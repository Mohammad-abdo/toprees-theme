<?php
/**
 * Tek-Craft Toppres theme bootstrap.
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'TK_THEME_VERSION', '1.5.5' );
define( 'TK_THEME_DIR', get_template_directory() );
define( 'TK_THEME_URI', get_template_directory_uri() );

$tk_includes = array(
	'/inc/helpers.php',
	'/inc/icons.php',
	'/inc/i18n.php',
	'/inc/nav-walker.php',
	'/inc/setup.php',
	'/inc/enqueue.php',
	'/inc/customizer.php',
	'/inc/template-functions.php',
	'/inc/template-hooks.php',
	'/inc/theme-images.php',
	'/inc/localize-media.php',
	'/inc/theme-activation.php',
	'/inc/elementor.php',
	'/inc/performance.php',
	'/inc/seo.php',
	'/inc/cpt-services.php',
);

foreach ( $tk_includes as $tk_file ) {
	$tk_path = TK_THEME_DIR . $tk_file;
	if ( file_exists( $tk_path ) ) {
		require_once $tk_path;
	}
}
