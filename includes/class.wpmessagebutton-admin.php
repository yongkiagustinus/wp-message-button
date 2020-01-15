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
		add_action( 'admin_enqueue_scripts', array( 'WPMessageButton_Admin', 'enqueue' ), 90 );
	
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

	/**
	 * Enqueue scripts
	 * 
	 * @static
	 */
	public static function enqueue(){
		$screen = get_current_screen();

		// Call scripts only in WP Message Button page
		if( $screen->id == 'toplevel_page_wpmessagebutton' ){

			// Load WP Media
			wp_enqueue_media();

			// Load WP Color Picker
			wp_enqueue_style( 'wp-color-picker' ); 
			wp_enqueue_script( 'wp-color-picker' ); 

			wp_enqueue_style( 'wpmessagebutton-admin', WPMESSAGEBUTTON_PLUGIN_URI . 'admin/css/wpmessagebutton-admin.css', array(), '1.0', 'all' );
			
			// Load jQuery UI
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-accordion' );
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script( 'jquery-ui-datepicker' );

			wp_enqueue_script( 'wpmessagebutton-jquery-validation', WPMESSAGEBUTTON_PLUGIN_URI . 'admin/js/jquery.validate.min.js', array(), '1.19.1', true );
			wp_enqueue_script( 'wpmessagebutton-admin', WPMESSAGEBUTTON_PLUGIN_URI . 'admin/js/wpmessagebutton-admin.js', array(), '1.0', true );

			$vars['minimum_agent_notice']	= __( 'Cannot delete. You need to have minimum 1 agent', 'wp-message-button' );
			$vars['delete_confirmation'] 	= __( 'Are you sure want to delete?', 'wp-message-button' );
			$vars['input_time_invalid']	= __( 'Please enter a valid time, between 00:00 and 23:59', 'wp-message-button' );
			$vars['choose_image']			= __( 'Choose Image', 'wp-message-button' );
			wp_localize_script( 'wpmessagebutton-admin', 'wpmb_admin', $vars );
			
			WPMessageButton_Widget::enqueue();
		
		}
	}

}