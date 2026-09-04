<?php
/**
 * Front page — Elementor-first when editing or when page has Elementor data.
 *
 * @package Tek_Craft_Toppres
 */

get_header();
?>
<main id="primary" class="site-main">
	<?php
	$rendered = false;
	$is_edit  = false;

	if ( class_exists( '\Elementor\Plugin' ) ) {
		$plugin = \Elementor\Plugin::$instance;
		if ( isset( $plugin->editor ) && method_exists( $plugin->editor, 'is_edit_mode' ) && $plugin->editor->is_edit_mode() ) {
			$is_edit = true;
		}
		if ( isset( $plugin->preview ) && method_exists( $plugin->preview, 'is_preview_mode' ) && $plugin->preview->is_preview_mode() ) {
			$is_edit = true;
		}
	}

	if ( is_front_page() && is_page() ) {
		while ( have_posts() ) {
			the_post();

			// Always output page content in Elementor editor/preview so widgets are editable.
			if ( $is_edit || tk_is_elementor_page() || ( isset( $_GET['elementor-preview'] ) ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				$rendered = true;
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
				</article>
				<?php
			} elseif ( trim( (string) get_the_content() ) !== '' ) {
				$rendered = true;
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content container section--tight">
						<?php the_content(); ?>
					</div>
				</article>
				<?php
			}
		}
	}

	if ( ! $rendered ) {
		get_template_part( 'template-parts/home/content' );
	}
	?>
</main>
<?php
get_footer();
