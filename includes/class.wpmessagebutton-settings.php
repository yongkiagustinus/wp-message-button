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
		<?php 
		$agents = get_option( 'wpmessagebutton_agents' );
		$agents = empty( $agents ) ? array( 'first' ) : $agents;
		?>
		<div id="agents">
			<?php foreach( $agents as $i => $agent ){ ?>
				<?php 
				$name 				= $agent == 'first' ? '' : $agent['name'];
				$photo				= $agent == 'first' ? '' : $agent['photo'];
				$handle				= $agent == 'first' ? '' : $agent['handle'];	
				$message 			= $agent == 'first' ? '' : $agent['message'];	
				$position 			= $agent == 'first' ? '' : $agent['position'];	
				?>
				<div class="agent stuffbox" data-agent="<?php echo $i; ?>">
					<div class="inside">
						<h2>
							<input type="text" id="agent-name-<?php echo $i; ?>" name="wpmessagebutton_agents[<?php echo $i; ?>][name]" placeholder="<?php echo esc_attr( __( 'Insert agent name here', 'wp-message-button' ) ); ?>" value="<?php echo $name; ?>" onkeypress="this.style.width = ((this.value.length + 1) * 8) + 'px';" required>
							<span class="agent__delete"><?php echo __( 'Delete', 'wp-message-button' ); ?></span>
						</h2>
						<div>
							<div class="wpmb-row">
								<div class="wpmb-col-3">
									<div class="wpmb-field">
										<div class="agent__photo">
											<?php $photo = empty( $photo ) ? WPMESSAGEBUTTON_PLUGIN_URI . 'public/images/agent-photo-placeholder.png' : $photo; ?>
											<img src="<?php echo $photo; ?>" alt="Agent Photo">
											<a class="wpmb-add-agent-photo" href="javascript:void(0);"><?php echo __( 'Add/update agent photo', 'wp-message-button' ); ?></a>
											<input type="hidden" id="agent-photo-<?php echo $i; ?>" name="wpmessagebutton_agents[<?php echo $i; ?>][photo]" value="<?php echo $photo; ?>">
										</div>
									</div>
								</div>
								<div class="wpmb-col-9">
									<div class="wpmb-field">
										<label for="agent-channel"><?php echo __( 'Select channel for this agent', 'wp-message-button' ); ?></label>
										<div class="wpmb-row wpmb-row-narrow">
											<?php 
											$channels = array( 
												'wa' 	=> __( 'Whatsapp', 'wp-message-button' ),
												'fb'	=> __( 'FB Messenger', 'wp-message-button' ),
												'tg'	=> __( 'Telegram', 'wp-message-button' ),
												'ln'	=> __( 'Line', 'wp-message-button' ),
												'sk'	=> __( 'Skype', 'wp-message-button' ),
												'ph'	=> __( 'Phone Call', 'wp-message-button' )
											); 
											?>
											<?php foreach( $channels as $id => $channel ){ ?>
												<?php $saved = $agent == 'first' ? '' : $agent['channel']; ?>
												<div class="wpmb-col-4">
													<div class="wpmb-radio">
														<input type="radio" name="wpmessagebutton_agents[<?php echo $i; ?>][channel]" id="agent-channel-<?php echo $id; ?>-<?php echo $i; ?>" <?php checked( $saved, $id ); ?> value="<?php echo $id; ?>" required>
														<label for="agent-channel-<?php echo $id; ?>-<?php echo $i; ?>"><?php echo $channel; ?></label>
													</div>
												</div>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
							
							
							<div class="wpmb-row">
								<div class="wpmb-col-6">
									<div class="wpmb-field">
										<label for="agent-handle-<?php echo $i; ?>"><?php echo __( 'Username or Phone Number', 'wp-message-button' ); ?></label>
										<input type="text" id="agent-handle-<?php echo $i; ?>" name="wpmessagebutton_agents[<?php echo $i; ?>][handle]" autocomplete="off" value="<?php echo $handle; ?>" placeholder="<?php echo esc_attr( __( 'Number or Username without url', 'wp-message-button' ) ); ?>" required>
										<p class="description"><?php echo __( 'For Whatsapp, please use country code without the "+".<br />Example: 1987654321 (US), 65987654321 (SG).', 'wp-message-button' ); ?></p>
									</div>
								</div>
								<div class="wpmb-col-6">
									<div class="wpmb-field field-message">
										<label for="agent-message-<?php echo $i; ?>"><?php echo __( 'Message', 'wp-message-button' ); ?></label>
										<textarea id="agent-message-<?php echo $i; ?>" name="wpmessagebutton_agents[<?php echo $i; ?>][message]" placeholder="<?php echo esc_attr( __( 'Example: Hello, I need more information about your service.', 'wp-message-button' ) ); ?>"><?php echo $message; ?></textarea>
										<p class="description"><?php echo __( 'Predefind message currently only available in Whatsapp channel', 'wp-message-button' ); ?></p>
									</div>
								</div>
							</div>
							<div class="wpmb-field">
								<label for="agent-position-<?php echo $i; ?>"><?php echo __( 'Position', 'wp-message-button' ); ?></label>
								<input type="text" id="agent-position-<?php echo $i; ?>" name="wpmessagebutton_agents[<?php echo $i; ?>][position]" autocomplete="off" value="<?php echo $position; ?>" placeholder="<?php echo esc_attr( __( 'Example: Customer Support or Billing or Technical Support', 'wp-message-button' ) ); ?>">
							</div>
							<div class="wpmb-field">
								<label for="agent-availability-schedule"><?php echo __( 'Availability Schedule (Leave all blank to hide the availability status)', 'wp-message-button' ); ?></label>
								<div class="wpmb-row">
									<?php $days = array( 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday' ); ?>
									<?php foreach( $days as $day ){ ?>
										<div class="wpmb-col-3">
											<div class="wpmb-field">
												<label for="agent-availability-<?php echo $day; ?>-<?php echo $i; ?>"><?php echo __( ucfirst( $day ), 'wp-message-button' ); ?></label>
												<div class="wpmb-field-timerange wp-clearfix">
													<input type="text" id="agent-availability-<?php echo $day; ?>-<?php echo $i; ?>" name="wpmessagebutton_agents[<?php echo $i; ?>][availability][<?php echo $day; ?>][start]" placeholder="<?php echo esc_attr( 'hh:mm' ); ?>" value="<?php echo $agent == 'first' ? '' : $agent['availability'][$day]['start']; ?>" minlength="5" maxlength="5" data-rule-time="true">
													<input type="text" id="agent-availability-<?php echo $day; ?>-end-<?php echo $i; ?>" name="wpmessagebutton_agents[<?php echo $i; ?>][availability][<?php echo $day; ?>][end]" placeholder="<?php echo esc_attr( 'hh:mm' ); ?>" value="<?php echo $agent == 'first' ? '' : $agent['availability'][$day]['end']; ?>" minlength="5" maxlength="5" data-rule-time="true">
												</div>
											</div>
										</div>
									<?php } ?>
								</div>
								<p class="description"><?php echo __( 'Please insert time in 24 hour format H:i, for example 09:00 to 17:00', 'wp-message-button' ); ?></p>
								<p class="description"><?php echo sprintf( __( 'Current active timezone is GMT %s, go to %s to change the timezone', 'wp-message-button' ), get_option( 'gmt_offset' ), '<a target="_blank" href="' . admin_url( 'options-general.php' ) . '">' . __( 'Settings > General', 'wp-message-button' ) . '</a>' ); ?></p>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
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
					<a href="<?php echo esc_url( 'https://88digital.co/plugins/wp-message-button/#pro' ) ?>" target="_blank" class="nav-tab"><?php echo __( 'GO PRO!', 'wp-message-button' ); ?></a>
				</h2>

				<form action="options.php" method="post" id="wpmessagebutton-form" class="wpmb-form">

				<div id="poststuff">
					<?php
					switch ( $active_tab ) {

						// Customizer settings tab
						case 'customizer':
							settings_fields( 'wpmessagebutton_customizer' );
							do_settings_sections( 'wpmessagebutton_customizer' );
							
							// Enable or disable chatbox
							// Close on click outside the opened box
							// Header title with timeaware shortcode [wpmessagebutton_message morning="" afternoon="" night=""]

							// Load preview chat box
							WPMessageButton_Widget::html(); 

							break;
						
						// Agents settings tab
						case 'agents':
							settings_fields( 'wpmessagebutton_agents' );
							do_settings_sections( 'wpmessagebutton_agents' );
							//Channel: Whatsapp, Phone call, Messenger, Line, Telegram, Skype
							break;

					}
					?>

					<?php submit_button( 'Save Settings' ); ?>
				</div>

					
					<div><h2>Cool features</h2>
					<ul>
						<li>Custom message per page</li>
						<li>Add dynamic data such as: Post title, post id, in the message & title (PREMIUM)</li>
					</ul>
					Purchase premium plugin to unlock full features only $15 for unlimited sites and 1 year premium support
					</div>
				</form>
			</div>
			<div class="wpmessagebutton-settings-sidebar">
				<div class="wpmessagebutton-ads">
					<h4 class="wpmessagebutton-ads__title"><?php echo __( 'WP Message Button PRO', 'wp-message-button' ); ?></h4>
					<p><?php echo __( 'Unlock cool premium features below to maximize your conversions', 'wp-message-button' ); ?></p>
					<ul class="wpmessagebutton-ads__list">
						<li><span class="dashicons dashicons-groups"></span> <?php echo __( 'Add more than 1 agent', 'wp-message-button' ); ?></li>
						<li><span class="dashicons dashicons-clock"></span> <?php echo __( 'Agent availability settings', 'wp-message-button' ); ?></li>
						<li><span class="dashicons dashicons-star-half"></span> <?php echo __( 'Dark mode theme for the chat box', 'wp-message-button' ); ?></li>
						<li><span class="dashicons dashicons-format-audio"></span> <?php echo __( 'Catch your visitor attention with notification sound on load', 'wp-message-button' ); ?></li>
						<li><span class="dashicons dashicons-format-chat"></span> <?php echo __( '20 chat box icons to choose', 'wp-message-button' ); ?></li>
					</ul>
				</div>
			</div>
		</div>

	<?php }
}