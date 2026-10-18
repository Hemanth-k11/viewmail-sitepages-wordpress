<?php
/**
 * Small helpers that build Elementor data (containers and widgets).
 *
 * @package Viewmail
 */

defined( 'ABSPATH' ) || exit;

function viewmail_el_id() {
	return substr( md5( uniqid( '', true ) . wp_rand() ), 0, 7 );
}

function viewmail_el_px( $size, $unit = 'px' ) {
	return array(
		'unit' => $unit,
		'size' => $size,
	);
}

function viewmail_el_box( $top, $right = null, $bottom = null, $left = null, $unit = 'px' ) {
	$right  = null === $right ? $top : $right;
	$bottom = null === $bottom ? $top : $bottom;
	$left   = null === $left ? $right : $left;
	return array(
		'unit'     => $unit,
		'top'      => (string) $top,
		'right'    => (string) $right,
		'bottom'   => (string) $bottom,
		'left'     => (string) $left,
		'isLinked' => ( $top === $right && $right === $bottom && $bottom === $left ),
	);
}

function viewmail_el_gap( $size ) {
	return array(
		'unit'     => 'px',
		'size'     => $size,
		'column'   => (string) $size,
		'row'      => (string) $size,
		'isLinked' => true,
	);
}

function viewmail_el_shadow( $color, $y = 10, $blur = 30 ) {
	return array(
		'horizontal' => 0,
		'vertical'   => $y,
		'blur'       => $blur,
		'spread'     => 0,
		'color'      => $color,
	);
}

/** Any container. */
function viewmail_el_container( $settings, $children = array() ) {
	return array(
		'id'       => viewmail_el_id(),
		'elType'   => 'container',
		'isInner'  => false,
		'settings' => array_merge(
			array(
				'content_width'  => 'full',
				'flex_direction' => 'column',
			),
			$settings
		),
		'elements' => $children,
	);
}

/** A full-width band with boxed content inside. */
function viewmail_el_section( $settings, $children ) {
	return viewmail_el_container(
		array_merge(
			array(
				'content_width'  => 'boxed',
				'boxed_width'    => viewmail_el_px( 1200 ),
				'flex_gap'       => viewmail_el_gap( 20 ),
				'padding'        => viewmail_el_box( 50, 25, 50, 25 ),
				'padding_mobile' => viewmail_el_box( 36, 16, 36, 16 ),
			),
			$settings
		),
		$children
	);
}

/** A row of cards that wraps on small screens. */
function viewmail_el_row( $children, $gap = 25, $extra = array() ) {
	return viewmail_el_container(
		array_merge(
			array(
				'flex_direction'       => 'row',
				'flex_wrap'            => 'wrap',
				'flex_gap'             => viewmail_el_gap( $gap ),
				'flex_justify_content' => 'center',
				'flex_align_items'     => 'stretch',
			),
			$extra
		),
		$children
	);
}

/** Card width for a row of $per cards (desktop), 2 on tablets, 1 on phones. */
function viewmail_el_width( $per, $gap = 25, $tablet = 2 ) {
	$calc = function ( $n ) use ( $gap ) {
		return 1 === $n ? '100%' : 'calc((100% - ' . ( ( $n - 1 ) * $gap ) . 'px) / ' . $n . ')';
	};
	return array(
		'width'        => array( 'unit' => 'custom', 'size' => $calc( $per ) ),
		'width_tablet' => array( 'unit' => 'custom', 'size' => $calc( min( $per, $tablet ) ) ),
		'width_mobile' => array( 'unit' => 'custom', 'size' => '100%' ),
	);
}

function viewmail_el_widget( $type, $settings ) {
	return array(
		'id'         => viewmail_el_id(),
		'elType'     => 'widget',
		'widgetType' => $type,
		'isInner'    => false,
		'settings'   => $settings,
		'elements'   => array(),
	);
}

