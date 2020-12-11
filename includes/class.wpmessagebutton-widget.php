<?php 

class WPMessageButton_Widget {

	public static function init(){
		add_action( 'wp_enqueue_scripts', array( 'WPMessageButton_Widget', 'enqueue' ) );
		add_action( 'wp_footer', array( 'WPMessageButton_Widget', 'html' ) );
	}

	/**
	 * Print HTML for the chatbox
	 * 
	 * @static
	 */
	public static function html(){ ?>
		<?php do_action( 'wpmessagebutton_before_render' ); ?>
		<?php $agents = get_option( 'wpmessagebutton_agents' ); ?>
		<?php if( $agents && $agents[0] != 'first' ){ ?>
			<?php
			$agents 			= WPMessageButton::is_wpmb_pro_active() ? $agents : array_slice( $agents, 0, 1 );
			$customizer		= get_option( 'wpmessagebutton_customizer', WPMessageButton_Settings::customizer_default() );
			$icon	= '<svg fill="#ffffff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M425.9 170.4H204.3c-21 0-38.1 17.1-38.1 38.1v154.3c0 21 17.1 38 38.1 38h126.8c2.8 0 5.6 1.2 7.6 3.2l63 58.1c3.5 3.4 9.3 2 9.3-2.9v-50.6c0-6 3.8-7.9 9.8-7.9h1c21 0 42.1-16.9 42.1-38V208.5c.1-21.1-17-38.1-38-38.1z"/><path d="M174.4 145.9h177.4V80.6c0-18-14.6-32.6-32.6-32.6H80.6C62.6 48 48 62.6 48 80.6v165.2c0 18 14.6 32.6 32.6 32.6h61.1v-99.9c.1-18 14.7-32.6 32.7-32.6z"/></svg>';
			$button_icon	= apply_filters( 'wpmessagebutton_button_icon', '<svg fill="#ffffff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M425.9 170.4H204.3c-21 0-38.1 17.1-38.1 38.1v154.3c0 21 17.1 38 38.1 38h126.8c2.8 0 5.6 1.2 7.6 3.2l63 58.1c3.5 3.4 9.3 2 9.3-2.9v-50.6c0-6 3.8-7.9 9.8-7.9h1c21 0 42.1-16.9 42.1-38V208.5c.1-21.1-17-38.1-38-38.1z"/><path d="M174.4 145.9h177.4V80.6c0-18-14.6-32.6-32.6-32.6H80.6C62.6 48 48 62.6 48 80.6v165.2c0 18 14.6 32.6 32.6 32.6h61.1v-99.9c.1-18 14.7-32.6 32.7-32.6z"/></svg>', $icon );
			?>
			<?php $classes = apply_filters( 'wpmessagebutton_classes', array( 'wpmessagebutton', 'wpmb_zindex', 'wpmb_position--right', 'wpmb_shape--rounded' ), $customizer ); ?>
			<div id="wpmessagebutton" class="<?php echo implode( ' ', $classes ); ?>">
				<div class="wpmessagebutton_chat wpmb_animated wpmb_shadow--md">
					<div class="wpmessagebutton_chat__header">
						<div class="wpmessagebutton_chat__header__title"><?php echo $customizer['header_title']; ?></div>
						<div class="wpmessagebutton_chat__header__content"><?php echo $customizer['header_text']; ?></div>
					</div>
					<div class="wpmessagebutton_chat__body">
						<div class="wpmessagebutton_chat__body__agents">
							<?php foreach( $agents as $agent ){ ?>
								<?php 
								$url = self::generate_url( $agent['channel'], $agent['handle'], $agent['message'] );
								$available = apply_filters( 'wpmessagebutton_agent_availability', true, $agent );
								unset( $agent_classes );
								$agent_classes[] = 'wpmessagebutton_chat__agent';
								$agent_classes[] = 'wpmessagebutton_chat__agent--' . $agent['channel'];
								if( ! $available ) {
									$agent_classes[] = 'wpmessagebutton_chat__agent--unavailable';
								}
								?>
								<a href="<?php echo $url; ?>" target="_blank" class="<?php echo implode( ' ', $agent_classes ); ?>">
									<div class="wpmessagebutton_chat__agent__photo">
										<img src="<?php echo $agent['photo']; ?>" alt="<?php echo $agent['name']; ?>">
									</div>
									<div class="wpmessagebutton_chat__agent__detail">
										<div class="wpmessagebutton_chat__agent__detail__position"><?php echo $agent['position']; ?></div>
										<div class="wpmessagebutton_chat__agent__detail__name"><?php echo $agent['name']; ?></div>
										<?php do_action( 'wpmessagebutton_after_agent_name', $agent, $available ); ?>
									</div>
								</a>
							<?php } ?>
						</div>
					</div>
					<div class="wpmessagebutton_chat__footer"><?php echo $customizer['footer_text']; ?></div>
				</div>
				<div class="wpmessagebutton_button wpmb_size--md wpmb_shadow--md">
					<?php if( ! empty( $customizer['bubble_text'] ) ){ ?><div class="wpmessagebutton_button__bubble wpmb_animated wpmb_bounceIn"><?php echo $customizer['bubble_text']; ?></div><?php } ?>
					<div class="wpmessagebutton_button__close"><svg fill="#ffffff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M278.6 256l68.2-68.2c6.2-6.2 6.2-16.4 0-22.6-6.2-6.2-16.4-6.2-22.6 0L256 233.4l-68.2-68.2c-6.2-6.2-16.4-6.2-22.6 0-3.1 3.1-4.7 7.2-4.7 11.3 0 4.1 1.6 8.2 4.7 11.3l68.2 68.2-68.2 68.2c-3.1 3.1-4.7 7.2-4.7 11.3 0 4.1 1.6 8.2 4.7 11.3 6.2 6.2 16.4 6.2 22.6 0l68.2-68.2 68.2 68.2c6.2 6.2 16.4 6.2 22.6 0 6.2-6.2 6.2-16.4 0-22.6L278.6 256z"/></svg></div>
					<div class="wpmessagebutton_button__icon"><?php echo $button_icon; ?></div>
				</div>
				<?php do_action( 'wpmessagebutton_after_button' ); ?>
			</div>
			<?php do_action( 'wpmessagebutton_after_render' ); ?>
		<?php } ?>
	<?php }

