<?php
/**
 * Template Name: فريق العمل
 *
 * @package Toppers
 */

get_header();

$categories = toppers_team_roster();
$known      = array();
foreach ( $categories as $key => $cat ) {
	foreach ( $cat['members'] as $i => $member ) {
		$known[] = $member[0];
		$post_id = toppers_post_exists_title( $member[0], 'toppers_team' );
		if ( ! $post_id ) {
			continue;
		}
		$custom = wp_strip_all_tags( get_post_field( 'post_content', $post_id ) );
		if ( $custom ) {
			$categories[ $key ]['members'][ $i ][2] = $custom;
		}
		$uni = get_post_meta( $post_id, '_toppers_university', true );
		if ( $uni ) {
			$categories[ $key ]['members'][ $i ][1] = $uni;
		}
	}
}

$extra = new WP_Query(
	array(
		'post_type'      => 'toppers_team',
		'posts_per_page' => 50,
		'post_status'    => 'publish',
		'orderby'        => 'menu_order title',
		'order'          => 'ASC',
	)
);
if ( $extra->have_posts() ) {
	while ( $extra->have_posts() ) {
		$extra->the_post();
		$name = get_the_title();
		if ( in_array( $name, $known, true ) ) {
			continue;
		}
		$cat_key = get_post_meta( get_the_ID(), '_toppers_team_cat', true );
		if ( ! isset( $categories[ $cat_key ] ) ) {
			continue;
		}
		$uni = get_post_meta( get_the_ID(), '_toppers_university', true );
		if ( ! $uni ) {
			$uni = get_post_meta( get_the_ID(), '_toppers_role', true );
		}
		$categories[ $cat_key ]['members'][] = array(
			$name,
			$uni,
			wp_strip_all_tags( get_the_content() ),
		);
	}
	wp_reset_postdata();
}

