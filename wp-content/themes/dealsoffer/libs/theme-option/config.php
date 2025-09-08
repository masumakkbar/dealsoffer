<?php

/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if (!class_exists('Redux')) {
    return;
}

// This is your option name where all the Redux data is stored.
$opt_name = "dealsoffer_option";

// This line is only for altering the demo. Can be easily removed.
$opt_name = apply_filters('dealsoffer/opt_name', $opt_name);

/*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name'             => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name'         => $theme->get('Name'),
    // Name that appears at the top of your panel
    'display_version'      => $theme->get('Version'),
    // Version that appears at the top of your panel
    'menu_type'            => 'menu',
    'page_priority'        => 8,
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'       => true,
    // Show the sections below the admin menu item or not
    'menu_title'           => esc_html__('Dealsoffer Options', 'dealsoffer'),
    'page_title'           => esc_html__('Dealsoffer Options', 'dealsoffer'),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key'       => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography'     => true,
    // Use a asynchronous font on the front end or font string
    // Disable this in case you want to create your own google fonts loader
    'admin_bar'            => false,
    // Show the panel pages on the admin bar
    'admin_bar_icon'       => 'dashicons-portfolio',
    // Choose an icon for the admin bar menu
    'admin_bar_priority'   => 20,
    // Choose an priority for the admin bar menu
    'global_variable'      => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode'             => false,
    'forced_dev_mode_off' => true,
    // Show the time the page took to load, etc
    'update_notice'        => true,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer'           => true,
    'compiler' => true,

    // OPTIONAL -> Give you extra features
    'page_priority'        => 20,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent'          => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'     => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon'            => '',
    // Specify a custom URL to an icon
    'last_tab'             => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon'            => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug'            => '',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults'        => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show'         => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark'         => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export'   => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag'           => true,
    'force_output' => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database'             => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn'              => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    // HINTS
    'hints'                => array(
        'icon'          => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     => array(
            'color'   => 'red',
            'shadow'  => true,
            'rounded' => false,
            'style'   => '',
        ),
        'tip_position'  => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect'    => array(
            'show' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseover',
            ),
            'hide' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'click mouseleave',
            ),
        ),
    )
);

// Panel Intro text -> before the form
if (!isset($args['global_variable']) || $args['global_variable'] !== false) {
    if (!empty($args['global_variable'])) {
        $v = $args['global_variable'];
    } else {
        $v = str_replace('-', '_', $args['opt_name']);
    }
    $args['intro_text'] = sprintf(esc_html__('Dealsoffer Theme', 'dealsoffer'), $v);
} else {
    $args['intro_text'] = esc_html__('Dealsoffer Theme', 'dealsoffer');
}

Redux::setArgs($opt_name, $args);

/*
 * ---> END ARGUMENTSdealsoffer  
*/
// -> START General Settings
Redux::setSection(
    $opt_name,
    array(
        'title'            => esc_html__('General Settings', 'dealsoffer'),
        'id'               => 'basic-checkbox',
        'customizer_width' => '450px',
        'fields'           => array(

            array(
                'id'       => 'enable_global',
                'type'     => 'switch',
                'title'    => esc_html__('Enable Global Settings', 'dealsoffer'),
                'subtitle' => esc_html__('If you enable global settings all option will be work only theme option', 'dealsoffer'),
                'default'  => false,
            ),

            array(
                'id'       => 'container_size',
                'title'    => esc_html__('Container Size', 'dealsoffer'),
                'subtitle' => esc_html__('Container Size example(1350px)', 'dealsoffer'),
                'type'     => 'text',
                'default'  => '1320px'
            ),

            array(
                'id'       => 'tp_favicon',
                'type'     => 'media',
                'title'    => esc_html__('Upload Favicon', 'dealsoffer'),
                'subtitle' => esc_html__('Upload your faviocn here', 'dealsoffer'),
                'url' => true
            ),

            array(
                'id'       => 'off_sticky',
                'type'     => 'switch',
                'title'    => esc_html__('Enable Sticky Menu', 'dealsoffer'),
                'subtitle' => esc_html__('You can show or hide sticky menu here', 'dealsoffer'),
                'default'  => false,
            ),  
            array(
                'id'       => 'show_top_bottom',
                'type'     => 'switch', 
                'title'    => esc_html__('Scroll to Top', 'dealsoffer'),
                'subtitle' => esc_html__('You can show or hide here', 'dealsoffer'),
                'default'  => false,
            ),         
        )
    )
);


//Preloader settings
Redux::setSection(
    $opt_name,
    array(
        'title'  => esc_html__('Preloader Style', 'dealsoffer'),
        'desc'   => esc_html__('Preloader Style Here', 'dealsoffer'),
        'fields' => array(
            array(
                'id'       => 'show_preloader',
                'type'     => 'switch',
                'title'    => esc_html__('Show Preloader', 'dealsoffer'),
                'subtitle' => esc_html__('You can show or hide preloader', 'dealsoffer'),
                'default'  => false,
            ),

            array(
                'id'        => 'preloader_bg_color',
                'type'      => 'color',
                'title'     => esc_html__('Preloader Background Color', 'dealsoffer'),
                'subtitle'  => esc_html__('Pick color', 'dealsoffer'),
                'default'   => '#F8FAFF',
                'validate'  => 'color',
            ),
           

            array(
                'id'        => 'preloader_animate_color2',
                'type'      => 'color',
                'title'     => esc_html__('Preloader Circle Color', 'dealsoffer'),
                'subtitle'  => esc_html__('Pick color', 'dealsoffer'),
                'default'   => '#7D25EC',
                'validate'  => 'color',
                'output'    => array('background' => '.lds-ellipsis div')
            ),

          
            array(
                'id'    => 'preloader_img',
                'url'   => true,
                'title' => esc_html__('Preloader Image', 'dealsoffer'),
                'type'  => 'media',
            ),
        )
    )
);
//End Preloader settings 

// -> START Style Section
Redux::setSection($opt_name, array(
    'title'            => esc_html__('Style', 'dealsoffer'),
    'id'               => 'stle',
    'customizer_width' => '450px',
    'icon' => 'el el-brush',
));

