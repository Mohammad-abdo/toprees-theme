<?php
/**
 * Canonical services catalog + sync.
 *
 * @package Toppers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Services catalog version (bump to re-run sync).
 */
define( 'TOPPERS_SERVICES_CATALOG_VER', '2026-03-24-v1' );

/**
 * Category definitions for the services page.
 *
 * @return array<string, array{name:string, description:string, order:int}>
 */
function toppers_services_categories() {
	return array(
		'masters-phd' => array(
			'name'        => 'الماجستير والدكتوراه',
			'description' => 'من اقتراح العنوان وخطة البحث حتى إعداد الرسالة والدراسات السابقة والنقد العلمي.',
			'order'       => 1,
		),
		'tools-stats' => array(
			'name'        => 'أدوات الدراسة والتحليل الإحصائي',
			'description' => 'تصميم وتحكيم ونشر أدوات الدراسة، مع التحليل الإحصائي وتفسير النتائج.',
			'order'       => 2,
		),
		'publishing'  => array(
			'name'        => 'النشر العلمي وأبحاث الترقية',
			'description' => 'إعداد أبحاث الترقية والأوراق العلمية ومتابعة النشر في المجلات المحكمة.',
			'order'       => 3,
		),
		'proofing'    => array(
			'name'        => 'التدقيق والخدمات المساندة',
			'description' => 'التدقيق اللغوي، إعادة الصياغة، فحص الاقتباس، التنسيق، الترجمة، وتلخيص المراجع.',
			'order'       => 4,
		),
		'university'  => array(
			'name'        => 'المهام والبحوث الجامعية',
			'description' => 'أبحاث التخرج والواجبات والتقارير ودراسات الحالة والعروض التقديمية.',
			'order'       => 5,
		),
		'career'      => array(
			'name'        => 'التطوير والتدريب',
			'description' => 'خدمات مساندة للتطوير المهني والاستشارات البحثية.',
			'order'       => 6,
		),
	);
}

/**
 * Full services list: title, excerpt, category slug, badge, image key, aliases.
 *
 * @return array<int, array{0:string,1:string,2:string,3:string,4:string,5:array<int,string>}>
 */
