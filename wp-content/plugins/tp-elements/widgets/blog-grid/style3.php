<div class="grid-item col-xxl-<?php echo esc_attr($col_xxl); ?> col-xl-<?php echo esc_attr($col_xl); ?> col-lg-<?php echo esc_attr($col_lg); ?> col-md-<?php echo esc_attr($col_md); ?> col-sm-<?php echo esc_attr($col_sm); ?> col-<?php echo esc_attr($col_xs); ?> <?php echo esc_attr($termsString);?>">
   <div class="align-items-center no-gutter blog-item themephi-blog-grid1">     
         <div class="blog-inner"> 
                <?php if($settings['blog_image'] == 'yes') :?>                             
                <div class="image-part <?php echo $settings['image_gray'];?>">
                    <a href="<?php the_permalink();?>">
                        <?php the_post_thumbnail($settings['thumbnail_size']); ?>
                    </a> 
                    <?php if(($settings['blog_cat_show_hide'] == 'yes') && !empty($category ) ){ ?>
                        <div class="cat_list"><i class="tp tp-tags"></i> <?php echo esc_html($category[0]->cat_name);?></div>
                    <?php } ?>
                </div>    
                <?php endif; ?>          
            
                <div class="blog-content-wrapper">
                    <div class="blog-content">                                    
                        <?php if(($settings['blog_meta_show_hide'] == 'yes') ){ ?>
                        <ul class="blog-meta">
                            <?php if(($settings['blog_avatar_show_hide'] == 'yes') && !empty($post_admin) ){ ?>
                                <li><span class="meta_author"><i class="tp tp-user"></i> <?php echo esc_html($post_admin);?></span></li>
                            <?php } ?>
                            <?php if(($settings['blog_date_show_hide'] == 'yes') ){ ?>						
                                <li><span class="meta_date"><i class="tp tp-calendar-days"></i> <?php echo esc_html( $full_date ); ?></span></li>						
                            <?php } ?>
                            <?php if(($settings['blog_comments_show_hide'] == 'yes') && !empty($comment_ccount ) ){ ?>
                                <li><span class="meta_comments"><i class="tp tp-message"></i> <?php echo esc_html( $comment_ccount )  . esc_html__( ' Comments', 'tp-elements' );?></span></li>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                        <div class="bottom-part">
                            <div class="title dd"><a href="<?php the_permalink();?>"><?php the_title();?></a></div>
                            <?php if(($settings['blog_content_show_hide'] == 'yes') ){ ?>
                                <p class="txt"><?php echo wp_trim_words( get_the_content(), $limit, '...' ); ?></p>
                            <?php } ?>
                            <?php if($settings['blog_readmore_show_hide'] == 'yes') { ?>
                            <div class="btn-part">
                                <a class="readon-arrow" href="<?php the_permalink(); ?>">
                                    <?php echo esc_html($settings['blog_btn_text']);?> <i class="fa <?php echo esc_html( $settings['blog_btn_icon'] );?>"></i>
                                </a>
                            </div>
                            <?php } ?>
                        </div>
                    </div> 
                </div>
            </div>                      
                                                                
    </div>
</div>