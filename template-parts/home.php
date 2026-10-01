<?php
/**
 * Homepage markup matching final-v.1/home.html.
 *
 * @package Toppers
 */

$hero_slides = array(
	toppers_photo( 'hero-1' ),
	toppers_photo( 'hero-2' ),
	toppers_photo( 'hero-3' ),
);

$home_services = array(
	// title (URL), short label, description, image key, badge
	array( 'إعداد رسائل الماجستير', 'رسائل الماجستير', 'مرافقة منهجية متكاملة من البناء حتى التسليم النهائي.', 'masters', 'حصري' ),
	array( 'إعداد رسائل الدكتوراه', 'رسائل الدكتوراه', 'دعم متخصص بعمق منهجي وتحليلي يناسب متطلبات الدرجة.', 'phd', '' ),
	array( 'إعداد خطة البحث (المقترح البحثي – Proposal)', 'خطة البحث', 'مقترح بحثي متكامل: المشكلة والأهداف والمنهجية.', 'proposal', 'الأكثر طلباً' ),
	array( 'التحليل الإحصائي وتفسير النتائج', 'التحليل الإحصائي', 'تحليل البيانات ببرامج معتمدة مع تفسير علمي واضح.', 'stats', 'الأكثر طلباً' ),
	array( 'التدقيق اللغوي والنحوي', 'التدقيق اللغوي', 'مراجعة لغوية ونحوية شاملة تضمن رصانة النص.', 'proof', '' ),
	array( 'فحص السرقة الأدبية ونسبة الاقتباس (Plagiarism)', 'فحص الاقتباس', 'فحص Plagiarism مع تقرير وتوصيات لتحسين الأصالة.', 'similarity', '' ),
	array( 'نشر الأبحاث في المجلات العلمية المحكّمة', 'النشر العلمي', 'تجهيز البحث ومتابعة النشر في المجلات المحكمة.', 'publish', '' ),
	array( 'إعداد الأبحاث الجامعية', 'الأبحاث الجامعية', 'بحوث جامعية بمنهجية علمية تناسب متطلبات المقرر.', 'research', '' ),
	array( 'تصميم أدوات الدراسة (الاستبيانات، المقابلات، بطاقات الملاحظة)', 'أدوات الدراسة', 'تصميم الاستبيانات والمقابلات وبطاقات الملاحظة.', 'stats', '' ),
	array( 'تنفيذ ملاحظات وتعديلات على بحث جاهز', 'تعديلات البحث', 'تنفيذ ملاحظات المشرف على بحث جاهز بدقة وسرعة.', 'meeting', 'جديد' ),
	array( 'الترجمة الأكاديمية المعتمدة', 'الترجمة المعتمدة', 'ترجمة أكاديمية دقيقة بمصطلحات علمية منضبطة.', 'translate', '' ),
	array( 'كتابة سيرة ذاتية ATS', 'سيرة ذاتية ATS', 'سيرة احترافية متوافقة مع أنظمة التوظيف ATS.', 'meeting', '' ),
);

$home_service_cats = function_exists( 'toppers_services_categories' ) ? toppers_services_categories() : array();

$why_icons = array(
	'<i class="fa-solid fa-user-graduate" aria-hidden="true"></i>',
	'<i class="fa-solid fa-clipboard-check" aria-hidden="true"></i>',
	'<i class="fa-solid fa-clock" aria-hidden="true"></i>',
	'<i class="fa-solid fa-lock" aria-hidden="true"></i>',
);

