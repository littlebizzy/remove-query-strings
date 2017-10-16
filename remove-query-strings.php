<?php
/*
Plugin Name: Remove Query Strings
Plugin URI: https://www.littlebizzy.com/
Description: Remove Query Strings
Version: 1.1
Author: LittleBizzy
Author URI: https://www.littlebizzy.com

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

Copyright 2017 by LittleBizzy

*/


/* Initialization */

// Avoid script calls via plugin URL
if (!function_exists('add_action'))
	die;

// This plugin constants
define('RMQRST_FILE', __FILE__);
define('RMQRST_PATH', dirname(RMQRST_FILE));
define('RMQRST_VERSION', '1.1');

// Quick context check
if (is_admin())
	return;


/* WP hooks */

// Filters for static style and script loaders
add_filter('style_loader_src',  'rmqrst_loader_src');
add_filter('script_loader_src', 'rmqrst_loader_src');

// Load front filter class
function rmqrst_loader_src($src) {
	require_once(RMQRST_PATH.'/remove-query-strings-filter.php');
	return RMQRST_Front_Filter::loader_src($src);
}