<?php
/**
 * Helper functions.
 *
 * @package Toppers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function toppers_opt( $key, $default = '' ) {
	return get_theme_mod( $key, $default );
}

function toppers_content( $key, $default = '' ) {
	$all = get_option( 'toppers_page_content', array() );
	if ( isset( $all[ $key ] ) && '' !== $all[ $key ] && null !== $all[ $key ] ) {
		return $all[ $key ];
	}
	return $default;
}

function toppers_content_img( $key, $fallback = '' ) {
	$id = (int) toppers_content( $key, 0 );
	if ( $id ) {
		$url = wp_get_attachment_image_url( $id, 'full' );
		if ( $url ) {
			return $url;
		}
	}
	return $fallback;
}

function toppers_hero_args( $page, $defaults = array() ) {
	$map = array(
		'title'   => $page . '_title',
		'eyebrow' => $page . '_eyebrow',
		'lede'    => $page . '_lede',
		'crumb'   => $page . '_crumb',
	);
	foreach ( $map as $arg => $key ) {
		$val = toppers_content( $key, '' );
		if ( '' !== $val ) {
			$defaults[ $arg ] = $val;
		}
	}
	$img = toppers_content_img( $page . '_image', '' );
	if ( $img ) {
		$defaults['image'] = $img;
	}
	return $defaults;
}

function toppers_photo( $key ) {
	$from_dash = toppers_content_img( 'img_' . $key, '' );
	if ( $from_dash ) {
		return $from_dash;
	}
	if ( preg_match( '/^hero-(\d)$/', $key, $m ) ) {
		$cid = (int) toppers_opt( 'toppers_hero_slide_' . $m[1], 0 );
		if ( $cid ) {
			$url = wp_get_attachment_image_url( $cid, 'toppers-hero' );
			if ( $url ) {
				return $url;
			}
		}
	}
	if ( 'about-hero' === $key ) {
		$cid = (int) toppers_opt( 'toppers_about_image', 0 );
		if ( $cid ) {
			$url = wp_get_attachment_image_url( $cid, 'large' );
			if ( $url ) {
				return $url;
			}
		}
	}
	$map = array(
		'hero-1'      => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&q=80&w=1920',
		'hero-2'      => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&q=80&w=1920',
		'hero-3'      => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&q=80&w=1920',
		'research'    => 'https://images.unsplash.com/photo-1488190211105-8b0e65b80b4e?auto=format&fit=crop&q=80&w=600&h=400',
		'masters'     => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&q=80&w=600&h=400',
		'phd'         => 'https://images.unsplash.com/photo-1513258496099-48168024aec0?auto=format&fit=crop&q=80&w=600&h=400',
		'proposal'    => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&q=80&w=600&h=400',
		'translate'   => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&q=80&w=600&h=400',
		'proof'       => 'https://images.unsplash.com/photo-1455390582262-044cdead27d8?auto=format&fit=crop&q=80&w=600&h=400',
		'similarity'  => 'https://images.unsplash.com/photo-1513258496099-48168024aec0?auto=format&fit=crop&q=80&w=600&h=400',
		'meeting'     => 'https://images.unsplash.com/photo-1516321497487-e288fb19713f?auto=format&fit=crop&q=80&w=600&h=400',
		'stats'       => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&q=80&w=600&h=400',
		'library'     => 'https://images.unsplash.com/photo-1532012197267-da84d127e765?auto=format&fit=crop&q=80&w=600&h=400',
		'publish'     => 'https://images.unsplash.com/photo-1512314889357-e157c22f938d?auto=format&fit=crop&q=80&w=600&h=400',
		'laptop'      => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&q=80&w=600&h=400',
		'campus'      => 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&q=80&w=1920&h=600',
		'classroom'   => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&q=80&w=1920&h=1080',
		'team'        => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&q=80&w=800&h=800',
		'about-hero'  => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&q=80&w=800&h=900',
		'office'      => 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80&w=800&h=400',
		'svc-hero'    => 'https://images.unsplash.com/photo-1513258496099-48168024aec0?auto=format&fit=crop&q=80&w=1920&h=600',
		'single-hero' => 'https://images.unsplash.com/photo-1513258496099-48168024aec0?auto=format&fit=crop&q=80&w=1920&h=600',
	);
	return isset( $map[ $key ] ) ? $map[ $key ] : '';
}

function toppers_img( $file ) {
	$key = pathinfo( ltrim( (string) $file, '/' ), PATHINFO_FILENAME );
	$remote = toppers_photo( $key );
	if ( $remote ) {
		return $remote;
	}
	$file = ltrim( (string) $file, '/' );
	$path = TOPPERS_DIR . '/assets/images/' . $file;
	if ( $file && file_exists( $path ) ) {
		return TOPPERS_URI . '/assets/images/' . $file;
	}
	$fallback = toppers_photo( 'research' );
	return $fallback ? $fallback : TOPPERS_URI . '/assets/images/logo.png';
}

function toppers_service_url( $title ) {
	$id = toppers_post_exists_title( $title, 'toppers_service' );
	return $id ? get_permalink( $id ) : toppers_page_url( 'services' );
}

function toppers_service_image( $title_or_id = '' ) {
	if ( is_numeric( $title_or_id ) ) {
		$url = get_the_post_thumbnail_url( (int) $title_or_id, 'toppers-card' );
		if ( $url ) {
			return $url;
		}
		$meta = get_post_meta( (int) $title_or_id, '_toppers_image', true );
		if ( $meta ) {
			return toppers_img( $meta );
		}
		$title_or_id = get_the_title( (int) $title_or_id );
	}
	$map = array(
		'البحوث الجامعية'              => 'research',
		'البحوث الجامعية المتقدمة'     => 'research',
		'دعم مشاريع التخرج'           => 'meeting',
		'رسائل الماجستير'             => 'masters',
		'إعداد رسائل الماجستير'       => 'masters',
		'أطروحات الدكتوراه'           => 'phd',
		'خطة البحث والمقترح'          => 'proposal',
		'خطة البحث (Proposal)'        => 'proposal',
		'التحليل الإحصائي'            => 'stats',
		'التحليل الإحصائي ببرنامج SPSS' => 'stats',
		'الترجمة الأكاديمية'          => 'translate',
		'التدقيق اللغوي'              => 'proof',
		'التدقيق اللغوي والنحوي'      => 'proof',
		'فحص نسبة الاقتباس'           => 'similarity',
		'جمع الدراسات السابقة'        => 'library',
		'النشر في المجلات المحكمة'    => 'publish',
	);
	$key = $map[ $title_or_id ] ?? 'research';
	$remote = toppers_photo( $key );
	return $remote ? $remote : toppers_img( $key . '.jpg' );
}

function toppers_voice_note( $time = '0:45' ) {
	$bars = str_repeat( '<span></span>', 15 );
	return '<div class="voice-note"><button class="vn-play" type="button"><i class="fa-solid fa-play" aria-hidden="true"></i></button><div class="vn-wave">' . $bars . '</div><span class="vn-time">' . esc_html( $time ) . '</span></div>';
}

function toppers_star_svg( $class = 'star-ic' ) {
	return '<i class="fa-solid fa-star ' . esc_attr( $class ) . '" aria-hidden="true"></i>';
}

function toppers_whatsapp_url() {
	$raw = toppers_opt( 'toppers_whatsapp', '966549093465' );
	$digits = preg_replace( '/\D+/', '', $raw );
	return $digits ? 'https://wa.me/' . $digits : '#';
}

function toppers_phone() {
	return toppers_opt( 'toppers_phone', '+966 54 909 3465' );
}

function toppers_email() {
	return toppers_opt( 'toppers_email', 'info@toppers-edu.com' );
}

function toppers_hours() {
	return toppers_opt( 'toppers_hours', 'نخدمكم على مدار الساعة' );
}

function toppers_is_elementor_page( $post_id = null ) {
	if ( ! $post_id ) {
		$post_id = get_queried_object_id();
	}
	if ( ! $post_id || ! did_action( 'elementor/loaded' ) ) {
		return false;
	}
	$document = \Elementor\Plugin::$instance->documents->get( $post_id );
	return $document && $document->is_built_with_elementor();
}

function toppers_page_url( $slug, $fallback = '#' ) {
	$page = get_page_by_path( $slug );
	return $page ? get_permalink( $page ) : $fallback;
}

function toppers_logo_html( $class = '', $height = 0 ) {
	$attr = array(
		'class' => trim( 'custom-logo ' . $class ),
		'alt'   => get_bloginfo( 'name' ),
	);
	if ( $height ) {
		$attr['style'] = 'height:' . absint( $height ) . 'px;width:auto;';
	}

	$logo_id = (int) get_theme_mod( 'custom_logo' );
	if ( ! $logo_id ) {
		$logo_id = (int) toppers_opt( 'toppers_logo_id', 0 );
	}
	if ( $logo_id ) {
		return wp_get_attachment_image( $logo_id, 'full', false, $attr );
	}

	$logo = file_exists( TOPPERS_DIR . '/assets/images/logo.png' ) ? 'logo.png' : 'logo.svg';
	$style = $height ? ' style="' . esc_attr( $attr['style'] ) . '"' : '';
	return '<img class="' . esc_attr( $attr['class'] ) . '" src="' . esc_url( TOPPERS_URI . '/assets/images/' . $logo ) . '" alt="' . esc_attr( $attr['alt'] ) . '"' . $style . '>';
}

function toppers_media_url( $id_or_url, $size = 'large' ) {
	if ( is_numeric( $id_or_url ) && $id_or_url ) {
		$url = wp_get_attachment_image_url( (int) $id_or_url, $size );
		return $url ? $url : '';
	}
	return $id_or_url ? esc_url_raw( $id_or_url ) : '';
}

function toppers_post_exists_title( $title, $type ) {
	$q = new WP_Query(
		array(
			'post_type'      => $type,
			'title'          => $title,
			'post_status'    => 'any',
			'posts_per_page' => 1,
			'fields'         => 'ids',
			'no_found_rows'  => true,
		)
	);
	return ! empty( $q->posts ) ? (int) $q->posts[0] : 0;
}

function toppers_blog_url() {
	$posts_page = (int) get_option( 'page_for_posts' );
	return $posts_page ? get_permalink( $posts_page ) : get_post_type_archive_link( 'post' );
}

class Toppers_Flat_Walker extends Walker_Nav_Menu {
	public function start_lvl( &$output, $depth = 0, $args = null ) {}
	public function end_lvl( &$output, $depth = 0, $args = null ) {}
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$active  = ( in_array( 'current-menu-item', $classes, true ) || in_array( 'current_page_item', $classes, true ) ) ? 'active' : '';
		$output .= '<a href="' . esc_url( $item->url ) . '"' . ( $active ? ' class="active"' : '' ) . '>' . esc_html( $item->title ) . '</a>';
	}
	public function end_el( &$output, $item, $depth = 0, $args = null ) {}
}

function toppers_audio_player( $src = '', $time = '0:45' ) {
	return '<div class="audio-player" data-audio="' . esc_attr( $src ) . '"><button class="audio-btn" type="button" aria-label="' . esc_attr__( 'تشغيل', 'toppers' ) . '"><i class="fa-solid fa-play icon-play" aria-hidden="true"></i><i class="fa-solid fa-pause icon-pause" aria-hidden="true"></i></button><div class="audio-waveform"><div class="audio-progress-bg"><div class="audio-progress-bar"></div></div></div><span class="audio-time">' . esc_html( $time ) . '</span></div>';
}

function toppers_testimonial_types() {
	return array(
		'voice'    => __( 'رسالة صوتية', 'toppers' ),
		'video'    => __( 'فيديو', 'toppers' ),
		'image'    => __( 'لقطة محادثة', 'toppers' ),
		'text'     => __( 'رأي نصي', 'toppers' ),
		'photo'    => __( 'صورة', 'toppers' ),
		'whatsapp' => __( 'سكرين شوت واتساب', 'toppers' ),
	);
}

function toppers_testimonial_type( $post_id = 0 ) {
	$post_id = $post_id ? (int) $post_id : get_the_ID();
	$type    = get_post_meta( $post_id, '_toppers_testimonial_type', true );
	$types   = toppers_testimonial_types();
	return isset( $types[ $type ] ) ? $type : 'text';
}

function toppers_first_letter( $name ) {
	$name = trim( wp_strip_all_tags( $name ) );
	$name = preg_replace( '/^(أ\.?\s*د\.?|د\.|م\.|أ\.)\s*/u', '', $name );
	$name = trim( (string) $name );
	if ( '' === $name ) {
		return 'ت';
	}
	if ( function_exists( 'mb_substr' ) ) {
		return mb_substr( $name, 0, 1 );
	}
	return substr( $name, 0, 1 );
}

