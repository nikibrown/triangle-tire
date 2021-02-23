/**
 * Scripts for theme
 */
jQuery(document).ready(function($){

	//Process the registration form submission
	$(document.body).on('submit', 'form.js-submit-dealer', function(event){
		event.preventDefault();
		var $form = $(this);
		var $notifier = $form.find('.js-notifications');
		var $submit_button = $form.find('[type="submit"]'),
			$submitval = $submit_button.html();

		$notifier.hide();
		$notifier.empty();
		$submit_button.attr('disabled', 'disabled').html('Processing...');

		var form_data = $form.serialize();
		$.ajax({
			type : "post",
			url : ajax_object.ajax_url,
			dataType: 'json',
			data : form_data,
			success: function(response) {
				if(response.success === true) {
					$form.find('input, textarea').filter(':visible').val('');
					$form.find('.js-posthide').hide();
					$notifier.html(response.message);
					$notifier.removeClass('warning').addClass('success').fadeIn();
					$('html, body').animate({scrollTop: $notifier.offset().top - 40}, 400);
				} else {
					$notifier.html(response.message);
					$notifier.addClass('warning').removeClass('success').fadeIn();
					$(document.body).animate({scrollTop: $notifier.offset().top - 40 }, 400);
				}
			},
			error: function() {
				$notifier.html('Unable to process');
				$notifier.addClass('warning').removeClass('success').fadeIn();
				$('html, body').animate({scrollTop: $notifier.offset().top - 40}, 400);
			}
		});
		$submit_button.removeAttr('disabled').html($submitval);

	});

	$(document.body).on('click', '.js-email', function(event){
		event.preventDefault();
		var theID = $(this).data('id');
	});

	$(document.body).on('click', '.js-print', function(event){
		event.preventDefault();
		var theID = $(this).data('id');

		$('#js-printblock').print({
			globalStyles: true,
			mediaPrint: false,
			stylesheet: null,
			noPrintSelector: ".no-print",
			iframe: true,
			append: null,
			prepend: null,
			manuallyCopyFormValues: true,
			deferred: $.Deferred().done(function(){

			}),
			timeout: 750,
			title: null,
			doctype: '<!doctype html>'
		});
	});

	if($('.js-instantprint') !== undefined && $('.js-instantprint').length > 0) {
		setTimeout(function() {
			$('#js-printblock').print({
				globalStyles: true,
				mediaPrint: false,
				stylesheet: null,
				noPrintSelector: ".no-print",
				iframe: true,
				append: null,
				prepend: null,
				manuallyCopyFormValues: true,
				deferred: $.Deferred().done(function(){

				}),
				timeout: 750,
				title: null,
				doctype: '<!doctype html>'
			});
		}, 50);
	}

	$(document.body).on('click', '.js-addtoprint', function(event){
		$(this).toggleClass('js-queued');
		var baselink = 'mailto:?subject=Tires from Triangle&body=';
		$('form.js-printitems').find('input[name="selection[]"]').remove();
		$('.js-replace-links').attr('href', '#');
		var newlinks = [];
		$('.js-queued').each(function(){
			$('form.js-printitems').append('<input type="hidden" name="selection[]" value="' + $(this).data('id') + '" />');
			//get the email link
			newlinks.push($(this).data('link'));
		});
		if($('form.js-printitems').find('input[name="selection[]"]').length > 0) {
			$('.js-init-batchprint').show();
			$('.js-replace-links').attr('href', baselink + newlinks.join('%0D%0A' ) );
		} else {
			$('.js-init-batchprint').hide();
		}

	});

	$(document).on(
		'open.zf.reveal', '[data-reveal]', function () {
			$(this).find('input').filter(':visible').first().focus();
		}
	);

	$(document.body).on('click', '.js-init-batchprint', function(event){
		event.preventDefault();
		var selectedItems = $('form.js-printitems').find('input[name="selection[]"]').length;
		if(selectedItems > 0) {
			$('#modal-inputs').foundation('open');
			console.log(selectedItems);
			//$('form.js-printitems').submit();
		}
	});

	$(document.body).on('submit', 'form.js-printitems', function(event){
		$(this).submit();
	});


	$(document.body).on('change', '.js-change-view', function(event){
		if($(this).val() != '') {
			window.location.href = site_options.base + '/' + $(this).val();
		}
	});
});