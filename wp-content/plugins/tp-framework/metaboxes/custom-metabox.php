<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'rt_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/CMB2/CMB2
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}

/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 $cmb CMB2 object.
 *
 * @return bool      True if metabox should show
 */
function tp_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template.
	if ( get_option( 'page_on_front' ) !== $cmb->object_id ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field $field Field object.
 *
 * @return bool              True if metabox should show
 */
function tp_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category.
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

/**
 * Manually render a field.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object.
 */
function tp_render_row_cb( $field_args, $field ) {
	$classes     = $field->row_classes();
	$id          = $field->args( 'id' );
	$label       = $field->args( 'name' );
	$name        = $field->args( '_name' );
	$value       = $field->escaped_value();
	$description = $field->args( 'description' );
	?>
	<div class="custom-field-row <?php echo esc_attr( $classes ); ?>">
		<p><label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $label ); ?></label></p>
		<p><input id="<?php echo esc_attr( $id ); ?>" type="text" name="<?php echo esc_attr( $name ); ?>" value="<?php echo $value; ?>"/></p>
		<p class="description"><?php echo esc_html( $description ); ?></p>
	</div>
	<?php
}

/**
 * Manually render a field column display.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object.
 */
function tp_display_text_small_column( $field_args, $field ) {
	?>
	<div class="custom-column-display <?php echo esc_attr( $field->row_classes() ); ?>">
		<p><?php echo $field->escaped_value(); ?></p>
		<p class="description"><?php echo esc_html( $field->args( 'description' ) ); ?></p>
	</div>
	<?php
}

/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array      $field_args Array of field parameters.
 * @param  CMB2_Field $field      Field object.
 */
function tp_before_row_if_2( $field_args, $field ) {
	if ( 2 == $field->object_id ) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}

add_action( 'cmb2_admin_init', 'tp_register_gallery_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function tp_register_gallery_metabox() {
	$prefix = 'tp_'; 
	$cmb_project = new_cmb2_box( array(
		'id'            => $prefix . 'metabox-gallery',
		'title'         => esc_html__( 'Gallery Images', 'tp-framework' ),
		'object_types'  => array( 'gallery' ), // Post type

	) );

	$cmb_project->add_field( array(
	'name' => 'Upload Gallery Images',
	'desc' => '',
	'id'   => 'Screenshot',
	'type' => 'file_list',
	'text' => array(
		'add_upload_files_text' => 'Upload Files', // default: "Add or Upload Files"
		'remove_image_text' => 'Replacement', // default: "Remove Image"
		'file_text' => 'Replacement', // default: "File:"
		'file_download_text' => 'Replacement', // default: "Download"
		'remove_text' => 'Replacement', // default: "Remove"
	),
) );
	
}

add_action( 'cmb2_admin_init', 'tp_register_header_metabox' );

