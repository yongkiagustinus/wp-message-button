document.addEventListener('DOMContentLoaded', function () {
	if (document.getElementById('wpmessagebutton') != null) {
		var wpmb_cont = document.querySelector('.wpmessagebutton');
		var wpmb_chat = document.querySelector('.wpmessagebutton_chat');
		var wpmb_toggle = document.querySelector('.wpmessagebutton_button');
		var wpmb_bubble = document.querySelector('.wpmessagebutton_button__bubble');
		var wpmb_agent = document.querySelector('.wpmessagebutton_chat__agent');

		// Open message box on button click
		wpmb_toggle.addEventListener('click', function () {
			wpmb_toggle_chat();
		});

		// Adjust the bubble position on load
		if (wpmessagebutton.customization.bubble_text != '') { wpmb_bubble.style.left = '-' + (wpmb_bubble.offsetWidth + 25) + 'px'; }

		// If keep open setting disabled, close message box on click outside
		if (wpmessagebutton.customization.keep_open != 1) {
			window.addEventListener('click', function (e) {
				if (wpmb_cont.classList.contains('wpmessagebutton--opened') && !wpmb_cont.contains(e.target)) {
					wpmb_toggle_chat();
				}
			});
		}

		// On-click an agent
		wpmb_agent.addEventListener('click', function (e) {
			var agent_name = this.querySelector('.wpmessagebutton_chat__agent__detail__name').innerText;
			// If Google Analytic exists, send event to ga
			if (typeof ga != 'undefined' && ga.loaded) {
				ga('send', 'event', 'WP Message Button', 'Click', agent_name);
			}

			// If Facebook pixel exists, send event to fbq
			if (typeof fbq != 'undefined' && fbq.loaded) {
				fbq('track', 'WP Message Button', { agent: agent_name });
			}
		});

		// Toggle message box
		function wpmb_toggle_chat() {
			wpmb_cont.classList.toggle('wpmessagebutton--opened');
			wpmb_chat.classList.toggle('wpmb_bounceIn');
			if (wpmessagebutton.customization.bubble_text != '') { wpmb_bubble.classList.toggle('wpmb_bounceOut'); }
		}
	}
});
