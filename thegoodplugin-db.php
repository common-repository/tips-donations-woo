<?php

global $wpdb;
$charset_collate = $wpdb->get_charset_collate();
$thegoodplugin_db_version = '1.0.0';
$thegoodplugin_db_table_tip = $wpdb->prefix . 'thegoodplugin_tips';

$sql = "CREATE TABLE $thegoodplugin_db_table_tip (
	tips_id int(110) NOT NULL AUTO_INCREMENT,
	order_id varchar(200) NOT NULL,
	tip_value varchar(200) NOT NULL,
	total_tip varchar(200) NULL,
	tip_type varchar(200) NOT NULL,
	tip_time varchar(200) NOT NULL,
	UNIQUE KEY id (tips_id)
) $charset_collate;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );
add_option( 'thegoodplugin_db_version', $thegoodplugin_db_version );
