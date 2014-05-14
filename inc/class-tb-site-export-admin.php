<?php
/**
 * Setup up a basic admin page, which contains a button
 * to export site settings and widgets.
 *
 * @author		Jason Bobich
 * @copyright	Copyright (c) Jason Bobich
 * @link		http://jasonbobich.com
 * @link		http://themeblvd.com
 * @package 	Theme Blvd WordPress Framework
 */
class Theme_Blvd_Site_Export_Admin {

	/*--------------------------------------------*/
	/* Properties, private
	/*--------------------------------------------*/

	/**
	 * A single instance of this class.
	 *
	 * @since 1.0.0
	 */
	private static $instance = null;

	/**
	 * The base URL for the admin page
	 *
	 * @since 1.0.0
	 */
	private $base_url = '';


	/*--------------------------------------------*/
	/* Constructor
	/*--------------------------------------------*/

	/**
     * Creates or returns an instance of this class.
     *
     * @since 1.0.0
     *
     * @return Theme_Blvd_Site_Export_Admin A single instance of this class.
     */
	public static function get_instance() {

		if ( self::$instance == null ) {
            self::$instance = new self;
        }

        return self::$instance;
	}

	/**
	 * Constructor. Hook everything in.
	 *
	 * @since 2.3.0
	 */
	public function __construct() {

		$this->base_url = admin_url('tools.php?page=themeblvd-export-site');
		add_action( 'admin_menu', array( $this, 'add' ) );

	}

	/*--------------------------------------------*/
	/* Methods
	/*--------------------------------------------*/

	/**
	 * Add admin page to Tools > Export Site
	 *
	 * @since 1.0.0
	 */
	public function add() {
		$title = __('Export Site', 'themeblvd_export_site');
		add_management_page( $title, $title, 'export', 'themeblvd-export-site', array( $this, 'display' ) );
	}

	/**
	 * Display admin page
	 *
	 * @since 1.0.0
	 */
	public function display() {
		?>
		<div class="wrap">

			<h2><?php _e('Export Site', 'themeblvd_export_site'); ?></h2>
			<p><?php _e('This page allows you to export some items for moving your site that WordPress\'s built-in export functionality will not allow for.', 'themeblvd_export_site'); ?></p>

			<hr />

			<h3><?php _e('Site Settings', 'themeblvd_export_site'); ?></h3>
			<p><?php _e('This will export an XML file containing a few key site settings like your menu assignments and frontpage setting.', 'themeblvd_export_site'); ?></p>
			<p><a href="<?php echo $this->base_url.'&themeblvd_export_site_settings=true&security='.wp_create_nonce( 'themeblvd_export_site_settings' ); ?>" class="button-secondary"><?php _e( 'Export Site Settings', 'themeblvd_export_site' ); ?></a></p>

			<hr />

			<h3><?php _e('Widgets', 'themeblvd_export_site'); ?></h3>
			<p><?php _e('This will export an XML file containing your current setup of widgets.', 'themeblvd_export_site'); ?></p>
			<p><a href="<?php echo $this->base_url.'&themeblvd_export_site_widgets=true&security='.wp_create_nonce( 'themeblvd_export_site_widgets' ); ?>" class="button-secondary"><?php _e( 'Export Site Widgets', 'themeblvd_export_site' ); ?></a></p>

			<hr />

			<h3><?php _e('Theme Settings', 'themeblvd_export_site'); ?></h3>
			<p><?php _e('This will export an XML file of everything saved at <em>Appearance > Theme Options</em>.', 'themeblvd_export_site'); ?></p>
			<p><a href="<?php echo $this->base_url.'&themeblvd_export_'.themeblvd_get_option_name().'=true&security='.wp_create_nonce( 'themeblvd_export_'.themeblvd_get_option_name() ); ?>" class="button-secondary"><?php _e( 'Export Theme Settings', 'themeblvd_export_site' ); ?></a></p>

			<hr />

		</div>
		<?php
	}

	/**
	 * Get the base URL for this admin page
	 *
	 * @since 1.0.0
	 */
	public function get_base_url() {
		return $this->base_url;
	}
}