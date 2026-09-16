<?php
/**
 * Template Name: تواصل معنا
 *
 * @package Toppers
 */

get_header();
?>
<main class="site-main">
	<?php
	while ( have_posts() ) :
		the_post();
		if ( toppers_is_elementor_page() ) {
			the_content();
			continue;
		}
		get_template_part( 'template-parts/page-hero', null, toppers_hero_args( 'contact', array( 'title' => get_the_title() ?: __( 'لنبدأ رحلتك البحثية معًا', 'toppers' ), 'eyebrow' => __( 'تواصل معنا', 'toppers' ), 'lede' => __( 'أرسل تفاصيل طلبك وسنعاود التواصل معك خلال ساعات لتزويدك بعرض سعر واضح ومدة تسليم محددة.', 'toppers' ) ) ) );
		get_template_part( 'template-parts/contact-form' );
	endwhile;
	?>
</main>
<?php
get_footer();
