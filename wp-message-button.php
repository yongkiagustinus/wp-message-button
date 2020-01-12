<?php
/**
 * Plugin Name: WP Message Button
 * Plugin URI: https://88digital.co/plugins/wp-message-button/
 * Description: Display a chat button that link to popular messenger platform such as WhatsApp, Facebook Messenger, Telegram and Line. Customize the button and box design color, layout, positioning and show / hide in any page or post you like.
 * Version: 0.1.0
 * Author: smplWP
 * Author URI: https://88digital.co
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.en.html
 * Domain Path: /languages
 */

/*
 	Copyright (C) 2020 smplWP

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

if ( ! defined( 'ABSPATH' ) ) { die( 'Forbidden' ); }

define( 'WPMESSAGEBUTTON_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WPMESSAGEBUTTON_PLUGIN_URI', plugin_dir_url( __FILE__ ) );

require_once( WPMESSAGEBUTTON_PLUGIN_DIR . 'includes/class.wpmessagebutton.php' );
require_once( WPMESSAGEBUTTON_PLUGIN_DIR . 'includes/class.wpmessagebutton-widget.php' );

add_action( 'init', array( 'WPMessageButton', 'init' ) );

register_activation_hook( __FILE__, array( 'WPMessageButton', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'WPMessageButton', 'plugin_deactivation' ) );
register_uninstall_hook( __FILE__, array( 'WPMessageButton', 'plugin_uninstall' ) );

// Init in admin
if( is_admin() ){
	require_once( WPMESSAGEBUTTON_PLUGIN_DIR . 'includes/class.wpmessagebutton-admin.php' );
	require_once( WPMESSAGEBUTTON_PLUGIN_DIR . 'includes/class.wpmessagebutton-settings.php' );
	add_action( 'init', array( 'WPMessageButton_Admin', 'init' ) );
	add_action( 'admin_init', array( 'WPMessageButton_Settings', 'init' ) );
}