<?php

/**
 * Remove Query Strings - Core Data class
 *
 * @package Remove Query Strings
 * @subpackage Remove Query Strings Core
 */
class RMQRST_Core_Data {



	// Constants
	// ---------------------------------------------------------------------------------------------------



	// Option data
	const OPTION_KEY = 'rmqrst_args';



	// Data access
	// ---------------------------------------------------------------------------------------------------



	/**
	 * Save user input data
	 */
	public static function set_args($input) {

		// Initialize
		$args = array();

		// Uset data
		$input = trim($input);
		$input = str_replace(',', "\n", $input);
		$input = explode("\n", trim($input));

		// Sanitize line by line
		foreach ($input as $line) {
			$line = trim($line);
			if ('' !== $line)
				$args[] = $line;
		}

		// Save data
		update_option(self::OPTION_KEY, @json_encode($args), true);
	}



	/**
	 * Retrieve args data
	 */
	public static function get_args($cache = true) {

		// Local cache
		static $args;
		if ($cache && isset($args))
			return $args;

		// Retrieve option
		$args = @json_decode(get_option(self::OPTION_KEY), true);
		if (empty($args) || !is_array($args))
			$args = array();

		// Done
		return $args;
	}



	// Activation hooks
	// ---------------------------------------------------------------------------------------------------



	/**
	 * Plugin activation
	 */
	public static function activation() {
		$args = self::get_args();
		if (empty($args))
			self::set_args('ver');
	}



	/**
	 * Plugin uninstall
	 */
	public static function uninstall() {
		delete_option(self::OPTION_KEY);
	}



}