function toppers_team_cats() {
	return array(
		'academics' => __( 'المختصون الأكاديميون', 'toppers' ),
		'stats'     => __( 'خبراء التحليل الإحصائي', 'toppers' ),
		'language'  => __( 'التدقيق والضبط اللغوي', 'toppers' ),
		'support'   => __( 'الدعم والتشغيل الرقمي', 'toppers' ),
	);
}

function toppers_team_roster() {
	return array(
		'academics' => array(
			'title'   => 'أولاً: المختصون والخبراء الأكاديميون',
			'desc'    => 'فريق من حملة الدكتوراه والماجستير للإشراف والمساعدة في المنهجيات والدراسات الأكاديمية',
			'note'    => '* وغيرهم من مئات الباحثين المتخصصين في مختلف التخصصات العلمية والإنسانية',
			'members' => array(
				array( 'أ.د. عبد الرحمن', 'جامعة الملك سعود', 'حاصل على أستاذية ودكتوراه في المناهج وطرق التدريس من جامعة الملك سعود (السعودية).' ),
				array( 'د. نورة', 'جامعة القاهرة', 'حاصلة على الدكتوراه في علم الاجتماع التطبيقي من جامعة القاهرة (مصر).' ),
				array( 'د. خالد', 'جامعة أم القرى', 'حاصل على الدكتوراه في الإدارة التربوية والسياسات التعليمية من جامعة أم القرى (السعودية).' ),
				array( 'د. منيرة', 'جامعة مانشستر', 'حاصلة على الدكتوراه في إدارة الأعمال والتخطيط الاستراتيجي من جامعة مانشستر (بريطانيا).' ),
				array( 'د. فهد', 'جامعة الإمام', 'حاصل على الدكتوراه في علم النفس التربوي والقياس من جامعة الإمام محمد بن سعود (السعودية).' ),
				array( 'د. هدى', 'جامعة عين شمس', 'حاصلة على الدكتوراه في الأدب والنقد من جامعة عين شمس (مصر).' ),
				array( 'د. فيصل', 'جامعة الأردن', 'حاصل على الدكتوراه في العلوم السياسية والعلاقات الدولية من جامعة الأردن (الأردن).' ),
				array( 'د. أروى', 'جامعة السوربون', 'حاصلة على الدكتوراه في القانون العام والتشريعات من جامعة السوربون (فرنسا).' ),
				array( 'د. سلطان', 'ولاية أوهايو', 'حاصل على الدكتوراه في الاقتصاد التطبيقي والقياسي من جامعة ولاية أوهايو (أمريكا).' ),
				array( 'د. ريم', 'جامعة الملك عبد العزيز', 'حاصلة على الدكتوراه في تقنيات التعليم والتعلم الإلكتروني من جامعة الملك عبد العزيز (السعودية).' ),
			),
		),
		'stats'     => array(
			'title'   => 'ثانياً: خبراء التحليل الإحصائي ونشر الاستبيانات',
			'desc'    => 'صنّاع الدقة الرقمية، المعالجة المنهجية، ونشر أدوات الدراسة للشرائح المستهدفة',
			'note'    => '* وغيرهم من خبراء التحليل الإحصائي والمعالجة الرقمية',
			'members' => array(
				array( 'د. يوسف', 'جامعة الملك فهد', 'حاصل على الدكتوراه في الإحصاء التطبيقي من جامعة الملك فهد للبترول والمعادن (السعودية).' ),
				array( 'م. أسامة', 'الجامعة الأمريكية', 'حاصل على الماجستير في الإحصاء والعلوم الكمية من الجامعة الأمريكية بالقاهرة (مصر).' ),
				array( 'د. أسماء', 'جامعة مالايا', 'حاصلة على الدكتوراه في مناهج البحث والتحليل النوعي من جامعة مالايا (ماليزيا).' ),
				array( 'أ. ماجد', 'جامعة الملك سعود', 'حاصل على الماجستير في الرياضيات الإحصائية من جامعة الملك سعود (السعودية).' ),
				array( 'م. ناصر', 'جامعة ليستر', 'حاصل على الماجستير في تحليل البيانات والذكاء الاصطناعي من جامعة ليستر (بريطانيا).' ),
				array( 'أ. طارق', 'ميداني', 'أخصائي نشر وتوزيع الاستبيانات الميدانية والأكاديمية للفئات المستهدفة.' ),
			),
		),
		'language'  => array(
			'title'   => 'ثالثاً: فريق التدقيق والضبط اللغوي',
			'desc'    => 'حُرّاس الرصانة اللغوية والسلامة الأسلوبية والأصالة العلمية',
			'note'    => '* وغيرهم من متخصصي اللغة والتدقيق والترجمة',
			'members' => array(
				array( 'د. محمد', 'جامعة الأزهر', 'حاصل على دكتوراه في اللغويات والنحو العربي من جامعة الأزهر (مصر).' ),
				array( 'د. فاطمة', 'جامعة مؤتة', 'حاصلة على الدكتوراه في البلاغة والنقد والأدب من جامعة مؤتة (الأردن).' ),
				array( 'أ. سارة', 'جامعة الملك سعود', 'حاصلة على الماجستير في المكتبات والمعلومات وتوثيق المراجع من جامعة الملك سعود (السعودية).' ),
				array( 'أ. وليد', 'جامعة ليدز', 'حاصل على الماجستير في الترجمة واللغويات التطبيقية من جامعة ليدز (بريطانيا).' ),
				array( 'أ. خلود', 'جامعة الأميرة نورة', 'حاصلة على الماجستير في اللغة العربية والتدقيق اللغوي من جامعة الأميرة نورة (السعودية).' ),
			),
		),
		'support'   => array(
			'title'   => 'رابعاً: فريق الدعم والتواصل والتشغيل الرقمي',
			'desc'    => 'المنظومة الاحترافية التي تضمن سلاسة الخدمة، جودة المحتوى، وسرعة التواصل',
			'note'    => '',
			'members' => array(
				array( 'أ. أحمد', 'SEO', 'أخصائي تحسين محركات البحث (SEO) وتطوير محتوى الموقع الإلكتروني.' ),
				array( 'أ. نورهان', 'محتوى', 'كاتبة المحتوى المعرفي والمقالات الأكاديمية.' ),
				array( 'أ. أسماء', 'محتوى', 'كاتبة المحتوى المعرفي والمقالات الأكاديمية.' ),
				array( 'أ. محمد', 'دعم', 'ممثل خدمة العملاء والدعم الفني عبر البوابة والواتساب.' ),
				array( 'أ. ناصر', 'دعم', 'ممثل خدمة العملاء والدعم الفني وتنسيق جداول التسليم.' ),
			),
		),
	);
}

