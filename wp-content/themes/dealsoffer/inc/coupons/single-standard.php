<?php

    global $dealsoffer_option;
    $post_id      = get_the_ID();

    $excerpt = get_the_excerpt();
    $cats_show = get_the_term_list( $post_id, 'coupon-category', ' ', '<span class="separator">,</span> ');
    $store_show = get_the_term_list( $post_id, 'coupon-store', ' ', '<span class="separator">,</span> ');
    $post_date = get_the_date('F j, Y', $post_id);
    $author_name = get_the_author_meta('display_name'); 

    $gallery_images = get_post_meta(get_the_ID(), 'tp_gallery_images', true);

    //checking page layout 
    $page_layout = get_post_meta( $post->ID, 'layout', true );
    $col_side = '';
    $col_letf = '';

    if($page_layout == '2left' && is_active_sidebar( 'sidebar-coupon' )){
        $col_side = '8';
        $col_letf = 'left-sidebar';}
    else if($page_layout == '2right' && is_active_sidebar( 'sidebar-coupon' )){
        $col_side = '8';
        $col_letf = 'right-sidebar';
    }
    else{
        $col_side = '12';
        $col_letf = 'full-width';
    }

    $container_class = 'container';

    ?>

    <div class="<?php echo esc_attr($container_class); ?>">
        <div class="themephi-coupon-details">
            <div class="row padding-<?php echo esc_attr( $col_letf) ?>">
                <div class="col-lg-<?php echo esc_attr( $col_side); ?> <?php echo esc_attr( $col_letf); ?> ">
                    <div class="themephi-coupon-details-inner-left ">
                        <?php while ( have_posts() ) : the_post();  ?>  

                        <div class="tp-coupon-inner-content ">

                            <div class="tp-coupon-inner-content-text-wrapp mb-40">

                                <?php if (!empty($gallery_images) && is_array($gallery_images)) : $count_img = count( $gallery_images ); ?>
                                <div class="tp-coupon-inner-content-gallery-wrapper tp-coupon-inner-content-gallery-wrapper-<?php echo esc_attr( $count_img ); ?>">
                                    <?php foreach ($gallery_images as $image_id => $image_url) : ?>
                                    <div class="tp-coupon-inner-content-gallery-item">
                                        <img src="<?php echo esc_url($image_url); ?>" alt="portfolio-image">
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <?php else : ?>

                                <div class="tp-coupon-details-img">
                                <?php if ( has_post_thumbnail() ) {
                                    the_post_thumbnail();
                                } ?>
                                </div>
                                    
                                <?php endif; ?>
                                <div class="tp-coupon-inner-content-text">
                                    <h2 class="tp-coupon-inner-content-text-title"><?php echo the_title(); ?></h2>
                                    <?php the_content(); ?>
                                </div>
                            </div>

                            <?php 
                            if( $dealsoffer_option['enable_comments'] == 'yes' ){
                                comments_template( '', true );
                            }
                            ?>
                        </div>

                        <?php endwhile; wp_reset_query();?>
                        
                        <?php 
                        $next_post = get_next_post();
                        $previous_post = get_previous_post();
                        if( !empty($next_post) || !empty($previous_post)):?>
                        <div class="service-navigation">
                            <?php			 
                            $url_next = is_object( $next_post ) ? get_permalink( $next_post->ID ) : ''; 
                            $title    = is_object( $next_post ) ? get_the_title( $next_post->ID ) : ''; 
                            ?>
                            <div class="row align-items-center justify-content-between tps-left-write-blog-wrapper-main">
                                <div class="col-lg-6 col-sm-6">
                                    <?php if($next_post):?>	
                                    <div class="left-icon-area single">
                                        <div class="icon-1">
                                            <a href="<?php echo esc_url( $url_next ) ?>">
                                                <i class="tp-arrow-left"></i>
                                            </a>
                                        </div>
                                        <div class="writing-content">
                                            <a href="<?php echo esc_url( $url_next ) ?>"><span><?php echo esc_html__('Previous', 'dealsoffer'); ?></span>
                                                <h6 class="title"><?php echo esc_html( $title ); ?></h6>
                                            </a>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>

                                <div class="col-lg-6 col-sm-6">
                                    <?php $url_previous = is_object( $previous_post ) ? get_permalink( $previous_post->ID ) : '';
                                    $title = is_object( $previous_post ) ? get_the_title( $previous_post->ID ) : ''; ?>
                                    <?php if($previous_post):?>	
                                    <div class="right-icon-area single justify-content-end">
                                        <div class="writing-content">
                                            <a href="<?php echo esc_url( $url_previous ) ?>"><span><?php echo esc_html__('Next', 'dealsoffer'); ?></span>
                                                <h6 class="title">
                                                <?php echo esc_html( $title ); ?>
                                                </h6>
                                            </a>
                                        </div>
                                        <div class="icon-1">
                                            <a href="<?php echo esc_url( $url_previous ) ?>"> <i class="tp-arrow-right"></i></a>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>

                <?php 
                if( ( $page_layout=='2left' || $page_layout=='2right' ) && is_active_sidebar( 'sidebar-coupon' ) ){	
                ?>
                <div class="col-xxl-4 col-xl-4 col-lg-4">
                    <aside id="secondary" class="widget-area sticky-sidebar">
                        <div class="themephi-sideabr dynamic-sidebar">
                        <?php
                            dynamic_sidebar('sidebar-coupon');
                        ?>
                        </div>
                    </aside>
                </div>
                <?php
                } ?>

            </div>
        </div>
    </div>
    