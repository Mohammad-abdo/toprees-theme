<?php
/**
 * Template hooks.
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Wrap embeds for responsive behavior (non-Elementor contexts).
 *
 * @param string $html Embed HTML.
 * @return string
 */
function tk_wrap_embed( $html ) {
	if ( false !== strpos( $html, 'tk-embed' ) ) {
		return $html;
	}
	return '<div class="tk-embed">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'tk_wrap_embed', 10 );
add_filter( 'video_embed_html', 'tk_wrap_embed' );

/**
 * Avoid wpautop breaking imported HTML page layouts.
 *
 * @param string $content Content.
 * @return string
 */
function tk_maybe_disable_wpautop( $content ) {
	if ( is_singular( 'page' ) && ( false !== strpos( $content, 'page-hero' ) || false !== strpos( $content, 'section class' ) || false !== strpos( $content, '<style' ) ) ) {
		remove_filter( 'the_content', 'wpautop' );
	}
	return $content;
}
add_filter( 'the_content', 'tk_maybe_disable_wpautop', 1 );
