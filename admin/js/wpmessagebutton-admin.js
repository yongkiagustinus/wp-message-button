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

	// Color Picker
	$('.wpmb-color-picker').wpColorPicker();

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