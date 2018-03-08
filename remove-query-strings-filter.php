<?php

/**
 * Remove Query Strings - Front Filter class
 *
 * @package Remove Query Strings
 * @subpackage Remove Query Strings Front
 */
class RMQRST_Front_Filter {



	/**
	 * Handle URL loader filter
	 */
	public static function loader_src($src) {

		// Decomposes URL
		if (false !== ($url = @parse_url($src))) {

			// Check result array
			if (!empty($url) && is_array($url) && !empty($url['query'])) {

				// Extract arguments
				@parse_str($url['query'], $args);
				if (!empty($args) && is_array($args)) {

					// Remove arguments without value
					foreach ($args as $arg => $value) {
						if ('' === trim(''.$value))
							$src = remove_query_arg($arg, $src);
					}

					// Load unwanted args
					$unwanted_args = apply_filters('rmqrst_unwanted_args', self::get_unwanted_args(), $src);
					if (empty($unwanted_args) || !is_array($unwanted_args))
						return $src;

					// Enum URL args
					foreach ($args as $arg => $value) {

						// Check removable arg
						if (in_array($arg, $unwanted_args)) {

							// Remove avoiding agressive arg removing
							$src = remove_query_arg($arg, $src);
						}
					}
				}
			}
		}

		// Done
		return $src;
	}



	/**
	 * Check the wp-config.php constant REMOVE_QUERY_STRINGS_ARGS
	 * Example: define('REMOVE_QUERY_STRINGS_ARGS', 'ver,test,w');
	 */
	private static function get_unwanted_args() {

		// Local cache
		static $unwanted;
		if (isset($unwanted))
			return $unwanted;

		// Inspect wp-config.php constant
		if (defined('REMOVE_QUERY_STRINGS_ARGS')) {

			// Initialize user args
			$args_user = array();

			// Extract arguments
			$args_const = explode(',', REMOVE_QUERY_STRINGS_ARGS);
			foreach ($args_const as $arg) {
				$arg = trim($arg);
				if ('' !== $arg)
					$args_user[] = $arg;
			}
		}

		// Set result
		$unwanted = empty($args_user)? self::get_default_args() : $args_user;

		// Done
		return $unwanted;
	}



	/**
	 * Default remove query string arg
	 */
	private static function get_default_args() {
		return array('ver', 'version', 'v');
	}



}
