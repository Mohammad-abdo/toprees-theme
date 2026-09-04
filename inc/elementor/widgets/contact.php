<?php
/**
 * Elementor Contact section widget — markup aligned with contact.html.
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * Contact form + premium info cards.
 */
class TK_Widget_Contact extends Widget_Base {

	public function get_name() {
		return 'tk_contact';
	}

	public function get_title() {
		return __( 'TK Contact', 'tek-craft-toppres' );
	}

	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	public function get_categories() {
		return array( 'tek-craft-toppres' );
	}

	protected function register_controls() {
		$this->start_controls_section( 'content', array( 'label' => __( 'المحتوى', 'tek-craft-toppres' ) ) );

		$this->add_control( 'form_title', array( 'label' => __( 'عنوان النموذج', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'أرسل طلبك', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'info_title', array( 'label' => __( 'عنوان معلومات التواصل', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'معلومات التواصل', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'phone_label', array( 'label' => __( 'عنوان الهاتف', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'الهاتف / واتساب', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'phone', array( 'label' => __( 'رقم الهاتف', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => '+966 54 909 3465', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'email_label', array( 'label' => __( 'عنوان البريد', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'البريد الإلكتروني', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'email', array( 'label' => __( 'البريد', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => 'info@toppers-edu.com', 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'hours_label', array( 'label' => __( 'عنوان الساعات', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'ساعات العمل', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'hours', array( 'label' => __( 'ساعات العمل', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXTAREA, 'default' => __( 'على مدار الساعة، طوال أيام الأسبوع', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'whatsapp_text', array( 'label' => __( 'نص زر واتساب', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'تواصل عبر واتساب', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'submit_text', array( 'label' => __( 'نص زر الإرسال', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'إرسال الطلب', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );

		$this->end_controls_section();

		if ( function_exists( 'tk_register_common_style_controls' ) ) {
			tk_register_common_style_controls( $this, 'section' );
		}
	}

	protected function render() {
		$s      = $this->get_settings_for_display();
		$wa     = function_exists( 'tk_whatsapp_url' ) ? tk_whatsapp_url() : 'https://wa.me/966549093465';
		$action = esc_url( admin_url( 'admin-post.php' ) );
		$sent   = isset( $_GET['tk_sent'] ) && '1' === $_GET['tk_sent']; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		?>
		<section class="section tk-contact-section">
			<div class="container split tk-contact-split">
				<div class="form-card reveal<?php echo $sent ? ' is-success' : ''; ?>">
					<div class="form-card-inner"<?php echo $sent ? ' hidden' : ''; ?>>
						<h3 class="tk-contact-form-title"><?php echo esc_html( $s['form_title'] ); ?></h3>
						<form method="post" action="<?php echo $action; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" class="tk-contact-form" id="request-form">
							<input type="hidden" name="action" value="tk_contact_request">
							<?php wp_nonce_field( 'tk_contact_request', 'tk_contact_nonce' ); ?>

							<div class="field-row">
								<div class="field">
									<label for="tk_name"><?php esc_html_e( 'الاسم الكامل', 'tek-craft-toppres' ); ?></label>
									<input id="tk_name" type="text" name="tk_name" required placeholder="<?php esc_attr_e( 'الاسم الكامل', 'tek-craft-toppres' ); ?>">
								</div>
								<div class="field">
									<label for="tk_phone"><?php esc_html_e( 'رقم الجوال', 'tek-craft-toppres' ); ?></label>
									<input id="tk_phone" type="tel" name="tk_phone" required placeholder="+966..." dir="ltr">
								</div>
							</div>

							<div class="field">
								<label for="tk_email"><?php esc_html_e( 'البريد الإلكتروني', 'tek-craft-toppres' ); ?></label>
								<input id="tk_email" type="email" name="tk_email" required placeholder="name@example.com" dir="ltr">
							</div>

							<div class="field-row">
								<div class="field">
									<label for="tk_level"><?php esc_html_e( 'المرحلة الدراسية', 'tek-craft-toppres' ); ?></label>
									<select id="tk_level" name="tk_level">
										<option value=""><?php esc_html_e( 'اختر المرحلة', 'tek-craft-toppres' ); ?></option>
										<option><?php esc_html_e( 'بكالوريوس', 'tek-craft-toppres' ); ?></option>
										<option><?php esc_html_e( 'ماجستير', 'tek-craft-toppres' ); ?></option>
										<option><?php esc_html_e( 'دكتوراه', 'tek-craft-toppres' ); ?></option>
										<option><?php esc_html_e( 'باحث / أكاديمي', 'tek-craft-toppres' ); ?></option>
									</select>
								</div>
								<div class="field">
									<label for="tk_service"><?php esc_html_e( 'الخدمة المطلوبة', 'tek-craft-toppres' ); ?></label>
									<select id="tk_service" name="tk_service">
										<option value=""><?php esc_html_e( 'اختر الخدمة', 'tek-craft-toppres' ); ?></option>
										<option><?php esc_html_e( 'البحوث الجامعية', 'tek-craft-toppres' ); ?></option>
										<option><?php esc_html_e( 'رسائل الماجستير', 'tek-craft-toppres' ); ?></option>
										<option><?php esc_html_e( 'أطروحات الدكتوراه', 'tek-craft-toppres' ); ?></option>
										<option><?php esc_html_e( 'التحليل الإحصائي', 'tek-craft-toppres' ); ?></option>
										<option><?php esc_html_e( 'الترجمة الأكاديمية', 'tek-craft-toppres' ); ?></option>
										<option><?php esc_html_e( 'التدقيق اللغوي', 'tek-craft-toppres' ); ?></option>
									</select>
								</div>
							</div>

							<div class="field">
								<label for="tk_deadline"><?php esc_html_e( 'الموعد المطلوب', 'tek-craft-toppres' ); ?></label>
								<input id="tk_deadline" type="date" name="tk_deadline">
							</div>

							<div class="field">
								<label for="tk_message"><?php esc_html_e( 'تفاصيل الطلب', 'tek-craft-toppres' ); ?></label>
								<textarea id="tk_message" name="tk_message" rows="4" placeholder="<?php esc_attr_e( 'اكتب تفاصيل طلبك، التخصص، وأي ملاحظات من جامعتك…', 'tek-craft-toppres' ); ?>"></textarea>
							</div>

							<button type="submit" class="btn btn-gold btn-block"><?php echo esc_html( $s['submit_text'] ); ?></button>
						</form>
					</div>

					<div class="form-success"<?php echo $sent ? '' : ' hidden'; ?>>
						<div class="check" aria-hidden="true">
							<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M20 6L9 17l-5-5"/></svg>
						</div>
						<h3><?php esc_html_e( 'تم استلام طلبك بنجاح', 'tek-craft-toppres' ); ?></h3>
						<p><?php esc_html_e( 'سيتواصل معك فريقنا خلال ساعات لمناقشة تفاصيل طلبك وتزويدك بعرض السعر.', 'tek-craft-toppres' ); ?></p>
						<a class="btn btn-outline-dark" href="<?php echo esc_url( get_permalink() ); ?>"><?php esc_html_e( 'إرسال طلب آخر', 'tek-craft-toppres' ); ?></a>
					</div>
				</div>

				<div class="tk-contact-info reveal">
					<h3 class="tk-contact-info-title"><?php echo esc_html( $s['info_title'] ); ?></h3>

					<a href="<?php echo esc_url( $wa ); ?>" target="_blank" rel="noopener noreferrer" class="info-card-premium">
						<div class="info-ic-premium">
							<?php echo function_exists( 'tk_icon' ) ? tk_icon( 'phone', array( 'size' => 22 ) ) : ''; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
						<div class="info-details">
							<h4><?php echo esc_html( $s['phone_label'] ); ?></h4>
							<p dir="ltr"><?php echo esc_html( $s['phone'] ); ?></p>
						</div>
						<span class="info-action-arrow" aria-hidden="true">&larr;</span>
					</a>

					<a href="mailto:<?php echo esc_attr( $s['email'] ); ?>" class="info-card-premium">
						<div class="info-ic-premium">
							<?php echo function_exists( 'tk_icon' ) ? tk_icon( 'mail', array( 'size' => 22 ) ) : ''; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
						<div class="info-details">
							<h4><?php echo esc_html( $s['email_label'] ); ?></h4>
							<p dir="ltr"><?php echo esc_html( $s['email'] ); ?></p>
						</div>
						<span class="info-action-arrow" aria-hidden="true">&larr;</span>
					</a>

					<div class="info-card-premium">
						<div class="info-ic-premium">
							<?php echo function_exists( 'tk_icon' ) ? tk_icon( 'clock', array( 'size' => 22 ) ) : ''; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
						<div class="info-details">
							<h4><?php echo esc_html( $s['hours_label'] ); ?></h4>
							<p><?php echo esc_html( $s['hours'] ); ?></p>
						</div>
					</div>

					<a href="<?php echo esc_url( $wa ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-gold btn-block tk-contact-wa-btn">
						<?php echo function_exists( 'tk_icon' ) ? tk_icon( 'message', array( 'size' => 18 ) ) : ''; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<span><?php echo esc_html( $s['whatsapp_text'] ); ?></span>
					</a>
				</div>
			</div>
		</section>
		<?php
	}
}
