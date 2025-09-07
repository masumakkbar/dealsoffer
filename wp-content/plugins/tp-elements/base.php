<?php
/**
 * Main Elementor Extension Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class TPelements_Elementor_Extension {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.4';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Elementor_Test_Extension The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Elementor_Test_Extension An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function i18n() {
		load_plugin_textdomain( 'tp-elements' );
	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}
		// Add Plugin actions
		add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_category' ] );
        add_action( 'elementor/elements/categories_registered', [ $this, 'resgister_tpaddon_category' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'resgister_header_footer_category' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'tpelements_register_widget_styles' ] );	
		add_action( 'wp_enqueue_scripts', [ $this, 'tpaddon_register_plugin_styles' ] );		
		add_action( 'admin_enqueue_scripts', [ $this, 'tpaddon_admin_defualt_css' ] );		
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'tpaddon_register_plugin_admin_styles' ] );
		$this->include_files();		
	}

	public function tpelements_register_widget_styles() {		
		$dir = plugin_dir_url(__FILE__);        
		$tpelements_addon_setting = get_option( 'tpelements_addon_option' );

			
		//Contact Form 7
		if( isset( $tpelements_addon_setting['tp_contact_form_7_setting'] ) == 'tpelement_contact_form_7' ) {
			wp_enqueue_style( 'tpelements-cf7', $dir.'widgets/cf7/cf7-css/cf7.css' );			
		}					

		//Icon Box
		if( isset( $tpelements_addon_setting['tp_icon_box_setting'] ) == 'tpelement_icon_box' ){
			wp_enqueue_style( 'tpelements-iconbox', $dir.'widgets/iconbox/tp-iconbox-css/iconbox.css' );
		}
		//Progress Pie
		if( isset( $tpelements_addon_setting['tp_progress_pie_setting'] ) == 'tpelement_progress_pie' ) {
			wp_enqueue_style( 'tpelements-progress-pie', $dir.'widgets/progress-pie/progress-pie-css/progress-pie.css' );
		}

		// Countdown
		wp_enqueue_style( 'tpelements-countdown-css', $dir.'widgets/countdown/countdown.css' );

		// Coupons
		wp_enqueue_style( 'tpelements-coupons-grid-css', $dir.'widgets/coupons/coupons-grid/coupons-css/coupons.css' );

		// Coupons Search
		wp_enqueue_style( 'tpelements-coupons-search-css', $dir.'widgets/coupons/coupon-search/search-css/search.css' );

		
	}

	public function tpaddon_register_plugin_styles() {		
		$dir = plugin_dir_url(__FILE__);       
		wp_enqueue_style( 'custom-elements', $dir.'assets/css/aos.css' );		
		wp_enqueue_style( 'aos', $dir.'assets/css/elements.css' );     
        //enqueue javascript   		  
		wp_enqueue_script( 'aos', $dir.'assets/js/aos.js' , array('jquery'), '201513434', true);
		wp_enqueue_script( 'hover-revel', $dir.'assets/js/hover-revel.js' , array('jquery'), '201513435', true);
		wp_enqueue_script( 'twinmax', $dir.'assets/js/twinmax.js' , array('jquery'), '201513434', true);
		wp_enqueue_script( 'TimeCircles', $dir.'assets/js/TimeCircles.js' , array('jquery'), '2015134367', true);
        wp_enqueue_script( 'jquery-plugin-progressbar', $dir.'assets/js/jQuery-plugin-progressbar.js' , array('jquery'), '201514', true);   		
        wp_enqueue_script( 'tpaddons-custom-pro', $dir.'assets/js/custom.js', array('jquery', 'imagesloaded'), '201434', true);       	
        
    }

    public function tpaddon_register_plugin_admin_styles(){
    	$dir = plugin_dir_url(__FILE__);
    	wp_enqueue_style( 'tpaddons-admin-pro', $dir.'assets/css/admin/admin.css' );
    	wp_enqueue_style( 'tpaddons-admin-floaticon-pro', $dir.'assets/fonts/flaticon.css' );
    } 

    public function tpaddon_admin_defualt_css(){
    	$dir = plugin_dir_url(__FILE__);
    	wp_enqueue_style( 'tpaddons-admin-pro-style', $dir.'assets/css/admin/style.css' );    	
    }

     public function include_files() {       
        require( __DIR__ . '/inc/tp-addon-icons.php' ); 
        require( __DIR__ . '/inc/form.php' );  
        require( __DIR__ . '/inc/helper.php' );  
        require( __DIR__ . '/inc/single-templates.php' );
        require( __DIR__ . '/inc/subscription-modal.php' );
    }

	public function add_category( $elements_manager ) {
        $elements_manager->add_category(
            'pielements_category',
            [
                'title' => esc_html__('TP Elementor Addons', 'tp-elements' ),
                'icon' => 'fa fa-smile-o',
            ]
        );
    }

    public function resgister_tpaddon_category( $elements_manager ) {
        $elements_manager->add_category(
            'tpaddon_category',
            [
                'title' => esc_html__('TP Elementor Pro Addons', 'tp-elements' ),
                'icon' => 'fa fa-smile-o',
            ]
        );
    }

    public function resgister_header_footer_category( $elements_manager ) {
        $elements_manager->add_category(
            'header_footer_category',
            [
                'title' => esc_html__('TP Header Footer Elements', 'tp-elements' ),
                'icon' => 'fa fa-smile-o',
            ]
        );
    }


	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'tp-elements' ),
			'<strong>' . esc_html__( 'TP Elementor Addon', 'tp-elements' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'tp-elements' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'tp-elements' ),
			'<strong>' . esc_html__( 'TP Elementor Addon', 'tp-elements' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'tp-elements' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'tp-elements' ),
			'<strong>' . esc_html__( 'TP Elementor Addon', 'tp-elements' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'tp-elements' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {
		$tpelements_addon_setting = get_option( 'tpelements_addon_option' );		

		// Coupons Filters
		require_once(__DIR__ . '/widgets/coupons/coupon-filter/coupon-filter.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Coupon_Filter());
		
		// Coupons Header Icon
		require_once(__DIR__ . '/widgets/coupons/coupon-signin/coupon-signin.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Coupon_Sign_In_Button());
		
		// Coupons Category
		require_once(__DIR__ . '/widgets/coupons/coupon-category/coupon-category.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Coupon_Category_Widget());
		
		// Coupons Store
		require_once(__DIR__ . '/widgets/coupons/coupon-store/coupon-store.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Coupon_Store_Widget());

		// Coupons Grid
		require_once(__DIR__ . '/widgets/coupons/coupons-grid/coupons-grid.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Coupons_Grid_Widget());

		// Coupons Search
		require_once(__DIR__ . '/widgets/coupons/coupon-search/coupon-search.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Coupon_Search_Widget());

		// Hero Slider
		require_once(__DIR__ . '/widgets/hero-slider/hero-slider.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Hero_Slider_Widget());
		
		// Scrollbar Progress Bar
		require_once(__DIR__ . '/widgets/header-footer/site-scrollprogress.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Scroll_Progress());

		//Image Showcase
		if( isset( $tpelements_addon_setting['tp_image_showcase_setting'] ) == 'tpelement_image_showcase' ) {
		require_once( __DIR__ . '/widgets/image-widget/image.php' );	
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Image_Showcase_Widget() );		
		}

		//Counter
		if( isset( $tpelements_addon_setting['tp_counter_setting'] ) == 'tpelement_counter' ){
			require_once( __DIR__ . '/widgets/counter/tp-counter.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_Counter_Widget() );
		}

		//Button
		if( isset( $tpelements_addon_setting['tp_button_setting'] ) == 'tpelement_button' ) {
			require_once( __DIR__ . '/widgets/button/button.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Button_Widget() );
		}

		//Button Switch
		require_once( __DIR__ . '/widgets/button-switch/button-switch.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Button_Switch_Widget() );

		//Testimonial Slider
		if( isset( $tpelements_addon_setting['tp_testimonial_slider_setting'] ) == 'tpelement_testimonial_slider' ) {
			require_once( __DIR__ . '/widgets/slider/slider.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_Testimonial_Slider_Widget() );
		}

		//Advance Tab
        if( isset( $tpelements_addon_setting['tp_advance_tab_setting'] ) == 'tpelement_advance_tab' ) {
		require_once( __DIR__ . '/widgets/advanced-tab/tab.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Advance_Tab_Widget() );
        }

        //Icon Box
        if( isset( $tpelements_addon_setting['tp_icon_box_setting'] ) == 'tpelement_icon_box' ){
		require_once( __DIR__ . '/widgets/iconbox/tp-iconbox.php' );	
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Icon_Box_Widget() );	
		}

		//Blog Grid
        if( isset( $tpelements_addon_setting['tp_blog_grid_setting'] ) == 'tpelement_blog_grid' ){
			require_once( __DIR__ . '/widgets/blog-grid/blog-grid-widget.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_Blog_Grid_Widget () );
		}

		//Blog Slider
        if( isset( $tpelements_addon_setting['tp_blog_slider_setting'] ) == 'tpelement_blog_slider' ){
			require_once( __DIR__ . '/widgets/blog-slider/blog-slider-widget.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_Blog_Slider_Widget() );
		}

		//Contact Form 7
		if( isset( $tpelements_addon_setting['tp_contact_form_7_setting'] ) == 'tpelement_contact_form_7' ) {
			require_once( __DIR__ . '/widgets/cf7/contact-cf7.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_CF7_Widget() );
		}

		//Progress Bar
		if( isset( $tpelements_addon_setting['tp_progress_bar_setting'] ) == 'tpelement_progress_bar' ) {
			require_once( __DIR__ . '/widgets/progress/tp-progress.php' );	
			\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_Progress_Widget() );	
		}
		// Iconbox Top
		if( isset( $tpelements_addon_setting['tp_icon_bar_setting'] ) == 'tpelement_icon_bar' ) {
			require_once( __DIR__ . '/widgets/header-footer/topbar-icon.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Topbar_Icon_Bar_Widget() );
		}
		// Iconbox List
		if( isset( $tpelements_addon_setting['tp_contactbox_icon_setting'] ) == 'tpelement_contactbox_icon' ) {
		require_once( __DIR__ . '/widgets/topbar-item/topbar-icon.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Contactbox_List_Widget() );
		}

		//Progress Pie
		if( isset( $tpelements_addon_setting['tp_progress_pie_setting'] ) == 'tpelement_progress_pie' ) {
		require_once( __DIR__ . '/widgets/progress-pie/progress-pie.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_Progress_Pie_Widget() );		
		}

		//countdown
		if( isset( $tpelements_addon_setting['tp_countdown_setting'] ) == 'tpelement_countdown_box' ){
		require_once( __DIR__ . '/widgets/countdown/countdown.php' );	
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_Pro_Countdown_Widget() );
		}

		//Accordion
		if( isset( $tpelements_addon_setting['tp_accordion_setting'] ) == 'tpelement_accordion' ) {
		require_once( __DIR__ . '/widgets/accordion/accordion.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Widget_Accordion() );
		}

		//Newsletter
        if( isset( $tpelements_addon_setting['tp_newsletter_setting'] ) == 'tpelement_newsletter' ){
		require_once( __DIR__ . '/widgets/mailchimp/mailchimp.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Mailchimp_Widget() );
		}

		//Marquee
        if( isset( $tpelements_addon_setting['tp_marquee_setting'] ) == 'tpelement_marquee' ){
		require_once( __DIR__ . '/widgets/marquee/marquee.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_Pro_Marquee_Widget() );
		}
		
		//Timeline
        if( isset( $tpelements_addon_setting['tp_timeline_setting'] ) == 'tpelement_timeline' ){
		require_once( __DIR__ . '/widgets/timeline/timeline.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Timeline_Showcase_Widget() );
		}

		//Feature Image
        if( isset( $tpelements_addon_setting['tp_featured_image_setting'] ) == 'tpelement_featured_image' ){
		require_once( __DIR__ . '/widgets/featured-image/image.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Featured_Image_Showcase_Widget() );
		}
	
		//Site Logo
        if( isset( $tpelements_addon_setting['tp_site_logo_setting'] ) == 'tpelement_site_logo' ){
		require_once( __DIR__ . '/widgets/header-footer/site-logo.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Site_Logo() );	

		}
			
		//Site Search
        if( isset( $tpelements_addon_setting['tp_site_search_setting'] ) == 'tpelement_site_search' ){
		require_once( __DIR__ . '/widgets/header-footer/site-search.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Search_Button() );	

		}

		//Site Canvas
        if( isset( $tpelements_addon_setting['tp_site_canvas_setting'] ) == 'tpelement_site_canvas' ){
		require_once( __DIR__ . '/widgets/header-footer/site-canvas.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Offcanvas() );	

		}

		//Site Navigation
        if( isset( $tpelements_addon_setting['tp_site_navigation_setting'] ) == 'tpelement_site_navigation' ){
		require_once( __DIR__ . '/widgets/header-footer/site-nav.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Navigation_Menu() );	

		}

		//Scroll To Top
        if( isset( $tpelements_addon_setting['tp_scroll_to_top_setting'] ) == 'tpelement_scroll_to_top' ){
		require_once( __DIR__ . '/widgets/header-footer/scroll-to-top.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_Scroll_To_Top_Widget() );	

		}

		//Single Page Navigation
        if( isset( $tpelements_addon_setting['tp_single_navigation_setting'] ) == 'tpelement_single_navigation' ){
		require_once( __DIR__ . '/widgets/header-footer/single-page-nav.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Single_Navigation_Menu() );	

		}

		//Copyright
        if( isset( $tpelements_addon_setting['tp_copyright_setting'] ) == 'tpelement_copyright' ){
		require_once( __DIR__ . '/widgets/header-footer/copyright.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_Copyright_Widget() );

		}

        require_once( __DIR__ . '/widgets/gallery/gallery-widget.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_pro_Gallery_Widget() );
        
        require_once( __DIR__ . '/widgets/instagram/instagram.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Instagram_Widget() );

        require_once( __DIR__ . '/widgets/table/table.php' );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Pro_Table_Elementor_Widget() );
        

			
		// Register widget				
		add_action( 'elementor/elements/categories_registered', [$this, 'add_category'] );
        add_action( 'elementor/elements/categories_registered', [$this, 'resgister_tpaddon_category'] );
		add_action( 'elementor/elements/categories_registered', [$this, 'resgister_header_footer_category'] );
		
	}
}
TPelements_Elementor_Extension::instance();