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
					<a href="<?php echo esc_url( $wa ); ?>" target="_blank" rel="noopener" class="btn btn-whatsapp">
						<i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
						<?php echo esc_html( toppers_opt( 'toppers_footer_cta_b', 'تواصل معنا الآن' ) ); ?>
					</a>
				</div>
			</div>
			<div class="footer-grid">
				<div class="footer-about">
					<div class="footer-brand" style="display: flex; justify-content: flex-start; margin-bottom: 28px; padding-bottom: 4px;">
						<?php echo toppers_footer_logo_html( '', 54 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
					<p style="color: rgba(255,255,255,0.7); font-size: 14.5px; line-height: 1.85; margin-bottom: 20px;">
						<?php echo esc_html( toppers_opt( 'toppers_footer_about', 'منظومة أكاديمية رائدة ومتخصصة في تقديم الاستشارات وخدمات البحث العلمي لطلبة الدراسات العليا والباحثين في المملكة العربية السعودية والوطن العربي بأعلى معايير الرصانة والسرية.' ) ); ?>
					</p>

					<!-- Compact Newsletter Form -->
					<div class="footer-newsletter-mini">
						<div class="fn-mini-title">
							<i class="fa-solid fa-envelope-open-text" aria-hidden="true"></i>
							<span><?php esc_html_e( 'اشترك في النشرة البريدية', 'toppers' ); ?></span>
						</div>
						<form id="footer-newsletter-form" class="fn-mini-form" method="post" action="">
							<?php wp_nonce_field( 'toppers_form', 'fn_nonce' ); ?>
							<div class="fn-mini-input-group">
								<input type="email" name="email" id="fn-email-input" placeholder="<?php esc_attr_e( 'أدخل بريدك الإلكتروني...', 'toppers' ); ?>" required dir="ltr">
								<button type="submit" id="fn-submit-btn" class="btn btn-gold" aria-label="<?php esc_attr_e( 'اشتراك', 'toppers' ); ?>">
									<i class="fa-solid fa-paper-plane" aria-hidden="true"></i>
									<span><?php esc_html_e( 'اشتراك', 'toppers' ); ?></span>
								</button>
							</div>
						</form>
						<div id="fn-success-msg" class="fn-mini-feedback is-success" style="display:none;">
							<i class="fa-solid fa-circle-check"></i>
							<span><?php esc_html_e( 'تم اشتراكك بنجاح! شكرًا لك.', 'toppers' ); ?></span>
						</div>
						<div id="fn-error-msg" class="fn-mini-feedback is-error" style="display:none;"></div>
					</div>
				</div>
				<div class="footer-col links-col">
					<h5><?php esc_html_e( 'روابط سريعة', 'toppers' ); ?></h5>
					<?php
					if ( has_nav_menu( 'footer' ) ) {
						wp_nav_menu(
							array(
								'theme_location' => 'footer',
								'container'      => false,
								'items_wrap'     => '<ul class="footer-links-grid">%3$s</ul>',
								'depth'          => 1,
							)
						);
					} else {
						?>
						<ul class="footer-links-grid">
							<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'الرئيسية', 'toppers' ); ?></a></li>
							<li><a href="<?php echo esc_url( toppers_page_url( 'about' ) ); ?>"><?php esc_html_e( 'من نحن', 'toppers' ); ?></a></li>
							<li><a href="<?php echo esc_url( toppers_page_url( 'services', get_post_type_archive_link( 'toppers_service' ) ) ); ?>"><?php esc_html_e( 'الخدمات', 'toppers' ); ?></a></li>
							<li><a href="<?php echo esc_url( toppers_page_url( 'testimonials' ) ); ?>"><?php esc_html_e( 'آراء الطلاب', 'toppers' ); ?></a></li>
							<li><a href="<?php echo esc_url( toppers_page_url( 'guarantees' ) ); ?>"><?php esc_html_e( 'الضمانات', 'toppers' ); ?></a></li>
							<li><a href="<?php echo esc_url( toppers_page_url( 'team' ) ); ?>"><?php esc_html_e( 'فريق العمل', 'toppers' ); ?></a></li>
							<li><a href="<?php echo esc_url( toppers_page_url( 'careers' ) ); ?>"><?php esc_html_e( 'انضم إلى توبرز', 'toppers' ); ?></a></li>
							<li><a href="<?php echo esc_url( toppers_page_url( 'faq' ) ); ?>"><?php esc_html_e( 'الأسئلة الشائعة', 'toppers' ); ?></a></li>
							<li><a href="<?php echo esc_url( toppers_blog_url() ); ?>"><?php esc_html_e( 'المدونة', 'toppers' ); ?></a></li>
							<li><a href="<?php echo esc_url( toppers_page_url( 'contact' ) ); ?>"><?php esc_html_e( 'تواصل معنا', 'toppers' ); ?></a></li>
							<li><a href="<?php echo esc_url( toppers_page_url( 'privacy' ) ); ?>"><?php esc_html_e( 'الخصوصية', 'toppers' ); ?></a></li>
							<li><a href="<?php echo esc_url( toppers_page_url( 'terms' ) ); ?>"><?php esc_html_e( 'الشروط والأحكام', 'toppers' ); ?></a></li>
						</ul>
						<?php
					}
					?>
				</div>
				<div class="footer-col services-col">
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
						$services = get_posts( array( 'post_type' => 'toppers_service', 'posts_per_page' => 6, 'orderby' => 'menu_order title' ) );
						if ( ! empty( $services ) ) {
							echo '<ul>';
							foreach ( $services as $service ) {
								echo '<li><a href="' . esc_url( get_permalink( $service ) ) . '">' . esc_html( get_the_title( $service ) ) . '</a></li>';
							}
							echo '</ul>';
						} else {
							?>
							<ul>
								<li><a href="<?php echo esc_url( toppers_service_url( 'إعداد رسائل الماجستير' ) ); ?>"><?php esc_html_e( 'إعداد رسائل الماجستير', 'toppers' ); ?></a></li>
								<li><a href="<?php echo esc_url( toppers_service_url( 'إعداد رسائل الدكتوراه' ) ); ?>"><?php esc_html_e( 'إعداد رسائل الدكتوراه', 'toppers' ); ?></a></li>
								<li><a href="<?php echo esc_url( toppers_service_url( 'إعداد خطة البحث (المقترح البحثي – Proposal)' ) ); ?>"><?php esc_html_e( 'خطة البحث (Proposal)', 'toppers' ); ?></a></li>
								<li><a href="<?php echo esc_url( toppers_service_url( 'التحليل الإحصائي وتفسير النتائج' ) ); ?>"><?php esc_html_e( 'التحليل الإحصائي', 'toppers' ); ?></a></li>
								<li><a href="<?php echo esc_url( toppers_service_url( 'التدقيق اللغوي والنحوي' ) ); ?>"><?php esc_html_e( 'التدقيق اللغوي', 'toppers' ); ?></a></li>
								<li><a href="<?php echo esc_url( toppers_service_url( 'فحص السرقة الأدبية ونسبة الاقتباس (Plagiarism)' ) ); ?>"><?php esc_html_e( 'فحص الاقتباس (Plagiarism)', 'toppers' ); ?></a></li>
							</ul>
							<?php
						}
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
					<div class="footer-social-wrap" style="margin-top: 24px; padding-top: 18px; border-top: 1px solid rgba(255,255,255,0.08);">
						<div style="font-size: 13px; color: rgba(255,255,255,0.85); font-weight: 600; margin-bottom: 12px;"><?php esc_html_e( 'تابعنا على منصات التواصل', 'toppers' ); ?></div>
						<div class="footer-social" style="display: flex; gap: 8px; flex-wrap: wrap;">
							<a href="<?php echo esc_url( toppers_whatsapp_url() ); ?>" aria-label="WhatsApp" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i></a>
							<?php if ( toppers_opt( 'toppers_facebook', 'https://facebook.com' ) ) : ?>
								<a href="<?php echo esc_url( toppers_opt( 'toppers_facebook', 'https://facebook.com' ) ); ?>" aria-label="Facebook" target="_blank" rel="noopener"><i class="fa-brands fa-facebook-f" aria-hidden="true"></i></a>
							<?php endif; ?>
							<?php if ( toppers_opt( 'toppers_twitter', 'https://twitter.com' ) ) : ?>
								<a href="<?php echo esc_url( toppers_opt( 'toppers_twitter', 'https://twitter.com' ) ); ?>" aria-label="X (Twitter)" target="_blank" rel="noopener"><i class="fa-brands fa-x-twitter" aria-hidden="true"></i></a>
							<?php endif; ?>
							<?php if ( toppers_opt( 'toppers_instagram', 'https://instagram.com' ) ) : ?>
								<a href="<?php echo esc_url( toppers_opt( 'toppers_instagram', 'https://instagram.com' ) ); ?>" aria-label="Instagram" target="_blank" rel="noopener"><i class="fa-brands fa-instagram" aria-hidden="true"></i></a>
							<?php endif; ?>
							<?php if ( toppers_opt( 'toppers_linkedin', 'https://linkedin.com' ) ) : ?>
								<a href="<?php echo esc_url( toppers_opt( 'toppers_linkedin', 'https://linkedin.com' ) ); ?>" aria-label="LinkedIn" target="_blank" rel="noopener"><i class="fa-brands fa-linkedin-in" aria-hidden="true"></i></a>
							<?php endif; ?>
							<?php if ( toppers_opt( 'toppers_snapchat', 'https://snapchat.com' ) ) : ?>
								<a href="<?php echo esc_url( toppers_opt( 'toppers_snapchat', 'https://snapchat.com' ) ); ?>" aria-label="Snapchat" target="_blank" rel="noopener"><i class="fa-brands fa-snapchat" aria-hidden="true"></i></a>
							<?php endif; ?>
							<?php if ( toppers_opt( 'toppers_youtube' ) ) : ?>
								<a href="<?php echo esc_url( toppers_opt( 'toppers_youtube' ) ); ?>" aria-label="YouTube" target="_blank" rel="noopener"><i class="fa-brands fa-youtube" aria-hidden="true"></i></a>
							<?php endif; ?>
							<?php if ( toppers_opt( 'toppers_tiktok' ) ) : ?>
								<a href="<?php echo esc_url( toppers_opt( 'toppers_tiktok' ) ); ?>" aria-label="TikTok" target="_blank" rel="noopener"><i class="fa-brands fa-tiktok" aria-hidden="true"></i></a>
							<?php endif; ?>
							<?php if ( toppers_opt( 'toppers_telegram' ) ) : ?>
								<a href="<?php echo esc_url( toppers_opt( 'toppers_telegram' ) ); ?>" aria-label="Telegram" target="_blank" rel="noopener"><i class="fa-brands fa-telegram" aria-hidden="true"></i></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>

			<!-- Payment Methods Bar -->
			<?php echo toppers_payment_methods_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

			<div class="footer-bottom">
				<div class="copyright">&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'جميع الحقوق محفوظة.', 'toppers' ); ?></div>
				<div class="footer-legal">
					<a href="<?php echo esc_url( toppers_page_url( 'privacy' ) ); ?>"><?php esc_html_e( 'سياسة الخصوصية', 'toppers' ); ?></a>
					<span aria-hidden="true">·</span>
					<a href="<?php echo esc_url( toppers_page_url( 'terms' ) ); ?>"><?php esc_html_e( 'شروط الاستخدام', 'toppers' ); ?></a>
					<span aria-hidden="true">·</span>
					<a href="<?php echo esc_url( toppers_page_url( 'faq' ) ); ?>"><?php esc_html_e( 'الأسئلة الشائعة', 'toppers' ); ?></a>
				</div>
				<div class="dev-credits">Developed by <a href="http://tek-craft.com/" target="_blank" rel="noopener noreferrer"><b>tekcraft</b></a></div>
			</div>
		</div>
	</footer>

	<a href="<?php echo esc_url( $wa ); ?>" target="_blank" rel="noopener" class="wa-float" aria-label="WhatsApp">
		<i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
	</a>

	<style>
	.footer-newsletter-mini {
		margin-top: 24px;
		background: rgba(255, 255, 255, 0.03);
		border: 1px solid rgba(255, 255, 255, 0.08);
		border-radius: 14px;
		padding: 16px 18px;
		max-width: 100%;
		transition: border-color 0.3s ease, background 0.3s ease;
	}
	.footer-newsletter-mini:focus-within {
		border-color: rgba(201, 154, 59, 0.4);
		background: rgba(255, 255, 255, 0.05);
	}
	.fn-mini-title {
		font-size: 13.5px;
		font-weight: 700;
		color: #ffffff;
		margin-bottom: 10px;
		display: flex;
		align-items: center;
		gap: 8px;
	}
	.fn-mini-title i {
		color: var(--gold, #c99a3b);
		font-size: 14px;
	}
	.fn-mini-input-group {
		display: flex;
		align-items: stretch;
		gap: 6px;
		background: rgba(14, 23, 48, 0.9);
		border: 1px solid rgba(255, 255, 255, 0.12);
		border-radius: 10px;
		padding: 4px;
		transition: all 0.3s ease;
	}
	.fn-mini-input-group:focus-within {
		border-color: var(--gold, #c99a3b);
		box-shadow: 0 0 0 2px rgba(201, 154, 59, 0.2);
	}
	.fn-mini-input-group input {
		background: transparent !important;
		border: none !important;
		color: #ffffff !important;
		font-size: 13px !important;
		padding: 8px 10px !important;
		flex: 1 1 auto !important;
		min-width: 0 !important;
		outline: none !important;
		box-shadow: none !important;
	}
	.fn-mini-input-group input::placeholder {
		color: rgba(255, 255, 255, 0.4);
		font-size: 12.5px;
	}
	.fn-mini-input-group .btn {
		padding: 7px 14px;
		font-size: 12.5px;
		font-weight: 600;
		display: inline-flex;
		align-items: center;
		gap: 6px;
		border-radius: 7px;
		white-space: nowrap;
		flex-shrink: 0;
	}
	.fn-mini-feedback {
		margin-top: 8px;
		font-size: 12px;
		display: flex;
		align-items: center;
		gap: 6px;
		line-height: 1.4;
	}
	.fn-mini-feedback.is-success {
		color: #4ade80;
	}
	.fn-mini-feedback.is-error {
		color: #f87171;
	}
	@media (max-width: 480px) {
		.fn-mini-input-group {
			flex-direction: column;
		}
		.fn-mini-input-group .btn {
			width: 100%;
			justify-content: center;
		}
	}
	</style>

	<script>
	document.addEventListener('DOMContentLoaded', function () {
		var fnForm = document.getElementById('footer-newsletter-form');
		var fnInput = document.getElementById('fn-email-input');
		var fnBtn = document.getElementById('fn-submit-btn');
		var fnSuccess = document.getElementById('fn-success-msg');
		var fnError = document.getElementById('fn-error-msg');

		if (fnForm) {
			fnForm.addEventListener('submit', function (e) {
				e.preventDefault();
				var email = fnInput.value.trim();
				if (!email) return;

				var originalHtml = fnBtn.innerHTML;
				fnBtn.disabled = true;
				fnBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';

				var formData = new FormData();
				formData.append('action', 'toppers_newsletter_subscribe');
				formData.append('nonce', (window.toppersTheme && window.toppersTheme.nonce) ? window.toppersTheme.nonce : '');
				formData.append('email', email);

				var ajaxUrl = (window.toppersTheme && window.toppersTheme.ajaxUrl) ? window.toppersTheme.ajaxUrl : '/wp-admin/admin-ajax.php';

				fetch(ajaxUrl, {
					method: 'POST',
					body: formData,
					credentials: 'same-origin'
				})
				.then(function (r) { return r.json(); })
				.then(function (res) {
					fnBtn.disabled = false;
					fnBtn.innerHTML = originalHtml;
					if (res && res.success) {
						fnForm.style.display = 'none';
						if (fnError) fnError.style.display = 'none';
						if (fnSuccess) fnSuccess.style.display = 'flex';
					} else {
						if (fnError) {
							fnError.textContent = (res && res.data && res.data.message) ? res.data.message : 'حدث خطأ. يرجى المحاولة لاحقاً.';
							fnError.style.display = 'flex';
						}
					}
				})
				.catch(function () {
					fnBtn.disabled = false;
					fnBtn.innerHTML = originalHtml;
					fnForm.style.display = 'none';
					if (fnSuccess) fnSuccess.style.display = 'flex';
				});
			});
		}
	});
	</script>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>