<?php
/**
 * Elementor Journey widget.
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
 * Journey steps widget.
 */
class TK_Widget_Journey extends Widget_Base {

	public function get_name() { return 'tk_journey'; }
	public function get_title() { return __( 'TK Journey', 'tek-craft-toppres' ); }
	public function get_icon() { return 'eicon-navigator'; }
	public function get_categories() { return array( 'tek-craft-toppres' ); }

	protected function register_controls() {
		$this->start_controls_section( 'content', array( 'label' => __( 'Content', 'tek-craft-toppres' ) ) );

		$this->add_control( 'eyebrow', array(
			'label'   => __( 'Eyebrow', 'tek-craft-toppres' ),
			'type'    => Controls_Manager::TEXT,
			'default' => __( 'كيف نعمل', 'tek-craft-toppres' ),
			'dynamic' => array( 'active' => true ),
		) );
		$this->add_control( 'title', array(
			'label'   => __( 'Title', 'tek-craft-toppres' ),
			'type'    => Controls_Manager::TEXT,
			'default' => __( 'رحلة طلب واضحة من أول تواصل حتى التسليم', 'tek-craft-toppres' ),
			'dynamic' => array( 'active' => true ),
		) );

		$rep = new Repeater();
		$rep->add_control( 'icon', array(
			'label'   => __( 'أيقونة', 'tek-craft-toppres' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'message',
			'options' => array(
				'message'      => __( 'رسالة', 'tek-craft-toppres' ),
				'search'       => __( 'بحث', 'tek-craft-toppres' ),
				'clipboard'    => __( 'عرض سعر', 'tek-craft-toppres' ),
				'edit'         => __( 'تنفيذ', 'tek-craft-toppres' ),
				'check-circle' => __( 'مراجعة', 'tek-craft-toppres' ),
				'send'         => __( 'تسليم', 'tek-craft-toppres' ),
				'clock'        => __( 'وقت', 'tek-craft-toppres' ),
				'shield'       => __( 'حماية', 'tek-craft-toppres' ),
			),
		) );
		$rep->add_control( 'step_title', array( 'label' => __( 'Step title', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'dynamic' => array( 'active' => true ) ) );
		$rep->add_control( 'step_text', array( 'label' => __( 'Step text', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXTAREA, 'dynamic' => array( 'active' => true ) ) );

		$this->add_control( 'steps', array(
			'type'    => Controls_Manager::REPEATER,
			'fields'  => $rep->get_controls(),
			'default' => array(
				array( 'icon' => 'message', 'step_title' => __( 'التواصل', 'tek-craft-toppres' ), 'step_text' => __( 'تخبرنا بمتطلبات بحثك عبر الموقع أو واتساب.', 'tek-craft-toppres' ) ),
				array( 'icon' => 'search', 'step_title' => __( 'دراسة الطلب', 'tek-craft-toppres' ), 'step_text' => __( 'نراجع التفاصيل ونحدد التخصص المناسب.', 'tek-craft-toppres' ) ),
				array( 'icon' => 'clipboard', 'step_title' => __( 'عرض السعر', 'tek-craft-toppres' ), 'step_text' => __( 'نرسل لك سعرًا واضحًا ومدة تسليم محددة.', 'tek-craft-toppres' ) ),
				array( 'icon' => 'edit', 'step_title' => __( 'التنفيذ', 'tek-craft-toppres' ), 'step_text' => __( 'يبدأ الباحث المتخصص العمل على طلبك.', 'tek-craft-toppres' ) ),
				array( 'icon' => 'check-circle', 'step_title' => __( 'مراجعة الجودة', 'tek-craft-toppres' ), 'step_text' => __( 'فحص علمي ولغوي وتدقيق تشابه قبل التسليم.', 'tek-craft-toppres' ) ),
				array( 'icon' => 'send', 'step_title' => __( 'التسليم', 'tek-craft-toppres' ), 'step_text' => __( 'تستلم عملك مع إمكانية طلب تعديلات.', 'tek-craft-toppres' ) ),
			),
			'title_field' => '{{{ step_title }}}',
		) );
		$this->end_controls_section();

		if ( function_exists( 'tk_register_common_style_controls' ) ) {
			tk_register_common_style_controls( $this, 'section' );
		}
	}

	protected function render() {
		$s    = $this->get_settings_for_display();
		$star = function_exists( 'tk_star_svg' ) ? tk_star_svg() : '';
		?>
		<section class="section">
			<div class="container">
				<div class="section-head center reveal">
					<div class="eyebrow"><?php echo $star; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php echo esc_html( $s['eyebrow'] ); ?></span></div>
					<h2><?php echo esc_html( $s['title'] ); ?></h2>
				</div>
				<div class="journey reveal-stagger reveal">
					<?php foreach ( (array) $s['steps'] as $i => $step ) :
						$icon = ! empty( $step['icon'] ) ? $step['icon'] : 'layers';
						?>
						<div class="journey-step">
							<div class="journey-num journey-num--icon">
								<?php echo function_exists( 'tk_icon' ) ? tk_icon( $icon, array( 'size' => 22 ) ) : esc_html( (string) ( $i + 1 ) ); // phpcs:ignore ?>
							</div>
							<h4><?php echo esc_html( $step['step_title'] ); ?></h4>
							<p><?php echo esc_html( $step['step_text'] ); ?></p>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	}
}
