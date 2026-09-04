<?php
/**
 * Page template — Elementor + imported HTML.
 *
 * @package Tek_Craft_Toppres
 */

get_header();
?>
<main id="primary" class="site-main">
	<?php
	while ( have_posts() ) :
		the_post();
		$is_elementor = tk_is_elementor_page();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if ( ! $is_elementor ) : ?>
				<header class="page-header container section--tight">
					<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
				</header>
			<?php endif; ?>
			<div class="entry-content<?php echo $is_elementor ? '' : ' container'; ?>">
				<?php the_content(); ?>
			</div>
		</article>
		<?php
	endwhile;
	?>
</main>
<?php
get_footer();
