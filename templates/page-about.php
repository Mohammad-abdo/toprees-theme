<?php
/**
 * Template Name: من نحن
 *
 * @package Toppers
 */

get_header();
?>
<main class="site-main">
	<?php if ( toppers_is_elementor_page() ) : ?>
		<?php
		while ( have_posts() ) {
			the_post();
			the_content();
		}
		?>
	<?php else : ?>
		<section class="about-hero">
			<div class="container about-hero-wrap">
				<div class="about-hero-text">
					<div class="breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'الرئيسية', 'toppers' ); ?></a><span>/</span><span><?php esc_html_e( 'من نحن', 'toppers' ); ?></span></div>
					<div class="eyebrow"><?php echo toppers_star_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php echo esc_html( toppers_content( 'about_eyebrow', __( 'شريكك الأكاديمي الموثوق', 'toppers' ) ) ); ?></div>
					<h1><?php echo esc_html( toppers_content( 'about_title', __( 'منظومتك المتكاملة لخدمات البحث العلمي؛ نُخب متخصصة تقود مشروعك خطوة بخطوة إلى الاعتماد', 'toppers' ) ) ); ?></h1>
					<p class="about-hero-lede"><?php echo esc_html( toppers_content( 'about_lede', __( 'نحن منظومة أكاديمية رائدة ومتخصصة في تقديم خدمات البحث العلمي لطلبة الدراسات العليا والباحثين في المملكة العربية السعودية والوطن العربي. نُسخّر نخبة من الكفاءات الأكاديمية لتذليل عقبات البحث العلمي، وصياغة نتاج معرفي أصيل يلتزم بأعلى معايير النزاهة والضوابط الجامعية؛ لنكون سندك الموثوق في كل مرحلة من رحلتك الأكاديمية، ونرتقي معًا نحو قمة البحث العلمي.', 'toppers' ) ) ); ?></p>
					<div class="about-hero-actions">
						<a href="<?php echo esc_url( toppers_page_url( 'services' ) ); ?>" class="btn btn-navy"><?php esc_html_e( 'استكشف خدماتنا', 'toppers' ); ?></a>
						<a href="<?php echo esc_url( toppers_page_url( 'contact' ) ); ?>" class="btn btn-outline-dark"><?php esc_html_e( 'تواصل معنا', 'toppers' ); ?></a>
					</div>
				</div>
				<div class="about-hero-img-wrap">
					<div class="about-hero-img-bg"></div>
					<img src="<?php echo esc_url( toppers_content_img( 'about_image', toppers_photo( 'about-hero' ) ) ); ?>" alt="<?php esc_attr_e( 'طلاب في الجامعة', 'toppers' ); ?>">
				</div>
			</div>
		</section>

		<section class="about-story-sec">
			<div class="about-story-bg"><div class="about-story-overlay"></div></div>
			<div class="container about-story-inner">
				<div class="about-story-box">
					<div class="eyebrow"><?php echo toppers_star_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'قصتنا', 'toppers' ); ?></span></div>
					<h2><?php echo esc_html( toppers_content( 'about_story_title', __( 'من فكرة إلى منظومة أكاديمية', 'toppers' ) ) ); ?></h2>
					<p><?php echo esc_html( toppers_content( 'about_story_p1', __( 'بدأت رحلة شركة توبرز للاستشارات والحلول البحثية عام 2016 من فهم عميق لواقع البيئة الأكاديمية؛ حيث يمتلك الباحثون وطلاب الدراسات العليا أفكارًا علمية نيرة، لكنهم يصطدمون بعقبات التنفيذ المنهجي ودقة التحليل والالتزام الصارم بالأدلة الجامعية. انطلقنا حينها بفريق شغوف من الأكاديميين لجسر هذه الفجوة وتذليل تلك التحديات، لتتوج هذه الجهود بالانطلاق الحقيقي والمؤسسي للشركة عام 2019؛ حيث تحولت "توبرز" إلى منظومة استشارية وبحثية متكاملة تضم نخبة من الباحثين والمحللين والمدققين اللغويين في مختلف التخصصات العلمية والإنسانية.', 'toppers' ) ) ); ?></p>
					<p><?php echo esc_html( toppers_content( 'about_story_p2', __( 'واليوم، نفخر بشراكتنا الممتدة مع الباحثين وأعضاء هيئة التدريس في كافة الجامعات السعودية والعربية، والتي أثمرت عن إلمام عميق بكافة ضوابط الرسائل العلمية واشتراطات النشر المحكّم، لنواصل مسيرتنا بثبات نحو قمة البحث العلمي.', 'toppers' ) ) ); ?></p>
				</div>
			</div>
		</section>

		<section class="founder-sec">
			<div class="container">
				<div class="section-head center">
					<div class="eyebrow"><?php echo toppers_star_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'كلمة المؤسس', 'toppers' ); ?></span></div>
					<h2><?php echo esc_html( toppers_content( 'about_founder_title', __( 'شريكك حتى لحظة المناقشة', 'toppers' ) ) ); ?></h2>
				</div>
				<div class="founder-box">
					<span class="founder-quote-mark">”</span>
					<p class="founder-text"><?php echo esc_html( toppers_content( 'about_founder_text', __( 'أدرك تمامًا حجم الضغط الذي يواجهه كل باحث في مراحل إعداد رسالته العلمية، فقد كانت هذه المعاناة نفسها هي الدافع وراء تأسيس "توبرز". لم نُرِد أن نكون مجرد جهة تقدّم خدمة، بل شريكًا حقيقيًا يفهم قلق الباحث ويقف بجانبه في كل خطوة، من اختيار العنوان وحتى لحظة المناقشة. نلتزم أمامكم بتقديم دعم منهجي حقيقي، لا وعودًا تسويقية فارغة.', 'toppers' ) ) ); ?></p>
					<p class="founder-sign"><?php echo esc_html( toppers_content( 'about_founder_sign', __( '— د. عمرو، مؤسس شركة توبرز للاستشارات والحلول البحثية', 'toppers' ) ) ); ?></p>
				</div>
			</div>
		</section>

		<section class="about-stats-sec">
			<div class="container">
				<div class="section-head center">
					<h2><?php esc_html_e( 'إنجازات بالأرقام.. ثقة تُجسّدها المسيرة', 'toppers' ); ?></h2>
				</div>
				<div class="about-stats-grid">
					<?php
					foreach ( array( array( '+10', 'سنوات خبرة مؤسسية' ), array( '+500', 'مختص أكاديمي' ), array( '+10000', 'مشروع وبحث أكاديمي' ), array( '98.5%', 'معدل رضا العملاء' ) ) as $stat ) {
						echo '<div class="about-stat-card"><div class="about-stat-num">' . esc_html( $stat[0] ) . '</div><div class="about-stat-label">' . esc_html( $stat[1] ) . '</div></div>';
					}
					?>
				</div>
			</div>
		</section>

		<section class="about-mv-sec">
			<div class="container">
				<div class="section-head center about-mv-head">
					<h2><?php esc_html_e( 'رسالتنا ورؤيتنا', 'toppers' ); ?></h2>
				</div>
				<div class="about-mv-grid">
					<div class="about-mv-card">
						<div class="about-mv-ic">
							<i class="fa-solid fa-bullseye" aria-hidden="true" style="font-size: 32px;"></i>
						</div>
						<h3><?php esc_html_e( 'رسالتنا', 'toppers' ); ?></h3>
						<p><?php esc_html_e( 'تمكين طلبة الدراسات العليا والباحثين من تحقيق التميز الأكاديمي، عبر تقديم استشارات وحلول بحثية ومنهجية رصينة، نُسخّر لها نخبة من الكفاءات العلمية، مع الالتزام المطلق بأعلى معايير النزاهة والخصوصية والضوابط الجامعية.', 'toppers' ); ?></p>
					</div>
					<div class="about-mv-card">
						<div class="about-mv-ic">
							<i class="fa-solid fa-eye" aria-hidden="true" style="font-size: 32px;"></i>
						</div>
						<h3><?php esc_html_e( 'رؤيتنا', 'toppers' ); ?></h3>
						<p><?php esc_html_e( 'أن نكون المنظومة الأكاديمية الاستشارية الأولى والأكثر ثقة في المملكة العربية السعودية والوطن العربي، والمرجع الرائد في تمكين الباحثين ورفد المكتبة العربية بنتاج علمي أصيل يُعتد به عالميًا.', 'toppers' ); ?></p>
					</div>
				</div>
			</div>
		</section>

		<section class="audience-sec">
			<div class="container">
				<div class="section-head center">
					<div class="eyebrow"><?php echo toppers_star_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'لمن نعمل', 'toppers' ); ?></span></div>
					<h2><?php esc_html_e( 'من هم المستفيدون من خدماتنا؟', 'toppers' ); ?></h2>
				</div>
				<div class="grid grid-4">
					<?php
					$audiences = array(
						array( 'fa-graduation-cap', 'طلبة الدراسات العليا', 'نرافقكم خطوة بخطوة؛ من اختيار العناوين والخطط البحثية، مرورًا بالإطار النظري والتحليل الإحصائي، وحتى التعديلات والمناقشة النهائية.' ),
						array( 'fa-chalkboard-user', 'أعضاء هيئة التدريس', 'ندعم مسيرتكم الأكاديمية والترقية العلمية عبر إعداد ونشر الأبحاث في المجلات العلمية المحكمة (Scopus وISI).' ),
						array( 'fa-building-columns', 'طلاب البكالوريوس', 'نُساندكم في خطواتكم الأولى؛ من صياغة فكرة مشروع التخرج، إلى جمع المصادر والتحليل الإحصائي وتنسيق البحث.' ),
						array( 'fa-chart-column', 'المؤسسات والمراكز البحثية', 'نوفر الاستشارات الإحصائية وبناء أدوات الدراسة وتحليل البيانات الضخمة لدعم القرارات والدراسات المؤسسية.' ),
					);
					foreach ( $audiences as $card ) {
						echo '<div class="audience-card"><h3><i class="fa-solid ' . esc_attr( $card[0] ) . '" aria-hidden="true"></i> ' . esc_html( $card[1] ) . '</h3><p>' . esc_html( $card[2] ) . '</p></div>';
					}
					?>
				</div>
			</div>
		</section>

		<section class="scope-sec">
			<div class="container scope-inner">
				<div class="eyebrow"><?php echo toppers_star_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'نطاق العمل', 'toppers' ); ?></span></div>
				<h2><?php esc_html_e( 'النطاق الجغرافي لخدماتنا', 'toppers' ); ?></h2>
				<p><?php esc_html_e( 'تتوسع خدماتنا الاستشارية والبحثية المتقدمة لتغطي كافة مناطق المملكة العربية السعودية، مع دراية عميقة بدليل كتابة الرسائل والشروط التنظيمية لكافة الجامعات السعودية، ويمتد نطاق عملنا ليشمل كافة دول مجلس التعاون الخليجي (الإمارات، الكويت، قطر، سلطنة عمان، والبحرين) والوطن العربي، وصولًا إلى تقديم الدعم المنهجي للطلاب المبتعثين في الجامعات العالمية وفق أرفع المعايير الأكاديمية الدولية.', 'toppers' ); ?></p>
			</div>
		</section>

		<section class="why-sec">
			<div class="container">
				<div class="section-head center">
					<h2><?php esc_html_e( 'لماذا تختار "توبرز"؟ (ضمانات التميز والأمان)', 'toppers' ); ?></h2>
				</div>
				<div class="why-panel">
					<?php
					$why = array(
						array( 'fa-shield-halved', 'النزاهة والذكاء الأكاديمي:', 'التزام بأعلى معايير الرصانة العلمية، وضمان خلو الأعمال من السرقة العلمية أو الذكاء الاصطناعي' ),
						array( 'fa-lock', 'السرية الحصينة للملكية الفكرية:', 'بياناتك وأفكارك ومخرجاتك في أمان تام بموجب بروتوكولات حماية صارمة' ),
						array( 'fa-graduation-cap', 'التخصص الدقيق:', 'يتولى دراستك مختص في نفس مجالك العلمي الدقيق لضمان الفهم الكامل لمتطلباتك' ),
						array( 'fa-stopwatch', 'الانضباط الصارم بالمواعيد:', 'نسلمك عملك في الموعد المتفق عليه تمامًا دون أي تأخير' ),
						array( 'fa-magnifying-glass', 'ضبط الجودة المزدوج:', 'لا يُسلَّم أي عمل دون مراجعة وتدقيق لغوي ومنهجي دقيق' ),
					);
					foreach ( $why as $row ) {
						echo '<div class="feature-row"><div class="feature-ic"><i class="fa-solid ' . esc_attr( $row[0] ) . '" aria-hidden="true"></i></div><div><h3>' . esc_html( $row[1] ) . '</h3><p>' . esc_html( $row[2] ) . '</p></div></div>';
					}
					?>
				</div>
			</div>
		</section>

		<section class="team-sec">
			<div class="container team-inner">
				<div class="eyebrow"><?php echo toppers_star_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'فريق العمل', 'toppers' ); ?></span></div>
				<h2><?php esc_html_e( 'نخبة من الأكاديميين والمتخصصين', 'toppers' ); ?></h2>
				<p><?php esc_html_e( 'يُدار عملك في "توبرز" بإشراف مباشر من نخبة من الباحثين والمحللين الإحصائيين والمحكمين اللغويين المعتمدين، مدعومين بفريق إداري وتقني يعمل على مدار الساعة لضمان دقة التنفيذ وسلاسة التجربة.', 'toppers' ); ?></p>
				<a href="<?php echo esc_url( toppers_page_url( 'team' ) ); ?>" class="inline-link"><?php esc_html_e( 'تعرّف على فريقنا الأكاديمي والمنظومة بالكامل', 'toppers' ); ?> <span class="arrow"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i></span></a>
			</div>
		</section>

		<section class="process-sec">
			<div class="container">
				<div class="process-intro">
					<div class="eyebrow"><?php echo toppers_star_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'منهجية العمل', 'toppers' ); ?></span></div>
					<h2><?php esc_html_e( 'كيف نُدير مشروعك الأكاديمي؟', 'toppers' ); ?></h2>
					<p><?php esc_html_e( 'نتبع في "توبرز" منظومة عمل متسلسلة تبدأ من فهم متطلباتك، مرورًا بالبناء المنهجي والتدقيق، وصولًا إلى فحص الأصالة وتسليمك تقارير Turnitin المعتمدة، مع استمرار الدعم حتى اعتماد بحثك بالكامل.', 'toppers' ); ?></p>
				</div>
				<?php
				$phases = array(
					array( 'استقبال الطلب ودراسة المتطلبات', array( 'استقبال بيانات بحثك وتوجيهات مشرفك عبر الموقع أو الواتساب', 'مراجعة دليل كتابة الرسائل والشروط الخاصة بجامعتك', 'دراسة أي ملاحظات أو قرارات رفض سابقة', 'الاتفاق المباشر على نطاق الخدمة والتفاصيل المطلوبة' ) ),
					array( 'التخطيط الأكاديمي ورسم الخريطة', array( 'صياغة هيكل عام ومظلة منهجية للبحث قبل التفاصيل', 'اعتماد جدول زمني مرن لتسليم الفصول تباعًا', 'الاتفاق على وسيلة التواصل اليومية', 'وضع خطة استباقية تتجنب الملاحظات الجوهرية المتوقعة' ) ),
					array( 'الإعداد العلمي الصارم والصياغة', array( 'إسناد كل جزء للمتخصص الدقيق (نظري أو إحصائي)', 'إرسال المخرجات مقسمة على مراحل لمناقشتها مع مشرفك', 'التعامل الفوري مع أي تعديلات يطلبها المشرف', 'الحفاظ على انسجام البحث بين المقدمة والنتائج والتوصيات' ) ),
					array( 'المراجعة الشاملة وفحص الأصالة', array( 'تدقيق لغوي ونحوي شامل يضمن السلاسة والرصانة العلمية', 'مراجعة ضبط الهوامش وتوثيق المراجع حسب النظام المعتمد', 'فحص النص بأحدث برامج كشف الاقتباس والذكاء الاصطناعي', 'إرفاق تقارير الفحص المعتمدة (Turnitin / AI Detector) مجانًا' ) ),
					array( 'التسليم النهائي ودعم المناقشة', array( 'تسليم الملفات بصيغ Word وPDF مرفقة بتقارير الأصالة', 'جلسة استشارية Online مع الباحث المختص لشرح المنهجية والنتائج', 'التزام تام بتطبيق ملاحظات المشرف حتى الاعتماد النهائي', 'حفظ كافة بياناتك بأعلى معايير السرية والأمان' ) ),
				);
				echo '<div class="phase-list">';
				$last = count( $phases ) - 1;
				foreach ( $phases as $i => $phase ) {
					echo '<div class="phase-item"><div class="phase-num-col"><div class="phase-num">' . esc_html( $i + 1 ) . '</div>';
					if ( $i !== $last ) {
						echo '<div class="phase-line"></div>';
					}
					echo '</div><div class="phase-card"><h3>' . esc_html( $phase[0] ) . '</h3><ul>';
					foreach ( $phase[1] as $li ) {
						echo '<li>' . esc_html( $li ) . '</li>';
					}
					echo '</ul></div></div>';
				}
				echo '</div>';
				?>
			</div>
		</section>

		<section class="guarantee-sec">
			<div class="container">
				<div class="section-head center">
					<div class="eyebrow"><?php echo toppers_star_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'ضماناتنا', 'toppers' ); ?></span></div>
					<h2><?php esc_html_e( 'ضماناتنا — حقوقك محفوظة.. ضمانات حقيقية لا مجرد وعود', 'toppers' ); ?></h2>
				</div>
				<div class="grid grid-2">
					<?php
					$gs = array(
						array( 'fa-file-lines', 'اتفاقية عدم الإفصاح والسرية (NDA)', 'التزام قانوني حازم بحماية فكرتك وبياناتك وعدم إعادة استخدام العمل مستقبلًا' ),
						array( 'fa-credit-card', 'سياسة استرداد الأموال', 'ضمان مالي واضح يُعوض الباحث في حال عدم الالتزام بالمتطلبات المعتمدة أو التأخر غير المبرر' ),
						array( 'fa-scroll', 'شهادات فحص رسمية معتمدة', 'تسليم تقارير الأصالة Turnitin المطبوعة رسميًا كإثبات موثق لخلو العمل من الانتحال' ),
						array( 'fa-graduation-cap', 'ضمان المطابقة والأمانة العلمية', 'تطابق العمل بنسبة 100% مع دليل الجامعة والمراجعة الأكاديمية المجانية' ),
					);
					foreach ( $gs as $g ) {
						echo '<div class="guarantee-card"><span class="g-ic"><i class="fa-solid ' . esc_attr( $g[0] ) . '" aria-hidden="true"></i></span><h3>' . esc_html( $g[1] ) . '</h3><p>' . esc_html( $g[2] ) . '</p></div>';
					}
					?>
				</div>
				<div class="guarantee-link-wrap">
					<a href="<?php echo esc_url( toppers_page_url( 'guarantees' ) ); ?>" class="inline-link"><?php esc_html_e( 'الاطلاع على الشروط والأحكام وسياسة الضمان الشاملة', 'toppers' ); ?> <span class="arrow"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i></span></a>
				</div>
			</div>
		</section>

		<section class="teaser-sec">
			<div class="container teaser-inner">
				<div class="eyebrow"><?php echo toppers_star_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'آراء طلابنا', 'toppers' ); ?></span></div>
				<h2><?php esc_html_e( 'آراء نعتز بها', 'toppers' ); ?></h2>
				<p><?php esc_html_e( 'على مدار أكثر من 10 سنوات من العطاء الأكاديمي، كانت ثقة باحثينا هي المعيار الحقيقي لتميزنا. نضع بين يديك تجارب حقيقية وواقعية لطلاب الماجستير والدكتوراه؛ تشمل رسائل صوتية واقتباسات لمحادثات فعلية تُجسّد رحلتهم معنا بكل شفافية.', 'toppers' ); ?></p>
				<a href="<?php echo esc_url( toppers_page_url( 'testimonials' ) ); ?>" class="inline-link"><?php esc_html_e( 'اضغط هنا لمطالعة كافة آراء وتجارب العملاء', 'toppers' ); ?> <span class="arrow"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i></span></a>
			</div>
		</section>

		<section class="integrity-sec">
			<div class="container integrity-inner">
				<div class="eyebrow"><?php echo toppers_star_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'التزامنا الأخلاقي', 'toppers' ); ?></span></div>
				<h2><?php esc_html_e( 'التزامنا بالنزاهة والمسؤولية الأكاديمية', 'toppers' ); ?></h2>
				<p><?php esc_html_e( 'تُقدّم شركة "توبرز" للاستشارات والحلول البحثية دعمًا استشاريًا وإرشاديًا مشروعًا يُساعد الباحث على تطوير عمله العلمي وفهم منهجية البحث بشكل أعمق، وتُعد خدماتنا رافدًا تعليميًا مساندًا وليست بديلًا عن الجهد الشخصي للباحث. كما نلتزم بالسرية التامة لجميع البيانات والأبحاث، ولا نعرض أعمال زبائننا كـ"نماذج" مطلقًا حمايةً لخصوصيتهم وأمانة أبحاثهم.', 'toppers' ); ?></p>
				<p><?php esc_html_e( 'وتجدر الإشارة إلى أن قبول الرسالة العلمية أو اعتمادها النهائي يبقى قرارًا حصريًا يعود للمشرف الأكاديمي ولجنة المناقشة، ولا تملك أي جهة استشارية حق ضمان هذا القرار. ما تلتزم به "توبرز" هو تقديم أعلى مستوى ممكن من الدعم المنهجي والعلمي الذي يرفع من جودة البحث وفرص نجاحه.', 'toppers' ); ?></p>
				<div class="integrity-link-wrap">
					<a href="<?php echo esc_url( toppers_page_url( 'terms' ) ); ?>" class="inline-link"><?php esc_html_e( 'اقرأ المزيد عن سياستنا وشروط الخدمة', 'toppers' ); ?> <span class="arrow"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i></span></a>
				</div>
			</div>
		</section>

		<div class="trust-strip">
			<div class="container">
				<div class="trust-strip-item"><span class="t-ic"><i class="fa-solid fa-lock" aria-hidden="true"></i></span> <?php esc_html_e( '100% سرية تامة لبياناتك وأبحاثك', 'toppers' ); ?></div>
				<div class="trust-strip-item"><span class="t-ic"><i class="fa-solid fa-bolt" aria-hidden="true"></i></span> <?php esc_html_e( 'استجابة ورَد سريع خلال دقائق عبر الواتساب', 'toppers' ); ?></div>
				<div class="trust-strip-item"><span class="t-ic"><i class="fa-solid fa-file-lines" aria-hidden="true"></i></span> <?php esc_html_e( 'تقارير أصالة واقتباس (Turnitin) مجانية مع كل عمل', 'toppers' ); ?></div>
			</div>
		</div>

		<section class="about-gallery-sec">
			<div class="container">
				<div class="section-head center">
					<div class="eyebrow"><?php echo toppers_star_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'بيئة العمل', 'toppers' ); ?></span></div>
					<h2><?php esc_html_e( 'التفوق ينبع من بيئة محفزة', 'toppers' ); ?></h2>
					<p><?php esc_html_e( 'نعمل كفريق متناغم يتبادل الخبرات للوصول لأفضل النتائج.', 'toppers' ); ?></p>
				</div>
				<div class="about-gallery">
					<div class="large-img">
						<img src="<?php echo esc_url( toppers_content_img( 'about_gallery_1', toppers_photo( 'team' ) ) ); ?>" alt="<?php esc_attr_e( 'فريق توبرز', 'toppers' ); ?>">
					</div>
					<div class="wide-img">
						<img src="<?php echo esc_url( toppers_content_img( 'about_gallery_2', toppers_photo( 'office' ) ) ); ?>" alt="<?php esc_attr_e( 'مكتب توبرز', 'toppers' ); ?>">
					</div>
					<div>
						<img src="<?php echo esc_url( toppers_content_img( 'about_gallery_3', toppers_photo( 'masters' ) ) ); ?>" alt="<?php esc_attr_e( 'بحث علمي', 'toppers' ); ?>">
					</div>
					<div>
						<img src="<?php echo esc_url( toppers_content_img( 'about_gallery_4', toppers_photo( 'meeting' ) ) ); ?>" alt="<?php esc_attr_e( 'دراسات', 'toppers' ); ?>">
					</div>
				</div>
			</div>
		</section>

		<section class="section">
			<div class="container">
				<div class="cta-band">
					<h2><?php esc_html_e( 'جاهز تبدأ رحلتك الأكاديمية مع توبرز؟', 'toppers' ); ?></h2>
					<p><?php esc_html_e( 'اطلب خدمتك الآن أو تواصل معنا عبر الواتساب لنبدأ معك من أول خطوة.', 'toppers' ); ?></p>
					<div class="cta-actions">
						<a class="btn btn-gold" href="<?php echo esc_url( toppers_page_url( 'contact' ) ); ?>"><?php esc_html_e( 'اطلب الخدمة الآن', 'toppers' ); ?></a>
						<a class="btn btn-outline" href="<?php echo esc_url( toppers_whatsapp_url() ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'تواصل معنا عبر الواتساب', 'toppers' ); ?></a>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>
</main>
<?php
get_footer();
