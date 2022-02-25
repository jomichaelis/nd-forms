<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       jomichaelis.de
 * @since      1.0.0
 *
 * @package    ND_Forms
 * @subpackage ND_Forms/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    ND_Forms
 * @subpackage ND_Forms/public
 * @author     Jo Michaelis
 */
class ND_Forms_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function register_shortcodes() {
		add_shortcode( 'nd_forms_lulags_table', array( $this, 'shortcode_nd_forms_lulags_table') );
		add_shortcode( 'nd_forms_lulags_form', array( $this, 'shortcode_nd_forms_lulags_form') );
	}

	public function shortcode_nd_forms_lulags_table() {
		include( plugin_dir_path( __FILE__ ) . 'partials/shortcode-nd-forms-lulags-table.php' );
	}

	public function shortcode_nd_forms_lulags_form() {
		include( plugin_dir_path( __FILE__ ) . 'partials/shortcode-nd-forms-lulags-form.php' );
	}

}
