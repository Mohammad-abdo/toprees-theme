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
				<i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
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

	<div class="t-stars"><?php echo str_repeat( '<i class="fa-solid fa-star" aria-hidden="true"></i>', $stars ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
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
