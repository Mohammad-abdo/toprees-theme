<?php
/**
 * No results template.
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'لا يوجد محتوى', 'tek-craft-toppres' ); ?></h1>
	</header>
	<div class="page-content">
		<?php if ( is_search() ) : ?>
			<p><?php esc_html_e( 'لم يتم العثور على نتائج مطابقة. جرّب كلمات أخرى.', 'tek-craft-toppres' ); ?></p>
			<?php get_search_form(); ?>
		<?php else : ?>
			<p><?php esc_html_e( 'يبدو أنه لا يوجد شيء هنا بعد.', 'tek-craft-toppres' ); ?></p>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div>
</section>
