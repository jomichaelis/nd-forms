<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       jomichaelis.de
 * @since      1.0.0
 *
 * @package    ND_Forms
 * @subpackage ND_Forms/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    ND_Forms
 * @subpackage ND_Forms/admin
 * @author     Jo Michaelis
 */
class ND_Forms_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in ND_Forms_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The ND_Forms_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/sf-chronik-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in ND_Forms_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The ND_Forms_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/sf-chronik-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function include_menu() {
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/nd-forms-menu.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/views/tabs/lulags/form-handler.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/views/tabs/lulags/list-table.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/views/tabs/lulags/functions.php';
		new ND_Forms_Menu();
	}
	/*
	public function include_lulags_submenu() {
		include plugin_dir_path(dirname(__FILE__)) . 'admin/partials/lulags/submenu.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/chronik/tabs/ereignisse/form-handler.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/chronik/tabs/ereignisse/list-table.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/chronik/tabs/ereignisse/functions.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/chronik/tabs/jahrestitel/form-handler.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/chronik/tabs/jahrestitel/list-table.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/chronik/tabs/jahrestitel/functions.php';
		new ND_Forms_Submenu();
	}
	*/
}
