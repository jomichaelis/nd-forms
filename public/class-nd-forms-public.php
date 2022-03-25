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

	/**
	 * Register the JavaScript for the public area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		// wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/nd-forms-lulags-public.js', array( 'jquery' ), $this->version, false );
		wp_deregister_script('jquery');
		wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', array(), null, false);
		wp_enqueue_script('jquery-validate', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js', array(), null, false);
	}

	public function process_lulags() {
		include( plugin_dir_path( dirname( __FILE__ ) ) . 'ajax/process_lulags_form.php' );
	}

	public function register_shortcodes() {
		add_shortcode( 'nd_forms_lulags_table', array( $this, 'shortcode_nd_forms_lulags_table') );
		add_shortcode( 'nd_forms_lulags_form', array( $this, 'shortcode_nd_forms_lulags_form') );
		add_shortcode( 'nd_forms_lulags_form_protected', array( $this, 'shortcode_nd_forms_lulags_form_protected') );
		add_shortcode( 'nd_forms_ajax_form', array( $this, 'shortcode_nd_forms_ajax_form') );
	}

	public function shortcode_nd_forms_lulags_table() {
		ob_start();
		include( plugin_dir_path( __FILE__ ) . 'partials/shortcode-nd-forms-lulags-table.php' );
		return ob_get_clean();
	}

	public function shortcode_nd_forms_lulags_form() {
		ob_start();
		include( plugin_dir_path( __FILE__ ) . 'partials/shortcode-nd-forms-lulags-form.php' );
		return ob_get_clean();
	}

	public function shortcode_nd_forms_lulags_form_protected() {
		ob_start();
		include( plugin_dir_path( __FILE__ ) . 'partials/shortcode-nd-forms-lulags-table-protected.php' );
		return ob_get_clean();
	}

	public function shortcode_nd_forms_ajax_form() {
		readfile( plugin_dir_path( __FILE__ ) . 'partials/shortcode-nd-forms-ajax-form.html'  );
	}

}
