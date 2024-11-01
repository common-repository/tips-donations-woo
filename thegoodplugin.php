<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://thegoodplugin.com/
 * @since             1.0.0
 * @package           tips-donations-woo
 *
 * @wordpress-plugin
 * Plugin Name:       Tips & Donations for WooCommerce
 * Plugin URI:        https://demo.thegoodplugin.com/
 * Description:       Custom tip and donation plugin for WooCommerce.
 * Version:           1.0.0
 * Author:            The Good Plugin
 * Author URI:        https://thegoodplugin.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tips-donations-woo
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'THEGOODPLUGIN_VERSION', '1.0.0' );

define( 'THEGOODPLUGIN', __FILE__ );

define( 'THEGOODPLUGIN_BASENAME', plugin_basename( THEGOODPLUGIN ) );

define( 'THEGOODPLUGIN_NAME', trim( dirname( THEGOODPLUGIN_BASENAME ), '/' ) );

define( 'THEGOODPLUGIN_DIR', untrailingslashit( dirname( THEGOODPLUGIN ) ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-thegoodplugin-activator.php
 */
function activate_thegoodplugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-thegoodplugin-activator.php';
	Thegoodplugin_Activator::activate();
}

/**
 * The code that built new database during plugin activation.
 */
function thegoodplugin_create_db() {
	require_once 'thegoodplugin-db.php';
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-thegoodplugin-deactivator.php
 */
function deactivate_thegoodplugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-thegoodplugin-deactivator.php';
	Thegoodplugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_thegoodplugin' );
register_activation_hook( __FILE__, 'thegoodplugin_create_db' );
register_deactivation_hook( __FILE__, 'deactivate_thegoodplugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-thegoodplugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_thegoodplugin() {

	$plugin = new Thegoodplugin();
	$plugin->run();

}
run_thegoodplugin();

/**
 * Carbon init.
 */
function thegoodplugin_crb_load() {
	require_once 'vendor/autoload.php';
	\Carbon_Fields\Carbon_Fields::boot();
}
add_action( 'after_setup_theme', 'thegoodplugin_crb_load' );

/* carbon options */
require_once plugin_dir_path( __FILE__ ) . 'thegoodplugin-options.php';

/**
 * Add a tip box to the cart page.
 */
function thegoodplugin_html_tips() {
	$thegoodplugin_box_title         = carbon_get_theme_option( 'thegoodplugin_box_title' );
	$thegoodplugin_box_description   = carbon_get_theme_option( 'thegoodplugin_box_description' );
	$thegoodplugin_button_text       = carbon_get_theme_option( 'thegoodplugin_button_text' );
	$thegoodplugin_button_after_text = carbon_get_theme_option( 'thegoodplugin_button_after_text' );
	$thegoodplugin_box_color         = carbon_get_theme_option( 'thegoodplugin_box_color' );
	$thegoodplugin_emoji_icon        = carbon_get_theme_option( 'thegoodplugin_emoji_icon' );
	$thegoodplugin_amount            = carbon_get_theme_option( 'thegoodplugin_amount' );

	$price        = '5';
	if ( ! empty( $thegoodplugin_amount ) ) {
		$price = $thegoodplugin_amount;
	}
	$button_color = '#000000';

	if ( class_exists( 'WooCommerce' ) ) {
		$currency = get_woocommerce_currency_symbol();
	} else {
		$currency = '$';
	}

	$show_tip = $currency . $price; ?>

	<div class="tips-and-more-wrapper">
		<div class="tips-inner" style="background-color: <?php echo esc_attr( $thegoodplugin_box_color ); ?>">
			<?php if ( !empty( $thegoodplugin_box_title ) ) { ?>
			<h3 class="title-tips">
				<?php echo apply_filters( 'the_content', $thegoodplugin_box_title ); ?>
			</h3>
			<?php } ?>
			<?php if ( !empty( $thegoodplugin_box_description ) ) { ?>
			<div class="tips-description">
				<?php echo apply_filters( 'the_content', $thegoodplugin_box_description ); ?>
			</div>
			<?php } ?>

			<form id="save_tipmore_tip" name="save_tipmore_tip" action="" method="POST" enctype="multipart/form-data">
				<div class="give-tips-wrap">
					<div class="give-tips">
						<div class="image-tips">
							<h4><?php echo esc_html( $thegoodplugin_emoji_icon ); ?></h4>
						</div>
						<div class="input-tips">
							<div class="minus-tip"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="5" viewBox="0 0 8 5" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M7.77214 0.263502C7.99197 0.483327 7.99197 0.839735 7.77214 1.05956L4.77002 4.06168C4.55019 4.28151 4.19379 4.28151 3.97396 4.06168L0.971837 1.05956C0.752011 0.839734 0.752011 0.483327 0.971837 0.263502C1.19166 0.0436762 1.54807 0.0436762 1.76789 0.263502L4.37199 2.8676L6.97608 0.263502C7.19591 0.0436764 7.55232 0.0436764 7.77214 0.263502Z" fill="black"/></svg></div>
							<input id="total_tip" class="total_tip" type="number" name="total_tip" value="1" min="1" step="1" readonly>
							<div class="plus-tip"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="5" viewBox="0 0 8 5" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M0.971998 4.21672C0.752173 3.9969 0.752173 3.64049 0.971998 3.42066L3.97412 0.41854C4.19395 0.198715 4.55035 0.198715 4.77018 0.41854L7.7723 3.42066C7.99213 3.64049 7.99213 3.9969 7.7723 4.21672C7.55248 4.43655 7.19607 4.43655 6.97625 4.21672L4.37215 1.61263L1.76806 4.21672C1.54823 4.43655 1.19182 4.43655 0.971998 4.21672Z" fill="black"/></svg></div>
							<input type="hidden" class="nominal-tip" value="<?php echo esc_attr( $price ); ?>">
							<input type="hidden" class="currency-tip" value="<?php echo esc_attr( $currency ); ?>">
							<input type="hidden" class="thanks-tip" value="<?php echo esc_attr( $thegoodplugin_button_after_text ); ?>">
						</div>
						<div class="button-tips">
							<button class="btn-tips" type="button" style="background-color: <?php echo esc_attr( $button_color ); ?>;border-color:<?php echo esc_attr( $button_color ); ?>;"><?php echo esc_html( $thegoodplugin_button_text ); ?> <span class="nominal-text"><?php echo '('.esc_html( $show_tip.')' ); ?></span></button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

	<?php
}

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	add_action( 'woocommerce_checkout_order_review', 'thegoodplugin_html_tips', 11 );

}


if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	add_action( 'woocommerce_review_order_before_payment', 'thegoodplugin_hidden_field' );

	function thegoodplugin_hidden_field() {

		$chosen = WC()->session->get( 'nominal_tip' );
		$chosen = empty( $chosen ) ? WC()->checkout->get_value( 'nominal_tip' ) : $chosen;
		$chosen = empty( $chosen ) ? '0' : '0';

		$args = array(
		'type' => 'number',
		'class' => array( 'form-row-wide', 'hidden_nominal_tip' ));

		woocommerce_form_field( 'nominal_tip', $args, $chosen);
	}

	add_action( 'woocommerce_checkout_update_order_review', 'thegoodplugin_hidden_field_set_session' );

	function thegoodplugin_hidden_field_set_session( $posted_data ) {
		parse_str( $posted_data, $output );
		if ( isset( $output['nominal_tip'] ) ){
			WC()->session->set( 'nominal_tip', $output['nominal_tip'] );
		}
	}
}

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	/**
	 * Modify cart price with fees.
	 *
	 * @param string $cart get the item from cart.
	 */
	function thegoodplugin_add_tip_to_cart( $cart ) {

		if ( is_admin() && ! defined( 'DOING_AJAX' ) || ! is_checkout() ) return;

		$thegoodplugin_style_choice = carbon_get_theme_option( 'thegoodplugin_style_choice' );
		$thegoodplugin_button_text  = carbon_get_theme_option( 'thegoodplugin_button_text' );

		$thegoodplugin_emoji_icon     = carbon_get_theme_option( 'thegoodplugin_emoji_icon' );
		$thegoodplugin_amount            = carbon_get_theme_option( 'thegoodplugin_amount' );

		$price        = '5';
		if ( ! empty( $thegoodplugin_amount ) ) {
			$price = $thegoodplugin_amount;
		}

		$total_sum_tip = WC()->session->get( 'nominal_tip' );

		if ( $total_sum_tip ) {
			$cart->add_fee( $thegoodplugin_button_text, + ( $total_sum_tip * $price ) );
		}
	}
	add_action( 'woocommerce_cart_calculate_fees', 'thegoodplugin_add_tip_to_cart', 20, 1 );
}