$default_tests = array(
	// 1. VIDEOS (YouTube)
	array( 'عميل 1', 'طالبة ماجستير — إدارة أعمال', 'تجربتي مع منصة توبرز في إعداد الإطار النظري والتحليل الإحصائي لرسالة الماجستير؛ التزام استثنائي بالمواعيد ودقة علمية عالية ساعدتني في اجتياز السيمنار بنجاح.', 'video', 'https://youtu.be/dujo3xmx0ME' ),
	array( 'عميل 2', 'باحث دكتوراه — مناهج وطرق تدريس', 'فريق عمل احترافي ساعدني في تحكيم أدوات الدراسة وبناء مقياس البحث ومطابقته مع دليل الجامعة المعتمد، سرعة استجابة ومتابعة مستمرة.', 'video', 'https://youtu.be/dujo3xmx0ME' ),
	// 2. IMAGES (Screenshots & WhatsApp chat)
	array( 'عميل 3', 'أستاذ مساعد — دراسات إسلامية', 'قبول ونشر البحث العلمي في مجلة محكمة ومصنفة دولياً خلال فترة قياسية، عمل يشكر عليه فريق توبرز.', 'image', array( 'مبروك دكتور، تم قبول البحث ونشره في المجلة المحكمة رسمياً.', 'ما شاء الله تبارك الله، ألف شكر لفريق توبرز على الدقة والاحترافية وسرعة الإنجاز.' ) ),
	array( 'عميل 4', 'طالبة بكالوريوس — علوم حاسب', 'تقرير فحص نسبة الاقتباس (Turnitin) بنسبة 3% فقط بعد التدقيق والصياغة الأكاديمية لمشروع التخرج.', 'image', array( 'مرحباً، تم الانتهاء من فحص الاقتباس والتقرير معتمد بنسبة 3% فقط.', 'جزاكم الله خيراً، الشغل ممتاز جداً والدكتور اعتمد البحث مباشرة بدون أي ملاحظات.' ) ),
	// 3. TEXTS (Written reviews)
	array( 'عميل 5', 'باحث ماجستير — قانون عام', 'التدقيق اللغوي والمراجعة المنهجية كانت على أعلى مستوى من الرصانة، لم أجد ملاحظة لغوية واحدة من لجنة المناقشة. شكراً لكم.', 'text', '' ),
	array( 'عميل 6', 'طالبة دراسات عليا — تمريض', 'التحليل الإحصائي عبر برنامج SPSS كان دقيقاً مع جداول ورسوم بيانية واضحة وشرح وافٍ ومفصل لكل اختبار وفرضية.', 'text', '' ),
);
?>
<section class="hero-slider-wrapper hero-slider-wrapper--image-only">
	<div class="hero-slider" id="heroSlider">
		<?php foreach ( $hero_slides as $i => $img ) : ?>
			<div class="hero-slide<?php echo 0 === $i ? ' is-active' : ''; ?> slide-<?php echo esc_attr( $i + 1 ); ?>">
				<div class="slide-bg">
					<img src="<?php echo esc_url( $img ); ?>" alt="" decoding="async"<?php echo 0 === $i ? ' fetchpriority="high"' : ' loading="lazy"'; ?>>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<div class="slider-controls">
		<button class="slider-btn" id="sliderPrev" type="button" aria-label="<?php esc_attr_e( 'السابق', 'toppers' ); ?>">
			<i class="fa-solid fa-chevron-right" aria-hidden="true" style="font-size:20px;"></i>
		</button>
		<div class="slider-dots" id="sliderDots">
			<button class="slider-dot active" data-index="0" type="button"></button>
			<button class="slider-dot" data-index="1" type="button"></button>
			<button class="slider-dot" data-index="2" type="button"></button>
		</div>
		<button class="slider-btn" id="sliderNext" type="button" aria-label="<?php esc_attr_e( 'التالي', 'toppers' ); ?>">
			<i class="fa-solid fa-chevron-left" aria-hidden="true" style="font-size:20px;"></i>
		</button>
	</div>
</section>

