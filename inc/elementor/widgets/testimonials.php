<?php
/**
 * Elementor Testimonials widget.
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
 * Testimonials cards.
 */
class TK_Widget_Testimonials extends Widget_Base {

	public function get_name() { return 'tk_testimonials'; }
	public function get_title() { return __( 'TK Testimonials', 'tek-craft-toppres' ); }
	public function get_icon() { return 'eicon-testimonial'; }
	public function get_categories() { return array( 'tek-craft-toppres' ); }

	protected function register_controls() {
		$this->start_controls_section( 'content', array( 'label' => __( 'Content', 'tek-craft-toppres' ) ) );
		$this->add_control( 'eyebrow', array( 'label' => __( 'Eyebrow', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'آراء عملائنا', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'title', array( 'label' => __( 'Title', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'طلاب وباحثون وثقوا بنا في محطة مهمة من مسيرتهم', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );

		$rep = new Repeater();
		$rep->add_control( 'avatar_image', array( 'label' => __( 'Avatar image (optional)', 'tek-craft-toppres' ), 'type' => Controls_Manager::MEDIA ) );
		$rep->add_control( 'avatar_letter', array( 'label' => __( 'Avatar letter', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => 'س' ) );
		$rep->add_control( 'quote', array( 'label' => __( 'Quote', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXTAREA, 'dynamic' => array( 'active' => true ) ) );
		$rep->add_control( 'name', array( 'label' => __( 'Name', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'dynamic' => array( 'active' => true ) ) );
		$rep->add_control( 'role', array( 'label' => __( 'Role', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'dynamic' => array( 'active' => true ) ) );
		$rep->add_control( 'time', array( 'label' => __( 'Voice time label', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => '0:45' ) );

		$this->add_control( 'items', array(
			'type' => Controls_Manager::REPEATER,
			'fields' => $rep->get_controls(),
			'default' => array(
				array( 'avatar_letter' => 'س', 'quote' => __( 'تعاملت مع توبرز في رسالة الماجستير، والفريق كان دقيقًا جدًا في المنهجية والتحليل الإحصائي. التزموا بالموعد تمامًا.', 'tek-craft-toppres' ), 'name' => __( 'سارة العتيبي', 'tek-craft-toppres' ), 'role' => __( 'طالبة ماجستير — إدارة أعمال', 'tek-craft-toppres' ), 'time' => '0:45' ),
				array( 'avatar_letter' => 'م', 'quote' => __( 'خدمة الترجمة الأكاديمية كانت احترافية، والمصطلحات العلمية دقيقة جدًا مقارنة بمكاتب أخرى تعاملت معها سابقًا.', 'tek-craft-toppres' ), 'name' => __( 'محمد الحربي', 'tek-craft-toppres' ), 'role' => __( 'باحث دكتوراه — علوم حاسب', 'tek-craft-toppres' ), 'time' => '1:12' ),
				array( 'avatar_letter' => 'ن', 'quote' => __( 'التواصل عبر واتساب سهّل عليّ متابعة بحث التخرج، وفريق الدعم كان متجاوبًا في كل مرحلة.', 'tek-craft-toppres' ), 'name' => __( 'نورة القحطاني', 'tek-craft-toppres' ), 'role' => __( 'طالبة بكالوريوس', 'tek-craft-toppres' ), 'time' => '0:30' ),
			),
			'title_field' => '{{{ name }}}',
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
				<div class="grid grid-3 reveal-stagger reveal">
					<?php foreach ( (array) $s['items'] as $item ) :
						$avatar = tk_elementor_image_url( isset( $item['avatar_image'] ) ? $item['avatar_image'] : array() );
						?>
						<div class="t-card">
							<div class="t-stars">★★★★★</div>
							<div class="voice-note">
								<button class="vn-play" type="button" aria-label="<?php esc_attr_e( 'تشغيل', 'tek-craft-toppres' ); ?>"><svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor"><path d="M8 5v14l11-7z" /></svg></button>
								<div class="vn-wave"><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span></div>
								<span class="vn-time"><?php echo esc_html( $item['time'] ); ?></span>
							</div>
							<p class="t-quote"><?php echo esc_html( $item['quote'] ); ?></p>
							<div class="t-who">
								<?php if ( $avatar ) : ?>
									<div class="t-avatar" style="background-image:url('<?php echo esc_url( $avatar ); ?>'); background-size:cover;"></div>
								<?php else : ?>
									<div class="t-avatar"><?php echo esc_html( $item['avatar_letter'] ); ?></div>
								<?php endif; ?>
								<div><b><?php echo esc_html( $item['name'] ); ?></b><span><?php echo esc_html( $item['role'] ); ?></span></div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	}
}