/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function tp_register_header_metabox() {
	$prefix = 'tp_'; 

  /**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Page Options', 'tp-framework' ),
		'object_types'  => array( 'page','post','teams','tp-portfolios','services','product','archive' ), // Post type
		'vertical_tabs' => true, // Set vertical tabs, default false
		'tabs' => array(
            array(
                'id'    => 'tab-1',
                'icon' => 'dashicons-admin-page',
                'title' => 'Page Settings',
                'fields' => array(
                    'primary-colors',
                    'page_bg',
                    'content_top',
                    'content_bottom'
                ),
            ),
                     
            array(
                'id'    => 'tab-9',
                'icon' => 'dashicons-format-image',
                'title' => 'Banner Settings',
                'fields' => array(
                    'banner_image',
                    'banner_hide',
                    'select-title',
                    'select-bread',                   
                    'content_banner',                   
                    'intro_content_banner'             
                ),
            ),         

        )
		
	) );

function get_myposttype_options($argument) {
	$args = array(
		'post_type' => $argument, 
		'posts_per_page' => -1,
		'orderby' => 'title',
    	'order'   => 'ASC');
	$loop = new WP_Query($args);
	if($loop->have_posts()) {  
	    while($loop->have_posts()) : $loop->the_post();
	        //
	        $varID = get_the_id();
	        $varName = get_the_title();
	        $pageArray[$varID]=$varName;
	    endwhile; 
	    return  $pageArray;  
	}
	
}

	//Page Settings meta field
	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Primary Color', 'tp-framework' ),
		'desc'    => esc_html__( 'chosse your background', 'tp-framework' ),
		'id'      => 'primary-colors',		
		'type'    => 'colorpicker',
		'default' => '',
	) );

	$cmb_demo->add_field( array(
		'name' => esc_html__( 'Select Page Background Image', 'tp-framework' ),
		'desc' => esc_html__( 'Upload an image or enter a URL for page banner.', 'tp-framework' ),
		'id'   => 'page_bg',
		'type' => 'file',
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Content Top Padding', 'tp-framework' ),
		'desc'    => esc_html__( 'example(80px)', 'tp-framework' ),
		'default' => esc_attr__( '80px', 'tp-framework' ),
		'id'      => 'content_top',
		'type'    => 'text_medium',
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Content Bottom Padding', 'tp-framework' ),
		'desc'    => esc_html__( 'example(40px)', 'tp-framework' ),
		'default' => esc_attr__( '40px', 'tp-framework' ),
		'id'      => 'content_bottom',
		'type'    => 'text_medium',
	) );

	//Banner Custom field here
	$cmb_demo->add_field( array(
		'name' => esc_html__( 'Select Banner Image', 'tp-framework' ),
		'desc' => esc_html__( 'Upload an image or enter a URL for page banner.', 'tp-framework' ),
		'id'   => 'banner_image',
		'type' => 'file',
	) );
    
    $cmb_demo->add_field( array(
		'name'             => esc_html__( 'Banner Hide', 'tp-framework' ),
		'desc'             => esc_html__( 'You Can Show or Hide Banner', 'tp-framework' ),
		'id'               => 'banner_hide',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'show' => esc_html__( 'Show', 'tp-framework' ),
			'hide' => esc_html__( 'Hide', 'tp-framework' ),			
		),
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Show Page Title', 'tp-framework' ),
		'desc'             => esc_html__( 'You can show/hide page title', 'tp-framework' ),
		'id'               => 'select-title',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'show' => esc_html__( 'Show', 'tp-framework' ),
			'hide' => esc_html__( 'Hide', 'tp-framework' ),			
		),
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Show Breadcurmbs', 'tp-framework' ),
		'desc'             => esc_html__( 'You can show/hide  breadcurmbs here', 'tp-framework' ),
		'id'               => 'select-bread',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'show' => esc_html__( 'Show', 'tp-framework' ),
			'hide' => esc_html__( 'Hide', 'tp-framework' ),			
		),
	));


	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Page Banner Text', 'tp-framework' ),
		'desc'    => esc_html__( 'Enter some text in banner', 'tp-framework' ),
		'id'      => 'content_banner',
		'type'    => 'textarea_small',
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Page Banner Intro Text', 'tp-framework' ),
		'desc'    => esc_html__( 'Enter some intro text in banner', 'tp-framework' ),
		'id'      => 'intro_content_banner',
		'type'    => 'textarea_small',
	) );

}


/**** Skill Meta ***/

add_action( 'cmb2_admin_init', 'themephi_register_repeatable_group_field_metabox' );
/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function themephi_register_repeatable_group_field_metabox() {
	$prefix = 'tp_group_';  

	/**
	 * Repeatable Field Groups
	 */
	$cmb_group = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => esc_html__( 'Team Member Skill', 'tp-framework' ),
		'object_types' => array( 'teams' ),
		'priority'     => 'low',  //  'high', 'core', 'default' or 'low'
	) );
    
	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_id = $cmb_group->add_field( array(
		'id'          => 'member_skill',
		'type'        => 'group',
		'description' => esc_html__( 'Team Member Personal Skills', 'tp-framework' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Skill {#}', 'tp-framework' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add More Skill', 'tp-framework' ),
			'remove_button' => esc_html__( 'Remove Skill', 'tp-framework' ),
			'sortable'      => true, // beta
		),
	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Skill Title', 'tp-framework' ),
		'id'         => 'skill_title',
		'type'       => 'text',
	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Skill Level', 'tp-framework' ),
		'id'         => 'skill_level',
		'type'       => 'text',
		'desc' => esc_html__( 'add skill level as like (35%) out 100%', 'tp-framework' ),
	) );		

}


/**** Product Ingredient ***/