function toppers_platform_active() {
	return defined( 'TOPPERS_PATH' ) || class_exists( '\Toppers\Portal\PortalRouter' );
}

function toppers_login_url() {
	if ( toppers_platform_active() ) {
		return home_url( '/toppers-login/' );
	}
	return wp_login_url();
}

function toppers_register_url() {
	if ( toppers_platform_active() ) {
		return home_url( '/toppers-login/?view=register' );
	}
	return wp_registration_url();
}

function toppers_logout_url() {
	if ( toppers_platform_active() ) {
		return home_url( '/toppers-logout/' );
	}
	return wp_logout_url( home_url( '/' ) );
}

function toppers_system_request_url( $service = '' ) {
	$args = array( 'tab' => 'new' );
	if ( $service ) {
		$args['service'] = $service;
	}
	$target = add_query_arg( $args, home_url( '/toppers-client/' ) );
	if ( is_user_logged_in() ) {
		return $target;
	}
	return add_query_arg(
		array(
			'redirect_to' => $target,
		),
		toppers_login_url()
	);
}

function toppers_account_url( $tab = '' ) {
	if ( ! is_user_logged_in() ) {
		return toppers_login_url();
	}

	$path = '/toppers-client/';
	$role = '';
	if ( class_exists( '\Toppers\Portal\PortalService' ) ) {
		$role = \Toppers\Portal\PortalService::getUserRole( get_current_user_id() );
		if ( 'notifications' === $tab && method_exists( '\Toppers\Portal\PortalService', 'getNotificationsUrl' ) ) {
			return \Toppers\Portal\PortalService::getNotificationsUrl( $role );
		}
		$map = array(
			'administrator'      => '/toppers-portal/',
			'toppers_manager'    => '/toppers-portal/',
			'toppers_finance'    => '/toppers-portal/',
			'toppers_sales'      => '/toppers-sales/',
			'toppers_specialist' => '/toppers-specialist/',
			'toppers_qc'         => '/toppers-qc/',
		);
		if ( isset( $map[ $role ] ) ) {
			$path = $map[ $role ];
		}
	} elseif ( current_user_can( 'manage_options' ) ) {
		$path = '/toppers-portal/';
	}

	if ( ! $tab && 'toppers_finance' === $role ) {
		$tab = 'finance';
	}

	$url = home_url( $path );
	if ( $tab ) {
		$url = add_query_arg( 'tab', $tab, $url );
	}
	return $url;
}

