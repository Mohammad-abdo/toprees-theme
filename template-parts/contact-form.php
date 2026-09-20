<?php
/**
 * Contact form + info.
 *
 * @package Toppers
 */

$prefill_topic   = isset( $_GET['topic'] ) ? sanitize_text_field( wp_unslash( (string) $_GET['topic'] ) ) : '';
$prefill_major   = isset( $_GET['major'] ) ? sanitize_text_field( wp_unslash( (string) $_GET['major'] ) ) : '';
$prefill_degree  = isset( $_GET['degree'] ) ? sanitize_text_field( wp_unslash( (string) $_GET['degree'] ) ) : '';
$prefill_service = isset( $_GET['service'] ) ? sanitize_text_field( wp_unslash( (string) $_GET['service'] ) ) : '';
$prefill_details = trim(
	implode(
		"\n",
		array_filter(
			array(
				$prefill_topic ? 'عنوان البحث: ' . $prefill_topic : '',
				$prefill_major ? 'التخصص: ' . $prefill_major : '',
				$prefill_degree ? 'المرحلة: ' . $prefill_degree : '',
			)
		)
	)
);
?>
<section class="section">
	<div class="container split" style="align-items:flex-start">
		<div class="form-card reveal">
			<div class="form-card-inner">
				<h3 style="margin-bottom:18px"><?php esc_html_e( 'اطلب خدمتك', 'toppers' ); ?></h3>
				<?php get_template_part( 'template-parts/request-paths' ); ?>

				<hr class="request-paths-divider" style="border:0;border-top:1px solid var(--line);margin:28px 0 22px">

				<p style="margin:0 0 16px;font-size:14px;color:var(--ink-muted)"><?php esc_html_e( 'أو اترك بياناتك وسنتواصل معك — يُحفظ الطلب كعميل محتمل في المنصة.', 'toppers' ); ?></p>

				<form id="request-form" method="post" action="">
					<div class="field-row">
						<div class="field">
							<label for="cf-name"><?php esc_html_e( 'الاسم الكامل', 'toppers' ); ?></label>
							<input id="cf-name" type="text" name="name" required autocomplete="name">
						</div>
						<div class="field">
							<label for="cf-phone"><?php esc_html_e( 'الجوال / واتساب', 'toppers' ); ?></label>
							<input id="cf-phone" type="tel" name="phone" required autocomplete="tel" dir="ltr">
						</div>
					</div>
					<div class="field-row">
						<div class="field">
							<label for="cf-email"><?php esc_html_e( 'البريد الإلكتروني', 'toppers' ); ?></label>
							<input id="cf-email" type="email" name="email" autocomplete="email" dir="ltr">
						</div>
						<div class="field">
							<label for="cf-level"><?php esc_html_e( 'المرحلة الدراسية', 'toppers' ); ?></label>
							<select id="cf-level" name="level">
								<option value=""><?php esc_html_e( 'اختر المرحلة', 'toppers' ); ?></option>
								<?php
								$level_opts = array(
									'بكالوريوس' => array( 'بكالوريوس', 'Bachelor' ),
									'ماجستير'   => array( 'ماجستير', 'Master' ),
									'دكتوراه'   => array( 'دكتوراه', 'PhD' ),
									'أخرى'      => array( 'أخرى', 'Other' ),
								);
								foreach ( $level_opts as $label => $aliases ) :
									$is_sel = in_array( $prefill_degree, $aliases, true ) || $prefill_degree === $label;
									?>
									<option value="<?php echo esc_attr( $label ); ?>" <?php selected( $is_sel ); ?>><?php echo esc_html( $label ); ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="field-row">
						<div class="field">
							<label for="cf-service"><?php esc_html_e( 'الخدمة المطلوبة', 'toppers' ); ?></label>
							<input id="cf-service" type="text" name="service" value="<?php echo esc_attr( $prefill_service ); ?>" placeholder="<?php esc_attr_e( 'مثال: رسالة ماجستير', 'toppers' ); ?>">
						</div>
						<div class="field">
							<label for="cf-deadline"><?php esc_html_e( 'الموعد المطلوب', 'toppers' ); ?></label>
							<input id="cf-deadline" type="text" name="deadline" placeholder="<?php esc_attr_e( 'مثال: خلال أسبوعين', 'toppers' ); ?>">
						</div>
					</div>
					<div class="field">
						<label for="cf-details"><?php esc_html_e( 'تفاصيل إضافية', 'toppers' ); ?></label>
						<textarea id="cf-details" name="details" rows="4" placeholder="<?php esc_attr_e( 'موضوع البحث، تعليمات الجامعة، أو أي ملاحظات…', 'toppers' ); ?>"><?php echo esc_textarea( $prefill_details ); ?></textarea>
					</div>
					<p class="form-note"><?php esc_html_e( 'بياناتك تُستخدم للتواصل بخصوص طلبك فقط.', 'toppers' ); ?></p>
					<button type="submit" class="btn btn-gold btn-block"><?php esc_html_e( 'إرسال الطلب', 'toppers' ); ?></button>
				</form>
			</div>
			<div class="form-success">
				<div class="check" aria-hidden="true"><i class="fa-solid fa-check"></i></div>
				<h3><?php esc_html_e( 'تم استلام طلبك', 'toppers' ); ?></h3>
				<p><?php esc_html_e( 'سيتواصل معك فريق توبرز قريبًا.', 'toppers' ); ?></p>
				<button type="button" class="btn btn-outline-dark" data-form-reset><?php esc_html_e( 'إرسال طلب آخر', 'toppers' ); ?></button>
			</div>
		</div>
		<div>
			<h3 style="margin-bottom:22px"><?php esc_html_e( 'معلومات التواصل', 'toppers' ); ?></h3>
			<a href="<?php echo esc_url( toppers_whatsapp_url() ); ?>" target="_blank" rel="noopener" class="info-card-premium">
				<div class="info-ic-premium"><i class="fa-brands fa-whatsapp" style="font-size:22px;" aria-hidden="true"></i></div>
				<div class="info-details">
					<h4><?php esc_html_e( 'الهاتف / واتساب', 'toppers' ); ?></h4>
					<p dir="ltr"><?php echo esc_html( toppers_phone() ); ?></p>
				</div>
			</a>
			<a href="mailto:<?php echo esc_attr( toppers_email() ); ?>" class="info-card-premium">
				<div class="info-ic-premium"><i class="fa-solid fa-envelope" style="font-size:20px;" aria-hidden="true"></i></div>
				<div class="info-details">
					<h4><?php esc_html_e( 'البريد الإلكتروني', 'toppers' ); ?></h4>
					<p dir="ltr"><?php echo esc_html( toppers_email() ); ?></p>
				</div>
			</a>
			<div class="info-card-premium">
				<div class="info-ic-premium"><i class="fa-regular fa-clock" style="font-size:20px;" aria-hidden="true"></i></div>
				<div class="info-details">
					<h4><?php esc_html_e( 'ساعات العمل', 'toppers' ); ?></h4>
					<p><?php echo esc_html( toppers_hours() ); ?></p>
				</div>
			</div>
			<a href="<?php echo esc_url( toppers_whatsapp_url() ); ?>" target="_blank" rel="noopener" class="btn btn-gold btn-block" style="margin-top:10px"><?php esc_html_e( 'تواصل عبر واتساب', 'toppers' ); ?></a>
		</div>
	</div>
