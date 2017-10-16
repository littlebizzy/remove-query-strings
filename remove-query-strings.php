<?php
/*
Plugin Name: Remove Query Strings
Plugin URI: https://www.littlebizzy.com/plugins/remove-query-strings
Description: Remove Query Strings
Version: 1.0
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
define('RMQRST_VERSION', '1.0');


/* Context hooks */

// Check context
if (is_admin()) {

	// Admin menu hook
	add_action('admin_menu', 'rmqrst_admin_menu');

	// Create item in options menu
	function rmqrst_admin_menu() {
		add_submenu_page('options-general.php', 'Remove Query Strings', 'Remove Query Strings', 'manage_options', 'remove-query-strings', 'rmqrst_admin_page');
	}

	// Admin page form
	function rmqrst_admin_page() {
		require_once(RMQRST_PATH.'/admin/form.php');
		RMQRST_Admin_Form::show();
	}

// Front
} else {

	// Front filter class
	require_once(RMQRST_PATH.'/front/filter.php');
	RMQRST_Front_Filter::start();
}


/* Activation hooks */

// Plugin activation
register_activation_hook(RMQRST_FILE, 'rmqrst_activation');
function rmqrst_activation() {
	require_once(RMQRST_PATH.'/core/data.php');
	RMQRST_Core_Data::activation();
}

// Plugin uninstall (aka remove)
register_uninstall_hook(RMQRST_FILE, 'rmqrst_uninstall');
function rmqrst_uninstall() {
	require_once(RMQRST_PATH.'/core/data.php');
	RMQRST_Core_Data::uninstall();
}