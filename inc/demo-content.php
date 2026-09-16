<?php
/**
 * Seed demo pages, menu, and sample content on first activation.
 *
 * @package Toppers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'after_switch_theme', 'toppers_seed_demo' );
add_action( 'init', 'toppers_seed_demo_once', 30 );
function toppers_seed_demo_once() {
	if ( get_option( 'toppers_demo_seeded_v3' ) ) {
		return;
	}
	delete_option( 'toppers_demo_seeded' );
	delete_option( 'toppers_demo_seeded_v2' );
	toppers_seed_demo();
	update_option( 'toppers_demo_seeded_v3', 1 );
}
function toppers_get_or_create_category( $name ) {
	$term = term_exists( $name, 'category' );
	if ( ! $term ) {
		$term = wp_insert_term( $name, 'category' );
	}
	if ( is_wp_error( $term ) ) {
		return 0;
	}
	return (int) ( is_array( $term ) ? $term['term_id'] : $term );
}
function toppers_seed_demo() {
	if ( get_option( 'toppers_demo_seeded' ) && get_option( 'toppers_demo_seeded_v3' ) ) {
		return;
	}

	$pages = array(
		'home'         => array( __( 'الرئيسية', 'toppers' ), 'templates/front-home.php' ),
		'about'        => array( __( 'من نحن', 'toppers' ), 'templates/page-about.php' ),
		'services'     => array( __( 'الخدمات', 'toppers' ), 'templates/page-services.php' ),
		'testimonials' => array( __( 'آراء الطلاب', 'toppers' ), 'templates/page-testimonials.php' ),
		'contact'      => array( __( 'تواصل معنا', 'toppers' ), 'templates/page-contact.php' ),
		'faq'          => array( __( 'الأسئلة الشائعة', 'toppers' ), 'templates/page-faq.php' ),
		'team'         => array( __( 'فريق العمل', 'toppers' ), 'templates/page-team.php' ),
		'guarantees'   => array( __( 'الضمانات', 'toppers' ), 'templates/page-guarantees.php' ),
		'privacy'      => array( __( 'سياسة الخصوصية', 'toppers' ), 'templates/page-privacy.php' ),
		'terms'        => array( __( 'شروط الاستخدام', 'toppers' ), 'templates/page-terms.php' ),
		'blog'         => array( __( 'المقالات', 'toppers' ), '' ),
		'ai-assistant' => array( __( 'المساعد البحثي', 'toppers' ), 'templates/page-ai.php' ),
	);

	$ids = array();
	foreach ( $pages as $slug => $data ) {
		$existing = get_page_by_path( $slug );
		if ( $existing ) {
			$ids[ $slug ] = $existing->ID;
			if ( $data[1] ) {
				update_post_meta( $existing->ID, '_wp_page_template', $data[1] );
			}
			continue;
		}
		$args = array(
			'post_title'   => $data[0],
			'post_name'    => $slug,
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '',
		);
		if ( $data[1] ) {
			$args['page_template'] = $data[1];
		}
		$ids[ $slug ] = wp_insert_post( $args );
	}

	if ( ! empty( $ids['home'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $ids['home'] );
	}
	if ( ! empty( $ids['blog'] ) ) {
		update_option( 'page_for_posts', $ids['blog'] );
	}

	$cats = array(
		'uni'      => 'الطلاب الجامعيين',
		'grad'     => 'الدراسات العليا',
		'research' => 'منهجية البحث العلمي',
		'write'    => 'الكتابة والنشر',
	);
	$cat_ids = array();
	foreach ( $cats as $slug => $name ) {
		$term = term_exists( $name, 'service_category' );
		if ( ! $term ) {
			$term = wp_insert_term( $name, 'service_category', array( 'slug' => $slug ) );
		}
		if ( ! is_wp_error( $term ) ) {
			$cat_ids[ $slug ] = (int) ( is_array( $term ) ? $term['term_id'] : $term );
		}
	}

	$services = array(
		array( 'البحوث الجامعية', 'إعداد بحوث جامعية بمنهجية علمية دقيقة تناسب متطلبات كل مقرر.', 'uni', 'الأكثر طلباً', 'research.jpg' ),
		array( 'دعم مشاريع التخرج', 'مساعدة متكاملة في التخطيط والتنفيذ وكتابة تقارير مشاريع التخرج.', 'uni', '', 'meeting.jpg' ),
		array( 'رسائل الماجستير', 'مرافقة كاملة من اختيار العنوان حتى المناقشة والتنسيق النهائي.', 'grad', 'حصري', 'masters.jpg' ),
		array( 'أطروحات الدكتوراه', 'دعم بحثي متقدم للباحثين في مراحل الدكتوراه المختلفة.', 'grad', '', 'phd.jpg' ),
		array( 'خطة البحث والمقترح', 'صياغة مقترح بحثي متكامل يحدد مشكلة البحث وأهدافه ومنهجيته.', 'grad', '', 'proposal.jpg' ),
		array( 'التحليل الإحصائي', 'تحليل بيانات البحث باستخدام البرامج الإحصائية المناسبة.', 'research', '', 'hero-3.jpg' ),
		array( 'الترجمة الأكاديمية', 'ترجمة دقيقة للأبحاث والمصادر بين العربية ولغات البحث العلمي.', 'write', '', 'laptop.jpg' ),
		array( 'التدقيق اللغوي', 'مراجعة لغوية شاملة لرسائل الماجستير والدكتوراه والأبحاث.', 'write', '', 'proof.jpg' ),
		array( 'فحص نسبة الاقتباس', 'تقرير دقيق لنسبة التشابه مع توصيات لتحسين الأصالة العلمية.', 'research', '', 'library.jpg' ),
		array( 'النشر في المجلات المحكمة', 'تجهيز الورقة العلمية وفق شروط المجلات ومتابعة عملية النشر.', 'write', '', 'publish.jpg' ),
	);

	foreach ( $services as $i => $svc ) {
		if ( toppers_post_exists_title( $svc[0], 'toppers_service' ) ) {
			continue;
		}
		$id = wp_insert_post(
			array(
				'post_title'   => $svc[0],
				'post_content' => $svc[1],
				'post_excerpt' => $svc[1],
				'post_status'  => 'publish',
				'post_type'    => 'toppers_service',
				'menu_order'   => $i,
			)
		);
		if ( $id && ! is_wp_error( $id ) ) {
			if ( ! empty( $svc[3] ) ) {
				update_post_meta( $id, '_toppers_badge', $svc[3] );
			}
			if ( ! empty( $svc[4] ) ) {
				update_post_meta( $id, '_toppers_image', $svc[4] );
			}
			if ( ! empty( $cat_ids[ $svc[2] ] ) ) {
				wp_set_object_terms( $id, array( $cat_ids[ $svc[2] ] ), 'service_category' );
			}
		}
	}

	$testimonials = array(
		array( 'سارة العتيبي', 'طالبة ماجستير — إدارة أعمال', 'تعاملت مع توبرز في رسالة الماجستير، والفريق كان دقيقًا جدًا في المنهجية والتحليل الإحصائي. التزموا بالموعد تمامًا.' ),
		array( 'محمد الحربي', 'باحث دكتوراه — علوم حاسب', 'خدمة الترجمة الأكاديمية كانت احترافية، والمصطلحات العلمية دقيقة جدًا مقارنة بمكاتب أخرى تعاملت معها سابقًا.' ),
		array( 'نورة القحطاني', 'طالبة بكالوريوس', 'التواصل عبر واتساب سهّل عليّ متابعة بحث التخرج، وفريق الدعم كان متجاوبًا في كل مرحلة.' ),
		array( 'أحمد الدوسري', 'باحث ماجستير', 'دعم مستمر وإجابة على جميع الاستفسارات بصدر رحب. تجربة ممتازة ولن تكون الأخيرة.' ),
		array( 'د. ريم الخالدي', 'أستاذ مساعد', 'ساعدوني في نشر بحثي العلمي في مجلة محكمة بوقت قياسي. عمل احترافي بلا شك.' ),
		array( 'ياسر المطيري', 'باحث دكتوراه', 'التدقيق اللغوي كان ممتازاً، لم أجد أي خطأ بعد استلام الملف. شكراً توبرز.' ),
	);
	foreach ( $testimonials as $row ) {
		if ( toppers_post_exists_title( $row[0], 'toppers_testimonial' ) ) {
			continue;
		}
		$id = wp_insert_post(
			array(
				'post_title'   => $row[0],
				'post_content' => $row[2],
				'post_status'  => 'publish',
				'post_type'    => 'toppers_testimonial',
			)
		);
		if ( $id && ! is_wp_error( $id ) ) {
			update_post_meta( $id, '_toppers_role', $row[1] );
			update_post_meta( $id, '_toppers_stars', '5' );
		}
	}

	$team = array();
	foreach ( toppers_team_roster() as $cat_key => $cat ) {
		foreach ( $cat['members'] as $member ) {
			$team[] = array( $member[0], $member[1], $member[2], $cat_key );
		}
	}
	foreach ( $team as $i => $member ) {
		if ( toppers_post_exists_title( $member[0], 'toppers_team' ) ) {
			continue;
		}
		$id = wp_insert_post(
			array(
				'post_title'   => $member[0],
				'post_content' => $member[2],
				'post_excerpt' => $member[1],
				'post_status'  => 'publish',
				'post_type'    => 'toppers_team',
				'menu_order'   => $i,
			)
		);
		if ( $id && ! is_wp_error( $id ) ) {
			update_post_meta( $id, '_toppers_role', $member[1] );
			update_post_meta( $id, '_toppers_university', $member[1] );
			update_post_meta( $id, '_toppers_team_cat', $member[3] );
		}
	}

	$faqs = array(
		array( 'من هي شركة توبرز للاستشارات الأكاديمية؟', 'شركة توبرز للاستشارات الأكاديمية شركة سعودية متخصصة في تقديم الدعم الأكاديمي والاستشارات العلمية لطلاب الدراسات العليا والباحثين.', 'عن الشركة والخدمة' ),
		array( 'ما المعلومات التي أحتاج تقديمها؟', 'موضوع بحثك، المرحلة الدراسية، الخدمة المطلوبة، وأي ملفات أو تعليمات من جامعتك.', 'عن الشركة والخدمة' ),
		array( 'كم تستغرق مدة التنفيذ؟', 'تختلف المدة حسب نوع الخدمة وحجم العمل، ونحددها بوضوح عند إرسال عرض السعر.', 'المواعيد والتنفيذ' ),
		array( 'هل يمكنني طلب تعديلات؟', 'نعم، يمكنك طلب مراجعات على العمل المسلَّم وفق سياسة التعديلات المتفق عليها.', 'المواعيد والتنفيذ' ),
		array( 'ما صيغ الملفات المدعومة؟', 'نستقبل ونسلّم بصيغ PDF وWord وExcel وPowerPoint وغيرها حسب طبيعة الخدمة.', 'الملفات والتسليم' ),
	);
	foreach ( $faqs as $i => $faq ) {
		if ( toppers_post_exists_title( $faq[0], 'toppers_faq' ) ) {
			continue;
		}
		$id = wp_insert_post(
			array(
				'post_title'   => $faq[0],
				'post_content' => $faq[1],
				'post_status'  => 'publish',
				'post_type'    => 'toppers_faq',
				'menu_order'   => $i,
			)
		);
		if ( $id && ! is_wp_error( $id ) ) {
			update_post_meta( $id, '_toppers_faq_cat', $faq[2] );
		}
	}

	if ( ! wp_get_nav_menu_object( 'Toppers Primary' ) ) {
		$menu_id = wp_create_nav_menu( 'Toppers Primary' );
		$items   = array(
			array( 'الرئيسية', get_permalink( $ids['home'] ?? 0 ) ),
			array( 'الخدمات', get_permalink( $ids['services'] ?? 0 ) ),
			array( 'من نحن', get_permalink( $ids['about'] ?? 0 ) ),
			array( 'آراء الطلاب', get_permalink( $ids['testimonials'] ?? 0 ) ),
			array( 'المقالات', get_permalink( $ids['blog'] ?? 0 ) ),
			array( 'تواصل معنا', get_permalink( $ids['contact'] ?? 0 ) ),
		);
		foreach ( $items as $item ) {
			if ( $item[1] ) {
				wp_update_nav_menu_item(
					$menu_id,
					0,
					array(
						'menu-item-title'  => $item[0],
						'menu-item-url'    => $item[1],
						'menu-item-status' => 'publish',
						'menu-item-type'   => 'custom',
					)
				);
			}
		}
		$locations            = get_theme_mod( 'nav_menu_locations', array() );
		$locations['primary'] = $menu_id;
		$locations['mobile']  = $menu_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}

	$posts = array(
		array( 'كيفية اختيار موضوع رسالة الماجستير خطوة بخطوة', 'دليل شامل يوضح أهم المعايير لاختيار موضوع بحثي متميز.', 'نصائح أكاديمية', 'masters.jpg' ),
		array( 'أهمية برنامج SPSS في تحليل بيانات البحث العلمي', 'تعرف على أساسيات التحليل الإحصائي باستخدام SPSS.', 'التحليل الإحصائي', 'hero-3.jpg' ),
		array( 'معايير قبول الأبحاث في المجلات العلمية المحكمة', 'أهم النقاط التي يركز عليها المحكمون عند مراجعة بحثك.', 'النشر العلمي', 'publish.jpg' ),
		array( 'كيف تكتب خطة بحث تقنع لجنة الإشراف', 'خطوات عملية لصياغة مقترح بحثي متكامل.', 'خطة البحث', 'proposal.jpg' ),
		array( 'أخطاء شائعة في مشاريع التخرج وكيفية تجنبها', 'نصائح عملية لطلاب البكالوريوس قبل التسليم.', 'الطلاب الجامعيين', 'meeting.jpg' ),
		array( 'التدقيق اللغوي للرسائل العلمية', 'كيف ترفع جودة النص الأكاديمي قبل المناقشة.', 'الكتابة', 'proof.jpg' ),
	);
	foreach ( $posts as $row ) {
		$pid = toppers_post_exists_title( $row[0], 'post' );
		if ( ! $pid ) {
			$pid = wp_insert_post(
				array(
					'post_title'   => $row[0],
					'post_content' => $row[1],
					'post_excerpt' => $row[1],
					'post_status'  => 'publish',
					'post_type'    => 'post',
				)
			);
		}
		if ( $pid && ! is_wp_error( $pid ) ) {
			$cat_id = toppers_get_or_create_category( $row[2] );
			if ( $cat_id ) {
				wp_set_post_categories( $pid, array( $cat_id ) );
			}
			update_post_meta( $pid, '_toppers_image', $row[3] );
		}
	}

	flush_rewrite_rules();
	update_option( 'toppers_demo_seeded', 1 );
}

add_action( 'after_switch_theme', 'toppers_flush_rewrites', 20 );
function toppers_flush_rewrites() {
	toppers_register_cpts();
	flush_rewrite_rules();
}

add_action( 'init', 'toppers_remove_employee_page', 40 );
function toppers_remove_employee_page() {
	if ( get_option( 'toppers_removed_employee_page' ) ) {
		return;
	}
	$page = get_page_by_path( 'employee' );
	if ( $page ) {
		wp_delete_post( $page->ID, true );
	}
	update_option( 'toppers_removed_employee_page', 1 );
}

add_action( 'init', 'toppers_seed_testimonial_media_v1', 45 );
function toppers_seed_testimonial_media_v1() {
	if ( get_option( 'toppers_seeded_testimonial_media_v1' ) ) {
		return;
	}

	$map = array(
		'سارة العتيبي'   => array( 'photo', 'meeting.jpg' ),
		'محمد الحربي'    => array( 'photo', 'laptop.jpg' ),
		'نورة القحطاني'  => array( 'whatsapp', '' ),
		'د. ريم الخالدي' => array( 'whatsapp', '' ),
		'أحمد الدوسري'   => array( 'text', '' ),
		'ياسر المطيري'   => array( 'text', '' ),
	);

	foreach ( $map as $title => $data ) {
		$id = toppers_post_exists_title( $title, 'toppers_testimonial' );
		if ( ! $id ) {
			continue;
		}
		update_post_meta( $id, '_toppers_testimonial_type', $data[0] );
		if ( $data[1] ) {
			update_post_meta( $id, '_toppers_image', $data[1] );
		}
	}

	update_option( 'toppers_seeded_testimonial_media_v1', 1 );
}

add_action( 'init', 'toppers_seed_testimonial_layout_v2', 46 );
function toppers_seed_testimonial_layout_v2() {
	if ( get_option( 'toppers_seeded_testimonial_layout_v2' ) ) {
		return;
	}
	$map = array(
		'سارة العتيبي'   => 'voice',
		'محمد الحربي'    => 'voice',
		'نورة القحطاني'  => 'voice',
		'أحمد الدوسري'   => 'video',
		'د. ريم الخالدي' => 'image',
		'ياسر المطيري'   => 'text',
	);
	foreach ( $map as $title => $type ) {
		$id = toppers_post_exists_title( $title, 'toppers_testimonial' );
		if ( $id ) {
			update_post_meta( $id, '_toppers_testimonial_type', $type );
		}
	}
	update_option( 'toppers_seeded_testimonial_layout_v2', 1 );
}

add_action( 'init', 'toppers_seed_team_roster_v1', 48 );
function toppers_seed_team_roster_v1() {
	if ( get_option( 'toppers_seeded_team_roster_v1' ) ) {
		return;
	}

	$dummy = array( 'د. خالد السعيد', 'د. منى العتيبي', 'أ. فهد القحطاني' );
	foreach ( $dummy as $title ) {
		$id = toppers_post_exists_title( $title, 'toppers_team' );
		if ( $id ) {
			wp_delete_post( $id, true );
		}
	}

	$order = 0;
	foreach ( toppers_team_roster() as $cat_key => $cat ) {
		foreach ( $cat['members'] as $member ) {
			$id = toppers_post_exists_title( $member[0], 'toppers_team' );
			if ( ! $id ) {
				$id = wp_insert_post(
					array(
						'post_title'   => $member[0],
						'post_content' => $member[2],
						'post_excerpt' => $member[1],
						'post_status'  => 'publish',
						'post_type'    => 'toppers_team',
						'menu_order'   => $order,
					)
				);
			}
			if ( $id && ! is_wp_error( $id ) ) {
				wp_update_post(
					array(
						'ID'           => $id,
						'post_content' => $member[2],
						'post_excerpt' => $member[1],
						'menu_order'   => $order,
					)
				);
				update_post_meta( $id, '_toppers_role', $member[1] );
				update_post_meta( $id, '_toppers_university', $member[1] );
				update_post_meta( $id, '_toppers_team_cat', $cat_key );
			}
			++$order;
		}
	}

	update_option( 'toppers_seeded_team_roster_v1', 1 );
}

add_action( 'init', 'toppers_align_primary_nav_v1', 47 );
function toppers_align_primary_nav_v1() {
	if ( get_option( 'toppers_aligned_primary_nav_v1' ) ) {
		return;
	}
	$locations = get_nav_menu_locations();
	$menu_id   = isset( $locations['primary'] ) ? (int) $locations['primary'] : 0;
	if ( ! $menu_id ) {
		$menu = wp_get_nav_menu_object( 'Toppers Primary' );
		$menu_id = $menu ? (int) $menu->term_id : 0;
	}
	if ( ! $menu_id ) {
		return;
	}

	$wanted = array(
		array( 'الرئيسية', home_url( '/' ) ),
		array( 'الخدمات', toppers_page_url( 'services' ) ),
		array( 'من نحن', toppers_page_url( 'about' ) ),
		array( 'آراء الطلاب', toppers_page_url( 'testimonials' ) ),
		array( 'المقالات', toppers_blog_url() ),
		array( 'تواصل معنا', toppers_page_url( 'contact' ) ),
	);

	$existing = wp_get_nav_menu_items( $menu_id );
	if ( $existing ) {
		foreach ( $existing as $item ) {
			wp_delete_post( $item->ID, true );
		}
	}

	$pos = 1;
	foreach ( $wanted as $row ) {
		if ( empty( $row[1] ) || '#' === $row[1] ) {
			continue;
		}
		wp_update_nav_menu_item(
			$menu_id,
			0,
			array(
				'menu-item-title'    => $row[0],
				'menu-item-url'      => $row[1],
				'menu-item-status'   => 'publish',
				'menu-item-type'     => 'custom',
				'menu-item-position' => $pos++,
			)
		);
	}

	update_option( 'toppers_aligned_primary_nav_v1', 1 );
}

add_action( 'init', 'toppers_purge_theme_auth_pages', 20 );
function toppers_purge_theme_auth_pages() {
	if ( get_option( 'toppers_purged_theme_auth_v1' ) ) {
		return;
	}

	$slugs = array(
		'login',
		'register',
		'profile',
		'client-dashboard',
		'specialist-dashboard',
		'qc-dashboard',
		'platform-order',
		'platform-login',
		'platform-register',
		'platform-client',
		'platform-specialist',
		'platform-qc',
	);
	$deleted_ids = array();
	foreach ( $slugs as $slug ) {
		$page = get_page_by_path( $slug );
		if ( $page ) {
			$deleted_ids[] = (int) $page->ID;
			wp_delete_post( $page->ID, true );
		}
	}

	$locations = get_nav_menu_locations();
	foreach ( $locations as $menu_id ) {
		$items = wp_get_nav_menu_items( $menu_id );
		if ( ! $items ) {
			continue;
		}
		foreach ( $items as $item ) {
			$url = (string) $item->url;
			$object_id = (int) $item->object_id;
			$hit = in_array( $object_id, $deleted_ids, true );
			foreach ( $slugs as $slug ) {
				if ( false !== strpos( $url, '/' . $slug ) ) {
					$hit = true;
					break;
				}
			}
			if ( $hit ) {
				wp_delete_post( $item->ID, true );
			}
		}
	}

	update_option( 'toppers_purged_theme_auth_v1', 1 );
}
