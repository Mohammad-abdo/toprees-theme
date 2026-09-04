<?php
/**
 * Elementor Page Hero — matches HTML page-hero (dark) + light/about variant.
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * Interior page hero.
 */
class TK_Widget_Page_Hero extends Widget_Base {

	public function get_name() {
		return 'tk_page_hero';
	}

	public function get_title() {
		return __( 'TK Page Hero', 'tek-craft-toppres' );
	}

	public function get_icon() {
		return 'eicon-banner';
	}

	public function get_categories() {
		return array( 'tek-craft-toppres' );
	}

	protected function register_controls() {
		$this->start_controls_section( 'content', array( 'label' => __( 'المحتوى', 'tek-craft-toppres' ) ) );

		$this->add_control(
			'variant',
			array(
				'label'   => __( 'النمط', 'tek-craft-toppres' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'dark',
				'options' => array(
					'dark'  => __( 'داكن (افتراضي)', 'tek-craft-toppres' ),
					'light' => __( 'فاتح (من نحن)', 'tek-craft-toppres' ),
				),
			)
		);

		$this->add_control( 'eyebrow', array( 'label' => __( 'سطر علوي', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'توبرز', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'title', array( 'label' => __( 'العنوان', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXTAREA, 'default' => __( 'عنوان الصفحة', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'lede', array( 'label' => __( 'الوصف', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXTAREA, 'default' => '', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'crumb_current', array( 'label' => __( 'breadcrumb الحالي', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => '', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'bg_image', array(
			'label'   => __( 'خلفية / صورة جانبية', 'tek-craft-toppres' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => array(
				'url' => function_exists( 'tk_default_media_url' ) ? tk_default_media_url( 'page' ) : '',
			),
		) );
		$this->add_control( 'btn1_text', array( 'label' => __( 'زر 1', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => '', 'condition' => array( 'variant' => 'light' ) ) );
		$this->add_control( 'btn1_link', array( 'label' => __( 'رابط زر 1', 'tek-craft-toppres' ), 'type' => Controls_Manager::URL, 'condition' => array( 'variant' => 'light' ) ) );
		$this->add_control( 'btn2_text', array( 'label' => __( 'زر 2', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => '', 'condition' => array( 'variant' => 'light' ) ) );
		$this->add_control( 'btn2_link', array( 'label' => __( 'رابط زر 2', 'tek-craft-toppres' ), 'type' => Controls_Manager::URL, 'condition' => array( 'variant' => 'light' ) ) );
		$this->add_control( 'center', array( 'label' => __( 'توسيط المحتوى', 'tek-craft-toppres' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => '', 'condition' => array( 'variant' => 'dark' ) ) );

		$this->end_controls_section();

		if ( function_exists( 'tk_register_common_style_controls' ) ) {
			tk_register_common_style_controls( $this, '.page-hero' );
		}
	}

	protected function render() {
		$s       = $this->get_settings_for_display();
		$variant = $s['variant'] ?? 'dark';
		$fallback = function_exists( 'tk_default_media_url' ) ? tk_default_media_url( 'light' === $variant ? 'about' : 'page' ) : '';
		$bg      = function_exists( 'tk_elementor_image_url' ) ? tk_elementor_image_url( $s['bg_image'] ?? array(), $fallback ) : ( $s['bg_image']['url'] ?? $fallback );
		$crumb   = ! empty( $s['crumb_current'] ) ? $s['crumb_current'] : wp_strip_all_tags( $s['title'] );
		$center  = ( 'yes' === ( $s['center'] ?? '' ) );
		$star    = function_exists( 'tk_star_svg' ) ? tk_star_svg() : '';

		if ( 'light' === $variant ) {
			$this->render_light( $s, $bg, $crumb, $star );
			return;
		}

		$style = '';
		if ( $bg ) {
			$style = ' style="background-image:radial-gradient(ellipse 100% 80% at 80% 0%,rgba(201,154,59,.3),transparent 60%),linear-gradient(150deg,rgba(14,23,48,.88),rgba(28,47,94,.88) 70%),url(' . esc_url( $bg ) . ');background-size:cover;background-position:center;"';
		}
		?>
		<section class="page-hero"<?php echo $style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
			<div class="hero-field"></div>
			<div class="container"<?php echo $center ? ' style="text-align:center;"' : ''; ?>>
				<div class="breadcrumb"<?php echo $center ? ' style="justify-content:center;"' : ''; ?>>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'الرئيسية', 'tek-craft-toppres' ); ?></a>
					<span>/</span>
					<span><?php echo esc_html( $crumb ); ?></span>
				</div>
				<?php if ( ! empty( $s['eyebrow'] ) ) : ?>
					<div class="eyebrow" style="color:var(--gold-light);<?php echo $center ? 'justify-content:center;' : ''; ?>">
						<?php echo $star; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<span><?php echo esc_html( $s['eyebrow'] ); ?></span>
					</div>
				<?php endif; ?>
				<h1><?php echo esc_html( $s['title'] ); ?></h1>
				<?php if ( ! empty( $s['lede'] ) ) : ?>
					<p class="page-hero-lede"<?php echo $center ? ' style="margin-inline:auto;"' : ''; ?>><?php echo esc_html( $s['lede'] ); ?></p>
				<?php endif; ?>
			</div>
		</section>
		<?php
	}

	/**
	 * Light about-style hero.
	 *
	 * @param array  $s     Settings.
	 * @param string $bg    Image URL.
	 * @param string $crumb Crumb label.
	 * @param string $star  Star SVG.
	 */
	private function render_light( $s, $bg, $crumb, $star ) {
		$b1 = ! empty( $s['btn1_link']['url'] ) ? $s['btn1_link']['url'] : home_url( '/services/' );
		$b2 = ! empty( $s['btn2_link']['url'] ) ? $s['btn2_link']['url'] : home_url( '/contact/' );
		?>
		<section class="page-hero page-hero--light">
			<div class="container about-hero-wrap">
				<div class="about-hero-text">
					<div class="breadcrumb">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'الرئيسية', 'tek-craft-toppres' ); ?></a>
						<span>/</span>
						<span><?php echo esc_html( $crumb ); ?></span>
					</div>
					<?php if ( ! empty( $s['eyebrow'] ) ) : ?>
						<div class="eyebrow" style="color:var(--gold-deep);">
							<?php echo $star; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<span><?php echo esc_html( $s['eyebrow'] ); ?></span>
						</div>
					<?php endif; ?>
					<h1><?php echo esc_html( $s['title'] ); ?></h1>
					<?php if ( ! empty( $s['lede'] ) ) : ?>
						<p class="page-hero-lede"><?php echo esc_html( $s['lede'] ); ?></p>
					<?php endif; ?>
					<?php if ( ! empty( $s['btn1_text'] ) || ! empty( $s['btn2_text'] ) ) : ?>
						<div class="about-hero-actions">
							<?php if ( ! empty( $s['btn1_text'] ) ) : ?>
								<a href="<?php echo esc_url( $b1 ); ?>" class="btn btn-navy"><?php echo esc_html( $s['btn1_text'] ); ?></a>
							<?php endif; ?>
							<?php if ( ! empty( $s['btn2_text'] ) ) : ?>
								<a href="<?php echo esc_url( $b2 ); ?>" class="btn btn-outline"><?php echo esc_html( $s['btn2_text'] ); ?></a>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
				<?php if ( $bg ) : ?>
					<div class="about-hero-img-wrap">
						<div class="about-hero-img-bg"></div>
						<img src="<?php echo esc_url( $bg ); ?>" alt="" loading="eager" width="800" height="900">
					</div>
				<?php endif; ?>
			</div>
		</section>
		<?php
	}
}
