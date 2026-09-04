<?php
/**
 * Elementor Stats Row widget.
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
 * Animated stats.
 */
class TK_Widget_Stats_Row extends Widget_Base {

	public function get_name() {
		return 'tk_stats_row';
	}

	public function get_title() {
		return __( 'TK Stats Row', 'tek-craft-toppres' );
	}

	public function get_icon() {
		return 'eicon-counter';
	}

	public function get_categories() {
		return array( 'tek-craft-toppres' );
	}

	protected function register_controls() {
		$this->start_controls_section( 'content', array( 'label' => __( 'المحتوى', 'tek-craft-toppres' ) ) );

		$rep = new Repeater();
		$rep->add_control( 'number', array( 'label' => __( 'الرقم', 'tek-craft-toppres' ), 'type' => Controls_Manager::NUMBER, 'default' => 100 ) );
		$rep->add_control( 'suffix', array( 'label' => __( 'لاحقة', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => '+' ) );
		$rep->add_control( 'label', array( 'label' => __( 'التسمية', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'dynamic' => array( 'active' => true ) ) );

		$this->add_control(
			'stats',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $rep->get_controls(),
				'title_field' => '{{{ label }}}',
				'default'     => array(
					array( 'number' => 8, 'suffix' => '+', 'label' => __( 'سنوات خبرة', 'tek-craft-toppres' ) ),
					array( 'number' => 3200, 'suffix' => '+', 'label' => __( 'عميل', 'tek-craft-toppres' ) ),
					array( 'number' => 1500, 'suffix' => '+', 'label' => __( 'بحث أكاديمي', 'tek-craft-toppres' ) ),
					array( 'number' => 95, 'suffix' => '%', 'label' => __( 'رضا العملاء', 'tek-craft-toppres' ) ),
				),
			)
		);

		$this->add_control(
			'navy',
			array(
				'label'        => __( 'خلفية داكنة', 'tek-craft-toppres' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->end_controls_section();

		if ( function_exists( 'tk_register_common_style_controls' ) ) {
			tk_register_common_style_controls( $this, 'section' );
		}
	}

	protected function render() {
		$s       = $this->get_settings_for_display();
		$section = ( 'yes' === ( $s['navy'] ?? 'yes' ) ) ? 'section section--navy' : 'section section--alt';
		?>
		<section class="<?php echo esc_attr( $section ); ?>">
			<div class="container">
				<div class="why-stats reveal" style="display:flex;justify-content:space-around;align-items:center;flex-wrap:wrap;gap:20px;padding:36px 20px;border-radius:8px;<?php echo ( 'yes' === ( $s['navy'] ?? '' ) ) ? 'background:rgba(255,255,255,.02);border:1px solid rgba(255,255,255,.08);' : 'background:var(--white);border:1px solid var(--line);'; ?>">
					<?php foreach ( (array) $s['stats'] as $stat ) : ?>
						<div class="stat-item" style="text-align:center;">
							<div style="font-family:var(--f-display);font-size:42px;font-weight:800;color:var(--gold-deep);line-height:1;">
								<span data-count="<?php echo esc_attr( (string) $stat['number'] ); ?>" data-suffix="<?php echo esc_attr( $stat['suffix'] ); ?>">0</span>
							</div>
							<div style="font-size:13.5px;margin-top:10px;font-weight:600;color:var(--ink-soft);"><?php echo esc_html( $stat['label'] ); ?></div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	}
}
