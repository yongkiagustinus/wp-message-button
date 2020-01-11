<?php 

class WPMessageButton_Settings {
	
	public static function init(){
		
		// Agents settings
		register_setting( 'wpmessagebutton_agents', 'wpmessagebutton_agents', array( 'WPMessageButton_Settings', 'sanitize' ) );
			add_settings_section( 'section_agents', '', '', 'wpmessagebutton_agents' );
			add_settings_field( 'field_agents', __( 'Agents', 'wp-message-button' ), array( 'WPMessageButton_Settings', 'field_agents' ), 'wpmessagebutton_agents', 'section_agents' );

		// Customizer settings
		register_setting( 'wpmessagebutton_customizer', 'wpmessagebutton_customizer', array( 'WPMessageButton_Settings', 'sanitize' ) );
		
			add_settings_section( 'section_customizer_general', __( 'General', 'wp-message-button' ), '', 'wpmessagebutton_customizer' );
				add_settings_field( 'footer_text', __( 'Footer Text', 'wp-message-button' ), array( 'WPMessageButton_Settings', 'field_customizer_header' ), 'wpmessagebutton_customizer', 'section_customizer_general' );

			add_settings_section( 'section_customizer_header', __( 'Header', 'wp-message-button' ), '', 'wpmessagebutton_customizer' );
				add_settings_field( 'background', __( 'Background', 'wp-message-button' ), array( 'WPMessageButton_Settings', 'field_customizer_header' ), 'wpmessagebutton_customizer', 'section_customizer_header' );

			add_settings_section( 'section_customizer_footer', __( 'Footer', 'wp-message-button' ), '', 'wpmessagebutton_customizer' );
				add_settings_field( 'background', __( 'Background', 'wp-message-button' ), array( 'WPMessageButton_Settings', 'field_customizer_header' ), 'wpmessagebutton_customizer', 'section_customizer_footer' );

		// Visibility Settings
		if( WPMessageButton::is_wpmb_pro_active() ){
			WPMessageButtonPro_Settings::register_visibility_settings();
		}

	}

