document.addEventListener('DOMContentLoaded', function () {

	var wpmb_cont = document.querySelector('.wpmessagebutton');
	var wpmb_chat = document.querySelector('.wpmessagebutton_chat');
	var wpmb_toggle = document.querySelector('.wpmessagebutton_button');
	var wpmb_bubble = document.querySelector('.wpmessagebutton_button__bubble');

	wpmb_toggle.addEventListener('click', function () {
		wpmb_cont.classList.toggle('wpmessagebutton--opened');
		wpmb_chat.classList.toggle('wpmb_bounceIn');
		wpmb_bubble.classList.toggle('wpmb_bounceOut');
	});

	// Adjust the bubble position
	wpmb_bubble.style.left = '-' + (wpmb_bubble.offsetWidth + 15) + 'px';

	// If sound setting enabled
	if (wpmessagebutton.open_on_load) {
		setTimeout(function () {
			document.getElementById('wpmb_notification_sound').play();
			wpmb_toggle.click();
		}, wpmessagebutton.open_on_load_after);
	}

});
