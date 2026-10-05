<?php
/**
 * Dashboard editor for theme page copy and images.
 *
 * @package Toppers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function toppers_content_schema() {
	return array(
		'home'         => array(
			'label'  => 'الرئيسية',
			'note'   => 'أزرار الكول تو أكشن (Hero CTA)، شرائح الهيرو وأقسام الصفحة الرئيسية.',
			'fields' => array(
				array( 'home_hero_btn1_text', 'زر الهيرو الأول (الذهبي) — النص', 'text', 'اطلب استشارتك الأكاديمية' ),
				array( 'home_hero_btn1_url', 'زر الهيرو الأول (الذهبي) — الرابط', 'text', toppers_page_url( 'contact' ) ),
				array( 'home_hero_btn2_text', 'زر الهيرو الثاني (الواتساب / الخدمات) — النص', 'text', 'تواصل عبر واتساب' ),
				array( 'home_hero_btn2_url', 'زر الهيرو الثاني (الواتساب / الخدمات) — الرابط', 'text', toppers_whatsapp_url() ),
				array( 'home_slide_1_url', 'شريحة 1 — رابط النقر على البانر (اختياري)', 'text', '' ),
				array( 'home_slide_2_url', 'شريحة 2 — رابط النقر على البانر (اختياري)', 'text', '' ),
				array( 'home_slide_3_url', 'شريحة 3 — رابط النقر على البانر (اختياري)', 'text', '' ),
				array( 'home_slide_1_eyebrow', 'شريحة 1 — الشريط العلوي', 'text', 'توبرز للاستشارات والحلول البحثية' ),
				array( 'home_slide_1_title', 'شريحة 1 — العنوان', 'text', 'من فكرة البحث' ),
				array( 'home_slide_1_accent', 'شريحة 1 — الكلمة المميزة', 'text', 'إلى التسليم النهائي' ),
				array( 'home_slide_1_lede', 'شريحة 1 — الوصف', 'textarea', 'نرافق طلاب البكالوريوس والماجستير والدكتوراه والباحثين في كل محطة من رحلتهم الأكاديمية؛ بدقة علمية، ومواعيد تُحترم.' ),
				array( 'img_hero-1', 'شريحة 1 — الصورة', 'image' ),
				array( 'home_slide_2_eyebrow', 'شريحة 2 — الشريط العلوي', 'text', 'أعلى معايير الجودة' ),
				array( 'home_slide_2_title', 'شريحة 2 — العنوان', 'text', 'رسائل الماجستير' ),
				array( 'home_slide_2_accent', 'شريحة 2 — الكلمة المميزة', 'text', 'بمنهجية دقيقة' ),
				array( 'home_slide_2_lede', 'شريحة 2 — الوصف', 'textarea', 'دعم شامل للباحثين من اقتراح العنوان وحتى المناقشة، مع ضمان الجودة والسرية التامة لجميع البيانات.' ),
				array( 'img_hero-2', 'شريحة 2 — الصورة', 'image' ),
				array( 'home_slide_3_eyebrow', 'شريحة 3 — الشريط العلوي', 'text', 'دعم إحصائي ولغوي' ),
				array( 'home_slide_3_title', 'شريحة 3 — العنوان', 'text', 'التحليل الإحصائي' ),
				array( 'home_slide_3_accent', 'شريحة 3 — الكلمة المميزة', 'text', 'والترجمة الاحترافية' ),
				array( 'home_slide_3_lede', 'شريحة 3 — الوصف', 'textarea', 'نستخدم أحدث البرامج الإحصائية لتحليل بيانات بحثك، ونقدم ترجمة أكاديمية معتمدة تدعم وصول بحثك للعالمية.' ),
				array( 'img_hero-3', 'شريحة 3 — الصورة', 'image' ),
				array( 'home_about_eyebrow', 'من نحن (الرئيسية) — الشريط', 'text', 'من نحن' ),
				array( 'home_about_title', 'من نحن (الرئيسية) — العنوان', 'text', 'منظومتك المتكاملة لخدمات البحث العلمي' ),
				array( 'home_about_text', 'من نحن (الرئيسية) — النص التعريفي', 'textarea', 'نحن منظومة أكاديمية رائدة ومتخصصة في تقديم خدمات البحث العلمي لطلبة الدراسات العليا والباحثين في المملكة العربية السعودية والوطن العربي. نُسخّر نخبة من الكفاءات الأكاديمية لتذليل عقبات البحث العلمي، وصياغة نتاج معرفي أصيل يلتزم بأعلى معايير النزاهة والضوابط الجامعية؛ لنكون سندك الموثوق في كل مرحلة من رحلتك الأكاديمية، ونرتقي معًا نحو قمة البحث العلمي.' ),
				array( 'home_video_title', 'فيديو توبرز — العنوان', 'text', 'الفيديو التعريفي لمنصة توبرز | نحو قمة البحث العلمي' ),
				array( 'home_video_desc', 'فيديو توبرز — الوصف المختصر', 'text', 'تعرف على خدماتنا الأكاديمية المتكاملة وكيف نرافقك خطوة بخطوة لتحقيق التميز البحثي والاعتماد الأكاديمي.' ),
				array( 'home_video_embed_url', 'فيديو توبرز — رابط الفيديو على يوتيوب', 'text', 'https://youtu.be/dujo3xmx0ME' ),
				array( 'home_journey_eyebrow', 'رحلة الطلب — الشريط', 'text', 'كيف نعمل' ),
				array( 'home_journey_title', 'رحلة الطلب — العنوان', 'text', 'رحلة طلب واضحة من أول تواصل حتى التسليم' ),
				array( 'home_services_eyebrow', 'الخدمات — الشريط', 'text', 'خدماتنا' ),
				array( 'home_services_title', 'الخدمات — العنوان', 'text', 'كل ما تحتاجه رحلتك البحثية في مكان واحد' ),
				array( 'home_services_lede', 'الخدمات — الوصف', 'textarea', 'من اختيار العنوان إلى النشر العلمي — نغطي المراحل الأكاديمية كافة بفريق متخصص لكل مجال.' ),
				array( 'home_why_eyebrow', 'لماذا توبرز — الشريط', 'text', 'لماذا توبرز' ),
				array( 'home_why_title', 'لماذا توبرز — العنوان', 'text', 'شريكك الأكاديمي من الفكرة حتى النشر' ),
				array( 'home_why_lede', 'لماذا توبرز — الوصف', 'textarea', 'نقدم لك دعماً بحثياً متكاملاً بمعايير عالمية لضمان نجاحك الأكاديمي بكل احترافية وسرية تامة، لنكون شركاء في رحلتك نحو التميز.' ),
				array( 'home_stat_1_num', 'إحصائية 1 — الرقم', 'text', '10' ),
				array( 'home_stat_1_suffix', 'إحصائية 1 — اللاحقة', 'text', '+' ),
				array( 'home_stat_1_label', 'إحصائية 1 — النص', 'text', 'سنوات خبرة مؤسسية' ),
				array( 'home_stat_2_num', 'إحصائية 2 — الرقم', 'text', '500' ),
				array( 'home_stat_2_suffix', 'إحصائية 2 — اللاحقة', 'text', '+' ),
				array( 'home_stat_2_label', 'إحصائية 2 — النص', 'text', 'مختص أكاديمي' ),
				array( 'home_stat_3_num', 'إحصائية 3 — الرقم', 'text', '10000' ),
				array( 'home_stat_3_suffix', 'إحصائية 3 — اللاحقة', 'text', '+' ),
				array( 'home_stat_3_label', 'إحصائية 3 — النص', 'text', 'مشروع وبحث أكاديمي' ),
				array( 'home_stat_4_num', 'إحصائية 4 — الرقم', 'text', '98.5' ),
				array( 'home_stat_4_suffix', 'إحصائية 4 — اللاحقة', 'text', '%' ),
				array( 'home_stat_4_label', 'إحصائية 4 — النص', 'text', 'معدل رضا العملاء' ),
				array( 'home_testimonials_eyebrow', 'آراء العملاء — الشريط', 'text', 'آراء عملائنا' ),
				array( 'home_testimonials_title', 'آراء العملاء — العنوان', 'text', 'طلاب وباحثون وثقوا بنا في محطة مهمة من مسيرتهم' ),
				array( 'home_testimonials_lede', 'آراء العملاء — الوصف', 'textarea', 'نفخر بكوننا جزءاً من نجاح آلاف الطلاب والباحثين، اقرأ واستمع وشاهد بعضاً من تجاربهم في التعامل معنا.' ),
				array( 'home_blog_eyebrow', 'المقالات — الشريط', 'text', 'أحدث المقالات' ),
				array( 'home_blog_title', 'المقالات — العنوان', 'text', 'المدونة' ),
				array( 'home_blog_lede', 'المقالات — الوصف', 'textarea', 'نشاركك أفضل الممارسات والنصائح لإعداد الأبحاث والرسائل العلمية بمنهجية صحيحة.' ),
				array( 'home_cta_title', 'شريط الدعوة — العنوان', 'text', 'جاهز لبدء رحلتك البحثية؟' ),
				array( 'home_cta_lede', 'شريط الدعوة — الوصف', 'textarea', 'أرسل تفاصيل مشروعك الآن واحصل على استشارة أولية وعرض سعر مجاني خلال ساعات.' ),
			),
		),
		'about'        => array(
			'label'  => 'من نحن',
			'note'   => 'نصوص وصور صفحة من نحن.',
			'fields' => array(
				array( 'about_eyebrow', 'الشريط العلوي', 'text', 'شريكك الأكاديمي الموثوق' ),
				array( 'about_title', 'عنوان الهيرو', 'text', 'منظومتك المتكاملة لخدمات البحث العلمي؛ نُخب متخصصة تقود مشروعك خطوة بخطوة إلى الاعتماد' ),
				array( 'about_lede', 'وصف الهيرو', 'textarea', 'نحن منظومة أكاديمية رائدة ومتخصصة في تقديم خدمات البحث العلمي لطلبة الدراسات العليا والباحثين في المملكة العربية السعودية والوطن العربي.' ),
				array( 'about_image', 'صورة الهيرو', 'image' ),
				array( 'img_about-hero', 'صورة القصة', 'image' ),
				array( 'about_story_title', 'عنوان القصة', 'text', 'قصتنا' ),
				array( 'about_story_p1', 'الفقرة الأولى', 'textarea', '' ),
				array( 'about_story_p2', 'الفقرة الثانية', 'textarea', '' ),
				array( 'about_founder_title', 'عنوان كلمة المؤسس', 'text', 'كلمة المؤسس' ),
				array( 'about_founder_text', 'نص كلمة المؤسس', 'textarea', '' ),
				array( 'about_founder_sign', 'توقيع المؤسس', 'text', '' ),
				array( 'about_process_eyebrow', 'منهجية العمل — الشريط', 'text', 'منهجية العمل' ),
				array( 'about_process_title', 'منهجية العمل — العنوان', 'text', 'كيف نُدير مشروعك الأكاديمي؟' ),
				array( 'about_process_lede', 'منهجية العمل — العنوان الفرعي / الوصف', 'textarea', 'نتبع في "توبرز" منظومة عمل متسلسلة تبدأ من فهم متطلباتك، مرورًا بالبناء المنهجي والتدقيق، وصولًا إلى فحص الأصالة وتسليمك تقارير Turnitin المعتمدة، مع استمرار الدعم حتى اعتماد بحثك بالكامل.' ),
			),
		),
		'services'     => array(
			'label'  => 'الخدمات',
			'note'   => 'هيرو صفحة الخدمات. عناصر الخدمات نفسها من قائمة «الخدمات» في ووردبريس.',
			'cpt'    => array( 'edit.php?post_type=toppers_service', 'إدارة عناصر الخدمات' ),
			'fields' => array(
				array( 'services_eyebrow', 'الشريط العلوي', 'text', 'دليل الخدمات الشامل' ),
				array( 'services_title', 'العنوان', 'text', 'حلول أكاديمية متكاملة تُساند رحلتك البحثية من الفكرة وحتى المناقشة.' ),
				array( 'services_lede', 'الوصف', 'textarea', 'نضع بين يديك أكثر من 20 خدمة بحثية وإحصائية مُتخصصة، تُنفَّذ بأيدي نخبة من حملة الدكتوراه والخبراء، وفق معايير الرصانة العلمية ودليل جامعتك المعتمد.' ),
				array( 'services_image', 'صورة الهيرو', 'image' ),
				array( 'img_campus', 'صورة الهيرو البديلة (campus)', 'image' ),
				array( 'img_research', 'صورة خدمة البحوث', 'image' ),
				array( 'img_masters', 'صورة خدمة الماجستير', 'image' ),
				array( 'img_phd', 'صورة خدمة الدكتوراه', 'image' ),
				array( 'img_stats', 'صورة التحليل الإحصائي', 'image' ),
				array( 'img_proposal', 'صورة خطة البحث', 'image' ),
				array( 'img_translate', 'صورة الترجمة', 'image' ),
				array( 'img_proof', 'صورة التدقيق اللغوي', 'image' ),
				array( 'img_similarity', 'صورة فحص الاقتباس', 'image' ),
			),
		),
		'team'         => array(
			'label'  => 'فريق العمل',
			'note'   => 'نصوص صفحة الفريق. الأعضاء من قائمة «فريق العمل».',
			'cpt'    => array( 'edit.php?post_type=toppers_team', 'إدارة أعضاء الفريق' ),
			'fields' => array(
				array( 'team_eyebrow', 'الشريط العلوي', 'text', 'فريق العمل' ),
				array( 'team_title', 'العنوان', 'text', 'العقول الأكاديمية والتقنية خلف تميزك' ),
				array( 'team_lede', 'الوصف', 'textarea', 'في «توبرز»، لا نؤمن بالحلول العشوائية أو العمل الفردي. يقف خلف كل رسالة علمية وبحث مُحكّم منظومة متكاملة تقودها نخبة من الباحثين والأكاديميين.' ),
				array( 'team_image', 'صورة الهيرو', 'image' ),
				array( 'team_how_eyebrow', 'ضمان الكفاءة — الشريط', 'text', 'ضمان الكفاءة' ),
				array( 'team_how_title', 'ضمان الكفاءة — العنوان', 'text', 'كيف نضمن لك أعلى مستوى من الكفاءة؟' ),
				array( 'team_how_p1', 'ضمان الكفاءة — فقرة 1', 'textarea', 'لا ينضم أي متخصص إلى فريق «توبرز» بطريقة عشوائية؛ بل نتبع منهجية انتقائية صارمة تضمن أعلى مستويات الرصانة والأمانة العلمية.' ),
				array( 'team_how_p2', 'ضمان الكفاءة — فقرة 2', 'textarea', 'كما يخضع كل مختص لاختبارات تقييم عملي مكثفة وتدريب مستمر على أحدث أدوات التدقيق وفحص أصالة النصوص.' ),
				array( 'team_roster_eyebrow', 'هيكل الفريق — الشريط', 'text', 'هيكل الفريق الأكاديمي' ),
				array( 'team_roster_title', 'هيكل الفريق — العنوان', 'text', 'نخبة العقول الأكاديمية والخبرات البحثية' ),
				array( 'team_roster_lede', 'هيكل الفريق — الوصف', 'textarea', 'فريق متكامل من المختصين داخل وخارج المملكة يقود رحلتك العلمية نحو التميز بالمعرفة والدقة المنهجية' ),
				array( 'team_step_1_title', 'المرحلة 1 — العنوان', 'text', 'التوجيه العلمي والمنهجي' ),
				array( 'team_step_1_desc', 'المرحلة 1 — الوصف', 'textarea', 'يتولى الباحث المختص في المجال الأكاديمي الدقيق وضع الإطار العلمي والإشراف على المضمون ورسم ملامح الفصول.' ),
				array( 'team_step_2_title', 'المرحلة 2 — العنوان', 'text', 'المعالجة والتحليل الإحصائي' ),
				array( 'team_step_2_desc', 'المرحلة 2 — الوصف', 'textarea', 'ينقل الملف إلى خبراء الإحصاء والبيانات لمعالجة الأرقام وبناء العلاقات الإحصائية واختبار الفرضيات بأعلى درجات الدقة.' ),
				array( 'team_step_3_title', 'المرحلة 3 — العنوان', 'text', 'التدقيق والضبط اللغوي' ),
				array( 'team_step_3_desc', 'المرحلة 3 — الوصف', 'textarea', 'يخضع العمل لمراجعة شاملة من حُرّاس اللغة والضبط الأكاديمي لضمان الرصانة والسلامة اللغوية والخلو من الانتحال العلمي.' ),
				array( 'team_step_4_title', 'المرحلة 4 — العنوان', 'text', 'الفلترة والجودة النهائية' ),
				array( 'team_step_4_desc', 'المرحلة 4 — الوصف', 'textarea', 'تتولى إدارة الجودة المطابقة النهائية للمواصفات والشروط الأكاديمية ودليل الجامعة المعتمد قبل تسليم الباحث.' ),
			),
		),
		'testimonials' => array(
			'label'  => 'آراء الطلاب',
			'note'   => 'هيرو الصفحة وعناوين ووصف كل تصنيف من تصنيفات الآراء (صوتيات، فيديوهات، سكرين شوت، آراء نصية). الآراء نفسها تُدار من قائمة «آراء الطلاب».',
			'cpt'    => array( 'edit.php?post_type=toppers_testimonial', 'إدارة الآراء والوسائط' ),
			'fields' => array(
				array( 'testimonials_eyebrow', 'الهيرو — الشريط العلوي', 'text', 'آراء عملائنا' ),
				array( 'testimonials_title', 'الهيرو — العنوان', 'text', 'طلاب وباحثون وثقوا بنا في محطة مهمة من مسيرتهم' ),
				array( 'testimonials_lede', 'الهيرو — الوصف', 'textarea', 'نفخر بكوننا جزءاً من نجاح آلاف الطلاب والباحثين، اقرأ واستمع وشاهد بعضاً من تجاربهم في التعامل معنا.' ),
				array( 'testimonials_image', 'الهيرو — الصورة', 'image' ),
				array( 'testimonials_voice_eyebrow', 'قسم الصوتيات — الشريط العلوي', 'text', 'شهادات صوتية حية' ),
				array( 'testimonials_voice_title', 'قسم الصوتيات — العنوان', 'text', 'رسائل صوتية وتجارب مسجلة' ),
				array( 'testimonials_voice_desc', 'قسم الصوتيات — الوصف المختصر', 'textarea', 'استمع لتجارب حقيقية يرويها طلاب الماجستير والدكتوراه عن رحلتهم البحثية ونتائجهم مع توبرز.' ),
				array( 'testimonials_video_eyebrow', 'قسم الفيديوهات — الشريط العلوي', 'text', 'تجارب مرئية' ),
				array( 'testimonials_video_title', 'قسم الفيديوهات — العنوان', 'text', 'تجارب حية ومصورة بالفيديو' ),
				array( 'testimonials_video_desc', 'قسم الفيديوهات — الوصف المختصر', 'textarea', 'مشاهدات وتقييمات موثقة بالفيديو تعكس دقة العمل والاحترافية الأكاديمية لفريقنا.' ),
				array( 'testimonials_image_eyebrow', 'قسم السكرين شوت — الشريط العلوي', 'text', 'محادثات موثقة وتقارير معتمدة' ),
				array( 'testimonials_image_title', 'قسم السكرين شوت — العنوان', 'text', 'سكرين شوت محادثات القبول وتقارير الاقتباس' ),
				array( 'testimonials_image_desc', 'قسم السكرين شوت — الوصف المختصر', 'textarea', 'لقطات شاشة موثقة لآراء الطلاب وفحص نسبة الاقتباس ورسائل القبول الأكاديمي والنشر الدولي.' ),
				array( 'testimonials_text_eyebrow', 'قسم الآراء النصية — الشريط العلوي', 'text', 'تقييمات أكاديمية مكتوبة' ),
				array( 'testimonials_text_title', 'قسم الآراء النصية — العنوان', 'text', 'آراء وتوصيات أكاديمية مكتوبة' ),
				array( 'testimonials_text_desc', 'قسم الآراء النصية — الوصف المختصر', 'textarea', 'انطباعات ورسائل شكر مكتوبة يشاركنا بها طلابنا بعد اعتماد أبحاثهم ورسائلهم بنجاح.' ),
			),
		),
		'contact'      => array(
			'label'  => 'تواصل معنا',
			'note'   => 'هيرو صفحة التواصل. رقم الواتساب والبريد من المظهر ← تخصيص ← تواصل.',
			'fields' => array(
				array( 'contact_eyebrow', 'الشريط العلوي', 'text', 'تواصل معنا' ),
				array( 'contact_title', 'العنوان', 'text', 'لنبدأ رحلتك البحثية معًا' ),
				array( 'contact_lede', 'الوصف', 'textarea', 'أرسل تفاصيل طلبك وسنعاود التواصل معك خلال ساعات لتزويدك بعرض سعر واضح ومدة تسليم محددة.' ),
				array( 'contact_image', 'صورة الهيرو', 'image' ),
			),
		),
		'faq'          => array(
			'label'  => 'الأسئلة الشائعة',
			'note'   => 'هيرو الصفحة. الأسئلة من قائمة «الأسئلة الشائعة».',
			'cpt'    => array( 'edit.php?post_type=toppers_faq', 'إدارة الأسئلة' ),
			'fields' => array(
				array( 'faq_eyebrow', 'الشريط العلوي', 'text', 'دليل الإجابات الشامل' ),
				array( 'faq_title', 'العنوان', 'text', 'الأسئلة الشائعة لأهم استفسارات الباحثين' ),
				array( 'faq_lede', 'الوصف', 'textarea', 'جمعنا لك إجابات شاملة عن أكثر الأسئلة التي يطرحها الباحثون وطلاب الدراسات العليا قبل التعامل مع توبرز.' ),
				array( 'faq_image', 'صورة الهيرو', 'image' ),
			),
		),
		'guarantees'   => array(
			'label'  => 'الضمانات',
			'note'   => 'هيرو صفحة الضمانات.',
			'fields' => array(
				array( 'guarantees_eyebrow', 'الشريط العلوي', 'text', 'الضمانات وحقوق الباحث' ),
				array( 'guarantees_title', 'العنوان', 'text', 'حقوقك محفوظة بضمانات حقيقية لا مجرد وعود' ),
				array( 'guarantees_lede', 'الوصف', 'textarea', 'في توبرز، ندرك أن الاستعانة بجهة أكاديمية هي خطوة مصيرية في رحلتك العلمية؛ لذا لا نكتفي بالوعود الشفهية، بل نسوغ حقوقك في حقيبة ضمانات ملزمة.' ),
				array( 'guarantees_image', 'صورة الهيرو', 'image' ),
			),
		),
		'ai'           => array(
			'label'  => 'المساعد البحثي',
			'note'   => 'هيرو صفحة المساعد البحثي.',
			'fields' => array(
				array( 'ai_eyebrow', 'الشريط العلوي', 'text', '' ),
				array( 'ai_title', 'العنوان', 'text', 'المساعد البحثي الذكي' ),
				array( 'ai_lede', 'الوصف', 'textarea', 'دع الذكاء الاصطناعي الخاص بنا يقترح لك أفضل الأفكار البحثية التي تتناسب مع تخصصك واهتماماتك الأكاديمية بدقة عالية.' ),
				array( 'ai_image', 'صورة الهيرو', 'image' ),
			),
		),
		'blog'         => array(
			'label'  => 'المقالات',
			'note'   => 'هيرو صفحة المقالات. المقالات نفسها من قائمة «المقالات».',
			'cpt'    => array( 'edit.php', 'إدارة المقالات' ),
			'fields' => array(
				array( 'blog_eyebrow', 'الشريط العلوي', 'text', 'المقالات' ),
				array( 'blog_title', 'العنوان', 'text', 'مدونة توبرز الأكاديمية' ),
				array( 'blog_lede', 'الوصف', 'textarea', 'نشاركك أفضل الممارسات والنصائح لإعداد الأبحاث والرسائل العلمية.' ),
				array( 'blog_image', 'صورة الهيرو', 'image' ),
			),
		),
		'legal'        => array(
			'label'  => 'الخصوصية والشروط',
			'note'   => 'هيرو صفحتي الخصوصية وشروط الاستخدام.',
			'fields' => array(
				array( 'privacy_eyebrow', 'الخصوصية — الشريط', 'text', 'سياسة الخصوصية وسرية المعلومات' ),
				array( 'privacy_title', 'الخصوصية — العنوان', 'text', 'خصوصيتك وأمان بياناتك في صدارة أولوياتنا' ),
				array( 'privacy_lede', 'الخصوصية — الوصف', 'textarea', 'في توبرز، نضع سرية معلوماتك وأمان أبحاثك في مقدمة أولوياتنا، ونوضح في هذه السياسة كيفية جمع المعلومات وحمايتها والتعامل معها.' ),
				array( 'privacy_image', 'الخصوصية — صورة الهيرو', 'image' ),
				array( 'terms_eyebrow', 'الشروط — الشريط', 'text', 'شروط الاستخدام والأحكام العامة' ),
				array( 'terms_title', 'الشروط — العنوان', 'text', 'شروط الاستخدام والأحكام التنظيمية' ),
				array( 'terms_lede', 'الشروط — الوصف', 'textarea', 'تسري هذه الشروط على جميع زوار الموقع والعملاء والمستفيدين من خدمات توبرز. يُعد استخدامك للموقع موافقة صريحة على هذه الشروط، بالإضافة إلى سياسة الخصوصية.' ),
				array( 'terms_image', 'الشروط — صورة الهيرو', 'image' ),
			),
		),
	);
}

add_action( 'admin_menu', 'toppers_content_menu' );
function toppers_content_menu() {
	add_menu_page(
		'محتوى الصفحات',
		'محتوى الصفحات',
		'edit_theme_options',
		'toppers-content',
		'toppers_content_render',
		'dashicons-edit-page',
		58
	);

	add_submenu_page(
		'toppers-content',
		'المساعد البحثي الذكي',
		'المساعد البحثي الذكي',
		'edit_theme_options',
		'toppers-ai-settings',
		'toppers_ai_settings_render'
	);
}

add_action( 'admin_init', 'toppers_content_save' );
function toppers_content_save() {
	if ( empty( $_POST['toppers_content_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['toppers_content_nonce'] ) ), 'toppers_save_content' ) ) {
		return;
	}
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}

	$schema = toppers_content_schema();
	$tab    = isset( $_POST['toppers_content_tab'] ) ? sanitize_key( wp_unslash( $_POST['toppers_content_tab'] ) ) : '';
	if ( ! isset( $schema[ $tab ] ) ) {
		return;
	}

	$saved  = get_option( 'toppers_page_content', array() );
	$posted = isset( $_POST['toppers_c'] ) && is_array( $_POST['toppers_c'] ) ? wp_unslash( $_POST['toppers_c'] ) : array();

	foreach ( $schema[ $tab ]['fields'] as $field ) {
		$key  = $field[0];
		$type = $field[2];
		$raw  = isset( $posted[ $key ] ) ? $posted[ $key ] : '';
		if ( 'image' === $type ) {
			$saved[ $key ] = absint( $raw );
		} elseif ( 'textarea' === $type ) {
			$saved[ $key ] = wp_kses_post( $raw );
		} else {
			$saved[ $key ] = sanitize_text_field( $raw );
		}
	}

	update_option( 'toppers_page_content', $saved, false );
	add_settings_error( 'toppers_content', 'saved', 'تم حفظ المحتوى.', 'updated' );
}

add_action( 'admin_enqueue_scripts', 'toppers_content_assets' );
function toppers_content_assets( $hook ) {
	if ( 'toplevel_page_toppers-content' !== $hook ) {
		return;
	}
	wp_enqueue_media();
	wp_enqueue_script( 'jquery' );
}

function toppers_content_render() {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}
	$schema = toppers_content_schema();
	$tab    = isset( $_GET['tab'] ) ? sanitize_key( wp_unslash( $_GET['tab'] ) ) : 'home';
	if ( ! isset( $schema[ $tab ] ) ) {
		$tab = 'home';
	}
	settings_errors( 'toppers_content' );
	?>
	<div class="wrap toppers-content-wrap" dir="rtl">
		<h1>محتوى الصفحات</h1>
		<p class="description">عدّل النصوص والصور لكل صفحة. اترك الحقل فارغًا للإبقاء على النص الافتراضي.</p>
		<h2 class="nav-tab-wrapper">
			<?php foreach ( $schema as $slug => $page ) : ?>
				<a class="nav-tab<?php echo $slug === $tab ? ' nav-tab-active' : ''; ?>" href="<?php echo esc_url( admin_url( 'admin.php?page=toppers-content&tab=' . $slug ) ); ?>"><?php echo esc_html( $page['label'] ); ?></a>
			<?php endforeach; ?>
		</h2>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin.php?page=toppers-content&tab=' . $tab ) ); ?>">
			<?php wp_nonce_field( 'toppers_save_content', 'toppers_content_nonce' ); ?>
			<input type="hidden" name="toppers_content_tab" value="<?php echo esc_attr( $tab ); ?>">
			<div class="toppers-content-card">
				<?php if ( ! empty( $schema[ $tab ]['note'] ) ) : ?>
					<p class="description"><?php echo esc_html( $schema[ $tab ]['note'] ); ?></p>
				<?php endif; ?>
				<?php if ( ! empty( $schema[ $tab ]['cpt'] ) ) : ?>
					<p><a class="button" href="<?php echo esc_url( admin_url( $schema[ $tab ]['cpt'][0] ) ); ?>"><?php echo esc_html( $schema[ $tab ]['cpt'][1] ); ?></a></p>
				<?php endif; ?>
				<table class="form-table" role="presentation">
					<?php foreach ( $schema[ $tab ]['fields'] as $field ) : ?>
						<?php toppers_content_field_row( $field ); ?>
					<?php endforeach; ?>
				</table>
			</div>
			<?php submit_button( 'حفظ هذه الصفحة' ); ?>
		</form>
	</div>
	<style>
		.toppers-content-wrap .toppers-content-card{background:#fff;border:1px solid #dcdcde;border-radius:8px;padding:8px 24px 24px;margin-top:16px;max-width:920px}
		.toppers-content-wrap .nav-tab-wrapper{border-bottom:1px solid #c3c4c7}
		.toppers-img-field{display:flex;align-items:center;gap:12px;flex-wrap:wrap}
		.toppers-img-field img{width:120px;height:80px;object-fit:cover;border-radius:6px;background:#f0f0f1;border:1px solid #dcdcde}
		.toppers-img-field img.is-empty{display:none}
	</style>
	<script>
	jQuery(function($){
		$(document).on('click', '.toppers-pick-img', function(e){
			e.preventDefault();
			var $wrap = $(this).closest('.toppers-img-field');
			var frame = wp.media({ title: 'اختر صورة', library: { type: 'image' }, multiple: false, button: { text: 'استخدام الصورة' } });
			frame.on('select', function(){
				var att = frame.state().get('selection').first().toJSON();
				var src = (att.sizes && att.sizes.medium) ? att.sizes.medium.url : att.url;
				$wrap.find('input[type="hidden"]').val(att.id);
				$wrap.find('img').attr('src', src).removeClass('is-empty').show();
			});
			frame.open();
		});
		$(document).on('click', '.toppers-clear-img', function(e){
			e.preventDefault();
			var $wrap = $(this).closest('.toppers-img-field');
			$wrap.find('input[type="hidden"]').val('0');
			$wrap.find('img').attr('src', '').addClass('is-empty').hide();
		});
	});
	</script>
	<?php
}

function toppers_content_field_row( $field ) {
	$key     = $field[0];
	$label   = $field[1];
	$type    = $field[2];
	$default = isset( $field[3] ) ? $field[3] : '';
	$value   = toppers_content( $key, '' );
	echo '<tr><th scope="row"><label for="toppers_c_' . esc_attr( $key ) . '">' . esc_html( $label ) . '</label></th><td>';
	if ( 'textarea' === $type ) {
		echo '<textarea class="large-text" rows="4" id="toppers_c_' . esc_attr( $key ) . '" name="toppers_c[' . esc_attr( $key ) . ']" placeholder="' . esc_attr( $default ) . '">' . esc_textarea( $value ) . '</textarea>';
	} elseif ( 'image' === $type ) {
		$id  = (int) $value;
		$url = $id ? wp_get_attachment_image_url( $id, 'medium' ) : '';
		echo '<div class="toppers-img-field">';
		echo '<img src="' . esc_url( $url ) . '" alt="" class="' . ( $url ? '' : 'is-empty' ) . '">';
		echo '<input type="hidden" name="toppers_c[' . esc_attr( $key ) . ']" value="' . esc_attr( (string) $id ) . '">';
		echo '<button type="button" class="button toppers-pick-img">اختيار صورة</button>';
		echo '<button type="button" class="button-link toppers-clear-img">إزالة</button>';
		echo '</div>';
	} else {
		echo '<input class="regular-text" type="text" id="toppers_c_' . esc_attr( $key ) . '" name="toppers_c[' . esc_attr( $key ) . ']" value="' . esc_attr( $value ) . '" placeholder="' . esc_attr( $default ) . '">';
	}
	echo '</td></tr>';
}

/**
 * Handle saving AI Assistant Settings.
 */
