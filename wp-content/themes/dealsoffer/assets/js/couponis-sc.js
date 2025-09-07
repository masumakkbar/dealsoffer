jQuery(document).ready(function($){
	"use strict";

    $('.social-login a').on('click', function(e){
        e.preventDefault();
        window.open(couponis_sc[$(this).attr('class')],'','scrollbars=no,menubar=no,height=500,width=900,resizable=yes,toolbar=no,status=no');
    });
});