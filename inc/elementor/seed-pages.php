<?php
/**
 * Seed interior pages with real Elementor TK section widgets (no HTML dump).
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'tk_seed_el_id' ) ) {
	/**
	 * @return string
	 */
	function tk_seed_el_id() {
		return substr( bin2hex( random_bytes( 4 ) ), 0, 7 );
	}
}

if ( ! function_exists( 'tk_seed_widget_container' ) ) {
	/**
	 * @param string $widget_type Widget name.
	 * @param array  $settings    Settings.
	 * @return array
	 */
	function tk_seed_widget_container( $widget_type, $settings = array() ) {
		return array(
			'id'       => tk_seed_el_id(),
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
					'id'         => tk_seed_el_id(),
					'elType'     => 'widget',
					'widgetType' => $widget_type,
					'settings'   => $settings,
					'elements'   => array(),
				),
			),
		);
	}
}

/**
 * Apply Elementor builder meta for a page.
 *
 * @param int   $post_id  Page ID.
 * @param array $elements Elementor elements tree.
 */
function tk_seed_apply_elementor( $post_id, $elements ) {
	update_post_meta( $post_id, '_elementor_edit_mode', 'builder' );
	update_post_meta( $post_id, '_elementor_template_type', 'wp-page' );
	update_post_meta( $post_id, '_elementor_version', defined( 'ELEMENTOR_VERSION' ) ? ELEMENTOR_VERSION : '3.21.0' );
	update_post_meta( $post_id, '_elementor_data', wp_slash( wp_json_encode( $elements ) ) );
	update_post_meta( $post_id, '_elementor_page_settings', array() );
	update_post_meta( $post_id, '_wp_page_template', 'templates/elementor-fullwidth.php' );
	delete_post_meta( $post_id, '_elementor_css' );
	wp_update_post(
		array(
			'ID'           => $post_id,
			'post_content' => '',
		)
	);
}

/**
 * Ensure page exists by slug.
 *
 * @param string $slug  Slug.
 * @param string $title Title.
 * @return int
 */
function tk_seed_ensure_page( $slug, $title ) {
	$page = get_page_by_path( $slug );
	if ( $page ) {
		return (int) $page->ID;
	}
	return (int) wp_insert_post(
		array(
			'post_title'  => $title,
			'post_name'   => $slug,
			'post_status' => 'publish',
			'post_type'   => 'page',
		)
	);
}

/**
 * Seed all interior marketing pages.
 *
 * @return array Map slug => page ID.
 */
