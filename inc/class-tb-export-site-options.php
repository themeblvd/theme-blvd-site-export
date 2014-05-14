<?php
/**
 * Export key site options by extending the
 * Theme_Blvd_Export which holds the basic structure
 * for exporting.
 *
 * 1. Site name/description
 * 2. Assigned menus
 * 3. Settings > Reading > Frontpage displays
 * 4. Settings > Reading > Blog pages show at most
 *
 * See Theme_Blvd_Export class documentation at
 * /framework/tools/tb-class-export.php
 *
 * @author		Jason Bobich
 * @copyright	Copyright (c) Jason Bobich
 * @link		http://jasonbobich.com
 * @link		http://themeblvd.com
 * @package 	Theme Blvd WordPress Framework
 */
class Theme_Blvd_Export_Site_Options extends Theme_Blvd_Export {

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param string $id A unique ID for this exporter
	 */
	public function __construct( $id, $args = array() ) {
		parent::__construct( $id, $args );
	}

	/**
	 * Output content to be exported.
	 *
	 * @since 1.0.0
	 */
	public function export() {

		// Static frontpage
		$frontpage = get_option('page_on_front');

		if ( $frontpage && $frontpage != '0' ) {
			$frontpage = get_post($frontpage);
			$frontpage = $frontpage->post_name;
		} else {
			$frontpage = '';
		}

		// Posts page
		$blogpage = get_option('page_for_posts');

		if ( $blogpage && $blogpage != '0' ) {
			$blogpage = get_post($blogpage);
			$blogpage = $blogpage->post_name;
		} else {
			$blogpage = '';
		}

		// General site settings we'll need
		$settings = array(
			'blogname' 			=> get_option('blogname'),
			'blogdescription' 	=> get_option('blogdescription'),
			'posts_per_page'	=> get_option('posts_per_page'),
			'show_on_front'		=> get_option('show_on_front'),
			'page_on_front'		=> $frontpage,
			'page_for_posts'	=> $blogpage
		);

		// Nav menus
		$menu_locations = get_theme_mod( 'nav_menu_locations' );

		// Output the XML file content
		if ( $menu_locations ) {
			include_once( TB_SITE_EXPORT_PLUGIN_DIR . '/inc/export-site-options.php' );
		}
	}

}