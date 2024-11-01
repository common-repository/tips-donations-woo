<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Block;

add_action( 'carbon_fields_register_fields', 'thegoodplugin_plugin_options_opt' );
function thegoodplugin_plugin_options_opt() {
	// loader background

	$varval1 = '☕';
	$varval2 = '🍕';
	$varval3 = '🌳';

	$basic_thegoodplugin_options_container = Container::make( 'theme_options', 'thegoodplugin_opts', esc_html__( 'Tips & Donations', 'tips-donations-woo' ) )
	->set_icon( plugin_dir_url('README.txt') . THEGOODPLUGIN_NAME . '/assets/wplogo.svg' )
	->add_fields( array(
		Field::make( 'html', 'thegoodplugin_opts', '' )
		->set_html( 'thegoodplugin_analytics_temp' ),

		Field::make( 'text', 'thegoodplugin_emoji_icon', esc_html__( 'Emoji', 'tips-donations-woo' ) )
		->set_default_value( wp_specialchars_decode( $varval1 ) )
		->set_classes( 'inputemoji field-flex tip-box' )
		->set_width( 100 ),

		Field::make( 'text', 'thegoodplugin_amount', esc_html__( 'Amount Value', 'tips-donations-woo' ) )
		->set_attribute( 'type', 'number' )
		->set_classes( 'field-flex' )
		->set_width( 100 ),

		Field::make( 'color', 'thegoodplugin_box_color', esc_html__( 'Background Color', 'tips-donations-woo' ) )
		->set_width( 50 )
		->set_classes( 'field-flex' ),

		Field::make( 'rich_text', 'thegoodplugin_box_title', esc_html__( 'Title', 'tips-donations-woo' ) )
		->set_attribute( 'placeholder', 'Tips appreciated!' )
		->set_help_text( esc_html__( 'Remove text in order to disable the title', 'tips-donations-woo' ) )
		->set_classes( 'field-flex text4field textitle' ),

		Field::make( 'rich_text', 'thegoodplugin_box_description', esc_html__( 'Description', 'tips-donations-woo' ) )
		->set_help_text( esc_html__( 'Remove text in order to disable the description', 'tips-donations-woo' ) )
		->set_classes( 'field-flex text4field textdesc' ),

		Field::make( 'text', 'thegoodplugin_button_text', esc_html__( 'Button text', 'tips-donations-woo' ) )
		->set_attribute( 'placeholder', 'Tip' )
		->set_classes( 'field-flex' ),

		Field::make( 'text', 'thegoodplugin_button_after_text', esc_html__( 'Button after text', 'tips-donations-woo' ) )
		->set_attribute( 'placeholder', 'Thank you!' )
		->set_classes( 'field-flex' ),
	) );
}

/**
 * Custom HTML for statistic.
 */
function thegoodplugin_analytics_temp() {
	// check user capabilities.
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	ob_start();
	include plugin_dir_path( __FILE__ ) . 'admin/partials/thegoodplugin-admin-display.php';
	$content = ob_get_clean();
	return $content;
}
