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
	<article class="t-card t-card--<?php echo esc_attr( $type ); ?>" data-type="<?php echo esc_attr( $type ); ?>">
		<span class="media-badge <?php echo esc_attr( $badge[2] ); ?>">
			<i class="<?php echo esc_attr( $badge[0] ); ?>" aria-hidden="true"></i>
			<?php echo esc_html( $badge[1] ); ?>
		</span>

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
				<?php if ( ! empty( $item['chat'][0] ) ) : ?>
					<div class="chat-bubble in"><?php echo esc_html( $item['chat'][0] ); ?></div>
				<?php else : ?>
					<div class="chat-bubble in"><?php echo esc_html( $quote ?: __( 'خدمة متميزة وسريعة، شكراً توبرز.', 'toppers' ) ); ?></div>
				<?php endif; ?>
				<div class="chat-bubble out">
					<?php echo esc_html( ! empty( $item['chat'][1] ) ? $item['chat'][1] : __( 'سعداء جداً بخدمتك ونتمنى لك دوام التوفيق', 'toppers' ) ); ?>
					<span class="tick">✓✓</span>
				</div>
			</div>
		<?php endif; ?>

		<div class="t-stars"><?php echo $star_str; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>

		<?php if ( $quote && 'voice' !== $type ) : ?>
			<p class="t-quote"><?php echo esc_html( $quote ); ?></p>
		<?php elseif ( $quote && 'voice' === $type ) : ?>
			<p class="t-quote t-quote--voice"><?php echo esc_html( $quote ); ?></p>
		<?php endif; ?>

		<div class="t-who">
			<div class="t-avatar" aria-hidden="true"><i class="fa-solid fa-user-graduate"></i></div>
			<div>
				<strong><?php echo esc_html( $display_name ); ?></strong>
				<small><?php echo esc_html( $role ); ?></small>
			</div>
		</div>
	</article>
	<?php
};

$items   = array();
$counts  = array(
	'all'   => 0,
	'voice' => 0,
	'video' => 0,
	'image' => 0,
	'text'  => 0,
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

		$items[] = array(
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
		++$counts[ $type ];
		++$counts['all'];
		++$counter;
	}
} else {
	foreach ( $defaults as $row ) {
		$items[] = array(
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
		++$counts[ $row['type'] ];
		++$counts['all'];
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
		<section class="section t-page-sec">
			<div class="container">
				<div class="t-filters" role="tablist" aria-label="<?php esc_attr_e( 'تصفية الآراء', 'toppers' ); ?>">
					<button type="button" class="tab-btn active" data-filter="all" role="tab" aria-selected="true">
						<?php esc_html_e( 'الكل', 'toppers' ); ?>
						<span class="cnt"><?php echo esc_html( (string) $counts['all'] ); ?></span>
					</button>
					<button type="button" class="tab-btn" data-filter="voice" role="tab" aria-selected="false">
						<i class="fa-solid fa-microphone-lines" aria-hidden="true"></i>
						<?php esc_html_e( 'صوتيات', 'toppers' ); ?>
						<span class="cnt"><?php echo esc_html( (string) $counts['voice'] ); ?></span>
					</button>
					<button type="button" class="tab-btn" data-filter="video" role="tab" aria-selected="false">
						<i class="fa-brands fa-youtube" aria-hidden="true"></i>
						<?php esc_html_e( 'فيديوهات', 'toppers' ); ?>
						<span class="cnt"><?php echo esc_html( (string) $counts['video'] ); ?></span>
					</button>
					<button type="button" class="tab-btn" data-filter="image" role="tab" aria-selected="false">
						<i class="fa-solid fa-camera" aria-hidden="true"></i>
						<?php esc_html_e( 'سكرين شوت', 'toppers' ); ?>
						<span class="cnt"><?php echo esc_html( (string) $counts['image'] ); ?></span>
					</button>
					<button type="button" class="tab-btn" data-filter="text" role="tab" aria-selected="false">
						<i class="fa-solid fa-pen-nib" aria-hidden="true"></i>
						<?php esc_html_e( 'آراء نصية', 'toppers' ); ?>
						<span class="cnt"><?php echo esc_html( (string) $counts['text'] ); ?></span>
					</button>
				</div>

				<div class="t-masonry" id="testimonialsGrid">
					<?php
					foreach ( $items as $item ) {
						$render_testimonial_card( $item );
					}
					?>

					<article class="t-card t-card--cta share-card" data-type="__cta">
						<div class="sh-ic" aria-hidden="true"><i class="fa-solid fa-comment-dots"></i></div>
						<h3><?php esc_html_e( 'هل تعاملت معنا من قبل؟', 'toppers' ); ?></h3>
						<p><?php esc_html_e( 'نعتز بثقتكم وسعداء بمشاركتكم تجربتكم عبر رسالة صوتية أو فيديو أو سكرين شوت عبر واتساب.', 'toppers' ); ?></p>
						<a href="<?php echo esc_url( toppers_whatsapp_url() ); ?>" target="_blank" rel="noopener" class="btn btn-gold btn-sm">
							<i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
							<?php esc_html_e( 'شاركنا تجربتك', 'toppers' ); ?>
						</a>
					</article>
				</div>

				<p class="t-empty is-hidden" id="testimonialsEmpty"><?php esc_html_e( 'لا توجد آراء ضمن هذا التصنيف حالياً.', 'toppers' ); ?></p>
			</div>
		</section>

		<div class="image-modal-overlay" id="imageModal">
			<div class="image-modal-box">
				<button class="image-modal-close" id="imageModalClose" type="button" aria-label="<?php esc_attr_e( 'إغلاق', 'toppers' ); ?>">&times;</button>
				<img id="imageModalImg" src="" alt="<?php esc_attr_e( 'معاينة سكرين شوت', 'toppers' ); ?>">
			</div>
		</div>

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
