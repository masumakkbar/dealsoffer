<?php

/* Custom Meta For Taxonomies */
/* Adding New */
if( !function_exists('couponis_category_icon_add') ){
function couponis_category_icon_add() {
	echo '
	<div class="form-field">
		<label for="category_image">'.esc_html__( 'Icon:', 'dealsoffer' ).'</label>
		<div class="icon-preview"></div>
		<select name="category_icon" class="category_icon">
			'.couponis_category_icon_list().'
		</select>
		<span class="cat-divider"></span>
		<a href="#" class="cat-icon button">'.esc_html__( 'Select Image', 'dealsoffer' ).'</a>
		<p class="description">'.esc_html__( 'Select icon for the category','dealsoffer' ).'</p>
	</div>
	<div class="form-field">
		<input type="checkbox" name="category_hide" id="category_hide" />
		<label for="category_hide">'.esc_html__( 'Hide From All Categories', 'dealsoffer' ).'</label>
		<p class="description">'.esc_html__( 'Hide this categry from showing on all categories page','dealsoffer' ).'</p>
	</div>
	';
}
add_action( 'coupon-category_add_form_fields', 'couponis_category_icon_add', 10, 2 );
}


if( !function_exists( 'couponis_terms_styles' ) ){
function couponis_terms_styles(){

}
}
add_action('wp_enqueue_scripts', 'couponis_terms_styles' );

/*
Create options for category icon selection
*/
if( !function_exists( 'couponis_category_icon_list' )){
function couponis_category_icon_list( $selected = '' ){
	$icons = couponis_awesome_icons_list();
	$list = '';
	foreach( $icons as $icon ){
		$list .= '<option value="'.esc_attr( $icon ).'" '.( $selected == $icon ? 'selected="selected"' : '' ).'>'.$icon.'</option>';
	}

	return $list;
}
}

if( !function_exists( 'couponis_category_icon' ) ){
function couponis_category_icon( $cat_id ){
	$category_icon = get_term_meta( $cat_id, 'category_icon', true );
	return couponis_build_category_icon( $category_icon );
}
}

if( !function_exists('couponis_category_svg') ){
function couponis_category_svg( $html, $attachment_id, $size, $icon, $attr ){
    
    if( !empty( $attr['src'] ) )
    { 
        $extension = pathinfo( $attr['src'], PATHINFO_EXTENSION );
        if( $extension == 'svg' )
        {
            $file = get_attached_file( $attachment_id );

            if( !empty( $file ) )
            {
                $html = file_get_contents( $file );
                $html = preg_replace( ['/[<]\!DOC[^>]*[>]/', '/[<]\?xml[^>]*[>]/', '/input="[^\"]*"/', '/in="/'], [ '', '', '', 'in2="' ], $html );
            }
        }
    }

    return $html;
}
}

if( !function_exists( 'couponis_build_category_icon' ) ){
function couponis_build_category_icon( $val ){
	if( !empty( $val ) )
	{
		if( is_numeric( $val ) )
		{
            add_filter( 'wp_get_attachment_image', 'couponis_category_svg', 10, 5 );
			return wp_get_attachment_image( $val, 'full' );
            remove_filter( 'wp_get_attachment_image', 'couponis_category_svg', 10, 5 );
		}
		else
		{
			return '<i class="fa fa-'.esc_attr( $val ).'"></i>';
		}
	}
}
}

