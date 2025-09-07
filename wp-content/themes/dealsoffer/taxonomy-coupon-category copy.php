<?php
get_header();
global $dealsoffer_option;

if (is_tax('coupon-category')) {
    $term = get_queried_object();
    $current_url = get_term_link($term); // Get the current term URL
} else {
    $term = null;
    $current_url = home_url('/'); // Fallback to home URL
}

/* 
########################################################################################################
top portion start 
########################################################################################################
*/ 

// Get category stats
$total_deals = wp_count_posts('coupon')->publish;
$active_coupons = get_posts(array(
    'post_type' => 'coupon',
    'tax_query' => array(
        array(
            'taxonomy' => 'coupon-category',
            'field' => 'id',
            'terms' => $term->term_id
        )
    ),
    'meta_query' => array(
        array(
            'key' => 'expire',
            'value' => time(),
            'compare' => '>',
            'type' => 'NUMERIC'
        )
    ),
    'posts_per_page' => -1
));
$active_count = count($active_coupons);

// Get used count for today
$used_today = get_posts(array(
    'post_type' => 'coupon',
    'tax_query' => array(
        array(
            'taxonomy' => 'coupon-category',
            'field' => 'id',
            'terms' => $term->term_id
        )
    ),
    'meta_query' => array(
        array(
            'key' => 'last_used',
            'value' => strtotime('today midnight'),
            'compare' => '>=',
            'type' => 'NUMERIC'
        )
    ),
    'posts_per_page' => -1
));
$used_today_count = count($used_today);

/* 
########################################################################################################
top portion end
########################################################################################################
*/ 

$items_per_page = 6;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// Get selected coupon types from URL - sanitize inputs
$selected_types = isset($_GET['type']) ? array_map('intval', (array)$_GET['type']) : array();
$selected_stores = isset($_GET['store']) ? array_map('intval', (array)$_GET['store']) : array();

// Base query arguments
$args = array(
    'post_type' => 'coupon',
    'post_status' => 'publish',
    'posts_per_page' => $items_per_page,
    'paged' => $paged,
);

// Initialize tax query array
$tax_query = array();

// If we're viewing a specific store, filter by that store
if ($term) {
    $tax_query[] = array(
        'taxonomy' => 'coupon-category',
        'field' => 'id',
        'terms' => $term->term_id,
        'operator' => 'IN',
    );
}

// Add store filter if Stores are selected
if (!empty($selected_stores)) {
    $tax_query[] = array(
        'taxonomy' => 'coupon-store',
        'field' => 'term_id',
        'terms' => $selected_stores,
        'operator' => 'IN',
    );
}

// If we have multiple tax queries, set the relation
if (count($tax_query) > 1) {
    $tax_query['relation'] = 'AND';
}

if (!empty($tax_query)) {
    $args['tax_query'] = $tax_query;
}

// Add coupon type filter if types are selected
if (!empty($selected_types)) {
    $args['meta_query'] = array(
        array(
            'key' => 'ctype',
            'value' => $selected_types,
            'compare' => 'IN'
        )
    );
}
// Add store filter if Stores are selected
if (!empty($selected_stores)) {
    $args['tax_query'][] = array(
        'taxonomy' => 'coupon-store', // Change to your store taxonomy name if different
        'field' => 'term_id',
        'terms' => $selected_stores,
        'operator' => 'IN',
    );
}

// Get all coupon stores for the filter dropdown
$storesfilter = get_terms(array(
    'taxonomy' => 'coupon-store', // Change to your store taxonomy name if different
    'hide_empty' => true,
));

