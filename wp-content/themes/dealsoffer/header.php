<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="//gmpg.org/xfn/11">
<?php global $dealsoffer_option; ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php 
if( function_exists('couponis_activate_account') ){
	couponis_activate_account();	
}
?>
  
   <div class="close-button body-close"></div>   
    <!--Preloader start here-->
    <?php get_template_part( 'inc/header/preloader' ); ?>
    <!--Preloader area end here-->

    <div class="tp-coupon-modal modal fade in" id="showCode" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content coupon_modal_content">

            </div>
        </div>
    </div>

    <?php 
		if( ! function_exists( 'wp_body_open' ) ) {
		    function wp_body_open() {
		    	do_action( 'wp_body_open' );
		    }
		}
	?>  
    <?php
        $gap = ''; 
        if ( is_active_sidebar( 'footer_top' )){
        $gap = 'footer-bottom-gaps';
    }?>
    <?php        
        $extrapadding = !empty($dealsoffer_option['show_call_btns']) ? '' : 'lesspadding';      
    ?>
    <div id="page" class="site <?php echo esc_attr( $gap );?> <?php echo esc_attr($extrapadding);?>">
        <?php
            get_template_part('inc/header/header'); 
        ?> 
        <!-- End Header Menu End -->
        <?php 
            $page_bg = get_post_meta(get_the_ID(), 'page_bg', true);
            $primary_colors = get_post_meta(get_the_ID(), 'primary-colors', true);
            if($page_bg !='' && is_page()): ?>
                <div class="main-contain offcontents" style="background-image: url('<?php echo esc_url( $page_bg );?>'); ">
            <?php else: ?>
                <div class="main-contain offcontents" style="background-color: <?php echo esc_url( $primary_colors ); ?>;">                
            <?php endif;
        ?>  
              
        <div id="content">