/** Heading. $size is the desktop font size; phones get a smaller one. */
function viewmail_el_heading( $text, $tag = 'h2', $size = 34, $extra = array() ) {
	$set = array(
		'title'                       => $text,
		'header_size'                 => $tag,
		'typography_typography'       => 'custom',
		'typography_font_family'      => 'Plus Jakarta Sans',
		'typography_font_weight'      => '800',
		'typography_font_size'        => viewmail_el_px( $size ),
		'typography_font_size_mobile' => viewmail_el_px( max( 16, round( $size * 0.75 ) ) ),
		'typography_line_height'      => viewmail_el_px( 1.25, 'em' ),
		'title_color'                 => '#0A2351',
	);
	return viewmail_el_widget( 'heading', array_merge( $set, $extra ) );
}

function viewmail_el_text( $html, $extra = array() ) {
	return viewmail_el_widget(
		'text-editor',
		array_merge(
			array(
				'editor'                 => $html,
				'text_color'             => '#475569',
				'typography_typography'  => 'custom',
				'typography_font_family' => 'Plus Jakarta Sans',
				'typography_font_size'   => viewmail_el_px( 15 ),
				'typography_line_height' => viewmail_el_px( 1.7, 'em' ),
			),
			$extra
		)
	);
}

/** Button. $colors = array( background, text, hover background ). */
function viewmail_el_button( $text, $url, $colors, $extra = array() ) {
	$external = 0 === strpos( $url, 'http' );
	return viewmail_el_widget(
		'button',
		array_merge(
			array(
				'text'                          => $text,
				'link'                          => array(
					'url'         => $url,
					'is_external' => $external ? 'on' : '',
					'nofollow'    => '',
				),
				'background_color'              => $colors[0],
				'button_text_color'             => $colors[1],
				'button_background_hover_color' => isset( $colors[2] ) ? $colors[2] : $colors[0],
				'hover_color'                   => $colors[1],
				'border_radius'                 => viewmail_el_box( 8 ),
				'text_padding'                  => viewmail_el_box( 14, 40, 14, 40 ),
				'typography_typography'         => 'custom',
				'typography_font_family'        => 'Plus Jakarta Sans',
				'typography_font_weight'        => '700',
				'typography_font_size'          => viewmail_el_px( 15 ),
				'hover_animation'               => 'grow',
			),
			$extra
		)
	);
}

function viewmail_el_image( $slug, $alt = '', $extra = array() ) {
	$id = viewmail_image_id( $slug );
	return viewmail_el_widget(
		'image',
		array_merge(
			array(
				'image'      => array(
					'id'  => $id,
					'url' => $id ? wp_get_attachment_url( $id ) : VIEWMAIL_URI . '/assets/images/' . $slug . '.jpg',
					'alt' => $alt,
				),
				'image_size' => 'full',
			),
			$extra
		)
	);
}

/** Icon with title and text beside or above it. */
function viewmail_el_icon_box( $icon, $title, $text, $color, $title_color, $extra = array() ) {
	$library = 0 === strpos( $icon, 'fab ' ) ? 'fa-brands' : 'fa-solid';
	return viewmail_el_widget(
		'icon-box',
		array_merge(
			array(
				'selected_icon'                     => array(
					'value'   => $icon,
					'library' => $library,
				),
				'view'                              => 'default',
				'position'                          => 'left',
				'title_text'                        => $title,
				'description_text'                  => $text,
				'title_size'                        => 'h4',
				'primary_color'                     => $color,
				'icon_size'                         => viewmail_el_px( 20 ),
				'icon_space'                        => viewmail_el_px( 12 ),
				'title_bottom_space'                => viewmail_el_px( 10 ),
				'title_color'                       => $title_color,
				'description_color'                 => '#333333',
				'title_typography_typography'       => 'custom',
				'title_typography_font_family'      => 'Plus Jakarta Sans',
				'title_typography_font_weight'      => '700',
				'title_typography_font_size'        => viewmail_el_px( 19 ),
				'description_typography_typography' => 'custom',
				'description_typography_font_family' => 'Plus Jakarta Sans',
				'description_typography_font_size'  => viewmail_el_px( 15 ),
				'description_typography_line_height' => viewmail_el_px( 1.6, 'em' ),
				'text_align'                        => 'left',
			),
			$extra
		)
	);
}

