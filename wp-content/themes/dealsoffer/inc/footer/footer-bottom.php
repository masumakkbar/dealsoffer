<?php
    global $dealsoffer_option;    

    $header_width_meta = get_post_meta(get_the_ID(), 'header_width_custom', true);
    if ($header_width_meta != ''){
        $header_width = ( $header_width_meta == 'full' ) ? 'container-fluid': 'container';
    }else{
        $header_width = !empty($dealsoffer_option['header-grid']) ? $dealsoffer_option['header-grid'] : '';
        $header_width = ( $header_width == 'full' ) ? 'container-fluid': 'container';
    }
    
?>
<div class="footer-bottom" <?php if(!empty( $copyright_bg)): ?> style="background: <?php echo esc_attr($copyright_bg); ?> !important;" <?php elseif(!empty( $copy_trans)): ?> style="background: <?php echo esc_attr($copy_trans); ?> !important;" <?php endif; ?>>
    <div class="<?php echo esc_attr($header_width);?>">
        <div class="copyright_border">
            
            <div class="copyright text-center" <?php if(!empty( $copy_space)): ?> style="padding: <?php echo esc_attr($copy_space); ?>" <?php endif; ?> >
                <?php if(!empty($dealsoffer_option['copyright'])){?>
                <p><?php echo wp_kses($dealsoffer_option['copyright'], 'dealsoffer'); ?></p>
                <?php }
                 else{
                    ?>
                <p><?php echo esc_html('Copyright &copy;')?> <?php echo date("Y");?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>. <?php echo esc_html('Designed By _Themephi')?>
                </p>
                <?php
                 }   
                ?>
            </div>
        </div>
    </div>
</div>


