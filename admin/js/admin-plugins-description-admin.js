(function ($) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$(window).load(function () {

		$('.apd-delete-button').hide();

		$('.apd-link').on('click', function () {
			$(this).closest('.column-description').find('.apd-form').toggleClass('hidden');

			if ($(this).closest('.column-description').find('.apd-textarea').text().length > 0) {
				$(this).closest('.column-description').find('.apd-delete-button').show();
			}
		});

		$(".apd-button").on("click", function () {
			const description = $(this).closest('.apd-form').find('.apd-textarea');
			$.ajax({
				url: adminPluginsDesription.ajaxurl,
				type: "POST",
				data: {
					action: "send_ajax_request",
					nonce: adminPluginsDesription.nonce,
					plugin: $(this).data("plugin"),
					description: description.val(),
				},
				success: function (response) {
					console.log('Success');
					$('.apd-button[data-plugin="' + response.data.plugin + '"]').closest('.apd-form').addClass('hidden');
					$('.apd-link[data-plugin="' + response.data.plugin + '"]').closest('.column-description').find('.apd-description').text(response.data.description).show();
					$('.apd-link[data-plugin="' + response.data.plugin + '"]').html('<span class="dashicons dashicons-edit"></span> Edit description');
					$('.apd-delete-button').show();
				},
				error: function (response) {
					console.log("AJAX Error: " + response.data);
				},
			});
		});

		$(".apd-delete-button").on("click", function () {

			$.ajax({
				url: adminPluginsDesription.ajaxurl,
				type: "POST",
				data: {
					action: "remove_description",
					nonce: adminPluginsDesription.nonce,
					plugin: $(this).data("plugin"),
				},
				success: function (response) {
					console.log('Success');
					$('.apd-button[data-plugin="' + response.data.plugin + '"]').closest('.apd-form').addClass('hidden');
					$('.apd-link[data-plugin="' + response.data.plugin + '"]').closest('.column-description').find('.apd-description').hide();
					$('.apd-link[data-plugin="' + response.data.plugin + '"]').html('<span class="dashicons dashicons-edit"></span> Add description');
					$('.apd-link[data-plugin="' + response.data.plugin + '"]').closest('.column-description').find('.apd-delete-button').hide();
					$('.apd-link[data-plugin="' + response.data.plugin + '"]').closest('.column-description').find('.apd-textarea').val('');
				},
				error: function (response) {
					console.log("AJAX Error: " + response.data);
				},
			});
		});
	});

})(jQuery);
