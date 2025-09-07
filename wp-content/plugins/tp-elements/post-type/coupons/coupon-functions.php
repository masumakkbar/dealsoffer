<?php 

// Function to get saved coupons
function couponis_save_coupon_link($post_id) {
    if (get_option('users_can_register')) {
        if (!is_user_logged_in()) {
            $login_url = function_exists('couponis_get_permalink_by_tpl') 
                ? esc_url(couponis_get_permalink_by_tpl('page-tpl_login')) 
                : home_url();
            $link_part = 'href="'. $login_url .'" class="save-coupon"';
        } else {
            $user_id = get_current_user_id();
            $saved_coupons = get_user_meta($user_id, 'saved_coupons', true);
            $saved_coupons = !empty($saved_coupons) ? explode(',', $saved_coupons) : array();
            $link_part = 'href="javascript:;" class="save-coupon save-coupon-action '.(in_array($post_id, $saved_coupons) ? 'added' : '').'"';
        }
        return '<li><a '.$link_part.' data-post_id="'.esc_attr($post_id).'" title="'.esc_attr__('Save Coupon', 'tp-elements').'">
                    <span class="icon-star"></span>
                </a></li>';
    }
}

// Function to get page URL by template

function couponis_activate_account() {
    if (!empty($_GET['activation_hash']) && !empty($_GET['login'])) {
        $user = get_user_by('login', sanitize_text_field($_GET['login']));

        if ($user) {
            $activation_hash = get_user_meta($user->ID, 'activation_hash', true);

            if ($activation_hash && hash_equals($activation_hash, $_GET['activation_hash'])) {
                delete_user_meta($user->ID, 'activation_hash');
                update_user_meta($user->ID, 'user_active_status', 'active');

                echo '<div class="alert alert-success activation-alert">'
                    . esc_html__('Hello', 'tp-elements') . ' <strong>' . esc_html($user->user_login) . '</strong>. '
                    . esc_html__('Your account is activated now.', 'tp-elements') . '</div>';
            }
        }
    }
}


/* 
Delete account
*/
if( !function_exists( 'couponis_delete_account' ) ){
	function couponis_delete_account(){
		if( is_user_logged_in() ){
			require_once(ABSPATH.'wp-admin/includes/user.php' );
			$admins = get_super_admins();
			if( !empty( $admins[0] ) ){
				$the_admin = get_user_by('login', $admins[0]);
				$the_admin_id = $the_admin->ID;			
			}
			if( !empty( $the_admin_id ) ){
				wp_delete_user( get_current_user_id(), $the_admin_id );
				echo json_encode(
					array(
						'redirect' => home_url('/')
					)
				);
			}
			die();
		}
	}
	add_action( 'wp_ajax_couponis_delete_account', 'couponis_delete_account' );
}

/*common for gmap and for culture gallery*/
function couponxl_confirm_hash( $length = 100 ) {
	$characters    = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$random_string = '';
	for ( $i = 0; $i < $length; $i ++ ) {
		$random_string .= $characters[ rand( 0, strlen( $characters ) - 1 ) ];
	}

	return $random_string;
}

