jQuery(document).ready(function($){
	"use strict";

	/* OPEN COUPON MODAL */
	var fetchingCode = false;
	function show_code_modal( $this, coupon_id ){
		if( !fetchingCode ){
			fetchingCode = true;
			if( $this ){
				$this.find( '.code-text-full' ).append('<i class="fa fa-circle-o-notch fa-spin"></i>');
				$this.find( '.code-text' ).append('<i class="fa fa-circle-o-notch fa-spin"></i>');
			}
			$.ajax({
				url: tp_coupon_overall_data.ajaxurl,

				method: 'POST',
				data: {
					action: 'show_code',
					coupon_id: coupon_id,
				},
				dataType: "HTML",
				success: function(response){
					$('#showCode .coupon_modal_content').html( response );
					$('#showCode').modal('show');
					if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
						$('.coupon-code-modal.print').attr( 'href', $('.coupon-print-image').attr('src') );
					}

					if( $this ){
						$this.find('i').remove();
					}
				},
				complete: function(){
					fetchingCode = false;
				}
			});			
		}
	}

	if( window.location.hash && window.location.hash.indexOf('o-') > 0 ){
		show_code_modal( false, window.location.hash.split('o-')[1] );
	}

	$(document).on( 'click', '.coupon-action-button', function(e){
		var $this = $(this);
		if( $this.data('affiliate') ){
			setTimeout(function(){
				window.location.href = $this.data('affiliate');
			}, 30);
		}
		else{
			e.preventDefault();
			var href = $this.attr( 'href' );
			show_code_modal( $this, href.split('o-')[1] );
		}
	});

	
	/* AUTOCOPY FOR NO PHONES */
	$(document).on('click', 'input.coupon-code-modal', function(e) {
		var $this = $(this);
		var isPhone = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ? true : false;
		e.preventDefault();
		if( isPhone ){
			var el = $this.get(0);
			var editable = el.contentEditable;
			var readOnly = el.readOnly;
			el.contentEditable = 'true';
			el.readOnly = 'false';
			var range = document.createRange();
			range.selectNodeContents(el);
			var sel = window.getSelection();
			sel.removeAllRanges();
			sel.addRange(range);
			el.setSelectionRange(0, 999999);
			el.contentEditable = editable;
			el.readOnly = readOnly;			
		}
		else{
			$this.select();
		}

		try {
			var success = document.execCommand('copy');
			if( success ){
				$('.coupon-code-copied').hide();
				$('.coupon-code-copied.after-copy').show();
			}
		} catch (err) {
			console.log('Oops, unable to copy');
		}

		if( isPhone ){
			el.contentEditable = 'false';
			el.readOnly = 'true';			
		}

	});



	/* COUPON FEEDBACK */
	var feedbackFlag = false;
	$(document).on('click', '.feedback-record-action', function(){
		var $this = $(this);
		
		if(!feedbackFlag){
			feedbackFlag = true;

			var feedback = $this.data('value');
			var couponId = $this.data('coupon_id');
			var nonce = tp_coupon_overall_data.nonce;

			$.ajax({
				url: tp_coupon_overall_data.ajaxurl,
				method: 'POST',
				data: {
					action: 'feedback',
					feedback: feedback,
					coupon_id: couponId,
					nonce: nonce
				},
				success: function(response){
					if(response.success){
						$this.parent().html(response.data.html);
					} else {
						alert(response.data.message); 
					}
				},
				complete: function(){
					feedbackFlag = false;
				}
			});
		}
	});


	/* TOGGLE CONTENT IN MODAL */
	$(document).on( 'click', '.modal-content-action', function(){
		$('#showCode .modal-coupon-content').toggleClass( 'hidden' );
	});


	// Coupon Search Ajax
	$('.tp-coupon-search-area').on('input change', '.tp-coupn-search-input, .tp-coupon-category', function() {
		var $searchWidget = $(this).closest('.tp-coupon-search-area'); 
		var searchQuery = $searchWidget.find('.tp-coupn-search-input').val(); 
		var category = $searchWidget.find('.tp-coupon-category').val();
		var $resultsContainer = $searchWidget.find('#coupon-search-results'); 
		$resultsContainer.addClass('d-none');

		if (searchQuery.length > 2 || category !== "") { 
			$resultsContainer.html('<p>Loading...</>').removeClass('d-none');

			$.ajax({
				url: tp_coupon_overall_data.ajaxurl,
				method: 'GET', 
				data: {
					action: 'coupon_search_ajax', 
					search_query: searchQuery,
					category: category, 
					nonce: tp_coupon_overall_data.nonce 
				},
				success: function(response) {
					if (response) {
						$resultsContainer.html(response).removeClass('d-none');
					} else {
						$resultsContainer.html('No coupons found.').removeClass('d-none');
					}
				},
				error: function(xhr, status, error) {
					console.log("AJAX Error: ", error);  
					$resultsContainer.html('Error fetching results.').removeClass('d-none');
				}
			});
		} else {
			$resultsContainer.addClass('d-none');
		}
	});

	// Close the results if clicked outside the search area
	$(document).click(function(event) {
		if (!$(event.target).closest('.tp-coupon-search-area').length) {
			$('.tp-coupon-search-area #coupon-search-results').addClass('d-none');
		}
	});


	//Store favourite Icon || Toggle the favorite bookmark Latter Removeable
	$(document).on('click', '.favorite-bookmark', function() {
		var $this = $(this);
		var couponId = $this.data('coupon-id');

		// Check if the coupon is already marked as favorite
		var favorites = JSON.parse(localStorage.getItem('favoriteCoupons')) || [];

		// If the coupon is in the favorites list, remove it
		if (favorites.includes(couponId)) {
			favorites = favorites.filter(function(id) {
				return id !== couponId;
			});
			$this.removeClass('favorite'); // Change icon
		} else {
			// Otherwise, add it to the favorites list
			favorites.push(couponId);
			$this.addClass('favorite'); // Change icon
		}

		// Update localStorage
		localStorage.setItem('favoriteCoupons', JSON.stringify(favorites));

		// Optionally, you can send this to the server using AJAX to persist on the backend (if necessary)
	});

	// On page load, check if any coupons are marked as favorites
	$(function() {
		var favorites = JSON.parse(localStorage.getItem('favoriteCoupons')) || [];
		$('.favorite-bookmark').each(function() {
			var couponId = $(this).data('coupon-id');
			if (favorites.includes(couponId)) {
				$(this).addClass('favorite'); // Add the 'favorite' class if it's in the list
			}
		});
	});


	// google map for store 
	// Check if the store location data is available and Google Maps API is loaded
	var $map = $('.contact-map');
	if ($map.length > 0 && typeof google != 'undefined' && typeof storeLocations != 'undefined' && storeLocations.length > 0) {
		var markersArray = [];
		var bounds = new google.maps.LatLngBounds();
		var mapOptions = { mapTypeId: google.maps.MapTypeId.ROADMAP };
		var map = new google.maps.Map($map[0], mapOptions);

		// Loop through each store location and create markers
		storeLocations.forEach(function (location) {
			var coords = location.split(','); // Assuming LATITUDE,LONGITUDE format
			if (coords.length === 2) {
				var latitude = parseFloat(coords[0]);
				var longitude = parseFloat(coords[1]);

				if (!isNaN(latitude) && !isNaN(longitude)) {
					var position = new google.maps.LatLng(latitude, longitude);
					bounds.extend(position);

					var marker = new google.maps.Marker({
						position: position,
						map: map,
						icon: tp_coupon_overall_data.marker_icon || '' // Use the localized marker icon
					});
				}
			}
		});

		// Adjust the map to fit the bounds of the markers
		map.fitBounds(bounds);

		// Optional: Set the zoom level if it's provided
		var listener = google.maps.event.addListener(map, "idle", function () {
			if (tp_coupon_overall_data.markers_max_zoom != '') {
				map.setZoom(parseInt(tp_coupon_overall_data.markers_max_zoom));
				google.maps.event.removeListener(listener);
			}
		});
	}

	$('.ajax-form').on('submit', function(e) {
		e.preventDefault();

		var form = $(this);
		var formData = form.serialize();

		$.ajax({
			url: tp_coupon_overall_data.ajaxurl,
			type: 'POST',
			data: formData,
			success: function(response) {
				if (response.success) {
					form.find('.ajax-form-result').html('<div class="alert alert-success">' + response.data + '</div>');
				} else {
					form.find('.ajax-form-result').html('<div class="alert alert-danger">' + response.data + '</div>');
				}
			},
			error: function() {
				form.find('.ajax-form-result').html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
			}
		});
	});

	/*Delete account */
	$('.delete-account').on('click', function(){
		var $this = $(this);
		var r = confirm( $this.data('confirm') );
		if( r ){
			$.ajax({
				url: tp_coupon_overall_data.ajaxurl,
				data: {
					action: 'couponis_delete_account'
				},
				dataType: 'json',
				success: function( res ){
					window.location.href = res.redirect;
				}
			})
		}
	});

	/* VALIDATE FORM */
	function validate_form($container) {
		var valid = true;
		$container.find('small.error').remove();
		$container.find('select, input, textarea').each(function () {
			var $$this = $(this);
			$$this.removeClass('error');

			if ($$this.is('[data-validation]') && ($$this.is(':visible') || ($$this.attr('type') == 'hidden' && $$this.parents('.input-group').is(':visible')))) {
				var validations = $$this.data('validation').split('|');
				for (var i = 0; i < validations.length; i++) {
					switch (validations[i]) {
						case 'length_conditional':
							if ($$this.val() !== '') {
								var num = parseInt($($$this.data('field_number_val')).val());
								if ($$this.val().split(/\r*\n/).length != num) {
									valid = false;
								}
							}
							break;
						case 'conditional':
							if ($$this.val() == '' && $('#' + $$this.data('conditional-field')).val() == '') {
								valid = false;
							}
							break;
						case 'required':
							if ($$this.val() == '') {
								valid = false;
							}
							break;
						case 'number':
							if (isNaN(parseInt($$this.val()))) {
								valid = false;
							}
							break;
						case 'email':
							if (!/\S+@\S+\.\S+/.test($$this.val())) {
								valid = false;
							}
							break;
						case 'match':
							if ($$this.val() !== $('input[name="' + $$this.data('match') + '"]').val()) {
								valid = false;
							}
							break;
						case 'checked':
							if (!$$this.prop('checked')) {
								valid = false;
							}
							break;
					}
				}
				if (!valid) {
					if ($$this.attr('type') == 'checkbox') {
						$$this.parent().before('<small class="no-margin error">' + $$this.data('error') + '</small><br />');
					} else {
						$$this.before('<small class="error">' + $$this.data('error') + '</small>');
					}
				}
			}
		});

		if ($container.find('#offer_description').length > 0) {
			var $desc_label = $('label[for="offer_description"]');
			$desc_label.parent().find('.error').remove();
			var tiny = '';
			if (typeof tinyMCE !== 'undefined' && tinyMCE.get('offer_description')) {
				tiny = tinyMCE.get('offer_description').getContent();
				$('#offer_description').val(tiny);
			} else {
				tiny = $('#offer_description').val();
			}
			if (tiny == '') {
				valid = false;
				$desc_label.after('<small class="error">' + $desc_label.data('error') + '</small>');
			}
		}
		return valid;
	}

	// Submit form
	$('.submit-form').click(function () {
		var $this = $(this);
		var $form = $this.parents('form');
		var can_submit = validate_form($form);

		if (can_submit) {
			if ($this.hasClass('register-form')) {
				var $text = $this.text();
				$this.append('<i class="fa fa-spin fa-spinner" style="margin-left: 10px;"></i>');
				$.ajax({
					url: tp_coupon_overall_data.ajaxurl,
					method: 'POST',
					data: $form.serialize(),
					dataType: 'JSON',
					success: function (response) {
						if (response.message.indexOf('success') > -1) {
							$('input').val('');
						}
						$('.ajax-response').html('<div class="white-block-content">' + response.message + '</div>');
					},
					complete: function () {
						$this.html($text);
					}
				});
			} else {
				$form.submit();
			}
		} else {
			var error_message = $('.submit-form').data('form-error');
			if (typeof error_message !== 'undefined') {
				$('.submit-form').after('<small class="submit-form-error error"><br />' + error_message + '</small>');
			}
		}
	});

	// Password Show Hide
	$('.show-hide-pass').on('click', function () {
		var passwordInput = $($(this).siblings("input"));
		if (passwordInput.attr("type") == "password") {
			passwordInput.attr("type", "text");
		} else {
			passwordInput.attr("type", "password");
		}
	});
	
    $(document).on('click', '.save-coupon-action', function() {
        var $this = $(this);
        $.ajax({
            url: tp_coupon_overall_data.ajaxurl,
            method: 'POST',
            data: {
                action: 'save_coupon',
                post_id: $this.data('post_id'),
                nonce: tp_coupon_overall_data.nonce
            },
            success: function(response) {
                if (response.success) {
                    $this.toggleClass('added');

                    if ($('.page-template-page-tpl_account').length > 0) {
                        $this.closest('.white-block').fadeOut(300, function() {
                            $(this).remove();
                        });
                    }
                } else {
                    alert(response.data.message);
                }
            },
            error: function() {
                alert('An error occurred. Please try again.');
            }
        });
    });

	/* COUNTDOWN */
	var $countdown = $('.countdown');
	if( $countdown.length > 0 ){
		$('.countdown').kkcountdown({
			dayText				: $countdown.data('single'),
			daysText 			: $countdown.data('multiple'),
			displayZeroDays 	: true,
			rusNumbers  		: false
		});
	}


	// Progress Canvas
	var $progress = $('#progress');
	if( $progress.length > 0 ){
		var can = $progress[0];
		var context = can.getContext('2d');


		var percentage = $progress.data('value');
		var degrees = percentage * 3.6;
		var radians = degrees * (Math.PI / 180);

		var s = 1.5 * Math.PI;

		context.beginPath();
		context.strokeStyle = $progress.data('color');
		context.lineWidth = 5;
		if( $(window).width() > 800 && $(window).width() < 900 ){
			var arcSize = 100;
		}
		else{
			var arcSize = 107;
		}
		context.arc(110, 110, arcSize, s, radians+s);
		context.stroke();
	}

	/* SUBMIT FORM */
	$(document).on( 'click', '.submit-form, .submit-ajax-form', function(){
		$(this).parents('form').submit();
	});

	/* REMEMBER COOKIE */
	var $orderby = $('.search-header .orderby');
	if( $orderby.length > 0 ){
		$orderby.on('change', function(){
			Cookies.set('couponis-orderby', $(this).val(), { expires: 1, path: '/' });
			window.location.reload();
		});
	}

});