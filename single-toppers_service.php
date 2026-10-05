<?php
/**
 * Single service.
 *
 * @package Toppers
 */

get_header();

$check_icon = '<i class="fa-solid fa-circle-check" aria-hidden="true"></i>';
$checks     = array(
	__( 'تنفيذ بمنهجية علمية سليمة ومصادر موثوقة.', 'toppers' ),
	__( 'توافق مع دليل جامعتك ونظام التوثيق المطلوب.', 'toppers' ),
	__( 'مراجعة جودة قبل التسليم مع إمكانية التعديلات.', 'toppers' ),
	__( 'سرية تامة لبياناتك وأبحاثك.', 'toppers' ),
);
$steps      = array(
	__( 'استلام الطلب ودراسة المتطلبات بدقة.', 'toppers' ),
	__( 'إسناد العمل لمتخصص في نفس المجال.', 'toppers' ),
	__( 'التنفيذ ومراجعة الجودة الداخلية.', 'toppers' ),
	__( 'التسليم في الموعد مع دعم التعديلات.', 'toppers' ),
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

		$badge    = get_post_meta( get_the_ID(), '_toppers_badge', true );
		$price    = get_post_meta( get_the_ID(), '_toppers_price', true );
		$svc_img  = toppers_service_image( get_the_ID() );
		$terms    = get_the_terms( get_the_ID(), 'service_category' );
		$term     = ( $terms && ! is_wp_error( $terms ) ) ? $terms[0] : null;
		$excerpt  = get_the_excerpt() ?: __( 'إعداد العمل بمنهجية علمية سليمة ومصادر موثوقة، مع التزام تام بالمعايير الأكاديمية والسرية المطلقة.', 'toppers' );
		?>
		<section class="single-svc-hero">
			<div class="container single-svc-hero-grid">
				<div class="single-svc-hero-text">
					<nav class="breadcrumb" aria-label="<?php esc_attr_e( 'مسار التنقل', 'toppers' ); ?>">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'الرئيسية', 'toppers' ); ?></a>
						<span>/</span>
						<a href="<?php echo esc_url( toppers_page_url( 'services' ) ); ?>"><?php esc_html_e( 'الخدمات', 'toppers' ); ?></a>
						<?php if ( $term ) : ?>
							<span>/</span>
							<a href="<?php echo esc_url( toppers_page_url( 'services' ) . '#cat-' . rawurlencode( $term->slug ) ); ?>"><?php echo esc_html( $term->name ); ?></a>
						<?php endif; ?>
						<span>/</span>
						<span><?php the_title(); ?></span>
					</nav>
					<div class="eyebrow"><?php echo toppers_star_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php echo esc_html( $badge ? $badge : ( $term ? $term->name : __( 'خدمات توبرز', 'toppers' ) ) ); ?></span></div>
					<h1><?php the_title(); ?></h1>
					<p class="single-svc-lede"><?php echo esc_html( $excerpt ); ?></p>
					<div class="single-svc-actions">
						<button class="btn btn-gold open-order-modal" type="button" data-service="<?php echo esc_attr( get_the_title() ); ?>" data-service-id="<?php echo (int) get_the_ID(); ?>">
							<?php esc_html_e( 'اطلب الخدمة الآن', 'toppers' ); ?>
						</button>
						<a class="btn btn-whatsapp" href="<?php echo esc_url( toppers_whatsapp_url() ); ?>" target="_blank" rel="noopener">
							<i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
							<?php esc_html_e( 'واتساب', 'toppers' ); ?>
						</a>
					</div>
				</div>
				<figure class="single-svc-media">
					<img src="<?php echo esc_url( $svc_img ); ?>" alt="<?php the_title_attribute(); ?>" loading="eager">
					<?php if ( $badge ) : ?>
						<span class="single-svc-media-badge"><?php echo esc_html( $badge ); ?></span>
					<?php endif; ?>
				</figure>
			</div>
		</section>

		<section class="section single-svc-sec">
			<div class="container single-svc-layout">
				<div class="single-svc-main">
					<?php if ( get_the_content() ) : ?>
						<div class="entry-content"><?php the_content(); ?></div>
					<?php else : ?>
						<h2><?php esc_html_e( 'عن الخدمة', 'toppers' ); ?></h2>
						<p><?php echo esc_html( $excerpt ); ?></p>
						<p><?php esc_html_e( 'فريقنا المتخصص من الباحثين الأكاديميين يضمن لك عملاً أصيلاً وخالياً من الاستلال، مع الالتزام التام بشروط ومتطلبات جامعتك وتوجيهات مشرفك الأكاديمي.', 'toppers' ); ?></p>
					<?php endif; ?>

					<div class="single-svc-block">
						<h2><?php esc_html_e( 'ماذا نقدم في هذه الخدمة؟', 'toppers' ); ?></h2>
						<ul class="check-list">
							<?php foreach ( $checks as $check ) : ?>
								<li><?php echo $check_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php echo esc_html( $check ); ?></span></li>
							<?php endforeach; ?>
						</ul>
					</div>

					<div class="single-svc-steps">
						<h3><?php esc_html_e( 'مراحل التنفيذ', 'toppers' ); ?></h3>
						<ol>
							<?php foreach ( $steps as $i => $step ) : ?>
								<li>
									<span class="single-svc-step-num"><?php echo esc_html( (string) ( $i + 1 ) ); ?></span>
									<span><?php echo esc_html( $step ); ?></span>
								</li>
							<?php endforeach; ?>
						</ol>
					</div>
				</div>

				<aside class="svc-order">
					<div class="svc-order-inner">
						<?php if ( $price ) : ?>
							<p class="svc-order-price"><?php echo esc_html( $price ); ?></p>
						<?php endif; ?>
						<h4><?php esc_html_e( 'احجز الخدمة الآن', 'toppers' ); ?></h4>
						<p class="svc-order-note"><?php esc_html_e( 'اختر طريقة الطلب المناسبة لك وسنبدأ مباشرة.', 'toppers' ); ?></p>
						<?php get_template_part( 'template-parts/request-paths', null, array( 'service' => get_the_title(), 'service_id' => get_the_ID() ) ); ?>
					</div>
				</aside>
			</div>
		</section>

		<section class="section section--alt">
			<div class="container">
				<div class="section-head">
					<div class="eyebrow"><?php echo toppers_star_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'خدمات أخرى', 'toppers' ); ?></span></div>
					<h2><?php esc_html_e( 'قد يهمك أيضاً', 'toppers' ); ?></h2>
				</div>
				<div class="grid grid-3">
					<?php
					$related_args = array(
						'post_type'      => 'toppers_service',
						'posts_per_page' => 3,
						'post__not_in'   => array( get_the_ID() ),
						'orderby'        => 'menu_order title',
						'order'          => 'ASC',
					);
					if ( $term ) {
						$related_args['tax_query'] = array(
							array(
								'taxonomy' => 'service_category',
								'field'    => 'term_id',
								'terms'    => (int) $term->term_id,
							),
						);
					}
					$related = new WP_Query( $related_args );
					if ( $related->have_posts() ) {
						while ( $related->have_posts() ) {
							$related->the_post();
							get_template_part( 'template-parts/card-service' );
						}
						wp_reset_postdata();
					}
					?>
				</div>
				<div class="center" style="margin-top:36px">
					<a class="btn btn-outline-dark" href="<?php echo esc_url( toppers_page_url( 'services' ) ); ?>"><?php esc_html_e( 'عرض كل الخدمات', 'toppers' ); ?></a>
				</div>
			</div>
		</section>
		<?php
	endwhile;
	?>
</main>
<?php
get_footer();
