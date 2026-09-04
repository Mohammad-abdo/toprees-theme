<?php
/**
 * Asset enqueue.
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue front-end styles and scripts.
 */
function tk_enqueue_assets() {
	$ver = TK_THEME_VERSION;

	$locale = determine_locale();

	// Respect active language from multilingual plugins.
	if ( defined( 'ICL_LANGUAGE_CODE' ) && ICL_LANGUAGE_CODE ) {
		$locale = ICL_LANGUAGE_CODE;
	} elseif ( function_exists( 'pll_current_language' ) ) {
		$pll = pll_current_language( 'locale' );
		if ( $pll ) {
			$locale = $pll;
		}
	}

	$is_ar = ( 0 === strpos( strtolower( (string) $locale ), 'ar' ) ) || is_rtl();

	if ( $is_ar ) {
		wp_enqueue_style(
			'tk-fonts',
			'https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&family=Tajawal:wght@400;500;700&display=swap',
			array(),
			null
		);
	} else {
		wp_enqueue_style(
			'tk-fonts',
			'https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap',
			array(),
			null
		);
	}

	wp_enqueue_style( 'tk-base', TK_THEME_URI . '/assets/css/base.css', array( 'tk-fonts' ), $ver );
	wp_enqueue_style( 'tk-components', TK_THEME_URI . '/assets/css/components.css', array( 'tk-base' ), $ver );
	wp_enqueue_style( 'tk-header-footer', TK_THEME_URI . '/assets/css/header-footer.css', array( 'tk-components' ), $ver );
	wp_enqueue_style( 'tk-blog', TK_THEME_URI . '/assets/css/blog.css', array( 'tk-components' ), $ver );
	wp_enqueue_style( 'tk-wordpress', TK_THEME_URI . '/assets/css/wordpress.css', array( 'tk-blog' ), $ver );
	wp_enqueue_style( 'tk-tweaks', TK_THEME_URI . '/assets/css/theme-tweaks.css', array( 'tk-wordpress' ), $ver );
	wp_enqueue_style( 'tk-theme-style', get_stylesheet_uri(), array( 'tk-tweaks' ), $ver );

	wp_enqueue_script(
		'tk-main',
		TK_THEME_URI . '/assets/js/main.js',
		array(),
		$ver,
		array(
			'strategy'  => 'defer',
			'in_footer' => true,
		)
	);

	wp_localize_script(
		'tk-main',
		'tkTheme',
		array(
			'homeUrl' => esc_url( home_url( '/' ) ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'tk_enqueue_assets' );

/**
 * Add preconnect for Google Fonts.
 *
 * @param array  $urls          URLs to print for resource hints.
 * @param string $relation_type Relation type.
 * @return array
 */
function tk_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.googleapis.com',
		);
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'tk_resource_hints', 10, 2 );