add_action( 'cmb2_admin_init', 'product_register_repeatable_group_field_metabox' );
/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function product_register_repeatable_group_field_metabox() {
	$prefix = 'tp_group_in_';

	/**
	 * Repeatable Field Groups
	 */
	$cmb_group = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => esc_html__( 'Product Ingredient', 'tp-framework' ),
		'object_types' => array( 'product' ),
		'priority'     => 'low',  //  'high', 'core', 'default' or 'low'
	) );


	$cmb_group->add_field( array(
		'name'    => esc_html__( 'Ingredient Label', 'tp-framework' ),
		'id'      => 'product_ingredient_label',
		'type'    => 'text',
	) );

	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_id = $cmb_group->add_field( array(
		'id'          => 'product-ingredient',
		'type'        => 'group',
		'description' => esc_html__( 'Product Ingredient Information', 'tp-framework' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Ingredient {#}', 'tp-framework' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add More Ingredient', 'tp-framework' ),
			'remove_button' => esc_html__( 'Remove Ingredient', 'tp-framework' ),
			'sortable'      => true, // beta
		),
	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Product Ingredient', 'tp-framework' ),
		'id'         => 'ingredient_feature',
		'type'       => 'text',
		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );	

}




add_action( 'cmb2_admin_init', 'header_style_register_field_metabox' );
/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function header_style_register_field_metabox() {
	$prefix = 'tp_group_header_';

	/**
	 * Repeatable Field Groups
	 */
	$cmb_meta_page = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => esc_html__( 'Header Layout', 'tp-framework' ),
		'object_types' => array( 'elementor-hf' ),
		'priority'     => 'low',  //  'high', 'core', 'default' or 'low'
	) );

	$cmb_meta_page->add_field( array(
		'name'    => esc_html__( 'Fixed Header Layout', 'tp-framework' ),
		'desc'    => esc_html__( 'If you active it your header layout will be fixed/absolutue positon', 'tp-framework' ),		
		'id'      => 'header-position',
		'type'    => 'checkbox',
	) );

	
}



// Timeline Year
add_action( 'cmb2_admin_init', 'tp_register_timeline_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function tp_register_timeline_metabox() {
	$prefix = 'tp_demo_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_meta_page = new_cmb2_box( array(
		'id'            => $prefix . 'timeline',
		'title'         => esc_html__( 'Timeline Settings', 'tp-framework' ),
		'object_types'  => array( 'timelines' ), // Post type

	) );	

	$cmb_meta_page->add_field( array(
		'name'    => esc_html__( 'Enter Period of Time', 'tp-framework' ),
		'desc'    => esc_html__( 'Enter Period of Time i.e year of experience or year', 'tp-framework' ),		
		'id'      => 'year',
		'type'    => 'text_medium',
	) );
}

/**
 * Callback to define the optionss-saved message.
 *
 * @param CMB2  $cmb The CMB2 object.
 * @param array $args {
 *     An array of message arguments
 *
 *     @type bool   $is_options_page Whether current page is this options page.
 *     @type bool   $should_notify   Whether options were saved and we should be notified.
 *     @type bool   $is_updated      Whether options were updated with save (or stayed the same).
 *     @type string $setting         For add_settings_error(), Slug title of the setting to which
 *                                   this error applies.
 *     @type string $code            For add_settings_error(), Slug-name to identify the error.
 *                                   Used as part of 'id' attribute in HTML output.
 *     @type string $message         For add_settings_error(), The formatted message text to display
 *                                   to the user (will be shown inside styled `<div>` and `<p>` tags).
 *                                   Will be 'Settings updated.' if $is_updated is true, else 'Nothing to update.'
 *     @type string $type            For add_settings_error(), Message type, controls HTML class.
 *                                   Accepts 'error', 'updated', '', 'notice-warning', etc.
 *                                   Will be 'updated' if $is_updated is true, else 'notice-warning'.
 * }
 */
function tp_options_page_message_callback( $cmb, $args ) {
	if ( ! empty( $args['should_notify'] ) ) {

		if ( $args['is_updated'] ) {

			// Modify the updated message.
			$args['message'] = sprintf( esc_html__( '%s &mdash; Updated!', 'tp-framework' ), $cmb->prop( 'title' ) );
		}

		add_settings_error( $args['setting'], $args['code'], $args['message'], $args['type'] );
	}
}

/**
 * Only show this box in the CMB2 REST API if the user is logged in.
 *
 * @param  bool                 $is_allowed     Whether this box and its fields are allowed to be viewed.
 * @param  CMB2_REST_Controller $cmb_controller The controller object.
 *                                              CMB2 object available via `$cmb_controller->rest_box->cmb`.
 *
 * @return bool                 Whether this box and its fields are allowed to be viewed.
 */
