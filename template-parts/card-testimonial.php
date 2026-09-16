<?php
/**
 * Single testimonial card.
 *
 * @package Toppers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$id    = get_the_ID();
$type  = toppers_testimonial_type( $id );
$role  = get_post_meta( $id, '_toppers_role', true );
$stars = max( 1, min( 5, (int) get_post_meta( $id, '_toppers_stars', true ) ?: 5 ) );
$audio = (int) get_post_meta( $id, '_toppers_audio_id', true );
$types = toppers_testimonial_types();
$img   = get_the_post_thumbnail_url( $id, 'large' );
if ( ! $img ) {
	$file = get_post_meta( $id, '_toppers_image', true );
	$img  = $file ? toppers_img( $file ) : '';
}
$quote = wp_strip_all_tags( get_the_content() );
?>
<article class="t-card t-card--<?php echo esc_attr( $type ); ?>" data-type="<?php echo esc_attr( $type ); ?>">
	<span class="t-badge"><?php echo esc_html( $types[ $type ] ); ?></span>

	<?php if ( in_array( $type, array( 'image', 'whatsapp', 'photo' ), true ) && $img ) : ?>
		<div class="t-screenshot-wrap" data-full-image="<?php echo esc_url( get_the_post_thumbnail_url( $id, 'full' ) ?: $img ); ?>" title="<?php esc_attr_e( 'انقر لتكبير السكرين شوت', 'toppers' ); ?>">
			<img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="t-screenshot-img">
			<div class="t-zoom-overlay">
				<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
				<span><?php esc_html_e( 'تكبير', 'toppers' ); ?></span>
			</div>
		</div>
	<?php endif; ?>

	<?php if ( $audio && 'voice' === $type ) : ?>
		<?php $audio_url = wp_get_attachment_url( $audio ); ?>
		<?php if ( $audio_url ) : ?>
			<?php echo toppers_audio_player( $audio_url, get_post_meta( $id, '_toppers_audio_time', true ) ?: '0:45' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php endif; ?>
	<?php endif; ?>

	<div class="t-stars"><?php echo esc_html( str_repeat( '★', $stars ) ); ?></div>
	<?php if ( $quote && 'whatsapp' !== $type ) : ?>
		<p class="t-quote"><?php echo esc_html( $quote ); ?></p>
	<?php endif; ?>
	<div class="t-who">
		<?php if ( has_post_thumbnail() && 'whatsapp' !== $type ) : ?>
			<?php the_post_thumbnail( 'thumbnail', array( 'class' => 't-avatar' ) ); ?>
		<?php else : ?>
			<div class="t-avatar"><?php echo esc_html( toppers_first_letter( get_the_title() ) ); ?></div>
		<?php endif; ?>
		<div>
			<b><?php the_title(); ?></b>
			<?php if ( $role ) : ?>
				<span><?php echo esc_html( $role ); ?></span>
			<?php endif; ?>
		</div>
	</div>
</article>
