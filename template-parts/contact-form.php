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
				<div class="info-ic-premium"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3-8.7A2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .3 2 .6 3a2 2 0 0 1-.5 2.1L8 10a16 16 0 0 0 6 6l1.2-1.2a2 2 0 0 1 2.1-.5c1 .3 2 .5 3 .6a2 2 0 0 1 1.7 2z" /></svg></div>
				<div class="info-details">
					<h4><?php esc_html_e( 'الهاتف / واتساب', 'toppers' ); ?></h4>
					<p dir="ltr"><?php echo esc_html( toppers_phone() ); ?></p>
				</div>
			</a>
			<a href="mailto:<?php echo esc_attr( toppers_email() ); ?>" class="info-card-premium">
				<div class="info-ic-premium"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="4" width="20" height="16" rx="2" /><path d="M22 6l-10 7L2 6" /></svg></div>
				<div class="info-details">
					<h4><?php esc_html_e( 'البريد الإلكتروني', 'toppers' ); ?></h4>
					<p dir="ltr"><?php echo esc_html( toppers_email() ); ?></p>
				</div>
			</a>
			<div class="info-card-premium">
				<div class="info-ic-premium"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9" /><path d="M12 7v5l3 3" /></svg></div>
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

