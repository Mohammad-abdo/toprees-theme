<?php
/**
 * Performance-related tweaks.
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Disable WordPress emoji scripts/styles on the front end.
 */
function tk_disable_emojis() {
	if ( is_admin() ) {
		return;
	}

	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'tk_disable_emojis' );

/**
 * Remove emoji DNS prefetch.
 *
 * @param array  $urls          URLs.
 * @param string $relation_type Relation.
 * @return array
 */
function tk_disable_emoji_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' === $relation_type ) {
		$urls = array_filter(
			$urls,
			function ( $url ) {
				return false === strpos( $url, 'https://s.w.org/images/core/emoji/' );
			}
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'tk_disable_emoji_dns_prefetch', 10, 2 );

/**
 * Remove generator meta for slight hardening / cleanliness.
 */
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );

/**
 * Disable embeds script when not needed on simple marketing pages.
 */
function tk_dequeue_wp_embed() {
	if ( is_admin() ) {
		return;
	}
	wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'tk_dequeue_wp_embed' );

/**
 * Native lazy-loading for content images (keep first hero/featured eager).
 *
 * @param string $content Post content.
 * @return string
 */
function tk_lazy_content_images( $content ) {
	if ( is_admin() || false === strpos( $content, '<img' ) ) {
		return $content;
	}

	$first = true;
	return preg_replace_callback(
		'/<img\b[^>]*>/i',
		static function ( $m ) use ( &$first ) {
			$tag = $m[0];
			if ( false !== stripos( $tag, 'loading=' ) ) {
				$first = false;
				return $tag;
			}
			if ( $first ) {
				$first = false;
				if ( false === stripos( $tag, 'fetchpriority=' ) ) {
					$tag = str_replace( '<img', '<img fetchpriority="high"', $tag );
				}
				return $tag;
			}
			return str_replace( '<img', '<img loading="lazy" decoding="async"', $tag );
		},
		$content
	);
}
add_filter( 'the_content', 'tk_lazy_content_images', 20 );

/**
 * Default attachment images to lazy + async decode.
 *
 * @param array $attr Image attributes.
 * @return array
 */
function tk_attachment_image_attrs( $attr ) {
	if ( empty( $attr['loading'] ) ) {
		$attr['loading'] = 'lazy';
	}
	if ( empty( $attr['decoding'] ) ) {
		$attr['decoding'] = 'async';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'tk_attachment_image_attrs', 10, 1 );

/**
 * Limit Heartbeat on the front end.
 */
function tk_disable_front_heartbeat() {
	if ( ! is_admin() ) {
		wp_deregister_script( 'heartbeat' );
	}
}
add_action( 'init', 'tk_disable_front_heartbeat', 1 );

/**
 * Defer non-critical Google Fonts stylesheet.
 *
 * @param string $html   Link tag HTML.
 * @param string $handle Style handle.
 * @param string $href   Stylesheet URL.
 * @param string $media  Media attribute.
 * @return string
 */
function tk_defer_font_css( $html, $handle, $href, $media ) {
	if ( 'tk-fonts' !== $handle ) {
		return $html;
	}
	$href = esc_url( $href );
	return '<link rel="preload" as="style" href="' . $href . '" onload="this.onload=null;this.rel=\'stylesheet\'">' .
		'<noscript><link rel="stylesheet" href="' . $href . '"></noscript>';
}
add_filter( 'style_loader_tag', 'tk_defer_font_css', 10, 4 );

/**
 * Skip blog CSS on pages that never show the blog grid.
 */
function tk_conditional_assets() {
	if ( is_admin() ) {
		return;
	}
	$need_blog = is_home() || is_singular( 'post' ) || is_archive() || is_search() || is_category() || is_tag();
	if ( ! $need_blog && ! is_front_page() ) {
		wp_dequeue_style( 'tk-blog' );
	}
}
add_action( 'wp_enqueue_scripts', 'tk_conditional_assets', 100 );
