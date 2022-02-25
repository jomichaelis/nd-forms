<?php

/**
 * Fired during plugin uninstallation.
 *
 * This class defines all code necessary to run during the plugin's uninstallation.
 *
 * @since      1.0.0
 * @package    ND_Forms
 * @subpackage ND_Forms/includes
 * @author     Jo Michaelis
 */
class ND_Forms_Uninstaller {

	/**
	 * Public function to trigger at plugin uninstallation.
	 *
	 * @since    1.0.0
	 */
	public static function uninstall() {
		// If uninstall not called from WordPress, then exit.
		if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
			exit;
		}
		global $wpdb;
		$table_name = $wpdb->prefix . "nd_forms_lulags";
		$sql = "DROP TABLE IF EXISTS $table_name";
		$wpdb->query($sql);
	}
}
