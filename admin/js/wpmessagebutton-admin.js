/**
 * Agents field
 */
(function ($) {

	// Agent field open / close
	$(document).on('click', '#agents .agent h2', function (e) {
		if (e.target !== this)
			return;

		$(this).next().slideToggle();
	});

	// Agents field sortable
	$('#agents').sortable({
		axis: 'y',
		handle: 'h2',
		placeholder: 'widget-placeholder',
		stop: function (event, ui) {
			ui.item.children('h2').triggerHandler('focusout');
			// Function to fix the forms order after sort
			console.log(ui.item.index());
		}
	});

	// Add agent
	$(document).on('click', '#wpmb-add-agent', function (e) {
		e.preventDefault();
		// Clone an agent field
		var agent = getOuterHTML($('#agents > div.agent'));

	});

	// Add time validation
	$.validator.addMethod("time", function (value, element) {
		return this.optional(element) || /^([01]\d|2[0-3]|[0-9])(:[0-5]\d){1,2}$/.test(value);
	}, "Please enter a valid time, between 00:00 and 23:59");

	// Form validation
	$('#wpmessagebutton-form').validate({
		errorPlacement: function () {
			return false;
		}
	});

	// Get outer HTML function for the addable fields
	function getOuterHTML(el) {
		var wrapper = '';
		if (el) {
			var inner = el.innerHTML;
			var wrapper = '<' + el.tagName;
			for (var i = 0; i < el.attributes.length; i++) {
				wrapper += ' ' + el.attributes[i].nodeName + '="';
				wrapper += el.attributes[i].nodeValue + '"';
			}
			wrapper += '>' + inner + '</' + el.tagName + '>';
		}
		return wrapper;
	}

})(jQuery);