</section>
<section class="section section--alt">
	<div class="container" style="max-width:820px">
		<div class="section-head center">
			<div class="eyebrow"><?php echo toppers_star_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'الأسئلة الشائعة', 'toppers' ); ?></span></div>
			<h2><?php esc_html_e( 'إجابات عن أكثر الأسئلة تكرارًا', 'toppers' ); ?></h2>
		</div>
		<?php
		$minis = array(
			array( 'ما المعلومات التي أحتاج تقديمها؟', 'موضوع بحثك، المرحلة الدراسية، الخدمة المطلوبة، وأي ملفات أو تعليمات من جامعتك.' ),
			array( 'كم تستغرق مدة التنفيذ؟', 'تختلف المدة حسب نوع الخدمة وحجم العمل، ونحددها بوضوح عند إرسال عرض السعر.' ),
			array( 'هل يمكنني طلب تعديلات؟', 'نعم، يمكنك طلب مراجعات على العمل المسلَّم وفق سياسة التعديلات المتفق عليها.' ),
			array( 'ما صيغ الملفات المدعومة؟', 'نستقبل ونسلّم بصيغ PDF وWord وExcel وPowerPoint وغيرها حسب طبيعة الخدمة.' ),
			array( 'كيف يتم تحديد السعر؟', 'يعتمد السعر على المرحلة الدراسية وعدد الصفحات وتعقيد البحث والموعد المطلوب.' ),
			array( 'هل يمكنني طلب تسليم عاجل؟', 'نعم، نوفر خيار التسليم العاجل مقابل رسوم إضافية حسب توفر الفريق.' ),
		);
		foreach ( $minis as $i => $faq ) {
			echo '<div class="faq-item' . ( 0 === $i ? ' is-open' : '' ) . '"><div class="faq-q"><span>' . esc_html( $faq[0] ) . '</span><span class="plus"></span></div><div class="faq-a"><p>' . esc_html( $faq[1] ) . '</p></div></div>';
		}
		?>
	</div>
</section>
