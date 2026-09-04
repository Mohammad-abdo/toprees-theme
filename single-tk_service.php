<?php
/**
 * Single service — matches single-service.html.
 *
 * @package Tek_Craft_Toppres
 */

get_header();

while ( have_posts() ) :
	the_post();
	$cover   = get_the_post_thumbnail_url( get_the_ID(), 'full' );
	$excerpt = get_the_excerpt() ?: wp_trim_words( wp_strip_all_tags( get_the_content() ), 28 );
	$wa      = function_exists( 'tk_whatsapp_url' ) ? tk_whatsapp_url() : '';
	$contact = home_url( '/contact/' );
	?>
<main id="primary" class="site-main tk-service-single">
	<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) : ?>

		<?php if ( tk_is_elementor_page() ) : ?>
			<div class="entry-content"><?php the_content(); ?></div>
		<?php else : ?>

			<section class="page-hero service-hero"<?php echo $cover ? ' style="background-image:linear-gradient(150deg,rgba(14,23,48,.92),rgba(28,47,94,.9) 70%),url(' . esc_url( $cover ) . ');background-size:cover;background-position:center;"' : ''; ?>>
				<div class="container">
					<div class="breadcrumb">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'الرئيسية', 'tek-craft-toppres' ); ?></a>
						<span>/</span>
						<a href="<?php echo esc_url( get_post_type_archive_link( 'tk_service' ) ); ?>"><?php esc_html_e( 'الخدمات', 'tek-craft-toppres' ); ?></a>
						<span>/</span>
						<span><?php the_title(); ?></span>
					</div>
					<div class="eyebrow" style="color:var(--gold-light)">
						<?php echo function_exists( 'tk_icon' ) ? tk_icon( 'briefcase', array( 'class' => 'star-ic', 'size' => 16 ) ) : ''; // phpcs:ignore ?>
						<span><?php esc_html_e( 'تفاصيل الخدمة', 'tek-craft-toppres' ); ?></span>
					</div>
					<?php the_title( '<h1 style="margin-bottom:24px;">', '</h1>' ); ?>
					<p style="max-width:600px;color:rgba(255,255,255,.8);font-size:17px;line-height:1.7;"><?php echo esc_html( $excerpt ); ?></p>
					<div style="margin-top:40px;display:flex;gap:16px;flex-wrap:wrap;">
						<a class="btn btn-gold" href="<?php echo esc_url( $contact ); ?>"><?php esc_html_e( 'اطلب الخدمة الآن', 'tek-craft-toppres' ); ?></a>
						<?php if ( $wa ) : ?>
							<a class="btn btn-outline" style="border-color:rgba(255,255,255,.3);color:#fff;" href="<?php echo esc_url( $wa ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'تواصل عبر واتساب', 'tek-craft-toppres' ); ?></a>
						<?php endif; ?>
					</div>
				</div>
			</section>

			<section class="section">
				<div class="container service-detail-layout">
					<div class="service-detail-main">
						<h2><?php esc_html_e( 'عن الخدمة', 'tek-craft-toppres' ); ?></h2>
						<div class="entry-content service-body">
							<?php the_content(); ?>
						</div>

						<h2><?php esc_html_e( 'ماذا نقدم؟', 'tek-craft-toppres' ); ?></h2>
						<ul class="service-checklist">
							<?php
							$checks = array(
								__( 'صياغة خطة واضحة حسب متطلباتك', 'tek-craft-toppres' ),
								__( 'مصادر ومراجع موثوقة عربية وأجنبية', 'tek-craft-toppres' ),
								__( 'تنسيق حسب نظام التوثيق المطلوب', 'tek-craft-toppres' ),
								__( 'مراجعة لغوية وضمان جودة قبل التسليم', 'tek-craft-toppres' ),
							);
							foreach ( $checks as $item ) :
								?>
								<li>
									<?php echo function_exists( 'tk_icon' ) ? tk_icon( 'check-circle', array( 'size' => 22, 'class' => 'tk-icon tk-icon--gold' ) ) : ''; // phpcs:ignore ?>
									<span><?php echo esc_html( $item ); ?></span>
								</li>
							<?php endforeach; ?>
						</ul>

						<div class="service-steps-box">
							<h3><?php esc_html_e( 'مراحل التنفيذ', 'tek-craft-toppres' ); ?></h3>
							<ol>
								<li><?php esc_html_e( 'استلام الطلب ودراسة المتطلبات بدقة.', 'tek-craft-toppres' ); ?></li>
								<li><?php esc_html_e( 'إسناد العمل لمتخصص في نفس المجال.', 'tek-craft-toppres' ); ?></li>
								<li><?php esc_html_e( 'التنفيذ ومراجعة الجودة.', 'tek-craft-toppres' ); ?></li>
								<li><?php esc_html_e( 'التسليم في الموعد مع إمكانية التعديل.', 'tek-craft-toppres' ); ?></li>
							</ol>
						</div>
					</div>

					<aside class="service-detail-aside">
						<div class="service-book-card">
							<h4><?php esc_html_e( 'احجز الخدمة الآن', 'tek-craft-toppres' ); ?></h4>
							<p><?php esc_html_e( 'أرسل بياناتك وسنتواصل معك خلال ساعات بعرض سعر واضح.', 'tek-craft-toppres' ); ?></p>
							<a class="btn btn-gold btn-block" href="<?php echo esc_url( $contact ); ?>"><?php esc_html_e( 'طلب استشارة مجانية', 'tek-craft-toppres' ); ?></a>
							<?php if ( $wa ) : ?>
								<a class="btn btn-outline-dark btn-block" style="margin-top:12px;" href="<?php echo esc_url( $wa ); ?>" target="_blank" rel="noopener noreferrer">
									<?php echo function_exists( 'tk_icon' ) ? tk_icon( 'phone', array( 'size' => 16 ) ) : ''; // phpcs:ignore ?>
									<?php esc_html_e( 'واتساب مباشر', 'tek-craft-toppres' ); ?>
								</a>
							<?php endif; ?>
						</div>
					</aside>
				</div>
			</section>

		<?php endif; ?>
	<?php endif; ?>
</main>
	<?php
endwhile;
get_footer();
