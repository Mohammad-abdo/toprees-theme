<?php
/**
 * Shared Elementor Style tab controls for TK widgets.
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register common Style controls on a widget instance.
 *
 * @param \Elementor\Widget_Base $widget   Widget.
 * @param string                 $selector Root CSS selector inside wrapper.
 */
function tk_register_common_style_controls( $widget, $selector = '' ) {
	$root = $selector ? '{{WRAPPER}} ' . $selector : '{{WRAPPER}}';

	$widget->start_controls_section(
		'tk_section_style_general',
		array(
			'label' => __( 'المظهر العام', 'tek-craft-toppres' ),
			'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
		)
	);

	$widget->add_responsive_control(
		'tk_section_padding',
		array(
			'label'      => __( 'Padding', 'tek-craft-toppres' ),
			'type'       => \Elementor\Controls_Manager::DIMENSIONS,
			'size_units' => array( 'px', 'em', '%' ),
			'selectors'  => array(
				$root => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			),
		)
	);

	$widget->add_responsive_control(
		'tk_section_margin',
		array(
			'label'      => __( 'Margin', 'tek-craft-toppres' ),
			'type'       => \Elementor\Controls_Manager::DIMENSIONS,
			'size_units' => array( 'px', 'em', '%' ),
			'selectors'  => array(
				$root => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			),
		)
	);

	$widget->add_group_control(
		\Elementor\Group_Control_Background::get_type(),
		array(
			'name'     => 'tk_section_bg',
			'selector' => $root,
		)
	);

	$widget->add_responsive_control(
		'tk_border_radius',
		array(
			'label'      => __( 'Border Radius', 'tek-craft-toppres' ),
			'type'       => \Elementor\Controls_Manager::SLIDER,
			'size_units' => array( 'px' ),
			'range'      => array( 'px' => array( 'min' => 0, 'max' => 48 ) ),
			'default'    => array( 'unit' => 'px', 'size' => 8 ),
			'selectors'  => array(
				'{{WRAPPER}} .btn, {{WRAPPER}} .service-card, {{WRAPPER}} .sc-img, {{WRAPPER}} .sc-img img, {{WRAPPER}} .why-card, {{WRAPPER}} .t-card, {{WRAPPER}} .article-card, {{WRAPPER}} .ac-img, {{WRAPPER}} .ac-img img, {{WRAPPER}} .cta-band, {{WRAPPER}} .journey-step, {{WRAPPER}} .hero-slider-wrapper, {{WRAPPER}} .hero-slide, {{WRAPPER}} .slide-bg' => 'border-radius: {{SIZE}}{{UNIT}} !important;',
			),
		)
	);

	$widget->end_controls_section();

	$widget->start_controls_section(
		'tk_section_style_typo',
		array(
			'label' => __( 'النصوص', 'tek-craft-toppres' ),
			'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
		)
	);

	$widget->add_control(
		'tk_title_color',
		array(
			'label'     => __( 'لون العناوين', 'tek-craft-toppres' ),
			'type'      => \Elementor\Controls_Manager::COLOR,
			'selectors' => array(
				'{{WRAPPER}} h1, {{WRAPPER}} h2, {{WRAPPER}} h3, {{WRAPPER}} .hero-title' => 'color: {{VALUE}};',
			),
		)
	);

	$widget->add_group_control(
		\Elementor\Group_Control_Typography::get_type(),
		array(
			'name'     => 'tk_title_typo',
			'label'    => __( 'خط العناوين', 'tek-craft-toppres' ),
			'selector' => '{{WRAPPER}} h1, {{WRAPPER}} h2, {{WRAPPER}} h3, {{WRAPPER}} .hero-title',
		)
	);

	$widget->add_control(
		'tk_text_color',
		array(
			'label'     => __( 'لون النصوص', 'tek-craft-toppres' ),
			'type'      => \Elementor\Controls_Manager::COLOR,
			'selectors' => array(
				'{{WRAPPER}} p, {{WRAPPER}} .hero-lede, {{WRAPPER}} .t-quote' => 'color: {{VALUE}};',
			),
		)
	);

	$widget->add_group_control(
		\Elementor\Group_Control_Typography::get_type(),
		array(
			'name'     => 'tk_text_typo',
			'label'    => __( 'خط النصوص', 'tek-craft-toppres' ),
			'selector' => '{{WRAPPER}} p, {{WRAPPER}} .hero-lede, {{WRAPPER}} .t-quote',
		)
	);

	$widget->end_controls_section();

	$widget->start_controls_section(
		'tk_section_style_buttons',
		array(
			'label' => __( 'الأزرار', 'tek-craft-toppres' ),
			'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
		)
	);

	$widget->add_control(
		'tk_btn_bg',
		array(
			'label'     => __( 'خلفية الزر الذهبي', 'tek-craft-toppres' ),
			'type'      => \Elementor\Controls_Manager::COLOR,
			'selectors' => array(
				'{{WRAPPER}} .btn-gold' => 'background-color: {{VALUE}} !important; border-color: {{VALUE}} !important;',
			),
		)
	);

	$widget->add_control(
		'tk_btn_color',
		array(
			'label'     => __( 'لون نص الزر', 'tek-craft-toppres' ),
			'type'      => \Elementor\Controls_Manager::COLOR,
			'selectors' => array(
				'{{WRAPPER}} .btn-gold' => 'color: {{VALUE}} !important;',
			),
		)
	);

	$widget->add_responsive_control(
		'tk_btn_radius',
		array(
			'label'      => __( 'نصف قطر الزر', 'tek-craft-toppres' ),
			'type'       => \Elementor\Controls_Manager::SLIDER,
			'size_units' => array( 'px' ),
			'range'      => array( 'px' => array( 'min' => 0, 'max' => 40 ) ),
			'default'    => array( 'unit' => 'px', 'size' => 8 ),
			'selectors'  => array(
				'{{WRAPPER}} .btn' => 'border-radius: {{SIZE}}{{UNIT}} !important;',
			),
		)
	);

	$widget->end_controls_section();
}
