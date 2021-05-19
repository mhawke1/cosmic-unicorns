<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'kiddy' ); ?></span>
		<input type="text" class="search-field" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php esc_attr_e( 'Search for:', 'kiddy' ); ?>" />
	</label>
	<input type="submit" class="search-submit" value="<?php echo esc_attr__( 'Search', 'kiddy' ); ?>" />
</form>