/**
 * In-app notifications for the current user (plugin table).
 *
 * @param int $limit 0 = all fetched rows.
 * @return array<int, array<string, mixed>>
 */
function toppers_user_notifications( $limit = 8 ) {
	if ( ! is_user_logged_in() || ! class_exists( '\Toppers\Portal\PortalService' ) ) {
		return array();
	}

	$user_id = get_current_user_id();
	if ( method_exists( '\Toppers\Portal\PortalService', 'getRecentNotificationsForTopbar' ) ) {
		$items = \Toppers\Portal\PortalService::getRecentNotificationsForTopbar( $user_id, $limit > 0 ? $limit : 20 );
	} else {
		$items = \Toppers\Portal\PortalService::getClientNotifications( $user_id );
		if ( ! is_array( $items ) ) {
			$items = array();
		}
		if ( $limit > 0 ) {
			$items = array_slice( $items, 0, $limit );
		}
	}
	return is_array( $items ) ? $items : array();
}

function toppers_notification_unread( $row ) {
	return empty( $row['read_at'] );
}

function toppers_unread_notification_count() {
	$count = 0;
	foreach ( toppers_user_notifications( 0 ) as $row ) {
		if ( toppers_notification_unread( $row ) ) {
			++$count;
		}
	}
	return $count;
}