Redux::setSection(
    $opt_name,
    array(
        'title'  => esc_html__('Global Style', 'dealsoffer'),
        'desc'   => esc_html__('Style your theme', 'dealsoffer'),
        'subsection' => true,
        'fields' => array(

            array(
                'id'        => 'body_bg_color',
                'type'      => 'color',
                'title'     => esc_html__('Body Backgroud Color', 'dealsoffer'),
                'subtitle'  => esc_html__('Pick body background color', 'dealsoffer'),
                'default'   => '#ffffff',
                'validate'  => 'color',
            ),

            array(
                'id'        => 'body_text_color',
                'type'      => 'color',
                'title'     => esc_html__('Text Color', 'dealsoffer'),
                'subtitle'  => esc_html__('Pick text color', 'dealsoffer'),
                'default'   => '#7F879E',
                'validate'  => 'color',
            ),

            array(
                'id'        => 'primary_color',
                'type'      => 'color',
                'title'     => esc_html__('Primary Color', 'dealsoffer'),
                'subtitle'  => esc_html__('Select Primary Color.', 'dealsoffer'),
                'default'   => '#7D25EC',
                'validate'  => 'color',
                'output'      => array('.themephi-heading .title-inner .sub-text,  .menu-area .navbar ul li:hover a'),
            ),

            array(
                'id'        => 'secondary_color',
                'type'      => 'color',
                'title'     => esc_html__('Secondary Color', 'dealsoffer'),
                'subtitle'  => esc_html__('Select Secondary Color.', 'dealsoffer'),
                'default'   => '#FE424B',
                'validate'  => 'color',
            ),

            array(
                'id'        => 'link_text_color',
                'type'      => 'color',
                'title'     => esc_html__('Link Color', 'dealsoffer'),
                'subtitle'  => esc_html__('Pick Link color', 'dealsoffer'),
                'default'   => '#7F879E',
                'validate'  => 'color',
            ),

            array(
                'id'        => 'link_hover_text_color',
                'type'      => 'color',
                'title'     => esc_html__('Link Hover Color', 'dealsoffer'),
                'subtitle'  => esc_html__('Pick link hover color', 'dealsoffer'),
                'default'   => '#7D25EC',
                'validate'  => 'color',
            ),

        )
    )
);


//Button settings
Redux::setSection(
    $opt_name,
    array(
        'title'      => esc_html__('Button Style', 'dealsoffer'),
        'desc'       => esc_html__('Button Style Here', 'dealsoffer'),
        'subsection' => true,
        'fields' => array(

            array(
                'id'        => 'btn_bg_color',
                'type'      => 'color',
                'title'     => esc_html__('Background Color', 'dealsoffer'),
                'subtitle'  => esc_html__('Pick color', 'dealsoffer'),
                'default'   => '#7D25EC',
                'validate'  => 'color',
                'output'    => array('background-color' => '.themephi-button a')
            ),

            array(
                'id'        => 'btn_bg_hover',
                'type'      => 'color',
                'title'     => esc_html__('Hover Background', 'dealsoffer'),
                'subtitle'  => esc_html__('Pick color', 'dealsoffer'),
                'default'   => '#FE424B',
                'validate'  => 'color',
                'output'    => array('background' => '.themephi-button a:hover::before')

            ),          

            array(
                'id'        => 'btn_text_color',
                'type'      => 'color',
                'title'     => esc_html__('Text Color', 'dealsoffer'),
                'subtitle'  => esc_html__('Pick color', 'dealsoffer'),
                'default'   => '#ffffff',
                'validate'  => 'color',
                'output'    => array('.themephi-button a')
            ),

            array(
                'id'        => 'btn_txt_hover_color',
                'type'      => 'color',
                'title'     => esc_html__('Hover Text Color', 'dealsoffer'),
                'subtitle'  => esc_html__('Pick color', 'dealsoffer'),
                'default'   => '#ffffff',
                'validate'  => 'color',
                'output'    => array('.themephi-button a:hover')
            ),

            array(
                'id'     => 'notice_critical',
                'type'   => 'info',
                'notice' => true,
                'style'  => 'success',
                'title'  => esc_html__('Seconday Button Style', 'dealsoffer')            
            ),
            array(
                'id'        => 'btn2_bg_color',
                'type'      => 'color',
                'title'     => esc_html__('Background Color', 'dealsoffer'),
                'subtitle'  => esc_html__('Pick color', 'dealsoffer'),
                'default'   => '#FE424B',
                'validate'  => 'color',
                'output'    => array('background-color' => '.themephi-button.secondary_btn a')
            ),

            array(
                'id'        => 'btn2_bg_hover',
                'type'      => 'color',
                'title'     => esc_html__('Hover Background', 'dealsoffer'),
                'subtitle'  => esc_html__('Pick color', 'dealsoffer'),
                'default'   => '#7D25EC',
                'validate'  => 'color',
                'output'    => array('background' => '.themephi-button.secondary_btn a:after')

            ),
            
            array(
                'id'        => 'btn2_text_color',
                'type'      => 'color',
                'title'     => esc_html__('Text Color', 'dealsoffer'),
                'subtitle'  => esc_html__('Pick color', 'dealsoffer'),
                'default'   => '#ffffff',
                'validate'  => 'color',
                'output'    => array('.themephi-button.secondary_btn a')
            ),

            array(
                'id'        => 'btn2_txt_hover_color',
                'type'      => 'color',
                'title'     => esc_html__('Hover Text Color', 'dealsoffer'),
                'subtitle'  => esc_html__('Pick color', 'dealsoffer'),
                'default'   => '#ffffff',
                'validate'  => 'color',
                'output'    => array('.themephi-button.secondary_btn a:after')
            ),
        )
    )
);


