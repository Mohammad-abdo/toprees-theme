<?php
/**
 * Form submissions management: Career Applications, Contact Inquiries, and Global Notification Email Settings.
 *
 * @package Toppers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get the global notification email configured in Dashboard.
 *
 * @return string
 */
function toppers_notification_email() {
	$saved = get_option( 'toppers_site_notification_email' );
	if ( ! empty( $saved ) && is_email( $saved ) ) {
		return sanitize_email( $saved );
	}
	return toppers_opt( 'toppers_email', 'info@toppers-edu.com' );
}

/**
 * Register Custom Post Types for Form Submissions in Dashboard.
 */
add_action( 'init', 'toppers_register_submission_cpts' );
function toppers_register_submission_cpts() {
	// 1. Career Applications (طلبات التوظيف)
	register_post_type(
		'toppers_career_app',
		array(
			'labels'              => array(
				'name'               => __( 'طلبات التوظيف', 'toppers' ),
				'singular_name'      => __( 'طلب توظيف', 'toppers' ),
				'menu_name'          => __( 'طلبات التوظيف', 'toppers' ),
				'all_items'          => __( 'كل طلبات التوظيف', 'toppers' ),
				'view_item'          => __( 'عرض طلب التوظيف', 'toppers' ),
				'edit_item'          => __( 'تفاصيل طلب التوظيف', 'toppers' ),
				'search_items'       => __( 'بحث في طلبات التوظيف', 'toppers' ),
				'not_found'          => __( 'لا توجد طلبات توظيف حتى الآن', 'toppers' ),
				'not_found_in_trash' => __( 'لا توجد طلبات في سلة المهملات', 'toppers' ),
			),
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 56,
			'menu_icon'           => 'dashicons-id-alt',
			'supports'            => array( 'title' ),
			'capability_type'     => 'post',
			'map_meta_cap'        => true,
		)
	);

	// 2. Contact & Service Inquiries (طلبات التواصل والخدمات)
	register_post_type(
		'toppers_contact_req',
		array(
			'labels'              => array(
				'name'               => __( 'طلبات الخدمات والتواصل', 'toppers' ),
				'singular_name'      => __( 'طلب خدمة', 'toppers' ),
				'menu_name'          => __( 'طلبات الخدمات', 'toppers' ),
				'all_items'          => __( 'كل طلبات الخدمات', 'toppers' ),
				'view_item'          => __( 'عرض الطلب', 'toppers' ),
				'edit_item'          => __( 'تفاصيل طلب الخدمة', 'toppers' ),
				'search_items'       => __( 'بحث في طلبات الخدمات', 'toppers' ),
				'not_found'          => __( 'لا توجد طلبات خدمات حتى الآن', 'toppers' ),
				'not_found_in_trash' => __( 'لا توجد طلبات في سلة المهملات', 'toppers' ),
			),
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 57,
			'menu_icon'           => 'dashicons-email-alt',
			'supports'            => array( 'title' ),
			'capability_type'     => 'post',
			'map_meta_cap'        => true,
		)
	);

	// 3. Newsletter Subscribers (المشتركون في النشرة البريدية)
	register_post_type(
		'toppers_subscriber',
		array(
			'labels'              => array(
				'name'               => __( 'النشرة البريدية', 'toppers' ),
				'singular_name'      => __( 'مشترك', 'toppers' ),
				'menu_name'          => __( 'النشرة البريدية', 'toppers' ),
				'all_items'          => __( 'كل المشتركين', 'toppers' ),
				'search_items'       => __( 'بحث في المشتركين', 'toppers' ),
				'not_found'          => __( 'لا يوجد مشتركون حتى الآن', 'toppers' ),
				'not_found_in_trash' => __( 'لا يوجد مشتركون في سلة المهملات', 'toppers' ),
			),
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 58,
			'menu_icon'           => 'dashicons-email-alt2',
			'supports'            => array( 'title' ),
			'capability_type'     => 'post',
			'map_meta_cap'        => true,
		)
	);
}

/**
 * Add Notification Email Settings Submenu Page under both CPTs and under Appearance.
 */
