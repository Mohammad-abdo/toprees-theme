<?php
/**
 * Search results.
 *
 * @package Tek_Craft_Toppres
 */

get_header();
?>
<main id="primary" class="site-main">
	<header class="page-header container section--tight">
		<h1 class="page-title">
			<?php
			printf(
				/* translators: %s: search query */
				esc_html__( 'نتائج البحث عن: %s', 'tek-craft-toppres' ),
				'<span>' . esc_html( get_search_query() ) . '</span>'
			);
			?>
		</h1>
	</header>

	<div class="container section--tight">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content/content', 'search' );
			endwhile;
			tk_posts_navigation();
		else :
			get_template_part( 'template-parts/content/content', 'none' );
		endif;
		?>
	</div>
</main>
<?php
get_footer();