$steps = array(
	array( 'التوجيه العلمي والمنهجي', 'يتولى الباحث المختص في المجال الأكاديمي الدقيق وضع الإطار العلمي والإشراف على المضمون ورسم ملامح الفصول.' ),
	array( 'المعالجة والتحليل الإحصائي', 'ينقل الملف إلى خبراء الإحصاء والبيانات لمعالجة الأرقام وبناء العلاقات الإحصائية واختبار الفرضيات بأعلى درجات الدقة.' ),
	array( 'التدقيق والضبط اللغوي', 'يخضع العمل لمراجعة شاملة من حُرّاس اللغة والضبط الأكاديمي لضمان الرصانة والسلامة اللغوية والخلو من الانتحال العلمي.' ),
	array( 'الفلترة والجودة النهائية', 'تتولى إدارة الجودة المطابقة النهائية للمواصفات والشروط الأكاديمية ودليل الجامعة المعتمد قبل تسليم الباحث.' ),
);
?>
<main class="site-main">
	<?php
	if ( toppers_is_elementor_page() ) {
		while ( have_posts() ) {
			the_post();
			the_content();
		}
	} else {
		get_template_part(
			'template-parts/page-hero',
			null,
			toppers_hero_args(
				'team',
				array(
					'title'   => __( 'العقول الأكاديمية والتقنية خلف تميزك', 'toppers' ),
					'eyebrow' => __( 'فريق العمل', 'toppers' ),
					'crumb'   => __( 'فريق العمل', 'toppers' ),
					'lede'    => __( 'في «توبرز»، لا نؤمن بالحلول العشوائية أو العمل الفردي. يقف خلف كل رسالة علمية وبحث مُحكّم منظومة متكاملة تقودها نخبة من الباحثين والأكاديميين، مدعومين بفريق تقني وإداري يعمل على مدار الساعة ليضمن لك رحلة بحثية آمنة، دقيقة، وخالية من التعقيد.', 'toppers' ),
					'plain'   => true,
				)
			)
		);
		?>
		<section class="section">
			<div class="container split">
				<div class="reveal">
					<div class="eyebrow"><?php echo toppers_star_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php echo esc_html( toppers_content( 'team_how_eyebrow', __( 'ضمان الكفاءة', 'toppers' ) ) ); ?></span></div>
					<h2><?php echo esc_html( toppers_content( 'team_how_title', __( 'كيف نضمن لك أعلى مستوى من الكفاءة؟', 'toppers' ) ) ); ?></h2>
					<p><?php echo esc_html( toppers_content( 'team_how_p1', __( 'لا ينضم أي متخصص إلى فريق «توبرز» بطريقة عشوائية؛ بل نتبع منهجية انتقائية صارمة تضمن أعلى مستويات الرصانة والأمانة العلمية. نلزم كافة أعضاء فريقنا بالحصول على مؤهلات أكاديمية متقدمة وتخصصات دقيقة في مجالاتهم، مع امتلاك سجل حافل بالخبرة البحثية والميدانية.', 'toppers' ) ) ); ?></p>
					<p><?php echo esc_html( toppers_content( 'team_how_p2', __( 'كما يخضع كل مختص لاختبارات تقييم عملي مكثفة وتدريب مستمر على أحدث أدوات التدقيق وفحص أصالة النصوص، لضمان حصولك على خدمة أكاديمية متكاملة يُعتد بها، ووفق أعلى المعايير الدولية.', 'toppers' ) ) ); ?></p>
				</div>
				<div class="reveal" style="display: flex; align-items: center; justify-content: center;">
					<div class="card" style="width: 100%; padding: 40px; background: var(--navy); color: white; border: none;">
						<div style="width: 64px; height: 64px; border-radius: 50%; background: rgba(201,154,59,0.15); display: flex; align-items: center; justify-content: center; margin-bottom: 20px; color: var(--gold-light);">
							<i class="fa-solid fa-shield-halved" aria-hidden="true" style="font-size: 32px;"></i>
						</div>
						<h3 style="color: var(--gold-light); margin-bottom: 12px;"><?php esc_html_e( 'معايير اختيار صارمة', 'toppers' ); ?></h3>
						<p style="color: rgba(255,255,255,0.8); font-size: 14.5px; line-height: 1.8; margin-bottom: 0;"><?php esc_html_e( 'نحن نفحص السير الذاتية والشهادات بدقة، ونقيم القدرة الفعلية للمتقدمين من خلال اختبارات عملية في الصياغة والتحليل المنهجي.', 'toppers' ); ?></p>
					</div>
				</div>
			</div>
		</section>

		<section class="section section--alt">
			<div class="container">
				<div class="section-head center reveal">
					<div class="eyebrow"><?php echo toppers_star_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php echo esc_html( toppers_content( 'team_roster_eyebrow', __( 'هيكل الفريق الأكاديمي', 'toppers' ) ) ); ?></span></div>
					<h2><?php echo esc_html( toppers_content( 'team_roster_title', __( 'نخبة العقول الأكاديمية والخبرات البحثية', 'toppers' ) ) ); ?></h2>
					<p style="margin-inline:auto; max-width:700px;"><?php echo esc_html( toppers_content( 'team_roster_lede', __( 'فريق متكامل من المختصين داخل وخارج المملكة يقود رحلتك العلمية نحو التميز بالمعرفة والدقة المنهجية', 'toppers' ) ) ); ?></p>
				</div>
				<?php foreach ( $categories as $cat ) : ?>
					<div class="team-cat">
						<h3 class="reveal team-cat-title"><?php echo esc_html( $cat['title'] ); ?></h3>
						<p class="reveal cat-desc"><?php echo esc_html( $cat['desc'] ); ?></p>
						<div class="grid grid-2 reveal-stagger reveal">
							<?php foreach ( $cat['members'] as $member ) : ?>
								<div class="team-card">
									<div class="team-avatar"><?php echo esc_html( toppers_first_letter( $member[0] ) ); ?></div>
									<div>
										<h4><?php echo esc_html( $member[0] ); ?> <span class="team-badge"><?php echo esc_html( $member[1] ); ?></span></h4>
										<p><?php echo esc_html( $member[2] ); ?></p>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
						<?php if ( ! empty( $cat['note'] ) ) : ?>
							<p class="reveal team-note"><?php echo esc_html( $cat['note'] ); ?></p>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</section>

		<section class="section">
			<div class="container">
				<div class="section-head center reveal">
					<div class="eyebrow"><?php echo toppers_star_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'تكامل المنظومة', 'toppers' ); ?></span></div>
					<h2><?php esc_html_e( 'كيف يعمل فريق توبرز معًا؟', 'toppers' ); ?></h2>
					<p style="margin-inline:auto; max-width:750px;"><?php esc_html_e( 'في توبرز، لا يعمل أي مختص بمعزل عن الآخرين، ولا نعتمد إطلاقًا على الفردية في إدارة المشاريع الأكاديمية؛ بل نخضع كل طلب لمنظومة تشغيلية متكاملة يمر خلالها المشروع بعدة مراحل متسلسلة لضمان أعلى مستويات الجودة:', 'toppers' ); ?></p>
				</div>
				<div class="journey journey-4step reveal-stagger reveal">
					<?php foreach ( $steps as $i => $step ) : ?>
						<div class="journey-step">
							<div class="journey-num"><?php echo esc_html( (string) ( $i + 1 ) ); ?></div>
							<h4><?php echo esc_html( $step[0] ); ?></h4>
							<p><?php echo esc_html( $step[1] ); ?></p>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="reveal center" style="margin-top: 40px; max-width: 800px; margin-inline: auto;">
					<p style="font-weight: 600; font-size: 15px; color: var(--ink-soft);"><?php esc_html_e( 'هذا التكامل بين الخبرات المتباينة هو السر وراء تقديم أعمال أكاديمية رصينة ومكتملة الجوانب، ويضمن لك مخرجات تُبنى برؤية فريق متخصص وليس باجتهاد فردي واحد.', 'toppers' ); ?></p>
				</div>
			</div>
		</section>

		<section class="section section--alt">
			<div class="container">
				<div class="cta-band reveal">
					<h2><?php esc_html_e( 'هل تريد التعامل مع فريقنا المتخصص؟', 'toppers' ); ?></h2>
					<p style="margin-top: 12px; margin-bottom: 24px; color: rgba(255,255,255,0.85);"><?php esc_html_e( 'ابدأ مشروعك الآن مع النخبة الأكاديمية والتقنية في الوطن العربي واحصل على تقارير الأصالة المعتمدة.', 'toppers' ); ?></p>
					<div class="cta-actions">
						<a class="btn btn-gold" href="<?php echo esc_url( toppers_page_url( 'contact' ) ); ?>"><?php esc_html_e( 'تواصل معنا الآن', 'toppers' ); ?></a>
						<a class="btn btn-outline" href="<?php echo esc_url( toppers_whatsapp_url() ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'تواصل عبر الواتساب', 'toppers' ); ?></a>
					</div>
				</div>
			</div>
		</section>
		<?php
	}
	?>
</main>
<?php
get_footer();
