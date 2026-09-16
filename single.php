<?php
/**
 * Single post.
 *
 * @package Toppers
 */

get_header();

if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'single' ) ) {
	get_footer();
	return;
}
$cats = get_the_category();
?>
<main class="site-main">
	<?php
	while ( have_posts() ) :
		the_post();
		if ( toppers_is_elementor_page() ) {
			the_content();
			continue;
		}
		get_template_part(
			'template-parts/page-hero',
			null,
			array(
				'title'   => get_the_title(),
				'lede'    => get_the_date() . ' · ' . __( '5 دقائق قراءة', 'toppers' ),
				'eyebrow' => $cats ? $cats[0]->name : __( 'المدونة', 'toppers' ),
			)
		);
		?>
		<section class="section">
			<div class="container article-layout">
				<article class="article-body">
					<?php if ( has_post_thumbnail() ) : ?>
						<img src="<?php the_post_thumbnail_url( 'large' ); ?>" alt="<?php the_title_attribute(); ?>" style="border-radius:20px;margin-bottom:32px;width:100%;">
					<?php endif; ?>
					<div class="entry-content"><?php the_content(); ?></div>
					<?php if ( has_tag() ) : ?>
						<div style="margin-top:24px"><?php the_tags( '', ' · ' ); ?></div>
					<?php endif; ?>
				</article>
				<aside class="blog-side">
					<h4><?php esc_html_e( 'بحث في المدونة', 'toppers' ); ?></h4>
					<?php get_search_form(); ?>
					<h4><?php esc_html_e( 'التصنيفات', 'toppers' ); ?></h4>
					<ul>
						<?php wp_list_categories( array( 'title_li' => '', 'show_count' => true ) ); ?>
					</ul>
					<h4><?php esc_html_e( 'أحدث المقالات', 'toppers' ); ?></h4>
					<ul>
						<?php
						$recent = wp_get_recent_posts( array( 'numberposts' => 4, 'post_status' => 'publish' ) );
						foreach ( $recent as $item ) {
							echo '<li><a href="' . esc_url( get_permalink( $item['ID'] ) ) . '">' . esc_html( $item['post_title'] ) . '</a></li>';
						}
						?>
					</ul>
				</aside>
			</div>
		</section>
		<section class="section section--alt">
			<div class="container">
				<h2><?php esc_html_e( 'مقالات ذات صلة', 'toppers' ); ?></h2>
				<div class="grid grid-3">
					<?php
					$related = new WP_Query(
						array(
							'post_type'      => 'post',
							'posts_per_page' => 3,
							'post__not_in'   => array( get_the_ID() ),
							'category__in'   => wp_get_post_categories( get_the_ID() ),
						)
					);
					if ( $related->have_posts() ) {
						while ( $related->have_posts() ) {
							$related->the_post();
							get_template_part( 'template-parts/card-post' );
						}
						wp_reset_postdata();
					}
					?>
				</div>
			</div>
		</section>
		<?php
	endwhile;
	?>
</main>
<?php
get_footer();
