<?php
/*
    Template Name: Submit Coupon
*/
global $dealsoffer_option;
if ( ! is_user_logged_in() ) {
    wp_redirect( home_url( '/' ) );
    exit;
} else if ( $dealsoffer_option['can_submit'] == 'no' ) {
    wp_redirect( home_url( '/' ) );
    exit;
}

get_header();
the_post();

// $coupon_types = $dealsoffer_option['coupon_types'];
// $ajax_taxonomy = $dealsoffer_option['ajax_taxonomy'];

$coupon_types = isset($dealsoffer_option['coupon_types']) ? $dealsoffer_option['coupon_types'] : [];
$ajax_taxonomy = isset($dealsoffer_option['ajax_taxonomy']) ? $dealsoffer_option['ajax_taxonomy'] : 'no';
?>

<main>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-block">
                    <div class="white-block-single-content">
                        <form class="ajax-form">
                            <div class="row">
								<div class="col-xl-12">
                                    <div class="form-group">
                                        <label for="title"><?php esc_html_e( 'Coupon Title', 'dealsoffer' ) ?> *</label>
                                        <input type="text" name="title" id="title" class="form-control" placeholder="<?php esc_attr_e( 'Place Coupon Title Here', 'dealsoffer' ) ?>" required />
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label for="type"><?php esc_html_e( 'Coupon Type', 'dealsoffer' ) ?> *</label>
                                        <select name="type" id="type" class="form-control" required>
                                            <?php if ( empty( $coupon_types ) || in_array( '1', $coupon_types ) ): ?>
                                                <option value="1"><?php esc_html_e( 'Online Code', 'dealsoffer' ) ?></option>
                                            <?php endif; ?>
                                            <?php if ( empty( $coupon_types ) || in_array( '2', $coupon_types ) ): ?>
                                                <option value="2"><?php esc_html_e( 'In Store Code', 'dealsoffer' ) ?></option>
                                            <?php endif; ?>
                                            <?php if ( empty( $coupon_types ) || in_array( '3', $coupon_types ) ): ?>
                                                <option value="3"><?php esc_html_e( 'Online Sale', 'dealsoffer' ) ?></option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label for="expire"><?php esc_html_e( 'Expire Date', 'dealsoffer' ) ?> *</label>
                                        <input type="date" name="expire" id="expire" class="form-control" required />
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label for="used"><?php esc_html_e( 'Used Number', 'dealsoffer' ) ?></label>
                                        <input type="number" name="used" id="used" class="form-control" placeholder="<?php esc_attr_e( 'Used Number Value', 'dealsoffer' ) ?>" />
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label for="positive"><?php esc_html_e( 'Positive Feedback', 'dealsoffer' ) ?></label>
                                        <input type="number" name="positive" id="positive" class="form-control" placeholder="<?php esc_attr_e( 'Positive Number Value', 'dealsoffer' ) ?>" />
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label for="coupon_affiliate"><?php esc_html_e( 'Affiliate Link', 'dealsoffer' ) ?></label>
                                        <input type="text" name="coupon_affiliate" id="coupon_affiliate" class="form-control" placeholder="<?php esc_attr_e( 'Affiliate Link Here', 'dealsoffer' ) ?>" />
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label for="coupon_code_change"><?php esc_html_e( 'Coupon Code', 'dealsoffer' ) ?> *</label>
                                        <input type="text" name="coupon_code_change" id="coupon_code_change" class="form-control" placeholder="<?php esc_attr_e( 'Coupon Code Here', 'dealsoffer' ) ?>" required />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description"><?php esc_html_e( 'Coupon Description', 'dealsoffer' ) ?> *</label>
                                <textarea name="description" id="description" class="form-control" placeholder="<?php esc_attr_e( 'Leave Message Here', 'dealsoffer' ) ?>" required></textarea>
                            </div>
                            <div class="form-group-checkbox mb-20">
                                <input type="checkbox" name="exclusive" id="exclusive" />
                                <label for="exclusive"><?php esc_html_e( 'Is Exclusive?', 'dealsoffer' ) ?></label>
                            </div>
                            <div class="ajax-form-result"></div>
                            <button type="submit" class="submit-ajax-form"><?php esc_html_e( 'Submit Coupon', 'dealsoffer' ) ?></button>
                            <input type="hidden" name="action" value="submit_coupon">
                            <input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'coupon_feedback_nonce' ); ?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>