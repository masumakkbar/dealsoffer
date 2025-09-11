<?php


/* LOAD DEMO CONFIGURATION */
$stage = ''; // leave this empty to disable demo environment
if ( 'demo' == $stage ) {
	define( 'PBS_DEMO', 'demo' );
}

// check if it is demo site
if ( ! function_exists( 'pbs_is_demo' ) ) {
	function pbs_is_demo() {
		if ( 'dealsoffer' == get_option( 'template' ) ) {
			if ( defined( 'PBS_DEMO' ) ) {
				return true;
			}
		}

		return false;
	}
}


if ( ! function_exists( 'dealsoffer_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */ 

function dealsoffer_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on dealsoffer, use a find and replace
	 * to change 'dealsoffer' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'dealsoffer', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'wp-block-styles' );
    add_theme_support( 'responsive-embeds' );
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	
	if ( class_exists( 'WooCommerce' ) ) {  

		add_theme_support( 'woocommerce' );	
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

	}

	function my_theme_register_block_patterns() {
		register_block_pattern( 'my-theme/my-pattern', array(
			'title'       => __( 'My Pattern', 'dealsoffer' ),
			'description' => _x( 'A custom pattern for my theme.', 'Block pattern description', 'dealsoffer' ),
			'content'     => "<!-- wp:paragraph --><p>" . __( 'Hello world!', 'dealsoffer' ) . "</p><!-- /wp:paragraph -->",
		));
	}
	add_action( 'init', 'my_theme_register_block_patterns' );
	function my_theme_register_block_styles() {
		register_block_style( 'core/quote', array(
			'name'  => 'fancy-quote',
			'label' => __( 'Fancy Quote', 'dealsoffer' ),
		));
	}
	add_action( 'init', 'my_theme_register_block_styles' );

	
	function dealsoffer_change_excerpt( $text )
	{
		$pos = strrpos( $text, '[');
		if ($pos === false)
		{
			return $text;
		}
		
		return rtrim (substr($text, 0, $pos) ) . '...';
	}
	add_filter('get_the_excerpt', 'dealsoffer_change_excerpt');


	// Limit Excerpt Length by number of Words
	function dealsoffer_custom_excerpt( $limit ) {
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...';
		} else {
		$excerpt = implode(" ",$excerpt);
		}
		$excerpt = preg_replace('`[[^]]*]`','',$excerpt);
		return $excerpt;
		}
		function content($limit) {
		$content = explode(' ', get_the_content(), $limit);
		if (count($content)>=$limit) {
		array_pop($content);
		$content = implode(" ",$content).'...';
		} else {
		$content = implode(" ",$content);
		}
		$content = preg_replace('/[.+]/','', $content);
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
		return $content;
	}

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary Menu', 'dealsoffer' ),		
		'menu-2' => esc_html__( 'Single Menu', 'dealsoffer' ),
		
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'dealsoffer_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	//add support posts format
	add_theme_support( 'post-formats', array( 
		'aside', 
		'gallery',
		'audio',
		'video',
		'image',
		'quote',
		'link',
	) );

add_theme_support( 'align-wide' );	
}
endif;
add_action( 'after_setup_theme', 'dealsoffer_setup' );

/**
*Custom Image Size
*/
add_image_size( 'dealsoffer-blog-slider', 420, 365, true );
add_image_size( 'dealsoffer-blog-sideabr', 87, 87, true );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function dealsoffer_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'dealsoffer_content_width', 640 );
}
add_action( 'after_setup_theme', 'dealsoffer_content_width', 0 );


/**
 * Implement the Custom Header feature.
 */
require_once get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 *  Enqueue scripts and styles.
 */
require_once get_template_directory() . '/inc/theme-scripts.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once get_template_directory() . '/inc/theme-functions.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once get_template_directory() . '/inc/theme-sidebar.php';

/**
 * Customizer additions.
 */
require_once get_template_directory() . '/inc/customizer.php';

/**
 * Custom Style
 */
require_once get_template_directory() . '/inc/dyanamic-css.php';
require_once get_template_directory() . '/libs/theme-option/config.php';
require_once get_template_directory() . '/inc/tgm/tgm-config.php';


