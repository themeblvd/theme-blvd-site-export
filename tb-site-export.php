<?php
/*
Plugin Name: Theme Blvd Site Export
Description: This plugin exports some key site configuration settings that don't get exported via WordPress's Export tool.
Version: 1.0.0
Author: Theme Blvd
Author URI: http://themeblvd.com
License: GPL2

    Copyright 2014 Theme Blvd

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License version 2,
    as published by the Free Software Foundation.

    You may NOT assume that you can use any other version of the GPL.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    The license for this software can likely be found here:
    http://www.gnu.org/licenses/gpl-2.0.html

*/

define( 'TB_SITE_EXPORT_PLUGIN_VERSION', '1.0.0' );
define( 'TB_SITE_EXPORT_PLUGIN_DIR', dirname( __FILE__ ) );
define( 'TB_SITE_EXPORT_PLUGIN_URI', plugins_url( '' , __FILE__ ) );

/**
 * Run site export plugin
 *
 * @since 1.0.0
 */
function themeblvd_site_export_init() {

	if ( ! is_admin() ) {
		return;
	}

	global $_themeblvd_site_options;
	global $_themeblvd_export_widgets;
	global $_themeblvd_export_theme_options;

	// Include required classes
	if ( ! class_exists('Theme_Blvd_Export') ) {
		include_once( TB_SITE_EXPORT_PLUGIN_DIR . '/inc/class-tb-export.php' );
	}

	// Include required classes
	include_once( TB_SITE_EXPORT_PLUGIN_DIR . '/inc/class-tb-site-export-admin.php' );
	include_once( TB_SITE_EXPORT_PLUGIN_DIR . '/inc/class-tb-export-site-options.php' );
	include_once( TB_SITE_EXPORT_PLUGIN_DIR . '/inc/class-tb-export-widgets.php' );

	// Setup admin page
	$admin = Theme_Blvd_Site_Export_Admin::get_instance();

	// Setup export actions
	$base_url = $admin->get_base_url();

	// Export site settings
	$args = array(
		'filename' => 'site-settings.xml',
		'base_url' => $base_url
	);
	$_themeblvd_site_options = new Theme_Blvd_Export_Site_Options( 'site_settings', $args );

	// Export site widgets
	$args = array(
		'filename' => 'site-widgets.xml',
		'base_url' => $base_url
	);
	$_themeblvd_export_widgets = new Theme_Blvd_Export_Widgets( 'site_widgets', $args );

	// Export theme options
	$args = array(
		'filename' => 'theme-settings.xml',
		'base_url' => $base_url
	);
	$_themeblvd_export_theme_options = new Theme_Blvd_Export_Options( themeblvd_get_option_name(), $args );

}
add_action( 'after_setup_theme', 'themeblvd_site_export_init' ); // We need class Theme_Blvd_Export from theme framework