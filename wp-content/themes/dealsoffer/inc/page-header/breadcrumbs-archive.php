<?php
  global $dealsoffer_option;
  $header_trans = '';
    if(!empty($dealsoffer_option['header_layout'])){               
        $header_style = $dealsoffer_option['header_layout'];               
        if($header_style == 'style2'){       
            $header_trans = 'heads_trans';    
        }
    }
?>
<?php 
 $enable_breadcrumb_title = $dealsoffer_option['enable_breadcrumb_title'] ?? '';
  $post_meta_data = get_post_meta(get_the_ID(), 'banner_image', true);
  $post_meta_data2 = '';
    //theme option chekcing
  if($post_meta_data == ''){
    if(!empty($dealsoffer_option['page_banner_main']['url'])):
      $post_meta_data = $dealsoffer_option['page_banner_main']['url'];
    
    else: {
      $post_meta_data2 = !empty($dealsoffer_option['breadcrumb_bg_color'])? $dealsoffer_option['breadcrumb_bg_color'] : '';
    }
    endif;
  }  

  $banner_hide = get_post_meta(get_the_ID(), 'banner_hide', true);
  if( 'show' == $banner_hide ||  $banner_hide == '' ){  
    $post_meta_data = $post_meta_data;
    $post_meta_data2 = $post_meta_data2;
  }else{
    $post_meta_data = '';
    $post_meta_data2 = '';
  }
  $post_menu_type = get_post_meta(get_the_ID(), 'menu-type', true);
  $content_banner = get_post_meta(get_the_ID(), 'content_banner', true); 
  $intro_content_banner = get_post_meta(get_the_ID(), 'intro_content_banner', true); 
?>

<div class="themephi-breadcrumbs porfolio-details <?php echo esc_attr($header_trans);?>">
    <?php  if(is_post_type_archive('events')){
        $archive_banner = !empty($dealsoffer_option['event_banner_main']['url']) ? $dealsoffer_option['event_banner_main']['url'] : '';
    }
    
    else{
        $archive_banner = !empty($dealsoffer_option['blog_banner_main']['url']) ? $dealsoffer_option['blog_banner_main']['url'] : '';
    }

    if(!empty($dealsoffer_option['show_banner__course'])):
      $archive_banner = $dealsoffer_option['show_banner__course'];
    endif;

   if(!empty($archive_banner)) { ?>
    <div class="breadcrumbs-single" style="background:<?php echo esc_attr($dealsoffer_option['breadcrumb_bg_color']);?>">
      <img src="<?php echo esc_url($post_meta_data); ?>" alt="<?php echo esc_attr__('breadcrumb image', 'dealsoffer'); ?>">
      <div class="container">
        <div class="breadcrumbs-inner">
            <div class="row">
              <div class="col-lg-12">             

                <?php if (empty($dealsoffer_option['show_banner__course'])) {
                    if(!empty($dealsoffer_option['event_info']) && is_post_type_archive('events')){
                        echo '<h1 class="page-title a">'.esc_html($dealsoffer_option['event_info']).'</h1>';
                            if( !empty($dealsoffer_option['off_breadcrumb_event'])){
                                if(function_exists('bcn_display')){?>
                                    <div class="breadcrumbs-title"> <?php  bcn_display();?></div>
                                <?php } 
                            }                 
                        }
                        elseif(!empty($dealsoffer_option['notice_info']) && is_post_type_archive('notices')){
                        echo '<h1 class="page-title b">'.esc_html($dealsoffer_option['notice_info']).'</h1>';  
                        if(!empty($dealsoffer_option['off_breadcrumb_notice'])){
                            if(function_exists('bcn_display')){?>
                                <div class="breadcrumbs-title"> <?php  bcn_display();?></div>
                            <?php } 
                        }                 
                        } else {
                        if( $enable_breadcrumb_title == true ) {
                           the_archive_title( '<h1 class="page-title c">', '</h1>' );
                        }
                    } 
                }          
                ?>   
                </div>
                <div class="col-lg-12">
                        <?php if(!empty($dealsoffer_option['off_breadcrumb'])){
                            if(function_exists('bcn_display')){?>
                                <div class="breadcrumbs-title"> <?php  bcn_display();?></div>
                            <?php } 
                        }   ?>
                    </div>
              </div>
            </div>
      </div>
    </div>
  <?php }
  else{   
  ?>
  <div class="breadcrumbs-single" style="background:<?php echo esc_attr($dealsoffer_option['breadcrumb_bg_color']);?>">  
    <div class="themephi-breadcrumbs-inner">
    <div class="container">
        <div class="breadcrumbs-inner">
            <div class="row">
              <div class="col-lg-12">              

                <?php if (empty($dealsoffer_option['show_banner__course'])) {
                    if(!empty($dealsoffer_option['event_info']) && is_post_type_archive('events')){
                        echo '<h1 class="page-title a">'.esc_html($dealsoffer_option['event_info']).'</h1>';
                            if( !empty($dealsoffer_option['off_breadcrumb_event'])){
                                if(function_exists('bcn_display')){?>
                                    <div class="breadcrumbs-title"> <?php  bcn_display();?></div>
                                <?php } 
                            }                 
                        }
                        elseif(!empty($dealsoffer_option['notice_info']) && is_post_type_archive('notices')){
                        echo '<h1 class="page-title b">'.esc_html($dealsoffer_option['notice_info']).'</h1>';  
                        if(!empty($dealsoffer_option['off_breadcrumb_notice'])){
                            if(function_exists('bcn_display')){?>
                                <div class="breadcrumbs-title"> <?php  bcn_display();?></div>
                            <?php } 
                        }                 
                        } else { 
                        if( $enable_breadcrumb_title == true ) {
                           the_archive_title( '<h1 class="page-title c">', '</h1>' );
                        }
                    } 
                }          
                ?>   
                </div>
                    <div class="col-lg-12">
                        <?php if(!empty($dealsoffer_option['off_breadcrumb'])){
                            if(function_exists('bcn_display')){?>
                                <div class="breadcrumbs-title"> <?php  bcn_display();?></div>
                            <?php } 
                        }   ?>
                    </div>
              </div>
            </div>
      </div>
    </div>
    </div>
  </div>
  <?php
  }
?>  
</div>