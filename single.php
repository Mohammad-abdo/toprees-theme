<?php
/**
 * Single post — layout matched to new-single-blog.html.
 *
 * @package Tek_Craft_Toppres
 */

get_header();

$cats       = get_the_category();
$badge      = $cats ? $cats[0]->name : __( 'نصائح أكاديمية', 'tek-craft-toppres' );
$cover      = get_the_post_thumbnail_url( get_the_ID(), 'full' );
if ( ! $cover && function_exists( 'tk_default_media_url' ) ) {
	$cover = tk_default_media_url( 'article' );
}
$blog_url   = get_permalink( (int) get_option( 'page_for_posts' ) ) ?: home_url( '/blog/' );
$share_url  = rawurlencode( get_permalink() );
$share_text = rawurlencode( get_the_title() );
$author     = get_the_author();
$author_ini = function_exists( 'mb_substr' ) ? mb_substr( $author, 0, 1 ) : substr( $author, 0, 1 );

/**
 * Build TOC from h2 headings in content.
 *
 * @param string $content Post content.
 * @return array{html:string,content:string}
 */
function tk_single_prepare_toc( $content ) {
	$index = 0;
	$html  = '';
	$out   = preg_replace_callback(
		'/<h2([^>]*)>(.*?)<\/h2>/isu',
		static function ( $m ) use ( &$index, &$html ) {
			++$index;
			$id = 'sec' . $index;
			if ( preg_match( '/id=["\']([^"\']+)["\']/', $m[1], $im ) ) {
				$id = $im[1];
			}
			$text = wp_strip_all_tags( $m[2] );
			$html .= '<li><a href="#' . esc_attr( $id ) . '">' . esc_html( $text ) . '</a></li>';
			return '<h2 id="' . esc_attr( $id ) . '">' . $m[2] . '</h2>';
		},
		$content
	);
	return array(
		'html'    => $html,
		'content' => $out ? $out : $content,
	);
}
?>
<main id="primary" class="site-main tk-single-article">
	<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();

			if ( tk_is_elementor_page() ) :
				?>
				<div class="entry-content"><?php the_content(); ?></div>
				<?php
			else :
				$prepared = tk_single_prepare_toc( get_the_content() );
				$body     = apply_filters( 'the_content', $prepared['content'] );
				$toc_html = $prepared['html'];
				?>

				<div class="reading-progress" aria-hidden="true"><div class="reading-progress-bar" id="readProgress"></div></div>

				<section class="article-hero"<?php echo $cover ? ' style="background-image:linear-gradient(180deg,rgba(14,23,48,.55) 0%,rgba(14,23,48,.86) 78%,var(--ink) 100%),url(' . esc_url( $cover ) . ');background-size:cover;background-position:center;"' : ''; ?>>
					<div class="container article-hero-inner">
						<div class="breadcrumb">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'الرئيسية', 'tek-craft-toppres' ); ?></a>
							<span>/</span>
							<a href="<?php echo esc_url( $blog_url ); ?>"><?php esc_html_e( 'المدونة', 'tek-craft-toppres' ); ?></a>
							<span>/</span>
							<span><?php echo esc_html( $badge ); ?></span>
						</div>
						<span class="article-cat-pill">
							<?php echo function_exists( 'tk_star_svg' ) ? tk_star_svg() : ''; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<?php echo esc_html( $badge ); ?>
						</span>
						<?php the_title( '<h1>', '</h1>' ); ?>
						<div class="article-meta">
							<span class="am-item"><?php echo esc_html( get_the_date() ); ?></span>
							<span class="am-dot"></span>
							<span class="am-item"><?php echo esc_html( tk_reading_time() ); ?></span>
							<span class="am-dot"></span>
							<span class="am-item"><span class="am-avatar"><?php echo esc_html( $author_ini ); ?></span> <?php echo esc_html( $author ); ?></span>
						</div>
					</div>
				</section>

				<section class="section tk-article-section">
					<div class="container article-layout">
						<div class="article-main">
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="entry-content article-body">
									<?php echo $body; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</div>

								<div class="article-footer-row">
									<div class="article-tags">
										<?php
										$tags = get_the_tags();
										if ( $tags ) {
											foreach ( $tags as $tag ) {
												echo '<a href="' . esc_url( get_tag_link( $tag ) ) . '">' . esc_html( $tag->name ) . '</a>';
											}
										} else {
											echo '<a href="' . esc_url( $blog_url ) . '">' . esc_html( $badge ) . '</a>';
										}
										?>
									</div>
									<div class="share-row">
										<span class="label"><?php esc_html_e( 'مشاركة:', 'tek-craft-toppres' ); ?></span>
										<a href="<?php echo esc_url( 'https://twitter.com/intent/tweet?url=' . $share_url . '&text=' . $share_text ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
											<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M23 4.9c-.8.4-1.7.6-2.6.8 1-.6 1.7-1.5 2-2.6-.9.5-1.9.9-3 1.1-.9-.9-2.1-1.5-3.4-1.5-2.6 0-4.7 2.1-4.7 4.7 0 .4 0 .7.1 1-3.9-.2-7.4-2.1-9.7-5-.4.7-.6 1.5-.6 2.3 0 1.6.8 3.1 2.1 3.9-.7 0-1.5-.2-2.1-.6v.1c0 2.3 1.6 4.2 3.8 4.6-.4.1-.8.2-1.2.2-.3 0-.6 0-.9-.1.6 1.9 2.3 3.2 4.4 3.3-1.6 1.3-3.6 2-5.8 2-.4 0-.7 0-1.1-.1 2.1 1.3 4.5 2.1 7.1 2.1 8.6 0 13.3-7.1 13.3-13.3v-.6c.9-.7 1.7-1.5 2.3-2.4z"/></svg>
										</a>
										<a href="<?php echo esc_url( 'https://www.linkedin.com/sharing/share-offsite/?url=' . $share_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
											<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
										</a>
										<a href="<?php echo esc_url( 'https://wa.me/?text=' . $share_text . '%20' . $share_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
											<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a10 10 0 0 0-8.6 15L2 22l5.2-1.4A10 10 0 1 0 12 2zm0 18.2a8.1 8.1 0 0 1-4.2-1.1l-.3-.2-3.1.8.8-3-.2-.3A8.2 8.2 0 1 1 12 20.2zm4.5-6.1c-.2-.1-1.5-.7-1.7-.8-.2-.1-.4-.1-.6.1-.2.2-.7.8-.8 1-.2.2-.3.2-.5.1-1.4-.7-2.4-1.3-3.3-2.9-.3-.4.3-.4.7-1.3.1-.2 0-.4 0-.5-.1-.1-.6-1.5-.9-2-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.5.1-.7.3-.2.2-1 1-1 2.4s1 2.8 1.1 3c.1.2 2 3 4.8 4.2.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.5-.1 1.5-.6 1.8-1.2.2-.6.2-1.1.1-1.2 0-.2-.2-.2-.4-.3z"/></svg>
										</a>
									</div>
								</div>
							</article>
						</div>

						<aside class="article-sidebar" aria-label="<?php esc_attr_e( 'شريط المقال', 'tek-craft-toppres' ); ?>">
							<div class="side-widget">
								<h4><?php esc_html_e( 'بحث في المدونة', 'tek-craft-toppres' ); ?></h4>
								<form class="search-widget-wrap" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
									<input type="search" name="s" placeholder="<?php esc_attr_e( 'ابحث هنا...', 'tek-craft-toppres' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>">
									<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
								</form>
							</div>

							<?php if ( $toc_html ) : ?>
								<div class="side-widget">
									<h4><?php esc_html_e( 'محتويات المقال', 'tek-craft-toppres' ); ?></h4>
									<ul class="toc-list"><?php echo $toc_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></ul>
								</div>
							<?php endif; ?>

							<div class="side-widget">
								<h4><?php esc_html_e( 'الكاتب', 'tek-craft-toppres' ); ?></h4>
								<div class="author-card">
									<div class="aw-avatar"><?php echo esc_html( $author_ini ); ?></div>
									<div>
										<b><?php echo esc_html( $author ); ?></b>
										<span><?php esc_html_e( 'كاتب أكاديمي', 'tek-craft-toppres' ); ?></span>
									</div>
								</div>
							</div>

							<?php if ( $cats ) : ?>
								<div class="side-widget">
									<h4><?php esc_html_e( 'التصنيفات', 'tek-craft-toppres' ); ?></h4>
									<ul class="cat-list">
										<?php foreach ( $cats as $cat ) : ?>
											<li>
												<a href="<?php echo esc_url( get_category_link( $cat ) ); ?>">
													<span><?php echo esc_html( $cat->name ); ?></span>
													<span><?php echo esc_html( (string) $cat->count ); ?></span>
												</a>
											</li>
										<?php endforeach; ?>
									</ul>
								</div>
							<?php endif; ?>

							<div class="side-widget">
								<h4><?php esc_html_e( 'أحدث المقالات', 'tek-craft-toppres' ); ?></h4>
								<?php
								$recent = new WP_Query(
									array(
										'posts_per_page'      => 3,
										'post__not_in'        => array( get_the_ID() ),
										'ignore_sticky_posts' => true,
									)
								);
								if ( $recent->have_posts() ) :
									while ( $recent->have_posts() ) :
										$recent->the_post();
										$t = get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' );
										?>
										<a class="recent-item" href="<?php the_permalink(); ?>">
											<?php if ( $t ) : ?>
												<img src="<?php echo esc_url( $t ); ?>" alt="" width="66" height="66" loading="lazy">
											<?php endif; ?>
											<div>
												<h5><?php the_title(); ?></h5>
												<span><?php echo esc_html( get_the_date() ); ?></span>
											</div>
										</a>
										<?php
									endwhile;
									wp_reset_postdata();
								endif;
								?>
							</div>

							<div class="side-widget news-widget">
								<h4><?php esc_html_e( 'هل تحتاج مساعدة؟', 'tek-craft-toppres' ); ?></h4>
								<p><?php esc_html_e( 'تواصل معنا للحصول على استشارة مجانية حول بحثك.', 'tek-craft-toppres' ); ?></p>
								<a class="btn btn-gold btn-block" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'اطلب خدمتك', 'tek-craft-toppres' ); ?></a>
							</div>
						</aside>
					</div>
				</section>

				<?php
				$related = new WP_Query(
					array(
						'posts_per_page'      => 3,
						'post__not_in'        => array( get_the_ID() ),
						'category__in'        => wp_list_pluck( $cats ?: array(), 'term_id' ),
						'ignore_sticky_posts' => true,
					)
				);
				if ( ! $related->have_posts() ) {
					$related = new WP_Query(
						array(
							'posts_per_page'      => 3,
							'post__not_in'        => array( get_the_ID() ),
							'ignore_sticky_posts' => true,
						)
					);
				}
				if ( $related->have_posts() ) :
					?>
					<section class="section section--alt tk-related-sec">
						<div class="container">
							<div class="section-head center">
								<div class="eyebrow"><?php echo function_exists( 'tk_star_svg' ) ? tk_star_svg() : ''; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'تابع القراءة', 'tek-craft-toppres' ); ?></span></div>
								<h2><?php esc_html_e( 'مقالات ذات صلة', 'tek-craft-toppres' ); ?></h2>
							</div>
							<div class="grid grid-3">
								<?php
								while ( $related->have_posts() ) :
									$related->the_post();
									$img = get_the_post_thumbnail_url( get_the_ID(), 'tk-card' ) ?: get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
									$c   = get_the_category();
									?>
									<a href="<?php the_permalink(); ?>" class="article-card">
										<div class="ac-img">
											<?php if ( $img ) : ?>
												<img src="<?php echo esc_url( $img ); ?>" alt="" loading="lazy" width="640" height="420">
											<?php endif; ?>
											<?php if ( $c ) : ?>
												<span class="ac-badge"><?php echo esc_html( $c[0]->name ); ?></span>
											<?php endif; ?>
										</div>
										<div class="ac-content">
											<div class="ac-meta"><?php echo esc_html( get_the_date() ); ?> · <?php echo esc_html( tk_reading_time() ); ?></div>
											<h3><?php the_title(); ?></h3>
											<p><?php echo esc_html( wp_trim_words( get_the_excerpt() ?: wp_strip_all_tags( get_the_content() ), 18 ) ); ?></p>
											<span class="ac-link"><?php esc_html_e( 'اقرأ المزيد', 'tek-craft-toppres' ); ?> <span class="arrow">&larr;</span></span>
										</div>
									</a>
									<?php
								endwhile;
								wp_reset_postdata();
								?>
							</div>
						</div>
					</section>
					<?php
				endif;
			endif;

			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'السابق', 'tek-craft-toppres' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'التالي', 'tek-craft-toppres' ) . '</span> <span class="nav-title">%title</span>',
				)
			);
		endwhile;
		?>
	<?php endif; ?>
</main>
<?php
get_footer();
