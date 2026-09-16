<?php
/**
 * Theme footer.
 *
 * @package Toppers
 */

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) :
	$wa = toppers_whatsapp_url();
	?>
	<footer class="site-footer">
		<div class="container">
			<div class="footer-cta" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); padding: 40px; border-radius: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px; margin-bottom: 60px;">
				<div>
					<h3 style="color: #fff; font-size: 24px; margin-bottom: 8px;"><?php echo esc_html( toppers_opt( 'toppers_footer_cta_t', 'هل أنت مستعد لبدء رحلة نجاحك الأكاديمي؟' ) ); ?></h3>
					<p style="color: rgba(255,255,255,0.6); margin: 0; font-size: 15px;"><?php echo esc_html( toppers_opt( 'toppers_footer_cta_d', 'انضم إلى آلاف الباحثين والطلاب الذين وثقوا في توبرز.' ) ); ?></p>
				</div>
				<div>
					<a href="<?php echo esc_url( $wa ); ?>" target="_blank" rel="noopener" class="btn btn-gold" style="display: inline-flex; align-items: center; gap: 8px;">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 0 0-8.6 15L2 22l5.2-1.4A10 10 0 1 0 12 2zm0 18.2a8.1 8.1 0 0 1-4.2-1.1l-.3-.2-3.1.8.8-3-.2-.3A8.2 8.2 0 1 1 12 20.2zm4.5-6.1c-.2-.1-1.5-.7-1.7-.8-.2-.1-.4-.1-.6.1-.2.2-.7.8-.8 1-.2.2-.3.2-.5.1-1.4-.7-2.4-1.3-3.3-2.9-.3-.4.3-.4.7-1.3.1-.2 0-.4 0-.5-.1-.1-.6-1.5-.9-2-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.5.1-.7.3-.2.2-1 1-1 2.4s1 2.8 1.1 3c.1.2 2 3 4.8 4.2.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.5-.1 1.5-.6 1.8-1.2.2-.6.2-1.1.1-1.2 0-.2-.2-.2-.4-.3z" /></svg>
						<?php echo esc_html( toppers_opt( 'toppers_footer_cta_b', 'تواصل معنا الآن' ) ); ?>
					</a>
				</div>
			</div>
			<div class="footer-grid">
				<div class="footer-about">
					<div class="footer-brand" style="display: flex; justify-content: flex-start; margin-bottom: 20px;">
						<?php echo toppers_logo_html( '', 48 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
					<p style="color: rgba(255,255,255,0.6); font-size: 14.5px; line-height: 1.8; margin-bottom: 24px;"><?php echo esc_html( toppers_opt( 'toppers_footer_about', 'شركة سعودية متخصصة في تقديم الخدمات الأكاديمية والبحثية لطلاب الجامعات والدراسات العليا والباحثين في جميع أنحاء الوطن العربي.' ) ); ?></p>
					<div class="footer-social" style="display: flex; justify-content: flex-start; margin: 0;">
						<a href="<?php echo esc_url( toppers_opt( 'toppers_twitter' ) ?: '#' ); ?>" aria-label="Twitter"<?php echo toppers_opt( 'toppers_twitter' ) ? ' target="_blank" rel="noopener"' : ''; ?>><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M23 4.9c-.8.4-1.7.6-2.6.8 1-.6 1.7-1.5 2-2.6-.9.5-1.9.9-3 1.1-.9-.9-2.1-1.5-3.4-1.5-2.6 0-4.7 2.1-4.7 4.7 0 .4 0 .7.1 1-3.9-.2-7.4-2.1-9.7-5-.4.7-.6 1.5-.6 2.3 0 1.6.8 3.1 2.1 3.9-.7 0-1.5-.2-2.1-.6v.1c0 2.3 1.6 4.2 3.8 4.6-.4.1-.8.2-1.2.2-.3 0-.6 0-.9-.1.6 1.9 2.3 3.2 4.4 3.3-1.6 1.3-3.6 2-5.8 2-.4 0-.7 0-1.1-.1 2.1 1.3 4.5 2.1 7.1 2.1 8.6 0 13.3-7.1 13.3-13.3v-.6c.9-.7 1.7-1.5 2.3-2.4z" /></svg></a>
						<a href="<?php echo esc_url( toppers_opt( 'toppers_instagram' ) ?: '#' ); ?>" aria-label="Instagram"<?php echo toppers_opt( 'toppers_instagram' ) ? ' target="_blank" rel="noopener"' : ''; ?>><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2c2.7 0 3.1 0 4.1.1 1 0 1.7.2 2.3.4.6.3 1.1.6 1.6 1.1.5.5.8 1 1.1 1.6.2.6.4 1.3.4 2.3.1 1 .1 1.4.1 4.1s0 3.1-.1 4.1c0 1-.2 1.7-.4 2.3-.3.6-.6 1.1-1.1 1.6-.5.5-1 .8-1.6 1.1-.6.2-1.3.4-2.3.4-1 .1-1.4.1-4.1.1s-3.1 0-4.1-.1c-1 0-1.7-.2-2.3-.4-.6-.3-1.1-.6-1.6-1.1-.5-.5-.8-1-1.1-1.6-.2-.6-.4-1.3-.4-2.3C2 15.1 2 14.7 2 12s0-3.1.1-4.1c0-1 .2-1.7.4-2.3.3-.6.6-1.1 1.1-1.6.5-.5 1-.8 1.6-1.1.6-.2 1.3-.4 2.3-.4C8.9 2 9.3 2 12 2zm0 5a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm0 8.2a3.2 3.2 0 1 1 0-6.4 3.2 3.2 0 0 1 0 6.4zm5.2-8.4a1.2 1.2 0 1 0 0-2.4 1.2 1.2 0 0 0 0 2.4z" /></svg></a>
						<?php if ( toppers_opt( 'toppers_linkedin' ) ) : ?>
							<a href="<?php echo esc_url( toppers_opt( 'toppers_linkedin' ) ); ?>" aria-label="LinkedIn" target="_blank" rel="noopener"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M4.98 3.5C4.98 4.88 3.88 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1s2.48 1.12 2.48 2.5zM.5 8.5h4V24h-4V8.5zM8.5 8.5h3.8v2.1h.05c.53-1 1.84-2.1 3.79-2.1 4.05 0 4.8 2.67 4.8 6.14V24h-4v-7.7c0-1.84-.03-4.2-2.56-4.2-2.56 0-2.95 2-2.95 4.06V24h-4V8.5z"/></svg></a>
						<?php endif; ?>
					</div>
				</div>
				<div class="footer-col">
					<h5><?php esc_html_e( 'روابط سريعة', 'toppers' ); ?></h5>
					<?php
					if ( has_nav_menu( 'footer' ) ) {
						wp_nav_menu(
							array(
								'theme_location' => 'footer',
								'container'      => false,
								'items_wrap'     => '<ul>%3$s</ul>',
								'depth'          => 1,
							)
						);
					} else {
						?>
						<ul>
							<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'الرئيسية', 'toppers' ); ?></a></li>
							<li><a href="<?php echo esc_url( get_post_type_archive_link( 'toppers_service' ) ); ?>"><?php esc_html_e( 'الخدمات', 'toppers' ); ?></a></li>
							<li><a href="<?php echo esc_url( toppers_page_url( 'about' ) ); ?>"><?php esc_html_e( 'من نحن', 'toppers' ); ?></a></li>
							<li><a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'المقالات', 'toppers' ); ?></a></li>
						</ul>
						<?php
					}
					?>
				</div>
				<div class="footer-col">
					<h5><?php esc_html_e( 'خدمات رئيسية', 'toppers' ); ?></h5>
					<?php
					if ( has_nav_menu( 'footer_services' ) ) {
						wp_nav_menu(
							array(
								'theme_location' => 'footer_services',
								'container'      => false,
								'items_wrap'     => '<ul>%3$s</ul>',
								'depth'          => 1,
							)
						);
					} else {
						$services = get_posts( array( 'post_type' => 'toppers_service', 'posts_per_page' => 4, 'orderby' => 'menu_order title' ) );
						echo '<ul>';
						foreach ( $services as $service ) {
							echo '<li><a href="' . esc_url( get_permalink( $service ) ) . '">' . esc_html( get_the_title( $service ) ) . '</a></li>';
						}
						echo '</ul>';
					}
					?>
				</div>
				<div class="footer-col contact-col">
					<h5><?php esc_html_e( 'تواصل معنا', 'toppers' ); ?></h5>
					<ul>
						<li class="contact-item" style="color: rgba(255,255,255,0.7);">
							<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--gold-light)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
							<a href="<?php echo esc_url( $wa ); ?>" dir="ltr"><?php echo esc_html( toppers_phone() ); ?></a>
						</li>
						<li class="contact-item" style="color: rgba(255,255,255,0.7);">
							<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--gold-light)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
							<a href="mailto:<?php echo esc_attr( toppers_email() ); ?>"><?php echo esc_html( toppers_email() ); ?></a>
						</li>
						<li class="contact-item" style="color: rgba(255,255,255,0.7);">
							<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--gold-light)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
							<span><?php echo esc_html( toppers_hours() ); ?></span>
						</li>
					</ul>
				</div>
			</div>
			<div class="footer-bottom">
				<div class="copyright">&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'جميع الحقوق محفوظة.', 'toppers' ); ?></div>
				<div class="dev-credits">Developed by <b>tekcraft</b></div>
			</div>
		</div>
	</footer>

	<a href="<?php echo esc_url( $wa ); ?>" target="_blank" rel="noopener" class="wa-float" aria-label="WhatsApp">
		<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 0 0-8.6 15L2 22l5.2-1.4A10 10 0 1 0 12 2zm0 18.2a8.1 8.1 0 0 1-4.2-1.1l-.3-.2-3.1.8.8-3-.2-.3A8.2 8.2 0 1 1 12 20.2zm4.5-6.1c-.2-.1-1.5-.7-1.7-.8-.2-.1-.4-.1-.6.1-.2.2-.7.8-.8 1-.2.2-.3.2-.5.1-1.4-.7-2.4-1.3-3.3-2.9-.3-.4.3-.4.7-1.3.1-.2 0-.4 0-.5-.1-.1-.6-1.5-.9-2-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.5.1-.7.3-.2.2-1 1-1 2.4s1 2.8 1.1 3c.1.2 2 3 4.8 4.2.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.5-.1 1.5-.6 1.8-1.2.2-.6.2-1.1.1-1.2 0-.2-.2-.2-.4-.3z" /></svg>
	</a>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
