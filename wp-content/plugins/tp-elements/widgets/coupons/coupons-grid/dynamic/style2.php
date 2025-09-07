<div class="col-xxl-<?php echo esc_attr( $settings['even_col_xxl'] ); ?> col-xl-<?php echo esc_attr( $settings['even_col_xl'] ); ?> col-lg-<?php echo esc_attr( $settings['even_col_lg'] ); ?> col-md-<?php echo esc_attr( $settings['even_col_md'] ); ?> col-sm-<?php echo esc_attr( $settings['even_col_sm'] ); ?> col-<?php echo esc_attr($settings['even_col_xs'] ); ?> grid-item <?php echo $termsString;?>" >

    <div class="themephi-addon-coupons position-relative <?php echo esc_attr( $settings['image_or_icon_vertical_align'] ); ?> <?php echo esc_attr( $settings['image_or_icon_position'] ); ?> coupons-<?php echo esc_attr( $settings['coupon_style'] ); ?> coupons-<?php echo esc_attr( $settings['coupon_grid_source'] ); ?>">

        <div class="tp-coupon-item" >

            <?php if( !empty( $store_image_url ) && $settings['store_box_position'] == 'top' ){ ?>
            <div class="tp-coupon-item-img d-flex justify-content-between align-items-center">
                
                <div class="tp-coupon-img-inner d-inline-flex align-items-center">
                    <a href="<?php echo esc_url( $store_link ); ?>">
                        <img style="width: 60px; height: 60px; object-fit: cover; margin-right: 15px; border-radius: 5px;" src="<?php echo esc_url( $store_image_url ); ?>" alt="<?php echo esc_attr(get_post_meta($att, '_wp_attachment_image_alt', true)); ?>">
                    </a>
                    <div class="tp-coupon-img-inner-text text-start">
                        <h6 class="tp-coupon-store-name mb-0 "><?php echo esc_html( $store_name ); ?></h6>
                        <span class="tp-coupon-store-address"><i class="tp tp-location-dot-1"></i> <?php echo esc_html( $store_address ); ?></span>
                    </div>
                </div>

                <?php if( $settings['coupon_share_show_hide'] == 'yes' ) : ?>
                <div class="tp-coupon-info-list-item toggle-coupon-share-<?php echo esc_attr( $unique ); ?> toggle-coupon-share" data-target="share-<?php echo esc_attr( get_the_ID() ); ?>" id="share-btn-<?php echo esc_attr( get_the_ID() ); ?>" >
                    <span class="tp-coupon-info-list-item-icon">
                    <i class="fa fa-share-alt" aria-hidden="true"></i>
                    </span>
                    <span class="tp-coupon-info-list-item-text"></span>
                </div>
                <?php endif; ?>

            </div>
            <?php }?>


            <div class="tp-coupon-item-content-wrapper <?php echo esc_attr( $settings['button_position'] ); ?>">

                <div class="tp-coupon-content-wrapp">
                    <?php if( $settings['coupon_title_show_hide'] == 'yes' ) : ?>
                    <<?php echo esc_attr( $settings['title_tag'] ); ?> class="tp-coupon-title"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), $title_limit, '...' ); ?></a></<?php echo esc_attr( $settings['title_tag'] ); ?>>
                    <?php endif; ?>

                    <div class="tp-coupon-meta d-flex flex-wrap">
                        <?php if( ! empty( $expire_timestamp )  && $settings['coupon_expired_show_hide'] == 'yes' ) : ?>
                        <span class="tp-coupon-meta-single tp-coupon-date-single">
                            <span class="tp-coupon-meta-single-icon"><i class="tp tp-calendar-days"></i></span>
                            <div class="tp-coupon-meta-single-text"><?php echo date( 'd M, Y', $expire_timestamp ); ?></div>
                        </span>
                        <?php endif; ?>

                        <?php if( ! empty( $current_used )  && $settings['coupon_usage_show_hide'] == 'yes' ) : ?>
                        <span class="tp-coupon-meta-single">
                            <span class="tp-coupon-meta-single-icon"><i class="fas fa-solid fa-lock"></i></span>
                            <div class="tp-coupon-meta-single-text"><?php echo esc_html( $current_used ); ?></div>
                        </span>
                        <?php endif; ?>

                        <?php if( $settings['coupon_comments_show_hide'] == 'yes' ) : ?>
                        <a href="<?php echo get_comments_link(); ?>" class="tp-coupon-meta-single">
                            <span class="tp-coupon-meta-single-icon"><i class="tp tp-comments"></i></span>
                            <div class="tp-coupon-meta-single-text"><?php echo get_comments_number() ?></div>
                        </a>
                        <?php endif; ?>

                    </div>

                    <?php if( $settings['coupon_text_show_hide'] == 'yes' ) : ?>
                    <div class="tp-coupon-desc">
                    <?php echo wp_kses_post( wp_trim_words( get_the_content(), $text_limit, '...' ) ); ?>
                    </div>
                    <?php endif; ?>

                    <?php if( $settings['coupon_rich_text_show_hide'] == 'yes' ) : ?>
                    <div class="tp-coupon-store-voucher">
                        <?php echo wp_kses_post( $store_rich_description ); ?>
                    </div>
                    <?php endif; ?>

                </div>


                <div class="tp-coupon-button-wrapp <?php echo esc_attr( $settings['button_vertical_align'] ); ?>">

                    <?php if( $settings['coupon_btn_show_hide'] == 'yes' ) : ?>
                    <div class="tp-coupon-button">

                        <?php
                        $link_open = $settings['coupon_btn_link_open'] == 'yes' ? 'target=_blank' : ''; 
                        $icon_position = $settings['coupon_btn_icon_position'] == 'before' ? 'icon-before' : 'icon-after';
                        ?>

                        <a class="coupon-action-button <?php echo esc_attr( $icon_position ); ?>" href="<?php echo esc_url( $store_link ); ?>" >
                            <?php if( $settings['coupon_btn_icon_position'] == 'before' ) : ?>
                                <?php if($settings['coupon_btn_icon']): ?>
                                <?php \Elementor\Icons_Manager::render_icon( $settings['coupon_btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if( $settings['coupon_btn_text'] ) : ?>
                            <span class="code-text-full"><?php echo esc_html( $settings['coupon_btn_text'] ); ?></span>
                            <?php endif; ?>
                            <?php if( $settings['coupon_btn_icon_position'] == 'after' ) : ?>
                                <?php if($settings['coupon_btn_icon']): ?>
                                <?php \Elementor\Icons_Manager::render_icon( $settings['coupon_btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </a>

                    </div>
                    <?php endif; ?>

                </div>


            </div>

            <?php if( !empty( $store_image_url ) && $settings['store_box_position'] == 'bottom' ){ ?>
            <div class="tp-coupon-item-img d-flex justify-content-between align-items-center">
                
                <div class="tp-coupon-img-inner d-inline-flex align-items-center">
                    <img style="width: 60px; height: 60px; object-fit: cover; margin-right: 15px; border-radius: 5px;" src="<?php echo esc_url( $store_image_url ); ?>" alt="<?php echo esc_attr(get_post_meta($att, '_wp_attachment_image_alt', true)); ?>">
                    <div class="tp-coupon-img-inner-text text-start">
                        <h6 class="tp-coupon-store-name mb-0 "><?php echo esc_html( $store_name ); ?></h6>
                        <span class="tp-coupon-store-address"><i class="tp tp-location-dot-1"></i> <?php echo esc_html( $store_address ); ?></span>
                    </div>
                </div>

                <?php if( $settings['coupon_share_show_hide'] == 'yes' ) : ?>
                <div class="tp-coupon-info-list-item toggle-coupon-share-<?php echo esc_attr( $unique ); ?> toggle-coupon-share" data-target="share-<?php echo esc_attr( get_the_ID() ); ?>" id="share-btn-<?php echo esc_attr( get_the_ID() ); ?>" >
                    <span class="tp-coupon-info-list-item-icon">
                    <i class="fa fa-share-alt" aria-hidden="true"></i>
                    </span>
                    <span class="tp-coupon-info-list-item-text"></span>
                </div>
                <?php endif; ?>

            </div>
            <?php }?>


        </div>

        <!-- share start -->
        <div class="share-coupon share-<?php echo esc_attr( get_the_ID() ); ?> ">
            <div class="tp-post-share-absolute">
            <?php    
            if( !empty( $coupon_id ) ){
                $share_post_id = $coupon_id;
            } else {
                $share_post_id = get_the_ID();
            }
            ?>
            <div class="post-share">
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( rawurlencode( get_permalink( $share_post_id ) ) ); ?>" class="share facebook" target="_blank" title="<?php esc_attr_e( 'Share on Facebook', 'tp-elements' ); ?>"><i class="fa fa-facebook fa-fw"></i></a>
                <a href="https://twitter.com/intent/tweet?source=<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>&amp;text=<?php echo esc_url( rawurlencode( get_permalink( $share_post_id ) ) ); ?>" class="share twitter" target="_blank" title="<?php esc_attr_e( 'Share on Twitter', 'tp-elements' ); ?>"><i class="fa fa-twitter fa-fw"></i></a>
                <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url( rawurlencode( get_permalink( $share_post_id ) ) ); ?>&amp;title=<?php echo esc_url( rawurlencode( get_the_title( $share_post_id ) ) ); ?>&amp;source=<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="share linkedin" target="_blank" title="<?php esc_attr_e( 'Share on LinkedIn', 'tp-elements' ); ?>"><i class="fa fa-linkedin fa-fw"></i></a>
                <a href="https://www.tumblr.com/share/link?url=<?php echo esc_url( rawurlencode( get_permalink( $share_post_id ) ) ); ?>&amp;name=<?php echo esc_url( rawurlencode( get_the_title( $share_post_id ) ) ); ?>" class="share tumblr" target="_blank" title="<?php esc_attr_e( 'Share on Tumblr', 'tp-elements' ); ?>"><i class="fa fa-tumblr fa-fw"></i></a>
                <a href="https://t.me/share/url?url=<?php echo esc_url( rawurlencode( get_permalink( $share_post_id ) ) ); ?>&amp;text=<?php echo esc_url( rawurlencode( get_the_title( $share_post_id ) ) ); ?>" class="share telegram" target="_blank" title="<?php esc_attr_e( 'Share on Telegram', 'tp-elements' ); ?>"><i class="fa fa-telegram fa-fw"></i></a>
                <a href="https://api.whatsapp.com/send?text=<?php echo esc_url( rawurlencode( get_permalink( $share_post_id ) ) ); ?>" class="share whatsapp" target="_blank" title="<?php esc_attr_e( 'Share on WhatsApp', 'tp-elements' ); ?>"><i class="fa fa-whatsapp fa-fw"></i></a>
            </div>

            <a href="javascript:;" class="toggle-coupon-share-<?php echo esc_attr( $unique ); ?> toggle-coupon-share" data-target="share-<?php echo esc_attr( get_the_ID() ) ?>"><span class="icon-close">x</span></a>
            </div>
        </div>
        <!-- share end -->

    </div>
    
</div>