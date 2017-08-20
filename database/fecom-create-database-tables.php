<?php


    global $jal_db_version;
    $jal_db_version = '1.0';

    function jal_install() {
    	global $wpdb;
    	global $jal_db_version;

    	$table_name = $wpdb->prefix . 'fecom_product';

    	$charset_collate = $wpdb->get_charset_collate();

    	$sql = "CREATE TABLE $table_name (
    		id mediumint(9) NOT NULL AUTO_INCREMENT,
    		price mediumint(9) NOT NULL,
            stock bool DEFAULT 0,
            situation bool DEFAULT 0,
    		name tinytext NOT NULL,
    		explanation text NOT NULL,
    		PRIMARY KEY  (id)
    	) $charset_collate;";

    	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    	dbDelta( $sql );

    	add_option( 'jal_db_version', $jal_db_version );
    }

?>
