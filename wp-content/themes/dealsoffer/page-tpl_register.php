<?php
/*
    Template Name: Register
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
$success = false;

if( !empty( $confirmation_hash ) ){
    global $dealsoffer_option; 
    $username = get_query_var( $dealsoffer_option['username'], '' );
    $username = esc_sql( $username );
    $user = get_user_by( 'login', $username );
    if( !empty( $user ) ){
        $confirmation_hash = get_user_meta( $user->ID, 'confirmation_hash', true );
        if( !empty( $confirmation_hash ) && $confirmation_hash == $confirmation_hash ){
            update_user_meta( $user->ID, 'user_active_status', 'active' );
            $message = '<div class="alert alert-success">'.__( 'Thank you for confirming your email. Now you can proceed to login.', 'dealsoffer' ).'</div>';
        }
        else{
            $message = '<div class="alert alert-danger">'.__( 'Wrong confirmation hash.', 'dealsoffer' ).'</div>';
        }
    }
    else{
        $message = '<div class="alert alert-danger">'.__( 'There is no user with that username.', 'dealsoffer' ).'</div>';
    }
    $success = true;
}


?>
<?php if(get_option('users_can_register')): ?>

<div class="signup-area ">
    <?php if( !$success ): ?> 
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-11 col-md-10 col-lg-8 col-xl-7 col-xxl-6">
                <div class="signup-wrapper">
                    <?php if( !empty( $message ) ): ?>
                    <div class="white-block-content">
                        <?php echo wp_kses_post( $message ); ?>
                    </div>  
                    <?php endif; ?>
                    <div class="ajax-response"></div>
                    <div class="signup-wrapper-header text-center">
                        <h2 class="signup-title"><?php echo esc_html__('Register', 'dealsoffer'); ?></h2>
                    </div>
                    <div class="signup-wrapper-body">
                        <div class="signup-body-header text-center mb-45">
                            <span class="signup-body-subtitle"><?php echo esc_html__('Start For Free', 'dealsoffer'); ?></span>
                            <h4 class="signup-body-title"><?php echo esc_html__('Sign Up to You', 'dealsoffer'); ?></h4>
                            <span class="signtext d-block mb-25"><?php echo esc_html__('Already have account?', 'dealsoffer'); ?> <a href="<?php echo esc_url( $login_url ); ?>"><?php echo esc_html__('Login', 'dealsoffer'); ?></a></span>
                            <?php if ( shortcode_exists( 'nextend_social_login' ) ) : ?>
                                <?php echo do_shortcode('[nextend_social_login]'); ?>
                            <?php endif; ?>
                        </div>
                        <form class="signup-body-content" method="post" action="<?php echo esc_url( $register_url ); ?>">
                            <div class="sign-single-input ">
                                <label><?php echo esc_html__('E-mail', 'dealsoffer'); ?></label>
                                <div class="sign-input mb-15">
                                    <input type="email" name="email" id="email" placeholder="jhonstudent@gmail.com" data-validation="required|email"  data-error="<?php esc_attr_e( 'Email is empty or invalid', 'dealsoffer' ); ?>">
                                    <i class="far fa-envelope"></i>
                                </div>
                            </div>
                            <div class="sign-single-input mb-15">
                                <label><?php echo esc_html__('Username', 'dealsoffer'); ?></label>
                                <div class="sign-input">
                                    <input type="text" name="username" id="username" placeholder="Jhone Doe" data-validation="required"  data-error="<?php esc_attr_e( 'Insert Username', 'dealsoffer' ); ?>">
                                    <i class="far fa-user"></i>
                                </div>
                            </div>
                            <div class="sign-single-input mb-15">
                                <label><?php echo esc_html__('Password', 'dealsoffer'); ?></label>
                                <div class="sign-input">
                                    <input type="password" name="password" id="password" placeholder="Password" data-validation="required|match" data-match="repeat_password" data-error="<?php esc_attr_e( 'Passwords do not match', 'dealsoffer' ); ?>">
                                    <i class="fas fa-eye show-hide-pass"></i>
                                </div>
                            </div>
                            <div class="sign-single-input mb-15">
                                <label><?php echo esc_html__('Confirm Password', 'dealsoffer'); ?></label>
                                <div class="sign-input">
                                    <input type="password" name="repeat_password" id="repeat_password" placeholder="Confirm Password" data-validation="required|match" data-match="password" data-error="<?php esc_attr_e( 'Passwords do not match', 'dealsoffer' ); ?>">
                                    <i class="fas fa-eye show-hide-pass"></i>
                                </div>
                            </div>

                            <?php $register_terms = $dealsoffer_option['register_terms'];
                            if( !empty( $register_terms ) ):?>
                            <div class="input-group mb-15">
                                <label class="terms-label"><?php _e( 'Terms & Condition', 'dealsoffer' ); ?></label>
                                <div class="terms_conditions">
                                    <?php echo apply_filters( 'the_content', $register_terms ); ?>
                                </div>
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" name="terms" id="terms" data-validation="checked" data-error="<?php esc_attr_e( 'You must read and accept terms in order to be able to register on site', 'dealsoffer' ); ?>">
                                    <label for="terms"><?php _e( 'I have read and agreed with the terms and conditions.', 'dealsoffer' ); ?></label>
                                </div>
                            </div>
                            <?php endif; ?>

                            <!-- <input type="checkbox hidden" name="captcha" id="captcha"> -->
                            <input type="hidden" name="action" value="register">
                            <?php wp_nonce_field('register','register_field'); ?>

                            <div class="sign-buttons text-center mt-25">
                                
                                <button class="submit-form register-form def-btn"><?php _e( 'Register', 'dealsoffer' ); ?></button>

                                <?php if( pbs_is_demo() ) : ?>
                                <span class="demo-notice"><?php _e('Registering is not possible on demo, please login with predefined accounts.', 'dealsoffer' ); ?></span>
                                <?php endif; ?>
                                
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php endif; ?>

<?php get_footer(); ?>