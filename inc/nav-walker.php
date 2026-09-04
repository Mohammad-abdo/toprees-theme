<?php
/**
 * Flat nav walker — outputs bare <a> tags like the original HTML (no UL/LI).
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Walker that prints only anchor tags for exact design match.
 */
class TK_Flat_Nav_Walker extends Walker_Nav_Menu {

	/**
	 * Start level — unused (flat).
	 *
	 * @param string   $output Output.
	 * @param int      $depth  Depth.
	 * @param stdClass $args   Args.
	 */
	public function start_lvl( &$output, $depth = 0, $args = null ) {}

	/**
	 * End level — unused.
	 *
	 * @param string   $output Output.
	 * @param int      $depth  Depth.
	 * @param stdClass $args   Args.
	 */
	public function end_lvl( &$output, $depth = 0, $args = null ) {}

	/**
	 * Start element.
	 *
	 * @param string   $output Output.
	 * @param WP_Post  $item   Item.
	 * @param int      $depth  Depth.
	 * @param stdClass $args   Args.
	 * @param int      $id     ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$active  = in_array( 'current-menu-item', $classes, true ) || in_array( 'current_page_item', $classes, true );
		$class   = $active ? ' class="active"' : '';

		$output .= sprintf(
			'<a href="%1$s"%2$s>%3$s</a>',
			esc_url( $item->url ),
			$class,
			esc_html( $item->title )
		);
	}

	/**
	 * End element — unused.
	 *
	 * @param string   $output Output.
	 * @param WP_Post  $item   Item.
	 * @param int      $depth  Depth.
	 * @param stdClass $args   Args.
	 */
	public function end_el( &$output, $item, $depth = 0, $args = null ) {}
}
