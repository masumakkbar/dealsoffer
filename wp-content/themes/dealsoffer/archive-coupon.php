<?php
get_header();

// Pagination settings
$items_per_page = 12;
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args = array(
    'taxonomy'   => 'coupon-category',
    'parent'     => 0,          
    'hide_empty' => true,        
    'number'     => $items_per_page, 
    'offset'     => ( $paged - 1 ) * $items_per_page, 
);

$categories = get_terms( $args );

$total_categories = count( get_terms( array(
    'taxonomy'   => 'coupon-category',
    'parent'     => 0,
    'hide_empty' => true,
) ) );

$total_pages = ceil( $total_categories / $items_per_page );
?>

<div class="tp-coupon-category-wrapper">
    <div class="container">
        <?php if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : ?>
            <div class="row">
                <?php foreach ( $categories as $category ) : 
                    $cat_image_id = get_term_meta( $category->term_id, 'category_icon', true );
                    if ( $cat_image_id ) {
                        $cat_image_url = wp_get_attachment_image_url( $cat_image_id, 'full' );
                    } else {
                        $cat_image_url = ''; 
                    }
                ?>
                    <div class="col-lg-3">
                        <div class="tp-coupon-cat-item">
                            <div class="tp-coupon-cat-img">
                                <?php if ( $cat_image_url ) : ?>
                                    <img src="<?php echo esc_url( $cat_image_url ); ?>" alt="<?php echo esc_attr( $category->name ); ?>">
                                <?php endif; ?>
                                <span><?php echo esc_html( '(' . $category->count . ')' ); ?></span>
                            </div>
                            <h4 class="tp-coupon-cat-name">
                                <a href="<?php echo esc_url( get_term_link( $category ) ); ?>">
                                    <?php echo esc_html( $category->name ); ?> 
                                </a>
                            </h4>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
  
            <!-- Pagination -->
            <div class="tp-theme-pagination mb-40 mt-10 text-center">
                <?php
                echo paginate_links( array(
                    'total'     => $total_pages,
                    'current'   => $paged,
                    'prev_text' => '<i class="tp tp-angle-left"></i>',
                    'next_text' => '<i class="tp tp-angle-right"></i>',
                ) );
                ?>
            </div>

        <?php else : ?>
            <p><?php esc_html_e( 'No categories found.', 'dealsoffer' ); ?></p>
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();
?>