function toppers_services_catalog() {
	return array(
		// 1 — الماجستير والدكتوراه
		array( 'اقتراح عناوين رسائل الماجستير والدكتوراه', 'صياغة عناوين بحثية دقيقة وقابلة للدراسة وفق تخصصك ومتطلبات جامعتك.', 'masters-phd', '', 'proposal', array( 'اقتراح عناوين رسائل ماجستير ودكتوراه' ) ),
		array( 'إعداد خطة البحث (المقترح البحثي – Proposal)', 'إعداد مقترح بحثي متكامل يحدد المشكلة والأهداف والمنهجية والحدود.', 'masters-phd', 'الأكثر طلباً', 'proposal', array( 'خطة البحث والمقترح', 'خطة البحث (Proposal)', 'اعداد خطة البحث' ) ),
		array( 'إعداد الإطار العام للدراسة', 'بناء الهيكل العام للدراسة وعناصرها الأساسية بشكل منهجي متسق.', 'masters-phd', '', 'research', array( 'اعداد الاطار العام' ) ),
		array( 'إعداد الإطار النظري', 'صياغة إطار نظري رصين يربط مفاهيم الدراسة ونظرياتها بالمشكلة البحثية.', 'masters-phd', '', 'library', array( 'اعداد الاطار النظري' ) ),
		array( 'إعداد الدراسات السابقة', 'جمع وتحليل الدراسات السابقة وربطها بمشكلة البحث والفجوة العلمية.', 'masters-phd', '', 'library', array( 'جمع الدراسات السابقة', 'اعداد الدراسات السابقة' ) ),
		array( 'إعداد رسائل الماجستير', 'مرافقة منهجية متكاملة لرسالة الماجستير من البناء حتى التسليم النهائي.', 'masters-phd', 'حصري', 'masters', array( 'رسائل الماجستير', 'اعداد رسائل الماجستير' ) ),
		array( 'إعداد رسائل الدكتوراه', 'دعم متخصص لأطروحة الدكتوراه بعمق منهجي وتحليلي يناسب متطلبات الدرجة.', 'masters-phd', '', 'phd', array( 'أطروحات الدكتوراه', 'اعداد رسائل الدكتوراه' ) ),
		array( 'نقد الدراسات والأبحاث العلمية', 'مراجعة نقدية منهجية للدراسات والأبحاث مع ملاحظات علمية واضحة.', 'masters-phd', '', 'meeting', array( 'نقد الدراسات العلمية' ) ),

		// 2 — أدوات الدراسة والتحليل
		array( 'تصميم أدوات الدراسة (الاستبيانات، المقابلات، بطاقات الملاحظة)', 'تصميم أدوات جمع البيانات بما يخدم أهداف الدراسة ومتغيراتها.', 'tools-stats', '', 'stats', array( 'تصميم ادوات الدراسة', 'اعداد الاستبيان' ) ),
		array( 'تحكيم أدوات الدراسة', 'تحكيم علمي للاستبيانات والأدوات لضمان الصدق والثبات والملاءمة.', 'tools-stats', '', 'stats', array( 'تحكيم الدراسات والاستبيانات' ) ),
		array( 'نشر الاستبيانات', 'إدارة نشر الاستبيانات ومتابعة الاستجابات وفق خطة جمع البيانات.', 'tools-stats', '', 'meeting', array() ),
		array( 'التحليل الإحصائي وتفسير النتائج', 'تحليل البيانات ببرامج معتمدة مع تفسير علمي واضح للجداول والنتائج.', 'tools-stats', 'الأكثر طلباً', 'stats', array( 'التحليل الإحصائي', 'التحليل الإحصائي ببرنامج SPSS' ) ),

		// 3 — النشر والترقية
		array( 'إعداد أبحاث الترقية العلمية', 'إعداد أبحاث الترقية لأعضاء هيئة التدريس وفق متطلبات اللجان العلمية.', 'publishing', '', 'publish', array( 'اعداد ابحاث الترقية' ) ),
		array( 'إعداد الأوراق العلمية والبحوث للنشر', 'صياغة أوراق علمية جاهزة للتقديم وفق قوالب المجلات وشروطها.', 'publishing', '', 'publish', array( 'اعداد ابحاث النشر' ) ),
		array( 'نشر الأبحاث في المجلات العلمية المحكّمة', 'تجهيز البحث ومتابعة إجراءات النشر في المجلات المحكمة (مثل Scopus وISI).', 'publishing', '', 'publish', array( 'النشر في المجلات المحكمة', 'نشر الابحاث في المجلات العلمية' ) ),

		// 4 — التدقيق والخدمات المساندة
		array( 'التدقيق اللغوي والنحوي', 'مراجعة لغوية ونحوية شاملة تضمن سلاسة النص ورصانته الأكاديمية.', 'proofing', '', 'proof', array( 'التدقيق اللغوي', 'التدقيق اللغوي لرسائل الماجستير والدكتوراه' ) ),
		array( 'إعادة الصياغة العلمية وتقليل الاقتباس', 'إعادة صياغة علمية دقيقة لتقليل نسبة التشابه مع الحفاظ على المعنى.', 'proofing', '', 'proof', array( 'اعادة الصياغة / تقليل نسبة الاقتباس', 'إعادة الصياغة' ) ),
		array( 'فحص السرقة الأدبية ونسبة الاقتباس (Plagiarism)', 'فحص الاقتباس ببرامج معتمدة مع تقرير وتوصيات لتحسين الأصالة.', 'proofing', '', 'similarity', array( 'فحص نسبة الاقتباس', 'فحص السرقة الأدبية plagiarism / فحص نسبة الاقتباس' ) ),
		array( 'تنسيق الرسائل العلمية وفق دليل الجامعة', 'تنسيق كامل للرسالة وفق دليل الجامعة المعتمد (هوامش، مراجع، جداول).', 'proofing', '', 'masters', array( 'تنسيق رسائل الماجستير والدكتوراه' ) ),
		array( 'الترجمة الأكاديمية المعتمدة', 'ترجمة أكاديمية دقيقة من وإلى العربية بمصطلحات علمية منضبطة.', 'proofing', '', 'translate', array( 'الترجمة الأكاديمية', 'الترجمة المعتمدة' ) ),
		array( 'تلخيص الكتب والمراجع العلمية', 'تلخيص منهجي للكتب والمراجع بما يخدم الإطار النظري والدراسات السابقة.', 'proofing', '', 'library', array() ),
		array( 'تنفيذ ملاحظات وتعديلات على بحث جاهز', 'تنفيذ ملاحظات المشرف أو اللجنة على بحث جاهز بدقة وضمن النطاق المتفق عليه.', 'proofing', 'جديد', 'meeting', array() ),

		// 5 — المهام الجامعية
		array( 'إعداد مشروع بحث التخرج', 'إعداد مشروع التخرج من الفكرة حتى التقرير النهائي وفق متطلبات المقرر.', 'university', '', 'meeting', array( 'دعم مشاريع التخرج', 'اعداد بحث التخرج' ) ),
		array( 'إعداد الأبحاث الجامعية', 'إعداد بحوث جامعية بمنهجية علمية تناسب متطلبات كل مقرر.', 'university', '', 'research', array( 'البحوث الجامعية', 'اعداد بحوث جامعية', 'اعداد بحوث ماجستير' ) ),
		array( 'المساندة في الواجبات الجامعية', 'دعم أكاديمي في إنجاز التكاليف والواجبات الجامعية وفق تعليمات المقرر.', 'university', '', 'research', array( 'المساعدة في التكاليف الجامعية' ) ),
		array( 'إعداد التقارير الجامعية', 'صياغة تقارير جامعية منظمة وواضحة وفق النموذج المطلوب.', 'university', '', 'research', array( 'اعداد تقارير جامعية' ) ),
		array( 'إعداد تقرير التدريب الميداني والتعاوني', 'إعداد تقرير التدريب الميداني/التعاوني بشكل احترافي ومتوافق مع دليل الجامعة.', 'university', '', 'meeting', array( 'اعداد تقرير التدريب التعاوني' ) ),
		array( 'إعداد دراسة الحالة (Case Study)', 'إعداد دراسة حالة منهجية تربط التحليل النظري بالواقع التطبيقي.', 'university', '', 'research', array( 'اعداد دراسة حالة' ) ),
		array( 'إعداد العروض التقديمية (PowerPoint)', 'تصميم عروض بوربوينت أكاديمية للمناقشة أو العروض الصفية.', 'university', '', 'laptop', array( 'اعداد عرض بوربوينت' ) ),

		// 6 — التطوير والتدريب
		array( 'كتابة سيرة ذاتية ATS', 'إعداد سيرة ذاتية متوافقة مع أنظمة ATS بصياغة احترافية وواضحة.', 'career', '', 'meeting', array( 'كتابة السيرة الذاتية ATS' ) ),
		array( 'الاستشارات والحلول البحثية', 'استشارات بحثية مباشرة تساعدك على اتخاذ قرارات منهجية صحيحة في كل مرحلة.', 'career', '', 'proposal', array() ),
	);
}