/**
 * Add value to custom database.
 *
 * @param string $order_id get the order id from current session cart.
 */
function thegoodplugin_add_records( $order_id ) {

	global $wpdb;

	if ( ! $order_id )
		return;

	$the_order = wc_get_order( $order_id );

	$thegoodplugin_emoji_icon     = carbon_get_theme_option( 'thegoodplugin_emoji_icon' );
	$thegoodplugin_amount            = carbon_get_theme_option( 'thegoodplugin_amount' );

	$price        = '5';
	if ( ! empty( $thegoodplugin_amount ) ) {
		$price = $thegoodplugin_amount;
	}

	foreach ( $the_order->get_items( 'fee' ) as $item_id => $item_fee ) {

		// The fee name.
		$fee_name = $item_fee->get_name();

		// The fee total amount.
		$fee_total = $item_fee->get_total();

		// The fee total tax amount.
		$fee_total_tax = $item_fee->get_total_tax();

		$total_tip = $fee_total / $price;

		$time_tip = strtotime( date( 'd-m-Y' ) );

		$order_exist = $wpdb->get_row( "SELECT order_id FROM {$wpdb->prefix}thegoodplugin_tips WHERE order_id = $order_id");

		if ( empty( $order_exist ) ) {
			$fee_total = sanitize_text_field( $fee_total );
			$wpdb->insert(
				$wpdb->prefix . 'thegoodplugin_tips',
				array(
					'order_id'  => sanitize_text_field( $order_id ),
					'tip_value' => sanitize_text_field( $fee_total ),
					'total_tip' => sanitize_text_field( $total_tip ),
					'tip_time'  => sanitize_text_field( $time_tip ),
				)
			);
		}
	}
}
add_action( 'woocommerce_thankyou', 'thegoodplugin_add_records', 10, 1 );

