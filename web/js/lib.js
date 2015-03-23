/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
jQuery(function(){
    jQuery(window).scroll(function () {
        if (jQuery(this).scrollTop() > 0) {
            jQuery('#scroller').fadeIn();
        } else {
            jQuery('#scroller').fadeOut();
        }
    });
    jQuery('#scroller').click(function () {
        jQuery('body,html').animate({
            scrollTop: 0
        }, 400);
        return false;
    });
    
    jQuery('.editor').ckeditor();
    
 jQuery('.editor2').ckeditor({
     toolbarGroups:[
         { name: 'document',	   groups: [ 'mode', 'document' ] },			// Displays document group with its two subgroups.
 		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },			// Group's name will be used to create voice label.
 		'/',																// Line break - next group will be placed in new line.
 		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
 		{ name: 'links' }
         
     ],
     
 });
 jQuery('.tags').taginput({
	style: 'bootstrap'
});

jQuery(".fancy").fancybox();

});


