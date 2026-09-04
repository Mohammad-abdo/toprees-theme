<?php
/**
 * Elementor Services grid widget.
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

/**
 * Services cards with editable images.
 */
class TK_Widget_Services extends Widget_Base {

	public function get_name() { return 'tk_services'; }
	public function get_title() { return __( 'TK Services', 'tek-craft-toppres' ); }
	public function get_icon() { return 'eicon-gallery-grid'; }
	public function get_categories() { return array( 'tek-craft-toppres' ); }

	protected function register_controls() {
		$this->start_controls_section( 'content', array( 'label' => __( 'Content', 'tek-craft-toppres' ) ) );

		$this->add_control( 'source', array(
			'label'   => __( 'Content source', 'tek-craft-toppres' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'manual',
			'options' => array(
				'manual' => __( 'Manual (Elementor)', 'tek-craft-toppres' ),
				'cpt'    => __( 'Services CPT', 'tek-craft-toppres' ),
			),
		) );

		$this->add_control( 'eyebrow', array( 'label' => __( 'Eyebrow', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'خدماتنا', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'title', array( 'label' => __( 'Title', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'كل ما تحتاجه رحلتك البحثية في مكان واحد', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'lede', array( 'label' => __( 'Description', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXTAREA, 'default' => __( 'من اختيار العنوان إلى النشر العلمي — نغطي المراحل الأكاديمية كافة بفريق متخصص لكل مجال.', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'view_all_text', array( 'label' => __( 'View all text', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'عرض كل الخدمات', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'view_all_link', array( 'label' => __( 'View all link', 'tek-craft-toppres' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => get_post_type_archive_link( 'tk_service' ) ?: '#' ), 'dynamic' => array( 'active' => true ) ) );

		$rep = new Repeater();
		$rep->add_control( 'image', array( 'label' => __( 'Image', 'tek-craft-toppres' ), 'type' => Controls_Manager::MEDIA, 'default' => array( 'url' => 'https://images.unsplash.com/photo-1488190211105-8b0e65b80b4e?auto=format&fit=crop&q=80&w=600&h=400' ) ) );
		$rep->add_control( 'card_title', array( 'label' => __( 'Title', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'dynamic' => array( 'active' => true ) ) );
		$rep->add_control( 'card_text', array( 'label' => __( 'Text', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXTAREA, 'dynamic' => array( 'active' => true ) ) );
		$rep->add_control( 'card_link', array( 'label' => __( 'Link', 'tek-craft-toppres' ), 'type' => Controls_Manager::URL, 'dynamic' => array( 'active' => true ) ) );
		$rep->add_control( 'link_label', array( 'label' => __( 'Link label', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'اطلب هذه الخدمة', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );

		$this->add_control( 'cards', array(
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $rep->get_controls(),
			'condition'   => array( 'source' => 'manual' ),
			'default'     => array(
				array( 'card_title' => __( 'البحوث الجامعية', 'tek-craft-toppres' ), 'card_text' => __( 'إعداد بحوث جامعية بمنهجية علمية دقيقة تناسب متطلبات كل مقرر.', 'tek-craft-toppres' ), 'image' => array( 'url' => 'https://images.unsplash.com/photo-1488190211105-8b0e65b80b4e?auto=format&fit=crop&q=80&w=600&h=400' ) ),
				array( 'card_title' => __( 'رسائل الماجستير', 'tek-craft-toppres' ), 'card_text' => __( 'مرافقة كاملة من اختيار العنوان حتى المناقشة والتنسيق النهائي.', 'tek-craft-toppres' ), 'image' => array( 'url' => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&q=80&w=600&h=400' ) ),
				array( 'card_title' => __( 'أطروحات الدكتوراه', 'tek-craft-toppres' ), 'card_text' => __( 'دعم بحثي متقدم للباحثين في مراحل الدكتوراه المختلفة.', 'tek-craft-toppres' ), 'image' => array( 'url' => 'https://images.unsplash.com/photo-1513258496099-48168024aec0?auto=format&fit=crop&q=80&w=600&h=400' ) ),
				array( 'card_title' => __( 'التحليل الإحصائي', 'tek-craft-toppres' ), 'card_text' => __( 'تحليل بيانات البحث باستخدام البرامج الإحصائية المناسبة.', 'tek-craft-toppres' ), 'image' => array( 'url' => 'https://images.unsplash.com/photo-1488190211105-8b0e65b80b4e?auto=format&fit=crop&q=80&w=600&h=400' ) ),
			),
			'title_field' => '{{{ card_title }}}',
		) );

		$this->add_control( 'cpt_count', array(
			'label'     => __( 'Number of services', 'tek-craft-toppres' ),
			'type'      => Controls_Manager::NUMBER,
			'default'   => 8,
			'condition' => array( 'source' => 'cpt' ),
		) );

		$this->end_controls_section();

		if ( function_exists( 'tk_register_common_style_controls' ) ) {
			tk_register_common_style_controls( $this, 'section' );
		}
	}

	/**
	 * Render widget.
	 */
	protected function render() {
		$s     = $this->get_settings_for_display();
		$star  = function_exists( 'tk_star_svg' ) ? tk_star_svg() : '';
		$view  = ! empty( $s['view_all_link']['url'] ) ? $s['view_all_link']['url'] : '#';
		$cards = array();

		if ( 'cpt' === $s['source'] ) {
			$posts = get_posts( array( 'post_type' => 'tk_service', 'posts_per_page' => (int) $s['cpt_count'], 'post_status' => 'publish' ) );
			foreach ( $posts as $p ) {
				$cards[] = array(
					'image'      => array( 'url' => get_the_post_thumbnail_url( $p, 'tk-card' ) ?: '' ),
					'card_title' => get_the_title( $p ),
					'card_text'  => get_the_excerpt( $p ),
					'card_link'  => array( 'url' => get_permalink( $p ) ),
					'link_label' => __( 'اطلب هذه الخدمة', 'tek-craft-toppres' ),
				);
			}
		} else {
			$cards = (array) $s['cards'];
		}
		?>
		<section class="section section--alt">
			<div class="container">
				<div class="section-head reveal">
					<div class="eyebrow"><?php echo $star; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php echo esc_html( $s['eyebrow'] ); ?></span></div>
					<h2><?php echo esc_html( $s['title'] ); ?></h2>
					<?php if ( ! empty( $s['lede'] ) ) : ?><p><?php echo esc_html( $s['lede'] ); ?></p><?php endif; ?>
				</div>
				<div class="grid grid-4 reveal-stagger reveal">
					<?php foreach ( $cards as $card ) :
						$img  = tk_elementor_image_url( isset( $card['image'] ) ? $card['image'] : array() );
						$link = ! empty( $card['card_link']['url'] ) ? $card['card_link']['url'] : $view;
						$label = ! empty( $card['link_label'] ) ? $card['link_label'] : __( 'اطلب هذه الخدمة', 'tek-craft-toppres' );
						?>
						<div class="service-card">
							<div class="sc-img">
								<?php if ( $img ) : ?>
									<img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $card['card_title'] ); ?>" loading="lazy" width="600" height="400">
								<?php endif; ?>
								<span class="sc-badge"><?php echo esc_html( $card['card_title'] ); ?></span>
							</div>
							<div class="sc-content">
								<h3><?php echo esc_html( $card['card_title'] ); ?></h3>
								<p><?php echo esc_html( $card['card_text'] ); ?></p>
								<a href="<?php echo esc_url( $link ); ?>" class="sc-link"><span><?php echo esc_html( $label ); ?></span> <span class="arrow">&larr;</span></a>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<?php if ( ! empty( $s['view_all_text'] ) ) : ?>
					<div class="center" style="margin-top:44px">
						<a href="<?php echo esc_url( $view ); ?>" class="btn btn-outline-dark"><?php echo esc_html( $s['view_all_text'] ); ?></a>
					</div>
				<?php endif; ?>
			</div>
		</section>
		<?php
	}
}