add_action( 'admin_menu', 'toppers_register_email_settings_menu' );
function toppers_register_email_settings_menu() {
	// Submenu under Career Applications
	add_submenu_page(
		'edit.php?post_type=toppers_career_app',
		__( 'إعدادات بريد الإشعارات', 'toppers' ),
		__( 'إعدادات بريد الإشعارات', 'toppers' ),
		'manage_options',
		'toppers-email-settings',
		'toppers_render_email_settings_page'
	);

	// Submenu under Service Inquiries as well for quick access
	add_submenu_page(
		'edit.php?post_type=toppers_contact_req',
		__( 'إعدادات بريد الإشعارات', 'toppers' ),
		__( 'إعدادات بريد الإشعارات', 'toppers' ),
		'manage_options',
		'toppers-email-settings',
		'toppers_render_email_settings_page'
	);
}

/**
 * Render the Email Settings Admin Page.
 */
function toppers_render_email_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$message = '';
	$status  = '';

	// Handle Save
	if ( isset( $_POST['toppers_save_email_settings'] ) && check_admin_referer( 'toppers_email_settings_action', 'toppers_email_settings_nonce' ) ) {
		$new_email = sanitize_email( wp_unslash( $_POST['notification_email'] ?? '' ) );
		if ( ! empty( $new_email ) && is_email( $new_email ) ) {
			update_option( 'toppers_site_notification_email', $new_email );
			set_theme_mod( 'toppers_email', $new_email );
			$message = __( 'تم تحديث وحفظ بريد استلام الإشعارات بنجاح! سيتم إرسال كافة طلبات الموقع إليه فورًا.', 'toppers' );
			$status  = 'success';
		} else {
			$message = __( 'يرجى إدخال عنوان بريد إلكتروني صحيح.', 'toppers' );
			$status  = 'error';
		}
	}

	// Handle Test Email
	if ( isset( $_POST['toppers_send_test_email'] ) && check_admin_referer( 'toppers_email_settings_action', 'toppers_email_settings_nonce' ) ) {
		$target_email = toppers_notification_email();
		$subject      = sprintf( '[Toppers] بريد تجريبي لتأكيد الربط — %s', wp_date( 'Y-m-d H:i' ) );
		$body         = "مرحباً بك،\n\nهذه رسالة اختبارية لتأكيد استلام الإشعارات من موقع توبرز.\nكافة نماذج الموقع (نموذج انضم إلى توبرز، ونموذج طلب الخدمة) مربوطة الآن بهذا البريد بنجاح.\n\nتاريخ الإرسال: " . wp_date( 'Y-m-d H:i:s' );
		$headers      = array( 'Content-Type: text/plain; charset=UTF-8' );

		$sent = wp_mail( $target_email, $subject, $body, $headers );
		if ( $sent ) {
			$message = sprintf( __( 'تم إرسال البريد التجريبي بنجاح إلى: %s. يرجى فحص صندوق الوارد أو البريد غير الهام (Spam).', 'toppers' ), $target_email );
			$status  = 'success';
		} else {
			$message = sprintf( __( 'تعذر إرسال البريد التجريبي إلى: %s. يرجى التأكد من إعدادات البريد (SMTP) في ووردبريس.', 'toppers' ), $target_email );
			$status  = 'error';
		}
	}

	$current_email = toppers_notification_email();
	?>
	<div class="wrap" dir="rtl" style="max-width: 900px; font-family: inherit;">
		<h1 style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
			<span class="dashicons dashicons-email-alt" style="font-size: 32px; width: 32px; height: 32px; color: #c99a3b;"></span>
			<?php esc_html_e( 'إعدادات بريد استلام الإشعارات ونماذج الموقع', 'toppers' ); ?>
		</h1>

		<?php if ( $message ) : ?>
			<div class="notice notice-<?php echo esc_attr( $status ); ?> is-dismissible" style="padding: 12px 18px; font-size: 15px;">
				<p><strong><?php echo esc_html( $message ); ?></strong></p>
			</div>
		<?php endif; ?>

		<div style="background: #fff; border: 1px solid #ccd0d4; border-radius: 12px; padding: 28px 32px; box-shadow: 0 4px 16px rgba(0,0,0,0.04); margin-top: 15px;">
			<div style="background: #f8fafc; border-right: 4px solid #c99a3b; padding: 14px 18px; border-radius: 6px; margin-bottom: 24px;">
				<p style="margin: 0; font-size: 14.5px; color: #1e293b; line-height: 1.7;">
					<strong><?php esc_html_e( 'ملاحظة هامة:', 'toppers' ); ?></strong>
					<?php esc_html_e( 'البريد الإلكتروني المسجل هنا هو الوجهة المركزية التي ستستقبل إشعارات كافة النماذج في الموقع (استمارة انضم إلى توبرز للتوظيف، واستمارة طلب الخدمة والتواصل). عند تغيير هذا البريد سيتم تطبيقه فورًا على جميع الفورمات.', 'toppers' ); ?>
				</p>
			</div>

			<form method="post" action="">
				<?php wp_nonce_field( 'toppers_email_settings_action', 'toppers_email_settings_nonce' ); ?>

				<table class="form-table" role="presentation" style="margin-bottom: 20px;">
					<tr>
						<th scope="row" style="width: 240px; font-size: 15px; font-weight: 600;">
							<label for="notification_email"><?php esc_html_e( 'البريد الإلكتروني للإشعارات:', 'toppers' ); ?></label>
						</th>
						<td>
							<input name="notification_email" type="email" id="notification_email" value="<?php echo esc_attr( $current_email ); ?>" class="regular-text" style="width: 100%; max-width: 450px; font-size: 15px; padding: 8px 12px; direction: ltr; text-align: left;" required>
							<p class="description" style="margin-top: 8px; font-size: 13.5px; color: #64748b;">
								<?php esc_html_e( 'البريد الفعّال حاليًا لاستلام كافة رسائل النماذج والإشعارات.', 'toppers' ); ?>
							</p>
						</td>
					</tr>
				</table>

				<div style="display: flex; align-items: center; gap: 15px; border-top: 1px solid #e2e8f0; padding-top: 20px;">
					<button type="submit" name="toppers_save_email_settings" class="button button-primary button-large" style="background: #0e1730; border-color: #0e1730; font-weight: 600; padding: 4px 24px; height: 42px; font-size: 15px;">
						<span class="dashicons dashicons-saved" style="margin-top: 4px;"></span>
						<?php esc_html_e( 'حفظ التغييرات', 'toppers' ); ?>
					</button>

					<button type="submit" name="toppers_send_test_email" class="button button-secondary button-large" style="height: 42px; font-size: 14.5px;" onclick="return confirm('هل تريد إرسال بريد تجريبي الآن للتأكد من وصول الإشعارات؟');">
						<span class="dashicons dashicons-email" style="margin-top: 4px;"></span>
						<?php esc_html_e( 'إرسال بريد تجريبي الآن', 'toppers' ); ?>
					</button>
				</div>
			</form>
		</div>

		<!-- Quick Info Cards -->
		<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 25px;">
			<div style="background: #fff; border: 1px solid #ccd0d4; border-radius: 10px; padding: 20px;">
				<h3 style="margin-top: 0; display: flex; align-items: center; gap: 8px; color: #0e1730;">
					<span class="dashicons dashicons-id-alt" style="color: #c99a3b;"></span>
					<?php esc_html_e( 'طلبات التوظيف (انضم إلى توبرز)', 'toppers' ); ?>
				</h3>
				<p style="color: #64748b; font-size: 13.5px; line-height: 1.6; margin-bottom: 12px;">
					<?php esc_html_e( 'تُحفظ كافة طلبات المتقدمين في قائمة خاصة في الداش بورد مع بيانات المؤهل والتخصص ورابط السيرة الذاتية وزر تواصل مباشر عبر واتساب.', 'toppers' ); ?>
				</p>
				<a href="<?php echo esc_url( admin_url( 'edit.php?post_type=toppers_career_app' ) ); ?>" class="button button-small">
					<?php esc_html_e( 'عرض طلبات التوظيف &larr;', 'toppers' ); ?>
				</a>
			</div>

			<div style="background: #fff; border: 1px solid #ccd0d4; border-radius: 10px; padding: 20px;">
				<h3 style="margin-top: 0; display: flex; align-items: center; gap: 8px; color: #0e1730;">
					<span class="dashicons dashicons-email-alt" style="color: #c99a3b;"></span>
					<?php esc_html_e( 'طلبات الخدمات والتواصل', 'toppers' ); ?>
				</h3>
				<p style="color: #64748b; font-size: 13.5px; line-height: 1.6; margin-bottom: 12px;">
					<?php esc_html_e( 'تُحفظ طلبات الخدمات والاستشارات الأكاديمية تلقائيًا مع رقم جوال العميل، الخدمة المطلوبة، الموعد، والتفاصيل.', 'toppers' ); ?>
				</p>
				<a href="<?php echo esc_url( admin_url( 'edit.php?post_type=toppers_contact_req' ) ); ?>" class="button button-small">
					<?php esc_html_e( 'عرض طلبات الخدمات &larr;', 'toppers' ); ?>
				</a>
			</div>
		</div>
	</div>
	<?php
}

