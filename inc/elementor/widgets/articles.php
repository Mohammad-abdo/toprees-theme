<?php
/**
 * Elementor Articles widget.
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * Latest articles from WordPress posts (featured images editable per post).
 */
class TK_Widget_Articles extends Widget_Base {

	public function get_name() { return 'tk_articles'; }
	public function get_title() { return __( 'TK Articles', 'tek-craft-toppres' ); }
	public function get_icon() { return 'eicon-posts-grid'; }
	public function get_categories() { return array( 'tek-craft-toppres' ); }

	protected function register_controls() {
		$this->start_controls_section( 'content', array( 'label' => __( 'Content', 'tek-craft-toppres' ) ) );
		$this->add_control( 'eyebrow', array( 'label' => __( 'Eyebrow', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'أحدث المقالات', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'title', array( 'label' => __( 'Title', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'مدونة توبرز الأكاديمية', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'lede', array( 'label' => __( 'Description', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXTAREA, 'default' => __( 'نشاركك أفضل الممارسات والنصائح لإعداد الأبحاث والرسائل العلمية بمنهجية صحيحة.', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'count', array( 'label' => __( 'Number of posts', 'tek-craft-toppres' ), 'type' => Controls_Manager::NUMBER, 'default' => 3 ) );
		$this->add_control( 'view_all_text', array( 'label' => __( 'View all text', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'عرض كل المقالات', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'view_all_link', array(
			'label'   => __( 'View all link', 'tek-craft-toppres' ),
			'type'    => Controls_Manager::URL,
			'default' => array( 'url' => get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url( '/' ) ),
			'dynamic' => array( 'active' => true ),
		) );
		$this->end_controls_section();

		if ( function_exists( 'tk_register_common_style_controls' ) ) {
			tk_register_common_style_controls( $this, 'section' );
		}
	}

	protected function render() {
		$s     = $this->get_settings_for_display();
		$star  = function_exists( 'tk_star_svg' ) ? tk_star_svg() : '';
		$view  = ! empty( $s['view_all_link']['url'] ) ? $s['view_all_link']['url'] : '#';
		$query = new WP_Query( array( 'posts_per_page' => (int) $s['count'], 'post_status' => 'publish', 'ignore_sticky_posts' => true ) );
		?>
		<section class="section section--alt">
			<div class="container">
				<div class="section-head center reveal">
					<div class="eyebrow"><?php echo $star; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php echo esc_html( $s['eyebrow'] ); ?></span></div>
					<h2><?php echo esc_html( $s['title'] ); ?></h2>
					<?php if ( ! empty( $s['lede'] ) ) : ?>
						<p style="max-width: 600px; margin: 15px auto 0;"><?php echo esc_html( $s['lede'] ); ?></p>
					<?php endif; ?>
				</div>
				<div class="grid grid-3 reveal-stagger reveal">
					<?php
					if ( $query->have_posts() ) :
						while ( $query->have_posts() ) :
							$query->the_post();
							$cat   = get_the_category();
							$badge = $cat ? $cat[0]->name : __( 'مقال', 'tek-craft-toppres' );
							$thumb = get_the_post_thumbnail_url( get_the_ID(), 'tk-card' );
							if ( ! $thumb ) {
								$thumb = TK_THEME_URI . '/assets/images/logo.png';
							}
							?>
							<a href="<?php the_permalink(); ?>" class="article-card">
								<div class="ac-img">
									<img src="<?php echo esc_url( $thumb ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" width="600" height="400">
									<span class="ac-badge"><?php echo esc_html( $badge ); ?></span>
								</div>
								<div class="ac-content">
									<div class="ac-meta"><span><?php echo esc_html( get_the_date() ); ?></span></div>
									<h3><?php the_title(); ?></h3>
									<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
									<span class="ac-link"><?php esc_html_e( 'اقرأ المزيد', 'tek-craft-toppres' ); ?> &larr;</span>
								</div>
							</a>
							<?php
						endwhile;
						wp_reset_postdata();
					else :
						echo '<p class="center">' . esc_html__( 'أضف مقالات من لوحة التحكم — ستظهر هنا تلقائياً. صورة كل مقال تُغيَّر من المقالة (الصورة البارزة).', 'tek-craft-toppres' ) . '</p>';
					endif;
					?>
				</div>
				<?php if ( ! empty( $s['view_all_text'] ) ) : ?>
					<div style="text-align:center; margin-top: 40px;" class="reveal">
						<a href="<?php echo esc_url( $view ); ?>" class="btn btn-outline"><?php echo esc_html( $s['view_all_text'] ); ?></a>
					</div>
				<?php endif; ?>
			</div>
		</section>
		<?php
	}
}
