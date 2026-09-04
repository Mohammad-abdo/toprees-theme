<?php
/**
 * Migrate all HTML site pages/posts into WordPress.
 *
 * Usage (from WP root):
 *   wp eval-file wp-content/themes/tek-craft-toppres/inc/migrate-from-html.php
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$source_candidates = array(
	dirname( TK_THEME_DIR ) . '/tek-craft-tppres',
	'C:/Users/HP/Downloads/toprees  wordpress  theme/tek-craft-tppres',
	'C:/laragon/www/toppres-html-source/tek-craft-tppres',
);

$html_dir = '';
foreach ( $source_candidates as $candidate ) {
	if ( is_dir( $candidate ) && file_exists( $candidate . '/home.html' ) ) {
		$html_dir = $candidate;
		break;
	}
}

if ( ! $html_dir ) {
	WP_CLI::error( 'HTML source folder tek-craft-tppres not found.' );
}

WP_CLI::log( 'Source: ' . $html_dir );

/**
 * Keep only article prose nodes (p/h2/h3/quote/lists/images) — strip layout chrome.
 *
 * @param string $html HTML fragment.
 * @return string
 */
function tk_sanitize_article_body_html( $html ) {
	$html = (string) $html;

	// Cut at known layout markers if dump leaked past article body.
	foreach ( array( 'side-widget', 'toc-list', 'article-footer-row', 'blog-gallery-sec', 'محتويات المقال', 'بحث في المدونة', 'النشرة البريدية', 'مقالات ذات صلة' ) as $marker ) {
		$p = stripos( $html, $marker );
		if ( false !== $p && $p > 80 ) {
			// Prefer cutting at a tag boundary before the marker.
			$cut = strrpos( substr( $html, 0, $p ), '<' );
			if ( false !== $cut && $cut > 40 ) {
				$html = substr( $html, 0, $cut );
			}
			break;
		}
	}

	$allowed = '<p><br><h2><h3><h4><ul><ol><li><strong><em><b><i><a><blockquote><div><span><img><figure><figcaption>';
	$clean   = wp_kses( $html, array() ); // placeholder — rebuild below.

	// Prefer structured keep of known good blocks.
	$parts = array();
	if ( preg_match_all( '/<(p|h2|h3|h4|ul|ol|blockquote|div\s+class="article-quote"[^>]*)\b[^>]*>.*?<\/\1>/isu', $html, $m ) ) {
		// Fallback simpler: extract by tag names.
	}
	if ( preg_match_all( '/<(?:p|h2|h3|h4|ul|ol|blockquote)(?:\s[^>]*)?>.*?<\/(?:p|h2|h3|h4|ul|ol|blockquote)>/isu', $html, $blocks ) ) {
		$parts = $blocks[0];
	}
	if ( preg_match_all( '/<div[^>]*class="[^"]*article-quote[^"]*"[^>]*>.*?<\/div>/isu', $html, $quotes ) ) {
		foreach ( $quotes[0] as $q ) {
			$parts[] = $q;
		}
	}

	if ( ! empty( $parts ) ) {
		// Preserve original order approximately by sorting on position.
		usort(
			$parts,
			static function ( $a, $b ) use ( $html ) {
				return stripos( $html, $a ) <=> stripos( $html, $b );
			}
		);
		$html = implode( "\n\n", array_unique( $parts ) );
	} else {
		$html = wp_kses_post( $html );
	}

	return trim( $html );
}

/**
 * Extract body content between mobile-nav/header and footer.
 *
 * @param string $html Full HTML.
 * @return string
 */
