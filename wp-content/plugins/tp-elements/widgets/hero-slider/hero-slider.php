<?php
/**
 * Logo widget class
 *
 */
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\register_controls;

defined( 'ABSPATH' ) || die();
class Themephi_Elementor_Hero_Slider_Widget  extends \Elementor\Widget_Base {
  
    /**
     * Get widget name.
     *   
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */

    public function get_name() {
        return 'tp-hero-slider';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */

    public function get_title() {
        return esc_html__( 'TP Hero Slider', 'tp-elements' );
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-gallery-grid';
    }
    public function get_categories() {
        return [ 'pielements_category' ];
    }
    public function get_keywords() {
        return [ 'hero-slider' ];
    }
    protected function register_controls() {

        $this->start_controls_section(
            '_services_slider_s',
            [
                'label' => esc_html__( 'Slider Style', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_slider_style',
            [
                'label'   => esc_html__( 'Select Style', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [					
                    'style1' => esc_html__( 'Style 1', 'tp-elements'),
                ],
            ]
        );        

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_logo',
            [
                'label' => esc_html__( 'Slider Item', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'tp-elements'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );  

        $repeater->add_control(
            'sub_image',
            [
                'label' => esc_html__('Befor Title Image', 'tp-elements'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

		$repeater->add_control(
            'sub_title',
            [
                'label' => esc_html__('Sub Title', 'tp-elements'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Find Your Favorite Affiliate Coupons', 'tp-elements'),
                'label_block' => true,
                'placeholder' => esc_html__( 'Type Sub Title', 'tp-elements' ),
                'separator'   => 'before',
            ]
        );

        $repeater->add_control(
            'hero_title',
            [
                'label' => esc_html__('Title', 'tp-elements'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Get Instant Savings with Coupons', 'tp-elements'),
                'label_block' => true,
                'placeholder' => esc_html__( 'Type Title', 'tp-elements' ),
                'separator'   => 'before',
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'tp-elements'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('We understand that finding the right Coupons can be a daunting task. That\'s why we\'ve designed our platform.', 'tp-elements'),
                'label_block' => true,
                'placeholder' => esc_html__( 'Type Description', 'tp-elements' ),
                'separator'   => 'before',
            ]
        );
		
		$repeater->add_control(
			'btn_text',
			[
				'label'       => esc_html__( 'Button Text', 'tp-elements' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Sample',
				'placeholder' => esc_html__( 'Button Text', 'tp-elements' ),
				'separator'   => 'before',
			]
		);

		$repeater->add_control(
			'btn_link',
			[
				'label'       => esc_html__( ' Button Link', 'tp-elements' ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,						
			]
		);

		$repeater->add_control(
            'icon',
            [
				'label' => esc_html__( 'Icon', 'tp-elements' ),
				'type'  => Controls_Manager::HEADING,               
            ]
        );

		$repeater->add_control(
            'show_icon',
            [
				'label'        => esc_html__( 'Show Icon', 'tp-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'tp-elements' ),
				'label_off'    => esc_html__( 'Hide', 'tp-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
            ]
        );

		$repeater->add_control(
			'btn_icon',
			[
				'label'     => esc_html__( 'Icon', 'tp-elements' ),
				'type'      => Controls_Manager::ICONS,
				'default' => [
					'value' => 'tp tp-arrow-left',					
				],
				'separator' => 'before',				
			]
		);

		$repeater->add_control(
		    'btn_icon_spacing',
		    [
		        'label' => esc_html__( 'Icon Left Spacing', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 10
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-button i' => 'margin-left: {{SIZE}}{{UNIT}};',		
					'{{WRAPPER}} .themephi-button a svg' => 'margin-left: {{SIZE}}{{UNIT}};',	            
		        ],	
		    ]
		);					

		$repeater->add_control(
		    'btn_icon_width',
		    [
		        'label' => esc_html__( 'Icon Width', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
		        'selectors' => [    
		            '{{WRAPPER}} .themephi-button a svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',		            
		        ],
		    ]
		);

        $this->add_control(
            'hero_items',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ hero_title }}}',
				'default' => [
					[
						'list_title' => esc_html__( 'Title #1', 'tp-elements' ),
					],
					[
						'list_title' => esc_html__( 'Title #2', 'tp-elements' ),
					],
				],
            ]
        );    

        $this->end_controls_section();

        $this->start_controls_section(
            'content_slider',
            [
                'label' => esc_html__( 'Slider Settings', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_CONTENT,               
            ]
        );

        
        $this->add_control(
            'col_xxl',
            [
                'label'   => esc_html__( 'Wide Screen > 1399px', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3,
                'options' => [
                    '1' => esc_html__( '1 Column', 'tp-elements' ), 
                    '2' => esc_html__( '2 Column', 'tp-elements' ),
                    '3' => esc_html__( '3 Column', 'tp-elements' ),
                    '4' => esc_html__( '4 Column', 'tp-elements' ),
                    '4.5' => esc_html__( '4.5 Column', 'tp-elements' ),
                    '5' => esc_html__( '5 Column', 'tp-elements' ),
                    '6' => esc_html__( '6 Column', 'tp-elements' ),                 
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'col_xl',
            [
                'label'   => esc_html__( 'Wide Screen > 1199px', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3,
                'options' => [
                    '1' => esc_html__( '1 Column', 'tp-elements' ), 
                    '2' => esc_html__( '2 Column', 'tp-elements' ),
                    '3' => esc_html__( '3 Column', 'tp-elements' ),
                    '4' => esc_html__( '4 Column', 'tp-elements' ),
                    '4.5' => esc_html__( '4.5 Column', 'tp-elements' ),
                    '5' => esc_html__( '5 Column', 'tp-elements' ),
                    '6' => esc_html__( '6 Column', 'tp-elements' ),                 
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'col_lg',
            [
                'label'   => esc_html__( 'Desktops > 991px', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3,
                'options' => [
                    '1' => esc_html__( '1 Column', 'tp-elements' ), 
                    '2' => esc_html__( '2 Column', 'tp-elements' ),
                    '3' => esc_html__( '3 Column', 'tp-elements' ),
                    '4' => esc_html__( '4 Column', 'tp-elements' ),
                    '5' => esc_html__( '5 Column', 'tp-elements' ),
                    '6' => esc_html__( '6 Column', 'tp-elements' ),                 
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'col_md',
            [
                'label'   => esc_html__( 'Desktops > 768px', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3,         
                'options' => [
                    '1' => esc_html__( '1 Column', 'tp-elements' ), 
                    '2' => esc_html__( '2 Column', 'tp-elements' ),
                    '3' => esc_html__( '3 Column', 'tp-elements' ),
                    '4' => esc_html__( '4 Column', 'tp-elements' ),
                    '5' => esc_html__( '5 Column', 'tp-elements' ),
                    '6' => esc_html__( '6 Column', 'tp-elements' ),                     
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'col_sm',
            [
                'label'   => esc_html__( 'Tablets > 576px', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 2,         
                'options' => [
                    '1' => esc_html__( '1 Column', 'tp-elements' ), 
                    '2' => esc_html__( '2 Column', 'tp-elements' ),
                    '3' => esc_html__( '3 Column', 'tp-elements' ),
                    '4' => esc_html__( '4 Column', 'tp-elements' ),
                    '5' => esc_html__( '5 Column', 'tp-elements' ),
                    '6' => esc_html__( '6 Column', 'tp-elements' ),                 
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'col_xs',
            [
                'label'   => esc_html__( 'Tablets < 575px', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 1,         
                'options' => [
                    '1' => esc_html__( '1 Column', 'tp-elements' ), 
                    '2' => esc_html__( '2 Column', 'tp-elements' ),
                    '3' => esc_html__( '3 Column', 'tp-elements' ),
                    '4' => esc_html__( '4 Column', 'tp-elements' ),
                    '5' => esc_html__( '5 Column', 'tp-elements' ),
                    '6' => esc_html__( '6 Column', 'tp-elements' ),                 
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slides_ToScroll',
            [
                'label'   => esc_html__( 'Slide To Scroll', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 2,         
                'options' => [
                    '1' => esc_html__( '1 Item', 'tp-elements' ),
                    '2' => esc_html__( '2 Item', 'tp-elements' ),
                    '3' => esc_html__( '3 Item', 'tp-elements' ),
                    '4' => esc_html__( '4 Item', 'tp-elements' ),                   
                ],
                'separator' => 'before',
                            
            ]
            
        );      
        $this->add_control(
            'rt_pslider_effect',
            [
                'label' => esc_html__('Slider Effect', 'tp-elements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
					'default' => esc_html__('Default', 'tp-elements'),					
					'fade' => esc_html__('Fade', 'tp-elements'),
					'flip' => esc_html__('Flip', 'tp-elements'),
					'cube' => esc_html__('Cube', 'tp-elements'),
					'coverflow' => esc_html__('Coverflow', 'tp-elements'),
					'creative' => esc_html__('Creative', 'tp-elements'),
					'cards' => esc_html__('Cards', 'tp-elements'),
                ],
            ]
        );

        $this->add_control(
            'slider_dots',
            [
                'label'   => esc_html__( 'Navigation Dots', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'false',
                'options' => [
                    'true' => esc_html__( 'Enable', 'tp-elements' ),
                    'false' => esc_html__( 'Disable', 'tp-elements' ),              
                ],
                'separator' => 'before',
                            
            ]
            
        );
        $this->add_responsive_control(
            'slider_dot_width',
            [
                'label' => esc_html__( 'Width', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 80,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 80,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-hero-slide-pagination .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [ 'slider_dots' => 'true', ],
            ]
        );
        $this->add_responsive_control(
            'slider_dot_active_width',
            [
                'label' => esc_html__( 'Active Dot Width', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 80,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 80,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-hero-slide-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [ 'slider_dots' => 'true', ],
            ]
        );
        $this->add_responsive_control(
            'slider_dot_height',
            [
                'label' => esc_html__( 'Height', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 80,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 80,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-hero-slide-pagination .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [ 'slider_dots' => 'true', ],
            ]
        );
        $this->add_control(
            'slider_dot_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-hero-slide-pagination .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'condition' => [ 'slider_dots' => 'true', ],
            ]
        );
        $this->add_control(
            'slider_dots_color',
            [
                'label' => esc_html__( 'Navigation Dots Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-hero-slide-pagination .swiper-pagination-bullet' => 'background-color: {{VALUE}} !important;',
                ],
                'condition' => [ 'slider_dots' => 'true', ],
            ]
        );
        $this->add_control(
            'slider_dots_color_active',
            [
                'label' => esc_html__( 'Active Navigation Dots Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-hero-slide-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background-color: {{VALUE}} !important;',
                ],
                'condition' => [ 'slider_dots' => 'true', ],
            ]
        );

        $this->add_control(
            'slider_dot_gap_custom',
            [
                'label' => esc_html__( 'Pagination Bottom Gap', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,               
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 15,
                ],          
                'selectors' => [                   
                    '{{WRAPPER}} .themephi-addon-slider.swiper.swiper-horizontal' => 'padding-bottom: {{SIZE}}{{UNIT}};',                    
                ],
                'condition' => [ 'slider_dots' => 'true', ],
            ]
        );

        $this->add_responsive_control(
            'slider_dot_align',
            [
                'label' => esc_html__( 'Slider Dot Alignment', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'tp-elements' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'tp-elements' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'tp-elements' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-hero-slide-pagination' => 'text-align: {{VALUE}};',
                ],
                'condition' => [ 'slider_dots' => 'true', ],
            ]
        );

        $this->add_responsive_control(
            'slider_dot_padding',
            [
                'label' => esc_html__( 'Pagination Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-hero-slide-pagination' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 'slider_dots' => 'true', ],
            ]
        );

        $this->add_responsive_control(
            'slider_nav',
            [
                'label'   => esc_html__( 'Navigation Nav', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'false',           
                'options' => [
                    'true' => esc_html__( 'Enable', 'tp-elements' ),
                    'false' => esc_html__( 'Disable', 'tp-elements' ),              
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'slider_nav_align',
            [
                'label' => esc_html__( 'Slider Navigation Alignment', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => [
                    'start' => [
                        'title' => esc_html__( 'Left', 'tp-elements' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'tp-elements' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__( 'Right', 'tp-elements' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-hero-slider-navigation' => 'justify-content: {{VALUE}};',
                ],
                'condition' => [ 'slider_nav' => 'true', ],
            ]
        );

        $this->add_control(
            'slider_nav_gap_custom',
            [
                'label' => esc_html__( 'Navigation Top Gap', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,               
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 15,
                ],          
                'selectors' => [
                    '{{WRAPPER}} .tp-hero-slider-navigation' => 'margin-top: {{SIZE}}{{UNIT}};',                    
                ],
                'condition' => [ 'slider_nav' => 'true', ],
            ]
        );
        $this->add_control(
            'slider_nav_gap_between',
            [
                'label' => esc_html__( 'Navigation Gap Between', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,               
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 15,
                ],          
                'selectors' => [
                    '{{WRAPPER}} .tp-hero-slider-navigation' => 'gap: {{SIZE}}{{UNIT}};',                    
                ],
                'condition' => [ 'slider_nav' => 'true', ],
            ]
        );

        $this->add_responsive_control(
            'slider_nav_padding',
            [
                'label' => esc_html__( 'Pagination Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-hero-slider-navigation > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 'slider_nav' => 'true', ],
            ]
        );

        $this->add_control(
            'slider_nav_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-hero-slider-navigation > div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'condition' => [ 'slider_nav' => 'true', ],
            ]
        );

        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'navigation_border',
		        'selector' => '{{WRAPPER}} .tp-hero-slider-navigation > div',
                'condition' => [ 'slider_nav' => 'true', ],
		    ]
		);
        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'navigation_hover_border',
		        'selector' => '{{WRAPPER}} .tp-hero-slider-navigation > div:hover',
                'condition' => [ 'slider_nav' => 'true', ],
		    ]
		);

        $this->add_control(
            'pcat_nav_text_bg',
            [
                'label' => esc_html__( 'Nav BG Color', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-hero-slider-navigation > div' => 'background-color: {{VALUE}} !important;',
                ],
                'condition' => [ 'slider_nav' => 'true', ],
            ]
        );
        $this->add_control(
            'pcat_nav_text_bg_hover',
            [
                'label' => esc_html__( 'Nav BG Hover Color', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-hero-slider-navigation > div:hover' => 'background-color: {{VALUE}} !important;',
                ],
                'condition' => [ 'slider_nav' => 'true', ],
            ]
        );
        $this->add_control(
            'pcat_nav_text_bg_icon',
            [
                'label' => esc_html__( 'Nav BG Icon Color', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-hero-slider-navigation > div i' => 'color: {{VALUE}} !important;',
                ],
                'condition' => [ 'slider_nav' => 'true', ],
            ]
        );
        $this->add_control(
            'pcat_nav_text_bg_hover_icon',
            [
                'label' => esc_html__( 'Nav BG Icon Hover Color', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-hero-slider-navigation > div:hover i' => 'color: {{VALUE}} !important;',
                ],
                'condition' => [ 'slider_nav' => 'true', ],
            ]
        );

        $this->add_control(
            'slider_autoplay',
            [
                'label'   => esc_html__( 'Autoplay', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'false',           
                'options' => [
                    'true' => esc_html__( 'Enable', 'tp-elements' ),
                    'false' => esc_html__( 'Disable', 'tp-elements' ),              
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'slider_autoplay_speed',
            [
                'label'   => esc_html__( 'Autoplay Slide Speed', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3000,          
                'options' => [
                    '1000' => esc_html__( '1 Seconds', 'tp-elements' ),
                    '2000' => esc_html__( '2 Seconds', 'tp-elements' ), 
                    '3000' => esc_html__( '3 Seconds', 'tp-elements' ), 
                    '4000' => esc_html__( '4 Seconds', 'tp-elemsents' ), 
                    '5000' => esc_html__( '5 Seconds', 'tp-elements' ), 
                ],
                'separator' => 'before',
                'condition' => [
                    'slider_autoplay' => 'true',
                ],                          
            ]
        );

        $this->add_control(
            'slider_interval',
            [
                'label'   => esc_html__( 'Autoplay Interval', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3000,          
                'options' => [
                    '5000' => esc_html__( '5 Seconds', 'tp-elements' ), 
                    '4000' => esc_html__( '4 Seconds', 'tp-elements' ), 
                    '3000' => esc_html__( '3 Seconds', 'tp-elements' ), 
                    '2000' => esc_html__( '2 Seconds', 'tp-elements' ), 
                    '1000' => esc_html__( '1 Seconds', 'tp-elements' ),     
                ],
                'separator' => 'before',
                'condition' => [
                    'slider_autoplay' => 'true',
                ],                                                      
            ]
        );

        $this->add_control(
            'slider_stop_on_interaction',
            [
                'label'   => esc_html__( 'Stop On Interaction', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',               
                'options' => [
                    'true' => esc_html__( 'Enable', 'tp-elements' ),
                    'false' => esc_html__( 'Disable', 'tp-elements' ),              
                ],
                'separator' => 'before',
                'condition' => [
                    'slider_autoplay' => 'true',
                ],                                                      
            ]
            
        );

        $this->add_control(
            'slider_stop_on_hover',
            [
                'label'   => esc_html__( 'Stop on Hover', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',               
                'options' => [
                    'true' => esc_html__( 'Enable', 'tp-elements' ),
                    'false' => esc_html__( 'Disable', 'tp-elements' ),              
                ],
                'separator' => 'before',
                'condition' => [
                    'slider_autoplay' => 'true',
                ],                                                      
            ]
            
        );

        $this->add_control(
            'slider_loop',
            [
                'label'   => esc_html__( 'Loop', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__( 'Enable', 'tp-elements' ),
                    'false' => esc_html__( 'Disable', 'tp-elements' ),
                ],
                'separator' => 'before',            
            ]
        );

        $this->add_control(
            'slider_centerMode',
            [
                'label'   => esc_html__( 'Center Mode', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__( 'Enable', 'tp-elements' ),
                    'false' => esc_html__( 'Disable', 'tp-elements' ),
                ],
                'separator' => 'before',            
            ]
        );

        $this->add_control(
            'item_gap_custom',
            [
                'label' => esc_html__( 'Item Gap', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,               
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 15,
                ],          
            ]
        ); 
                
        $this->end_controls_section();
   
        $this->start_controls_section(
            '_section_style_grid',
            [
                'label' => esc_html__( 'Slider Style', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__( 'Content Space', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-hero-slider-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_space',
            [
                'label' => esc_html__( 'Title Space', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-hero-slider-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-hero-slider-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .tp-hero-slider-title',
            ]
        );

        $this->add_control(
		    'subtitle_image_width',
		    [
		        'label' => esc_html__( 'subtitle imagee width', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
		        'selectors' => [    
		            '{{WRAPPER}} .tp-hero-slider-subtitle img' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',	 	            
		        ],
		    ]
		);

        $this->add_responsive_control(
            'subtitle_space',
            [
                'label' => esc_html__( 'SubTitle Space', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-hero-slider-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__( 'Sub Title Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-hero-slider-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'selector' => '{{WRAPPER}} .tp-hero-slider-subtitle',
            ]
        );

        $this->add_control(
            'des__styles',
            [
                'label' => esc_html__( 'Description Styles', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'des__color',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-hero-slider-description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'des__typography',
                'selector' => '{{WRAPPER}} .tp-hero-slider-description',
            ]
        );

        $this->add_responsive_control(
            'des__margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-hero-slider-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->end_controls_section();


		$this->start_controls_section(
		    '_section_style_banner_image',
		    [
		        'label' => esc_html__( 'Banner Image', 'tp-elements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);

        $this->add_control(
		    'banner_image_width',
		    [
		        'label' => esc_html__( 'Imagee width', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
		        'selectors' => [    
		            '{{WRAPPER}} .tp-hero-slider-image img' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',		            
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'banner_image_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-hero-slider-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'banner_image_margin',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-hero-slider-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

        $this->end_controls_section();

		$this->start_controls_section(
		    '_section_style_button',
		    [
		        'label' => esc_html__( 'Button', 'tp-elements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->start_controls_tabs( '_tabs_button' );

		$this->start_controls_tab(
            'style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
            ]
        ); 

		$this->add_control(
		    'btn_text_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .themephi-button a' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .themephi-button a span' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'link_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'btn_typography',
		        'selector' => '{{WRAPPER}} .themephi-button a',
		    ]
		);

		$this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'background_normal',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .themephi-button a::after, {{WRAPPER}} .themephi-button a',
			]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'button_border',
		        'selector' => '{{WRAPPER}} .themephi-button a',
		    ]
		);

		$this->add_control(
		    'button_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'button_box_shadow',
		        'selector' => '{{WRAPPER}} .themephi-button a',
		    ]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'tp-elements' ),
            ]
        ); 

		$this->add_control(
		    'btn_text_hover_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .themephi-button a:hover' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .themephi-button a:hover span' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'link_hover_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-button a:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'btn_hover_typography',
		        'selector' => '{{WRAPPER}} .themephi-button a:hover',
		    ]
		);

		$this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .themephi-button a:hover',
			]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'button_hover_border',
		        'selector' => '{{WRAPPER}} .themephi-button a:hover',
		    ]
		);

		$this->add_control(
		    'button_hover_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-button a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'button_hover_box_shadow',
		        'selector' => '{{WRAPPER}} .themephi-button a:hover',
		    ]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
		    '_section_style_icon',
		    [
		        'label' => esc_html__( 'Icon', 'tp-elements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_control(
		    'icon_text_color',
		    [
		        'label' => esc_html__( 'Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .themephi-button a i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themephi-button a svg' => 'fill: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'icon_hover_color',
		    [
		        'label' => esc_html__( 'Hover Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .themephi-button a:hover i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themephi-button a:hover svg' => 'fill: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'icon_background',			[
				
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => ['{{WRAPPER}} .themephi-button a i' => 'background: {{VALUE}};',],
			]
		);

		$this->add_control(
		    'icon_hover_background',			[
				
				'label' => esc_html__( 'Hover Background', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => ['{{WRAPPER}} .themephi-button a:hover i'=> 'background: {{VALUE}};',],
			]
		);

		
		$this->add_responsive_control(
		    'icon_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-button a i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);


		$this->add_control(
		    'icon_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-button a i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_section();

    }
    protected function render() {
        $settings = $this->get_settings_for_display();
        $col_xxl          = $settings['col_xxl'];
        $col_xxl          = !empty($col_xxl) ? $col_xxl : 3;
        $slidesToShow    = $col_xxl;
        $autoplaySpeed   = $settings['slider_autoplay_speed'];
        $autoplaySpeed   = !empty($autoplaySpeed) ? $autoplaySpeed : '1000';
        $interval        = $settings['slider_interval'];
        $interval        = !empty($interval) ? $interval : '3000';
        $slidesToScroll  = $settings['slides_ToScroll'];
        $slider_autoplay = $settings['slider_autoplay'] === 'true' ? 'true' : 'false';
        $pauseOnHover    = $settings['slider_stop_on_hover'] === 'true' ? 'true' : 'false';
        $pauseOnInter    = $settings['slider_stop_on_interaction'] === 'true' ? 'true' : 'false';
        $sliderDots      = $settings['slider_dots'] == 'true' ? 'true' : 'false';
        $sliderNav       = $settings['slider_nav'] == 'true' ? 'true' : 'false';        
        $infinite        = $settings['slider_loop'] === 'true' ? 'true' : 'false';
        $centerMode      = $settings['slider_centerMode'] === 'true' ? 'true' : 'false';
        $col_xl          = $settings['col_xl'];
        $col_lg          = $settings['col_lg'];
        $col_md          = $settings['col_md'];
        $col_sm          = $settings['col_sm'];
        $col_xs          = $settings['col_xs'];
        $item_gap        = $settings['item_gap_custom']['size'];
        $item_gap        = !empty($item_gap) ? $item_gap : '30';   
        $unique          = rand(2012,35120);
        
        if( $slider_autoplay =='true' ){
            $slider_autoplay = 'autoplay: { ' ;
            $slider_autoplay .= 'delay: '.$interval;
            if(  $pauseOnHover =='true'  ){
                $slider_autoplay .= ', pauseOnMouseEnter: true';
            }else{
                $slider_autoplay .= ', pauseOnMouseEnter: false';
            }
            if(  $pauseOnInter =='true'  ){
                $slider_autoplay .= ', disableOnInteraction: true';
            }else{
                $slider_autoplay .= ', disableOnInteraction: false';
            }
            $slider_autoplay .= ' }';
        }else{
            $slider_autoplay = 'autoplay: false' ;
        }

        $effect = $settings['rt_pslider_effect'];

        if($effect== 'fade'){
            $seffect = "effect: 'fade', fadeEffect: { crossFade: true, },";
        }elseif($effect== 'cube'){
            $seffect = "effect: 'cube',";
        }elseif($effect== 'flip'){
            $seffect = "effect: 'flip',";
        }elseif($effect== 'coverflow'){
            $seffect = "effect: 'coverflow',";
        }elseif($effect== 'creative'){
            $seffect = "effect: 'creative', creativeEffect: { prev: { translate: [0, 0, -400], }, next: { translate: ['100%', 0, 0], }, },";
        }elseif($effect== 'cards'){
            $seffect = "effect: 'cards',";
        }else{
            $seffect = '';
        }

        if ( empty($settings['hero_items'] ) ) {
            return;
        }

        $sstyle = $settings['tp_slider_style'];

        ?>
        <style>
            .slider-style1 .tp-slide-item span.tp-hero-slider-subtitle {
                display: inline-flex;
                align-items: center;
                gap: 8px;
            }
            .slider-style1 .tp-slide-item * {
                opacity: 0;
                visibility: hidden;
            }
            .slider-style1 .tp-slide-item.swiper-slide-active * {
                opacity: 1;
                visibility: visible;
            }
            .slider-style1 .tp-slide-item .tp-hero-slider-subtitle {
                transform: translateY(40px);
                transition: 0.7s;
            }
            .slider-style1 .tp-slide-item.swiper-slide-active .tp-hero-slider-subtitle {
                transform: translateY(0px);
            }
            .slider-style1 .tp-slide-item .tp-hero-slider-title {
                transform: translateY(40px);
                transition: 0.7s;
            }
            .slider-style1 .tp-slide-item.swiper-slide-active .tp-hero-slider-title {
                transform: translateY(0px);
            }
            .slider-style1 .tp-slide-item .tp-hero-slider-description {
                transform: translateY(50px);
                transition: 0.9s;
            }
            .slider-style1 .tp-slide-item.swiper-slide-active .tp-hero-slider-description {
                transform: translateY(0px);
            }
            .slider-style1 .tp-slide-item .themephi-button {
                transform: translateY(60px);
                transition: 1.3s;
            }
            .slider-style1 .tp-slide-item.swiper-slide-active .themephi-button {
                transform: translateY(0px);
            }
            .slider-style1 .tp-slide-item .tp-hero-slider-image img {
                transform: translateY(-90px);
                transition: 1.3s;
            }
            .slider-style1 .tp-slide-item.swiper-slide-active .tp-hero-slider-image img {
                transform: translateY(0px);
            }
        </style>
            <div class="slider-inner-wrapper">
                <div class="themephi-addon-slider swiper slider-<?php echo esc_attr( $sstyle ); ?> tp_slider-<?php echo esc_attr($unique); ?>">

                    <div class="swiper-wrapper">                   
                        <?php
                        $total_number = count( $settings['hero_items'] );
                        foreach ( $settings['hero_items'] as $index => $item ) :                     
                            $imgId = $item['image']['id'];
                            $sub_imgId = $item['sub_image']['id'];
                                        
                            if($imgId ){
                                $image = wp_get_attachment_image_src($imgId, 'full')[0];
                                $IMGstyle = 'style="background-image: url( '. $image .' );"';
                            }else{
                                $IMGstyle = '';
                                $image = '';
                            }                            
               
                            if($sub_imgId ){
                                $sub_image = wp_get_attachment_image_src($sub_imgId, 'full')[0];
                            }else{
                                $sub_image = '';
                            }                            
               
                            $sub_title    = !empty($item['sub_title']) ? $item['sub_title'] : '';
                            $hero_title   = !empty($item['hero_title']) ? $item['hero_title'] : '';                                 
                            $description  = !empty($item['description']) ? $item['description'] : '';    
                            $btn_text  = !empty($item['btn_text']) ? $item['btn_text'] : '';    
                            $btn_link  = !empty($item['btn_link']['url']) ? $item['btn_link']['url'] : '';    
                            $target = $item['btn_link']['is_external'] ? 'target=_blank' : '';

                            if($sstyle){
                                require plugin_dir_path(__FILE__)."/$sstyle.php";
                            }else{
                                require plugin_dir_path(__FILE__)."/style1.php";
                            }
                            endforeach; 
                        ?>
                    </div>   
                    
                    <?php
                    
                    if( $sliderNav == 'true' ){
                        echo '<div class="tp-hero-slider-navigation d-flex"><div class="tp-hero-nav-prev tps-prev'.esc_attr($unique).'"><i class="tp tp-arrow-left"></i></div><div class="tp-hero-nav-next tps-next'.esc_attr($unique).'"><i class="tp tp-arrow-right"></i></div></div>';
                    }
                
                    if( $sliderDots == 'true' ) echo '<div class="swiper-pagination tp-hero-slide-pagination"></div>';

                    ?>

            
                </div>
            </div>
          
            <script type="text/javascript"> 
                jQuery(document).ready(function(){
                    var swiper<?php echo esc_attr($unique); ?><?php echo esc_attr($unique); ?> = new Swiper(".tp_slider-<?php echo esc_attr($unique); ?>", {				
                        slidesPerView: 1,
                        <?php echo $seffect; ?>
                        speed: <?php echo esc_attr($autoplaySpeed); ?>,
                        slidesPerGroup: 1,
                        loop: <?php echo esc_attr($infinite ); ?>,
                    <?php echo esc_attr($slider_autoplay); ?>,
                    spaceBetween:  <?php echo esc_attr($item_gap); ?>,
                    pagination: {
                        el: ".tp-hero-slide-pagination",
                        clickable: true,
                        },
                        centeredSlides: <?php echo esc_attr($centerMode); ?>,
                        navigation: {
                            nextEl: ".tps-next<?php echo esc_attr($unique); ?>",
                            prevEl: ".tps-prev<?php echo esc_attr($unique); ?>",
                        },
                        breakpoints: {
                            <?php
                            echo (!empty($col_xs)) ?  '0: { slidesPerView: '. $col_xs .' },' : '';
                            echo (!empty($col_sm)) ?  '575: { slidesPerView: '. $col_sm .' },' : '';
                            echo (!empty($col_md)) ?  '767: { slidesPerView: '. $col_md .' },' : '';
                            echo (!empty($col_lg)) ?  '991: { slidesPerView: '. $col_lg .' },' : '';
                            echo (!empty($col_xl)) ?  '1199: { slidesPerView: '. $col_xl .' },' : '';
                            ?>
                            1399: {
                                slidesPerView: <?php echo esc_attr($col_xxl); ?>,
                                spaceBetween:  <?php echo esc_attr($item_gap); ?>
                            }
                        }
                    });
                });
            </script>
        <?php
    }
}