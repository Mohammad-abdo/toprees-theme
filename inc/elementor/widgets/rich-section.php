<?php
/**
 * Elementor Rich Section widget (privacy/terms/etc).
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * Rich text content section.
 */
class TK_Widget_Rich_Section extends Widget_Base {

	public function get_name() {
		return 'tk_rich_section';
	}

	public function get_title() {
		return __( 'TK Rich Section', 'tek-craft-toppres' );
	}

	public function get_icon() {
		return 'eicon-text';
	}

	public function get_categories() {
		return array( 'tek-craft-toppres' );
	}

	protected function register_controls() {
		$this->start_controls_section( 'content', array( 'label' => __( 'المحتوى', 'tek-craft-toppres' ) ) );
		$this->add_control( 'title', array( 'label' => __( 'عنوان فرعي (اختياري)', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'dynamic' => array( 'active' => true ) ) );
		$this->add_control(
			'body',
			array(
				'label'   => __( 'المحتوى', 'tek-craft-toppres' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => __( '<p>اكتب محتوى الصفحة هنا من Elementor.</p>', 'tek-craft-toppres' ),
				'dynamic' => array( 'active' => true ),
			)
		);
		$this->end_controls_section();

		if ( function_exists( 'tk_register_common_style_controls' ) ) {
			tk_register_common_style_controls( $this, 'section' );
		}
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		?>
		<section class="section">
			<div class="container" style="max-width:860px;">
				<?php if ( ! empty( $s['title'] ) ) : ?>
					<h2 style="margin-bottom:20px;"><?php echo esc_html( $s['title'] ); ?></h2>
				<?php endif; ?>
				<div class="entry-content article-body">
					<?php echo wp_kses_post( $s['body'] ); ?>
				</div>
			</div>
		</section>
		<?php
	}
}