//----------------------------------------------------------------------
// Remove Redux Framework NewsFlash
//----------------------------------------------------------------------
if ( ! class_exists( 'reduxNewsflash' ) ):
    class reduxNewsflash {
        public function __construct( $parent, $params ) {}
    }
endif;

function dealsoffer_remove_demo_mode_link() { // Be sure to rename this function to something more unique
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    }
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
    }
}
add_action('init', 'dealsoffer_remove_demo_mode_link');

/**
 * Registers an editor stylesheet for the theme.
 */
function dealsoffer_theme_add_editor_styles() {
    add_editor_style( 'css/custom-editor-style.css' );
}
add_action( 'admin_init', 'dealsoffer_theme_add_editor_styles' );


//------------------------------------------------------------------------
//Organize Comments form field
//-----------------------------------------------------------------------
function dealsoffer_wpb_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}

add_filter( 'comment_form_fields', 'dealsoffer_wpb_move_comment_field_to_bottom' );	


//adding placeholder text for comment form

function dealsoffer_comment_textarea_placeholder( $args ) {
	$args['comment_field']        = str_replace( '<textarea', '<textarea placeholder="Comment"', $args['comment_field'] );
	return $args;
}
add_filter( 'comment_form_defaults', 'dealsoffer_comment_textarea_placeholder' );

/**
 * Comment Form Fields Placeholder
 *
 */
function dealsoffer_comment_form_fields( $fields ) {
	foreach( $fields as &$field ) {
		$field = str_replace( 'id="author"', 'id="author" placeholder="Name*"', $field );
		$field = str_replace( 'id="email"', 'id="email" placeholder="Email*"', $field );
		$field = str_replace( 'id="url"', 'id="url" placeholder="Website"', $field );
	}
	return $fields;
}
add_filter( 'comment_form_default_fields', 'dealsoffer_comment_form_fields' );


//customize archive tilte
add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        } elseif ( is_author() ) {
            $title = '<span class="vcard">' . get_the_author() . '</span>' ;
        }
    return $title;
});

add_filter( 'get_the_archive_title', 'dealsoffer_archive_title_remove_prefix' );
function dealsoffer_archive_title_remove_prefix( $title ) {
	if ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	}
	return $title;
}

function dealsoffer_menu_add_description_to_menu($item_output, $item, $depth, $args) {

   if (strlen($item->description) > 0 ) {
      // append description after link
      $item_output .= sprintf('<span class="description">%s</span>', esc_html($item->description));   
     
   }   
   return $item_output;
}
add_filter('walker_nav_menu_start_el', 'dealsoffer_menu_add_description_to_menu', 10, 4);

add_filter('wp_list_categories', 'dealsoffer_cat_count_span');
function dealsoffer_cat_count_span($links) {
  $links = str_replace('</a> (', '</a> <span>(', $links);
  $links = str_replace(')', ')</span>', $links);
  return $links;
}

function dealsoffer_style_the_archive_count($links) {
    $links = str_replace('</a>&nbsp;(', '</a> <span class="archiveCount">(', $links);
    $links = str_replace(')', ')</span>', $links);
    return $links;
}

add_filter('get_archives_link', 'dealsoffer_style_the_archive_count');

/**
 * Post title array
 */
function dealsoffer_get_postTitleArray($postType = 'post' ){
    $post_type_query  = new WP_Query(
        array (
            'post_type'      => $postType,
            'posts_per_page' => -1,
            'orderby' => 'title',
    		'order'   => 'ASC',
        )
    );
    // we need the array of posts
    $posts_array      = $post_type_query->posts;
    // the key equals the ID, the value is the post_title
    if ( is_array($posts_array) ) {
        $post_title_array = wp_list_pluck($posts_array, 'post_title', 'ID' );
    } else {
        $post_title_array['default'] = esc_html__( 'Default', 'dealsoffer' );
    }
    return $post_title_array;
}


if ( class_exists( 'WooCommerce' ) ) { 

	/**
	 * Display 3 products per row on Shop Page
	 */
	add_filter('loop_shop_columns', 'fitton_default_shop_loop_columns');
	function fitton_default_shop_loop_columns() {
		return 3;
	}

	/**
	 * Remove WooCommerce Actions 
	 */
	add_action( 'init', 'woo_remove_actions' );
	function woo_remove_actions() {
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	}

}

/* Coupons ajax start  */

