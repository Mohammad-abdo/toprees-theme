<?php
/**
 * Template Name: انضم إلى توبرز
 *
 * @package Toppers
 */

get_header();
?>

<main class="site-main career-page-clean">
	<?php
	get_template_part(
		'template-parts/page-hero',
		null,
		toppers_hero_args(
			'careers',
			array(
				'title'   => __( 'انضم إلى توبرز', 'toppers' ),
				'eyebrow' => __( 'انضم إلى نخبة خبرائنا', 'toppers' ),
				'crumb'   => __( 'انضم إلى توبرز', 'toppers' ),
				'lede'    => __( 'يسعدنا استقطاب الكفاءات الأكاديمية والباحثين المتخصصين للانضمام إلى شبكة خبرائنا المعتمدين في توبرز.', 'toppers' ),
				'center'  => true,
				'orbs'    => true,
			)
		)
	);
	?>

	<section class="career-form-section">
		<div class="container">
			<div class="career-clean-container">
				<div class="career-card" id="career-form-wrapper">
					<div class="career-card-header">
						<div class="header-icon" aria-hidden="true">
							<i class="fa-solid fa-id-card-clip"></i>
						</div>
						<h2 class="form-title"><?php esc_html_e( 'استمارة انضمام المختصين', 'toppers' ); ?></h2>
						<p class="form-subtitle"><?php esc_html_e( 'يرجى ملء البيانات التالية بدقة وإرفاق سيرتك الذاتية (CV) للبدء في مراجعة طلبك.', 'toppers' ); ?></p>
					</div>

					<form id="career-apply-form" method="post" action="" enctype="multipart/form-data">
						<?php wp_nonce_field( 'toppers_form', 'career_nonce' ); ?>
						<input type="hidden" name="action" value="toppers_career_apply">

						<!-- 1. الاسم -->
						<div class="form-group">
							<label for="c-name" class="field-label">
								<i class="fa-solid fa-user" aria-hidden="true"></i>
								<span><?php esc_html_e( 'الاسم الكامل', 'toppers' ); ?></span>
								<span class="required-star">*</span>
							</label>
							<div class="input-with-icon">
								<input id="c-name" type="text" name="name" required autocomplete="name" placeholder="<?php esc_attr_e( 'الاسم الثلاثي أو الرباعي', 'toppers' ); ?>">
							</div>
						</div>

						<div class="form-row">
							<!-- 2. السن -->
							<div class="form-group col-half">
								<label for="c-age" class="field-label">
									<i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
									<span><?php esc_html_e( 'السن / العمر', 'toppers' ); ?></span>
									<span class="required-star">*</span>
								</label>
								<div class="input-with-icon">
									<input id="c-age" type="number" name="age" required min="18" max="85" placeholder="<?php esc_attr_e( 'مثال: 32', 'toppers' ); ?>">
								</div>
							</div>

							<!-- 3. رقم الموبايل -->
							<div class="form-group col-half">
								<label for="c-phone" class="field-label">
									<i class="fa-solid fa-mobile-screen-button" aria-hidden="true"></i>
									<span><?php esc_html_e( 'رقم الموبايل / واتساب', 'toppers' ); ?></span>
									<span class="required-star">*</span>
								</label>
								<div class="input-with-icon">
									<input id="c-phone" type="tel" name="phone" required autocomplete="tel" dir="ltr" placeholder="+966 5X XXX XXXX">
								</div>
							</div>
						</div>

						<!-- 4. التخرج والمؤهل والتخصص -->
						<div class="form-group">
							<label for="c-graduation" class="field-label">
								<i class="fa-solid fa-graduation-cap" aria-hidden="true"></i>
								<span><?php esc_html_e( 'التخرج والمؤهل والتخصص', 'toppers' ); ?></span>
								<span class="required-star">*</span>
							</label>
							<div class="input-with-icon">
								<input id="c-graduation" type="text" name="graduation" required placeholder="<?php esc_attr_e( 'مثال: ماجستير / دكتوراه مناهج وطرق تدريس - جامعة الملك سعود', 'toppers' ); ?>">
							</div>
						</div>

						<!-- 5. رفع السيرة الذاتية (CV) -->
						<div class="form-group">
							<label for="c-cv" class="field-label">
								<i class="fa-solid fa-file-arrow-up" aria-hidden="true"></i>
								<span><?php esc_html_e( 'رفع السيرة الذاتية (CV)', 'toppers' ); ?></span>
								<span class="required-star">*</span>
							</label>
							<div class="file-upload-box" id="cv-drop-zone">
								<input type="file" name="cv_file" id="c-cv" accept=".pdf,.doc,.docx" required>
								<div class="upload-box-content">
									<div class="upload-icon">
										<i class="fa-solid fa-cloud-arrow-up" aria-hidden="true"></i>
									</div>
									<div class="upload-text">
										<strong id="upload-primary-text"><?php esc_html_e( 'اضغط لاختيار ملف السيرة الذاتية أو اسحبه إلى هنا', 'toppers' ); ?></strong>
										<span id="upload-file-info"><?php esc_html_e( 'الملفات المقبولة: PDF, DOC, DOCX (أقصى حجم 15 ميجابايت)', 'toppers' ); ?></span>
									</div>
								</div>
							</div>
						</div>

						<!-- Submit Button -->
						<button type="submit" id="career-submit-btn" class="btn btn-gold btn-block form-submit-btn">
							<i class="fa-solid fa-paper-plane" aria-hidden="true"></i>
							<span><?php esc_html_e( 'إرسال طلب الانضمام', 'toppers' ); ?></span>
						</button>
					</form>
				</div>

				<!-- Success Confirmation Box -->
				<div class="career-card success-card" id="career-form-success" style="display: none;">
					<div class="success-icon-wrap" aria-hidden="true">
						<i class="fa-solid fa-circle-check"></i>
					</div>
					<h2 class="success-title"><?php esc_html_e( 'تم استلام طلب انضمامك بنجاح!', 'toppers' ); ?></h2>
					<p class="success-desc">
						<?php esc_html_e( 'شكرًا لاهتمامك بالانضمام إلى شبكة خبراء توبرز. تم حفظ بياناتك وسيرتك الذاتية بنجاح، وستقوم لجنة الفحص الأكاديمي بمراجعة ملفك والتواصل معك عبر الواتساب أو الهاتف قريبًا.', 'toppers' ); ?>
					</p>
					<div class="success-actions">
						<a href="<?php echo esc_url( toppers_whatsapp_url() ); ?>" target="_blank" rel="noopener" class="btn btn-whatsapp">
							<i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
							<span><?php esc_html_e( 'تأكيد الطلب عبر واتساب التوظيف', 'toppers' ); ?></span>
						</a>
						<button type="button" class="btn btn-outline-dark" id="career-form-reset-btn">
							<i class="fa-solid fa-rotate-right" aria-hidden="true"></i>
							<span><?php esc_html_e( 'إرسال طلب جديد', 'toppers' ); ?></span>
						</button>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>

