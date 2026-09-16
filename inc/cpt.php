<?php
/**
 * Custom post types: services, team, testimonials, FAQs.
 *
 * @package Toppers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', 'toppers_register_cpts' );
function toppers_register_cpts() {
	register_post_type(
		'toppers_service',
		array(
			'labels'       => array(
				'name'          => __( 'الخدمات', 'toppers' ),
				'singular_name' => __( 'خدمة', 'toppers' ),
				'add_new_item'  => __( 'إضافة خدمة', 'toppers' ),
				'edit_item'     => __( 'تعديل الخدمة', 'toppers' ),
			),
			'public'       => true,
			'has_archive'  => true,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-welcome-learn-more',
			'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
			'rewrite'      => array( 'slug' => 'service' ),
		)
	);

	register_taxonomy(
		'service_category',
		'toppers_service',
		array(
			'labels'       => array(
				'name'          => __( 'تصنيفات الخدمات', 'toppers' ),
				'singular_name' => __( 'تصنيف خدمة', 'toppers' ),
			),
			'public'       => true,
			'hierarchical' => true,
			'show_in_rest' => true,
			'rewrite'      => array( 'slug' => 'service-category' ),
		)
	);

	register_post_type(
		'toppers_team',
		array(
			'labels'       => array(
				'name'          => __( 'فريق العمل', 'toppers' ),
				'singular_name' => __( 'عضو فريق', 'toppers' ),
				'add_new_item'  => __( 'إضافة عضو', 'toppers' ),
			),
			'public'       => true,
			'has_archive'  => true,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-groups',
			'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
			'rewrite'      => array( 'slug' => 'team-member' ),
		)
	);

	register_post_type(
		'toppers_testimonial',
		array(
			'labels'       => array(
				'name'          => __( 'آراء الطلاب', 'toppers' ),
				'singular_name' => __( 'رأي', 'toppers' ),
				'add_new_item'  => __( 'إضافة رأي', 'toppers' ),
			),
			'public'       => true,
			'has_archive'  => false,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-format-quote',
			'supports'     => array( 'title', 'editor', 'thumbnail' ),
		)
	);

	register_post_type(
		'toppers_faq',
		array(
			'labels'       => array(
				'name'          => __( 'الأسئلة الشائعة', 'toppers' ),
				'singular_name' => __( 'سؤال', 'toppers' ),
				'add_new_item'  => __( 'إضافة سؤال', 'toppers' ),
			),
			'public'       => true,
			'has_archive'  => false,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-editor-help',
			'supports'     => array( 'title', 'editor', 'page-attributes' ),
		)
	);
}

add_action( 'add_meta_boxes', 'toppers_add_meta_boxes' );
function toppers_add_meta_boxes() {
	add_meta_box( 'toppers_service_meta', __( 'تفاصيل الخدمة', 'toppers' ), 'toppers_service_meta_box', 'toppers_service', 'normal' );
	add_meta_box( 'toppers_team_meta', __( 'تفاصيل العضو', 'toppers' ), 'toppers_team_meta_box', 'toppers_team', 'side' );
	add_meta_box( 'toppers_testimonial_meta', __( 'تفاصيل الرأي', 'toppers' ), 'toppers_testimonial_meta_box', 'toppers_testimonial', 'side' );
	add_meta_box( 'toppers_faq_meta', __( 'تصنيف السؤال', 'toppers' ), 'toppers_faq_meta_box', 'toppers_faq', 'side' );
}

function toppers_service_meta_box( $post ) {
	wp_nonce_field( 'toppers_meta', 'toppers_meta_nonce' );
	$badge = get_post_meta( $post->ID, '_toppers_badge', true );
	$price = get_post_meta( $post->ID, '_toppers_price', true );
	echo '<p><label>' . esc_html__( 'شارة البطاقة', 'toppers' ) . '</label><br><input type="text" name="toppers_badge" value="' . esc_attr( $badge ) . '" class="widefat" placeholder="الأكثر طلباً"></p>';
	echo '<p><label>' . esc_html__( 'السعر / ملاحظة السعر', 'toppers' ) . '</label><br><input type="text" name="toppers_price" value="' . esc_attr( $price ) . '" class="widefat"></p>';
}

function toppers_team_meta_box( $post ) {
	wp_nonce_field( 'toppers_meta', 'toppers_meta_nonce' );
	$role = get_post_meta( $post->ID, '_toppers_role', true );
	$uni  = get_post_meta( $post->ID, '_toppers_university', true );
	$cat  = get_post_meta( $post->ID, '_toppers_team_cat', true ) ?: 'academics';
	echo '<p><label>' . esc_html__( 'المسمى', 'toppers' ) . '</label><br><input type="text" name="toppers_role" value="' . esc_attr( $role ) . '" class="widefat"></p>';
	echo '<p><label>' . esc_html__( 'الجامعة / التخصص', 'toppers' ) . '</label><br><input type="text" name="toppers_university" value="' . esc_attr( $uni ) . '" class="widefat"></p>';
	echo '<p><label>' . esc_html__( 'التصنيف', 'toppers' ) . '</label><br><select name="toppers_team_cat" class="widefat">';
	foreach ( toppers_team_cats() as $key => $label ) {
		echo '<option value="' . esc_attr( $key ) . '"' . selected( $cat, $key, false ) . '>' . esc_html( $label ) . '</option>';
	}
	echo '</select></p>';
}

function toppers_testimonial_meta_box( $post ) {
	wp_nonce_field( 'toppers_meta', 'toppers_meta_nonce' );
	$role       = get_post_meta( $post->ID, '_toppers_role', true );
	$stars      = get_post_meta( $post->ID, '_toppers_stars', true ) ?: '5';
	$type       = get_post_meta( $post->ID, '_toppers_testimonial_type', true ) ?: 'voice';
	$audio      = get_post_meta( $post->ID, '_toppers_audio_id', true );
	$audio_time = get_post_meta( $post->ID, '_toppers_audio_time', true ) ?: '0:45';
	$screenshot = get_post_meta( $post->ID, '_toppers_screenshot_id', true );
	if ( ! $screenshot ) {
		$screenshot = get_post_thumbnail_id( $post->ID );
	}
	$video      = get_post_meta( $post->ID, '_toppers_video_id', true );

	echo '<div class="toppers-testimonial-metabox">';
	echo '<p><label><strong>' . esc_html__( 'نوع الرأي:', 'toppers' ) . '</strong></label><br>';
	echo '<select name="toppers_testimonial_type" id="toppers_testimonial_type" class="widefat" style="margin-top:4px;font-weight:600;">';
	$type_labels = array(
		'voice' => __( '🎙️ تسجيل صوتي (رسالة صوتية تعمل على الثيم)', 'toppers' ),
		'image' => __( '📸 سكرين شوت (لقطة محادثة واتساب / صورة تقييم)', 'toppers' ),
		'text'  => __( '✍️ رأي نصي (كلام وتقييم بالنجوم)', 'toppers' ),
		'video' => __( '🎬 فيديو', 'toppers' ),
	);
	foreach ( $type_labels as $key => $label ) {
		echo '<option value="' . esc_attr( $key ) . '"' . selected( $type, $key, false ) . '>' . esc_html( $label ) . '</option>';
	}
	echo '</select></p>';

	// Voice options block
	echo '<div id="toppers-voice-block" class="toppers-type-block" style="' . ( 'voice' === $type ? '' : 'display:none;' ) . 'background:#f8fafc;padding:12px;border:1px solid #e2e8f0;border-radius:8px;margin-bottom:14px;">';
	echo '<label><strong>' . esc_html__( 'ملف الصوت (تسجيل صوتي):', 'toppers' ) . '</strong></label>';
	echo '<p class="description" style="margin-top:2px;">' . esc_html__( 'يدعم جميع صيغ الصوت: MP3, M4A, OGG, WAV, AAC, OPUS (تسجيلات الواتساب والهاتف).', 'toppers' ) . '</p>';
	echo '<input type="hidden" id="toppers_audio_id" name="toppers_audio_id" value="' . esc_attr( $audio ) . '">';
	echo '<div style="margin-top:8px;">';
	echo '<button type="button" class="button button-primary" id="toppers-pick-audio">' . esc_html__( '🎙️ رفع / اختيار ملف الصوت', 'toppers' ) . '</button> ';
	echo '<button type="button" class="button" id="toppers-clear-audio" style="' . ( $audio ? '' : 'display:none;' ) . '">' . esc_html__( 'مسح الصوت', 'toppers' ) . '</button>';
	echo '</div>';
	echo '<div id="toppers-audio-preview-wrap" style="margin-top:10px;' . ( $audio ? '' : 'display:none;' ) . '">';
	$audio_url = $audio ? wp_get_attachment_url( (int) $audio ) : '';
	echo '<audio id="toppers-audio-preview" controls src="' . esc_url( $audio_url ) . '" style="width:100%;margin-top:6px;"></audio>';
	echo '</div>';
	echo '<p style="margin-top:10px;"><label>' . esc_html__( 'مدة التسجيل (اختياري، مثلاً 0:45):', 'toppers' ) . '</label><br><input type="text" name="toppers_audio_time" value="' . esc_attr( $audio_time ) . '" class="regular-text" placeholder="0:45"></p>';
	echo '</div>';

	// Screenshot options block
	echo '<div id="toppers-image-block" class="toppers-type-block" style="' . ( 'image' === $type ? '' : 'display:none;' ) . 'background:#f8fafc;padding:12px;border:1px solid #e2e8f0;border-radius:8px;margin-bottom:14px;">';
	echo '<label><strong>' . esc_html__( 'صورة الاسكرين شوت (محادثة واتساب / صورة الرأي):', 'toppers' ) . '</strong></label>';
	echo '<p class="description" style="margin-top:2px;">' . esc_html__( 'ارفع لقطة الشاشة من الواتساب أو رأي العميل، وسيتم عرضها مصغرة مع إمكانية تكبيرها للزوار.', 'toppers' ) . '</p>';
	echo '<input type="hidden" id="toppers_screenshot_id" name="toppers_screenshot_id" value="' . esc_attr( $screenshot ) . '">';
	echo '<div style="margin-top:8px;">';
	echo '<button type="button" class="button button-primary" id="toppers-pick-screenshot">' . esc_html__( '📸 رفع / اختيار صورة الاسكرين', 'toppers' ) . '</button> ';
	echo '<button type="button" class="button" id="toppers-clear-screenshot" style="' . ( $screenshot ? '' : 'display:none;' ) . '">' . esc_html__( 'مسح الصورة', 'toppers' ) . '</button>';
	echo '</div>';
	$screenshot_url = $screenshot ? wp_get_attachment_image_url( (int) $screenshot, 'medium' ) : '';
	echo '<div id="toppers-screenshot-preview-wrap" style="margin-top:10px;' . ( $screenshot_url ? '' : 'display:none;' ) . '">';
	echo '<img id="toppers-screenshot-preview" src="' . esc_url( $screenshot_url ) . '" style="max-width:100%;max-height:220px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.1);display:block;">';
	echo '</div>';
	echo '</div>';

	// Video options block
	echo '<div id="toppers-video-block" class="toppers-type-block" style="' . ( 'video' === $type ? '' : 'display:none;' ) . 'background:#f8fafc;padding:12px;border:1px solid #e2e8f0;border-radius:8px;margin-bottom:14px;">';
	echo '<label><strong>' . esc_html__( 'فيديو الرأي:', 'toppers' ) . '</strong></label>';
	echo '<input type="hidden" id="toppers_video_id" name="toppers_video_id" value="' . esc_attr( $video ) . '">';
	echo '<div style="margin-top:8px;">';
	echo '<button type="button" class="button" id="toppers-pick-video">' . esc_html__( 'رفع / اختيار فيديو', 'toppers' ) . '</button> ';
	echo '<button type="button" class="button" id="toppers-clear-video" style="' . ( $video ? '' : 'display:none;' ) . '">' . esc_html__( 'مسح', 'toppers' ) . '</button>';
	echo '</div>';
	echo '</div>';

	// General fields
	echo '<p><label><strong>' . esc_html__( 'الصفة أو التخصص الأكاديمي:', 'toppers' ) . '</strong></label><br>';
	echo '<input type="text" name="toppers_role" value="' . esc_attr( $role ) . '" class="widefat" placeholder="مثال: طالبة ماجستير — إدارة أعمال"></p>';

	echo '<p><label><strong>' . esc_html__( 'التقييم بالنجوم:', 'toppers' ) . '</strong></label><br>';
	echo '<input type="number" min="1" max="5" name="toppers_stars" value="' . esc_attr( $stars ) . '" class="small-text"> ' . esc_html__( 'من 5 نجوم', 'toppers' ) . '</p>';

	echo '<p class="description" style="margin-top:14px;color:#64748b;">' . esc_html__( 'ملاحظة: يمكنك كتابة نص تعليق الطالب في مربع المحتوى الأساسي للصفحة أعلاه.', 'toppers' ) . '</p>';
	echo '</div>';
}

function toppers_faq_meta_box( $post ) {
	wp_nonce_field( 'toppers_meta', 'toppers_meta_nonce' );
	$cat = get_post_meta( $post->ID, '_toppers_faq_cat', true );
	echo '<p><label>' . esc_html__( 'التصنيف', 'toppers' ) . '</label><br><input type="text" name="toppers_faq_cat" value="' . esc_attr( $cat ) . '" class="widefat" placeholder="عن الشركة والخدمة"></p>';
}

add_action( 'save_post', 'toppers_save_meta' );
function toppers_save_meta( $post_id ) {
	if ( ! isset( $_POST['toppers_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['toppers_meta_nonce'] ) ), 'toppers_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$keys = array(
		'toppers_badge'             => '_toppers_badge',
		'toppers_price'             => '_toppers_price',
		'toppers_role'              => '_toppers_role',
		'toppers_university'        => '_toppers_university',
		'toppers_team_cat'          => '_toppers_team_cat',
		'toppers_stars'             => '_toppers_stars',
		'toppers_faq_cat'           => '_toppers_faq_cat',
		'toppers_testimonial_type'  => '_toppers_testimonial_type',
		'toppers_audio_id'          => '_toppers_audio_id',
		'toppers_audio_time'        => '_toppers_audio_time',
		'toppers_screenshot_id'     => '_toppers_screenshot_id',
		'toppers_video_id'          => '_toppers_video_id',
	);
	foreach ( $keys as $field => $meta ) {
		if ( isset( $_POST[ $field ] ) ) {
			$value = sanitize_text_field( wp_unslash( $_POST[ $field ] ) );
			if ( 'toppers_testimonial_type' === $field && ! in_array( $value, array( 'voice', 'image', 'text', 'video', 'whatsapp', 'photo' ), true ) ) {
				$value = 'voice';
			}
			if ( 'toppers_team_cat' === $field && ! isset( toppers_team_cats()[ $value ] ) ) {
				$value = 'academics';
			}
			if ( in_array( $field, array( 'toppers_audio_id', 'toppers_screenshot_id', 'toppers_video_id' ), true ) ) {
				$value = (string) absint( $value );
			}
			update_post_meta( $post_id, $meta, $value );

			// Automatically link screenshot to thumbnail if available
			if ( 'toppers_screenshot_id' === $field && $value ) {
				set_post_thumbnail( $post_id, (int) $value );
			}
		}
	}
}

add_action( 'admin_enqueue_scripts', 'toppers_testimonial_admin_assets' );
function toppers_testimonial_admin_assets( $hook ) {
	$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
	if ( ! $screen || 'toppers_testimonial' !== $screen->post_type ) {
		return;
	}
	wp_enqueue_media();
	wp_add_inline_script(
		'jquery',
		"jQuery(function($){
			// Type switcher toggle
			function syncTypeBlocks(){
				var current = $('#toppers_testimonial_type').val();
				$('.toppers-type-block').hide();
				if(current === 'voice'){
					$('#toppers-voice-block').show();
				} else if(current === 'image' || current === 'whatsapp' || current === 'photo'){
					$('#toppers-image-block').show();
				} else if(current === 'video'){
					$('#toppers-video-block').show();
				}
			}
			$('#toppers_testimonial_type').on('change', syncTypeBlocks);
			syncTypeBlocks();

			// Audio picker
			$('#toppers-pick-audio').on('click', function(e){
				e.preventDefault();
				var frame = wp.media({ title: 'اختيار ريكورد / تسجيل صوتي', library: { type: 'audio' }, multiple: false });
				frame.on('select', function(){
					var file = frame.state().get('selection').first().toJSON();
					$('#toppers_audio_id').val(file.id);
					$('#toppers-audio-preview').attr('src', file.url);
					$('#toppers-audio-preview-wrap').show();
					$('#toppers-clear-audio').show();
				});
				frame.open();
			});
			$('#toppers-clear-audio').on('click', function(e){
				e.preventDefault();
				$('#toppers_audio_id').val('');
				$('#toppers-audio-preview').removeAttr('src');
				$('#toppers-audio-preview-wrap').hide();
				$(this).hide();
			});

			// Screenshot picker
			$('#toppers-pick-screenshot').on('click', function(e){
				e.preventDefault();
				var frame = wp.media({ title: 'اختيار صورة الاسكرين شوت', library: { type: 'image' }, multiple: false });
				frame.on('select', function(){
					var file = frame.state().get('selection').first().toJSON();
					var imgUrl = (file.sizes && file.sizes.medium) ? file.sizes.medium.url : file.url;
					$('#toppers_screenshot_id').val(file.id);
					$('#toppers-screenshot-preview').attr('src', imgUrl);
					$('#toppers-screenshot-preview-wrap').show();
					$('#toppers-clear-screenshot').show();
				});
				frame.open();
			});
			$('#toppers-clear-screenshot').on('click', function(e){
				e.preventDefault();
				$('#toppers_screenshot_id').val('');
				$('#toppers-screenshot-preview').removeAttr('src');
				$('#toppers-screenshot-preview-wrap').hide();
				$(this).hide();
			});

			// Video picker
			$('#toppers-pick-video').on('click', function(e){
				e.preventDefault();
				var frame = wp.media({ title: 'اختيار فيديو', library: { type: 'video' }, multiple: false });
				frame.on('select', function(){
					var file = frame.state().get('selection').first().toJSON();
					$('#toppers_video_id').val(file.id);
					$('#toppers-clear-video').show();
				});
				frame.open();
			});
			$('#toppers-clear-video').on('click', function(e){
				e.preventDefault();
				$('#toppers_video_id').val('');
				$(this).hide();
			});
		});"
	);
}
