<?php 
/**
 *Plugin Name: TP Elements
 * Description: Theme core addon pluign.
 * Version:     1.0.0
 * Text Domain: tp-elements
 * Author: _Themephi
 * Author URI: https://www.themephi.net
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
define( 'TPELEMENTS_FILE', __FILE__ );
define( 'TPELEMENTS_DIR_PATH_PRO', plugin_dir_path( __FILE__ ) );
define( 'TPELEMENTS_DIR_URL_PRO', plugin_dir_url( __FILE__ ) );
define( 'TPELEMENTS_ASSETS_PRO', trailingslashit( TPELEMENTS_DIR_URL_PRO . 'assets' ) );

require TPELEMENTS_DIR_PATH_PRO . 'base.php';
require TPELEMENTS_DIR_PATH_PRO . 'post-type/coupons/coupon-functions.php';
require TPELEMENTS_DIR_PATH_PRO . 'post-type/coupons/class.coupon-query.php';
require TPELEMENTS_DIR_PATH_PRO . 'post-type/coupons/category-icon.php';
require TPELEMENTS_DIR_PATH_PRO . 'post-type/coupons/store-image.php';
require TPELEMENTS_DIR_PATH_PRO . 'post-type/post-type.php';
require TPELEMENTS_DIR_PATH_PRO . 'shortcode-elementor/elementor-shortcode.php';
require TPELEMENTS_DIR_PATH_PRO . 'inc/custom-tp-icon.php';
require TPELEMENTS_DIR_PATH_PRO . 'inc/font-awesome-icons.php';
require TPELEMENTS_DIR_PATH_PRO . 'inc/font-google-icons.php';
require TPELEMENTS_DIR_PATH_PRO . 'widget-option/admin-init.php';
require TPELEMENTS_DIR_PATH_PRO . 'themephi-header-footer-elementor/themephi-header-footer-elementor.php';

function dealsoffer_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'dealsoffer_mime_types');

