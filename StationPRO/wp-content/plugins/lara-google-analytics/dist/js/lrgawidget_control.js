
/**
 * @package    Google Analytics by Lara
 * @author     Amr M. Ibrahim <mailamr@gmail.com>
 * @link       https://www.xtraorbit.com/
 * @copyright  Copyright (c) WHMCSAdminTheme 2016 - 2017
 */

(function($) {
	
function lrWidgetSettings(arr){
	return $.ajax({
		method: "POST",
		url: lrgawidget_ajax_object.lrgawidget_ajax_url,
		data: arr,
		dataType: 'json'
	});

}	

$(document).ready(function(){
	$("#adv-settings fieldset").append('<label for="lrgawidget_panel_hide"><input id="lrgawidget_panel_hide" type="checkbox" >Lara, Google Analytics Dashboard Widget</label>');
		
	$('body').on('click', '#lrgawidget_panel_hide', function (e) {	
		var wstatevalue = "";
		if ($(this).is(":checked")){
			$("#lrgawidget").show();
			wstatevalue = "show";
			lrWidgetSettings({action : "lrgawidget_hideShowWidget", wstate: wstatevalue}).done(function (data, textStatus, jqXHR) {
				location.reload(true);
			});	
		}
	});			
		
});

})(jQuery);