//Breadcrumb settings
Redux::setSection(
    $opt_name,
    array(
        'title'  => esc_html__('Breadcrumb Style', 'dealsoffer'),
        'subsection' => true,
        'fields' => array(

            array(
                'id'       => 'off_breadcrumb',
                'type'     => 'switch',
                'title'    => esc_html__('Show off Breadcrumb', 'dealsoffer'),
                'subtitle' => esc_html__('You can show or hide off breadcrumb here', 'dealsoffer'),
                'default'  => true,
            ),

            array(
                'id'      => 'align_breadcrumb',
                'type'    => 'select',
                'title'    => esc_html__('Breadcrumb Alignment', 'dealsoffer'),
                'default'  => 'start',
                'options' => array(
                    'start' => __( 'Left', 'dealsoffer' ),
                    'center'   => __( 'Center', 'dealsoffer' ),
                    'end'     => __( 'Right', 'dealsoffer' ),
                ),
                'required'         => array('off_breadcrumb', '=', '1'),
            ),

            array(
                'id'        => 'breadcrumb_bg_color',
                'type'      => 'color',
                'title'     => esc_html__('Background Bg Color', 'dealsoffer'),
                'subtitle'  => esc_html__('Pick color', 'dealsoffer'),
                'default'   => '#EFF3FD',
                'validate'  => 'color',
                'required'         => array('off_breadcrumb', '=', '1'),
            ),  

            array(
                'id'       => 'enable_breadcrumb_title',
                'type'     => 'switch',
                'title'    => esc_html__('Enable Breadcrumb Title ?', 'deala'),
                'subtitle' => esc_html__('You can show or hide off breadcrumb title', 'deala'),
                'default'  => false,
                'required'         => array('off_breadcrumb', '=', '1'),
            ),
            array(
                'id'        => 'page_title_color',
                'type'      => 'color',
                'title'     => esc_html__('Banner Title Color', 'dealsoffer'),
                'subtitle'  => esc_html__('Pick color', 'dealsoffer'),
                'default'   => '#1B2A52',
                'validate'  => 'color',     
                'required'         => array(
                    array('off_breadcrumb', '=', '1'),
                    array('enable_breadcrumb_title', '=', '1'),
                ),
            ),

            array(
                'id'          => 'opt-typography',
                'type'        => 'typography', 
                'title'       => __('Banner Title Typography', 'dealsoffer'),    
                'output'      => array('.themephi-breadcrumbs .page-title'),
                'units'       =>'px',
                'subtitle'    => __('Typography option with each property can be called individually.', 'dealsoffer'),
                'required'         => array(
                    array('off_breadcrumb', '=', '1'),
                    array('enable_breadcrumb_title', '=', '1'),
                ),               
            ),

            array(
                'id'       => 'page_banner_main',
                'type'     => 'media',
                'title'    => esc_html__('Background Banner', 'dealsoffer'),
                'subtitle' => esc_html__('Upload your banner', 'dealsoffer'),
                // 'default' => [
                //     'url' => get_template_directory_uri() . '/assets/images/breadcrum_bg.png',
                // ],
                'url'      => true, // Allow URL upload
                'preview'  => true, // Enable preview of the image
                'required'         => array('off_breadcrumb', '=', '1'),
            ),

            array(
                'id'        => 'breadcrumb_top_gap',
                'type'      => 'text',
                'title'     => esc_html__('Top Gap', 'dealsoffer'),
                'desc'    => esc_html__('Type ex: 25px', 'dealsoffer'),
                'required'         => array('off_breadcrumb', '=', '1'),

            ),
            array(
                'id'        => 'breadcrumb_bottom_gap',
                'type'      => 'text',
                'title'     => esc_html__('Bottom Gap', 'dealsoffer'),
                'desc'    => esc_html__('Type ex: 35px', 'dealsoffer'),
                'required'         => array('off_breadcrumb', '=', '1'),
            ),
            array(
                'id'        => 'breadcrumb_position',
                'type'      => 'text',
                'title'     => esc_html__('Top Space', 'dealsoffer'),  
                'required'         => array('off_breadcrumb', '=', '1'),              
            ),

        )
    )
);
//-> START Typography
Redux::setSection(
    $opt_name,
    array(
        'title'  => esc_html__('Typography', 'dealsoffer'),
        'id'     => 'typography',
        'desc'   => esc_html__('You can specify your body and heading font here', 'dealsoffer'),
        'icon'   => 'el el-font',
        'fields' => array(
            array(
                'id'       => 'opt-typography-body',
                'type'     => 'typography',
                'title'    => esc_html__('Body Font', 'dealsoffer'),
                'subtitle' => esc_html__('Specify the body font properties.', 'dealsoffer'),
                'google'   => true,
                'font-style' => false,
                'default'  => array(
                    'font-size'   => '16px',
                    'font-weight' => '400',
                ),
            ),
            array(
                'id'       => 'opt-typography-menu',
                'type'     => 'typography',
                'title'    => esc_html__('Navigation Font', 'dealsoffer'),
                'subtitle' => esc_html__('Specify the menu font properties.', 'dealsoffer'),
                'google'   => true,
                'font-backup' => true,
                'all_styles'  => true,
                'default'  => array(
                    'color'       => '',
                    'font-family' => '',
                    'google'      => true,
                    'font-size'   => '15px',
                    'font-weight' => '500',
                ),
            ),
            array(
                'id'          => 'opt-typography-h1',
                'type'        => 'typography',
                'title'       => esc_html__('Heading H1', 'dealsoffer'),
                'font-backup' => true,
                'all_styles'  => true,
                'units'       => 'px',
                'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'dealsoffer'),
                'default'     => array(
                    'color'       => '#1B2A52',
                    'font-style'  => '700',
                    'font-family' => '',
                    'google'      => true,
                    'font-size'   => '48px',
                    'line-height' => ''

                ),
            ),
            array(
                'id'          => 'opt-typography-h2',
                'type'        => 'typography',
                'title'       => esc_html__('Heading H2', 'dealsoffer'),
                'font-backup' => true,
                'all_styles'  => true,
                'units'       => 'px',
                'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'dealsoffer'),
                'default'     => array(
                    'color'       => '#1B2A52',
                    'font-style'  => '700',
                    'font-family' => '',
                    'google'      => true,
                    'font-size'   => '38px',
                    'line-height' => ''

                ),
            ),
            array(
                'id'          => 'opt-typography-h3',
                'type'        => 'typography',
                'title'       => esc_html__('Heading H3', 'dealsoffer'),
                'units'       => 'px',
                'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'dealsoffer'),
                'default'     => array(
                    'color'       => '#1B2A52',
                    'font-style'  => '700',
                    'font-family' => '',
                    'google'      => true,
                    'font-size'   => '28px',
                    'line-height' => ''

                ),
            ),
            array(
                'id'          => 'opt-typography-h4',
                'type'        => 'typography',
                'title'       => esc_html__('Heading H4', 'dealsoffer'),
                'font-backup' => false,
                'all_styles'  => true,
                'units'       => 'px',
                'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'dealsoffer'),
                'default'     => array(
                    'color'       => '#1B2A52',
                    'font-style'  => '700',
                    'font-family' => '',
                    'google'      => true,
                    'font-size'   => '22px',
                    'line-height' => ''
                ),
            ),
            array(
                'id'          => 'opt-typography-h5',
                'type'        => 'typography',
                'title'       => esc_html__('Heading H5', 'dealsoffer'),
                'font-backup' => false,
                'all_styles'  => true,
                'units'       => 'px',
                'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'dealsoffer'),
                'default'     => array(
                    'color'       => '#1B2A52',
                    'font-style'  => '700',
                    'font-family' => '',
                    'google'      => true,
                    'font-size'   => '18px',
                    'line-height' => ''
                ),
            ),
            array(
                'id'          => 'opt-typography-6',
                'type'        => 'typography',
                'title'       => esc_html__('Heading H6', 'dealsoffer'),

                'font-backup' => false,
                'all_styles'  => true,
                'units'       => 'px',
                'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'dealsoffer'),
                'default'     => array(
                    'color'       => '#1B2A52',
                    'font-style'  => '700',
                    'font-family' => '',
                    'google'      => true,
                    'font-size'   => '16px',
                    'line-height' => ''
                ),
            ),

        )
    )

);