function tp_limit_rest_view_to_logged_in_users( $is_allowed, $cmb_controller ) {
	if ( ! is_user_logged_in() ) {
		$is_allowed = false;
	}

	return $is_allowed;
}

add_action('cmb2_admin_init', 'coupons_custom_meta');

function coupons_custom_meta() {
    $cmb = new_cmb2_box(array(
        'id'            => 'coupons_custom_meta_id',
        'title'         => __('Coupons Gallery', 'tp-framework'),
        'object_types'  => array('coupon'), // Custom post type
        'context'       => 'side',
        'priority'      => 'default',
    ));  

	$cmb->add_field(array(
        'desc'       => 'Upload and manage gallery images',
        'id'         => 'tp_gallery_images',
        'type'       => 'file_list',
        'options'    => array(
            'add_upload_file_text' => 'Add Images', // Change the text of the upload button
        ),
        'query_args' => array(
            'type' => 'image', // Specify to only show images
        ),
        'text' => array(
            'add_upload_file_text' => 'Add Images',
            'remove_image' => 'Remove Image',
            'file' => 'File',
            'file_remove' => 'Remove File',
        ),
    ));

}

add_action( 'cmb2_admin_init', 'tp_coupons_details_metas' );
/**
 * Define the metabox and field configurations.
 */
