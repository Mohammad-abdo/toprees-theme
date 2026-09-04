<?php
/**
 * Translation plugin compatibility (WPML, Polylang, TranslatePress, Loco, etc.).
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme text domain constant.
 */
if ( ! defined( 'TK_TEXTDOMAIN' ) ) {
	define( 'TK_TEXTDOMAIN', 'tek-craft-toppres' );
}

/**
 * Translate a dynamic/runtime string for multilingual plugins.
 *
 * Static UI strings should still use __() / esc_html_e() so gettext scanners find them.
 * This helper is for Customizer values and other dynamic text.
 *
 * @param string $string String to translate.
 * @param string $name   Unique context name for string registration.
 * @return string
 */
function tk_translate( $string, $name = '' ) {
	if ( ! is_string( $string ) || '' === $string ) {
		return $string;
	}

	$name = $name ? $name : md5( $string );

	// WPML / String Translation.
	if ( has_filter( 'wpml_translate_single_string' ) ) {
		return apply_filters( 'wpml_translate_single_string', $string, TK_TEXTDOMAIN, $name );
	}

	// Polylang Pro string translations.
	if ( function_exists( 'pll__' ) ) {
		return pll__( $string );
	}

	/**
	 * Filter for other translation plugins (TranslatePress hooks DOM; this is for PHP string APIs).
	 *
	 * @param string $string Original string.
	 * @param string $name   Context name.
	 */
	return apply_filters( 'tk_translate_string', $string, $name );
}

/**
 * Get a theme mod and translate it.
 *
 * @param string $key     Theme mod key.
 * @param mixed  $default Default.
 * @return mixed
 */
function tk_get_translated_mod( $key, $default = '' ) {
	$value = tk_get_mod( $key, $default );
	if ( is_string( $value ) ) {
		return tk_translate( $value, 'theme_mod_' . $key );
	}
	return $value;
}

/**
 * Register Customizer strings with WPML / Polylang.
 */
function tk_register_translatable_strings() {
	$strings = array(
		'tk_phone'            => tk_get_mod( 'tk_phone', '+966 54 909 3465' ),
		'tk_email'            => tk_get_mod( 'tk_email', 'info@toppers-edu.com' ),
		'tk_hours'            => tk_get_mod( 'tk_hours', 'نخدمكم على مدار الساعة' ),
		'tk_footer_about'     => tk_get_mod( 'tk_footer_about', '' ),
		'tk_footer_cta_title' => tk_get_mod( 'tk_footer_cta_title', '' ),
		'tk_footer_cta_text'  => tk_get_mod( 'tk_footer_cta_text', '' ),
		'tk_header_cta_label' => tk_get_mod( 'tk_header_cta_label', 'اطلب خدمتك' ),
	);

	foreach ( $strings as $name => $value ) {
		if ( ! is_string( $value ) || '' === $value ) {
			continue;
		}

		// WPML.
		do_action( 'wpml_register_single_string', TK_TEXTDOMAIN, $name, $value );

		// Polylang.
		if ( function_exists( 'pll_register_string' ) ) {
			pll_register_string( $name, $value, 'Tek-Craft Toppres', ( false !== strpos( $name, 'about' ) || false !== strpos( $name, 'cta_text' ) ) );
		}
	}
}
add_action( 'init', 'tk_register_translatable_strings', 20 );

/**
 * Make CPT and taxonomy translatable for WPML / Polylang when those plugins load.
 */
function tk_multilingual_cpt_support() {
	// WPML: custom post types are configured in WPML settings; expose filter defaults.
	add_filter(
		'wpml_custom_field_original_data',
		function ( $data ) {
			return $data;
		}
	);
}
add_action( 'init', 'tk_multilingual_cpt_support', 5 );

/**
 * Output a language switcher compatible with major plugins.
 * Falls back to nothing when no multilingual plugin is active.
 */
function tk_language_switcher() {
	// Polylang.
	if ( function_exists( 'pll_the_languages' ) ) {
		echo '<div class="tk-lang-switcher lang-toggle-wrap">';
		pll_the_languages(
			array(
				'dropdown'               => 0,
				'show_flags'             => 0,
				'show_names'             => 1,
				'display_names_as'       => 'slug',
				'hide_if_empty'          => 1,
				'hide_current'           => 0,
			)
		);
		echo '</div>';
		return;
	}

	// WPML.
	$languages = apply_filters( 'wpml_active_languages', null, array( 'skip_missing' => 0 ) );
	if ( ! empty( $languages ) && is_array( $languages ) ) {
		echo '<div class="tk-lang-switcher lang-toggle-wrap">';
		foreach ( $languages as $lang ) {
			$url   = isset( $lang['url'] ) ? $lang['url'] : '#';
			$code  = isset( $lang['language_code'] ) ? strtoupper( $lang['language_code'] ) : '';
			$class = ! empty( $lang['active'] ) ? 'lang-toggle is-active' : 'lang-toggle';
			printf(
				'<a class="%1$s" href="%2$s" hreflang="%3$s">%4$s</a>',
				esc_attr( $class ),
				esc_url( $url ),
				esc_attr( isset( $lang['language_code'] ) ? $lang['language_code'] : '' ),
				esc_html( $code )
			);
		}
		echo '</div>';
		return;
	}

	// TranslatePress.
	if ( shortcode_exists( 'language-switcher' ) ) {
		echo '<div class="tk-lang-switcher lang-toggle-wrap">';
		echo do_shortcode( '[language-switcher]' );
		echo '</div>';
	}
}

