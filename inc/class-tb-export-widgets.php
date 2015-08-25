<?php
/**
 * Export widgets by extending the Theme_Blvd_Export,
 * which holds the basic structure for exporting.
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
class Theme_Blvd_Export_Widgets extends Theme_Blvd_Export {

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

		$sidebars = get_option( 'sidebars_widgets' );
		if ( is_array( $sidebars ) ) {
			$sidebars = base64_encode(maybe_serialize($sidebars));
		}

		$registered_widgets = array();

		if ( isset( $GLOBALS['wp_widget_factory'] ) ) {
			$registered_widgets = $GLOBALS['wp_widget_factory']->widgets;
		}

		$widgets = array();

		foreach ( $registered_widgets as $widget ) {

			$value = get_option( $widget->option_name );

			// For custom menu widget, save slug of menu, opposed to ID.
			if ( ( $widget->option_name == 'widget_nav_menu' || $widget->option_name == 'widget_themeblvd_horz_menu_widget' ) && is_array($value) ) {
				foreach ( $value as $key => $instance ) {
					if ( ! empty( $instance['nav_menu'] ) ) {
						$menu = get_term_by( 'id', $instance['nav_menu'], 'nav_menu' );
						if ( $menu ) {
							$value[$key]['nav_menu'] = $menu->slug;
						}
					}
				}
			}

			$widgets[$widget->option_name] = base64_encode(maybe_serialize($value));
		}

		// Output the XML file content
		include_once( TB_SITE_EXPORT_PLUGIN_DIR . '/inc/export-site-widgets.php' );

	}

}