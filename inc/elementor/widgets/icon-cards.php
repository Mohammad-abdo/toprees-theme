<?php
/**
 * Elementor Icon Cards grid widget.
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
 * Icon / feature cards.
 */
class TK_Widget_Icon_Cards extends Widget_Base {

	public function get_name() {
		return 'tk_icon_cards';
	}

	public function get_title() {
		return __( 'TK Icon Cards', 'tek-craft-toppres' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return array( 'tek-craft-toppres' );
	}

	protected function register_controls() {
		$this->start_controls_section( 'content', array( 'label' => __( 'المحتوى', 'tek-craft-toppres' ) ) );

		$this->add_control( 'eyebrow', array( 'label' => __( 'سطر علوي', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'title', array( 'label' => __( 'العنوان', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'lede', array( 'label' => __( 'الوصف', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXTAREA, 'dynamic' => array( 'active' => true ) ) );
		$this->add_control(
			'columns',
			array(
				'label'   => __( 'الأعمدة', 'tek-craft-toppres' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '4',
				'options' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',
				),
			)
		);
		$this->add_control(
			'alt_bg',
			array(
				'label'        => __( 'خلفية بديلة', 'tek-craft-toppres' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$rep = new Repeater();
		$rep->add_control(
			'icon',
			array(
				'label'   => __( 'أيقونة', 'tek-craft-toppres' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'check-circle',
				'options' => array(
					'users'        => __( 'فريق', 'tek-craft-toppres' ),
					'check-circle' => __( 'تحقق', 'tek-craft-toppres' ),
					'clock'        => __( 'وقت', 'tek-craft-toppres' ),
					'shield'       => __( 'حماية', 'tek-craft-toppres' ),
					'graduation'   => __( 'تخرج', 'tek-craft-toppres' ),
					'book'         => __( 'كتاب', 'tek-craft-toppres' ),
					'bar-chart'    => __( 'إحصاء', 'tek-craft-toppres' ),
					'globe'        => __( 'عالمي', 'tek-craft-toppres' ),
					'award'        => __( 'جائزة', 'tek-craft-toppres' ),
					'zap'          => __( 'سرعة', 'tek-craft-toppres' ),
					'briefcase'    => __( 'حقيبة', 'tek-craft-toppres' ),
					'heart'        => __( 'قلب', 'tek-craft-toppres' ),
				),
			)
		);
		$rep->add_control( 'card_title', array( 'label' => __( 'عنوان الكرت', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'dynamic' => array( 'active' => true ) ) );
		$rep->add_control( 'card_text', array( 'label' => __( 'النص', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXTAREA, 'dynamic' => array( 'active' => true ) ) );

		$this->add_control(
			'cards',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $rep->get_controls(),
				'title_field' => '{{{ card_title }}}',
				'default'     => array(
					array( 'icon' => 'users', 'card_title' => __( 'فريق متخصص', 'tek-craft-toppres' ), 'card_text' => __( 'خبراء في مختلف التخصصات الأكاديمية.', 'tek-craft-toppres' ) ),
					array( 'icon' => 'check-circle', 'card_title' => __( 'دقة علمية', 'tek-craft-toppres' ), 'card_text' => __( 'التزام صارم بالمنهجية والمعايير.', 'tek-craft-toppres' ) ),
					array( 'icon' => 'clock', 'card_title' => __( 'مواعيد محترمة', 'tek-craft-toppres' ), 'card_text' => __( 'تسليم في الوقت المتفق عليه.', 'tek-craft-toppres' ) ),
					array( 'icon' => 'shield', 'card_title' => __( 'سرية تامة', 'tek-craft-toppres' ), 'card_text' => __( 'حماية كاملة لبياناتك وملفاتك.', 'tek-craft-toppres' ) ),
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
		$cols    = isset( $s['columns'] ) ? $s['columns'] : '4';
		$section = ( 'yes' === ( $s['alt_bg'] ?? '' ) ) ? 'section section--alt' : 'section';
		$star    = function_exists( 'tk_star_svg' ) ? tk_star_svg() : '';
		?>
		<section class="<?php echo esc_attr( $section ); ?>">
			<div class="container">
				<?php if ( ! empty( $s['title'] ) || ! empty( $s['eyebrow'] ) ) : ?>
					<div class="section-head center reveal">
						<?php if ( ! empty( $s['eyebrow'] ) ) : ?>
							<div class="eyebrow"><?php echo $star; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php echo esc_html( $s['eyebrow'] ); ?></span></div>
						<?php endif; ?>
						<?php if ( ! empty( $s['title'] ) ) : ?>
							<h2><?php echo esc_html( $s['title'] ); ?></h2>
						<?php endif; ?>
						<?php if ( ! empty( $s['lede'] ) ) : ?>
							<p style="max-width:640px;margin:12px auto 0;"><?php echo esc_html( $s['lede'] ); ?></p>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<div class="grid grid-<?php echo esc_attr( $cols ); ?> reveal-stagger reveal">
					<?php foreach ( (array) $s['cards'] as $card ) : ?>
						<div class="why-card card">
							<div class="why-card-ic">
								<?php echo function_exists( 'tk_icon' ) ? tk_icon( $card['icon'] ?? 'check-circle', array( 'size' => 28 ) ) : ''; // phpcs:ignore ?>
							</div>
							<h3><?php echo esc_html( $card['card_title'] ); ?></h3>
							<p><?php echo esc_html( $card['card_text'] ); ?></p>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	}
}
