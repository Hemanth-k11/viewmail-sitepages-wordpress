<?php
/**
 * Viewmail Elementor widgets: Ad Preview Studio, Bidding Calculator and
 * Web App Demo Explorer. They show up in the Elementor panel under "Viewmail".
 *
 * @package Viewmail
 */

defined( 'ABSPATH' ) || exit;

function viewmail_widget_category( $elements_manager ) {
	$elements_manager->add_category(
		'viewmail',
		array(
			'title' => __( 'Viewmail', 'viewmail' ),
			'icon'  => 'fa fa-plug',
		)
	);
}
add_action( 'elementor/elements/categories_registered', 'viewmail_widget_category' );

function viewmail_register_widgets( $widgets_manager ) {
	require_once __DIR__ . '/class-ad-studio.php';
	require_once __DIR__ . '/class-bid-calculator.php';
	require_once __DIR__ . '/class-demo-explorer.php';
	$widgets_manager->register( new \Viewmail_Ad_Studio() );
	$widgets_manager->register( new \Viewmail_Bid_Calculator() );
	$widgets_manager->register( new \Viewmail_Demo_Explorer() );
}
add_action( 'elementor/widgets/register', 'viewmail_register_widgets' );
