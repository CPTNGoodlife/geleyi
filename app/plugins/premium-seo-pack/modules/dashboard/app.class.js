/*
Document   :  Dashboard
Author     :  Andrei Dinca, AA-Team http://codecanyon.net/user/AA-Team
*/
// Initialization and events code for the app
pspDashboard = (function ($) {
    "use strict";

    // public
    var debug = false;
    var maincontainer = null;

	// init function, autoload
	function init()
	{
		maincontainer = $("#psp-ajax-response");
		triggers();
		fix_frame_preview();
	};
	
	function fix_frame_preview()
	{
		var preview = maincontainer.find(".psp-website-preview .browser-preview");
		maincontainer.find(".psp-website-preview .the-website-preview").load(function(){
			maincontainer.find(".psp-borwser-frame").height( preview.height() );
		});
	}
	
	function loadAudience()
	{
		var graph = $("#psp-audience-visits-graph"); 
		
		jQuery.post(ajaxurl, {
			'action' 		: 'pspGoogleAPIRequest',
			'sub_action' 	: 'getAudience',
			'from_date'		: graph.data('fromdate'),
			'to_date'		: graph.data('todate'),
			'debug'			: debug
		}, function(response) {
			
			if( typeof response.getAudience !== 'undefined' ){
				var data = response.getAudience.data.rows; 
				var opts = {
					series: {
						lines: { show: true },
						points: { show: true }
					},
					tooltip: true,
					tooltipOpts: {
						defaultTheme: true,
						content: "%x<br />%s: %y",
						xDateFormat: "%d/%m/%y"
					},
					xaxis: {
						mode: "time",
						timeformat: "%d/%m/%y"
					},
					grid: {
						hoverable: true,
						clickable: true,
						borderWidth: null
					}
				};
		
				var datasets = [
					{ data: data.newVisits, label: "% New Visits", color: "#E15656" },
					{ data: data.visits, label: "Visits", color: "#61A5E4" },
					{ data: data.avgTimeOnPage, label: "Avg. Visit Duration", color: "#37aa37" },
					{ data: data.visitBounceRate, label: "Bounce Rate", color: "#A6D037" },
					{ data: data.pageviews, label: "Pageviews", color: "#ad6dd6"},
					{ data: data.uniquePageviews, label: "Unique Visitors", color: "#a91c83" }
				];
				
				var plot = $.plot(graph, datasets, opts);
				
				// remove the loading
				graph.css('background-image', 'none');
			}else{
				graph.parents('.psp-panel-widget').eq(0).remove();
			}
			
		}, 'json');
		
	}
	
	function boxLoadAjaxContent( box )
	{
		var allAjaxActions = [];
		box.find('.is_ajax_content').each(function(key, value){
			
			var alias = $(value).text().replace( /\n/g, '').replace("{", "").replace("}", "");
			$(value).attr('id', 'psp-row-alias-' + alias);
			allAjaxActions.push( alias );
		}); 
		
		jQuery.post(ajaxurl, {
			'action' 		: 'pspDashboardRequest',
			'sub_actions'	: allAjaxActions.join(","),
			'debug'			: debug
		}, function(response) {
			
			$.each(response, function(key, value){
				if( value.status == 'valid' ){
					var row = box.find( "#psp-row-alias-" + key );
					row.html(value.html);
					
					row.removeClass('is_ajax_content');
				} 
			});
			
		}, 'json');
	}
	
	function triggers()
	{
		maincontainer.find(">div").each( function(e){
			var that = $(this);
			
			// check if box has ajax content
			if( that.find('.is_ajax_content').size() > 0 ){
				boxLoadAjaxContent(that);
			}
		});
		
		$("#psp-audience-visits-graph").each(function(){
			loadAudience();
		});
	}

	// external usage
	return {
		"init": init
    }
})(jQuery);