function tk_extract_main_html( $html ) {
	// Drop head.
	if ( preg_match( '/<body[^>]*>(.*)<\/body>/is', $html, $m ) ) {
		$html = $m[1];
	}

	// Remove header.
	$html = preg_replace( '/<header\b[^>]*>.*?<\/header>/is', '', $html, 1 );

	// Remove mobile nav.
	$html = preg_replace( '/<div\s+class="mobile-nav"[^>]*>.*?<\/div>\s*(?=<!(?:--)|<(?:section|style|main|div\s+class="page))/is', '', $html, 1 );
	$html = preg_replace( '/<div\s+class="mobile-nav".*?(?=<section|<style|<!--\s*=+)/is', '', $html, 1 );

	// Remove footer + after.
	$html = preg_replace( '/<!--\s*=+\s*FOOTER.*$/is', '', $html );
	$html = preg_replace( '/<footer\b[^>]*>.*$/is', '', $html );

	// Remove floating WhatsApp + scripts.
	$html = preg_replace( '/<a\b[^>]*class="[^"]*wa-float[^"]*"[^>]*>.*?<\/a>/is', '', $html );
	$html = preg_replace( '/<script\b[^>]*>.*?<\/script>/is', '', $html );

	return trim( $html );
}

/**
 * Rewrite HTML links to WordPress permalinks.
 *
 * @param string $html Content.
 * @return string
 */
function tk_rewrite_html_links( $html ) {
	$map = array(
		'home.html'            => home_url( '/' ),
		'about.html'           => home_url( '/about/' ),
		'contact.html'         => home_url( '/contact/' ),
		'services.html'        => get_post_type_archive_link( 'tk_service' ) ?: home_url( '/services/' ),
		'single-service.html'  => get_post_type_archive_link( 'tk_service' ) ?: home_url( '/services/' ),
		'blog.html'            => get_permalink( (int) get_option( 'page_for_posts' ) ) ?: home_url( '/blog/' ),
		'single-blog.html'     => get_permalink( (int) get_option( 'page_for_posts' ) ) ?: home_url( '/blog/' ),
		'new-single-blog.html' => get_permalink( (int) get_option( 'page_for_posts' ) ) ?: home_url( '/blog/' ),
		'testimonials.html'    => home_url( '/testimonials/' ),
		'faq.html'             => home_url( '/faq/' ),
		'team.html'            => home_url( '/team/' ),
		'guarantees.html'      => home_url( '/guarantees/' ),
		'privacy.html'         => home_url( '/privacy/' ),
		'terms.html'           => home_url( '/terms/' ),
		'ai-assistant.html'    => home_url( '/ai-assistant/' ),
		'login.html'           => wp_login_url(),
		'register.html'        => wp_registration_url(),
		'profile.html'         => home_url( '/contact/' ),
		'employee.html'        => home_url( '/contact/' ),
	);

	foreach ( $map as $from => $to ) {
		$html = str_replace( 'href="' . $from . '"', 'href="' . esc_url( $to ) . '"', $html );
		$html = str_replace( "href='" . $from . "'", "href='" . esc_url( $to ) . "'", $html );
	}

	// Relative assets in source site (rare) — leave external URLs.
	$html = preg_replace( '#(src|href)="assets/#', '$1="' . home_url( '/wp-content/themes/tek-craft-toppres/assets/images/' ), $html );

	// Dead HTML order-modal buttons → Contact page.
	$contact = esc_url( home_url( '/contact/' ) );
	$html    = preg_replace(
		'/<button([^>]*class="[^"]*open-order-modal[^"]*"[^>]*)>(.*?)<\/button>/is',
		'<a href="' . $contact . '" class="btn btn-gold btn-sm">$2</a>',
		$html
	);

	return $html;
}

/**
 * Create or update a page by slug and make it Elementor-editable.
 *
 * @param string $slug    Slug.
 * @param string $title   Title.
 * @param string $content HTML content.
 * @return int
 */
