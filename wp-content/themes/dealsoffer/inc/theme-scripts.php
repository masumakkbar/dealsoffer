<?php

function dealsoffer_scripts() {
	//register styles
	global $dealsoffer_option;
	wp_enqueue_style( 'boostrap', get_template_directory_uri() .'/assets/css/bootstrap.min.css' );	
	wp_enqueue_style( 'tp-icons', get_template_directory_uri() .'/assets/css/tp-icons.css');	
	wp_enqueue_style( 'font-awesome-css', get_template_directory_uri() .'/assets/css/fontawesome-all.min.css');	
    wp_enqueue_style( 'magnific-popup', get_template_directory_uri() .'/assets/css/magnific-popup.css');
	wp_enqueue_style( 'swiper', get_template_directory_uri().'/assets/css/swiper-bundle.min.css' );
	wp_enqueue_style( 'animate-css', get_template_directory_uri().'/assets/css/animate.css' );
	wp_enqueue_style( 'nice-select-css', get_template_directory_uri().'/assets/css/nice-select.css' );
	wp_enqueue_style( 'select2-css', get_template_directory_uri().'/assets/css/select2.min.css' );
	wp_enqueue_style( 'dealsoffer-style-default', get_template_directory_uri() .'/assets/scss/theme.css' );
	wp_enqueue_style( 'dealsoffer-style-responsive', get_template_directory_uri() .'/assets/css/responsive.css' );
	if ( is_rtl() ) {
		wp_enqueue_style(  'dealsoffer-rtl',  get_template_directory_uri().'/assets/scss/rtl.css' );		
	}
	wp_enqueue_style( 'dealsoffer-style', get_stylesheet_uri() );	

	$google_api_key = isset($dealsoffer_option['google_api_key']) ? $dealsoffer_option['google_api_key'] : '';
	if( !empty( $google_api_key ) && ( ( is_page( 'contact' ) ) || is_tax( 'coupon-store' ) ) ){
		$api = '';
		if( !empty( $google_api_key ) ){
			$api = '&key='.$google_api_key;
		}
		wp_enqueue_script( 'dealsoffer-googlemap', 'https://maps.googleapis.com/maps/api/js?'.$api, false, false, true );
	}
		
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/modernizr-2.8.3.min.js', array('jquery'), '2.8.3', true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '5.2.0', true );
	wp_enqueue_script( 'swiper', get_template_directory_uri().'/assets/js/swiper-bundle.min.js', array('jquery'), '8.2.3');
	wp_enqueue_script( 'wow', get_template_directory_uri().'/assets/js/wow.min.js', array('jquery'), '1.1.2');
	wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/assets/js/waypoints.min.js', array('jquery'), '2.0.3', true );	
	wp_enqueue_script( 'waypoints-sticky', get_template_directory_uri() . '/assets/js/waypoints-sticky.min.js', array('jquery'), '2.0.3', true );	
	wp_enqueue_script( 'jquery-counterup', get_template_directory_uri() . '/assets/js/jquery.counterup.min.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'jquery-countdown', get_template_directory_uri() . '/assets/js/countdown.js', array('jquery'), '1.4.1', true );
	wp_enqueue_script( 'jquery-magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'isotope-tp', get_template_directory_uri() . '/assets/js/isotope-tp.js', array('jquery', 'imagesloaded'), '20151215', true );	
	wp_enqueue_script('dealsoffer-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), wp_get_theme()->get( 'Version' ), true);

	if( is_tax('coupon-category') || is_tax('coupon-store') || is_tax('coupon-tag') || (is_page() && get_page_template_slug() == 'page-tpl_browse_coupon.php') ){
		wp_enqueue_script('cookie', get_theme_file_uri( '/assets/js/cookies.js' ), array( 'jquery' ), false, true);
	}
	
	
	/* login scripts start */
	if( !is_user_logged_in() ){
		wp_enqueue_script('couponis-sc', get_theme_file_uri( '/assets/js/couponis-sc.js' ), array('jquery'), false, true);	
	}
	/* login scripts end */
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'dealsoffer_scripts' );  

add_action( 'admin_enqueue_scripts', 'dealsoffer_load_admin_styles' );
function dealsoffer_load_admin_styles($screen) {
	wp_enqueue_style( 'dealsoffer-admin-style', get_template_directory_uri() . '/assets/css/admin-style.css', '1.0.0', true );
	wp_enqueue_script( 'dealsoffer-admin-script', get_template_directory_uri() . '/assets/js/admin-script.js', array('jquery'), '1.0.0', true );

	if( isset( $_GET['taxonomy'] ) && in_array( $_GET['taxonomy'], [ 'coupon-store', 'coupon-category' ] ) ){
		wp_enqueue_media();
		wp_enqueue_script( 'dealsoffer-admin-texonomy-script', get_template_directory_uri() . '/assets/js/admin-texonomy.js', array('jquery'), false, true );
	}

}



