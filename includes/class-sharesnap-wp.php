<?php
/**
 * The file that defines the core plugin class
 * 
 * @link       https://github.com/salimhossain
 * @since      1.0.0
 * @package    ShareSnap_WP
 * @subpackage ShareSnap_WP/includes
 * @author     Salim Hossain
 */
class ShareSnap_WP {

	/**
	 * The loader that's responsible for maintaining and registering all hooks.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      ShareSnap_WP_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'SHARESNAP_WP_VERSION' ) ) {
			$this->version = SHARESNAP_WP_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'sharesnap-wp';

		$this->load_dependencies();
		$this->define_admin_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the core plugin.
		 */
		require_once SHARESNAP_PLUGIN_DIR . 'includes/class-sharesnap-wp-loader.php';

		/**
		 * The class responsible for defining all actions in the admin area.
		 */
		require_once SHARESNAP_PLUGIN_DIR . 'admin/class-sharesnap-wp-admin.php';

		$this->loader = new ShareSnap_WP_Loader();
	}

	/**
	 * Register all of the hooks related to the admin area functionality.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		$plugin_admin = new ShareSnap_WP_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_admin_menu' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_admin_menu' );
		// Plugin action links
		$this->loader->add_filter( 'plugin_action_links_' . SHARESNAP_PLUGIN_BASENAME, $plugin_admin, 'add_plugin_action_links' );
		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'add_meta_box' );
		
		// AJAX actions
		$this->loader->add_action( 'wp_ajax_sharesnap_save_settings', $plugin_admin, 'save_settings' );
		$this->loader->add_action( 'wp_ajax_sharesnap_reset_settings', $plugin_admin, 'reset_settings' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks.
	 *
	 * @since     1.0.0
	 * @return    ShareSnap_WP_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
}