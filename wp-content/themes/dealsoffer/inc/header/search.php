<div class="sticky_form tps-search-popup">
	<div class="sticky_form_full">
	<form class="bs-search search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="search-wrap">
    	<label class="screen-reader-text">
    		<?php echo esc_html__( 'Search for:', 'dealsoffer' ); ?>
    	</label>
        <input type="search" placeholder="<?php esc_attr_e( 'Searching...', 'dealsoffer' ); ?>" name="s" class="search-input" value="<?php echo esc_attr( get_search_query() ); ?>" />
        <button type="submit"  value="Search"><i class="tp-search"></i></button>
    </div>
</form>
	</div><i class="tp-xmark close-search sticky_search sticky_form_search"></i>
</div>
