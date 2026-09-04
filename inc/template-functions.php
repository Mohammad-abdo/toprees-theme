<?php
/**
 * Template tags and helpers used in templates.
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Print the site logo or fallback brand image/text.
 */
function tk_the_logo() {
	if ( has_custom_logo() ) {
		$logo = get_custom_logo();
		// Ensure original .brand class for exact CSS match.
		$logo = str_replace( 'custom-logo-link', 'brand custom-logo-link', $logo );
		echo $logo; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		return;
	}

	$logo = TK_THEME_URI . '/assets/images/logo.png';
	printf(
		'<a href="%1$s" class="brand custom-logo-link" rel="home"><img src="%2$s" alt="%3$s" class="custom-logo" width="160" height="48" /></a>',
		esc_url( home_url( '/' ) ),
		esc_url( $logo ),
		esc_attr( get_bloginfo( 'name' ) )
	);
}

/**
 * Default primary nav matching original HTML when no menu is assigned.
 */
function tk_fallback_primary_menu() {
	$blog_url = get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url( '/blog/' );

	$about = get_page_by_path( 'about' );
	$testimonials = get_page_by_path( 'testimonials' );
	$contact = get_page_by_path( 'contact' );

	$items = array(
		array( home_url( '/' ), __( 'الرئيسية', 'tek-craft-toppres' ) ),
		array( get_post_type_archive_link( 'tk_service' ) ?: home_url( '/services/' ), __( 'الخدمات', 'tek-craft-toppres' ) ),
		array( $about ? get_permalink( $about ) : home_url( '/about/' ), __( 'من نحن', 'tek-craft-toppres' ) ),
		array( $testimonials ? get_permalink( $testimonials ) : home_url( '/testimonials/' ), __( 'آراء الطلاب', 'tek-craft-toppres' ) ),
		array( $blog_url, __( 'المقالات', 'tek-craft-toppres' ) ),
		array( $contact ? get_permalink( $contact ) : home_url( '/contact/' ), __( 'تواصل معنا', 'tek-craft-toppres' ) ),
	);

	foreach ( $items as $item ) {
		printf(
			'<a href="%1$s">%2$s</a>',
			esc_url( $item[0] ),
			esc_html( $item[1] )
		);
	}
}

/**
 * Header CTA URL.
 *
 * @return string
 */
function tk_header_cta_url() {
	$url = tk_get_mod( 'tk_header_cta_url', '' );
	if ( $url ) {
		return $url;
	}

	$contact = get_page_by_path( 'contact' );
	if ( $contact ) {
		return get_permalink( $contact );
	}

	$wa = tk_whatsapp_url();
	return $wa ? $wa : home_url( '/' );
}

/**
 * Posted on meta.
 */
function tk_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	printf(
		'<span class="posted-on">%s</span>',
		sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() )
		)
	);
}

/**
 * Posted by meta.
 */
function tk_posted_by() {
	printf(
		'<span class="byline">%1$s <span class="author vcard"><a class="url fn n" href="%2$s">%3$s</a></span></span>',
		esc_html__( 'بواسطة', 'tek-craft-toppres' ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_html( get_the_author() )
	);
}

/**
 * Posts navigation.
 */
function tk_posts_navigation() {
	the_posts_pagination(
		array(
			'mid_size'  => 2,
			'prev_text' => __( 'السابق', 'tek-craft-toppres' ),
			'next_text' => __( 'التالي', 'tek-craft-toppres' ),
		)
	);
}
