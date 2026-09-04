<?php
/**
 * Services archive — renders Elementor-seeded catalog page when available.
 *
 * @package Tek_Craft_Toppres
 */

get_header();

$guide     = get_page_by_path( 'services-guide' );
$use_guide = $guide && function_exists( 'tk_is_elementor_page' ) && tk_is_elementor_page( $guide->ID );
?>
<main id="primary" class="site-main tk-services-archive">
	<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'archive' ) ) : ?>

		<?php if ( $use_guide && class_exists( '\Elementor\Plugin' ) ) : ?>
			<?php echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( (int) $guide->ID ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php else : ?>

			<section class="page-hero">
				<div class="hero-field"></div>
				<div class="container" style="text-align:center;">
					<div class="breadcrumb" style="justify-content:center;">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'الرئيسية', 'tek-craft-toppres' ); ?></a>
						<span>/</span>
						<span><?php esc_html_e( 'الخدمات', 'tek-craft-toppres' ); ?></span>
					</div>
					<div class="eyebrow" style="color:var(--gold-light);justify-content:center;display:flex;gap:10px;">
						<?php echo function_exists( 'tk_star_svg' ) ? tk_star_svg() : ''; // phpcs:ignore ?>
						<span><?php esc_html_e( 'دليل الخدمات', 'tek-craft-toppres' ); ?></span>
					</div>
					<h1><?php esc_html_e( 'اكتشف خدمات توبرز الأكاديمية', 'tek-craft-toppres' ); ?></h1>
				</div>
			</section>

			<section class="section">
				<div class="container">
					<div class="grid grid-2">
						<?php
						if ( have_posts() ) :
							while ( have_posts() ) :
								the_post();
								$thumb = get_the_post_thumbnail_url( get_the_ID(), 'tk-card' );
								?>
								<a href="<?php the_permalink(); ?>" <?php post_class( 'service-card' ); ?>>
									<div class="sc-img">
										<?php if ( $thumb ) : ?>
											<img src="<?php echo esc_url( $thumb ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
										<?php endif; ?>
										<span class="sc-badge"><?php the_title(); ?></span>
									</div>
									<div class="sc-content">
										<h3><?php the_title(); ?></h3>
										<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
										<span class="sc-link"><?php esc_html_e( 'التفاصيل', 'tek-craft-toppres' ); ?> <span class="arrow">&larr;</span></span>
									</div>
								</a>
								<?php
							endwhile;
						endif;
						?>
					</div>
				</div>
			</section>

		<?php endif; ?>

	<?php endif; ?>
</main>
<?php
get_footer();