function toppers_notification_link( $row ) {
	if ( ! empty( $row['action_url'] ) ) {
		return $row['action_url'];
	}
	if ( ! empty( $row['order_id'] ) ) {
		return add_query_arg(
			array(
				'tab' => 'orders',
				'id'  => (int) $row['order_id'],
			),
			toppers_account_url()
		);
	}
	return toppers_account_url( 'notifications' );
}

/**
 * Enable audio mime types for student voice testimonials.
 */
add_filter( 'upload_mimes', 'toppers_custom_mime_types' );
function toppers_custom_mime_types( $mimes ) {
	$mimes['opus'] = 'audio/opus';
	$mimes['ogg']  = 'audio/ogg';
	$mimes['oga']  = 'audio/ogg';
	$mimes['m4a']  = 'audio/mp4';
	$mimes['mp3']  = 'audio/mpeg';
	$mimes['wav']  = 'audio/wav';
	$mimes['aac']  = 'audio/aac';
	$mimes['webm'] = 'video/webm';
	return $mimes;
}

/**
 * Calculate dynamic testimonial counts by type.
 */
function toppers_get_testimonials_counts() {
	$posts = get_posts(
		array(
			'post_type'      => 'toppers_testimonial',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'fields'         => 'ids',
		)
	);

	if ( empty( $posts ) ) {
		return array(
			'all'   => 6,
			'voice' => 3,
			'video' => 1,
			'image' => 1,
			'text'  => 1,
		);
	}

	$counts = array(
		'all'   => count( $posts ),
		'voice' => 0,
		'video' => 0,
		'image' => 0,
		'text'  => 0,
	);

	foreach ( $posts as $pid ) {
		$raw_type = get_post_meta( $pid, '_toppers_testimonial_type', true );
		if ( in_array( $raw_type, array( 'image', 'whatsapp', 'photo' ), true ) ) {
			$type = 'image';
		} elseif ( in_array( $raw_type, array( 'voice', 'video', 'text' ), true ) ) {
			$type = $raw_type;
		} else {
			$type = 'text';
		}
		if ( isset( $counts[ $type ] ) ) {
			$counts[ $type ]++;
		}
	}

	return $counts;
}

