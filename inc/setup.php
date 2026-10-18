<?php
/**
 * One-click site setup: plugins, pictures, pages, menu, header and footer.
 *
 * @package Viewmail
 */

defined( 'ABSPATH' ) || exit;

/** Plugins the site is built with (same as rnembedded.com). */
function viewmail_required_plugins() {
	return array(
		'elementor'               => array(
			'name' => 'Elementor',
			'file' => 'elementor/elementor.php',
		),
		'header-footer-elementor' => array(
			'name' => 'Elementor Header & Footer Builder',
			'file' => 'header-footer-elementor/header-footer-elementor.php',
		),
	);
}

/** Pages the theme creates. */
function viewmail_pages() {
	return array(
		'home'     => 'Home',
		'services' => 'Services',
		'gallery'  => 'Gallery',
	);
}

/** Plugin state: active, installed or missing. */
function viewmail_plugin_state( $slug ) {
	if ( ! function_exists( 'get_plugins' ) ) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
	}
	$file = viewmail_required_plugins()[ $slug ]['file'];
	if ( is_plugin_active( $file ) ) {
		return 'active';
	}
	return isset( get_plugins()[ $file ] ) ? 'installed' : 'missing';
}

/**
 * Install (from wordpress.org) and activate the required plugins.
 *
 * @return string[] Error messages, empty when all went well.
 */
function viewmail_install_plugins() {
	$errors = array();
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/misc.php';
	require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
	require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

	foreach ( viewmail_required_plugins() as $slug => $plugin ) {
		$state = viewmail_plugin_state( $slug );
		if ( 'missing' === $state ) {
			if ( ! current_user_can( 'install_plugins' ) ) {
				/* translators: %s: plugin name */
				$errors[] = sprintf( __( 'You are not allowed to install %s.', 'viewmail' ), $plugin['name'] );
				continue;
			}
			$api = plugins_api( 'plugin_information', array( 'slug' => $slug, 'fields' => array( 'sections' => false ) ) );
			if ( is_wp_error( $api ) ) {
				$errors[] = $plugin['name'] . ': ' . $api->get_error_message();
				continue;
			}
			$upgrader = new Plugin_Upgrader( new Automatic_Upgrader_Skin() );
			$result   = $upgrader->install( $api->download_link );
			if ( true !== $result ) {
				$message  = is_wp_error( $result ) ? $result->get_error_message() : __( 'could not be downloaded. Please install it from Plugins > Add New.', 'viewmail' );
				$errors[] = $plugin['name'] . ': ' . $message;
				continue;
			}
			wp_clean_plugins_cache();
		}
		if ( 'active' !== viewmail_plugin_state( $slug ) ) {
			$result = activate_plugin( $plugin['file'] );
			if ( is_wp_error( $result ) ) {
				$errors[] = $plugin['name'] . ': ' . $result->get_error_message();
			}
		}
	}

	// Stay on our setup screen instead of the plugins' welcome screens.
	delete_transient( 'elementor_activation_redirect' );
	delete_option( 'hfe_start_onboarding' );
	update_option( 'elementor_onboarded', true );

	return $errors;
}

/** Copy the theme pictures into the Media Library (once). */
function viewmail_import_images() {
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	$map = get_option( 'viewmail_images', array() );
	$map = is_array( $map ) ? $map : array();
	foreach ( viewmail_all_images() as $slug => $alt ) {
		if ( ! empty( $map[ $slug ] ) && get_post( $map[ $slug ] ) ) {
			continue;
		}
		$source = VIEWMAIL_DIR . '/assets/images/' . $slug . '.jpg';
		if ( ! file_exists( $source ) ) {
			continue;
		}
		$tmp = wp_tempnam( $slug . '.jpg' );
		copy( $source, $tmp );
		$id = media_handle_sideload(
			array(
				'name'     => $slug . '.jpg',
				'tmp_name' => $tmp,
			),
			0,
			$alt
		);
		if ( is_wp_error( $id ) ) {
			wp_delete_file( $tmp );
			continue;
		}
		update_post_meta( $id, '_wp_attachment_image_alt', $alt );
		update_post_meta( $id, '_viewmail_image', $slug );
		$map[ $slug ] = $id;
		update_option( 'viewmail_images', $map, false );
	}
	return $map;
}

