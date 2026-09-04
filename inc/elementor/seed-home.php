<?php
/**
 * Seed Home page with Elementor widgets so content is editable.
 * Run: wp eval-file wp-content/themes/tek-craft-toppres/inc/elementor/seed-home.php
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Generate Elementor-style element ID.
 *
 * @return string
 */
if ( ! function_exists( 'tk_seed_el_id' ) ) {
	/**
	 * @return string
	 */
	function tk_seed_el_id() {
		return substr( bin2hex( random_bytes( 4 ) ), 0, 7 );
	}
}

/**
 * Wrap a widget in a full-width container.
 *
 * @param string $widget_type Widget name.
 * @param array  $settings    Settings.
 * @return array
 */
if ( ! function_exists( 'tk_seed_widget_container' ) ) {
	/**
	 * @param string $widget_type Widget name.
	 * @param array  $settings    Settings.
	 * @return array
	 */
	function tk_seed_widget_container( $widget_type, $settings = array() ) {
		return array(
			'id'       => tk_seed_el_id(),
			'elType'   => 'container',
			'isInner'  => false,
			'settings' => array(
				'content_width'  => 'full',
				'flex_direction' => 'column',
				'flex_gap'       => array(
					'unit'     => 'px',
					'size'     => 0,
					'column'   => '0',
					'row'      => '0',
					'isLinked' => true,
				),
				'padding'        => array(
					'unit'     => 'px',
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true,
				),
				'margin'         => array(
					'unit'     => 'px',
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true,
				),
				'boxed_width'    => array(
					'unit' => 'px',
					'size' => 1200,
				),
			),
			'elements' => array(
				array(
					'id'         => tk_seed_el_id(),
					'elType'     => 'widget',
					'widgetType' => $widget_type,
					'settings'   => $settings,
					'elements'   => array(),
				),
			),
		);
	}
}

$home_id = (int) get_option( 'page_on_front' );
if ( ! $home_id ) {
	$home_id = wp_insert_post(
		array(
			'post_title'  => 'Home',
			'post_name'   => 'home',
			'post_status' => 'publish',
			'post_type'   => 'page',
		)
	);
	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $home_id );
}

$elements = array(
	tk_seed_widget_container(
		'tk_hero_slider',
		array(
			'slides' => array(
				array(
					'bg_image'     => array( 'url' => function_exists( 'tk_default_media_url' ) ? tk_default_media_url( 'hero1' ) : 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&q=80&w=1920' ),
					'eyebrow'      => 'توبرز للاستشارات والحلول البحثية',
					'title'        => 'من فكرة البحث',
					'title_accent' => 'إلى التسليم النهائي',
					'lede'         => 'نرافق طلاب البكالوريوس والماجستير والدكتوراه والباحثين في كل محطة من رحلتهم الأكاديمية.',
					'btn1_text'    => 'اطلب خدمتك الآن',
					'btn1_link'    => array( 'url' => home_url( '/contact/' ) ),
					'btn2_text'    => 'تصفح الخدمات',
					'btn2_link'    => array( 'url' => home_url( '/services/' ) ),
				),
				array(
					'bg_image'     => array( 'url' => function_exists( 'tk_default_media_url' ) ? tk_default_media_url( 'hero2' ) : 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&q=80&w=1920' ),
					'eyebrow'      => 'توبرز للاستشارات والحلول البحثية',
					'title'        => 'رسائل الماجستير',
					'title_accent' => 'بمنهجية دقيقة',
					'lede'         => 'مرافقة كاملة من اختيار العنوان حتى المناقشة والتنسيق النهائي وفق دليل جامعتك.',
					'btn1_text'    => 'عرض الخدمات',
					'btn1_link'    => array( 'url' => home_url( '/services/' ) ),
					'btn2_text'    => '',
				),
				array(
					'bg_image'     => array( 'url' => function_exists( 'tk_default_media_url' ) ? tk_default_media_url( 'hero3' ) : 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&q=80&w=1920' ),
					'eyebrow'      => 'توبرز للاستشارات والحلول البحثية',
					'title'        => 'التحليل الإحصائي',
					'title_accent' => 'والترجمة الاحترافية',
					'lede'         => 'تحليل بيانات دقيق وترجمة أكاديمية بمصطلحات صحيحة تناسب النشر والمحكّمين.',
					'btn1_text'    => 'تواصل معنا',
					'btn1_link'    => array( 'url' => home_url( '/contact/' ) ),
					'btn2_text'    => '',
				),
			),
		)
	),
	tk_seed_widget_container( 'tk_journey' ),
	tk_seed_widget_container( 'tk_services' ),
	tk_seed_widget_container( 'tk_why_us' ),
	tk_seed_widget_container( 'tk_testimonials' ),
	tk_seed_widget_container( 'tk_articles' ),
	tk_seed_widget_container( 'tk_cta' ),
);

$json = wp_json_encode( $elements );

update_post_meta( $home_id, '_elementor_edit_mode', 'builder' );
update_post_meta( $home_id, '_elementor_template_type', 'wp-page' );
update_post_meta( $home_id, '_elementor_version', defined( 'ELEMENTOR_VERSION' ) ? ELEMENTOR_VERSION : '3.0.0' );
update_post_meta( $home_id, '_elementor_data', wp_slash( $json ) );
update_post_meta( $home_id, '_elementor_page_settings', array() );
update_post_meta( $home_id, '_wp_page_template', 'templates/elementor-fullwidth.php' );

// Clear Elementor CSS cache for this page.
delete_post_meta( $home_id, '_elementor_css' );
if ( class_exists( '\Elementor\Plugin' ) ) {
	\Elementor\Plugin::$instance->files_manager->clear_cache();
}

if ( class_exists( 'WP_CLI' ) ) {
	WP_CLI::success( "Home page #{$home_id} seeded with Elementor TK widgets." );
}
