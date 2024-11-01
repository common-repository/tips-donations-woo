<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://thegoodplugin.com/
 * @since      1.0.0
 *
 * @package    Thegoodplugin
 * @subpackage Thegoodplugin/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php
global $wpdb;
$thegoodplugin_time = strtotime( date( 'd-m-Y' ) );
$thegoodplugin_tips = $wpdb->get_results( "SELECT tip_value,order_id,tip_type,total_tip FROM {$wpdb->prefix}thegoodplugin_tips WHERE tip_time = '$thegoodplugin_time'", ARRAY_A );

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

if ( class_exists( 'WooCommerce' ) ) {
	$currency = get_woocommerce_currency_symbol();
} else {
	$currency = '$';
}

$thegoodplugin_clients = '🤗';
?>
<div class="tipmore-analytic">
	<div class="stat-head">
		<h3 class="stat-head-title"><?php echo esc_html__( 'Stats', 'tips-donations-woo' ); ?></h3>
		<div class="tip-filter">
			<select name="tipfilter" id="tipfilter">
				<option value="today"><?php echo esc_html__( 'Today', 'tips-donations-woo' ); ?></option>
				<option value="days7"><?php echo esc_html__( '7 days', 'tips-donations-woo' ); ?></option>
				<option value="days30"><?php echo esc_html__( '30 days', 'tips-donations-woo' ); ?></option>
				<option value="all"><?php echo esc_html__( 'All time', 'tips-donations-woo' ); ?></option>
			</select>
		</div>
	</div>
	<div class="stats-table">
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
	</div>
</div>