<!-- About & Video Section -->
<section class="section home-about-video-sec">
	<div class="container">
		<div class="home-about-video-grid">
			<div class="home-about-col reveal">
				<div class="eyebrow"><?php echo toppers_star_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php echo esc_html( toppers_content( 'home_about_eyebrow', __( 'من نحن', 'toppers' ) ) ); ?></span></div>
				<h2 class="home-about-title"><?php echo esc_html( toppers_content( 'home_about_title', __( 'منظومتك المتكاملة لخدمات البحث العلمي', 'toppers' ) ) ); ?></h2>
				<p class="home-about-desc"><?php echo esc_html( toppers_content( 'home_about_text', __( 'نحن منظومة أكاديمية رائدة ومتخصصة في تقديم خدمات البحث العلمي لطلبة الدراسات العليا والباحثين في المملكة العربية السعودية والوطن العربي. نُسخّر نخبة من الكفاءات الأكاديمية لتذليل عقبات البحث العلمي، وصياغة نتاج معرفي أصيل يلتزم بأعلى معايير النزاهة والضوابط الجامعية؛ لنكون سندك الموثوق في كل مرحلة من رحلتك الأكاديمية، ونرتقي معًا نحو قمة البحث العلمي.', 'toppers' ) ) ); ?></p>
				<ul class="home-about-features">
					<li class="home-about-feat-item">
						<span class="feat-icon" aria-hidden="true"><i class="fa-solid fa-graduation-cap"></i></span>
						<div class="feat-text">
							<strong><?php esc_html_e( 'نخبة من الكفاءات الأكاديمية', 'toppers' ); ?></strong>
							<span><?php esc_html_e( 'باحثون ومستشارون معتمدون في شتى التخصصات العلمية والإنسانية.', 'toppers' ); ?></span>
						</div>
					</li>
					<li class="home-about-feat-item">
						<span class="feat-icon" aria-hidden="true"><i class="fa-solid fa-shield-halved"></i></span>
						<div class="feat-text">
							<strong><?php esc_html_e( 'التزام صارم بالمعايير والأمانة', 'toppers' ); ?></strong>
							<span><?php esc_html_e( 'توافق تام مع أدلة الجامعات السعودية وضمان سرية وأصالة العمل.', 'toppers' ); ?></span>
						</div>
					</li>
				</ul>
				<div class="home-about-actions">
					<a href="<?php echo esc_url( toppers_page_url( 'about' ) ); ?>" class="btn btn-gold">
						<?php esc_html_e( 'تعرف علينا أكثر', 'toppers' ); ?>
						<i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
					</a>
					<a href="<?php echo esc_url( toppers_whatsapp_url() ); ?>" target="_blank" rel="noopener" class="btn btn-outline-dark home-about-wa">
						<i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
						<?php esc_html_e( 'تواصل معنا', 'toppers' ); ?>
					</a>
				</div>
			</div>

			<div class="home-video-col reveal">
				<div class="home-video-card">
					<div class="home-video-media">
						<div class="home-video-badge">
							<span class="home-video-badge-dot" aria-hidden="true"></span>
							<span><?php esc_html_e( 'فيديو تعريفي', 'toppers' ); ?></span>
						</div>
						<div class="home-video-frame-wrap">
							<?php
							$home_vid_url = toppers_content( 'home_video_embed_url', 'https://youtu.be/dujo3xmx0ME' );
							$embed_src    = toppers_youtube_embed_url( $home_vid_url );
							$vid_title    = toppers_content( 'home_video_title', __( 'الفيديو التعريفي لمنصة توبرز | نحو قمة البحث العلمي', 'toppers' ) );
							?>
							<iframe
								src="<?php echo esc_url( $embed_src ); ?>"
								title="<?php echo esc_attr( $vid_title ); ?>"
								frameborder="0"
								allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
								referrerpolicy="strict-origin-when-cross-origin"
								allowfullscreen
								loading="lazy">
							</iframe>
						</div>
					</div>
					<div class="home-video-caption">
						<h3 class="home-video-caption-title"><?php echo esc_html( $vid_title ); ?></h3>
						<p class="home-video-caption-desc"><?php echo esc_html( toppers_content( 'home_video_desc', __( 'تعرف على خدماتنا الأكاديمية المتكاملة وكيف نرافقك خطوة بخطوة لتحقيق التميز البحثي والاعتماد الأكاديمي.', 'toppers' ) ) ); ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Services Section -->
<section class="section section--alt home-services-sec">
	<div class="container">
		<div class="section-head center reveal">
			<div class="eyebrow"><?php echo toppers_star_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php echo esc_html( toppers_content( 'home_services_eyebrow', __( 'خدماتنا', 'toppers' ) ) ); ?></span></div>
			<h2><?php echo esc_html( toppers_content( 'home_services_title', __( 'كل ما تحتاجه رحلتك البحثية في مكان واحد', 'toppers' ) ) ); ?></h2>
			<p><?php echo esc_html( toppers_content( 'home_services_lede', __( 'من اختيار العنوان إلى النشر العلمي — نغطي المراحل الأكاديمية كافة بفريق متخصص لكل مجال.', 'toppers' ) ) ); ?></p>
		</div>

		<?php if ( $home_service_cats ) : ?>
			<nav class="home-svc-cats reveal" aria-label="<?php esc_attr_e( 'أقسام الخدمات', 'toppers' ); ?>">
				<?php foreach ( $home_service_cats as $slug => $cat ) : ?>
					<a class="home-svc-cat" href="<?php echo esc_url( toppers_page_url( 'services' ) . '#cat-' . rawurlencode( $slug ) ); ?>">
						<?php echo esc_html( $cat['name'] ); ?>
					</a>
				<?php endforeach; ?>
			</nav>
		<?php endif; ?>

		<div class="home-svc-grid reveal-stagger reveal">
			<?php foreach ( $home_services as $svc ) : ?>
				<a href="<?php echo esc_url( toppers_service_url( $svc[0] ) ); ?>" class="service-card home-svc-card">
					<div class="sc-img">
						<img src="<?php echo esc_url( toppers_photo( $svc[3] ) ); ?>" alt="<?php echo esc_attr( $svc[1] ); ?>" loading="lazy">
						<?php if ( ! empty( $svc[4] ) ) : ?>
							<span class="sc-badge"><?php echo esc_html( $svc[4] ); ?></span>
						<?php endif; ?>
					</div>
					<div class="sc-content">
						<h3><?php echo esc_html( $svc[1] ); ?></h3>
						<p><?php echo esc_html( $svc[2] ); ?></p>
						<span class="sc-link"><?php esc_html_e( 'اطلب هذه الخدمة', 'toppers' ); ?> <span class="arrow">&larr;</span></span>
					</div>
				</a>
			<?php endforeach; ?>
		</div>

		<div class="home-svc-foot center reveal">
			<a href="<?php echo esc_url( toppers_page_url( 'services' ) ); ?>" class="btn btn-outline-dark"><?php esc_html_e( 'عرض كل الخدمات', 'toppers' ); ?></a>
			<button type="button" class="btn btn-gold open-order-modal" data-service="<?php esc_attr_e( 'خدمة مخصصة', 'toppers' ); ?>">
				<?php esc_html_e( 'طلب خدمة مخصصة', 'toppers' ); ?>
			</button>
		</div>
	</div>
