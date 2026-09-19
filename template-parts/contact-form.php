<?php
/**
 * Contact form + info.
 *
 * @package Toppers
 */
?>
<section class="section">
	<div class="container split" style="align-items:flex-start">
		<div class="form-card reveal">
			<div class="form-card-inner">
				<h3 style="margin-bottom:18px"><?php esc_html_e( 'اطلب خدمتك', 'toppers' ); ?></h3>
				<?php get_template_part( 'template-parts/request-paths' ); ?>
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