/*
If needed to be redirected
*/
if( !function_exists('dealsoffer_redirect_external_link') ){
	function dealsoffer_redirect_external_link() {
		if( !empty( $_GET['csout'] ) ){
			$external = get_post_meta( $_GET['csout'], 'coupon_spec_link', true );
		}
		if( !empty( $_GET['cout'] ) ){
			$external = get_post_meta( $_GET['cout'], 'coupon_affiliate', true );
		}
		else if( !empty( $_GET['sout'] ) ){
			$external = get_term_meta( $_GET['sout'], 'store_url', true );	
		}
		else if( !empty( $_GET['dout'] ) ){
			$external = get_post_meta( $_GET['dout'], 'coupon_url', true );
		}
	
		if( !empty( $external ) ){
			wp_redirect( $external );
			exit();
		}
	}
	add_action( 'template_redirect', 'dealsoffer_redirect_external_link' );
}
	

function enqueue_couponis_scripts() {
    global $dealsoffer_option;
    
    // Initialize default values
    $marker_icon = '';
    $markers_max_zoom = 10; // Default value
    
    // Check if options exist before accessing them
    if (!empty($dealsoffer_option)) {
        if (isset($dealsoffer_option['marker_icon']) && isset($dealsoffer_option['marker_icon']['url'])) {
            $marker_icon = $dealsoffer_option['marker_icon']['url'];
        }
        
        if (isset($dealsoffer_option['markers_max_zoom'])) {
            $markers_max_zoom = $dealsoffer_option['markers_max_zoom'];
        }
    }

    wp_enqueue_script('dealsoffer-coupon-js', get_template_directory_uri() . '/assets/js/coupon.js', array('jquery'), '1.0.0', true);

    wp_localize_script('dealsoffer-coupon-js', 'tp_coupon_overall_data', array(
        'markers_max_zoom' => $markers_max_zoom,
        'marker_icon'      => $marker_icon,
        'ajaxurl'          => admin_url('admin-ajax.php'),
        'nonce'            => wp_create_nonce('coupon_feedback_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_couponis_scripts');


/*
Get coupon store image
*/
if( !function_exists('tp_get_coupon_store_logo') ){
	function tp_get_coupon_store_logo( $store_id, $image_size = 'couponis-logo' ){
		$store_logo = get_term_meta( $store_id, 'store_image', true );
		return  wp_get_attachment_image( $store_logo, $image_size );
	}
}
	
/*
Get coupon store image src
*/
if( !function_exists('tp_get_coupon_store_logo_src') ){
	function tp_get_coupon_store_logo_src( $store_id, $image_size = 'couponis-logo' ){
		$store_logo = get_term_meta( $store_id, 'store_image', true );
		return  wp_get_attachment_image_url( $store_logo, $image_size );
	}
}
/*
feedback cookie
*/
if ( !function_exists('tp_coupon_get_feedback_cookie') ) {
    function tp_coupon_get_feedback_cookie() {
        $coupon_ids = array();
        if ( !empty( $_COOKIE['tp_coupon_feedback'] ) ) {
            $coupon_ids = explode( '-', $_COOKIE['tp_coupon_feedback'] );
        }
        return $coupon_ids;
    }
}

/*
Generate coupon modal content
*/
if( !function_exists( 'tp_coupon_show_code' ) ){
function tp_coupon_show_code(){
	$coupon_id = sanitize_text_field( $_POST['coupon_id'] );

	$coupon = get_post( $coupon_id );
	$coupon_modal = '';
	if( !empty( $coupon ) ){

		$used = get_post_meta( $coupon_id, 'used', true );
		$used = tp_register_coupon_used( $coupon_id, $used );
		$coupon_spec_link = get_post_meta( $coupon_id, 'coupon_spec_link', true );

		$store = get_the_terms( $coupon, 'coupon-store' );
		if( !empty( $store ) ){
			$store = array_shift( $store );
			$store_url = get_term_meta( $store->term_id, 'store_url', true );
		}

		if( !empty( $coupon_spec_link ) || !empty( $store_url ) )
		{
			$link = !empty( $coupon_spec_link ) ? add_query_arg( array( 'csout' => $coupon_id ), home_url('/') ) : add_query_arg( array( 'sout' => $store->term_id ), home_url('/') );     
		}

		$type = get_post_meta( $coupon_id, 'ctype', true );

		?>
		<div class="modal-header tp-coupon-modal-header">
			<h4 class="text-start tp-coupon-modal-title"><?php echo esc_html( $coupon->post_title ); ?></h4>
			<button type="button" class="close tp-coupon-modal-close" data-bs-dismiss="modal" aria-hidden="true"><i class="tp tp-xmark"></i></button>
		</div>

		<div class="modal-body tp-coupon-modal-body">

			<?php if( !empty( $store ) ): ?>
				<div class="text-center">
					<?php if( !empty( $link ) ): ?>
						<a class="store-image" href="<?php echo esc_url( $link ) ?>" rel="nofollow" target="_blank">
					<?php endif; ?>
						<?php echo tp_get_coupon_store_logo( $store->term_id ); ?>
					<?php if( !empty( $link ) ): ?>
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php
			if( $type == '1' ){
				$coupon_code = get_post_meta( $coupon_id, 'coupon_code_change', true );

				if( !empty( $link ) ){
					$after_text = esc_html__( 'Code is copied', 'dealsoffer' );
				}
				else{
					$after_text = esc_html__( 'Code is copied', 'dealsoffer' );
				}
				echo '<input type="text" class="coupon-code-modal header-alike" readonly="readonly" value="'.esc_attr( $coupon_code ).'" />';
				echo '<p class="coupon-code-copied">'.esc_html__( 'Click the code to auto copy', 'dealsoffer' ).'</p>';
				echo '<p class="coupon-code-copied after-copy hidden">'.$after_text.'</p>';
			}
			else if( $type == '2' ){
				$coupon_printable = get_post_meta( $coupon_id, 'coupon_printable', true );
				if ( !empty( $coupon_printable ) ) {
					echo '<a class="coupon-code-modal header-alike" href="' . esc_url( $coupon_printable ) . '" target="_blank">' . esc_html__( 'PRINT CODE', 'dealsoffer' ) . '</a>';
				} else {
					echo '<p>' . esc_html__( 'No printable coupon available.', 'dealsoffer' ) . '</p>';
				}
			}
			else if( $type == '3' ){
				echo '<a class="coupon-code-modal header-alike sale-act-btn" href="'.esc_url( add_query_arg( array( 'dout' => $coupon_id ), home_url('/') ) ).'" target="_blank">'.esc_html__( 'GET DEAL', 'dealsoffer' ).'</a>';
				echo '<p class="coupon-code-copied">'.esc_html__( 'Click button above to shop online and save', 'dealsoffer' ).'</p>';
			}		
			?>

			<div class="coupon-works">
				<span><?php esc_html_e( 'Did it work?','dealsoffer' ) ?></span>
				<p class="feedback-wrap">
					<?php 
					$positive_feedback = get_post_meta( $coupon_id, 'positive', true );
					$negative_feedback = get_post_meta( $coupon_id, 'negative', true );

					$coupon_ids = tp_coupon_get_feedback_cookie();

					if (in_array($coupon_id, $coupon_ids)) {
						echo '<a href="javascript:;" class="disabled"><i class="fa fa-thumbs-up" aria-hidden="true"></i> ' . esc_html__( 'Yes', 'dealsoffer' ) . '</a>';
						echo '<a href="javascript:;" class="disabled"><i class="fa fa-thumbs-down" aria-hidden="true"></i> ' . esc_html__( 'No', 'dealsoffer' ) . '</a>';
					} else {
						echo '<a href="javascript:;" class="feedback-record-action" data-value="+" data-coupon_id="' . esc_attr($coupon_id) . '"><i class="fa fa-thumbs-up" aria-hidden="true"></i> ' . esc_html__( 'Yes', 'dealsoffer' ) . '</a>';
						echo '<a href="javascript:;" class="feedback-record-action" data-value="-" data-coupon_id="' . esc_attr($coupon_id) . '"><i class="fa fa-thumbs-down" aria-hidden="true"></i> ' . esc_html__( 'No', 'dealsoffer' ) . '</a>';
					}

					?>
				</p>
			</div>

		</div>


		<div class="modal-footer">

			<div class="tp-modal-footer-inner">
				<div class="tp-coupon-modal-footer">
					<div class="tp-coupon-modal-footer-item">
						<a href="javascript:;" class="small-action modal-content-action">
							<?php esc_html_e( 'Show Information', 'dealsoffer' ) ?>
						</a>
						<?php include( get_theme_file_path( 'inc/coupons/share.php' ) ) ?>
					</div>
					<div class="tp-coupon-modal-footer-item">
						<span><i class="fas fa-unlock-alt"></i> <?php esc_html_e( 'Used by', 'dealsoffer' ) ?>  <?php echo esc_html( $used ); ?></span>
						<?php if( !empty( $store ) ): ?>
						<div class="tp-coupon-modal-footer-store">
							<a href="<?php echo get_term_link( $store ) ?>">
								<?php echo esc_html__( 'See ', 'dealsoffer' ).'<strong>'.$store->name.'</strong>'.esc_html__( ' Coupons', 'dealsoffer' ); ?> 
								<i class="tp tp-arrow-right-regular"></i>
							</a>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="modal-coupon-content hidden">
					<?php echo apply_filters( 'the_content', $coupon->post_content ); ?>
				</div>
			</div>

		</div>

		<?php
	}
	die();
}
add_action('wp_ajax_show_code', 'tp_coupon_show_code');
add_action('wp_ajax_nopriv_show_code', 'tp_coupon_show_code');
}


/*
Save coupon feedback
*/
add_action('wp_ajax_feedback', 'tp_coupon_save_feedback');
add_action('wp_ajax_nopriv_feedback', 'tp_coupon_save_feedback');

function tp_coupon_save_feedback() {
    // Verify nonce for security
    if( !isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'coupon_feedback_nonce') ){
        wp_send_json_error( array( 'message' => 'Invalid request.' ) );
    }

    // Get the coupon ID and feedback value
    $coupon_id = intval( $_POST['coupon_id'] );
    $feedback = sanitize_text_field( $_POST['feedback'] );

    // Get existing feedback values
    $positive = get_post_meta( $coupon_id, 'positive', true );
    $negative = get_post_meta( $coupon_id, 'negative', true );

    // Update the feedback count
    if ( $feedback === '+' ) {
        $positive++;
        update_post_meta( $coupon_id, 'positive', $positive );
    } else if ( $feedback === '-' ) {
        $negative++;
        update_post_meta( $coupon_id, 'negative', $negative );
    }

    // Calculate success rate
    $success_rate = ($positive + $negative > 0) ? round( ($positive / ($positive + $negative)) * 100 ) : 0;
    update_post_meta( $coupon_id, 'success', $success_rate );

    // Create updated HTML for feedback buttons (disable them)
    $html = '<a href="javascript:;" class="disabled"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a>';
    $html .= '<a href="javascript:;" class="disabled"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a>';

    wp_send_json_success( array( 'html' => $html ) );
}

/*
Increment usage number
*/

function tp_register_coupon_used( $post_id, $used = 0 ) {
	// Check if the post ID is valid and belongs to a 'coupon' post type
	if ( get_post_type( $post_id ) !== 'coupon' ) {
		return; // Exit if it's not a coupon post type
	}

	// Get the current 'used' meta value for the coupon post
	$used = get_post_meta( $post_id, 'used', true );

	// If the 'used' meta value is empty, initialize it to 0
	if ( empty( $used ) ) {
		$used = 0;
	}

	// Increment the 'used' count
	$used++;

	// Save the updated 'used' value back to the post meta
	update_post_meta( $post_id, 'used', $used );

	return $used;
}


/* Extra solutions for  */

function tp_store_marker_wrap( $store_marker = '' ) {
    ?>
    <div class="store-marker-wrap">
        <label><?php esc_html_e('Store Location', 'dealsoffer'); ?></label>
        <input type="text" name="store_location[]" value="<?php echo esc_attr( $store_marker ); ?>" placeholder="LATITUDE,LONGITUDE">
        <a href="javascript:;" class="remove-store-marker"><?php echo esc_html__('Remove', 'dealsoffer'); ?></a>
    </div>
    <?php
}


// Search Coupon Ajax
function coupon_search_ajax() {

    if ( !isset($_GET['nonce']) || !wp_verify_nonce($_GET['nonce'], 'coupon_feedback_nonce') ) {
        die('Permission denied!');
    }

    $search_query = isset($_GET['search_query']) ? sanitize_text_field($_GET['search_query']) : '';
    $category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';
    
    $args = array(
        'post_type'      => 'coupon',  
        'posts_per_page' => 5,     
        's'               => $search_query, 
        'post_status'     => 'publish', 
    );

    if ($category) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'coupon-category',
                'field'    => 'slug',
                'terms'    => $category,
            ),
        );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        echo '<ul>';
        while ($query->have_posts()) {
            $query->the_post();
            echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
        }
        echo '</ul>';
    } else {
        echo esc_html__('No coupons found.', 'dealsoffer');
    }

    wp_reset_postdata();
    die(); 
}

