<?php
/*
Plugin Name: Remove Query Strings
Plugin URI: https://www.littlebizzy.com/plugins/remove-query-strings
Description: Removes all query strings from static resources meaning that proxy servers and beyond can better cache your site content (plus, better SEO scores).
Version: 1.2.2
Author: LittleBizzy
Author URI: https://www.littlebizzy.com
License: GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/


/* Initialization */

// Avoid script calls via plugin URL
if (!function_exists('add_action'))
	die;

// This plugin constants
define('RMQRST_FILE', __FILE__);
define('RMQRST_PATH', dirname(RMQRST_FILE));
define('RMQRST_VERSION', '1.2.2');

// Quick context check
if ( is_admin() ) {
	require_once( RMQRST_PATH.'/admin-suggestions.php' );
	RMQRST_Admin_Suggestions::instance();
	return;
}


/* WP hooks */

// Filters for static style and script loaders
add_filter('style_loader_src',  'rmqrst_loader_src');
add_filter('script_loader_src', 'rmqrst_loader_src');

// Load front filter class
function rmqrst_loader_src($src) {
	require_once(RMQRST_PATH.'/remove-query-strings-filter.php');
	return RMQRST_Front_Filter::loader_src($src);
}