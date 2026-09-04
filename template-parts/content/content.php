<?php
/**
 * Default content template.
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'tk-card-post' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a class="tk-card-media" href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'tk-card' ); ?>
		</a>
	<?php endif; ?>

	<div class="tk-card-body">
		<header class="entry-header">
			<?php
			if ( is_singular() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
			?>
			<?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php tk_posted_on(); ?>
					<?php tk_posted_by(); ?>
				</div>
			<?php endif; ?>
		</header>

		<div class="entry-summary">
			<?php
			if ( is_singular() ) {
				the_content();
				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'الصفحات:', 'tek-craft-toppres' ),
						'after'  => '</div>',
					)
				);
			} else {
				the_excerpt();
				printf(
					'<a class="btn btn-outline btn-sm" href="%1$s">%2$s</a>',
					esc_url( get_permalink() ),
					esc_html__( 'اقرأ المزيد', 'tek-craft-toppres' )
				);
			}
			?>
		</div>
	</div>
</article>
