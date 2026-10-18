<?php
/**
 * Appearance > Viewmail Setup.
 *
 * @package Viewmail
 */

defined( 'ABSPATH' ) || exit;

function viewmail_setup_menu_page() {
	add_theme_page(
		__( 'Viewmail Setup', 'viewmail' ),
		__( 'Viewmail Setup', 'viewmail' ),
		'edit_theme_options',
		'viewmail-setup',
		'viewmail_setup_page'
	);
}
add_action( 'admin_menu', 'viewmail_setup_menu_page' );

function viewmail_setup_page() {
	$done   = isset( $_GET['done'] ) ? sanitize_key( wp_unslash( $_GET['done'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$errors = get_transient( 'viewmail_setup_errors' );
	delete_transient( 'viewmail_setup_errors' );
	$ready = viewmail_elementor_active() && viewmail_hfe_active();
	$built = (bool) get_option( 'viewmail_setup_done' );
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Viewmail Setup', 'viewmail' ); ?></h1>

		<?php if ( $errors ) : ?>
			<div class="notice notice-error"><p><?php echo implode( '<br>', array_map( 'esc_html', (array) $errors ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p></div>
		<?php elseif ( $done ) : ?>
			<div class="notice notice-success is-dismissible"><p><?php echo 'rebuild' === $done ? esc_html__( 'The Viewmail pages were rebuilt with the original designs.', 'viewmail' ) : esc_html__( 'Your site is ready. Open any page and click "Edit with Elementor" to change it.', 'viewmail' ); ?></p></div>
		<?php endif; ?>

		<p style="max-width:760px"><?php esc_html_e( 'This theme builds viewmail.sitepages.in with Elementor, like rnembedded.com: Hello Elementor theme, Elementor page builder and Elementor Header & Footer Builder. Everything is edited by drag and drop.', 'viewmail' ); ?></p>

		<h2><?php esc_html_e( '1. Plugins', 'viewmail' ); ?></h2>
		<table class="widefat striped" style="max-width:760px">
			<tbody>
			<?php
			foreach ( viewmail_required_plugins() as $slug => $plugin ) :
				$state  = viewmail_plugin_state( $slug );
				$labels = array(
					'active'    => __( 'Active', 'viewmail' ),
					'installed' => __( 'Installed, not active', 'viewmail' ),
					'missing'   => __( 'Not installed', 'viewmail' ),
				);
				?>
				<tr>
					<td><strong><?php echo esc_html( $plugin['name'] ); ?></strong></td>
					<td><?php echo 'active' === $state ? '<span style="color:#008a20">&#10003; ' . esc_html( $labels[ $state ] ) . '</span>' : esc_html( $labels[ $state ] ); ?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>

		<h2><?php esc_html_e( '2. Build the site', 'viewmail' ); ?></h2>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<?php wp_nonce_field( 'viewmail_setup' ); ?>
			<input type="hidden" name="action" value="viewmail_setup">
			<?php if ( ! $built || ! $ready ) : ?>
				<p><?php esc_html_e( 'One click installs the plugins, adds the pictures to the Media Library and creates the Home, Services and Gallery pages, the menu, the header and the footer.', 'viewmail' ); ?></p>
				<button class="button button-primary button-hero" name="do" value="build"><?php esc_html_e( 'Install plugins and build the site', 'viewmail' ); ?></button>
			<?php else : ?>
				<p><?php esc_html_e( 'The site is built. Pages you changed are kept when you click "Check setup".', 'viewmail' ); ?></p>
				<button class="button" name="do" value="build"><?php esc_html_e( 'Check setup (add anything missing)', 'viewmail' ); ?></button>
				<button class="button" name="do" value="rebuild" onclick="return confirm('<?php echo esc_js( __( 'Home, Services, Gallery, the header and the footer go back to the original designs. Your changes to them will be lost. Continue?', 'viewmail' ) ); ?>');"><?php esc_html_e( 'Rebuild pages with the original designs', 'viewmail' ); ?></button>
			<?php endif; ?>
		</form>

		<?php if ( $built && $ready ) : ?>
			<h2><?php esc_html_e( '3. Edit your site', 'viewmail' ); ?></h2>
			<ul style="list-style:disc;padding-left:20px">
				<?php
				foreach ( viewmail_pages() as $slug => $title ) :
					$page = get_page_by_path( $slug, OBJECT, 'page' );
					if ( ! $page ) {
						continue;
					}
					?>
					<li><strong><?php echo esc_html( get_the_title( $page ) ); ?>:</strong>
						<a href="<?php echo esc_url( admin_url( 'post.php?post=' . $page->ID . '&action=elementor' ) ); ?>"><?php esc_html_e( 'Edit with Elementor', 'viewmail' ); ?></a> |
						<a href="<?php echo esc_url( get_permalink( $page ) ); ?>"><?php esc_html_e( 'View', 'viewmail' ); ?></a></li>
				<?php endforeach; ?>
				<li><a href="<?php echo esc_url( admin_url( 'edit.php?post_type=elementor-hf' ) ); ?>"><?php esc_html_e( 'Header and footer (Appearance > Elementor Header & Footer Builder)', 'viewmail' ); ?></a></li>
				<li><a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php esc_html_e( 'Menu items', 'viewmail' ); ?></a></li>
				<li><a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=viewmail_options' ) ); ?>"><?php esc_html_e( 'WhatsApp button and Google description', 'viewmail' ); ?></a></li>
				<li><a href="<?php echo esc_url( admin_url( 'upload.php' ) ); ?>"><?php esc_html_e( 'Pictures (Media Library)', 'viewmail' ); ?></a></li>
			</ul>
			<p class="description" style="max-width:760px"><?php esc_html_e( 'Tip: the Google Ads preview, the bidding calculator and the demo search are Elementor widgets under "Viewmail" in the Elementor panel. Click one to change its texts, prices or demo list.', 'viewmail' ); ?></p>
		<?php endif; ?>
	</div>
	<?php
}

function viewmail_setup_action() {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_die( esc_html__( 'Sorry, you are not allowed to do that.', 'viewmail' ) );
	}
	check_admin_referer( 'viewmail_setup' );
	$do = isset( $_POST['do'] ) && 'rebuild' === $_POST['do'] ? 'rebuild' : 'build';

	if ( function_exists( 'set_time_limit' ) ) {
		set_time_limit( 300 ); // phpcs:ignore Squiz.PHP.DiscouragedFunctions.Discouraged
	}

	$errors = viewmail_install_plugins();
	if ( ! $errors ) {
		// The plugins were just switched on: build in a fresh request so they are fully loaded.
		wp_safe_redirect(
			add_query_arg(
				array(
					'action'   => 'viewmail_build',
					'do'       => $do,
					'_wpnonce' => wp_create_nonce( 'viewmail_build' ),
				),
				admin_url( 'admin-post.php' )
			)
		);
		exit;
	}
	set_transient( 'viewmail_setup_errors', $errors, 300 );
	wp_safe_redirect( admin_url( 'themes.php?page=viewmail-setup' ) );
	exit;
}
add_action( 'admin_post_viewmail_setup', 'viewmail_setup_action' );

function viewmail_build_action() {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_die( esc_html__( 'Sorry, you are not allowed to do that.', 'viewmail' ) );
	}
	check_admin_referer( 'viewmail_build' );
	$do = isset( $_GET['do'] ) && 'rebuild' === $_GET['do'] ? 'rebuild' : 'build';
	if ( function_exists( 'set_time_limit' ) ) {
		set_time_limit( 300 ); // phpcs:ignore Squiz.PHP.DiscouragedFunctions.Discouraged
	}
	$errors = viewmail_run_setup( 'rebuild' === $do );
	if ( $errors ) {
		set_transient( 'viewmail_setup_errors', $errors, 300 );
		$do = '';
	}
	wp_safe_redirect( admin_url( 'themes.php?page=viewmail-setup&done=' . $do ) );
	exit;
}
add_action( 'admin_post_viewmail_build', 'viewmail_build_action' );

/** Reminder until the site is built. */
function viewmail_admin_notice() {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}
	$screen = get_current_screen();
	if ( $screen && 'appearance_page_viewmail-setup' === $screen->id ) {
		delete_transient( 'viewmail_welcome' );
		return;
	}
	if ( get_option( 'viewmail_setup_done' ) && viewmail_elementor_active() && viewmail_hfe_active() ) {
		if ( get_transient( 'viewmail_welcome' ) ) {
			echo '<div class="notice notice-success is-dismissible"><p><strong>' . esc_html__( 'Viewmail is ready.', 'viewmail' ) . '</strong> <a href="' . esc_url( admin_url( 'themes.php?page=viewmail-setup' ) ) . '">' . esc_html__( 'Open Viewmail Setup', 'viewmail' ) . '</a></p></div>';
		}
		return;
	}
	echo '<div class="notice notice-info"><p><strong>' . esc_html__( 'Viewmail Sitepages:', 'viewmail' ) . '</strong> ';
	esc_html_e( 'one more step to build your site.', 'viewmail' );
	echo ' <a class="button button-primary" style="margin-left:8px" href="' . esc_url( admin_url( 'themes.php?page=viewmail-setup' ) ) . '">' . esc_html__( 'Open Viewmail Setup', 'viewmail' ) . '</a></p></div>';
}
add_action( 'admin_notices', 'viewmail_admin_notice' );