/**
 * -------------------------------------------------------------
 * Custom Columns for Career Applications (طلبات التوظيف)
 * -------------------------------------------------------------
 */
add_filter( 'manage_toppers_career_app_posts_columns', 'toppers_career_app_columns' );
function toppers_career_app_columns( $cols ) {
	$new_cols = array(
		'cb'            => '<input type="checkbox" />',
		'title'         => __( 'اسم المختص', 'toppers' ),
		'age'           => __( 'السن', 'toppers' ),
		'phone'         => __( 'رقم الموبايل / واتساب', 'toppers' ),
		'graduation'    => __( 'التخرج والمؤهل', 'toppers' ),
		'cv_file'       => __( 'السيرة الذاتية (CV)', 'toppers' ),
		'date'          => __( 'تاريخ التقديم', 'toppers' ),
	);
	return $new_cols;
}

add_action( 'manage_toppers_career_app_posts_custom_column', 'toppers_career_app_column_data', 10, 2 );
function toppers_career_app_column_data( $column, $post_id ) {
	switch ( $column ) {
		case 'age':
			$age = get_post_meta( $post_id, '_applicant_age', true );
			echo esc_html( $age ? $age . ' سنة' : '—' );
			break;

		case 'graduation':
			$grad = get_post_meta( $post_id, '_applicant_graduation', true );
			if ( ! $grad ) {
				$grad = get_post_meta( $post_id, '_applicant_qualification', true );
			}
			echo '<strong>' . esc_html( $grad ?: '—' ) . '</strong>';
			break;

		case 'phone':
			$phone = get_post_meta( $post_id, '_applicant_phone', true );
			if ( $phone ) {
				$clean = preg_replace( '/\D+/', '', $phone );
				echo '<span dir="ltr" style="font-weight:600;">' . esc_html( $phone ) . '</span><br>';
				echo '<a href="https://wa.me/' . esc_attr( $clean ) . '" target="_blank" rel="noopener" style="display:inline-flex; align-items:center; gap:4px; color:#16a34a; font-size:12px; text-decoration:none; margin-top:2px;">';
				echo '<span class="dashicons dashicons-whatsapp" style="font-size:14px; width:14px; height:14px;"></span> ' . esc_html__( 'واتساب', 'toppers' ) . '</a>';
			} else {
				echo '—';
			}
			break;

		case 'cv_file':
			$cv = get_post_meta( $post_id, '_applicant_cv_url', true );
			if ( ! $cv ) {
				$cv = get_post_meta( $post_id, '_applicant_portfolio_url', true );
			}
			if ( $cv ) {
				echo '<a href="' . esc_url( $cv ) . '" target="_blank" rel="noopener" class="button button-small" style="display:inline-flex; align-items:center; gap:4px; color:#0e1730; font-weight:600;">';
				echo '<span class="dashicons dashicons-media-document" style="font-size:14px; width:14px; height:14px; color:#c99a3b;"></span> ' . esc_html__( 'عرض / تحميل الـ CV', 'toppers' ) . '</a>';
			} else {
				echo '<span style="color:#94a3b8;">—</span>';
			}
			break;
	}
}

