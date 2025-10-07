<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Css_Filter;

defined( 'ABSPATH' ) || die();

class Themephi_Elementor_Coupons_Grid_Widget extends \Elementor\Widget_Base {

	 
	/**
	 * Get widget name.
	 *
	 * Retrieve counter widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'tp-coupons-grid';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve counter widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'TP Coupons Grid', 'tp-elements' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve counter widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'glyph-icon flaticon-support';
	}

	/**
	 * Retrieve the list of scripts the counter widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_categories() {
        return [ 'pielements_category' ];
    }


	/**
	 * Register services widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
		protected function register_controls() {

		$this->start_controls_section(
			'section_coupon',
			[
				'label' => esc_html__( 'Coupons Global', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		

		$this->add_control(
			'coupon_style',
			[
				'label'   => esc_html__( 'Select Coupon Style', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [					
					'style1' => esc_html__( 'Style 1', 'tp-elements'),	
					// 'style2' => esc_html__( 'Style 2', 'tp-elements'),	
					// 'style3' => esc_html__( 'Style 3', 'tp-elements'),	
					// 'store1' => esc_html__( 'Store 1', 'tp-elements'),	
				],
			]
		);

				
		$this->add_control(
			'coupon_grid_source',
			[
				'label'   => esc_html__( 'Select Coupon Type', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'dynamic',				
				'options' => [
                    'dynamic' => esc_html__('Dynamic', 'tp-elements'),
					'slider' => esc_html__('Slider', 'tp-elements'),					
				],											
			]
		);

        $this->add_control(
			'enable_item_massonry',  
			[
				'label' => esc_html__( 'Enable Massonry ?', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'tp-elements' ),
				'label_off' => esc_html__( 'Hide', 'tp-elements' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'coupon_grid_source' => 'dynamic',
				],
			]
		);

        $this->add_control(
			'enable_item_gutter',
			[
				'label' => esc_html__( 'Enable Gutter Space ?', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'tp-elements' ),
				'label_off' => esc_html__( 'Hide', 'tp-elements' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'coupon_grid_source' => 'dynamic',
				],
			]
		); 

		$this->add_control(
			'show_filter',
			[
				'label'   => esc_html__( 'Show Filter', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'filter_hide',	
				'separator' => 'before',		
				'options' => [
					'filter_show' => 'Show',
					'filter_hide' => 'Hide',				
				],
				'condition' => [
					'coupon_grid_source' => 'dynamic',
				],											
			]
		);
		
		$this->add_control(
			'enable_filter_icon',
			[
				'label' => esc_html__( 'Enable Filter Icon ?', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'tp-elements' ),
				'label_off' => esc_html__( 'Hide', 'tp-elements' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'show_filter' => 'filter_show',
					'coupon_grid_source' => 'dynamic',
				],
			]
		);

		$this->add_control(
			'filter_title',
			[
				'label' => esc_html__( 'Filter Default Title', 'tp-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => __('All', 'tp-elements'),
				'condition' => [
					'show_filter' => 'filter_show',
					'coupon_grid_source' => 'dynamic',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'coupon_exapansion',
			[
				'label'   => esc_html__( 'Slider Expansion', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'expansion-right',
				'options' => [					
					'expansion-right' => esc_html__( 'Right Expansion', 'tp-elements'),
					'expansion-left' => esc_html__( 'Left Expansion', 'tp-elements'),	
				],
				'condition' => [
					'coupon_grid_source' => 'slider',
				],
			]
		);
		
		$this->add_control(
			'store_box_position',
			[
				'label'   => esc_html__( 'Store Box Position', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'top',				
				'options' => [
                    'top' => esc_html__('Top', 'tp-elements'),
					'bottom' => esc_html__('Bottom', 'tp-elements'),					
				],
				'condition' => [
					'coupon_style' => 'style2',
				],											
			]
		);

		$this->add_control(
			'coupon_category',
			[
				'label'   => esc_html__( 'Category', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT2,	
				'default' => 0,			
				'options' => $this->getCategories(),
				'multiple' => true,	
				'separator' => 'before',
				// 'condition' => [
				// 	'show_filter' => 'filter_show',
				// 	'coupon_grid_source' => 'dynamic',
				// ],		
			]
		);

		$this->add_control(
			'coupon_store',
			[
				'label'   => esc_html__( 'Store', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT2,	
				'default' => 0,			
				'options' => $this->getStores(),
				'multiple' => true,	
				'separator' => 'before',		
			]
		);

		$this->add_control(
            'coupon_orderby',
            [
                'label'   => esc_html__( 'Order By', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'title',
                'options' => [
					'date' => esc_html__( 'Latest', 'tp-elements' ),
					'popular' => esc_html__( 'Popular', 'tp-elements' ),
					'ending'  => esc_html__( 'Ending Soon', 'tp-elements' ),
                    'title' => esc_html__( 'Title', 'tp-elements' ), 
                    'rend' => esc_html__( 'Random', 'tp-elements' ),               
                ],
                'separator' => 'before',
            ]
        );

		$this->add_control(
            'coupon_order',
            [
                'label'   => esc_html__( 'Order', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'DESC',
                'options' => [
                    'ASC' => esc_html__( 'Ascending', 'tp-elements' ), 
                    'DESC' => esc_html__( 'Descending', 'tp-elements' ),              
                ],
                'separator' => 'before',
            ]
        );

		$this->add_control(
            'coupon_type',
            [
                'label'   => esc_html__( 'Coupon Type', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => '',
                'options' => [
					'' => esc_html__( 'All', 'tp-elements' ),
					'1' => esc_html__( 'Online Code', 'tp-elements' ),
					'2' => esc_html__( 'In Store Code', 'tp-elements' ),
					'3' => esc_html__( 'Online Sale', 'tp-elements' ),             
                ],
                'separator' => 'before',
            ]
        );

		$this->add_control(
			'per_page',
			[
				'label' => esc_html__( 'Coupons Show Per Page', 'tp-elements' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'example 3', 'tp-elements' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
            'even_col_xxl',
            [
                'label'   => esc_html__( 'Desktops > 1399px', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3,
                'options' => [
                    '12' => esc_html__( '1 Column', 'tp-elements' ), 
                    '6' => esc_html__( '2 Column', 'tp-elements' ),
                    '4' => esc_html__( '3 Column', 'tp-elements' ),
                    '3' => esc_html__( '4 Column', 'tp-elements' ),
                    '2' => esc_html__( '6 Column', 'tp-elements' ),                 
                ],
                'separator' => 'before',
				'condition' => [
					'coupon_grid_source' => 'dynamic',
				],	        
            ]
            
        );

		$this->add_control(
            'even_col_xl',
            [
                'label'   => esc_html__( 'Desktops > 1199px', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3,
                'options' => [
                    '12' => esc_html__( '1 Column', 'tp-elements' ), 
                    '6' => esc_html__( '2 Column', 'tp-elements' ),
                    '4' => esc_html__( '3 Column', 'tp-elements' ),
                    '3' => esc_html__( '4 Column', 'tp-elements' ),
                    '2' => esc_html__( '6 Column', 'tp-elements' ),                 
                ],
                'separator' => 'before',
				'condition' => [
					'coupon_grid_source' => 'dynamic',
				],	        
            ]
            
        );

		$this->add_control(
            'even_col_lg',
            [
                'label'   => esc_html__( 'Desktops > 991px', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 4,
                'options' => [
                    '12' => esc_html__( '1 Column', 'tp-elements' ), 
                    '6' => esc_html__( '2 Column', 'tp-elements' ),
                    '4' => esc_html__( '3 Column', 'tp-elements' ),
                    '3' => esc_html__( '4 Column', 'tp-elements' ),
                    '2' => esc_html__( '6 Column', 'tp-elements' ),                 
                ],
                'separator' => 'before',
				'condition' => [
					'coupon_grid_source' => 'dynamic',
				],	        
            ]
            
        );

        $this->add_control(
            'even_col_md',
            [
                'label'   => esc_html__( 'Desktops > 768px', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 6,         
                'options' => [
                    '12' => esc_html__( '1 Column', 'tp-elements' ), 
                    '6' => esc_html__( '2 Column', 'tp-elements' ),
                    '4' => esc_html__( '3 Column', 'tp-elements' ),
                    '3' => esc_html__( '4 Column', 'tp-elements' ),
                    '2' => esc_html__( '6 Column', 'tp-elements' ),                   
                ],
                'separator' => 'before',
				'condition' => [
					'coupon_grid_source' => 'dynamic',
				],           
            ]
            
        );

        $this->add_control(
            'even_col_sm',
            [
                'label'   => esc_html__( 'Tablets > 576px', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 6,         
                'options' => [
                    '12' => esc_html__( '1 Column', 'tp-elements' ), 
                    '6' => esc_html__( '2 Column', 'tp-elements' ),
                    '4' => esc_html__( '3 Column', 'tp-elements' ),
                    '3' => esc_html__( '4 Column', 'tp-elements' ),
                    '2' => esc_html__( '6 Column', 'tp-elements' ),                  
                ],
                'separator' => 'before',
				'condition' => [
					'coupon_grid_source' => 'dynamic',
				],           
            ] 
        );

        $this->add_control(
            'even_col_xs',
            [
                'label'   => esc_html__( 'Tablets < 575px', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 12,         
                'options' => [
                    '12' => esc_html__( '1 Column', 'tp-elements' ), 
                    '6' => esc_html__( '2 Column', 'tp-elements' ),
                    '4' => esc_html__( '3 Column', 'tp-elements' ),
                    '3' => esc_html__( '4 Column', 'tp-elements' ),
                    '2' => esc_html__( '6 Column', 'tp-elements' ),                 
                ],
                'separator' => 'before',
				'condition' => [
					'coupon_grid_source' => 'dynamic',
				],           
            ]
        );

		$this->add_control(
			'image_show_hide',
			[
				'label'   => esc_html__( 'Image Show Hide', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'yes',				
				'options' => [
                    'yes' => esc_html__('Yes', 'tp-elements'),
					'no' => esc_html__('No', 'tp-elements'),					
				],										
			]
		);

		$this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ],
				'condition' => [
					'image_show_hide' => 'yes',
				], 
            ]
        );

		$this->add_responsive_control(
            'image_or_icon_position',
            [
                'label' => esc_html__( 'Image / Icon Position', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'elementor-postion-left' => [
                        'title' => esc_html__( 'Left', 'tp-elements' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'elementor-postion-top' => [
                        'title' => esc_html__( 'Top', 'tp-elements' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'elementor-postion-bottom' => [
                        'title' => esc_html__( 'Bottom', 'tp-elements' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                    'elementor-postion-right' => [
                        'title' => esc_html__( 'Right', 'tp-elements' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'toggle' => true,
				'default' => 'elementor-postion-top',
				'separator' => 'before',
            ]
        );
		$this->add_responsive_control(
            'image_or_icon_vertical_align',
            [
                'label' => esc_html__( 'Vertical Alignment', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'elementor-vertical-align-top' => [
                        'title' => esc_html__( 'Top', 'tp-elements' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'elementor-vertical-align-middle' => [
                        'title' => esc_html__( 'Middle', 'tp-elements' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'elementor-vertical-align-bottom' => [
                        'title' => esc_html__( 'Bottom', 'tp-elements' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'toggle' => true,
				'separator' => 'before',
				'default' => 'elementor-vertical-align-top',
				'condition' => [
					'image_or_icon_position' => ['elementor-postion-left', 'elementor-postion-right'],
				],
            ]
        );

		$this->add_responsive_control(
            'align',
            [
                'label' => esc_html__( 'Alignment', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
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
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'tp-elements' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-item' => 'text-align: {{VALUE}}',
                ],
				'separator' => 'before',
            ]
        );

		$this->add_control(
            'coupon_pagination_show_hide',
            [
                'label' => esc_html__( 'Pagination Show / Hide', 'tp-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'tp-elements' ),
                    'no' => esc_html__( 'No', 'tp-elements' ),
                ],                
                'separator' => 'before',
				'condition' => [
					'coupon_grid_source' => 'dynamic',
				],
            ]
        );
		
		$this->end_controls_section();	

		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title & Description', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
	
		$this->add_control(
            'coupon_title_show_hide',
            [
                'label' => esc_html__( 'Title Show / Hide', 'tp-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'tp-elements' ),
                    'no' => esc_html__( 'No', 'tp-elements' ),
                ],                
                'separator' => 'before',
            ]
        );

		$this->add_control(
            'title_word_count',
            [
                'label' => esc_html__( 'Title Word Count', 'tp-elements' ),
                'type' => Controls_Manager::NUMBER,  
				'condition' => [
					'coupon_title_show_hide' => 'yes',
				],         
            ]
        );

		$this->add_control(
			'link_open',
			[
				'label'   => esc_html__( 'Link Open New Window', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [					
					'no' => esc_html__( 'No', 'tp-elements'),
					'yes' => esc_html__( 'Yes', 'tp-elements'),					

				],
			]
		);

		$this->add_control(
		    'title_tag',
		    [
		        'label' => esc_html__( 'Title HTML Tag', 'tp-elements' ),
		        'type' => Controls_Manager::CHOOSE,
		        'options' => [
		            'h1'  => [
		                'title' => esc_html__( 'H1', 'tp-elements' ),
		                'icon' => 'eicon-editor-h1'
		            ],
		            'h2'  => [
		                'title' => esc_html__( 'H2', 'tp-elements' ),
		                'icon' => 'eicon-editor-h2'
		            ],
		            'h3'  => [
		                'title' => esc_html__( 'H3', 'tp-elements' ),
		                'icon' => 'eicon-editor-h3'
		            ],
		            'h4'  => [
		                'title' => esc_html__( 'H4', 'tp-elements' ),
		                'icon' => 'eicon-editor-h4'
		            ],
		            'h5'  => [
		                'title' => esc_html__( 'H5', 'tp-elements' ),
		                'icon' => 'eicon-editor-h5'
		            ],
		            'h6'  => [
		                'title' => esc_html__( 'H6', 'tp-elements' ),
		                'icon' => 'eicon-editor-h6'
		            ]
		        ],
		        'default' => 'h4',
		        'toggle' => false,
				'condition' => [
					'coupon_title_show_hide' => 'yes',
				], 
		    ]
		);

		$this->add_control(
            'coupon_text_show_hide',
            [
                'label' => esc_html__( 'Content Show / Hide', 'tp-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'tp-elements' ),
                    'no' => esc_html__( 'No', 'tp-elements' ),
                ],                
                'separator' => 'before',
            ]
        );

		$this->add_control(
            'coupon_text_word_limit',
            [
                'label' => esc_html__( 'Show Content Limit', 'tp-elements' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( '20', 'tp-elements' ),
                'separator' => 'before',
                'condition' => [
                    'coupon_text_show_hide' => 'yes',
                ]
            ]
        );

		$this->add_control(
            'coupon_rich_text_show_hide',
            [
                'label' => esc_html__( 'Rich Text Show / Hide', 'tp-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'tp-elements' ),
                    'no' => esc_html__( 'No', 'tp-elements' ),
                ],                
                'separator' => 'before',
            ]
        );

		$this->end_controls_section();	
		
		$this->start_controls_section(
			'section_upper_meta',
			[
				'label' => esc_html__( 'Coupons Upper Meta', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				]
			);

			$this->add_control(
				'coupon_upper_meta_show_hide',
				[
					'label' => esc_html__( 'Meta Show / Hide', 'tp-elements' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'tp-elements' ),
						'no' => esc_html__( 'No', 'tp-elements' ),
					],                
					'separator' => 'before',
				]
			);

			$this->add_control(
				'meta_upper_position',
				[
					'label'   => esc_html__( 'Meta Position', 'tp-elements' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'bottom_of_image',				
					'options' => [
						'top_of_image' => esc_html__('Top Of Image', 'tp-elements'),
						'bottom_of_image' => esc_html__('Bottom Of Image', 'tp-elements'),					
					],
					'condition' => [
						'coupon_upper_meta_show_hide' => 'yes',
					],											
				]
			);
					
			$this->add_control(
				'coupon_share_show_hide',
				[
					'label' => esc_html__( 'Show Share ?', 'tp-elements' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'tp-elements' ),
						'no' => esc_html__( 'No', 'tp-elements' ),
					],                
					'separator' => 'before',
					'condition' => [
						'coupon_upper_meta_show_hide' => ['yes'],
					],
				]
			);
			
			$this->add_control(
				'share_icon',
				[
					'label' => esc_html__( 'Share Icon', 'textdomain' ),
					'type' => Controls_Manager::ICONS,
					'default' => [
						'value' => 'fas fa-share', 
						'library' => 'fa-solid',
					], 
					'condition' => [
						'coupon_upper_meta_show_hide' => ['yes'],
						'coupon_share_show_hide' => ['yes'],
					],
				]
			);

			
			$this->add_control(
				'coupon_favourite_show_hide',
				[
					'label' => esc_html__( 'Show Favourite?', 'tp-elements' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'tp-elements' ),
						'no' => esc_html__( 'No', 'tp-elements' ),
					],                
					'separator' => 'before',
					'condition' => [
						'coupon_upper_meta_show_hide' => ['yes'],
					],
				]
			);

			$this->add_control(
				'favourite_icon',
				[
					'label' => esc_html__( 'Favourite Icon', 'textdomain' ),
					'type' => Controls_Manager::ICONS,
					'default' => [
						'value' => 'far fa-heart',
						'library' => 'fa-regular',
					],
					'condition' => [
						'coupon_upper_meta_show_hide' => ['yes'],
						'coupon_favourite_show_hide' => ['yes'],
					],
				]
			);

		$this->end_controls_section();	

		$this->start_controls_section(
			'section_meta',
			[
				'label' => esc_html__( 'Coupons Meta', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
            'coupon_meta_show_hide',
            [
                'label' => esc_html__( 'Meta Show / Hide', 'tp-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'tp-elements' ),
                    'no' => esc_html__( 'No', 'tp-elements' ),
                ],                
                'separator' => 'before',
            ]
        );

		$this->add_control(
			'meta_position',
			[
				'label'   => esc_html__( 'Meta Position', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'after_title',				
				'options' => [
                    'after_title' => esc_html__('After Title', 'tp-elements'),
					'before_title' => esc_html__('Before Title', 'tp-elements'),					
				],
				'condition' => [
					'coupon_meta_show_hide' => 'yes',
				],											
			]
		);

		$this->add_control(
            'coupon_comments_show_hide',
            [
                'label' => esc_html__( 'Show Comments?', 'tp-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'tp-elements' ),
                    'no' => esc_html__( 'No', 'tp-elements' ),
                ],                
                'separator' => 'before',
				'condition' => [
					'coupon_meta_show_hide' => ['yes'],
				],
            ]
        );

		$this->add_control(
			'comments_icon',
			[
				'label' => esc_html__( 'Comments Icon', 'textdomain' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-comment-alt',
					'library' => 'fa-regular',
				],
				'condition' => [
					'coupon_meta_show_hide' => ['yes'],
					'coupon_comments_show_hide' => ['yes'],
				],
			]
		);

        $this->add_control(
            'coupon_usage_show_hide',
            [
                'label' => esc_html__( 'Show Usage Amount?', 'tp-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'tp-elements' ),
                    'no' => esc_html__( 'No', 'tp-elements' ),
                ],                
                'separator' => 'before',
				'condition' => [
					'coupon_meta_show_hide' => ['yes'],
				],
            ]
        );

		$this->add_control(
			'usage_icon',
			[
				'label' => esc_html__( 'Usage Icon', 'textdomain' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-unlock',
					'library' => 'fa-solid',
				],
				'condition' => [
					'coupon_meta_show_hide' => ['yes'],
					'coupon_usage_show_hide' => ['yes'],
				], 
			]
		);

        $this->add_control(
            'coupon_feedback_show_hide',
            [
                'label' => esc_html__( 'Show Feedback?', 'tp-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'tp-elements' ),
                    'no' => esc_html__( 'No', 'tp-elements' ),
                ],                
                'separator' => 'before',
				'condition' => [
					'coupon_meta_show_hide' => ['yes'],
				],
            ]
        );

		$this->add_control(
			'feedback_icon',
			[
				'label' => esc_html__( 'Feedback Icon', 'textdomain' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-thumbs-up',
					'library' => 'fa-solid',
				],
				'condition' => [
					'coupon_meta_show_hide' => ['yes'],
					'coupon_feedback_show_hide' => ['yes'],
				], 
			]
		);

        $this->add_control(
            'coupon_expired_show_hide',
            [
                'label' => esc_html__( 'Show Expiration Time?', 'tp-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'tp-elements' ),
                    'no' => esc_html__( 'No', 'tp-elements' ),
                ],                
                'separator' => 'before',
				'condition' => [
					'coupon_meta_show_hide' => ['yes'],
				],
            ]
        );

		$this->add_control(
            'coupon_expired_type',
            [
                'label' => esc_html__( 'What Befor Date', 'tp-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'date_icon',
                'options' => [
                    'date_icon' => esc_html__( 'Icon ', 'tp-elements' ),
                    'date_text' => esc_html__( 'Text', 'tp-elements' ),
                ],                
                'separator' => 'before',
				'condition' => [
					'coupon_meta_show_hide' => ['yes'],
					'coupon_expired_show_hide' => ['yes'],
				],
            ]
        );

		$this->add_control(
			'expire_icon',
			[
				'label' => esc_html__( 'Expirity Icon', 'textdomain' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-calendar-check',
					'library' => 'fa-regular',
				],
				'condition' => [
					'coupon_meta_show_hide' => ['yes'],
					'coupon_expired_type' => ['date_icon'],
					'coupon_expired_show_hide' => ['yes'],
				], 
			]
		);

		$this->add_control(
			'expire_text',
			[
				'label' => esc_html__( 'Expirity Text', 'textdomain' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html('Expired at:', 'textdomain'),
				'condition' => [
					'coupon_meta_show_hide' => ['yes'],
					'coupon_expired_type' => ['date_text'],
					'coupon_expired_show_hide' => ['yes'],
				], 
			]
		);

		$this->end_controls_section();	

		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__( 'Button', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
            'coupon_btn_show_hide',
            [
                'label' => esc_html__( 'Button Show / Hide', 'tp-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'tp-elements' ),
                    'no' => esc_html__( 'No', 'tp-elements' ),
                ],                
                'separator' => 'before',
            ]
        );

		$this->add_control(
			'coupon_btn_text',
			[
				'label' => esc_html__( 'Button Text', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('View All', 'tp-elements'),
				'condition' => [
					'coupon_btn_show_hide' => ['yes'],
					'coupon_style' => ['store1', 'style2', 'style3'],
				],
			]
		);

		$this->add_control(
			'coupon_btn_link_open',
			[
				'label'   => esc_html__( 'Link Open New Window', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [					
					'no' => esc_html__( 'No', 'tp-elements'),
					'yes' => esc_html__( 'Yes', 'tp-elements'),
				],
				'condition' => [
					'coupon_type!' => '1',
					'coupon_btn_show_hide' => ['yes'],
				],
			]
		);

		$this->add_control(
			'coupon_btn_icon',
			[
				'label' => esc_html__( 'Icon', 'tp-elements' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-print',
					'library' => 'solid',
				],			
				'separator' => 'before',	
				'condition' => [
					'coupon_btn_show_hide' => ['yes'],
				],		
			]
		);

		$this->add_control(
		    'coupon_btn_icon_position',
		    [
		        'label' => esc_html__( 'Icon Position', 'tp-elements' ),
		        'type' => Controls_Manager::CHOOSE,
		        'label_block' => false,
		        'options' => [
		            'before' => [
		                'title' => esc_html__( 'Before', 'tp-elements' ),
		                'icon' => 'eicon-h-align-left',
		            ],
		            'after' => [
		                'title' => esc_html__( 'After', 'tp-elements' ),
		                'icon' => 'eicon-h-align-right',
		            ],
		        ],
		        'default' => 'after',
		        'toggle' => false,
		        'condition' => [
		            'coupon_btn_icon!' => '',
					'coupon_btn_show_hide' => ['yes'],
		        ],
		    ]
		); 

		$this->add_control(
		    'coupon_btn_icon_spacing',
		    [
		        'label' => esc_html__( 'Icon Spacing', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		       
		        'condition' => [
		            'coupon_btn_icon!' => '',
					'coupon_btn_show_hide' => ['yes'],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-button .coupon-action-button.icon-before i' => 'margin-right: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-button .coupon-action-button.icon-after i' => 'margin-left: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		
		$this->add_responsive_control(
            'button_position',
            [
                'label' => esc_html__( 'Button Position', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'elementor-btn-postion-top' => [
                        'title' => esc_html__( 'Top', 'tp-elements' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'elementor-btn-postion-bottom' => [
                        'title' => esc_html__( 'Bottom', 'tp-elements' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                    'elementor-btn-postion-right' => [
                        'title' => esc_html__( 'Right', 'tp-elements' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'toggle' => true,
				'default' => 'elementor-btn-postion-bottom',
				'separator' => 'before',
            ]
        );
		$this->add_responsive_control(
            'button_vertical_align',
            [
                'label' => esc_html__( 'Vertical Alignment', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'elementor-btn-vertical-align-top' => [
                        'title' => esc_html__( 'Top', 'tp-elements' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'elementor-btn-vertical-align-middle' => [
                        'title' => esc_html__( 'Middle', 'tp-elements' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'elementor-btn-vertical-align-bottom' => [
                        'title' => esc_html__( 'Bottom', 'tp-elements' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'toggle' => true,
				'separator' => 'before',
				'default' => 'elementor-btn-vertical-align-top',
				'condition' => [
					'button_position' => ['elementor-btn-postion-right'],
				],
            ]
        );

		$this->end_controls_section();

		        
		$this->start_controls_section(
            'content_slider',
            [
                'label' => esc_html__( 'Slider Settings', 'tp-elements' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'coupon_grid_source' => 'slider',
				],                
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
                'label'   => esc_html__( 'Laptop > 767px', 'tp-elements' ),
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
                'label'   => esc_html__( 'Tablets > 575px', 'tp-elements' ),
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
                'default' => 1,         
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
            'slider_navigation',
            [
                'label'   => esc_html__( 'Navigation Arrows', 'tp-elements' ),
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
            'slider_dots',
            [
                'label'   => esc_html__( 'Pagination Dots', 'tp-elements' ),
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
                    '4000' => esc_html__( '4 Seconds', 'tp-elements' ), 
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

        $this->add_responsive_control(
            'item_gap_custom',
            [
                'label' => esc_html__( 'Item Middle Gap', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,               
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 0,
                ],          
            ]
        ); 
      
        $this->end_controls_section();

		// STyle Start From Here

        $this->start_controls_section(
			'section_portfolio_style',
			[
				'label' => esc_html__( 'Filter Button', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_filter' => 'filter_show',
				],
			]
		);

		$this->add_responsive_control(
		    'filter_btn_wrap_margin',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .coupon-filter ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
		    ]
		);

		$this->add_responsive_control(
            'filter_btn_align',
            [
                'label' => esc_html__( 'Alignment', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
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
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'tp-elements' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .coupon-filter' => 'text-align: {{VALUE}}'
                ],
				'separator' => 'before',
            ]
        );

		$this->add_control(
		    'hr_fitler_btn',
		    [
		        'type' => Controls_Manager::DIVIDER,
		        'style' => 'thick',
		    ]
		);

		$this->start_controls_tabs( '_tabs_filter_btn' );

		$this->start_controls_tab(
		    '_tab_filter_btn_normal',
		    [
		        'label' => esc_html__( 'Normal', 'tp-elements' ),
		    ]
		);

		$this->add_responsive_control(
		    'filter_btn_margin',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .coupon-filter button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
		    ]
		);

        $this->add_responsive_control(
            'filter_btn__padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],  
                'selectors' => [
                    '{{WRAPPER}} .coupon-filter button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'filter_btn_typography',
		        'selector' => '{{WRAPPER}} .coupon-filter button',
		    ]
		);


		$this->add_control(
		    'filter_btn_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .coupon-filter button' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'filter_btn_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .coupon-filter button' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);
		
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'filter_btn_button_border',
		        'selector' => '{{WRAPPER}} .coupon-filter button',
		    ]
		);

		$this->add_control(
		    'filter_btn_button_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .coupon-filter button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'filter_btn_button_box_shadow',
		        'selector' => '{{WRAPPER}} .coupon-filter button',
		    ]
		);

		$this->add_control(
		    'filter_icon_only',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Filter Icon/Image', 'tp-elements' ),
		        'separator' => 'before'
		    ]
		);

		$this->add_responsive_control(
		    'filter_image_width',
		    [
		        'label' => esc_html__( 'Image Width', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 400,
		            ],
		            '%' => [
		                'min' => 1,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .coupon-filter img' => 'width: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		    ]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			[
				'name' => 'filter_image_filters',
				'selector' => '{{WRAPPER}} .coupon-filter img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
		    '_tab_filter_btn_hover',
		    [
		        'label' => esc_html__( 'Hover/Active', 'tp-elements' ),
		    ]
		);

		$this->add_control(
		    'filter_btn_hover_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .coupon-filter button:hover' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .coupon-filter button.active' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'filter_btn_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .coupon-filter button:hover' => 'background: {{VALUE}};',
		            '{{WRAPPER}} .coupon-filter button.active' => 'background: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'filter_btn_hover_border',
		        'selector' => '{{WRAPPER}} .coupon-filter button:hover, {{WRAPPER}} .coupon-filter button.active',
		    ]
		);

		$this->add_control(
		    'filter_btn_hover_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .coupon-filter button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            '{{WRAPPER}} .coupon-filter button.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'filter_btn_hover_box_shadow',
		        'selector' => '{{WRAPPER}} .coupon-filter button:hover, {{WRAPPER}} .coupon-filter button.active',
		    ]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			[
				'name' => 'filter_image_active_filters',
				'selector' => '{{WRAPPER}} .coupon-filter button:hover img, {{WRAPPER}} .coupon-filter button.active img',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

        $this->end_controls_section();

		$this->start_controls_section(
		    '_section_wrapper_style',
		    [
		        'label' => esc_html__( 'Item', 'tp-elements' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_responsive_control(
		    'item_margin',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'item_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'item_box_shadow',
		        'selector' => '{{WRAPPER}} .themephi-addon-coupons',
		    ]
		);

		$this->add_control(
		    'hr_one',
		    [
		        'type' => Controls_Manager::DIVIDER,
		        'style' => 'thick',
		    ]
		);

		$this->start_controls_tabs( '_tabs_item' );

		$this->start_controls_tab(
		    '_tab_item_normal',
		    [
		        'label' => esc_html__( 'Normal', 'tp-elements' ),
		    ]
		);

		$this->add_control(
		    'item_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'item_border',
		        'selector' => '{{WRAPPER}} .themephi-addon-coupons',
		    ]
		);

		$this->add_control(
		    'item_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
		    '_tab_item_hover',
		    [
		        'label' => esc_html__( 'Hover', 'tp-elements' ),
		    ]
		);

		$this->add_control(
		    'item_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons:hover' => 'background: {{VALUE}};',
		        ],
		    ]
		);
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'item_hover_border',
		        'selector' => '{{WRAPPER}} .themephi-addon-coupons:hover',
		    ]
		);

		$this->add_control(
		    'item_hover_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();


		$this->end_controls_section();

		$this->start_controls_section(
		    '_section_media_style',
		    [
		        'label' => esc_html__( 'Icon / Image', 'tp-elements' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_control(
			'show_graycale',
			[
				'label' => esc_html__( 'Enable Image Grayscale', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'tp-elements' ),
				'label_off' => esc_html__( 'Hide', 'tp-elements' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_responsive_control(
		    'image_width',
		    [
		        'label' => esc_html__( 'Image Width', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 400,
		            ],
		            '%' => [
		                'min' => 1,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-coupon-item-img img' => 'width: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		    ]
		);

		$this->add_responsive_control(
		    'image_width_box',
		    [
		        'label' => esc_html__( 'Image Box Width', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 400,
		            ],
		            '%' => [
		                'min' => 1,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-coupon-item-img' => 'width: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		    ]
		);

		$this->add_responsive_control(
		    'image_height_box',
		    [
		        'label' => esc_html__( 'Image Box Height', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 400,
		            ],
		            '%' => [
		                'min' => 1,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-coupon-item-img, {{WRAPPER}} .tp-coupon-item-img img' => 'height: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		    ]
		);

		$this->start_popover();

		$this->add_responsive_control(
		    'media_offset_x',
		    [
		        'label' => esc_html__( 'Offset Left', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'condition' => [
		            'offset_toggle' => 'yes'
		        ],
		        'range' => [
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'render_type' => 'ui',

		    ]
		);

		$this->add_responsive_control(
		    'media_offset_y',
		    [
		        'label' => esc_html__( 'Offset Top', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'condition' => [
		            'offset_toggle' => 'yes'
		        ],
		        'range' => [
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'selectors' => [
		            // Media translate styles
		            '(desktop){{WRAPPER}} .tp-coupon-item-img' => '-ms-transform: translate({{media_offset_x.SIZE || 0}}{{UNIT}}, {{media_offset_y.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{media_offset_x.SIZE || 0}}{{UNIT}}, {{media_offset_y.SIZE || 0}}{{UNIT}}); transform: translate({{media_offset_x.SIZE || 0}}{{UNIT}}, {{media_offset_y.SIZE || 0}}{{UNIT}}) !important;',
		            '(tablet){{WRAPPER}} .tp-coupon-item-img' => '-ms-transform: translate({{media_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{media_offset_y_tablet.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{media_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{media_offset_y_tablet.SIZE || 0}}{{UNIT}}); transform: translate({{media_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{media_offset_y_tablet.SIZE || 0}}{{UNIT}}) !important;',
		            '(mobile){{WRAPPER}} .tp-coupon-item-img' => '-ms-transform: translate({{media_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{media_offset_y_mobile.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{media_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{media_offset_y_mobile.SIZE || 0}}{{UNIT}}); transform: translate({{media_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{media_offset_y_mobile.SIZE || 0}}{{UNIT}}) !important;',
		            // Body text styles
		            '{{WRAPPER}} .tp-coupon-item-content-wrapper ' => 'margin-top: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		$this->end_popover();

		$this->add_responsive_control(
		    'media_spacing',
		    [
		        'label' => esc_html__( 'Bottom Spacing', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => ['px'],
		        'selectors' => [
		            '{{WRAPPER}} .tp-coupon-item-img' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'media_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-coupon-item-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		
		$this->add_responsive_control(
		    'media_margin',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-coupon-item-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'media_border',
		        'selector' => '{{WRAPPER}} .tp-coupon-item-img',
		    ]
		);

		$this->add_responsive_control(
		    'media_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [		            
		            '{{WRAPPER}} .tp-coupon-item-img, {{WRAPPER}} .tp-coupon-item-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'media_box_shadow',
		        'exclude' => [
		            'box_shadow_position',
		        ],
		        'selector' => '{{WRAPPER}} .tp-coupon-item-img > img, {{WRAPPER}} .tp-coupon-item-img'
		    ]
		);

		$this->add_control(
		    'icon_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .tp-coupon-item-img' => 'background-color: {{VALUE}} !important',
		        ],
		    ]
		);

		$this->add_control(
		    'icon_hover_bg_color',
		    [
		        'label' => esc_html__( 'Hover Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .elementor-widget-container:hover .tp-coupon-item-img' => 'background-color: {{VALUE}} !important',
		        ],
		    ]
		);

		$this->add_control(
		    'icon_bg_rotate',
		    [
		        'label' => esc_html__( 'Background Rotate', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'deg' ],
		        'default' => [
		            'unit' => 'deg',
		        ],
		        'range' => [
		            'deg' => [
		                'min' => 0,
		                'max' => 360,
		            ],
		        ],
		        'selectors' => [
		            // Icon box transform styles
		            '(desktop){{WRAPPER}} .tp-coupon-item-img' => '-ms-transform: translate({{media_offset_x.SIZE || 0}}px, {{media_offset_y.SIZE || 0}}px) rotate({{SIZE}}deg); -webkit-transform: translate({{media_offset_x.SIZE || 0}}px, {{media_offset_y.SIZE || 0}}px) rotate({{SIZE}}deg); transform: translate({{media_offset_x.SIZE || 0}}px, {{media_offset_y.SIZE || 0}}px) rotate({{SIZE}}deg) !important;',
		            '(tablet){{WRAPPER}} .tp-coupon-item-img' => '-ms-transform: translate({{media_offset_x_tablet.SIZE || 0}}px, {{media_offset_y_tablet.SIZE || 0}}px) rotate({{SIZE}}deg); -webkit-transform: translate({{media_offset_x_tablet.SIZE || 0}}px, {{media_offset_y_tablet.SIZE || 0}}px) rotate({{SIZE}}deg); transform: translate({{media_offset_x_tablet.SIZE || 0}}px, {{media_offset_y_tablet.SIZE || 0}}px) rotate({{SIZE}}deg) !important;',
		            '(mobile){{WRAPPER}} .tp-coupon-item-img' => '-ms-transform: translate({{media_offset_x_mobile.SIZE || 0}}px, {{media_offset_y_mobile.SIZE || 0}}px) rotate({{SIZE}}deg); -webkit-transform: translate({{media_offset_x_mobile.SIZE || 0}}px, {{media_offset_y_mobile.SIZE || 0}}px) rotate({{SIZE}}deg); transform: translate({{media_offset_x_mobile.SIZE || 0}}px, {{media_offset_y_mobile.SIZE || 0}}px) rotate({{SIZE}}deg) !important;',
		        ],
		    ]
		);

		$this->end_controls_section();

		$this->start_controls_section(
		    '_section_content_style',
		    [
		        'label' => esc_html__( 'Content', 'tp-elements' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_responsive_control(
		    'content_padding',
		    [
		        'label' => esc_html__( 'Content Box Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-coupon-item-content-wrapper ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'content_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .tp-coupon-item-content-wrapper ' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'content_border',
		        'selector' => '{{WRAPPER}} .tp-coupon-item-content-wrapper ',
		    ]
		);

		$this->add_responsive_control(
		    'content_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-coupon-item-content-wrapper ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);		

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'content_box_shadow',
		        'exclude' => [
		            'box_shadow_position',
		        ],
		        'selector' => '{{WRAPPER}} .tp-coupon-item-content-wrapper '
		    ]
		);

		$this->end_controls_section();

		$this->start_controls_section(
		    '_section_title_style',
		    [
		        'label' => esc_html__( 'Title', 'tp-elements' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'title_typography',
		        'label' => esc_html__( 'Typography', 'tp-elements' ),
		        'selector' => '{{WRAPPER}}  .themephi-addon-coupons .tp-coupon-title',
		    ]
		);

		$this->add_responsive_control(
		    'title_spacing',
		    [
		        'label' => esc_html__( 'Spacing', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}}  .themephi-addon-coupons .tp-coupon-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'title_color',
		    [
		        'label' => esc_html__( 'Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		             '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-title,
					  {{WRAPPER}}  .themephi-addon-coupons .tp-coupon-title a' => 'color: {{VALUE}}',
		        ],
		    ]
		);

		$this->add_control(
		    'title_hover_color',
		    [
		        'label' => esc_html__( 'Hover Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [

		        	'{{WRAPPER}} .themephi-addon-coupons .tp-coupon-title:hover,
		            {{WRAPPER}}   .themephi-addon-coupons .tp-coupon-title a:hover' => 'color: {{VALUE}}',
					
		        ],
		    ]
		);			

		$this->end_controls_section();


		
		$this->start_controls_section(
			'_section_style_desc',
		    [
			'label' => esc_html__( 'Description', 'tp-elements' ),
			'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'description_typography',
		        'label' => esc_html__( 'Typography', 'tp-elements' ),
		        'selector' => '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-desc',
		    ]
		);

		$this->add_responsive_control(
		    'description_spacing',
		    [
		        'label' => esc_html__( 'Spacing', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'description_color',
		    [
		        'label' => esc_html__( 'Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-desc p, {{WRAPPER}} .themephi-addon-coupons .tp-coupon-desc' => 'color: {{VALUE}}',
		            
		        ],
		    ]
		);

		$this->add_control(
		    'description_hover_color',
		    [
		        'label' => esc_html__( 'Hover Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .elementor-widget-container:hover .themephi-addon-coupons .tp-coupon-desc' => 'color: {{VALUE}}',
		        ],
		    ]
		);

		$this->end_controls_section();
	
		$this->start_controls_section(
			'_section_style_rich_desc',
		    [
			'label' => esc_html__( 'Rich Description', 'tp-elements' ),
			'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'rich_description_typography',
		        'label' => esc_html__( 'Typography', 'tp-elements' ),
		        'selector' => '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-store-voucher',
		    ]
		);
		
		$this->add_responsive_control(
		    'rich_description_margin',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-store-voucher' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
		    ]
		);

		$this->add_responsive_control(
		    'rich_description_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-store-voucher' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
		    ]
		);

		$this->add_control(
		    'rich_description_color',
		    [
		        'label' => esc_html__( 'Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-store-voucher' => 'color: {{VALUE}}',
		            
		        ],
		    ]
		);

		$this->add_control(
		    'rich_description_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-store-voucher' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'rich_description_border',
		        'selector' => '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-store-voucher',
		    ]
		);

		$this->add_control(
		    'rich_description_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-store-voucher' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'rich_description_box_shadow',
		        'selector' => '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-store-voucher',
		    ]
		);

		$this->end_controls_section();

		// Start Date Meta
		$this->start_controls_section(
			'_section_style_meta_date',
			[
				'label' => esc_html__( 'Date Meta', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( '_tabs_date_meta' );

		$this->start_controls_tab(
		    '_tab_date_meta_normal',
		    [
		        'label' => esc_html__( 'Normal', 'tp-elements' ),
		    ]
		);

		
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'meta_date_typography',
		        'selector' => '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item.tp-coupon-list-date',
		    ]
		);

		$this->add_responsive_control(
		    'meta_date_margin',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item.tp-coupon-list-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'meta_date_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item.tp-coupon-list-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'meta_date_box_shadow',
		        'selector' => '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item.tp-coupon-list-date',
		    ]
		);

		$this->add_control(
		    'meta_date_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item.tp-coupon-list-date' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'meta_date_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item.tp-coupon-list-date' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'meta_date_border',
		        'selector' => '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item.tp-coupon-list-date',
		    ]
		);

		$this->add_control(
		    'meta_date_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item.tp-coupon-list-date' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
	
		$this->add_control(
		    'date_icon_only',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Date Icon', 'tp-elements' ),
		        'separator' => 'before'
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'meta_date_icon_typography',
		        'selector' => '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item.tp-coupon-list-date i ',
		    ]
		);
		$this->add_control(
		    'meta_date_svg_width',
		    [
		        'label' => esc_html__( 'SVG Width', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
		        'selectors' => [    
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item.tp-coupon-list-date svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',		            
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'meta_date_icon_margin',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item.tp-coupon-list-date i, {{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item.tp-coupon-list-date svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'meta_date_icon_color',
		    [
		        'label' => esc_html__( 'Icon Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item.tp-coupon-list-date i' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item.tp-coupon-list-date svg' => 'fill: {{VALUE}};',
		        ],
		    ]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
		    '_tab_date_meta_hover',
		    [
		        'label' => esc_html__( 'Hover', 'tp-elements' ),
		    ]
		);

		$this->add_control(
		    'meta_only_date_hover_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
					'{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item.tp-coupon-list-date:hover' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'meta_date_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons  .tp-coupon-info-list-item.tp-coupon-list-date:hover' => 'background: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'meta_date_hover_border_color',
		    [
		        'label' => esc_html__( 'Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item.tp-coupon-list-date:hover, {{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item.tp-coupon-list-date:focus' => 'border-color: {{VALUE}};',
		        ],
		    ]
		);

			
		$this->add_control(
		    'date_icon_only_hover',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Date Icon', 'tp-elements' ),
		        'separator' => 'before'
		    ]
		);

		$this->add_control(
		    'meta_date_icon_hover_color',
		    [
		        'label' => esc_html__( 'Icon Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item.tp-coupon-list-date:hover i' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item.tp-coupon-list-date:hover svg' => 'fill: {{VALUE}};',
		        ],
		    ]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		// Start Upper Meta
		$this->start_controls_section(
		    '_section_style_meta_upper',
		    [
		        'label' => esc_html__( 'Upper Meta', 'tp-elements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_responsive_control(
            'meta_upper_align',
            [
                'label' => esc_html__( 'Display Meta', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'space-between' => [
                        'title' => esc_html__( 'Space Between', 'tp-elements' ),
                        'icon' => 'eicon-justify-space-between-h',
                    ],
                    'space-around' => [
                        'title' => esc_html__( 'Space Around', 'tp-elements' ),
                        'icon' => 'eicon-justify-space-around-h',
                    ],
                    'space-evenly' => [
                        'title' => esc_html__( 'Space Evenly', 'tp-elements' ),
                        'icon' => 'eicon-justify-space-evenly-h',
                    ],
                    'start' => [
                        'title' => esc_html__( 'Start', 'tp-elements' ),
                        'icon' => 'eicon-justify-start-h',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'tp-elements' ),
                        'icon' => 'eicon-justify-center-h',
                    ],
                    'end' => [
                        'title' => esc_html__( 'End', 'tp-elements' ),
                        'icon' => 'eicon-justify-end-h',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .tp-coupon-meta.d-flex' => 'justify-content: {{VALUE}}',
                ]
            ]
        );

		$this->add_responsive_control(
		    'meta_upper_margin',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'meta_upper_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'meta_upper_border',
		        'selector' => '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-meta',
		    ]
		);

		$this->add_control(
		    'meta_upper_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-meta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'hr_cat_two',
		    [
		        'type' => Controls_Manager::DIVIDER,
		        'style' => 'thick',
		    ]
		);

		$this->start_controls_tabs( '_tabs_cat_meta' );

		$this->start_controls_tab(
		    '_tab_cat_meta_normal',
		    [
		        'label' => esc_html__( 'Normal', 'tp-elements' ),
		    ]
		);

		
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'meta_cat_typography',
		        'selector' => '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-meta-single ',
		    ]
		);

		$this->add_responsive_control(
		    'meta_cat_margin',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-meta-single' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'meta_cat_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-meta-single' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'meta_cat_box_shadow',
		        'selector' => '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-meta-single',
		    ]
		);

		$this->add_control(
		    'meta_cat_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-meta-single' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'meta_cat_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-meta-single' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'meta_cat_border',
		        'selector' => '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-meta-single',
		    ]
		);

		$this->add_control(
		    'meta_cat_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-meta-single' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
	
		$this->add_control(
		    'upper_icon_only',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Meta Icon', 'tp-elements' ),
		        'separator' => 'before'
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'meta_cat_icon_typography',
		        'selector' => '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-meta-single i ',
		    ]
		);


		$this->add_control(
		    'meta_cat_svg_width',
		    [
		        'label' => esc_html__( 'SVG Size', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
		        'selectors' => [    
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-meta-single svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',		            
		        ],
		    ]
		);

		$this->add_responsive_control(
			'meta_cat_icon_margin',
			[
				'label' => esc_html__( 'Margin', 'tp-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .themephi-addon-coupons .tp-coupon-meta-single i, {{WRAPPER}} .themephi-addon-coupons .tp-coupon-meta-single svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
		    'meta_cat_icon_color',
		    [
		        'label' => esc_html__( 'Icon Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-meta-single i' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-meta-single svg' => 'fill: {{VALUE}};',
		        ],
		    ]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
		    '_tab_cat_meta_hover',
		    [
		        'label' => esc_html__( 'Hover', 'tp-elements' ),
		    ]
		);

		$this->add_control(
		    'meta_cat_hover_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
					'{{WRAPPER}} .themephi-addon-coupons .tp-coupon-meta-single:hover' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'meta_cat_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons  .tp-coupon-meta-single:hover' => 'background: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'meta_cat_hover_border_color',
		    [
		        'label' => esc_html__( 'Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-meta-single:hover, {{WRAPPER}} .themephi-addon-coupons .tp-coupon-meta-single:focus' => 'border-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'meta_cat_icon_color_hover',
		    [
		        'label' => esc_html__( 'Icon Hover Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-meta-single:hover i' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-meta-single:hover svg' => 'fill: {{VALUE}};',
		        ],
		    ]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		// End Upper Meta


		// Start Bottom Meta
		$this->start_controls_section(
			'_section_style_meta_bottom',
			[
				'label' => esc_html__( 'Meta', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'meta_align',
			[
				'label' => esc_html__( 'Display Meta', 'tp-elements' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'space-between' => [
						'title' => esc_html__( 'Space Between', 'tp-elements' ),
						'icon' => 'eicon-justify-space-between-h',
					],
					'space-around' => [
						'title' => esc_html__( 'Space Around', 'tp-elements' ),
						'icon' => 'eicon-justify-space-around-h',
					],
					'space-evenly' => [
						'title' => esc_html__( 'Space Evenly', 'tp-elements' ),
						'icon' => 'eicon-justify-space-evenly-h',
					],
					'start' => [
						'title' => esc_html__( 'Start', 'tp-elements' ),
						'icon' => 'eicon-justify-start-h',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'tp-elements' ),
						'icon' => 'eicon-justify-center-h',
					],
					'end' => [
						'title' => esc_html__( 'End', 'tp-elements' ),
						'icon' => 'eicon-justify-end-h',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list.d-flex' => 'justify-content: {{VALUE}} !important',
				]
			]
		);

		$this->add_responsive_control(
			'meta_margin',
			[
				'label' => esc_html__( 'Margin', 'tp-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'meta_padding',
			[
				'label' => esc_html__( 'Padding', 'tp-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'meta_border',
				'selector' => '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list',
			]
		);

		$this->add_control(
			'meta_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'tp-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'hr_meta_two',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->start_controls_tabs( '_tabs_bottom_meta' );

		$this->start_controls_tab(
			'_tab_meta_normal',
			[
				'label' => esc_html__( 'Normal', 'tp-elements' ),
			]
		);

		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'selector' => '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item ',
			]
		);

		$this->add_responsive_control(
			'meta_bottom_margin',
			[
				'label' => esc_html__( 'Margin', 'tp-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'meta_bottom_padding',
			[
				'label' => esc_html__( 'Padding', 'tp-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'meta_bottom_box_shadow',
				'selector' => '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item',
			]
		);

		$this->add_control(
			'meta_bottom_color',
			[
				'label' => esc_html__( 'Text Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'meta_bottom_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'meta_bottom_border',
				'selector' => '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item',
			]
		);

		$this->add_control(
			'meta_bottom_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'tp-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	
		$this->add_control(
			'meta_icon_only',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Meta Icon', 'tp-elements' ),
				'separator' => 'before'
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_icon_typography',
				'selector' => '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item i ',
			]
		);

		$this->add_control(
		    'meta_svg_width',
		    [
		        'label' => esc_html__( 'SVG Size', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
		        'selectors' => [    
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',		            
		        ],
		    ]
		);

		$this->add_responsive_control(
			'meta_icon_margin',
			[
				'label' => esc_html__( 'Margin', 'tp-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item i, {{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
		    'meta_icon_color',
		    [
		        'label' => esc_html__( 'Icon Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item i' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item svg' => 'fill: {{VALUE}};',
		        ],
		    ]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'_tab_bottom_meta_hover',
			[
				'label' => esc_html__( 'Hover', 'tp-elements' ),
			]
		);

		$this->add_control(
			'meta_bottom_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'meta_bottom_hover_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-addon-coupons  .tp-coupon-info-list-item:hover' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'meta_bottom_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item:hover, {{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
		    'meta_icon_color_hover',
		    [
		        'label' => esc_html__( 'Icon Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item:hover i' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-info-list-item:hover svg' => 'fill: {{VALUE}};',
		        ],
		    ]
		);


		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		// Start earn and share Meta
		$this->start_controls_section(
			'_section_style_meta_share',
			[
				'label' => esc_html__( 'Share Meta', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'coupon_style' => ['style3'],
				],
			]
		);

		$this->start_controls_tabs( '_tabs_share_meta' );

		$this->start_controls_tab(
		    '_tab_share_meta_normal',
		    [
		        'label' => esc_html__( 'Normal', 'tp-elements' ),
		    ]
		);

		
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'meta_share_typography',
		        'selector' => '{{WRAPPER}} .themephi-addon-coupons .toggle-coupon-share',
		    ]
		);

		$this->add_responsive_control(
		    'meta_share_margin',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .toggle-coupon-share' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'meta_share_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .toggle-coupon-share' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'meta_share_box_shadow',
		        'selector' => '{{WRAPPER}} .themephi-addon-coupons .toggle-coupon-share',
		    ]
		);

		$this->add_control(
		    'meta_share_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .toggle-coupon-share' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'meta_share_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .toggle-coupon-share' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'meta_share_border',
		        'selector' => '{{WRAPPER}} .themephi-addon-coupons .toggle-coupon-share',
		    ]
		);

		$this->add_control(
		    'meta_share_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .toggle-coupon-share' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
	
		$this->add_control(
		    'share_icon_only',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Share Icon', 'tp-elements' ),
		        'separator' => 'before'
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'meta_share_icon_typography',
		        'selector' => '{{WRAPPER}} .themephi-addon-coupons .toggle-coupon-share i ',
		    ]
		);

		$this->add_responsive_control(
		    'meta_share_icon_margin',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .toggle-coupon-share i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
		    '_tab_share_meta_hover',
		    [
		        'label' => esc_html__( 'Hover', 'tp-elements' ),
		    ]
		);

		$this->add_control(
		    'meta_share_hover_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
					'{{WRAPPER}} .themephi-addon-coupons .toggle-coupon-share:hover' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'meta_share_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons  .toggle-coupon-share:hover' => 'background: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'meta_share_hover_border_color',
		    [
		        'label' => esc_html__( 'Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .toggle-coupon-share:hover, {{WRAPPER}} .themephi-addon-coupons .toggle-coupon-share:focus' => 'border-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		// End Meta

		$this->start_controls_section(
		    '_section_style_button',
		    [
		        'label' => esc_html__( 'Button', 'tp-elements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_responsive_control(
            'normal_btn_align',
            [
                'label' => esc_html__( 'Alignment', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
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
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'tp-elements' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-button .coupon-action-button' => 'justify-content: {{VALUE}}',
                ],
				'separator' => 'before',
            ]
        );

		$this->add_responsive_control(
		    'link_wrapper_margin',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
		    ]
		);

		$this->add_responsive_control(
		    'link_wrapper_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'button_wrapper_border',
		        'selector' => '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-button',
		    ]
		);

		$this->add_control(
		    'hr_three',
		    [
		        'type' => Controls_Manager::DIVIDER,
		        'style' => 'thick',
		    ]
		);

		$this->start_controls_tabs( '_tabs_button' );

		$this->start_controls_tab(
		    '_tab_button_normal',
		    [
		        'label' => esc_html__( 'Normal', 'tp-elements' ),
		    ]
		);

		$this->add_responsive_control(
		    'link_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .coupon-action-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'btn_typography',
		        'selector' => '{{WRAPPER}} .themephi-addon-coupons .coupon-action-button',
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'button_border',
		        'selector' => '{{WRAPPER}} .coupon-action-button',
		    ]
		);

		$this->add_control(
		    'button_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .coupon-action-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'button_box_shadow',
		        'selector' => '{{WRAPPER}} .themephi-addon-coupons .coupon-action-button',
		    ]
		);

		$this->add_control(
		    'link_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-button .coupon-action-button' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-button .coupon-action-button' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_icon_translate',
		    [
		        'label' => esc_html__( 'Icon Translate X', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'range' => [
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .coupon-action-button.icon-before i' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
		            '{{WRAPPER}} .themephi-addon-coupons .coupon-action-button.icon-after i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
		        ],
		    ]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
		    '_tab_button_hover',
		    [
		        'label' => esc_html__( 'Hover', 'tp-elements' ),
		    ]
		);

		$this->add_control(
		    'button_hover_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .elementor-widget-container .themephi-addon-coupons .coupon-action-button:hover, {{WRAPPER}} .elementor-widget-container .themephi-addon-coupons:focus .coupon-action-button' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-button .coupon-action-button:hover' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .elementor-widget-container .themephi-addon-coupons .coupon-action-button:hover, {{WRAPPER}} .elementor-widget-container .themephi-addon-coupons .tp-coupon-button:focus .coupon-action-button' => 'background-color: {{VALUE}};',
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-button .coupon-action-button:hover, {{WRAPPER}} .themephi-addon-coupons .tp-coupon-button:focus .coupon-action-button' => 'background: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_hover_border_color',
		    [
		        'label' => esc_html__( 'Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'condition' => [
		            'button_border_border!' => '',
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .elementor-widget-container .themephi-addon-coupons:hover .coupon-action-button, {{WRAPPER}} .elementor-widget-container .themephi-addon-coupons .coupon-action-button:focus' => 'border-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_hover_icon_translate',
		    [
		        'label' => esc_html__( 'Icon Translate X', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        
		        'range' => [
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .elementor-widget-container .themephi-addon-coupons:hover .coupon-action-button.icon-before i' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
		            '{{WRAPPER}} .elementor-widget-container .themephi-addon-coupons .coupon-action-button.icon-after i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
		        ],
		    ]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		
		$this->add_control(
		    'btn_text_only',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Button Text', 'tp-elements' ),
		        'separator' => 'before'
		    ]
		);
		
		$this->add_responsive_control(
		    'btn_text_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .coupon-action-button .code-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'btn_text_typography',
		        'selector' => '{{WRAPPER}} .themephi-addon-coupons .coupon-action-button .code-text,
		        {{WRAPPER}} .themephi-addon-coupons .coupon-action-button .code-text',
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'btn_text_border',
		        'selector' => '{{WRAPPER}} .coupon-action-button .code-text',
		    ]
		);

		$this->add_control(
		    'btn_text_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .coupon-action-button .code-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'btn_text_box_shadow',
		        'selector' => '{{WRAPPER}} .themephi-addon-coupons .coupon-action-button .code-text',
		    ]
		);

		$this->add_control(
		    'hr_four',
		    [
		        'type' => Controls_Manager::DIVIDER,
		        'style' => 'thick',
		    ]
		);

		$this->start_controls_tabs( '_tabs_btn_text' );

		$this->start_controls_tab(
		    '_tab_btn_text_normal',
		    [
		        'label' => esc_html__( 'Normal', 'tp-elements' ),
		    ]
		);

		$this->add_control(
		    'btn_text_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-button .coupon-action-button .code-text' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'btn_text_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-button .coupon-action-button .code-text' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
		    '_tab_btn_text_hover',
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
		            '{{WRAPPER}}  .themephi-addon-coupons .tp-coupon-button .coupon-action-button:hover .code-text' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'btn_text_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-button .coupon-action-button:hover .code-text' => 'background: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'btn_text_hover_border_color',
		    [
		        'label' => esc_html__( 'Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .elementor-widget-container .themephi-addon-coupons .coupon-action-button:hover .code-text, {{WRAPPER}} .elementor-widget-container .themephi-addon-coupons .coupon-action-button:focus .code-text' => 'border-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
		    'button_icon_only',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Button Icon', 'tp-elements' ),
		        'separator' => 'before'
		    ]
		);

		$this->add_responsive_control(
		    'button_icon_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .coupon-action-button i, {{WRAPPER}} .themephi-addon-coupons .coupon-action-button svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'button_icon_typography',
		        'selector' => '{{WRAPPER}} .themephi-addon-coupons .coupon-action-button i',
		    ]
		);

		$this->add_control(
		    'button_icon_width',
		    [
		        'label' => esc_html__( 'Icon Size', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
		        'selectors' => [    
		            '{{WRAPPER}} .themephi-addon-coupons .coupon-action-button svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',		            
		        ],
		    ]
		);	

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'button_icon_border',
		        'selector' => '{{WRAPPER}} .coupon-action-button i, {{WRAPPER}} .coupon-action-button svg',
		    ]
		);

		$this->add_control(
		    'button_icon_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .coupon-action-button i, {{WRAPPER}} .themephi-addon-coupons .coupon-action-button svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'button_icon_box_shadow',
		        'selector' => '{{WRAPPER}} .themephi-addon-coupons .coupon-action-button i, {{WRAPPER}} .themephi-addon-coupons .coupon-action-button svg',
		    ]
		);

		$this->add_control(
		    'hr_five',
		    [
		        'type' => Controls_Manager::DIVIDER,
		        'style' => 'thick',
		    ]
		);

		$this->start_controls_tabs( '_tabs_button_icon' );

		$this->start_controls_tab(
		    '_tab_button_icon_normal',
		    [
		        'label' => esc_html__( 'Normal', 'tp-elements' ),
		    ]
		);

		$this->add_control(
		    'button_icon_color',
		    [
		        'label' => esc_html__( 'Icon Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-button .coupon-action-button i' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-button .coupon-action-button svg' => 'fill: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_icon_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-button .coupon-action-button i, {{WRAPPER}} .themephi-addon-coupons .tp-coupon-button .coupon-action-button svg' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
		    '_tab_button_icon_hover',
		    [
		        'label' => esc_html__( 'Hover', 'tp-elements' ),
		    ]
		);

		$this->add_control(
		    'button_icon_hover_color',
		    [
		        'label' => esc_html__( 'Icon Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .elementor-widget-container .themephi-addon-coupons .coupon-action-button:focus i' => 'color: {{VALUE}};',
		            '{{WRAPPER}}  .themephi-addon-coupons .tp-coupon-button .coupon-action-button:hover i' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .elementor-widget-container .themephi-addon-coupons .coupon-action-button:focus svg' => 'fill: {{VALUE}};',
		            '{{WRAPPER}}  .themephi-addon-coupons .tp-coupon-button .coupon-action-button:hover svg' => 'fill: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_icon_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .elementor-widget-container .themephi-addon-coupons .tp-coupon-button:focus .coupon-action-button:hover i' => 'background-color: {{VALUE}};',
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-button .coupon-action-button:hover i' => 'background: {{VALUE}};',
		            '{{WRAPPER}} .elementor-widget-container .themephi-addon-coupons .tp-coupon-button:focus .coupon-action-button:hover svg' => 'background-color: {{VALUE}};',
		            '{{WRAPPER}} .themephi-addon-coupons .tp-coupon-button .coupon-action-button:hover svg' => 'background: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_icon_hover_border_color',
		    [
		        'label' => esc_html__( 'Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .elementor-widget-container .themephi-addon-coupons .coupon-action-button:hover i, {{WRAPPER}} .elementor-widget-container .themephi-addon-coupons .coupon-action-button:focus i, {{WRAPPER}} .elementor-widget-container .themephi-addon-coupons .coupon-action-button:hover svg, {{WRAPPER}} .elementor-widget-container .themephi-addon-coupons .coupon-action-button:focus svg' => 'border-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
 
		$this->start_controls_section(
		    '_section_style_pagination',
		    [
		        'label' => esc_html__( 'Pagination', 'tp-elements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_responsive_control(
		    'margin_pagination',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-coupons-wrapper ul li a, {{WRAPPER}} .tp-coupons-wrapper ul li span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'pagination_typography',
		        'selector' => '{{WRAPPER}} .tp-coupons-wrapper ul li a, {{WRAPPER}} .tp-coupons-wrapper ul li span',
		    ]
		);

		$this->add_responsive_control(
            'pagination_align',
            [
                'label' => esc_html__( 'Alignment', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
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
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'tp-elements' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .tp-coupons-wrapper ul.page-numbers' => 'text-align: {{VALUE}}'
                ],
				'separator' => 'before',
            ]
        );

		$this->add_control(
		    'hr_six',
		    [
		        'type' => Controls_Manager::DIVIDER,
		        'style' => 'thick',
		    ]
		);

		$this->start_controls_tabs( '_tabs_pagination' );

		$this->start_controls_tab(
		    '_tab_pagination_normal',
		    [
		        'label' => esc_html__( 'Normal', 'tp-elements' ),
		    ]
		);
		
		$this->add_responsive_control(
		    'padding_pagination',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-coupons-wrapper ul li a, {{WRAPPER}} .tp-coupons-wrapper ul li span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
		    ]
		);

		$this->add_control(
		    'pagination_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .tp-coupons-wrapper ul li a, {{WRAPPER}} .tp-coupons-wrapper ul li span' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'pagination_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .tp-coupons-wrapper ul li a, {{WRAPPER}} .tp-coupons-wrapper ul li span' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'pagination_button_border',
		        'selector' => '{{WRAPPER}} .tp-coupons-wrapper ul li a, {{WRAPPER}} .tp-coupons-wrapper ul li span',
		    ]
		);

		$this->add_control(
		    'pagination_button_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-coupons-wrapper ul li a, {{WRAPPER}} .tp-coupons-wrapper ul li span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'pagination_border_color',
		    [
		        'label' => esc_html__( 'Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'condition' => [
		            'button_border_border!' => '',
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-coupons-wrapper ul li a, {{WRAPPER}} .tp-coupons-wrapper ul li span' => 'border-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'pagination_button_box_shadow',
		        'selector' => '{{WRAPPER}} .tp-coupons-wrapper ul li a, {{WRAPPER}} .tp-coupons-wrapper ul li span',
		    ]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
		    '_tab_pagination_hover',
		    [
		        'label' => esc_html__( 'Hover/Active', 'tp-elements' ),
		    ]
		);

		$this->add_control(
		    'pagination_hover_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .tp-coupons-wrapper ul li a:hover, {{WRAPPER}} .tp-coupons-wrapper ul li span:hover, {{WRAPPER}} .tp-coupons-wrapper ul li span.current' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'pagination_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .tp-coupons-wrapper ul li a:hover, {{WRAPPER}} .tp-coupons-wrapper ul li span:hover, {{WRAPPER}} .tp-coupons-wrapper ul li span.current' => 'background: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'pagination_hover_border',
		        'selector' => '{{WRAPPER}} .tp-coupons-wrapper ul li a:hover, {{WRAPPER}} .tp-coupons-wrapper ul li span:hover, {{WRAPPER}} .tp-coupons-wrapper ul li span.current',
		    ]
		);

		$this->add_control(
		    'pagination_hover_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-coupons-wrapper ul li a:hover, {{WRAPPER}} .tp-coupons-wrapper ul li span:hover, {{WRAPPER}} .tp-coupons-wrapper ul li span.current' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'tp_pagination_hover_border_color',
		    [
		        'label' => esc_html__( 'Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'condition' => [
		            'button_border_border!' => '',
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-coupons-wrapper ul li a:hover, {{WRAPPER}} .tp-coupons-wrapper ul li span:hover, {{WRAPPER}} .tp-coupons-wrapper ul li span.current' => 'border-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'pagination_hover_box_shadow',
		        'selector' => '{{WRAPPER}} .tp-coupons-wrapper ul li a:hover, {{WRAPPER}} .tp-coupons-wrapper ul li span:hover, {{WRAPPER}} .tp-coupons-wrapper ul li span.current',
		    ]
		);


		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Render counter widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	/**
	 * Render counter widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();			

		$sstyle = $settings['coupon_style'];
		$unique = rand(2012,35120);

			if( $settings['coupon_grid_source'] == 'slider' ) {
						
				$col_xxl          = $settings['col_xxl'];
				$col_xxl          = !empty($col_xxl) ? $col_xxl : 5;
				$slidesToShow    = $col_xxl;
				$autoplaySpeed   = $settings['slider_autoplay_speed'];
				$autoplaySpeed = !empty($autoplaySpeed) ? $autoplaySpeed : '1000';
				$interval        = $settings['slider_interval'];
				$interval = !empty($interval) ? $interval : '3000';
				$slidesToScroll  = $settings['slides_ToScroll'];
				$slider_autoplay = $settings['slider_autoplay'] === 'true' ? 'true' : 'false';
				$pauseOnHover    = $settings['slider_stop_on_hover'] === 'true' ? 'true' : 'false';
				$pauseOnInter    = $settings['slider_stop_on_interaction'] === 'true' ? 'true' : 'false';
				$sliderDots      = $settings['slider_dots'] == 'true' ? 'true' : 'false';       
				$infinite        = $settings['slider_loop'] === 'true' ? 'true' : 'false';
				$centerMode      = $settings['slider_centerMode'] === 'true' ? 'true' : 'false';
				$col_xl          = $settings['col_xl'];
				$col_lg          = $settings['col_lg'];
				$col_md          = $settings['col_md'];
				$col_sm          = $settings['col_sm'];
				$col_xs          = $settings['col_xs'];
				$item_gap = $settings['item_gap_custom']['size'];
				$item_gap = !empty($item_gap) ? $item_gap : '0';

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

			}	

			$orderby = $settings['coupon_orderby'];
			$order   = $settings['coupon_order'];
			$paged   = (get_query_var('paged')) ? get_query_var('paged') : 1;

			$meta_query = [];

			// Add coupon_type filter
			if (!empty($coupon_type)) {
				$meta_query[] = array(
					'key'     => 'ctype',
					'value'   => $coupon_type,
					'compare' => '=',
				);
			}

			// Setup base args
			$args = [
				'post_type'      => 'coupon',
				'posts_per_page' => $settings['per_page'],
				'paged'          => $paged,
				'order'          => $order,
				'meta_query'     => $meta_query,
			];

			// Custom order logic
			switch ( $orderby ) {
				case 'popular':
					$args['meta_key'] = 'used';
					$args['orderby']  = 'meta_value_num';
					break;

				case 'ending':
					$args['meta_key']  = 'expire';
					$args['orderby']  = 'meta_value_num';
					break;

				case 'rand':
					$args['orderby'] = 'rand';
					break;

				case 'title':
					$args['orderby'] = 'title';
					break;

				default: 
					$args['orderby'] = 'date';
					break;
			}

			// Taxonomy filters
			$cat = $settings['coupon_category'];
			$store = $settings['coupon_store'];
			
			if (!empty($cat) || !empty($store)) {
				$args['tax_query'] = array(
					'relation' => 'OR',
				);

				if (!empty($cat)) {
					$args['tax_query'][] = array(
						'taxonomy' => 'coupon-category',
						'field'    => 'slug',
						'terms'    => $cat,
					);
				}

				if (!empty($store)) {
					$args['tax_query'][] = array(
						'taxonomy' => 'coupon-store',
						'field'    => 'slug',
						'terms'    => $store,
					);
				}
			}

			$best_wp = new WP_Query($args);

			?>

			<style>

			<?php if( $settings['meta_upper_position'] == 'top_of_image' ) : ?>
			.tp-coupon-meta-with-image {
				top: 0;
			}
			<?php else : ?> 
			.tp-coupon-meta-with-image {
				bottom: 0;
			}
			<?php endif; ?>

			.share-coupon {
				display: none;
			}
			.share-coupon.open-share {
				display: block;
			}
			.favorite-bookmark {
				cursor: pointer;
				color: gray; 
				transition: color 0.3s ease;
			}
			.favorite-bookmark.favorite {
				color: #B3682B; 
			}
			.favorite-bookmark:hover {
				color: #B3682B; 
			}
			</style>

			<?php

			$terms = get_terms( array(
				'taxonomy'    => 'coupon-category',
				'hide_empty'  => true            
			) 
			);
			
			if( !empty($terms) && !is_wp_error($terms) ) { ?>
			<?php if($settings['show_filter'] == 'filter_show') : ?>	
			<div class="coupon-filter coupon-filter-<?php echo esc_attr( $unique ); ?>">
				<button class="active" data-filter="*">
					<?php if( $settings['enable_filter_icon'] == 'yes' ) : ?>
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/cat.png' ); ?>" >
					<?php endif; ?>
					<?php echo esc_html($settings['filter_title']);?>
				</button>
				<?php $taxonomy = "coupon-category";
					$select_cat = $settings['coupon_category'];
					if( !empty($select_cat) && !is_wp_error($select_cat) ) {
					foreach ($select_cat as $catid) {
					$term = get_term_by('slug', $catid, $taxonomy);
					$term_name  =  $term->name;
					$term_slug  =  $term->slug;

					$cat_id = get_term_meta($term->term_id, 'category_icon', true);
					if ($cat_id) {
						$cat_img = wp_get_attachment_url($cat_id);
					} else {
						$cat_img = ''; // Default image or empty if no image is set
					}

				?>
				<button data-filter=".filter_<?php echo esc_html($term_slug);?>">
					<?php if( $settings['enable_filter_icon'] == 'yes' ) : ?>
					<img src="<?php echo esc_url($cat_img); ?>" >
					<?php endif; ?>
					<?php echo esc_html($term_name);?>
				</button>
				<?php  } }
				
				?>

			</div>
			<?php endif; ?>

			<div class="tp-coupons-wrapper coupons-wrapper-<?php echo esc_attr( $settings['coupon_style'] ); ?> position-relative ">
                <?php if( $settings['coupon_grid_source'] == 'dynamic' ) : ?>
                    <div class="tp-coupons-dynamic-wrapp <?php if($settings['show_filter'] == 'filter_show') : ?> grid-<?php echo esc_attr( $unique ); ?> <?php endif; ?> ">
                    <div class="row <?php if ( $settings['enable_item_gutter'] == 'yes' ) : ?>  g-0 <?php endif; ?>" <?php if ( $settings['enable_item_massonry'] == 'yes' ) : ?>  data-masonry='{ "percentPosition": false }' <?php endif; ?> >
                <?php elseif( $settings['coupon_grid_source'] == 'slider' ) : ?>
                    <div class="tp-coupons-slider-<?php echo esc_attr($unique); ?> swiper <?php echo esc_attr( $settings['coupon_exapansion'] ); ?> ">
                        <div class="swiper-wrapper ">
                <?php else : ?>
                <?php endif; ?>

					<?php
					//$post_counter = 01;
					$x=1;
					while($best_wp->have_posts()): $best_wp->the_post();

					$post_id = get_the_ID();

					$termsArray  = get_the_terms( $post_id, "coupon-category" );  //Get the terms for this particular item
					$termsString = ""; //initialize the string that will contain the terms
					$termsSlug   = "";
			
					foreach ( $termsArray as $term ) { 
						$termsString .= 'filter_'.$term->slug.' '; 
						$termsSlug .= $term->name;
					}	

					$exclusive = get_post_meta( $post_id, 'exclusive', true );
					$expire_timestamp = get_post_meta( get_the_ID(), 'expire', true );
					$used = get_post_meta( $post_id, 'used', true );
					$current_used = tp_register_coupon_used( $post_id, $used );
					$positive_feedback = get_post_meta( $post_id, 'positive', true );

					$att = get_post_thumbnail_id();
					$image_src = wp_get_attachment_image_src($att, 'full');
					if (!empty($image_src)) {
						$image_src = $image_src[0];
					}

					// Category
					$categories = get_the_terms($post_id, 'coupon-category');

					if ($categories && !is_wp_error($categories)) {
						foreach ($categories as $category) {
							$category_name = $category->name;

							$cat_image_id = get_term_meta($category->term_id, 'category_icon', true);

							if ($cat_image_id) {
								$cat_image_url = wp_get_attachment_image_url($cat_image_id, 'full'); 
								
							}
						}
					}

					// Store
					$stores = get_the_terms($post_id, 'coupon-store'); 

					if ($stores && !is_wp_error($stores)) {
						foreach ($stores as $store) {
							$store_name = $store->name;
							$store_description = $store->description;
							$store_rich_description = get_term_meta( $store->term_id, 'store_rich_description', true );
							$store_address = get_term_meta( $store->term_id, 'store_address', true );
							$store_link = get_term_link($store);
							$store_image_id = get_term_meta($store->term_id, 'store_image', true);
							if ($store_image_id) {
								$store_image_url = wp_get_attachment_image_url($store_image_id, 'full'); 
							}

						}
					}

 
					if(!empty($settings['title_word_count'])){
						$title_limit = $settings['title_word_count']; 
					}
					else{
						$title_limit = 20;
					}
					if(!empty($settings['coupon_text_word_limit'])){
						$text_limit = $settings['coupon_text_word_limit']; 
					}
					else{
						$text_limit = 20;
					}

                    if( $settings['coupon_grid_source'] == 'dynamic' ) {

                        if($sstyle){
                            require plugin_dir_path(__FILE__)."/dynamic/$sstyle.php";
                        }else{
                            require plugin_dir_path(__FILE__)."/dynamic/style1.php";
                        }

                    }


                    if( $settings['coupon_grid_source'] == 'slider' ) {

                        if($sstyle){
                            require plugin_dir_path(__FILE__)."/slider/$sstyle.php";
                        }else{
                            require plugin_dir_path(__FILE__)."/slider/style1.php";
                        }

                    }

					//$post_counter++;
					$x++;
					endwhile;
					wp_reset_query();  
					?>  
                
                <?php if( $settings['coupon_grid_source'] == 'dynamic' || $settings['coupon_grid_source'] == 'slider' ) : ?>
				    </div>
				</div>
                <?php endif; ?>

				<?php 
					if( $settings['coupon_pagination_show_hide'] == 'yes' ) {
						echo paginate_links(
							array(
								'total'      => $best_wp->max_num_pages,
								'type'       => 'list',
								'current'    => max( 1, $paged ),
								'prev_text'  => '<i class="fa fa-angle-left"></i>',
								'next_text'  => '<i class="fa fa-angle-right"></i>'
							)
						);
					}
				?>
				<!-- slider navigation and pagination start -->
				<?php if( $settings['coupon_grid_source'] == 'slider' ) : 
				if( $settings['slider_dots'] == 'true' ) : ?>
				<div class="tp-coupons-pagination swiper-pagination"></div>
				<?php endif; ?>
				<?php if( $settings['slider_navigation'] == 'true' ) : ?>
				<div class="tp-coupons-navigation">
					<span class="tp-coupons-slide-prev box-style"><i class="tp tp-arrow-left"></i></span>
					<span class="tp-coupons-slide-next box-style"><i class="tp tp-arrow-right"></i></span>
				</div>
				<?php endif; endif; ?>
				<!-- slider navigation and pagination end -->

			</div>
			<script>
				jQuery(document).ready(function($) {

					$('.toggle-coupon-share-<?php echo esc_attr( $unique ); ?>').on('click', function() {
						var target = $(this).data('target'); 
						var shareDiv = $('.share-coupon.' + target); 
						shareDiv.toggleClass('open-share');
						$('.share-coupon').not(shareDiv).removeClass('open-share');
					});
					
				});

				// JS for Filter
				jQuery(window).load(function($) {

					// image loaded portfolio init
					jQuery('.grid-<?php echo esc_attr( $unique ); ?>').imagesLoaded(function() {
						jQuery('.coupon-filter-<?php echo esc_attr( $unique ); ?>').on('click', 'button', function() {
							var filterValue = jQuery(this).attr('data-filter');
							$grid.isotope({
								filter: filterValue
							});
						});
						var $grid = jQuery('.grid-<?php echo esc_attr( $unique ); ?>').isotope({
							animationOptions: {
							duration: 750,
							easing: 'linear',
							queue: false
						},

							itemSelector: '.grid-item',
							percentPosition: true,
							masonry: {
								columnWidth: '.grid-item',
							}
						});
					});
					jQuery('.coupon-filter-<?php echo esc_attr( $unique ); ?> button').on('click', function(event) {
						jQuery(this).siblings('.active').removeClass('active');
						jQuery(this).addClass('active');
						event.preventDefault();
					});

				});  

			</script>

			<?php if( $settings['coupon_grid_source'] == 'slider' ) : ?>

			<script type="text/javascript"> 
            jQuery(document).ready(function(){
                    
                var swiper = new Swiper(".tp-coupons-slider-<?php echo esc_attr($unique); ?>", {				
                    slidesPerView: <?php echo $slidesToShow;?>,
                    speed: <?php echo esc_attr($autoplaySpeed); ?>,
                  
                    loop: <?php echo esc_attr($infinite ); ?>,
                   <?php echo esc_attr($slider_autoplay); ?>,
                   spaceBetween:  <?php echo esc_attr($item_gap); ?>,
                   pagination: {
                       el: ".tp-coupons-pagination",
                       clickable: true,
                    },
                    centeredSlides: <?php echo esc_attr($centerMode); ?>,
                    navigation: {
                        nextEl: ".tp-coupons-slide-next",
                        prevEl: ".tp-coupons-slide-prev",
                    },
                    breakpoints: {
                        0: { slidesPerView: <?php echo $col_xs;?>},
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
			<?php endif; ?>

		<?php 
		} else {
			$admin_tp_url = admin_url('term.php?taxonomy=coupon-category&post_type=coupon');
			echo '<div class="text-center"><a href=" '. $admin_tp_url .' " class="btn btn-danger">Create Coupon Category & Add to Coupon Post</a></div>';
		}
	}
	public function getCategories(){
        $cat_list = [];
             if ( post_type_exists( 'coupon' ) ) { 
              $terms = get_terms( array(
                 'taxonomy'    => 'coupon-category',
                 'hide_empty'  => true            
             ) ); 
            foreach($terms as $post) {
                $cat_list[$post->slug]  = [$post->name];
            }
        }  
        return $cat_list;
    }

	public function getStores(){
        $store_list = [];
             if ( post_type_exists( 'coupon' ) ) { 
              $terms = get_terms( array(
                 'taxonomy'    => 'coupon-store',
                 'hide_empty'  => true            
             ) ); 
            foreach($terms as $post) {
                $store_list[$post->slug]  = [$post->name];
            }
        }  
        return $store_list;
    }
	
}