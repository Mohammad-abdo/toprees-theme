<?php
/**
 * Theme SEO helpers (titles, meta, Open Graph, JSON-LD).
 * Lightweight — skips output when Yoast / Rank Math / SEOPress are active.
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Whether a major SEO plugin already handles meta tags.
 *
 * @return bool
 */
function tk_seo_plugin_active() {
	return defined( 'WPSEO_VERSION' )
		|| defined( 'RANK_MATH_VERSION' )
		|| defined( 'SEOPRESS_VERSION' )
		|| class_exists( 'AIOSEO\\Plugin\\AIOSEO', false );
}

/**
 * Resolve a concise meta description for the current view.
 *
 * @return string
 */
function tk_get_meta_description() {
	$desc = '';

	if ( is_singular() ) {
		$post = get_queried_object();
		if ( $post instanceof WP_Post ) {
			if ( has_excerpt( $post ) ) {
				$desc = get_the_excerpt( $post );
			} else {
				$desc = wp_strip_all_tags( $post->post_content );
			}
		}
	} elseif ( is_category() || is_tag() || is_tax() ) {
		$desc = term_description();
	} elseif ( is_home() || is_front_page() ) {
		$desc = get_bloginfo( 'description', 'display' );
	} elseif ( is_post_type_archive() ) {
		$obj  = get_queried_object();
		$desc = ! empty( $obj->description ) ? $obj->description : get_bloginfo( 'description', 'display' );
	}

	$desc = wp_strip_all_tags( (string) $desc );
	$desc = preg_replace( '/\s+/u', ' ', $desc );
	$desc = trim( $desc );

	if ( '' === $desc ) {
		$desc = __( 'توبيرز للاستشارات والحلول البحثية — دعم أكاديمي لطلاب البكالوريوس والماجستير والدكتوراه والباحثين.', 'tek-craft-toppres' );
	}

	if ( function_exists( 'mb_substr' ) ) {
		if ( mb_strlen( $desc ) > 160 ) {
			$desc = rtrim( mb_substr( $desc, 0, 157 ) ) . '…';
		}
	} elseif ( strlen( $desc ) > 160 ) {
		$desc = rtrim( substr( $desc, 0, 157 ) ) . '...';
	}

	/**
	 * Filter theme meta description.
	 *
	 * @param string $desc Description.
	 */
	return (string) apply_filters( 'tk_meta_description', $desc );
}

/**
 * Canonical URL for current request.
 *
 * @return string
 */
function tk_get_canonical_url() {
	if ( is_singular() ) {
		return get_permalink();
	}
	if ( is_home() && ! is_front_page() ) {
		$page_for_posts = (int) get_option( 'page_for_posts' );
		return $page_for_posts ? get_permalink( $page_for_posts ) : home_url( '/' );
	}
	if ( is_front_page() ) {
		return home_url( '/' );
	}
	if ( is_category() || is_tag() || is_tax() ) {
		$link = get_term_link( get_queried_object() );
		return is_wp_error( $link ) ? home_url( '/' ) : $link;
	}
	if ( is_post_type_archive() ) {
		$link = get_post_type_archive_link( get_query_var( 'post_type' ) );
		return $link ? $link : home_url( '/' );
	}
	return home_url( add_query_arg( array() ) );
}

/**
 * Social / OG image URL.
 *
 * @return string
 */
function tk_get_og_image() {
	if ( is_singular() && has_post_thumbnail() ) {
		$url = get_the_post_thumbnail_url( null, 'large' );
		if ( $url ) {
			return $url;
		}
	}
	$custom_logo_id = (int) get_theme_mod( 'custom_logo' );
	if ( $custom_logo_id ) {
		$url = wp_get_attachment_image_url( $custom_logo_id, 'full' );
		if ( $url ) {
			return $url;
		}
	}
	return '';
}

/**
 * Print basic meta + Open Graph tags.
 */