/* Editing */
if( !function_exists('couponis_category_icon_edit') ){
function couponis_category_icon_edit( $term ) {
	$category_icon = get_term_meta( $term->term_id, 'category_icon', true );
	$category_hide = get_term_meta( $term->term_id, 'category_hide', true );
	?>
	<table class="form-table">
		<tbody>
			<tr class="form-field form-required">
				<th scope="row"><label for="category_icon"><?php esc_html_e( 'Image', 'dealsoffer' ); ?></label></th>
				<td>
					<div class="icon-preview">
						<?php echo couponis_build_category_icon( $category_icon ) ?>
						<?php if( is_numeric( $category_icon ) ): ?>
							<a href="#" class="button cat-icon-remove">X</a>
						<?php endif ?> 
					</div>
					<select name="category_icon" class="category_icon <?php echo is_numeric( $category_icon ) ? 'hidden' : '' ?>">
						<?php echo couponis_category_icon_list( $category_icon ) ?>
					</select>
					<span class="cat-divider <?php echo is_numeric( $category_icon ) ? 'hidden' : '' ?>"></span>
					<a href="#" class="cat-icon button"><?php esc_html_e( 'Select Image', 'dealsoffer' ); ?></a>
					<p class="description"><?php esc_html_e( 'Select icon for the category', 'dealsoffer' ); ?></p>
				</td>
			</tr>
			<tr class="form-field form-required">
				<th scope="row"><label for="category_hide"><?php esc_html_e( 'Hide From All Categories', 'dealsoffer' ); ?></label></th>
				<td>
					<input type="checkbox" name="category_hide" id="category_hide" <?php checked( 1, $category_hide ) ?>> 
					<p class="description"><?php esc_html_e( 'Hide this categry from showing on all categories page', 'dealsoffer' ); ?></p>
				</td>
			</tr>
		</tbody>
	</table>
	<?php
}
add_action( 'coupon-category_edit_form_fields', 'couponis_category_icon_edit', 10, 2 );
}

/* Save It */
if( !function_exists('couponis_category_icon_save') ){
function couponis_category_icon_save( $term_id ) {
	if ( isset( $_POST['category_icon'] ) ) {
		update_term_meta( $term_id, 'category_icon', $_POST['category_icon'] );
	}
	else if( isset($_POST['action']) && $_POST['action'] !== 'inline-save-tax' ){
		delete_term_meta( $term_id, 'category_icon' );
	}
	if ( isset( $_POST['category_hide'] ) ) {
		update_term_meta( $term_id, 'category_hide', '1' );
	}
	else if( isset($_POST['action']) && $_POST['action'] !== 'inline-save-tax' ){
		delete_term_meta( $term_id, 'category_hide' );
	}
}  
add_action( 'edited_coupon-category', 'couponis_category_icon_save', 10, 2 );  
add_action( 'create_coupon-category', 'couponis_category_icon_save', 10, 2 );
}


/* Add icon column */
if( !function_exists('couponis_category_column') ){
function couponis_category_column( $columns ) {
    $new_columns = array(
        'cb' 			=> '<input type="checkbox" />',
        'name' 			=> esc_html__('Name', 'dealsoffer'),
		'description' 	=> esc_html__('Description', 'dealsoffer'),
        'slug' 			=> esc_html__( 'Slug', 'dealsoffer' ),
		'posts' 		=> esc_html__( 'Posts', 'dealsoffer' ),
		'category_icon' => esc_html__( 'Icon', 'dealsoffer' )
        );
    return $new_columns;
}
add_filter("manage_edit-coupon-category_columns", 'couponis_category_column'); 
}

if( !function_exists('couponis_populate_category_column') ){
function couponis_populate_category_column( $out, $column_name, $term_id ){
    switch ( $column_name ) {  	
 		case 'category_icon':
            $out .= couponis_category_icon( $term_id );
			break;
        default:
            break;
    }

    return $out; 
}
add_filter("manage_coupon-category_custom_column", 'couponis_populate_category_column', 10, 3);
}

if( !function_exists('couponis_register_category_rest_fields') ){
function couponis_register_category_rest_fields(){
    register_term_meta( 'coupon-category', 'category_image', [
        'show_in_rest' => true,
        'single'       => true,
    ]);
    register_term_meta( 'coupon-category', 'category_hide', [
        'show_in_rest' => true,
        'single'       => true,
    ]);
}
add_action( 'rest_api_init', 'couponis_register_category_rest_fields' );
}


?>