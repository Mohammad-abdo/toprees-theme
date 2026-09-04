<?php
/**
 * Elementor Hero Slider — fade slides, unique IDs, fully editable repeater.
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

/**
 * Hero slider widget.
 */
class TK_Widget_Hero_Slider extends Widget_Base {

	public function get_name() {
		return 'tk_hero_slider';
	}

	public function get_title() {
		return __( 'TK Hero Slider', 'tek-craft-toppres' );
	}

	public function get_icon() {
		return 'eicon-slider-push';
	}

	public function get_categories() {
		return array( 'tek-craft-toppres' );
	}

	public function get_keywords() {
		return array( 'hero', 'slider', 'banner', 'toppres' );
	}

	/**
	 * @return array
	 */
	public function get_script_depends() {
		return array( 'tk-main' );
	}

	/**
	 * @return array
	 */
	public function get_style_depends() {
		return array( 'tk-components', 'tk-tweaks' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_slides',
			array(
				'label' => __( 'الشرائح (أضف / احذف / عدّل)', 'tek-craft-toppres' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'bg_image',
			array(
				'label'   => __( 'صورة الخلفية', 'tek-craft-toppres' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => function_exists( 'tk_default_media_url' ) ? tk_default_media_url( 'hero1' ) : 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&q=80&w=1920',
				),
			)
		);

		$repeater->add_control(
			'eyebrow',
			array(
				'label'   => __( 'سطر علوي', 'tek-craft-toppres' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'توبرز للاستشارات والحلول البحثية', 'tek-craft-toppres' ),
				'dynamic' => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'title',
			array(
				'label'   => __( 'العنوان — سطر 1', 'tek-craft-toppres' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'من فكرة البحث', 'tek-craft-toppres' ),
				'dynamic' => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'title_accent',
			array(
				'label'   => __( 'العنوان — سطر مميز', 'tek-craft-toppres' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'إلى التسليم النهائي', 'tek-craft-toppres' ),
				'dynamic' => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'lede',
			array(
				'label'   => __( 'الوصف', 'tek-craft-toppres' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'نرافق طلاب البكالوريوس والماجستير والدكتوراه والباحثين في كل محطة من رحلتهم الأكاديمية.', 'tek-craft-toppres' ),
				'dynamic' => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'btn1_text',
			array(
				'label'   => __( 'نص الزر 1', 'tek-craft-toppres' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'اطلب خدمتك الآن', 'tek-craft-toppres' ),
				'dynamic' => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'btn1_link',
			array(
				'label'       => __( 'رابط الزر 1', 'tek-craft-toppres' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => home_url( '/contact/' ),
				'default'     => array( 'url' => home_url( '/contact/' ) ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'btn2_text',
			array(
				'label'   => __( 'نص الزر 2', 'tek-craft-toppres' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'تصفح الخدمات', 'tek-craft-toppres' ),
				'dynamic' => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'btn2_link',
			array(
				'label'   => __( 'رابط الزر 2', 'tek-craft-toppres' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => get_post_type_archive_link( 'tk_service' ) ?: home_url( '/services/' ) ),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'slides',
			array(
				'label'       => __( 'الشرائح', 'tek-craft-toppres' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'     => array(
					array(
						'bg_image'     => array( 'url' => function_exists( 'tk_default_media_url' ) ? tk_default_media_url( 'hero1' ) : '' ),
						'title'        => __( 'من فكرة البحث', 'tek-craft-toppres' ),
						'title_accent' => __( 'إلى التسليم النهائي', 'tek-craft-toppres' ),
						'btn1_text'    => __( 'اطلب خدمتك الآن', 'tek-craft-toppres' ),
						'btn2_text'    => __( 'تصفح الخدمات', 'tek-craft-toppres' ),
					),
					array(
						'bg_image'     => array( 'url' => function_exists( 'tk_default_media_url' ) ? tk_default_media_url( 'hero2' ) : '' ),
						'title'        => __( 'رسائل الماجستير', 'tek-craft-toppres' ),
						'title_accent' => __( 'بمنهجية دقيقة', 'tek-craft-toppres' ),
						'btn1_text'    => __( 'عرض الخدمات', 'tek-craft-toppres' ),
						'btn2_text'    => '',
					),
					array(
						'bg_image'     => array( 'url' => function_exists( 'tk_default_media_url' ) ? tk_default_media_url( 'hero3' ) : '' ),
						'title'        => __( 'التحليل الإحصائي', 'tek-craft-toppres' ),
						'title_accent' => __( 'والترجمة الاحترافية', 'tek-craft-toppres' ),
						'btn1_text'    => __( 'تواصل معنا', 'tek-craft-toppres' ),
						'btn2_text'    => '',
					),
				),
			)
		);

		$this->add_control(
			'autoplay',
			array(
				'label'        => __( 'تشغيل تلقائي', 'tek-craft-toppres' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'autoplay_speed',
			array(
				'label'     => __( 'مدة الشريحة (مللي ثانية)', 'tek-craft-toppres' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 6000,
				'min'       => 2000,
				'step'      => 500,
				'condition' => array( 'autoplay' => 'yes' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_hero',
			array(
				'label' => __( 'تصميم البانر', 'tek-craft-toppres' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'min_height',
			array(
				'label'      => __( 'الارتفاع الأدنى', 'tek-craft-toppres' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'vh', 'px' ),
				'range'      => array(
					'vh' => array( 'min' => 40, 'max' => 100 ),
					'px' => array( 'min' => 320, 'max' => 1200 ),
				),
				'default'    => array( 'unit' => 'vh', 'size' => 90 ),
				'selectors'  => array(
					'{{WRAPPER}} .tk-hero' => 'min-height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'overlay_color',
			array(
				'label'     => __( 'لون التغطية', 'tek-craft-toppres' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(14,23,48,0.55)',
				'selectors' => array(
					'{{WRAPPER}} .tk-hero__overlay' => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'لون العنوان', 'tek-craft-toppres' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tk-hero__title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typo',
				'selector' => '{{WRAPPER}} .tk-hero__title',
			)
		);

		$this->add_control(
			'accent_color',
			array(
				'label'     => __( 'لون السطر المميز', 'tek-craft-toppres' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tk-hero__accent' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'text_color',
			array(
				'label'     => __( 'لون الوصف', 'tek-craft-toppres' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tk-hero__lede' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'radius',
			array(
				'label'      => __( 'Border Radius', 'tek-craft-toppres' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 40 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 8 ),
				'selectors'  => array(
					'{{WRAPPER}} .tk-hero, {{WRAPPER}} .tk-hero__btn' => 'border-radius: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$s      = $this->get_settings_for_display();
		$slides = isset( $s['slides'] ) ? $s['slides'] : array();
		if ( empty( $slides ) ) {
			$slides = array(
				array(
					'bg_image'     => array( 'url' => function_exists( 'tk_default_media_url' ) ? tk_default_media_url( 'hero1' ) : '' ),
					'eyebrow'      => __( 'توبرز للاستشارات والحلول البحثية', 'tek-craft-toppres' ),
					'title'        => __( 'من فكرة البحث', 'tek-craft-toppres' ),
					'title_accent' => __( 'إلى التسليم النهائي', 'tek-craft-toppres' ),
					'lede'         => __( 'نرافق طلاب البكالوريوس والماجستير والدكتوراه والباحثين في كل محطة من رحلتهم الأكاديمية.', 'tek-craft-toppres' ),
					'btn1_text'    => __( 'اطلب خدمتك الآن', 'tek-craft-toppres' ),
					'btn1_link'    => array( 'url' => home_url( '/contact/' ) ),
					'btn2_text'    => __( 'تصفح الخدمات', 'tek-craft-toppres' ),
					'btn2_link'    => array( 'url' => home_url( '/services/' ) ),
				),
				array(
					'bg_image'     => array( 'url' => function_exists( 'tk_default_media_url' ) ? tk_default_media_url( 'hero2' ) : '' ),
					'eyebrow'      => __( 'توبرز للاستشارات والحلول البحثية', 'tek-craft-toppres' ),
					'title'        => __( 'رسائل الماجستير', 'tek-craft-toppres' ),
					'title_accent' => __( 'بمنهجية دقيقة', 'tek-craft-toppres' ),
					'lede'         => __( 'مرافقة كاملة من اختيار العنوان حتى المناقشة والتنسيق النهائي وفق دليل جامعتك.', 'tek-craft-toppres' ),
					'btn1_text'    => __( 'عرض الخدمات', 'tek-craft-toppres' ),
					'btn1_link'    => array( 'url' => home_url( '/services/' ) ),
					'btn2_text'    => '',
				),
				array(
					'bg_image'     => array( 'url' => function_exists( 'tk_default_media_url' ) ? tk_default_media_url( 'hero3' ) : '' ),
					'eyebrow'      => __( 'توبرز للاستشارات والحلول البحثية', 'tek-craft-toppres' ),
					'title'        => __( 'التحليل الإحصائي', 'tek-craft-toppres' ),
					'title_accent' => __( 'والترجمة الاحترافية', 'tek-craft-toppres' ),
					'lede'         => __( 'تحليل بيانات دقيق وترجمة أكاديمية بمصطلحات صحيحة تناسب النشر والمحكّمين.', 'tek-craft-toppres' ),
					'btn1_text'    => __( 'تواصل معنا', 'tek-craft-toppres' ),
					'btn1_link'    => array( 'url' => home_url( '/contact/' ) ),
					'btn2_text'    => '',
				),
			);
		}

		$uid      = 'tk-hero-' . $this->get_id();
		$autoplay = ( 'yes' === ( $s['autoplay'] ?? 'yes' ) ) ? '1' : '0';
		$speed    = ! empty( $s['autoplay_speed'] ) ? (int) $s['autoplay_speed'] : 6000;
		$star     = function_exists( 'tk_icon' ) ? tk_icon( 'sparkles', array( 'class' => 'star-ic', 'size' => 16 ) ) : '';
		?>
		<section class="tk-hero hero-slider-wrapper" id="<?php echo esc_attr( $uid ); ?>" data-autoplay="<?php echo esc_attr( $autoplay ); ?>" data-speed="<?php echo esc_attr( (string) $speed ); ?>">
			<div class="tk-hero__track hero-slider" data-tk-hero-track>
				<?php foreach ( $slides as $i => $slide ) :
					$fallback = function_exists( 'tk_default_media_url' ) ? tk_default_media_url( 'hero' . ( ( $i % 3 ) + 1 ) ) : '';
					$bg       = function_exists( 'tk_elementor_image_url' ) ? tk_elementor_image_url( $slide['bg_image'] ?? array(), $fallback ) : $fallback;
					$btn1     = ! empty( $slide['btn1_link']['url'] ) ? $slide['btn1_link']['url'] : home_url( '/contact/' );
					$btn2     = ! empty( $slide['btn2_link']['url'] ) ? $slide['btn2_link']['url'] : home_url( '/services/' );
					?>
					<div class="tk-hero__slide hero-slide slide-<?php echo esc_attr( (string) ( ( $i % 3 ) + 1 ) ); ?> <?php echo 0 === $i ? 'is-active' : ''; ?>" data-tk-hero-slide <?php echo 0 === $i ? '' : 'hidden'; ?> aria-hidden="<?php echo 0 === $i ? 'false' : 'true'; ?>">
						<div class="tk-hero__bg slide-bg" style="background-image:url(<?php echo esc_url( $bg ); ?>)">
							<img class="tk-hero__img" src="<?php echo esc_url( $bg ); ?>" alt="" decoding="async" <?php echo 0 === $i ? 'fetchpriority="high"' : 'loading="lazy"'; ?>>
						</div>
						<div class="tk-hero__overlay slide-overlay"></div>
						<div class="container tk-hero__content slide-content center-content">
							<?php if ( ! empty( $slide['eyebrow'] ) ) : ?>
								<div class="eyebrow hero-eyebrow tk-hero__eyebrow">
									<?php echo $star; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									<span><?php echo esc_html( $slide['eyebrow'] ); ?></span>
								</div>
							<?php endif; ?>
							<h1 class="hero-title tk-hero__title">
								<?php echo esc_html( $slide['title'] ); ?>
								<?php if ( ! empty( $slide['title_accent'] ) ) : ?>
									<br><span class="accent tk-hero__accent"><?php echo esc_html( $slide['title_accent'] ); ?></span>
								<?php endif; ?>
							</h1>
							<?php if ( ! empty( $slide['lede'] ) ) : ?>
								<p class="hero-lede tk-hero__lede"><?php echo esc_html( $slide['lede'] ); ?></p>
							<?php endif; ?>
							<div class="hero-cta center-flex tk-hero__cta">
								<?php if ( ! empty( $slide['btn1_text'] ) ) : ?>
									<a class="btn btn-gold tk-hero__btn" href="<?php echo esc_url( $btn1 ); ?>"><?php echo esc_html( $slide['btn1_text'] ); ?></a>
								<?php endif; ?>
								<?php if ( ! empty( $slide['btn2_text'] ) ) : ?>
									<a class="btn btn-outline tk-hero__btn" href="<?php echo esc_url( $btn2 ); ?>"><?php echo esc_html( $slide['btn2_text'] ); ?></a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

			<?php if ( count( $slides ) > 1 ) : ?>
				<div class="slider-controls tk-hero__controls">
					<button class="slider-btn" type="button" data-tk-hero-prev aria-label="<?php esc_attr_e( 'السابق', 'tek-craft-toppres' ); ?>">
						<?php echo function_exists( 'tk_icon' ) ? tk_icon( 'arrow-left', array( 'size' => 18 ) ) : '&larr;'; // phpcs:ignore ?>
					</button>
					<div class="slider-dots" data-tk-hero-dots>
						<?php foreach ( $slides as $i => $slide ) : ?>
							<button class="slider-dot <?php echo 0 === $i ? 'active' : ''; ?>" type="button" data-index="<?php echo esc_attr( (string) $i ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'شريحة %d', 'tek-craft-toppres' ), $i + 1 ) ); ?>"></button>
						<?php endforeach; ?>
					</div>
					<button class="slider-btn" type="button" data-tk-hero-next aria-label="<?php esc_attr_e( 'التالي', 'tek-craft-toppres' ); ?>">
						<?php echo function_exists( 'tk_icon' ) ? tk_icon( 'arrow-left', array( 'size' => 18, 'class' => 'tk-icon tk-icon--flip' ) ) : '&rarr;'; // phpcs:ignore ?>
					</button>
				</div>
			<?php endif; ?>
		</section>
		<?php
	}
}
