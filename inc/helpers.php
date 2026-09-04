<?php
/**
 * Theme helper functions.
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Whether Elementor (free or pro) is active.
 *
 * @return bool
 */
function tk_is_elementor_active() {
	return did_action( 'elementor/loaded' ) || class_exists( '\Elementor\Plugin' );
}

/**
 * Whether Elementor Pro Theme Builder can render a location.
 *
 * Prefer calling elementor_theme_do_location() in templates; this helper
 * only checks that the Theme Builder API is available.
 *
 * @param string $location Location slug (header, footer, single, archive).
 * @return bool
 */
function tk_elementor_has_location( $location ) {
	unset( $location );
	return function_exists( 'elementor_theme_do_location' ) && class_exists( '\ElementorPro\Plugin' );
}

/**
 * Get a theme mod with sanitization fallback.
 *
 * @param string $key     Theme mod key.
 * @param mixed  $default Default value.
 * @return mixed
 */
function tk_get_mod( $key, $default = '' ) {
	$value = get_theme_mod( $key, $default );
	if ( null === $value || '' === $value ) {
		$value = $default;
	}
	return $value;
}

/**
 * Build a WhatsApp chat URL from Customizer phone number.
 *
 * @return string
 */
function tk_whatsapp_url() {
	$number = preg_replace( '/\D+/', '', (string) tk_get_mod( 'tk_whatsapp', '966549093465' ) );
	if ( '' === $number ) {
		return '';
	}
	return 'https://wa.me/' . $number;
}

/**
 * Whether the current document is built with Elementor.
 *
 * @param int|null $post_id Optional post ID.
 * @return bool
 */
function tk_is_elementor_page( $post_id = null ) {
	if ( ! tk_is_elementor_active() ) {
		return false;
	}

	$post_id = $post_id ? (int) $post_id : get_the_ID();
	if ( ! $post_id ) {
		return false;
	}

	$mode = get_post_meta( $post_id, '_elementor_edit_mode', true );
	if ( 'builder' !== $mode ) {
		return false;
	}

	$data = get_post_meta( $post_id, '_elementor_data', true );
	return ! empty( $data ) && '[]' !== $data;
}

/**
 * Approximate reading time label for the current post.
 *
 * @return string
 */
function tk_reading_time() {
	$content = get_post_field( 'post_content', get_the_ID() );
	$words   = str_word_count( wp_strip_all_tags( (string) $content ) );
	$mins    = max( 1, (int) ceil( $words / 180 ) );
	return sprintf(
		/* translators: %d: minutes */
		_n( '%d دقيقة قراءة', '%d دقائق قراءة', $mins, 'tek-craft-toppres' ),
		$mins
	);
}

/**
 * Default media URLs matching the static HTML (home hero + interiors).
 *
 * @param string $key hero1|hero2|hero3|article|about|page|service.
 * @return string
 */
function tk_default_media_url( $key = 'hero1' ) {
	$map = array(
		'hero1'   => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&q=80&w=1920',
		'hero2'   => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&q=80&w=1920',
		'hero3'   => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&q=80&w=1920',
		'article' => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&q=80&w=1600&h=900',
		'about'   => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&q=80&w=800&h=900',
		'page'    => 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&q=80&w=1920&h=600',
		'service' => 'https://images.unsplash.com/photo-1513258496099-48168024aec0?auto=format&fit=crop&q=80&w=1920&h=600',
	);
	return $map[ $key ] ?? $map['hero1'];
}