// Get total count of coupons for this store
if ($term) {
    $count_args = array(
        'post_type' => 'coupon',
        'tax_query' => array(
            array(
                'taxonomy' => 'coupon-category',
                'field' => 'id',
                'terms' => $term->term_id,
            )
        )
    );
    
    if (!empty($selected_types)) {
        $count_args['meta_query'] = array(
            array(
                'key' => 'ctype',
                'value' => $selected_types,
                'compare' => 'IN'
            )
        );
    }
    
    $count_query = new WP_Query($count_args);
    $total_coupons = $count_query->found_posts;
    wp_reset_postdata();
} else {
    $count_args = array(
        'post_type' => 'coupon',
        'posts_per_page' => -1
    );
    
    if (!empty($selected_types)) {
        $count_args['meta_query'] = array(
            array(
                'key' => 'ctype',
                'value' => $selected_types,
                'compare' => 'IN'
            )
        );
    }
    
    $count_query = new WP_Query($count_args);
    $total_coupons = $count_query->found_posts;
    wp_reset_postdata();
}

// Get selected orderby from cookie
$selected_orderby = couponis_get_search_orderby_cookie();

// Apply orderby if selected
if (!empty($selected_orderby)) {
    $args['orderby'] = $selected_orderby;
    $args['order'] = ($selected_orderby == 'expire' || $selected_orderby == 'name') ? 'ASC' : 'DESC';
}

// Run the query
$coupons = new WP_Query($args);

$page_links_total = $coupons->max_num_pages;
$pagination = paginate_links(
    array(
        'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
        'format' => '?paged=%#%',
        'current' => max(1, $paged),
        'total' => $page_links_total,
        'end_size' => 1,
        'mid_size' => 1,
        'prev_text' => '<i class="tp tp-arrow-left"></i>',
        'next_text' => '<i class="tp tp-arrow-right"></i>',
    )
);

// Get store information if we're on a store page
if ($term) {
    $cat_name = $term->name;
    $cat_desc = $term->description;
    $cat_image_id = get_term_meta($term->term_id, 'category_icon', true);
    $cat_image_url = $cat_image_id ? wp_get_attachment_image_url($cat_image_id, 'full') : '';
}
?>

