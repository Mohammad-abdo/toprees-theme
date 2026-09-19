<?php
/**
 * Single service matching final-v.1/single-service.html.
 *
 * @package Toppers
 */

get_header();
$check_icon = '<i class="fa-solid fa-circle-check" aria-hidden="true" style="font-size: 24px; color: var(--gold);"></i>';
$checks     = array(
	'صياغة خطة البحث المبدئية (Proposal).',
	'توفير أحدث المصادر والمراجع العربية والأجنبية.',
	'تنسيق البحث حسب نظام التوثيق المطلوب (APA, MLA, Harvard).',
	'المراجعة اللغوية والتدقيق النحوي لضمان سلامة النص.',
);
$steps      = array(
	'استلام الطلب ودراسة المتطلبات بدقة.',
	'إسناد البحث لباحث متخصص في نفس المجال.',
	'إعداد البحث ومراجعته من قسم الجودة.',
	'التسليم في الموعد، مع الاستعداد لأي تعديلات يطلبها المشرف.',
);
?>
<main class="site-main">
	<?php
	while ( have_posts() ) :
		the_post();
		if ( toppers_is_elementor_page() ) {
			the_content();
			continue;
		}
		$badge = get_post_meta( get_the_ID(), '_toppers_badge', true );
		$extra = '<div style="margin-top: 40px; display: flex; gap: 16px; flex-wrap: wrap;"><button class="btn btn-gold open-order-modal" type="button" data-service="' . esc_attr( get_the_title() ) . '">اطلب الخدمة الآن</button><a href="' . esc_url( toppers_whatsapp_url() ) . '" target="_blank" rel="noopener" class="btn btn-outline" style="border-color: rgba(255,255,255,0.3); color: #fff;">تواصل عبر واتساب</a></div>';
		get_template_part(
			'template-parts/page-hero',
			null,
			array(
				'title'   => get_the_title(),
				'lede'    => get_the_excerpt() ?: __( 'إعداد العمل بمنهجية علمية سليمة ومصادر موثوقة، مع التزام تام بالمعايير الأكاديمية والسرية المطلقة.', 'toppers' ),
				'eyebrow' => $badge ?: __( 'خدمات توبرز', 'toppers' ),
				'image'   => toppers_photo( 'single-hero' ),
				'parent'  => array( __( 'الخدمات', 'toppers' ), toppers_page_url( 'services' ) ),
				'extra'   => $extra,
			)
		);
		?>
		<section class="section" style="padding-top: 80px; padding-bottom: 80px;">
			<div class="container">
				<div class="split" style="align-items: flex-start; gap: 60px;">
					<div style="flex: 2;">
						<?php if ( get_the_content() ) : ?>
							<div class="entry-content"><?php the_content(); ?></div>
						<?php else : ?>
							<h2 style="font-size: 28px; margin-bottom: 24px; color: var(--navy);"><?php esc_html_e( 'عن الخدمة', 'toppers' ); ?></h2>
							<p style="font-size: 16px; line-height: 1.8; color: var(--ink-faint); margin-bottom: 24px;"><?php echo esc_html( get_the_excerpt() ?: 'تعتبر هذه الخدمة ركيزة أساسية في التقييم الأكاديمي، وتتطلب وقتاً وجهداً ومهارة في صياغة المحتوى العلمي. نحن في توبرز نوفرها بأعلى معايير الجودة، مستندين إلى أحدث المصادر والمراجع العلمية.' ); ?></p>
							<p style="font-size: 16px; line-height: 1.8; color: var(--ink-faint); margin-bottom: 40px;"><?php esc_html_e( 'فريقنا المتخصص من الباحثين الأكاديميين يضمن لك عملاً أصيلاً وخالياً من الاستلال (Plagiarism)، مع الالتزام التام بشروط ومتطلبات جامعتك وتوجيهات مشرفك الأكاديمي.', 'toppers' ); ?></p>
						<?php endif; ?>
						<h2 style="font-size: 28px; margin-bottom: 24px; color: var(--navy);"><?php esc_html_e( 'ماذا نقدم في هذه الخدمة؟', 'toppers' ); ?></h2>
						<ul class="check-list" style="list-style: none; padding: 0; margin-bottom: 40px;">
							<?php foreach ( $checks as $check ) : ?>
								<li><?php echo $check_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> <?php echo esc_html( $check ); ?></li>
							<?php endforeach; ?>
						</ul>
						<div style="background: rgba(201,154,59,0.05); border: 1px solid rgba(201,154,59,0.2); padding: 32px; border-radius: 20px;">
							<h3 style="font-size: 20px; color: var(--navy); margin-bottom: 16px;"><?php esc_html_e( 'مراحل التنفيذ', 'toppers' ); ?></h3>
							<ol style="margin-right: 20px; font-size: 15px; color: var(--ink); line-height: 1.8;">
								<?php foreach ( $steps as $step ) : ?>
									<li style="margin-bottom: 8px;"><?php echo esc_html( $step ); ?></li>
								<?php endforeach; ?>
							</ol>
						</div>
					</div>
					<div class="svc-order" style="flex: 1;">
						<div class="form-card-inner">
							<h4 style="font-size: 18px; margin-bottom: 18px; color: var(--navy);"><?php esc_html_e( 'احجز الخدمة الآن', 'toppers' ); ?></h4>
							<?php get_template_part( 'template-parts/request-paths', null, array( 'service' => get_the_title() ) ); ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php
	endwhile;
	?>
</main>
<?php
get_footer();
