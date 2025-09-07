<div class="store-box">
    <h4><?php echo esc_html( $store->post_title ); ?></h4>
    <?php
    $store_image = get_post_meta( $store->ID, 'store_image', true );
    if ( ! empty( $store_image ) ) {
        echo '<img src="' . esc_url( $store_image ) . '" alt="' . esc_attr( $store->post_title ) . '" />';
    }
    ?>
</div>