add_action('wp_ajax_coupon_search_ajax', 'coupon_search_ajax'); 
add_action('wp_ajax_nopriv_coupon_search_ajax', 'coupon_search_ajax'); 

// Redirect Page Template
function couponis_get_permalink_by_tpl( $template ) {
    $template_file = $template . '.php';
    $pages = get_posts([
        'post_type'   => 'page',
        'meta_key'    => '_wp_page_template',
        'meta_value'  => $template_file,
        'posts_per_page' => 1
    ]);

    if ( ! empty( $pages ) ) {
        return get_permalink( $pages[0]->ID );
    }

    return home_url(); 
}

// Handle form submission
function handle_coupon_submission() {
    if ( ! wp_verify_nonce( $_POST['nonce'], 'coupon_feedback_nonce' ) ) {
        wp_send_json_error( 'Invalid nonce' );
    }

    if ( ! is_user_logged_in() ) {
        wp_send_json_error( 'User not logged in' );
    }

    $coupon_data = array(
        'post_title'   => sanitize_text_field( $_POST['title'] ),
        'post_content' => sanitize_text_field( $_POST['description'] ),
        'post_status'  => 'pending',
        'post_type'    => 'coupon',
    );

    $coupon_id = wp_insert_post( $coupon_data );

    if ( $coupon_id ) {
        // Save meta data
        update_post_meta( $coupon_id, 'coupon_code_change', sanitize_text_field( $_POST['coupon_code_change'] ) );
        update_post_meta( $coupon_id, 'coupon_type', sanitize_text_field( $_POST['type'] ) );
        update_post_meta( $coupon_id, 'expire_date', sanitize_text_field( $_POST['expire'] ) );
        update_post_meta( $coupon_id, 'exclusive', sanitize_text_field( $_POST['exclusive'] ) );
        update_post_meta( $coupon_id, 'used', sanitize_text_field( $_POST['used'] ) );
        update_post_meta( $coupon_id, 'positive', sanitize_text_field( $_POST['positive'] ) );
        update_post_meta( $coupon_id, 'coupon_affiliate', sanitize_text_field( $_POST['coupon_affiliate'] ) );

        wp_send_json_success( 'Coupon submitted successfully' );
    } else {
        wp_send_json_error( 'Failed to submit coupon' );
    }
}
add_action( 'wp_ajax_submit_coupon', 'handle_coupon_submission' );
add_action( 'wp_ajax_nopriv_submit_coupon', 'handle_coupon_submission' );

