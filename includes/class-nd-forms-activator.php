<?php

/**
 * Fired during plugin activation
 *
 * @link       jomichaelis.de
 * @since      1.0.0
 *
 * @package    ND_Forms
 * @subpackage ND_Forms/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    ND_Forms
 * @subpackage ND_Forms/includes
 * @author     Jo Michaelis
 */
class ND_Forms_Activator {

	public static function activate() {
		self::create_table_nd_forms_lulags();
	}

	private static function create_table_nd_forms_lulags() {
		global $wpdb;
		$table_name = $wpdb->prefix."nd_forms_lulags";
		$charset_collate = $wpdb->get_charset_collate();
		$sql = "CREATE TABLE IF NOT EXISTS $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
  			status tinyint NOT NULL DEFAULT 0,
    		published tinyint NOT NULL DEFAULT 0,
  			title text NOT NULL DEFAULT '',
  			description text NOT NULL DEFAULT '',
    		event_type tinyint NOT NULL DEFAULT 0,
  			group_type text NOT NULL DEFAULT '',
    		attendees tinyint NOT NULL DEFAULT 0,
    		host_name text NOT NULL DEFAULT '',,
    		host_mail text NOT NULL DEFAULT '',,
    		host_stamm text NOT NULL DEFAULT '',,
  			PRIMARY KEY  (id)
		) $charset_collate;";
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}
}