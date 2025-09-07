<div class="swiper-slide tp-slide-item">
    <div  class="single--item">

        <?php if( $settings['show_rating'] == 'yes' ) : ?>
        <ul class="rating-portion d-center justify-content-start gap-2 tp-el-star">
            <?php if( $tp_rating == '1' ) : ?>
            <li><i class="tp tp-star"></i></li>
            <li><i class="tp tp-star-regular"></i></li>
            <li><i class="tp tp-star-regular"></i></li>
            <li><i class="tp tp-star-regular"></i></li>
            <li><i class="tp tp-star-regular"></i></li>
            <?php endif; ?>
            <?php if( $tp_rating == '1.5' ) : ?>
            <li><i class="tp tp-star "></i></li>
            <li><i class="tp tp-star-half"></i></li>
            <li><i class="tp tp-star-regular"></i></li>
            <li><i class="tp tp-star-regular"></i></li>
            <li><i class="tp tp-star-regular"></i></li>
            <?php endif; ?>
            <?php if( $tp_rating == '2' ) : ?>
            <li><i class="tp tp-star "></i></li>
            <li><i class="tp tp-star "></i></li>
            <li><i class="tp tp-star-regular"></i></li>
            <li><i class="tp tp-star-regular"></i></li>
            <li><i class="tp tp-star-regular"></i></li>
            <?php endif; ?>
            <?php if( $tp_rating == '2.5' ) : ?>
            <li><i class="tp tp-star "></i></li>
            <li><i class="tp tp-star "></i></li>
            <li><i class="tp tp-star-half"></i></li>
            <li><i class="tp tp-star-regular"></i></li>
            <li><i class="tp tp-star-regular"></i></li>
            <?php endif; ?>
            <?php if( $tp_rating == '3' ) : ?>
            <li><i class="tp tp-star "></i></li>
            <li><i class="tp tp-star "></i></li>
            <li><i class="tp tp-star "></i></li>
            <li><i class="tp tp-star-regular"></i></li>
            <li><i class="tp tp-star-regular"></i></li>
            <?php endif; ?>
            <?php if( $tp_rating == '3.5' ) : ?>
            <li><i class="tp tp-star "></i></li>
            <li><i class="tp tp-star "></i></li>
            <li><i class="tp tp-star "></i></li>
            <li><i class="tp tp-star-half"></i></li>
            <li><i class="tp tp-star-regular"></i></li>
            <?php endif; ?>
            <?php if( $tp_rating == '4' ) : ?>
            <li><i class="tp tp-star "></i></li>
            <li><i class="tp tp-star "></i></li>
            <li><i class="tp tp-star "></i></li>
            <li><i class="tp tp-star "></i></li>
            <li><i class="tp tp-star-regular"></i></li>
            <?php endif; ?>
            <?php if( $tp_rating == '4.5' ) : ?>
            <li><i class="tp tp-star "></i></li>
            <li><i class="tp tp-star "></i></li>
            <li><i class="tp tp-star "></i></li>
            <li><i class="tp tp-star "></i></li>
            <li><i class="tp tp-star-half"></i></li>
            <?php endif; ?>
            <?php if( $tp_rating == '5' ) : ?>
            <li><i class="tp tp-star "></i></li>
            <li><i class="tp tp-star "></i></li>
            <li><i class="tp tp-star "></i></li>
            <li><i class="tp tp-star "></i></li>
            <li><i class="tp tp-star "></i></li>
            <?php endif; ?>

        </ul>
        <?php endif; ?>
        <div class="review-body">
            <div class="desc">
                <?php echo wp_kses_post($description); ?>
            </div> 
        </div>

        <div class="content--box">
            <div class="banner-image">
                <img class="banner-img" src="<?php echo esc_url($image); ?>" alt="image">
            </div>
            <div class="description">
                <?php if(!empty($title)):?>
                    <h2 class="slider-title"><?php echo wp_kses_post($title); ?></h2>
                <?php endif;?>
                <?php if(!empty($sub_title)):?>
                    <p class="slider-subtitle"><?php echo wp_kses_post($sub_title); ?></p>
                <?php endif;?>
            </div> 
            <?php if(!empty($sub_img_link)):?>
                <img class="quote" src="<?php echo esc_attr($sub_img_link); ?>" alt="Icon">
            <?php endif;?>           
        </div>

    </div>
</div> 