// Redirect non-logged-in users to login page
function redirect_non_logged_in_users() {
    if ( ! is_user_logged_in() && ( is_page_template( 'page-tpl_submit.php' ) || is_page_template( 'page-tpl_account.php' ) ) ) {
        wp_redirect( home_url( '/login' ) );
        exit;
    }
}
add_action( 'template_redirect', 'redirect_non_logged_in_users' );


// Save or remove coupon via AJAX
function couponis_save_coupon() {
    check_ajax_referer('coupon_feedback_nonce', 'nonce');

    if (is_user_logged_in()) {
        $post_id = isset($_POST['post_id']) ? sanitize_text_field($_POST['post_id']) : 0;
        $user_id = get_current_user_id();
        $saved_coupons = get_user_meta($user_id, 'saved_coupons', true);
        $saved_coupons = !empty($saved_coupons) ? explode(',', $saved_coupons) : array();

        if (in_array($post_id, $saved_coupons)) {
            $saved_coupons = array_diff($saved_coupons, array($post_id));
        } else {
            $saved_coupons[] = $post_id;
        }

        $saved_coupons = array_filter($saved_coupons);
        update_user_meta($user_id, 'saved_coupons', implode(',', $saved_coupons));

        wp_send_json_success(array('message' => 'Coupon saved successfully.'));
    } else {
        wp_send_json_error(array('message' => 'User not logged in.'));
    }
}
add_action('wp_ajax_save_coupon', 'couponis_save_coupon');
add_action('wp_ajax_nopriv_save_coupon', 'couponis_save_coupon');

