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

$nav_fallback = static function () {
	$items = array(
		array( __( 'الرئيسية', 'toppers' ), home_url( '/' ) ),
		array( __( 'الخدمات', 'toppers' ), toppers_page_url( 'services' ) ),
		array( __( 'المساعد البحثي', 'toppers' ), toppers_page_url( 'ai-assistant' ) ),
		array(
			__( 'عن توبرز', 'toppers' ),
			toppers_page_url( 'about' ),
			array(
				array( __( 'من نحن', 'toppers' ), toppers_page_url( 'about' ) ),
				array( __( 'الضمانات', 'toppers' ), toppers_page_url( 'guarantees' ) ),
				array( __( 'فريق العمل', 'toppers' ), toppers_page_url( 'team' ) ),
				array( __( 'انضم إلى توبرز', 'toppers' ), toppers_page_url( 'careers' ) ),
				array( __( 'الأسئلة الشائعة', 'toppers' ), toppers_page_url( 'faq' ) ),
			),
		),
		array( __( 'آراء العملاء', 'toppers' ), toppers_page_url( 'testimonials' ) ),
		array( __( 'المدونة', 'toppers' ), toppers_blog_url() ),
		array( __( 'تواصل معنا', 'toppers' ), toppers_page_url( 'contact' ) ),
	);
	foreach ( $items as $row ) {
		$has_kids = ! empty( $row[2] ) && is_array( $row[2] );
		echo '<li class="menu-item' . ( $has_kids ? ' menu-item-has-children' : '' ) . '">';
		echo '<a href="' . esc_url( $row[1] ) . '">' . esc_html( $row[0] );
		if ( $has_kids ) {
			echo ' <i class="fa-solid fa-chevron-down nav-caret" aria-hidden="true"></i>';
		}
		echo '</a>';
		if ( $has_kids ) {
			echo '<button type="button" class="nav-submenu-toggle" aria-expanded="false" aria-label="' . esc_attr__( 'فتح القائمة الفرعية', 'toppers' ) . '"><i class="fa-solid fa-chevron-down" aria-hidden="true"></i></button>';
			echo '<ul class="sub-menu">';
			foreach ( $row[2] as $child ) {
				echo '<li class="menu-item"><a href="' . esc_url( $child[1] ) . '">' . esc_html( $child[0] ) . '</a></li>';
			}
			echo '</ul>';
		}
		echo '</li>';
	}
};
$header_bg    = toppers_opt( 'toppers_header_bg', '' );
$header_style = $header_bg ? ' style="background:' . esc_attr( $header_bg ) . ';"' : '';
?>

<header class="site-header is-scrolled header-separated"<?php echo $header_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
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
						'items_wrap'     => '<ul class="nav-menu-list">%3$s</ul>',
						'fallback_cb'    => false,
						'depth'          => 2,
						'walker'         => new Toppers_Flat_Walker(),
					)
				);
			} else {
				echo '<ul class="nav-menu-list">';
				$nav_fallback();
				echo '</ul>';
			}
			?>
		</nav>
		<div class="header-actions">
			<?php
			$toppers_logged_in  = is_user_logged_in();
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
			<?php if ( is_user_logged_in() ) : ?>
				<a href="<?php echo esc_url( toppers_account_url() ); ?>" class="icon-btn user-profile-btn" aria-label="<?php esc_attr_e( 'حسابي', 'toppers' ); ?>" title="<?php esc_attr_e( 'حسابي', 'toppers' ); ?>">
					<i class="fa-solid fa-user" aria-hidden="true" style="font-size:20px;"></i>
				</a>
			<?php else : ?>
				<a href="<?php echo esc_url( toppers_login_url() ); ?>" class="btn btn-outline-dark btn-sm header-login-btn">
					<i class="fa-solid fa-arrow-right-to-bracket" aria-hidden="true"></i>
					<span><?php esc_html_e( 'تسجيل الدخول', 'toppers' ); ?></span>
				</a>
			<?php endif; ?>
			<button class="btn btn-gold btn-sm open-order-modal" type="button" data-i18n="nav.cta"><?php echo esc_html( $cta ); ?></button>
			<button class="burger" type="button" aria-label="<?php esc_attr_e( 'القائمة', 'toppers' ); ?>" aria-expanded="false"><span></span><span></span><span></span></button>
		</div>
	</div>
</header>

<div class="mobile-nav" id="toppersMobileNav" hidden>
	<div class="mobile-nav-panel">
		<div class="mobile-nav-top">
			<?php echo toppers_logo_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<button class="mobile-close" type="button" aria-label="<?php esc_attr_e( 'إغلاق', 'toppers' ); ?>">&times;</button>
		</div>
		<nav class="mobile-nav-links" aria-label="<?php esc_attr_e( 'قائمة الموبايل', 'toppers' ); ?>">
			<?php
			if ( has_nav_menu( 'mobile' ) || has_nav_menu( 'primary' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => has_nav_menu( 'mobile' ) ? 'mobile' : 'primary',
						'container'      => false,
						'items_wrap'     => '<ul class="nav-menu-list">%3$s</ul>',
						'fallback_cb'    => false,
						'depth'          => 2,
						'walker'         => new Toppers_Flat_Walker(),
					)
				);
			} else {
				echo '<ul class="nav-menu-list">';
				$nav_fallback();
				echo '</ul>';
			}
			?>
			<ul class="nav-menu-list nav-menu-list--account">
			<?php
			if ( is_user_logged_in() ) {
				echo '<li class="menu-item"><a href="' . esc_url( toppers_account_url() ) . '">' . esc_html__( 'حسابي', 'toppers' ) . '</a></li>';
				echo '<li class="menu-item"><a href="' . esc_url( toppers_logout_url() ) . '">' . esc_html__( 'تسجيل الخروج', 'toppers' ) . '</a></li>';
			} else {
				echo '<li class="menu-item"><a href="' . esc_url( toppers_login_url() ) . '">' . esc_html__( 'تسجيل الدخول', 'toppers' ) . '</a></li>';
				echo '<li class="menu-item"><a href="' . esc_url( toppers_register_url() ) . '">' . esc_html__( 'إنشاء حساب', 'toppers' ) . '</a></li>';
			}
			?>
			</ul>
		</nav>
		<div class="mobile-nav-cta">
			<button class="btn btn-gold btn-block open-order-modal" type="button"><?php echo esc_html( $cta ); ?></button>
			<button class="btn btn-outline-dark btn-block" type="button" data-lang-toggle style="margin-top:10px"><span data-lang-label>EN</span></button>
		</div>
	</div>
</div>
