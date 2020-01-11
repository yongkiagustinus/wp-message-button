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

		add_action( 'wp_enqueue_scripts', array( 'WPMessageButton_Widget', 'enqueue' ) );
		
	}

	/**
	 * Run on plugin activation
	 * 
	 * Set default options
	 * 
	 * @static
	 */
	public static function plugin_activation(){
	}

	/**
	 * Run on plugin deactivation
	 * 
	 * Flush rewrite, removing scheduled event
	 * 
	 * @static
	 */
	public static function plugin_deactivation(){

	}

	/**
	 * Run on plugin uninstall
	 * 
	 * Cleaning options, remove custom DB tables
	 * 
	 * @static
	 */
	public static function plugin_uninstall(){

	}

	/**
	 * Check if `WP Message Button Pro` is active
	 * 
	 * @return boolean
	 */
	public static function is_wpmb_pro_active(){
		return is_plugin_active( 'wp-message-button-pro/wp-message-button-pro.php' );
	}

}