<?php
/**
 * Base Controller is used as a master class to store various reused functions and data for the Plugin.
 *
 * @package RM_PODCAST
 *
 * update 1.0.0 - Initial development and release.
 */

namespace RM_PODCAST\Base;

/**
 * Base controller class.
 */
class BaseController {

	/**
	 * The plugin path
	 *
	 * @var [type]
	 */
	public $plugin_path;

	/**
	 * Plugin URL
	 *
	 * @var [type]
	 */
	public $plugin_url;

	/**
	 * Plugin reference for the name of the plugin.
	 *
	 * @var [type]
	 */
	public $plugin;

	/**
	 * Construct for Base Controller.
	 */
	public function __construct() {

		$this->plugin_path = plugin_dir_path( dirname( __DIR__, 1 ) );
		$this->plugin_url  = plugin_dir_url( dirname( __DIR__, 1 ) );
		$this->plugin      = plugin_basename( dirname( __DIR__, 2 ) ) . '/rm-podacast.php';
	}
}
