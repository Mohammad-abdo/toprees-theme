<?php
/**
 * Homepage sections — exact markup from original home.html.
 * All strings use WordPress i18n so WPML / Polylang / TranslatePress / Loco can translate them.
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$services_url = get_post_type_archive_link( 'tk_service' );
$contact_url  = home_url( '/contact/' );
$contact_page = get_page_by_path( 'contact' );
if ( $contact_page ) {
	$contact_url = get_permalink( $contact_page );
}
$wa_url    = tk_whatsapp_url();
$blog_url  = get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url( '/blog/' );
$star      = tk_star_svg();
?>

<!-- ================= HERO SLIDER (FULLSCREEN) ================= -->
<section class="hero-slider-wrapper">
	<div class="hero-slider" id="heroSlider">

		<div class="hero-slide is-active slide-1">
			<div class="slide-bg" style="background-image: url('https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&q=80&w=1920');"></div>
			<div class="slide-overlay"></div>
			<div class="container slide-content center-content">
				<div class="eyebrow hero-eyebrow">
					<?php echo $star; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<span><?php esc_html_e( 'توبرز للاستشارات والحلول البحثية', 'tek-craft-toppres' ); ?></span>
				</div>
				<h1 class="hero-title">
					<?php esc_html_e( 'من فكرة البحث', 'tek-craft-toppres' ); ?><br>
					<span class="accent"><?php esc_html_e( 'إلى التسليم النهائي', 'tek-craft-toppres' ); ?></span>
				</h1>
				<p class="hero-lede"><?php esc_html_e( 'نرافق طلاب البكالوريوس والماجستير والدكتوراه والباحثين في كل محطة من رحلتهم الأكاديمية؛ بدقة علمية، ومواعيد تُحترم.', 'tek-craft-toppres' ); ?></p>
				<div class="hero-cta center-flex">
					<a href="<?php echo esc_url( $contact_url ); ?>" class="btn btn-gold"><?php esc_html_e( 'اطلب خدمتك الآن', 'tek-craft-toppres' ); ?></a>
					<a href="<?php echo esc_url( $services_url ); ?>" class="btn btn-outline" style="border-color: rgba(255,255,255,0.3); color: #fff;"><?php esc_html_e( 'تصفح الخدمات', 'tek-craft-toppres' ); ?></a>
				</div>
			</div>
		</div>

		<div class="hero-slide slide-2">
			<div class="slide-bg" style="background-image: url('https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&q=80&w=1920');"></div>
			<div class="slide-overlay"></div>
			<div class="container slide-content center-content">
				<div class="eyebrow hero-eyebrow">
					<?php echo $star; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<span><?php esc_html_e( 'أعلى معايير الجودة', 'tek-craft-toppres' ); ?></span>
				</div>
				<h1 class="hero-title">
					<?php esc_html_e( 'رسائل الماجستير', 'tek-craft-toppres' ); ?><br>
					<span class="accent"><?php esc_html_e( 'بمنهجية دقيقة', 'tek-craft-toppres' ); ?></span>
				</h1>
				<p class="hero-lede"><?php esc_html_e( 'دعم شامل للباحثين من اقتراح العنوان وحتى المناقشة، مع ضمان الجودة والسرية التامة لجميع البيانات.', 'tek-craft-toppres' ); ?></p>
				<div class="hero-cta center-flex">
					<a href="<?php echo esc_url( $services_url ); ?>" class="btn btn-gold"><?php esc_html_e( 'عرض الخدمة', 'tek-craft-toppres' ); ?></a>
				</div>
			</div>
		</div>

		<div class="hero-slide slide-3">
			<div class="slide-bg" style="background-image: url('https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&q=80&w=1920');"></div>
			<div class="slide-overlay"></div>
			<div class="container slide-content center-content">
				<div class="eyebrow hero-eyebrow">
					<?php echo $star; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<span><?php esc_html_e( 'دعم إحصائي ولغوي', 'tek-craft-toppres' ); ?></span>
				</div>
				<h1 class="hero-title">
					<?php esc_html_e( 'التحليل الإحصائي', 'tek-craft-toppres' ); ?><br>
					<span class="accent"><?php esc_html_e( 'والترجمة الاحترافية', 'tek-craft-toppres' ); ?></span>
				</h1>
				<p class="hero-lede"><?php esc_html_e( 'نستخدم أحدث البرامج الإحصائية لتحليل بيانات بحثك، ونقدم ترجمة أكاديمية معتمدة تدعم وصول بحثك للعالمية.', 'tek-craft-toppres' ); ?></p>
				<div class="hero-cta center-flex">
					<a href="<?php echo esc_url( $contact_url ); ?>" class="btn btn-gold"><?php esc_html_e( 'تواصل معنا', 'tek-craft-toppres' ); ?></a>
				</div>
			</div>
		</div>

	</div>

	<div class="slider-controls">
		<button class="slider-btn" id="sliderPrev" type="button" aria-label="<?php esc_attr_e( 'السابق', 'tek-craft-toppres' ); ?>">
			<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
		</button>
		<div class="slider-dots" id="sliderDots">
			<button class="slider-dot active" type="button" data-index="0" aria-label="1"></button>
			<button class="slider-dot" type="button" data-index="1" aria-label="2"></button>
			<button class="slider-dot" type="button" data-index="2" aria-label="3"></button>
		</div>
		<button class="slider-btn" id="sliderNext" type="button" aria-label="<?php esc_attr_e( 'التالي', 'tek-craft-toppres' ); ?>">
			<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"></polyline></svg>
		</button>
	</div>
</section>

<!-- ================= JOURNEY ================= -->
<section class="section">
	<div class="container">
		<div class="section-head center reveal">
			<div class="eyebrow"><?php echo $star; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'كيف نعمل', 'tek-craft-toppres' ); ?></span></div>
			<h2><?php esc_html_e( 'رحلة طلب واضحة من أول تواصل حتى التسليم', 'tek-craft-toppres' ); ?></h2>
		</div>
		<div class="journey reveal-stagger reveal">
			<?php
			$steps = array(
				array( __( 'التواصل', 'tek-craft-toppres' ), __( 'تخبرنا بمتطلبات بحثك عبر الموقع أو واتساب.', 'tek-craft-toppres' ) ),
				array( __( 'دراسة الطلب', 'tek-craft-toppres' ), __( 'نراجع التفاصيل ونحدد التخصص المناسب.', 'tek-craft-toppres' ) ),
				array( __( 'عرض السعر', 'tek-craft-toppres' ), __( 'نرسل لك سعرًا واضحًا ومدة تسليم محددة.', 'tek-craft-toppres' ) ),
				array( __( 'التنفيذ', 'tek-craft-toppres' ), __( 'يبدأ الباحث المتخصص العمل على طلبك.', 'tek-craft-toppres' ) ),
				array( __( 'مراجعة الجودة', 'tek-craft-toppres' ), __( 'فحص علمي ولغوي وتدقيق تشابه قبل التسليم.', 'tek-craft-toppres' ) ),
				array( __( 'التسليم', 'tek-craft-toppres' ), __( 'تستلم عملك مع إمكانية طلب تعديلات.', 'tek-craft-toppres' ) ),
			);
			foreach ( $steps as $i => $step ) :
				?>
				<div class="journey-step">
					<div class="journey-num"><?php echo esc_html( (string) ( $i + 1 ) ); ?></div>
					<h4><?php echo esc_html( $step[0] ); ?></h4>
					<p><?php echo esc_html( $step[1] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ================= SERVICES PREVIEW ================= -->
<section class="section section--alt">
	<div class="container">
		<div class="section-head reveal">
			<div class="eyebrow"><?php echo $star; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'خدماتنا', 'tek-craft-toppres' ); ?></span></div>
			<h2><?php esc_html_e( 'كل ما تحتاجه رحلتك البحثية في مكان واحد', 'tek-craft-toppres' ); ?></h2>
			<p><?php esc_html_e( 'من اختيار العنوان إلى النشر العلمي — نغطي المراحل الأكاديمية كافة بفريق متخصص لكل مجال.', 'tek-craft-toppres' ); ?></p>
		</div>
		<div class="grid grid-4 reveal-stagger reveal">
			<?php
			$svc_cards = array(
				array(
					'img'   => 'https://images.unsplash.com/photo-1488190211105-8b0e65b80b4e?auto=format&fit=crop&q=80&w=600&h=400',
					'title' => __( 'البحوث الجامعية', 'tek-craft-toppres' ),
					'desc'  => __( 'إعداد بحوث جامعية بمنهجية علمية دقيقة تناسب متطلبات كل مقرر.', 'tek-craft-toppres' ),
				),
				array(
					'img'   => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&q=80&w=600&h=400',
					'title' => __( 'رسائل الماجستير', 'tek-craft-toppres' ),
					'desc'  => __( 'مرافقة كاملة من اختيار العنوان حتى المناقشة والتنسيق النهائي.', 'tek-craft-toppres' ),
				),
				array(
					'img'   => 'https://images.unsplash.com/photo-1513258496099-48168024aec0?auto=format&fit=crop&q=80&w=600&h=400',
					'title' => __( 'أطروحات الدكتوراه', 'tek-craft-toppres' ),
					'desc'  => __( 'دعم بحثي متقدم للباحثين في مراحل الدكتوراه المختلفة.', 'tek-craft-toppres' ),
				),
				array(
					'img'   => 'https://images.unsplash.com/photo-1488190211105-8b0e65b80b4e?auto=format&fit=crop&q=80&w=600&h=400',
					'title' => __( 'التحليل الإحصائي', 'tek-craft-toppres' ),
					'desc'  => __( 'تحليل بيانات البحث باستخدام البرامج الإحصائية المناسبة.', 'tek-craft-toppres' ),
				),
				array(
					'img'   => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&q=80&w=600&h=400',
					'title' => __( 'خطة البحث والمقترح', 'tek-craft-toppres' ),
					'desc'  => __( 'صياغة مقترح بحثي متكامل يحدد مشكلة البحث وأهدافه ومنهجيته.', 'tek-craft-toppres' ),
				),
				array(
					'img'   => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&q=80&w=600&h=400',
					'title' => __( 'الترجمة الأكاديمية', 'tek-craft-toppres' ),
					'desc'  => __( 'ترجمة دقيقة للأبحاث والمصادر بين العربية ولغات البحث العلمي.', 'tek-craft-toppres' ),
				),
				array(
					'img'   => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&q=80&w=600&h=400',
					'title' => __( 'التدقيق اللغوي', 'tek-craft-toppres' ),
					'desc'  => __( 'مراجعة لغوية شاملة لرسائل الماجستير والدكتوراه والأبحاث.', 'tek-craft-toppres' ),
				),
				array(
					'img'   => 'https://images.unsplash.com/photo-1513258496099-48168024aec0?auto=format&fit=crop&q=80&w=600&h=400',
					'title' => __( 'فحص نسبة الاقتباس', 'tek-craft-toppres' ),
					'desc'  => __( 'تقرير دقيق لنسبة التشابه مع توصيات لتحسين الأصالة العلمية.', 'tek-craft-toppres' ),
				),
			);

			// Prefer live Services CPT when published items exist.
			$live_services = get_posts(
				array(
					'post_type'      => 'tk_service',
					'posts_per_page' => 8,
					'post_status'    => 'publish',
				)
			);

			if ( $live_services ) :
				foreach ( $live_services as $service ) :
					$thumb = get_the_post_thumbnail_url( $service, 'tk-card' );
					if ( ! $thumb ) {
						$thumb = $svc_cards[0]['img'];
					}
					?>
					<div class="service-card">
						<div class="sc-img">
							<img src="<?php echo esc_url( $thumb ); ?>" alt="<?php echo esc_attr( get_the_title( $service ) ); ?>" loading="lazy" width="600" height="400">
							<span class="sc-badge"><?php echo esc_html( get_the_title( $service ) ); ?></span>
						</div>
						<div class="sc-content">
							<h3><?php echo esc_html( get_the_title( $service ) ); ?></h3>
							<p><?php echo esc_html( get_the_excerpt( $service ) ); ?></p>
							<a href="<?php echo esc_url( get_permalink( $service ) ); ?>" class="sc-link"><span><?php esc_html_e( 'اطلب هذه الخدمة', 'tek-craft-toppres' ); ?></span> <span class="arrow">&larr;</span></a>
						</div>
					</div>
					<?php
				endforeach;
			else :
				foreach ( $svc_cards as $card ) :
					?>
					<div class="service-card">
						<div class="sc-img">
							<img src="<?php echo esc_url( $card['img'] ); ?>" alt="<?php echo esc_attr( $card['title'] ); ?>" loading="lazy" width="600" height="400">
							<span class="sc-badge"><?php echo esc_html( $card['title'] ); ?></span>
						</div>
						<div class="sc-content">
							<h3><?php echo esc_html( $card['title'] ); ?></h3>
							<p><?php echo esc_html( $card['desc'] ); ?></p>
							<a href="<?php echo esc_url( $services_url ); ?>" class="sc-link"><span><?php esc_html_e( 'اطلب هذه الخدمة', 'tek-craft-toppres' ); ?></span> <span class="arrow">&larr;</span></a>
						</div>
					</div>
					<?php
				endforeach;
			endif;
			?>
		</div>
		<div class="center" style="margin-top:44px">
			<a href="<?php echo esc_url( $services_url ); ?>" class="btn btn-outline-dark"><?php esc_html_e( 'عرض كل الخدمات', 'tek-craft-toppres' ); ?></a>
		</div>
	</div>
</section>

<!-- ================= WHY US ================= -->
<section class="section section--navy" style="position:relative; overflow:hidden;">
	<div style="position:absolute; top:-20%; right:-10%; width:600px; height:600px; background:radial-gradient(circle, rgba(201,154,59,0.15) 0%, transparent 60%); border-radius:50%; filter:blur(60px); pointer-events:none;"></div>
	<div style="position:absolute; bottom:-20%; left:-10%; width:600px; height:600px; background:radial-gradient(circle, rgba(28,47,94,0.6) 0%, transparent 60%); border-radius:50%; filter:blur(60px); pointer-events:none;"></div>

	<div class="container" style="position:relative; z-index:2;">
		<div class="section-head center reveal" style="margin-bottom:64px;">
			<div class="eyebrow" style="color:var(--gold-light); justify-content:center; display:flex; gap:12px;">
				<?php echo $star; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<span><?php esc_html_e( 'لماذا توبرز', 'tek-craft-toppres' ); ?></span>
				<?php echo $star; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
			<h2 style="font-size:clamp(32px, 4vw, 44px); margin-top:16px; background:linear-gradient(to left, #ffffff, #e0e0e0); -webkit-background-clip:text; -webkit-text-fill-color:transparent; display:inline-block;"><?php esc_html_e( 'شريكك الأكاديمي من الفكرة حتى النشر', 'tek-craft-toppres' ); ?></h2>
			<p style="color:rgba(255,255,255,0.7); max-width:640px; margin:20px auto 0; font-size:16px; line-height:1.7;"><?php esc_html_e( 'نقدم لك دعماً بحثياً متكاملاً بمعايير عالمية لضمان نجاحك الأكاديمي بكل احترافية وسرية تامة، لنكون شركاء في رحلتك نحو التميز.', 'tek-craft-toppres' ); ?></p>
		</div>

		<div class="grid grid-4 reveal-stagger reveal">
			<div class="why-card">
				<div class="why-card-ic">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="8" r="5" /><path d="M20 21a8 8 0 1 0-16 0" /></svg>
				</div>
				<h3><?php esc_html_e( 'فريق متخصص', 'tek-craft-toppres' ); ?></h3>
				<p><?php esc_html_e( 'باحثون وخبراء إحصاء ولغويون في مختلف التخصصات العلمية.', 'tek-craft-toppres' ); ?></p>
			</div>
			<div class="why-card" style="transition-delay:0.1s;">
				<div class="why-card-ic">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 11l3 3L22 4" /><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" /></svg>
				</div>
				<h3><?php esc_html_e( 'دقة علمية', 'tek-craft-toppres' ); ?></h3>
				<p><?php esc_html_e( 'التزام صارم بالمنهجية العلمية والمعايير الأكاديمية المعتمدة.', 'tek-craft-toppres' ); ?></p>
			</div>
			<div class="why-card" style="transition-delay:0.2s;">
				<div class="why-card-ic">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9" /><path d="M12 7v5l3 3" /></svg>
				</div>
				<h3><?php esc_html_e( 'مواعيد تُحترم', 'tek-craft-toppres' ); ?></h3>
				<p><?php esc_html_e( 'تسليم في الوقت المتفق عليه دون تأخير أو مفاجآت.', 'tek-craft-toppres' ); ?></p>
			</div>
			<div class="why-card" style="transition-delay:0.3s;">
				<div class="why-card-ic">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="5" y="11" width="14" height="9" rx="2" /><path d="M8 11V7a4 4 0 0 1 8 0v4" /></svg>
				</div>
				<h3><?php esc_html_e( 'سرية تامة', 'tek-craft-toppres' ); ?></h3>
				<p><?php esc_html_e( 'بياناتك وملفاتك محمية ولا يطّلع عليها سوى الفريق المكلف.', 'tek-craft-toppres' ); ?></p>
			</div>
		</div>

		<div class="why-stats reveal" style="margin-top:64px; display:flex; justify-content:space-around; align-items:center; background:rgba(255,255,255,0.02); border:1px solid rgba(255,255,255,0.08); padding:36px 20px; border-radius:24px; backdrop-filter:blur(16px); box-shadow:0 20px 40px -10px rgba(0,0,0,0.2);">
			<div class="stat-item" style="text-align:center;">
				<div style="font-family:var(--f-display); font-size:46px; font-weight:800; color:var(--gold-light); line-height:1; text-shadow:0 0 20px rgba(201,154,59,0.3);"><span data-count="8" data-suffix="+">0</span></div>
				<div style="font-size:13.5px; color:rgba(255,255,255,0.7); margin-top:10px; font-weight:600; text-transform:uppercase; letter-spacing:1px;"><?php esc_html_e( 'سنوات من الخبرة', 'tek-craft-toppres' ); ?></div>
			</div>
			<div class="stat-item" style="text-align:center;">
				<div style="font-family:var(--f-display); font-size:46px; font-weight:800; color:var(--gold-light); line-height:1; text-shadow:0 0 20px rgba(201,154,59,0.3);"><span data-count="3200" data-suffix="+">0</span></div>
				<div style="font-size:13.5px; color:rgba(255,255,255,0.7); margin-top:10px; font-weight:600; text-transform:uppercase; letter-spacing:1px;"><?php esc_html_e( 'عميل تمت خدمتهم', 'tek-craft-toppres' ); ?></div>
			</div>
			<div class="stat-item" style="text-align:center;">
				<div style="font-family:var(--f-display); font-size:46px; font-weight:800; color:var(--gold-light); line-height:1; text-shadow:0 0 20px rgba(201,154,59,0.3);"><span data-count="1500" data-suffix="+">0</span></div>
				<div style="font-size:13.5px; color:rgba(255,255,255,0.7); margin-top:10px; font-weight:600; text-transform:uppercase; letter-spacing:1px;"><?php esc_html_e( 'بحث جامعي وماجستير', 'tek-craft-toppres' ); ?></div>
			</div>
			<div class="stat-item" style="text-align:center;">
				<div style="font-family:var(--f-display); font-size:46px; font-weight:800; color:var(--gold-light); line-height:1; text-shadow:0 0 20px rgba(201,154,59,0.3);"><span data-count="95" data-suffix="%">0</span></div>
				<div style="font-size:13.5px; color:rgba(255,255,255,0.7); margin-top:10px; font-weight:600; text-transform:uppercase; letter-spacing:1px;"><?php esc_html_e( 'نسبة رضا العملاء', 'tek-craft-toppres' ); ?></div>
			</div>
		</div>
	</div>
</section>

<!-- ================= TESTIMONIALS ================= -->
<section class="section">
	<div class="container">
		<div class="section-head center reveal">
			<div class="eyebrow"><?php echo $star; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'آراء عملائنا', 'tek-craft-toppres' ); ?></span></div>
			<h2><?php esc_html_e( 'طلاب وباحثون وثقوا بنا في محطة مهمة من مسيرتهم', 'tek-craft-toppres' ); ?></h2>
		</div>
		<div class="grid grid-3 reveal-stagger reveal">
			<?php
			$testimonials = array(
				array( 'س', __( 'تعاملت مع توبرز في رسالة الماجستير، والفريق كان دقيقًا جدًا في المنهجية والتحليل الإحصائي. التزموا بالموعد تمامًا.', 'tek-craft-toppres' ), __( 'سارة العتيبي', 'tek-craft-toppres' ), __( 'طالبة ماجستير — إدارة أعمال', 'tek-craft-toppres' ), '0:45' ),
				array( 'م', __( 'خدمة الترجمة الأكاديمية كانت احترافية، والمصطلحات العلمية دقيقة جدًا مقارنة بمكاتب أخرى تعاملت معها سابقًا.', 'tek-craft-toppres' ), __( 'محمد الحربي', 'tek-craft-toppres' ), __( 'باحث دكتوراه — علوم حاسب', 'tek-craft-toppres' ), '1:12' ),
				array( 'ن', __( 'التواصل عبر واتساب سهّل عليّ متابعة بحث التخرج، وفريق الدعم كان متجاوبًا في كل مرحلة.', 'tek-craft-toppres' ), __( 'نورة القحطاني', 'tek-craft-toppres' ), __( 'طالبة بكالوريوس', 'tek-craft-toppres' ), '0:30' ),
				array( 'أ', __( 'دعم مستمر وإجابة على جميع الاستفسارات بصدر رحب. تجربة ممتازة ولن تكون الأخيرة.', 'tek-craft-toppres' ), __( 'أحمد الدوسري', 'tek-craft-toppres' ), __( 'باحث ماجستير', 'tek-craft-toppres' ), '0:55' ),
				array( 'ر', __( 'ساعدوني في نشر بحثي العلمي في مجلة محكمة بوقت قياسي. عمل احترافي بلا شك.', 'tek-craft-toppres' ), __( 'د. ريم الخالدي', 'tek-craft-toppres' ), __( 'أستاذ مساعد', 'tek-craft-toppres' ), '1:05' ),
				array( 'ي', __( 'التدقيق اللغوي كان ممتازاً، لم أجد أي خطأ بعد استلام الملف. شكراً توبرز.', 'tek-craft-toppres' ), __( 'ياسر المطيري', 'tek-craft-toppres' ), __( 'باحث دكتوراه', 'tek-craft-toppres' ), '0:40' ),
			);
			foreach ( $testimonials as $t ) :
				?>
				<div class="t-card">
					<div class="t-stars">★★★★★</div>
					<div class="voice-note">
						<button class="vn-play" type="button" aria-label="<?php esc_attr_e( 'تشغيل', 'tek-craft-toppres' ); ?>"><svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor"><path d="M8 5v14l11-7z" /></svg></button>
						<div class="vn-wave"><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span></div>
						<span class="vn-time"><?php echo esc_html( $t[4] ); ?></span>
					</div>
					<p class="t-quote"><?php echo esc_html( $t[1] ); ?></p>
					<div class="t-who">
						<div class="t-avatar"><?php echo esc_html( $t[0] ); ?></div>
						<div><b><?php echo esc_html( $t[2] ); ?></b><span><?php echo esc_html( $t[3] ); ?></span></div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ================= ARTICLES ================= -->
<section class="section section--alt">
	<div class="container">
		<div class="section-head center reveal">
			<div class="eyebrow"><?php echo $star; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'أحدث المقالات', 'tek-craft-toppres' ); ?></span></div>
			<h2><?php esc_html_e( 'مدونة توبرز الأكاديمية', 'tek-craft-toppres' ); ?></h2>
			<p style="max-width: 600px; margin: 15px auto 0;"><?php esc_html_e( 'نشاركك أفضل الممارسات والنصائح لإعداد الأبحاث والرسائل العلمية بمنهجية صحيحة.', 'tek-craft-toppres' ); ?></p>
		</div>
		<div class="grid grid-3 reveal-stagger reveal">
			<?php
			$recent = new WP_Query(
				array(
					'posts_per_page' => 3,
					'post_status'    => 'publish',
					'ignore_sticky_posts' => true,
				)
			);

			if ( $recent->have_posts() ) :
				while ( $recent->have_posts() ) :
					$recent->the_post();
					$cat = get_the_category();
					$badge = $cat ? $cat[0]->name : __( 'مقال', 'tek-craft-toppres' );
					$thumb = get_the_post_thumbnail_url( get_the_ID(), 'tk-card' );
					if ( ! $thumb ) {
						$thumb = 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&q=80&w=600&h=400';
					}
					?>
					<a href="<?php the_permalink(); ?>" class="article-card">
						<div class="ac-img">
							<img src="<?php echo esc_url( $thumb ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" width="600" height="400">
							<span class="ac-badge"><?php echo esc_html( $badge ); ?></span>
						</div>
						<div class="ac-content">
							<div class="ac-meta"><span><?php echo esc_html( get_the_date() ); ?></span></div>
							<h3><?php the_title(); ?></h3>
							<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
							<span class="ac-link"><?php esc_html_e( 'اقرأ المزيد', 'tek-craft-toppres' ); ?> &larr;</span>
						</div>
					</a>
					<?php
				endwhile;
				wp_reset_postdata();
			else :
				$demo_posts = array(
					array( 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&q=80&w=600&h=400', __( 'نصائح أكاديمية', 'tek-craft-toppres' ), __( 'كيفية اختيار موضوع رسالة الماجستير خطوة بخطوة', 'tek-craft-toppres' ), __( 'دليل شامل يوضح لك أهم المعايير والخطوات لاختيار موضوع بحثي متميز يضيف قيمة علمية في مجال تخصصك.', 'tek-craft-toppres' ) ),
					array( 'https://images.unsplash.com/photo-1513258496099-48168024aec0?auto=format&fit=crop&q=80&w=600&h=400', __( 'التحليل الإحصائي', 'tek-craft-toppres' ), __( 'أهمية برنامج SPSS في تحليل بيانات البحث العلمي', 'tek-craft-toppres' ), __( 'تعرف على أساسيات التحليل الإحصائي باستخدام برنامج SPSS وكيف يمكنه مساعدتك في استخراج نتائج دقيقة لبحثك.', 'tek-craft-toppres' ) ),
					array( 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&q=80&w=600&h=400', __( 'النشر العلمي', 'tek-craft-toppres' ), __( 'معايير قبول الأبحاث في المجلات العلمية المحكمة', 'tek-craft-toppres' ), __( 'اكتشف أهم النقاط التي يركز عليها المحكمون عند مراجعة بحثك لتجنب الرفض وزيادة فرص قبول نشر ورقتك العلمية.', 'tek-craft-toppres' ) ),
				);
				foreach ( $demo_posts as $p ) :
					?>
					<a href="<?php echo esc_url( $blog_url ); ?>" class="article-card">
						<div class="ac-img">
							<img src="<?php echo esc_url( $p[0] ); ?>" alt="" loading="lazy" width="600" height="400">
							<span class="ac-badge"><?php echo esc_html( $p[1] ); ?></span>
						</div>
						<div class="ac-content">
							<h3><?php echo esc_html( $p[2] ); ?></h3>
							<p><?php echo esc_html( $p[3] ); ?></p>
							<span class="ac-link"><?php esc_html_e( 'اقرأ المزيد', 'tek-craft-toppres' ); ?> &larr;</span>
						</div>
					</a>
					<?php
				endforeach;
			endif;
			?>
		</div>
		<div style="text-align:center; margin-top: 40px;" class="reveal">
			<a href="<?php echo esc_url( $blog_url ); ?>" class="btn btn-outline"><?php esc_html_e( 'عرض كل المقالات', 'tek-craft-toppres' ); ?></a>
		</div>
	</div>
</section>

<!-- ================= CTA ================= -->
<section class="section--tight">
	<div class="container">
		<div class="cta-band reveal">
			<h2><?php esc_html_e( 'جاهز لبدء رحلتك البحثية؟', 'tek-craft-toppres' ); ?></h2>
			<p><?php esc_html_e( 'أرسل تفاصيل مشروعك الآن واحصل على استشارة أولية وعرض سعر مجاني خلال ساعات.', 'tek-craft-toppres' ); ?></p>
			<div class="cta-actions">
				<a href="<?php echo esc_url( $contact_url ); ?>" class="btn btn-gold"><?php esc_html_e( 'اطلب خدمتك', 'tek-craft-toppres' ); ?></a>
				<?php if ( $wa_url ) : ?>
					<a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-outline"><?php esc_html_e( 'تواصل عبر واتساب', 'tek-craft-toppres' ); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
