<?php
/**
 * Import remote images into Media Library and rewrite content URLs.
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Import a remote image URL into the Media Library (cached by URL hash).
 *
 * @param string $url  Remote URL.
 * @param string $desc Attachment title.
 * @return int Attachment ID or 0.
 */
function tk_import_remote_image( $url, $desc = '' ) {
	$url = esc_url_raw( trim( $url ) );
	if ( ! $url || 0 !== strpos( $url, 'http' ) ) {
		return 0;
	}

	// Already local?
	$uploads = wp_upload_dir();
	if ( ! empty( $uploads['baseurl'] ) && false !== strpos( $url, $uploads['baseurl'] ) ) {
		$id = attachment_url_to_postid( $url );
		return $id ? (int) $id : 0;
	}

	$hash = md5( preg_replace( '/[?#].*$/', '', $url ) );
	$existing = get_posts(
		array(
			'post_type'      => 'attachment',
			'post_status'    => 'inherit',
			'posts_per_page' => 1,
			'meta_key'       => '_tk_source_hash', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
			'meta_value'     => $hash, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
			'fields'         => 'ids',
		)
	);
	if ( $existing ) {
		return (int) $existing[0];
	}

	if ( ! function_exists( 'media_handle_sideload' ) ) {
		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/media.php';
		require_once ABSPATH . 'wp-admin/includes/image.php';
	}

	$response = wp_remote_get(
		$url,
		array(
			'timeout'    => 45,
			'redirection' => 5,
			'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (compatible; TekCraftToppres/1.3)',
		)
	);

	if ( is_wp_error( $response ) || 200 !== (int) wp_remote_retrieve_response_code( $response ) ) {
		return 0;
	}

	$body = wp_remote_retrieve_body( $response );
	if ( ! $body ) {
		return 0;
	}

	$content_type = wp_remote_retrieve_header( $response, 'content-type' );
	$ext          = 'jpg';
	if ( is_string( $content_type ) ) {
		if ( false !== strpos( $content_type, 'png' ) ) {
			$ext = 'png';
		} elseif ( false !== strpos( $content_type, 'webp' ) ) {
			$ext = 'webp';
		} elseif ( false !== strpos( $content_type, 'gif' ) ) {
			$ext = 'gif';
		}
	}

	$tmp = wp_tempnam( 'tk-remote-' . $hash );
	if ( ! $tmp ) {
		return 0;
	}
	// phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_file_put_contents
	file_put_contents( $tmp, $body );

	$file_array = array(
		'name'     => sanitize_file_name( ( $desc ? sanitize_title( $desc ) : 'tk-img' ) . '-' . substr( $hash, 0, 8 ) . '.' . $ext ),
		'tmp_name' => $tmp,
	);

	$id = media_handle_sideload( $file_array, 0, $desc ? $desc : 'Toppres image' );
	if ( is_wp_error( $id ) ) {
		@unlink( $tmp ); // phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged
		return 0;
	}

	update_post_meta( $id, '_tk_source_hash', $hash );
	update_post_meta( $id, '_tk_source_url', $url );
	return (int) $id;
}

/**
 * Replace all http(s) image URLs in a string with local Media Library URLs.
 *
 * @param string $html HTML or JSON string.
 * @return string
 */
function tk_localize_urls_in_string( $html ) {
	if ( ! is_string( $html ) || '' === $html ) {
		return $html;
	}

	// Plain URLs in HTML.
	$html = preg_replace_callback(
		'#https?://images\.unsplash\.com/[^\"\'\s\)\\\\]+#i',
		static function ( $m ) {
			$url = rtrim( html_entity_decode( $m[0], ENT_QUOTES ), '\\' );
			$id  = tk_import_remote_image( $url );
			if ( ! $id ) {
				return $m[0];
			}
			$local = wp_get_attachment_url( $id );
			return $local ? $local : $m[0];
		},
		$html
	);

	// JSON-escaped URLs (Elementor _elementor_data).
	$html = preg_replace_callback(
		'#https?:\\\\/\\\\/images\.unsplash\.com\\\\/[^\"\'\s]+#i',
		static function ( $m ) {
			$url = stripslashes( $m[0] );
			$url = str_replace( '\/', '/', $url );
			$id  = tk_import_remote_image( $url );
			if ( ! $id ) {
				return $m[0];
			}
			$local = wp_get_attachment_url( $id );
			if ( ! $local ) {
				return $m[0];
			}
			return str_replace( '/', '\/', $local );
		},
		$html
	);

	return $html;
}

/**
 * Full site media localization: pages, posts, services, Elementor data, home seed images.
 *
 * @return array Stats.
 */