/** Create a page if it is missing. Returns array( id, created ). */
function viewmail_ensure_page( $slug, $title ) {
	$page = get_page_by_path( $slug, OBJECT, 'page' );
	if ( $page && 'trash' !== $page->post_status ) {
		return array( $page->ID, false );
	}
	$id = wp_insert_post(
		array(
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_title'   => $title,
			'post_name'    => $slug,
			'post_content' => '',
		)
	);
	update_post_meta( $id, '_viewmail_page', $slug );
	return array( $id, true );
}

/** Put the Elementor design into a page. */
function viewmail_fill_page( $id, $slug ) {
	$builders = array(
		'home'     => 'viewmail_home_data',
		'services' => 'viewmail_services_data',
		'gallery'  => 'viewmail_gallery_data',
	);
	$data     = call_user_func( $builders[ $slug ] );
	update_post_meta( $id, '_wp_page_template', 'elementor_header_footer' );
	viewmail_el_save( $id, $data, 'wp-page', array( 'hide_title' => 'yes' ) );
	if ( 'services' === $slug ) {
		viewmail_seo_seed( $id, viewmail_services_seo() );
	} elseif ( 'gallery' === $slug ) {
		viewmail_seo_seed( $id, viewmail_gallery_seo() );
	}
	update_post_meta( $id, '_viewmail_page', $slug );
	update_post_meta( $id, '_viewmail_built', VIEWMAIL_VERSION );
}

/**
 * Add a page to an existing menu at a position, unless it is already there.
 * Items at or after that position move down one place.
 */
function viewmail_menu_add_page( $menu, $slug, $page_id, $position ) {
	$items = wp_get_nav_menu_items( $menu->term_id );
	foreach ( (array) $items as $item ) {
		if ( 'page' === $item->object && (int) $item->object_id === (int) $page_id ) {
			return;
		}
	}
	foreach ( (array) $items as $item ) {
		if ( (int) $item->menu_order >= $position ) {
			wp_update_post(
				array(
					'ID'         => $item->ID,
					'menu_order' => (int) $item->menu_order + 1,
				)
			);
		}
	}
	wp_update_nav_menu_item(
		$menu->term_id,
		0,
		array(
			'menu-item-title'     => viewmail_pages()[ $slug ],
			'menu-item-object'    => 'page',
			'menu-item-object-id' => $page_id,
			'menu-item-type'      => 'post_type',
			'menu-item-status'    => 'publish',
			'menu-item-position'  => $position,
		)
	);
}

/** Main menu: Home, Services, Gallery, Domain Registration. */
function viewmail_setup_menu( $pages ) {
	$name = 'Main Menu';
	$menu = wp_get_nav_menu_object( $name );
	if ( ! $menu ) {
		$menu_id = wp_create_nav_menu( $name );
		if ( is_wp_error( $menu_id ) ) {
			return '';
		}
		foreach ( array( 'home', 'services', 'gallery' ) as $i => $slug ) {
			wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-title'     => viewmail_pages()[ $slug ],
					'menu-item-object'    => 'page',
					'menu-item-object-id' => $pages[ $slug ],
					'menu-item-type'      => 'post_type',
					'menu-item-status'    => 'publish',
					'menu-item-position'  => $i + 1,
				)
			);
		}
		wp_update_nav_menu_item(
			$menu_id,
			0,
			array(
				'menu-item-title'    => 'Domain Registration',
				'menu-item-url'      => viewmail_contact()['domains'],
				'menu-item-type'     => 'custom',
				'menu-item-target'   => '_blank',
				'menu-item-status'   => 'publish',
				'menu-item-position' => 4,
			)
		);
		$menu = wp_get_nav_menu_object( $menu_id );
	} else {
		viewmail_menu_add_page( $menu, 'services', $pages['services'], 2 );
	}
	$locations = get_theme_mod( 'nav_menu_locations', array() );
	if ( empty( $locations['menu-1'] ) ) {
		$locations['menu-1'] = $menu->term_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}
	return $menu->slug;
}

