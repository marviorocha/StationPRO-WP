jQuery(window).load(function() {
		if(jQuery('#slider') > 0) {
        jQuery('.nivoSlider').nivoSlider({
        	effect:'fade',
    });
		} else {
			jQuery('#slider').nivoSlider({
        	effect:'fade',
    });
		}
});
	
// First Word span
jQuery(window).load(function() { 
	// First word in title
	jQuery('h2.services_title').html(function(){	
		var text = jQuery(this).text().split(' ');
		var first = text.shift();
		return (text.length > 0 ? '<span>'+first+'</span> ' : first) + text.join(" ");
	});
});