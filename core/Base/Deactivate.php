<?php
/**
 * Deactivate Class.
 *
 * @package  RM_PODCAST
 */

namespace RM_PODCAST\Base;

/**
 * Deactivate Class
 */
class Deactivate {
	/**
	 * Static function for Deactivate.
	 *
	 * @return void
	 */
	public static function deactivate() {
		flush_rewrite_rules();
	}
}
