<?php
/**
* Plugin Name: TP Framework
* Plugin URI: https://codecanyon.net/user/themephi
* Description: Custom Framework plugin for page metabox
* Version: 1.0.0
* Author: _Themephi
* Author URI: https://www.themephi.net
*/

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
    die( 'You should not be here' );
}

/**
* Function when plugin is activated
*
* @param void
*
*/
//Including file that manages all template

//All Post type include here

$dir = plugin_dir_path( __FILE__ );
//For team
require_once $dir .'/metaboxes/page-header.php';
require_once $dir .'/metaboxes/custom-metabox.php';
require_once $dir .'/metaboxes/cmb2/init.php';

/**
 * Implement widgets
 */
require_once $dir . '/widgets/post_recent_widget.php';
require_once $dir . '/widgets/coupon-info.php';
require_once $dir . '/widgets/social-icon.php';
require_once $dir . '/widgets/tp-posts-categories.php';
require_once $dir . '/widgets/serivice-tags.php';
require_once $dir . '/widgets/search_widget.php';