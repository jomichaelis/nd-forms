<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              jomichaelis.de
 * @since             1.0.1
 * @package           ND_Forms
 *
 * @wordpress-plugin
 * Plugin Name:       ND-Forms
 * Plugin URI:        https://github.com/jomichaelis/nd-forms
 * Description:       Plugin zur Anzeige und Erfassung von Programmangeboten rund um die Bundesfahrt 2022.
 * Version:           1.0.0
 * Author:            Jo Michaelis
 * Author URI:        jomichaelis.de
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       nd-forms
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
define( 'ND_FORMS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-nd-forms-activator.php
 */
function activate_nd_forms() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-nd-forms-activator.php';
	ND_Forms_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-nd-forms-deactivator.php
 */
function deactivate_nd_forms() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-nd-forms-deactivator.php';
	ND_Forms_Deactivator::deactivate();
}

/**
 * The code that runs during plugin uninstallation.
 * This action is documented in includes/class-nd-forms-uninstaller.php
 */
function uninstall_nd_forms() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-nd-forms-uninstaller.php';
	ND_Forms_Uninstaller::uninstall();
}

register_activation_hook( __FILE__, 'activate_nd_forms' );
register_deactivation_hook( __FILE__, 'deactivate_nd_forms' );
register_uninstall_hook( __FILE__, 'uninstall_nd_forms' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-nd-forms.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_nd_forms() {

	$plugin = new ND_Forms();
	$plugin->run();

}
run_nd_forms();
