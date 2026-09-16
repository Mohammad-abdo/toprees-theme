<?php
/**
 * Template Name: المساعد البحثي
 *
 * @package Toppers
 */

get_header();

$ai_settings  = toppers_get_ai_settings();
$quick_chips  = $ai_settings['quick_chips'];
$contact_url  = toppers_page_url( 'contact' );
$whatsapp_raw = toppers_opt( 'toppers_whatsapp', '966549093465' );
$whatsapp_num = preg_replace( '/\D+/', '', $whatsapp_raw );
?>
<main class="site-main ai-assistant-page">
	<?php
	get_template_part(
		'template-parts/page-hero',
		null,
		toppers_hero_args(
			'ai',
			array(
				'title'   => __( 'المساعد البحثي الذكي 🤖', 'toppers' ),
				'eyebrow' => __( 'توليد أفكار وعناوين أبحاث حصرية', 'toppers' ),
				'lede'    => __( 'دع نظامنا الأكاديمي الذكي يقترح لك 5 أفكار وعناوين بحثية مبتكرة وغير مستهلكة تناسب تخصصك الدقيق واهتماماتك الأكاديمية.', 'toppers' ),
			)
		)
	);
	?>

	<section class="section ai-sec">
		<div class="container" style="max-width: 960px;">

			<!-- Main Generator Card -->
			<div class="ai-box reveal">
				<div class="ai-box-header">
					<div class="ai-box-badge">
						<span class="pulse-dot"></span>
						<span><?php esc_html_e( 'محرك الصياغة الأكاديمية الذكي', 'toppers' ); ?></span>
					</div>
					<h2><?php esc_html_e( 'أدخل بيانات بحثك لتوليد 5 عناوين مخصصة', 'toppers' ); ?></h2>
					<p><?php esc_html_e( 'حدد تخصصك والدرجة العلمية والكلمات المفتاحية، وسيقوم النظام فوراً بصياغة 5 مقترحات غير مستهلكة مدعومة بالمنهجيات المناسبة.', 'toppers' ); ?></p>
				</div>

				<form id="aiResearchForm" class="ai-form">
					<div class="ai-grid">
						<div class="ai-field">
							<label for="ai-major">
								<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
								<?php esc_html_e( 'التخصص الدقيق', 'toppers' ); ?> <span class="req">*</span>
							</label>
							<input type="text" id="ai-major" name="major" placeholder="<?php esc_attr_e( 'مثال: إدارة الأعمال، الأمن السيبراني، القانون التجاري...', 'toppers' ); ?>" required>
						</div>

						<div class="ai-field">
							<label for="ai-degree">
								<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg>
								<?php esc_html_e( 'الدرجة العلمية', 'toppers' ); ?> <span class="req">*</span>
							</label>
							<select id="ai-degree" name="degree" required>
								<option value="رسالة ماجستير"><?php esc_html_e( 'رسالة ماجستير', 'toppers' ); ?></option>
								<option value="أطروحة دكتوراه"><?php esc_html_e( 'أطروحة دكتوراه', 'toppers' ); ?></option>
								<option value="مشروع تخرج (بكالوريوس)"><?php esc_html_e( 'مشروع تخرج (بكالوريوس)', 'toppers' ); ?></option>
								<option value="بحث ترقية / ورقة علمية للنشر"><?php esc_html_e( 'بحث ترقية / ورقة علمية للنشر', 'toppers' ); ?></option>
							</select>
						</div>
					</div>

					<div class="ai-field" style="margin-top: 18px;">
						<label for="ai-interests">
							<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
							<?php esc_html_e( 'الاهتمامات البحثية أو الكلمات المفتاحية', 'toppers' ); ?> <span class="req">*</span>
						</label>
						<textarea id="ai-interests" name="interests" rows="3" placeholder="<?php esc_attr_e( 'اكتب الكلمات المفتاحية أو الموضوعات التي تود التركيز عليها (مثال: الذكاء الاصطناعي في قيادة التغيير، تحليل المخاطر، التنمية المستدامة...)' , 'toppers' ); ?>" required></textarea>
					</div>

					<?php if ( ! empty( $quick_chips ) ) : ?>
						<div class="ai-chips-wrap">
							<span class="chips-label"><?php esc_html_e( 'أو اختر من الكلمات الأكثر طلباً:', 'toppers' ); ?></span>
							<div class="ai-chips">
								<?php foreach ( $quick_chips as $chip ) : ?>
									<button type="button" class="ai-chip-btn" data-chip="<?php echo esc_attr( $chip ); ?>">
										+ <?php echo esc_html( $chip ); ?>
									</button>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>

					<div class="ai-submit-wrap">
						<button type="submit" id="aiSubmitBtn" class="btn btn-gold btn-lg ai-btn-generate">
							<span class="btn-sparkle">✨</span>
							<span><?php esc_html_e( 'توليد 5 أفكار وعناوين بحثية الآن', 'toppers' ); ?></span>
						</button>
					</div>
				</form>

				<!-- Animated Futuristic Loading State -->
				<div id="ai-loading" class="ai-loading-panel" style="display:none;">
					<div class="ai-scanner-sphere">
						<div class="sphere-inner"></div>
						<div class="sphere-ring"></div>
						<div class="sphere-ring-2"></div>
						<div class="ai-brain-icon">🧠</div>
					</div>
					<h3 id="ai-status-text"><?php esc_html_e( 'جاري تحليل الكلمات المفتاحية والتخصص الأكاديمي...', 'toppers' ); ?></h3>
					<div class="ai-progress-track">
						<div class="ai-progress-bar" id="aiProgressBar"></div>
					</div>
					<p class="ai-loading-sub"><?php esc_html_e( 'نطابق بياناتك مع مئات الأطر المنهجية ورؤية 2030 لابتكار 5 عناوين فريدة...', 'toppers' ); ?></p>
				</div>

				<!-- Results Container (5 Dynamic Cards) -->
				<div id="ai-results" class="ai-results-panel" style="display:none;">
					<div class="results-top-bar">
						<div>
							<span class="res-tag"><?php esc_html_e( 'اكتمل التوليد بنجاح 🎯', 'toppers' ); ?></span>
							<h3 class="res-title"><?php esc_html_e( 'تم توليد 5 أفكار بحثية متميزة تناسب معاييرك:', 'toppers' ); ?></h3>
						</div>
						<button type="button" class="btn btn-outline btn-sm" id="aiRerollBtn">
							🔄 <?php esc_html_e( 'توليد 5 أفكار أخرى', 'toppers' ); ?>
						</button>
					</div>

					<div id="ai-cards-grid" class="ai-cards-grid">
						<!-- Injected via JavaScript -->
					</div>

					<div class="results-bottom-bar">
						<div class="res-help-note">
							<svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
							<span><?php esc_html_e( 'أعجبك أحد العناوين؟ يمكنك نسخه فوراً أو طلب إعداده كاملاً مع كبار الباحثين الأكاديميين في توبرز.', 'toppers' ); ?></span>
						</div>
						<div class="res-actions-row">
							<button type="button" class="btn btn-gold" id="aiRerollBtnBottom">
								✨ <?php esc_html_e( 'توليد 5 عناوين جديدة تماماً', 'toppers' ); ?>
							</button>
							<button type="button" class="btn btn-outline" id="aiEditInputBtn">
								✏️ <?php esc_html_e( 'تعديل التخصص والكلمات', 'toppers' ); ?>
							</button>
						</div>
					</div>
				</div>

			</div>

			<!-- Additional Support Banner -->
			<div class="ai-guarantee-card reveal" style="margin-top: 40px;">
				<div class="gc-icon">🎓</div>
				<div>
					<h4><?php esc_html_e( 'هل تبحث عن مقترح بحثي (Proposal) متكامل أو استشارة خاصة؟', 'toppers' ); ?></h4>
					<p><?php esc_html_e( 'فريقنا الأكاديمي المكون من حملة الدكتوراه والماجستير جاهز لمساعدتك في صياغة خطة البحث، الدراسات السابقة، والتحليل الإحصائي الكامل.', 'toppers' ); ?></p>
				</div>
				<a href="<?php echo esc_url( $contact_url ); ?>" class="btn btn-gold btn-sm"><?php esc_html_e( 'تواصل مع باحث متخصص', 'toppers' ); ?></a>
			</div>

		</div>
	</section>
</main>

<script>
window.ToppersAIData = {
	templates: <?php echo wp_json_encode( $ai_settings['title_templates'] ); ?>,
	contactUrl: <?php echo wp_json_encode( $contact_url ); ?>,
	whatsappNum: <?php echo wp_json_encode( $whatsapp_num ); ?>
};
</script>

<?php
get_footer();

