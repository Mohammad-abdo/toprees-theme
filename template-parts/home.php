<?php
/**
 * Homepage markup matching final-v.1/home.html.
 *
 * @package Toppers
 */

$hero_slides = array(
	array( toppers_photo( 'hero-1' ), toppers_content( 'home_slide_1_eyebrow', 'توبرز للاستشارات والحلول البحثية' ), toppers_content( 'home_slide_1_title', 'من فكرة البحث' ), toppers_content( 'home_slide_1_accent', 'إلى التسليم النهائي' ), toppers_content( 'home_slide_1_lede', 'نرافق طلاب البكالوريوس والماجستير والدكتوراه والباحثين في كل محطة من رحلتهم الأكاديمية؛ بدقة علمية، ومواعيد تُحترم.' ), array( array( toppers_page_url( 'contact' ), 'اطلب خدمتك الآن', 'btn btn-gold' ), array( toppers_page_url( 'services' ), 'تصفح الخدمات', 'btn btn-outline' ) ) ),
	array( toppers_photo( 'hero-2' ), toppers_content( 'home_slide_2_eyebrow', 'أعلى معايير الجودة' ), toppers_content( 'home_slide_2_title', 'رسائل الماجستير' ), toppers_content( 'home_slide_2_accent', 'بمنهجية دقيقة' ), toppers_content( 'home_slide_2_lede', 'دعم شامل للباحثين من اقتراح العنوان وحتى المناقشة، مع ضمان الجودة والسرية التامة لجميع البيانات.' ), array( array( toppers_page_url( 'services' ), 'عرض الخدمة', 'btn btn-gold' ) ) ),
	array( toppers_photo( 'hero-3' ), toppers_content( 'home_slide_3_eyebrow', 'دعم إحصائي ولغوي' ), toppers_content( 'home_slide_3_title', 'التحليل الإحصائي' ), toppers_content( 'home_slide_3_accent', 'والترجمة الاحترافية' ), toppers_content( 'home_slide_3_lede', 'نستخدم أحدث البرامج الإحصائية لتحليل بيانات بحثك، ونقدم ترجمة أكاديمية معتمدة تدعم وصول بحثك للعالمية.' ), array( array( toppers_page_url( 'contact' ), 'تواصل معنا', 'btn btn-gold' ) ) ),
);

$home_services = array(
	array( 'البحوث الجامعية', 'إعداد بحوث جامعية بمنهجية علمية دقيقة تناسب متطلبات كل مقرر.', 'research' ),
	array( 'رسائل الماجستير', 'مرافقة كاملة من اختيار العنوان حتى المناقشة والتنسيق النهائي.', 'masters' ),
	array( 'أطروحات الدكتوراه', 'دعم بحثي متقدم للباحثين في مراحل الدكتوراه المختلفة.', 'phd' ),
	array( 'التحليل الإحصائي', 'تحليل بيانات البحث باستخدام البرامج الإحصائية المناسبة.', 'stats' ),
	array( 'خطة البحث والمقترح', 'صياغة مقترح بحثي متكامل يحدد مشكلة البحث وأهدافه ومنهجيته.', 'proposal' ),
	array( 'الترجمة الأكاديمية', 'ترجمة دقيقة للأبحاث والمصادر بين العربية ولغات البحث العلمي.', 'translate' ),
	array( 'التدقيق اللغوي', 'مراجعة لغوية شاملة لرسائل الماجستير والدكتوراه والأبحاث.', 'proof' ),
	array( 'فحص نسبة الاقتباس', 'تقرير دقيق لنسبة التشابه مع توصيات لتحسين الأصالة العلمية.', 'similarity' ),
);

$why_icons = array(
	'<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="8" r="5" /><path d="M20 21a8 8 0 1 0-16 0" /></svg>',
	'<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 11l3 3L22 4" /><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" /></svg>',
	'<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9" /><path d="M12 7v5l3 3" /></svg>',
	'<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="5" y="11" width="14" height="9" rx="2" /><path d="M8 11V7a4 4 0 0 1 8 0v4" /></svg>',
);

