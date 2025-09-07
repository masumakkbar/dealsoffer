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
	<?php do_action( 'wp_body_open' ); ?>
    
   <div class="close-button body-close"></div>
  
    <!--Preloader start here-->
    <?php get_template_part( 'inc/header/preloader' ); ?>
    <!--Preloader area end here-->
    
    <?php
        $gap = ''; 
        if ( is_active_sidebar( 'footer_top' )){
        $gap = 'footer-bottom-gaps';
        
    }$header_id = Header_Footer_Elementor::get_settings( 'type_header', '' );    
    $fixed_header = get_post_meta($header_id, 'header-position', true);
    $fixed_header = !empty($fixed_header) ? 'fixed-header' : '';?>
    
    <?php        
        $extrapadding = !empty($dealsoffer_option['show_call_btns']) ? '' : 'lesspadding';   
        $sticky             = !empty($dealsoffer_option['off_sticky']) ? $dealsoffer_option['off_sticky'] : ''; 
        $sticky_menu        = ($sticky == 1) ? ' menu-sticky' : '';   
    ?>
    <div id="page" class="site <?php echo esc_attr( $gap );?> <?php echo esc_attr($extrapadding);?>">
    <?php  get_template_part('inc/header/search'); get_template_part('inc/header/off-canvas'); ?>
    	<header id="themephi-header" class="header-style-1  mainsmenu <?php echo $fixed_header ;?>">   
	     
	    <div class="header-inner<?php echo esc_attr($sticky_menu);?>">
       <?php 

		if( is_404() ){
			return;
		} else {
			do_action( 'hfe_header' );
		} ?>
        </div>
    </header>

    <div class="tp-coupon-modal modal fade in" id="showCode" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content coupon_modal_content">

            </div>
        </div>
    </div>

    <?php get_template_part( 'inc/breadcrumbs' );  ?>
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


