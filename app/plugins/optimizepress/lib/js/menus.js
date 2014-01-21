// this file is loaded only on front end!

jQuery(document).ready(function(){
    //Loop through all menu items
    jQuery('body .container .navigation > ul > li > a').each(function(){
            var parentLi = jQuery(this).parent('li');
            var parentMenu = jQuery(this).parent().parent().parent().parent().parent().parent();
            if (!parentMenu.hasClass('page-header') && !parentMenu.hasClass('banner')) parentMenu = jQuery(this).parent().parent().parent().parent().parent().parent().parent().parent().parent();
            var bg = parentMenu.css('background-image');
            
            if (bg!='none') parentLi.addClass('no-transparency');
    });
    // fade in for elements only on frontend!
    jQuery("[data-fade]").each(function(){
    	var el = jQuery(this);
    	el
    		.css({opacity: 0.0, visibility: 'visible'})
    		.delay(parseInt(el.attr('data-fade'), 10) * 1000)
    		.animate({opacity: 1.0});
    });
});