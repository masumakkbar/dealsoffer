<?php
global $dealsoffer_option;
?>
<div class="single-content-full">
    
    <?php if(!empty($dealsoffer_option['blog-author-meta']) && $dealsoffer_option['blog-author-meta'] == 'show') : ?>
        <div class="user-info">
            <!-- single info -->
            <div class="single-info">
                <i class="tp tp-user-2"></i>
                <span><?php echo esc_html__('by', 'dealsoffer');?>  <?php if(!empty($dealsoffer_option['blog-author-post'])){
                    if ($dealsoffer_option['blog-author-post'] == 'show'): ?>                                                                                         
                        
                        
                        <?php
                        
                        if( !empty($first_name) && !empty($last_name)){
                        echo esc_html($first_name).' '. esc_html($last_name);
                        }else{
                        echo get_the_author();
                    }  ?>                                      
                    
                    <?php endif; }
                    else{ ?>                                        
                    
                    
                    <?php 
                    
                    if( !empty($first_name) && !empty($last_name)){
                        echo esc_html($first_name).' '. esc_html($last_name);
                    }else{
                        echo get_the_author();
                    } ?>
                
                    <?php }; ?></span>
            </div>
            <!-- single infoe end -->
            <!-- single info -->
            <div class="single-info">
                <i class="tp tp-clock-regular"></i>
                <span><?php echo get_the_date();?></span>
            </div>
            <!-- single infoe end -->
            <!-- single info -->
            <div class="single-info cat">
                <i class="tp tp-tags"></i>
                <span> <?php if(!empty($dealsoffer_option['blog-category'])){
                    if($dealsoffer_option['blog-category'] == 'show'){
                        if(get_the_category()):
                            the_category(', ');                                                 
                    endif;
                        }
                    }else{
                        if(get_the_category()): ?>
                                                                    
                        <?php
                            //tag add
                            $seperator = ', '; // blank instead of comma
                            $after = '';
                            $before = '';                    
                            ?>
                            
                            <?php
                            the_category(', '); 
                            
                            ?> 
                        
                    <?php
                endif;
                    } ?>
                </span>
            </div>
            <!-- single info end -->
        </div>
    <?php endif; ?>
    <h2 class="single-content-title"><?php the_title(); ?></h2>
    <div class="bs-desc">
        <?php
            the_content();

            wp_link_pages( array(
              'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'dealsoffer' ),
              'after'       => '</div>',
              'link_before' => '<span class="page-number">',
              'link_after'  => '</span>',
            ) );
        ?>
    </div>
     <?php 
        if(has_tag()){ ?>
            <div class="bs-info single-page-info tags">
                <?php
                    //tag add
                    $seperator = ''; // blank instead of comma
                    $after = '';
                    echo esc_html__( 'Tags: ', 'dealsoffer' );
                    the_tags( '', $seperator, $after );
                ?>             
            </div> 
       <?php } ?> 
</div>
