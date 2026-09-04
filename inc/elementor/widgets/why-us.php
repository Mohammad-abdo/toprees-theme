<?php
/**
 * Elementor Why Us widget.
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
 * Why us + stats.
 */
class TK_Widget_Why_Us extends Widget_Base {

	public function get_name() { return 'tk_why_us'; }
	public function get_title() { return __( 'TK Why Us', 'tek-craft-toppres' ); }
	public function get_icon() { return 'eicon-info-box'; }
	public function get_categories() { return array( 'tek-craft-toppres' ); }

	protected function register_controls() {
		$this->start_controls_section( 'content', array( 'label' => __( 'Content', 'tek-craft-toppres' ) ) );
		$this->add_control( 'eyebrow', array( 'label' => __( 'Eyebrow', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'لماذا توبرز', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'title', array( 'label' => __( 'Title', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'شريكك الأكاديمي من الفكرة حتى النشر', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'lede', array( 'label' => __( 'Description', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXTAREA, 'default' => __( 'نقدم لك دعماً بحثياً متكاملاً بمعايير عالمية لضمان نجاحك الأكاديمي بكل احترافية وسرية تامة، لنكون شركاء في رحلتك نحو التميز.', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );

		$rep = new Repeater();
		$rep->add_control( 'item_title', array( 'label' => __( 'Title', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'dynamic' => array( 'active' => true ) ) );
		$rep->add_control( 'item_text', array( 'label' => __( 'Text', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXTAREA, 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'items', array(
			'type' => Controls_Manager::REPEATER,
			'fields' => $rep->get_controls(),
			'default' => array(
				array( 'item_title' => __( 'فريق متخصص', 'tek-craft-toppres' ), 'item_text' => __( 'باحثون وخبراء إحصاء ولغويون في مختلف التخصصات العلمية.', 'tek-craft-toppres' ) ),
				array( 'item_title' => __( 'دقة علمية', 'tek-craft-toppres' ), 'item_text' => __( 'التزام صارم بالمنهجية العلمية والمعايير الأكاديمية المعتمدة.', 'tek-craft-toppres' ) ),
				array( 'item_title' => __( 'مواعيد تُحترم', 'tek-craft-toppres' ), 'item_text' => __( 'تسليم في الوقت المتفق عليه دون تأخير أو مفاجآت.', 'tek-craft-toppres' ) ),
				array( 'item_title' => __( 'سرية تامة', 'tek-craft-toppres' ), 'item_text' => __( 'بياناتك وملفاتك محمية ولا يطّلع عليها سوى الفريق المكلف.', 'tek-craft-toppres' ) ),
			),
			'title_field' => '{{{ item_title }}}',
		) );

		$stats = new Repeater();
		$stats->add_control( 'number', array( 'label' => __( 'Number', 'tek-craft-toppres' ), 'type' => Controls_Manager::NUMBER, 'default' => 8 ) );
		$stats->add_control( 'suffix', array( 'label' => __( 'Suffix', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => '+' ) );
		$stats->add_control( 'label', array( 'label' => __( 'Label', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'stats', array(
			'type' => Controls_Manager::REPEATER,
			'fields' => $stats->get_controls(),
			'default' => array(
				array( 'number' => 8, 'suffix' => '+', 'label' => __( 'سنوات من الخبرة', 'tek-craft-toppres' ) ),
				array( 'number' => 3200, 'suffix' => '+', 'label' => __( 'عميل تمت خدمتهم', 'tek-craft-toppres' ) ),
				array( 'number' => 1500, 'suffix' => '+', 'label' => __( 'بحث جامعي وماجستير', 'tek-craft-toppres' ) ),
				array( 'number' => 95, 'suffix' => '%', 'label' => __( 'نسبة رضا العملاء', 'tek-craft-toppres' ) ),
			),
			'title_field' => '{{{ label }}}',
		) );
		$this->end_controls_section();

		if ( function_exists( 'tk_register_common_style_controls' ) ) {
			tk_register_common_style_controls( $this, 'section' );
		}
	}

	protected function render() {
		$s    = $this->get_settings_for_display();
		$star = function_exists( 'tk_star_svg' ) ? tk_star_svg() : '';
		$icons = array( 'users', 'check-circle', 'clock', 'shield' );
		?>
		<section class="section section--navy" style="position:relative; overflow:hidden;">
			<div class="container" style="position:relative; z-index:2;">
				<div class="section-head center reveal" style="margin-bottom:64px;">
					<div class="eyebrow" style="color:var(--gold-light); justify-content:center; display:flex; gap:12px;">
						<?php echo $star; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<span><?php echo esc_html( $s['eyebrow'] ); ?></span>
						<?php echo $star; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
					<h2 style="font-size:clamp(32px, 4vw, 44px); margin-top:16px; background:linear-gradient(to left, #ffffff, #e0e0e0); -webkit-background-clip:text; -webkit-text-fill-color:transparent; display:inline-block;"><?php echo esc_html( $s['title'] ); ?></h2>
					<?php if ( ! empty( $s['lede'] ) ) : ?>
						<p style="color:rgba(255,255,255,0.7); max-width:640px; margin:20px auto 0; font-size:16px; line-height:1.7;"><?php echo esc_html( $s['lede'] ); ?></p>
					<?php endif; ?>
				</div>
				<div class="grid grid-4 reveal-stagger reveal">
					<?php foreach ( (array) $s['items'] as $i => $item ) : ?>
						<div class="why-card" style="transition-delay:<?php echo esc_attr( ( $i * 0.1 ) . 's' ); ?>">
							<div class="why-card-ic">
								<?php echo function_exists( 'tk_icon' ) ? tk_icon( $icons[ $i % 4 ], array( 'size' => 28 ) ) : ''; // phpcs:ignore ?>
							</div>
							<h3><?php echo esc_html( $item['item_title'] ); ?></h3>
							<p><?php echo esc_html( $item['item_text'] ); ?></p>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="why-stats reveal" style="margin-top:64px; display:flex; justify-content:space-around; align-items:center; flex-wrap:wrap; gap:20px; background:rgba(255,255,255,0.02); border:1px solid rgba(255,255,255,0.08); padding:36px 20px; border-radius:8px;">
					<?php foreach ( (array) $s['stats'] as $stat ) : ?>
						<div class="stat-item" style="text-align:center;">
							<div style="font-family:var(--f-display); font-size:46px; font-weight:800; color:var(--gold-light); line-height:1;">
								<span data-count="<?php echo esc_attr( (string) $stat['number'] ); ?>" data-suffix="<?php echo esc_attr( $stat['suffix'] ); ?>">0</span>
							</div>
							<div style="font-size:13.5px; color:rgba(255,255,255,0.7); margin-top:10px; font-weight:600;"><?php echo esc_html( $stat['label'] ); ?></div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	}
}
