<?php
/**
 * Search form.
 *
 * @package Toppers
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="toppers-search"><?php esc_html_e( 'بحث', 'toppers' ); ?></label>
	<input id="toppers-search" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'ابحث...', 'toppers' ); ?>">
	<button type="submit" class="btn btn-gold btn-sm"><?php esc_html_e( 'بحث', 'toppers' ); ?></button>
</form>