// Expired Coupon

if( !function_exists('couponis_is_expired') ){
	function couponis_is_expired( $expire ){
		if( empty( $expire ) ){
			return false;
		}
	
		if( $expire < current_time( 'timestamp' ) ){
			return true;
		}
	
		return false;
	}
}

/*
Get search order by cookie value
*/
if (!function_exists('couponis_get_search_orderby_cookie')) {
    function couponis_get_search_orderby_cookie()
    {
        $selected = '';
        if (!empty($_COOKIE['couponis-orderby']) && in_array($_COOKIE['couponis-orderby'], ['expire', 'used', 'name', 'date', 'success'])) {
            $selected = $_COOKIE['couponis-orderby'];
        }
        return $selected;
    }
}

/*
Order by select dropdown
*/
if (!function_exists('couponis_search_orderby')) {
    function couponis_search_orderby()
    {
        $selected = couponis_get_search_orderby_cookie();
        ?>
        <div class="styled-select">
            <select name="orderby" class="orderby">
                <option value="expire" <?php selected($selected, 'expire') ?>><?php esc_html_e('Ending Soon', 'dealsoffer') ?></option>
                <option value="used" <?php selected($selected, 'used') ?>><?php esc_html_e('Popular', 'dealsoffer') ?></option>
                <option value="name" <?php selected($selected, 'name') ?>><?php esc_html_e('Name', 'dealsoffer') ?></option>
                <option value="date" <?php selected($selected, 'date') ?>><?php esc_html_e('Date Added', 'dealsoffer') ?></option>
                <option value="success" <?php selected($selected, 'success') ?>><?php esc_html_e('Success Rate', 'dealsoffer') ?></option>
            </select>
        </div>
        <?php
    }
}

