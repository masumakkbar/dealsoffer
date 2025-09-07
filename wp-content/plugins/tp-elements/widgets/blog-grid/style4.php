<div class="grid-item col-xxl-<?php echo esc_attr($col_xxl); ?> col-xl-<?php echo esc_attr($col_xl); ?> col-lg-<?php echo esc_attr($col_lg); ?> col-md-<?php echo esc_attr($col_md); ?> col-sm-<?php echo esc_attr($col_sm); ?> col-<?php echo esc_attr($col_xs); ?> <?php echo esc_attr($termsString);?>">
    <div class="align-items-center g-0 blog-item d-flex themephi-blog-grid1 h-100 <?php if ( has_post_thumbnail() ) : ?> row <?php else : ?> <?php endif; ?>">
        <?php if($settings['blog_image'] == 'yes') :?>
        <?php if ( has_post_thumbnail() ) { ?>
        <div class="col-md-5 top-image-cat h-100">
            <div class="image-part h-100">
                <a href="<?php the_permalink();?>">
                    <?php the_post_thumbnail($settings['thumbnail_size']); ?>
                </a>
            </div>
        </div>
        <?php } ?>
        <?php endif; ?>
        <div class="content--column <?php if ( has_post_thumbnail() ) : ?> col-md-7 <?php else : ?> w-100 <?php endif; ?>">
            <div class="blog-content">        
                <?php if(($settings['blog_meta_show_hide'] == 'yes') ){ ?>
                <ul class="blog-meta">
                    <?php if(($settings['blog_cat_show_hide'] == 'yes') && !empty($category ) ){ ?>
                        <li><span class="meta_category"><i class="tp tp-tags"></i> <?php echo esc_html($category[0]->cat_name);?></span></li>
                    <?php } ?>
                    <?php if(($settings['blog_date_show_hide'] == 'yes') ){ ?>						
                        <li><span class="meta_date"><i class="tp tp-calendar-days"></i> <?php echo esc_html( $full_date ); ?></span></li>						
                    <?php } ?>
                    <?php if(($settings['blog_comments_show_hide'] == 'yes') && !empty($comment_ccount ) ){ ?>
                        <li><span class="meta_comments"><i class="tp tp-message"></i> <?php echo esc_html( $comment_ccount )  . esc_html__( ' Comments', 'tp-elements' );?></span></li>
                    <?php } ?>
                </ul>
                <?php } ?>

                <h3 class="title dd"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                <?php if(($settings['blog_content_show_hide'] == 'yes') ){ ?>
                    <p class="txt"><?php echo wp_trim_words( get_the_content(), $limit, '...' ); ?></p>
                <?php } ?>
                <div class="blog_footer d-flex flex-wrap justify-content-between">
                <?php if(($settings['blog_avatar_show_hide'] == 'yes') && !empty($post_admin) ){ ?>
                    <span class="meta_author <?php echo esc_attr( $settings['author_image_layout'] ); ?>">
                        <?php if( $settings['author_image_layout'] == 'yes' ) : ?>
                            <span class="tp-author-img"><?php echo get_avatar( get_the_author_meta( get_the_ID() ), 48 ); ?></span>
                            <span class="tp-author-text"><strong><?php echo esc_html($post_admin);?></strong> <br /> <?php echo esc_html( $full_date ); ?></span>
                        <?php else : ?>
                            <?php echo esc_html__( '- By', 'tp-elements' ); ?>
                            <?php echo esc_html($post_admin);?></span> 
                        <?php endif; ?>
                    </span>
                <?php } ?>
                <?php if($settings['blog_readmore_show_hide'] == 'yes') { ?>
                    <div class="btn-part">
                        <a class="readon-arrow" href="<?php the_permalink(); ?>">
                            <?php echo esc_html($settings['blog_btn_text']);?> 
                        </a>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>