	public static function enqueue(){
		wp_register_style( 'wpmessagebutton', WPMESSAGEBUTTON_PLUGIN_URI . 'public/css/wpmessagebutton.css', array(), '1.0', 'all' );
		wp_register_script( 'wpmessagebutton', WPMESSAGEBUTTON_PLUGIN_URI . 'public/js/wpmessagebutton.js', array(), '1.0', true );

		wp_enqueue_style( 'wpmessagebutton' );
		wp_enqueue_script( 'wpmessagebutton' );
		
		$customizer				= get_option( 'wpmessagebutton_customizer' );
		$header_bg_solid		= isset( $customizer['header_bg_solid'] ) ? $customizer['header_bg_solid'] : 0;

		// Dynamic CSS for customizer settings
		ob_start(); ?>
			.wpmessagebutton{font-size:14px;}
			.wpmessagebutton_chat__header {
				background: <?php echo $customizer['header_bg'][0]; ?>;  /* fallback for old browsers */
				<?php if( $header_bg_solid == 0 ){ ?>
					background: -webkit-linear-gradient(to right, <?php echo $customizer['header_bg'][0] ?>, <?php echo $customizer['header_bg'][1]; ?>);  /* Chrome 10-25, Safari 5.1-6 */
					background: linear-gradient(to right, <?php echo $customizer['header_bg'][0] ?>, <?php echo $customizer['header_bg'][1]; ?>); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
				<?php } ?>
			}
			.wpmessagebutton_button,
			.wpmessagebutton_button__bubble {
				background: <?php echo $customizer['icon_bg']; ?>;
			}
			.wpmessagebutton_button__bubble::before {
				border-color: <?php echo $customizer['icon_bg']; ?> transparent transparent <?php echo $customizer['icon_bg']; ?>;
			}
			<?php do_action( 'wpmessagebutton_after_dynamic_css' ); ?>
		<?php
		$dynamic_css = ob_get_clean();
		wp_add_inline_style( 'wpmessagebutton', $dynamic_css );

		// Apply settings to JS
		$vars['customization']			= $customizer;
		$vars['default_color']			= self::default_color();
		wp_localize_script( 'wpmessagebutton', 'wpmessagebutton', $vars );

	}

	/**
	 * Generate url for each channel
	 * 
	 * @static
	 */
	static function generate_url( $channel, $handle, $message ){
		switch ( $channel ) {
			case 'wa':
				$url = 'https://wa.me/' . $handle . '?text=' . urlencode( $message );
				break;
			case 'fb':
				$url = 'https://m.me/' . $handle;
				break;
			case 'ln':
				$url = 'https://line.me/ti/p/' . $handle;
				break;
			case 'sk':
				$url = 'skype:live:' . $handle . '?chat';
				break;
			case 'tg':
				$url = 'https://t.me/' . $handle;
				break;
			case 'ph':
				$url = 'tel:' . $handle;
				break;
		}
		return $url;
	}

	/**
	 * Default color for light & dark mode
	 * 
	 * @static
	 */
	public static function default_color(){
		$default_color = array(
			'header_bg'		=> array(
				'light'		=> array( '#0052D4', '#65C7F7' ),
				'dark'		=> array( '#0E0E0E', '#151515' )
			),
			'icon_bg'		=> array(
				'light' 	=> '#208CEB',
				'dark'	=> '#0E0E0E'
			)
		);
		return apply_filters( 'wpmessagebutton_default_color', $default_color );
	}

}

function WPMessageButton_Widget(){
	return new WPMessageButton_Widget;
}