/**
 * Metabox for single Career Application view in Dashboard.
 */
add_action( 'add_meta_boxes', 'toppers_career_app_metaboxes' );
function toppers_career_app_metaboxes() {
	add_meta_box(
		'toppers_career_app_details',
		__( 'بيانات طلب انضمام المختص', 'toppers' ),
		'toppers_career_app_details_callback',
		'toppers_career_app',
		'normal',
		'high'
	);
}

function toppers_career_app_details_callback( $post ) {
	$name        = get_post_meta( $post->ID, '_applicant_name', true ) ?: get_the_title( $post->ID );
	$age         = get_post_meta( $post->ID, '_applicant_age', true );
	$phone       = get_post_meta( $post->ID, '_applicant_phone', true );
	$graduation  = get_post_meta( $post->ID, '_applicant_graduation', true ) ?: get_post_meta( $post->ID, '_applicant_qualification', true );
	$cv_url      = get_post_meta( $post->ID, '_applicant_cv_url', true ) ?: get_post_meta( $post->ID, '_applicant_portfolio_url', true );
	$clean_phone = preg_replace( '/\D+/', '', $phone );
	?>
	<div style="padding: 10px 5px; font-size: 15px; line-height: 1.8;">
		<div style="background: #f8fafc; padding: 22px 24px; border-radius: 10px; border: 1px solid #e2e8f0; max-width: 680px;">
			<p style="margin: 0 0 14px; font-size: 16px;">
				<strong style="color:#0e1730;"><?php esc_html_e( 'اسم المختص:', 'toppers' ); ?></strong>
				<span style="font-weight: 700;"><?php echo esc_html( $name ); ?></span>
			</p>

			<p style="margin: 0 0 14px;">
				<strong style="color:#0e1730;"><?php esc_html_e( 'السن / العمر:', 'toppers' ); ?></strong>
				<span><?php echo esc_html( $age ? $age . ' سنة' : '—' ); ?></span>
			</p>

			<p style="margin: 0 0 14px;">
				<strong style="color:#0e1730;"><?php esc_html_e( 'رقم الموبايل:', 'toppers' ); ?></strong>
				<span dir="ltr" style="font-weight:600; margin-inline-end: 10px;"><?php echo esc_html( $phone ); ?></span>
				<?php if ( $clean_phone ) : ?>
					<a href="https://wa.me/<?php echo esc_attr( $clean_phone ); ?>" target="_blank" class="button button-small" style="color:#16a34a; font-weight:600;">
						<span class="dashicons dashicons-whatsapp" style="margin-top:2px;"></span> <?php esc_html_e( 'مراسلة عبر واتساب', 'toppers' ); ?>
					</a>
				<?php endif; ?>
			</p>

			<p style="margin: 0 0 18px;">
				<strong style="color:#0e1730;"><?php esc_html_e( 'التخرج / المؤهل والتخصص:', 'toppers' ); ?></strong>
				<span style="background: #fef3c7; color: #92400e; padding: 3px 10px; border-radius: 6px; font-weight: 600;"><?php echo esc_html( $graduation ?: '—' ); ?></span>
			</p>

			<?php if ( $cv_url ) : ?>
				<div style="background: #eff6ff; border: 1px solid #bfdbfe; padding: 14px 18px; border-radius: 8px; margin-top: 15px;">
					<strong style="display:block; margin-bottom: 8px; color:#1e40af;"><?php esc_html_e( 'ملف السيرة الذاتية (CV):', 'toppers' ); ?></strong>
					<a href="<?php echo esc_url( $cv_url ); ?>" target="_blank" rel="noopener" class="button button-primary" style="font-size: 14px; padding: 4px 18px; background: #0e1730; border-color: #0e1730;">
						<span class="dashicons dashicons-download" style="margin-top: 3px;"></span>
						<?php esc_html_e( 'تحميل واستعراض الـ CV &larr;', 'toppers' ); ?>
					</a>
				</div>
			<?php else : ?>
				<p style="margin: 0; color: #94a3b8;"><?php esc_html_e( 'لم يتم إرفاق ملف سيرة ذاتية.', 'toppers' ); ?></p>
			<?php endif; ?>
		</div>
	<?php
}

