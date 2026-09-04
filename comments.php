<?php
/**
 * Comments template.
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area container section--tight">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$tk_count = get_comments_number();
			printf(
				/* translators: 1: comment count, 2: post title */
				esc_html( _n( 'تعليق واحد على &ldquo;%2$s&rdquo;', '%1$s تعليقات على &ldquo;%2$s&rdquo;', $tk_count, 'tek-craft-toppres' ) ),
				esc_html( number_format_i18n( $tk_count ) ),
				esc_html( get_the_title() )
			);
			?>
		</h2>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
				)
			);
			?>
		</ol>

		<?php the_comments_navigation(); ?>
	<?php endif; ?>

	<?php
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<p class="no-comments"><?php esc_html_e( 'التعليقات مغلقة.', 'tek-craft-toppres' ); ?></p>
		<?php
	endif;

	comment_form();
	?>
</div>
