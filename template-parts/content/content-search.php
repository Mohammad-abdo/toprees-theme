<?php
/**
 * Search result item.
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'tk-search-item' ); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<div class="entry-meta">
			<span class="post-type"><?php echo esc_html( get_post_type_object( get_post_type() )->labels->singular_name ); ?></span>
		</div>
	</header>
	<div class="entry-summary"><?php the_excerpt(); ?></div>
</article>