function tk_upsert_page( $slug, $title, $content ) {
	$existing = get_page_by_path( $slug );
	$data     = array(
		'post_title'   => $title,
		'post_name'    => $slug,
		'post_status'  => 'publish',
		'post_type'    => 'page',
		'post_content' => $content,
	);

	if ( $existing ) {
		$data['ID'] = $existing->ID;
		$id         = wp_update_post( $data, true );
	} else {
		$id = wp_insert_post( $data, true );
	}

	if ( is_wp_error( $id ) ) {
		WP_CLI::warning( $slug . ': ' . $id->get_error_message() );
		return 0;
	}

	// Pages are seeded as real Elementor TK section widgets later (seed-pages.php).
	// Do NOT wrap marketing pages in a raw HTML widget.

	WP_CLI::log( "Page OK: {$title} (#{$id}) /{$slug}/" );
	return (int) $id;
}

/**
 * Random Elementor element id.
 *
 * @return string
 */
function tk_migrate_el_id() {
	return substr( md5( uniqid( (string) wp_rand(), true ) ), 0, 7 );
}

/**
 * Store page HTML inside an Elementor HTML widget so it opens in Elementor editor.
 *
 * @param int    $post_id Post ID.
 * @param string $html    HTML.
 */
function tk_make_elementor_html_page( $post_id, $html ) {
	$elements = array(
		array(
			'id'       => tk_migrate_el_id(),
			'elType'   => 'container',
			'isInner'  => false,
			'settings' => array(
				'content_width'  => 'full',
				'flex_direction' => 'column',
				'padding'        => array(
					'unit'     => 'px',
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true,
				),
			),
			'elements' => array(
				array(
					'id'         => tk_migrate_el_id(),
					'elType'     => 'widget',
					'widgetType' => 'html',
					'settings'   => array(
						'html' => $html,
					),
					'elements'   => array(),
				),
			),
		),
	);

	update_post_meta( $post_id, '_elementor_edit_mode', 'builder' );
	update_post_meta( $post_id, '_elementor_template_type', 'wp-page' );
	update_post_meta( $post_id, '_elementor_version', defined( 'ELEMENTOR_VERSION' ) ? ELEMENTOR_VERSION : '3.21.0' );
	update_post_meta( $post_id, '_elementor_data', wp_slash( wp_json_encode( $elements ) ) );
	update_post_meta( $post_id, '_wp_page_template', 'templates/elementor-fullwidth.php' );
	delete_post_meta( $post_id, '_elementor_css' );
}

/**
 * Sideload remote image as featured image (download first — sideload URL often fails).
 *
 * @param int    $post_id Post ID.
 * @param string $url     Image URL.
 * @param string $desc    Description.
 * @param bool   $force   Replace existing thumbnail.
 */
