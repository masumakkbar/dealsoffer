<?php
/*
    Template Name: Recover Password
*/

if( is_user_logged_in() ){
    wp_redirect( home_url() );
}

get_header();
the_post();
//get_template_part( 'includes/title' );


if ( function_exists( 'couponis_get_permalink_by_tpl' ) ) {
    $submit_url = esc_url( couponis_get_permalink_by_tpl( 'page-tpl_submit' ) );
    $account_url = esc_url( couponis_get_permalink_by_tpl( 'page-tpl_account' ) );
    $login_url = esc_url( couponis_get_permalink_by_tpl( 'page-tpl_login' ) );
    $register_url = esc_url( couponis_get_permalink_by_tpl( 'page-tpl_register' ) );
    $recover_password_url = esc_url( couponis_get_permalink_by_tpl( 'page-tpl_recover_password' ) );
} else {
    $submit_url = home_url();
    $account_url = home_url();
    $login_url = home_url();
    $register_url = home_url();
    $recover_password_url = home_url();
}

$message = '';
if( function_exists( 'couponxl_recover_password_email' ) ) {
	couponxl_recover_password_email();
}

?>

<div class="signup-area ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-11 col-md-10 col-lg-8 col-xl-7 col-xxl-6">
                <div class="signup-wrapper">
                    <div class="signup-wrapper-header text-center">
                        <h2 class="signup-title">Recover Password</h2>
                    </div>
                    <div class="signup-wrapper-body">
                        <div class="signup-body-header text-center">
                            <h4 class="signup-body-title mb-15">Recover to Kidba</h4>
                            <?php if( !empty( $message ) ): ?>
                            <div class="white-block-content">
                                <?php echo wp_kses_post( $message ); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <form method="post" action="<?php  echo esc_url( $recover_password_url ); ?>" class="signup-body-content">
                            <div class="sign-single-input mb-15">
                                <label>Username</label>
                                <div class="sign-input">
                                    <input type="text" name="username" id="username" placeholder="<?php esc_attr_e( 'Your Username', 'dealsoffer' ); ?>" data-validation="required"  data-error="<?php esc_attr_e( 'Please input your username', 'dealsoffer' ); ?>">
                                    <i class="far fa-user"></i>
                                </div>
                            </div>
                            <div class="sign-single-input mb-30">
                                <label>Email</label>
                                <div class="sign-input">
                                    <input type="email" name="email" id="email" data-validation="required|email"  data-error="<?php esc_attr_e( 'Email is empty or invaid', 'dealsoffer' ); ?>" placeholder="<?php esc_attr_e( 'Your Email', 'dealsoffer' ); ?>">
                                    <i class="far fa-envelope"></i>
                                </div>
                            </div>
                            <!-- <div class="sign-single-input mb-25">
                                <label>Password</label>
                                <div class="sign-input">
                                    <input type="password" placeholder="Password">
                                    <i class="icofont-lock"></i>
                                </div>
                            </div> -->

                            <?php wp_nonce_field('recover','recover_field'); ?>

                            <div class="sign-buttons text-center">
                                <button class="submit-form def-btn "><?php _e( 'Recover Password', 'dealsoffer' ); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>