<?php
/**
 * Blog posts index — matches HTML blog.html layout.
 *
 * @package Tek_Craft_Toppres
 */

get_header();
?>
<main id="primary" class="site-main tk-blog-archive">
	<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'archive' ) ) : ?>

		<section class="page-hero">
			<div class="hero-field"></div>
			<div class="container">
				<div class="breadcrumb">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'الرئيسية', 'tek-craft-toppres' ); ?></a>
					<span>/</span>
					<span><?php esc_html_e( 'المدونة والمقالات', 'tek-craft-toppres' ); ?></span>
				</div>
				<div class="eyebrow" style="color:var(--gold-light)">
					<?php echo function_exists( 'tk_star_svg' ) ? tk_star_svg() : ''; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<span><?php esc_html_e( 'المقالات', 'tek-craft-toppres' ); ?></span>
				</div>
				<h1><?php esc_html_e( 'مدونة توبرز الأكاديمية', 'tek-craft-toppres' ); ?></h1>
				<p style="max-width:58ch;color:rgba(255,255,255,.75)">
					<?php esc_html_e( 'نشاركك أفضل الممارسات والنصائح لإعداد الأبحاث والرسائل العلمية بمنهجية صحيحة.', 'tek-craft-toppres' ); ?>
				</p>
			</div>
		</section>

		<section class="section section--alt">
			<div class="container">
				<div class="grid grid-3 reveal-stagger reveal tk-posts-grid">
					<?php
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
							$cats  = get_the_category();
							$badge = $cats ? $cats[0]->name : __( 'مقال', 'tek-craft-toppres' );
							$thumb = get_the_post_thumbnail_url( get_the_ID(), 'tk-card' );
							if ( ! $thumb ) {
								$thumb = TK_THEME_URI . '/assets/images/logo.png';
							}
							?>
							<a href="<?php the_permalink(); ?>" <?php post_class( 'article-card' ); ?>>
								<div class="ac-img">
									<img src="<?php echo esc_url( $thumb ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" width="600" height="400">
									<span class="ac-badge"><?php echo esc_html( $badge ); ?></span>
								</div>
								<div class="ac-content">
									<div class="ac-meta">
										<span><?php echo esc_html( get_the_date() ); ?></span>
									</div>
									<h3><?php the_title(); ?></h3>
									<p><?php echo esc_html( wp_trim_words( get_the_excerpt() ? get_the_excerpt() : get_the_content(), 24 ) ); ?></p>
									<span class="ac-link"><?php esc_html_e( 'اقرأ المزيد', 'tek-craft-toppres' ); ?> &larr;</span>
								</div>
							</a>
							<?php
						endwhile;
					else :
						get_template_part( 'template-parts/content/content', 'none' );
					endif;
					?>
				</div>
				<?php tk_posts_navigation(); ?>
			</div>
		</section>

		<section class="section--tight">
			<div class="container">
				<div class="cta-band reveal">
					<h2><?php esc_html_e( 'جاهز لبدء رحلتك البحثية؟', 'tek-craft-toppres' ); ?></h2>
					<p><?php esc_html_e( 'أرسل تفاصيل مشروعك الآن واحصل على استشارة أولية وعرض سعر مجاني خلال ساعات.', 'tek-craft-toppres' ); ?></p>
					<div class="cta-actions">
						<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-gold"><?php esc_html_e( 'اطلب خدمتك', 'tek-craft-toppres' ); ?></a>
						<?php if ( function_exists( 'tk_whatsapp_url' ) && tk_whatsapp_url() ) : ?>
							<a href="<?php echo esc_url( tk_whatsapp_url() ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-outline"><?php esc_html_e( 'تواصل عبر واتساب', 'tek-craft-toppres' ); ?></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>

	<?php endif; ?>
</main>
<?php
get_footer();
