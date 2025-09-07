<?php

/* Custom Meta For Taxonomies */
/* Adding New */
if( !function_exists('couponis_store_icon_add') ){
    function couponis_store_icon_add() {
        ?>
        <div class="form-field">
            <label for="store_image"><?php esc_html_e( 'Image:', 'dealsoffer' ) ?></label>
            <input type="hidden" name="store_image" value="">
            <div class="image-holder">
            </div>
            <a href="javascript:;" class="add_store_image button"><?php esc_html_e( 'Select Image', 'dealsoffer' ); ?></a>
            <p class="description"><?php esc_html_e( 'Select image for the store','dealsoffer' ); ?></p>
        </div>
        <div class="form-field">
            <label for="store_url"><?php esc_html_e( 'Store URL:', 'dealsoffer' ); ?></label>
            <input type="text" name="store_url" value="">
            <p class="description"><?php esc_html_e( 'Input URL of the store','dealsoffer' ); ?></p>
        </div>
        <!-- store address  -->
        <div class="form-field">
            <label for="store_address"><?php esc_html_e( 'Store Address:', 'dealsoffer' ); ?></label>
            <input type="text" name="store_address" value="">
            <p class="description"><?php esc_html_e( 'Input Address of the store','dealsoffer' ); ?></p>
        </div>
        <!-- store address  -->
        <div class="form-field">
            <label><?php esc_html_e( 'Store Locations:', 'dealsoffer' ); ?></label>
            <?php tp_store_marker_wrap(); ?>
            <p class="description"><?php esc_html_e( 'Input location of the store in form LATITUDE,LONGITUDE','dealsoffer' ); ?></p>
            <a href="#" class="add-store-marker button"><?php esc_html_e( 'Add New Marker', 'dealsoffer' ); ?></a>
        </div>
        <div class="form-field">
            <label><?php esc_html_e( 'Rich description:', 'dealsoffer' ); ?></label>
            <?php wp_editor( '', 'store_rich_description', ['tinymce' => [
                'setup' => 'function (editor) {
                    editor.on("change", (e) => {
                        jQuery(\'#store_rich_description\').val( editor.getContent() );
                    });
                }',
            ]]); ?>
        </div>
        <?php
    }
    add_action( 'coupon-store_add_form_fields', 'couponis_store_icon_add', 10, 2 );
}

/* Editing */
if( !function_exists('couponis_store_icon_edit') ){
    function couponis_store_icon_edit( $term ) {
        $store_image = get_term_meta( $term->term_id, 'store_image', true );
        $store_url = get_term_meta( $term->term_id, 'store_url', true );
        $store_address = get_term_meta( $term->term_id, 'store_address', true );
        $store_location = get_term_meta( $term->term_id, 'store_location', true );
        $store_rich_description = get_term_meta( $term->term_id, 'store_rich_description', true );
        ?>
        <table class="form-table">
            <tbody>
                <tr class="form-field">
                    <th scope="row"><label for="store_image"><?php esc_html_e( 'Image', 'dealsoffer' ); ?></label></th>
                    <td>
                        <input type="hidden" name="store_image" value="<?php echo esc_attr( $store_image ) ?>">
                        <div class="image-holder">
                            <?php
                            if( !empty( $store_image ) ){
                                echo wp_get_attachment_image( $store_image, 'thumbnail' );
                                echo '<a href="javascript:;" class="button remove_store_image">X</a>';
                            }
                            ?>
                        </div>
                        <a href="javascript:;" class="add_store_image button"><?php esc_html_e( 'Select Image', 'dealsoffer' ); ?></a>
                        <p class="description"><?php esc_html_e( 'Select image for the store', 'dealsoffer' ); ?></p>
                    </td>
                </tr>
                <tr class="form-field">
                    <th scope="row"><label for="store_url"><?php esc_html_e( 'Store URL', 'dealsoffer' ); ?></label></th>
                    <td>
                        <input type="text" name="store_url" value="<?php echo esc_attr( $store_url ) ?>">
                        <p class="description"><?php esc_html_e( 'Input URL of the store', 'dealsoffer' ); ?></p>
                    </td>
                </tr>
                <!-- store address  -->
                <tr class="form-field">
                    <th scope="row"><label for="store_address"><?php esc_html_e( 'Store Address', 'dealsoffer' ); ?></label></th>
                    <td>
                        <input type="text" name="store_address" value="<?php echo esc_attr( $store_address ) ?>">
                        <p class="description"><?php esc_html_e( 'Input Address of the store', 'dealsoffer' ); ?></p>
                    </td>
                </tr>
                <!-- store address  -->
                <tr class="form-field">
                    <th scope="row"><label><?php esc_html_e( 'Store Locations', 'dealsoffer' ); ?></label></th>
                    <td>
                        <?php 
                        if( !empty( $store_location ) ){
                            $store_location = explode('|', $store_location);
                            foreach( $store_location as $store_marker ){
                                tp_store_marker_wrap( $store_marker );
                            }
                        }
                        else{
                            tp_store_marker_wrap();
                        }
                        ?>
                        <p class="description"><?php esc_html_e( 'Input location of the store in form LATITUDE,LONGITUDE','dealsoffer' ); ?></p>
                        <a href="#" class="add-store-marker button"><?php esc_html_e( 'Add New Marker', 'dealsoffer' ); ?></a>
                    </td>
                </tr>
                <tr class="form-field">
                    <th scope="row"><label><?php esc_html_e( 'Rich description', 'dealsoffer' ); ?></label></th>
                    <td>
                        <?php wp_editor( $store_rich_description, 'store_rich_description' ) ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php
    }
    add_action( 'coupon-store_edit_form_fields', 'couponis_store_icon_edit', 10, 2 );
}