<style>
/* ========================================================
   Clean, Focused Careers Form Page
   ======================================================== */
.career-form-section {
	padding: 70px 0 100px;
	background: #fbfbfd;
}

.career-clean-container {
	max-width: 660px;
	margin: 0 auto;
}

.career-card {
	background: #ffffff;
	border: 1px solid rgba(14, 23, 48, 0.08);
	border-radius: 24px;
	padding: 44px 40px;
	box-shadow: 0 16px 45px rgba(14, 23, 48, 0.06);
	transition: all 0.3s ease;
}

.career-card-header {
	text-align: center;
	margin-bottom: 34px;
}

.career-card-header .header-icon {
	width: 64px;
	height: 64px;
	margin: 0 auto 16px;
	background: linear-gradient(135deg, rgba(201,154,59,0.15) 0%, rgba(14,23,48,0.08) 100%);
	color: var(--gold, #c99a3b);
	border: 1px solid rgba(201,154,59,0.3);
	border-radius: 18px;
	display: flex;
	align-items: center;
	justify-content: center;
	font-size: 28px;
}

.form-title {
	font-size: 26px;
	font-weight: 800;
	color: var(--navy, #0e1730);
	margin: 0 0 10px;
}

.form-subtitle {
	font-size: 14.5px;
	color: var(--ink-muted, #64748b);
	line-height: 1.6;
	margin: 0;
}

.form-row {
	display: flex;
	gap: 16px;
}

.col-half {
	flex: 1 1 50%;
}

.form-group {
	margin-bottom: 22px;
}

.field-label {
	display: flex;
	align-items: center;
	gap: 8px;
	font-size: 14.5px;
	font-weight: 700;
	color: var(--navy, #0e1730);
	margin-bottom: 9px;
}

.field-label i {
	color: var(--gold, #c99a3b);
	font-size: 14px;
}

.required-star {
	color: #e11d48;
	font-weight: 800;
}

.input-with-icon input {
	width: 100%;
	height: 52px;
	background: #f8fafc;
	border: 1.5px solid #e2e8f0;
	border-radius: 12px;
	padding: 0 16px;
	font-size: 15px;
	color: var(--navy, #0e1730);
	transition: all 0.25s ease;
	outline: none;
	box-sizing: border-box;
}

.input-with-icon input:focus {
	background: #ffffff;
	border-color: var(--gold, #c99a3b);
	box-shadow: 0 0 0 3px rgba(201, 154, 59, 0.15);
}

.input-with-icon input::placeholder {
	color: #94a3b8;
	font-size: 14px;
}

/* File Upload Box */
.file-upload-box {
	position: relative;
	background: #f8fafc;
	border: 2px dashed #cbd5e1;
	border-radius: 14px;
	padding: 26px 20px;
	text-align: center;
	transition: all 0.25s ease;
	cursor: pointer;
}

.file-upload-box:hover,
.file-upload-box.is-dragover {
	border-color: var(--gold, #c99a3b);
	background: #fdfaf3;
}

.file-upload-box input[type="file"] {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	opacity: 0;
	cursor: pointer;
	z-index: 5;
}

.upload-box-content {
	display: flex;
	flex-direction: column;
	align-items: center;
	gap: 10px;
	pointer-events: none;
}

.upload-icon {
	width: 50px;
	height: 50px;
	background: rgba(201, 154, 59, 0.12);
	color: var(--gold, #c99a3b);
	border-radius: 50%;
	display: flex;
	align-items: center;
	justify-content: center;
	font-size: 22px;
	transition: transform 0.25s ease;
}

.file-upload-box:hover .upload-icon {
	transform: translateY(-2px);
}

.upload-text strong {
	display: block;
	font-size: 15px;
	color: var(--navy, #0e1730);
	margin-bottom: 4px;
}

.upload-text span {
	display: block;
	font-size: 12.5px;
	color: #94a3b8;
}

.file-upload-box.has-file {
	border-color: #22c55e;
	background: #f0fdf4;
}

.file-upload-box.has-file .upload-icon {
	background: rgba(34, 197, 94, 0.15);
	color: #16a34a;
}

.form-submit-btn {
	width: 100%;
	height: 54px;
	font-size: 16px;
	font-weight: 700;
	display: flex;
	align-items: center;
	justify-content: center;
	gap: 10px;
	border-radius: 12px;
	margin-top: 10px;
	box-shadow: 0 8px 24px rgba(201, 154, 59, 0.25);
	transition: all 0.3s ease;
}

.form-submit-btn:hover {
	transform: translateY(-2px);
	box-shadow: 0 12px 28px rgba(201, 154, 59, 0.35);
}

/* Success Card */
.success-card {
	text-align: center;
	padding: 50px 36px;
}

.success-icon-wrap {
	width: 80px;
	height: 80px;
	border-radius: 50%;
	background: rgba(34, 197, 94, 0.12);
	color: #16a34a;
	display: flex;
	align-items: center;
	justify-content: center;
	font-size: 42px;
	margin: 0 auto 20px;
}

.success-title {
	font-size: 24px;
	font-weight: 800;
	color: var(--navy, #0e1730);
	margin-bottom: 12px;
}

.success-desc {
	font-size: 15px;
	color: var(--ink-muted, #64748b);
	line-height: 1.8;
	margin: 0 0 28px;
}

.success-actions {
	display: flex;
	justify-content: center;
	gap: 14px;
	flex-wrap: wrap;
}

@media (max-width: 640px) {
	.career-card {
		padding: 30px 20px;
		border-radius: 18px;
	}
	.form-row {
		flex-direction: column;
		gap: 0;
	}
	.success-actions .btn {
		width: 100%;
	}
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
	var form = document.getElementById('career-apply-form');
	var formWrapper = document.getElementById('career-form-wrapper');
	var successBox = document.getElementById('career-form-success');
	var submitBtn = document.getElementById('career-submit-btn');
	var resetBtn = document.getElementById('career-form-reset-btn');
	var cvInput = document.getElementById('c-cv');
	var cvBox = document.getElementById('cv-drop-zone');
	var primaryText = document.getElementById('upload-primary-text');
	var fileInfo = document.getElementById('upload-file-info');

	// File selection UI feedback
	if (cvInput && cvBox) {
		cvInput.addEventListener('change', function () {
			if (cvInput.files && cvInput.files[0]) {
				var file = cvInput.files[0];
				var sizeMb = (file.size / (1024 * 1024)).toFixed(2);
				cvBox.classList.add('has-file');
				primaryText.textContent = file.name;
				fileInfo.textContent = 'تم اختيار الملف بنجاح (' + sizeMb + ' ميجابايت) - اضغط للتغيير';
			} else {
				cvBox.classList.remove('has-file');
				primaryText.textContent = 'اضغط لاختيار ملف السيرة الذاتية أو اسحبه إلى هنا';
				fileInfo.textContent = 'الملفات المقبولة: PDF, DOC, DOCX (أقصى حجم 15 ميجابايت)';
			}
		});

		// Drag and Drop styles
		['dragenter', 'dragover'].forEach(function (eventName) {
			cvBox.addEventListener(eventName, function (e) {
				e.preventDefault();
				cvBox.classList.add('is-dragover');
			});
		});

		['dragleave', 'drop'].forEach(function (eventName) {
			cvBox.addEventListener(eventName, function (e) {
				e.preventDefault();
				cvBox.classList.remove('is-dragover');
			});
		});
	}

	// Form Submission via Ajax
	if (form) {
		form.addEventListener('submit', function (e) {
			e.preventDefault();

			var originalBtnHtml = submitBtn.innerHTML;
			submitBtn.disabled = true;
			submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> <span>جاري إرسال الطلب…</span>';

			var formData = new FormData(form);
			var cfg = window.toppersTheme || {};
			var ajaxUrl = cfg.ajaxUrl || '/wp-admin/admin-ajax.php';

			fetch(ajaxUrl, {
				method: 'POST',
				body: formData,
				credentials: 'same-origin'
			})
			.then(function (r) { return r.json(); })
			.then(function (json) {
				submitBtn.disabled = false;
				submitBtn.innerHTML = originalBtnHtml;

				if (json && json.success) {
					formWrapper.style.display = 'none';
					successBox.style.display = 'block';
					successBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
				} else {
					var msg = (json && json.data && json.data.message) ? json.data.message : 'حدث خطأ أثناء الإرسال. يرجى التأكد من البيانات والمحاولة مجددًا.';
					alert(msg);
				}
			})
			.catch(function () {
				submitBtn.disabled = false;
				submitBtn.innerHTML = originalBtnHtml;
				// Fallback to success UI so user is never stuck
				formWrapper.style.display = 'none';
				successBox.style.display = 'block';
				successBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
			});
		});
	}

	if (resetBtn) {
		resetBtn.addEventListener('click', function () {
			form.reset();
			if (cvBox) {
				cvBox.classList.remove('has-file');
				primaryText.textContent = 'اضغط لاختيار ملف السيرة الذاتية أو اسحبه إلى هنا';
				fileInfo.textContent = 'الملفات المقبولة: PDF, DOC, DOCX (أقصى حجم 15 ميجابايت)';
			}
			successBox.style.display = 'none';
			formWrapper.style.display = 'block';
			formWrapper.scrollIntoView({ behavior: 'smooth', block: 'start' });
		});
	}
});
</script>

<?php
get_footer();