add_action( 'admin_init', 'toppers_ai_settings_save' );
function toppers_ai_settings_save() {
	if ( empty( $_POST['toppers_ai_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['toppers_ai_nonce'] ) ), 'toppers_save_ai' ) ) {
		return;
	}
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}

	if ( isset( $_POST['toppers_ai_reset'] ) ) {
		delete_option( 'toppers_ai_settings' );
		wp_safe_redirect( add_query_arg( array( 'page' => 'toppers-ai-settings', 'updated' => 'reset' ), admin_url( 'admin.php' ) ) );
		exit;
	}

	$settings = toppers_get_ai_settings();

	// Quick chips
	if ( isset( $_POST['toppers_quick_chips'] ) ) {
		$raw_chips = sanitize_textarea_field( wp_unslash( $_POST['toppers_quick_chips'] ) );
		$chips_lines = preg_split( '/[\r\n,]+/', $raw_chips );
		$cleaned_chips = array();
		foreach ( $chips_lines as $c ) {
			$c = trim( $c );
			if ( ! empty( $c ) && ! in_array( $c, $cleaned_chips, true ) ) {
				$cleaned_chips[] = $c;
			}
		}
		if ( ! empty( $cleaned_chips ) ) {
			$settings['quick_chips'] = $cleaned_chips;
		}
	}

	// Title templates
	if ( isset( $_POST['toppers_templates'] ) && is_array( $_POST['toppers_templates'] ) ) {
		$new_templates = array();
		foreach ( $_POST['toppers_templates'] as $tpl ) {
			$pattern     = isset( $tpl['pattern'] ) ? sanitize_text_field( wp_unslash( $tpl['pattern'] ) ) : '';
			$desc        = isset( $tpl['desc'] ) ? sanitize_textarea_field( wp_unslash( $tpl['desc'] ) ) : '';
			$methodology = isset( $tpl['methodology'] ) ? sanitize_text_field( wp_unslash( $tpl['methodology'] ) ) : '';
			$impact      = isset( $tpl['impact'] ) ? sanitize_text_field( wp_unslash( $tpl['impact'] ) ) : '';

			if ( ! empty( $pattern ) ) {
				$new_templates[] = array(
					'pattern'     => $pattern,
					'desc'        => $desc,
					'methodology' => $methodology ?: 'منهج وصفي تحليلي',
					'impact'      => $impact ?: 'إثراء التخصص العلمي وتقديم نموذج قابل للتطبيق',
				);
			}
		}
		if ( ! empty( $new_templates ) ) {
			$settings['title_templates'] = $new_templates;
		}
	}

	update_option( 'toppers_ai_settings', $settings );
	wp_safe_redirect( add_query_arg( array( 'page' => 'toppers-ai-settings', 'updated' => '1' ), admin_url( 'admin.php' ) ) );
	exit;
}

/**
 * Render the AI Assistant dashboard settings page.
 */
function toppers_ai_settings_render() {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}
	$settings = toppers_get_ai_settings();
	$updated  = isset( $_GET['updated'] ) ? sanitize_text_field( wp_unslash( $_GET['updated'] ) ) : '';
	?>
	<div class="wrap toppers-ai-settings-wrap" dir="rtl">
		<h1 style="display:flex;align-items:center;gap:10px;">
			<span><i class="fa-solid fa-robot" aria-hidden="true"></i> إعدادات المساعد البحثي الذكي</span>
			<span style="font-size:13px;background:#c99a3b;color:#fff;padding:3px 10px;border-radius:20px;font-weight:normal;">توليد 5 نواتج ذكية</span>
		</h1>
		<p style="color:#64748b;font-size:14px;max-width:850px;">
			من هذه الصفحة يمكنك التحكم الكامل في مخرجات وقواعد بيانات <strong>المساعد البحثي</strong> في موقعك. يقوم المساعد باستخراج التخصص والدرجة العلمية والكلمات المفتاحية التي يدخلها الطالب، ثم يصيغ <strong>5 أفكار وعناوين بحثية احترافية وغير مستهلكة</strong> بالاعتماد على القوالب والوسوم التي تحددها هنا.
		</p>

		<?php if ( '1' === $updated ) : ?>
			<div class="notice notice-success is-dismissible"><p><strong>تم حفظ إعدادات المساعد البحثي بنجاح!</strong></p></div>
		<?php elseif ( 'reset' === $updated ) : ?>
			<div class="notice notice-info is-dismissible"><p><strong>تمت استعادة الإعدادات والقوالب الأكاديمية النموذجية بنجاح.</strong></p></div>
		<?php endif; ?>

		<form method="post" action="" style="margin-top:20px;">
			<?php wp_nonce_field( 'toppers_save_ai', 'toppers_ai_nonce' ); ?>

			<div class="toppers-box" style="background:#fff;border:1px solid #cbd5e1;border-radius:12px;padding:24px;margin-bottom:24px;max-width:980px;box-shadow:0 2px 6px rgba(0,0,0,0.02);">
				<h2 style="font-size:18px;margin-top:0;color:#0f172a;border-bottom:1px solid #e2e8f0;padding-bottom:12px;">
					<i class="fa-solid fa-tag" aria-hidden="true"></i> الكلمات المفتاحية السريعة (Quick Suggestion Chips)
				</h2>
				<p style="color:#64748b;font-size:13px;">تظهر هذه الكلمات للطالب كأزرار سريعة في صفحة المساعد البحثي لتسهيل الاختيار بنقرة واحدة. افصل بين كل كلمة أو عبارة بفاصلة أو سطر جديد.</p>
				<?php
				$chips_text = implode( "\n", $settings['quick_chips'] );
				?>
				<textarea name="toppers_quick_chips" rows="5" class="large-text" style="font-size:14px;line-height:1.6;font-family:inherit;"><?php echo esc_textarea( $chips_text ); ?></textarea>
			</div>

			<div class="toppers-box" style="background:#fff;border:1px solid #cbd5e1;border-radius:12px;padding:24px;margin-bottom:24px;max-width:980px;box-shadow:0 2px 6px rgba(0,0,0,0.02);">
				<div style="display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid #e2e8f0;padding-bottom:12px;margin-bottom:16px;">
					<h2 style="font-size:18px;margin:0;color:#0f172a;">
						<i class="fa-solid fa-lightbulb" aria-hidden="true"></i> قوالب صياغة الأفكار والعناوين الأكاديمية
					</h2>
					<button type="button" class="button button-secondary" id="toppers-add-template">+ إضافة قالب جديد</button>
				</div>
				<p style="color:#64748b;font-size:13px;margin-bottom:16px;">
					يقوم النظام باختيار 5 قوالب مختلفة عشوائياً في كل مرة ويستبدل المتغيرات: <code>{major}</code> (التخصص)، <code>{degree}</code> (الدرجة العلمية)، <code>{keyword}</code> (الاهتمامات أو الكلمات المفتاحية).
				</p>

				<div id="toppers-templates-container">
					<?php foreach ( $settings['title_templates'] as $i => $tpl ) : ?>
						<div class="toppers-template-item" style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:16px;margin-bottom:14px;position:relative;">
							<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
								<strong style="color:#1e293b;font-size:14px;">قالب رقم #<?php echo esc_html( (string) ( $i + 1 ) ); ?></strong>
								<button type="button" class="button-link-delete toppers-del-tpl" style="color:#ef4444;text-decoration:none;">حذف القالب</button>
							</div>
							<div style="margin-bottom:10px;">
								<label style="display:block;font-weight:600;font-size:13px;margin-bottom:4px;">صياغة العنوان (مع المتغيرات {keyword} و {major}):</label>
								<input type="text" name="toppers_templates[<?php echo esc_attr( (string) $i ); ?>][pattern]" value="<?php echo esc_attr( $tpl['pattern'] ); ?>" class="large-text" required>
							</div>
							<div style="display:grid;grid-template-columns:2fr 1fr;gap:12px;margin-bottom:10px;">
								<div>
									<label style="display:block;font-weight:600;font-size:13px;margin-bottom:4px;">النبذة والهدف من البحث:</label>
									<textarea name="toppers_templates[<?php echo esc_attr( (string) $i ); ?>][desc]" rows="2" class="large-text"><?php echo esc_textarea( $tpl['desc'] ); ?></textarea>
								</div>
								<div>
									<label style="display:block;font-weight:600;font-size:13px;margin-bottom:4px;">المنهجية المقترحة:</label>
									<input type="text" name="toppers_templates[<?php echo esc_attr( (string) $i ); ?>][methodology]" value="<?php echo esc_attr( $tpl['methodology'] ); ?>" class="widefat">
									<label style="display:block;font-weight:600;font-size:13px;margin-top:8px;margin-bottom:4px;">الأثر والمساهمة:</label>
									<input type="text" name="toppers_templates[<?php echo esc_attr( (string) $i ); ?>][impact]" value="<?php echo esc_attr( $tpl['impact'] ?? '' ); ?>" class="widefat">
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

			<div style="display:flex;gap:14px;align-items:center;">
				<?php submit_button( 'حفظ جميع إعدادات المساعد البحثي', 'primary', 'submit', false ); ?>
				<button type="submit" name="toppers_ai_reset" value="1" class="button button-secondary" onclick="return confirm('هل أنت متأكد من استعادة القوالب والكلمات الأكاديمية النموذجية الأصلية؟');" style="color:#64748b;">
					<i class="fa-solid fa-arrows-rotate" aria-hidden="true"></i> استعادة القوالب الافتراضية
				</button>
			</div>
		</form>
	</div>

	<script>
	jQuery(function($){
		var nextIdx = <?php echo esc_js( (string) count( $settings['title_templates'] ) ); ?>;
		$('#toppers-add-template').on('click', function(e){
			e.preventDefault();
			var html = '<div class="toppers-template-item" style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:16px;margin-bottom:14px;position:relative;">' +
				'<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">' +
				'<strong style="color:#1e293b;font-size:14px;">قالب جديد</strong>' +
				'<button type="button" class="button-link-delete toppers-del-tpl" style="color:#ef4444;text-decoration:none;">حذف القالب</button>' +
				'</div>' +
				'<div style="margin-bottom:10px;">' +
				'<label style="display:block;font-weight:600;font-size:13px;margin-bottom:4px;">صياغة العنوان (مع المتغيرات {keyword} و {major}):</label>' +
				'<input type="text" name="toppers_templates[' + nextIdx + '][pattern]" value="دور {keyword} في تطوير منظومة {major}: دراسة استشرافية" class="large-text" required>' +
				'</div>' +
				'<div style="display:grid;grid-template-columns:2fr 1fr;gap:12px;margin-bottom:10px;">' +
				'<div>' +
				'<label style="display:block;font-weight:600;font-size:13px;margin-bottom:4px;">النبذة والهدف من البحث:</label>' +
				'<textarea name="toppers_templates[' + nextIdx + '][desc]" rows="2" class="large-text">دراسة أكاديمية متقدمة لمرحلة {degree} تبحث أثر تطبيق وتطوير المفاهيم ذات الصلة بـ {keyword} في التخصص.</textarea>' +
				'</div>' +
				'<div>' +
				'<label style="display:block;font-weight:600;font-size:13px;margin-bottom:4px;">المنهجية المقترحة:</label>' +
				'<input type="text" name="toppers_templates[' + nextIdx + '][methodology]" value="منهج وصفي تحليلي" class="widefat">' +
				'<label style="display:block;font-weight:600;font-size:13px;margin-top:8px;margin-bottom:4px;">الأثر والمساهمة:</label>' +
				'<input type="text" name="toppers_templates[' + nextIdx + '][impact]" value="تقديم نموذج مقترح قابل للتطبيق الميداني" class="widefat">' +
				'</div>' +
				'</div>' +
				'</div>';
			$('#toppers-templates-container').append(html);
			nextIdx++;
		});

		$(document).on('click', '.toppers-del-tpl', function(e){
			e.preventDefault();
			$(this).closest('.toppers-template-item').remove();
		});
	});
	</script>
	<?php
}

