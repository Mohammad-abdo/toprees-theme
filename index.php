<?php
/**
 * Main fallback template.
 *
 * @package Tek_Craft_Toppres
 */

get_header();
?>
<main id="primary" class="site-main">
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
</main>
<?php
get_footer();