function tk_set_featured_from_url( $post_id, $url, $desc = '', $force = false ) {
	if ( ! $url ) {
		return;
	}
	if ( has_post_thumbnail( $post_id ) && ! $force ) {
		return;
	}
	if ( ! function_exists( 'media_handle_sideload' ) ) {
		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/media.php';
		require_once ABSPATH . 'wp-admin/includes/image.php';
	}

	$response = wp_remote_get(
		$url,
		array(
			'timeout'    => 30,
			'user-agent' => 'Mozilla/5.0 (compatible; TekCraftToppres/1.0)',
		)
	);
	if ( is_wp_error( $response ) || 200 !== (int) wp_remote_retrieve_response_code( $response ) ) {
		// Fallback to core sideload.
		$id = media_sideload_image( $url, $post_id, $desc, 'id' );
		if ( ! is_wp_error( $id ) ) {
			set_post_thumbnail( $post_id, $id );
		}
		return;
	}

	$body = wp_remote_retrieve_body( $response );
	if ( ! $body ) {
		return;
	}

	$tmp = wp_tempnam( 'tk-img-' . $post_id );
	if ( ! $tmp ) {
		return;
	}
	file_put_contents( $tmp, $body ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_file_put_contents

	$file_array = array(
		'name'     => 'post-' . $post_id . '-' . wp_unique_id() . '.jpg',
		'tmp_name' => $tmp,
	);

	$id = media_handle_sideload( $file_array, $post_id, $desc );
	if ( is_wp_error( $id ) ) {
		@unlink( $tmp ); // phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged
		return;
	}
	set_post_thumbnail( $post_id, $id );
}

/**
 * Find post by title + type.
 *
 * @param string $title Title.
 * @param string $type  Post type.
 * @return WP_Post|null
 */
function tk_find_by_title( $title, $type = 'post' ) {
	$q = new WP_Query(
		array(
			'post_type'              => $type,
			'title'                  => $title,
			'posts_per_page'         => 1,
			'post_status'            => 'any',
			'no_found_rows'          => true,
			'ignore_sticky_posts'    => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
		)
	);
	return $q->have_posts() ? $q->posts[0] : null;
}

$page_map = array(
	'about.html'        => array( 'about', 'من نحن' ),
	'contact.html'      => array( 'contact', 'تواصل معنا' ),
	'services.html'     => array( 'services-guide', 'دليل الخدمات' ),
	'faq.html'          => array( 'faq', 'الأسئلة الشائعة' ),
	'testimonials.html' => array( 'testimonials', 'آراء الطلاب' ),
	'team.html'         => array( 'team', 'فريق العمل' ),
	'guarantees.html'   => array( 'guarantees', 'ضماناتنا' ),
	'privacy.html'      => array( 'privacy', 'سياسة الخصوصية' ),
	'terms.html'        => array( 'terms', 'الشروط والأحكام' ),
	'ai-assistant.html' => array( 'ai-assistant', 'المساعد الذكي' ),
);

$created_pages = array();

foreach ( $page_map as $file => $meta ) {
	$path = trailingslashit( $html_dir ) . $file;
	if ( ! file_exists( $path ) ) {
		WP_CLI::warning( "Missing {$file}" );
		continue;
	}
	$raw     = file_get_contents( $path );
	$content = tk_rewrite_html_links( tk_extract_main_html( $raw ) );
	$id      = tk_upsert_page( $meta[0], $meta[1], $content );
	if ( $id ) {
		$created_pages[ $meta[0] ] = $id;
	}
}

// Blog page.
$blog_id = (int) get_option( 'page_for_posts' );
if ( ! $blog_id ) {
	$blog_id = tk_upsert_page( 'blog', 'المقالات', '' );
	update_option( 'page_for_posts', $blog_id );
} else {
	wp_update_post(
		array(
			'ID'         => $blog_id,
			'post_title' => 'المقالات',
			'post_name'  => 'blog',
		)
	);
}

// Ensure Home is front.
$home = get_page_by_path( 'home' );
if ( ! $home ) {
	$home_id = tk_upsert_page( 'home', 'الرئيسية', '' );
} else {
	$home_id = $home->ID;
}
update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $home_id );
update_option( 'page_for_posts', $blog_id );

// ---- Import blog posts from blog.html ----
$blog_html = file_get_contents( trailingslashit( $html_dir ) . 'blog.html' );
$posts_src = array();

if ( preg_match_all( '/<a[^>]*class="[^"]*article-card[^"]*"[^>]*>.*?<\/a>/is', $blog_html, $cards ) ) {
	foreach ( $cards[0] as $card ) {
		$title = '';
		$img   = '';
		$badge = '';
		$desc  = '';
		if ( preg_match( '/<h3[^>]*>(.*?)<\/h3>/is', $card, $m ) ) {
			$title = wp_strip_all_tags( $m[1] );
		}
		if ( preg_match( '/<img[^>]+src=["\']([^"\']+)["\']/i', $card, $m ) ) {
			$img = $m[1];
		}
		if ( preg_match( '/class="ac-badge"[^>]*>(.*?)<\/span>/is', $card, $m ) ) {
			$badge = wp_strip_all_tags( $m[1] );
		}
		if ( preg_match( '/<p[^>]*>(.*?)<\/p>/is', $card, $m ) ) {
			$desc = wp_strip_all_tags( $m[1] );
		}
		if ( $title ) {
			$posts_src[] = compact( 'title', 'img', 'badge', 'desc' );
		}
	}
}