//-> START Woocommerce
if (class_exists('WooCommerce')) {
    Redux::setSection(
        $opt_name,
        array(
            'title'  => esc_html__('Woocommerce', 'dealsoffer'),
            'icon'   => 'el el-shopping-cart',
        )
    );

    Redux::setSection(
        $opt_name,
        array(
            'title'            => esc_html__('Shop', 'dealsoffer'),
            'id'               => 'shop_layout',
            'customizer_width' => '450px',
            'subsection' => true,
            'fields'           => array(
                array(
                    'id'       => 'shop_banner',
                    'url'      => true,
                    'title'    => esc_html__('Shop page banner', 'dealsoffer'),
                    'type'     => 'media',
                ),
                array(
                    'id'       => 'shop-long-title',
                    'url'      => true,
                    'title'    => esc_html__('Shop Long Title', 'dealsoffer'),
                    'type'     => 'text',
                ),
                array(
                    'id'       => 'shop-layout',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Select Shop Layout', 'dealsoffer'),
                    'subtitle' => esc_html__('Select your shop layout', 'dealsoffer'),
                    'options'  => array(
                        'full'      => array(
                            'alt'   => esc_html__('Shop Style 1', 'dealsoffer'),
                            'img'   => get_template_directory_uri() . '/libs/img/1c.png'
                        ),
                        'right-col' => array(
                            'alt'   => esc_html__('Shop Style 2', 'dealsoffer'),
                            'img'   => get_template_directory_uri() . '/libs/img/2cr.png'
                        ),
                        'left-col'  => array(
                            'alt'   => esc_html__('Shop Style 3', 'dealsoffer'),
                            'img'   => get_template_directory_uri() . '/libs/img/2cl.png'
                        ),
                    ),
                    'default' => 'full'
                ),

                array(
                    'id'       => 'wc_num_product',
                    'type'     => 'text',
                    'title'    => esc_html__('Number of Products Per Page', 'dealsoffer'),
                    'default'  => '9',
                ),

                array(
                    'id'       => 'wc_num_product_per_row',
                    'type'     => 'text',
                    'title'    => esc_html__('Number of Products Per Row', 'dealsoffer'),
                    'default'  => '3',
                ),

                array(
                    'id'       => 'wc_cart_icon',
                    'type'     => 'switch',
                    'title'    => esc_html__('Cart Icon Show At Menu Area', 'dealsoffer'),
                    'on'       => esc_html__('Enabled', 'dealsoffer'),
                    'off'      => esc_html__('Disabled', 'dealsoffer'),
                    'default'  => false,
                ),

                array(
                    'id'       => 'disable-sidebar',
                    'type'     => 'switch',
                    'title'    => esc_html__('Sidebar Disable For Single Product Page', 'dealsoffer'),
                    'default'  => true,
                ),

                array(
                    'id'       => 'wc_wishlist_icon',
                    'type'     => 'switch',
                    'title'    => esc_html__('Show Wishlist Icon', 'dealsoffer'),
                    'on'       => esc_html__('Enabled', 'dealsoffer'),
                    'off'      => esc_html__('Disabled', 'dealsoffer'),
                    'default'  => true,
                ),
                array(
                    'id'       => 'wc_quickview_icon',
                    'type'     => 'switch',
                    'title'    => esc_html__('Product Quickview Icon', 'dealsoffer'),
                    'on'       => esc_html__('Enabled', 'dealsoffer'),
                    'off'      => esc_html__('Disabled', 'dealsoffer'),
                    'default'  => true,
                ),
                array(
                    'id'       => 'wc_show_new',
                    'type'     => 'switch',
                    'title'    => esc_html__('Show Product New Badge', 'dealsoffer'),
                    'on'       => esc_html__('Enabled', 'dealsoffer'),
                    'off'      => esc_html__('Disabled', 'dealsoffer'),
                    'default'  => true,
                ),

                array(
                    'id'       => 'wc_new_product_days',
                    'type'     => 'select',
                    'title'    => esc_html__('New Days', 'dealsoffer'),
                    'desc'     => esc_html__('Select last day, when uploaded products will show a new badge.', 'dealsoffer'),
                    'options'  => array(
                        '7'     => esc_html__('7 Days', 'dealsoffer'),
                        '10' => esc_html__('10 Days', 'dealsoffer'),
                        '15' => esc_html__('15 Days', 'dealsoffer'),
                        '30' => esc_html__('30 Days', 'dealsoffer'),
                    ),
                    'default'  => '15',

                ),

            )
        )
    );
    Redux::setSection(
        $opt_name,
        array(
            'title'            => esc_html__('Shop Single', 'dealsoffer'),
            'id'               => 'shop_single',
            'customizer_width' => '450px',
            'subsection' => true,
            'fields'           => array(

                array(
                    'id'       => 'single-gallery-layout',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Single Product Gallery Layout', 'dealsoffer'),
                    'subtitle' => esc_html__('Select single page gallery layout', 'dealsoffer'),
                    'options'  => array(
                        'default-thumb'      => array(
                            'alt'   => esc_html__('Style 1', 'dealsoffer'),
                            'img'   => get_template_directory_uri() . '/libs/img/1c.png'
                        ),
                        'right-thumb' => array(
                            'alt'   => esc_html__('Style 2', 'dealsoffer'),
                            'img'   => get_template_directory_uri() . '/libs/img/2cr.png'
                        ),
                        'left-thumb'  => array(
                            'alt'   => esc_html__('Style 3', 'dealsoffer'),
                            'img'   => get_template_directory_uri() . '/libs/img/2cl.png'
                        ),
                    ),
                    'default' => 'default-thumb'
                ),

                array(
                    'id'       => 'single_releted_products',
                    'type'     => 'text',
                    'title'    => esc_html__('Number of Releted Products in Product detail Page', 'dealsoffer'),
                    'default'  => '4',
                ),
                array(
                    'id'       => 'single_releted_products_col',
                    'type'     => 'text',
                    'title'    => esc_html__('Coloumn Number of Releted Products in Product detail Page', 'dealsoffer'),
                    'default'  => '4',
                ),

            )
        )
    );
}

