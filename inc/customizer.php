<?php
/**
 * Theme Customizer — change logo, colors, contact, and default photos.
 *
 * @package Toppers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'customize_register', 'toppers_customize_register' );
function toppers_customize_register( $wp_customize ) {
	$wp_customize->add_panel(
		'toppers_panel',
		array(
			'title'    => __( 'إعدادات توبرز', 'toppers' ),
			'priority' => 30,
		)
	);

	$wp_customize->add_section(
		'toppers_brand',
		array(
			'title' => __( 'الهوية والألوان', 'toppers' ),
			'panel' => 'toppers_panel',
		)
	);

	$colors = array(
		'toppers_gold'  => array( __( 'الذهبي', 'toppers' ), '#c99a3b' ),
		'toppers_navy'  => array( __( 'الكحلي', 'toppers' ), '#1c2f5e' ),
		'toppers_ink'   => array( __( 'الأساسي', 'toppers' ), '#0e1730' ),
		'toppers_paper' => array( __( 'خلفية الورق', 'toppers' ), '#fbf8f1' ),
	);
	foreach ( $colors as $id => $data ) {
		$wp_customize->add_setting( $id, array( 'default' => $data[1], 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh' ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $id, array( 'label' => $data[0], 'section' => 'toppers_brand' ) ) );
	}

	$wp_customize->add_section(
		'toppers_contact',
		array(
			'title' => __( 'بيانات التواصل', 'toppers' ),
			'panel' => 'toppers_panel',
		)
	);

	$fields = array(
		'toppers_phone'    => array( __( 'رقم الهاتف', 'toppers' ), '+966 54 909 3465' ),
		'toppers_whatsapp' => array( __( 'واتساب (أرقام فقط مع مفتاح الدولة)', 'toppers' ), '966549093465' ),
		'toppers_email'    => array( __( 'البريد الإلكتروني', 'toppers' ), 'info@toppers-edu.com' ),
		'toppers_hours'    => array( __( 'ساعات العمل', 'toppers' ), 'نخدمكم على مدار الساعة' ),
		'toppers_address'  => array( __( 'العنوان', 'toppers' ), 'المملكة العربية السعودية' ),
		'toppers_twitter'  => array( __( 'رابط X / تويتر', 'toppers' ), '' ),
		'toppers_instagram'=> array( __( 'رابط إنستغرام', 'toppers' ), '' ),
		'toppers_linkedin' => array( __( 'رابط لينكدإن', 'toppers' ), '' ),
	);
	foreach ( $fields as $id => $data ) {
		$cb = ( false !== strpos( $id, 'email' ) ) ? 'sanitize_email' : ( false !== strpos( $id, 'http' ) || false !== strpos( $id, 'twitter' ) || false !== strpos( $id, 'instagram' ) || false !== strpos( $id, 'linkedin' ) ? 'esc_url_raw' : 'sanitize_text_field' );
		$wp_customize->add_setting( $id, array( 'default' => $data[1], 'sanitize_callback' => $cb ) );
		$wp_customize->add_control( $id, array( 'label' => $data[0], 'section' => 'toppers_contact', 'type' => 'text' ) );
	}

	$wp_customize->add_section(
		'toppers_copy',
		array(
			'title' => __( 'نصوص الهيدر والفوتر', 'toppers' ),
			'panel' => 'toppers_panel',
		)
	);

	$copy = array(
		'toppers_cta_label'    => array( __( 'زر اطلب خدمتك', 'toppers' ), 'اطلب خدمتك' ),
		'toppers_footer_about' => array( __( 'نبذة الفوتر', 'toppers' ), 'شركة سعودية متخصصة في تقديم الخدمات الأكاديمية والبحثية لطلاب الجامعات والدراسات العليا والباحثين في جميع أنحاء الوطن العربي.' ),
		'toppers_footer_cta_t' => array( __( 'عنوان شريط الفوتر', 'toppers' ), 'هل أنت مستعد لبدء رحلة نجاحك الأكاديمي؟' ),
		'toppers_footer_cta_d' => array( __( 'وصف شريط الفوتر', 'toppers' ), 'انضم إلى آلاف الباحثين والطلاب الذين وثقوا في توبرز.' ),
		'toppers_footer_cta_b' => array( __( 'زر شريط الفوتر', 'toppers' ), 'تواصل معنا الآن' ),
	);
	foreach ( $copy as $id => $data ) {
		$type = ( false !== strpos( $id, 'about' ) || false !== strpos( $id, 'cta_d' ) ) ? 'textarea' : 'text';
		$wp_customize->add_setting( $id, array( 'default' => $data[1], 'sanitize_callback' => 'wp_kses_post' ) );
		$wp_customize->add_control( $id, array( 'label' => $data[0], 'section' => 'toppers_copy', 'type' => $type ) );
	}

	$wp_customize->add_section(
		'toppers_home_images',
		array(
			'title'       => __( 'صور الصفحة الرئيسية الافتراضية', 'toppers' ),
			'description' => __( 'تُستخدم إذا لم تبنِ الصفحة بـ Elementor. يمكنك أيضاً استبدال كل صورة من داخل Elementor.', 'toppers' ),
			'panel'       => 'toppers_panel',
		)
	);

	for ( $i = 1; $i <= 3; $i++ ) {
		$id = 'toppers_hero_slide_' . $i;
		$wp_customize->add_setting( $id, array( 'default' => 0, 'sanitize_callback' => 'absint' ) );
		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, $id, array( 'label' => sprintf( __( 'صورة السلايد %d', 'toppers' ), $i ), 'section' => 'toppers_home_images', 'mime_type' => 'image' ) ) );
	}

	$wp_customize->add_setting( 'toppers_about_image', array( 'default' => 0, 'sanitize_callback' => 'absint' ) );
	$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'toppers_about_image', array( 'label' => __( 'صورة من نحن', 'toppers' ), 'section' => 'toppers_home_images', 'mime_type' => 'image' ) ) );
}