/* Save It */
if( !function_exists('couponis_store_icon_save') ){
    function couponis_store_icon_save( $term_id ) {
        if ( isset( $_POST['store_image'] ) ) {
            update_term_meta( $term_id, 'store_image', $_POST['store_image'] );
        } else if( isset($_POST['action']) && $_POST['action'] !== 'inline-save-tax' ){
            delete_term_meta( $term_id, 'store_image' );
        }
        if ( isset( $_POST['store_url'] ) ) {
            update_term_meta( $term_id, 'store_url', $_POST['store_url'] );
        } else if( isset($_POST['action']) && $_POST['action'] !== 'inline-save-tax' ){
            delete_term_meta( $term_id, 'store_url' );
        }
        // store address 
        if ( isset( $_POST['store_address'] ) ) {
            update_term_meta( $term_id, 'store_address', $_POST['store_address'] );
        } else if( isset($_POST['action']) && $_POST['action'] !== 'inline-save-tax' ){
            delete_term_meta( $term_id, 'store_address' );
        }
        // store address 
        if ( isset( $_POST['store_location'] ) ) {
            $store_location = implode( '|', $_POST['store_location'] );
            update_term_meta( $term_id, 'store_location', $store_location );
        } else if( isset($_POST['action']) && $_POST['action'] !== 'inline-save-tax' ){
            delete_term_meta( $term_id, 'store_location' );
        }

        update_term_meta( $term_id, 'store_rich_description', $_POST['store_rich_description'] ?? '' );
    }  
    add_action( 'edited_coupon-store', 'couponis_store_icon_save', 10, 2 );  
    add_action( 'create_coupon-store', 'couponis_store_icon_save', 10, 2 );
}

/* Delete It */
if( !function_exists('couponis_store_icon_delete') ){
    function couponis_store_icon_delete( $t, $object_id, $meta_key, $meta_value ) {
        global $dealsoffer_option;
        if( $meta_key == 'store_image' ){
            $delete_store_images = $dealsoffer_option['delete_store_images'];
            if( $delete_store_images == 'yes' ){
                wp_delete_attachment( $meta_value, true );
            }
        }
        return $t;
    }  
    add_action( 'delete_term_meta', 'couponis_store_icon_delete', 10, 4 );  
}

/* Add icon column */
if( !function_exists('couponis_store_column') ){
    function couponis_store_column( $columns ) {
        $new_columns = array(
            'cb' 			=> '<input type="checkbox" />',
            'name' 			=> esc_html__('Name', 'dealsoffer'),
            'description' 	=> esc_html__('Description', 'dealsoffer'),
            'slug' 			=> esc_html__( 'Slug', 'dealsoffer' ),
            'posts' 		=> esc_html__( 'Posts', 'dealsoffer' ),
            'store_image' 	=> esc_html__( 'Image', 'dealsoffer' )
        );
        return $new_columns;
    }
    add_filter("manage_edit-coupon-store_columns", 'couponis_store_column'); 
}

if( !function_exists('couponis_populate_store_column') ){
    function couponis_populate_store_column( $out, $column_name, $term_id ){
        switch ( $column_name ) {  
            case 'store_image':
                $store_image = get_term_meta( $term_id, 'store_image', true );
                $out .= wp_get_attachment_image( $store_image, 'thumbnail' );
                break;
            default:
                break;
        }

        return $out; 
    }
    add_filter("manage_coupon-store_custom_column", 'couponis_populate_store_column', 10, 3);
}

if( !function_exists('couponis_register_store_rest_fields') ){
    function couponis_register_store_rest_fields(){
        register_term_meta( 'coupon-store', 'store_image', [
            'show_in_rest' => true,
            'single'       => true,
        ]);
        register_term_meta( 'coupon-store', 'store_url', [
            'show_in_rest' => true,
            'single'       => true,
        ]);
        // store address 
        register_term_meta( 'coupon-store', 'store_address', [
            'show_in_rest' => true,
            'single'       => true,
        ]);
        // store address 
        register_term_meta( 'coupon-store', 'store_location', [
            'show_in_rest' => true,
            'single'       => true,
        ]);
        register_term_meta( 'coupon-store', 'store_rich_description', [
            'show_in_rest' => true,
            'single'       => true,
        ]);
    }
    add_action( 'rest_api_init', 'couponis_register_store_rest_fields' );
}
?>
