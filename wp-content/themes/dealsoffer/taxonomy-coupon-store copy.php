<?php
/*
    Template Name: Browse Coupon by Store
*/

get_header();
global $dealsoffer_option;

if (is_tax('coupon-store')) {
    $term = get_queried_object();
    $current_url = get_term_link($term); // Get the current term URL
} else {
    $term = null;
    $current_url = home_url('/'); // Fallback to home URL
}

$items_per_page = 6;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// Get selected coupon types from URL
$selected_types = isset($_GET['type']) ? (array)$_GET['type'] : array();
$selected_categories = isset($_GET['category']) ? (array)$_GET['category'] : array();

// Base query arguments
$args = array(
    'post_type' => 'coupon',
    'post_status' => 'publish',
    'posts_per_page' => $items_per_page,
    'paged' => $paged,
);

// If we're viewing a specific store, filter by that store
if ($term) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'coupon-store',
            'field' => 'id',
            'terms' => $term->term_id,
            'operator' => 'IN',
        )
    );
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

// Add category filter if categories are selected
if (!empty($selected_categories)) {
    $args['tax_query'][] = array(
        'taxonomy' => 'coupon-category', // Change to your category taxonomy name if different
        'field' => 'term_id',
        'terms' => $selected_categories,
        'operator' => 'IN',
    );
}

// Get all coupon categories for the filter dropdown
$categories = get_terms(array(
    'taxonomy' => 'coupon-category', // Change to your category taxonomy name if different
    'hide_empty' => true,
));

// Get total count of coupons for this store
if ($term) {
    $count_args = array(
        'post_type' => 'coupon',
        'tax_query' => array(
            array(
                'taxonomy' => 'coupon-store',
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
    $store_name = $term->name;
    $store_description = $term->description;
    $store_rich_description = get_term_meta($term->term_id, 'store_rich_description', true);
    $store_address = get_term_meta($term->term_id, 'store_address', true);
    $store_url = get_term_meta($term->term_id, 'store_url', true);
    $store_image_id = get_term_meta($term->term_id, 'store_image', true);
    $store_image_url = $store_image_id ? wp_get_attachment_image_url($store_image_id, 'full') : '';
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
                                    <?php if ($store_image_url) : ?>
                                        <div class="store-logo mb-15">
                                            <img src="<?php echo esc_url($store_image_url); ?>" alt="<?php echo esc_attr($store_name); ?>">
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($store_rich_description)) : ?>
                                        <div class="store-rich-description mb-10">
                                            <?php echo wp_kses_post($store_rich_description); ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="store-go-to-website">
                                        <a href="<?php echo esc_url( $store_url ); ?>"><?php echo esc_html__( 'Go To Shop', 'dealsoffer' ); ?></a>
                                    </div>

                                    <?php if (!empty($store_address)) : ?>
                                        <div class="store-address">
                                            <i class="tp tp-location-dot"></i>
                                            <?php echo esc_html($store_address); ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                </div>

                                <div class="white-block-content search-filter ">

                                    <div class="widget-title">
                                        <h4 class="mb-0"><?php esc_html_e('Deals or Coupons', 'dealsoffer'); ?></h4>
                                    </div>

                                    <form method="GET" action="<?php echo esc_url($current_url); ?>" class="widget-search-coupons">
                                        <?php if ($term) : ?>
                                            <input type="hidden" name="coupon-store" value="<?php echo esc_attr($term->slug); ?>">
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

                                        <!-- Category Filter Start -->
                                        <?php if (!empty($categories) && !is_wp_error($categories)) : ?>
                                            <div class="white-block-content-wrapper mt-40">
                                                <div class="widget-title">
                                                    <h4 class="mb-0"><?php esc_html_e('Category', 'dealsoffer'); ?></h4>
                                                </div>
                                                <div class="filter-section">
                                                    <div class="form-group categories-wrap clearfix">
                                                        <?php foreach ($categories as $category) : ?>
                                                            <div class="coupon_category_item">
                                                                <input type="checkbox" name="category[]" value="<?php echo esc_attr($category->term_id); ?>" 
                                                                    id="sidebar-category-<?php echo esc_attr($category->term_id); ?>"
                                                                    <?php checked(in_array($category->term_id, $selected_categories)); ?>>
                                                                <label for="sidebar-category-<?php echo esc_attr($category->term_id); ?>" class="search-category">
                                                                    <?php echo esc_html($category->name); ?>
                                                                </label>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <!-- Category Filter end -->
                                        
                                        
                                        <noscript>
                                            <button type="submit" class="btn submit-form"><?php esc_html_e('Apply Filter', 'dealsoffer'); ?></button>
                                        </noscript>
                                    </form>

                                </div>

                                <?php if ($term) : ?>
                                    <div class="white-block-content mt-40">
                                        <div class="widget-title">
                                            <h4 class="mb-0"><?php esc_html_e('About Store', 'dealsoffer'); ?></h4>
                                        </div>
                                        <?php if (!empty($store_description)) : ?>
                                            <div class="store-description ">
                                                <?php echo wp_kses_post($store_description); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                            </div>
                            <?php endif; ?>


                        </div>
                    </aside>
                </div>

                <div class="col-xxl-8 col-xl-8 col-lg-8">
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
                                            
                                            // Get store info for each coupon
                                            $stores = get_the_terms(get_the_ID(), 'coupon-store');
                                            $store_link = $term ? get_term_link($term) : '';
                                            $store_image_url = $term ? $store_image_url : '';
                                            
                                            if (!$term && $stores && !is_wp_error($stores)) {
                                                foreach ($stores as $store) {
                                                    
                                                    $store_link = get_term_link($store);
                                                    $store_image_id = get_term_meta($store->term_id, 'store_image', true);
                                                    if ($store_image_id) {
                                                        $store_image_url = wp_get_attachment_image_url($store_image_id, 'full');
                                                    }
                                                    break;
                                                }
                                            }
                                    ?>
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="tp-coupons-item-single-wrapper">
                                            <div class="tp-coupons-item-single tp-taxnomoy-grid-item">

                                                <!-- <a class="tp-coupons-item-single-img" href="<?php // echo esc_url( $store_link ); ?>">
                                                    <img src="<?php // echo esc_url( $store_image_url ); ?>" alt="<?php // echo esc_attr(get_post_meta($att, '_wp_attachment_image_alt', true)); ?>">
                                                </a> -->

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
                                            
                                            // Get store info for each coupon
                                            $stores = get_the_terms(get_the_ID(), 'coupon-store');
                                            $store_link = $term ? get_term_link($term) : '';
                                            $store_image_url = $term ? $store_image_url : '';
                                            
                                            if (!$term && $stores && !is_wp_error($stores)) {
                                                foreach ($stores as $store) {
                                                    $store_link = get_term_link($store);
                                                    $store_image_id = get_term_meta($store->term_id, 'store_image', true);
                                                    if ($store_image_id) {
                                                        $store_image_url = wp_get_attachment_image_url($store_image_id, 'full');
                                                    }
                                                    break;
                                                }
                                            }
                                    ?>
                                    <div class="col-xl-12">
                                        <div class="tp-coupons-item-single tp-taxnomoy-list-item">

                                            <!-- <a class="tp-coupons-item-single-img" href="<?php // echo esc_url( $store_link ); ?>">
                                                <img src="<?php // echo esc_url( $store_image_url ); ?>" alt="<?php // echo esc_attr(get_post_meta($att, '_wp_attachment_image_alt', true)); ?>">
                                            </a> -->
                                            
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