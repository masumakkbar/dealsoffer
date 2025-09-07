<?php 
// Register and load the widget
function tptheme_coupon_info_widget() {
    register_widget( 'coupon_info_widget' );
}
add_action( 'widgets_init', 'tptheme_coupon_info_widget' );

//Coupon info Widget 
class coupon_info_widget extends WP_Widget {
 
   /** constructor */
   function __construct() {
    parent::__construct(
      'coupon_info_widget', 
      __('TP Coupon Info', 'tp-framework'),
      array( 'description' => __( 'Display your coupon info!', 'tp-framework' ), )
    );
  }
 
    /** @see WP_Widget::widget */
    function widget($args, $instance) { 
        extract( $args );
        $image_src = '';
        $title    = apply_filters('widget_title', $instance['title']);  

        echo wp_kses_post($before_widget); 
        if ( $title )
        echo wp_kses_post($before_title . $title . $after_title); 


  $coupon_id = get_the_ID();
  $positive_feedback = get_post_meta( $coupon_id, 'positive', true );
  $negative_feedback = get_post_meta( $coupon_id, 'negative', true );
  $expire = get_post_meta( $coupon_id, 'expire', true );
  ?>
  <ul class="coupon-info-ul">
    <?php 
    if( $positive_feedback > 0 || $negative_feedback > 0 ): 
    
      if( $positive_feedback > 0 || $negative_feedback > 0 ){
          $success = round( ( $positive_feedback / ( $positive_feedback + $negative_feedback ) ) * 100 );
      }
      else{
          $success = 0;
      }

      $color = '#D91E18';
      if( $success > 66 ){
        $color = '#26A65B';
      }
      else if( $success > 34 ){
        $color = '#FF943D';
      }
      
    ?>
    <li class="success-rate text-center flex-wrap flex-always">
      <div class="center-rate">
        <canvas id="progress" width="220" height="220" data-value="<?php echo esc_attr( $success ) ?>" data-color="<?php echo esc_attr( $color ) ?>"></canvas>
        <div class="back-grey"></div>
        <div class="header-alike"><?php echo  $success ?>%<p><?php esc_html_e( 'SUCCESS', 'dealsoffer' ) ?></p></div>
      </div>
      <div class="left-rate">
        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
        <div class="small-action"><?php echo  $positive_feedback.' '.( $positive_feedback == 1 ? esc_html__( 'VOTE', 'dealsoffer' ) : esc_html__( 'VOTES', 'dealsoffer' ) ) ?> </div>
      </div>
      <div class="right-rate">
        <i class="fa fa-thumbs-down" aria-hidden="true"></i>
        <div class="small-action"><?php echo  $negative_feedback.' '.( $negative_feedback == 1 ? esc_html__( 'VOTE', 'dealsoffer' ) : esc_html__( 'VOTES', 'dealsoffer' ) ) ?> </div>
      </div>
    </li>
    <?php endif; ?>

    <?php
    if( !empty( $expire ) && $expire !== '99999999999' && !couponis_is_expired( $expire ) ): ?>
    <li class="single-expire flex-wrap flex-always">
      <div class="leading-icon">
        <i class="tp tp-clock-regular"></i>
      </div>
      <div class="flex-right">
        <p class="small-action"><?php esc_html_e( 'Expires in', 'dealsoffer' ) ?></p>
                    <span class="countdown header-alike" data-single="<?php esc_attr_e( 'Day', 'dealsoffer' ) ?>" data-multiple="<?php esc_attr_e( 'Days', 'dealsoffer' ) ?>" data-expire="<?php echo esc_attr( $expire ) ?>" data-current-time="<?php echo esc_attr( current_time( 'timestamp' ) ); ?>"></span>
                </div>
    </li>
    <?php endif; ?>

    <li class="flex-wrap flex-always">
      
      <div class="tp-coupon-button-wrapp ">
        <div class="tp-coupon-button">
        <?php 
        $href = '#o-' . get_the_ID();
        $data_href = '';
        $coupon_affiliate = get_post_meta(get_the_ID(), 'coupon_affiliate', true);

        if (!empty($coupon_affiliate)) {
            $href = add_query_arg(array()) . $href;
            $data_href = add_query_arg(array('cout' => get_the_ID()), home_url('/'));
        }

        $current_coupon_type = get_post_meta(get_the_ID(), 'ctype', true);

        $effective_coupon_type = !empty($coupon_type) ? $coupon_type : $current_coupon_type;

        if ($effective_coupon_type == 1) {
            $coupon_code = get_post_meta(get_the_ID(), 'coupon_code_change', true);
            ?>
            <a class="coupon-action-button header-alike icon-after" href="<?php echo esc_attr($href); ?>" 
            <?php if (!empty($data_href)) : ?> data-affiliate="<?php echo esc_url($data_href); ?>" target="_blank" <?php endif; ?> rel="nofollow" >
                <span class="code-text"><?php echo esc_html__('GET CODE', 'tp-elements'); ?></span>
                <span class="partial-code">&nbsp;<?php echo substr($coupon_code, -4, 4); ?></span>
            </a>
        <?php
        } elseif ($effective_coupon_type == 2) {
            ?>
            <a class="coupon-action-button header-alike icon-after" href="<?php echo esc_attr($href); ?>" 
            <?php if (!empty($data_href)) : ?> data-affiliate="<?php echo esc_url($data_href); ?>" target="_blank" <?php endif; ?> rel="nofollow"  >
                <span class="code-text-full"><?php echo esc_html( 'Print Code', 'tp-elements' ); ?></span>
                <i class="tp tp-arrow-right-regular"></i>
            </a>
        <?php
        } elseif ($effective_coupon_type == 3) {
            ?>
            <a class="coupon-action-button header-alike icon-after" href="<?php echo esc_attr($href); ?>" 
            <?php if (!empty($data_href)) : ?> data-affiliate="<?php echo esc_url($data_href); ?>" target="_blank" <?php endif; ?> rel="nofollow"  >
                <span class="code-text-full"><?php echo esc_html( 'Get Deal', 'tp-elements' ); ?></span>
                <i class="tp tp-arrow-right-regular"></i>
            </a>
        <?php
        }
        ?>

        </div>
      </div>

    </li>

  </ul>

    <?php echo wp_kses_post($after_widget); ?>
     <?php
    }
 
  /** @see WP_Widget::update  */
  function update($new_instance, $old_instance) {   
      $instance            = $old_instance;
      $instance['title']   = strip_tags($new_instance['title']);     
      return $instance;
    }
 
    /** @see WP_Widget::form */
    function form($instance) {  

       $title   = (isset($instance['title']))? $instance['title'] : '';          

     ?>      
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'tp-framework'); ?></label> 
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_js( $title); ?>" />
        </p> 
        
        <?php 
    }
} // end class
