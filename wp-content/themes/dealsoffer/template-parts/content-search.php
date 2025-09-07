<?php global $dealsoffer_option; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>  
    <header class="entry-header">
        <?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
    </header>
    <!-- .entry-header -->
    
    <div class="entry-summary mb-0">
        <p><?php echo dealsoffer_custom_excerpt(30);?></p>   
        <?php 
        if(!empty($dealsoffer_option['blog_readmore'])):?>
        <div class="blog-button">
            <a href="<?php the_permalink();?>" class="tp-blog-btn">
                <span class="tp-blog-btn-text mr-5"><?php echo esc_html($dealsoffer_option['blog_readmore']); ?></span>
                <span class="tp-blog-btn-icon">
                    <i class="tp tp-arrow-right "></i>
                </span>
            </a>
        </div>
        <?php endif; ?>
    </div>
    <!-- .entry-summary -->

</article>
