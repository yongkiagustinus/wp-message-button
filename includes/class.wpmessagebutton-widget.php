<?php 

class WPMessageButton_Widget {

	/**
	 * Print HTML for the chatbox
	 * 
	 * @static
	 */
	public static function html(){ ?>
		<div class="wpmessagebutton wpmb_zindex wpmb_position--right wpmb_shape--rounded">
			<div class="wpmessagebutton_chat wpmb_animated wpmb_shadow--md">
				<div class="wpmessagebutton_chat__header">
					<div class="wpmessagebutton_chat__header__title">Good Morning!</div>
					<div class="wpmessagebutton_chat__header__content">Feel free to reach to one of our representative below if you need help.</div>
				</div>
				<div class="wpmessagebutton_chat__body">
					<div class="wpmessagebutton_chat__body__agents">
						<a href="https://wa.me/6287862035757?text=Hi%20i%20need%20help" target="_blank" class="wpmessagebutton_chat__agent wpmessagebutton_chat__agent--wa">
							<div class="wpmessagebutton_chat__agent__photo">
								<img src="https://randomuser.me/api/portraits/men/51.jpg" alt="Agent name">
							</div>
							<div class="wpmessagebutton_chat__agent__detail">
								<div class="wpmessagebutton_chat__agent__detail__position">Customer Support</div>
								<div class="wpmessagebutton_chat__agent__detail__name">Jonathan Support</div>
							</div>
						</a>
						<a href="https://m.me/yongkiagustinus" target="_blank" class="wpmessagebutton_chat__agent wpmessagebutton_chat__agent--fb">
							<div class="wpmessagebutton_chat__agent__photo">
								<img src="https://randomuser.me/api/portraits/men/51.jpg" alt="Agent name">
							</div>
							<div class="wpmessagebutton_chat__agent__detail">
								<div class="wpmessagebutton_chat__agent__detail__position">Billing</div>
								<div class="wpmessagebutton_chat__agent__detail__name">Jonathan Billing</div>
							</div>
						</a>
						<a href="tel:6287862035757" class="wpmessagebutton_chat__agent wpmessagebutton_chat__agent--ph">
							<div class="wpmessagebutton_chat__agent__photo">
								<img src="https://randomuser.me/api/portraits/men/51.jpg" alt="Agent name">
							</div>
							<div class="wpmessagebutton_chat__agent__detail">
								<div class="wpmessagebutton_chat__agent__detail__position">Call Service</div>
								<div class="wpmessagebutton_chat__agent__detail__name">Jonathan Callme</div>
							</div>
						</a>
						<a href="https://line.me/ti/p/yongkiagustinus" target="_blank" class="wpmessagebutton_chat__agent wpmessagebutton_chat__agent--ln">
							<div class="wpmessagebutton_chat__agent__photo">
								<img src="https://randomuser.me/api/portraits/men/51.jpg" alt="Agent name">
							</div>
							<div class="wpmessagebutton_chat__agent__detail">
								<div class="wpmessagebutton_chat__agent__detail__position">Marketing</div>
								<div class="wpmessagebutton_chat__agent__detail__name">Jonathan Marketing</div>
							</div>
						</a>
						<a href="skype:live:me_11117?chat" target="_blank" class="wpmessagebutton_chat__agent wpmessagebutton_chat__agent--sk">
							<div class="wpmessagebutton_chat__agent__photo">
								<img src="https://randomuser.me/api/portraits/men/51.jpg" alt="Agent name">
							</div>
							<div class="wpmessagebutton_chat__agent__detail">
								<div class="wpmessagebutton_chat__agent__detail__position">Technical Support</div>
								<div class="wpmessagebutton_chat__agent__detail__name">Jonathan Technical</div>
							</div>
						</a>
						<a href="https://t.me/yongkiagustinus" target="_blank" class="wpmessagebutton_chat__agent wpmessagebutton_chat__agent--unavailable wpmessagebutton_chat__agent--tg">
							<div class="wpmessagebutton_chat__agent__photo">
								<img src="https://randomuser.me/api/portraits/men/51.jpg" alt="Agent name">
							</div>
							<div class="wpmessagebutton_chat__agent__detail">
								<div class="wpmessagebutton_chat__agent__detail__position">Pre-Sales Support</div>
								<div class="wpmessagebutton_chat__agent__detail__name">Jonathan Sales</div>
								<div class="wpmessagebutton_chat__agent__detail__availability">Available from 09:00 to 17:00</div>
							</div>
						</a>
					</div>
				</div>
				<div class="wpmessagebutton_chat__footer">Call +6285211332332 for fast response!</div>
			</div>
			<div class="wpmessagebutton_button wpmb_size--md wpmb_shadow--md" style="background: #208CEB;">
				<div class="wpmessagebutton_button__bubble wpmb_animated wpmb_bounceIn">How can i help you mas mbak?</div>
				<div class="wpmessagebutton_button__close"><svg fill="#ffffff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M278.6 256l68.2-68.2c6.2-6.2 6.2-16.4 0-22.6-6.2-6.2-16.4-6.2-22.6 0L256 233.4l-68.2-68.2c-6.2-6.2-16.4-6.2-22.6 0-3.1 3.1-4.7 7.2-4.7 11.3 0 4.1 1.6 8.2 4.7 11.3l68.2 68.2-68.2 68.2c-3.1 3.1-4.7 7.2-4.7 11.3 0 4.1 1.6 8.2 4.7 11.3 6.2 6.2 16.4 6.2 22.6 0l68.2-68.2 68.2 68.2c6.2 6.2 16.4 6.2 22.6 0 6.2-6.2 6.2-16.4 0-22.6L278.6 256z"/></svg></div>
				<div class="wpmessagebutton_button__icon"><svg fill="#ffffff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M425.9 170.4H204.3c-21 0-38.1 17.1-38.1 38.1v154.3c0 21 17.1 38 38.1 38h126.8c2.8 0 5.6 1.2 7.6 3.2l63 58.1c3.5 3.4 9.3 2 9.3-2.9v-50.6c0-6 3.8-7.9 9.8-7.9h1c21 0 42.1-16.9 42.1-38V208.5c.1-21.1-17-38.1-38-38.1z"/><path d="M174.4 145.9h177.4V80.6c0-18-14.6-32.6-32.6-32.6H80.6C62.6 48 48 62.6 48 80.6v165.2c0 18 14.6 32.6 32.6 32.6h61.1v-99.9c.1-18 14.7-32.6 32.7-32.6z"/></svg></div>
			</div>
			<audio src="<?php echo WPMESSAGEBUTTON_PLUGIN_URI . 'public/audio/oh-finally.mp3'; ?>" id="wpmb_notification_sound"></audio>
		</div>
	<?php }

	public static function enqueue(){
		wp_register_style( 'wpmessagebutton', WPMESSAGEBUTTON_PLUGIN_URI . 'public/css/wpmessagebutton.css', array(), 'all' );
		wp_register_script( 'wpmessagebutton', WPMESSAGEBUTTON_PLUGIN_URI . 'public/js/wpmessagebutton.js', array(), true );

		wp_enqueue_style( 'wpmessagebutton' );
		wp_enqueue_script( 'wpmessagebutton' );
		
		// Apply setting to CSS
		$dynamic_css = '.wpmessagebutton_chat__header {
			background: #9CECFB;  /* fallback for old browsers */
			background: -webkit-linear-gradient(to right, #0052D4, #65C7F7);  /* Chrome 10-25, Safari 5.1-6 */
			background: linear-gradient(to right, #0052D4, #65C7F7); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
			color: #fff;
		}';
		wp_add_inline_style( 'wpmessagebutton', $dynamic_css );

		// Apply settings to JS
		$vars['open_on_load'] 			= false;
		$vars['open_on_load_after'] 	= 3000;
		wp_localize_script( 'wpmessagebutton', 'wpmessagebutton', $vars );

	}

}

function WPMessageButton_Widget(){
	return new WPMessageButton_Widget;
}