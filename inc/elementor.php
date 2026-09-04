<?php
/**
 * Elementor compatibility.
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Elementor Theme Builder locations (Pro).
 *
 * @param object $elementor_theme_manager Locations manager.
 */
function tk_register_elementor_locations( $elementor_theme_manager ) {
	if ( method_exists( $elementor_theme_manager, 'register_all_core_location' ) ) {
		$elementor_theme_manager->register_all_core_location();
	}
}
add_action( 'elementor/theme/register_locations', 'tk_register_elementor_locations' );

/**
 * Theme support for Elementor.
 */
function tk_elementor_support() {
	add_theme_support( 'elementor' );
}
add_action( 'after_setup_theme', 'tk_elementor_support', 20 );

/**
 * Load widgets after Elementor is ready.
 */
function tk_load_elementor_widgets() {
	require_once TK_THEME_DIR . '/inc/elementor/widget-style-controls.php';
	require_once TK_THEME_DIR . '/inc/elementor/widgets-loader.php';
}
add_action( 'elementor/init', 'tk_load_elementor_widgets' );

/**
 * Ensure Elementor can edit pages, posts, and services.
 */
function tk_elementor_ensure_cpt_support() {
	if ( ! tk_is_elementor_active() ) {
		return;
	}

	$needed = array( 'page', 'post', 'tk_service' );
	$current = get_option( 'elementor_cpt_support' );
	if ( ! is_array( $current ) ) {
		$current = array();
	}
	$merged = array_values( array_unique( array_merge( $current, $needed ) ) );
	if ( $merged !== $current ) {
		update_option( 'elementor_cpt_support', $merged );
	}

	// Let Elementor own colors/typography in Style panels.
	if ( 'yes' !== get_option( 'elementor_disable_color_schemes' ) ) {
		update_option( 'elementor_disable_color_schemes', 'yes' );
	}
	if ( 'yes' !== get_option( 'elementor_disable_typography_schemes' ) ) {
		update_option( 'elementor_disable_typography_schemes', 'yes' );
	}
}
add_action( 'init', 'tk_elementor_ensure_cpt_support', 5 );

/**
 * Seed Elementor defaults once after theme activation.
 */
function tk_elementor_seed_defaults() {
	if ( get_option( 'tk_elementor_kit_seeded_v2' ) ) {
		return;
	}

	update_option( 'elementor_container_width', 1200 );
	update_option( 'elementor_viewport_md', 768 );
	update_option( 'elementor_viewport_lg', 1024 );
	update_option( 'elementor_cpt_support', array( 'page', 'post', 'tk_service' ) );
	update_option( 'elementor_disable_color_schemes', 'yes' );
	update_option( 'elementor_disable_typography_schemes', 'yes' );

	$kit_id = (int) get_option( 'elementor_active_kit' );
	if ( $kit_id && class_exists( '\Elementor\Plugin' ) ) {
		$settings = get_post_meta( $kit_id, '_elementor_page_settings', true );
		if ( ! is_array( $settings ) ) {
			$settings = array();
		}
		$settings['system_colors'] = isset( $settings['system_colors'] ) ? $settings['system_colors'] : array();
		$settings['default_generic_fonts'] = 'Cairo, Tajawal, sans-serif';
		$settings['container_width'] = array( 'unit' => 'px', 'size' => 1200 );
		$settings['space_between_widgets'] = array( 'unit' => 'px', 'size' => 0 );
		update_post_meta( $kit_id, '_elementor_page_settings', $settings );
	}

	update_option( 'tk_elementor_kit_seeded_v2', 1 );
}
add_action( 'after_switch_theme', 'tk_elementor_seed_defaults' );
add_action( 'admin_init', 'tk_elementor_seed_defaults' );

/**
 * Allow Services CPT in Elementor public post types list.
 *
 * @param array $post_types CPT list.
 * @return array
 */
function tk_elementor_cpt_support( $post_types ) {
	$post_types['tk_service'] = 'tk_service';
	$post_types['post']       = 'post';
	$post_types['page']       = 'page';
	return $post_types;
}
add_filter( 'elementor/utils/get_public_post_types', 'tk_elementor_cpt_support' );

/**
 * Body class for Elementor preview.
 *
 * @param array $classes Body classes.
 * @return array
 */
function tk_elementor_editor_body_class( $classes ) {
	if ( isset( $_GET['elementor-preview'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$classes[] = 'tk-elementor-preview';
	}
	return $classes;
}
add_filter( 'body_class', 'tk_elementor_editor_body_class' );

/**
 * Enqueue theme CSS inside Elementor editor + preview so widgets match front.
 */
function tk_elementor_enqueue_preview_styles() {
	$ver = defined( 'TK_THEME_VERSION' ) ? TK_THEME_VERSION : '1.0.0';
	wp_enqueue_style( 'tk-base', TK_THEME_URI . '/assets/css/base.css', array(), $ver );
	wp_enqueue_style( 'tk-header-footer', TK_THEME_URI . '/assets/css/header-footer.css', array( 'tk-base' ), $ver );
	wp_enqueue_style( 'tk-components', TK_THEME_URI . '/assets/css/components.css', array( 'tk-base' ), $ver );
	wp_enqueue_style( 'tk-blog', TK_THEME_URI . '/assets/css/blog.css', array( 'tk-components' ), $ver );
	wp_enqueue_style( 'tk-wordpress', TK_THEME_URI . '/assets/css/wordpress.css', array( 'tk-blog' ), $ver );
	wp_enqueue_style( 'tk-tweaks', TK_THEME_URI . '/assets/css/theme-tweaks.css', array( 'tk-wordpress' ), $ver );
}
add_action( 'elementor/preview/enqueue_styles', 'tk_elementor_enqueue_preview_styles' );
add_action( 'elementor/editor/after_enqueue_styles', 'tk_elementor_enqueue_preview_styles' );

/**
 * Load theme JS inside Elementor preview so slider/UX works while editing.
 */
function tk_elementor_enqueue_preview_scripts() {
	wp_enqueue_script(
		'tk-main',
		TK_THEME_URI . '/assets/js/main.js',
		array(),
		defined( 'TK_THEME_VERSION' ) ? TK_THEME_VERSION : '1.0.0',
		true
	);
}
add_action( 'elementor/preview/enqueue_scripts', 'tk_elementor_enqueue_preview_scripts' );

/**
 * Default radius CSS variable for Elementor + soft radius hint.
 */
function tk_elementor_kit_defaults() {
	if ( ! tk_is_elementor_active() ) {
		return;
	}
	add_action(
		'wp_head',
		static function () {
			echo '<style id="tk-elementor-radius">:root{--e-global-border-radius:8px;}</style>';
		},
		100
	);
}
add_action( 'wp', 'tk_elementor_kit_defaults' );
