<?php
/**
 * Services custom post type.
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Services CPT and category taxonomy.
 */
function tk_register_services_cpt() {
	$labels = array(
		'name'               => __( 'Services', 'tek-craft-toppres' ),
		'singular_name'      => __( 'Service', 'tek-craft-toppres' ),
		'menu_name'          => __( 'Services', 'tek-craft-toppres' ),
		'add_new'            => __( 'Add New', 'tek-craft-toppres' ),
		'add_new_item'       => __( 'Add New Service', 'tek-craft-toppres' ),
		'edit_item'          => __( 'Edit Service', 'tek-craft-toppres' ),
		'new_item'           => __( 'New Service', 'tek-craft-toppres' ),
		'view_item'          => __( 'View Service', 'tek-craft-toppres' ),
		'search_items'       => __( 'Search Services', 'tek-craft-toppres' ),
		'not_found'          => __( 'No services found', 'tek-craft-toppres' ),
		'not_found_in_trash' => __( 'No services found in Trash', 'tek-craft-toppres' ),
		'all_items'          => __( 'All Services', 'tek-craft-toppres' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'services' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-welcome-learn-more',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields' ),
	);

	register_post_type( 'tk_service', $args );

	register_taxonomy(
		'tk_service_category',
		'tk_service',
		array(
			'labels'            => array(
				'name'          => __( 'Service Categories', 'tek-craft-toppres' ),
				'singular_name' => __( 'Service Category', 'tek-craft-toppres' ),
			),
			'public'            => true,
			'hierarchical'      => true,
			'show_ui'           => true,
			'show_in_rest'      => true,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'service-category' ),
		)
	);
}
add_action( 'init', 'tk_register_services_cpt' );

/**
 * Flush rewrite rules once after theme switch.
 */
function tk_flush_rewrites_on_switch() {
	tk_register_services_cpt();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'tk_flush_rewrites_on_switch' );

/**
 * Register Services CPT/taxonomy with Polylang.
 *
 * @param array $post_types Post types.
 * @param bool  $is_settings Settings screen.
 * @return array
 */
function tk_pll_post_types( $post_types, $is_settings = false ) {
	unset( $is_settings );
	$post_types['tk_service'] = 'tk_service';
	return $post_types;
}
add_filter( 'pll_get_post_types', 'tk_pll_post_types', 10, 2 );

/**
 * Register service category with Polylang.
 *
 * @param array $taxonomies Taxonomies.
 * @param bool  $is_settings Settings.
 * @return array
 */
function tk_pll_taxonomies( $taxonomies, $is_settings = false ) {
	unset( $is_settings );
	$taxonomies['tk_service_category'] = 'tk_service_category';
	return $taxonomies;
}
add_filter( 'pll_get_taxonomies', 'tk_pll_taxonomies', 10, 2 );
