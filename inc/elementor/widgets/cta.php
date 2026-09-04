<?php
/**
 * Elementor CTA widget.
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * CTA band.
 */
class TK_Widget_CTA extends Widget_Base {

	public function get_name() { return 'tk_cta'; }
	public function get_title() { return __( 'TK CTA Band', 'tek-craft-toppres' ); }
	public function get_icon() { return 'eicon-call-to-action'; }
	public function get_categories() { return array( 'tek-craft-toppres' ); }

	protected function register_controls() {
		$this->start_controls_section( 'content', array( 'label' => __( 'Content', 'tek-craft-toppres' ) ) );
		$this->add_control( 'title', array( 'label' => __( 'Title', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'جاهز لبدء رحلتك البحثية؟', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'lede', array( 'label' => __( 'Description', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXTAREA, 'default' => __( 'أرسل تفاصيل مشروعك الآن واحصل على استشارة أولية وعرض سعر مجاني خلال ساعات.', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'btn1_text', array( 'label' => __( 'Button 1 text', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'اطلب خدمتك', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'btn1_link', array( 'label' => __( 'Button 1 link', 'tek-craft-toppres' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => home_url( '/contact/' ) ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'btn2_text', array( 'label' => __( 'Button 2 text', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'تواصل عبر واتساب', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'btn2_link', array( 'label' => __( 'Button 2 link', 'tek-craft-toppres' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => function_exists( 'tk_whatsapp_url' ) ? tk_whatsapp_url() : '' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'bg_image', array( 'label' => __( 'Background image (optional)', 'tek-craft-toppres' ), 'type' => Controls_Manager::MEDIA ) );
		$this->end_controls_section();

		if ( function_exists( 'tk_register_common_style_controls' ) ) {
			tk_register_common_style_controls( $this, 'section' );
		}
	}

	protected function render() {
		$s  = $this->get_settings_for_display();
		$bg = tk_elementor_image_url( $s['bg_image'] );
		$b1 = ! empty( $s['btn1_link']['url'] ) ? $s['btn1_link']['url'] : '#';
		$b2 = ! empty( $s['btn2_link']['url'] ) ? $s['btn2_link']['url'] : '#';
		$style = $bg ? ' style="background-image:url(' . esc_url( $bg ) . '); background-size:cover;"' : '';
		?>
		<section class="section--tight">
			<div class="container">
				<div class="cta-band reveal"<?php echo $style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<h2><?php echo esc_html( $s['title'] ); ?></h2>
					<p><?php echo esc_html( $s['lede'] ); ?></p>
					<div class="cta-actions">
						<?php if ( $s['btn1_text'] ) : ?>
							<a href="<?php echo esc_url( $b1 ); ?>" class="btn btn-gold"><?php echo esc_html( $s['btn1_text'] ); ?></a>
						<?php endif; ?>
						<?php if ( $s['btn2_text'] ) : ?>
							<a href="<?php echo esc_url( $b2 ); ?>" class="btn btn-outline" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $s['btn2_text'] ); ?></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>
		<?php
	}
}
