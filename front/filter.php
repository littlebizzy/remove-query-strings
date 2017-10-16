<?php

/**
 * Remove Query Strings - Front Filter class
 *
 * @package Remove Query Strings
 * @subpackage Remove Query Strings Front
 */
class RMQRST_Front_Filter {



	/**
	 * Script and style filters
	 */
	public static function start() {
		add_filter('style_loader_src',  array(__CLASS__, 'loader_src'));
		add_filter('script_loader_src', array(__CLASS__, 'loader_src'));
	}



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

					// Load disallowed args
					require_once(RMQRST_PATH.'/core/data.php');
					$disallowed_args = RMQRST_Core_Data::get_args();

					// Enum URL args
					foreach ($args as $arg => $value) {

						// Check removable arg
						if (in_array($arg, $disallowed_args)) {

							// Avoid agressive arg removing
							$src = remove_query_arg($arg, $src);
						}
					}
				}
			}
		}

		// Done
		return $src;
	}



}
