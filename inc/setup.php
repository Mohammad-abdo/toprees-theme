<?php
/**
 * Theme setup.
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sets up theme defaults and registers support for WordPress features.
 */
function tk_theme_setup() {
	load_theme_textdomain( 'tek-craft-toppres', TK_THEME_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
			'navigation-widgets',
		)
	);

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 240,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'fbf8f1',
		)
	);

	register_nav_menus(
		array(
			'primary'         => __( 'Primary Menu', 'tek-craft-toppres' ),
			'footer'          => __( 'Footer Quick Links', 'tek-craft-toppres' ),
			'footer_services' => __( 'Footer Services', 'tek-craft-toppres' ),
		)
	);

	add_image_size( 'tk-card', 640, 420, true );
	add_image_size( 'tk-hero', 1920, 1080, true );
}
add_action( 'after_setup_theme', 'tk_theme_setup' );

/**
 * Set content width.
 */
function tk_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'tk_content_width', 1200 );
}
add_action( 'after_setup_theme', 'tk_content_width', 0 );

/**
 * Add body classes for RTL and Elementor context.
 *
 * @param array $classes Body classes.
 * @return array
 */
function tk_body_classes( $classes ) {
	if ( is_rtl() ) {
		$classes[] = 'tk-rtl';
	}

	if ( tk_is_elementor_active() ) {
		$classes[] = 'tk-elementor';
	}

	if ( is_singular() && tk_is_elementor_page() ) {
		$classes[] = 'tk-elementor-page';
	}

	return $classes;
}
add_filter( 'body_class', 'tk_body_classes' );
