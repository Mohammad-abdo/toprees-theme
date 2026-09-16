<?php
/**
 * Search results.
 *
 * @package Toppers
 */

get_header();
?>
<main class="site-main">
	<?php get_template_part( 'template-parts/page-hero', null, array( 'title' => sprintf( __( 'نتائج البحث: %s', 'toppers' ), get_search_query() ) ) ); ?>
	<section class="section">
		<div class="container">
			<?php get_search_form(); ?>
			<?php if ( have_posts() ) : ?>
				<div class="grid grid-3" style="margin-top:40px">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/card-post' );
					endwhile;
					?>
				</div>
			<?php else : ?>
				<p style="margin-top:30px"><?php esc_html_e( 'لا توجد نتائج مطابقة.', 'toppers' ); ?></p>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php
get_footer();
