<?php
/**
 * Define the internationalization functionality
 *
 * @link       https://github.com/salimhossain
 * @since      1.0.0
 *
 * @package    ShareSnap_WP
 * @subpackage ShareSnap_WP/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    ShareSnap_WP
 * @subpackage ShareSnap_WP/includes
 * @author     Salim Hossain
 */
class ShareSnap_WP_i18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain(
			'sharesnap-wp',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	}
}