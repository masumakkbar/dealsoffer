<div class="col-xxl-<?php echo esc_attr( $settings['even_col_xxl'] ); ?> col-xl-<?php echo esc_attr( $settings['even_col_xl'] ); ?> col-lg-<?php echo esc_attr( $settings['even_col_lg'] ); ?> col-md-<?php echo esc_attr( $settings['even_col_md'] ); ?> col-sm-<?php echo esc_attr( $settings['even_col_sm'] ); ?> col-<?php echo esc_attr($settings['even_col_xs'] ); ?> grid-item <?php echo $termsString;?>" >

    <div class="themephi-addon-coupons position-relative <?php echo esc_attr( $settings['image_or_icon_vertical_align'] ); ?> <?php echo esc_attr( $settings['image_or_icon_position'] ); ?> coupons-<?php echo esc_attr( $settings['coupon_style'] ); ?> coupons-<?php echo esc_attr( $settings['coupon_grid_source'] ); ?>">

        <div class="tp-coupon-item" >

            <?php if( !empty( $image_src ) && $settings['image_show_hide'] == 'yes' ){ ?>
            <div class="tp-coupon-item-img">
                <a href="<?php echo get_the_permalink(); ?>">
                    <?php the_post_thumbnail($settings['thumbnail_size']); ?>
                </a>

                <div class="tp-coupon-meta-with-image">
                    <div class="tp-coupon-meta d-flex">
                        <?php if( $settings['coupon_share_show_hide'] == 'yes' ) : ?>
                        <span class="tp-coupon-meta-single toggle-coupon-share-<?php echo esc_attr( $unique ); ?> toggle-coupon-share" data-target="share-<?php echo esc_attr( get_the_ID() ); ?>" id="share-btn-<?php echo esc_attr( get_the_ID() ); ?>" >
                            <?php \Elementor\Icons_Manager::render_icon( $settings['share_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </span>
                        <?php endif; ?>
                        <?php if( $settings['coupon_favourite_show_hide'] == 'yes' ) : ?>
                        <span class="tp-coupon-meta-single favorite-bookmark" data-coupon-id="<?php echo esc_attr( get_the_ID() ); ?>">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['favourite_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
            <?php }?>

            <div class="tp-coupon-item-content-wrapper <?php echo esc_attr( $settings['button_position'] ); ?>">

                <div class="tp-coupon-content-wrapp">

                    <?php if( $settings['meta_position'] == 'before_title' ) : ?>
                    <div class="tp-coupon-info-list d-flex justify-content-between flex-wrap">

                        <?php if( ! empty( $expire_timestamp )  && $settings['coupon_expired_show_hide'] == 'yes' ) : ?>
                        <div class="tp-coupon-info-list-item tp-coupon-list-date">
                            <?php if( $settings['coupon_expired_type'] == 'date_text' && !empty($settings['date_text']) ) : ?>
                            <span class="tp-coupon-info-list-item-icon">
                            <?php echo esc_html( $settings['expire_text'] ); ?>
                            </span>
                            <?php else : ?>
                            <span class="tp-coupon-info-list-item-icon">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['expire_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </span>
                            <?php endif; ?>
                            <span class="tp-coupon-info-list-item-text"><?php echo date( 'd M, Y', $expire_timestamp ); ?></span>
                        </div>
                        <?php endif; ?>

                        <?php if( ! empty( $current_used )  && $settings['coupon_usage_show_hide'] == 'yes' ) : ?>
                        <div class="tp-coupon-info-list-item">
                            <span class="tp-coupon-info-list-item-icon">
                                <?php \Elementor\Icons_Manager::render_icon( $settings['usage_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </span>
                            <span class="tp-coupon-info-list-item-text"><?php echo esc_html( $current_used ); ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <?php if( $settings['coupon_feedback_show_hide'] == 'yes' ) : ?>
                        <div class="tp-coupon-info-list-item">
                            <span class="tp-coupon-info-list-item-icon">
                                <?php \Elementor\Icons_Manager::render_icon( $settings['feedback_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </span>
                            <span class="tp-coupon-info-list-item-text"><?php echo esc_html( $positive_feedback ); ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <?php if( $settings['coupon_comments_show_hide'] == 'yes' ) : ?>
                        <a href="<?php echo get_comments_link(); ?>" class="tp-coupon-info-list-item">
                            <span class="tp-coupon-info-list-item-icon">
                                <?php \Elementor\Icons_Manager::render_icon( $settings['comments_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </span>
                            <span class="tp-coupon-info-list-item-text"><?php echo get_comments_number(); ?></span>
                        </a>
                        <?php endif; ?>

                    </div>
                    <?php endif; ?>

                    <?php if( $settings['coupon_title_show_hide'] == 'yes' ) : ?>
                    <<?php echo esc_attr( $settings['title_tag'] ); ?> class="tp-coupon-title"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), $title_limit, '...' ); ?></a></<?php echo esc_attr( $settings['title_tag'] ); ?>>
                    <?php endif; ?>

                    <?php if( $settings['meta_position'] == 'after_title' ) : ?>
                    <div class="tp-coupon-info-list d-flex justify-content-between flex-wrap">

                        <?php if( ! empty( $expire_timestamp )  && $settings['coupon_expired_show_hide'] == 'yes' ) : ?>
                        <div class="tp-coupon-info-list-item">
                            <?php if( $settings['coupon_expired_type'] == 'date_text' && !empty($settings['date_text']) ) : ?>
                            <span class="tp-coupon-info-list-item-icon">
                            <?php echo esc_html( $settings['expire_text'] ); ?>
                            </span>
                            <?php else : ?>
                            <span class="tp-coupon-info-list-item-icon">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['expire_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </span>
                            <?php endif; ?>
                            <span class="tp-coupon-info-list-item-text"><?php echo date( 'd M, Y', $expire_timestamp ); ?></span>
                        </div>
                        <?php endif; ?>

                        <?php if( ! empty( $current_used )  && $settings['coupon_usage_show_hide'] == 'yes' ) : ?>
                        <div class="tp-coupon-info-list-item">
                            <span class="tp-coupon-info-list-item-icon">
                                <?php \Elementor\Icons_Manager::render_icon( $settings['usage_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </span>
                            <span class="tp-coupon-info-list-item-text"><?php echo esc_html( $current_used ); ?></span>
                        </div>
                        <?php endif; ?>

                        <?php if( $settings['coupon_feedback_show_hide'] == 'yes' ) : ?>
                        <div class="tp-coupon-info-list-item">
                            <span class="tp-coupon-info-list-item-icon">
                                <?php \Elementor\Icons_Manager::render_icon( $settings['feedback_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </span>
                            <span class="tp-coupon-info-list-item-text"><?php echo esc_html( $positive_feedback ); ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <?php if( $settings['coupon_comments_show_hide'] == 'yes' ) : ?>
                        <a href="<?php echo get_comments_link(); ?>" class="tp-coupon-info-list-item">
                            <span class="tp-coupon-info-list-item-icon">
                                <?php \Elementor\Icons_Manager::render_icon( $settings['comments_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </span>
                            <span class="tp-coupon-info-list-item-text"><?php echo get_comments_number(); ?></span>
                        </a>
                        <?php endif; ?>

                    </div>
                    <?php endif; ?>

                    <?php if( $settings['coupon_text_show_hide'] == 'yes' ) : ?>
                    <div class="tp-coupon-desc">
                    <?php echo wp_kses_post( wp_trim_words( get_the_content(), $text_limit, '...' ) ); ?>
                    </div>
                    <?php endif; ?>

                </div>

                <div class="tp-coupon-button-wrapp <?php echo esc_attr( $settings['button_vertical_align'] ); ?>">

                    <?php if( $settings['coupon_btn_show_hide'] == 'yes' ) : ?>
                    <div class="tp-coupon-button">
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
                        $link_open = $settings['coupon_btn_link_open'] == 'yes' ? 'target=_blank' : '';
                        $icon_position = $settings['coupon_btn_icon_position'] == 'before' ? 'icon-before' : 'icon-after';
                        ?>
                        <a class="coupon-action-button header-alike <?php echo esc_attr( $icon_position ); ?>" href="<?php echo esc_attr($href); ?>" 
                        <?php if (!empty($data_href)) : ?> data-affiliate="<?php echo esc_url($data_href); ?>" target="_blank" <?php else : ?> target="" <?php endif; ?> rel="nofollow" >
                            <span class="code-text"><?php echo esc_html__('GET CODE', 'tp-elements'); ?></span>
                            <span class="partial-code">&nbsp;<?php echo substr($coupon_code, -7, 7); ?></span>
                        </a>
                    <?php
                    } elseif ($effective_coupon_type == 2) {
                        $link_open = $settings['coupon_btn_link_open'] == 'yes' ? 'target=_blank' : '';
                        $icon_position = $settings['coupon_btn_icon_position'] == 'before' ? 'icon-before' : 'icon-after';
                        ?>
                        <a class="coupon-action-button header-alike <?php echo esc_attr( $icon_position ); ?>" href="<?php echo esc_attr($href); ?>" 
                        <?php if (!empty($data_href)) : ?> data-affiliate="<?php echo esc_url($data_href); ?>" target="_blank" <?php else : ?> target="" <?php endif; ?> rel="nofollow"  >
                            <?php if( $settings['coupon_btn_icon_position'] == 'before' ) : ?>
                                <?php if($settings['coupon_btn_icon']): ?>
                                <?php \Elementor\Icons_Manager::render_icon( $settings['coupon_btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                <?php endif; ?>
                            <?php endif; ?>
                            <span class="code-text-full"><?php echo esc_html( 'Print Code', 'tp-elements' ); ?></span>
                            <?php if( $settings['coupon_btn_icon_position'] == 'after' ) : ?>
                                <?php if($settings['coupon_btn_icon']): ?>
                                <?php \Elementor\Icons_Manager::render_icon( $settings['coupon_btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </a>
                    <?php
                    } elseif ($effective_coupon_type == 3) {
                        $link_open = $settings['coupon_btn_link_open'] == 'yes' ? 'target=_blank' : ''; 
                        $icon_position = $settings['coupon_btn_icon_position'] == 'before' ? 'icon-before' : 'icon-after';
                        ?>
                        <a class="coupon-action-button header-alike <?php echo esc_attr( $icon_position ); ?>" href="<?php echo esc_attr($href); ?>" 
                        <?php if (!empty($data_href)) : ?> data-affiliate="<?php echo esc_url($data_href); ?>" target="_blank" <?php else : ?> target="" <?php endif; ?> rel="nofollow"  >
                            <?php if( $settings['coupon_btn_icon_position'] == 'before' ) : ?>
                                <?php if($settings['coupon_btn_icon']): ?>
                                <?php \Elementor\Icons_Manager::render_icon( $settings['coupon_btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                <?php endif; ?>
                            <?php endif; ?>
                            <span class="code-text-full"><?php echo esc_html( 'Get Deal', 'tp-elements' ); ?></span>
                            <?php if( $settings['coupon_btn_icon_position'] == 'after' ) : ?>
                                <?php if($settings['coupon_btn_icon']): ?>
                                <?php \Elementor\Icons_Manager::render_icon( $settings['coupon_btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </a>
                    <?php
                    }
                    ?>

                    </div>
                    <?php endif; ?>

                </div>

            </div>

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