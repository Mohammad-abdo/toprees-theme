<?php
/**
 * Default site footer (Elementor Theme Builder fallback).
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$about      = tk_get_translated_mod( 'tk_footer_about', '' );
$cta_title  = tk_get_translated_mod( 'tk_footer_cta_title', '' );
$cta_text   = tk_get_translated_mod( 'tk_footer_cta_text', '' );
$phone      = tk_get_translated_mod( 'tk_phone', '+966 54 909 3465' );
$email      = tk_get_translated_mod( 'tk_email', 'info@toppers-edu.com' );
$hours      = tk_get_translated_mod( 'tk_hours', '' );
$twitter    = tk_get_mod( 'tk_twitter', '' );
$instagram  = tk_get_mod( 'tk_instagram', '' );
$linkedin   = tk_get_mod( 'tk_linkedin', '' );
$wa_url     = tk_whatsapp_url();
?>
<footer class="site-footer">
	<div class="container">
		<?php if ( $cta_title || $cta_text ) : ?>
			<div class="footer-cta">
				<div>
					<?php if ( $cta_title ) : ?>
						<h3><?php echo esc_html( $cta_title ); ?></h3>
					<?php endif; ?>
					<?php if ( $cta_text ) : ?>
						<p><?php echo esc_html( $cta_text ); ?></p>
					<?php endif; ?>
				</div>
				<?php if ( $wa_url ) : ?>
					<div>
						<a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-gold footer-wa-btn">
							<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a10 10 0 0 0-8.6 15L2 22l5.2-1.4A10 10 0 1 0 12 2zm0 18.2a8.1 8.1 0 0 1-4.2-1.1l-.3-.2-3.1.8.8-3-.2-.3A8.2 8.2 0 1 1 12 20.2zm4.5-6.1c-.2-.1-1.5-.7-1.7-.8-.2-.1-.4-.1-.6.1-.2.2-.7.8-.8 1-.2.2-.3.2-.5.1-1.4-.7-2.4-1.3-3.3-2.9-.3-.4.3-.4.7-1.3.1-.2 0-.4 0-.5-.1-.1-.6-1.5-.9-2-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.5.1-.7.3-.2.2-1 1-1 2.4s1 2.8 1.1 3c.1.2 2 3 4.8 4.2.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.5-.1 1.5-.6 1.8-1.2.2-.6.2-1.1.1-1.2 0-.2-.2-.2-.4-.3z"/></svg>
							<?php esc_html_e( 'تواصل معنا الآن', 'tek-craft-toppres' ); ?>
						</a>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="footer-grid">
			<div class="footer-about">
				<div class="footer-brand"><?php tk_the_logo(); ?></div>
				<?php if ( $about ) : ?>
					<p class="footer-about-text"><?php echo esc_html( $about ); ?></p>
				<?php endif; ?>
				<div class="footer-social">
					<?php if ( $twitter ) : ?>
						<a href="<?php echo esc_url( $twitter ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M23 4.9c-.8.4-1.7.6-2.6.8 1-.6 1.7-1.5 2-2.6-.9.5-1.9.9-3 1.1-.9-.9-2.1-1.5-3.4-1.5-2.6 0-4.7 2.1-4.7 4.7 0 .4 0 .7.1 1-3.9-.2-7.4-2.1-9.7-5-.4.7-.6 1.5-.6 2.3 0 1.6.8 3.1 2.1 3.9-.7 0-1.5-.2-2.1-.6v.1c0 2.3 1.6 4.2 3.8 4.6-.4.1-.8.2-1.2.2-.3 0-.6 0-.9-.1.6 1.9 2.3 3.2 4.4 3.3-1.6 1.3-3.6 2-5.8 2-.4 0-.7 0-1.1-.1 2.1 1.3 4.5 2.1 7.1 2.1 8.6 0 13.3-7.1 13.3-13.3v-.6c.9-.7 1.7-1.5 2.3-2.4z"/></svg>
						</a>
					<?php endif; ?>
					<?php if ( $instagram ) : ?>
						<a href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2c2.7 0 3.1 0 4.1.1 1 0 1.7.2 2.3.4.6.3 1.1.6 1.6 1.1.5.5.8 1 1.1 1.6.2.6.4 1.3.4 2.3.1 1 .1 1.4.1 4.1s0 3.1-.1 4.1c0 1-.2 1.7-.4 2.3-.3.6-.6 1.1-1.1 1.6-.5.5-1 .8-1.6 1.1-.6.2-1.3.4-2.3.4-1 .1-1.4.1-4.1.1s-3.1 0-4.1-.1c-1 0-1.7-.2-2.3-.4-.6-.3-1.1-.6-1.6-1.1-.5-.5-.8-1-1.1-1.6-.2-.6-.4-1.3-.4-2.3C2 15.1 2 14.7 2 12s0-3.1.1-4.1c0-1 .2-1.7.4-2.3.3-.6.6-1.1 1.1-1.6.5-.5 1-.8 1.6-1.1.6-.2 1.3-.4 2.3-.4C8.9 2 9.3 2 12 2zm0 5a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm0 8.2a3.2 3.2 0 1 1 0-6.4 3.2 3.2 0 0 1 0 6.4zm5.2-8.4a1.2 1.2 0 1 0 0-2.4 1.2 1.2 0 0 0 0 2.4z"/></svg>
						</a>
					<?php endif; ?>
					<?php if ( $linkedin ) : ?>
						<a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M4.98 3.5C4.98 4.88 3.86 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1s2.48 1.12 2.48 2.5zM0 8h5v16H0V8zm7.5 0H12v2.2h.06c.64-1.2 2.2-2.46 4.54-2.46C21.4 7.74 24 10.1 24 14.7V24h-5v-8.2c0-2-.04-4.56-2.78-4.56-2.78 0-3.2 2.16-3.2 4.4V24H7.5V8z"/></svg>
						</a>
					<?php endif; ?>
				</div>
			</div>

			<div class="footer-col">
				<h5><?php esc_html_e( 'روابط سريعة', 'tek-craft-toppres' ); ?></h5>
				<?php
				if ( has_nav_menu( 'footer' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'container'      => false,
							'menu_class'     => '',
							'depth'          => 1,
							'fallback_cb'    => false,
						)
					);
				} else {
					echo '<ul>';
					echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'الرئيسية', 'tek-craft-toppres' ) . '</a></li>';
					echo '<li><a href="' . esc_url( get_post_type_archive_link( 'tk_service' ) ) . '">' . esc_html__( 'الخدمات', 'tek-craft-toppres' ) . '</a></li>';
					echo '</ul>';
				}
				?>
			</div>

			<div class="footer-col">
				<h5><?php esc_html_e( 'خدمات رئيسية', 'tek-craft-toppres' ); ?></h5>
				<?php
				if ( has_nav_menu( 'footer_services' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'footer_services',
							'container'      => false,
							'menu_class'     => '',
							'depth'          => 1,
							'fallback_cb'    => false,
						)
					);
				} else {
					$services = get_posts(
						array(
							'post_type'      => 'tk_service',
							'posts_per_page' => 4,
							'post_status'    => 'publish',
						)
					);
					echo '<ul>';
					if ( $services ) {
						foreach ( $services as $service ) {
							printf(
								'<li><a href="%1$s">%2$s</a></li>',
								esc_url( get_permalink( $service ) ),
								esc_html( get_the_title( $service ) )
							);
						}
					} else {
						echo '<li><a href="' . esc_url( get_post_type_archive_link( 'tk_service' ) ) . '">' . esc_html__( 'عرض الخدمات', 'tek-craft-toppres' ) . '</a></li>';
					}
					echo '</ul>';
				}
				?>
			</div>

			<div class="footer-col contact-col">
				<h5><?php esc_html_e( 'تواصل معنا', 'tek-craft-toppres' ); ?></h5>
				<ul>
					<?php if ( $phone ) : ?>
						<li class="contact-item">
							<span dir="ltr"><?php echo esc_html( $phone ); ?></span>
						</li>
					<?php endif; ?>
					<?php if ( $email ) : ?>
						<li class="contact-item">
							<a href="<?php echo esc_url( 'mailto:' . $email ); ?>"><?php echo esc_html( $email ); ?></a>
						</li>
					<?php endif; ?>
					<?php if ( $hours ) : ?>
						<li class="contact-item"><?php echo esc_html( $hours ); ?></li>
					<?php endif; ?>
				</ul>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="copyright">
				&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>.
				<?php esc_html_e( 'جميع الحقوق محفوظة.', 'tek-craft-toppres' ); ?>
			</div>
			<div class="dev-credits"><?php esc_html_e( 'Developed by', 'tek-craft-toppres' ); ?> <b>tekcraft</b></div>
		</div>
	</div>
</footer>
