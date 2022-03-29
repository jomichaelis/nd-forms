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
		self::cleanup();
		self::create_table_nd_forms_lulags();
		self::create_table_nd_forms_lulags_suggestions();
	}

	private static function cleanup() {
		global $wpdb;
		$table_name = $wpdb->prefix . "nd_forms_lulags";
		$sql = "DROP TABLE IF EXISTS $table_name";
		$wpdb->query($sql);
		$table_name = $wpdb->prefix . "nd_forms_lulags_suggestions";
		$sql = "DROP TABLE IF EXISTS $table_name";
		$wpdb->query($sql);
	}

	private static function create_table_nd_forms_lulags() {
		global $wpdb;
		$table_name = $wpdb->prefix."nd_forms_lulags";
		$charset_collate = $wpdb->get_charset_collate();
		$sql = "CREATE TABLE IF NOT EXISTS $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
  			suggestion mediumint(9) NOT NULL DEFAULT 0,
    		title text NOT NULL DEFAULT '',
  			description text NOT NULL DEFAULT '',
    		event_type tinyint NOT NULL DEFAULT 0,
  			altersstufe text NOT NULL DEFAULT '',
    		attendees tinyint NOT NULL DEFAULT 0,
  			material_notes text NOT NULL DEFAULT '',
    		host_name text NOT NULL DEFAULT '',
    		host_mail text NOT NULL DEFAULT '',
    		host_stamm text NOT NULL DEFAULT '',
  			PRIMARY KEY  (id)
		) $charset_collate;";
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}

	private static function create_table_nd_forms_lulags_suggestions() {
		global $wpdb;
		$table_name = $wpdb->prefix."nd_forms_lulags_suggestions";
		$charset_collate = $wpdb->get_charset_collate();
		$sql = "CREATE TABLE IF NOT EXISTS $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
    		published tinyint NOT NULL DEFAULT 0,
  			title text NOT NULL DEFAULT '',
  			description text NOT NULL DEFAULT '',
    		event_type tinyint NOT NULL DEFAULT 0,
  			altersstufe text NOT NULL DEFAULT '',
    		attendees tinyint NOT NULL DEFAULT 0,
  			material_notes text NOT NULL DEFAULT '',
  			PRIMARY KEY  (id)
		) $charset_collate;";
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}
}
