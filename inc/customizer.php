<?php
/**
 * Theme Customizer settings.
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Customizer settings.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function tk_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'tk_contact',
		array(
			'title'    => __( 'Contact & Social', 'tek-craft-toppres' ),
			'priority' => 30,
		)
	);

	$fields = array(
		'tk_phone' => array(
			'label'   => __( 'Phone', 'tek-craft-toppres' ),
			'default' => '+966 54 909 3465',
			'type'    => 'text',
		),
		'tk_email' => array(
			'label'   => __( 'Email', 'tek-craft-toppres' ),
			'default' => 'info@toppers-edu.com',
			'type'    => 'email',
		),
		'tk_whatsapp' => array(
			'label'       => __( 'WhatsApp number (digits only)', 'tek-craft-toppres' ),
			'default'     => '966549093465',
			'type'        => 'text',
			'description' => __( 'Example: 966549093465', 'tek-craft-toppres' ),
		),
		'tk_hours' => array(
			'label'   => __( 'Business hours text', 'tek-craft-toppres' ),
			'default' => __( 'نخدمكم على مدار الساعة', 'tek-craft-toppres' ),
			'type'    => 'text',
		),
		'tk_twitter' => array(
			'label'   => __( 'Twitter / X URL', 'tek-craft-toppres' ),
			'default' => '',
			'type'    => 'url',
		),
		'tk_instagram' => array(
			'label'   => __( 'Instagram URL', 'tek-craft-toppres' ),
			'default' => '',
			'type'    => 'url',
		),
		'tk_linkedin' => array(
			'label'   => __( 'LinkedIn URL', 'tek-craft-toppres' ),
			'default' => '',
			'type'    => 'url',
		),
	);

	foreach ( $fields as $id => $args ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $args['default'],
				'sanitize_callback' => ( 'url' === $args['type'] ) ? 'esc_url_raw' : ( ( 'email' === $args['type'] ) ? 'sanitize_email' : 'sanitize_text_field' ),
				'transport'         => 'refresh',
			)
		);

		$control_args = array(
			'label'   => $args['label'],
			'section' => 'tk_contact',
			'type'    => ( 'url' === $args['type'] || 'email' === $args['type'] ) ? 'text' : $args['type'],
		);

		if ( ! empty( $args['description'] ) ) {
			$control_args['description'] = $args['description'];
		}

		$wp_customize->add_control( $id, $control_args );
	}

	$wp_customize->add_section(
		'tk_footer',
		array(
			'title'    => __( 'Footer', 'tek-craft-toppres' ),
			'priority' => 35,
		)
	);

	$wp_customize->add_setting(
		'tk_footer_about',
		array(
			'default'           => __( 'شركة سعودية متخصصة في تقديم الخدمات الأكاديمية والبحثية لطلاب الجامعات والدراسات العليا والباحثين في جميع أنحاء الوطن العربي.', 'tek-craft-toppres' ),
			'sanitize_callback' => 'sanitize_textarea_field',
		)
	);
	$wp_customize->add_control(
		'tk_footer_about',
		array(
			'label'   => __( 'Footer about text', 'tek-craft-toppres' ),
			'section' => 'tk_footer',
			'type'    => 'textarea',
		)
	);

	$wp_customize->add_setting(
		'tk_footer_cta_title',
		array(
			'default'           => __( 'هل أنت مستعد لبدء رحلة نجاحك الأكاديمي؟', 'tek-craft-toppres' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'tk_footer_cta_title',
		array(
			'label'   => __( 'Footer CTA title', 'tek-craft-toppres' ),
			'section' => 'tk_footer',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'tk_footer_cta_text',
		array(
			'default'           => __( 'انضم إلى آلاف الباحثين والطلاب الذين وثقوا في توبرز.', 'tek-craft-toppres' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'tk_footer_cta_text',
		array(
			'label'   => __( 'Footer CTA text', 'tek-craft-toppres' ),
			'section' => 'tk_footer',
			'type'    => 'text',
		)
	);

	$wp_customize->add_section(
		'tk_header',
		array(
			'title'    => __( 'Header CTA', 'tek-craft-toppres' ),
			'priority' => 28,
		)
	);

	$wp_customize->add_setting(
		'tk_header_cta_label',
		array(
			'default'           => __( 'اطلب خدمتك', 'tek-craft-toppres' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'tk_header_cta_label',
		array(
			'label'   => __( 'CTA button label', 'tek-craft-toppres' ),
			'section' => 'tk_header',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'tk_header_cta_url',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'tk_header_cta_url',
		array(
			'label'       => __( 'CTA button URL', 'tek-craft-toppres' ),
			'description' => __( 'Leave empty to use the contact page or WhatsApp.', 'tek-craft-toppres' ),
			'section'     => 'tk_header',
			'type'        => 'url',
		)
	);

	$wp_customize->add_setting(
		'tk_show_wa_float',
		array(
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);
	$wp_customize->add_control(
		'tk_show_wa_float',
		array(
			'label'   => __( 'Show floating WhatsApp button', 'tek-craft-toppres' ),
			'section' => 'tk_contact',
			'type'    => 'checkbox',
		)
	);
}
add_action( 'customize_register', 'tk_customize_register' );