/*
Sort taxonomies hierarchically
*/
if (!function_exists('couponis_sort_terms_hierarchically')) {
    function couponis_sort_terms_hierarchically(array &$cats, array &$into, $parentId = 0)
    {
        foreach ($cats as $i => $cat) {
            if ($cat->parent == $parentId) {
                $into[$cat->term_id] = $cat;
                unset($cats[$i]);
            }
        }

        foreach ($into as $topCat) {
            $topCat->children = [];
            couponis_sort_terms_hierarchically($cats, $topCat->children, $topCat->term_id);
        }
    }
}

/*
Get hierarchical terms
*/
if (!function_exists('couponis_get_hierarchical_terms')) {
    function couponis_get_hierarchical_terms($taxonomy, $hide_empty = true)
    {
        $terms = get_terms([
            'taxonomy'   => $taxonomy,
            'hide_empty' => $hide_empty
        ]);

        $sorted_terms = [];
        couponis_sort_terms_hierarchically($terms, $sorted_terms);
        usort($sorted_terms, "couponis_organized_sort_name_asc");

        return $sorted_terms;
    }
}

/*
Sort terms by name (ASC)
*/
if (!function_exists('couponis_organized_sort_name_asc')) {
    function couponis_organized_sort_name_asc($a, $b)
    {
        return strcasecmp($a->name, $b->name);
    }
}

/*
List terms in select options (Fix hierarchical display)
*/
if (!function_exists('couponis_list_terms_select')) {
    function couponis_list_terms_select($taxonomy, $selected = '', $parent_id = 0, $level = 0)
    {
        $terms = get_terms([
            'taxonomy'   => $taxonomy,
            'hide_empty' => false,
            'parent'     => $parent_id,
        ]);

        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $indent = str_repeat('&nbsp;&nbsp;&nbsp;', $level);
                ?>
                <option value="<?php echo esc_attr($term->term_id); ?>" <?php selected($selected, $term->term_id); ?>>
                    <?php echo wp_kses_post( $indent ) . esc_html($term->name); ?>
                </option>
                <?php
                couponis_list_terms_select($taxonomy, $selected, $term->term_id, $level + 1);
            }
        }
    }
}