/**
 * -------------------------------------------------------------
 * Custom Columns for Contact & Service Inquiries (طلبات الخدمات)
 * -------------------------------------------------------------
 */
add_filter( 'manage_toppers_contact_req_posts_columns', 'toppers_contact_req_columns' );
function toppers_contact_req_columns( $cols ) {
	$new_cols = array(
		'cb'       => '<input type="checkbox" />',
		'title'    => __( 'اسم العميل', 'toppers' ),
		'service'  => __( 'الخدمة المطلوبة', 'toppers' ),
		'level'    => __( 'المرحلة الدراسية', 'toppers' ),
		'phone'    => __( 'الجوال / واتساب', 'toppers' ),
		'email'    => __( 'البريد الإلكتروني', 'toppers' ),
		'deadline' => __( 'الموعد المطلوب', 'toppers' ),
		'date'     => __( 'تاريخ الطلب', 'toppers' ),
	);
	return $new_cols;
}

add_action( 'manage_toppers_contact_req_posts_custom_column', 'toppers_contact_req_column_data', 10, 2 );
function toppers_contact_req_column_data( $column, $post_id ) {
	switch ( $column ) {
		case 'service':
			$svc = get_post_meta( $post_id, '_inquiry_service', true );
			echo '<strong>' . esc_html( $svc ?: '—' ) . '</strong>';
			break;

		case 'level':
			$lvl = get_post_meta( $post_id, '_inquiry_level', true );
			echo esc_html( $lvl ?: '—' );
			break;

		case 'phone':
			$phone = get_post_meta( $post_id, '_inquiry_phone', true );
			if ( $phone ) {
				$clean = preg_replace( '/\D+/', '', $phone );
				echo '<span dir="ltr" style="font-weight:600;">' . esc_html( $phone ) . '</span><br>';
				echo '<a href="https://wa.me/' . esc_attr( $clean ) . '" target="_blank" rel="noopener" style="display:inline-flex; align-items:center; gap:4px; color:#16a34a; font-size:12px; text-decoration:none; margin-top:2px;">';
				echo '<span class="dashicons dashicons-whatsapp" style="font-size:14px; width:14px; height:14px;"></span> ' . esc_html__( 'واتساب', 'toppers' ) . '</a>';
			} else {
				echo '—';
			}
			break;

		case 'email':
			$email = get_post_meta( $post_id, '_inquiry_email', true );
			if ( $email ) {
				echo '<a href="mailto:' . esc_attr( $email ) . '" dir="ltr">' . esc_html( $email ) . '</a>';
			} else {
				echo '—';
			}
			break;

		case 'deadline':
			$dl = get_post_meta( $post_id, '_inquiry_deadline', true );
			echo esc_html( $dl ?: '—' );
			break;
	}
}