// Coupons Section Settings Start 
Redux::setSection(
    $opt_name,
    array(
        'title'  => esc_html__('Coupons Section Settings', 'dealsoffer'),
        'icon'   => 'el el-align-right',
    )
);

Redux::setSection(
    $opt_name,
    array(
        'title'            => esc_html__('Coupons', 'dealsoffer'),
        'id'               => 'coupons_layout',
        'customizer_width' => '450px',
        'subsection' => true,
        'fields'           => array(

            array(
                'id'       => 'coupon_single_image', 
                'url'      => true,     
                'title'    => esc_html__( 'Coupons Single page banner image', 'dealsoffer' ),                    
                'type'     => 'media',
                
            ),  
    
            array(
                'id'        => 'coupons_bg_color',
                'type'      => 'color',
                'title'     => esc_html__('Project Information Area Background', 'dealsoffer'),
                'subtitle'  => esc_html__('Pick color', 'dealsoffer'),
                'default'   => '#ffffff',
                'validate'  => 'color',
                'output'    => array('background' => '.big-bg-porduct-details .project-info')
            ),
            array(
                'id'        => 'coupons_bg_border_color',
                'type'      => 'color_rgba',
                'title'     => esc_html__('Project Information Border Color', 'dealsoffer'),
                'subtitle'  => esc_html__('Pick color', 'dealsoffer'),
                'output'    => array('border-color' => '.big-bg-porduct-details .project-info .info-body .single-info')
            ),


            /* coupont fields start  */

            array(
                'id'        => 'coupon_listing_style',
                'type'      => 'select',
                'options'   => array(
                    'list'      => esc_html__( 'List', 'dealsoffer' ),
                    'grid'      => esc_html__( 'Grid', 'dealsoffer' ),
                ),
                'title'     => esc_html__('Coupon Listing Type', 'dealsoffer') ,
                'desc'      => esc_html__('Select style of the coupon boxes in listings', 'dealsoffer'),
                'default'   => 'list'
            ),
            array(
                'id'        => 'coupon_listing_image',
                'type'      => 'select',
                'options'   => array(
                    'store'         => esc_html__( 'Store Logo', 'dealsoffer' ),
                    'featured'      => esc_html__( 'Featured Logo', 'dealsoffer' ),
                ),
                'title'     => esc_html__('Coupon Listing Image', 'dealsoffer') ,
                'desc'      => esc_html__('Select which image to show on coupon listing ( Featured falls back to Store logo )', 'dealsoffer'),
                'default'   => 'store'
            ),
            array(
                'id'        => 'coupons_per_page',
                'type'      => 'text',
                'title'     => esc_html__('Coupons Per Page', 'dealsoffer') ,
                'desc'      => esc_html__('Input how many coupons per page to display on listing', 'dealsoffer'),
                'default'   => '10'
            ),
            array(
                'id'        => 'expired_stamp',
                'type'      => 'media',
                'title'     => esc_html__('Expired Image', 'dealsoffer') ,
                'desc'      => esc_html__('Select image which will be used as stamp on expired coupons', 'dealsoffer'),
                'default'   => ''
            ),
            array(
                'id'        => 'list_empt_cats_stores',
                'type'      => 'select',
                'options'   => array(
                    'yes' => esc_html__( 'Hide', 'dealsoffer' ),
                    'no' => esc_html__( 'Show', 'dealsoffer' ),
                ),
                'title'     => esc_html__('Hide Empty Stores & Categories', 'dealsoffer') ,
                'desc'      => esc_html__('Enable or disable display of empty categories and stores on their listing', 'dealsoffer'),
                'default'   => 'yes'
            ),
            array(
                'id'        => 'single_coupon_sidebar_pos',
                'type'      => 'select',
                'options'   => array(
                    'right'      => esc_html__( 'Right Sidebar', 'dealsoffer' ),
                    'left'       => esc_html__( 'Left Sidebar', 'dealsoffer' ),
                ),
                'title'     => esc_html__('Coupon Single Sidebar Position', 'dealsoffer') ,
                'desc'      => esc_html__('Select location of the sidebar on coupon single pages', 'dealsoffer'),
                'default'   => 'right'
            ),
            array(
                'id'        => 'single_coupon_similar',
                'type'      => 'select',
                'options'   => array(
                    'yes'      => esc_html__( 'Yes', 'dealsoffer' ),
                    'no'       => esc_html__( 'No', 'dealsoffer' ),
                ),
                'title'     => esc_html__('Show Similar', 'dealsoffer') ,
                'desc'      => esc_html__('Show or hide similar coupons on single coupon pages', 'dealsoffer'),
                'default'   => 'yes'
            ),
            array(
                'id'        => 'time_on_badge',
                'type'      => 'select',
                'options'   => array(
                    'yes'      => esc_html__( 'Yes', 'dealsoffer' ),
                    'no'       => esc_html__( 'No', 'dealsoffer' ),
                ),
                'title'     => esc_html__('Show Time On Boxes', 'dealsoffer') ,
                'desc'      => esc_html__('Show or hide time of expiration on coupon boxes', 'dealsoffer'),
                'default'   => 'no'
            ),                        
            array(
                'id'        => 'single_coupon_similar_number',
                'type'      => 'text',
                'title'     => esc_html__('Number Of Similar', 'dealsoffer') ,
                'desc'      => esc_html__('How many similar coupons to display', 'dealsoffer'),
                'default'   => '5'
            ),
            array(
                'id'        => 'single_coupon_more_from_store',
                'type'      => 'text',
                'title'     => esc_html__('More Coupons From Store', 'dealsoffer') ,
                'desc'      => esc_html__('Show or hide more coupons from same store on coupon single pages. Leave empty to disable', 'dealsoffer'),
            ),
            array(
                'id'        => 'delete_coupon_images',
                'type'      => 'select',
                'options'   => array(
                    'no'      => esc_html__( 'No', 'dealsoffer' ),
                    'yes'       => esc_html__( 'Yes', 'dealsoffer' ),
                ),
                'title'     => esc_html__('Delete Coupon Images', 'dealsoffer') ,
                'desc'      => esc_html__('On coupon delete also remove featured and printable images ( If set to yes image will no longer be available for coupons which share the image', 'dealsoffer'),
                'default'   => 'no'
            ),
            array(
                'id'        => 'delete_store_images',
                'type'      => 'select',
                'options'   => array(
                    'no'      => esc_html__( 'No', 'dealsoffer' ),
                    'yes'       => esc_html__( 'Yes', 'dealsoffer' ),
                ),
                'title'     => esc_html__('Delete Store Images', 'dealsoffer') ,
                'desc'      => esc_html__('On store delete also remove images. ( If set to yes iamge will become unavailable for other coupons / stores which share it )', 'dealsoffer'),
                'default'   => 'no'
            ),
            array(
                'id'        => 'can_submit',
                'type'      => 'select',
                'options'   => array(
                    'yes'       => esc_html__( 'Yes', 'dealsoffer' ),
                    'no'        => esc_html__( 'No', 'dealsoffer' ),
                ),
                'title'     => esc_html__('Can Users Submit Coupons?', 'dealsoffer') ,
                'desc'      => esc_html__('Enable or disable submitting of coupons', 'dealsoffer'),
                'default'   => 'yes'
            ),
            array(
                'id'        => 'coupon_types',
                'type'      => 'select',
                'multi'     => true,
                'options'   => array(
                    '1' => esc_html__( 'Online Codes', 'dealsoffer' ),
                    '2' => esc_html__( 'Store Codes', 'dealsoffer' ),
                    '3' => esc_html__( 'Online Sales', 'dealsoffer' ),
                ),
                'title'     => esc_html__('Coupon Types', 'dealsoffer') ,
                'desc'      => esc_html__('Select which coupon types to display or leave empty to display them all', 'dealsoffer'),
            ),
            array(
                'id'        => 'ajax_taxonomy',
                'type'      => 'select',
                'options'   => array(
                    'yes'   => esc_html__( 'Yes', 'dealsoffer' ),
                    'no'    => esc_html__( 'No', 'dealsoffer' ),
                ),
                'title'     => esc_html__('AJAX Taxonomy', 'dealsoffer') ,
                'desc'      => esc_html__('Enable or disable ajax category/store selection', 'dealsoffer'),
                'default'   => 'no'
            ),
            array(
                'id'        => 'use_coupon_single',
                'type'      => 'select',
                'options'   => array(
                    'yes'   => esc_html__( 'Yes', 'dealsoffer' ),
                    'no'    => esc_html__( 'No', 'dealsoffer' ),
                ),
                'title'     => esc_html__('Coupon Single', 'dealsoffer') ,
                'desc'      => esc_html__('Enable or disable coupon single pages', 'dealsoffer'),
                'default'   => 'yes'
            ),
            array(
                'id'        => 'enable_share',
                'type'      => 'select',
                'options'   => array(
                    'yes'   => esc_html__( 'Yes', 'dealsoffer' ),
                    'no'    => esc_html__( 'No', 'dealsoffer' ),
                ),
                'title'     => esc_html__('Enable Share', 'dealsoffer') ,
                'desc'      => esc_html__('Enable or disable Share on coupons', 'dealsoffer'),
                'default'   => 'yes'
            ), 
            array(
                'id'        => 'enable_comments',
                'type'      => 'select',
                'options'   => array(
                    'yes'   => esc_html__( 'Yes', 'dealsoffer' ),
                    'no'    => esc_html__( 'No', 'dealsoffer' ),
                ),
                'title'     => esc_html__('Enable Comments', 'dealsoffer') ,
                'desc'      => esc_html__('Enable or disable comments on coupons', 'dealsoffer'),
                'default'   => 'yes'
            ), 
            array(
                'id'        => 'delete_account',
                'type'      => 'select',
                'options'   => array(
                    'yes'   => esc_html__( 'Yes', 'dealsoffer' ),
                    'no'    => esc_html__( 'No', 'dealsoffer' ),
                ),
                'title'     => esc_html__('Delete Account ?', 'dealsoffer') ,
                'desc'      => esc_html__('Enable or disable Account', 'dealsoffer'),
                'default'   => 'yes'
            ), 

            /* coupont fields end  */


        )
    )
);
Redux::setSection(
    $opt_name,
    array(
        'title'            => esc_html__('Coupon Slug', 'dealsoffer'),
        'id'               => 'coupons_slug_layout',
        'customizer_width' => '450px',
        'subsection' => true,
        'desc' => esc_html__('Change slugs. After the changes you must go Settings -> Permalinks and resave them ( just click Save Changes button ).', 'dealsoffer'),
        'fields'           => array(
            array(
                'id' => 'trans_coupon',
                'type' => 'text',
                'title' => esc_html__('Coupon Slug', 'dealsoffer') ,
                'desc' => esc_html__('Input slug you want to use for the coupon single page.', 'dealsoffer'),
                'default' => 'offer'
            ),
            array(
                'id' => 'trans_coupon-category',
                'type' => 'text',
                'title' => esc_html__('Coupons Category Slug', 'dealsoffer') ,
                'desc' => esc_html__('Input slug you want to use for the coupon categories.', 'dealsoffer'),
                'default' => 'offer-category'
            ),
            array(
                'id' => 'trans_coupon-store',
                'type' => 'text',
                'title' => esc_html__('Coupons Stores Slug', 'dealsoffer') ,
                'desc' => esc_html__('Input slug you want to use for the coupon stores.', 'dealsoffer'),
                'default' => 'offer-store'
            ),
            array(
                'id' => 'trans_coupon-tag',
                'type' => 'text',
                'title' => esc_html__('Coupons Tags Slug', 'dealsoffer') ,
                'desc' => esc_html__('Input slug you want to use for the coupon tags.', 'dealsoffer'),
                'default' => 'offer-tag'
            ),
        )
    )
);

