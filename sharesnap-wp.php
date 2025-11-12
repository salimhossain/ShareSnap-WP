<?php
/**
 * Plugin Name: ShareSnap WP
 * Plugin URI: https://github.com/salimhossain/ShareSnap-WP
 * Description: Instantly create 1200×1200 social media–ready posters from your WordPress posts — perfect for Facebook, Instagram, X (Twitter), and LinkedIn.
 * Version: 1.0.0
 * Requires at least: 5.0
 * Requires PHP: 7.2
 * Author: Salim Hossain
 * Author URI: https://github.com/salimhossain
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: sharesnap-wp
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Currently plugin version.
 */
define( 'SHARESNAP_WP_VERSION', '1.0.0' );

/**
 * Define plugin constants.
 */
define( 'SHARESNAP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SHARESNAP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'SHARESNAP_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 */
function activate_sharesnap_wp() {
    require_once SHARESNAP_PLUGIN_DIR . 'includes/class-sharesnap-wp-activator.php';
    ShareSnap_WP_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_sharesnap_wp() {
    require_once SHARESNAP_PLUGIN_DIR . 'includes/class-sharesnap-wp-deactivator.php';
    ShareSnap_WP_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_sharesnap_wp' );
register_deactivation_hook( __FILE__, 'deactivate_sharesnap_wp' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require SHARESNAP_PLUGIN_DIR . 'includes/class-sharesnap-wp.php';

/**
 * Begins execution of the plugin.
 */
function run_sharesnap_wp() {
    $plugin = new ShareSnap_WP();
    $plugin->run();
}
run_sharesnap_wp();