/**
 * Metabox for single Contact Request view in Dashboard.
 */
add_action( 'add_meta_boxes', 'toppers_contact_req_metaboxes' );
function toppers_contact_req_metaboxes() {
	add_meta_box(
		'toppers_contact_req_details',
		__( 'تفاصيل طلب الخدمة', 'toppers' ),
		'toppers_contact_req_details_callback',
		'toppers_contact_req',
		'normal',
		'high'
	);
}

function toppers_contact_req_details_callback( $post ) {
	$name     = get_the_title( $post->ID );
	$phone    = get_post_meta( $post->ID, '_inquiry_phone', true );
	$email    = get_post_meta( $post->ID, '_inquiry_email', true );
	$service  = get_post_meta( $post->ID, '_inquiry_service', true );
	$level    = get_post_meta( $post->ID, '_inquiry_level', true );
	$deadline = get_post_meta( $post->ID, '_inquiry_deadline', true );
	$details  = get_post_meta( $post->ID, '_inquiry_details', true );
	$clean    = preg_replace( '/\D+/', '', $phone );
	?>
	<div style="padding: 10px 5px; font-size: 14.5px; line-height: 1.8;">
		<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 24px;">
			<div style="background: #f8fafc; padding: 16px; border-radius: 8px; border: 1px solid #e2e8f0;">
				<p style="margin: 0 0 10px;"><strong><?php esc_html_e( 'اسم العميل:', 'toppers' ); ?></strong> <?php echo esc_html( $name ); ?></p>
				<p style="margin: 0 0 10px;">
					<strong><?php esc_html_e( 'رقم الجوال:', 'toppers' ); ?></strong>
					<span dir="ltr"><?php echo esc_html( $phone ); ?></span>
					<?php if ( $clean ) : ?>
						&nbsp; <a href="https://wa.me/<?php echo esc_attr( $clean ); ?>" target="_blank" class="button button-small" style="color:#16a34a; font-weight:600;"><span class="dashicons dashicons-whatsapp" style="margin-top:2px;"></span> <?php esc_html_e( 'واتساب', 'toppers' ); ?></a>
					<?php endif; ?>
				</p>
				<p style="margin: 0;"><strong><?php esc_html_e( 'البريد الإلكتروني:', 'toppers' ); ?></strong> <a href="mailto:<?php echo esc_attr( $email ); ?>" dir="ltr"><?php echo esc_html( $email ?: '—' ); ?></a></p>
			</div>

			<div style="background: #f8fafc; padding: 16px; border-radius: 8px; border: 1px solid #e2e8f0;">
				<p style="margin: 0 0 10px;"><strong><?php esc_html_e( 'الخدمة المطلوبة:', 'toppers' ); ?></strong> <span style="background: #fef3c7; color: #92400e; padding: 2px 8px; border-radius: 4px; font-weight: 600;"><?php echo esc_html( $service ?: '—' ); ?></span></p>
				<p style="margin: 0 0 10px;"><strong><?php esc_html_e( 'المرحلة الدراسية:', 'toppers' ); ?></strong> <?php echo esc_html( $level ?: '—' ); ?></p>
				<p style="margin: 0;"><strong><?php esc_html_e( 'الموعد المطلوب:', 'toppers' ); ?></strong> <?php echo esc_html( $deadline ?: '—' ); ?></p>
			</div>
		</div>

		<?php if ( $details ) : ?>
			<div style="background: #fff; border: 1px solid #e2e8f0; padding: 14px 18px; border-radius: 8px;">
				<strong style="display:block; margin-bottom: 6px;"><?php esc_html_e( 'تفاصيل وملاحظات الطلب:', 'toppers' ); ?></strong>
				<div style="color: #334155; white-space: pre-wrap; line-height: 1.8;"><?php echo esc_html( $details ); ?></div>
			</div>
		<?php endif; ?>
	</div>
	<?php
}

