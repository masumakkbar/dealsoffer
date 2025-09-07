<!-- share start -->
<div class="tp-coupon-modal-share share-<?php echo esc_attr( get_the_ID() ); ?> tp-post-share">
    <?php    
    if( !empty( $coupon_id ) ){
        $share_post_id = $coupon_id;
    } else {
        $share_post_id = get_the_ID();
    }
    ?>
    <div class="post-share">
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( rawurlencode( get_permalink( $share_post_id ) ) ); ?>" class="share facebook" target="_blank" title="<?php esc_attr_e( 'Share on Facebook', 'dealsoffer' ); ?>"><i class="fa fa-facebook fa-fw"></i></a>
        <a href="https://twitter.com/intent/tweet?source=<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>&amp;text=<?php echo esc_url( rawurlencode( get_permalink( $share_post_id ) ) ); ?>" class="share twitter" target="_blank" title="<?php esc_attr_e( 'Share on Twitter', 'dealsoffer' ); ?>"><i class="fa fa-twitter fa-fw"></i></a>
        <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url( rawurlencode( get_permalink( $share_post_id ) ) ); ?>&amp;title=<?php echo esc_url( rawurlencode( get_the_title( $share_post_id ) ) ); ?>&amp;source=<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="share linkedin" target="_blank" title="<?php esc_attr_e( 'Share on LinkedIn', 'dealsoffer' ); ?>"><i class="fa fa-linkedin fa-fw"></i></a>
        <a href="https://www.tumblr.com/share/link?url=<?php echo esc_url( rawurlencode( get_permalink( $share_post_id ) ) ); ?>&amp;name=<?php echo esc_url( rawurlencode( get_the_title( $share_post_id ) ) ); ?>" class="share tumblr" target="_blank" title="<?php esc_attr_e( 'Share on Tumblr', 'dealsoffer' ); ?>"><i class="fa fa-tumblr fa-fw"></i></a>
        <a href="https://t.me/share/url?url=<?php echo esc_url( rawurlencode( get_permalink( $share_post_id ) ) ); ?>&amp;text=<?php echo esc_url( rawurlencode( get_the_title( $share_post_id ) ) ); ?>" class="share telegram" target="_blank" title="<?php esc_attr_e( 'Share on Telegram', 'dealsoffer' ); ?>"><i class="fa fa-telegram fa-fw"></i></a>
        <a href="https://api.whatsapp.com/send?text=<?php echo esc_url( rawurlencode( get_permalink( $share_post_id ) ) ); ?>" class="share whatsapp" target="_blank" title="<?php esc_attr_e( 'Share on WhatsApp', 'dealsoffer' ); ?>"><i class="fa fa-whatsapp fa-fw"></i></a>
    </div>

</div>
<!-- share end -->