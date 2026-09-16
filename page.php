<?php
/**
 * Default page.
 *
 * @package Toppers
 */

get_header();

if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'single' ) ) {
	get_footer();
	return;
}
?>
<main class="site-main">
	<?php
	while ( have_posts() ) :
		the_post();
		if ( toppers_is_elementor_page() ) {
			the_content();
		} else {
			get_template_part( 'template-parts/page-hero', null, array( 'title' => get_the_title(), 'lede' => has_excerpt() ? get_the_excerpt() : '' ) );
			?>
			<section class="section page-default-content">
				<div class="container">
					<?php the_content(); ?>
				</div>
			</section>
			<?php
		}
	endwhile;
	?>
</main>
<?php
get_footer();
