<?php
/**
 * Service card.
 *
 * @package Toppers
 */

$badge = get_post_meta( get_the_ID(), '_toppers_badge', true );
$img = toppers_service_image( get_the_ID() );
?>
<a href="<?php the_permalink(); ?>" class="service-card">
	<div class="sc-img">
		<img src="<?php echo esc_url( $img ); ?>" alt="<?php the_title_attribute(); ?>">
		<?php if ( $badge ) : ?>
			<span class="sc-badge"><?php echo esc_html( $badge ); ?></span>
		<?php endif; ?>
	</div>
	<div class="sc-content">
		<h3><?php the_title(); ?></h3>
		<p><?php echo esc_html( get_the_excerpt() ?: wp_trim_words( wp_strip_all_tags( get_the_content() ), 18 ) ); ?></p>
		<span class="sc-link"><?php esc_html_e( 'التفاصيل', 'toppers' ); ?> <span class="arrow">&larr;</span></span>
	</div>
</a>
