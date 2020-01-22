(function ($) {

	// Open / close agent field
	$(document).on('click', '#agents .agent h2', function (e) {
		if (e.target !== this)
			return;

		$(this).next().slideToggle();
	});

	// WP media uploader
	var mediaUploader;
	$(document).on('click', '.wpmb-add-agent-photo', function (e) {
		e.preventDefault();
		var imgPreview = $(this).siblings('img');
		var imgInput = $(this).siblings('input');
		if (mediaUploader) {
			mediaUploader.open();
			return;
		}
		mediaUploader = wp.media.frames.file_frame = wp.media({
			title: wpmb_admin.choose_image,
			button: {
				text: wpmb_admin.choose_image
			}, multiple: false
		});
		mediaUploader.on('select', function () {
			var attachment = mediaUploader.state().get('selection').first().toJSON();
			imgPreview.attr('src', attachment.url);
			imgInput.val(attachment.url);
		});
		mediaUploader.open();
	});

	// WP color picker
	$('.wpmb-color-picker').wpColorPicker();

	// Update the default color when switching mode
	$('input[type=radio].wpmb-switch-mode').change(function () {
		if (this.value == 'light') {
			// Update header background default color
			$('#wpmb-header-bg-0').data('default-color', wpmessagebutton.default_color.header_bg.light[0]).attr('data-default-color', wpmessagebutton.default_color.header_bg.light[0]).wpColorPicker({ defaultColor: wpmessagebutton.default_color.header_bg.light[0] });
			$('#wpmb-header-bg-1').data('default-color', wpmessagebutton.default_color.header_bg.light[1]).attr('data-default-color', wpmessagebutton.default_color.header_bg.light[1]).wpColorPicker({ defaultColor: wpmessagebutton.default_color.header_bg.light[1] });
			// Update icon background default color
			$('#wpmb-icon-background').data('default-color', wpmessagebutton.default_color.icon_bg.light).attr('data-default-color', wpmessagebutton.default_color.icon_bg.light).wpColorPicker({ defaultColor: wpmessagebutton.default_color.icon_bg.light });
		}
		else if (this.value == 'dark') {
			// Update header background default color
			$('#wpmb-header-bg-0').data('default-color', wpmessagebutton.default_color.header_bg.dark[0]).attr('data-default-color', wpmessagebutton.default_color.header_bg.dark[0]).wpColorPicker({ defaultColor: wpmessagebutton.default_color.header_bg.dark[0] });
			$('#wpmb-header-bg-1').data('default-color', wpmessagebutton.default_color.header_bg.dark[1]).attr('data-default-color', wpmessagebutton.default_color.header_bg.dark[1]).wpColorPicker({ defaultColor: wpmessagebutton.default_color.header_bg.dark[1] });
			// Update icon background default color
			$('#wpmb-icon-background').data('default-color', wpmessagebutton.default_color.icon_bg.dark).attr('data-default-color', wpmessagebutton.default_color.icon_bg.dark).wpColorPicker({ defaultColor: wpmessagebutton.default_color.icon_bg.dark });
		}
	});

	// Add time validation method to jQuery.validate
	$.validator.addMethod("time", function (value, element) {
		return this.optional(element) || /^([01]\d|2[0-3]|[0-9])(:[0-5]\d){1,2}$/.test(value);
	}, wpmb_admin.input_time_invalid);

	$.validator.addMethod("timerange", function (value, element) {
		return this.optional(element) || /^(2[0-3]|1[0-9]|0[0-9]):([0-5][0-9])-(2[0-3]|1[0-9]|0[0-9]):([0-5][0-9]){1,2}$/.test(value);
	}, wpmb_admin.input_time_invalid);

	// Init form validation
	$('#wpmessagebutton-form').validate({
		errorPlacement: function () {
			return false;
		}
	});

})(jQuery);