Redux::setSection(
    $opt_name,
    array(
        'title'            => esc_html__('Coupon Registration', 'dealsoffer'),
        'id'               => 'coupons_registration_layout',
        'customizer_width' => '450px',
        'subsection' => true,
        'desc' => esc_html__('Change as per your requirement', 'dealsoffer'),
        'fields'           => array(

            array(
                'id'      => 'trans_username',
                'type'    => 'text',
                'title'   => __( 'Username Slug', 'dealsoffer' ),
                'desc'    => __( 'Input custom slug for username in the email verification email ( only small letters and underscore ).', 'dealsoffer' ),
                'default' => 'username',
            ),
            array(
                'id'       => 'registration_message',
                'type'     => 'textarea',
                'title'    => __( 'Registration Message', 'dealsoffer' ),
                'compiler' => 'true',
                'desc'     => __( 'Input registration message which will be sent to the users to verify their email address. Put %LINK% in the place you want to show confirmation link.', 'dealsoffer' )
            ),
            array(
                'id'       => 'registration_subject',
                'type'     => 'text',
                'title'    => __( 'Registration Message Subject', 'dealsoffer' ),
                'compiler' => 'true',
                'desc'     => __( 'Input registration message subject.', 'dealsoffer' )
            ),
            array(
                'id'      => 'register_terms',
                'type'    => 'editor',
                'title'   => __( 'Terms & Conditions', 'dealsoffer' ),
                'desc'    => __( 'Input terms and conditions which users must accept in order to register on site .', 'dealsoffer' ),
                'default' => ''
            ),
            array(
                'id'       => 'lost_password_message',
                'type'     => 'textarea',
                'title'    => __( 'Lost Password Message', 'dealsoffer' ),
                'compiler' => 'true',
                'desc'     => __( 'Input lost password message which will be sent to the users to verify their email address. Put %PASSWORD% in the place you want to show new password and put %USERNAME% where to place username.', 'dealsoffer' )
            ),
            array(
                'id'       => 'lost_password_subject',
                'type'     => 'text',
                'title'    => __( 'Lost Password Message Subject', 'dealsoffer' ),
                'compiler' => 'true',
                'desc'     => __( 'Input lost password message subject.', 'dealsoffer' )
            ),
            array(
                'id'       => 'email_sender',
                'type'     => 'text',
                'title'    => __( 'Email Of Sender', 'dealsoffer' ),
                'compiler' => 'true',
                'desc'     => __( 'Input email address you wish to show on the email messages.', 'dealsoffer' )
            ),
            array(
                'id'       => 'name_sender',
                'type'     => 'text',
                'title'    => __( 'Name Of Sender', 'dealsoffer' ),
                'compiler' => 'true',
                'desc'     => __( 'Input name you wish to show on the email messages.', 'dealsoffer' )
            )



        )
    )
);


