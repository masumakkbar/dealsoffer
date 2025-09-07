<?php
namespace Elementor;

function tpelements_pro_shortcode_insert_elementor($atts){
    if(!class_exists('Elementor\Plugin')){
        return '';
    }
    if(!isset($atts['id']) || empty($atts['id'])){
        return '';
    }

    $post_id = $atts['id'];

	$post_id = apply_filters( 'wpml_object_id', $post_id, 'tp_elements' );

    $response = Plugin::instance()->frontend->get_builder_content_for_display($post_id);
    return $response;
}
add_shortcode('SHORTCODE_ELEMENTOR','Elementor\tpelements_pro_shortcode_insert_elementor');


function tpelements_pro_shortcode_enable_elementor(){
    add_post_type_support( 'TP Elements', 'elementor' );
}
add_action('elementor/init','Elementor\tpelements_pro_shortcode_enable_elementor');


function tpelements_pro_shortcode_data($sections){
    foreach ( $sections as $section_data ) {
        $section = new Element_Section( $section_data );

        $section->print_element();
    }
}
/**
 *  Enable the use of shortcodes in text widgets.
 */
add_filter( 'widget_text', 'do_shortcode' );