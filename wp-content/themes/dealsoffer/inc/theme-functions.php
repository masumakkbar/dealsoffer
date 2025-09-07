<?php
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function dealsoffer_body_classes( $classes ) {
  // Adds a class of hfeed to non-singular pages.
  if ( ! is_singular() ) {
    $classes[] = 'hfeed';
  }

  return $classes;
}
add_filter( 'body_class', 'dealsoffer_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function dealsoffer_pingback_header() {
  if ( is_singular() && pings_open() ) {
    echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
  }
}

add_action( 'wp_head', 'dealsoffer_pingback_header' );
/**  kses_allowed_html */
function dealsoffer_prefix_kses_allowed_html($tags, $context) {
  switch($context) {
    case 'dealsoffer': 
      $tags = array( 
        'a' => array('href' => array()),
        'b' => array()
      );
      return $tags;
    default: 
      return $tags;
  }
}
add_filter( 'wp_kses_allowed_html', 'dealsoffer_prefix_kses_allowed_html', 10, 2);

/*
Register Fonts theme google font
*/
function dealsoffer_studio_fonts_url() {
    $font_url = '';
    
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'dealsoffer' ) ) {
        $font_url = 'https://fonts.googleapis.com/css2?' . urlencode('family=Space+Grotesk:wght@300;400;500;600;700&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');
    }
    return $font_url;
}

function dealsoffer_studio_scripts() {
    wp_enqueue_style( 'dealsoffer-fonts', dealsoffer_studio_fonts_url(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'dealsoffer_studio_scripts' );

//Favicon Icon
function dealsoffer_site_icon() {
 if ( ! ( function_exists( 'has_site_icon' ) && has_site_icon() ) ) {     
    global $dealsoffer_option;
     
    if(!empty($dealsoffer_option['tp_favicon']['url']))
    {?>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url(($dealsoffer_option['tp_favicon']['url'])); ?>"> 
  <?php 
    }
  }
}
add_filter('wp_head', 'dealsoffer_site_icon');


//excerpt for specific section
function dealsoffer_wpex_get_excerpt( $args = array() ) {
  // Defaults
  $defaults = array(
    'post'            => '',
    'length'          => 48,
    'readmore'        => false,
    'readmore_text'   => esc_html__( 'Read More', 'dealsoffer' ),
    'readmore_after'  => '',
    'custom_excerpts' => true,
    'disable_more'    => false,
  );
  // Apply filters
  $defaults = apply_filters( 'dealsoffer_wpex_get_excerpt_defaults', $defaults );
  // Parse args
  $args = wp_parse_args( $args, $defaults );
  // Apply filters to args
  $args = apply_filters( 'dealsoffer_wpex_get_excerpt_args', $defaults );
  // Extract
  extract( $args );
  // Get global post data
  if ( ! $post ) {
    global $post;
  }

  $post_id = $post->ID;
  if ( $custom_excerpts && has_excerpt( $post_id ) ) {
    $output = $post->post_excerpt;
  } 
  else { 
    $readmore_link = '<a href="' . get_permalink( $post_id ) . '" class="readmore">' . $readmore_text . $readmore_after . '</a>';    
    if ( ! $disable_more && strpos( $post->post_content, '<!--more-->' ) ) {
      $output = apply_filters( 'the_content', get_the_content( $readmore_text . $readmore_after ) );
    }    
    else {     
      $output = wp_trim_words( strip_shortcodes( $post->post_content ), $length );      
      if ( $readmore ) {
        $output .= apply_filters( 'dealsoffer_wpex_readmore_link', $readmore_link );
      }
    }
  }
  // Apply filters and echo
  return apply_filters( 'dealsoffer_wpex_get_excerpt', $output );
}

//Demo content file include here
function dealsoffer_import_files() {
  return array(
    array(
      'import_file_name'           => 'Dealsoffer Default Demo',
      'categories'                 => array( 'Main Demo' ),
      'import_file_url'            => 'https://dealsoffer.themephi.net/source/demo-data/dealsoffer-content.xml', 
             
      'import_redux'               => array(
        array(
          'file_url'               => 'https://dealsoffer.themephi.net/source/demo-data/dealsoffer-options.json',
          'option_name'            => 'dealsoffer_option',
        ),
      ),

      'import_preview_image_url'   => 'https://dealsoffer.themephi.net/wp-content/uploads/2025/02/screenshot.png',
     'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'dealsoffer' ),
      'preview_url'                => 'https://dealsoffer.themephi.net/',     
      
    ),

  );
}

add_filter( 'pt-ocdi/import_files', 'dealsoffer_import_files' );

function dealsoffer_after_import_setup($selected_import) {
  // Assign menus to their locations.
	$main_menu     = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
  $menu_single     = get_term_by( 'name', 'Onepage Menu', 'nav_menu' );
	set_theme_mod( 'nav_menu_locations', array(
      'menu-1' => $main_menu->term_id, 
      'menu-2' => $menu_single->term_id,      
    )
  );
  if ( 'Dealsoffer Default Demo' == $selected_import['import_file_name'] ) {

    $front_page_id = get_page_by_title('Main Home');

  }

  $blog_page_id  = get_page_by_title( 'News & Media' );
  update_option( 'show_on_front', 'page' );
  update_option( 'page_on_front', $front_page_id->ID );
  update_option( 'page_for_posts', $blog_page_id->ID ); 

  //Import Revolution Slider
  if ( class_exists( 'RevSlider' ) ) {
    $slider_array = array(

      get_template_directory()."/inc/demo-data/sliders/coupon-slider.zip",   

    );
    $slider = new RevSlider();
    foreach($slider_array as $filepath){
      $slider->importSliderFromPost(true,true,$filepath);  
    }
  }
  
}
add_action( 'pt-ocdi/after_import', 'dealsoffer_after_import_setup' );

add_filter( 'use_widgets_block_editor', '__return_false' );


update_option('elementor_disable_color_schemes', 'yes');
update_option('elementor_disable_typography_schemes', 'yes');


/* Coupons Store Functions */