/**
 * Titles to remove from the site.
 *
 * @return array<int, string>
 */
function toppers_services_removed_titles() {
	return array(
		'تحليل محتوى رسائل الماجستير والدكتوراه',
		'كتابة بروبوزال دكتوراه',
		'رومنة المراجع',
	);
}

/**
 * Sync categories + services to the canonical catalog.
 *
 * @return void
 */
function toppers_sync_services_catalog() {
	if ( ! taxonomy_exists( 'service_category' ) || ! post_type_exists( 'toppers_service' ) ) {
		return;
	}

	$cat_ids = array();
	foreach ( toppers_services_categories() as $slug => $cat ) {
		$term = term_exists( $slug, 'service_category' );
		if ( ! $term ) {
			$term = term_exists( $cat['name'], 'service_category' );
		}
		if ( ! $term ) {
			$term = wp_insert_term(
				$cat['name'],
				'service_category',
				array(
					'slug'        => $slug,
					'description' => $cat['description'],
				)
			);
		} elseif ( ! is_wp_error( $term ) ) {
			$tid = (int) ( is_array( $term ) ? $term['term_id'] : $term );
			wp_update_term(
				$tid,
				'service_category',
				array(
					'name'        => $cat['name'],
					'slug'        => $slug,
					'description' => $cat['description'],
				)
			);
			$term = array( 'term_id' => $tid );
		}
		if ( ! is_wp_error( $term ) ) {
			$tid            = (int) ( is_array( $term ) ? $term['term_id'] : $term );
			$cat_ids[ $slug ] = $tid;
			update_term_meta( $tid, '_toppers_order', (int) $cat['order'] );
		}
	}

	$keep_ids = array();
	foreach ( toppers_services_catalog() as $i => $svc ) {
		$title   = $svc[0];
		$excerpt = $svc[1];
		$cat     = $svc[2];
		$badge   = $svc[3];
		$image   = $svc[4];
		$aliases = isset( $svc[5] ) && is_array( $svc[5] ) ? $svc[5] : array();

		$id = toppers_post_exists_title( $title, 'toppers_service' );
		if ( ! $id ) {
			foreach ( $aliases as $alias ) {
				$id = toppers_post_exists_title( $alias, 'toppers_service' );
				if ( $id ) {
					break;
				}
			}
		}

		$postarr = array(
			'post_title'   => $title,
			'post_content' => $excerpt,
			'post_excerpt' => $excerpt,
			'post_status'  => 'publish',
			'post_type'    => 'toppers_service',
			'menu_order'   => $i + 1,
		);

		if ( $id ) {
			$postarr['ID'] = $id;
			wp_update_post( $postarr );
		} else {
			$id = wp_insert_post( $postarr );
		}

		if ( ! $id || is_wp_error( $id ) ) {
			continue;
		}

		$keep_ids[] = (int) $id;
		if ( $badge ) {
			update_post_meta( $id, '_toppers_badge', $badge );
		} else {
			delete_post_meta( $id, '_toppers_badge' );
		}
		if ( $image ) {
			update_post_meta( $id, '_toppers_image', $image . '.jpg' );
		}
		if ( ! empty( $cat_ids[ $cat ] ) ) {
			wp_set_object_terms( $id, array( (int) $cat_ids[ $cat ] ), 'service_category' );
		}
	}

	foreach ( toppers_services_removed_titles() as $gone ) {
		$rid = toppers_post_exists_title( $gone, 'toppers_service' );
		if ( $rid ) {
			wp_trash_post( $rid );
		}
	}

	// Remove empty legacy categories that are no longer in the catalog.
	$legacy = get_terms(
		array(
			'taxonomy'   => 'service_category',
			'hide_empty' => false,
		)
	);
	if ( ! is_wp_error( $legacy ) ) {
		$keep_slugs = array_keys( toppers_services_categories() );
		foreach ( $legacy as $term ) {
			if ( in_array( $term->slug, $keep_slugs, true ) ) {
				continue;
			}
			if ( (int) $term->count > 0 ) {
				continue;
			}
			wp_delete_term( (int) $term->term_id, 'service_category' );
		}
	}

	update_option( 'toppers_services_catalog_ver', TOPPERS_SERVICES_CATALOG_VER );
	flush_rewrite_rules( false );
}

add_action( 'init', 'toppers_maybe_sync_services_catalog', 50 );
/**
 * Run catalog sync once per version.
 */
function toppers_maybe_sync_services_catalog() {
	if ( get_option( 'toppers_services_catalog_ver' ) === TOPPERS_SERVICES_CATALOG_VER ) {
		return;
	}
	toppers_sync_services_catalog();
}