function thegoodplugin_change_filter_f() {
	global $wpdb;
	$tip_time = $_REQUEST['tiptime'];

	if ( 'today' === $tip_time ) {
		$thegoodplugin_time = strtotime( date( 'd-m-Y' ) );
		$thegoodplugin_tips = $wpdb->get_results( "SELECT tip_value,order_id,tip_type,total_tip FROM {$wpdb->prefix}thegoodplugin_tips WHERE tip_time = '$thegoodplugin_time'", ARRAY_A );
	} elseif ( 'days7' === $tip_time ) {
		$thegoodplugin_time = strtotime( '-7 days' );
		$thegoodplugin_tips = $wpdb->get_results( "SELECT tip_value,order_id,tip_type,total_tip FROM {$wpdb->prefix}thegoodplugin_tips WHERE tip_time >= '$thegoodplugin_time'", ARRAY_A );
	} elseif ( 'days30' === $tip_time ) {
		$thegoodplugin_time = strtotime( '-30 days' );
		$thegoodplugin_tips = $wpdb->get_results( "SELECT tip_value,order_id,tip_type,total_tip FROM {$wpdb->prefix}thegoodplugin_tips WHERE tip_time >= '$thegoodplugin_time'", ARRAY_A );
	} elseif ( 'all' === $tip_time ) {
		$thegoodplugin_tips = $wpdb->get_results( "SELECT tip_value,order_id,tip_type,total_tip FROM {$wpdb->prefix}thegoodplugin_tips", ARRAY_A );
	}

	$thegoodplugin_total_tips  = array();
	$thegoodplugin_total_value = array();

	foreach ( $thegoodplugin_tips as $tip ) {
		$thegoodplugin_total_donate[] = $tip['total_tip'];
		$thegoodplugin_total_value[]  = $tip['tip_value'];

		if ( 'first' === $tip['tip_type'] ) {
			$thegoodplugin_total_donate_coffe[] = $tip['total_tip'];
		}
	}

	if ( ! empty( $thegoodplugin_total_donate ) ) {
		$thegoodplugin_tips_donate = array_sum( $thegoodplugin_total_donate );
	} else {
		$thegoodplugin_tips_donate = '0';
	}

	if ( ! empty( $thegoodplugin_total_value ) ) {
		$thegoodplugin_tips_value = array_sum( $thegoodplugin_total_value );
	} else {
		$thegoodplugin_tips_value = '0';
	}

	$thegoodplugin_total_donation = count( $thegoodplugin_tips );

	$thegoodplugin_emoji_icon = carbon_get_theme_option( 'thegoodplugin_emoji_icon' );
	$thegoodplugin_clients    = '🤗';

	if ( class_exists( 'WooCommerce' ) ) {
		$currency = get_woocommerce_currency_symbol();
	} else {
		$currency = '$';
	} ?>

	<div class="box-stats total-tips">
		<div class="box-wrapper">
			<div class="box-img-icon">
				<h4 class="emoji-icon"><?php echo esc_html( $thegoodplugin_emoji_icon ); ?></h4>
			</div>
			<div class="box-info">
				<h3 class="box-title total-donate"><?php echo esc_html( $thegoodplugin_tips_donate ); ?></h3>
				<h5 class="box-subtitle total-gain"><?php echo esc_html( $currency ) . esc_html( $thegoodplugin_tips_value ); ?></h5>
			</div>
		</div>
	</div>
	<div class="box-stats total-customer">
		<div class="box-wrapper">
			<div class="box-img-icon">
				<h4 class="emoji-icon"><?php echo wp_specialchars_decode( $thegoodplugin_clients ); ?></h4>
			</div>
			<div class="box-info">
				<h3 class="box-title"><?php echo esc_html( $thegoodplugin_total_donation ); ?></h3>
				<h5 class="box-subtitle"><?php echo esc_html__( 'Customers', 'tips-donations-woo' ); ?></h5>
			</div>
		</div>
	</div>

	<?php
	exit();
}
