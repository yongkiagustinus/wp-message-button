<?php 

class WPMessageButton_Admin {

	private static $initiated = false;

	public static function init() {
		if ( ! self::$initiated ) {
			self::init_hooks();
		}
	}

	private static function init_hooks() {
		self::$initiated = true;
	
		add_action( 'admin_menu', array( 'WPMessageButton_Admin', 'register_admin_menu' ) );
		add_action( 'admin_enqueue_scripts', array( 'WPMessageButton_Widget', 'enqueue' ) );
	
	}

	/**
	 * Register admin menu
	 * 
	 * @static
	 */
	public static function register_admin_menu(){
		add_menu_page(
			__( 'WP Message Button Settings', 'wp-message-button' ),
			__( 'Message Button', 'wp-message-button' ),
			'manage_options',
			'wpmessagebutton',
			array( 'WPMessageButton_Settings', 'settings_page' ),
			'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA1MTIgNTEyIj48cGF0aCBmaWxsPSIjMjA4Q0VCIiBkPSJNNDUyLjEgNDlMNTIuMyAyNjUuM2MtNiAzLjMtNS42IDEyLjEuNiAxNC45bDY4LjIgMjUuN2M0IDEuNSA3LjIgNC41IDkgOC40bDUzIDEwOS4xYzEgNC44IDkuOSA2LjEgMTAgMS4ybC04LjEtOTAuMmMuNS02LjcgMy0xMyA3LjMtMTguMmwyMDcuMy0yMDMuMWMxLjItMS4yIDIuOS0xLjYgNC41LTEuMyAzLjQuOCA0LjggNC45IDIuNiA3LjZMMjI4IDMzOGMtNCA2LTYgMTEtNyAxOGwtMTAuNyA3Ny45Yy45IDYuOCA2LjIgOS40IDEwLjUgMy4zbDM4LjUtNDUuMmMyLjYtMy43IDcuNy00LjUgMTEuMy0xLjlsOTkuMiA3Mi4zYzQuNyAzLjUgMTEuNC45IDEyLjYtNC45TDQ2My44IDU4YzEuNS02LjgtNS42LTEyLjMtMTEuNy05eiIvPjwvc3ZnPg==',
			80
		);
	}

}