</section>

<!-- Journey / How We Work Section (With About Us button at bottom) -->
<section class="section">
	<div class="container">
		<div class="section-head center reveal">
			<div class="eyebrow"><?php echo toppers_star_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php echo esc_html( toppers_content( 'home_journey_eyebrow', __( 'كيف نعمل', 'toppers' ) ) ); ?></span></div>
			<h2><?php echo esc_html( toppers_content( 'home_journey_title', __( 'رحلة طلب واضحة من أول تواصل حتى التسليم', 'toppers' ) ) ); ?></h2>
		</div>
		<div class="journey reveal-stagger reveal">
			<?php
			$steps = array(
				array( '1', 'التواصل', 'تخبرنا بمتطلبات بحثك عبر الموقع أو واتساب.' ),
				array( '2', 'دراسة الطلب', 'نراجع التفاصيل ونحدد التخصص المناسب.' ),
				array( '3', 'عرض السعر', 'نرسل لك سعرًا واضحًا ومدة تسليم محددة.' ),
				array( '4', 'التنفيذ', 'يبدأ الباحث المتخصص العمل على طلبك.' ),
				array( '5', 'مراجعة الجودة', 'فحص علمي ولغوي وتدقيق تشابه قبل التسليم.' ),
				array( '6', 'التسليم', 'تستلم عملك مع إمكانية طلب تعديلات.' ),
			);
			foreach ( $steps as $step ) {
				echo '<div class="journey-step"><div class="journey-num">' . esc_html( $step[0] ) . '</div><h4>' . esc_html( $step[1] ) . '</h4><p>' . esc_html( $step[2] ) . '</p></div>';
			}
			?>
		</div>
		<div class="center reveal" style="margin-top:44px;">
			<a href="<?php echo esc_url( toppers_page_url( 'about' ) ); ?>" class="btn btn-navy" style="display:inline-flex; align-items:center; gap:8px;">
				<span><?php esc_html_e( 'تعرف أكثر على منصة توبرز', 'toppers' ); ?></span>
				<i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
			</a>
		</div>
	</div>
</section>