function tk_localize_all_site_images() {
	$stats = array(
		'posts'    => 0,
		'services' => 0,
		'pages'    => 0,
		'home'     => 0,
	);

	$html_dirs = array(
		dirname( TK_THEME_DIR ) . '/tek-craft-tppres',
		'C:/Users/HP/Downloads/toprees  wordpress  theme/tek-craft-tppres',
		'C:/laragon/www/toppres/wp-content/themes/tek-craft-tppres',
	);
	$html_dir = '';
	foreach ( $html_dirs as $d ) {
		if ( is_dir( $d ) && file_exists( $d . '/blog.html' ) ) {
			$html_dir = $d;
			break;
		}
	}

	// ---- Blog featured images from blog.html ----
	$post_map = array();
	if ( $html_dir && file_exists( $html_dir . '/blog.html' ) ) {
		$blog = file_get_contents( $html_dir . '/blog.html' ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
		if ( preg_match_all( '/<a[^>]*class="[^"]*article-card[^"]*"[^>]*>.*?<\/a>/is', $blog, $cards ) ) {
			foreach ( $cards[0] as $card ) {
				$title = $img = '';
				if ( preg_match( '/<h3[^>]*>(.*?)<\/h3>/is', $card, $m ) ) {
					$title = wp_strip_all_tags( $m[1] );
				}
				if ( preg_match( '/<img[^>]+src=["\']([^"\']+)["\']/i', $card, $m ) ) {
					$img = $m[1];
				}
				if ( $title && $img ) {
					$post_map[ $title ] = $img;
				}
			}
		}
	}

	foreach ( $post_map as $title => $img_url ) {
		$q = new WP_Query(
			array(
				'post_type'      => 'post',
				'title'          => $title,
				'posts_per_page' => 1,
				'post_status'    => 'any',
			)
		);
		$post = $q->have_posts() ? $q->posts[0] : null;
		wp_reset_postdata();
		if ( ! $post ) {
			continue;
		}
		$id = tk_import_remote_image( $img_url, $title );
		if ( $id ) {
			set_post_thumbnail( $post->ID, $id );
			++$stats['posts'];
		}
	}

	// ---- Services featured images from services.html ----
	$svc_map = array();
	if ( $html_dir && file_exists( $html_dir . '/services.html' ) ) {
		$svc_html = file_get_contents( $html_dir . '/services.html' ); // phpcs:ignore
		if ( preg_match_all( '/<a[^>]*class="[^"]*service-card[^"]*"[^>]*>.*?<\/a>/is', $svc_html, $cards ) ) {
			foreach ( $cards[0] as $card ) {
				$title = $img = '';
				if ( preg_match( '/<h3[^>]*>(.*?)<\/h3>/is', $card, $m ) ) {
					$title = wp_strip_all_tags( $m[1] );
				}
				if ( preg_match( '/<img[^>]+src=["\']([^"\']+)["\']/i', $card, $m ) ) {
					$img = $m[1];
				}
				if ( $title && $img ) {
					$svc_map[ $title ] = $img;
				}
			}
		}
	}

	// Fuzzy match CPT titles to HTML card titles.
	$alias = array(
		'البحوث الجامعية'           => 'البحوث الجامعية المتقدمة',
		'رسائل الماجستير'           => 'إعداد رسائل الماجستير',
		'خطة البحث والمقترح'        => 'خطة البحث (Proposal)',
		'التحليل الإحصائي'          => 'التحليل الإحصائي ببرنامج SPSS',
		'التدقيق اللغوي'            => 'التدقيق اللغوي والإملائي',
		'الترجمة الأكاديمية'        => 'الترجمة الأكاديمية',
		'أطروحات الدكتوراه'         => 'إعداد رسائل الماجستير',
		'فحص نسبة الاقتباس'         => 'النشر في المجلات العلمية',
	);

	foreach ( get_posts( array( 'post_type' => 'tk_service', 'numberposts' => -1, 'post_status' => 'any' ) ) as $svc ) {
		$title = $svc->post_title;
		$url   = '';
		if ( isset( $svc_map[ $title ] ) ) {
			$url = $svc_map[ $title ];
		} elseif ( isset( $alias[ $title ] ) && isset( $svc_map[ $alias[ $title ] ] ) ) {
			$url = $svc_map[ $alias[ $title ] ];
		} else {
			foreach ( $svc_map as $html_title => $img ) {
				if ( false !== strpos( $html_title, $title ) || false !== strpos( $title, mb_substr( $html_title, 0, 8 ) ) ) {
					$url = $img;
					break;
				}
			}
		}
		if ( ! $url ) {
			// Fallback rotating images from map.
			$urls = array_values( $svc_map );
			$url  = $urls[ $svc->ID % max( 1, count( $urls ) ) ] ?? '';
		}
		if ( $url ) {
			$id = tk_import_remote_image( $url, $title );
			if ( $id ) {
				set_post_thumbnail( $svc->ID, $id );
				++$stats['services'];
			}
		}
	}

	// ---- Rewrite Elementor HTML in all pages/posts ----
	$ids = get_posts(
		array(
			'post_type'      => array( 'page', 'post', 'tk_service' ),
			'posts_per_page' => -1,
			'post_status'    => 'any',
			'fields'         => 'ids',
		)
	);

	foreach ( $ids as $pid ) {
		$changed = false;

		$content = get_post_field( 'post_content', $pid );
		$new     = tk_localize_urls_in_string( $content );
		if ( $new !== $content ) {
			wp_update_post(
				array(
					'ID'           => $pid,
					'post_content' => $new,
				)
			);
			$changed = true;
		}

		$data = get_post_meta( $pid, '_elementor_data', true );
		if ( $data ) {
			$raw = is_string( $data ) ? $data : wp_json_encode( $data );
			$new = tk_localize_urls_in_string( $raw );
			if ( $new !== $raw ) {
				update_post_meta( $pid, '_elementor_data', wp_slash( $new ) );
				delete_post_meta( $pid, '_elementor_css' );
				$changed = true;
			}
		}

		if ( $changed ) {
			++$stats['pages'];
		}
	}

	// ---- Re-seed home Elementor widgets with local media ----
	$home_id = (int) get_option( 'page_on_front' );
	if ( $home_id ) {
		$hero1 = tk_import_remote_image( 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&q=80&w=1920', 'Hero 1' );
		$hero2 = tk_import_remote_image( 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&q=80&w=1920', 'Hero 2' );
		$hero3 = tk_import_remote_image( 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&q=80&w=1920', 'Hero 3' );

		$svc_imgs = array(
			tk_import_remote_image( 'https://images.unsplash.com/photo-1488190211105-8b0e65b80b4e?auto=format&fit=crop&q=80&w=600&h=400', 'Service 1' ),
			tk_import_remote_image( 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&q=80&w=600&h=400', 'Service 2' ),
			tk_import_remote_image( 'https://images.unsplash.com/photo-1513258496099-48168024aec0?auto=format&fit=crop&q=80&w=600&h=400', 'Service 3' ),
			tk_import_remote_image( 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&q=80&w=600&h=400', 'Service 4' ),
		);

		$media = static function ( $id ) {
			if ( ! $id ) {
				return array( 'url' => '', 'id' => '' );
			}
			return array(
				'id'  => $id,
				'url' => wp_get_attachment_url( $id ),
			);
		};

		$data = get_post_meta( $home_id, '_elementor_data', true );
		if ( is_string( $data ) ) {
			$data = json_decode( $data, true );
		}
		if ( ! is_array( $data ) || empty( $data ) ) {
			$seed = TK_THEME_DIR . '/inc/elementor/seed-home.php';
			if ( file_exists( $seed ) ) {
				ob_start();
				include $seed;
				ob_end_clean();
			}
			$data = get_post_meta( $home_id, '_elementor_data', true );
			if ( is_string( $data ) ) {
				$data = json_decode( $data, true );
			}
		}

		if ( is_array( $data ) ) {
			$json    = tk_localize_urls_in_string( wp_json_encode( $data ) );
			$decoded = json_decode( $json, true );
			if ( is_array( $decoded ) ) {
				foreach ( $decoded as &$section ) {
					$widget = $section['elements'][0] ?? null;
					if ( ! $widget || empty( $widget['widgetType'] ) ) {
						continue;
					}
					if ( 'tk_hero_slider' === $widget['widgetType'] && ! empty( $widget['settings']['slides'] ) ) {
						$heroes = array( $hero1, $hero2, $hero3 );
						foreach ( $widget['settings']['slides'] as $i => &$slide ) {
							$hid                 = $heroes[ $i ] ?? $hero1;
							$slide['bg_image']   = $media( $hid );
						}
						unset( $slide );
					}
					if ( 'tk_services' === $widget['widgetType'] && ! empty( $widget['settings']['cards'] ) ) {
						foreach ( $widget['settings']['cards'] as $i => &$card ) {
							$sid           = $svc_imgs[ $i % count( $svc_imgs ) ];
							$card['image'] = $media( $sid );
						}
						unset( $card );
					}
				}
				unset( $section );
				update_post_meta( $home_id, '_elementor_data', wp_slash( wp_json_encode( $decoded ) ) );
				delete_post_meta( $home_id, '_elementor_css' );
				$stats['home'] = 1;
			}
		}
	}

	if ( class_exists( '\Elementor\Plugin' ) ) {
		\Elementor\Plugin::$instance->files_manager->clear_cache();
	}

	update_option( 'tk_media_localized_at', time() );
	return $stats;
}
