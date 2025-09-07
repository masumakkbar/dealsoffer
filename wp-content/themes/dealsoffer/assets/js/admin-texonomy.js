jQuery(document).ready(function($){
    "use strict";

    /* handle image */
    function handle_images( frameArgs, callback ){
        var SM_Frame = wp.media( frameArgs );

        SM_Frame.on( 'select', function() {
            callback( SM_Frame.state().get('selection') );
            SM_Frame.close();
        });

        SM_Frame.open();	
    }		

    function imageExists(url, callback) {
        var img = new Image();
        img.onload = function() { callback(true); };
        img.onerror = function() { callback(false); };
        img.src = url;
    }	

    /* store image*/
    $(document).on( 'click', '.add_store_image', function(e) {
        e.preventDefault();
        var $this=  $(this);

        var frameArgs = {
            multiple: false,
            title: 'Select Image'
        };

        handle_images( frameArgs, function( selection ){
            var model = selection.first();
            $this.parent().find('input').val( model.id );
            var img = model.attributes.url;
            var ext = img.substring(img.lastIndexOf('.'));
            img = img.replace( ext, '-150x150'+ext );
            imageExists( img, function(exists){
                if( exists ){
                    $('.image-holder').html( '<img src="'+img+'"><a href="javascript:;" class="button remove_store_image">X</a>' );
                }
                else{
                    $('.image-holder').html( '<img src="'+model.attributes.url+'"><a href="javascript:;" class="button remove_store_image">X</a>' );
                }
            });
        });
    });	

    $(document).on( 'click', '.remove_store_image', function(){
        $(this).parents('td').find('input').val( '' );
        $('.image-holder').html('');
    });


	/* updated portion */

	$('.category_icon').on('change', function(){
		$('.icon-preview').html('<i class="fa fa-' + $(this).val() + '"></i>');
	});
	
	$(document).on('click', '.cat-icon', function(e){
		e.preventDefault();
	
		var frameArgs = {
			multiple: false,
			title: 'Select Image'
		};
	
		handle_images( frameArgs, function( selection ) {
			var attachment = selection.first();
	
			$('.icon-preview').html(`<img src="${attachment.attributes.url}" style="width: 50px; height: 50px;"><a href="#" class="cat-icon-remove button">X</a>`);
			$('select[name="category_icon"]').hide().append(`<option class="img-val" value="${attachment.id}">${attachment.id}</option>`).val(attachment.id);
			$('.cat-divider').hide();
		});
	});
	
	$(document).on('click', '.cat-icon-remove', function(e){
		e.preventDefault();
	
		$(this).parent().html('');
		$('select[name="category_icon"]').val('No Icon').show().find('.img-val').remove();
		$('.cat-divider').show();
	});
	


});