/**
 * Get AI Assistant configuration options from dashboard.
 */
function toppers_get_ai_settings() {
	$defaults = array(
		'quick_chips'     => array(
			'الذكاء الاصطناعي',
			'الأمن السيبراني',
			'التحول الرقمي',
			'إدارة سلاسل الإمداد',
			'الحوكمة المؤسسية',
			'المحاسبة القضائية',
			'القانون التجاري الدولي',
			'التعليم المدمج',
			'التسويق الرقمي الحديث',
			'الطاقة المتجددة',
			'إدارة الموارد البشرية',
			'رؤية 2030 والمشاريع الكبرى',
		),
		'title_templates' => array(
			array(
				'pattern'     => 'أثر توظيف {keyword} في تطوير مخرجات {major}: دراسة تطبيقية مقارنة',
				'desc'        => 'يهدف هذا البحث إلى قياس الأثر الفعلي لـ {keyword} على كفاءة وجودة العمل في قطاع {major}، مع تقديم نموذج مقترح قابل للتطبيق الميداني بما يتماشى مع متطلبات مرحلة {degree}.',
				'methodology' => 'منهج شبه تجريبي / دراسة مقارنة',
				'impact'      => 'تحسين كفاءة الأداء وتقديم إطار عملي قابل للقياس',
			),
			array(
				'pattern'     => 'التحديات المعاصرة التي تواجه {major} في ظل تسارع ابتكارات {keyword}: دراسة استشرافية',
				'desc'        => 'دراسة استكشافية تحليلية تسلط الضوء على الفجوات التشريعية والمهنية في {major} نتيجة التوسع في {keyword}، مع وضع خارطة طريق متكاملة للتعامل مع التحديات المستقبلية لمرحلة {degree}.',
				'methodology' => 'منهج وصفي تحليلي (دراسة مسحية)',
				'impact'      => 'رصد الفجوات الحالية وتزويد الباحثين بتوصيات استراتيجية',
			),
			array(
				'pattern'     => 'إطار عمل مقترح لدمج معايير {keyword} في منظومة {major} لتحقيق التميز المؤسسي وفق رؤية 2030',
				'desc'        => 'صياغة نموذج إرشادي متكامل يربط بين معايير {keyword} وتحقيق استدامة التميز في {major}، مع التركيز على مؤشرات الأداء الرئيسية ودعم أهداف التنمية والتحول المؤسسي.',
				'methodology' => 'منهج بنائي / دراسة حالة متعددة',
				'impact'      => 'بناء معايير مرجعية تدعم التنافسية الأكاديمية والمؤسسية',
			),
			array(
				'pattern'     => 'تحليل واقع ممارسات {major} وعلاقتها بتبني حلول {keyword}: دراسة ميدانية على عينة مختارة',
				'desc'        => 'بحث ميداني كمي يعتمد على استبانة محكمة ومعالجة إحصائية متقدمة (SPSS/AMOS) لمعرفة مستويات الوعي والتطبيق لـ {keyword} بين الممارسين في مجال {major}.',
				'methodology' => 'منهج كمي ميداني (تحليل إحصائي متقدم)',
				'impact'      => 'بيانات رقمية دقيقة ونمذجة معادلات بنائية تثري التخصص',
			),
			array(
				'pattern'     => 'مستقبل {major} في العصر الرقمي: استراتيجيات ريادية مدفوعة بـ {keyword}',
				'desc'        => 'بحث مبتكر يقدم رؤية حديثة تسعى لإعادة صياغة الأدوار التقليدية في {major} عبر تمكين أدوات {keyword}، وتحديد المهارات والكفايات المستقبلية المطلوبة للباحثين والمختصين لمرحلة {degree}.',
				'methodology' => 'منهج استشرافي (أسلوب دلفاي / تحليل سيناريوهات)',
				'impact'      => 'استشراف الاتجاهات الناشئة وصياغة سياسات مستقبلية رائدة',
			),
			array(
				'pattern'     => 'فاعلية استراتيجية قائمة على {keyword} في تعزيز جودة اتخاذ القرار في بيئات {major}',
				'desc'        => 'دراسة معمقة تبحث في كيفية مساهمة {keyword} في تقليل المخاطر وزيادة موثوقية القرارات في قطاع {major}، مع قياس العائد المعرفي والتشغيلي.',
				'methodology' => 'منهج تحليلي تقييمي',
				'impact'      => 'ترشيد القرارات وتقليل المخاطر التشغيلية',
			),
			array(
				'pattern'     => 'حوكمة تطبيقات {keyword} في مجال {major}: دراسة مقارنة بين الممارسات المحلية والدولية',
				'desc'        => 'مقارنة معيارية (Benchmarking) بين أفضل التجارب العالمية في استثمار {keyword} ومدى إمكانية موائمتها لتطوير قطاع {major} محلياً مع مراعاة الضوابط التنظيمية.',
				'methodology' => 'منهج مقارن معياري',
				'impact'      => 'مواءمة أفضل الممارسات العالمية مع البيئة المحلية',
			),
			array(
				'pattern'     => 'تقييم جاهزية قطاع {major} للتحول نحو منظومة {keyword}: الفرص والمعوقات',
				'desc'        => 'دراسة تشخيصية تقيس مستوى البنية التحتية والمهارات التنظيمية في {major} لقيادة التحول بفعالية نحو حلول {keyword}، واقتراح حلول للتغلب على مقاومة التغيير.',
				'methodology' => 'منهج وصفي تشخيصي',
				'impact'      => 'تحديد دقيق لمستوى النضج المؤسسي والجاهزية',
			),
		),
		'subject_banks'   => array(
			'إدارة الأعمال'               => array(
				'القيادة الرشيقة وإدارة التغيير',
				'حوكمة الشركات العائلية واستدامتها',
				'إدارة المخاطر وسلاسل التوريد المرنة',
				'استراتيجيات التسويق الرقمي وتجربة العميل',
			),
			'علوم الحاسب وتقنية المعلومات' => array(
				'خوارزميات التعلم العميق والأمن السيبراني',
				'تطبيقات البلوك تشين في حماية البيانات الحساسة',
				'معالجة اللغات الطبيعية للغة العربية (NLP)',
				'الحوسبة السحابية وإنترنت الأشياء في المدن الذكية',
			),
			'القانون والأنظمة'             => array(
				'المسؤولية المدنية والجزائية عن أضرار الذكاء الاصطناعي',
				'حماية البيانات الشخصية والخصوصية الرقمية في المعاملات',
				'التحكيم التجاري الإلكتروني وتسوية النزاعات الدولية',
				'التشريعات المنظمة للتجارة الرقمية والعقود الذكية',
			),
			'التربية والمناهج'             => array(
				'توظيف الواقع الافتراضي والمعزز في التدريس التفاعلي',
				'التقويم التربوي البديل في البيئات التعليمية المدمجة',
				'تنمية مهارات التفكير الناقد وحل المشكلات لدى المتعلمين',
				'إدارة الصف الرقمي والتعليم المتمايز لذوي الاحتياجات',
			),
			'المحاسبة والتمويل'           => array(
				'أثر الفنتك (FinTech) على الخدمات المصرفية والتمويلية',
				'المحاسبة القضائية ودورها في مكافحة الاحتيال المالي',
				'معايير المحاسبة الدولية (IFRS) وأثرها على جودة القوائم المالية',
				'إدارة المحافظ الاستثمارية وتحليل المخاطر الائتمانية',
			),
		),
	);

	$saved = get_option( 'toppers_ai_settings', array() );
	if ( ! is_array( $saved ) ) {
		$saved = array();
	}
	return wp_parse_args( $saved, $defaults );
}

