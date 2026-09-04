<?php
/**
 * Elementor Split Content widget.
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * Text + media / side box.
 */
class TK_Widget_Split_Content extends Widget_Base {

	public function get_name() {
		return 'tk_split_content';
	}

	public function get_title() {
		return __( 'TK Split Content', 'tek-craft-toppres' );
	}

	public function get_icon() {
		return 'eicon-columns';
	}

	public function get_categories() {
		return array( 'tek-craft-toppres' );
	}

	protected function register_controls() {
		$this->start_controls_section( 'content', array( 'label' => __( 'المحتوى', 'tek-craft-toppres' ) ) );

		$this->add_control( 'eyebrow', array( 'label' => __( 'سطر علوي', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'title', array( 'label' => __( 'العنوان', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'body', array( 'label' => __( 'النص', 'tek-craft-toppres' ), 'type' => Controls_Manager::WYSIWYG, 'default' => __( 'نص القسم هنا…', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'image', array( 'label' => __( 'صورة جانبية', 'tek-craft-toppres' ), 'type' => Controls_Manager::MEDIA ) );
		$this->add_control( 'side_title', array( 'label' => __( 'عنوان الصندوق الجانبي', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'side_text', array( 'label' => __( 'نص الصندوق الجانبي', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXTAREA, 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'btn_text', array( 'label' => __( 'نص الزر', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'btn_link', array( 'label' => __( 'رابط الزر', 'tek-craft-toppres' ), 'type' => Controls_Manager::URL, 'dynamic' => array( 'active' => true ) ) );
		$this->add_control(
			'reverse',
			array(
				'label'        => __( 'عكس الاتجاه', 'tek-craft-toppres' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'alt_bg',
			array(
				'label'        => __( 'خلفية بديلة', 'tek-craft-toppres' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			)
		);

		$this->end_controls_section();

		if ( function_exists( 'tk_register_common_style_controls' ) ) {
			tk_register_common_style_controls( $this, 'section' );
		}
	}

	protected function render() {
		$s       = $this->get_settings_for_display();
		$img     = function_exists( 'tk_elementor_image_url' ) ? tk_elementor_image_url( $s['image'] ) : '';
		$section = ( 'yes' === ( $s['alt_bg'] ?? '' ) ) ? 'section section--alt' : 'section';
		$rev     = ( 'yes' === ( $s['reverse'] ?? '' ) );
		$btn     = ! empty( $s['btn_link']['url'] ) ? $s['btn_link']['url'] : '';
		$star    = function_exists( 'tk_star_svg' ) ? tk_star_svg() : '';
		?>
		<section class="<?php echo esc_attr( $section ); ?>">
			<div class="container">
				<div class="split reveal" style="align-items:center;gap:48px;<?php echo $rev ? 'flex-direction:row-reverse;' : ''; ?>">
					<div style="flex:1.2;">
						<?php if ( ! empty( $s['eyebrow'] ) ) : ?>
							<div class="eyebrow"><?php echo $star; // phpcs:ignore ?><span><?php echo esc_html( $s['eyebrow'] ); ?></span></div>
						<?php endif; ?>
						<?php if ( ! empty( $s['title'] ) ) : ?>
							<h2 style="margin-bottom:18px;"><?php echo esc_html( $s['title'] ); ?></h2>
						<?php endif; ?>
						<div class="entry-content"><?php echo wp_kses_post( $s['body'] ); ?></div>
						<?php if ( ! empty( $s['btn_text'] ) && $btn ) : ?>
							<p style="margin-top:24px;"><a class="btn btn-gold" href="<?php echo esc_url( $btn ); ?>"><?php echo esc_html( $s['btn_text'] ); ?></a></p>
						<?php endif; ?>
					</div>
					<div style="flex:1;">
						<?php if ( $img ) : ?>
							<img src="<?php echo esc_url( $img ); ?>" alt="" loading="lazy" style="width:100%;border-radius:8px;object-fit:cover;max-height:420px;">
						<?php elseif ( ! empty( $s['side_title'] ) || ! empty( $s['side_text'] ) ) : ?>
							<div class="card" style="padding:28px;background:var(--paper-2);border:1px solid var(--line);border-radius:8px;">
								<?php if ( ! empty( $s['side_title'] ) ) : ?>
									<h3 style="margin-bottom:12px;color:var(--navy);"><?php echo esc_html( $s['side_title'] ); ?></h3>
								<?php endif; ?>
								<?php if ( ! empty( $s['side_text'] ) ) : ?>
									<p style="margin:0;color:var(--ink-soft);"><?php echo esc_html( $s['side_text'] ); ?></p>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>
		<?php
	}
}