/**
 * -------------------------------------------------------------
 * Custom Columns for Newsletter Subscribers (المشتركون في النشرة)
 * -------------------------------------------------------------
 */
add_filter( 'manage_toppers_subscriber_posts_columns', 'toppers_subscriber_columns' );
function toppers_subscriber_columns( $cols ) {
	return array(
		'cb'    => '<input type="checkbox" />',
		'title' => __( 'البريد الإلكتروني للمشترك', 'toppers' ),
		'date'  => __( 'تاريخ الاشتراك', 'toppers' ),
	);
}

/**
 * Handle Newsletter Subscription via Ajax.
 */
add_action( 'wp_ajax_toppers_newsletter_subscribe', 'toppers_handle_newsletter_subscribe' );
add_action( 'wp_ajax_nopriv_toppers_newsletter_subscribe', 'toppers_handle_newsletter_subscribe' );
function toppers_handle_newsletter_subscribe() {
	check_ajax_referer( 'toppers_form', 'nonce' );

	$email = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
	if ( ! $email || ! is_email( $email ) ) {
		wp_send_json_error( array( 'message' => __( 'يرجى إدخال بريد إلكتروني صحيح.', 'toppers' ) ) );
	}

	$existing = get_page_by_title( $email, OBJECT, 'toppers_subscriber' );
	if ( ! $existing ) {
		wp_insert_post(
			array(
				'post_type'   => 'toppers_subscriber',
				'post_title'  => $email,
				'post_status' => 'publish',
			)
		);

		// Notify site administrator email
		$to      = toppers_notification_email();
		$subject = sprintf( '[Toppers Newsletter] مشترك جديد في النشرة: %s', $email );
		$body    = "تم تسجيل مشترك جديد في النشرة الإخبارية عبر الفوتر:\n\nالبريد الإلكتروني: {$email}\nتاريخ الاشتراك: " . wp_date( 'Y-m-d H:i' ) . "\n\nيمكنك مراجعة كافة المشتركين من الداش بورد > النشرة البريدية.";
		$headers = array( 'Content-Type: text/plain; charset=UTF-8' );
		wp_mail( $to, $subject, $body, $headers );
	}

	wp_send_json_success( array( 'message' => __( 'تم اشتراكك في النشرة البريدية بنجاح! شكرًا لك.', 'toppers' ) ) );
}
