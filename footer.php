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
						<i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
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
						<?php if ( toppers_opt( 'toppers_twitter' ) ) : ?>
							<a href="<?php echo esc_url( toppers_opt( 'toppers_twitter' ) ); ?>" aria-label="Twitter" target="_blank" rel="noopener"><i class="fa-brands fa-x-twitter" aria-hidden="true"></i></a>
						<?php endif; ?>
						<?php if ( toppers_opt( 'toppers_instagram' ) ) : ?>
							<a href="<?php echo esc_url( toppers_opt( 'toppers_instagram' ) ); ?>" aria-label="Instagram" target="_blank" rel="noopener"><i class="fa-brands fa-instagram" aria-hidden="true"></i></a>
						<?php endif; ?>
						<?php if ( toppers_opt( 'toppers_linkedin' ) ) : ?>
							<a href="<?php echo esc_url( toppers_opt( 'toppers_linkedin' ) ); ?>" aria-label="LinkedIn" target="_blank" rel="noopener"><i class="fa-brands fa-linkedin-in" aria-hidden="true"></i></a>
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
							<li><a href="<?php echo esc_url( toppers_page_url( 'faq' ) ); ?>"><?php esc_html_e( 'الأسئلة الشائعة', 'toppers' ); ?></a></li>
							<li><a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'المقالات', 'toppers' ); ?></a></li>
							<li><a href="<?php echo esc_url( toppers_page_url( 'privacy' ) ); ?>"><?php esc_html_e( 'سياسة الخصوصية', 'toppers' ); ?></a></li>
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
							<i class="fa-solid fa-phone" style="color: var(--gold-light);" aria-hidden="true"></i>
							<a href="<?php echo esc_url( $wa ); ?>" dir="ltr"><?php echo esc_html( toppers_phone() ); ?></a>
						</li>
						<li class="contact-item" style="color: rgba(255,255,255,0.7);">
							<i class="fa-solid fa-envelope" style="color: var(--gold-light);" aria-hidden="true"></i>
							<a href="mailto:<?php echo esc_attr( toppers_email() ); ?>"><?php echo esc_html( toppers_email() ); ?></a>
						</li>
						<li class="contact-item" style="color: rgba(255,255,255,0.7);">
							<i class="fa-solid fa-clock" style="color: var(--gold-light);" aria-hidden="true"></i>
							<span><?php echo esc_html( toppers_hours() ); ?></span>
						</li>
					</ul>
				</div>
			</div>
			<div class="footer-bottom">
				<div class="copyright">&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'جميع الحقوق محفوظة.', 'toppers' ); ?></div>
				<div class="footer-legal">
					<a href="<?php echo esc_url( toppers_page_url( 'privacy' ) ); ?>"><?php esc_html_e( 'سياسة الخصوصية', 'toppers' ); ?></a>
					<span aria-hidden="true">·</span>
					<a href="<?php echo esc_url( toppers_page_url( 'terms' ) ); ?>"><?php esc_html_e( 'شروط الاستخدام', 'toppers' ); ?></a>
					<span aria-hidden="true">·</span>
					<a href="<?php echo esc_url( toppers_page_url( 'faq' ) ); ?>"><?php esc_html_e( 'الأسئلة الشائعة', 'toppers' ); ?></a>
				</div>
				<div class="dev-credits">Developed by <b>tekcraft</b></div>
			</div>
		</div>
	</footer>

	<a href="<?php echo esc_url( $wa ); ?>" target="_blank" rel="noopener" class="wa-float" aria-label="WhatsApp">
		<i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
	</a>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