// Fallback demo posts if none parsed.
if ( empty( $posts_src ) ) {
	$posts_src = array(
		array(
			'title' => 'كيفية اختيار موضوع رسالة الماجستير خطوة بخطوة',
			'img'   => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&q=80&w=600&h=400',
			'badge' => 'نصائح أكاديمية',
			'desc'  => 'دليل شامل يوضح لك أهم المعايير والخطوات لاختيار موضوع بحثي متميز.',
		),
		array(
			'title' => 'أهمية برنامج SPSS في تحليل بيانات البحث العلمي',
			'img'   => 'https://images.unsplash.com/photo-1513258496099-48168024aec0?auto=format&fit=crop&q=80&w=600&h=400',
			'badge' => 'التحليل الإحصائي',
			'desc'  => 'تعرف على أساسيات التحليل الإحصائي باستخدام برنامج SPSS.',
		),
		array(
			'title' => 'معايير قبول الأبحاث في المجلات العلمية المحكمة',
			'img'   => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&q=80&w=600&h=400',
			'badge' => 'النشر العلمي',
			'desc'  => 'اكتشف أهم النقاط التي يركز عليها المحكمون عند مراجعة بحثك.',
		),
	);
}

// Richer content from single blog templates (article body only — theme wraps hero).
$single_blog = '';
foreach ( array( 'new-single-blog.html', 'single-blog.html' ) as $single_file ) {
	$path = trailingslashit( $html_dir ) . $single_file;
	if ( ! file_exists( $path ) ) {
		continue;
	}
	$raw = file_get_contents( $path );
	$pos = stripos( $raw, 'class="article-body"' );
	if ( false !== $pos ) {
		$pos   = strpos( $raw, '>', $pos );
		$start = ( false !== $pos ) ? $pos + 1 : 0;
		$end   = strlen( $raw );
		foreach ( array( '</div>', 'class="article-footer-row"', 'class="article-share"', 'class="article-sidebar"', '<!-- Tags', '<footer' ) as $i => $marker ) {
			// Prefer the first closing of article-body: find </div> after start that closes body — use footer-row marker primarily.
			if ( 'class="article-footer-row"' === $marker || 'class="article-share"' === $marker || '<!-- Tags' === $marker ) {
				$p = stripos( $raw, $marker, $start );
				if ( false !== $p && $p < $end ) {
					$end = $p;
				}
			}
		}
		$chunk = trim( substr( $raw, $start, $end - $start ) );
		// Keep only prose nodes.
		$single_blog = tk_rewrite_html_links( tk_sanitize_article_body_html( $chunk ) );
	}
	break;
}

foreach ( $posts_src as $i => $p ) {
	$existing = tk_find_by_title( $p['title'], 'post' );
	$content  = '<p>' . esc_html( $p['desc'] ) . '</p>';
	if ( $single_blog ) {
		// First post gets full sample article body; others keep their excerpt as content seed.
		$content = ( 0 === $i ) ? $single_blog : ( '<p>' . esc_html( $p['desc'] ) . '</p><p>' . esc_html__( 'يمكنك استبدال هذا النص بمحتوى المقال الكامل من لوحة التحكم أو Elementor.', 'tek-craft-toppres' ) . '</p>' );
	}

	$data = array(
		'post_title'   => $p['title'],
		'post_status'  => 'publish',
		'post_type'    => 'post',
		'post_content' => $content,
		'post_excerpt' => $p['desc'],
	);

	if ( $existing ) {
		$data['ID'] = $existing->ID;
		$pid        = wp_update_post( $data );
	} else {
		$pid = wp_insert_post( $data );
	}

	if ( $pid && ! is_wp_error( $pid ) ) {
		if ( ! empty( $p['badge'] ) ) {
			wp_set_post_terms( $pid, array( $p['badge'] ), 'category', false );
		}
		if ( ! empty( $p['img'] ) ) {
			tk_set_featured_from_url( $pid, $p['img'], $p['title'], true );
		}
	}

	WP_CLI::log( "Post OK: {$p['title']} (#{$pid})" );
}