// Register 
function couponxl_register() {
	global $dealsoffer_option; 

	$first_name      = isset( $_POST['first_name'] ) ? esc_sql( $_POST['first_name'] ) : '';
	$last_name       = isset( $_POST['last_name'] ) ? esc_sql( $_POST['last_name'] ) : '';
	$email           = isset( $_POST['email'] ) ? esc_sql( $_POST['email'] ) : '';
	$username        = isset( $_POST['username'] ) ? esc_sql( $_POST['username'] ) : '';
	$password        = isset( $_POST['password'] ) ? esc_sql( $_POST['password'] ) : '';
	$repeat_password = isset( $_POST['repeat_password'] ) ? esc_sql( $_POST['repeat_password'] ) : '';
	$message         = '';

	if ( pbs_is_demo() ) {
		$message = '<div class="alert alert-danger">' . __( 'Registering is not possible on demo, please login with predefined accounts', 'tp-elements' ) . '</div>';
		echo json_encode( array(
			'message' => $message,
		) );
		exit;
	}

	if ( isset( $_POST['register_field'] ) ) {
		if ( wp_verify_nonce( $_POST['register_field'], 'register' ) ) {
			if ( ! isset( $_POST['captcha'] ) ) {
				if ( ! empty( $first_name ) && ! empty( $last_name ) && ! empty( $email ) && ! empty( $username ) && ! empty( $password ) && ! empty( $repeat_password ) ) {
					if ( filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
						if ( stristr( $username, " " ) === false && stristr( $username, "." ) === false ) {
							if ( $password == $repeat_password ) {
								if ( ! username_exists( $username ) ) {
									if ( ! email_exists( $email ) ) {
										$user_id = wp_insert_user( array(
											'user_login' => $username,
											'user_pass'  => $password,
											'user_email' => $email
										) );
										if ( ! is_wp_error( $user_id ) ) {
											wp_new_user_notification( $user_id, null, 'admin' );
											wp_update_user( array(
												'ID'   => $user_id,
												'role' => 'editor'
											) );
											$confirmation_hash = couponxl_confirm_hash();
											update_user_meta( $user_id, "first_name", $first_name );
											update_user_meta( $user_id, "last_name", $last_name );
											update_user_meta( $user_id, 'user_active_status', 'inactive' );
											update_user_meta( $user_id, 'confirmation_hash', $confirmation_hash );

											$confirmation_message = $dealsoffer_option['registration_message'];
											$confirmation_link    = couponis_get_permalink_by_tpl( 'page-tpl_register' );
											$confirmation_link    = couponxl_append_query_string( $confirmation_link, array(
												'username'          => $username,
												'confirmation_hash' => $confirmation_hash
											) );

											$confirmation_message = str_replace( '%LINK%', $confirmation_link, $confirmation_message );

											$registration_subject = $dealsoffer_option['registration_subject'];

											$email_sender = $dealsoffer_option['email_sender'];
											$name_sender  = $dealsoffer_option['name_sender'];
											$headers      = array();
											$headers[]    = "MIME-Version: 1.0";
											$headers[]    = "Content-Type: text/html; charset=UTF-8";
											$headers[]    = "From: " . $name_sender . " <" . $email_sender . ">";

											$info = wp_mail( $email, $registration_subject, $confirmation_message, $headers );

											if ( $info ) {
												$message = '<div class="alert alert-success">' . __( 'Thank you for registering, an email to confirm your email address is sent to your inbox.', 'tp-elements' ) . '</div>';
												$success = true;
											} else {
												$message = '<div class="alert alert-danger">' . __( 'You are registered but there was an error trying to send an email. Please contact site administrator about it.', 'tp-elements' ) . '</div>';
												$success = true;
											}
										} else {
											$message = '<div class="alert alert-danger">' . __( 'There was an error while trying to register you', 'tp-elements' ) . '</div>';
										}
									} else {
										$message = '<div class="alert alert-danger">' . __( 'Email is already registered', 'tp-elements' ) . '</div>';
									}
								} else {
									$message = '<div class="alert alert-danger">' . __( 'Username is already registered', 'tp-elements' ) . '</div>';
								}
							} else {
								$message = '<div class="alert alert-danger">' . __( 'Provided passwords do not match', 'tp-elements' ) . '</div>';
							}
						} else {
							$message = '<div class="alert alert-danger">' . __( 'Username can not hold empty spaces or dots', 'tp-elements' ) . '</div>';
						}
					} else {
						$message = '<div class="alert alert-danger">' . __( 'Email address is invalid', 'tp-elements' ) . '</div>';
					}
				} else {
					$message = '<div class="alert alert-danger">' . __( 'All fields are required', 'tp-elements' ) . '</div>';
				}
			} else {
				$message = '<div class="alert alert-danger">' . __( 'Captcha is wrong', 'tp-elements' ) . '</div>';
			}
		} else {
			$message = '<div class="alert alert-danger">' . __( 'You do not permission for your action', 'tp-elements' ) . '</div>';
		}
	}

	echo json_encode( array(
		'message' => $message,
	) );
	die();
}

add_action( 'wp_ajax_register', 'couponxl_register' );
add_action( 'wp_ajax_nopriv_register', 'couponxl_register' );


/*generate random password*/
function couponxl_random_string( $length = 10 ) {
	$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$random     = '';
	for ( $i = 0; $i < $length; $i ++ ) {
		$random .= $characters[ rand( 0, strlen( $characters ) - 1 ) ];
	}

	return $random;
}

