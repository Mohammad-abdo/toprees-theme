<?php
/**
 * Theme footer.
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
	get_template_part( 'template-parts/footer/site', 'footer' );
}

get_template_part( 'template-parts/components/wa', 'float' );

wp_footer();
?>
</body>
</html>
