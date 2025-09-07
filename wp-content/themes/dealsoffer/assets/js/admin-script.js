/**
*
* -----------------------------------------------------------------------------
*
* Template JS for Admin*
* -----------------------------------------------------------------------------
*
**/

(function($) {

	"use strict";
	 $('.radio-select label').on('click', function(event) {   
	    $('.radio-select label').removeClass('active');
	    $(this).addClass('active');	      
	});

	$('#meta-image-button').on('click', function() {
	    var send_attachment_bkp = wp.media.editor.send.attachment;
	    wp.media.editor.send.attachment = function(props, attachment) {
	        $('#meta-image').val(attachment.url);
	 		 $('#meta-image-preview').attr('src',attachment.url);
	        wp.media.editor.send.attachment = send_attachment_bkp;
	    }
	    wp.media.editor.open();
	    return false;
	});
	
	$(".meta-img-wrap i").on('click', function(){
		$('.meta-img-wrap').hide();
	    $("#meta-image").val('');
	});


	/* ######################################################################################
	 Admin js for Coupons 
	###################################################################################     */

	$(document).on( 'click', '.couponis-notice-dismiss', function(){
		$.ajax({
			url: ajaxurl,
			data: {
				action: 'couponis_notice_dismiss',
				option: $(this).data('option')
			}
		})
	});

	function show_type_fields( type ){
		if( type == 1 ){
			$('#coupon_code').show();
            $('#coupon_spec_link').show();
		}
		else if( type == 2 ){
			$('#coupon_printable').show();
		}
		else{
			$('#coupon_url').show();
		}
	}

	if( $('#ctype') ){
		show_type_fields( $('#ctype select').val() );

		$(document).on( 'change', '#ctype select', function(){
			$('#coupon_code, #coupon_url, #coupon_printable, #coupon_spec_link').hide();
			show_type_fields( $(this).val() );
		});
	}

	/* MARKER MANAGMENT */
	$(document).on( 'click', '.add-store-marker', function(e){
		e.preventDefault()
		var $last = $('.store-marker-wrap:last');
		var $clone = $last.clone();
		$clone.find('input').val('');
		$last.after( $clone );
	});

	$(document).on( 'click', '.remove-store-marker', function(e){
		e.preventDefault()
		var $parent = $(this).parent('.store-marker-wrap');
		if( $('.store-marker-wrap').length > 1 ){
			$parent.remove();
		}
		else{
			$parent.find('input').val('');
		}
	});

	
})(jQuery);