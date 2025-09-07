<?php
/*
    Template Name: Browse Coupon
*/

get_header();

global $dealsoffer_option;
$coupon_slug = !empty($dealsoffer_option['trans_coupon']) ? $dealsoffer_option['trans_coupon'] : 'offer';

$cur_page = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);

// Get filter values from the URL
$category = !empty($_GET['category']) ? sanitize_text_field($_GET['category']) : '';
$store = !empty($_GET['store']) ? sanitize_text_field($_GET['store']) : '';
$keyword = !empty($_GET['keyword']) ? sanitize_text_field($_GET['keyword']) : '';
$type = !empty($_GET['type']) && is_array($_GET['type']) ? array_map('sanitize_text_field', $_GET['type']) : array();

$selected_orderby = couponis_get_search_orderby_cookie();

// Base query arguments
$search_args = array(
    'post_type'     => 'coupon',
    'post_status'   => 'publish',
    'orderby'       => 'date',
    'order'         => 'DESC',
    'paged'         => $cur_page,
    'tax_query'     => array(), 
    'posts_per_page' => 6,
);

// Apply orderby if selected
if (!empty($selected_orderby)) {
    $search_args['orderby'] = $selected_orderby;
    $search_args['order'] = ($selected_orderby == 'expire' || $selected_orderby == 'name') ? 'ASC' : 'DESC';
}

// Handle category filter
if (!empty($category)) {
    $search_args['tax_query'][] = array(
        'taxonomy' => 'coupon-category',
        //'field'    => 'slug', // Use 'slug' to match the category slug
        'terms'    => $category,
    );
}

// Handle store filter
if (!empty($store)) {
    $search_args['tax_query'][] = array(
        'taxonomy' => 'coupon-store',
        //'field'    => 'slug', // Use 'slug' to match the store slug
        'terms'    => $store,
    );
}

// Handle coupon type filter (Online Codes, Store Codes, Online Sales)
if (!empty($type)) {
    $search_args['meta_query'] = array(
        'relation' => 'OR',
    );
    if (in_array('1', $type)) {
        $search_args['meta_query'][] = array(
            'key'     => 'ctype',
            'value'   => '1',  // Online Codes
            'compare' => 'LIKE',
        );
    }
    if (in_array('2', $type)) {
        $search_args['meta_query'][] = array(
            'key'     => 'ctype',
            'value'   => '2',  // Store Codes
            'compare' => 'LIKE',
        );
    }
    if (in_array('3', $type)) {
        $search_args['meta_query'][] = array(
            'key'     => 'ctype',
            'value'   => '3',  // Online Sales
            'compare' => 'LIKE',
        );
    }
}

// Handle keyword search
if (!empty($keyword)) {
    $search_args['s'] = $keyword;
}

// Handle multiple taxonomies
if (count($search_args['tax_query']) > 1) {
    $search_args['tax_query']['relation'] = 'AND'; // Use 'AND' to match both category AND store
}

// Run the query
$coupons = new WP_Query($search_args);

$page_links_total = $coupons->max_num_pages;
$pagination = paginate_links(
    array(
        'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
        'format'    => '?paged=%#%',
        'current'   => max( 1, $cur_page ),
        'total'     => $page_links_total,
        'end_size'  => 1,
        'mid_size'  => 1,
        'prev_text' => '<i class="tp tp-arrow-left"></i>', // Previous arrow icon
        'next_text' => '<i class="tp tp-arrow-right"></i>', // Next arrow icon
    )
);
?>

