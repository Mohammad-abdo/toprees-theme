<?php
/**
 * Fallback index.
 *
 * @package Toppers
 */

get_header();

if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'archive' ) ) {
	get_footer();
	return;
}
?>
<main class="site-main">
	<?php get_template_part( 'template-parts/page-hero', null, array( 'title' => get_the_archive_title(), 'lede' => get_the_archive_description() ) ); ?>
	<section class="section">
		<div class="container">
			<?php if ( have_posts() ) : ?>
				<div class="grid grid-3">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/card-post' );
					endwhile;
					?>
				</div>
				<div class="center" style="margin-top:40px"><?php the_posts_pagination(); ?></div>
			<?php else : ?>
				<p><?php esc_html_e( 'لا توجد نتائج.', 'toppers' ); ?></p>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php
get_footer();
