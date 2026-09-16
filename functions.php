<?php
/**
 * Toppers theme bootstrap.
 *
 * @package Toppers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'TOPPERS_VERSION' ) ) {
	define( 'TOPPERS_VERSION', '1.2.2' );
}
if ( ! defined( 'TOPPERS_DIR' ) ) {
	define( 'TOPPERS_DIR', get_template_directory() );
}
if ( ! defined( 'TOPPERS_URI' ) ) {
	define( 'TOPPERS_URI', get_template_directory_uri() );
}

require_once TOPPERS_DIR . '/inc/helpers.php';
require_once TOPPERS_DIR . '/inc/setup.php';
require_once TOPPERS_DIR . '/inc/cpt.php';
require_once TOPPERS_DIR . '/inc/customizer.php';
require_once TOPPERS_DIR . '/inc/admin-content.php';
require_once TOPPERS_DIR . '/inc/demo-content.php';
require_once TOPPERS_DIR . '/inc/elementor.php';
