<?php
/**
 * Theme images — import into Media Library so Elementor can use them.
 *
 * @package Tek_Craft_Toppres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Absolute path to theme images directory.
 *
 * @return string
 */
function tk_theme_images_dir() {
	return TK_THEME_DIR . '/assets/images';
}

/**
 * List image files shipped with the theme.
 *
 * @return array<string,string> basename => absolute path
 */
function tk_get_theme_image_files() {
	$dir = tk_theme_images_dir();
	if ( ! is_dir( $dir ) ) {
		return array();
	}

	$files  = array();
	$allowed = array( 'jpg', 'jpeg', 'png', 'gif', 'webp', 'svg' );
	foreach ( glob( trailingslashit( $dir ) . '*' ) as $path ) {
		if ( ! is_file( $path ) ) {
			continue;
		}
		$ext = strtolower( pathinfo( $path, PATHINFO_EXTENSION ) );
		if ( in_array( $ext, $allowed, true ) ) {
			$files[ basename( $path ) ] = $path;
		}
	}
	return $files;
}

/**
 * Get attachment ID for a theme image basename (imported or existing).
 *
 * @param string $basename File name e.g. logo.png.
 * @return int
 */
function tk_get_theme_image_id( $basename ) {
	$map = get_option( 'tk_theme_image_map', array() );
	if ( ! empty( $map[ $basename ] ) ) {
		$id = (int) $map[ $basename ];
		if ( $id && wp_attachment_is_image( $id ) ) {
			return $id;
		}
	}

	// Search media by filename.
	$attachments = get_posts(
		array(
			'post_type'      => 'attachment',
			'post_status'    => 'inherit',
			'posts_per_page' => 1,
			'meta_query'     => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
				array(
					'key'   => '_tk_theme_image',
					'value' => $basename,
				),
			),
		)
	);

	if ( $attachments ) {
		return (int) $attachments[0]->ID;
	}

	return 0;
}

/**
 * Import all theme images into the Media Library.
 *
 * @return array Imported map basename => attachment ID.
 */
function tk_import_theme_images() {
	if ( ! function_exists( 'media_handle_sideload' ) ) {
		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/media.php';
		require_once ABSPATH . 'wp-admin/includes/image.php';
	}

	$map   = get_option( 'tk_theme_image_map', array() );
	$files = tk_get_theme_image_files();

	foreach ( $files as $basename => $path ) {
		$existing = tk_get_theme_image_id( $basename );
		if ( $existing ) {
			$map[ $basename ] = $existing;
			continue;
		}

		$tmp = wp_tempnam( $basename );
		if ( ! $tmp ) {
			continue;
		}
		copy( $path, $tmp );

		$file_array = array(
			'name'     => $basename,
			'tmp_name' => $tmp,
		);

		$id = media_handle_sideload( $file_array, 0, null );
		if ( is_wp_error( $id ) ) {
			@unlink( $tmp ); // phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged
			continue;
		}

		update_post_meta( $id, '_tk_theme_image', $basename );
		$map[ $basename ] = (int) $id;
	}

	update_option( 'tk_theme_image_map', $map );
	return $map;
}

/**
 * Auto-import on theme activation.
 */
function tk_import_theme_images_on_switch() {
	tk_import_theme_images();
}
add_action( 'after_switch_theme', 'tk_import_theme_images_on_switch' );

/**
 * Appearance → Theme Images admin screen.
 */
function tk_theme_images_admin_menu() {
	add_theme_page(
		__( 'Theme Images', 'tek-craft-toppres' ),
		__( 'Theme Images', 'tek-craft-toppres' ),
		'upload_files',
		'tk-theme-images',
		'tk_theme_images_admin_page'
	);
}
add_action( 'admin_menu', 'tk_theme_images_admin_menu' );

/**
 * Admin page callback.
 */
function tk_theme_images_admin_page() {
	if ( ! current_user_can( 'upload_files' ) ) {
		return;
	}

	if ( isset( $_POST['tk_import_images'] ) && check_admin_referer( 'tk_import_images' ) ) {
		$map = tk_import_theme_images();
		echo '<div class="notice notice-success"><p>' . esc_html(
			sprintf(
				/* translators: %d: number of images */
				__( 'Imported / linked %d theme image(s) into the Media Library. You can now use them in Elementor.', 'tek-craft-toppres' ),
				count( $map )
			)
		) . '</p></div>';
	}

	$files = tk_get_theme_image_files();
	$map   = get_option( 'tk_theme_image_map', array() );
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Tek-Craft Toppres — Theme Images', 'tek-craft-toppres' ); ?></h1>
		<p><?php esc_html_e( 'These images ship with the theme. Import them into the Media Library so you can pick and replace them in Elementor Image widgets and theme widgets.', 'tek-craft-toppres' ); ?></p>

		<form method="post">
			<?php wp_nonce_field( 'tk_import_images' ); ?>
			<p>
				<button type="submit" name="tk_import_images" class="button button-primary">
					<?php esc_html_e( 'Import theme images to Media Library', 'tek-craft-toppres' ); ?>
				</button>
			</p>
		</form>

		<table class="widefat striped" style="max-width:900px;margin-top:20px">
			<thead>
				<tr>
					<th><?php esc_html_e( 'Preview', 'tek-craft-toppres' ); ?></th>
					<th><?php esc_html_e( 'File', 'tek-craft-toppres' ); ?></th>
					<th><?php esc_html_e( 'Media Library', 'tek-craft-toppres' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php if ( empty( $files ) ) : ?>
					<tr><td colspan="3"><?php esc_html_e( 'No images found in assets/images/.', 'tek-craft-toppres' ); ?></td></tr>
				<?php else : ?>
					<?php foreach ( $files as $basename => $path ) : ?>
						<?php
						$id  = ! empty( $map[ $basename ] ) ? (int) $map[ $basename ] : tk_get_theme_image_id( $basename );
						$url = TK_THEME_URI . '/assets/images/' . rawurlencode( $basename );
						?>
						<tr>
							<td><img src="<?php echo esc_url( $url ); ?>" alt="" style="max-height:48px;width:auto"></td>
							<td><code><?php echo esc_html( $basename ); ?></code></td>
							<td>
								<?php if ( $id ) : ?>
									<a href="<?php echo esc_url( get_edit_post_link( $id ) ); ?>"><?php esc_html_e( 'Open in Media', 'tek-craft-toppres' ); ?></a>
									(#<?php echo esc_html( (string) $id ); ?>)
								<?php else : ?>
									<em><?php esc_html_e( 'Not imported yet', 'tek-craft-toppres' ); ?></em>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>

		<hr>
		<h2><?php esc_html_e( 'Edit content in Elementor', 'tek-craft-toppres' ); ?></h2>
		<ol>
			<li><?php esc_html_e( 'Open Pages → your Front Page (or any page).', 'tek-craft-toppres' ); ?></li>
			<li><?php esc_html_e( 'Click Edit with Elementor.', 'tek-craft-toppres' ); ?></li>
			<li><?php esc_html_e( 'In the widget panel find the “Tek-Craft Toppres” category — Hero, Journey, Services, Why Us, Testimonials, CTA.', 'tek-craft-toppres' ); ?></li>
			<li><?php esc_html_e( 'Every image has a Media control: click it to replace from the Media Library.', 'tek-craft-toppres' ); ?></li>
			<li><?php esc_html_e( 'Every text field can be edited in the widget sidebar (and translated with your translation plugin).', 'tek-craft-toppres' ); ?></li>
		</ol>
	</div>
	<?php
}
