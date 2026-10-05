<?php
/**
 * Template Name: آراء الطلاب
 *
 * @package Toppers
 */

get_header();

$defaults = array(
	array(
		'role'       => 'طالبة ماجستير — إدارة أعمال',
		'quote'      => 'رسالة صوتية عن تجربتي مع توبرز في الإطار النظري والتحليل الإحصائي.',
		'type'       => 'voice',
		'audio_url'  => '',
		'audio_time' => '0:48',
		'stars'      => 5,
	),
	array(
		'role'       => 'باحث دكتوراه — مناهج وطرق تدريس',
		'quote'      => 'تسجيل صوتي عن احترافية الفريق وسرعة الاستجابة.',
		'type'       => 'voice',
		'audio_url'  => '',
		'audio_time' => '1:05',
		'stars'      => 5,
	),
	array(
		'role'      => 'باحث دكتوراه — علوم تربوية',
		'quote'     => 'فريق عمل احترافي ساعدني في تحكيم أدوات الدراسة ومطابقته مع دليل الجامعة المعتمد.',
		'type'      => 'video',
		'video_url' => 'https://youtu.be/dujo3xmx0ME',
		'stars'     => 5,
	),
	array(
		'role'  => 'أستاذ مساعد — دراسات إسلامية',
		'quote' => 'قبول ونشر البحث العلمي في مجلة محكمة ومصنفة دولياً خلال فترة قياسية.',
		'type'  => 'image',
		'chat'  => array(
			'مبروك دكتور، تم قبول البحث ونشره في المجلة المحكمة رسمياً.',
			'ما شاء الله تبارك الله، ألف شكر لفريق توبرز على الدقة والاحترافية.',
		),
		'stars' => 5,
	),
	array(
		'role'  => 'طالبة بكالوريوس — علوم حاسب',
		'quote' => 'تقرير فحص نسبة الاقتباس بنسبة 3% فقط بعد التدقيق والصياغة.',
		'type'  => 'image',
		'chat'  => array(
			'مرحباً، تم الانتهاء من فحص الاقتباس والتقرير معتمد بنسبة 3% فقط.',
			'جزاكم الله خيراً، الشغل ممتاز والدكتور اعتمد البحث مباشرة.',
		),
		'stars' => 5,
	),
	array(
		'role'  => 'باحث ماجستير — قانون عام',
		'quote' => 'التدقيق اللغوي والمراجعة المنهجية كانت على أعلى مستوى من الرصانة.',
		'type'  => 'text',
		'stars' => 5,
	),
);

$testimonials_query = new WP_Query(
	array(
		'post_type'      => 'toppers_testimonial',
		'posts_per_page' => -1,
		'post_status'    => 'publish',
	)
);

/**
 * Render a testimonial card.
 *
 * @param array $item Normalized item.
 */