function tk_seed_all_pages() {
	$ids = array();

	// ---- About ----
	$about = tk_seed_ensure_page( 'about', 'من نحن' );
	tk_seed_apply_elementor(
		$about,
		array(
			tk_seed_widget_container(
				'tk_page_hero',
				array(
					'variant'       => 'light',
					'eyebrow'       => 'شريكك الأكاديمي الموثوق',
					'title'         => 'منظومتك المتكاملة لخدمات البحث العلمي؛ نُخب متخصصة تقود مشروعك خطوة بخطوة إلى الاعتماد',
					'lede'          => 'نحن منظومة أكاديمية رائدة ومتخصصة في تقديم خدمات البحث العلمي لطلبة الدراسات العليا والباحثين في المملكة العربية السعودية والوطن العربي.',
					'crumb_current' => 'من نحن',
					'bg_image'      => array( 'url' => function_exists( 'tk_default_media_url' ) ? tk_default_media_url( 'about' ) : 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&q=80&w=800&h=900' ),
					'btn1_text'     => 'استكشف خدماتنا',
					'btn1_link'     => array( 'url' => home_url( '/services/' ) ),
					'btn2_text'     => 'تواصل معنا',
					'btn2_link'     => array( 'url' => home_url( '/contact/' ) ),
				)
			),
			tk_seed_widget_container(
				'tk_split_content',
				array(
					'eyebrow'     => 'قصتنا',
					'title'      => 'قصتنا',
					'body'       => '<p>بدأت رحلة شركة توبرز للاستشارات والحلول البحثية عام 2016 من فهم عميق لواقع البيئة الأكاديمية؛ حيث يمتلك الباحثون وطلاب الدراسات العليا أفكارًا علمية نيرة، لكنهم يصطدمون بعقبات التنفيذ المنهجي ودقة التحليل والالتزام الصارم بالأدلة الجامعية.</p><p>واليوم، نفخر بشراكتنا الممتدة مع الباحثين وأعضاء هيئة التدريس في كافة الجامعات السعودية والعربية، والتي أثمرت عن إلمام عميق بكافة ضوابط الرسائل العلمية واشتراطات النشر المحكّم.</p>',
					'side_title' => 'رسالتنا',
					'side_text'  => 'تمكين كل باحث من تقديم عمل أكاديمي يليق بطموحه — بدقة، وشفافية، ودعم مستمر.',
				)
			),
			tk_seed_widget_container(
				'tk_stats_row',
				array(
					'navy'  => 'yes',
					'stats' => array(
						array( 'number' => 8, 'suffix' => '+', 'label' => 'سنوات خبرة' ),
						array( 'number' => 3200, 'suffix' => '+', 'label' => 'عميل تمت خدمتهم' ),
						array( 'number' => 1500, 'suffix' => '+', 'label' => 'بحث ورسالة' ),
						array( 'number' => 95, 'suffix' => '%', 'label' => 'نسبة رضا' ),
					),
				)
			),
			tk_seed_widget_container(
				'tk_icon_cards',
				array(
					'eyebrow' => 'قيمنا',
					'title'   => 'ما نلتزم به في كل طلب',
					'columns' => '4',
					'alt_bg'  => 'yes',
					'cards'   => array(
						array( 'icon' => 'users', 'card_title' => 'فريق متخصص', 'card_text' => 'خبراء لكل مجال أكاديمي.' ),
						array( 'icon' => 'check-circle', 'card_title' => 'دقة علمية', 'card_text' => 'منهجية ومعايير واضحة.' ),
						array( 'icon' => 'clock', 'card_title' => 'مواعيد محترمة', 'card_text' => 'تسليم في الوقت المتفق.' ),
						array( 'icon' => 'shield', 'card_title' => 'سرية تامة', 'card_text' => 'حماية كاملة لملفاتك.' ),
					),
				)
			),
			tk_seed_widget_container(
				'tk_journey',
				array(
					'eyebrow' => 'كيف نعمل',
					'title'   => 'رحلة واضحة من التواصل حتى التسليم',
				)
			),
			tk_seed_widget_container( 'tk_cta', array() ),
		)
	);
	$ids['about'] = $about;

	// ---- Contact ----
	$contact = tk_seed_ensure_page( 'contact', 'تواصل معنا' );
	tk_seed_apply_elementor(
		$contact,
		array(
			tk_seed_widget_container(
				'tk_page_hero',
				array(
					'eyebrow'       => 'تواصل معنا',
					'title'         => 'لنبدأ رحلتك البحثية معًا',
					'lede'          => 'أرسل تفاصيل طلبك وسنعاود التواصل معك خلال ساعات لتزويدك بعرض سعر واضح ومدة تسليم محددة.',
					'crumb_current' => 'تواصل معنا',
				)
			),
			tk_seed_widget_container(
				'tk_contact',
				array(
					'form_title'    => 'أرسل طلبك',
					'info_title'    => 'معلومات التواصل',
					'phone_label'   => 'الهاتف / واتساب',
					'phone'         => '+966 54 909 3465',
					'email_label'   => 'البريد الإلكتروني',
					'email'         => 'info@toppers-edu.com',
					'hours_label'   => 'ساعات العمل',
					'hours'         => 'على مدار الساعة، طوال أيام الأسبوع',
					'whatsapp_text' => 'تواصل عبر واتساب',
					'submit_text'   => 'إرسال الطلب',
				)
			),
			tk_seed_widget_container(
				'tk_faq',
				array(
					'eyebrow'        => 'الأسئلة الشائعة',
					'title'          => 'إجابات عن أكثر الأسئلة تكرارًا',
					'show_category'  => '',
					'narrow'         => 'yes',
					'items'          => array(
						array(
							'question' => 'ما المعلومات التي أحتاج تقديمها؟',
							'answer'   => 'موضوع بحثك، المرحلة الدراسية، الخدمة المطلوبة، وأي ملفات أو تعليمات من جامعتك.',
						),
						array(
							'question' => 'كم تستغرق مدة التنفيذ؟',
							'answer'   => 'تختلف المدة حسب نوع الخدمة وحجم العمل، ونحددها بوضوح عند إرسال عرض السعر.',
						),
						array(
							'question' => 'هل يمكنني طلب تعديلات؟',
							'answer'   => 'نعم، يمكنك طلب مراجعات على العمل المسلَّم وفق سياسة التعديلات المتفق عليها.',
						),
						array(
							'question' => 'ما صيغ الملفات المدعومة؟',
							'answer'   => 'نستقبل ونسلّم بصيغ PDF وWord وExcel وPowerPoint وغيرها حسب طبيعة الخدمة.',
						),
						array(
							'question' => 'كيف يتم تحديد السعر؟',
							'answer'   => 'يعتمد السعر على المرحلة الدراسية وعدد الصفحات وتعقيد البحث والموعد المطلوب.',
						),
						array(
							'question' => 'هل يمكنني طلب تسليم عاجل؟',
							'answer'   => 'نعم، نوفر خيار التسليم العاجل مقابل رسوم إضافية حسب توفر الفريق.',
						),
					),
				)
			),
		)
	);
	$ids['contact'] = $contact;

	// ---- FAQ ----
	$faq = tk_seed_ensure_page( 'faq', 'الأسئلة الشائعة' );
	tk_seed_apply_elementor(
		$faq,
		array(
			tk_seed_widget_container(
				'tk_page_hero',
				array(
					'eyebrow'       => 'دليل الإجابات الشامل',
					'title'         => 'الأسئلة الشائعة لأهم استفسارات الباحثين',
					'lede'          => 'جمعنا لك في هذه الصفحة إجابات شاملة عن أكثر الأسئلة التي يطرحها الباحثون وطلاب الدراسات العليا قبل التعامل مع شركة توبرز، موزّعة على تصنيفات واضحة.',
					'crumb_current' => 'الأسئلة الشائعة',
				)
			),
			tk_seed_widget_container(
				'tk_faq',
				array(
					'eyebrow'       => 'الأسئلة الشائعة',
					'title'         => 'إجابات عن أكثر الأسئلة تكرارًا',
					'show_category' => 'yes',
					'narrow'        => '',
					'items'         => array(
						array( 'category' => 'عن الشركة', 'question' => 'من هي شركة توبرز للاستشارات الأكاديمية؟', 'answer' => 'شركة سعودية متخصصة في الدعم الأكاديمي والاستشارات العلمية لطلاب الدراسات العليا والباحثين، بخبرة تمتد لأكثر من 8 سنوات.' ),
						array( 'category' => 'الخدمات', 'question' => 'ما التخصصات التي تغطونها؟', 'answer' => 'نغطي نطاقاً واسعاً من التخصصات الإنسانية والعلمية والتقنية عبر شبكة باحثين متخصصين.' ),
						array( 'category' => 'الخدمات', 'question' => 'هل تساعدون في خطة البحث فقط؟', 'answer' => 'نعم، يمكنك طلب مرحلة واحدة أو باقة متكاملة حسب احتياجك.' ),
						array( 'category' => 'الجودة', 'question' => 'كيف تضمنون جودة العمل؟', 'answer' => 'مراجعة منهجية ولغوية وفحص تشابه قبل التسليم.' ),
						array( 'category' => 'الجودة', 'question' => 'هل العمل أصلي؟', 'answer' => 'نعم، نلتزم بالأصالة ونوفر تقرير اقتباس عند الطلب.' ),
						array( 'category' => 'التسليم', 'question' => 'ما مدة التنفيذ؟', 'answer' => 'تُحدد المدة حسب حجم الطلب وتعقيده وتُذكر في عرض السعر.' ),
						array( 'category' => 'التسليم', 'question' => 'هل يمكن التعديل بعد التسليم؟', 'answer' => 'نعم ضمن نطاق التعديلات المتفق عليه في الطلب.' ),
						array( 'category' => 'الدفع', 'question' => 'كيف يتم الدفع؟', 'answer' => 'نوضح خيارات الدفع الآمنة عند اعتماد عرض السعر.' ),
						array( 'category' => 'السرية', 'question' => 'من يطلع على ملفي؟', 'answer' => 'فقط الفريق المكلف بتنفيذ طلبك.' ),
					),
				)
			),
			tk_seed_widget_container( 'tk_cta', array() ),
		)
	);
	$ids['faq'] = $faq;

	// ---- Team ----
	$team = tk_seed_ensure_page( 'team', 'فريق العمل' );
	tk_seed_apply_elementor(
		$team,
		array(
			tk_seed_widget_container(
				'tk_page_hero',
				array(
					'eyebrow'       => 'فريق العمل',
					'title'         => 'العقول الأكاديمية والتقنية خلف تميزك',
					'lede'          => 'في «توبرز»، لا نؤمن بالحلول العشوائية أو العمل الفردي. يقف خلف كل رسالة علمية منظومة متكاملة تقودها نخبة من الباحثين والأكاديميين.',
					'crumb_current' => 'فريق العمل',
				)
			),
			tk_seed_widget_container(
				'tk_split_content',
				array(
					'eyebrow'     => 'ضمان الكفاءة',
					'title'      => 'كيف نضمن لك أعلى مستوى من الكفاءة؟',
					'body'       => '<p>لا ينضم أي متخصص إلى فريق «توبرز» بطريقة عشوائية؛ بل نتبع منهجية انتقائية صارمة تضمن أعلى مستويات الرصانة والأمانة العلمية.</p><p>كما يخضع كل مختص لاختبارات تقييم عملي مكثفة وتدريب مستمر على أحدث أدوات التدقيق وفحص أصالة النصوص.</p>',
					'side_title' => 'معيار الاختيار',
					'side_text'  => 'مؤهلات أكاديمية متقدمة، تخصص دقيق، وسجل خبرة بحثية مثبت.',
					'alt_bg'     => 'yes',
				)
			),
			tk_seed_widget_container( 'tk_team_grid', array() ),
			tk_seed_widget_container( 'tk_journey', array() ),
			tk_seed_widget_container( 'tk_cta', array() ),
		)
	);
	$ids['team'] = $team;

	// ---- Testimonials ----
	$testimonials = tk_seed_ensure_page( 'testimonials', 'آراء الطلاب' );
	tk_seed_apply_elementor(
		$testimonials,
		array(
			tk_seed_widget_container(
				'tk_page_hero',
				array(
					'eyebrow'       => 'آراء الطلاب',
					'title'         => 'تجارب حقيقية من باحثين وطلاب',
					'lede'          => 'شهادات ممن وثقوا بنا في محطة مهمة من مسيرتهم.',
					'crumb_current' => 'آراء الطلاب',
				)
			),
			tk_seed_widget_container( 'tk_testimonials', array() ),
			tk_seed_widget_container( 'tk_cta', array() ),
		)
	);
	$ids['testimonials'] = $testimonials;

	// ---- Guarantees ----
	$guarantees = tk_seed_ensure_page( 'guarantees', 'ضماناتنا' );
	tk_seed_apply_elementor(
		$guarantees,
		array(
			tk_seed_widget_container(
				'tk_page_hero',
				array(
					'eyebrow'       => 'الضمانات وحقوق الباحث',
					'title'         => 'حقوقك محفوظة بضمانات حقيقية لا مجرد وعود',
					'lede'          => 'في توبرز، ندرك أن الاستعانة بجهة أكاديمية خطوة مصيرية؛ لذا نسوق حقوقك في حقيبة ضمانات ملزمة ومحددة تمنحك الأمان من اليوم الأول وحتى اعتماد بحثك.',
					'crumb_current' => 'الضمانات',
				)
			),
			tk_seed_widget_container(
				'tk_icon_cards',
				array(
					'eyebrow' => 'نظرة عامة',
					'title'   => 'ستة ضمانات أساسية',
					'columns' => '3',
					'cards'   => array(
						array( 'icon' => 'shield', 'card_title' => 'السرية', 'card_text' => 'ملفاتك محمية بالكامل.' ),
						array( 'icon' => 'check-circle', 'card_title' => 'الأصالة', 'card_text' => 'عمل أصلي مع فحص اقتباس.' ),
						array( 'icon' => 'clock', 'card_title' => 'المواعيد', 'card_text' => 'التزام بموعد التسليم.' ),
						array( 'icon' => 'edit', 'card_title' => 'التعديلات', 'card_text' => 'جولة تعديلات ضمن النطاق.' ),
						array( 'icon' => 'award', 'card_title' => 'الجودة', 'card_text' => 'مراجعة علمية ولغوية.' ),
						array( 'icon' => 'message', 'card_title' => 'التواصل', 'card_text' => 'تحديثات واضحة أثناء التنفيذ.' ),
					),
				)
			),
			tk_seed_widget_container(
				'tk_split_content',
				array(
					'title'      => 'ضمان الجودة الأكاديمية',
					'body'       => '<p>يمر كل عمل بمراجعة منهجية ولغوية قبل التسليم. إن وُجد خلل ضمن نطاق الاتفاق، نعيد المعالجة دون تأخير غير مبرر.</p>',
					'side_title' => 'ماذا يشمل؟',
					'side_text'  => 'مراجعة الهيكل، الاتساق المنهجي، والصياغة الأكاديمية.',
					'alt_bg'     => 'yes',
				)
			),
			tk_seed_widget_container( 'tk_cta', array() ),
		)
	);
	$ids['guarantees'] = $guarantees;

	// ---- Services page (Elementor catalog) — used by archive OR dedicated page ----
	$services = tk_seed_ensure_page( 'services-guide', 'دليل الخدمات' );
	tk_seed_apply_elementor(
		$services,
		array(
			tk_seed_widget_container(
				'tk_page_hero',
				array(
					'eyebrow'       => 'دليل الخدمات الشامل',
					'title'         => 'اكتشف خدمات توبرز الأكاديمية',
					'lede'          => 'نقدم لك مجموعة متكاملة من الخدمات البحثية والأكاديمية المصممة بعناية لتلبية احتياجاتك، من المرحلة الجامعية وحتى نشر الأبحاث في المجلات العالمية.',
					'crumb_current' => 'الخدمات',
					'center'        => 'yes',
				)
			),
			tk_seed_widget_container(
				'tk_services_catalog',
				array(
					'source' => 'cpt',
				)
			),
			tk_seed_widget_container( 'tk_cta', array() ),
		)
	);
	$ids['services-guide'] = $services;

	// ---- Privacy / Terms / AI ----
	$legal = array(
		'privacy'      => array( 'سياسة الخصوصية', 'كيف نحمي بياناتك ونستخدمها بشفافية.' ),
		'terms'        => array( 'الشروط والأحكام', 'الأطر القانونية لاستخدام خدمات توبرز.' ),
		'ai-assistant' => array( 'المساعد الذكي', 'أداة مساعدة لتوجيهك في بداية رحلتك البحثية.' ),
	);

	foreach ( $legal as $slug => $meta ) {
		$pid = tk_seed_ensure_page( $slug, $meta[0] );
		$body = '<p>' . esc_html( $meta[1] ) . '</p><p>يمكنك تعديل هذا المحتوى بالكامل من Elementor عبر ويدجت <strong>TK Rich Section</strong>.</p><h3>بنود أساسية</h3><ul><li>الشفافية في التعامل.</li><li>حماية البيانات الشخصية.</li><li>وضوح نطاق الخدمة والأسعار.</li></ul>';
		tk_seed_apply_elementor(
			$pid,
			array(
				tk_seed_widget_container(
					'tk_page_hero',
					array(
						'eyebrow'       => $meta[0],
						'title'         => $meta[0],
						'lede'          => $meta[1],
						'crumb_current' => $meta[0],
					)
				),
				tk_seed_widget_container(
					'tk_rich_section',
					array(
						'title' => $meta[0],
						'body'  => $body,
					)
				),
			)
		);
		$ids[ $slug ] = $pid;
	}

	if ( class_exists( '\Elementor\Plugin' ) ) {
		\Elementor\Plugin::$instance->files_manager->clear_cache();
	}

	update_option( 'tk_pages_seeded_at', time() );

	if ( class_exists( 'WP_CLI' ) ) {
		WP_CLI::success( 'Interior pages seeded with Elementor TK sections.' );
	}

	return $ids;
}

// Allow direct include/run.
if ( ! defined( 'TK_SEED_PAGES_NO_AUTO' ) ) {
	tk_seed_all_pages();
}
