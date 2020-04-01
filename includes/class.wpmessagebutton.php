<?php 
class WPMessageButton {
	
	private static $initiated = false;

	public static function init() {
		if ( ! self::$initiated ) {
			self::init_hooks();
		}
	}

	private static function init_hooks() {
		self::$initiated = true;
		self::load_textdomain();
		WPMessageButton_Widget::init();
	}

	/**
	 * Load plugin text domain
	 */
	public static function load_textdomain(){
		load_plugin_textdomain( 'wpmessagebutton', false, basename( WPMESSAGEBUTTON_PLUGIN_DIR ) . '/languages' );
	}

	/**
	 * Run on plugin activation

	 * @static
	 */
	public static function plugin_activation(){
		// Set default options
		update_option( 'wpmessagebutton_customizer', WPMessageButton_Settings::customizer_default() );		
	}

	/**
	 * Run on plugin uninstall
	 * 
	 * @static
	 */
	public static function plugin_uninstall(){
		// Delete plugin options
		delete_option( 'wpmessagebutton_agents' );
		delete_option( 'wpmessagebutton_customizer' );
	}

	/**
	 * Check if `WP Message Button Pro` is active
	 * 
	 * @return boolean
	 */
	public static function is_wpmb_pro_active(){
		if( ! is_admin() ){
			include_once( ABSPATH .'wp-admin/includes/plugin.php' );
		}
		return is_plugin_active( 'wp-message-button-pro/wp-message-button-pro.php' );
	}

}