<?php
/**
 * Custom Elementor widgets for Toppers.
 *
 * @package Toppers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

abstract class Toppers_Widget_Base extends Widget_Base {
	public function get_categories() {
		return array( 'toppers' );
	}

	protected function section_heading_controls( $defaults = array() ) {
		$defaults = wp_parse_args(
			$defaults,
			array(
				'eyebrow' => 'قسم',
				'title'   => 'العنوان',
				'lede'    => '',
			)
		);
		$this->start_controls_section( 'section_heading', array( 'label' => __( 'عنوان القسم', 'toppers' ) ) );
		$this->add_control( 'eyebrow', array( 'label' => __( 'التسمية الصغيرة', 'toppers' ), 'type' => Controls_Manager::TEXT, 'default' => $defaults['eyebrow'] ) );
		$this->add_control( 'title', array( 'label' => __( 'العنوان', 'toppers' ), 'type' => Controls_Manager::TEXTAREA, 'default' => $defaults['title'] ) );
		$this->add_control( 'lede', array( 'label' => __( 'الوصف', 'toppers' ), 'type' => Controls_Manager::TEXTAREA, 'default' => $defaults['lede'] ) );
		$this->end_controls_section();
	}

	protected function render_section_head( $settings, $center = true ) {
		echo '<div class="section-head' . ( $center ? ' center' : '' ) . '">';
		if ( ! empty( $settings['eyebrow'] ) ) {
			echo '<div class="eyebrow">' . toppers_star_svg() . '<span>' . esc_html( $settings['eyebrow'] ) . '</span></div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		if ( ! empty( $settings['title'] ) ) {
			echo '<h2>' . esc_html( $settings['title'] ) . '</h2>';
		}
		if ( ! empty( $settings['lede'] ) ) {
			echo '<p>' . esc_html( $settings['lede'] ) . '</p>';
		}
		echo '</div>';
	}
}

class Toppers_Widget_Hero_Slider extends Toppers_Widget_Base {
	public function get_name() { return 'toppers-hero-slider'; }
	public function get_title() { return __( 'سلايدر الرئيسية', 'toppers' ); }
	public function get_icon() { return 'eicon-slider-push'; }

	protected function register_controls() {
		$this->start_controls_section( 'section_slides', array( 'label' => __( 'الشرائح (صور فقط)', 'toppers' ) ) );
		$repeater = new Repeater();
		$repeater->add_control( 'image', array( 'label' => __( 'صورة البانر', 'toppers' ), 'type' => Controls_Manager::MEDIA, 'default' => array( 'url' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&q=80&w=1920' ) ) );
		$this->add_control(
			'slides',
			array(
				'label'       => __( 'الشرائح', 'toppers' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => __( 'صورة', 'toppers' ),
				'default'     => array(
					array( 'image' => array( 'url' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&q=80&w=1920' ) ),
					array( 'image' => array( 'url' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&q=80&w=1920' ) ),
					array( 'image' => array( 'url' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&q=80&w=1920' ) ),
				),
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$slides = $this->get_settings_for_display()['slides'];
		if ( empty( $slides ) ) {
			return;
		}
		echo '<section class="hero-slider-wrapper hero-slider-wrapper--image-only"><div class="hero-slider" id="heroSlider">';
		foreach ( $slides as $i => $slide ) {
			$img = ! empty( $slide['image']['url'] ) ? $slide['image']['url'] : '';
			$active = 0 === $i ? ' is-active' : '';
			echo '<div class="hero-slide' . esc_attr( $active ) . ' slide-' . esc_attr( $i + 1 ) . '">';
			echo '<div class="slide-bg">';
			if ( $img ) {
				echo '<img src="' . esc_url( $img ) . '" alt="" decoding="async"' . ( 0 === $i ? ' fetchpriority="high"' : ' loading="lazy"' ) . '>';
			}
			echo '</div></div>';
		}
		echo '</div><div class="slider-controls"><button class="slider-btn" id="sliderPrev" type="button" aria-label="' . esc_attr__( 'السابق', 'toppers' ) . '"><i class="fa-solid fa-chevron-right" style="font-size:18px;" aria-hidden="true"></i></button><div class="slider-dots" id="sliderDots">';
		foreach ( $slides as $i => $slide ) {
			echo '<button class="slider-dot' . ( 0 === $i ? ' active' : '' ) . '" data-index="' . esc_attr( $i ) . '" type="button"></button>';
		}
		echo '</div><button class="slider-btn" id="sliderNext" type="button" aria-label="' . esc_attr__( 'التالي', 'toppers' ) . '"><i class="fa-solid fa-chevron-left" style="font-size:18px;" aria-hidden="true"></i></button></div></section>';
	}
}

class Toppers_Widget_Journey extends Toppers_Widget_Base {
	public function get_name() { return 'toppers-journey'; }
	public function get_title() { return __( 'رحلة العمل', 'toppers' ); }
	public function get_icon() { return 'eicon-flow'; }

	protected function register_controls() {
		$this->section_heading_controls( array( 'eyebrow' => 'كيف نعمل', 'title' => 'رحلة طلب واضحة من أول تواصل حتى التسليم' ) );
		$this->start_controls_section( 'section_steps', array( 'label' => __( 'الخطوات', 'toppers' ) ) );
		$repeater = new Repeater();
		$repeater->add_control( 'num', array( 'label' => __( 'الرقم', 'toppers' ), 'type' => Controls_Manager::TEXT, 'default' => '1' ) );
		$repeater->add_control( 'title', array( 'label' => __( 'العنوان', 'toppers' ), 'type' => Controls_Manager::TEXT, 'default' => 'التواصل' ) );
		$repeater->add_control( 'desc', array( 'label' => __( 'الوصف', 'toppers' ), 'type' => Controls_Manager::TEXTAREA, 'default' => 'تخبرنا بمتطلبات بحثك عبر الموقع أو واتساب.' ) );
		$this->add_control(
			'steps',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'     => array(
					array( 'num' => '1', 'title' => 'التواصل', 'desc' => 'تخبرنا بمتطلبات بحثك عبر الموقع أو واتساب.' ),
					array( 'num' => '2', 'title' => 'دراسة الطلب', 'desc' => 'نراجع التفاصيل ونحدد التخصص المناسب.' ),
					array( 'num' => '3', 'title' => 'عرض السعر', 'desc' => 'نرسل لك سعرًا واضحًا ومدة تسليم محددة.' ),
					array( 'num' => '4', 'title' => 'التنفيذ', 'desc' => 'يبدأ الباحث المتخصص العمل على طلبك.' ),
					array( 'num' => '5', 'title' => 'مراجعة الجودة', 'desc' => 'فحص علمي ولغوي وتدقيق تشابه قبل التسليم.' ),
					array( 'num' => '6', 'title' => 'التسليم', 'desc' => 'تستلم عملك مع إمكانية طلب تعديلات.' ),
				),
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		echo '<section class="section"><div class="container">';
		$this->render_section_head( $s );
		echo '<div class="journey">';
		foreach ( $s['steps'] as $step ) {
			echo '<div class="journey-step"><div class="journey-num">' . esc_html( $step['num'] ) . '</div><h4>' . esc_html( $step['title'] ) . '</h4><p>' . esc_html( $step['desc'] ) . '</p></div>';
		}
		echo '</div></div></section>';
	}
}

class Toppers_Widget_Services_Grid extends Toppers_Widget_Base {
	public function get_name() { return 'toppers-services-grid'; }
	public function get_title() { return __( 'شبكة الخدمات', 'toppers' ); }
	public function get_icon() { return 'eicon-gallery-grid'; }

	protected function register_controls() {
		$this->section_heading_controls( array( 'eyebrow' => 'خدماتنا', 'title' => 'كل ما تحتاجه رحلتك البحثية في مكان واحد', 'lede' => 'من اختيار العنوان إلى النشر العلمي — نغطي المراحل الأكاديمية كافة.' ) );
		$this->start_controls_section( 'section_source', array( 'label' => __( 'المصدر والصور', 'toppers' ) ) );
		$this->add_control( 'source', array( 'label' => __( 'المصدر', 'toppers' ), 'type' => Controls_Manager::SELECT, 'default' => 'cpt', 'options' => array( 'cpt' => __( 'من الخدمات في لوحة التحكم', 'toppers' ), 'manual' => __( 'يدوي (صور ونصوص هنا)', 'toppers' ) ) ) );
		$this->add_control( 'count', array( 'label' => __( 'عدد الخدمات', 'toppers' ), 'type' => Controls_Manager::NUMBER, 'default' => 8, 'condition' => array( 'source' => 'cpt' ) ) );
		$repeater = new Repeater();
		$repeater->add_control( 'image', array( 'label' => __( 'الصورة', 'toppers' ), 'type' => Controls_Manager::MEDIA, 'default' => array( 'url' => Utils::get_placeholder_image_src() ) ) );
		$repeater->add_control( 'title', array( 'label' => __( 'العنوان', 'toppers' ), 'type' => Controls_Manager::TEXT, 'default' => 'خدمة' ) );
		$repeater->add_control( 'desc', array( 'label' => __( 'الوصف', 'toppers' ), 'type' => Controls_Manager::TEXTAREA ) );
		$repeater->add_control( 'badge', array( 'label' => __( 'الشارة', 'toppers' ), 'type' => Controls_Manager::TEXT ) );
		$repeater->add_control( 'link', array( 'label' => __( 'الرابط', 'toppers' ), 'type' => Controls_Manager::URL ) );
		$this->add_control( 'items', array( 'label' => __( 'الخدمات اليدوية', 'toppers' ), 'type' => Controls_Manager::REPEATER, 'fields' => $repeater->get_controls(), 'title_field' => '{{{ title }}}', 'condition' => array( 'source' => 'manual' ) ) );
		$this->add_control( 'btn_text', array( 'label' => __( 'زر عرض الكل', 'toppers' ), 'type' => Controls_Manager::TEXT, 'default' => 'عرض كل الخدمات' ) );
		$this->add_control( 'btn_link', array( 'label' => __( 'رابط عرض الكل', 'toppers' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => toppers_page_url( 'services', '#' ) ) ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		$items = array();
		if ( 'manual' === $s['source'] ) {
			$items = $s['items'];
		} else {
			$q = new WP_Query( array( 'post_type' => 'toppers_service', 'posts_per_page' => (int) $s['count'], 'orderby' => 'menu_order title' ) );
			foreach ( $q->posts as $post ) {
				$items[] = array(
					'image' => array( 'url' => toppers_service_image( $post->ID ) ),
					'title' => get_the_title( $post ),
					'desc'  => $post->post_excerpt ?: wp_trim_words( wp_strip_all_tags( $post->post_content ), 18 ),
					'badge' => get_post_meta( $post->ID, '_toppers_badge', true ),
					'link'  => array( 'url' => get_permalink( $post ) ),
				);
			}
			wp_reset_postdata();
		}
		echo '<section class="section section--alt"><div class="container">';
		$this->render_section_head( $s, false );
		echo '<div class="grid grid-4">';
		foreach ( $items as $item ) {
			$url = ! empty( $item['link']['url'] ) ? $item['link']['url'] : '#';
			$img = ! empty( $item['image']['url'] ) ? $item['image']['url'] : '';
			echo '<div class="service-card"><div class="sc-img"><img src="' . esc_url( $img ) . '" alt="' . esc_attr( $item['title'] ) . '">';
			if ( ! empty( $item['badge'] ) ) {
				echo '<span class="sc-badge">' . esc_html( $item['badge'] ) . '</span>';
			} elseif ( ! empty( $item['title'] ) ) {
				echo '<span class="sc-badge">' . esc_html( $item['title'] ) . '</span>';
			}
			echo '</div><div class="sc-content"><h3>' . esc_html( $item['title'] ) . '</h3><p>' . esc_html( $item['desc'] ) . '</p>';
			echo '<a href="' . esc_url( $url ) . '" class="sc-link"><span>' . esc_html__( 'اطلب هذه الخدمة', 'toppers' ) . '</span> <span class="arrow">&larr;</span></a></div></div>';
		}
		echo '</div>';
		if ( ! empty( $s['btn_text'] ) ) {
			$url = ! empty( $s['btn_link']['url'] ) ? $s['btn_link']['url'] : '#';
			echo '<div class="center" style="margin-top:44px"><a href="' . esc_url( $url ) . '" class="btn btn-outline-dark">' . esc_html( $s['btn_text'] ) . '</a></div>';
		}
		echo '</div></section>';
	}
}

class Toppers_Widget_Why_Us extends Toppers_Widget_Base {
	public function get_name() { return 'toppers-why-us'; }
	public function get_title() { return __( 'لماذا توبرز + إحصائيات', 'toppers' ); }
	public function get_icon() { return 'eicon-counter'; }

	protected function register_controls() {
		$this->section_heading_controls( array( 'eyebrow' => 'لماذا توبرز', 'title' => 'شريكك الأكاديمي من الفكرة حتى النشر', 'lede' => 'نقدم لك دعماً بحثياً متكاملاً بمعايير عالمية لضمان نجاحك الأكاديمي بكل احترافية وسرية تامة.' ) );
		$this->start_controls_section( 'section_cards', array( 'label' => __( 'المزايا', 'toppers' ) ) );
		$repeater = new Repeater();
		$repeater->add_control( 'title', array( 'label' => __( 'العنوان', 'toppers' ), 'type' => Controls_Manager::TEXT ) );
		$repeater->add_control( 'desc', array( 'label' => __( 'الوصف', 'toppers' ), 'type' => Controls_Manager::TEXTAREA ) );
		$this->add_control(
			'cards',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'     => array(
					array( 'title' => 'فريق متخصص', 'desc' => 'باحثون وخبراء إحصاء ولغويون في مختلف التخصصات العلمية.' ),
					array( 'title' => 'دقة علمية', 'desc' => 'التزام صارم بالمنهجية العلمية والمعايير الأكاديمية المعتمدة.' ),
					array( 'title' => 'مواعيد تُحترم', 'desc' => 'تسليم في الوقت المتفق عليه دون تأخير أو مفاجآت.' ),
					array( 'title' => 'سرية تامة', 'desc' => 'بياناتك وملفاتك محمية ولا يطّلع عليها سوى الفريق المكلف.' ),
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section( 'section_stats', array( 'label' => __( 'الإحصائيات', 'toppers' ) ) );
		$sr = new Repeater();
		$sr->add_control( 'number', array( 'label' => __( 'الرقم', 'toppers' ), 'type' => Controls_Manager::NUMBER, 'default' => 8 ) );
		$sr->add_control( 'suffix', array( 'label' => __( 'اللاحقة', 'toppers' ), 'type' => Controls_Manager::TEXT, 'default' => '+' ) );
		$sr->add_control( 'label', array( 'label' => __( 'التسمية', 'toppers' ), 'type' => Controls_Manager::TEXT ) );
		$this->add_control(
			'stats',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $sr->get_controls(),
				'title_field' => '{{{ label }}}',
				'default'     => array(
					array( 'number' => 8, 'suffix' => '+', 'label' => 'سنوات من الخبرة' ),
					array( 'number' => 3200, 'suffix' => '+', 'label' => 'عميل تمت خدمتهم' ),
					array( 'number' => 1500, 'suffix' => '+', 'label' => 'بحث جامعي وماجستير' ),
					array( 'number' => 95, 'suffix' => '%', 'label' => 'نسبة رضا العملاء' ),
				),
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		echo '<section class="section section--navy" style="position:relative;overflow:hidden;"><div class="container" style="position:relative;z-index:2;">';
		echo '<div class="section-head center" style="margin-bottom:64px;">';
		if ( ! empty( $s['eyebrow'] ) ) {
			echo '<div class="eyebrow" style="color:var(--gold-light);justify-content:center;display:flex;gap:12px;">' . toppers_star_svg() . '<span>' . esc_html( $s['eyebrow'] ) . '</span>' . toppers_star_svg() . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		if ( ! empty( $s['title'] ) ) {
			echo '<h2 style="margin-top:16px;color:#fff;">' . esc_html( $s['title'] ) . '</h2>';
		}
		if ( ! empty( $s['lede'] ) ) {
			echo '<p style="color:rgba(255,255,255,0.7);max-width:640px;margin:20px auto 0;">' . esc_html( $s['lede'] ) . '</p>';
		}
		echo '</div><div class="grid grid-4">';
		foreach ( $s['cards'] as $card ) {
			echo '<div class="why-card"><div class="why-card-ic"><i class="fa-solid fa-user" aria-hidden="true"></i></div><h3>' . esc_html( $card['title'] ) . '</h3><p>' . esc_html( $card['desc'] ) . '</p></div>';
		}
		echo '</div><div class="why-stats" style="margin-top:64px;display:flex;justify-content:space-around;align-items:center;flex-wrap:wrap;gap:20px;background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.08);padding:36px 20px;border-radius:24px;">';
		foreach ( $s['stats'] as $stat ) {
			echo '<div class="stat-item" style="text-align:center;"><div style="font-family:var(--f-display);font-size:46px;font-weight:800;color:var(--gold-light);line-height:1;"><span data-count="' . esc_attr( $stat['number'] ) . '" data-suffix="' . esc_attr( $stat['suffix'] ) . '">0</span></div><div style="font-size:13.5px;color:rgba(255,255,255,0.7);margin-top:10px;">' . esc_html( $stat['label'] ) . '</div></div>';
		}
		echo '</div></div></section>';
	}
}

class Toppers_Widget_Testimonials extends Toppers_Widget_Base {
	public function get_name() { return 'toppers-testimonials'; }
	public function get_title() { return __( 'آراء الطلاب', 'toppers' ); }
	public function get_icon() { return 'eicon-testimonial'; }

	protected function register_controls() {
		$this->section_heading_controls( array( 'eyebrow' => 'آراء عملائنا', 'title' => 'طلاب وباحثون وثقوا بنا في محطة مهمة من مسيرتهم' ) );
		$this->start_controls_section( 'section_source', array( 'label' => __( 'المصدر', 'toppers' ) ) );
		$this->add_control( 'source', array( 'label' => __( 'المصدر', 'toppers' ), 'type' => Controls_Manager::SELECT, 'default' => 'cpt', 'options' => array( 'cpt' => __( 'من آراء الطلاب في لوحة التحكم', 'toppers' ), 'manual' => __( 'يدوي', 'toppers' ) ) ) );
		$repeater = new Repeater();
		$repeater->add_control( 'name', array( 'label' => __( 'الاسم', 'toppers' ), 'type' => Controls_Manager::TEXT ) );
		$repeater->add_control( 'role', array( 'label' => __( 'الصفة', 'toppers' ), 'type' => Controls_Manager::TEXT ) );
		$repeater->add_control( 'quote', array( 'label' => __( 'الرأي', 'toppers' ), 'type' => Controls_Manager::TEXTAREA ) );
		$repeater->add_control( 'photo', array( 'label' => __( 'الصورة (اختياري)', 'toppers' ), 'type' => Controls_Manager::MEDIA ) );
		$this->add_control( 'items', array( 'type' => Controls_Manager::REPEATER, 'fields' => $repeater->get_controls(), 'title_field' => '{{{ name }}}', 'condition' => array( 'source' => 'manual' ) ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		$items = array();
		if ( 'manual' === $s['source'] ) {
			$items = $s['items'];
		} else {
			$q = new WP_Query( array( 'post_type' => 'toppers_testimonial', 'posts_per_page' => 9 ) );
			foreach ( $q->posts as $post ) {
				$items[] = array(
					'name'  => get_the_title( $post ),
					'role'  => get_post_meta( $post->ID, '_toppers_role', true ),
					'quote' => wp_strip_all_tags( $post->post_content ),
					'photo' => array( 'url' => get_the_post_thumbnail_url( $post, 'thumbnail' ) ),
				);
			}
		}
		echo '<section class="section"><div class="container">';
		$this->render_section_head( $s );
		echo '<div class="grid grid-3">';
		foreach ( $items as $item ) {
			$letter = toppers_first_letter( $item['name'] );
			echo '<div class="t-card"><div class="t-stars">' . str_repeat( '<i class="fa-solid fa-star" aria-hidden="true"></i>', 5 ) . '</div><p class="t-quote">' . esc_html( $item['quote'] ) . '</p><div class="t-who">';
			if ( ! empty( $item['photo']['url'] ) ) {
				echo '<img class="t-avatar" src="' . esc_url( $item['photo']['url'] ) . '" alt="' . esc_attr( $item['name'] ) . '" style="width:44px;height:44px;border-radius:50%;object-fit:cover;">';
			} else {
				echo '<div class="t-avatar">' . esc_html( $letter ) . '</div>';
			}
			echo '<div><b>' . esc_html( $item['name'] ) . '</b><span>' . esc_html( $item['role'] ) . '</span></div></div></div>';
		}
		echo '</div></div></section>';
	}
}

class Toppers_Widget_Team extends Toppers_Widget_Base {
	public function get_name() { return 'toppers-team'; }
	public function get_title() { return __( 'فريق العمل', 'toppers' ); }
	public function get_icon() { return 'eicon-person'; }

	protected function register_controls() {
		$this->section_heading_controls( array( 'eyebrow' => 'فريق العمل', 'title' => 'نخبة الباحثين والأكاديميين' ) );
		$this->start_controls_section( 'section_source', array( 'label' => __( 'الأعضاء', 'toppers' ) ) );
		$this->add_control( 'source', array( 'label' => __( 'المصدر', 'toppers' ), 'type' => Controls_Manager::SELECT, 'default' => 'cpt', 'options' => array( 'cpt' => __( 'من فريق العمل في لوحة التحكم', 'toppers' ), 'manual' => __( 'يدوي', 'toppers' ) ) ) );
		$repeater = new Repeater();
		$repeater->add_control( 'photo', array( 'label' => __( 'الصورة', 'toppers' ), 'type' => Controls_Manager::MEDIA ) );
		$repeater->add_control( 'name', array( 'label' => __( 'الاسم', 'toppers' ), 'type' => Controls_Manager::TEXT ) );
		$repeater->add_control( 'role', array( 'label' => __( 'المسمى', 'toppers' ), 'type' => Controls_Manager::TEXT ) );
		$repeater->add_control( 'uni', array( 'label' => __( 'الجامعة', 'toppers' ), 'type' => Controls_Manager::TEXT ) );
		$this->add_control( 'items', array( 'type' => Controls_Manager::REPEATER, 'fields' => $repeater->get_controls(), 'title_field' => '{{{ name }}}', 'condition' => array( 'source' => 'manual' ) ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		$items = array();
		if ( 'manual' === $s['source'] ) {
			$items = $s['items'];
		} else {
			$q = new WP_Query( array( 'post_type' => 'toppers_team', 'posts_per_page' => 12, 'orderby' => 'menu_order title' ) );
			foreach ( $q->posts as $post ) {
				$items[] = array(
					'name'  => get_the_title( $post ),
					'role'  => get_post_meta( $post->ID, '_toppers_role', true ),
					'uni'   => get_post_meta( $post->ID, '_toppers_university', true ),
					'photo' => array( 'url' => get_the_post_thumbnail_url( $post, 'toppers-team' ) ),
				);
			}
		}
		echo '<section class="section"><div class="container">';
		$this->render_section_head( $s );
		echo '<div class="grid grid-3">';
		foreach ( $items as $item ) {
			$img = ! empty( $item['photo']['url'] ) ? $item['photo']['url'] : toppers_img( 'avatar.jpg' );
			echo '<div class="service-card"><div class="sc-img"><img src="' . esc_url( $img ) . '" alt="' . esc_attr( $item['name'] ) . '"></div><div class="sc-content"><h3>' . esc_html( $item['name'] ) . '</h3><p>' . esc_html( $item['role'] ) . '</p>';
			if ( ! empty( $item['uni'] ) ) {
				echo '<span class="sc-badge">' . esc_html( $item['uni'] ) . '</span>';
			}
			echo '</div></div>';
		}
		echo '</div></div></section>';
	}
}

class Toppers_Widget_Faq extends Toppers_Widget_Base {
	public function get_name() { return 'toppers-faq'; }
	public function get_title() { return __( 'الأسئلة الشائعة', 'toppers' ); }
	public function get_icon() { return 'eicon-accordion'; }

	protected function register_controls() {
		$this->section_heading_controls( array( 'eyebrow' => 'الأسئلة الشائعة', 'title' => 'إجابات عن أكثر الأسئلة تكرارًا' ) );
		$this->start_controls_section( 'section_items', array( 'label' => __( 'الأسئلة', 'toppers' ) ) );
		$this->add_control( 'source', array( 'label' => __( 'المصدر', 'toppers' ), 'type' => Controls_Manager::SELECT, 'default' => 'cpt', 'options' => array( 'cpt' => __( 'من الأسئلة في لوحة التحكم', 'toppers' ), 'manual' => __( 'يدوي', 'toppers' ) ) ) );
		$repeater = new Repeater();
		$repeater->add_control( 'q', array( 'label' => __( 'السؤال', 'toppers' ), 'type' => Controls_Manager::TEXT ) );
		$repeater->add_control( 'a', array( 'label' => __( 'الجواب', 'toppers' ), 'type' => Controls_Manager::TEXTAREA ) );
		$this->add_control( 'items', array( 'type' => Controls_Manager::REPEATER, 'fields' => $repeater->get_controls(), 'title_field' => '{{{ q }}}', 'condition' => array( 'source' => 'manual' ) ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		$items = array();
		if ( 'manual' === $s['source'] ) {
			$items = $s['items'];
		} else {
			$q = new WP_Query( array( 'post_type' => 'toppers_faq', 'posts_per_page' => 20, 'orderby' => 'menu_order title' ) );
			foreach ( $q->posts as $post ) {
				$items[] = array( 'q' => get_the_title( $post ), 'a' => wp_strip_all_tags( $post->post_content ) );
			}
		}
		echo '<section class="section section--alt"><div class="container" style="max-width:820px">';
		$this->render_section_head( $s );
		foreach ( $items as $i => $item ) {
			echo '<div class="faq-item' . ( 0 === $i ? ' is-open' : '' ) . '"><div class="faq-q"><span>' . esc_html( $item['q'] ) . '</span><span class="plus"></span></div><div class="faq-a"><p>' . esc_html( $item['a'] ) . '</p></div></div>';
		}
		echo '</div></section>';
	}
}

class Toppers_Widget_Cta extends Toppers_Widget_Base {
	public function get_name() { return 'toppers-cta'; }
	public function get_title() { return __( 'شريط الدعوة', 'toppers' ); }
	public function get_icon() { return 'eicon-call-to-action'; }

	protected function register_controls() {
		$this->start_controls_section( 'section_cta', array( 'label' => __( 'المحتوى', 'toppers' ) ) );
		$this->add_control( 'title', array( 'label' => __( 'العنوان', 'toppers' ), 'type' => Controls_Manager::TEXT, 'default' => 'جاهز لبدء رحلتك البحثية؟' ) );
		$this->add_control( 'lede', array( 'label' => __( 'الوصف', 'toppers' ), 'type' => Controls_Manager::TEXTAREA, 'default' => 'أرسل تفاصيل مشروعك الآن واحصل على استشارة أولية وعرض سعر مجاني خلال ساعات.' ) );
		$this->add_control( 'btn1', array( 'label' => __( 'الزر الأول', 'toppers' ), 'type' => Controls_Manager::TEXT, 'default' => 'اطلب خدمتك' ) );
		$this->add_control( 'btn1_link', array( 'label' => __( 'رابط الزر الأول', 'toppers' ), 'type' => Controls_Manager::URL ) );
		$this->add_control( 'btn2', array( 'label' => __( 'الزر الثاني', 'toppers' ), 'type' => Controls_Manager::TEXT, 'default' => 'تواصل عبر واتساب' ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		$url = ! empty( $s['btn1_link']['url'] ) ? $s['btn1_link']['url'] : toppers_page_url( 'contact', '#' );
		echo '<section class="section--tight"><div class="container"><div class="cta-band"><h2>' . esc_html( $s['title'] ) . '</h2><p>' . esc_html( $s['lede'] ) . '</p><div class="cta-actions">';
		echo '<a href="' . esc_url( $url ) . '" class="btn btn-gold">' . esc_html( $s['btn1'] ) . '</a>';
		echo '<a href="' . esc_url( toppers_whatsapp_url() ) . '" target="_blank" rel="noopener" class="btn btn-outline">' . esc_html( $s['btn2'] ) . '</a>';
		echo '</div></div></div></section>';
	}
}

class Toppers_Widget_Page_Hero extends Toppers_Widget_Base {
	public function get_name() { return 'toppers-page-hero'; }
	public function get_title() { return __( 'هيرو الصفحة الداخلية', 'toppers' ); }
	public function get_icon() { return 'eicon-banner'; }

	protected function register_controls() {
		$this->start_controls_section( 'section_hero', array( 'label' => __( 'المحتوى والصورة', 'toppers' ) ) );
		$this->add_control( 'image', array( 'label' => __( 'صورة الخلفية', 'toppers' ), 'type' => Controls_Manager::MEDIA, 'default' => array( 'url' => 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&q=80&w=1920' ) ) );
		$this->add_control( 'eyebrow', array( 'label' => __( 'التسمية', 'toppers' ), 'type' => Controls_Manager::TEXT, 'default' => 'توبرز' ) );
		$this->add_control( 'title', array( 'label' => __( 'العنوان', 'toppers' ), 'type' => Controls_Manager::TEXTAREA, 'default' => get_the_title() ) );
		$this->add_control( 'lede', array( 'label' => __( 'الوصف', 'toppers' ), 'type' => Controls_Manager::TEXTAREA ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		$img = ! empty( $s['image']['url'] ) ? $s['image']['url'] : '';
		$style = $img ? 'background:linear-gradient(135deg,rgba(14,23,48,0.95) 0%,rgba(26,45,92,0.95) 100%),url(' . esc_url( $img ) . ') center/cover no-repeat;' : '';
		echo '<section class="page-hero" style="' . esc_attr( $style ) . 'padding-top:180px;padding-bottom:120px;"><div class="container" style="text-align:center;">';
		if ( ! empty( $s['eyebrow'] ) ) {
			echo '<div class="eyebrow" style="color:var(--gold-light);justify-content:center;">' . toppers_star_svg() . esc_html( $s['eyebrow'] ) . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		echo '<h1>' . esc_html( $s['title'] ) . '</h1>';
		if ( ! empty( $s['lede'] ) ) {
			echo '<p style="max-width:70ch;margin:0 auto;color:rgba(255,255,255,.8);">' . esc_html( $s['lede'] ) . '</p>';
		}
		echo '</div></section>';
	}
}

class Toppers_Widget_Contact extends Toppers_Widget_Base {
	public function get_name() { return 'toppers-contact'; }
	public function get_title() { return __( 'نموذج التواصل', 'toppers' ); }
	public function get_icon() { return 'eicon-form-horizontal'; }

	protected function register_controls() {
		$this->start_controls_section( 'section_form', array( 'label' => __( 'النصوص', 'toppers' ) ) );
		$this->add_control( 'form_title', array( 'label' => __( 'عنوان النموذج', 'toppers' ), 'type' => Controls_Manager::TEXT, 'default' => 'أرسل طلبك' ) );
		$this->add_control( 'info_title', array( 'label' => __( 'عنوان المعلومات', 'toppers' ), 'type' => Controls_Manager::TEXT, 'default' => 'معلومات التواصل' ) );
		$this->end_controls_section();
	}

	protected function render() {
		get_template_part( 'template-parts/contact-form' );
	}
}

class Toppers_Widget_Blog_Grid extends Toppers_Widget_Base {
	public function get_name() { return 'toppers-blog-grid'; }
	public function get_title() { return __( 'شبكة المقالات', 'toppers' ); }
	public function get_icon() { return 'eicon-posts-grid'; }

	protected function register_controls() {
		$this->section_heading_controls( array( 'eyebrow' => 'أحدث المقالات', 'title' => 'مدونة توبرز الأكاديمية', 'lede' => 'نشاركك أفضل الممارسات والنصائح لإعداد الأبحاث والرسائل العلمية.' ) );
		$this->start_controls_section( 'section_q', array( 'label' => __( 'العرض', 'toppers' ) ) );
		$this->add_control( 'count', array( 'label' => __( 'عدد المقالات', 'toppers' ), 'type' => Controls_Manager::NUMBER, 'default' => 3 ) );
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		$q = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => (int) $s['count'] ) );
		echo '<section class="section section--alt"><div class="container">';
		$this->render_section_head( $s );
		echo '<div class="grid grid-3">';
		if ( $q->have_posts() ) {
			while ( $q->have_posts() ) {
				$q->the_post();
				$img = get_the_post_thumbnail_url( get_the_ID(), 'toppers-card' ) ?: toppers_img( get_post_meta( get_the_ID(), '_toppers_image', true ) ?: 'masters.jpg' );
				$cat = get_the_category();
				$badge = $cat ? $cat[0]->name : __( 'مقال', 'toppers' );
				echo '<a href="' . esc_url( get_permalink() ) . '" class="article-card"><div class="ac-img"><img src="' . esc_url( $img ) . '" alt="' . esc_attr( get_the_title() ) . '"><span class="ac-badge">' . esc_html( $badge ) . '</span></div><div class="ac-content"><div class="ac-meta"><span>' . esc_html( get_the_date() ) . '</span></div><h3>' . esc_html( get_the_title() ) . '</h3><p>' . esc_html( get_the_excerpt() ) . '</p><span class="ac-link">' . esc_html__( 'اقرأ المزيد', 'toppers' ) . ' &larr;</span></div></a>';
			}
			wp_reset_postdata();
		}
		echo '</div><div style="text-align:center;margin-top:40px;"><a href="' . esc_url( toppers_blog_url() ) . '" class="btn btn-outline">' . esc_html__( 'عرض كل المقالات', 'toppers' ) . '</a></div></div></section>';
	}
}

class Toppers_Widget_Guarantees extends Toppers_Widget_Base {
	public function get_name() { return 'toppers-guarantees'; }
	public function get_title() { return __( 'الضمانات', 'toppers' ); }
	public function get_icon() { return 'eicon-check-circle'; }

	protected function register_controls() {
		$this->section_heading_controls( array( 'eyebrow' => 'الضمانات الذهبية', 'title' => 'التزام أكاديمي ونظامي ومالي واضح' ) );
		$this->start_controls_section( 'section_items', array( 'label' => __( 'الضمانات', 'toppers' ) ) );
		$repeater = new Repeater();
		$repeater->add_control( 'image', array( 'label' => __( 'صورة', 'toppers' ), 'type' => Controls_Manager::MEDIA ) );
		$repeater->add_control( 'title', array( 'label' => __( 'العنوان', 'toppers' ), 'type' => Controls_Manager::TEXT ) );
		$repeater->add_control( 'desc', array( 'label' => __( 'الوصف', 'toppers' ), 'type' => Controls_Manager::TEXTAREA ) );
		$this->add_control(
			'items',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'     => array(
					array( 'title' => 'الضمان الأكاديمي', 'desc' => 'منهجية علمية دقيقة ومراجعة جودة قبل التسليم.' ),
					array( 'title' => 'الضمان النظامي', 'desc' => 'سرية تامة والتزام بالضوابط الأكاديمية.' ),
					array( 'title' => 'الضمان المالي', 'desc' => 'سعر واضح مسبقاً دون رسوم خفية.' ),
				),
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		echo '<section class="section"><div class="container">';
		$this->render_section_head( $s );
		echo '<div class="grid grid-3">';
		foreach ( $s['items'] as $item ) {
			echo '<div class="why-card" style="background:var(--white);color:inherit;"><h3>' . esc_html( $item['title'] ) . '</h3><p>' . esc_html( $item['desc'] ) . '</p>';
			if ( ! empty( $item['image']['url'] ) ) {
				echo '<img src="' . esc_url( $item['image']['url'] ) . '" alt="' . esc_attr( $item['title'] ) . '" style="margin-top:16px;border-radius:12px;">';
			}
			echo '</div>';
		}
		echo '</div></div></section>';
	}
}
