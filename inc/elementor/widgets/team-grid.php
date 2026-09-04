<?php
/**
 * Elementor Team Grid widget.
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
 * Team member cards.
 */
class TK_Widget_Team_Grid extends Widget_Base {

	public function get_name() {
		return 'tk_team_grid';
	}

	public function get_title() {
		return __( 'TK Team Grid', 'tek-craft-toppres' );
	}

	public function get_icon() {
		return 'eicon-person';
	}

	public function get_categories() {
		return array( 'tek-craft-toppres' );
	}

	protected function register_controls() {
		$this->start_controls_section( 'content', array( 'label' => __( 'المحتوى', 'tek-craft-toppres' ) ) );

		$this->add_control( 'eyebrow', array( 'label' => __( 'سطر علوي', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'فريق العمل', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'title', array( 'label' => __( 'العنوان', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'متخصصون في كل مرحلة من رحلتك الأكاديمية', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );

		$rep = new Repeater();
		$rep->add_control( 'name', array( 'label' => __( 'الاسم', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'dynamic' => array( 'active' => true ) ) );
		$rep->add_control( 'role', array( 'label' => __( 'الدور', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'dynamic' => array( 'active' => true ) ) );
		$rep->add_control( 'dept', array( 'label' => __( 'القسم', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'dynamic' => array( 'active' => true ) ) );
		$rep->add_control( 'letter', array( 'label' => __( 'حرف الأفاتار', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => 'م' ) );

		$this->add_control(
			'members',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $rep->get_controls(),
				'title_field' => '{{{ name }}}',
				'default'     => array(
					array( 'name' => __( 'د. أحمد العتيبي', 'tek-craft-toppres' ), 'role' => __( 'مشرف أكاديمي', 'tek-craft-toppres' ), 'dept' => __( 'الدراسات العليا', 'tek-craft-toppres' ), 'letter' => 'أ' ),
					array( 'name' => __( 'أ. سارة الحربي', 'tek-craft-toppres' ), 'role' => __( 'باحثة إحصائية', 'tek-craft-toppres' ), 'dept' => __( 'التحليل الإحصائي', 'tek-craft-toppres' ), 'letter' => 'س' ),
					array( 'name' => __( 'أ. محمد القحطاني', 'tek-craft-toppres' ), 'role' => __( 'مدقق لغوي', 'tek-craft-toppres' ), 'dept' => __( 'اللغة والنشر', 'tek-craft-toppres' ), 'letter' => 'م' ),
					array( 'name' => __( 'أ. نورة الشمري', 'tek-craft-toppres' ), 'role' => __( 'منسقة طلبات', 'tek-craft-toppres' ), 'dept' => __( 'خدمة العملاء', 'tek-craft-toppres' ), 'letter' => 'ن' ),
				),
			)
		);

		$this->end_controls_section();

		if ( function_exists( 'tk_register_common_style_controls' ) ) {
			tk_register_common_style_controls( $this, 'section' );
		}
	}

	protected function render() {
		$s    = $this->get_settings_for_display();
		$star = function_exists( 'tk_star_svg' ) ? tk_star_svg() : '';
		?>
		<section class="section section--alt">
			<div class="container">
				<div class="section-head center reveal">
					<?php if ( ! empty( $s['eyebrow'] ) ) : ?>
						<div class="eyebrow"><?php echo $star; // phpcs:ignore ?><span><?php echo esc_html( $s['eyebrow'] ); ?></span></div>
					<?php endif; ?>
					<?php if ( ! empty( $s['title'] ) ) : ?>
						<h2><?php echo esc_html( $s['title'] ); ?></h2>
					<?php endif; ?>
				</div>
				<div class="grid grid-2 reveal-stagger reveal">
					<?php foreach ( (array) $s['members'] as $m ) : ?>
						<div class="team-card card" style="display:flex;gap:16px;align-items:center;padding:20px;border:1px solid var(--line);border-radius:8px;background:var(--white);">
							<div class="t-avatar" style="width:56px;height:56px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-weight:800;background:linear-gradient(135deg,var(--gold-light),var(--gold));color:var(--ink);flex-shrink:0;">
								<?php echo esc_html( $m['letter'] ?: mb_substr( $m['name'], 0, 1 ) ); ?>
							</div>
							<div>
								<?php if ( ! empty( $m['dept'] ) ) : ?>
									<small style="color:var(--gold-deep);font-weight:700;"><?php echo esc_html( $m['dept'] ); ?></small>
								<?php endif; ?>
								<h3 style="margin:4px 0;font-size:1.05rem;"><?php echo esc_html( $m['name'] ); ?></h3>
								<p style="margin:0;color:var(--ink-soft);font-size:14px;"><?php echo esc_html( $m['role'] ); ?></p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	}
}
