<?php
/**
 * Blog listing with category filter, matching the services sidebar.
 *
 * @package Toppers
 */

$current = is_category() ? get_queried_object() : null;
$cats    = get_categories(
	array(
		'hide_empty' => true,
		'orderby'    => 'name',
		'order'      => 'ASC',
		'exclude'    => (int) get_option( 'default_category' ),
	)
);
$q       = new WP_Query(
	array(
		'post_type'           => 'post',
		'posts_per_page'      => -1,
		'ignore_sticky_posts' => true,
		'post_status'         => 'publish',
		'category__not_in'    => array( (int) get_option( 'default_category' ) ),
	)
);
?>
<section class="section">
	<div class="container services-layout">
		<aside class="services-sidebar">
			<h3><?php esc_html_e( 'تصنيفات المقالات', 'toppers' ); ?></h3>
			<ul class="services-menu" id="blogFilters">
				<li>
					<a href="<?php echo esc_url( toppers_blog_url() ); ?>" class="js-blog-filter<?php echo $current ? '' : ' active'; ?>" data-cat="all">
						<?php esc_html_e( 'الكل', 'toppers' ); ?>
						<span><?php echo esc_html( (string) $q->found_posts ); ?></span>
					</a>
				</li>
				<?php foreach ( $cats as $term ) : ?>
					<li>
						<a href="<?php echo esc_url( get_category_link( $term ) ); ?>" class="js-blog-filter<?php echo ( $current && (int) $current->term_id === (int) $term->term_id ) ? ' active' : ''; ?>" data-cat="<?php echo esc_attr( $term->slug ); ?>">
							<?php echo esc_html( $term->name ); ?>
							<span><?php echo esc_html( (string) $term->count ); ?></span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
			<div class="legal-card" style="margin-top:24px">
				<h4><?php esc_html_e( 'هل تحتاج مساعدة في بحثك؟', 'toppers' ); ?></h4>
				<p><?php esc_html_e( 'فريق توبرز جاهز لمرافقتك من الفكرة حتى التسليم.', 'toppers' ); ?></p>
				<a class="btn btn-gold btn-block" href="<?php echo esc_url( toppers_page_url( 'contact' ) ); ?>"><?php esc_html_e( 'اطلب استشارة مجانية', 'toppers' ); ?></a>
			</div>
		</aside>
		<div class="services-content">
			<?php if ( $q->have_posts() ) : ?>
				<div class="grid grid-2" id="blogGrid">
					<?php
					while ( $q->have_posts() ) :
						$q->the_post();
						get_template_part( 'template-parts/card-post' );
					endwhile;
					wp_reset_postdata();
					?>
				</div>
				<p class="blog-empty" id="blogEmpty" hidden><?php esc_html_e( 'لا توجد مقالات في هذا التصنيف.', 'toppers' ); ?></p>
			<?php else : ?>
				<p><?php esc_html_e( 'لا توجد مقالات بعد. أضف مقالاً من لوحة التحكم وضع له صورة بارزة.', 'toppers' ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>