$render_testimonial_card = static function ( $item ) {
	$type         = $item['type'];
	$display_name = $item['name'];
	$role         = $item['role'];
	$quote        = $item['quote'];
	$stars        = (int) $item['stars'];
	$star_str     = str_repeat( '<i class="fa-solid fa-star" aria-hidden="true"></i>', $stars );
	$badge_map    = array(
		'voice' => array( 'fa-solid fa-microphone-lines', __( 'رسالة صوتية', 'toppers' ), 'is-voice' ),
		'video' => array( 'fa-brands fa-youtube', __( 'فيديو تجربة', 'toppers' ), 'is-video' ),
		'image' => array( 'fa-solid fa-camera', __( 'سكرين شوت معتمد', 'toppers' ), 'is-image' ),
		'text'  => array( 'fa-solid fa-pen-nib', __( 'رأي أكاديمي موثق', 'toppers' ), 'is-text' ),
	);
	$badge        = $badge_map[ $type ] ?? $badge_map['text'];
	?>
	<article class="t-card t-card--<?php echo esc_attr( $type ); ?> text-center" data-type="<?php echo esc_attr( $type ); ?>">
		<div style="text-align: center; margin-bottom: 12px;">
			<span class="media-badge <?php echo esc_attr( $badge[2] ); ?>">
				<i class="<?php echo esc_attr( $badge[0] ); ?>" aria-hidden="true"></i>
				<?php echo esc_html( $badge[1] ); ?>
			</span>
		</div>

		<?php if ( 'voice' === $type ) : ?>
			<div class="t-voice-wrap">
				<?php
				echo toppers_audio_player( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					$item['audio_url'] ?? '',
					$item['audio_time'] ?? '0:45'
				);
				?>
			</div>
		<?php elseif ( 'video' === $type && ! empty( $item['video_url'] ) ) : ?>
			<div class="t-video-wrap">
				<iframe
					src="<?php echo esc_url( toppers_youtube_embed_url( $item['video_url'] ) ); ?>"
					title="<?php echo esc_attr( $display_name ); ?>"
					allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
					allowfullscreen
					loading="lazy"></iframe>
			</div>
		<?php elseif ( 'image' === $type && ! empty( $item['screen_full'] ) ) : ?>
			<div class="t-designed-image-wrap" style="margin-bottom: 16px; text-align: center;">
				<img src="<?php echo esc_url( $item['screen_full'] ); ?>" alt="<?php echo esc_attr( $display_name ); ?>" style="max-width: 100%; height: auto; border-radius: 12px; margin: 0 auto; display: block;">
			</div>
		<?php elseif ( 'image' === $type && ! empty( $item['screen_thumb'] ) ) : ?>
			<div class="t-screenshot-wrap" data-full-image="<?php echo esc_url( $item['screen_full'] ); ?>" title="<?php esc_attr_e( 'انقر لتكبير السكرين شوت', 'toppers' ); ?>">
				<img src="<?php echo esc_url( $item['screen_thumb'] ); ?>" alt="<?php echo esc_attr( sprintf( /* translators: %s: client label */ __( 'رأي %s', 'toppers' ), $display_name ) ); ?>" class="t-screenshot-img">
				<div class="t-zoom-overlay">
					<i class="fa-solid fa-magnifying-glass-plus" aria-hidden="true"></i>
					<span><?php esc_html_e( 'تكبير الصورة', 'toppers' ); ?></span>
				</div>
			</div>
		<?php elseif ( 'image' === $type ) : ?>
			<div class="chat-proof">
				<div class="cp-head">
					<span class="dot" aria-hidden="true"></span>
					<span><i class="fa-brands fa-whatsapp" aria-hidden="true"></i> <?php echo esc_html( sprintf( /* translators: %s: client label */ __( 'محادثة واتساب — %s', 'toppers' ), $display_name ) ); ?></span>
				</div>
				<div class="cp-body">
					<?php foreach ( $item['chat'] as $msg ) : ?>
						<div class="cp-bubble cp-in"><?php echo esc_html( $msg ); ?></div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>

		<div class="t-stars" aria-label="<?php echo esc_attr( sprintf( /* translators: %d: stars */ __( '%d نجوم', 'toppers' ), $stars ) ); ?>">
			<?php echo $star_str; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>

		<?php if ( ! empty( $quote ) ) : ?>
			<blockquote class="t-quote">“<?php echo esc_html( $quote ); ?>”</blockquote>
		<?php endif; ?>

		<div class="t-who">
			<div class="t-avatar" aria-hidden="true">
				<i class="fa-solid fa-user-graduate"></i>
			</div>
			<div>
				<strong><?php echo esc_html( $display_name ); ?></strong>
				<small><?php echo esc_html( $role ); ?></small>
			</div>
		</div>
	</article>
	<?php
};