$default_tests = array(
	array( 'سارة العتيبي', 'طالبة ماجستير — إدارة أعمال', 'تعاملت مع توبرز في رسالة الماجستير، والفريق كان دقيقًا جدًا في المنهجية والتحليل الإحصائي. التزموا بالموعد تمامًا.', '0:45' ),
	array( 'محمد الحربي', 'باحث دكتوراه — علوم حاسب', 'خدمة الترجمة الأكاديمية كانت احترافية، والمصطلحات العلمية دقيقة جدًا مقارنة بمكاتب أخرى تعاملت معها سابقًا.', '1:12' ),
	array( 'نورة القحطاني', 'طالبة بكالوريوس', 'التواصل عبر واتساب سهّل عليّ متابعة بحث التخرج، وفريق الدعم كان متجاوبًا في كل مرحلة.', '0:30' ),
	array( 'أحمد الدوسري', 'باحث ماجستير', 'دعم مستمر وإجابة على جميع الاستفسارات بصدر رحب. تجربة ممتازة ولن تكون الأخيرة.', '0:55' ),
	array( 'د. ريم الخالدي', 'أستاذ مساعد', 'ساعدوني في نشر بحثي العلمي في مجلة محكمة بوقت قياسي. عمل احترافي بلا شك.', '1:05' ),
	array( 'ياسر المطيري', 'باحث دكتوراه', 'التدقيق اللغوي كان ممتازاً، لم أجد أي خطأ بعد استلام الملف. شكراً توبرز.', '0:40' ),
);
?>
<section class="hero-slider-wrapper">
	<div class="hero-slider" id="heroSlider">
		<?php foreach ( $hero_slides as $i => $slide ) :
			$img = $slide[0];
			?>
			<div class="hero-slide<?php echo 0 === $i ? ' is-active' : ''; ?> slide-<?php echo esc_attr( $i + 1 ); ?>">
				<div class="slide-bg" style="background-image: url('<?php echo esc_url( $img ); ?>');"></div>
				<div class="slide-overlay"></div>
				<div class="container slide-content center-content">
					<div class="eyebrow hero-eyebrow">
						<svg class="star-ic" viewBox="0 0 24 24" style="fill: var(--gold)"><path d="M12 0l2.9 8.4L24 12l-9.1 3.6L12 24l-2.9-8.4L0 12l9.1-3.6L12 0z" /></svg>
						<span><?php echo esc_html( $slide[1] ); ?></span>
					</div>
					<h1 class="hero-title"><?php echo esc_html( $slide[2] ); ?><br><span class="accent"><?php echo esc_html( $slide[3] ); ?></span></h1>
					<p class="hero-lede"><?php echo esc_html( $slide[4] ); ?></p>
					<div class="hero-cta center-flex">
						<?php foreach ( $slide[5] as $btn ) : ?>
							<a href="<?php echo esc_url( $btn[0] ); ?>" class="<?php echo esc_attr( $btn[2] ); ?>"<?php echo false !== strpos( $btn[2], 'outline' ) ? ' style="border-color: rgba(255,255,255,0.3); color: #fff;"' : ''; ?>><?php echo esc_html( $btn[1] ); ?></a>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<div class="slider-controls">
		<button class="slider-btn" id="sliderPrev" type="button">
			<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
		</button>
		<div class="slider-dots" id="sliderDots">
			<button class="slider-dot active" data-index="0" type="button"></button>
			<button class="slider-dot" data-index="1" type="button"></button>
			<button class="slider-dot" data-index="2" type="button"></button>
		</div>
		<button class="slider-btn" id="sliderNext" type="button">
			<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"></polyline></svg>
		</button>
	</div>
</section>

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
	</div>
</section>

<section class="section section--alt">
	<div class="container">
		<div class="section-head reveal">
			<div class="eyebrow"><?php echo toppers_star_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php echo esc_html( toppers_content( 'home_services_eyebrow', __( 'خدماتنا', 'toppers' ) ) ); ?></span></div>
			<h2><?php echo esc_html( toppers_content( 'home_services_title', __( 'كل ما تحتاجه رحلتك البحثية في مكان واحد', 'toppers' ) ) ); ?></h2>
			<p><?php echo esc_html( toppers_content( 'home_services_lede', __( 'من اختيار العنوان إلى النشر العلمي — نغطي المراحل الأكاديمية كافة بفريق متخصص لكل مجال.', 'toppers' ) ) ); ?></p>
		</div>
		<div class="grid grid-4 reveal-stagger reveal">
			<?php foreach ( $home_services as $svc ) : ?>
				<a href="<?php echo esc_url( toppers_service_url( $svc[0] ) ); ?>" class="service-card">
					<div class="sc-img">
						<img src="<?php echo esc_url( toppers_photo( $svc[2] ) ); ?>" alt="<?php echo esc_attr( $svc[0] ); ?>">
						<span class="sc-badge"><?php echo esc_html( $svc[0] ); ?></span>
					</div>
					<div class="sc-content">
						<h3><?php echo esc_html( $svc[0] ); ?></h3>
						<p><?php echo esc_html( $svc[1] ); ?></p>
						<span class="sc-link"><?php esc_html_e( 'اطلب هذه الخدمة', 'toppers' ); ?> <span class="arrow">&larr;</span></span>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
		<div class="center" style="margin-top:44px">
			<a href="<?php echo esc_url( toppers_page_url( 'services' ) ); ?>" class="btn btn-outline-dark"><?php esc_html_e( 'عرض كل الخدمات', 'toppers' ); ?></a>
		</div>
	</div>
