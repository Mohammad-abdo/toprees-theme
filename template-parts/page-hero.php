<?php
/**
 * Inner page hero matching final-v.1.
 *
 * @package Toppers
 */

$title   = $args['title'] ?? get_the_title();
$lede    = $args['lede'] ?? '';
$eyebrow = $args['eyebrow'] ?? '';
$image   = $args['image'] ?? '';
$crumb   = $args['crumb'] ?? $title;
$center  = ! empty( $args['center'] );
$orbs    = ! empty( $args['orbs'] );
$plain   = ! empty( $args['plain'] );
$extra   = $args['extra'] ?? '';
if ( ! $plain ) {
	if ( ! $image && has_post_thumbnail() ) {
		$image = get_the_post_thumbnail_url( get_the_ID(), 'toppers-hero' );
	}
	if ( ! $image ) {
		$image = toppers_photo( 'campus' );
	}
}
$bg = '';
if ( ! $plain && $image ) {
	$bg = 'background: linear-gradient(135deg, rgba(14,23,48,0.95) 0%, rgba(26,45,92,0.95) 100%), url(\'' . esc_url( $image ) . '\') center/cover no-repeat;';
	if ( $orbs ) {
		$bg .= ' padding-top: 180px; padding-bottom: 120px; position: relative; overflow: hidden;';
	}
}
?>
<section class="page-hero"<?php echo $bg ? ' style="' . $bg . '"' : ''; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php if ( $orbs ) : ?>
		<div style="position: absolute; top: -100px; right: -100px; width: 400px; height: 400px; background: rgba(201,154,59,0.3); filter: blur(100px); border-radius: 50%;"></div>
		<div style="position: absolute; bottom: -100px; left: -100px; width: 500px; height: 500px; background: rgba(14,23,48,0.8); filter: blur(150px); border-radius: 50%;"></div>
	<?php else : ?>
		<div class="hero-field"></div>
	<?php endif; ?>
	<div class="container" style="position: relative; z-index: 2;<?php echo $center ? ' text-align: center;' : ''; ?>">
		<div class="breadcrumb"<?php echo $center ? ' style="justify-content: center;"' : ''; ?>>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'الرئيسية', 'toppers' ); ?></a>
			<?php if ( ! empty( $args['parent'] ) ) : ?>
				<span>/</span>
				<a href="<?php echo esc_url( $args['parent'][1] ); ?>"><?php echo esc_html( $args['parent'][0] ); ?></a>
			<?php endif; ?>
			<span>/</span>
			<span><?php echo esc_html( wp_strip_all_tags( $crumb ) ); ?></span>
		</div>
		<?php if ( $eyebrow ) : ?>
			<div class="eyebrow" style="color:var(--gold-light);<?php echo $center ? ' justify-content: center;' : ''; ?>"><?php echo toppers_star_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php echo esc_html( $eyebrow ); ?></span></div>
		<?php endif; ?>
		<h1<?php echo $center ? ' style="font-size: 48px; margin-bottom: 24px;"' : ''; ?>><?php echo esc_html( wp_strip_all_tags( $title ) ); ?></h1>
		<?php if ( $lede ) : ?>
			<p style="max-width:<?php echo $center ? '70ch' : '65ch'; ?>;<?php echo $center ? ' margin: 0 auto;' : ''; ?> color:rgba(255,255,255,.8); font-size: 18px; line-height: 1.8;"><?php echo esc_html( wp_strip_all_tags( $lede ) ); ?></p>
		<?php endif; ?>
		<?php
		if ( $extra ) {
			echo $extra; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		?>
	</div>
</section>
