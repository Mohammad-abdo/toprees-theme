<?php
/**
 * Register all Elementor widgets.
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register widget category.
 *
 * @param \Elementor\Elements_Manager $elements_manager Elements manager.
 */
function tk_elementor_categories( $elements_manager ) {
	$elements_manager->add_category(
		'tek-craft-toppres',
		array(
			'title' => __( 'Tek-Craft Toppres', 'tek-craft-toppres' ),
			'icon'  => 'fa fa-plug',
		)
	);
}
add_action( 'elementor/elements/categories_registered', 'tk_elementor_categories' );

/**
 * Register theme Elementor widgets.
 */
function tk_register_elementor_widgets( $widgets_manager ) {
	$files = array(
		'TK_Widget_Hero_Slider'      => '/inc/elementor/widgets/hero-slider.php',
		'TK_Widget_Journey'          => '/inc/elementor/widgets/journey.php',
		'TK_Widget_Services'         => '/inc/elementor/widgets/services.php',
		'TK_Widget_Why_Us'           => '/inc/elementor/widgets/why-us.php',
		'TK_Widget_Testimonials'     => '/inc/elementor/widgets/testimonials.php',
		'TK_Widget_CTA'              => '/inc/elementor/widgets/cta.php',
		'TK_Widget_Articles'         => '/inc/elementor/widgets/articles.php',
		'TK_Widget_Page_Hero'        => '/inc/elementor/widgets/page-hero.php',
		'TK_Widget_Icon_Cards'       => '/inc/elementor/widgets/icon-cards.php',
		'TK_Widget_Split_Content'    => '/inc/elementor/widgets/split-content.php',
		'TK_Widget_Stats_Row'        => '/inc/elementor/widgets/stats-row.php',
		'TK_Widget_FAQ'              => '/inc/elementor/widgets/faq.php',
		'TK_Widget_Contact'          => '/inc/elementor/widgets/contact.php',
		'TK_Widget_Team_Grid'        => '/inc/elementor/widgets/team-grid.php',
		'TK_Widget_Services_Catalog' => '/inc/elementor/widgets/services-catalog.php',
		'TK_Widget_Rich_Section'     => '/inc/elementor/widgets/rich-section.php',
	);

	foreach ( $files as $class => $rel ) {
		$path = TK_THEME_DIR . $rel;
		if ( file_exists( $path ) ) {
			require_once $path;
			if ( class_exists( $class ) ) {
				$widgets_manager->register( new $class() );
			}
		}
	}
}
add_action( 'elementor/widgets/register', 'tk_register_elementor_widgets' );

/**
 * Helper: resolve Elementor image control to URL.
 *
 * @param array  $image Image control value.
 * @param string $fallback Fallback URL.
 * @return string
 */
function tk_elementor_image_url( $image, $fallback = '' ) {
	if ( ! empty( $image['id'] ) ) {
		$url = wp_get_attachment_image_url( (int) $image['id'], 'full' );
		if ( $url ) {
			return $url;
		}
	}
	if ( ! empty( $image['url'] ) ) {
		return $image['url'];
	}
	return $fallback;
}

/**
 * Handle contact form submissions from TK Contact widget.
 */
function tk_handle_contact_request() {
	if ( ! isset( $_POST['tk_contact_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['tk_contact_nonce'] ) ), 'tk_contact_request' ) ) {
		wp_die( esc_html__( 'انتهت صلاحية الطلب. أعد المحاولة.', 'tek-craft-toppres' ) );
	}

	$name     = isset( $_POST['tk_name'] ) ? sanitize_text_field( wp_unslash( $_POST['tk_name'] ) ) : '';
	$phone    = isset( $_POST['tk_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['tk_phone'] ) ) : '';
	$email    = isset( $_POST['tk_email'] ) ? sanitize_email( wp_unslash( $_POST['tk_email'] ) ) : '';
	$level    = isset( $_POST['tk_level'] ) ? sanitize_text_field( wp_unslash( $_POST['tk_level'] ) ) : '';
	$service  = isset( $_POST['tk_service'] ) ? sanitize_text_field( wp_unslash( $_POST['tk_service'] ) ) : '';
	$deadline = isset( $_POST['tk_deadline'] ) ? sanitize_text_field( wp_unslash( $_POST['tk_deadline'] ) ) : '';
	$message  = isset( $_POST['tk_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['tk_message'] ) ) : '';

	$to      = get_option( 'admin_email' );
	$subject = sprintf( '[Toppres] طلب تواصل جديد من %s', $name );
	$body    = "الاسم: {$name}\nالهاتف: {$phone}\nالبريد: {$email}\nالمرحلة: {$level}\nالخدمة: {$service}\nالموعد: {$deadline}\n\n{$message}";
	$headers = array( 'Content-Type: text/plain; charset=UTF-8' );
	if ( $email ) {
		$headers[] = 'Reply-To: ' . $email;
	}
	wp_mail( $to, $subject, $body, $headers );

	wp_safe_redirect( add_query_arg( 'tk_sent', '1', wp_get_referer() ? wp_get_referer() : home_url( '/contact/' ) ) );
	exit;
}
add_action( 'admin_post_nopriv_tk_contact_request', 'tk_handle_contact_request' );
add_action( 'admin_post_tk_contact_request', 'tk_handle_contact_request' );
