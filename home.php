<?php
/**
 * Blog posts index.
 *
 * @package Toppers
 */

get_header();
?>
<main class="site-main">
	<?php get_template_part( 'template-parts/page-hero', null, toppers_hero_args( 'blog', array( 'title' => __( 'مدونة توبرز الأكاديمية', 'toppers' ), 'lede' => __( 'نشاركك أفضل الممارسات والنصائح لإعداد الأبحاث والرسائل العلمية.', 'toppers' ), 'eyebrow' => __( 'المقالات', 'toppers' ) ) ) ); ?>
	<?php get_template_part( 'template-parts/blog-list' ); ?>
	<section class="section--tight">
		<div class="container">
			<div class="cta-band">
				<h2><?php esc_html_e( 'جاهز لبدء رحلتك البحثية؟', 'toppers' ); ?></h2>
				<p><?php esc_html_e( 'أرسل تفاصيل مشروعك الآن واحصل على استشارة أولية وعرض سعر مجاني خلال ساعات.', 'toppers' ); ?></p>
				<div class="cta-actions">
					<a class="btn btn-gold" href="<?php echo esc_url( toppers_page_url( 'contact' ) ); ?>"><?php esc_html_e( 'اطلب خدمتك', 'toppers' ); ?></a>
					<a class="btn btn-outline" href="<?php echo esc_url( toppers_whatsapp_url() ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'تواصل عبر واتساب', 'toppers' ); ?></a>
				</div>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
