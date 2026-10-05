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
?>
<main class="site-main">
	<?php
	while ( have_posts() ) :
		the_post();
		if ( toppers_is_elementor_page() ) {
			the_content();
			continue;
		}

		$cats       = get_the_category();
		$cat_name   = $cats ? $cats[0]->name : __( 'المدونة', 'toppers' );
		$cat_link   = $cats ? get_category_link( $cats[0]->term_id ) : get_permalink( get_option( 'page_for_posts' ) );
		$word_count = str_word_count( wp_strip_all_tags( get_the_content() ) );
		$read_mins  = max( 1, (int) ceil( $word_count / 180 ) );
		$thumb      = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'large' ) : '';
		$hero_img   = $thumb ? get_the_post_thumbnail_url( get_the_ID(), 'toppers-hero' ) : '';
		?>
		<section class="single-post-hero<?php echo $hero_img ? ' has-cover' : ''; ?>"<?php echo $hero_img ? ' style="--sp-cover:url(' . esc_url( $hero_img ) . ')"' : ''; ?>>
			<div class="container single-post-hero-inner">
				<nav class="breadcrumb" aria-label="<?php esc_attr_e( 'مسار التنقل', 'toppers' ); ?>">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'الرئيسية', 'toppers' ); ?></a>
					<span>/</span>
					<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'المدونة', 'toppers' ); ?></a>
					<span>/</span>
					<span><?php the_title(); ?></span>
				</nav>
				<div class="eyebrow"><?php echo toppers_star_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php echo esc_html( $cat_name ); ?></span></div>
				<h1><?php the_title(); ?></h1>
				<div class="single-post-meta">
					<span><i class="fa-regular fa-calendar" aria-hidden="true"></i> <?php echo esc_html( get_the_date() ); ?></span>
					<span><i class="fa-regular fa-clock" aria-hidden="true"></i> <?php echo esc_html( sprintf( /* translators: %d: minutes */ _n( '%d دقيقة قراءة', '%d دقائق قراءة', $read_mins, 'toppers' ), $read_mins ) ); ?></span>
					<?php if ( $cats ) : ?>
						<a class="single-post-cat" href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_html( $cat_name ); ?></a>
					<?php endif; ?>
				</div>
			</div>
		</section>

		<section class="section single-post-sec">
			<div class="container article-layout">
				<article <?php post_class( 'article-body' ); ?>>
					<figure class="single-post-figure<?php echo $thumb ? '' : ' is-placeholder'; ?>">
						<?php if ( $thumb ) : ?>
							<img src="<?php echo esc_url( $thumb ); ?>" alt="<?php the_title_attribute(); ?>" loading="eager">
						<?php else : ?>
							<div class="single-post-figure-empty">
								<i class="fa-regular fa-image" aria-hidden="true"></i>
								<span><?php esc_html_e( 'أضف صورة بارزة للمقال من لوحة التحكم', 'toppers' ); ?></span>
							</div>
						<?php endif; ?>
						<?php if ( get_the_post_thumbnail_caption() ) : ?>
							<figcaption><?php echo esc_html( get_the_post_thumbnail_caption() ); ?></figcaption>
						<?php endif; ?>
					</figure>

					<?php if ( has_excerpt() ) : ?>
						<p class="single-post-lede"><?php echo esc_html( get_the_excerpt() ); ?></p>
					<?php endif; ?>

					<div class="entry-content"><?php the_content(); ?></div>

					<?php if ( has_tag() ) : ?>
						<div class="single-post-tags">
							<span class="single-post-tags-label"><?php esc_html_e( 'الوسوم:', 'toppers' ); ?></span>
							<?php the_tags( '', '' ); ?>
						</div>
					<?php endif; ?>

					<footer class="single-post-share">
						<span><?php esc_html_e( 'هل أفادك المقال؟', 'toppers' ); ?></span>
						<a class="btn btn-whatsapp btn-sm" href="<?php echo esc_url( toppers_whatsapp_url() ); ?>" target="_blank" rel="noopener">
							<i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
							<?php esc_html_e( 'تواصل للاستشارة', 'toppers' ); ?>
						</a>
					</footer>
				</article>

				<aside class="blog-side">
					<div class="blog-side-card">
						<h4><?php esc_html_e( 'بحث في المدونة', 'toppers' ); ?></h4>
						<?php get_search_form(); ?>
					</div>
					<div class="blog-side-card">
						<h4><?php esc_html_e( 'التصنيفات', 'toppers' ); ?></h4>
						<ul class="blog-side-list">
							<?php wp_list_categories( array( 'title_li' => '', 'show_count' => true ) ); ?>
						</ul>
					</div>
					<div class="blog-side-card">
						<h4><?php esc_html_e( 'أحدث المقالات', 'toppers' ); ?></h4>
						<ul class="blog-side-recent">
							<?php
							$recent = wp_get_recent_posts(
								array(
									'numberposts'  => 4,
									'post_status'  => 'publish',
									'post__not_in' => array( get_the_ID() ),
								)
							);
							foreach ( $recent as $item ) {
								$rid  = (int) $item['ID'];
								$rimg = get_the_post_thumbnail_url( $rid, 'thumbnail' );
								echo '<li>';
								echo '<a href="' . esc_url( get_permalink( $rid ) ) . '">';
								if ( $rimg ) {
									echo '<img src="' . esc_url( $rimg ) . '" alt="" loading="lazy">';
								} else {
									echo '<span class="blog-side-thumb-fallback" aria-hidden="true"><i class="fa-solid fa-book-open"></i></span>';
								}
								echo '<span>' . esc_html( $item['post_title'] ) . '</span>';
								echo '</a></li>';
							}
							?>
						</ul>
					</div>
					<div class="blog-side-cta">
						<p><?php esc_html_e( 'تحتاج مساعدة في بحثك؟', 'toppers' ); ?></p>
						<button type="button" class="btn btn-gold btn-sm btn-block open-order-modal"><?php esc_html_e( 'اطلب خدمة', 'toppers' ); ?></button>
					</div>
				</aside>
			</div>
		</section>

		<section class="section section--alt single-related-sec">
			<div class="container">
				<div class="section-head">
					<div class="eyebrow"><?php echo toppers_star_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'المزيد', 'toppers' ); ?></span></div>
					<h2><?php esc_html_e( 'مقالات ذات صلة', 'toppers' ); ?></h2>
				</div>
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
					} else {
						echo '<p class="t-empty">' . esc_html__( 'لا توجد مقالات ذات صلة حالياً.', 'toppers' ) . '</p>';
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
