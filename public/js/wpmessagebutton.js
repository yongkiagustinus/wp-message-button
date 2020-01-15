document.addEventListener('DOMContentLoaded', function () {

	var wpmb_cont = document.querySelector('.wpmessagebutton');
	var wpmb_chat = document.querySelector('.wpmessagebutton_chat');
	var wpmb_toggle = document.querySelector('.wpmessagebutton_button');
	var wpmb_bubble = document.querySelector('.wpmessagebutton_button__bubble');

	wpmb_toggle.addEventListener('click', function () {
		wpmb_toggle_chat();
	});

	// Adjust the bubble position
	if( wpmessagebutton.customization.bubble_text != '' ) { wpmb_bubble.style.left = '-' + (wpmb_bubble.offsetWidth + 25) + 'px'; }

	window.addEventListener('click', function (e) {
		if (wpmb_cont.classList.contains('wpmessagebutton--opened') && !wpmb_cont.contains(e.target)) {
			wpmb_toggle_chat();
		}
	});

	function wpmb_toggle_chat() {
		wpmb_cont.classList.toggle('wpmessagebutton--opened');
		wpmb_chat.classList.toggle('wpmb_bounceIn');
		if( wpmessagebutton.customization.bubble_text != '' ) { wpmb_bubble.classList.toggle('wpmb_bounceOut'); }
	}

});
