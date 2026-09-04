<?php
/**
 * Archives.
 *
 * @package Tek_Craft_Toppres
 */

get_header();
?>
<main id="primary" class="site-main">
	<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'archive' ) ) : ?>
		<header class="page-header container section--tight">
			<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
			<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
		</header>

		<div class="container section--tight tk-posts-grid">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content/content' );
				endwhile;
				tk_posts_navigation();
			else :
				get_template_part( 'template-parts/content/content', 'none' );
			endif;
			?>
		</div>
	<?php endif; ?>
</main>
<?php
get_footer();