/*Blog Sections*/
Redux::setSection(
    $opt_name,
    array(
        'title'            => esc_html__('Blog', 'dealsoffer'),
        'id'               => 'blog',
        'customizer_width' => '450px',
        'icon' => 'el el-comment',
    )
);

Redux::setSection(
    $opt_name,
    array(
        'title'            => esc_html__('Blog Settings', 'dealsoffer'),
        'id'               => 'blog-settings',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'    => 'blog_banner_main',
                'url'   => true,
                'title' => esc_html__('Blog Page Banner', 'dealsoffer'),
                'type'  => 'media',
            ),

            array(
                'id'        => 'blog_bg_color',
                'type'      => 'color',
                'title'     => esc_html__('Body Backgroud Color', 'dealsoffer'),
                'subtitle'  => esc_html__('Pick body background color', 'dealsoffer'),
                'default'   => '#ffffff',
                'validate'  => 'color',
            ),

            array(
                'id'       => 'blog_title',
                'title'    => esc_html__('Blog  Title', 'dealsoffer'),
                'subtitle' => esc_html__('Enter Blog  Title Here', 'dealsoffer'),
                'type'     => 'text',
            ),

            array(
                'id'       => 'blog_long_title',
                'title'    => esc_html__('Blog  Long Title', 'dealsoffer'),
                'subtitle' => esc_html__('Enter Blog  Long Title Here', 'dealsoffer'),
                'type'     => 'text',
            ),

            array(
                'id'               => 'blog-layout',
                'type'             => 'image_select',
                'title'            => esc_html__('Select Blog Layout', 'dealsoffer'),
                'subtitle'         => esc_html__('Select your blog layout', 'dealsoffer'),
                'options'          => array(
                    'full'             => array(
                        'alt'              => esc_html__('Blog Style 1', 'dealsoffer'),
                        'img'              => get_template_directory_uri() . '/libs/img/1c.png'
                    ),
                    '2right'           => array(
                        'alt'              => esc_html__('Blog Style 2', 'dealsoffer'),
                        'img'              => get_template_directory_uri() . '/libs/img/2cr.png'
                    ),
                    '2left'            => array(
                        'alt'              => esc_html__('Blog Style 3', 'dealsoffer'),
                        'img'              => get_template_directory_uri() . '/libs/img/2cl.png'
                    ),
                ),
                'default'          => '2right'
            ),

            array(
                'id'               => 'blog-grid',
                'type'             => 'select',
                'title'            => esc_html__('Select Blog Gird', 'dealsoffer'),
                'desc'             => esc_html__('Select your blog gird layout', 'dealsoffer'),
                'options'          => array(
                    '12'               => esc_html__('1 Column', 'dealsoffer'),
                    '6'                => esc_html__('2 Column', 'dealsoffer'),
                    '4'                => esc_html__('3 Column', 'dealsoffer'),
                    '3'                => esc_html__('4 Column', 'dealsoffer'),
                ),
                'default'          => '12',
            ),

            array(
                'id'               => 'blog-author-post',
                'type'             => 'select',
                'title'            => esc_html__('Show Author Info ', 'dealsoffer'),
                'desc'             => esc_html__('Select author info show or hide', 'dealsoffer'),
                'options'          => array(
                    'show'             => esc_html__('Show', 'dealsoffer'),
                    'hide'             => esc_html__('Hide', 'dealsoffer'),
                ),
                'default'          => 'show',

            ),

            array(
                'id'               => 'blog-category',
                'type'             => 'select',
                'title'            => esc_html__('Show Category', 'dealsoffer'),
                'options'          => array(
                    'show'             => esc_html__('Show', 'dealsoffer'),
                    'hide'             => esc_html__('Hide', 'dealsoffer'),
                ),
                'default'          => 'show',

            ),

            array(
                'id'               => 'blog-date',
                'type'             => 'switch',
                'title'            => esc_html__('Show Date', 'dealsoffer'),
                'desc'             => esc_html__('You can show/hide date at blog page', 'dealsoffer'),
                'default'          => true,
            ),
            array(
                'id'               => 'blog_readmore',
                'title'            => esc_html__('Blog Read More Text', 'dealsoffer'),
                'subtitle'         => esc_html__('Enter Blog Read More Here', 'dealsoffer'),
                'type'             => 'text',
                'default'          => esc_html__('Read More', 'dealsoffer'),
            ),

        )
    )

);