<main>
    <div class="container">
        <div class="main-listing">
            <div class="row">
                <div class="col-xxl-4 col-xl-4 col-lg-4">

                    <aside id="secondary" class="widget-area sticky-sidebar">
                        <div class="themephi-sideabr dynamic-sidebar">

                            <div class="widget white-block hand-picked">
                                <div class="white-block-content">
                                    <div class="widget-title">
                                        <h4 class="mb-0"><?php esc_html_e('Shop by Store', 'deala'); ?></h4>
                                    </div>
                                    <div class="hand-picked-brands">
                                    <?php
                                    // Fetch all coupon-store terms
                                    $store_picks = get_terms(array(
                                        'taxonomy'   => 'coupon-store',
                                        'orderby'    => 'name',
                                        'hide_empty' => true,
                                    ));

                                    if (!is_wp_error($store_picks) && !empty($store_picks)) {
                                        foreach ($store_picks as $store_pick) {
                                            $store_link = get_term_link($store_pick);
                                            $store_image_id = get_term_meta($store_pick->term_id, 'store_image', true);

                                            if ($store_image_id) {
                                                $store_image_url = wp_get_attachment_image_url($store_image_id, 'full');
                                                ?>
                                                <a href="<?php echo esc_url($store_link); ?>" title="<?php echo esc_attr($store_pick->name); ?>">
                                                    <img src="<?php echo esc_url($store_image_url); ?>" alt="<?php echo esc_attr($store_pick->name); ?>" />
                                                </a>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>

                                    </div>
                                </div>
                            </div>

                            <div class="widget white-block coupon-tags">
                                <div class="white-block-content">
                                    <div class="widget-title">
                                        <h4 class="mb-0"><?php esc_html_e('Popular Tags', 'deala'); ?></h4>
                                    </div>
                                    <div class="hand-picked-tags">
                                    <?php
                                    $tags = get_terms(array(
                                        'taxonomy'   => 'coupon-tag',
                                        'orderby'    => 'name',
                                        'hide_empty' => true,
                                    ));

                                    if ( $tags && ! is_wp_error( $tags ) ) {
                                        foreach ( $tags as $tag ) {
                                            echo '<a href="' . esc_url( get_term_link( $tag ) ) . '">' . esc_html( $tag->name ) . '</a> ';
                                        }
                                    }
                                    ?>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </aside>

                </div>

                <div class="col-xxl-8 col-xl-8 col-lg-8">

                    <div class="search-filter-wrapp">
                        <?php
                        // Get selected values from URL parameters
                        $selected_types = isset($_GET['type']) ? $_GET['type'] : [];
                        $selected_category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';
                        $selected_store = isset($_GET['store']) ? sanitize_text_field($_GET['store']) : '';

                        $coupon_types = isset( $dealsoffer_option['coupon_types'] ) ? $dealsoffer_option['coupon_types'] : [];
                        $ajax_taxonomy = isset( $dealsoffer_option['ajax_taxonomy'] ) ? $dealsoffer_option['ajax_taxonomy'] : [];
                        ?>

                        <form method="GET" action="<?php echo esc_url(couponis_get_permalink_by_tpl('page-tpl_browse_coupon')); ?>" class="widget-search-coupons">

                            <?php if (empty($coupon_types) || sizeof($coupon_types) > 1): ?>
                            <div class="coupon_types_item_wrapper">
                                <div class="form-group types-wrap clearfix">

                                    <div class="coupon_types_item">
                                        <input type="checkbox" name="type[]" value="" id="check-type-" checked>
                                        <label for="check-type-" class="search-type">
                                            <i class="fal fa-filter"></i>
                                            <?php esc_html_e('All ' . ucfirst( $coupon_slug ), 'dealsoffer') ?>
                                        </label>
                                    </div>
                                    <?php if (empty($coupon_types) || in_array('1', $coupon_types)): ?>
                                        <div class="coupon_types_item">
                                            <input type="checkbox" name="type[]" value="1" id="check-type-1" <?php checked(in_array('1', $selected_types)) ?>>
                                            <label for="check-type-1" class="search-type">
                                                <i class="fal fa-link"></i>
                                                <?php esc_html_e('Online Codes', 'dealsoffer') ?>
                                            </label>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (empty($coupon_types) || in_array('2', $coupon_types)): ?>
                                        <div class="coupon_types_item">
                                            <input type="checkbox" name="type[]" value="2" id="check-type-2" <?php checked(in_array('2', $selected_types)) ?>>
                                            <label for="check-type-2" class="search-type">
                                                <i class="fal fa-tag"></i>
                                                <?php esc_html_e('Store Codes', 'dealsoffer') ?>
                                            </label>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (empty($coupon_types) || in_array('3', $coupon_types)): ?>
                                        <div class="coupon_types_item">
                                            <input type="checkbox" name="type[]" value="3" id="check-type-3" <?php checked(in_array('3', $selected_types)) ?>>
                                            <label for="check-type-3" class="search-type">
                                                <i class="fal fa-clock"></i>
                                                <?php esc_html_e('Online Sales', 'dealsoffer') ?>
                                            </label>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="search-filter-inputs">
                                <div class="form-group coupon-input-style">
                                    <label for="keyword"><?php esc_html_e('Keyword', 'dealsoffer') ?></label>
                                    <input type="text" id="keyword" name="keyword" placeholder="Keywords" class="form-control coupon-input-style-input" value="<?php echo esc_attr($keyword ?? '') ?>" />
                                </div>

                                <div class="form-group coupon-input-style">
                                    <label for="category"><?php esc_html_e('Category', 'dealsoffer') ?></label>
                                    <div class="styled-select select2-styled ">
                                        <select name="category" id="category" class="coupon-input-style-input <?php echo isset( $ajax_taxonomy ) && $ajax_taxonomy == 'yes' ? esc_attr( 'launch-select2' ) : '' ?>" data-taxonomy="coupon-category">
                                            <option value=""><?php esc_html_e( 'Category', 'dealsoffer' ) ?></option>
                                            <?php
                                            if( isset( $ajax_taxonomy ) && $ajax_taxonomy == 'yes' ){
                                                if( !empty( $category ) ){
                                                    $term = get_term_by( 'id', $category, 'coupon-category' );
                                                    if ( $term ) {
                                                        ?>
                                                        <option value="<?php echo esc_attr( $term->term_id ); ?>" selected="selected"><?php echo esc_html( $term->name ); ?></option>
                                                        <?php
                                                    }
                                                }
                                            } else {
                                                $categories = get_terms( array(
                                                    'taxonomy' => 'coupon-category',
                                                    'orderby'  => 'name',
                                                    'hide_empty' => false, // Show even empty terms
                                                ));

                                                if( !is_wp_error( $categories ) && !empty( $categories ) ){
                                                    foreach( $categories as $category_term ){
                                                        ?>
                                                        <option value="<?php echo esc_attr( $category_term->term_id ); ?>" <?php selected( $category, $category_term->term_id ); ?>>
                                                            <?php echo esc_html( $category_term->name ); ?>
                                                        </option>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group coupon-input-style">
                                    <label for="store"><?php esc_html_e('Store', 'dealsoffer') ?></label>
                                    <div class="styled-select select2-styled">
                                        <select name="store" id="store" class="coupon-input-style-input <?php echo isset( $ajax_taxonomy ) && $ajax_taxonomy == 'yes' ? esc_attr( 'launch-select2' ) : '' ?>" data-taxonomy="coupon-store">
                                            <option value=""><?php esc_html_e( 'Store', 'dealsoffer' ) ?></option>
                                            <?php
                                            if( isset( $ajax_taxonomy ) && $ajax_taxonomy == 'yes' ){
                                                if( !empty( $store ) ){
                                                    $term = get_term_by( 'id', $store, 'coupon-store' );
                                                    if ( $term ) {
                                                        ?>
                                                        <option value="<?php echo esc_attr( $term->term_id ); ?>" selected="selected"><?php echo esc_html( $term->name ); ?></option>
                                                        <?php
                                                    }
                                                }
                                            } else {
                                                $stores = get_terms( array(
                                                    'taxonomy' => 'coupon-store',
                                                    'orderby'  => 'name',
                                                    'hide_empty' => false, // Show even empty terms
                                                ));

                                                if( !is_wp_error( $stores ) && !empty( $stores ) ){
                                                    foreach( $stores as $store_term ){
                                                        ?>
                                                        <option value="<?php echo esc_attr( $store_term->term_id ); ?>" <?php selected( $store, $store_term->term_id ); ?>>
                                                            <?php echo esc_html( $store_term->name ); ?>
                                                        </option>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn submit-form"><?php esc_html_e('Filter', 'dealsoffer') ?></button>
                            </div>
                        </form>
                    </div>

                    <div class="search-content">
						<div class="white-block search-header">
							<div class="white-block-content">
								<div class="flex-wrap flex-always d-flex align-items-center justify-content-between mb-15">
									<div class="flex-left header-alike">
                                        <?php
                                        echo esc_html__( 'Found', 'dealsoffer' ) . ' ' . $coupons->found_posts . ' ' . 
                                            ( $coupons->found_posts == 1 
                                                ? esc_html( ucfirst( $coupon_slug ) ) 
                                                : esc_html( ucfirst( $coupon_slug ) . 's' ) 
                                            );
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
                                    <?php while ( $coupons->have_posts() ) : $coupons->the_post(); 
                                    $exclusive = get_post_meta( get_the_ID(), 'exclusive', true );
                                    $expire_timestamp = get_post_meta( get_the_ID(), 'expire', true );
                                    $used = get_post_meta( get_the_ID(), 'used', true );
                                    $current_used = tp_register_coupon_used( get_the_ID(), $used );
                                    $positive_feedback = get_post_meta( get_the_ID(), 'positive', true );
                                    // Store
                                    $stores = get_the_terms( get_the_ID(), 'coupon-store'); 
                                    
                                    if ($stores && !is_wp_error($stores)) {
                                        foreach ($stores as $store) {
                                            $store_name = $store->name;
                                            $store_description = $store->description;
                                            $store_rich_description = get_term_meta( $store->term_id, 'store_rich_description', true );
                                            $store_address = get_term_meta( $store->term_id, 'store_address', true );
                                            $store_link = get_term_link($store);
                                            $store_image_id = get_term_meta($store->term_id, 'store_image', true);
                                            if ($store_image_id) {
                                                $store_image_url = wp_get_attachment_image_url($store_image_id, 'full'); 
                                            }
                                    
                                        }
                                    }
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
                                                                <?php if( !empty( $expire_timestamp ) ) : ?>
                                                                <span class="tp-coupons-item-single-upper-meta"><i class="tp tp-calendar-days"></i> <?php echo date( 'd M, Y', $expire_timestamp ); ?></span> 
                                                                <?php endif; ?>
                                                                <?php if( !empty( $current_used ) ) : ?>
                                                                <span class="tp-coupons-item-single-upper-meta"><i class="tp tp-basket-shopping"></i> <?php echo esc_html( $current_used ); ?></span> 
                                                                <?php endif; ?>
                                                                <?php if( !empty( $positive_feedback ) ) : ?>
                                                                <span class="tp-coupons-item-single-upper-meta"><i class="far fa-thumbs-up"></i> <?php echo esc_html( $positive_feedback ); ?></span> 
                                                                <?php endif; ?>

                                                                <a href="<?php echo get_comments_link(); ?>" class="tp-coupons-item-single-upper-meta"><i class="tp tp-comments"></i> <?php echo get_comments_number() ?></a> 

                                                            </div>
                                                            <h4 class="tp-coupons-item-single-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
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

                                                            $current_coupon_type = get_post_meta(get_the_ID(), 'ctype', true);

                                                            $effective_coupon_type = !empty($coupon_type) ? $coupon_type : $current_coupon_type;

                                                            if ($effective_coupon_type == 1) {
                                                                $coupon_code = get_post_meta(get_the_ID(), 'coupon_code_change', true);
                                                                ?>
                                                                <a class="coupon-action-button header-alike " href="<?php echo esc_attr($href); ?>" 
                                                                <?php if (!empty($data_href)) : ?> data-affiliate="<?php echo esc_url($data_href); ?>" target="_blank" <?php endif; ?> rel="nofollow" >
                                                                    <span class="code-text"><?php echo esc_html__('GET CODE', 'dealsoffer'); ?></span>
                                                                    <span class="partial-code">&nbsp;<?php echo substr($coupon_code, -4, 4); ?></span>
                                                                </a>
                                                            <?php
                                                            } elseif ($effective_coupon_type == 2) { ?>
                                                                <a class="coupon-action-button header-alike " href="<?php echo esc_attr($href); ?>" 
                                                                <?php if (!empty($data_href)) : ?> data-affiliate="<?php echo esc_url($data_href); ?>" target="_blank" <?php endif; ?> rel="nofollow"  >
                                                                    <span class="code-text-full"><?php echo esc_html( 'Print Code', 'dealsoffer' ); ?></span>
                                                                </a>
                                                            <?php
                                                            } elseif ($effective_coupon_type == 3) { ?>
                                                                <a class="coupon-action-button header-alike " href="<?php echo esc_attr($href); ?>" 
                                                                <?php if (!empty($data_href)) : ?> data-affiliate="<?php echo esc_url($data_href); ?>" target="_blank" <?php endif; ?> rel="nofollow"  >
                                                                    <span class="code-text-full"><?php echo esc_html( 'Get Deal', 'dealsoffer' ); ?></span>
                                                                </a>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>

                                                        <div class="tp-coupons-store-box">
                                                            <a class="tp-coupons-store-box-img" href="<?php echo esc_url( $store_link ); ?>">
                                                                <img src="<?php echo esc_url( $store_image_url ); ?>" alt="<?php echo esc_attr(get_post_meta($att, '_wp_attachment_image_alt', true)); ?>">
                                                            </a>
                                                            <div class="tp-coupons-store-box-content">
                                                                <h4 class="tp-coupons-store-box-title"><a href="<?php echo esc_url( $store_link ); ?>"><?php echo esc_html( $store_name ); ?></a></h4>
                                                                <span><?php echo esc_html( $store_address ); ?></span>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="taxonomyList" role="tabpanel" aria-labelledby="taxonomyList-tab">

                                <div class="row">
                                    <?php while ( $coupons->have_posts() ) : $coupons->the_post(); 
                                    $exclusive = get_post_meta( get_the_ID(), 'exclusive', true );
                                    $expire_timestamp = get_post_meta( get_the_ID(), 'expire', true );
                                    $used = get_post_meta( get_the_ID(), 'used', true );
                                    $current_used = tp_register_coupon_used( get_the_ID(), $used );
                                    
                                    // Store
                                    $stores = get_the_terms( get_the_ID(), 'coupon-store'); 
                                    
                                    if ($stores && !is_wp_error($stores)) {
                                        foreach ($stores as $store) {
                                            $store_name = $store->name;
                                            $store_description = $store->description;
                                            $store_rich_description = get_term_meta( $store->term_id, 'store_rich_description', true );
                                            $store_address = get_term_meta( $store->term_id, 'store_address', true );
                                            $store_link = get_term_link($store);
                                            $store_image_id = get_term_meta($store->term_id, 'store_image', true);
                                            if ($store_image_id) {
                                                $store_image_url = wp_get_attachment_image_url($store_image_id, 'full'); 
                                            }
                                    
                                        }
                                    }
                                    ?>
                                        <div class="col-xl-12">
                                            <div class="tp-coupons-item-single-wrapp ">

                                                <div class="tp-coupons-item-single tp-taxnomoy-list-item">

                                                    <?php if ( has_post_thumbnail() ) : ?>
                                                    <a class="tp-coupons-item-single-img" href="<?php echo esc_url(get_the_permalink()); ?>">
                                                        <?php the_post_thumbnail(); ?>
                                                    </a>
                                                    <?php endif; ?>


                                                    <div class="tp-coupons-item-single-content">
                                                        <div class="tp-coupons-item-single-content-inner">
                                                            <div class="tp-coupons-item-single-upper-metas">
                                                                <?php if( !empty( $expire_timestamp ) ) : ?>
                                                                <span class="tp-coupons-item-single-upper-meta"><i class="tp tp-calendar-days"></i> <?php echo date( 'd M, Y', $expire_timestamp ); ?></span> 
                                                                <?php endif; ?>
                                                                <?php if( !empty( $current_used ) ) : ?>
                                                                <span class="tp-coupons-item-single-upper-meta"><i class="tp tp-basket-shopping"></i> <?php echo esc_html( $current_used ); ?></span> 
                                                                <?php endif; ?>
                                                                <?php if( !empty( $positive_feedback ) ) : ?>
                                                                <span class="tp-coupons-item-single-upper-meta"><i class="far fa-thumbs-up"></i> <?php echo esc_html( $positive_feedback ); ?></span> 
                                                                <?php endif; ?>

                                                                <a href="<?php echo get_comments_link(); ?>" class="tp-coupons-item-single-upper-meta"><i class="tp tp-comments"></i> <?php echo get_comments_number() ?></a> 

                                                            </div>
                                                            <h4 class="tp-coupons-item-single-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
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

                                                            $current_coupon_type = get_post_meta(get_the_ID(), 'ctype', true);

                                                            $effective_coupon_type = !empty($coupon_type) ? $coupon_type : $current_coupon_type;

                                                            if ($effective_coupon_type == 1) {
                                                                $coupon_code = get_post_meta(get_the_ID(), 'coupon_code_change', true);
                                                                ?>
                                                                <a class="coupon-action-button header-alike " href="<?php echo esc_attr($href); ?>" 
                                                                <?php if (!empty($data_href)) : ?> data-affiliate="<?php echo esc_url($data_href); ?>" target="_blank" <?php endif; ?> rel="nofollow" >
                                                                    <span class="code-text"><?php echo esc_html__('GET CODE', 'dealsoffer'); ?></span>
                                                                    <span class="partial-code">&nbsp;<?php echo substr($coupon_code, -4, 4); ?></span>
                                                                </a>
                                                            <?php
                                                            } elseif ($effective_coupon_type == 2) { ?>
                                                                <a class="coupon-action-button header-alike " href="<?php echo esc_attr($href); ?>" 
                                                                <?php if (!empty($data_href)) : ?> data-affiliate="<?php echo esc_url($data_href); ?>" target="_blank" <?php endif; ?> rel="nofollow"  >
                                                                    <span class="code-text-full"><?php echo esc_html( 'Print Code', 'dealsoffer' ); ?></span>
                                                                </a>
                                                            <?php
                                                            } elseif ($effective_coupon_type == 3) { ?>
                                                                <a class="coupon-action-button header-alike " href="<?php echo esc_attr($href); ?>" 
                                                                <?php if (!empty($data_href)) : ?> data-affiliate="<?php echo esc_url($data_href); ?>" target="_blank" <?php endif; ?> rel="nofollow"  >
                                                                    <span class="code-text-full"><?php echo esc_html( 'Get Deal', 'dealsoffer' ); ?></span>
                                                                </a>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        
                                                        <div class="tp-coupons-store-box">
                                                            <a class="tp-coupons-store-box-img" href="<?php echo esc_url( $store_link ); ?>">
                                                                <img src="<?php echo esc_url( $store_image_url ); ?>" alt="<?php echo esc_attr(get_post_meta($att, '_wp_attachment_image_alt', true)); ?>">
                                                            </a>
                                                            <div class="tp-coupons-store-box-content">
                                                                <h4 class="tp-coupons-store-box-title"><a href="<?php echo esc_url( $store_link ); ?>"><?php echo esc_html( $store_name ); ?></a></h4>
                                                                <span><?php echo esc_html( $store_address ); ?></span>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>

                            </div>
                        </div>



						<?php
						if( !empty( $pagination ) ){
							echo '<div class="pagination header-alike">'.$pagination.'</div>';
						}
						?>
					</div>

                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>