/**
 * Whether the site should render as Arabic RTL.
 * Toppres is Arabic-first by default.
 *
 * @return bool
 */
function tk_is_arabic_site() {
	static $cached = null;
	if ( null !== $cached ) {
		return $cached;
	}

	// Prefer persisted WP language (does not recurse through locale filter).
	$wplang = (string) get_option( 'WPLANG', '' );
	if ( $wplang && 0 === strpos( strtolower( $wplang ), 'ar' ) ) {
		$cached = true;
		return true;
	}

	if ( defined( 'ICL_LANGUAGE_CODE' ) && ICL_LANGUAGE_CODE ) {
		$cached = ( 0 === strpos( strtolower( (string) ICL_LANGUAGE_CODE ), 'ar' ) );
		return $cached;
	}

	if ( function_exists( 'pll_current_language' ) ) {
		$pll = pll_current_language( 'slug' );
		if ( $pll ) {
			$cached = ( 0 === strpos( strtolower( (string) $pll ), 'ar' ) );
			return $cached;
		}
	}

	/**
	 * Filter: force Arabic RTL for this theme (default true — Arabic-first brand).
	 *
	 * @param bool $is_arabic Whether to use Arabic RTL.
	 */
	$cached = (bool) apply_filters( 'tk_force_arabic_rtl', true );
	return $cached;
}

/**
 * Prefer Arabic locale for the front end (Arabic-first theme).
 *
 * @param string $locale Locale.
 * @return string
 */
function tk_force_arabic_locale( $locale ) {
	static $guard = false;
	if ( $guard ) {
		return $locale ? $locale : 'ar';
	}
	$guard = true;

	$locale_l = strtolower( (string) $locale );
	if ( $locale_l && 0 === strpos( $locale_l, 'ar' ) ) {
		$guard = false;
		return $locale;
	}

	if ( tk_is_arabic_site() ) {
		$guard = false;
		return 'ar';
	}

	$guard = false;
	return $locale;
}
add_filter( 'locale', 'tk_force_arabic_locale', 1 );

/**
 * Force WP text direction to RTL (needed when Arabic language pack is missing).
 */
function tk_force_wp_rtl_direction() {
	if ( ! tk_is_arabic_site() ) {
		return;
	}
	global $wp_locale;
	if ( $wp_locale instanceof WP_Locale ) {
		$wp_locale->text_direction = 'rtl';
	}
}
add_action( 'init', 'tk_force_wp_rtl_direction', 0 );
add_action( 'wp_loaded', 'tk_force_wp_rtl_direction', 0 );

/**
 * Ensure html lang/dir match Arabic RTL (single clean attributes).
 *
 * @param string $output language_attributes output.
 * @return string
 */
function tk_language_attributes( $output ) {
	if ( ! tk_is_arabic_site() ) {
		return $output;
	}
	return 'lang="ar" dir="rtl"';
}
add_filter( 'language_attributes', 'tk_language_attributes', 99 );

/**
 * Mark body as RTL for CSS hooks even if WP core missed it.
 *
 * @param array $classes Body classes.
 * @return array
 */
function tk_rtl_body_class( $classes ) {
	if ( tk_is_arabic_site() ) {
		$classes[] = 'rtl';
		$classes[] = 'tk-rtl';
		$classes  = array_diff( $classes, array( 'ltr' ) );
	}
	return array_values( array_unique( $classes ) );
}
add_filter( 'body_class', 'tk_rtl_body_class', 20 );

/**
 * Declare theme support for common translation plugins.
 */
function tk_translation_plugin_support() {
	// Polylang / WPML discover this via Text Domain in style.css.
	load_theme_textdomain( 'tek-craft-toppres', TK_THEME_DIR . '/languages' );
}
add_action( 'after_setup_theme', 'tk_translation_plugin_support', 1 );

/**
 * Star motif SVG used across the design.
 *
 * @return string
 */
function tk_star_svg() {
	if ( function_exists( 'tk_icon' ) ) {
		return tk_icon( 'sparkles', array( 'class' => 'star-ic', 'size' => 16 ) );
	}
	return '<svg class="star-ic" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 0l2.9 8.4L24 12l-9.1 3.6L12 24l-2.9-8.4L0 12l9.1-3.6L12 0z"/></svg>';
}