// ---- Services from services.html cards ----
$services_html = file_get_contents( trailingslashit( $html_dir ) . 'services.html' );
$svc_items     = array();

if ( preg_match_all( '/<div[^>]*class="[^"]*service-card[^"]*"[^>]*>.*?<\/div>\s*<\/div>/is', $services_html, $svc_cards ) ) {
	foreach ( $svc_cards[0] as $card ) {
		$title = $desc = $img = '';
		if ( preg_match( '/<h3[^>]*>(.*?)<\/h3>/is', $card, $m ) ) {
			$title = wp_strip_all_tags( $m[1] );
		}
		if ( preg_match( '/<p[^>]*>(.*?)<\/p>/is', $card, $m ) ) {
			$desc = wp_strip_all_tags( $m[1] );
		}
		if ( preg_match( '/<img[^>]+src=["\']([^"\']+)["\']/i', $card, $m ) ) {
			$img = $m[1];
		}
		if ( $title ) {
			$svc_items[] = compact( 'title', 'desc', 'img' );
		}
	}
}

if ( empty( $svc_items ) ) {
	// From home service cards defaults.
	$svc_items = array(
		array( 'title' => 'البحوث الجامعية', 'desc' => 'إعداد بحوث جامعية بمنهجية علمية دقيقة.', 'img' => '' ),
		array( 'title' => 'رسائل الماجستير', 'desc' => 'مرافقة كاملة من اختيار العنوان حتى المناقشة.', 'img' => '' ),
		array( 'title' => 'أطروحات الدكتوراه', 'desc' => 'دعم بحثي متقدم لمراحل الدكتوراه.', 'img' => '' ),
		array( 'title' => 'التحليل الإحصائي', 'desc' => 'تحليل بيانات البحث بالبرامج المناسبة.', 'img' => '' ),
		array( 'title' => 'خطة البحث والمقترح', 'desc' => 'صياغة مقترح بحثي متكامل.', 'img' => '' ),
		array( 'title' => 'الترجمة الأكاديمية', 'desc' => 'ترجمة دقيقة للأبحاث والمصادر.', 'img' => '' ),
		array( 'title' => 'التدقيق اللغوي', 'desc' => 'مراجعة لغوية شاملة.', 'img' => '' ),
		array( 'title' => 'فحص نسبة الاقتباس', 'desc' => 'تقرير دقيق لنسبة التشابه.', 'img' => '' ),
	);
}

$single_service = '';
if ( file_exists( trailingslashit( $html_dir ) . 'single-service.html' ) ) {
	$single_service = tk_rewrite_html_links( tk_extract_main_html( file_get_contents( trailingslashit( $html_dir ) . 'single-service.html' ) ) );
}

foreach ( $svc_items as $i => $s ) {
	$existing = tk_find_by_title( $s['title'], 'tk_service' );
	$content  = '<p>' . esc_html( $s['desc'] ) . '</p>';
	if ( $single_service && false ) {
		$content = $single_service;
	}
	// Keep service body short — single template renders the design; Elementor can edit later.
	$content = '<p>' . esc_html( $s['desc'] ) . '</p><p>' . esc_html__( 'نوفر هذه الخدمة بمعايير أكاديمية عالية، مع فريق متخصص ومواعيد واضحة ومراجعة جودة قبل التسليم.', 'tek-craft-toppres' ) . '</p>';

	$data = array(
		'post_title'   => $s['title'],
		'post_status'  => 'publish',
		'post_type'    => 'tk_service',
		'post_content' => $content,
		'post_excerpt' => $s['desc'],
	);

	if ( $existing ) {
		$data['ID'] = $existing->ID;
		$sid        = wp_update_post( $data );
	} else {
		$sid = wp_insert_post( $data );
	}

	if ( $sid && ! is_wp_error( $sid ) && ! empty( $s['img'] ) ) {
		tk_set_featured_from_url( $sid, $s['img'], $s['title'] );
	}

	WP_CLI::log( "Service OK: {$s['title']} (#{$sid})" );
}

