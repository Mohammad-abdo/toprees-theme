<?php
/**
 * Elementor compatibility and custom widgets.
 *
 * @package Toppers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'after_setup_theme', 'toppers_elementor_support' );
function toppers_elementor_support() {
	add_theme_support( 'elementor' );
}

add_action( 'elementor/theme/register_locations', 'toppers_register_elementor_locations' );
function toppers_register_elementor_locations( $manager ) {
	$manager->register_all_core_locations();
}

add_action( 'elementor/widgets/register', 'toppers_register_elementor_widgets' );
function toppers_register_elementor_widgets( $widgets_manager ) {
	if ( ! did_action( 'elementor/loaded' ) ) {
		return;
	}
	require_once TOPPERS_DIR . '/elementor/widgets.php';

	$widgets_manager->register( new \Toppers_Widget_Hero_Slider() );
	$widgets_manager->register( new \Toppers_Widget_Journey() );
	$widgets_manager->register( new \Toppers_Widget_Services_Grid() );
	$widgets_manager->register( new \Toppers_Widget_Why_Us() );
	$widgets_manager->register( new \Toppers_Widget_Testimonials() );
	$widgets_manager->register( new \Toppers_Widget_Team() );
	$widgets_manager->register( new \Toppers_Widget_Faq() );
	$widgets_manager->register( new \Toppers_Widget_Cta() );
	$widgets_manager->register( new \Toppers_Widget_Page_Hero() );
	$widgets_manager->register( new \Toppers_Widget_Contact() );
	$widgets_manager->register( new \Toppers_Widget_Blog_Grid() );
	$widgets_manager->register( new \Toppers_Widget_Guarantees() );
}

add_action( 'elementor/elements/categories_registered', 'toppers_elementor_category' );
function toppers_elementor_category( $elements_manager ) {
	$elements_manager->add_category(
		'toppers',
		array(
			'title' => __( 'توبرز', 'toppers' ),
			'icon'  => 'fa fa-star',
		)
	);
}

add_action( 'elementor/editor/after_enqueue_styles', 'toppers_elementor_editor_styles' );
function toppers_elementor_editor_styles() {
	wp_enqueue_style( 'toppers-theme', TOPPERS_URI . '/assets/css/theme.css', array(), TOPPERS_VERSION );
	wp_enqueue_style( 'toppers-compat', TOPPERS_URI . '/assets/css/elementor-compat.css', array( 'toppers-theme' ), TOPPERS_VERSION );
}

add_filter( 'elementor/theme/need_override_location', 'toppers_need_override_location', 10, 2 );
function toppers_need_override_location( $need, $location ) {
	return $need;
}
