<?php
/**
 * Services listing.
 *
 * @package Toppers
 */

$menu_arrow = '<i class="fa-solid fa-chevron-left" aria-hidden="true"></i>';

get_template_part(
	'template-parts/page-hero',
	null,
	toppers_hero_args(
		'services',
		array(
			'title'   => __( 'حلول أكاديمية متكاملة تُساند رحلتك البحثية من الفكرة وحتى المناقشة.', 'toppers' ),
			'lede'    => __( 'نضع بين يديك أكثر من 20 خدمة بحثية وإحصائية مُتخصصة، تُنفَّذ بأيدي نخبة من حملة الدكتوراه والخبراء، وفق معايير الرصانة العلمية ودليل جامعتك المعتمد.', 'toppers' ),
			'eyebrow' => __( 'دليل الخدمات الشامل', 'toppers' ),
			'image'   => toppers_photo( 'campus' ),
			'center'  => true,
			'orbs'    => true,
		)
	)
);

$terms = get_terms(
	array(
		'taxonomy'   => 'service_category',
		'hide_empty' => true,
	)
);

if ( ! is_wp_error( $terms ) && $terms ) {
	usort(
		$terms,
		static function ( $a, $b ) {
			$oa = (int) get_term_meta( $a->term_id, '_toppers_order', true );
			$ob = (int) get_term_meta( $b->term_id, '_toppers_order', true );
			if ( $oa === $ob ) {
				return strcasecmp( $a->name, $b->name );
			}
			return $oa <=> $ob;
		}
	);
}
?>
<section class="section services-page-sec">
	<div class="container">
		<div class="services-layout">
			<aside class="services-sidebar">
				<h3><?php esc_html_e( 'أقسام الخدمات', 'toppers' ); ?></h3>
				<ul class="services-menu" id="servicesMenu">
					<?php
					if ( ! is_wp_error( $terms ) && $terms ) {
						foreach ( $terms as $i => $term ) {
							echo '<li><a href="#cat-' . esc_attr( $term->slug ) . '"' . ( 0 === $i ? ' class="active"' : '' ) . '><span>' . esc_html( $term->name ) . '</span> ' . $menu_arrow . '</a></li>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						}
					}
					?>
				</ul>

				<div class="services-side-cta">
					<h4><?php esc_html_e( 'لم تجد ما تبحث عنه؟', 'toppers' ); ?></h4>
					<p><?php esc_html_e( 'اطلب خدمة مخصصة تناسب بحثك، أو خدمة تنفيذ ملاحظات المشرف على بحث جاهز.', 'toppers' ); ?></p>
					<button class="btn btn-gold btn-block btn-sm open-order-modal" type="button" data-service="<?php esc_attr_e( 'خدمة مخصصة', 'toppers' ); ?>">
						<?php esc_html_e( 'طلب خدمة مخصصة', 'toppers' ); ?>
					</button>
					<button class="btn btn-outline-dark btn-block btn-sm open-order-modal" type="button" data-service="<?php esc_attr_e( 'تنفيذ ملاحظات وتعديلات على بحث جاهز', 'toppers' ); ?>" style="margin-top:10px;">
						<?php esc_html_e( 'تعديلات على بحث جاهز', 'toppers' ); ?>
					</button>
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
								'orderby'        => 'menu_order title',
								'order'          => 'ASC',
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
						echo '<div class="service-section" id="cat-' . esc_attr( $term->slug ) . '">';
						echo '<h2>' . esc_html( $term->name ) . '</h2>';
						if ( $term->description ) {
							echo '<p class="cat-desc">' . esc_html( $term->description ) . '</p>';
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
					$q = new WP_Query(
						array(
							'post_type'      => 'toppers_service',
							'posts_per_page' => -1,
							'orderby'        => 'menu_order title',
							'order'          => 'ASC',
						)
					);
					echo '<div class="grid grid-2">';
					while ( $q->have_posts() ) {
						$q->the_post();
						get_template_part( 'template-parts/card-service' );
					}
					echo '</div>';
					wp_reset_postdata();
				}
				?>

				<div class="services-custom-band">
					<div>
						<h3><?php esc_html_e( 'خدمة مخصصة أو تعديلات على بحث جاهز', 'toppers' ); ?></h3>
						<p><?php esc_html_e( 'إن لم تجد الخدمة ضمن القائمة، صمّم طلبك معنا — أو أرسل ملاحظات المشرف لننفّذ التعديلات على بحثك الحالي.', 'toppers' ); ?></p>
					</div>
					<div class="services-custom-actions">
						<button class="btn btn-gold open-order-modal" type="button" data-service="<?php esc_attr_e( 'خدمة مخصصة', 'toppers' ); ?>">
							<?php esc_html_e( 'طلب خدمة مخصصة', 'toppers' ); ?>
						</button>
						<a class="btn btn-whatsapp" href="<?php echo esc_url( toppers_whatsapp_url() ); ?>" target="_blank" rel="noopener">
							<i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
							<?php esc_html_e( 'واتساب', 'toppers' ); ?>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
