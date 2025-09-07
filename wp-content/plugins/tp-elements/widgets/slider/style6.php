<div class="swiper-slide tp-slide-item ">
    <div class="single-item position-relative  tp-el-content">
        <div class="img-area mb-30">
            <img src="<?php echo esc_url($image); ?>" class="max-un rounded-circle" alt="image">
            <?php if(!empty($sub_img_link)): ?>
            <div class="quote-area position-absolute end-0">
                <img src="<?php echo $sub_img_link;?>" class="max-un quote" alt="quote">
            </div>
            <?php endif; ?>
        </div>
        <?php if( !empty( $description ) ) : ?>
        <p class="text-body fs-five fw-mid tp-el-desc mb-20"><?php echo wp_kses_post($description); ?></p>
        <?php endif; ?>
        <?php if( $settings['show_rating'] == 'yes' ) : ?>
        <ul class="single d-center justify-content-start gap-2 tp-el-star">
            <?php if( $tp_rating == '1' ) : ?>
            <li><i class="tp tp-star p1-color fs-eight"></i></li>
            <li><i class="tp tp-star-regular p1-color fs-eight"></i></li>
            <li><i class="tp tp-star-regular p1-color fs-eight"></i></li>
            <li><i class="tp tp-star-regular p1-color fs-eight"></i></li>
            <li><i class="tp tp-star-regular p1-color fs-eight"></i></li>
            <?php endif; ?>
            <?php if( $tp_rating == '1.5' ) : ?>
            <li><i class="tp tp-star  p1-color fs-eight"></i></li>
            <li><i class="tp tp-star-half p1-color fs-eight"></i></li>
            <li><i class="tp tp-star-regular p1-color fs-eight"></i></li>
            <li><i class="tp tp-star-regular p1-color fs-eight"></i></li>
            <li><i class="tp tp-star-regular p1-color fs-eight"></i></li>
            <?php endif; ?>
            <?php if( $tp_rating == '2' ) : ?>
            <li><i class="tp tp-star  p1-color fs-eight"></i></li>
            <li><i class="tp tp-star  p1-color fs-eight"></i></li>
            <li><i class="tp tp-star-regular p1-color fs-eight"></i></li>
            <li><i class="tp tp-star-regular p1-color fs-eight"></i></li>
            <li><i class="tp tp-star-regular p1-color fs-eight"></i></li>
            <?php endif; ?>
            <?php if( $tp_rating == '2.5' ) : ?>
            <li><i class="tp tp-star  p1-color fs-eight"></i></li>
            <li><i class="tp tp-star  p1-color fs-eight"></i></li>
            <li><i class="tp tp-star-half p1-color fs-eight"></i></li>
            <li><i class="tp tp-star-regular p1-color fs-eight"></i></li>
            <li><i class="tp tp-star-regular p1-color fs-eight"></i></li>
            <?php endif; ?>
            <?php if( $tp_rating == '3' ) : ?>
            <li><i class="tp tp-star  p1-color fs-eight"></i></li>
            <li><i class="tp tp-star  p1-color fs-eight"></i></li>
            <li><i class="tp tp-star  p1-color fs-eight"></i></li>
            <li><i class="tp tp-star-regular p1-color fs-eight"></i></li>
            <li><i class="tp tp-star-regular p1-color fs-eight"></i></li>
            <?php endif; ?>
            <?php if( $tp_rating == '3.5' ) : ?>
            <li><i class="tp tp-star  p1-color fs-eight"></i></li>
            <li><i class="tp tp-star  p1-color fs-eight"></i></li>
            <li><i class="tp tp-star  p1-color fs-eight"></i></li>
            <li><i class="tp tp-star-half p1-color fs-eight"></i></li>
            <li><i class="tp tp-star-regular p1-color fs-eight"></i></li>
            <?php endif; ?>
            <?php if( $tp_rating == '4' ) : ?>
            <li><i class="tp tp-star  p1-color fs-eight"></i></li>
            <li><i class="tp tp-star  p1-color fs-eight"></i></li>
            <li><i class="tp tp-star  p1-color fs-eight"></i></li>
            <li><i class="tp tp-star  p1-color fs-eight"></i></li>
            <li><i class="tp tp-star-regular p1-color fs-eight"></i></li>
            <?php endif; ?>
            <?php if( $tp_rating == '4.5' ) : ?>
            <li><i class="tp tp-star  p1-color fs-eight"></i></li>
            <li><i class="tp tp-star  p1-color fs-eight"></i></li>
            <li><i class="tp tp-star  p1-color fs-eight"></i></li>
            <li><i class="tp tp-star  p1-color fs-eight"></i></li>
            <li><i class="tp tp-star-half p1-color fs-eight"></i></li>
            <?php endif; ?>
            <?php if( $tp_rating == '5' ) : ?>
            <li><i class="tp tp-star  p1-color fs-eight"></i></li>
            <li><i class="tp tp-star  p1-color fs-eight"></i></li>
            <li><i class="tp tp-star  p1-color fs-eight"></i></li>
            <li><i class="tp tp-star  p1-color fs-eight"></i></li>
            <li><i class="tp tp-star  p1-color fs-eight"></i></li>
            <?php endif; ?>

        </ul>
        <?php endif; ?>

        <div class="info-area ">
            <div class="text-area alt-color">
                <?php if(!empty($title)):?>
                    <h6 class="mb-1 slider-title tp-el-title"><?php echo wp_kses_post($title); ?></h6>
                <?php endif;?>
                <?php if(!empty($sub_title)):?>
                    <p class="slider-subtitle tp-el-subtitle mb-0"><?php echo wp_kses_post($sub_title); ?></p>
                <?php endif;?>
            </div>
        </div>
    </div>

</div> 
