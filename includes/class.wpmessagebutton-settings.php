<?php 
class WPMessageButton_Settings {
	
	public static function init(){
		
		// Register agents settings
		register_setting( 'wpmessagebutton_agents', 'wpmessagebutton_agents', array( 'WPMessageButton_Settings', 'sanitize' ) );
			add_settings_section( 'section_agents', '', '', 'wpmessagebutton_agents' );
				add_settings_field( 'field_agents', __( 'Agents', 'wp-message-button' ), array( 'WPMessageButton_Settings', 'field_agents' ), 'wpmessagebutton_agents', 'section_agents' );

		// Register customizer settings
		register_setting( 'wpmessagebutton_customizer', 'wpmessagebutton_customizer', array( 'WPMessageButton_Settings', 'sanitize' ) );
			add_settings_section( 'section_customizer_settings', '', '', 'wpmessagebutton_customizer' );
				add_settings_field( 'field_customizer', '', array( 'WPMessageButton_Settings', 'field_customizer' ), 'wpmessagebutton_customizer', 'section_customizer_settings', array( 'class' => 'noth' ) );

	}

	/**
	 * Field Agents
	 */
	public static function field_agents() { ?>
		<?php 
		$agents = get_option( 'wpmessagebutton_agents', array( 'first' ) );
		$agents = WPMessageButton::is_wpmb_pro_active() ? $agents : array_slice( $agents, 0, 1 );
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
							<?php do_action( 'wpmessagebutton_after_agent_name_field' ); ?>
						</h2>
						<div>
							<div class="wpmb-row">
								<div class="wpmb-col-3">
									<div class="wpmb-field">
										<div class="agent__photo">
											<?php $photo = empty( $photo ) ? WPMESSAGEBUTTON_PLUGIN_URI . 'public/images/agent-photo-placeholder.png' : $photo; ?>
											<img src="<?php echo $photo; ?>" alt="<?php echo __( 'Agent Photo', 'wp-message-button' ); ?>">
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
												'wa' 	=> __( 'WhatsApp', 'wp-message-button' ),
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

							<?php if( WPMessageButton::is_wpmb_pro_active() ){ ?>
								<div class="wpmb-field">
									<label for="agent-availability-schedule"><?php echo __( 'Availability Schedule (Leave blank to set agent as available all day)', 'wp-message-button' ); ?></label>
									<div class="wpmb-row">
										<?php $days = array( 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday' ); ?>
										<?php foreach( $days as $day ){ ?>
											<div class="wpmb-col-3">
												<div class="wpmb-field">
													<label for="agent-availability-<?php echo $day; ?>-<?php echo $i; ?>"><?php echo __( ucfirst( $day ), 'wp-message-button' ); ?></label>
													<input id="agent-availability-<?php echo $day; ?>-<?php echo $i; ?>" name="wpmessagebutton_agents[<?php echo $i; ?>][<?php echo $day; ?>]" value="<?php echo $agent == 'first' ? '' : $agent[$day]; ?>" type="text" class="wpmb-schedule-input" placeholder="Example: 09:00-17:00" data-rule-timerange="true" />
												</div>
											</div>
										<?php } ?>
									</div>
									<p class="description"><?php echo __( 'Please insert time in 24 hour format H:i, for example 09:00 to 17:00', 'wp-message-button' ); ?></p>
									<p class="description"><?php echo sprintf( __( 'Current active timezone is UTC %s, go to %s to change the timezone', 'wp-message-button' ), get_option( 'gmt_offset' ), '<a target="_blank" href="' . admin_url( 'options-general.php' ) . '">' . __( 'Settings > General', 'wp-message-button' ) . '</a>' ); ?></p>
								</div>
							<?php } ?>

						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<?php do_action( 'wpmessagebutton_after_agents' ); ?>

	<?php }

	/**
	 * Field: Customizer
	 */
	public static function field_customizer(){
		$customizer 			= get_option( 'wpmessagebutton_customizer', self::customizer_default() );
		$default_color			= WPMessageButton_Widget::default_color();
		$keep_open				= isset( $customizer['keep_open'] ) ? $customizer['keep_open'] : 0;
		$header_bg_default 	= $customizer['mode'] == 'light' ? $default_color['header_bg']['light'] : $default_color['header_bg']['dark'];
		$icon_bg_default 		= $customizer['mode'] == 'light' ? $default_color['icon_bg']['light'] : $default_color['icon_bg']['dark'];
		$header_bg_solid		= isset( $customizer['header_bg_solid'] ) ? $customizer['header_bg_solid'] : 0;
		?>

		<div class="wpmb-field">
			<label><?php echo __( 'Select mode', 'wp-message-button' ); ?></label>
			<div class="wpmb-row">
				<div class="wpmb-col-4">
					<div class="wpmb-radio">
						<input type="radio" id="wpmb-mode-light" class="wpmb-switch-mode" name="wpmessagebutton_customizer[mode]" <?php checked( 'light', $customizer['mode'] ); ?> value="light" required>
						<label for="wpmb-mode-light"><?php echo __( 'Light', 'wp-message-button' ); ?></label>
					</div>
				</div>
				<div class="wpmb-col-4">
					<div class="wpmb-radio <?php echo WPMessageButton::is_wpmb_pro_active() ? '' : 'wpmb-disabled'; ?>">
						<input type="radio" id="wpmb-mode-dark" class="wpmb-switch-mode" <?php disabled( WPMessageButton::is_wpmb_pro_active(), false ); ?> name="wpmessagebutton_customizer[mode]" <?php checked( 'dark', $customizer['mode'] ); ?> value="dark" required>
						<label for="wpmb-mode-dark"><?php echo __( 'Dark', 'wp-message-button' ); ?></label>
					</div>
				</div>
			</div>
			<p class="description"><?php echo __( 'Default color of the header & icon background will be changed when switching the mode', 'wp-message-button' ); ?></p>
			<?php if( ! WPMessageButton::is_wpmb_pro_active() ){ ?>
				<p class="description"><?php echo __( 'Get <strong>WP Message Button PRO</strong>, to unlock Dark Mode', 'wp-message-button' ); ?></p>
			<?php } ?>
		</div>

		<div class="wpmb-field">
			<label for="wpmb-header-title"><?php echo __( 'Header Title', 'wp-message-button' ); ?> *</label>
			<input type="text" id="wpmb-header-title" name="wpmessagebutton_customizer[header_title]" value="<?php echo $customizer['header_title']; ?>" required>
		</div>

		<div class="wpmb-field">
			<label for="wpmb-header-text"><?php echo __( 'Header Text', 'wp-message-button' ); ?> *</label>
			<input type="text" id="wpmb-header-text" name="wpmessagebutton_customizer[header_text]" value="<?php echo $customizer['header_text']; ?>" required>
		</div>

		<div class="wpmb-field">
			<label for="wpmb-header-bg"><?php echo __( 'Header Background', 'wp-message-button' ); ?> *</label>
			<input type="text" id="wpmb-header-bg-0" class="wpmb-color-picker" name="wpmessagebutton_customizer[header_bg][0]" value="<?php echo $customizer['header_bg'][0]; ?>" data-default-color="<?php echo $header_bg_default[0]; ?>" required>
			<input type="text" id="wpmb-header-bg-1" class="wpmb-color-picker" name="wpmessagebutton_customizer[header_bg][1]" value="<?php echo $customizer['header_bg'][1]; ?>" data-default-color="<?php echo $header_bg_default[1]; ?>">
			<p class="description"><?php echo __( 'If gradient disabled, only the first color will be used as background', 'wp-message-button' ); ?></p>
		</div>

		<div class="wpmb-field">
			<label><input type="checkbox" name="wpmessagebutton_customizer[header_bg_solid]" value="1" <?php checked( 1, $header_bg_solid ); ?> /> <?php echo __( 'Disable header background gradient', 'wp-message-button' ); ?></label>
			<p class="description"><?php echo __( 'Enable this to use solid background color for header', 'wp-message-button' ); ?></p>
		</div>

		<div class="wpmb-field">
			<label for="wpmb-footer-text"><?php echo __( 'Footer Text', 'wp-message-button' ); ?></label>
			<input type="text" id="wpmb-footer-text" name="wpmessagebutton_customizer[footer_text]" value="<?php echo $customizer['footer_text']; ?>">
			<p class="description"><?php echo __( 'Add text to message box footer, for example: "Call +123456789 for fast response" or a simple thank you message.', 'wp-message-button' ); ?></p>
		</div>

		<div class="wpmb-field">
			<label for="wpmb-bubble-text"><?php echo __( 'Icon Bubble Text', 'wp-message-button' ); ?> *</label>
			<input type="text" id="wpmb-bubble-text" name="wpmessagebutton_customizer[bubble_text]" value="<?php echo $customizer['bubble_text']; ?>">
			<p class="description"><?php echo __( 'Leave it blank to disable hide bubble text', 'wp-message-button' ); ?></p>
		</div>

		<div class="wpmb-field">
			<label for="wpmb-icon-background"><?php echo __( 'Icon & Bubble Background', 'wp-message-button' ); ?> *</label>
			<input type="text" id="wpmb-icon-background" class="wpmb-color-picker" name="wpmessagebutton_customizer[icon_bg]" value="<?php echo $customizer['icon_bg']; ?>" data-default-color="<?php echo $icon_bg_default; ?>">
		</div>

		<div class="wpmb-field">
			<label><input type="checkbox" name="wpmessagebutton_customizer[keep_open]" value="1" <?php checked( 1, $keep_open ); ?> /> <?php echo __( 'Keep the message box open when user click outside the box', 'wp-message-button' ); ?></label>
		</div>

		<?php do_action( 'wpmessagebutton_after_customizer', $customizer ); ?>

	<?php }

	/**
	 * Sanitize settings input
	 * 
	 * @var $input 
	 */
	public static function sanitize( $input ){
		$input = array_map( array( 'WPMessageButton_Settings', 'sanitize_field' ), $input );
		return $input;
	}

	/**
	 * Sanitize each field
	 */
	public static function sanitize_field( $value ){
		if( is_array( $value ) ){
			$value = array_map( 'sanitize_text_field', $value ); 
		} else {
			$value = sanitize_text_field( $value );
		}
		return $value;
	}

	/**
	 * Check if valid color hex
	 */
	public static function validate_color($color) {
		$color = ltrim($color, '#');
		if ( ctype_xdigit($color) && (strlen($color) == 6 || strlen($color) == 3)) return true;
		else return false;
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

		<div class="wrap <?php echo 'wpmb-tab-' . $active_tab; ?>">
			<h1>WP Message Button <?php echo WPMessageButton::is_wpmb_pro_active() ? '<span class="wpmessagebutton_pro">' . __( 'Pro', 'wp-message-button' ) . '</span>' : ''; ?></h1>
			<div class="wpmessagebutton-settings-content">
				<h2 class="nav-tab-wrapper">
					<a href="?page=wpmessagebutton&tab=agents" class="nav-tab <?php echo $active_tab == 'agents' ? 'nav-tab-active' : ''; ?>"><?php echo __( 'Agents', 'wp-message-button' ); ?></a>
					<a href="?page=wpmessagebutton&tab=customizer" class="nav-tab <?php echo $active_tab == 'customizer' ? 'nav-tab-active' : ''; ?>"><?php echo __( 'Customizer', 'wp-message-button' ); ?></a>
					<?php if( ! WPMessageButton::is_wpmb_pro_active() ){ ?>
						<a href="<?php echo esc_url( WPMESSAGEBUTTON_GET_PRO_URI ) ?>" target="_blank" class="nav-tab"><?php echo __( 'GO PRO!', 'wp-message-button' ); ?></a>
					<?php } ?>
				</h2>

				<form action="options.php" method="post" id="wpmessagebutton-form" class="wpmb-form">

					<div id="poststuff">
						<?php
						switch ( $active_tab ) {

							// Customizer settings tab
							case 'customizer':
								settings_fields( 'wpmessagebutton_customizer' );
								do_settings_sections( 'wpmessagebutton_customizer' );
								// Load message box for preview
								WPMessageButton_Widget::html(); 
								break;
							
							// Agents settings tab
							case 'agents':
								settings_fields( 'wpmessagebutton_agents' );
								do_settings_sections( 'wpmessagebutton_agents' );
								break;

						}
						?>

						<?php submit_button( 'Save Settings' ); ?>
					</div>
				</form>
			</div>
			<div class="wpmessagebutton-settings-sidebar">
				<?php if( ! WPMessageButton::is_wpmb_pro_active() ){ ?>
					<div class="wpmessagebutton-ads">
						<h4 class="wpmessagebutton-ads__title"><?php echo __( 'WP Message Button PRO', 'wp-message-button' ); ?></h4>
						<p><?php echo __( 'Unlock cool premium features below to maximize your conversions even more', 'wp-message-button' ); ?></p>
						<ul class="wpmessagebutton-ads__list">
							<li><span class="dashicons dashicons-groups"></span> <?php echo __( 'Add more than 1 agent', 'wp-message-button' ); ?></li>
							<li><span class="dashicons dashicons-clock"></span> <?php echo __( 'Agent availability time settings', 'wp-message-button' ); ?></li>
							<li><span class="dashicons dashicons-star-half"></span> <?php echo __( 'Dark mode theme for the chat box', 'wp-message-button' ); ?></li>
							<li><span class="dashicons dashicons-info"></span> <?php echo __( 'Auto open message box after ... seconds', 'wp-message-button' ); ?></li>
							<li><span class="dashicons dashicons-format-audio"></span> <?php echo __( 'Catch attention with notification sound', 'wp-message-button' ); ?></li>
							<li><span class="dashicons dashicons-admin-customizer"></span> <?php echo __( 'More customization options', 'wp-message-button' ); ?></li>
						</ul>
						<div class="wpmessagebutton-ads__cta">
							<div><?php echo __( 'FREE!', 'wp-message-button' ); ?></div>
							<a target="_blank" href="<?php echo WPMESSAGEBUTTON_GET_PRO_URI; ?>"><?php echo __( 'GET THE PRO VERSION!', 'wp-message-button' ); ?></a>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>

	<?php }

	/**
	 * Default value for customizer settings
	 */
	public static function customizer_default(){
		$default['mode'] 					= 'light';
		$default['header_title']		= 'Hello!';
		$default['header_text']			= 'Feel free to reach to one of our representative below if you need help.';
		$default['header_bg']			= array( '#0052D4', '#65C7F7' );
		$default['header_bg_solid']	= 0;
		$default['footer_text']			= '';
		$default['bubble_text']			= 'Hi there, do you need help?';
		$default['icon_bg']				= '#208CEB';
		$default['keep_open']			= 0;
		$default['auto_open'] 			= 0;
		$default['play_sound']			= 0;
		return apply_filters( 'wpmessagebutton_customizer_default', $default );
	}

}