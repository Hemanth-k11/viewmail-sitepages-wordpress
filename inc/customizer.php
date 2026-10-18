<?php
/**
 * Appearance > Customize > Viewmail: WhatsApp button and home page description.
 *
 * @package Viewmail
 */

defined( 'ABSPATH' ) || exit;

function viewmail_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'viewmail_options',
		array(
			'title'    => __( 'Viewmail: WhatsApp and search text', 'viewmail' ),
			'priority' => 30,
		)
	);

	$wp_customize->add_setting( 'viewmail_wa_show', array( 'default' => true, 'sanitize_callback' => 'wp_validate_boolean' ) );
	$wp_customize->add_control(
		'viewmail_wa_show',
		array(
			'label'   => __( 'Show the floating WhatsApp button', 'viewmail' ),
			'section' => 'viewmail_options',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting( 'viewmail_wa_number', array( 'default' => '919966222314', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control(
		'viewmail_wa_number',
		array(
			'label'       => __( 'WhatsApp number', 'viewmail' ),
			'description' => __( 'With country code, for example 919966222314.', 'viewmail' ),
			'section'     => 'viewmail_options',
			'type'        => 'text',
		)
	);

	$wp_customize->add_setting( 'viewmail_wa_label', array( 'default' => 'Need help? Chat now!', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control(
		'viewmail_wa_label',
		array(
			'label'   => __( 'Text beside the button', 'viewmail' ),
			'section' => 'viewmail_options',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'viewmail_meta_description',
		array(
			'default'           => 'Affordable cPanel hosting and domain registration in India. Specializing in .in, Nixi, and .bharat IDN domains. Secure, fast servers with 24/7 local support.',
			'sanitize_callback' => 'sanitize_textarea_field',
		)
	);
	$wp_customize->add_control(
		'viewmail_meta_description',
		array(
			'label'       => __( 'Home page description for Google', 'viewmail' ),
			'description' => __( 'Not used when an SEO plugin such as Rank Math or Yoast is active.', 'viewmail' ),
			'section'     => 'viewmail_options',
			'type'        => 'textarea',
		)
	);
}
add_action( 'customize_register', 'viewmail_customize_register' );
