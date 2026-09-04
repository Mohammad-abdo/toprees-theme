<?php
/**
 * Default site header — markup aligned with original HTML design.
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cta_label = tk_get_translated_mod( 'tk_header_cta_label', __( 'اطلب خدمتك', 'tek-craft-toppres' ) );
$cta_url   = tk_header_cta_url();
// Solid header on all pages except the marketing front page (hero).
$header_class = 'site-header';
if ( ! is_front_page() ) {
	$header_class .= ' tk-solid is-scrolled';
}
?>
<header class="<?php echo esc_attr( $header_class ); ?>" role="banner">
	<div class="container header-inner">
		<?php tk_the_logo(); ?>

		<nav class="nav-desktop" aria-label="<?php esc_attr_e( 'القائمة الرئيسية', 'tek-craft-toppres' ); ?>">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'items_wrap'     => '%3$s',
						'fallback_cb'    => false,
						'depth'          => 1,
						'walker'         => new TK_Flat_Nav_Walker(),
					)
				);
			} else {
				tk_fallback_primary_menu();
			}
			?>
		</nav>

		<div class="header-actions">
			<?php tk_language_switcher(); ?>
			<a class="btn btn-gold btn-sm header-cta" href="<?php echo esc_url( $cta_url ); ?>">
				<?php echo esc_html( $cta_label ); ?>
			</a>
			<button class="burger" type="button" aria-label="<?php esc_attr_e( 'فتح القائمة', 'tek-craft-toppres' ); ?>" aria-expanded="false" aria-controls="tk-mobile-nav">
				<span></span><span></span><span></span>
			</button>
		</div>
	</div>
</header>

<div class="mobile-nav" id="tk-mobile-nav" hidden aria-hidden="true">
	<div class="mobile-nav-top">
		<?php tk_the_logo(); ?>
		<button class="mobile-close" type="button" aria-label="<?php esc_attr_e( 'إغلاق القائمة', 'tek-craft-toppres' ); ?>">&times;</button>
	</div>
	<nav class="mobile-nav-links" aria-label="<?php esc_attr_e( 'قائمة الجوال', 'tek-craft-toppres' ); ?>">
		<?php
		if ( has_nav_menu( 'primary' ) ) {
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'items_wrap'     => '%3$s',
					'fallback_cb'    => false,
					'depth'          => 1,
					'walker'         => new TK_Flat_Nav_Walker(),
				)
			);
		} else {
			tk_fallback_primary_menu();
		}
		?>
	</nav>
	<a class="btn btn-gold btn-block" href="<?php echo esc_url( $cta_url ); ?>">
		<?php echo esc_html( $cta_label ); ?>
	</a>
</div>
