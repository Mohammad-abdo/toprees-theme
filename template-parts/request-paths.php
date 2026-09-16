<?php
/**
 * Two request paths: WhatsApp or logged-in student portal.
 *
 * @package Toppers
 */

$service = isset( $args['service'] ) ? (string) $args['service'] : '';
$wa      = toppers_whatsapp_url();
if ( $service ) {
	$wa = add_query_arg( 'text', rawurlencode( 'أرغب في طلب خدمة: ' . $service ), $wa );
}
$system = toppers_system_request_url( $service );
?>
<div class="request-paths">
	<p class="request-paths-lede"><?php esc_html_e( 'تقدر تطلب الخدمة بطريقتين: واتساب، أو من حسابك على المنصة بعد تسجيل الدخول.', 'toppers' ); ?></p>
	<div class="request-paths-grid">
		<a class="request-path-card" href="<?php echo esc_url( $wa ); ?>" target="_blank" rel="noopener">
			<span class="request-path-kicker"><?php esc_html_e( 'الطريقة الأولى', 'toppers' ); ?></span>
			<strong><?php esc_html_e( 'تواصل عبر واتساب', 'toppers' ); ?></strong>
			<span><?php esc_html_e( 'راسلنا مباشرة ونكمل معك التفاصيل من هناك.', 'toppers' ); ?></span>
		</a>
		<a class="request-path-card request-path-card--system" href="<?php echo esc_url( $system ); ?>">
			<span class="request-path-kicker"><?php esc_html_e( 'الطريقة الثانية', 'toppers' ); ?></span>
			<strong><?php echo is_user_logged_in() ? esc_html__( 'اطلب من حسابك', 'toppers' ) : esc_html__( 'سجّل دخول واطلب من المنصة', 'toppers' ); ?></strong>
			<span><?php esc_html_e( 'الطلب يظهر في حساب الطالب، ويوصل لفريق توبرز لنكمل الفلو المعتاد.', 'toppers' ); ?></span>
		</a>
	</div>
</div>