function viewmail_el_save( $post_id, $data, $type = 'wp-page', $page_settings = array() ) {
	update_post_meta( $post_id, '_elementor_edit_mode', 'builder' );
	update_post_meta( $post_id, '_elementor_template_type', $type );
	update_post_meta( $post_id, '_elementor_version', ELEMENTOR_VERSION );
	update_post_meta( $post_id, '_elementor_data', wp_slash( wp_json_encode( $data ) ) );
	if ( $page_settings ) {
		update_post_meta( $post_id, '_elementor_page_settings', $page_settings );
	}
	delete_post_meta( $post_id, '_elementor_css' );
	delete_post_meta( $post_id, '_elementor_element_cache' );
}

/** Elementor site settings: colours, fonts, page width. */
function viewmail_elementor_site_settings() {
	update_option( 'elementor_disable_color_schemes', 'yes' );
	update_option( 'elementor_disable_typography_schemes', 'yes' );
	update_option( 'elementor_font_display', 'swap' );
	update_option( 'elementor_load_fa4_shim', '' );

	$kit_id = (int) get_option( 'elementor_active_kit' );
	if ( ! $kit_id || ! get_post( $kit_id ) ) {
		if ( empty( \Elementor\Plugin::$instance->kits_manager ) ) {
			return;
		}
		$kit_id = \Elementor\Plugin::$instance->kits_manager->create_default();
		update_option( 'elementor_active_kit', $kit_id );
	}
	$kit = get_post_meta( $kit_id, '_elementor_page_settings', true );
	$kit = is_array( $kit ) ? $kit : array();

	$font = function ( $id, $title, $weight ) {
		return array(
			'_id'                    => $id,
			'title'                  => $title,
			'typography_typography'  => 'custom',
			'typography_font_family' => 'Plus Jakarta Sans',
			'typography_font_weight' => $weight,
		);
	};

	$kit = array_merge(
		$kit,
		array(
			'system_colors'          => array(
				array( '_id' => 'primary', 'title' => 'Navy', 'color' => '#0A2351' ),
				array( '_id' => 'secondary', 'title' => 'Blue', 'color' => '#4285F4' ),
				array( '_id' => 'text', 'title' => 'Text', 'color' => '#1E293B' ),
				array( '_id' => 'accent', 'title' => 'Gold', 'color' => '#FFB400' ),
			),
			'custom_colors'          => array(
				array( '_id' => 'vmgreen', 'title' => 'Green', 'color' => '#28A745' ),
				array( '_id' => 'vmred', 'title' => 'Red', 'color' => '#E53E3E' ),
				array( '_id' => 'vmbg', 'title' => 'Page background', 'color' => '#F8FAFD' ),
				array( '_id' => 'vmdark', 'title' => 'Footer', 'color' => '#0F172A' ),
			),
			'system_typography'      => array(
				$font( 'primary', 'Headings', '800' ),
				$font( 'secondary', 'Sub headings', '700' ),
				$font( 'text', 'Text', '400' ),
				$font( 'accent', 'Buttons', '700' ),
			),
			'body_background_background' => 'classic',
			'body_background_color'  => '#F8FAFD',
			'body_color'             => '#1E293B',
			'body_typography_typography' => 'custom',
			'body_typography_font_family' => 'Plus Jakarta Sans',
			'link_normal_color'      => '#0056B3',
			'container_width'        => viewmail_el_px( 1200 ),
			'space_between_widgets'  => array( 'unit' => 'px', 'size' => 16, 'column' => '16', 'row' => '16', 'isLinked' => true ),
			'page_title_selector'    => 'h1.entry-title',
			'hello_header_logo_display' => '',
			'hello_footer_logo_display' => '',
		)
	);
	update_post_meta( $kit_id, '_elementor_page_settings', $kit );
	delete_post_meta( $kit_id, '_elementor_css' );
}
