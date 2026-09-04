<?php
/**
 * Elementor FAQ accordion — markup aligned with HTML (.faq-item / .plus).
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
 * FAQ accordion.
 */
class TK_Widget_FAQ extends Widget_Base {

	public function get_name() {
		return 'tk_faq';
	}

	public function get_title() {
		return __( 'TK FAQ', 'tek-craft-toppres' );
	}

	public function get_icon() {
		return 'eicon-accordion';
	}

	public function get_categories() {
		return array( 'tek-craft-toppres' );
	}

	protected function register_controls() {
		$this->start_controls_section( 'content', array( 'label' => __( 'المحتوى', 'tek-craft-toppres' ) ) );

		$this->add_control( 'eyebrow', array( 'label' => __( 'سطر علوي', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'الأسئلة الشائعة', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'title', array( 'label' => __( 'العنوان', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'إجابات عن أكثر الأسئلة تكرارًا', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'show_category', array( 'label' => __( 'إظهار التصنيف', 'tek-craft-toppres' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => '' ) );
		$this->add_control( 'narrow', array( 'label' => __( 'عرض ضيق (مثل صفحة التواصل)', 'tek-craft-toppres' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ) );

		$rep = new Repeater();
		$rep->add_control( 'category', array( 'label' => __( 'التصنيف', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'dynamic' => array( 'active' => true ) ) );
		$rep->add_control( 'question', array( 'label' => __( 'السؤال', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'dynamic' => array( 'active' => true ) ) );
		$rep->add_control( 'answer', array( 'label' => __( 'الجواب', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXTAREA, 'dynamic' => array( 'active' => true ) ) );

		$this->add_control(
			'items',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $rep->get_controls(),
				'title_field' => '{{{ question }}}',
				'default'     => array(
					array(
						'question' => __( 'ما المعلومات التي أحتاج تقديمها؟', 'tek-craft-toppres' ),
						'answer'   => __( 'موضوع بحثك، المرحلة الدراسية، الخدمة المطلوبة، وأي ملفات أو تعليمات من جامعتك.', 'tek-craft-toppres' ),
					),
					array(
						'question' => __( 'كم تستغرق مدة التنفيذ؟', 'tek-craft-toppres' ),
						'answer'   => __( 'تختلف المدة حسب نوع الخدمة وحجم العمل، ونحددها بوضوح عند إرسال عرض السعر.', 'tek-craft-toppres' ),
					),
					array(
						'question' => __( 'هل يمكنني طلب تعديلات؟', 'tek-craft-toppres' ),
						'answer'   => __( 'نعم، يمكنك طلب مراجعات على العمل المسلَّم وفق سياسة التعديلات المتفق عليها.', 'tek-craft-toppres' ),
					),
				),
			)
		);

		$this->end_controls_section();

		if ( function_exists( 'tk_register_common_style_controls' ) ) {
			tk_register_common_style_controls( $this, 'section' );
		}
	}

	protected function render() {
		$s       = $this->get_settings_for_display();
		$star    = function_exists( 'tk_star_svg' ) ? tk_star_svg() : '';
		$show_cat = ( 'yes' === ( $s['show_category'] ?? '' ) );
		$narrow   = ( 'yes' === ( $s['narrow'] ?? 'yes' ) );
		$items    = (array) ( $s['items'] ?? array() );
		?>
		<section class="section section--alt tk-faq-section">
			<div class="container"<?php echo $narrow ? ' style="max-width:820px"' : ''; ?>>
				<div class="section-head center reveal">
					<?php if ( ! empty( $s['eyebrow'] ) ) : ?>
						<div class="eyebrow"><?php echo $star; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php echo esc_html( $s['eyebrow'] ); ?></span></div>
					<?php endif; ?>
					<?php if ( ! empty( $s['title'] ) ) : ?>
						<h2><?php echo esc_html( $s['title'] ); ?></h2>
					<?php endif; ?>
				</div>
				<div class="tk-faq-list reveal">
					<?php foreach ( $items as $i => $item ) : ?>
						<div class="faq-item<?php echo 0 === $i ? ' is-open' : ''; ?>">
							<button class="faq-q" type="button">
								<span>
									<?php if ( $show_cat && ! empty( $item['category'] ) ) : ?>
										<small class="faq-cat"><?php echo esc_html( $item['category'] ); ?></small>
									<?php endif; ?>
									<?php echo esc_html( $item['question'] ); ?>
								</span>
								<span class="plus" aria-hidden="true"></span>
							</button>
							<div class="faq-a">
								<p><?php echo esc_html( $item['answer'] ); ?></p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	}
}