function tp_coupons_details_metas() {

    /**
     * Initiate the metabox
     */
    $cmb = new_cmb2_box( array(
        'id'            => 'tp_coupons_details_metas_id',
        'title'         => __( 'Coupon Details', 'tp-framework' ),
        'object_types'  => array( 'coupon' ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        'cmb_styles' => false, // false to disable the CMB stylesheet
        'closed'     => true, // Keep the metabox closed by default
    ) );

    $cmb->add_field( 
        array(
            'id'                => 'ctype',
            'name'              => esc_html__( 'Coupon Type', 'tp-framework' ),
            'type'              => 'select',
            'options'           => array(
                '1' => esc_html__( 'Online Code', 'tp-framework' ),
                '2' => esc_html__( 'In Store Code', 'tp-framework' ),
                '3' => esc_html__( 'Online Sale', 'tp-framework' ),
            ),
            'default'           => '1',
        )
    );

    $cmb->add_field( 
        array(
            'id'                => 'expire',
            'name'              => esc_html__( 'Expire Time', 'tp-framework' ),
            'desc'              => esc_html__( 'Settings to time 00:00:00 means that coupon will expire at the start of the selected day while selection 23:59:59 means that it will be available until end of the day.', 'tp-framework' ),
            'type'              => 'text_datetime_timestamp',
        )
    );

    $cmb->add_field( 
        array(
            'id'                => 'exclusive',
            'name'              => esc_html__( 'Is Exclusive', 'tp-framework' ),
            'type'              => 'checkbox',
        )
    );

    $cmb->add_field( 
        array(
            'id'                => 'verified',
            'name'              => esc_html__( 'Is Verified', 'tp-framework' ),
            'type'              => 'checkbox',
        )
    );

    $cmb->add_field( 
        array(
            'id'                => 'used',
            'name'              => esc_html__( 'Used', 'tp-framework' ),
            'type' => 'text',  
            'attributes' => array(
                'type' => 'number',  
                'min'  => 0,         
            ),
            'sanitization_cb' => 'absint',
        )
    );

    $cmb->add_field( 
        array(
            'id'                => 'positive',
            'name'              => esc_html__( 'Positive Feedback', 'tp-framework' ),
            'type' => 'text',  
            'attributes' => array(
                'type' => 'number',  
                'min'  => 0,         
            ),
            'sanitization_cb' => 'absint',
        )
    );

    $cmb->add_field( 
        array(
            'id'                => 'negative',
            'name'              => esc_html__( 'Negative Feedback', 'tp-framework' ),
            'type' => 'text',  
            'attributes' => array(
                'type' => 'number',  
                'min'  => 0,         
            ),
            'sanitization_cb' => 'absint',
        )
    );

    $cmb->add_field( 
        array(
            'id'                => 'coupon_affiliate',
            'name'              => esc_html__( 'Affiliate Link', 'tp-framework' ),
            'type'              => 'text',
            'description' => __( 'Value. Ex: www.affiliatelink.com', 'tp-framework' ),
        )
    );

    $cmb->add_field( 
        array(
            'id'                => 'coupon_spec_link',
            'name'              => esc_html__( 'Specific Link', 'tp-framework' ),
            'type'              => 'text',
            'desc'              => esc_html__( 'If coupon code must be applied to specific product/URL add link here an it will overwrite link to store', 'tp-framework' )
        )
    );

    $cmb->add_field( 
        array(
            'id'                => 'coupon_code_change',
            'name'              => esc_html__( 'Coupon Code', 'tp-framework' ),
            'type'              => 'text',
            'description' => __( 'Value. Ex: XREFGDGDOP', 'tp-framework' ),
        )
    );

    $cmb->add_field( 
        array(
            'id'                => 'coupon_url',
            'name'              => esc_html__( 'Coupon Link', 'tp-framework' ),
            'type'              => 'text',
        )
    );

    $cmb->add_field( 
        array(
            'id'                => 'coupon_printable',
            'name'              => esc_html__( 'Printable', 'tp-framework' ),
            'type'              => 'file',
        )
    );

    function enqueue_cmb2_conditional_js() {
        ?>
        <script type="text/javascript">
            (function($) {
                function toggleFieldsBasedOnCtype() {
                    var ctypeValue = $('#ctype').val();  
					
                    $('.cmb2-id-coupon-code-change').toggle(ctypeValue === '1'); // Show if 'Online Code'
                    $('.cmb2-id-coupon-printable').toggle(ctypeValue === '2'); // Show if 'In Store Code'
                    $('.cmb2-id-coupon-url').toggle(ctypeValue === '3'); // Show if 'Online Sale'
                }

                $(document).ready(function() {
                    toggleFieldsBasedOnCtype();  // Initial check on page load
                    $('#ctype').on('change', toggleFieldsBasedOnCtype);  // Bind change event to dynamically update
                });
            })(jQuery);
        </script>
        <?php
    }
    add_action('admin_footer', 'enqueue_cmb2_conditional_js');
}


add_action( 'cmb2_admin_init', 'tp_product_metabox' );
/**
 * Define the metabox and field configurations.
 */
function tp_product_metabox() {

	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box( array(
		'id'            => 'tp_product__meta',
		'title'         => __( 'TP Metabox', 'tp-framework' ),
		'object_types'  => array( 'product', ), // Post type
		'context'       => 'side',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );

	$cmb->add_field( array(
		'name'    => 'Product 2nd Image',
		'desc'    => 'This Image will show on the product hover on the home page if no gallery image is uploaded.',
		'id'      => 'tp_product_2nd_img',
		'type'    => 'file',
		'options' => array(
			'url' => false, // Hide the text input for the url
		),
		'text'    => array(
			'add_upload_file_text' => 'Add File' // Change upload button text. Default: "Add or Upload File"
		),
		'preview_size' => 'thumbnail', // Image size to use when previewing in the admin.
	) );
	$cmb->add_field( array(
		'name' => 'Disable New Badge',
		'desc' => 'Check for only disable the new badge for this post',
		'id'   => 'disable_new_badge',
		'type' => 'checkbox',
	) );

}



add_action( 'cmb2_admin_init', 'tp_testimonial_metabox' );
/**
 * Define the metabox and field configurations.
 */
function tp_testimonial_metabox() {

	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box( array(
		'id'            => 'testimonial_info_meta',
		'title'         => __( 'Testimonial Info', 'tp-framework' ),
		'object_types'  => array( 'tp-testimonials', ), // Post type
		'context'       => 'top',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );

	$cmb->add_field( array(
		'name'    => 'Review Title',
		'desc'    => 'Give Your Review A Title.',
		'id'      => 'tp_review__title',
		'type'    => 'text',
		
	) );

	$cmb->add_field( array(
		'name'    => 'Author Designation',
		'desc'    => 'Your Designation.',
		'id'      => 'designation',
		'type'    => 'text',
	) );

	$cmb->add_field( array(
		'name'             => 'Select Ratings',
		'desc'             => 'Select ratings',
		'id'               => 'ratings',
		'type'             => 'select',
		'show_option_none' => true,
		'options'          => array(
			'1'   => __( '1', 'tp-framework' ),
			'1.5' => __( '1.5', 'tp-framework' ),
			'2'   => __( '2', 'tp-framework' ),
			'2.5' => __( '2.5', 'tp-framework' ),
			'3'   => __( '3', 'tp-framework' ),
			'3.5' => __( '3.5', 'tp-framework' ),
			'4'   => __( '4', 'tp-framework' ),
			'4.5' => __( '4.5', 'tp-framework' ),
			'5'   => __( '5', 'tp-framework' ),
		),
	) );


}

// services_addition_here

add_action( 'cmb2_admin_init', 'tp_register_services_taxonomy_metabox' );
/**
 * Hook in and add a metabox to add fields to taxonomy terms
 */
function tp_register_services_taxonomy_metabox() {

	/**
	 * Metabox to add fields to categories and tags
	 */
	$cmb_term = new_cmb2_box( array(
		'id'               => 'tp_service_cat_info',
		'title'            => esc_html__( 'Category Metabox', 'cmb2' ), // Doesn't output for term boxes
		'object_types'     => array( 'term' ), // Tells CMB2 to use term_meta vs post_meta
		'taxonomies'       => array( 'service-category' ), // Tells CMB2 which taxonomies should have these fields
	) );

	$cmb_term->add_field( array(
		'name' => esc_html__( 'Icon', 'cmb2' ),
		'desc' => esc_html__( 'Add Service Category Icon Image', 'cmb2' ),
		'id'   => 'tp_service_cat_icon',
		'type' => 'file',
		'options' => array(
			'url' => false, // Hide the text input for the url
		),
		'text'    => array(
			'add_upload_file_text' => 'Add Icon'
		),
		'preview_size' => 'thumbnail', // Image size to use when previewing in the admin.
	) );

	$cmb_term->add_field( array(
		'name' => esc_html__( 'Category Image', 'cmb2' ),
		'desc' => esc_html__( 'Add Category Image', 'cmb2' ),
		'id'   => 'tp_service_cat_image',
		'type' => 'file',
		'options' => array(
			'url' => false, // Hide the text input for the url
		),
		'text'    => array(
			'add_upload_file_text' => 'Add Image'
		),
		'preview_size' => 'thumbnail', // Image size to use when previewing in the admin.
	) );		

}

// products_addition_here
add_action( 'cmb2_admin_init', 'tp_register_taxonomy_metabox' );
/**
 * Hook in and add a metabox to add fields to taxonomy terms
 */
function tp_register_taxonomy_metabox() {

	/**
	 * Metabox to add fields to categories and tags
	 */
	$cmb_term = new_cmb2_box( array(
		'id'               => 'tp_pcat_info',
		'title'            => esc_html__( 'Category Metabox', 'cmb2' ), // Doesn't output for term boxes
		'object_types'     => array( 'term' ), // Tells CMB2 to use term_meta vs post_meta
		'taxonomies'       => array( 'product_cat' ), // Tells CMB2 which taxonomies should have these fields
	) );

	$cmb_term->add_field( array(
		'name' => esc_html__( 'Icon', 'cmb2' ),
		'desc' => esc_html__( 'Add Product Category Icon Image', 'cmb2' ),
		'id'   => 'tp_pcat_icon',
		'type' => 'file',
		'options' => array(
			'url' => false, // Hide the text input for the url
		),
		'text'    => array(
			'add_upload_file_text' => 'Add Icon'
		),
		'preview_size' => 'thumbnail', // Image size to use when previewing in the admin.
	) );

	$cmb_term->add_field( array(
		'name' => esc_html__( 'Category Image', 'cmb2' ),
		'desc' => esc_html__( 'Add Category Image', 'cmb2' ),
		'id'   => 'tp_pcat_image',
		'type' => 'file',
		'options' => array(
			'url' => false, // Hide the text input for the url
		),
		'text'    => array(
			'add_upload_file_text' => 'Add Image'
		),
		'preview_size' => 'thumbnail', // Image size to use when previewing in the admin.
	) );

	$cmb_term->add_field( array(
		'name'    => 'Category Grid Item Background',
		'id'      => 'pcat_grid_bg',
		'type'    => 'colorpicker',
		'options' => array(
			'alpha' => true, 
		),
		) );
		
	$cmb_term->add_field( array(
		'name'    => 'Category Grid Item Button Color',
		'id'      => 'pcat_grid_btn_color',
		'type'    => 'colorpicker',
		'desc' 	  => esc_html__( 'Try to pick a similar color like icon ', 'cmb2' ),
		'options' => array(
			'alpha' => true, 
		),
	) );		

}