$categories_meta = array(
	'voice' => array(
		'slug'      => 'voice',
		'nav_label' => __( 'صوتيات', 'toppers' ),
		'icon'      => 'fa-solid fa-microphone-lines',
		'eyebrow'   => toppers_content( 'testimonials_voice_eyebrow', __( 'شهادات صوتية حية', 'toppers' ) ),
		'title'     => toppers_content( 'testimonials_voice_title', __( 'رسائل صوتية وتجارب مسجلة', 'toppers' ) ),
		'desc'      => toppers_content( 'testimonials_voice_desc', __( 'استمع لتجارب حقيقية يرويها طلاب الماجستير والدكتوراه عن رحلتهم البحثية ونتائجهم مع توبرز.', 'toppers' ) ),
	),
	'video' => array(
		'slug'      => 'video',
		'nav_label' => __( 'فيديوهات', 'toppers' ),
		'icon'      => 'fa-brands fa-youtube',
		'eyebrow'   => toppers_content( 'testimonials_video_eyebrow', __( 'تجارب مرئية', 'toppers' ) ),
		'title'     => toppers_content( 'testimonials_video_title', __( 'تجارب حية ومصورة بالفيديو', 'toppers' ) ),
		'desc'      => toppers_content( 'testimonials_video_desc', __( 'مشاهدات وتقييمات موثقة بالفيديو تعكس دقة العمل والاحترافية الأكاديمية لفريقنا.', 'toppers' ) ),
	),
	'image' => array(
		'slug'      => 'image',
		'nav_label' => __( 'سكرين شوت', 'toppers' ),
		'icon'      => 'fa-solid fa-camera',
		'eyebrow'   => toppers_content( 'testimonials_image_eyebrow', __( 'محادثات موثقة وتقارير معتمدة', 'toppers' ) ),
		'title'     => toppers_content( 'testimonials_image_title', __( 'سكرين شوت محادثات القبول وتقارير الاقتباس', 'toppers' ) ),
		'desc'      => toppers_content( 'testimonials_image_desc', __( 'لقطات شاشة موثقة لآراء الطلاب وفحص نسبة الاقتباس ورسائل القبول الأكاديمي والنشر الدولي.', 'toppers' ) ),
	),
	'text'  => array(
		'slug'      => 'text',
		'nav_label' => __( 'آراء نصية', 'toppers' ),
		'icon'      => 'fa-solid fa-pen-nib',
		'eyebrow'   => toppers_content( 'testimonials_text_eyebrow', __( 'تقييمات أكاديمية مكتوبة', 'toppers' ) ),
		'title'     => toppers_content( 'testimonials_text_title', __( 'آراء وتوصيات أكاديمية مكتوبة', 'toppers' ) ),
		'desc'      => toppers_content( 'testimonials_text_desc', __( 'انطباعات ورسائل شكر مكتوبة يشاركنا بها طلابنا بعد اعتماد أبحاثهم ورسائلهم بنجاح.', 'toppers' ) ),
	),
);

$categorized = array(
	'voice' => array(),
	'video' => array(),
	'image' => array(),
	'text'  => array(),
);
$counter = 1;

