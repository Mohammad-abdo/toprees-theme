<?php
/**
 * Template Name: آراء الطلاب
 *
 * @package Toppers
 */

get_header();

$counts = toppers_get_testimonials_counts();

$defaults = array(
	array(
		'name'  => 'سارة العتيبي',
		'role'  => 'طالبة ماجستير — إدارة أعمال',
		'quote' => 'تعاملت مع توبرز في رسالة الماجستير، والفريق كان دقيقًا جدًا في المنهجية والتحليل الإحصائي. التزموا بالموعد تمامًا.',
		'type'  => 'voice',
		'time'  => '0:45',
		'audio' => '',
	),
	array(
		'name'  => 'محمد الحربي',
		'role'  => 'باحث دكتوراه — علوم حاسب',
		'quote' => 'خدمة الترجمة الأكاديمية كانت احترافية، والمصطلحات العلمية دقيقة جدًا مقارنة بمكاتب أخرى تعاملت معها سابقًا.',
		'type'  => 'voice',
		'time'  => '1:12',
		'audio' => '',
	),
	array(
		'name'  => 'أحمد الدوسري',
		'role'  => 'باحث ماجستير',
		'quote' => 'دعم مستمر وإجابة على جميع الاستفسارات بصدر رحب. تجربة ممتازة ولن تكون الأخيرة.',
		'type'  => 'video',
		'time'  => '1:34',
		'thumb' => 'https://images.unsplash.com/photo-1596496181848-3091d4878b24?auto=format&fit=crop&q=80&w=700&h=440',
	),
	array(
		'name'  => 'نورة القحطاني',
		'role'  => 'طالبة بكالوريوس',
		'quote' => 'التواصل عبر واتساب سهّل عليّ متابعة بحث التخرج، وفريق الدعم كان متجاوبًا في كل مرحلة.',
		'type'  => 'voice',
		'time'  => '0:30',
		'audio' => '',
	),
	array(
		'name'  => 'د. ريم الخالدي',
		'role'  => 'أستاذ مساعد',
		'quote' => 'ساعدوني في نشر بحثي العلمي في مجلة محكمة بوقت قياسي. عمل احترافي بلا شك.',
		'type'  => 'image',
		'chat'  => array(
			'مبروك د. ريم 🎉 تم قبول البحث في المجلة المحكمة رسميًا.',
			'الله يبارك فيكم، فريق محترف وسريع في كل خطوة 🌹',
		),
	),
	array(
		'name'  => 'ياسر المطيري',
		'role'  => 'باحث دكتوراه',
		'quote' => 'التدقيق اللغوي كان ممتازاً، لم أجد أي خطأ بعد استلام الملف. شكراً توبرز.',
		'type'  => 'text',
	),
);