	/**
	 * Field Agents
	 */
	public static function field_agents() { ?>
		<div id="agents">
			<div class="agent stuffbox">
				<div class="inside">
					<h2><input type="text" name="wpmessagebutton_agents[0][name]" placeholder="<?php echo esc_attr( __( 'Insert agent name here', 'wp-message-button' ) ); ?>" value="" required></h2>
					<div>
						<div class="wpmb-field">
							<label><?php echo __( 'Select channel for this agent', 'wp-message-button' ); ?></label>
							<div class="wpmb-radio"><input type="radio" name="wpmessagebutton_agents[0][channel]" id="agent-channel-1" value="wa" required><label for="agent-channel-1"><?php echo __( 'Whatsapp', 'wp-message-button' ); ?></label></div>
							<div class="wpmb-radio"><input type="radio" name="wpmessagebutton_agents[0][channel]" id="agent-channel-2" value="fb"><label for="agent-channel-2"><?php echo __( 'Facebook Messenger', 'wp-message-button' ); ?></label></div>
							<div class="wpmb-radio"><input type="radio" name="wpmessagebutton_agents[0][channel]" id="agent-channel-3" value="tg"><label for="agent-channel-3"><?php echo __( 'Telegram', 'wp-message-button' ); ?></label></div>
							<div class="wpmb-radio"><input type="radio" name="wpmessagebutton_agents[0][channel]" id="agent-channel-4" value="ln"><label for="agent-channel-4"><?php echo __( 'Line', 'wp-message-button' ); ?></label></div>
							<div class="wpmb-radio"><input type="radio" name="wpmessagebutton_agents[0][channel]" id="agent-channel-5" value="sk"><label for="agent-channel-5"><?php echo __( 'Skype', 'wp-message-button' ); ?></label></div>
							<div class="wpmb-radio"><input type="radio" name="wpmessagebutton_agents[0][channel]" id="agent-channel-6" value="ph"><label for="agent-channel-6"><?php echo __( 'Phone Call', 'wp-message-button' ); ?></label></div>
						</div>
						<div class="wpmb-row">
							<div class="wpmb-col-6">
								<div class="wpmb-field">
									<label for="agent-handle"><?php echo __( 'Username or Phone Number', 'wp-message-button' ); ?></label>
									<input type="text" name="wpmessagebutton_agents[0][handle]" autocomplete="off" placeholder="<?php echo esc_attr( __( 'Number or Username without url', 'wp-message-button' ) ); ?>" required>
									<p class="description"><?php echo __( 'For Whatsapp, please use country code without the "+".<br />Example: 1987654321 (US), 65987654321 (SG).', 'wp-message-button' ); ?></p>
								</div>
							</div>
							<div class="wpmb-col-6">
								<div class="wpmb-field field-message">
									<label for="agent-message"><?php echo __( 'Message', 'wp-message-button' ); ?></label>
									<textarea name="wpmessagebutton_agents[0][message]" placeholder="<?php echo esc_attr( __( 'Example: Hello, I need more information about your service.', 'wp-message-button' ) ); ?>"></textarea>
									<p class="description"><?php echo __( 'Predefind message currently only available in Whatsapp channel', 'wp-message-button' ); ?></p>
								</div>
							</div>
						</div>
						<div class="wpmb-field">
							<label for="agent-position"><?php echo __( 'Position', 'wp-message-button' ); ?></label>
							<input type="text" name="wpmessagebutton_agents[0][position]" autocomplete="off" placeholder="<?php echo esc_attr( __( 'Example: Customer Support or Billing or Technical Support', 'wp-message-button' ) ); ?>">
						</div>
						<div class="wpmb-field">
							<label><?php echo __( 'Availability Schedule (Leave all blank to hide the availability status)', 'wp-message-button' ); ?></label>
							<div class="wpmb-row">
								<div class="wpmb-col-3">
									<div class="wpmb-field">
										<label for="agent-availability-monday"><?php echo __( 'Monday', 'wp-message-button' ); ?></label>
										<div class="wpmb-field-timerange wp-clearfix">
											<input type="text" name="wpmessagebutton_agents[0][availability][monday][start]" placeholder="<?php echo esc_attr( 'hh:mm' ); ?>" minlength="5" maxlength="5" data-rule-time="true">
											<input type="text" name="wpmessagebutton_agents[0][availability][monday][end]" placeholder="<?php echo esc_attr( 'hh:mm' ); ?>" minlength="5" maxlength="5" data-rule-time="true">
										</div>
									</div>
								</div>
								<div class="wpmb-col-3">
									<div class="wpmb-field">
										<label for="agent-availability-tuesday"><?php echo __( 'Tuesday', 'wp-message-button' ); ?></label>
										<div class="wpmb-field-timerange wp-clearfix">
											<input type="text" name="wpmessagebutton_agents[0][availability][tuesday][start]" placeholder="<?php echo esc_attr( 'hh:mm' ); ?>" minlength="5" maxlength="5" data-rule-time="true">
											<input type="text" name="wpmessagebutton_agents[0][availability][tuesday][end]" placeholder="<?php echo esc_attr( 'hh:mm' ); ?>" minlength="5" maxlength="5" data-rule-time="true">
										</div>
									</div>
								</div>
								<div class="wpmb-col-3">
									<div class="wpmb-field">
										<label for="agent-availability-wednesday"><?php echo __( 'Wednesday', 'wp-message-button' ); ?></label>
										<div class="wpmb-field-timerange wp-clearfix">
											<input type="text" name="wpmessagebutton_agents[0][availability][wednesday][start]" placeholder="<?php echo esc_attr( 'hh:mm' ); ?>" minlength="5" maxlength="5" data-rule-time="true">
											<input type="text" name="wpmessagebutton_agents[0][availability][wednesday][end]" placeholder="<?php echo esc_attr( 'hh:mm' ); ?>" minlength="5" maxlength="5" data-rule-time="true">
										</div>
									</div>
								</div>
								<div class="wpmb-col-3">
									<div class="wpmb-field">
										<label for="agent-availability-thursday"><?php echo __( 'Thursday', 'wp-message-button' ); ?></label>
										<div class="wpmb-field-timerange wp-clearfix">
											<input type="text" name="wpmessagebutton_agents[0][availability][thursday][start]" placeholder="<?php echo esc_attr( 'hh:mm' ); ?>" minlength="5" maxlength="5" data-rule-time="true">
											<input type="text" name="wpmessagebutton_agents[0][availability][thursday][end]" placeholder="<?php echo esc_attr( 'hh:mm' ); ?>" minlength="5" maxlength="5" data-rule-time="true">
										</div>
									</div>
								</div>
							</div>
							<div class="wpmb-row">
								<div class="wpmb-col-3">
									<div class="wpmb-field">
										<label for="agent-availability-friday"><?php echo __( 'Friday', 'wp-message-button' ); ?></label>
										<div class="wpmb-field-timerange wp-clearfix">
											<input type="text" name="wpmessagebutton_agents[0][availability][friday][start]" placeholder="<?php echo esc_attr( 'hh:mm' ); ?>" minlength="5" maxlength="5" data-rule-time="true">
											<input type="text" name="wpmessagebutton_agents[0][availability][friday][end]" placeholder="<?php echo esc_attr( 'hh:mm' ); ?>" minlength="5" maxlength="5" data-rule-time="true">
										</div>
									</div>
								</div>
								<div class="wpmb-col-3">
									<div class="wpmb-field">
										<label for="agent-availability-saturday"><?php echo __( 'Saturday', 'wp-message-button' ); ?></label>
										<div class="wpmb-field-timerange wp-clearfix">
											<input type="text" name="wpmessagebutton_agents[0][availability][saturday][start]" placeholder="<?php echo esc_attr( 'hh:mm' ); ?>" minlength="5" maxlength="5" data-rule-time="true">
											<input type="text" name="wpmessagebutton_agents[0][availability][saturday][end]" placeholder="<?php echo esc_attr( 'hh:mm' ); ?>" minlength="5" maxlength="5" data-rule-time="true">
										</div>
									</div>
								</div>
								<div class="wpmb-col-3">
									<div class="wpmb-field">
										<label for="agent-availability-sunday"><?php echo __( 'Sunday', 'wp-message-button' ); ?></label>
										<div class="wpmb-field-timerange wp-clearfix">
											<input type="text" name="wpmessagebutton_agents[0][availability][sunday][start]" placeholder="<?php echo esc_attr( 'hh:mm' ); ?>" minlength="5" maxlength="5" data-rule-time="true">
											<input type="text" name="wpmessagebutton_agents[0][availability][sunday][end]" placeholder="<?php echo esc_attr( 'hh:mm' ); ?>" minlength="5" maxlength="5" data-rule-time="true">
										</div>
									</div>
								</div>
							</div>
							<p class="description"><?php echo __( 'Please insert time in 24 hour format H:i, for example 09:00 to 17:00', 'wp-message-button' ); ?></p>
							<p class="description"><?php echo sprintf( __( 'Current active timezone is GMT %s, go to %s to change the timezone', 'wp-message-button' ), get_option( 'gmt_offset' ), '<a target="_blank" href="' . admin_url( 'options-general.php' ) . '">' . __( 'Settings > General', 'wp-message-button' ) . '</a>' ); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<a href="#" class="button button-primary" id="wpmb-add-agent"><?php echo __( 'Add Agent', 'wp-message-button' ); ?></a>

	<?php }

