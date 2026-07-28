<?php
/**
 * Simple Activation Class.
 *
 * @package  RM_PODCAST
 */

namespace RM_PODCAST\Base;

/**
 * Activate Class.
 */
class Activate {
	/**
	 * Hooked for Activate inside Plugin.
	 *
	 * @return void
	 */
	public static function activate() {
		flush_rewrite_rules();
	}
}
