<?php
/*
Plugin Name: Remove Query Strings
Plugin URI: https://www.littlebizzy.com/plugins/remove-query-strings
Description: Removes all query strings from static resources meaning that proxy servers and beyond can better cache your site content (plus, better SEO scores).
Version: 1.3.0
Author: LittleBizzy
Author URI: https://www.littlebizzy.com
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Prefix: RMQRST
*/

// Admin Notices module
require_once dirname(__FILE__).'/admin-notices.php';
RMQRST_Admin_Notices::instance(__FILE__);

/**
 * Admin Notices Multisite check
 * Uncomment //return to disable this plugin on Multisite installs
 */
require_once dirname(__FILE__).'/admin-notices-ms.php';
if (false !== \LittleBizzy\RemoveQueryStrings\Admin_Notices_MS::instance(__FILE__)) {
	//return;
}

// Block direct calls
if (!function_exists('add_action'))
	die;

// Plugin constants
define('RMQRST_FILE', __FILE__);
define('RMQRST_PATH', dirname(RMQRST_FILE));
define('RMQRST_VERSION', '1.3.0');

/* WP hooks */

// Filters for static style and script loaders
add_filter('style_loader_src',  'rmqrst_loader_src');
add_filter('script_loader_src', 'rmqrst_loader_src');

// Load front filter class
function rmqrst_loader_src($src) {
	require_once(RMQRST_PATH.'/remove-query-strings-filter.php');
	return RMQRST_Front_Filter::loader_src($src);
}