function tk_seo_meta_tags() {
	if ( is_admin() || tk_seo_plugin_active() ) {
		return;
	}

	$desc = tk_get_meta_description();
	if ( $desc ) {
		echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
	}

	$canonical = tk_get_canonical_url();
	if ( $canonical ) {
		echo '<link rel="canonical" href="' . esc_url( $canonical ) . '">' . "\n";
	}

	$title = wp_get_document_title();
	$type  = is_singular( 'post' ) ? 'article' : 'website';
	$image = tk_get_og_image();
	$locale = is_rtl() ? 'ar_SA' : 'en_US';

	echo '<meta property="og:locale" content="' . esc_attr( $locale ) . '">' . "\n";
	echo '<meta property="og:type" content="' . esc_attr( $type ) . '">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
	if ( $desc ) {
		echo '<meta property="og:description" content="' . esc_attr( $desc ) . '">' . "\n";
	}
	echo '<meta property="og:url" content="' . esc_url( $canonical ) . '">' . "\n";
	echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . "\n";
	if ( $image ) {
		echo '<meta property="og:image" content="' . esc_url( $image ) . '">' . "\n";
	}

	echo '<meta name="twitter:card" content="' . esc_attr( $image ? 'summary_large_image' : 'summary' ) . '">' . "\n";
	echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '">' . "\n";
	if ( $desc ) {
		echo '<meta name="twitter:description" content="' . esc_attr( $desc ) . '">' . "\n";
	}
	if ( $image ) {
		echo '<meta name="twitter:image" content="' . esc_url( $image ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'tk_seo_meta_tags', 1 );

/**
 * Organization + WebSite JSON-LD.
 */
function tk_seo_schema() {
	if ( is_admin() || tk_seo_plugin_active() ) {
		return;
	}

	$phone = tk_get_mod( 'tk_whatsapp', '' );
	$email = tk_get_mod( 'tk_email', 'info@toppers-edu.com' );
	$logo  = '';
	$logo_id = (int) get_theme_mod( 'custom_logo' );
	if ( $logo_id ) {
		$logo = (string) wp_get_attachment_image_url( $logo_id, 'full' );
	}

	$org = array(
		'@type' => 'Organization',
		'@id'   => home_url( '/#organization' ),
		'name'  => get_bloginfo( 'name' ),
		'url'   => home_url( '/' ),
	);
	if ( $logo ) {
		$org['logo'] = array(
			'@type' => 'ImageObject',
			'url'   => $logo,
		);
	}
	if ( $email ) {
		$org['email'] = $email;
	}
	if ( $phone ) {
		$org['telephone'] = $phone;
	}

	$graph = array(
		$org,
		array(
			'@type'           => 'WebSite',
			'@id'             => home_url( '/#website' ),
			'url'             => home_url( '/' ),
			'name'            => get_bloginfo( 'name' ),
			'description'     => get_bloginfo( 'description', 'display' ),
			'publisher'       => array( '@id' => home_url( '/#organization' ) ),
			'inLanguage'      => get_bloginfo( 'language' ),
			'potentialAction' => array(
				'@type'       => 'SearchAction',
				'target'      => home_url( '/?s={search_term_string}' ),
				'query-input' => 'required name=search_term_string',
			),
		),
	);

	if ( is_singular() ) {
		$post = get_queried_object();
		if ( $post instanceof WP_Post ) {
			$item = array(
				'@type'       => 'post' === $post->post_type ? 'Article' : 'WebPage',
				'@id'         => get_permalink( $post ) . '#webpage',
				'url'         => get_permalink( $post ),
				'name'        => get_the_title( $post ),
				'headline'    => get_the_title( $post ),
				'description' => tk_get_meta_description(),
				'isPartOf'    => array( '@id' => home_url( '/#website' ) ),
				'datePublished' => get_the_date( DATE_W3C, $post ),
				'dateModified'  => get_the_modified_date( DATE_W3C, $post ),
				'inLanguage'    => get_bloginfo( 'language' ),
			);
			if ( has_post_thumbnail( $post ) ) {
				$item['image'] = get_the_post_thumbnail_url( $post, 'large' );
			}
			$graph[] = $item;
		}
	}

	$data = array(
		'@context' => 'https://schema.org',
		'@graph'   => $graph,
	);

	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_head', 'tk_seo_schema', 5 );

/**
 * Improve document title parts for archives / CPT.
 *
 * @param array $parts Title parts.
 * @return array
 */
function tk_document_title_parts( $parts ) {
	if ( is_post_type_archive( 'tk_service' ) ) {
		$parts['title'] = __( 'الخدمات الأكاديمية', 'tek-craft-toppres' );
	}
	return $parts;
}
add_filter( 'document_title_parts', 'tk_document_title_parts' );
