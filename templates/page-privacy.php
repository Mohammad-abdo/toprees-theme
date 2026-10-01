<?php
/**
 * Template Name: سياسة الخصوصية
 *
 * @package Toppers
 */

get_header();

$email = toppers_email() ?: 'info@toppers-edu.com';

$blocks = array(
	array(
		'مقدمة',
		array(
			'تلتزم شركة توبرز للاستشارات والحلول البحثية بحماية خصوصية عملائها وزوار موقعها الإلكتروني، وفق نظام حماية البيانات الشخصية السعودي (PDPL) الصادر بالمرسوم الملكي رقم (م/19). توضح هذه السياسة كيفية جمعنا لبياناتك ومعالجتها وحمايتها عند استخدامك لموقعنا أو خدماتنا، ولا نشارك بياناتك إلا وفق ما توضحه هذه السياسة.',
		),
		array(),
	),
	array(
		'البيانات التي نجمعها',
		array(),
		array(
			'البيانات الشخصية: الاسم، رقم التواصل (واتساب)، البريد الإلكتروني.',
			'الاحتياجات الأكاديمية التي يزوّدنا بها العميل عند طلب الخدمة (تفاصيل البحث، دليل الجامعة، متطلبات المشرف).',
			'بيانات تقنية محدودة عند تصفح الموقع، مثل عنوان IP، نوع المتصفح، مزوّد خدمة الإنترنت، وتاريخ ووقت الزيارة، لأغراض تحليل حركة الزوار وتحسين أداء الموقع.',
		),
	),
	array(
		'الغرض من جمع البيانات',
		array(
			'تُستخدم البيانات المُجمَّعة حصرًا للأغراض التالية: تنفيذ الخدمة المطلوبة والتواصل بشأنها، تحسين جودة خدماتنا وتجربة المستخدم على الموقع، والرد على استفسارات العملاء. لا تُستخدم بياناتك لأي غرض آخر دون الحصول على موافقتك الصريحة.',
		),
		array(),
	),
	array(
		'كيفية استخدام وحماية البيانات',
		array(
			'نلتزم باستخدام أنظمة وتقنيات آمنة لحماية بيانات العملاء من الوصول غير المصرح به. تُعامل جميع بيانات العملاء بسرية تامة، ولا تتم مشاركتها مع أي طرف ثالث لأغراض تسويقية أو تجارية إلا بموافقة كتابية صريحة من العميل، أو إذا تطلب القانون ذلك. يُتاح الاطلاع على بيانات العميل وتفاصيل مشروعه فقط للمتخصص المسؤول عن تنفيذ الخدمة، وبالقدر اللازم لإنجاز العمل.',
		),
		array(),
	),
	array(
		'حقوقك تجاه بياناتك',
		array(
			'وفقًا لنظام حماية البيانات الشخصية السعودي، يحق لك:',
		),
		array(
			'الاطلاع على بياناتك الشخصية المحفوظة لدينا.',
			'طلب تصحيح أي بيانات غير دقيقة.',
			'طلب حذف بياناتك أو إتلافها بعد انتهاء الغرض من معالجتها.',
			'سحب موافقتك على معالجة بياناتك في أي وقت.',
		),
	),
	array(
		'سياسة ملفات تعريف الارتباط (Cookies)',
		array(
			'قد يستخدم موقعنا ملفات تعريف الارتباط لتحسين تجربة التصفح وتحليل حركة الزوار. يمكنك ضبط إعدادات متصفحك لرفض هذه الملفات، مع العلم أن ذلك قد يؤثر على بعض وظائف الموقع.',
		),
		array(),
	),
	array(
		'مدة الاحتفاظ بالبيانات',
		array(
			'تحتفظ توبرز ببيانات العميل للمدة اللازمة لتنفيذ الخدمة المطلوبة ولأغراض المتابعة اللاحقة، ثم يتم إتلافها أو حذفها وفق الضوابط النظامية، ما لم يطلب العميل خلاف ذلك أو يستلزم النظام مدة احتفاظ أطول.',
		),
		array(),
	),
	array(
		'التعديلات على هذه السياسة',
		array(
			'قد تُحدَّث سياسة الخصوصية هذه من وقت لآخر بما يتماشى مع أي تطورات قانونية أو تقنية. سيتم نشر أي تعديل على هذه الصفحة، ويُعد استمرارك في استخدام الموقع بعد نشر التعديل موافقة ضمنية عليه.',
		),
		array(),
	),
	array(
		'التواصل بخصوص الخصوصية',
		array(
			'لأي استفسار أو طلب متعلق ببياناتك الشخصية، أو لتقديم شكوى بخصوص كيفية معالجة بياناتك، يمكنك التواصل معنا عبر البريد الإلكتروني ' . $email . ' أو عبر الواتساب.',
		),
		array(),
	),
);
?>
<main class="site-main">
	<?php
	get_template_part(
		'template-parts/page-hero',
		null,
		toppers_hero_args(
			'privacy',
			array(
				'title'   => __( 'سياسة الخصوصية', 'toppers' ),
				'eyebrow' => __( 'توبرز للاستشارات والحلول البحثية', 'toppers' ),
				'crumb'   => __( 'سياسة الخصوصية', 'toppers' ),
				'lede'    => __( 'تلتزم شركة توبرز للاستشارات والحلول البحثية بحماية خصوصية عملائها وزوار موقعها الإلكتروني، وفق نظام حماية البيانات الشخصية السعودي (PDPL) وسرية أبحاثك التامة.', 'toppers' ),
				'image'   => toppers_img( 'campus.jpg' ),
				'center'  => true,
				'orbs'    => true,
			)
		)
	);
	?>

	<section class="section privacy-page-sec">
		<div class="container" style="max-width: 860px;">
			<div class="legal-stack" style="display: flex; flex-direction: column; gap: 24px;">
				<?php
				$n = 0;
				foreach ( $blocks as $block ) :
					++$n;
					?>
					<div class="legal-card">
						<div class="legal-card-head" style="display: flex; align-items: center; gap: 14px; margin-bottom: 16px;">
							<span class="legal-card-num" style="display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 8px; background: rgba(201,154,59,0.15); color: var(--gold); font-weight: 700; font-size: 15px;"><?php echo esc_html( str_pad( (string) $n, 2, '0', STR_PAD_LEFT ) ); ?></span>
							<h3 style="margin: 0; font-size: 20px;"><?php echo esc_html( $block[0] ); ?></h3>
						</div>
						<?php foreach ( $block[1] as $p ) : ?>
							<p style="line-height: 1.8; color: var(--ink-soft);"><?php echo esc_html( $p ); ?></p>
						<?php endforeach; ?>
						<?php if ( ! empty( $block[2] ) ) : ?>
							<ul style="padding-right: 20px; margin: 12px 0 0; line-height: 1.8; color: var(--ink-soft);">
								<?php foreach ( $block[2] as $li ) : ?>
									<li style="margin-bottom: 8px;"><?php echo esc_html( $li ); ?></li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<div class="cta-band">
				<h2><?php esc_html_e( 'لأي استفسار حول خصوصية بياناتك', 'toppers' ); ?></h2>
				<p><?php esc_html_e( 'تواصل مع مسؤولي حماية البيانات لدينا مباشرة وسنجيبك بكل وضوح.', 'toppers' ); ?></p>
				<div class="cta-actions">
					<a class="btn btn-gold" href="<?php echo esc_url( toppers_page_url( 'contact' ) ); ?>"><?php esc_html_e( 'تواصل معنا', 'toppers' ); ?></a>
					<a class="btn btn-whatsapp" href="<?php echo esc_url( toppers_whatsapp_url() ); ?>" target="_blank" rel="noopener">
						<i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
						<?php esc_html_e( 'تواصل عبر الواتساب', 'toppers' ); ?>
					</a>
				</div>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
