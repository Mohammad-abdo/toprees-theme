<?php
/**
 * 404.
 *
 * @package Toppers
 */

get_header();
?>
<main class="site-main">
	<?php get_template_part( 'template-parts/page-hero', null, array( 'title' => '404', 'lede' => __( 'الصفحة غير موجودة.', 'toppers' ) ) ); ?>
	<section class="section">
		<div class="container center">
			<a class="btn btn-gold" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'العودة للرئيسية', 'toppers' ); ?></a>
		</div>
	</section>
</main>
<?php
get_footer();