// ---- Menus ----
function tk_ensure_menu( $name, $location ) {
	$menu = wp_get_nav_menu_object( $name );
	if ( ! $menu ) {
		$menu_id = wp_create_nav_menu( $name );
	} else {
		$menu_id = (int) $menu->term_id;
		$items   = wp_get_nav_menu_items( $menu_id );
		if ( $items ) {
			foreach ( $items as $item ) {
				wp_delete_post( $item->ID, true );
			}
		}
	}

	$locations              = get_theme_mod( 'nav_menu_locations', array() );
	$locations[ $location ] = $menu_id;
	set_theme_mod( 'nav_menu_locations', $locations );

	return (int) $menu_id;
}

function tk_menu_add_page( $menu_id, $page_id, $title = '' ) {
	if ( ! $page_id ) {
		return;
	}
	wp_update_nav_menu_item(
		$menu_id,
		0,
		array(
			'menu-item-title'     => $title ? $title : get_the_title( $page_id ),
			'menu-item-object'    => 'page',
			'menu-item-object-id' => $page_id,
			'menu-item-type'      => 'post_type',
			'menu-item-status'    => 'publish',
		)
	);
}

function tk_menu_add_url( $menu_id, $title, $url ) {
	wp_update_nav_menu_item(
		$menu_id,
		0,
		array(
			'menu-item-title'  => $title,
			'menu-item-url'    => $url,
			'menu-item-type'   => 'custom',
			'menu-item-status' => 'publish',
		)
	);
}

$primary_id = tk_ensure_menu( 'Primary', 'primary' );
tk_menu_add_page( $primary_id, $home_id, 'الرئيسية' );
tk_menu_add_url( $primary_id, 'الخدمات', get_post_type_archive_link( 'tk_service' ) ?: home_url( '/services/' ) );
tk_menu_add_page( $primary_id, $created_pages['about'] ?? 0, 'من نحن' );
tk_menu_add_page( $primary_id, $created_pages['testimonials'] ?? 0, 'آراء الطلاب' );
tk_menu_add_page( $primary_id, $blog_id, 'المقالات' );
tk_menu_add_page( $primary_id, $created_pages['contact'] ?? 0, 'تواصل معنا' );

$footer_id = tk_ensure_menu( 'Footer Links', 'footer' );
tk_menu_add_page( $footer_id, $home_id, 'الرئيسية' );
tk_menu_add_url( $footer_id, 'الخدمات', get_post_type_archive_link( 'tk_service' ) ?: home_url( '/services/' ) );
tk_menu_add_page( $footer_id, $created_pages['about'] ?? 0, 'من نحن' );
tk_menu_add_page( $footer_id, $blog_id, 'المقالات' );
tk_menu_add_page( $footer_id, $created_pages['faq'] ?? 0, 'الأسئلة الشائعة' );
tk_menu_add_page( $footer_id, $created_pages['privacy'] ?? 0, 'سياسة الخصوصية' );
tk_menu_add_page( $footer_id, $created_pages['terms'] ?? 0, 'الشروط والأحكام' );

$footer_svc_id = tk_ensure_menu( 'Footer Services', 'footer_services' );
$services      = get_posts( array( 'post_type' => 'tk_service', 'posts_per_page' => 6, 'post_status' => 'publish' ) );
foreach ( $services as $svc ) {
	wp_update_nav_menu_item(
		$footer_svc_id,
		0,
		array(
			'menu-item-title'     => $svc->post_title,
			'menu-item-object'    => 'tk_service',
			'menu-item-object-id' => $svc->ID,
			'menu-item-type'      => 'post_type',
			'menu-item-status'    => 'publish',
		)
	);
}

flush_rewrite_rules( false );

WP_CLI::success( 'HTML migration complete. Pages, posts, services, and menus are ready.' );
