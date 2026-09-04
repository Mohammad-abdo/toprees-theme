<?php
/**
 * Theme activation: import content + seed Elementor sections (no HTML dump).
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Run full content import once after theme switch.
 */
function tk_on_theme_activation() {
	update_option( 'tk_pending_html_import', 1 );
	// Arabic-first site language for RTL.
	if ( ! get_option( 'WPLANG' ) ) {
		update_option( 'WPLANG', 'ar' );
	}
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'tk_on_theme_activation' );

/**
 * Process pending import (admin or front).
 */
function tk_maybe_run_pending_import() {
	if ( ! get_option( 'tk_pending_html_import' ) ) {
		return;
	}

	if ( get_transient( 'tk_importing_now' ) ) {
		return;
	}
	set_transient( 'tk_importing_now', 1, 300 );

	if ( ! class_exists( 'WP_CLI' ) ) {
		/**
		 * Minimal WP_CLI shim for include context.
		 */
		class WP_CLI {
			public static function log( $msg ) {
				if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
					error_log( '[TK Import] ' . $msg ); // phpcs:ignore
				}
			}
			public static function warning( $msg ) {
				self::log( 'WARN: ' . $msg );
			}
			public static function success( $msg ) {
				self::log( 'OK: ' . $msg );
			}
			public static function error( $msg ) {
				self::log( 'ERR: ' . $msg );
			}
		}
	}

	update_option( 'elementor_cpt_support', array( 'page', 'post', 'tk_service' ) );
	update_option( 'elementor_disable_color_schemes', 'yes' );
	update_option( 'elementor_disable_typography_schemes', 'yes' );

	$script = TK_THEME_DIR . '/inc/migrate-from-html.php';
	if ( file_exists( $script ) ) {
		include $script;
	}

	if ( class_exists( '\Elementor\Plugin' ) ) {
		$home_seed = TK_THEME_DIR . '/inc/elementor/seed-home.php';
		if ( file_exists( $home_seed ) ) {
			ob_start();
			include $home_seed;
			ob_end_clean();
		}

		$pages_seed = TK_THEME_DIR . '/inc/elementor/seed-pages.php';
		if ( file_exists( $pages_seed ) ) {
			ob_start();
			include $pages_seed;
			ob_end_clean();
		}

		\Elementor\Plugin::$instance->files_manager->clear_cache();
	}

	if ( function_exists( 'tk_localize_all_site_images' ) ) {
		tk_localize_all_site_images();
	}

	delete_option( 'tk_pending_html_import' );
	delete_transient( 'tk_importing_now' );
	update_option( 'tk_html_import_done', time() );
}
add_action( 'init', 'tk_maybe_run_pending_import', 30 );

/**
 * Admin notice with import / reseed actions.
 */
function tk_import_admin_notice() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	if ( isset( $_GET['tk_run_import'] ) && check_admin_referer( 'tk_run_import' ) ) { // phpcs:ignore
		update_option( 'tk_pending_html_import', 1 );
		delete_transient( 'tk_importing_now' );
		tk_maybe_run_pending_import();
		echo '<div class="notice notice-success"><p>' . esc_html__( 'تم استيراد المحتوى وتسييد صفحات Elementor كسكاشن قابلة للتحرير.', 'tek-craft-toppres' ) . '</p></div>';
		return;
	}

	if ( isset( $_GET['tk_reseed_pages'] ) && check_admin_referer( 'tk_reseed_pages' ) ) { // phpcs:ignore
		$pages_seed = TK_THEME_DIR . '/inc/elementor/seed-pages.php';
		if ( file_exists( $pages_seed ) ) {
			ob_start();
			include $pages_seed;
			ob_end_clean();
		}
		$home_seed = TK_THEME_DIR . '/inc/elementor/seed-home.php';
		if ( file_exists( $home_seed ) ) {
			ob_start();
			include $home_seed;
			ob_end_clean();
		}
		if ( class_exists( '\Elementor\Plugin' ) ) {
			\Elementor\Plugin::$instance->files_manager->clear_cache();
		}
		echo '<div class="notice notice-success"><p>' . esc_html__( 'تمت إعادة بناء صفحات Elementor كسكاشن TK حقيقية.', 'tek-craft-toppres' ) . '</p></div>';
		return;
	}

	$url       = wp_nonce_url( admin_url( 'themes.php?tk_run_import=1' ), 'tk_run_import' );
	$reseed    = wp_nonce_url( admin_url( 'themes.php?tk_reseed_pages=1' ), 'tk_reseed_pages' );
	$media_url = wp_nonce_url( admin_url( 'themes.php?tk_localize_media=1' ), 'tk_localize_media' );

	if ( isset( $_GET['tk_localize_media'] ) && check_admin_referer( 'tk_localize_media' ) ) { // phpcs:ignore
		$stats = function_exists( 'tk_localize_all_site_images' ) ? tk_localize_all_site_images() : array();
		echo '<div class="notice notice-success"><p>' . esc_html__( 'تم تحميل الصور إلى Media.', 'tek-craft-toppres' ) . ' ' . esc_html( wp_json_encode( $stats ) ) . '</p></div>';
	}

	echo '<div class="notice notice-info is-dismissible"><p>';
	echo esc_html__( 'Tek-Craft Toppres:', 'tek-craft-toppres' ) . ' ';
	echo '<a href="' . esc_url( $url ) . '">' . esc_html__( 'استيراد كامل', 'tek-craft-toppres' ) . '</a> | ';
	echo '<a href="' . esc_url( $reseed ) . '">' . esc_html__( 'إعادة بناء صفحات Elementor (سكاشن)', 'tek-craft-toppres' ) . '</a> | ';
	echo '<a href="' . esc_url( $media_url ) . '">' . esc_html__( 'تحميل الصور إلى Media', 'tek-craft-toppres' ) . '</a>';
	echo '</p></div>';
}
add_action( 'admin_notices', 'tk_import_admin_notice' );
