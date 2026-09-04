<?php
/**
 * Elementor Services Catalog widget.
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
 * Services catalog with categories + CPT cards.
 */
class TK_Widget_Services_Catalog extends Widget_Base {

	public function get_name() {
		return 'tk_services_catalog';
	}

	public function get_title() {
		return __( 'TK Services Catalog', 'tek-craft-toppres' );
	}

	public function get_icon() {
		return 'eicon-products';
	}

	public function get_categories() {
		return array( 'tek-craft-toppres' );
	}

	protected function register_controls() {
		$this->start_controls_section( 'content', array( 'label' => __( 'المحتوى', 'tek-craft-toppres' ) ) );

		$this->add_control(
			'source',
			array(
				'label'   => __( 'مصدر البطاقات', 'tek-craft-toppres' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'cpt',
				'options' => array(
					'cpt'    => __( 'خدمات CPT', 'tek-craft-toppres' ),
					'manual' => __( 'يدوي', 'tek-craft-toppres' ),
				),
			)
		);

		$this->add_control( 'sidebar_title', array( 'label' => __( 'عنوان القائمة الجانبية', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'الفئات الأكاديمية', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'sidebar_cta_title', array( 'label' => __( 'عنوان CTA الجانبي', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'لم تجد ما تبحث عنه؟', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'sidebar_cta_text', array( 'label' => __( 'نص CTA الجانبي', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXTAREA, 'default' => __( 'فريقنا جاهز لتصميم خدمة مخصصة تناسب بحثك.', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'sidebar_cta_btn', array( 'label' => __( 'زر CTA', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'طلب استشارة مجانية', 'tek-craft-toppres' ), 'dynamic' => array( 'active' => true ) ) );
		$this->add_control( 'sidebar_cta_link', array( 'label' => __( 'رابط CTA', 'tek-craft-toppres' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => home_url( '/contact/' ) ), 'dynamic' => array( 'active' => true ) ) );

		$cats = new Repeater();
		$cats->add_control( 'cat_title', array( 'label' => __( 'اسم الفئة', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'dynamic' => array( 'active' => true ) ) );
		$cats->add_control( 'cat_desc', array( 'label' => __( 'وصف الفئة', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXTAREA, 'dynamic' => array( 'active' => true ) ) );
		$cats->add_control( 'cat_anchor', array( 'label' => __( 'معرّف القسم (anchor)', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => 'cat-1' ) );

		$this->add_control(
			'categories',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $cats->get_controls(),
				'title_field' => '{{{ cat_title }}}',
				'default'     => array(
					array( 'cat_title' => __( 'الطلاب الجامعيين', 'tek-craft-toppres' ), 'cat_desc' => __( 'دعم أكاديمي متكامل لطلاب البكالوريوس.', 'tek-craft-toppres' ), 'cat_anchor' => 'cat-uni' ),
					array( 'cat_title' => __( 'الدراسات العليا', 'tek-craft-toppres' ), 'cat_desc' => __( 'خدمات الماجستير والدكتوراه.', 'tek-craft-toppres' ), 'cat_anchor' => 'cat-grad' ),
					array( 'cat_title' => __( 'منهجية البحث', 'tek-craft-toppres' ), 'cat_desc' => __( 'تحليل إحصائي ودراسات سابقة.', 'tek-craft-toppres' ), 'cat_anchor' => 'cat-research' ),
					array( 'cat_title' => __( 'الكتابة والنشر', 'tek-craft-toppres' ), 'cat_desc' => __( 'تدقيق لغوي ونشر علمي.', 'tek-craft-toppres' ), 'cat_anchor' => 'cat-write' ),
				),
			)
		);

		$cards = new Repeater();
		$cards->add_control( 'image', array( 'label' => __( 'صورة', 'tek-craft-toppres' ), 'type' => Controls_Manager::MEDIA ) );
		$cards->add_control( 'card_title', array( 'label' => __( 'العنوان', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'dynamic' => array( 'active' => true ) ) );
		$cards->add_control( 'card_text', array( 'label' => __( 'الوصف', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXTAREA, 'dynamic' => array( 'active' => true ) ) );
		$cards->add_control( 'badge', array( 'label' => __( 'شارة', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'dynamic' => array( 'active' => true ) ) );
		$cards->add_control( 'category_anchor', array( 'label' => __( 'معرّف الفئة', 'tek-craft-toppres' ), 'type' => Controls_Manager::TEXT, 'default' => 'cat-uni' ) );
		$cards->add_control( 'card_link', array( 'label' => __( 'الرابط', 'tek-craft-toppres' ), 'type' => Controls_Manager::URL, 'dynamic' => array( 'active' => true ) ) );

		$this->add_control(
			'cards',
			array(
				'type'      => Controls_Manager::REPEATER,
				'fields'    => $cards->get_controls(),
				'condition' => array( 'source' => 'manual' ),
				'title_field' => '{{{ card_title }}}',
			)
		);

		$this->add_control( 'cpt_count', array( 'label' => __( 'عدد الخدمات من CPT', 'tek-craft-toppres' ), 'type' => Controls_Manager::NUMBER, 'default' => 8, 'condition' => array( 'source' => 'cpt' ) ) );

		$this->end_controls_section();

		if ( function_exists( 'tk_register_common_style_controls' ) ) {
			tk_register_common_style_controls( $this, 'section' );
		}
	}

	protected function render() {
		$s    = $this->get_settings_for_display();
		$cta  = ! empty( $s['sidebar_cta_link']['url'] ) ? $s['sidebar_cta_link']['url'] : home_url( '/contact/' );
		$cats = (array) ( $s['categories'] ?? array() );
		$cards = array();

		if ( 'manual' === ( $s['source'] ?? 'cpt' ) ) {
			$cards = (array) ( $s['cards'] ?? array() );
		} else {
			$posts = get_posts(
				array(
					'post_type'      => 'tk_service',
					'posts_per_page' => (int) ( $s['cpt_count'] ?? 8 ),
					'post_status'    => 'publish',
				)
			);
			$anchors = array( 'cat-uni', 'cat-grad', 'cat-research', 'cat-write' );
			foreach ( $posts as $i => $p ) {
				$cards[] = array(
					'image'           => array( 'url' => get_the_post_thumbnail_url( $p, 'tk-card' ) ?: '' ),
					'card_title'      => get_the_title( $p ),
					'card_text'       => get_the_excerpt( $p ),
					'badge'           => '',
					'category_anchor' => $anchors[ $i % count( $anchors ) ],
					'card_link'       => array( 'url' => get_permalink( $p ) ),
				);
			}
		}
		?>
		<section class="section">
			<div class="container">
				<div class="services-layout">
					<aside class="services-sidebar">
						<h3><?php echo esc_html( $s['sidebar_title'] ); ?></h3>
						<ul class="services-menu" id="servicesMenu">
							<?php foreach ( $cats as $i => $cat ) : ?>
								<li>
									<a href="#<?php echo esc_attr( $cat['cat_anchor'] ); ?>" class="<?php echo 0 === $i ? 'active' : ''; ?>">
										<span><?php echo esc_html( $cat['cat_title'] ); ?></span>
										<?php echo function_exists( 'tk_icon' ) ? tk_icon( 'arrow-left', array( 'size' => 16 ) ) : ''; // phpcs:ignore ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
						<div style="margin-top:32px;padding:24px;background:rgba(201,154,59,.1);border-radius:8px;border:1px solid rgba(201,154,59,.2);text-align:center;">
							<h4 style="font-size:16px;color:var(--navy);margin-bottom:12px;"><?php echo esc_html( $s['sidebar_cta_title'] ); ?></h4>
							<p style="font-size:13.5px;color:var(--ink-soft);margin-bottom:16px;"><?php echo esc_html( $s['sidebar_cta_text'] ); ?></p>
							<a class="btn btn-gold btn-block btn-sm" href="<?php echo esc_url( $cta ); ?>"><?php echo esc_html( $s['sidebar_cta_btn'] ); ?></a>
						</div>
					</aside>

					<div class="services-content">
						<?php
						if ( 'cpt' === ( $s['source'] ?? 'cpt' ) ) {
							$chunks = array_chunk( $cards, 2 );
							foreach ( $cats as $i => $cat ) :
								$chunk = $chunks[ $i ] ?? array();
								if ( empty( $chunk ) && 0 !== $i ) {
									continue;
								}
								if ( empty( $chunk ) && 0 === $i ) {
									$chunk = $cards;
								}
								?>
								<div id="<?php echo esc_attr( $cat['cat_anchor'] ); ?>" class="service-section">
									<h2><?php echo esc_html( $cat['cat_title'] ); ?></h2>
									<?php if ( ! empty( $cat['cat_desc'] ) ) : ?>
										<p class="cat-desc"><?php echo esc_html( $cat['cat_desc'] ); ?></p>
									<?php endif; ?>
									<div class="grid grid-2">
										<?php foreach ( $chunk as $card ) :
											$img  = $card['image']['url'] ?? '';
											$link = $card['card_link']['url'] ?? '#';
											?>
											<a href="<?php echo esc_url( $link ); ?>" class="service-card">
												<div class="sc-img">
													<?php if ( $img ) : ?>
														<img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $card['card_title'] ); ?>" loading="lazy" width="600" height="400">
													<?php endif; ?>
													<span class="sc-badge"><?php echo esc_html( $card['card_title'] ); ?></span>
												</div>
												<div class="sc-content">
													<h3><?php echo esc_html( $card['card_title'] ); ?></h3>
													<p><?php echo esc_html( $card['card_text'] ); ?></p>
													<span class="sc-link"><?php esc_html_e( 'التفاصيل', 'tek-craft-toppres' ); ?> <span class="arrow">&larr;</span></span>
												</div>
											</a>
										<?php endforeach; ?>
									</div>
								</div>
								<?php
							endforeach;
						} else {
							foreach ( $cats as $cat ) :
								$anchor = $cat['cat_anchor'];
								$group  = array_values(
									array_filter(
										$cards,
										static function ( $c ) use ( $anchor ) {
											return ( $c['category_anchor'] ?? '' ) === $anchor;
										}
									)
								);
								if ( empty( $group ) ) {
									continue;
								}
								?>
								<div id="<?php echo esc_attr( $anchor ); ?>" class="service-section">
									<h2><?php echo esc_html( $cat['cat_title'] ); ?></h2>
									<?php if ( ! empty( $cat['cat_desc'] ) ) : ?>
										<p class="cat-desc"><?php echo esc_html( $cat['cat_desc'] ); ?></p>
									<?php endif; ?>
									<div class="grid grid-2">
										<?php foreach ( $group as $card ) :
											$img  = function_exists( 'tk_elementor_image_url' ) ? tk_elementor_image_url( $card['image'] ?? array() ) : ( $card['image']['url'] ?? '' );
											$link = ! empty( $card['card_link']['url'] ) ? $card['card_link']['url'] : '#';
											?>
											<a href="<?php echo esc_url( $link ); ?>" class="service-card">
												<div class="sc-img">
													<?php if ( $img ) : ?>
														<img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $card['card_title'] ); ?>" loading="lazy">
													<?php endif; ?>
													<?php if ( ! empty( $card['badge'] ) ) : ?>
														<span class="sc-badge"><?php echo esc_html( $card['badge'] ); ?></span>
													<?php endif; ?>
												</div>
												<div class="sc-content">
													<h3><?php echo esc_html( $card['card_title'] ); ?></h3>
													<p><?php echo esc_html( $card['card_text'] ); ?></p>
													<span class="sc-link"><?php esc_html_e( 'التفاصيل', 'tek-craft-toppres' ); ?> <span class="arrow">&larr;</span></span>
												</div>
											</a>
										<?php endforeach; ?>
									</div>
								</div>
								<?php
							endforeach;
						}
						?>
					</div>
				</div>
			</div>
		</section>
		<?php
	}
}
