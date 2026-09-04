<?php
/**
 * 404 template.
 *
 * @package Tek_Craft_Toppres
 */

get_header();
?>
<main id="primary" class="site-main">
	<section class="error-404 not-found container section">
		<header class="page-header">
			<h1 class="page-title"><?php esc_html_e( 'الصفحة غير موجودة', 'tek-craft-toppres' ); ?></h1>
		</header>
		<div class="page-content">
			<p><?php esc_html_e( 'عذراً، لم نتمكن من العثور على الصفحة المطلوبة.', 'tek-craft-toppres' ); ?></p>
			<p>
				<a class="btn btn-gold" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php esc_html_e( 'العودة للرئيسية', 'tek-craft-toppres' ); ?>
				</a>
			</p>
			<?php get_search_form(); ?>
		</div>
	</section>
</main>
<?php
get_footer();