	/**
	 * Field: Customizer Header
	 */

	/**
	 * Sanitize settings input
	 * 
	 * @var $input 
	 */
	public static function sanitize( $input ){
		return $input;
	}

	/**
	 * Settings Page
	 * 
	 * @static
	 */
	public static function settings_page(){ ?>

		<?php 
		// Check capabilities
		if( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// Check if settings updated
		if( isset( $_GET['settings-updated'] ) ) {
			add_settings_error( 'wpmessagebutton_messages', 'wpmessagebutton_message', __( 'Settings Saved', 'wp-message-button' ), 'updated' );
 		}
 
		// Display the error/update messages
		settings_errors( 'wpmessagebutton_messages' );

		// Set default active tab
		$active_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'agents';
		?>

		<div class="wrap">
			<h1>WP Message Button <?php echo WPMessageButton::is_wpmb_pro_active() ? '<span class="wpmessagebutton_pro">' . __( 'Pro', 'wp-message-button' ) . '</span>' : ''; ?></h1>
			<div class="wpmessagebutton-settings-content">
				<h2 class="nav-tab-wrapper">
					<a href="?page=wpmessagebutton&tab=agents" class="nav-tab <?php echo $active_tab == 'agents' ? 'nav-tab-active' : ''; ?>"><?php echo __( 'Agents', 'wp-message-button' ); ?></a>
					<a href="?page=wpmessagebutton&tab=customizer" class="nav-tab <?php echo $active_tab == 'customizer' ? 'nav-tab-active' : ''; ?>"><?php echo __( 'Customizer', 'wp-message-button' ); ?></a>
					<a href="?page=wpmessagebutton&tab=visibility" class="nav-tab <?php echo $active_tab == 'visibility' ? 'nav-tab-active' : ''; ?>"><?php echo __( 'Visibility', 'wp-message-button' ); ?></a>
					<a href="<?php echo esc_url( 'https://smplwp.com/plugins/wp-message-button/#pro' ) ?>" target="_blank" class="nav-tab"><?php echo __( 'GO PRO!', 'wp-message-button' ); ?></a>
				</h2>

				<form action="options.php" method="post" id="wpmessagebutton-form" class="wpmb-form">

				<div id="poststuff">
					<?php
					switch ( $active_tab ) {

						// Customizer settings tab
						case 'customizer':
							settings_fields( 'wpmessagebutton_customizer' );
							do_settings_sections( 'wpmessagebutton_customizer' );
							
							// Load preview chat box
							WPMessageButton_Widget::html(); 

							break;
						
						// Agents settings tab
						case 'agents':
							settings_fields( 'wpmessagebutton_agents' );
							do_settings_sections( 'wpmessagebutton_agents' );
							//Channel: Whatsapp, Phone call, Messenger, Line, Telegram, Skype
							break;

						// Visibility settings tab
						case 'visibility':
							if( WPMessageButton::is_wpmb_pro_active() ){
								settings_fields( 'wpmessagebutton_visibility' );
								do_settings_sections( 'wpmessagebutton_visibility' );
							} else {
								echo '<h2>' . __( 'Show and hide the widget in any pages', 'wp-message-button' ) . '</h2>';
								echo '[gif preview of visibility settings]';
							}
							break;

					}
					?>

					<?php submit_button( 'Save Settings' ); ?>
				</div>

					
					<div><h2>Cool features</h2>
					<ul>
						<li>Custom message per page</li>
						<li>Add dynamic data such as: Post title, post id, in the message & title (PREMIUM)</li>
						<li>Add more than 1 agent (PREMIUM)</li>
						<li>Auto open chat on load with sound to catch attention (PREMIUM)</li>
						<li>Dark Mode (PREMIUM)</li>
						<li>More icon options (PREMIUM)</li>
						<li>Visibility settings (PREMIUM)</li>
						<li>Availability settings (PREMIUM)</li>
					</ul>
					Purchase premium plugin to unlock full features only $15 for unlimited sites and 1 year premium support
					</div>
				</form>
			</div>
			<div class="wpmessagebutton-settings-sidebar">Sidebar content here [UNLOCK PREMIUM]</div>
		</div>

	<?php }
}