/** Header or footer template for the Header & Footer Builder (only if none exists). */
function viewmail_setup_hf( $type, $title, $data ) {
	$existing = get_posts(
		array(
			'post_type'   => 'elementor-hf',
			'post_status' => 'any',
			'numberposts' => 1,
			'fields'      => 'ids',
			'meta_key'    => 'ehf_template_type', // phpcs:ignore WordPress.DB.SlowDBQuery
			'meta_value'  => $type, // phpcs:ignore WordPress.DB.SlowDBQuery
		)
	);
	if ( $existing ) {
		return (int) $existing[0];
	}
	$id = wp_insert_post(
		array(
			'post_type'   => 'elementor-hf',
			'post_status' => 'publish',
			'post_title'  => $title,
		)
	);
	update_post_meta( $id, 'ehf_template_type', $type );
	update_post_meta(
		$id,
		'ehf_target_include_locations',
		array(
			'rule'     => array( 'basic-global' ),
			'specific' => array(),
		)
	);
	update_post_meta( $id, 'ehf_target_exclude_locations', array() );
	update_post_meta( $id, '_wp_page_template', 'elementor_canvas' );
	viewmail_el_save( $id, $data, 'wp-post' );
	update_post_meta( $id, '_viewmail_hf', $type );
	return $id;
}

/** Remove the WordPress sample post and page when nobody changed them. */
function viewmail_remove_samples() {
	foreach ( array( array( 'hello-world', 'post' ), array( 'sample-page', 'page' ) ) as $item ) {
		$post = get_page_by_path( $item[0], OBJECT, $item[1] );
		if ( $post && $post->post_modified_gmt === $post->post_date_gmt ) {
			wp_delete_post( $post->ID, true );
		}
	}
}

/**
 * Build the site. Pages that already exist are kept unless $rebuild is true.
 *
 * @return string[] Error messages.
 */
function viewmail_run_setup( $rebuild = false ) {
	if ( ! viewmail_elementor_active() || ! viewmail_hfe_active() ) {
		return array( __( 'Elementor and Elementor Header & Footer Builder must be active first.', 'viewmail' ) );
	}

	viewmail_import_images();
	viewmail_sync_image_seo();
	viewmail_elementor_site_settings();

	$pages = array();
	foreach ( viewmail_pages() as $slug => $title ) {
		list( $id, $created ) = viewmail_ensure_page( $slug, $title );
		$pages[ $slug ]       = $id;
		$ours                 = get_post_meta( $id, '_viewmail_page', true );
		if ( $created || ( $rebuild && $ours ) || ( $ours && ! get_post_meta( $id, '_elementor_edit_mode', true ) ) ) {
			viewmail_fill_page( $id, $slug );
		}
	}

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $pages['home'] );
	if ( ! get_option( 'permalink_structure' ) ) {
		update_option( 'permalink_structure', '/%postname%/' );
	}
	if ( 'Just another WordPress site' === get_option( 'blogdescription' ) || '' === get_option( 'blogdescription' ) ) {
		update_option( 'blogdescription', 'Digital Intelligence' );
	}

	$menu_slug = viewmail_setup_menu( $pages );
	if ( $rebuild ) {
		foreach ( get_posts( array( 'post_type' => 'elementor-hf', 'post_status' => 'any', 'numberposts' => -1, 'meta_key' => '_viewmail_hf' ) ) as $old ) { // phpcs:ignore WordPress.DB.SlowDBQuery
			wp_delete_post( $old->ID, true );
		}
	}
	viewmail_setup_hf( 'type_header', 'Viewmail Header', viewmail_header_data( $menu_slug ) );
	viewmail_setup_hf( 'type_footer', 'Viewmail Footer', viewmail_footer_data() );

	if ( empty( get_option( 'site_icon' ) ) && viewmail_image_id( 'logo' ) ) {
		update_option( 'site_icon', viewmail_image_id( 'logo' ) );
	}

	viewmail_remove_samples();
	flush_rewrite_rules();
	\Elementor\Plugin::$instance->files_manager->clear_cache();
	update_option( 'viewmail_setup_done', VIEWMAIL_VERSION );

	return array();
}

/**
 * After the theme is switched on: build right away if the plugins are ready,
 * otherwise point to the setup screen.
 */
function viewmail_after_switch() {
	if ( viewmail_elementor_active() && viewmail_hfe_active() && ! get_option( 'viewmail_setup_done' ) ) {
		viewmail_run_setup();
	}
	set_transient( 'viewmail_welcome', 1, DAY_IN_SECONDS );
}
add_action( 'after_switch_theme', 'viewmail_after_switch' );
