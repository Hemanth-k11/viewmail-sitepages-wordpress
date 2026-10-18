<?php
/**
 * Viewmail Sitepages: child theme of Hello Elementor.
 *
 * @package Viewmail
 */

defined( 'ABSPATH' ) || exit;

define( 'VIEWMAIL_VERSION', '1.0.0' );
define( 'VIEWMAIL_DIR', get_stylesheet_directory() );
define( 'VIEWMAIL_URI', get_stylesheet_directory_uri() );

require VIEWMAIL_DIR . '/inc/demo-list.php';
require VIEWMAIL_DIR . '/inc/elementor-helpers.php';
require VIEWMAIL_DIR . '/inc/pages.php';
require VIEWMAIL_DIR . '/inc/image-seo.php';
require VIEWMAIL_DIR . '/inc/services-page.php';
require VIEWMAIL_DIR . '/inc/seo.php';
require VIEWMAIL_DIR . '/inc/setup.php';
require VIEWMAIL_DIR . '/inc/admin-setup.php';
require VIEWMAIL_DIR . '/inc/customizer.php';
require VIEWMAIL_DIR . '/inc/widgets/loader.php';

function viewmail_elementor_active() {
	return defined( 'ELEMENTOR_VERSION' ) && class_exists( '\Elementor\Plugin' );
}

function viewmail_hfe_active() {
	return defined( 'HFE_VER' );
}

/** Styles and scripts. */
function viewmail_assets() {
	wp_enqueue_style( 'viewmail', VIEWMAIL_URI . '/assets/css/site.css', array(), VIEWMAIL_VERSION );
	wp_register_style( 'choices', VIEWMAIL_URI . '/assets/vendor/choices.min.css', array(), '11.2.4' );
	wp_register_script( 'choices', VIEWMAIL_URI . '/assets/vendor/choices.min.js', array(), '11.2.4', true );
	wp_enqueue_script( 'viewmail', VIEWMAIL_URI . '/assets/js/site.js', array( 'jquery' ), VIEWMAIL_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'viewmail_assets', 20 );

/** Site icon fallback: the logo from the old site. */
function viewmail_fallback_icon() {
	if ( has_site_icon() ) {
		return;
	}
	echo '<link rel="icon" href="' . esc_url( VIEWMAIL_URI . '/assets/images/logo.jpg' ) . '" type="image/jpeg">' . "\n";
}
add_action( 'wp_head', 'viewmail_fallback_icon' );

/** Basic search description for the home page when no SEO plugin is active. */
function viewmail_meta_description() {
	if ( ! is_front_page() || viewmail_seo_plugin_active() || viewmail_seo_page() ) {
		return;
	}
	$text = get_theme_mod( 'viewmail_meta_description', 'Affordable cPanel hosting and domain registration in India. Specializing in .in, Nixi, and .bharat IDN domains. Secure, fast servers with 24/7 local support.' );
	if ( $text ) {
		echo '<meta name="description" content="' . esc_attr( $text ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'viewmail_meta_description', 1 );

/** Floating WhatsApp button (Appearance > Customize > WhatsApp button). */
function viewmail_whatsapp_button() {
	if ( ! get_theme_mod( 'viewmail_wa_show', true ) ) {
		return;
	}
	$number = preg_replace( '/\D+/', '', (string) get_theme_mod( 'viewmail_wa_number', '919966222314' ) );
	if ( ! $number ) {
		return;
	}
	$label = get_theme_mod( 'viewmail_wa_label', 'Need help? Chat now!' );
	?>
	<div class="vm-wa">
		<?php if ( $label ) : ?>
			<div class="vm-wa__label"><?php echo esc_html( $label ); ?></div>
		<?php endif; ?>
		<a class="vm-wa__button" href="<?php echo esc_url( 'https://wa.me/' . $number ); ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e( 'Chat on WhatsApp', 'viewmail' ); ?>">
			<svg viewBox="0 0 448 512" aria-hidden="true"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-5.5-2.8-23.2-8.5-44.2-27.1-16.4-14.6-27.4-32.7-30.6-38.2-3.2-5.6-.3-8.6 2.5-11.3 2.5-2.5 5.5-6.5 8.3-9.7 2.8-3.3 3.7-5.6 5.6-9.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 13.2 5.8 23.5 9.2 31.5 11.8 13.3 4.2 25.4 3.6 35 2.2 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
		</a>
	</div>
	<?php
}
add_action( 'wp_footer', 'viewmail_whatsapp_button' );
