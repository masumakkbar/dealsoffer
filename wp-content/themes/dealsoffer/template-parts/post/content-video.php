<?php
/**
 * @author  themephi-theme
 * @since   1.0
 * @version 1.0 
 */
?>
<?php if ( '' !== get_the_post_thumbnail() && ! is_single() && empty( $video ) ) : ?>
		<div class="bs-img">
		  <?php the_post_thumbnail()?>
          
        </div>
    <?php endif; ?>    
<div class="single-content-full">
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