/*Single Post Sections*/
Redux::setSection(
    $opt_name,
    array(
        'title'            => esc_html__('Single Post', 'dealsoffer'),
        'id'               => 'spost',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(

            array(
                'id'       => 'single_blog_title',
                'title'    => esc_html__('Single Blog  Title', 'dealsoffer'),
                'subtitle' => esc_html__('Enter Title Here', 'dealsoffer'),
                'type'     => 'text',
            ),
            array(
                'id'       => 'blog_banner',
                'url'      => true,
                'title'    => esc_html__('Blog Single page banner', 'dealsoffer'),
                'type'     => 'media',

            ),

            array(
                'id'       => 'blog-comments',
                'type'     => 'select',
                'title'    => esc_html__('Show Comment Form', 'dealsoffer'),
                'desc'     => esc_html__('Select comments show or hide', 'dealsoffer'),
                'options'  => array(
                    'show' => esc_html__('Show', 'dealsoffer'),
                    'hide' => esc_html__('Hide', 'dealsoffer'),
                ),
                'default'  => 'show',

            ),

            array(
                'id'       => 'blog-author-meta',
                'type'     => 'select',
                'title'    => esc_html__('Show Meta Info', 'dealsoffer'),
                'desc'     => esc_html__('Select meta info show or hide', 'dealsoffer'),
                'options'  => array(
                    'show' => esc_html__('Show', 'dealsoffer'),
                    'hide' => esc_html__('Hide', 'dealsoffer'),
                ),
                'default'  => 'show',

            ),

        )
    )


);

Redux::setSection(
    $opt_name,
    array(
        'title'  => esc_html__('Contact Page', 'dealsoffer'),
        'id'     => 'contact_page',
        'desc'   => esc_html__('Contact page settings', 'dealsoffer'),
        'icon'   => 'el el-error-alt',
        'fields' => array(

            array(
                'id' => 'contact_form_email',
                'type' => 'text',
                'title' => esc_html__('Email', 'dealsoffer') ,
                'desc' => esc_html__('Input email where the messages should arive.', 'dealsoffer'),
            ),
            array(
                'id' => 'markers',
                'type' => 'multi_text',
                'title' => esc_html__('Markers', 'dealsoffer') ,
                'desc' => esc_html__('Input markers for contact page in form LATITUDE,LONGITUDE.', 'dealsoffer'),
            ),
            array(
                'id' => 'marker_icon',
                'type' => 'media',
                'title' => esc_html__('Marker Icon', 'dealsoffer') ,
                'desc' => esc_html__('Select marker icon for the contact page.', 'dealsoffer'),
            ),
            array(
                'id' => 'markers_max_zoom',
                'type' => 'text',
                'title' => esc_html__('Markers Max Zoom', 'dealsoffer') ,
                'desc' => esc_html__('Markers max zoom 0 - 19.', 'dealsoffer'),
            ),
            array(
                'id' => 'google_api_key',
                'type' => 'text',
                'title' => esc_html__('Google API Key', 'dealsoffer') ,
                'desc' => esc_html__('Input google API key or leave empty to disable loading of google maps', 'dealsoffer'),
            ),
            array(
                'id' => 'agreement_text',
                'type' => 'editor',
                'args'  => array(
                    'media_buttons' => false
                ),
                'title' => esc_html__('Agreement Text', 'dealsoffer') ,
                'desc' => esc_html__('Input text of the agreement', 'dealsoffer'),
            ),

        )
    )
);

Redux::setSection(
    $opt_name,
    array(
        'title'  => esc_html__('404 Error Page', 'dealsoffer'),
        'id'     => 'error_page',
        'desc'   => esc_html__('404 details  here', 'dealsoffer'),
        'icon'   => 'el el-error-alt',
        'fields' => array(

            array(
                'id'       => 'title_404',
                'type'     => 'text',
                'title'    => esc_html__('Title', 'dealsoffer'),
                'subtitle' => esc_html__('Enter title for 404 page', 'dealsoffer'),
                'default'  => esc_html__('404', 'dealsoffer')
            ),
            array(
                'id'       => 'text_404',
                'type'     => 'text',
                'title'    => esc_html__('Text', 'dealsoffer'),
                'subtitle' => esc_html__('Enter text for 404 page', 'dealsoffer'),
                'default'  => esc_html__('Page Not Found', 'dealsoffer')
            ),
            array(
                'id'       => 'back_home',
                'type'     => 'text',
                'title'    => esc_html__('Back to Home Button Label', 'dealsoffer'),
                'subtitle' => esc_html__('Enter label for "Back to Home" button', 'dealsoffer'),
                'default'  => esc_html__('Back to Home', 'dealsoffer')

            ),
            array(
                'id'       => '404_bg',
                'type'     => 'media',
                'title'    => esc_html__('404 page Image', 'dealsoffer'),
                'subtitle' => esc_html__('Upload your image', 'dealsoffer'),
                'url' => true
            ),


        )
    )
);

if (!function_exists('compiler_action')) {
    function compiler_action($options, $css, $changed_values)
    {
        echo '<h1>The compiler hook has run!</h1>';
        echo "<pre>";
        print_r($changed_values); // Values that have changed since the last save
        echo "</pre>";
    }
}

/**
 * Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')) {
    function redux_validate_callback_function($field, $value, $existing_value)
    {
        $error   = false;
        $warning = false;

        //do your validation
        if ($value == 1) {
            $error = true;
            $value = $existing_value;
        } elseif ($value == 2) {
            $warning = true;
            $value   = $existing_value;
        }

        $return['value'] = $value;

        if ($error == true) {
            $field['msg']    = 'your custom error message';
            $return['error'] = $field;
        }

        if ($warning == true) {
            $field['msg']      = 'your custom warning message';
            $return['warning'] = $field;
        }

        return $return;
    }
}

/**
 * Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')) {
    function redux_my_custom_field($field, $value)
    {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
}

/**
 * Custom function for filtering the sections array. Good for child themes to override or add to the sections.     
 * */
if (!function_exists('dynamic_section')) {
    function dynamic_section($sections)
    {
        $sections[] = array(
            'title'  => esc_html__('Section via hook', 'dealsoffer'),
            'desc'   => esc_html__('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'dealsoffer'),
            'icon'   => 'el el-paper-clip',
            'fields' => array()
        );
        return $sections;
    }
}

/**
 * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
 * */
if (!function_exists('change_arguments')) {
    function change_arguments($args)
    {
        return $args;
    }
}

/**
 * Filter hook for filtering the default value of any given field. Very useful in development mode.
 * */
if (!function_exists('change_defaults')) {
    function change_defaults($defaults)
    {
        $defaults['str_replace'] = 'Testing filter hook!';
        return $defaults;
    }
}

/**
 * Removes the demo link and the notice of integrated demo from the redux-framework plugin
 */
if (!function_exists('remove_demo')) {
    function remove_demo()
    {
        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if (class_exists('ReduxFrameworkPlugin')) {
            remove_action('plugin_row_meta', array(
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ), null, 2);
            remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
        }
    }
}
