<?php
/**
 * Theme setup, menus, assets, and forms.
 *
 * @package Toppers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'after_setup_theme', 'toppers_setup' );
function toppers_setup() {
	load_theme_textdomain( 'toppers', TOPPERS_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 240,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);
	add_theme_support( 'editor-styles' );

	register_nav_menus(
		array(
			'primary'       => __( 'القائمة الرئيسية', 'toppers' ),
			'mobile'        => __( 'قائمة الجوال', 'toppers' ),
			'footer'        => __( 'روابط الفوتر', 'toppers' ),
			'footer_services' => __( 'خدمات الفوتر', 'toppers' ),
		)
	);

	set_post_thumbnail_size( 800, 520, true );
	add_image_size( 'toppers-card', 600, 400, true );
	add_image_size( 'toppers-hero', 1920, 900, true );
	add_image_size( 'toppers-team', 480, 560, true );

	if ( ! isset( $GLOBALS['content_width'] ) ) {
		$GLOBALS['content_width'] = 1200;
	}
}

add_action( 'widgets_init', 'toppers_widgets_init' );
function toppers_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'الشريط الجانبي', 'toppers' ),
			'id'            => 'sidebar-1',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}

add_action( 'wp_enqueue_scripts', 'toppers_enqueue_assets' );
function toppers_enqueue_assets() {
	wp_enqueue_style(
		'toppers-theme',
		TOPPERS_URI . '/assets/css/theme.css',
		array(),
		(string) filemtime( TOPPERS_DIR . '/assets/css/theme.css' )
	);
	wp_enqueue_style(
		'toppers-compat',
		TOPPERS_URI . '/assets/css/elementor-compat.css',
		array( 'toppers-theme' ),
		TOPPERS_VERSION
	);
	wp_enqueue_style(
		'toppers-pages',
		TOPPERS_URI . '/assets/css/pages.css',
		array( 'toppers-compat' ),
		(string) filemtime( TOPPERS_DIR . '/assets/css/pages.css' )
	);
	wp_enqueue_style(
		'font-awesome',
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css',
		array(),
		'6.5.2'
	);

	wp_enqueue_script(
		'toppers-i18n',
		TOPPERS_URI . '/assets/js/i18n.js',
		array(),
		TOPPERS_VERSION,
		true
	);
	wp_enqueue_script(
		'toppers-theme',
		TOPPERS_URI . '/assets/js/theme.js',
		array( 'toppers-i18n' ),
		(string) filemtime( TOPPERS_DIR . '/assets/js/theme.js' ),
		true
	);

	wp_localize_script(
		'toppers-theme',
		'toppersTheme',
		array(
			'ajaxUrl'     => admin_url( 'admin-ajax.php' ),
			'nonce'       => wp_create_nonce( 'toppers_form' ),
			'homeUrl'     => home_url( '/' ),
			'whatsapp'    => toppers_whatsapp_url(),
			'loginUrl'    => toppers_login_url(),
			'registerUrl' => toppers_register_url(),
			'accountUrl'  => toppers_account_url(),
			'requestUrl'  => toppers_system_request_url(),
			'logoutUrl'   => toppers_logout_url(),
			'loggedIn'    => is_user_logged_in(),
			'restUrl'     => esc_url_raw( rest_url( 'toppers/v1/' ) ),
			'restNonce'   => wp_create_nonce( 'wp_rest' ),
			'i18n'        => array(
				'sent'  => __( 'تم استلام طلبك بنجاح', 'toppers' ),
				'error' => __( 'تعذر الإرسال. حاول مرة أخرى.', 'toppers' ),
			),
		)
	);
}

add_action( 'admin_enqueue_scripts', 'toppers_admin_enqueue_assets' );
function toppers_admin_enqueue_assets() {
	wp_enqueue_style(
		'font-awesome',
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css',
		array(),
		'6.5.2'
	);
}

add_filter( 'login_url', 'toppers_filter_login_url', 20, 3 );
function toppers_filter_login_url( $url, $redirect = '', $force_reauth = false ) {
	if ( is_admin() && ! wp_doing_ajax() ) {
		return $url;
	}
	if ( ! toppers_platform_active() ) {
		return $url;
	}
	$login = toppers_login_url();
	if ( $redirect ) {
		$login = add_query_arg( 'redirect_to', $redirect, $login );
	}
	return $login;
}

add_filter( 'register_url', 'toppers_filter_register_url', 20 );
function toppers_filter_register_url( $url ) {
	if ( ! toppers_platform_active() ) {
		return $url;
	}
	return toppers_register_url();
}

add_filter( 'logout_url', 'toppers_filter_logout_url', 20, 1 );
function toppers_filter_logout_url( $url ) {
	if ( is_admin() && ! wp_doing_ajax() ) {
		return $url;
	}
	if ( ! toppers_platform_active() ) {
		return $url;
	}
	return toppers_logout_url();
}

add_action( 'login_init', 'toppers_redirect_wp_login_to_plugin' );
function toppers_redirect_wp_login_to_plugin() {
	if ( ! toppers_platform_active() ) {
		return;
	}
	if ( 'POST' === ( $_SERVER['REQUEST_METHOD'] ?? '' ) ) {
		return;
	}
	if ( ! empty( $_REQUEST['interim-login'] ) ) {
		return;
	}
	$action = isset( $_REQUEST['action'] ) ? sanitize_key( wp_unslash( $_REQUEST['action'] ) ) : 'login';
	$keep   = array( 'logout', 'lostpassword', 'retrievepassword', 'resetpass', 'rp', 'confirmaction', 'postpass' );
	if ( in_array( $action, $keep, true ) ) {
		return;
	}
	$target = home_url( '/toppers-login/' );
	if ( ! empty( $_REQUEST['redirect_to'] ) ) {
		$target = add_query_arg(
			'redirect_to',
			esc_url_raw( wp_unslash( (string) $_REQUEST['redirect_to'] ) ),
			$target
		);
	}
	wp_safe_redirect( $target );
	exit;
}

add_action( 'template_redirect', 'toppers_redirect_theme_auth_pages' );
function toppers_redirect_theme_auth_pages() {
	if ( is_admin() || ! toppers_platform_active() ) {
		return;
	}

	$path = trim( (string) parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ), '/' );
	if ( 'employee' === $path || str_ends_with( $path, '/employee' ) ) {
		wp_safe_redirect( is_user_logged_in() ? toppers_account_url() : toppers_login_url() );
		exit;
	}

	if ( ! is_singular( 'page' ) ) {
		return;
	}
	$slug = get_post_field( 'post_name', get_queried_object_id() );
	if ( 'login' === $slug || 'register' === $slug ) {
		wp_safe_redirect( 'register' === $slug ? toppers_register_url() : toppers_login_url() );
		exit;
	}
	if ( 'profile' === $slug || 'employee' === $slug ) {
		wp_safe_redirect( toppers_account_url() );
		exit;
	}
}

add_filter( 'body_class', 'toppers_body_class' );
function toppers_body_class( $classes ) {
	$classes[] = 'toppers-theme';
	$classes[] = 'rtl';
	if ( toppers_is_elementor_page() ) {
		$classes[] = 'toppers-elementor-page';
	}

	// Solid readable header on light tops / content pages (avoids invisible white-on-white nav).
	$solid_header = is_page_template( 'templates/page-about.php' )
		|| is_home()
		|| is_singular( 'post' )
		|| is_category()
		|| is_tag()
		|| is_author()
		|| is_date()
		|| is_search()
		|| is_404()
		|| ( function_exists( 'toppers_is_elementor_page' ) && toppers_is_elementor_page() && ! is_front_page() );

	if ( $solid_header ) {
		$classes[] = 'has-light-hero';
	}

	return $classes;
}

add_filter( 'language_attributes', 'toppers_language_attributes' );
function toppers_language_attributes( $output ) {
	if ( is_admin() ) {
		return $output;
	}
	$pagenow = isset( $GLOBALS['pagenow'] ) ? (string) $GLOBALS['pagenow'] : '';
	if ( in_array( $pagenow, array( 'wp-login.php', 'wp-register.php' ), true ) ) {
		return $output;
	}
	$output = preg_replace( '/lang="[^"]*"/', 'lang="ar"', $output );
	if ( preg_match( '/dir="/', $output ) ) {
		$output = preg_replace( '/dir="[^"]*"/', 'dir="rtl"', $output );
	} else {
		$output .= ' dir="rtl"';
	}
	return $output;
}

add_action( 'wp_head', 'toppers_favicon', 1 );
function toppers_favicon() {
	if ( function_exists( 'has_site_icon' ) && has_site_icon() ) {
		return;
	}
	$logo = TOPPERS_URI . '/assets/images/logo.png';
	echo '<link rel="icon" href="' . esc_url( $logo ) . '">' . "\n";
}

add_action( 'wp_head', 'toppers_dynamic_css', 20 );
function toppers_dynamic_css() {
	$gold  = toppers_opt( 'toppers_gold', '#c99a3b' );
	$navy  = toppers_opt( 'toppers_navy', '#1c2f5e' );
	$ink   = toppers_opt( 'toppers_ink', '#0e1730' );
	$paper = toppers_opt( 'toppers_paper', '#fbf8f1' );
	echo '<style id="toppers-dynamic">:root{--gold:' . esc_html( $gold ) . ';--navy:' . esc_html( $navy ) . ';--ink:' . esc_html( $ink ) . ';--paper:' . esc_html( $paper ) . ';}</style>';
}

add_filter( 'nav_menu_css_class', 'toppers_menu_item_classes', 10, 2 );
function toppers_menu_item_classes( $classes, $item ) {
	if ( in_array( 'current-menu-item', $classes, true ) || in_array( 'current_page_item', $classes, true ) ) {
		$classes[] = 'active';
	}
	return $classes;
}

add_filter( 'nav_menu_link_attributes', 'toppers_menu_link_atts', 10, 2 );
function toppers_menu_link_atts( $atts, $item ) {
	if ( empty( $atts['class'] ) ) {
		$atts['class'] = '';
	}
	return $atts;
}

add_action( 'wp_ajax_toppers_contact', 'toppers_handle_contact' );
add_action( 'wp_ajax_nopriv_toppers_contact', 'toppers_handle_contact' );
function toppers_handle_contact() {
	check_ajax_referer( 'toppers_form', 'nonce' );

	$name    = sanitize_text_field( wp_unslash( $_POST['name'] ?? '' ) );
	$phone   = sanitize_text_field( wp_unslash( $_POST['phone'] ?? '' ) );
	$email   = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
	$level    = sanitize_text_field( wp_unslash( $_POST['level'] ?? '' ) );
	$service  = sanitize_text_field( wp_unslash( $_POST['service'] ?? '' ) );
	$deadline = sanitize_text_field( wp_unslash( $_POST['deadline'] ?? '' ) );
	$details  = sanitize_textarea_field( wp_unslash( $_POST['details'] ?? '' ) );

	if ( ! $name || ! $phone ) {
		wp_send_json_error( array( 'message' => __( 'الاسم والجوال مطلوبان.', 'toppers' ) ) );
	}

	// Bridge to platform: create a potential customer (lead), not a full client account.
	$lead_ok = false;
	if ( class_exists( '\Toppers\Modules\Accounts\Repository\LeadRepository' ) ) {
		$repo   = new \Toppers\Modules\Accounts\Repository\LeadRepository();
		$notes  = trim(
			implode(
				"\n",
				array_filter(
					array(
						$service ? 'الخدمة: ' . $service : '',
						$level ? 'المرحلة: ' . $level : '',
						$deadline ? 'الموعد: ' . $deadline : '',
						$details,
					)
				)
			)
		);
		$existing = $repo->findByPhone( $phone );
		if ( $existing ) {
			$result  = $repo->update(
				(int) $existing['id'],
				array(
					'name'   => $name,
					'email'  => $email,
					'notes'  => trim( ( (string) ( $existing['notes'] ?? '' ) ) . "\n---\n" . $notes ),
					'status' => 'contacted',
					'source' => 'contact',
				)
			);
			$lead_ok = ! empty( $result['ok'] );
		} else {
			$result  = $repo->create(
				array(
					'name'   => $name,
					'phone'  => $phone,
					'email'  => $email,
					'source' => 'contact',
					'status' => 'new',
					'notes'  => $notes,
				)
			);
			$lead_ok = ! empty( $result['ok'] );
		}
	}

	// Record contact inquiry in Dashboard (toppers_contact_req)
	$req_id = wp_insert_post(
		array(
			'post_type'    => 'toppers_contact_req',
			'post_title'   => $name . ( $service ? ' — ' . $service : '' ),
			'post_status'  => 'publish',
			'post_content' => $details,
		)
	);
	if ( $req_id && ! is_wp_error( $req_id ) ) {
		update_post_meta( $req_id, '_inquiry_name', $name );
		update_post_meta( $req_id, '_inquiry_phone', $phone );
		update_post_meta( $req_id, '_inquiry_email', $email );
		update_post_meta( $req_id, '_inquiry_service', $service );
		update_post_meta( $req_id, '_inquiry_level', $level );
		update_post_meta( $req_id, '_inquiry_deadline', $deadline );
		update_post_meta( $req_id, '_inquiry_details', $details );
	}

	$to      = toppers_email();
	$subject = sprintf( '[Toppers] طلب خدمة جديد من: %s', $name );
	$body    = "وصلك طلب خدمة وتواصل جديد عبر موقع توبرز:\n\n"
		. "الاسم: {$name}\n"
		. "الجوال: {$phone}\n"
		. "البريد الإلكتروني: {$email}\n"
		. "المرحلة الدراسية: {$level}\n"
		. "الخدمة المطلوبة: {$service}\n"
		. "الموعد المطلوب: {$deadline}\n\n"
		. "تفاصيل الطلب:\n{$details}\n\n"
		. "---\nيمكنك أيضاً مراجعة الطلب والرد على العميل عبر لوحة التحكم (الداش بورد) > طلبات الخدمات.";
	$headers = array( 'Content-Type: text/plain; charset=UTF-8' );
	if ( $email ) {
		$headers[] = 'Reply-To: ' . $email;
	}

	wp_mail( $to, $subject, $body, $headers );

	if ( class_exists( '\Toppers\Modules\Accounts\Repository\LeadRepository' ) && ! $lead_ok ) {
		wp_send_json_error( array( 'message' => __( 'تم استلام البريد ولكن يرجى التحقق من لوحة التحكم.', 'toppers' ) ) );
	}

	wp_send_json_success( array( 'message' => __( 'تم استلام طلبك بنجاح', 'toppers' ) ) );
}

add_action( 'wp_ajax_toppers_career_apply', 'toppers_handle_career_apply' );
add_action( 'wp_ajax_nopriv_toppers_career_apply', 'toppers_handle_career_apply' );
function toppers_handle_career_apply() {
	check_ajax_referer( 'toppers_form', 'career_nonce' );

	$name       = sanitize_text_field( wp_unslash( $_POST['name'] ?? '' ) );
	$age        = sanitize_text_field( wp_unslash( $_POST['age'] ?? '' ) );
	$phone      = sanitize_text_field( wp_unslash( $_POST['phone'] ?? '' ) );
	$graduation = sanitize_text_field( wp_unslash( $_POST['graduation'] ?? '' ) );
	$email      = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );

	if ( ! $name || ! $phone ) {
		wp_send_json_error( array( 'message' => __( 'يرجى إدخال الاسم ورقم الموبايل.', 'toppers' ) ) );
	}

	$cv_url = '';
	if ( ! empty( $_FILES['cv_file']['name'] ) ) {
		if ( ! function_exists( 'wp_handle_upload' ) ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
		}
		$uploadedfile     = $_FILES['cv_file'];
		$upload_overrides = array( 'test_form' => false );
		$movefile         = wp_handle_upload( $uploadedfile, $upload_overrides );

		if ( $movefile && ! isset( $movefile['error'] ) ) {
			$cv_url = $movefile['url'];
		} else {
			wp_send_json_error( array( 'message' => __( 'خطأ أثناء رفع السيرة الذاتية: ', 'toppers' ) . ( $movefile['error'] ?? '' ) ) );
		}
	}

	// 1. Record application in WordPress Dashboard (toppers_career_app)
	$app_title = $name . ( $graduation ? ' — ' . $graduation : '' );
	$app_id    = wp_insert_post(
		array(
			'post_type'    => 'toppers_career_app',
			'post_title'   => $app_title,
			'post_status'  => 'publish',
		)
	);

	if ( $app_id && ! is_wp_error( $app_id ) ) {
		update_post_meta( $app_id, '_applicant_name', $name );
		update_post_meta( $app_id, '_applicant_age', $age );
		update_post_meta( $app_id, '_applicant_phone', $phone );
		update_post_meta( $app_id, '_applicant_graduation', $graduation );
		update_post_meta( $app_id, '_applicant_qualification', $graduation );
		if ( $email ) {
			update_post_meta( $app_id, '_applicant_email', $email );
		}
		if ( $cv_url ) {
			update_post_meta( $app_id, '_applicant_cv_url', $cv_url );
			update_post_meta( $app_id, '_applicant_portfolio_url', $cv_url );
		}
	}

	$details = "طلب انضمام جديد عبر استمارة (انضم إلى توبرز):\n\n"
		. "اسم المختص: {$name}\n"
		. "السن / العمر: " . ( $age ?: '—' ) . "\n"
		. "رقم الموبايل: {$phone}\n"
		. "التخرج / المؤهل والتخصص: " . ( $graduation ?: '—' ) . "\n"
		. "ملف السيرة الذاتية (CV): " . ( $cv_url ? $cv_url : 'لم يتم إرفاق ملف' ) . "\n\n"
		. "---\nتم حفظ هذا الطلب أيضاً في الداش بورد تحت «طلبات التوظيف».";

	if ( class_exists( '\Toppers\Modules\Accounts\Repository\LeadRepository' ) ) {
		$repo     = new \Toppers\Modules\Accounts\Repository\LeadRepository();
		$existing = $repo->findByPhone( $phone );
		if ( $existing ) {
			$repo->update(
				(int) $existing['id'],
				array(
					'name'   => $name,
					'email'  => $email,
					'notes'  => trim( ( (string) ( $existing['notes'] ?? '' ) ) . "\n---\n" . $details ),
					'status' => 'candidate',
					'source' => 'career',
				)
			);
		} else {
			$repo->create(
				array(
					'name'   => $name,
					'phone'  => $phone,
					'email'  => $email,
					'source' => 'career',
					'status' => 'new',
					'notes'  => $details,
				)
			);
		}
	}

	$to      = function_exists( 'toppers_notification_email' ) ? toppers_notification_email() : toppers_email();
	$subject = sprintf( '[Toppers Career] طلب انضمام جديد: %s (%s)', $name, $graduation ?: 'مختص' );
	$headers = array( 'Content-Type: text/plain; charset=UTF-8' );
	if ( $email ) {
		$headers[] = 'Reply-To: ' . $email;
	}

	wp_mail( $to, $subject, $details, $headers );

	wp_send_json_success( array( 'message' => __( 'تم استلام طلب انضمامك بنجاح!', 'toppers' ) ) );
}

add_action( 'init', 'toppers_ensure_careers_page' );
function toppers_ensure_careers_page() {
	if ( get_option( 'toppers_careers_page_synced' ) ) {
		return;
	}
	$existing = get_page_by_path( 'careers' ) ?: get_page_by_path( 'career' );
	if ( ! $existing ) {
		$page_id = wp_insert_post(
			array(
				'post_title'     => 'انضم إلى توبرز',
				'post_name'      => 'careers',
				'post_status'    => 'publish',
				'post_type'      => 'page',
				'page_template'  => 'templates/page-career.php',
			)
		);
		if ( $page_id && ! is_wp_error( $page_id ) ) {
			update_post_meta( $page_id, '_wp_page_template', 'templates/page-career.php' );
		}
	} else {
		wp_update_post(
			array(
				'ID'         => $existing->ID,
				'post_title' => 'انضم إلى توبرز',
			)
		);
		update_post_meta( $existing->ID, '_wp_page_template', 'templates/page-career.php' );
	}
	update_option( 'toppers_careers_page_synced', 1 );
}

add_action( 'admin_notices', 'toppers_admin_notice' );
function toppers_admin_notice() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	if ( did_action( 'elementor/loaded' ) ) {
		return;
	}
	$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
	if ( ! $screen || ( 'themes' !== $screen->id && 'dashboard' !== $screen->id ) ) {
		return;
	}
	echo '<div class="notice notice-info"><p>';
	echo esc_html__( 'قالب توبرز جاهز لـ Elementor. ثبّت إضافة Elementor ثم افتح أي صفحة واضغط «تعديل بـ Elementor» لتغيير الصور والنصوص.', 'toppers' );
	echo '</p></div>';
}
