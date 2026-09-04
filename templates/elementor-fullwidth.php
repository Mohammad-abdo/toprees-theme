<?php
/**
 * Elementor Full Width — header/footer + full content width (no sidebar).
 *
 * Template Name: Elementor Full Width
 *
 * @package Tek_Craft_Toppres
 */

get_header();
?>
<main id="primary" class="site-main tk-elementor-fullwidth">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		</article>
		<?php
	endwhile;
	?>
</main>
<?php
get_footer();
