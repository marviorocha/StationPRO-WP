
/**
 * @package    Google Analytics by Lara
 * @author     Amr M. Ibrahim <mailamr@gmail.com>
 * @link       https://www.xtraorbit.com/
 * @copyright  Copyright (c) WHMCSAdminTheme 2016 - 2017
 */

window.gauthWindow = function (url) {
      var newWindow = window.open(url, 'name', 'height=600,width=450');
      if (window.focus) {
        newWindow.focus();
      }
}

window.debugWindow = function () {
      var newWindow = window.open('', 'Debug', 'height=600,width=600,scrollbars=yes');
	  newWindow.document.write("<pre>"+JSON.stringify(lrgawidget_debug, null, " ")+"</pre>");
      if (window.focus) {
        newWindow.focus();
      }
}

window.lrgawidget_debug;

(function($) {

	
var dateRange = {};
var systemTimeZone;
var gaViewTimeZone;
var lrsessionStorageReady = false;
var setup = false;
var debug = false;


function isObject(val) {
    if (val === null) { return false;}
    return ( (typeof val === 'function') || (typeof val === 'object') );
}

function reloadCurrentTab(){
   var $link = $('#lrgawidget li.active a[data-toggle="tab"]');
   $link.parent().removeClass('active');
   var tabLink = $link.data('target');
   $('#lrgawidget a[data-target="' + tabLink + '"]').tab('show');	
}

function lrgaErrorHandler(err){
	var error;
	var error_description;
	var error_code;
	var error_debug;
	var message;
	if (typeof err === 'object'){
		error = ((err.error != null) ? "["+err.error+"]" : "");
		error_description = ((err.error_description != null) ? err.error_description : "");
		error_code = ((err.code != null) ? "code ["+err.code+"]" : "");	
		if (err.debug != null){
			error_debug = "<a href='javascript:debugWindow();'>debug</a>";
			lrgawidget_debug = err.debug;
		}
        message = "Error "+error_code+" "+error_debug+":<br> "+error+" "+error_description;
	}else {
		message = err;
	}
    $("#lrgawidget_error").html('<h4><i class="icon fa fa-ban"></i> '+message+'</h4>');
	$("#lrgawidget_error").removeClass("hidden");	
}

function lrWidgetSettings(arr){
	$("#lrgawidget_error").html("").addClass("hidden");
	$("#lrgawidget_mode").html("");
	$("#lrgawidget_loading").html('<i class="fa fa-spinner fa-pulse"></i>');

	if (arr[0]){
		arr[0].value = "lrgawidget_"+arr[0].value;
	}else{
		arr['action'] = "lrgawidget_"+arr['action'];
	}
	if (typeof arr === 'object'){
		try {
			arr.push({name: 'start', value: dateRange.start});
			arr.push({name: 'end', value: dateRange.end});
		}catch(e){
			arr['start'] = dateRange.start;
			arr['end'] = dateRange.end;
		}
	}

	if (debug){console.log(arr)};
	return $.ajax({
		method: "POST",
		url: lrgawidget_ajax_object.lrgawidget_ajax_url,
		data: arr,
		dataType: 'json'
	})
	.done(function (data, textStatus, jqXHR) {
		if (debug){console.log(data)};
		if (data.status != "done"){
			lrgaErrorHandler(data);
		}
		
		if (data.setup === 1){
			setup = true;
			if ($("#lrgawidget a[data-target='#lrgawidget_settings_tab']").is(":visible")){
				$("#lrgawidget a[data-target='#lrgawidget_settings_tab']").tab('show');
			}else{
				lrgaErrorHandler("Initial Setup Required!<br><br>Please contact an administratior to complete the widget setup.");
			}
		}
		
		if (data.status == "done"){
			if (data.cached){ $("#lrgawidget_mode").attr( "class", "label label-success").html('cached');}
			if (data.system_timezone){ systemTimeZone = data.system_timezone;}
			if (data.gaview_timezone){ gaViewTimeZone = data.gaview_timezone;}
		}		
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
		lrgaErrorHandler(errorThrown);
		if (debug){
			console.log(jqXHR);
			console.log(textStatus);
			console.log(errorThrown);
		}
	})		
	.always(function (dataOrjqXHR, textStatus, jqXHRorErrorThrown) {
		$("#lrgawidget_loading").html("");
		$("#lrgawidget_loading_big").hide();
	});
}


var lrgaAccounts;
var lrgaProfiles;
var lrgaaccountID; 
var webPropertyID;
var profileID;
var webPropertyUrl;


function getProfileDetails(id){
	var cProfile = {};
	$.each(lrgaProfiles, function( index, profile ) {
		if (profile.id && profile.id == id){
			cProfile = profile;
		}
	});
	return cProfile;
}

function populateViews(){
	$('#lrgawidget-accounts').html("");
	$('#lrgawidget-properties').html("");
	$('#lrgawidget-profiles').html("");
    
	$.each(lrgaAccounts, function( index, account ) {
		if (account.id){
			if (!lrgaaccountID){lrgaaccountID = account.id;}
			$('#lrgawidget-accounts').append($("<option></option>").attr("value",account.id).text(account.name)); 
			if (account.id == lrgaaccountID){
				$("#lrgawidget-accname").html(account.name);
				if (account.webProperties){
					$.each(account.webProperties, function( index, webProperty ) {
						if (!webPropertyID){webPropertyID = webProperty.id;}
						$('#lrgawidget-properties').append($("<option></option>").attr("value",webProperty.id).text(webProperty.name + " - [ " + webProperty.id + " ] "));
						if (webProperty.id == webPropertyID){
							$("#lrgawidget-propname").html(webProperty.name);
							$("#lrgawidget-propurl").html(webProperty.websiteUrl+ " - [ " + webProperty.id + " ] ");
							webPropertyUrl = webProperty.websiteUrl;
							if (webProperty.profiles){
								$.each(webProperty.profiles, function( index, profile ) {
									if (!profileID){profileID = profile.id;}
									$('#lrgawidget-profiles').append($("<option></option>").attr("value",profile.id).text(profile.name));
									if (profile.id == profileID){
										$("#lrgawidget-vname").html(profile.name);
										$("#lrgawidget-vtype").html(profile.type);
										var cProfile = getProfileDetails(profile.id);
										$("#lrgawidget-vtimezone").html(cProfile.timezone);
										$('#lrgawidget-setProfileID input[name=profile_timezone]').val(cProfile.timezone);
										if (cProfile.timezone != systemTimeZone){
											$("#lrgawidget-tz-error-vtimezone").html(cProfile.timezone);
											$("#lrgawidget-tz-error-stimezone").html(systemTimeZone);
											$("#lrgawidget-timezone-show-error").show();
										}else{
											$("#lrgawidget-timezone-show-error").hide();
											$("#lrgawidget-timezone-error").hide();
										}
									}
								});
							}
						}											 
					});
				}
			}
		}
	});


	$('#lrgawidget-accounts').val(lrgaaccountID);
	$('#lrgawidget-properties').val(webPropertyID);
	$('#lrgawidget-profiles').val(profileID);
	
}

$(document).ready(function(){
	
    $("#lrgawidget-credentials").submit(function(e) {
        e.preventDefault();
		lrWidgetSettings($("#lrgawidget-credentials").serializeArray()).done(function (data, textStatus, jqXHR) {
			$('#lrga-wizard').wizard('selectedItem', {step: "lrga-getCode"});
			$('#lrga-wizard #code-btn').attr('href','javascript:gauthWindow("'+data.url+'");');
			$('#lrgawidget-code input[name="client_id"]').val($('#lrgawidget-credentials input[name="client_id"]').val());
			$('#lrgawidget-code input[name="client_secret"]').val($('#lrgawidget-credentials input[name="client_secret"]').val());
		})
	});
	
	
    $("#lrgawidget-code").submit(function(e) {
        e.preventDefault();
		lrWidgetSettings($("#lrgawidget-code").serializeArray()).done(function (data, textStatus, jqXHR) {
			if (data.status == "done"){
				$('#lrga-wizard').wizard('selectedItem', {step: "lrga-profile"});
			}
		})
	});	
	
    $("#express-lrgawidget-code").submit(function(e) {
        e.preventDefault();
		lrWidgetSettings($("#express-lrgawidget-code").serializeArray()).done(function (data, textStatus, jqXHR) {
			if (data.status == "done"){
				$('#lrga-wizard').wizard('selectedItem', {step: "lrga-profile"});
			}
		})
	});		
	
	
    $("#lrgawidget-setProfileID").submit(function(e) {
        e.preventDefault();
		lrWidgetSettings($("#lrgawidget-setProfileID").serializeArray()).done(function (data, textStatus, jqXHR) {
			if (data.status == "done"){
				$("#lrgawidget a[data-target^='#lrgawidget_']:eq(1)").click();
			}
		})	
	});		
	
	$('#lrga-wizard').on('changed.fu.wizard', function (evt, data) {
		if ($("[data-step="+data.step+"]").attr("data-name") == "lrga-profile"){
			lrWidgetSettings({action: "getProfiles"}).done(function (data, textStatus, jqXHR) {
				if (data.status == "done"){
					lrgaaccountID = data.current_selected.account_id;
					webPropertyID = data.current_selected.property_id;
					profileID = data.current_selected.profile_id;
					lrgaAccounts = data.all_accounts;
					lrgaProfiles = data.all_profiles;
					populateViews();
					setup = false;
				}
			})
		}
	});
	
	$('#lrgawidget-accounts').on('change', function() {
		lrgaaccountID = this.value;
		webPropertyID = "";
		profileID = "";
		populateViews();
	});

	$('#lrgawidget-properties').on('change', function() {
		webPropertyID = this.value;
		profileID = "";
		populateViews();
	});	

	$('#lrgawidget-profiles').on('change', function() {
		profileID = this.value;
		populateViews();
	});	

	$('#lrgawidget-timezone-show-error').on('click', function(e) {
		 e.preventDefault();
		 $("#lrgawidget-timezone-error").toggle();
	});

	$('a[data-reload="lrgawidget_reload_tab"]').on('click', function(e) {
		 e.preventDefault();
		 reloadCurrentTab();
	});
	
	$('a[data-reload="lrgawidget_go_advanced"]').on('click', function(e) {
		 e.preventDefault();
		 $("#lrgawidget_express_setup").hide();
		 $("#lrgawidget_advanced_setup").show();
		 $("[data-reload='lrgawidget_go_express']").show();
		 
	});	
	
	$('[data-reload="lrgawidget_go_express"]').on('click', function(e) {
		 e.preventDefault();
		 $("#lrgawidget_error").html("").addClass("hidden");
		 $("#lrgawidget_advanced_setup").hide();
		 $("[data-reload='lrgawidget_go_express']").hide();
		 $('#lrga-wizard').wizard('selectedItem', {step: 1});
		 $("#lrgawidget_express_setup").show();
	});	
	
});


var pieColors = ['#8a56e2','#cf56e2','#e256ae','#e25668','#e28956','#e2cf56','#aee256','#68e256','#56e289','#56e2cf','#56aee2','#a6cee3'];
pieColors.reverse(); 



var pieObjects = {};

function tooltipFunction(v, pieData, legendHeader){
	var percent;
	var tip;
	$.each(pieData, function( i, obj ){
		if (v.value == obj.value){
			percent = obj.percent;
			return false;
		}
	});
	if (percent){
		tip = legendHeader+" "+v.label+" - Sessions: "+v.value+" - "+percent+" %";
	}else{
		tip = legendHeader+" "+v.label+" - Clicks: "+v.value;
	}
	return tip;
}
	
function drawDPieChart (tabName, pieData, legendHeader , iconName , iconColor ) {
	var chartName = "#lrgawidget_"+tabName+"_chartDiv";
	var legendName = "#lrgawidget_"+tabName+"_legendDiv";
	
	$(legendName).empty();
	 if(pieObjects[tabName]!=null  && !$.isEmptyObject(pieObjects[tabName])){
		pieObjects[tabName].destroy();
		pieObjects[tabName] = {};
	}
		
	if ($(chartName).is(":visible")){
		var helpers = Chartv1.helpers;
		var options = { animateRotate : true,
						animationSteps: 100,
						segmentShowStroke : true, 
						animationEasing: 'easeInOutQuart',
						middleIconName: iconName,
						middleIconColor: iconColor,
						legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><i class=\"fa fa-circle-o fa-fw\" style=\"color:<%=segments[i].fillColor%>\"></i>  <%if(segments[i].label){%><%if(segments[i].label.length > 18){%><%=segments[i].label.substring(0, 18)%><%=\" ...\"%><%}else{%><%=segments[i].label%><%}%><%}%>   </li><%}%></ul>",
						tooltipTemplate: function(v) {return tooltipFunction(v, pieData, legendHeader);}
						 };
		var ctx = $(chartName).get(0).getContext("2d");

		var moduleDoughnut  = new Chartv1(ctx).DoughnutWithMiddleIcon(pieData,options);

		pieObjects[tabName] = moduleDoughnut;
		
			var legendHolder = document.createElement('div');
			legendHolder.innerHTML = moduleDoughnut.generateLegend();
			helpers.each(legendHolder.firstChild.childNodes, function(legendNode, index){
				helpers.addEvent(legendNode, 'mouseover', function(){
					var activeSegment = moduleDoughnut.segments[index];
					activeSegment.save();
					activeSegment.fillColor = activeSegment.highlightColor;
					moduleDoughnut.showTooltip([activeSegment]);
					activeSegment.restore();
				});
			});
			helpers.addEvent(legendHolder.firstChild, 'mouseout', function(){
				moduleDoughnut.draw();
			});
			
			$(legendName).append(legendHolder.firstChild);
	}
	
}

var browsersIcons = {"chrome":{"hex": "\uf268", "icon" : "fa-chrome", "color" : "#4587F3"},
                     "firefox":{"hex": "\uf269", "icon" : "fa-firefox", "color" : "#e66000"},
					 "safari":{"hex": "\uf267", "icon" : "fa-safari", "color" : "#1B88CA"},
					 "safari (in-app)":{"hex": "\uf179", "icon" : "fa-apple", "color" : "#979797"},
					 "internet explorer":{"hex": "\uf26b", "icon" : "fa-internet-explorer", "color" : "#1EBBEE"},
					 "edge":{"hex": "\uf282", "icon" : "fa-edge", "color" : "#55acee"},
					 "opera":{"hex": "\uf26a", "icon" : "fa-opera", "color" : "#cc0f16"},
					 "opera mini":{"hex": "\uf26a", "icon" : "fa-opera", "color" : "#cc0f16"},
					 "android browser":{"hex": "\uf17b", "icon" : "fa-android", "color" : "#a4c639"},
					 "mozilla compatible agent":{"hex": "\uf136", "icon" : "fa-maxcdn", "color" : "#FF6600"},
					 "default_icon":{"hex": "\uf022", "icon" : "fa-list-alt", "color" : "#1EBBEE"}
					 };
						  
var osIcons = {"chrome os":{"hex": "\uf268", "icon" : "fa-chrome", "color" : "#4587F3"},
               "ios":{"hex": "\uf179", "icon" : "fa-apple", "color" : "#979797"},
			   "windows":{"hex": "\uf17a", "icon" : "fa-windows", "color" : "#1EBBEE"},
			   "linux":{"hex": "\uf17c", "icon" : "fa-linux", "color" : "#000000"},
			   "macintosh":{"hex": "\uf179", "icon" : "fa-apple", "color" : "#979797"},
			   "windows phone":{"hex": "\uf17a", "icon" : "fa-windows", "color" : "#1EBBEE"},
			   "android":{"hex": "\uf17b", "icon" : "fa-android", "color" : "#a4c639"},
			   "default_icon":{"hex": "\uf108", "icon" : "fa-desktop", "color" : "#1EBBEE"}
			   };

var devicesIcons = {"desktop":{"hex": "\uf108", "icon" : "fa-desktop", "color" : "#1EBBEE"},
					"mobile":{"hex": "\uf10b", "icon" : "fa-mobile", "color" : "#1EBBEE"},
					"tablet":{"hex": "\uf10a", "icon" : "fa-tablet", "color" : "#1EBBEE"},
					"default_icon":{"hex": "\uf108", "icon" : "fa-desktop", "color" : "#1EBBEE"}
			   };			   

var languagesIcons = {"default_icon":{"hex": "\uf031", "icon" : "fa-font", "color" : "#1EBBEE"}};
var screenresIcons = {"default_icon":{"hex": "\uf0b2", "icon" : "fa-arrows-alt", "color" : "#1EBBEE"}};
var pagesIcons = {"default_icon":{"hex": "\uf016","icon" : "fa-file-o", "color" : "#1EBBEE"}};

var dataTableDefaults = { "paging": true,
						  "pagingType": "full",
						  "lengthChange": false,
						  "searching": false,
						  "ordering": true,
						  "info": true,
						  "autoWidth": false,
						  "pageLength": 7,
						  "retrieve": true,
						  "columnDefs": [{ "width": "60%", "targets": 0 }],
						  "order": [[ 1, "desc" ]]};
						  
function getIcon (name, icons){
	var sname = name.toLowerCase();
	if ( icons[sname] ){
		return {"hex" : icons[sname]['hex'], "name" : icons[sname]['icon'], "color" : icons[sname]['color']};
	}else{
		return {"hex" : icons['default_icon']['hex'], "name" : icons['default_icon']['icon'], "color" : icons['default_icon']['color']};
	}
}

function prepareTable(tableName, options){
	var settings = $.extend({}, dataTableDefaults, options);
	var table = $(tableName).DataTable(settings);
	return table;
}

function prepareData(data, icons){
	var pieData = [];
	var tableData = [];
	var combined = 0;
	var combinedPercent = 0;
	var lIndex = 0;	
	
	$.each(data, function( i, row ){
		if ((typeof row === 'object') && (row)){
			var tableLabel = row[0];
			var pieLabel   = row[0];
			var rawLabel   = row[0];
			if ($.isArray(row[0])){
				rawLabel   = row[0][0];
				tableLabel = row[0][1] + "<br><i class='fa fa-arrow-circle-right fa-lg fa-fw' style='color:#1EBBEE;'></i>&nbsp;&nbsp;<a href='//" + row[0][0] + "' target='_blank'>" + row[0][0] + "</a>";
				pieLabel   = row[0][1];
			}
			var icon = getIcon (pieLabel, icons);
			if ((row[2] <= 1) || (i >= 11)){
				combined = combined + parseFloat(row[1]);
				combinedPercent = combinedPercent + parseFloat(row[2]);
			}else{
				pieData[i] = { label: pieLabel,  value: row[1], percent: row[2] ,color: pieColors[i]};
			}
			
			tableData[i] = [rawLabel,"<i class='fa "+icon.name+" fa-lg fa-fw' style='color:"+icon.color+";'></i>&nbsp;&nbsp;"+tableLabel,row[1],row[2]+" %"];
			lIndex = i;
		}
	});
	if ( combined > 0){
		pieData.push({label: "Others",  value: combined,  percent: parseFloat(Math.round(combinedPercent * 100) / 100).toFixed(2), color: pieColors[lIndex]});
	}
	return [tableData, pieData];
}

function drawTablePie(tabName, callName, icons){
	var tableName = "#lrgawidget_"+tabName+"_dataTable";
	var pieData = [];
	var options = {"columnDefs": [{"targets": [ 0 ],"visible": false,"searchable": false},{ "width": "60%", "targets": 1 }],
	               "order": [[ 2, "desc" ]]	};
	   
	var table = prepareTable(tableName, options);
	table.clear();
	
	lrWidgetSettings({action : callName}).done(function (data, textStatus, jqXHR) {
		if (data.status == "done"){
			var processedData = prepareData(data, icons);
			table.rows.add(processedData[0]);
			table.draw();
			drawDPieChart(tabName, processedData[1],"",icons['default_icon']['hex'], icons['default_icon']['color']);
		}
	});
	return table;			
}


var mainChart;
var mainChartDefaults = {"grid"   : {axisMargin: 20, hoverable: true, borderColor: "#f3f3f3",	borderWidth: 1,	tickColor: "#f3f3f3", mouseActiveRadius: 350},
						 "series" : {shadowSize: 1},
						 "lines"  : {fill: true, color: ["#3c8dbc", "#f56954"]},
						 "yaxes"  : [{ min: 0 }],
						 "xaxis"  : {mode: "time",timeformat: "%b %d"},
						 "colors" : ["#3c8dbc"],
						 "legend" : {show: true, container:'#lrga-legendholder'}};
						 
var lastFlotIndex = null;
var currentPlotData = {};

function lrTickFormatter (val, axis){
	if(Math.round(val) !== val) { val = val.toFixed(2);}
	return axis.options.lrcustom.before + val +" "+ axis.options.lrcustom.after;
}

function lrLegendFormatter(label, series){
   if (series.lrcustom.total >= 0){
	   return label+"</td><td class='legendEarnings'>"+series.lrcustom.before + series.lrcustom.total+" "+series.lrcustom.after+"</td><td>|</td><td class='legendSales'>"+series.lrcustom.totalorders;
   }
}						 

function drawGraph(data,name){
	var settings = mainChartDefaults;
	var totalSales = 0;
	var totalEarnings = 0;	
	var gData = [{ data:data["data"], label:data["label"], lines: { show: true },points: { show: true}, lrcustom: {before: data["lrbefore"], after: data["lrafter"], format: data["lrformat"]}}];
	$("#lrgawidget_sessions_chart_tooltip").remove();
	$("#lrgawidget_sessions_chartDiv").removeData("plot").empty();

	if (mainChart){
        mainChart.shutdown();
		mainChart.destroy();
        mainChart = null;
		lastFlotIndex = null;
		currentPlotData = {};
	}

	mainChart = $.plot($("#lrgawidget_sessions_chartDiv"), gData, settings);
	currentPlotData = mainChart.getData();

	if( $('#lrga-legendholder').is(':empty')) {$("#lrga-legendholder").hide();}	else{$("#lrga-legendholder").show();}
	
	if ((totalSales > 0 || totalEarnings > 0) && (graphData.settings.showtotal == "on") ){
		$("#lrga-legendholder table tr:last").after('<tr class="legendTotals"><td class="legendColorBox"></td><td class="legendLabel">Total</td><td class="legendEarnings">'+plotData["earnings"]["config"]["lrbefore"]+totalEarnings.toFixed(2)+plotData["earnings"]["config"]["lrafter"]+'</td><td>|</td><td class="legendSales">'+totalSales+'</td></tr>');	
	}	
	
	$('<div class="tooltip-inner" id="lrgawidget_sessions_chart_tooltip"></div>').css({
		"text-align": "left",
		"position": "absolute",
		"display": "none",
		"opacity": 0.8
	}).appendTo("body");

	$("#lrgawidget_sessions_chartDiv").bind("plothover", function (event, pos, item) {
		if (item) {
			if  ((lastFlotIndex != item.dataIndex)){
				lastFlotIndex = item.dataIndex;
				if (debug){ console.log(item);
							console.log(currentPlotData);
							console.log(lastFlotIndex);
					}
				var x = item.datapoint[0].toFixed(2);
				var y = item.datapoint[1];
				var rightMargin = "auto";
				var leftMargin  = "auto";
				var formattedDateString = moment(item.datapoint[0]).format('ddd, MMMM D, YYYY');
				
				var currToolTipText = formattedDateString + "<br>";
				var totalorders = 0;
				$.each(currentPlotData, function( i, dSeries ){
					if (typeof dSeries.lrcustom !== 'undefined') {
						var cItem = dSeries.data[item.dataIndex][1];
						var tOrders = ((totalorders > 0) ? "| "+totalorders : "");
						if (cItem > 0 || totalorders > 0){
							if (dSeries.lrcustom.format == "seconds"){ cItem = formatSeconds(cItem);}
							currToolTipText += '<div style="display: inline-block;padding:1px;"><div style="width:4px;height:0;border:4px solid '+dSeries.color+';overflow:hidden"></div></div><div style="display: inline-block;padding-left:5px;">'+dSeries.label+' : '+dSeries.lrcustom.before + cItem + " " + dSeries.lrcustom.after +tOrders+"</div><br>";
						}
					}else{
						totalorders = dSeries.data[item.dataIndex][1];
					}
				});
				
				if(item.pageX + 350 > $(document).width()){ 
					rightMargin = ($(document).width() - item.pageX) + 15;
				}else{
					leftMargin  = item.pageX + 15;
				}
				
				$("#lrgawidget_sessions_chart_tooltip").html(currToolTipText)
					.css({top: item.pageY - 25, left: leftMargin, right: rightMargin})
					.show();
			}
		} else {
			lastFlotIndex = null;
			$("#lrgawidget_sessions_chart_tooltip").hide();
			$("#lrgawidget_sessions_chart_tooltip").empty();
		}
	});
}

function formatSeconds(totalSec){
	var hours   = Math.floor(totalSec / 3600);
	var minutes = Math.floor((totalSec - (hours * 3600)) / 60);
	var seconds = totalSec - (hours * 3600) - (minutes * 60);
	var fseconds = seconds.toFixed(0);
	var result = (hours < 10 ? "0" + hours : hours) + ":" + (minutes < 10 ? "0" + minutes : minutes) + ":" + (fseconds  < 10 ? "0" + fseconds : fseconds);	
	return result;
}

function drawSparkline(id, data, color){
	if (!color){color = '#b1d1e4';}
	$(id).sparkline(data.split(','), {
		type: 'line',
		lineColor: "#3c8dbc",
		fillColor: color,
		spotColor: "#3c8dbc",
		minSpotColor: "#3c8dbc",
		maxSpotColor: "#3c8dbc",
		drawNormalOnTop: false,
		disableTooltips: true,
		disableInteraction: true,
		width:"100px"
		});
}

var plotData = {};
var plotTotalData = {};
var selectedPname = "";

function drawMainGraphWidgets(data, selected){
	if ($('#lrgawidget_sb-main').is(":visible")){
		$.each(data, function( name, raw ){
			var appnd = "";
			var color = "";
			if ((name == "percentNewSessions") || (name == "bounceRate")){ appnd = " %";} 
			if (name == selected ){  color = "#77b2d4";} 		
			$("#lrgawidget_sb_"+name+" .description-header").html(raw['total']+appnd);
			drawSparkline("#lrgawidget_spline_"+name, raw['data'], color);
		});
	}
}

function drawMainGraph(){
	lrWidgetSettings({action : "getSessions"}).done(function (data, textStatus, jqXHR) {
		if (data.status == "done" && data.setup !== 1){
			plotData = data.plotdata;
			plotTotalData = data.totalsForAllResults;
			if (!selectedPname){selectedPname = "sessions";}
			drawGraph(plotData[selectedPname], selectedPname);
			drawMainGraphWidgets(plotTotalData);
			$("#lrgawidget_sb_"+selectedPname).addClass("selected");
		}
	});	
}


$(document).ready(function(){
	
	dateRange = {start : moment().subtract(29, 'days').format('YYYY-MM-DD'),  end : moment().format('YYYY-MM-DD')};

    $('#lrgawidget_reportrange').html(moment(dateRange.start).format('MMMM D, YYYY') + ' - ' + moment(dateRange.end).format('MMMM D, YYYY'));
	$("[data-lrgawidget-reset]").on('click', function () {
		if (confirm("All saved authentication data will be removed.\nDo you want to continue ?!") == true) {
			lrWidgetSettings({action : "settingsReset"}).done(function (data, textStatus, jqXHR) {
				if (data.status == "done"){
					$('#lrga-wizard').wizard('selectedItem', {step: 1});
					$("[data-lrgawidget-reset]").hide();
				}
			});	
		}
	});
	
	$("#lrgawidget_main a[data-toggle='tab']").on('shown.bs.tab', function (e) {

		$("#lrgawidget_sessions_chart_tooltip").remove();
		
		if (this.hash == "#lrgawidget_settings_tab"){
			if (!setup){
				$('#lrga-wizard').wizard('selectedItem', {step: "lrga-profile"});
				$("#lrga-wizard .steps li").removeClass("complete");
				$("[data-lrgawidget-reset]").show();
			}
	    }else if (this.hash == "#lrgawidget_sessions_tab"){
			drawMainGraph();
		}else if (this.hash == "#lrgawidget_browsers_tab"){

			browsersTable = drawTablePie("browsers", "getBrowsers", browsersIcons);

		}else if (this.hash == "#lrgawidget_languages_tab"){
			
			languagesTable = drawTablePie("languages", "getLanguages", languagesIcons);
		
		}else if (this.hash == "#lrgawidget_os_tab"){
			
			osTable = drawTablePie("os", "getOS", osIcons);
		
		}else if (this.hash == "#lrgawidget_devices_tab"){
			
			devicesTable = drawTablePie("devices", "getDevices", devicesIcons);
			
		}else if (this.hash == "#lrgawidget_screenres_tab"){
			
			screenresTable = drawTablePie("screenres", "getScreenResolution", screenresIcons);
		}else if (this.hash == "#lrgawidget_pages_tab"){
			
			pagesTable = drawTablePie("pages", "getPages", pagesIcons);			
		}
		
		
	});
 
    $("#lrgawidget_browsers_dataTable tbody, #lrgawidget_os_dataTable tbody, #lrgawidget_devices_dataTable tbody").on('click', 'tr', function (e) {
	  e.preventDefault();
	  $('#lrgawidget a[data-target="#lrgawidget_gopro_tab"]').tab('show');
    });	

    $("#lrgawidget_daterange_label").on('click', function (e) {
      e.preventDefault();
	  $('#lrgawidget a[data-target="#lrgawidget_gopro_tab"]').tab('show');

	});	

	$("[data-lrgawidget-plot]").on('click', function (e) {
		e.preventDefault();
		selectedPname = $(this).data('lrgawidget-plot');
		$("[data-lrgawidget-plot]").removeClass("selected");
		drawGraph(plotData[selectedPname] , selectedPname);
		$(this).addClass("selected");	
	});

    $('body').on('click', '#lrgawidget_panel_hide', function (e) {
		var wstatevalue = "";
		if ($(this).is(":checked")){
			$("#lrgawidget").show();
			wstatevalue = "show";
		}else{
			$("#lrgawidget").hide();
			wstatevalue = "hide";
		}
		lrWidgetSettings({action : "hideShowWidget", wstate: wstatevalue}).done(function (data, textStatus, jqXHR) {});	
	});

	$(".wrap:eq(1)").children("h1:first").remove();
	$("#adv-settings fieldset").append('<label for="lrgawidget_panel_hide"><input id="lrgawidget_panel_hide" type="checkbox" checked="checked">Lara, Google Analytics Dashboard Widget</label>');
	$("#lrgawidget_remove").on('click', function (e) {
		e.preventDefault(); 
		$("#lrgawidget_panel_hide").click();
	});		
	$(".daterangepicker").removeClass("daterangepicker dropdown-menu opensleft").addClass("lrga_bs daterangepicker custom-dropdown-menu opensleft");
	$('[data-toggle="lrgawidget_tooltip"]').tooltip();
	if (typeof actLrgaTabs !== 'undefined'){
		$("#lrgawidget a[data-target='#"+actLrgaTabs+"']").tab('show');
	}

    $(".lrgawidget_view_demo").colorbox({iframe:true, innerWidth:"80%", innerHeight:575, scrolling: false});
});


	
})(jQuery);