<!-- Testimonials Section (Swapped to come before Why Toppers) -->
<section class="section section--alt">
	<div class="container">
		<div class="section-head center reveal">
			<div class="eyebrow"><?php echo toppers_star_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php echo esc_html( toppers_content( 'home_testimonials_eyebrow', __( 'آراء عملائنا', 'toppers' ) ) ); ?></span></div>
			<h2><?php echo esc_html( toppers_content( 'home_testimonials_title', __( 'طلاب وباحثون وثقوا بنا في محطة مهمة من مسيرتهم', 'toppers' ) ) ); ?></h2>
			<p style="max-width: 650px; margin: 15px auto 0; color: rgba(14,23,48,0.7);"><?php echo esc_html( toppers_content( 'home_testimonials_lede', __( 'نفخر بكوننا جزءاً من نجاح آلاف الطلاب والباحثين، اقرأ واستمع وشاهد بعضاً من تجاربهم في التعامل معنا.', 'toppers' ) ) ); ?></p>
		</div>
		<div class="grid grid-3 reveal-stagger reveal">
			<?php
			$tests = new WP_Query(
				array(
					'post_type'      => 'toppers_testimonial',
					'posts_per_page' => 6,
					'post_status'    => 'publish',
				)
			);
			$home_client_counter = 1;
			if ( $tests->have_posts() ) {
				$raw_posts = $tests->posts;
				$voices    = array();
				$vids      = array();
				$imgs      = array();
				$txts      = array();
				foreach ( $raw_posts as $p ) {
					$rtype    = get_post_meta( $p->ID, '_toppers_testimonial_type', true ) ?: 'text';
					$audio_id = (int) get_post_meta( $p->ID, '_toppers_audio_id', true );
					if ( 'voice' === $rtype || $audio_id ) {
						$voices[] = $p;
					} elseif ( 'video' === $rtype || get_post_meta( $p->ID, '_toppers_video_url', true ) || get_post_meta( $p->ID, '_toppers_youtube_url', true ) ) {
						$vids[] = $p;
					} elseif ( in_array( $rtype, array( 'image', 'whatsapp', 'photo' ), true ) || get_post_meta( $p->ID, '_toppers_screenshot_id', true ) || has_post_thumbnail( $p->ID ) ) {
						$imgs[] = $p;
					} else {
						$txts[] = $p;
					}
				}
				$ordered_tests = array_merge( $voices, $vids, $imgs, $txts );

				foreach ( $ordered_tests as $tpost ) {
					$pid      = $tpost->ID;
					$role     = get_post_meta( $pid, '_toppers_role', true ) ?: 'طالب باحث';
					$quote    = wp_strip_all_tags( $tpost->post_content );
					$raw_type = get_post_meta( $pid, '_toppers_testimonial_type', true ) ?: 'text';
					$stars    = max( 1, min( 5, (int) ( get_post_meta( $pid, '_toppers_stars', true ) ?: 5 ) ) );
					$star_str = str_repeat( '<i class="fa-solid fa-star" aria-hidden="true"></i>', $stars );

					$audio_id   = (int) get_post_meta( $pid, '_toppers_audio_id', true );
					$audio_url  = $audio_id ? wp_get_attachment_url( $audio_id ) : '';
					$audio_time = get_post_meta( $pid, '_toppers_audio_time', true ) ?: '0:45';

					$video_url = get_post_meta( $pid, '_toppers_youtube_url', true ) ?: get_post_meta( $pid, '_toppers_video_url', true ) ?: '';
					if ( ! $video_url && 'video' === $raw_type ) {
						$video_url = 'https://youtu.be/dujo3xmx0ME';
					}

					$screen_id = (int) get_post_meta( $pid, '_toppers_screenshot_id', true );
					if ( ! $screen_id ) {
						$screen_id = get_post_thumbnail_id( $pid );
					}
					$screen_thumb = $screen_id ? wp_get_attachment_image_url( $screen_id, 'large' ) : '';
					$screen_full  = $screen_id ? wp_get_attachment_image_url( $screen_id, 'full' ) : $screen_thumb;

					if ( 'voice' === $raw_type || $audio_url ) {
						$type = 'voice';
					} elseif ( 'video' === $raw_type || $video_url ) {
						$type = 'video';
					} elseif ( in_array( $raw_type, array( 'image', 'whatsapp', 'photo' ), true ) || $screen_thumb ) {
						$type = 'image';
					} else {
						$type = 'text';
					}
					$client_title = sprintf( /* translators: %d: client number */ __( 'عميل %d', 'toppers' ), $home_client_counter );

					echo '<div class="t-card" data-type="' . esc_attr( $type ) . '" style="border-radius: 18px;">';
					if ( 'voice' === $type ) {
						echo '<span class="media-badge is-voice"><i class="fa-solid fa-microphone-lines" aria-hidden="true"></i> ' . esc_html__( 'رسالة صوتية', 'toppers' ) . '</span>';
						echo '<div class="t-voice-wrap">';
						echo toppers_audio_player( $audio_url, $audio_time ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						echo '</div>';
						echo '<div class="t-stars">' . $star_str . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						if ( $quote ) {
							echo '<p class="t-quote t-quote--voice">' . esc_html( $quote ) . '</p>';
						}
					} elseif ( 'video' === $type ) {
						echo '<span class="media-badge" style="background: rgba(239,68,68,0.12); color: #dc2626; border: 1px solid rgba(239,68,68,0.25);"><i class="fa-brands fa-youtube" aria-hidden="true"></i> ' . esc_html__( 'فيديو تجربة', 'toppers' ) . '</span>';
						echo '<div class="t-video-wrap" style="position: relative; width: 100%; padding-top: 56.25%; border-radius: 12px; overflow: hidden; margin-bottom: 12px; background: #0f172a;"><iframe src="' . esc_url( toppers_youtube_embed_url( $video_url ) ) . '" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;" allowfullscreen loading="lazy"></iframe></div>';
						echo '<div class="t-stars">' . $star_str . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						if ( $quote ) {
							echo '<p class="t-quote">' . esc_html( $quote ) . '</p>';
						}
					} elseif ( 'image' === $type && $screen_thumb ) {
						echo '<span class="media-badge"><i class="fa-solid fa-camera" aria-hidden="true"></i> ' . esc_html__( 'سكرين شوت', 'toppers' ) . '</span>';
						echo '<div class="t-screenshot-wrap" data-full-image="' . esc_url( $screen_full ) . '" title="' . esc_attr__( 'انقر لتكبير السكرين شوت', 'toppers' ) . '">';
						echo '<img src="' . esc_url( $screen_thumb ) . '" alt="' . esc_attr( $client_title ) . '" class="t-screenshot-img">';
						echo '<div class="t-zoom-overlay"><i class="fa-solid fa-magnifying-glass-plus" aria-hidden="true" style="font-size:20px;"></i><span>' . esc_html__( 'تكبير', 'toppers' ) . '</span></div>';
						echo '</div>';
						echo '<div class="t-stars" style="margin-top:10px;">' . $star_str . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						if ( $quote ) {
							echo '<p class="t-quote">' . esc_html( $quote ) . '</p>';
						}
					} else {
						echo '<span class="media-badge"><i class="fa-solid fa-pen-nib" aria-hidden="true"></i> ' . esc_html__( 'رأي نصي', 'toppers' ) . '</span>';
						echo '<div class="t-stars">' . $star_str . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						echo '<p class="t-quote" style="margin-top:6px;">' . esc_html( $quote ) . '</p>';
					}
					echo '<div class="t-who"><div class="t-avatar"><i class="fa-solid fa-user-graduate" aria-hidden="true"></i></div><div><b>' . esc_html( $client_title ) . '</b><span>' . esc_html( $role ) . '</span></div></div>';
					echo '</div>';
					++$home_client_counter;
				}
				wp_reset_postdata();
			} else {
				foreach ( $default_tests as $row ) {
					$default_star_str = str_repeat( '<i class="fa-solid fa-star" aria-hidden="true"></i>', 5 );
					$type = $row[3];
					echo '<div class="t-card" data-type="' . esc_attr( $type ) . '" style="border-radius: 18px;">';
					if ( 'video' === $type ) {
						echo '<span class="media-badge" style="background: rgba(239,68,68,0.12); color: #dc2626; border: 1px solid rgba(239,68,68,0.25);"><i class="fa-brands fa-youtube" aria-hidden="true"></i> ' . esc_html__( 'فيديو تجربة', 'toppers' ) . '</span>';
						echo '<div class="t-video-wrap" style="position: relative; width: 100%; padding-top: 56.25%; border-radius: 12px; overflow: hidden; margin-bottom: 12px; background: #0f172a;"><iframe src="' . esc_url( toppers_youtube_embed_url( $row[4] ) ) . '" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;" allowfullscreen loading="lazy"></iframe></div>';
						echo '<div class="t-stars">' . $default_star_str . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						echo '<p class="t-quote">' . esc_html( $row[2] ) . '</p>';
					} elseif ( 'image' === $type ) {
						echo '<span class="media-badge"><i class="fa-solid fa-camera" aria-hidden="true"></i> ' . esc_html__( 'لقطة محادثة', 'toppers' ) . '</span>';
						echo '<div class="chat-proof" style="background:#f8fafc; border-radius:12px; padding:12px; margin-bottom:12px; border:1px solid rgba(14,23,48,0.06);">';
						echo '<div class="cp-head" style="font-size:11.5px; color:var(--ink-faint); margin-bottom:6px;"><i class="fa-brands fa-whatsapp" style="color:#25d366;"></i> ' . esc_html( sprintf( 'محادثة واتساب — %s', $row[0] ) ) . '</div>';
						echo '<div class="chat-bubble in" style="background:#fff; padding:8px 12px; border-radius:10px 10px 0 10px; font-size:13px; margin-bottom:6px; box-shadow:0 1px 3px rgba(0,0,0,0.04);">' . esc_html( $row[4][0] ) . '</div>';
						echo '<div class="chat-bubble out" style="background:#d9fdd3; padding:8px 12px; border-radius:10px 10px 10px 0; font-size:13px; margin-right:auto;">' . esc_html( $row[4][1] ) . ' <span style="color:#53bdeb;">✓✓</span></div>';
						echo '</div>';
						echo '<div class="t-stars">' . $default_star_str . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						echo '<p class="t-quote">' . esc_html( $row[2] ) . '</p>';
					} else {
						echo '<span class="media-badge"><i class="fa-solid fa-pen-nib" aria-hidden="true"></i> ' . esc_html__( 'رأي نصي', 'toppers' ) . '</span>';
						echo '<div class="t-stars">' . $default_star_str . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						echo '<p class="t-quote" style="margin-top:6px;">' . esc_html( $row[2] ) . '</p>';
					}
					echo '<div class="t-who"><div class="t-avatar"><i class="fa-solid fa-user-graduate" aria-hidden="true"></i></div><div><b>' . esc_html( $row[0] ) . '</b><span>' . esc_html( $row[1] ) . '</span></div></div>';
					echo '</div>';
				}
			}
			?>
		</div>
		<div style="text-align:center; margin-top: 36px;" class="reveal">
			<a href="<?php echo esc_url( toppers_page_url( 'testimonials' ) ); ?>" class="btn btn-outline-dark"><?php esc_html_e( 'عرض كافة آراء الطلاب وتجاربهم', 'toppers' ); ?></a>
		</div>
	</div>
</section>

<!-- Screenshot Lightbox Modal for Homepage -->
<div class="image-modal-overlay" id="homeImageModal">
	<div class="image-modal-box">
		<button class="image-modal-close" id="homeImageModalClose" type="button" aria-label="<?php esc_attr_e( 'إغلاق', 'toppers' ); ?>">&times;</button>
		<img id="homeImageModalImg" src="" alt="<?php esc_attr_e( 'معاينة سكرين شوت', 'toppers' ); ?>">
	</div>
</div>

<!-- Why Toppers Section (With Stats synchronized with About Us) -->
<section class="section section--navy" style="position:relative; overflow:hidden;">
	<div style="position:absolute; top:-20%; right:-10%; width:600px; height:600px; background:radial-gradient(circle, rgba(201,154,59,0.15) 0%, transparent 60%); border-radius:50%; filter:blur(60px); pointer-events:none;"></div>
	<div style="position:absolute; bottom:-20%; left:-10%; width:600px; height:600px; background:radial-gradient(circle, rgba(28,47,94,0.6) 0%, transparent 60%); border-radius:50%; filter:blur(60px); pointer-events:none;"></div>
	<div class="container" style="position:relative; z-index:2;">
		<div class="section-head center reveal" style="margin-bottom:64px;">
			<div class="eyebrow" style="color:var(--gold-light); justify-content:center; display:flex; gap:12px;">
				<?php echo toppers_star_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<span><?php echo esc_html( toppers_content( 'home_why_eyebrow', __( 'لماذا توبرز', 'toppers' ) ) ); ?></span>
				<?php echo toppers_star_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
			<h2 style="font-size:clamp(32px, 4vw, 44px); margin-top:16px; background:linear-gradient(to left, #ffffff, #e0e0e0); -webkit-background-clip:text; -webkit-text-fill-color:transparent; display:inline-block;"><?php echo esc_html( toppers_content( 'home_why_title', __( 'شريكك الأكاديمي من الفكرة حتى النشر', 'toppers' ) ) ); ?></h2>
			<p style="color:rgba(255,255,255,0.7); max-width:640px; margin:20px auto 0; font-size:16px; line-height:1.7;"><?php echo esc_html( toppers_content( 'home_why_lede', __( 'نقدم لك دعماً بحثياً متكاملاً بمعايير عالمية لضمان نجاحك الأكاديمي بكل احترافية وسرية تامة، لنكون شركاء في رحلتك نحو التميز.', 'toppers' ) ) ); ?></p>
		</div>
		<div class="grid grid-4 reveal-stagger reveal">
			<?php
			$whys = array(
				array( 'فريق متخصص', 'باحثون وخبراء إحصاء ولغويون في مختلف التخصصات العلمية.' ),
				array( 'دقة علمية', 'التزام صارم بالمنهجية العلمية والمعايير الأكاديمية المعتمدة.' ),
				array( 'مواعيد تُحترم', 'تسليم في الوقت المتفق عليه دون تأخير أو مفاجآت.' ),
				array( 'سرية تامة', 'بياناتك وملفاتك محمية ولا يطّلع عليها سوى الفريق المكلف.' ),
			);
			foreach ( $whys as $i => $why ) {
				$delay = $i ? ' style="transition-delay:' . ( $i * 0.1 ) . 's;"' : '';
				echo '<div class="why-card"' . $delay . '><div class="why-card-ic">' . $why_icons[ $i ] . '</div><h3>' . esc_html( $why[0] ) . '</h3><p>' . esc_html( $why[1] ) . '</p></div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
			?>
		</div>
		<div class="why-stats reveal" style="margin-top:64px; display:flex; justify-content:space-around; align-items:center; background:rgba(255,255,255,0.02); border:1px solid rgba(255,255,255,0.08); padding:36px 20px; border-radius:24px; backdrop-filter:blur(16px); box-shadow:0 20px 40px -10px rgba(0,0,0,0.2);">
			<?php
			$stats = array(
				array( toppers_content( 'home_stat_1_num', '10' ), toppers_content( 'home_stat_1_suffix', '+' ), toppers_content( 'home_stat_1_label', 'سنوات خبرة مؤسسية' ) ),
				array( toppers_content( 'home_stat_2_num', '500' ), toppers_content( 'home_stat_2_suffix', '+' ), toppers_content( 'home_stat_2_label', 'مختص أكاديمي' ) ),
				array( toppers_content( 'home_stat_3_num', '10000' ), toppers_content( 'home_stat_3_suffix', '+' ), toppers_content( 'home_stat_3_label', 'مشروع وبحث أكاديمي' ) ),
				array( toppers_content( 'home_stat_4_num', '98.5' ), toppers_content( 'home_stat_4_suffix', '%' ), toppers_content( 'home_stat_4_label', 'معدل رضا العملاء' ) ),
			);
			foreach ( $stats as $stat ) {
				echo '<div class="stat-item" style="text-align:center;"><div style="font-family:var(--f-display); font-size:46px; font-weight:800; color:var(--gold-light); line-height:1; text-shadow:0 0 20px rgba(201,154,59,0.3);"><span data-count="' . esc_attr( $stat[0] ) . '" data-suffix="' . esc_attr( $stat[1] ) . '">0</span></div><div style="font-size:13.5px; color:rgba(255,255,255,0.7); margin-top:10px; font-weight:600; text-transform:uppercase; letter-spacing:1px;">' . esc_html( $stat[2] ) . '</div></div>';
			}
			?>
		</div>
	</div>
</section>

<!-- Blog Section -->
<section class="section">
	<div class="container">
		<div class="section-head center reveal">
			<div class="eyebrow"><?php echo toppers_star_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php echo esc_html( toppers_content( 'home_blog_eyebrow', __( 'أحدث المقالات', 'toppers' ) ) ); ?></span></div>
			<h2><?php echo esc_html( toppers_content( 'home_blog_title', __( 'المدونة', 'toppers' ) ) ); ?></h2>
			<p style="max-width: 600px; margin: 15px auto 0;"><?php echo esc_html( toppers_content( 'home_blog_lede', __( 'نشاركك أفضل الممارسات والنصائح لإعداد الأبحاث والرسائل العلمية بمنهجية صحيحة.', 'toppers' ) ) ); ?></p>
		</div>
		<div class="grid grid-3 reveal-stagger reveal">
			<?php
			$latest = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 3 ) );
			if ( $latest->have_posts() ) {
				while ( $latest->have_posts() ) {
					$latest->the_post();
					get_template_part( 'template-parts/card-post' );
				}
				wp_reset_postdata();
			}
			?>
		</div>
		<div style="text-align:center; margin-top: 40px;" class="reveal">
			<a href="<?php echo esc_url( toppers_blog_url() ); ?>" class="btn btn-outline-dark"><?php esc_html_e( 'عرض كل المقالات', 'toppers' ); ?></a>
		</div>
	</div>
</section>

<!-- Call to Action -->
<section class="section--tight">
	<div class="container">
		<div class="cta-band reveal">
			<h2><?php echo esc_html( toppers_content( 'home_cta_title', __( 'جاهز لبدء رحلتك البحثية؟', 'toppers' ) ) ); ?></h2>
			<p><?php echo esc_html( toppers_content( 'home_cta_lede', __( 'أرسل تفاصيل مشروعك الآن واحصل على استشارة أولية وعرض سعر مجاني خلال ساعات.', 'toppers' ) ) ); ?></p>
			<div class="cta-actions">
				<a href="<?php echo esc_url( toppers_page_url( 'contact' ) ); ?>" class="btn btn-gold"><?php esc_html_e( 'اطلب خدمتك', 'toppers' ); ?></a>
				<a href="<?php echo esc_url( toppers_whatsapp_url() ); ?>" target="_blank" rel="noopener" class="btn btn-whatsapp">
					<i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
					<?php esc_html_e( 'تواصل عبر واتساب', 'toppers' ); ?>
				</a>
			</div>
		</div>
	</div>
</section>