$testimonials_query = new WP_Query(
	array(
		'post_type'      => 'toppers_testimonial',
		'posts_per_page' => -1,
		'post_status'    => 'publish',
	)
);
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
					'title'   => __( 'طلاب وباحثون وثقوا بنا في محطة مهمة من مسيرتهم', 'toppers' ),
					'eyebrow' => __( 'آراء عملائنا', 'toppers' ),
					'lede'    => __( 'نفخر بكوننا جزءاً من نجاح آلاف الطلاب والباحثين، اقرأ واستمع وشاهد بعضاً من تجاربهم في التعامل معنا.', 'toppers' ),
				)
			)
		);
		?>
		<section class="section">
			<div class="container">
				<div class="t-filters" role="tablist" aria-label="<?php esc_attr_e( 'تصفية الآراء', 'toppers' ); ?>">
					<button class="tab-btn active" type="button" data-filter="all"><?php esc_html_e( 'الكل', 'toppers' ); ?> <span class="cnt"><?php echo esc_html( (string) $counts['all'] ); ?></span></button>
					<button class="tab-btn" type="button" data-filter="voice"><?php esc_html_e( '🎙️ رسائل صوتية', 'toppers' ); ?> <span class="cnt"><?php echo esc_html( (string) $counts['voice'] ); ?></span></button>
					<button class="tab-btn" type="button" data-filter="image"><?php esc_html_e( '📸 لقطات وسكرينات', 'toppers' ); ?> <span class="cnt"><?php echo esc_html( (string) $counts['image'] ); ?></span></button>
					<button class="tab-btn" type="button" data-filter="text"><?php esc_html_e( '✍️ آراء نصية', 'toppers' ); ?> <span class="cnt"><?php echo esc_html( (string) $counts['text'] ); ?></span></button>
					<?php if ( ! empty( $counts['video'] ) ) : ?>
						<button class="tab-btn" type="button" data-filter="video"><?php esc_html_e( '🎬 فيديو', 'toppers' ); ?> <span class="cnt"><?php echo esc_html( (string) $counts['video'] ); ?></span></button>
					<?php endif; ?>
				</div>

				<div class="t-masonry reveal">
					<?php
					if ( $testimonials_query->have_posts() ) :
						while ( $testimonials_query->have_posts() ) :
							$testimonials_query->the_post();
							$pid        = get_the_ID();
							$name       = get_the_title();
							$quote      = wp_strip_all_tags( get_the_content() );
							$role       = get_post_meta( $pid, '_toppers_role', true ) ?: 'طالب باحث';
							$stars      = max( 1, min( 5, (int) get_post_meta( $pid, '_toppers_stars', true ) ?: 5 ) );
							$star_str   = str_repeat( '★', $stars );
							$raw_type   = get_post_meta( $pid, '_toppers_testimonial_type', true ) ?: 'voice';
							$type       = in_array( $raw_type, array( 'image', 'whatsapp', 'photo' ), true ) ? 'image' : $raw_type;
							$audio_id   = (int) get_post_meta( $pid, '_toppers_audio_id', true );
							$audio_url  = $audio_id ? wp_get_attachment_url( $audio_id ) : '';
							$audio_time = get_post_meta( $pid, '_toppers_audio_time', true ) ?: '0:45';

							// Screenshot image
							$screen_id  = (int) get_post_meta( $pid, '_toppers_screenshot_id', true );
							if ( ! $screen_id ) {
								$screen_id = get_post_thumbnail_id( $pid );
							}
							$screen_thumb = $screen_id ? wp_get_attachment_image_url( $screen_id, 'large' ) : '';
							$screen_full  = $screen_id ? wp_get_attachment_image_url( $screen_id, 'full' ) : $screen_thumb;

							// Video
							$video_id  = (int) get_post_meta( $pid, '_toppers_video_id', true );
							$video_url = $video_id ? wp_get_attachment_url( $video_id ) : '';
							?>
							<div class="t-card" data-type="<?php echo esc_attr( $type ); ?>">
								<?php if ( 'voice' === $type ) : ?>
									<span class="media-badge"><?php esc_html_e( '🎙️ رسالة صوتية', 'toppers' ); ?></span>
									<div class="t-stars"><?php echo esc_html( $star_str ); ?></div>
									<?php echo toppers_audio_player( $audio_url, $audio_time ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									<?php if ( $quote ) : ?>
										<p class="t-quote"><?php echo esc_html( $quote ); ?></p>
									<?php endif; ?>
								<?php elseif ( 'image' === $type ) : ?>
									<span class="media-badge"><?php esc_html_e( '📸 سكرين شوت', 'toppers' ); ?></span>
									<?php if ( $screen_thumb ) : ?>
										<div class="t-screenshot-wrap" data-full-image="<?php echo esc_url( $screen_full ); ?>" title="<?php esc_attr_e( 'انقر لتكبير السكرين شوت', 'toppers' ); ?>">
											<img src="<?php echo esc_url( $screen_thumb ); ?>" alt="<?php echo esc_attr( sprintf( 'رأي %s', $name ) ); ?>" class="t-screenshot-img">
											<div class="t-zoom-overlay">
												<svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
												<span><?php esc_html_e( 'تكبير الصورة', 'toppers' ); ?></span>
											</div>
										</div>
									<?php else : ?>
										<div class="chat-proof">
											<div class="cp-head"><span class="dot"></span><span><?php echo esc_html( sprintf( 'محادثة واتساب — %s', $name ) ); ?></span></div>
											<div class="chat-bubble in"><?php echo esc_html( $quote ?: __( 'خدمة متميزة وسريعة، شكراً توبرز.', 'toppers' ) ); ?></div>
											<div class="chat-bubble out"><?php esc_html_e( 'سعداء جداً بخدمتك ونتمنى لك دوام التوفيق 🌹', 'toppers' ); ?><span class="tick">✓✓</span></div>
										</div>
									<?php endif; ?>
									<div class="t-stars" style="margin-top:10px;"><?php echo esc_html( $star_str ); ?></div>
									<?php if ( $quote && $screen_thumb ) : ?>
										<p class="t-quote"><?php echo esc_html( $quote ); ?></p>
									<?php endif; ?>
								<?php elseif ( 'video' === $type ) : ?>
									<span class="media-badge"><?php esc_html_e( '🎬 فيديو', 'toppers' ); ?></span>
									<div class="video-thumb" data-video="<?php echo esc_url( $video_url ); ?>">
										<?php if ( has_post_thumbnail( $pid ) ) : ?>
											<img src="<?php echo esc_url( get_the_post_thumbnail_url( $pid, 'large' ) ); ?>" alt="<?php echo esc_attr( $name ); ?>">
										<?php else : ?>
											<div style="width:100%;height:180px;background:#0f172a;display:flex;align-items:center;justify-content:center;color:#fff;">🎬</div>
										<?php endif; ?>
										<div class="vt-overlay"></div>
										<div class="vt-play"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z" /></svg></div>
									</div>
									<div class="t-stars"><?php echo esc_html( $star_str ); ?></div>
									<?php if ( $quote ) : ?>
										<p class="t-quote"><?php echo esc_html( $quote ); ?></p>
									<?php endif; ?>
								<?php else : ?>
									<span class="media-badge"><?php esc_html_e( '✍️ رأي نصي', 'toppers' ); ?></span>
									<div class="t-stars"><?php echo esc_html( $star_str ); ?></div>
									<p class="t-quote" style="margin-top: 6px"><?php echo esc_html( $quote ); ?></p>
								<?php endif; ?>
								<div class="t-who">
									<div class="t-avatar"><?php echo esc_html( toppers_first_letter( $name ) ); ?></div>
									<div>
										<b><?php echo esc_html( $name ); ?></b>
										<span><?php echo esc_html( $role ); ?></span>
									</div>
								</div>
							</div>
							<?php
						endwhile;
						wp_reset_postdata();
					else :
						// Fallback defaults
						foreach ( $defaults as $row ) :
							$type = $row['type'];
							?>
							<div class="t-card" data-type="<?php echo esc_attr( $type ); ?>">
								<?php if ( 'voice' === $type ) : ?>
									<span class="media-badge"><?php esc_html_e( '🎙️ رسالة صوتية', 'toppers' ); ?></span>
									<div class="t-stars">★★★★★</div>
									<?php echo toppers_audio_player( $row['audio'] ?? '', $row['time'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									<p class="t-quote"><?php echo esc_html( $row['quote'] ); ?></p>
								<?php elseif ( 'video' === $type ) : ?>
									<span class="media-badge"><?php esc_html_e( '🎬 فيديو', 'toppers' ); ?></span>
									<div class="video-thumb" data-video="">
										<img src="<?php echo esc_url( $row['thumb'] ?? '' ); ?>" alt="<?php echo esc_attr( $row['name'] ); ?>">
										<div class="vt-overlay"></div>
										<div class="vt-play"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z" /></svg></div>
										<span class="vt-duration"><?php echo esc_html( $row['time'] ); ?></span>
									</div>
									<div class="t-stars">★★★★★</div>
									<p class="t-quote"><?php echo esc_html( $row['quote'] ); ?></p>
								<?php elseif ( 'image' === $type ) : ?>
									<span class="media-badge"><?php esc_html_e( '📸 لقطة محادثة', 'toppers' ); ?></span>
									<div class="chat-proof">
										<div class="cp-head"><span class="dot"></span><span><?php echo esc_html( sprintf( 'محادثة واتساب — %s', $row['name'] ) ); ?></span></div>
										<div class="chat-bubble in"><?php echo esc_html( $row['chat'][0] ); ?></div>
										<div class="chat-bubble out"><?php echo esc_html( $row['chat'][1] ); ?><span class="tick">✓✓ 11:42 ص</span></div>
									</div>
									<div class="t-stars">★★★★★</div>
									<p class="t-quote"><?php echo esc_html( $row['quote'] ); ?></p>
								<?php else : ?>
									<span class="media-badge"><?php esc_html_e( '✍️ رأي نصي', 'toppers' ); ?></span>
									<div class="t-stars">★★★★★</div>
									<p class="t-quote" style="margin-top: 6px"><?php echo esc_html( $row['quote'] ); ?></p>
								<?php endif; ?>
								<div class="t-who">
									<div class="t-avatar"><?php echo esc_html( toppers_first_letter( $row['name'] ) ); ?></div>
									<div>
										<b><?php echo esc_html( $row['name'] ); ?></b>
										<span><?php echo esc_html( $row['role'] ); ?></span>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>

					<div class="t-card is-hidden" data-type="__cta" style="display: block">
						<div class="share-card">
							<div class="sh-ic">
								<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a10 10 0 0 0-8.6 15L2 22l5.2-1.4A10 10 0 1 0 12 2z"></path></svg>
							</div>
							<h3><?php esc_html_e( 'هل تعاملت معنا من قبل؟', 'toppers' ); ?></h3>
							<p><?php esc_html_e( 'شاركنا تجربتك برسالة صوتية أو نصية أو سكرين شوت عبر الواتساب.', 'toppers' ); ?></p>
							<a href="<?php echo esc_url( toppers_whatsapp_url() ); ?>" target="_blank" rel="noopener" class="btn btn-gold btn-sm"><?php esc_html_e( 'شاركنا رأيك', 'toppers' ); ?></a>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Screenshot Lightbox Modal -->
		<div class="image-modal-overlay" id="imageModal">
			<div class="image-modal-box">
				<button class="image-modal-close" id="imageModalClose" type="button" aria-label="<?php esc_attr_e( 'إغلاق', 'toppers' ); ?>">&times;</button>
				<img id="imageModalImg" src="" alt="<?php esc_attr_e( 'معاينة سكرين شوت', 'toppers' ); ?>">
			</div>
		</div>

		<!-- Video Modal -->
		<div class="video-modal-overlay" id="videoModal">
			<div class="video-modal-box">
				<button class="video-modal-close" id="videoModalClose" type="button" aria-label="<?php esc_attr_e( 'إغلاق', 'toppers' ); ?>">&times;</button>
				<video id="videoModalPlayer" controls playsinline></video>
			</div>
		</div>

		<section class="section--tight">
			<div class="container">
				<div class="cta-band reveal">
					<h2><?php esc_html_e( 'جاهز لبدء رحلتك البحثية؟', 'toppers' ); ?></h2>
					<p><?php esc_html_e( 'أرسل تفاصيل مشروعك الآن واحصل على استشارة أولية وعرض سعر مجاني خلال ساعات.', 'toppers' ); ?></p>
					<div class="cta-actions">
						<a href="<?php echo esc_url( toppers_page_url( 'contact' ) ); ?>" class="btn btn-gold"><?php esc_html_e( 'اطلب خدمتك', 'toppers' ); ?></a>
						<a href="<?php echo esc_url( toppers_whatsapp_url() ); ?>" target="_blank" rel="noopener" class="btn btn-outline"><?php esc_html_e( 'تواصل عبر واتساب', 'toppers' ); ?></a>
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