if ( ! function_exists( 'couponxl_recover_password_email' ) ) {
    function couponxl_recover_password_email() {
        global $couponly_option;
        $message = '';

        // Ensure defaults exist
        $lost_password_message = isset($couponly_option['lost_password_message']) ? $couponly_option['lost_password_message'] : 'Your new password is: %PASSWORD%';
        $lost_password_subject = isset($couponly_option['lost_password_subject']) ? $couponly_option['lost_password_subject'] : 'Password Recovery';
        $email_sender          = isset($couponly_option['email_sender']) ? $couponly_option['email_sender'] : get_option('admin_email');
        $name_sender           = isset($couponly_option['name_sender']) ? $couponly_option['name_sender'] : get_bloginfo('name');

        if ( isset($_POST['recover_field']) && wp_verify_nonce($_POST['recover_field'], 'recover') ) {

            $username = isset($_POST['username']) ? sanitize_user($_POST['username']) : '';
            $email    = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';

            // Find user by email or username
            if ( !empty($email) ) {
                $user = get_user_by('email', $email);
            } elseif ( !empty($username) ) {
                $user = get_user_by('login', $username);
            } else {
                $user = false;
            }

            if ( $user ) {
                // Check if registered with Google (Nextend Social Login)
                $google_id = get_user_meta($user->ID, 'nextend_google_identifier', true);
                if ( !empty($google_id) ) {
                    return '<div class="alert alert-warning">' . 
                        __( 'This account was registered with Google. Please sign in using Google instead of resetting your password.', 'couponly' ) . 
                        '</div>';
                }

                // Generate new password
                $new_password = wp_generate_password( 10 );
                wp_set_password( $new_password, $user->ID );

                // Replace placeholders
                $body = str_replace( ["%USERNAME%", "%PASSWORD%"], [$user->user_login, $new_password], $lost_password_message );

                // Headers
                $headers   = [];
                $headers[] = "MIME-Version: 1.0";
                $headers[] = "Content-Type: text/html; charset=UTF-8";
                $headers[] = "From: $name_sender <$email_sender>";

                // Send mail
                if ( wp_mail( $user->user_email, $lost_password_subject, $body, $headers ) ) {
                    $message = '<div class="alert alert-success">' . __( 'Your new password has been emailed to you.', 'couponly' ) . '</div>';
                } else {
                    $message = '<div class="alert alert-danger">' . __( 'There was an error sending the email.', 'couponly' ) . '</div>';
                }
            } else {
                $message = '<div class="alert alert-danger">' . __( 'No user found with that username or email.', 'couponly' ) . '</div>';
            }
        }

        return $message;
    }
}

if (!class_exists('WP_Coupons_Query')) {
    class WP_Coupons_Query extends WP_Query {
        public $args;

        function __construct($args = array()) {
            $args = array_merge(array(
                'post_type'       => 'coupon',
                'order'           => 'DESC',
                'type'            => '',
                'exclusive'       => false,
                'expired'         => false,
                'saved_only'      => false, // Filter saved coupons if true
                'posts_per_page'  => get_option('posts_per_page')
            ), $args);

            $this->args = $args;

            // Filter by saved coupons if enabled
            if (!empty($args['saved_only']) && is_user_logged_in()) {
                $user_id = get_current_user_id();
                $saved_coupons = get_user_meta($user_id, 'saved_coupons', true);
                $saved_coupons = !empty($saved_coupons) ? explode(',', $saved_coupons) : array();

                if (!empty($saved_coupons)) {
                    $this->args['post__in'] = $saved_coupons;
                } else {
                    $this->args['post__in'] = array(0); // No saved coupons, return empty
                }
            }

            add_filter('posts_where', array($this, 'posts_where'));
            add_filter('posts_orderby', array($this, 'posts_orderby'));

            if (!empty($args['type'])) {
                $this->args['type'] = is_array($this->args['type']) ? $this->args['type'] : explode(',', $this->args['type']);
                add_filter('posts_where', array($this, 'filter_post_type'));
            }

            parent::__construct($this->args);

            remove_filter('posts_where', array($this, 'posts_where'));
            remove_filter('posts_orderby', array($this, 'posts_orderby'));

            if (!empty($args['type'])) {
                remove_filter('posts_where', array($this, 'filter_post_type'));
            }
        }

        // Modify WHERE clause to filter expired and exclusive coupons
        function posts_where($where) {
            if (!$this->args['expired']) {
                $where .= " AND post_status = 'publish'";
            }
            if ($this->args['exclusive'] === true) {
                $where .= " AND EXISTS (SELECT 1 FROM wp_postmeta WHERE wp_postmeta.post_id = ID AND wp_postmeta.meta_key = 'exclusive' AND wp_postmeta.meta_value = '1')";
            }
            return $where;
        }

        // Filter by coupon category
        function filter_post_type($where) {
            $where .= " AND EXISTS (
                SELECT 1 FROM wp_term_relationships AS tr
                INNER JOIN wp_term_taxonomy AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
                WHERE tr.object_id = ID
                AND tt.taxonomy = 'coupon-category'
            )";
            return $where;
        }
    }
}
