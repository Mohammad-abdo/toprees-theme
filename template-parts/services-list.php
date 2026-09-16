<?php
/**
 * Services listing matching final-v.1/services.html.
 *
 * @package Toppers
 */

$menu_arrow = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>';
$fallback_desc = array(
	'الطلاب الجامعيين'     => 'دعم أكاديمي متكامل لطلاب البكالوريوس لضمان التفوق في المقررات، إعداد التقارير، والبحوث الجامعية بكفاءة عالية وبدون أي نسبة استلال.',
	'الدراسات العليا'       => 'خدمات احترافية تلبي دقة وصرامة مرحلة الدراسات العليا، تبدأ من اقتراح العناوين وحتى المناقشة النهائية للرسالة.',
	'منهجية البحث العلمي'   => 'أدوات مساعدة لضمان جودة الأبحاث، تشمل جمع البيانات، التحليل الإحصائي الدقيق، والمراجعة النقدية للدراسات السابقة.',
	'الكتابة والنشر'        => 'خدمات لغوية متقدمة ونشر في المجلات العلمية المحكمة عالمياً (Scopus, ISI) للترقية الأكاديمية.',
);

get_template_part(
	'template-parts/page-hero',
	null,
	toppers_hero_args(
		'services',
		array(
			'title'   => __( 'اكتشف خدمات توبرز الأكاديمية', 'toppers' ),
			'lede'    => __( 'نقدم لك مجموعة متكاملة من الخدمات البحثية والأكاديمية المصممة بعناية فائقة لتلبية احتياجاتك، من المرحلة الجامعية وحتى نشر الأبحاث في المجلات العالمية.', 'toppers' ),
			'eyebrow' => __( 'دليل الخدمات الشامل', 'toppers' ),
			'image'   => toppers_photo( 'campus' ),
			'center'  => true,
			'orbs'    => true,
		)
	)
);
?>
<section class="section" style="padding-top: 80px; padding-bottom: 100px;">
	<div class="container">
		<div class="services-layout">
			<aside class="services-sidebar">
				<h3><?php esc_html_e( 'الفئات الأكاديمية', 'toppers' ); ?></h3>
				<ul class="services-menu" id="servicesMenu">
					<?php
					$terms = get_terms( array( 'taxonomy' => 'service_category', 'hide_empty' => false ) );
					if ( ! is_wp_error( $terms ) && $terms ) {
						foreach ( $terms as $i => $term ) {
							echo '<li><a href="#cat-' . esc_attr( $term->slug ) . '"' . ( 0 === $i ? ' class="active"' : '' ) . '><span>' . esc_html( $term->name ) . '</span> ' . $menu_arrow . '</a></li>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						}
					}
					?>
				</ul>
				<div style="margin-top: 32px; padding: 24px; background: rgba(201,154,59,0.1); border-radius: 16px; border: 1px solid rgba(201,154,59,0.2); text-align: center;">
					<h4 style="font-size: 16px; color: var(--navy); margin-bottom: 12px;"><?php esc_html_e( 'لم تجد ما تبحث عنه؟', 'toppers' ); ?></h4>
					<p style="font-size: 13.5px; color: var(--ink-faint); margin-bottom: 16px;"><?php esc_html_e( 'فريقنا جاهز لتصميم خدمة مخصصة تناسب بحثك بالضبط.', 'toppers' ); ?></p>
					<button class="btn btn-gold btn-block btn-sm open-order-modal" type="button"><?php esc_html_e( 'طلب استشارة مجانية', 'toppers' ); ?></button>
				</div>
			</aside>
			<div class="services-content">
				<?php
				if ( ! is_wp_error( $terms ) && $terms ) {
					foreach ( $terms as $term ) {
						$q = new WP_Query(
							array(
								'post_type'      => 'toppers_service',
								'posts_per_page' => -1,
								'tax_query'      => array(
									array(
										'taxonomy' => 'service_category',
										'field'    => 'term_id',
										'terms'    => $term->term_id,
									),
								),
							)
						);
						if ( ! $q->have_posts() ) {
							continue;
						}
						$desc = $term->description ? $term->description : ( $fallback_desc[ $term->name ] ?? '' );
						echo '<div class="service-section" id="cat-' . esc_attr( $term->slug ) . '">';
						echo '<h2>' . esc_html( $term->name ) . '</h2>';
						if ( $desc ) {
							echo '<p class="cat-desc">' . esc_html( $desc ) . '</p>';
						}
						echo '<div class="grid grid-2">';
						while ( $q->have_posts() ) {
							$q->the_post();
							get_template_part( 'template-parts/card-service' );
						}
						echo '</div></div>';
						wp_reset_postdata();
					}
				} else {
					$q = new WP_Query( array( 'post_type' => 'toppers_service', 'posts_per_page' => -1 ) );
					echo '<div class="grid grid-2">';
					while ( $q->have_posts() ) {
						$q->the_post();
						get_template_part( 'template-parts/card-service' );
					}
					echo '</div>';
					wp_reset_postdata();
				}
				?>
			</div>
		</div>
	</div>
</section>