<main>
    <div class="container">
        <div class="main-listing">
            <div class="row">
                <div class="col-xxl-4 col-xl-4 col-lg-4">
                    <aside id="secondary" class="widget-area sticky-sidebar">
                        <div class="themephi-sideabr dynamic-sidebar">

                            <?php if ($term) : ?>
                            <div class="widget white-block store-info ">
                                <div class="white-block-content text-center mb-40">
                                    <?php if ($cat_image_url) : ?>
                                        <div class="tp-coupon-taxonomy-img mb-15">
                                            <img src="<?php echo esc_url($cat_image_url); ?>" alt="<?php echo esc_attr($cat_name); ?>">
                                        </div>
                                    <?php endif; ?>
                                    <div class="tp-coupon-taxonomy-text">
                                        <h4 class="tp-coupon-taxonomy-title"><?php echo esc_html( $cat_name ); ?></h4>
                                        <p><?php echo wp_kses_post( $cat_desc ); ?></p>

                                        <div class="store-go-to-website">
                                            <a href="<?php echo get_term_link($term->term_id); ?>"><?php echo esc_html__( 'Explore Category', 'dealsoffer' ); ?></a>
                                        </div>
                                    </div>

                                </div>

                                <div class="white-block-content search-filter ">

                                    <div class="widget-title">
                                        <h4 class="mb-0"><?php esc_html_e('Deals or Coupons', 'dealsoffer'); ?></h4>
                                    </div>

                                    <form method="GET" action="<?php echo esc_url($current_url); ?>" class="widget-search-coupons">
                                        <?php if ($term) : ?>
                                            <input type="hidden" name="coupon-category" value="<?php echo esc_attr($term->slug); ?>">
                                        <?php endif; ?>
                                        <div class="coupon_types_item_wrapper">
                                            <div class="form-group types-wrap clearfix">
                                                <div class="coupon_types_item">
                                                    <input type="checkbox" name="type[]" value="1" id="sidebar-check-type-1" <?php checked(in_array('1', $selected_types)); ?>>
                                                    <label for="sidebar-check-type-1" class="search-type">
                                                        <?php esc_html_e('ONLINE CODES', 'dealsoffer') ?>
                                                    </label>
                                                </div>
                                                
                                                <div class="coupon_types_item">
                                                    <input type="checkbox" name="type[]" value="2" id="sidebar-check-type-2" <?php checked(in_array('2', $selected_types)); ?>>
                                                    <label for="sidebar-check-type-2" class="search-type">
                                                        <?php esc_html_e('STORE CODES', 'dealsoffer') ?>
                                                    </label>
                                                </div>
                                                
                                                <div class="coupon_types_item">
                                                    <input type="checkbox" name="type[]" value="3" id="sidebar-check-type-3" <?php checked(in_array('3', $selected_types)); ?>>
                                                    <label for="sidebar-check-type-3" class="search-type">
                                                        <?php esc_html_e('ONLINE SALES', 'dealsoffer') ?>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Store Filter Start -->
                                        <?php if (!empty($storesfilter) && !is_wp_error($storesfilter)) : ?>
                                            <div class="white-block-content-wrapper mt-40">
                                                <div class="widget-title">
                                                    <h4 class="mb-0"><?php esc_html_e('Stores', 'dealsoffer'); ?></h4>
                                                </div>
                                                <div class="filter-section">
                                                    <div class="form-group categories-wrap clearfix">
                                                        <?php foreach ($storesfilter as $storefilter) : ?>
                                                            <div class="coupon_category_item">
                                                                <input type="checkbox" name="store[]" value="<?php echo esc_attr($storefilter->term_id); ?>" 
                                                                    id="sidebar-category-<?php echo esc_attr($storefilter->term_id); ?>"
                                                                    <?php checked(in_array($storefilter->term_id, $selected_stores)); ?>>
                                                                <label for="sidebar-category-<?php echo esc_attr($storefilter->term_id); ?>" class="search-store">
                                                                    <?php echo esc_html($storefilter->name); ?>
                                                                </label>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <!-- Store Filter end -->
                                        
                                        
                                        <noscript>
                                            <button type="submit" class="btn submit-form"><?php esc_html_e('Apply Filter', 'dealsoffer'); ?></button>
                                        </noscript>
                                    </form>

                                </div>


                            </div>
                            <?php endif; ?>


                        </div>
                    </aside>
                </div>

                <div class="col-xxl-8 col-xl-8 col-lg-8">
                    <div class="coupon-box-layout-wrapper">
                        <div class="coupon-box-layout-item">
                            <span class="coupon-box-layout-item-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--primaryColor)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star text-blue-600"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                            </span>
                            <div class="coupon-box-layout-item-content">
                                <span class="coupon-box-layout-item-text"><?php echo esc_html__( 'Total Coupons', 'dealsoffer' ); ?></span>
                                <h4 class="coupon-box-layout-item-number mb-0"><?php echo esc_html($total_deals); ?></h4>
                            </div>                                
                        </div>
                        <div class="coupon-box-layout-item">
                            <span class="coupon-box-layout-item-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--primaryColor)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-zap text-blue-600"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                        </span>
                            <div class="coupon-box-layout-item-content">
                                <span class="coupon-box-layout-item-text"><?php echo esc_html__( 'Active Coupons', 'dealsoffer' ); ?></span>
                                <h4 class="coupon-box-layout-item-number mb-0"><?php echo esc_html($active_count); ?></h4>
                            </div>                                
                        </div>
                        <div class="coupon-box-layout-item">
                            <span class="coupon-box-layout-item-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--primaryColor)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-up text-blue-600"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline><polyline points="16 7 22 7 22 13"></polyline></svg>
                        </span>
                            <div class="coupon-box-layout-item-content">
                                <span class="coupon-box-layout-item-text"><?php echo esc_html__( 'Used Today', 'dealsoffer' ); ?></span>
                                <h4 class="coupon-box-layout-item-number mb-0"><?php echo esc_html($used_today_count); ?></h4>
                            </div>                                
                        </div>
                    </div>
                    <div class="search-content">
                        <div class="white-block search-header">
                            <div class="white-block-content">
                                <div class="flex-wrap flex-always d-flex align-items-center mb-15">
                                    <div class="flex-left header-alike">
                                        <?php 
                                        echo esc_html__('Found', 'dealsoffer') . ' ' . $total_coupons . ' ';
                                        echo ($total_coupons == 1) ? esc_html__('coupon', 'dealsoffer') : esc_html__('coupons', 'dealsoffer');
                                        ?>
                                    </div>
                                    <div class="flex-right">
                                        <ul class="nav justify-content-sm-end tp-taxonomy-tab-item-wrapper" id="taxonomyTab" role="tablist">
                                            <li class="tp-taxonomy-tab-item" role="presentation">
                                                <button class="active" id="taxonomyGrid-tab" data-bs-toggle="pill" data-bs-target="#taxonomyGrid" role="tab" aria-controls="taxonomyGrid" aria-selected="true">
                                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5.66667 1H1V5.66667H5.66667V1Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M12.9997 1H8.33301V5.66667H12.9997V1Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M12.9997 8.33337H8.33301V13H12.9997V8.33337Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M5.66667 8.33337H1V13H5.66667V8.33337Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </button>
                                            </li>
                                            <li class="tp-taxonomy-tab-item" role="presentation">
                                                <button id="taxonomyList-tab" data-bs-toggle="pill" data-bs-target="#taxonomyList" role="tab" aria-controls="taxonomyList" aria-selected="false">
                                                    <svg width="14" height="14" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M15 7.11108H1" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M15 1H1" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M15 13.2222H1" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </button>
                                            </li>
                                            <?php echo couponis_search_orderby(); ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-content" id="taxonomyTabContent">
                            <div class="tab-pane fade show active" id="taxonomyGrid" role="tabpanel" aria-labelledby="taxonomyGrid-tab">
                                <div class="row">
                                    <?php 
                                    if ($coupons->have_posts()) :
                                        while ($coupons->have_posts()) : $coupons->the_post();
                                            $exclusive = get_post_meta(get_the_ID(), 'exclusive', true);
                                            $expire_timestamp = get_post_meta(get_the_ID(), 'expire', true);
                                            $used = get_post_meta(get_the_ID(), 'used', true);
                                            $current_used = tp_register_coupon_used(get_the_ID(), $used);
                                            $current_coupon_type = get_post_meta(get_the_ID(), 'ctype', true);
                                    ?>
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="tp-coupons-item-single-wrapper">
                                            <div class="tp-coupons-item-single tp-taxnomoy-grid-item">
                                                <?php if ( has_post_thumbnail() ) : ?>
                                                <a class="tp-coupons-item-single-img" href="<?php echo esc_url(get_the_permalink()); ?>">
                                                    <?php the_post_thumbnail(); ?>
                                                </a>
                                                <?php endif; ?>

                                                <div class="tp-coupons-item-single-content">
                                                    <div class="tp-coupons-item-single-content-inner">
                                                        <div class="tp-coupons-item-single-upper-metas">
                                                            <?php if (!empty($exclusive)) : ?>
                                                            <span class="tp-coupons-item-single-upper-meta"><?php echo esc_html__('Exclusive', 'dealsoffer'); ?></span> 
                                                            <?php endif; ?>
                                                            <?php if (!empty($expire_timestamp)) : ?>
                                                            <span class="tp-coupons-item-single-upper-meta"><i class="tp tp-calendar-days"></i> <?php echo date('d M, Y', $expire_timestamp); ?></span> 
                                                            <?php endif; ?>
                                                        </div>
                                                        <h4 class="tp-coupons-item-single-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                                        <div class="tp-coupons-item-single-metas">
                                                            <?php if (!empty($current_used)) : ?>
                                                            <span class="tp-coupons-item-single-meta"><i class="tp tp-basket-shopping"></i> <?php echo esc_html($current_used); ?></span> 
                                                            <?php endif; ?>
                                                            <span class="tp-coupons-item-single-meta-bundle">
                                                                <a href="<?php echo get_comments_link(); ?>" class="tp-coupons-item-single-meta"><i class="tp tp-comments"></i> <?php echo get_comments_number(); ?></a> 
                                                            </span> 
                                                        </div>
                                                    </div>
                                                    <div class="tp-coupons-item-single-button">               
                                                        <?php 
                                                        $href = '#o-' . get_the_ID();
                                                        $data_href = '';
                                                        $coupon_affiliate = get_post_meta(get_the_ID(), 'coupon_affiliate', true);

                                                        if (!empty($coupon_affiliate)) {
                                                            $href = add_query_arg(array()) . $href;
                                                            $data_href = add_query_arg(array('cout' => get_the_ID()), home_url('/'));
                                                        }

                                                        if ($current_coupon_type == 1) {
                                                            $coupon_code = get_post_meta(get_the_ID(), 'coupon_code_change', true);
                                                            ?>
                                                            <a class="coupon-action-button header-alike" href="<?php echo esc_attr($href); ?>" 
                                                            <?php if (!empty($data_href)) : ?> data-affiliate="<?php echo esc_url($data_href); ?>" target="_blank" <?php endif; ?> rel="nofollow">
                                                                <span class="code-text"><?php echo esc_html__('GET CODE', 'dealsoffer'); ?></span>
                                                                <span class="partial-code">&nbsp;<?php echo substr($coupon_code, -4, 4); ?></span>
                                                            </a>
                                                        <?php
                                                        } elseif ($current_coupon_type == 2) { ?>
                                                            <a class="coupon-action-button header-alike" href="<?php echo esc_attr($href); ?>" 
                                                            <?php if (!empty($data_href)) : ?> data-affiliate="<?php echo esc_url($data_href); ?>" target="_blank" <?php endif; ?> rel="nofollow">
                                                                <span class="code-text-full"><?php echo esc_html('Print Code', 'dealsoffer'); ?></span>
                                                            </a>
                                                        <?php
                                                        } elseif ($current_coupon_type == 3) { ?>
                                                            <a class="coupon-action-button header-alike" href="<?php echo esc_attr($href); ?>" 
                                                            <?php if (!empty($data_href)) : ?> data-affiliate="<?php echo esc_url($data_href); ?>" target="_blank" <?php endif; ?> rel="nofollow">
                                                                <span class="code-text-full"><?php echo esc_html('Get Deal', 'dealsoffer'); ?></span>
                                                            </a>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                        endwhile;
                                    else:
                                        echo '<div class="col-12"><div class="alert alert-info">' . esc_html__('No coupons found matching your criteria.', 'dealsoffer') . '</div></div>';
                                    endif;
                                    ?>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="taxonomyList" role="tabpanel" aria-labelledby="taxonomyList-tab">
                                <div class="row">
                                    <?php 
                                    $coupons->rewind_posts();
                                    if ($coupons->have_posts()) :
                                        while ($coupons->have_posts()) : $coupons->the_post();
                                            $exclusive = get_post_meta(get_the_ID(), 'exclusive', true);
                                            $expire_timestamp = get_post_meta(get_the_ID(), 'expire', true);
                                            $used = get_post_meta(get_the_ID(), 'used', true);
                                            $current_used = tp_register_coupon_used(get_the_ID(), $used);
                                            $current_coupon_type = get_post_meta(get_the_ID(), 'ctype', true);
                                    ?>
                                    <div class="col-xl-12">
                                        <div class="tp-coupons-item-single tp-taxnomoy-list-item">
                                            <?php if ( has_post_thumbnail() ) : ?>
                                            <a class="tp-coupons-item-single-img" href="<?php echo esc_url(get_the_permalink()); ?>">
                                                <?php the_post_thumbnail(); ?>
                                            </a>
                                            <?php endif; ?>

                                            <div class="tp-coupons-item-single-content">
                                                <div class="tp-coupons-item-single-content-inner">
                                                    <div class="tp-coupons-item-single-upper-metas">
                                                        <?php if (!empty($exclusive)) : ?>
                                                        <span class="tp-coupons-item-single-upper-meta"><?php echo esc_html__('Exclusive', 'dealsoffer'); ?></span> 
                                                        <?php endif; ?>
                                                        <?php if (!empty($expire_timestamp)) : ?>
                                                        <span class="tp-coupons-item-single-upper-meta"><i class="tp tp-calendar-days"></i> <?php echo date('d M, Y', $expire_timestamp); ?></span> 
                                                        <?php endif; ?>
                                                    </div>
                                                    <h4 class="tp-coupons-item-single-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                                    <div class="tp-coupons-item-single-metas">
                                                        <?php if (!empty($current_used)) : ?>
                                                        <span class="tp-coupons-item-single-meta"><i class="tp tp-basket-shopping"></i> <?php echo esc_html($current_used); ?></span> 
                                                        <?php endif; ?>
                                                        <span class="tp-coupons-item-single-meta-bundle">
                                                            <a href="<?php echo get_comments_link(); ?>" class="tp-coupons-item-single-meta"><i class="tp tp-comments"></i> <?php echo get_comments_number(); ?></a> 
                                                        </span> 
                                                    </div>
                                                </div>
                                                <div class="tp-coupons-item-single-button">               
                                                    <?php 
                                                    $href = '#o-' . get_the_ID();
                                                    $data_href = '';
                                                    $coupon_affiliate = get_post_meta(get_the_ID(), 'coupon_affiliate', true);

                                                    if (!empty($coupon_affiliate)) {
                                                        $href = add_query_arg(array()) . $href;
                                                        $data_href = add_query_arg(array('cout' => get_the_ID()), home_url('/'));
                                                    }

                                                    if ($current_coupon_type == 1) {
                                                        $coupon_code = get_post_meta(get_the_ID(), 'coupon_code_change', true);
                                                        ?>
                                                        <a class="coupon-action-button header-alike" href="<?php echo esc_attr($href); ?>" 
                                                        <?php if (!empty($data_href)) : ?> data-affiliate="<?php echo esc_url($data_href); ?>" target="_blank" <?php endif; ?> rel="nofollow">
                                                            <span class="code-text"><?php echo esc_html__('GET CODE', 'dealsoffer'); ?></span>
                                                            <span class="partial-code">&nbsp;<?php echo substr($coupon_code, -4, 4); ?></span>
                                                        </a>
                                                    <?php
                                                    } elseif ($current_coupon_type == 2) { ?>
                                                        <a class="coupon-action-button header-alike" href="<?php echo esc_attr($href); ?>" 
                                                        <?php if (!empty($data_href)) : ?> data-affiliate="<?php echo esc_url($data_href); ?>" target="_blank" <?php endif; ?> rel="nofollow">
                                                            <span class="code-text-full"><?php echo esc_html('Print Code', 'dealsoffer'); ?></span>
                                                        </a>
                                                    <?php
                                                    } elseif ($current_coupon_type == 3) { ?>
                                                        <a class="coupon-action-button header-alike" href="<?php echo esc_attr($href); ?>" 
                                                        <?php if (!empty($data_href)) : ?> data-affiliate="<?php echo esc_url($data_href); ?>" target="_blank" <?php endif; ?> rel="nofollow">
                                                            <span class="code-text-full"><?php echo esc_html('Get Deal', 'dealsoffer'); ?></span>
                                                        </a>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                        endwhile;
                                    else:
                                        echo '<div class="col-12"><div class="alert alert-info">' . esc_html__('No coupons found matching your criteria.', 'dealsoffer') . '</div></div>';
                                    endif;
                                    ?>
                                </div>
                            </div>
                        </div>

                        <?php
                        if (!empty($pagination)) {
                            echo '<div class="pagination header-alike">' . $pagination . '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
jQuery(document).ready(function($) {
    // Auto-submit form when checkbox is clicked
    $('.widget-search-coupons input[type="checkbox"]').change(function() {
        $(this).closest('form').submit();
    });
});
</script>

<?php get_footer(); ?>