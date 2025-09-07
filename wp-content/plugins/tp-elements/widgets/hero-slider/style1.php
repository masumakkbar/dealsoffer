<div class="swiper-slide tp-slide-item">
    <div  class="tp-hero-slider-item single--item d-flex flex-column flex-md-row align-items-center">

        <div class="tp-hero-slider-text order-2 order-md-0">
            <?php if(!empty($sub_title)):?>
            <div class="tp-sub-title"></div>
            <span class="tp-hero-slider-subtitle"><img src="<?php echo esc_url( $sub_image ); ?>"><?php echo wp_kses_post($sub_title); ?></span>
            <?php endif;?>
            <?php if(!empty($hero_title)):?>
            <h2 class="tp-hero-slider-title"><?php echo wp_kses_post($hero_title); ?></h2>
            <?php endif;?>
            <?php if(!empty($description)):?>
            <p class="tp-hero-slider-description"><?php echo wp_kses_post($description); ?></p>
            <?php endif;?>

            <div class="themephi-button ">
                <a class="themephi_button " href="<?php echo esc_url( $btn_link );?>" <?php echo esc_attr($target);?>>				
                    <span class="btn_text"><?php echo esc_html( $btn_text ); ?></span>
                    <?php if( !empty($item['btn_icon']) ) : ?>
                        <span><?php \Elementor\Icons_Manager::render_icon( $item['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>				
                    <?php endif; ?>
                </a>
            </div> 

        </div>
        <div class="tp-hero-slider-image ">
            <img class="banner-img" src="<?php echo esc_url($image); ?>">
        </div>

    </div>
</div> 