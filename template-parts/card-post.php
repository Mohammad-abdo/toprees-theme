<?php
/**
 * Blog card.
 *
 * @package Toppers
 */

$img = get_the_post_thumbnail_url( get_the_ID(), 'toppers-card' );
if ( ! $img ) {
	$fallback = get_post_meta( get_the_ID(), '_toppers_image', true );
	$img      = $fallback ? toppers_img( $fallback ) : toppers_img( 'masters.jpg' );
}
$cat = get_the_category();
$badge = $cat ? $cat[0]->name : __( 'مقال', 'toppers' );
$slugs = $cat ? implode( ' ', wp_list_pluck( $cat, 'slug' ) ) : '';
?>
<a href="<?php the_permalink(); ?>" class="article-card" data-cat="<?php echo esc_attr( $slugs ); ?>">
	<div class="ac-img">
		<img src="<?php echo esc_url( $img ); ?>" alt="<?php the_title_attribute(); ?>">
		<span class="ac-badge"><?php echo esc_html( $badge ); ?></span>
	</div>
	<div class="ac-content">
		<div class="ac-meta"><span><?php echo esc_html( get_the_date() ); ?></span> • <span><?php esc_html_e( '5 دقائق قراءة', 'toppers' ); ?></span></div>
		<h3><?php the_title(); ?></h3>
		<p><?php echo esc_html( get_the_excerpt() ); ?></p>
		<span class="ac-link"><?php esc_html_e( 'اقرأ المزيد', 'toppers' ); ?> &larr;</span>
	</div>
</a>
