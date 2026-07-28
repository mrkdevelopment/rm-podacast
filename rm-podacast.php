<?php
/**
 * Plugin Name:     Rankmath Podcast Post Type
 * Plugin URI:      https://www.mrkwp.com
 * Description:     A Post Type and Block Toolset for the management of podcast inside WordPress. Requires Rankmath.
 * Author:          M R K WP
 * Author URI:      https://www.mrkwp.com
 * Text Domain:     rm-podacast
 * Domain Path:     /languages
 * Version:         1.0.0
 *
 * @package RM_PODCAST
 */

// If this file is called firectly, abort!!!
defined( 'ABSPATH' ) || die( 'No Access!' );

define( 'RM_PODCAST_VERSION', '1.0.0' );

// Require once the Composer Autoload.
if ( file_exists( __DIR__ . '/lib/autoload.php' ) ) {
	require_once __DIR__ . '/lib/autoload.php';
}


/**
 * The code that runs during plugin activation.
 *
 * @return void
 */
function activate_rm_podcast_plugin() {
	RM_PODCAST\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_rm_podcast_plugin' );

/**
 * The code that runs during plugin deactivation.
 *
 * @return void
 */
function deactivate_rm_podcast_plugin() {
	RM_PODCAST\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_rm_podcast_plugin' );

/**
 * Initialize all the core classes of the plugin.
 */
if ( class_exists( 'RM_PODCAST\\Init' ) ) {
	RM_PODCAST\Init::register_services();
}