if ( $testimonials_query->have_posts() ) {
	$voices = array();
	$vids   = array();
	$imgs   = array();
	$txts   = array();

	foreach ( $testimonials_query->posts as $p ) {
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

	foreach ( array_merge( $voices, $vids, $imgs, $txts ) as $post ) {
		$pid        = $post->ID;
		$role       = get_post_meta( $pid, '_toppers_role', true ) ?: __( 'باحث أكاديمي', 'toppers' );
		$quote      = wp_strip_all_tags( $post->post_content );
		$stars      = max( 1, min( 5, (int) ( get_post_meta( $pid, '_toppers_stars', true ) ?: 5 ) ) );
		$raw_type   = get_post_meta( $pid, '_toppers_testimonial_type', true ) ?: 'text';
		$video_url  = get_post_meta( $pid, '_toppers_youtube_url', true ) ?: get_post_meta( $pid, '_toppers_video_url', true ) ?: '';
		$audio_id   = (int) get_post_meta( $pid, '_toppers_audio_id', true );
		$audio_url  = $audio_id ? wp_get_attachment_url( $audio_id ) : '';
		$audio_time = get_post_meta( $pid, '_toppers_audio_time', true ) ?: '0:45';
		$screen_id  = (int) get_post_meta( $pid, '_toppers_screenshot_id', true );
		if ( ! $screen_id ) {
			$screen_id = get_post_thumbnail_id( $pid );
		}
		$screen_thumb = $screen_id ? wp_get_attachment_image_url( $screen_id, 'large' ) : '';
		$screen_full  = $screen_id ? wp_get_attachment_image_url( $screen_id, 'full' ) : $screen_thumb;

		if ( ! $video_url && 'video' === $raw_type ) {
			$video_url = 'https://youtu.be/dujo3xmx0ME';
		}

		if ( 'voice' === $raw_type || $audio_url ) {
			$type = 'voice';
		} elseif ( 'video' === $raw_type || $video_url ) {
			$type = 'video';
		} elseif ( in_array( $raw_type, array( 'image', 'whatsapp', 'photo' ), true ) || $screen_thumb ) {
			$type = 'image';
		} else {
			$type = 'text';
		}

		$item = array(
			'type'         => $type,
			'name'         => sprintf( /* translators: %d: client number */ __( 'عميل %d', 'toppers' ), $counter ),
			'role'         => $role,
			'quote'        => $quote,
			'stars'        => $stars,
			'video_url'    => $video_url,
			'audio_url'    => $audio_url,
			'audio_time'   => $audio_time,
			'screen_thumb' => $screen_thumb,
			'screen_full'  => $screen_full,
			'chat'         => array(),
		);

		$categorized[ $type ][] = $item;
		++$counter;
	}
} else {
	foreach ( $defaults as $row ) {
		$item = array(
			'type'         => $row['type'],
			'name'         => sprintf( /* translators: %d: client number */ __( 'عميل %d', 'toppers' ), $counter ),
			'role'         => $row['role'],
			'quote'        => $row['quote'],
			'stars'        => (int) ( $row['stars'] ?? 5 ),
			'video_url'    => $row['video_url'] ?? '',
			'audio_url'    => $row['audio_url'] ?? '',
			'audio_time'   => $row['audio_time'] ?? '0:45',
			'screen_thumb' => '',
			'screen_full'  => '',
			'chat'         => $row['chat'] ?? array(),
		);

		$categorized[ $row['type'] ][] = $item;
		++$counter;
	}
}
?>
<main class="site-main">
	<?php
	if ( toppers_is_elementor_page() ) {
		while ( have_posts() ) {
			the_post();
			the_content();
		}
	} else {
		get_template_part(
			'template-parts/page-hero',
			null,
			toppers_hero_args(
				'testimonials',
				array(
					'title'   => __( 'آراء نعتز بها', 'toppers' ),
					'eyebrow' => __( 'تجارب الباحثين والطلاب', 'toppers' ),
					'lede'    => __( 'على مدار أكثر من 10 سنوات من العطاء الأكاديمي، كانت ثقة باحثينا هي المعيار الحقيقي لتميزنا. نضع بين يديك تجارب حقيقية وواقعية لطلاب الماجستير والدكتوراه تُجسّد رحلتهم معنا بكل شفافية.', 'toppers' ),
					'crumb'   => __( 'آراء العملاء', 'toppers' ),
					'center'  => true,
					'orbs'    => true,
				)
			)
		);
		?>

		<?php
		$sec_index = 0;
		foreach ( $categories_meta as $cat_key => $cat ) :
			$cat_items = $categorized[ $cat_key ] ?? array();
			if ( empty( $cat_items ) ) {
				continue;
			}
			$is_alt = ( $sec_index % 2 !== 0 );
			$sec_index++;
			?>
			<section class="section t-category-sec <?php echo $is_alt ? 'section--alt' : ''; ?>" id="testimonials-<?php echo esc_attr( $cat_key ); ?>">
				<div class="container">
					<div class="section-head text-center reveal" style="text-align: center; margin: 0 auto 38px; max-width: 780px;">
						<h2 style="text-align: center; margin: 0 0 12px; font-weight: 800; font-size: clamp(26px, 3.2vw, 36px);"><?php echo esc_html( $cat['title'] ); ?></h2>
						<?php if ( ! empty( $cat['desc'] ) ) : ?>
							<p class="section-desc" style="text-align: center; margin: 0 auto; max-width: 680px; font-size: 16px; color: var(--ink-soft); line-height: 1.75;"><?php echo esc_html( $cat['desc'] ); ?></p>
						<?php endif; ?>
					</div>

					<div class="t-masonry t-grid-3">
						<?php
						foreach ( $cat_items as $item ) {
							$render_testimonial_card( $item );
						}
						?>
					</div>
				</div>
			</section>
		<?php endforeach; ?>

		<style>
		.t-category-sec .section-head {
			text-align: center !important;
			max-width: 780px !important;
			margin: 0 auto 38px !important;
		}
		.t-category-sec .section-head .eyebrow {
			display: none !important;
		}
		.t-category-sec .section-head h2 {
			text-align: center !important;
			font-weight: 800 !important;
			margin: 0 0 12px !important;
		}
		.t-category-sec .section-head .section-desc {
			text-align: center !important;
			margin: 0 auto !important;
			max-width: 680px !important;
		}
		.t-masonry,
		.t-grid-3 {
			display: grid !important;
			grid-template-columns: repeat(3, 1fr) !important;
			gap: 24px !important;
		}
		.t-card {
			text-align: center !important;
			display: flex !important;
			flex-direction: column !important;
			justify-content: space-between !important;
			align-items: center !important;
			padding: 24px !important;
			border-radius: 18px !important;
		}
		.t-card .media-badge {
			margin: 0 auto 12px !important;
			display: inline-flex !important;
			align-items: center !important;
			justify-content: center !important;
		}
		.t-card .t-stars {
			display: flex !important;
			justify-content: center !important;
			align-items: center !important;
			gap: 4px !important;
			margin: 0 auto 12px !important;
			color: var(--gold) !important;
			font-size: 14px !important;
		}
		.t-card .t-quote {
			text-align: center !important;
			margin: 0 auto 16px !important;
			max-width: 95% !important;
			line-height: 1.8 !important;
			color: var(--ink-soft) !important;
		}
		.t-card .t-who {
			display: flex !important;
			flex-direction: column !important;
			align-items: center !important;
			justify-content: center !important;
			text-align: center !important;
			gap: 8px !important;
			margin-top: auto !important;
			padding-top: 14px !important;
			border-top: 1px solid var(--line) !important;
			width: 100% !important;
		}
		.t-card .t-avatar {
			margin: 0 auto !important;
		}
		.t-designed-image-wrap {
			text-align: center !important;
			margin: 0 auto 16px !important;
			width: 100% !important;
		}
		.t-designed-image-wrap img {
			margin: 0 auto !important;
			display: block !important;
			max-width: 100% !important;
		}
		.t-voice-wrap,
		.t-video-wrap {
			margin-inline: auto !important;
			width: 100% !important;
		}
		@media (max-width: 980px) {
			.t-masonry,
			.t-grid-3 {
				grid-template-columns: repeat(2, 1fr) !important;
			}
		}
		@media (max-width: 640px) {
			.t-masonry,
			.t-grid-3 {
				grid-template-columns: 1fr !important;
			}
		}
		</style>

		<!-- Share Experience Section -->
		<section class="section t-share-experience-sec">
			<div class="container">
				<div class="share-experience-banner reveal">
					<div class="sh-ic" aria-hidden="true"><i class="fa-solid fa-comment-dots"></i></div>
					<div class="sh-content">
						<h3><?php esc_html_e( 'هل تعاملت معنا من قبل؟ شاركنا تجربتك', 'toppers' ); ?></h3>
						<p><?php esc_html_e( 'نعتز بثقتكم وسعداء بمشاركتكم تجربتكم عبر رسالة صوتية أو فيديو أو سكرين شوت عبر واتساب لنكون دائماً عند حسن ظنكم.', 'toppers' ); ?></p>
					</div>
					<div class="sh-action">
						<a href="<?php echo esc_url( toppers_whatsapp_url() ); ?>" target="_blank" rel="noopener" class="btn btn-gold">
							<i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
							<?php esc_html_e( 'شاركنا تجربتك عبر واتساب', 'toppers' ); ?>
						</a>
					</div>
				</div>
			</div>
		</section>

		<div class="image-modal-overlay" id="imageModal">
			<div class="image-modal-box">
				<button class="image-modal-close" id="imageModalClose" type="button" aria-label="<?php esc_attr_e( 'إغلاق', 'toppers' ); ?>">&times;</button>
				<img id="imageModalImg" src="" alt="<?php esc_attr_e( 'معاينة سكرين شوت', 'toppers' ); ?>">
			</div>
		</div>

		<!-- Bottom CTA Band -->
		<section class="section--tight">
			<div class="container">
				<div class="cta-band reveal">
					<h2><?php esc_html_e( 'جاهز لبدء رحلتك البحثية؟', 'toppers' ); ?></h2>
					<p><?php esc_html_e( 'أرسل تفاصيل مشروعك الآن واحصل على استشارة أولية وعرض سعر مجاني خلال ساعات.', 'toppers' ); ?></p>
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
		<?php
	}
	?>
</main>
<?php
get_footer();
