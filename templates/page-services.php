<?php
/**
 * Template Name: الخدمات
 *
 * @package Toppers
 */

get_header();
?>
<main class="site-main">
	<?php
	if ( toppers_is_elementor_page() ) {
		while ( have_posts() ) {
			the_post();
			the_content();
		}
	} else {
		get_template_part( 'template-parts/services-list' );
	}
	?>
</main>
<?php
get_footer();
