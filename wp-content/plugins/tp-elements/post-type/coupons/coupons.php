<?php 
class Themephi_Coupons {
    public function __construct() {
        add_action('init', [$this, 'tp_coupons_register_post_type']);
        add_action('init', [$this, 'tp_create_coupons_taxonomies']);
    }

    public function tp_coupons_register_post_type() {
        global $dealsoffer_option;
        $use_coupon_single = !empty($dealsoffer_option['use_coupon_single']) && $dealsoffer_option['use_coupon_single'] == 'yes';
        $coupon_slug = !empty($dealsoffer_option['trans_coupon']) ? $dealsoffer_option['trans_coupon'] : 'offer';

        $coupon_args = [
            'labels' => [
                'name'          => __( ucfirst( $coupon_slug ), 'tp-elements' ),
                'singular_name' => __( ucfirst( rtrim( $coupon_slug, 's' ) ), 'tp-elements' ),
            ],
            'public'              => true,
            'show_in_menu'        => true,
            'show_in_admin_bar'   => true,
            'can_export'          => true,
            'hierarchical'        => false,
            'menu_position'       => 20,
            'show_in_rest'        => true,
            'menu_icon'           => plugins_url('img/icon.png', __FILE__),
            'publicly_queryable'  => $use_coupon_single,
            'has_archive'         => true,
            'supports'            => ['title', 'thumbnail', 'editor', 'excerpt', 'comments'],
            'rewrite'             => ['slug' => $coupon_slug],
        ];

        register_post_type('coupon', $coupon_args);
    }

    public function tp_create_coupons_taxonomies() {
        global $dealsoffer_option;
        $coupon_category_slug = !empty($dealsoffer_option['trans_coupon-category']) ? $dealsoffer_option['trans_coupon-category'] : 'offer-category';
        $coupon_store_slug = !empty($dealsoffer_option['trans_coupon-store']) ? $dealsoffer_option['trans_coupon-store'] : 'offer-store';
        $coupon_tag_slug = !empty($dealsoffer_option['trans_coupon-tag']) ? $dealsoffer_option['trans_coupon-tag'] : 'offer-tag';
        $taxonomies = [
            [
                'slug'        => 'coupon-category',
                'plural'      => __( ucfirst( rtrim( $coupon_category_slug, 's' ) ) , 'tp-elements' ),
                'singular'    => __( ucfirst( $coupon_category_slug ), 'tp-elements' ),
                'hierarchical'=> true,
                'show_ui' => true,
                'show_admin_column' => true,
                'query_var' => true,
                'rewrite'     => $coupon_category_slug,
            ],
            [
                'slug'        => 'coupon-store',
                'plural'      => __( ucfirst( rtrim( $coupon_store_slug, 's' ) ) , 'tp-elements' ),
                'singular'    => __( ucfirst( $coupon_store_slug ), 'tp-elements' ),
                'hierarchical'=> true, 
                'show_ui' => true,
                'show_admin_column' => true,
                'query_var' => true,
                'rewrite'     => $coupon_store_slug,
            ],
            [
                'slug'        => 'coupon-tag',
                'plural'      => __( ucfirst( rtrim( $coupon_tag_slug, 's' ) ) , 'tp-elements' ),
                'singular'    => __( ucfirst( $coupon_tag_slug ), 'tp-elements' ),
                'hierarchical'=> false,
                'rewrite'     => $coupon_tag_slug,
            ],
        ];

        foreach ($taxonomies as $tax) {
            register_taxonomy($tax['slug'], 'coupon', [
                'show_in_rest' => true,
                'hierarchical' => $tax['hierarchical'],
                'labels'       => [
                    'name'          => $tax['plural'],
                    'singular_name' => $tax['singular'],
                    'menu_name'     => $tax['singular'],
                    'search_items'  => __('Search ', 'dealsoffer') . $tax['plural'],
                ],
                'rewrite' => ['slug' => $tax['rewrite']],
            ]);
        }
    }
}
new Themephi_Coupons();

