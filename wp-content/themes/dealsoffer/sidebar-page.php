<?php

if ( !is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
if(is_home()){?>
    <aside id="secondary" class="widget-area sticky-sidebar">
      <div class="themephi-sideabr dynamic-sidebar">
        <?php		
             dynamic_sidebar('sidebar-1');
        ?>
      </div>
    </aside>
<?php }
else{ 

	$page_layout = get_post_meta( $post->ID, 'layout', true );
	$page_sidebar = get_post_meta( $post->ID, 'custom_sidebar', true );

	if(($page_layout=='2left' || $page_layout=='2right' ) && is_active_sidebar($page_sidebar)){	
	?>
		<div class="col-lg-4">
		  <aside id="secondary" class="widget-area sticky-sidebar">
		    <div class="themephi-sideabr dynamic-sidebar">
		      <?php
		        dynamic_sidebar($page_sidebar);
		      ?>
		    </div>
		  </aside>
		  <!-- #secondary --> 
		</div>
	<?php
	}
}
?>