</section>

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
				array( toppers_content( 'home_stat_1_num', '8' ), toppers_content( 'home_stat_1_suffix', '+' ), toppers_content( 'home_stat_1_label', 'سنوات من الخبرة' ) ),
				array( toppers_content( 'home_stat_2_num', '3200' ), toppers_content( 'home_stat_2_suffix', '+' ), toppers_content( 'home_stat_2_label', 'عميل تمت خدمتهم' ) ),
				array( toppers_content( 'home_stat_3_num', '1500' ), toppers_content( 'home_stat_3_suffix', '+' ), toppers_content( 'home_stat_3_label', 'بحث جامعي وماجستير' ) ),
				array( toppers_content( 'home_stat_4_num', '95' ), toppers_content( 'home_stat_4_suffix', '%' ), toppers_content( 'home_stat_4_label', 'نسبة رضا العملاء' ) ),
			);
			foreach ( $stats as $stat ) {
				echo '<div class="stat-item" style="text-align:center;"><div style="font-family:var(--f-display); font-size:46px; font-weight:800; color:var(--gold-light); line-height:1; text-shadow:0 0 20px rgba(201,154,59,0.3);"><span data-count="' . esc_attr( $stat[0] ) . '" data-suffix="' . esc_attr( $stat[1] ) . '">0</span></div><div style="font-size:13.5px; color:rgba(255,255,255,0.7); margin-top:10px; font-weight:600; text-transform:uppercase; letter-spacing:1px;">' . esc_html( $stat[2] ) . '</div></div>';
			}
			?>
		</div>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="section-head center reveal">
			<div class="eyebrow"><?php echo toppers_star_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php echo esc_html( toppers_content( 'home_testimonials_eyebrow', __( 'آراء عملائنا', 'toppers' ) ) ); ?></span></div>
			<h2><?php echo esc_html( toppers_content( 'home_testimonials_title', __( 'طلاب وباحثون وثقوا بنا في محطة مهمة من مسيرتهم', 'toppers' ) ) ); ?></h2>
		</div>
		<div class="grid grid-3 reveal-stagger reveal">
			<?php
			$tests = new WP_Query( array( 'post_type' => 'toppers_testimonial', 'posts_per_page' => 6, 'post_status' => 'publish' ) );
			if ( $tests->have_posts() ) {
				$i = 0;
				while ( $tests->have_posts() ) {
					$tests->the_post();
					$pid        = get_the_ID();
					$name       = get_the_title();
					$role       = get_post_meta( $pid, '_toppers_role', true ) ?: 'طالب باحث';
					$quote      = wp_strip_all_tags( get_the_content() );
					$raw_type   = get_post_meta( $pid, '_toppers_testimonial_type', true ) ?: 'voice';
					$type       = in_array( $raw_type, array( 'image', 'whatsapp', 'photo' ), true ) ? 'image' : $raw_type;
					$stars      = max( 1, min( 5, (int) get_post_meta( $pid, '_toppers_stars', true ) ?: 5 ) );
					$star_str   = str_repeat( '★', $stars );
					$audio_id   = (int) get_post_meta( $pid, '_toppers_audio_id', true );
					$audio_url  = $audio_id ? wp_get_attachment_url( $audio_id ) : '';
					$audio_time = get_post_meta( $pid, '_toppers_audio_time', true ) ?: '0:45';

					$screen_id  = (int) get_post_meta( $pid, '_toppers_screenshot_id', true );
					if ( ! $screen_id ) {
						$screen_id = get_post_thumbnail_id( $pid );
					}
					$screen_thumb = $screen_id ? wp_get_attachment_image_url( $screen_id, 'large' ) : '';
					$screen_full  = $screen_id ? wp_get_attachment_image_url( $screen_id, 'full' ) : $screen_thumb;

					echo '<div class="t-card" data-type="' . esc_attr( $type ) . '">';
					if ( 'voice' === $type ) {
						echo '<span class="media-badge">' . esc_html__( '🎙️ رسالة صوتية', 'toppers' ) . '</span>';
						echo '<div class="t-stars">' . esc_html( $star_str ) . '</div>';
						echo toppers_audio_player( $audio_url, $audio_time ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						if ( $quote ) {
							echo '<p class="t-quote">' . esc_html( $quote ) . '</p>';
						}
					} elseif ( 'image' === $type && $screen_thumb ) {
						echo '<span class="media-badge">' . esc_html__( '📸 سكرين شوت', 'toppers' ) . '</span>';
						echo '<div class="t-screenshot-wrap" data-full-image="' . esc_url( $screen_full ) . '" title="' . esc_attr__( 'انقر لتكبير السكرين شوت', 'toppers' ) . '">';
						echo '<img src="' . esc_url( $screen_thumb ) . '" alt="' . esc_attr( $name ) . '" class="t-screenshot-img">';
						echo '<div class="t-zoom-overlay"><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg><span>' . esc_html__( 'تكبير', 'toppers' ) . '</span></div>';
						echo '</div>';
						echo '<div class="t-stars" style="margin-top:10px;">' . esc_html( $star_str ) . '</div>';
						if ( $quote ) {
							echo '<p class="t-quote">' . esc_html( $quote ) . '</p>';
						}
					} else {
						echo '<span class="media-badge">' . esc_html__( '✍️ رأي نصي', 'toppers' ) . '</span>';
						echo '<div class="t-stars">' . esc_html( $star_str ) . '</div>';
						echo '<p class="t-quote" style="margin-top:6px;">' . esc_html( $quote ) . '</p>';
					}
					echo '<div class="t-who"><div class="t-avatar">' . esc_html( toppers_first_letter( $name ) ) . '</div><div><b>' . esc_html( $name ) . '</b><span>' . esc_html( $role ) . '</span></div></div>';
					echo '</div>';
					$i++;
				}
				wp_reset_postdata();
			} else {
				foreach ( $default_tests as $row ) {
					echo '<div class="t-card"><span class="media-badge">' . esc_html__( '🎙️ رسالة صوتية', 'toppers' ) . '</span><div class="t-stars">★★★★★</div>' . toppers_audio_player( '', $row[3] ) . '<p class="t-quote">' . esc_html( $row[2] ) . '</p><div class="t-who"><div class="t-avatar">' . esc_html( toppers_first_letter( $row[0] ) ) . '</div><div><b>' . esc_html( $row[0] ) . '</b><span>' . esc_html( $row[1] ) . '</span></div></div></div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			}
			?>
		</div>
		<div style="text-align:center; margin-top: 36px;" class="reveal">
			<a href="<?php echo esc_url( toppers_page_url( 'testimonials' ) ); ?>" class="btn btn-outline"><?php esc_html_e( 'عرض كافة آراء الطلاب وتجاربهم', 'toppers' ); ?></a>
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

<section class="section section--alt">
	<div class="container">
		<div class="section-head center reveal">
			<div class="eyebrow"><?php echo toppers_star_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php echo esc_html( toppers_content( 'home_blog_eyebrow', __( 'أحدث المقالات', 'toppers' ) ) ); ?></span></div>
			<h2><?php echo esc_html( toppers_content( 'home_blog_title', __( 'مدونة توبرز الأكاديمية', 'toppers' ) ) ); ?></h2>
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
			<a href="<?php echo esc_url( toppers_blog_url() ); ?>" class="btn btn-outline"><?php esc_html_e( 'عرض كل المقالات', 'toppers' ); ?></a>
		</div>
	</div>
</section>

<section class="section--tight">
	<div class="container">
		<div class="cta-band reveal">
			<h2><?php echo esc_html( toppers_content( 'home_cta_title', __( 'جاهز لبدء رحلتك البحثية؟', 'toppers' ) ) ); ?></h2>
			<p><?php echo esc_html( toppers_content( 'home_cta_lede', __( 'أرسل تفاصيل مشروعك الآن واحصل على استشارة أولية وعرض سعر مجاني خلال ساعات.', 'toppers' ) ) ); ?></p>
			<div class="cta-actions">
				<a href="<?php echo esc_url( toppers_page_url( 'contact' ) ); ?>" class="btn btn-gold"><?php esc_html_e( 'اطلب خدمتك', 'toppers' ); ?></a>
				<a href="<?php echo esc_url( toppers_whatsapp_url() ); ?>" target="_blank" rel="noopener" class="btn btn-outline"><?php esc_html_e( 'تواصل عبر واتساب', 'toppers' ); ?></a>
			</div>
		</div>
	</div>
</section>
