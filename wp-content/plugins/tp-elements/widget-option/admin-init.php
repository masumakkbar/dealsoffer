<?php

class TP_Elements_Addon_Control {

    private $tpelements_options;

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'tpelements_add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'tpelements_page_init' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'tpelements_admin_scripts' ) );
        register_activation_hook( TPELEMENTS_FILE, [$this,'tpelements_plugin_activate'] );      
        
    }

    public function tpelements_admin_scripts(){
        wp_register_style('tpelements-admin-styles', TPELEMENTS_DIR_URL_PRO . 'widget-option/assets/css/tpelements-admin.css', array(), null );
        wp_enqueue_style('tpelements-admin-styles');
    }


    public function tpelements_add_plugin_page() {
        add_menu_page(
            'TP Elements Setting',
            'TP Elements',
            'manage_options',
            'tpelements-addon-settings',
            array( $this, 'tpelements_create_admin_page' ),
            'dashicons-superhero',
            6
        );
    }

    /**
     *
     */
    public function tpelements_create_admin_page() {
        $this->tpelements_options = get_option( 'tpelements_addon_option' );
        ?>
        <div class="wrap">
            <form class="tpelements-form" method="post" action="options.php">
                <?php
                settings_fields( 'tpelements_addon_group' );
                do_settings_sections( 'tpelements-addon-field' );
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }


    public function tpelements_page_init(){

        /**
         * Sanitize callback
         */
        register_setting(
            'tpelements_addon_group',
            'tpelements_addon_option',
            array( $this, 'tpelements_sanitize' )
        );

        

        add_settings_section(
            'tpelements_section_field_id',
            esc_html__( 'Disable Elements for better performance', 'tp-elements' ),
            array( $this, 'tpelements_section_info' ),
            'tpelements-addon-field'
        );

        /**
         * Image Showcase
         */
        add_settings_field(
            'tp_image_showcase',
            esc_html__( 'TP Image Showcase', 'tp-elements' ),
            array( $this, 'tpelements_image_showcase_setting' ),
            'tpelements-addon-field',
            'tpelements_section_field_id',
            array( 'class' => 'tpselements_addon_field' )
        );
        
        /**
         * Counter
         */
        add_settings_field(
            'tp_counter',
            esc_html__( 'TP Counter', 'tp-elements' ),
            array( $this, 'tpelements_counter_setting' ),
            'tpelements-addon-field',
            'tpelements_section_field_id',
            array( 'class' => 'tpselements_addon_field' )
        );

        /**
         * Button
         */
        add_settings_field(
            'tp_button',
            esc_html__( 'TP Button', 'tp-elements' ),
            array( $this, 'tpelements_button_setting' ),
            'tpelements-addon-field',
            'tpelements_section_field_id',
            array( 'class' => 'tpselements_addon_field' )
        );

        /**
         * Testimonial Slider
         */
        add_settings_field(
            'tp_testimonial_slider',
            esc_html__( 'TP Testimonial Slider', 'tp-elements' ),
            array( $this, 'tpelements_testimonial_slider_setting' ),
            'tpelements-addon-field',
            'tpelements_section_field_id',
            array( 'class' => 'tpselements_addon_field' )
        );

        /**
         * Advance Tab
         */
        add_settings_field(
            'tp_advance_tab',
            esc_html__( 'TP Advance Tab', 'tp-elements' ),
            array( $this, 'tpelements_advance_tab_setting' ),
            'tpelements-addon-field',
            'tpelements_section_field_id',
            array( 'class' => 'tpselements_addon_field' )
        );
        /**
         * Icon Box
         */
        add_settings_field(
            'tp_icon_box',
            esc_html__( 'TP Icon Box', 'tp-elements' ),
            array( $this, 'tpelements_icon_box_setting' ),
            'tpelements-addon-field',
            'tpelements_section_field_id',
            array( 'class' => 'tpselements_addon_field' )
        );
        /**
         * Blog Grid
         */
        add_settings_field(
            'tp_blog_grid',
            esc_html__( 'TP Blog Grid', 'tp-elements' ),
            array( $this, 'tpelements_blog_grid_setting' ),
            'tpelements-addon-field',
            'tpelements_section_field_id',
            array( 'class' => 'tpselements_addon_field' )
        );
        /**
         * Blog Slider
         */
        add_settings_field(
            'tp_blog_slider',
            esc_html__( 'TP Blog Slider', 'tp-elements' ),
            array( $this, 'tpelements_blog_slider_setting' ),
            'tpelements-addon-field',
            'tpelements_section_field_id',
            array( 'class' => 'tpselements_addon_field' )
        );
        /**
         * Contact Form 7
         */
        add_settings_field(
            'tp_contact_form_7',
            esc_html__( 'TP Contact Form 7', 'tp-elements' ),
            array( $this, 'tpelements_contact_form_7_setting' ),
            'tpelements-addon-field',
            'tpelements_section_field_id',
            array( 'class' => 'tpselements_addon_field' )
        );
        /**
         * Progress Bar
         */
        add_settings_field(
            'tp_progress_bar',
            esc_html__( 'TP Progress Bar', 'tp-elements' ),
            array( $this, 'tpelements_progress_bar_setting' ),
            'tpelements-addon-field',
            'tpelements_section_field_id',
            array( 'class' => 'tpselements_addon_field' )
        );

        /**
         * Iconbox Top
         */
        add_settings_field(
            'tp_iconbox_bar',
            esc_html__( 'TP Iconbox Top', 'tp-elements' ),
            array( $this, 'tpelements_icon_bar_setting' ),
            'tpelements-addon-field',
            'tpelements_section_field_id',
            array( 'class' => 'tpselements_addon_field' )
        );
        /**
         * Iconbox List
         */
        add_settings_field(
            'tp_contactbox_icon',
            esc_html__( 'TP Iconbox List', 'tp-elements' ),
            array( $this, 'tpelements_contactbox_icon_setting' ),
            'tpelements-addon-field',
            'tpelements_section_field_id',
            array( 'class' => 'tpselements_addon_field' )
        );

        /**
         * Progress Pie
         */
        add_settings_field(
            'tp_progress_pie',
            esc_html__( 'TP Progress Pie', 'tp-elements' ),
            array( $this, 'tpelements_progress_pie_setting' ),
            'tpelements-addon-field',
            'tpelements_section_field_id',
            array( 'class' => 'tpselements_addon_field' )
        );


        /**
         * Countdown
         */
        add_settings_field(
            'tp_countdown_box',
            esc_html__( 'TP Countdown', 'tp-elements' ),
            array( $this, 'tpelements_countdown_setting' ),
            'tpelements-addon-field',
            'tpelements_section_field_id',
            array( 'class' => 'tpselements_addon_field' )
        );

        /**
         * FAQ ( Masum did not find )
         */
        add_settings_field(
            'tp_faq',
            esc_html__( 'TP FAQ Masum', 'tp-elements' ),
            array( $this, 'tpelements_faq_setting' ),
            'tpelements-addon-field',
            'tpelements_section_field_id',
            array( 'class' => 'tpselements_addon_field' )
        );
       
        /**
         * Accordion
         */
        add_settings_field(
            'tp_accordion',
            esc_html__( 'TP Accordion', 'tp-elements' ),
            array( $this, 'tpelements_accordion_setting' ),
            'tpelements-addon-field',
            'tpelements_section_field_id',
            array( 'class' => 'tpselements_addon_field' )
        );
        /**
         * Newsletter
         */
        add_settings_field(
            'tp_newsletter',
            esc_html__( 'TP MC4WP', 'tp-elements' ),
            array( $this, 'tpelements_newsletter_setting' ),
            'tpelements-addon-field',
            'tpelements_section_field_id',
            array( 'class' => 'tpselements_addon_field' )
        );

        /**
         * Marquee
         */
        add_settings_field(
            'tp_marquee',
            esc_html__( 'TP Marquee', 'tp-elements' ),
            array( $this, 'tpelements_marquee_setting' ),
            'tpelements-addon-field',
            'tpelements_section_field_id',
            array( 'class' => 'tpselements_addon_field' )
        );

        /**
         * Timeline
         */
        add_settings_field(
            'tp_timeline',
            esc_html__( 'TP Timeline', 'tp-elements' ),
            array( $this, 'tpelements_timeline_setting' ),
            'tpelements-addon-field',
            'tpelements_section_field_id',
            array( 'class' => 'tpselements_addon_field' )
        );

        /**
         * Featured Image
         */
        add_settings_field(
            'tp_featured_image',
            esc_html__( 'TP Single Featured Image', 'tp-elements' ),
            array( $this, 'tpelements_featured_image_setting' ),
            'tpelements-addon-field',
            'tpelements_section_field_id',
            array( 'class' => 'tpselements_addon_field' )
        );

        /**
         * Site Logo
         */
        add_settings_field(
            'tp_site_logo',
            esc_html__( 'TP Site Logo', 'tp-elements' ),
            array( $this, 'tpelements_site_logo_setting' ),
            'tpelements-addon-field',
            'tpelements_section_field_id',
            array( 'class' => 'tpselements_addon_field' )
        );
        /**
         * Site Search
         */
        add_settings_field(
            'tp_site_search',
            esc_html__( 'TP Search', 'tp-elements' ),
            array( $this, 'tpelements_site_search_setting' ),
            'tpelements-addon-field',
            'tpelements_section_field_id',
            array( 'class' => 'tpselements_addon_field' )
        );
        /**
         * Site Canvas
         */
        add_settings_field(
            'tp_site_canvas',
            esc_html__( 'OffCanvas Hamburger', 'tp-elements' ),
            array( $this, 'tpelements_site_canvas_setting' ),
            'tpelements-addon-field',
            'tpelements_section_field_id',
            array( 'class' => 'tpselements_addon_field' )
        );
        /**
         * Site Navigation
         */
        add_settings_field(
            'tp_site_navigation',
            esc_html__( 'Navigation Menu', 'tp-elements' ),
            array( $this, 'tpelements_site_navigation_setting' ),
            'tpelements-addon-field',
            'tpelements_section_field_id',
            array( 'class' => 'tpselements_addon_field' )
        );
        /**
         * Scroll To Top
         */
        add_settings_field(
            'tp_scroll_to_top',
            esc_html__( 'TP Scroll To Top', 'tp-elements' ),
            array( $this, 'tpelements_scroll_to_top_setting' ),
            'tpelements-addon-field',
            'tpelements_section_field_id',
            array( 'class' => 'tpselements_addon_field' )
        );

        /**
         * Single Navigation
         */
        add_settings_field(
            'tp_single_navigation',
            esc_html__( 'Single Page Navigation', 'tp-elements' ),
            array( $this, 'tpelements_single_navigation_setting' ),
            'tpelements-addon-field',
            'tpelements_section_field_id',
            array( 'class' => 'tpselements_addon_field' )
        );

        /**
         * Copyright
         */
        add_settings_field(
            'tp_copyright',
            esc_html__( 'TP Copyright', 'tp-elements' ),
            array( $this, 'tpelements_copyright_setting' ),
            'tpelements-addon-field',
            'tpelements_section_field_id',
            array( 'class' => 'tpselements_addon_field' )
        );

    }

    /**
     * Sanitize all form
     */
    public function tpelements_sanitize( $input_addon ) {
        $rt_addon_arg = array();

        //Counter 
        if( isset( $input_addon['tp_counter_setting'] ) ){
            $rt_addon_arg['tp_counter_setting'] = sanitize_text_field( $input_addon['tp_counter_setting'] );
        }

         //Counter 
         if( isset( $input_addon['tp_countdown_setting'] ) ){
            $rt_addon_arg['tp_countdown_setting'] = sanitize_text_field( $input_addon['tp_countdown_setting'] );
        } 

        //Button
        if( isset( $input_addon['tp_button_setting'] ) ){
            $rt_addon_arg['tp_button_setting'] = sanitize_text_field( $input_addon['tp_button_setting'] );
        }

        //Testimonial Slider
        if( isset( $input_addon['tp_testimonial_slider_setting'] ) ){
            $rt_addon_arg['tp_testimonial_slider_setting'] = sanitize_text_field( $input_addon['tp_testimonial_slider_setting'] );
        }

        //Advance Tab
        if( isset( $input_addon['tp_advance_tab_setting'] ) ){
            $rt_addon_arg['tp_advance_tab_setting'] = sanitize_text_field( $input_addon['tp_advance_tab_setting'] );
        }
        //Icon Box
        if( isset( $input_addon['tp_icon_box_setting'] ) ){
            $rt_addon_arg['tp_icon_box_setting'] = sanitize_text_field( $input_addon['tp_icon_box_setting'] );
        }
        //Blog Grid
        if( isset( $input_addon['tp_blog_grid_setting'] ) ){
            $rt_addon_arg['tp_blog_grid_setting'] = sanitize_text_field( $input_addon['tp_blog_grid_setting'] );
        }
        //Blog Slider
        if( isset( $input_addon['tp_blog_slider_setting'] ) ){
            $rt_addon_arg['tp_blog_slider_setting'] = sanitize_text_field( $input_addon['tp_blog_slider_setting'] );
        }
        //Contact Form 7
        if( isset( $input_addon['tp_contact_form_7_setting'] ) ){
            $rt_addon_arg['tp_contact_form_7_setting'] = sanitize_text_field( $input_addon['tp_contact_form_7_setting'] );
        }
        //Progress Bar
        if( isset( $input_addon['tp_progress_bar_setting'] ) ){
            $rt_addon_arg['tp_progress_bar_setting'] = sanitize_text_field( $input_addon['tp_progress_bar_setting'] );
        }
        //Progress Pie
        if( isset( $input_addon['tp_progress_pie_setting'] ) ){
            $rt_addon_arg['tp_progress_pie_setting'] = sanitize_text_field( $input_addon['tp_progress_pie_setting'] );
        }
        //Iconbox Top
        if( isset( $input_addon['tp_icon_bar_setting'] ) ){
            $rt_addon_arg['tp_icon_bar_setting'] = sanitize_text_field( $input_addon['tp_icon_bar_setting'] );
        }
        //Iconbox List
        if( isset( $input_addon['tp_contactbox_icon_setting'] ) ){
            $rt_addon_arg['tp_contactbox_icon_setting'] = sanitize_text_field( $input_addon['tp_contactbox_icon_setting'] );
        }

        //FAQ
        if( isset( $input_addon['tp_faq_setting'] ) ){
            $rt_addon_arg['tp_faq_setting'] = sanitize_text_field( $input_addon['tp_faq_setting'] );
        }
        //Image Showcase
        if( isset( $input_addon['tp_image_showcase_setting'] ) ){
            $rt_addon_arg['tp_image_showcase_setting'] = sanitize_text_field( $input_addon['tp_image_showcase_setting'] );
        }

        //Accordion
        if( isset( $input_addon['tp_accordion_setting'] ) ){
            $rt_addon_arg['tp_accordion_setting'] = sanitize_text_field( $input_addon['tp_accordion_setting'] );
        }
        //Newsletter
        if( isset( $input_addon['tp_newsletter_setting'] ) ){
            $rt_addon_arg['tp_newsletter_setting'] = sanitize_text_field( $input_addon['tp_newsletter_setting'] );
        }
        //Marquee
        if( isset( $input_addon['tp_marquee_setting'] ) ){
            $rt_addon_arg['tp_marquee_setting'] = sanitize_text_field( $input_addon['tp_marquee_setting'] );
        }

        //Timeline
        if( isset( $input_addon['tp_timeline_setting'] ) ){
            $rt_addon_arg['tp_timeline_setting'] = sanitize_text_field( $input_addon['tp_timeline_setting'] );
        }

        //Featured Image
        if( isset( $input_addon['tp_featured_image_setting'] ) ){
            $rt_addon_arg['tp_featured_image_setting'] = sanitize_text_field( $input_addon['tp_featured_image_setting'] );
        }
        //Site Logo
        if( isset( $input_addon['tp_site_logo_setting'] ) ){
            $rt_addon_arg['tp_site_logo_setting'] = sanitize_text_field( $input_addon['tp_site_logo_setting'] );
        }

        //Site Search
        if( isset( $input_addon['tp_site_search_setting'] ) ){
            $rt_addon_arg['tp_site_search_setting'] = sanitize_text_field( $input_addon['tp_site_search_setting'] );
        }

        //Site Canvas
        if( isset( $input_addon['tp_site_canvas_setting'] ) ){
            $rt_addon_arg['tp_site_canvas_setting'] = sanitize_text_field( $input_addon['tp_site_canvas_setting'] );
        }

        //Site Navigation
        if( isset( $input_addon['tp_site_navigation_setting'] ) ){
            $rt_addon_arg['tp_site_navigation_setting'] = sanitize_text_field( $input_addon['tp_site_navigation_setting'] );
        }

        //Sroll To Top
        if( isset( $input_addon['tp_scroll_to_top_setting'] ) ){
            $rt_addon_arg['tp_scroll_to_top_setting'] = sanitize_text_field( $input_addon['tp_scroll_to_top_setting'] );
        }

        //Single Navigation
        if( isset( $input_addon['tp_single_navigation_setting'] ) ){
            $rt_addon_arg['tp_single_navigation_setting'] = sanitize_text_field( $input_addon['tp_single_navigation_setting'] );
        }

        //Copyright
        if( isset( $input_addon['tp_copyright_setting'] ) ){
            $rt_addon_arg['tp_copyright_setting'] = sanitize_text_field( $input_addon['tp_copyright_setting'] );
        }

        return $rt_addon_arg;
    }

    /**
     * Print the Section text
     */
    public function tpelements_section_info() {
        //print 'Enter your settings below:';
    }

    /**
     * Counter
     */
    public function tpelements_counter_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="tpelements_addon_option[tp_counter_setting]" id="tp_counter_setting" value="tpelement_counter" %s/>',
                (isset( $this->tpelements_options['tp_counter_setting']) && $this->tpelements_options['tp_counter_setting'] ) == 'tpelement_counter' ? 'checked' : ''
            );
            ?>
            <label for="tp_counter_setting"></label>
        </div>
        <?php
    }

    /**
     * Button
     */
    public function tpelements_button_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="tpelements_addon_option[tp_button_setting]" id="tp_button_setting" value="tpelement_button" %s/>',
                (isset( $this->tpelements_options['tp_button_setting']) && $this->tpelements_options['tp_button_setting'] ) == 'tpelement_button' ? 'checked' : ''
            );
            ?>
            <label for="tp_button_setting"></label>
        </div>
        <?php
    }

    /**
     * Testimonial Slider
     */
    public function tpelements_testimonial_slider_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="tpelements_addon_option[tp_testimonial_slider_setting]" id="tp_testimonial_slider_setting" value="tpelement_testimonial_slider" %s/>',
                (isset( $this->tpelements_options['tp_testimonial_slider_setting']) && $this->tpelements_options['tp_testimonial_slider_setting'] ) == 'tpelement_testimonial_slider' ? 'checked' : ''
            );
            ?>
            <label for="tp_testimonial_slider_setting"></label>
        </div>
        <?php
    }

    /**
     * Advance Tab
     */
    public function tpelements_advance_tab_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="tpelements_addon_option[tp_advance_tab_setting]" id="tp_advance_tab_setting" value="tpelement_advance_tab" %s/>',
                (isset( $this->tpelements_options['tp_advance_tab_setting']) && $this->tpelements_options['tp_advance_tab_setting'] ) == 'tpelement_advance_tab' ? 'checked' : ''
            );
            ?>
            <label for="tp_advance_tab_setting"></label>
        </div>
        <?php
    }
    
    /**
     * Icon Box
     */
    public function tpelements_icon_box_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="tpelements_addon_option[tp_icon_box_setting]" id="tp_icon_box_setting" value="tpelement_icon_box" %s/>',
                (isset( $this->tpelements_options['tp_icon_box_setting']) && $this->tpelements_options['tp_icon_box_setting'] ) == 'tpelement_icon_box' ? 'checked' : ''
            );
            ?>
            <label for="tp_icon_box_setting"></label>
        </div>
        <?php
    }

    /**
     * Blog Grid
     */
    public function tpelements_blog_grid_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="tpelements_addon_option[tp_blog_grid_setting]" id="tp_blog_grid_setting" value="tpelement_blog_grid" %s/>',
                (isset( $this->tpelements_options['tp_blog_grid_setting']) && $this->tpelements_options['tp_blog_grid_setting'] ) == 'tpelement_blog_grid' ? 'checked' : ''
            );
            ?>
            <label for="tp_blog_grid_setting"></label>
        </div>
        <?php
    }

    /**
     * Blog Slider
     */
    public function tpelements_blog_slider_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="tpelements_addon_option[tp_blog_slider_setting]" id="tp_blog_slider_setting" value="tpelement_blog_slider" %s/>',
                (isset( $this->tpelements_options['tp_blog_slider_setting']) && $this->tpelements_options['tp_blog_slider_setting'] ) == 'tpelement_blog_slider' ? 'checked' : ''
            );
            ?>
            <label for="tp_blog_slider_setting"></label>
        </div>
        <?php
    }

    /**
     * Contact Form 7
     */
    public function tpelements_contact_form_7_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="tpelements_addon_option[tp_contact_form_7_setting]" id="tp_contact_form_7_setting" value="tpelement_contact_form_7" %s/>',
                (isset( $this->tpelements_options['tp_contact_form_7_setting']) && $this->tpelements_options['tp_contact_form_7_setting'] ) == 'tpelement_contact_form_7' ? 'checked' : ''
            );
            ?>
            <label for="tp_contact_form_7_setting"></label>
        </div>
        <?php
    }

    /**
     * Progress Bar
     */
    public function tpelements_progress_bar_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="tpelements_addon_option[tp_progress_bar_setting]" id="tp_progress_bar_setting" value="tpelement_progress_bar" %s/>',
                (isset( $this->tpelements_options['tp_progress_bar_setting']) && $this->tpelements_options['tp_progress_bar_setting'] ) == 'tpelement_progress_bar' ? 'checked' : ''
            );
            ?>
            <label for="tp_progress_bar_setting"></label>
        </div>
        <?php
    }

    /**
     * Iconbox Top
     */
    public function tpelements_icon_bar_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="tpelements_addon_option[tp_icon_bar_setting]" id="tp_icon_bar_setting" value="tpelement_icon_bar" %s/>',
                (isset( $this->tpelements_options['tp_icon_bar_setting']) && $this->tpelements_options['tp_icon_bar_setting'] ) == 'tpelement_icon_bar' ? 'checked' : ''
            );
            ?>
            <label for="tp_icon_bar_setting"></label>
        </div>
        <?php
    }

    /**
     * Iconbox List
     */
    public function tpelements_contactbox_icon_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="tpelements_addon_option[tp_contactbox_icon_setting]" id="tp_contactbox_icon_setting" value="tpelement_contactbox_icon" %s/>',
                (isset( $this->tpelements_options['tp_contactbox_icon_setting']) && $this->tpelements_options['tp_contactbox_icon_setting'] ) == 'tpelement_contactbox_icon' ? 'checked' : ''
            );
            ?>
            <label for="tp_contactbox_icon_setting"></label>
        </div>
        <?php
    }

    /**
     * Progress Pie
     */
    public function tpelements_progress_pie_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="tpelements_addon_option[tp_progress_pie_setting]" id="tp_progress_pie_setting" value="tpelement_progress_pie" %s/>',
                (isset( $this->tpelements_options['tp_progress_pie_setting']) && $this->tpelements_options['tp_progress_pie_setting'] ) == 'tpelement_progress_pie' ? 'checked' : ''
            );
            ?>
            <label for="tp_progress_pie_setting"></label>
        </div>
        <?php
    }

    
    /**
     * Countdown Box
     */
    public function tpelements_countdown_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="tpelements_addon_option[tp_countdown_setting]" id="tp_countdown_setting" value="tpelement_countdown_box" %s/>',
                (isset( $this->tpelements_options['tp_countdown_setting']) && $this->tpelements_options['tp_countdown_setting'] ) == 'tpelement_countdown_box' ? 'checked' : ''
            );
            ?>
            <label for="tp_countdown_setting"></label>
        </div>
        <?php
    }

    /**
     * FAQ ( masum did not find )
     */
    public function tpelements_faq_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="tpelements_addon_option[tp_faq_setting]" id="tp_faq_setting" value="tpelement_faq" %s/>',
                (isset( $this->tpelements_options['tp_faq_setting']) && $this->tpelements_options['tp_faq_setting'] ) == 'tpelement_faq' ? 'checked' : ''
            );
            ?>
            <label for="tp_faq_setting"></label>
        </div>
        <?php
    }

    /**
     * Image Showcase
     */
    public function tpelements_image_showcase_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="tpelements_addon_option[tp_image_showcase_setting]" id="tp_image_showcase_setting" value="tpelement_image_showcase" %s/>',
                (isset( $this->tpelements_options['tp_image_showcase_setting']) && $this->tpelements_options['tp_image_showcase_setting'] ) == 'tpelement_image_showcase' ? 'checked' : ''
            );
            ?>
            <label for="tp_image_showcase_setting"></label>
        </div>
        <?php
    }

    /**
     * Accordion
     */
    public function tpelements_accordion_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="tpelements_addon_option[tp_accordion_setting]" id="tp_accordion_setting" value="tpelement_accordion" %s/>',
                (isset( $this->tpelements_options['tp_accordion_setting']) && $this->tpelements_options['tp_accordion_setting'] ) == 'tpelement_accordion' ? 'checked' : ''
            );
            ?>
            <label for="tp_accordion_setting"></label>
        </div>
        <?php
    }

    /**
     * Newsletter
     */
    public function tpelements_newsletter_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="tpelements_addon_option[tp_newsletter_setting]" id="tp_newsletter_setting" value="tpelement_newsletter" %s/>',
                (isset( $this->tpelements_options['tp_newsletter_setting']) && $this->tpelements_options['tp_newsletter_setting'] ) == 'tpelement_newsletter' ? 'checked' : ''
            );
            ?>
            <label for="tp_newsletter_setting"></label>
        </div>
        <?php
    }

    /**
     * Marquee
     */
    public function tpelements_marquee_setting() {
        ?>
        <div class="checkbox">
            <?php

            printf('<input type="checkbox" name="tpelements_addon_option[tp_marquee_setting]" id="tp_marquee_setting" value="tpelement_marquee" %s/>',
                (isset( $this->tpelements_options['tp_marquee_setting']) && $this->tpelements_options['tp_marquee_setting'] ) == 'tpelement_marquee' ? 'checked' : ''
            );
            ?>
            <label for="tp_marquee_setting"></label>
        </div>
        <?php
    }

    /**
     * Timeline
     */
    public function tpelements_timeline_setting() {
        ?>
        <div class="checkbox">
            <?php

            printf('<input type="checkbox" name="tpelements_addon_option[tp_timeline_setting]" id="tp_timeline_setting" value="tpelement_timeline" %s/>',
                (isset( $this->tpelements_options['tp_timeline_setting']) && $this->tpelements_options['tp_timeline_setting'] ) == 'tpelement_timeline' ? 'checked' : ''
            );
            ?>
            <label for="tp_timeline_setting"></label>
        </div>
        <?php
    }

    /**
     * Featured Image
     */
    public function tpelements_featured_image_setting() {
        ?>
        <div class="checkbox">
            <?php

            printf('<input type="checkbox" name="tpelements_addon_option[tp_featured_image_setting]" id="tp_featured_image_setting" value="tpelement_featured_image" %s/>',
                (isset( $this->tpelements_options['tp_featured_image_setting']) && $this->tpelements_options['tp_featured_image_setting'] ) == 'tpelement_featured_image' ? 'checked' : ''
            );
            ?>
            <label for="tp_featured_image_setting"></label>
        </div>
        <?php
    }
    /**
     * Site Logo
     */
    public function tpelements_site_logo_setting() {
        ?>
        <div class="checkbox">
            <?php

            printf('<input type="checkbox" name="tpelements_addon_option[tp_site_logo_setting]" id="tp_site_logo_setting" value="tpelement_site_logo" %s/>',
                (isset( $this->tpelements_options['tp_site_logo_setting']) && $this->tpelements_options['tp_site_logo_setting'] ) == 'tpelement_site_logo' ? 'checked' : ''
            );
            ?>
            <label for="tp_site_logo_setting"></label>
        </div>
        <?php
    }
    /**
     * Site Search
     */
    public function tpelements_site_search_setting() {
        ?>
        <div class="checkbox">
            <?php

            printf('<input type="checkbox" name="tpelements_addon_option[tp_site_search_setting]" id="tp_site_search_setting" value="tpelement_site_search" %s/>',
                (isset( $this->tpelements_options['tp_site_search_setting']) && $this->tpelements_options['tp_site_search_setting'] ) == 'tpelement_site_search' ? 'checked' : ''
            );
            ?>
            <label for="tp_site_search_setting"></label>
        </div>
        <?php
    }

    /**
     * Site Canvas
     */
    public function tpelements_site_canvas_setting() {
        ?>
        <div class="checkbox">
            <?php

            printf('<input type="checkbox" name="tpelements_addon_option[tp_site_canvas_setting]" id="tp_site_canvas_setting" value="tpelement_site_canvas" %s/>',
                (isset( $this->tpelements_options['tp_site_canvas_setting']) && $this->tpelements_options['tp_site_canvas_setting'] ) == 'tpelement_site_canvas' ? 'checked' : ''
            );
            ?>
            <label for="tp_site_canvas_setting"></label>
        </div>
        <?php
    }

    /**
     * Site Navigation
     */
    public function tpelements_site_navigation_setting() {
        ?>
        <div class="checkbox">
            <?php

            printf('<input type="checkbox" name="tpelements_addon_option[tp_site_navigation_setting]" id="tp_site_navigation_setting" value="tpelement_site_navigation" %s/>',
                (isset( $this->tpelements_options['tp_site_navigation_setting']) && $this->tpelements_options['tp_site_navigation_setting'] ) == 'tpelement_site_navigation' ? 'checked' : ''
            );
            ?>
            <label for="tp_site_navigation_setting"></label>
        </div>
        <?php
    }

    /**
     * Scroll To Top
     */
    public function tpelements_scroll_to_top_setting() {
        ?>
        <div class="checkbox">
            <?php

            printf('<input type="checkbox" name="tpelements_addon_option[tp_scroll_to_top_setting]" id="tp_scroll_to_top_setting" value="tpelement_scroll_to_top" %s/>',
                (isset( $this->tpelements_options['tp_scroll_to_top_setting']) && $this->tpelements_options['tp_scroll_to_top_setting'] ) == 'tpelement_scroll_to_top' ? 'checked' : ''
            );
            ?>
            <label for="tp_scroll_to_top_setting"></label>
        </div>
        <?php
    }


    /**
     * Single Navigation
     */
    public function tpelements_single_navigation_setting() {
        ?>
        <div class="checkbox">
            <?php

            printf('<input type="checkbox" name="tpelements_addon_option[tp_single_navigation_setting]" id="tp_single_navigation_setting" value="tpelement_single_navigation" %s/>',
                (isset( $this->tpelements_options['tp_single_navigation_setting']) && $this->tpelements_options['tp_single_navigation_setting'] ) == 'tpelement_single_navigation' ? 'checked' : ''
            );
            ?>
            <label for="tp_single_navigation_setting"></label>
        </div>
        <?php
    }

    /**
     * Copyright
     */
    public function tpelements_copyright_setting() {
        ?>
        <div class="checkbox">
            <?php

            printf('<input type="checkbox" name="tpelements_addon_option[tp_copyright_setting]" id="tp_copyright_setting" value="tpelement_copyright" %s/>',
                (isset( $this->tpelements_options['tp_copyright_setting']) && $this->tpelements_options['tp_copyright_setting'] ) == 'tpelement_copyright' ? 'checked' : ''
            );
            ?>
            <label for="tp_copyright_setting"></label>
        </div>
        <?php
    }

    public function tpelements_plugin_activate() {
        $all_elements_list = $this->tpelements_widget_list();

        update_option('tpelements_addon_option',$all_elements_list);
    }

    public function tpelements_widget_list() {
        $tpall_elements = [
            'tp_copyright_setting' => 'tpelement_copyright',
            'tp_single_navigation_setting' => 'tpelement_single_navigation',
            'tp_scroll_to_top_setting' => 'tpelement_scroll_to_top',
            'tp_site_navigation_setting' => 'tpelement_site_navigation',
            'tp_site_canvas_setting' => 'tpelement_site_canvas',
            'tp_site_search_setting' => 'tpelement_site_search',
            'tp_site_logo_setting' => 'tpelement_site_logo',
            'tp_featured_image_setting' => 'tpelement_featured_image',
            'tp_timeline_setting' => 'tpelement_timeline',
            'tp_marquee_setting' => 'tpelement_marquee',
            'tp_counter_setting' => 'tpelement_counter',
            'tp_button_setting' => 'tpelement_button',
            'tp_advance_tab_setting' => 'tpelement_advance_tab',
            'tp_icon_box_setting' => 'tpelement_icon_box',
            'tp_blog_grid_setting' => 'tpelement_blog_grid',
            'tp_blog_slider_setting' => 'tpelement_blog_slider',
            'tp_contact_form_7_setting' => 'tpelement_contact_form_7',
            'tp_progress_bar_setting' => 'tpelement_progress_bar',
            'tp_icon_bar_setting' => 'tpelement_icon_bar',
            'tp_contactbox_icon_setting' => 'tpelement_contactbox_icon',
            'tp_progress_pie_setting' => 'tpelement_progress_pie',
            'tp_countdown_setting' => 'tpelement_countdown_box',
            'tp_faq_setting' => 'tpelement_faq',
            'tp_image_showcase_setting' => 'tpelement_image_showcase',          
            'tp_accordion_setting' => 'tpelement_accordion',
            'tp_newsletter_setting' => 'tpelement_newsletter',
            'tp_testimonial_slider_setting' => 'tpelement_testimonial_slider',
           
        ];

        return $tpall_elements;
    }
    
}

if( is_admin() )
    new TP_Elements_Addon_Control();