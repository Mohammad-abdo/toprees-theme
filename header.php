<?php
/**
 * Theme header — matching final-v.1.
 *
 * @package Toppers
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'header' ) ) {
	return;
}
$cta = toppers_opt( 'toppers_cta_label', 'اطلب خدمتك' );
?>

<header class="site-header<?php echo ( is_page_template( 'templates/page-about.php' ) || is_home() || is_singular( 'post' ) || is_search() || is_404() || ( ! is_front_page() && function_exists( 'toppers_is_elementor_page' ) && toppers_is_elementor_page() ) ) ? ' is-scrolled' : ''; ?>">
	<div class="container header-inner">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand">
			<?php echo toppers_logo_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</a>
		<nav class="nav-desktop" aria-label="<?php esc_attr_e( 'القائمة الرئيسية', 'toppers' ); ?>">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'items_wrap'     => '%3$s',
						'fallback_cb'    => false,
						'depth'          => 1,
						'walker'         => new Toppers_Flat_Walker(),
					)
				);
			} else {
				echo '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'الرئيسية', 'toppers' ) . '</a>';
				echo '<a href="' . esc_url( toppers_page_url( 'services' ) ) . '">' . esc_html__( 'الخدمات', 'toppers' ) . '</a>';
				echo '<a href="' . esc_url( toppers_page_url( 'about' ) ) . '">' . esc_html__( 'من نحن', 'toppers' ) . '</a>';
				echo '<a href="' . esc_url( toppers_page_url( 'faq' ) ) . '">' . esc_html__( 'الأسئلة الشائعة', 'toppers' ) . '</a>';
				echo '<a href="' . esc_url( toppers_page_url( 'testimonials' ) ) . '">' . esc_html__( 'آراء الطلاب', 'toppers' ) . '</a>';
				echo '<a href="' . esc_url( toppers_blog_url() ) . '">' . esc_html__( 'المقالات', 'toppers' ) . '</a>';
				echo '<a href="' . esc_url( toppers_page_url( 'contact' ) ) . '">' . esc_html__( 'تواصل معنا', 'toppers' ) . '</a>';
			}
			?>
		</nav>
		<div class="header-actions">
			<?php
			$toppers_logged_in = is_user_logged_in();
			$toppers_all_notifs = $toppers_logged_in ? toppers_user_notifications( 0 ) : array();
			$toppers_unread     = 0;
			foreach ( $toppers_all_notifs as $n ) {
				if ( toppers_notification_unread( $n ) ) {
					++$toppers_unread;
				}
			}
			$toppers_notifs = array_slice( $toppers_all_notifs, 0, 6 );
			?>
			<div class="header-dropdown" id="notifDropdownToggle">
				<button class="icon-btn" type="button" aria-label="<?php esc_attr_e( 'الإشعارات', 'toppers' ); ?>" aria-expanded="false" aria-controls="notifMenu">
					<i class="fa-solid fa-bell" aria-hidden="true" style="font-size:20px;"></i>
					<?php if ( $toppers_unread > 0 ) : ?>
						<span class="notif-badge"><?php echo esc_html( $toppers_unread > 9 ? '9+' : (string) $toppers_unread ); ?></span>
					<?php endif; ?>
				</button>
				<div class="dropdown-menu notif-menu" id="notifMenu" role="menu">
					<div class="notif-header">
						<span><?php esc_html_e( 'الإشعارات', 'toppers' ); ?></span>
						<?php if ( $toppers_logged_in && $toppers_unread > 0 ) : ?>
							<button class="notif-read-all" type="button" data-notif-read-all><?php esc_html_e( 'تعيين الكل كمقروء', 'toppers' ); ?></button>
						<?php endif; ?>
					</div>
					<div class="notif-list">
						<?php if ( ! $toppers_logged_in ) : ?>
							<div class="notif-empty">
								<p><?php esc_html_e( 'سجّل دخولك لمتابعة تنبيهات طلباتك من المنصة.', 'toppers' ); ?></p>
								<a class="btn btn-navy btn-sm" href="<?php echo esc_url( toppers_login_url() ); ?>"><?php esc_html_e( 'تسجيل الدخول', 'toppers' ); ?></a>
							</div>
						<?php elseif ( empty( $toppers_notifs ) ) : ?>
							<div class="notif-empty">
								<p><?php esc_html_e( 'لا توجد إشعارات حالياً. ستصلك تحديثات عند تغيّر حالة طلبك.', 'toppers' ); ?></p>
							</div>
						<?php else : ?>
							<?php foreach ( $toppers_notifs as $nt ) : ?>
								<?php
								$nt_unread = toppers_notification_unread( $nt );
								$nt_title  = (string) ( $nt['title'] ?? __( 'تحديث على طلبك', 'toppers' ) );
								$nt_body   = (string) ( $nt['body'] ?? '' );
								$nt_time   = (string) ( $nt['created_at'] ?? '' );
								$nt_id     = isset( $nt['id'] ) ? (int) $nt['id'] : 0;
								?>
								<a class="notif-item<?php echo $nt_unread ? ' unread' : ''; ?>" href="<?php echo esc_url( toppers_notification_link( $nt ) ); ?>"<?php echo $nt_id ? ' data-notif-id="' . esc_attr( (string) $nt_id ) . '"' : ''; ?>>
									<div class="notif-title"><?php echo esc_html( $nt_title ); ?></div>
									<?php if ( $nt_body ) : ?>
										<div class="notif-desc"><?php echo esc_html( wp_trim_words( $nt_body, 18 ) ); ?></div>
									<?php endif; ?>
									<?php if ( $nt_time ) : ?>
										<div class="notif-time"><?php echo esc_html( $nt_time ); ?></div>
									<?php endif; ?>
								</a>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
					<?php if ( $toppers_logged_in ) : ?>
						<a href="<?php echo esc_url( toppers_account_url( 'notifications' ) ); ?>" class="notif-footer"><?php esc_html_e( 'عرض كل الإشعارات', 'toppers' ); ?></a>
					<?php endif; ?>
				</div>
			</div>
			<a href="<?php echo esc_url( toppers_account_url() ); ?>" class="icon-btn user-profile-btn" aria-label="<?php echo is_user_logged_in() ? esc_attr__( 'حسابي', 'toppers' ) : esc_attr__( 'تسجيل الدخول', 'toppers' ); ?>" title="<?php echo is_user_logged_in() ? esc_attr__( 'حسابي', 'toppers' ) : esc_attr__( 'تسجيل الدخول', 'toppers' ); ?>">
				<i class="fa-solid fa-user" aria-hidden="true" style="font-size:20px;"></i>
			</a>
			<button class="btn btn-gold btn-sm open-order-modal" type="button" data-i18n="nav.cta"><?php echo esc_html( $cta ); ?></button>
			<button class="burger" type="button" aria-label="<?php esc_attr_e( 'القائمة', 'toppers' ); ?>"><span></span><span></span><span></span></button>
		</div>
	</div>
</header>

<div class="mobile-nav">
	<div class="mobile-nav-top">
		<?php echo toppers_logo_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<button class="mobile-close" type="button" aria-label="<?php esc_attr_e( 'إغلاق', 'toppers' ); ?>">&times;</button>
	</div>
	<?php
	if ( has_nav_menu( 'mobile' ) || has_nav_menu( 'primary' ) ) {
		wp_nav_menu(
			array(
				'theme_location' => has_nav_menu( 'mobile' ) ? 'mobile' : 'primary',
				'container'      => false,
				'items_wrap'     => '%3$s',
				'fallback_cb'    => false,
				'depth'          => 1,
				'walker'         => new Toppers_Flat_Walker(),
			)
		);
	} else {
		echo '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'الرئيسية', 'toppers' ) . '</a>';
		echo '<a href="' . esc_url( toppers_page_url( 'services' ) ) . '">' . esc_html__( 'الخدمات', 'toppers' ) . '</a>';
		echo '<a href="' . esc_url( toppers_page_url( 'about' ) ) . '">' . esc_html__( 'من نحن', 'toppers' ) . '</a>';
		echo '<a href="' . esc_url( toppers_page_url( 'faq' ) ) . '">' . esc_html__( 'الأسئلة الشائعة', 'toppers' ) . '</a>';
		echo '<a href="' . esc_url( toppers_page_url( 'testimonials' ) ) . '">' . esc_html__( 'آراء الطلاب', 'toppers' ) . '</a>';
		echo '<a href="' . esc_url( toppers_blog_url() ) . '">' . esc_html__( 'المقالات', 'toppers' ) . '</a>';
		echo '<a href="' . esc_url( toppers_page_url( 'contact' ) ) . '">' . esc_html__( 'تواصل معنا', 'toppers' ) . '</a>';
	}
	if ( is_user_logged_in() ) {
		echo '<a href="' . esc_url( toppers_account_url() ) . '">' . esc_html__( 'حسابي', 'toppers' ) . '</a>';
		echo '<a href="' . esc_url( toppers_logout_url() ) . '">' . esc_html__( 'تسجيل الخروج', 'toppers' ) . '</a>';
	} else {
		echo '<a href="' . esc_url( toppers_login_url() ) . '">' . esc_html__( 'تسجيل الدخول', 'toppers' ) . '</a>';
		echo '<a href="' . esc_url( toppers_register_url() ) . '">' . esc_html__( 'إنشاء حساب', 'toppers' ) . '</a>';
	}
	?>
	<button class="btn btn-gold btn-block" type="button" data-lang-toggle style="margin-top:22px"><span data-lang-label>EN</span></button>
</div>
