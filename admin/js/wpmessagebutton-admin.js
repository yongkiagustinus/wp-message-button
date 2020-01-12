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
			wpmb_reorder_agents();
		}
	});

	// Media uploader
	var mediaUploader;
	$('.wpmb-add-agent-photo').click(function (e) {
		e.preventDefault();
		var imgPreview = $(this).siblings('img');
		var imgInput = $(this).siblings('input');

		if (mediaUploader) {
			mediaUploader.open();
			return;
		}
		mediaUploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Image',
			button: {
				text: 'Choose Image'
			}, multiple: false
		});
		mediaUploader.on('select', function () {
			var attachment = mediaUploader.state().get('selection').first().toJSON();
			imgPreview.attr('src', attachment.url);
			imgInput.val(attachment.url);
		});
		mediaUploader.open();
	});

	// Update agent fields order
	function wpmb_reorder_agents() {
		$('#agents .agent').each(function (i, e) {
			$(e)
				.data('agent', i)
				.attr('data-agent', i)
				.find('input,select,textarea').attr('name', function (idx, old) {
					return old.replace(/\[(\d+)\]/, '[' + i + ']');
				})
				.end()
				.find('input,select,textarea').attr('id', function (idx, old) {
					return old.replace(/\-(\d+)/, '-' + i);
				})
				.end()
				.find('label').attr('for', function (idx, old) {
					return old.replace(/\-(\d+)/, '-' + i);
				})
				.end()
				.find('input[type="radio"][checked="checked"]').prop('checked', true);
		});
	}

	// Add agent
	$(document).on('click', '#wpmb-add-agent', function (e) {
		e.preventDefault();
		$('#agents .agent').last().clone().appendTo($('#agents')).find('input:not([type="radio"]),select,textarea').val('');
		wpmb_reorder_agents();
		return false;
	});

	// Delete agent
	$(document).on('click', '.agent__delete', function (e) {
		if (confirm(wpmb_admin.delete_confirmation)) {
			if ($('#agents .agent').length == 1) {
				alert(wpmb_admin.minimum_agent_notice);
				return false;
			} else {
				$(this).parents('.agent').remove();
				wpmb_reorder_agents();
			}

		} else {
			return false;
		}
	});

	// Add time validation
	$.validator.addMethod("time", function (value, element) {
		return this.optional(element) || /^([01]\d|2[0-3]|[0-9])(:[0-5]\d){1,2}$/.test(value);
	}, wpmb_admin.input_time_invalid);

	// Form validation
	$('#wpmessagebutton-form').validate({
		errorPlacement: function () {
			return false;
		}
	});

})(jQuery);