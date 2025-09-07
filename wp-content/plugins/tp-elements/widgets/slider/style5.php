<div class="swiper-slide tp-slide-item"> 
    <?php if(!empty($sub_img_link)): ?>
    <div class="quote-area">
        <img src="<?php echo $sub_img_link;?>" alt="quote">
    </div>
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

    <div class="slider-content-area tp-el-content">
    <?php if(!empty($description)):?>
                <div class="slider-description"><?php echo wp_kses_post($description); ?></div>
            <?php endif;?>

        <div class="bottom--area">
            <?php $img_gap = !empty($img_gap ) ? 'style="margin-right:'. $img_gap .'"' : '';?>
            <div class="image-area">
                <img src="<?php echo esc_url($image); ?>" class="max-un rounded-circle" alt="image">
            </div>
            <div class="content--box">
                <?php if(!empty($title)):?>
                    <h5 class="slider-title"><?php echo wp_kses_post($title); ?></h5>
                <?php endif;?>
                <?php if(!empty($sub_title)):?>
                    <p class="slider-subtitle"><?php echo wp_kses_post($sub_title); ?></p>
                <?php endif;?>

            </div>
                       
        </div>
    </div>
</div> 
