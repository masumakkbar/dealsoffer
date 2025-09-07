<?php
/*
    Template Name: My Account
*/
global $dealsoffer_option;

if ( ! is_user_logged_in() ) {
    wp_redirect( home_url( '/' ) );
    exit;
}

$user = wp_get_current_user();
$saved_coupons = get_user_meta( $user->ID, 'saved_coupons', true );
$saved_stores = get_user_meta( $user->ID, 'saved_stores', true );
$can_delete_account = isset($dealsoffer_option['delete_account']) ? $dealsoffer_option['delete_account'] : '';

get_header();
?>

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-lg-12">
                <div class="tp-coupon-account-wrapper">

                    
                    <div class="nav tp-coupon-account-tab <?php echo esc_attr( $can_delete_account == 'yes' ? 'tabs-4' : 'tabs-3' ); ?>" role="tablist">

                        <button class="active" id="coupons-tab" data-bs-toggle="tab" data-bs-target="#coupons" type="button" role="tab" aria-controls="coupons" aria-selected="true"><?php esc_html_e( 'Saved Coupons', 'dealsoffer' ); ?></button>
                        <button id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false"><?php esc_html_e( 'Profile', 'dealsoffer' ) ?></button>

                        <?php if( $can_delete_account == 'yes' ): ?>
                        <button id="delete-account-tab"  class="delete-account" data-bs-toggle="tab" type="button" role="tab" data-confirm="<?php esc_attr_e( 'Are you sure you want to delete your account?', 'dealsoffer') ?>" >
                            <?php esc_html_e( 'Delete Account', 'dealsoffer' ) ?>
                        </button>
                        <?php endif; ?>

                    </div>

                    <div class="tab-content" id="nav-tabContent">
                        <div role="tabpanel" class="tab-pane fade show active" id="coupons" aria-labelledby="coupons-tab">
                            <div class="white-block">
                                <?php 
                                    $saved_coupons_query = new WP_Coupons_Query(array(
                                        'saved_only' => true,
                                        'posts_per_page' => 10
                                    ));

                                    if ($saved_coupons_query->have_posts()) :
                                        while ($saved_coupons_query->have_posts()) : $saved_coupons_query->the_post();
                                            the_title();
                                        endwhile;
                                        wp_reset_postdata();
                                    else :
                                        echo 'No saved coupons';
                                    endif;
                                ?>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
                            <div class="white-block">
                                <div class="white-block-content">
                                    <form class="ajax-form">
                                        <div class="form-group">
                                            <label for="email"><?php esc_html_e( 'Email', 'dealsoffer' ) ?> *</label>
                                            <input type="email" name="email" id="email" class="form-control" value="<?php echo esc_attr( $user->user_email ); ?>" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="password"><?php esc_html_e( 'Password', 'dealsoffer' ) ?></label>
                                            <input type="password" name="password" id="password" class="form-control" placeholder="<?php esc_attr_e( 'type password', 'dealsoffer' ) ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirm"><?php esc_html_e( 'Confirm Password', 'dealsoffer' ) ?></label>
                                            <input type="password" name="password_confirm" id="password_confirm" class="form-control" placeholder="<?php esc_attr_e( 'retype password', 'dealsoffer' ) ?>" />
                                        </div>
                                        <div class="ajax-form-result"></div>
                                        <button type="submit" class="btn submit-ajax-form box-style box-second rounded-pill d-center "><?php esc_html_e( 'Update Profile', 'dealsoffer' ) ?></button>
                                        <input type="hidden" name="action" value="update_profile">
                                        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'coupon_feedback_nonce' ); ?>">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>