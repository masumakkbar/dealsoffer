<?php
/*
    Template Name: Login
*/
if( is_user_logged_in() ){
    wp_redirect( home_url() );
}

the_post();
$message = '';

if( isset( $_POST['login_field'] ) ){
    if( wp_verify_nonce($_POST['login_field'], 'login') ){
        $username = isset( $_POST['username'] ) ? esc_sql( $_POST['username'] ) : '';
        $password = isset( $_POST['password'] ) ? esc_sql( $_POST['password'] ) : '';

        $user = get_user_by( 'login', $username );
        if( $user ){
            $is_active = get_user_meta( $user->ID, 'user_active_status', true );
            if( empty( $is_active ) || $is_active == 'active' ){
                $user = wp_signon( array(
                    'user_login' => $username,
                    'user_password' => $password,
                    'remember' => isset( $_POST['remember_me'] ) ? true : false
                ), is_ssl() );
                if ( is_wp_error($user) ){
                    switch( $user->get_error_code() ){
                        case 'invalid_username': 
                            $message = __( 'Invalid username', 'dealsoffer' ); 
                            break;
                        case 'incorrect_password':
                            $message = __( 'Invalid password', 'dealsoffer' ); 
                            break;                    
                    }
                    $message = '<div class="alert alert-danger">'.$message.'</div>';
                }
                else{
                	if( !empty( $_POST['redirect'] ) ){
                		wp_redirect( $_POST['redirect'] );
                	}
                	else{
                		wp_redirect( home_url() );
                	}
                }
            }
            else{
                $message = '<div class="alert alert-danger">'.__( 'Your account is not activated. Check you mail for the activation link.', 'dealsoffer' ).'</div>';
            }
        }
        else{
            $message = '<div class="alert alert-danger">'.__( 'Invalid username', 'dealsoffer' ).'</div>';
        }
    }
    else{
        $message = '<div class="alert alert-danger">'.__( 'You do not permission for your action', 'dealsoffer' ).'</div>';
    }
}

get_header();

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

?>

<div class="signup-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-11 col-md-10 col-lg-8 col-xl-7 col-xxl-6">
                <div class="signup-wrapper">
                    <div class="signup-wrapper-header text-center">
                        <h2 class="signup-title"><?php echo esc_html__('Sign In', 'dealsoffer'); ?></h2>
                    </div>
                    <div class="signup-wrapper-body">
                        <div class="signup-body-header text-center mb-45">

                            <?php if( !empty( $message ) ): ?>
                            <div class="white-block-content">
                                <?php echo wp_kses_post( $message ); ?>
                            </div>
                            <?php endif; ?>

                            <h4 class="signup-body-title mb-25"><?php echo esc_html__('Sign In to You', 'dealsoffer'); ?></h4>

                            <?php if ( shortcode_exists( 'nextend_social_login' ) ) : ?>
                                <?php echo do_shortcode('[nextend_social_login]'); ?>
                            <?php endif; ?>

                        </div>
                        <form method="post" action="<?php echo esc_url( $login_url ); ?>" class="signup-body-content">
                            <div class="sign-single-input mb-25">
                                <label><?php echo esc_html__('Username', 'dealsoffer'); ?></label>
                                <div class="sign-input">
                                    <input type="text" name="username" placeholder="<?php esc_attr_e( 'Your Username', 'dealsoffer' ); ?>" data-validation="required" data-error="<?php esc_attr_e( 'Please input your username', 'dealsoffer' ); ?>">
                                    <i class="far fa-user"></i>
                                </div>
                            </div>
                            <div class="sign-single-input mb-25">
                                <label><?php echo esc_html__('Password', 'dealsoffer'); ?></label>
                                <div class="sign-input">
                                    <input type="password" name="password" placeholder="<?php esc_attr_e( 'Enter Password', 'dealsoffer' ); ?>"  data-validation="required"  data-error="<?php esc_attr_e( 'Please input your password', 'dealsoffer' ); ?>">
                                    <i class="fas fa-eye show-hide-pass"></i>
                                </div>
                            </div>

                            <div class="checkbox checkbox-inline d-flex justify-content-start mb-15">
                                <input type="checkbox" id="remember_me" name="remember_me">
                                <label for="remember_me"><?php _e( 'Remember me', 'dealsoffer' ); ?></label>
                            </div>

                            <div class="sign-buttons text-center mt-45">
                                <?php wp_nonce_field('login','login_field'); ?>

                                <input type="hidden" name="redirect" value="<?php echo !empty( $_GET['redirect'] ) ? esc_url( urldecode( $_GET['redirect']) ) : '' ?>">
                                <button type="submit" class="submit-form def-btn mb-30"><?php _e( 'Login', 'dealsoffer' ); ?></button>

                            </div>
                            <span class="signtext d-block mb-15"><a href="<?php echo esc_url( $recover_password_url ); ?>"><?php _e( 'Forgot Password?', 'dealsoffer' ) ?></a></span>
                             <span class="signtext d-block"><?php _e( 'Don’t have an account?', 'dealsoffer' ); ?>
                                <a href="<?php echo esc_url( $register_url ); ?>"><?php _e( 'Sign Up', 'dealsoffer' ); ?></a>
                            </span>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>