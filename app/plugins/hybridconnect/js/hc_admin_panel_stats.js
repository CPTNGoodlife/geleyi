jQuery(document).ready(function(){
    jQuery("#hc_admin_update_chart").click(function(){
        //TODO - some date verifications..here or on the serverside
        jQuery("#chart1").html("");
        hc_update_chart();
    });
    //set up the datepickers
    jQuery('#datepicker1').datepicker({
        dateFormat: 'dd-mm-yy',
        onSelect: function(dateText, inst) {
        }
    });
    jQuery('#datepicker2').datepicker({
        dateFormat: 'dd-mm-yy',
        onSelect: function(dateText, inst) {
        }
    });
    jQuery("#hc_admin_notification_dialog").dialog({
        autoOpen: false
    });
    // retreive full referer stats for query
    jQuery("a.fullURLStats").click(function(ev) {
      ev.preventDefault();
      var thisCall = this;
      // hide all open stats
      jQuery(".referingURLRow").hide();
      var hc_ajax_nonce = jQuery('#hc_hidden_services_ajaxnonce').val();
      var thisDomain = jQuery(this).attr('href');
      var data = {
        action: 'getFullRefererStats',
        domain: thisDomain,
        security: hc_ajax_nonce
      }
      console.log(data);
      jQuery('#hc_admin_ajax_loading').show();
          jQuery.post(ajaxurl, data, function(response) {
               jQuery('#hc_admin_ajax_loading').hide();
               var fullRefererLocation=jQuery(thisCall).parents("tr").first().next();
               jQuery(fullRefererLocation).show();
               jQuery(fullRefererLocation).find("td").html(response);
            });
    });
    
    hc_update_chart();
});
function hc_update_chart() {
    var hc_ajax_nonce = jQuery('#hc_hidden_services_ajaxnonce').val();
    var start_date = jQuery("#datepicker1").val();
    var end_date = jQuery("#datepicker2").val();
    var data = {
        action: 'hc_get_stats_options',
        start_date: start_date,
        end_date: end_date,
        security: hc_ajax_nonce
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response == "00") {
            jQuery('#hc_admin_notification_dialog_txt').html("There are no subscriptions for the interval you've chosen.");
            jQuery("#hc_admin_notification_dialog").dialog('open');
            return;
        }
        if (response == 0 || response == -1 || response == 1) {
            jQuery('#hc_admin_notification_dialog_txt').html("We couldn't process your input data!");
            jQuery("#hc_admin_notification_dialog").dialog('open');
            return;
        }
        var line = eval(response);
        var axisLabelAmount=line.length;
        var plot1 = jQuery.jqplot('chart1', [line], {
            title:'Subscriptions chart',
            color: '#058dc7',
             axesDefaults: { syncTicks: true,
              tickOptions: {
            mark: 'outside',    // Where to put the tick mark on the axis
                                // 'outside', 'inside' or 'cross',
            showMark: true,
            showGridline: true, // wether to draw a gridline (across the whole grid) at this tick,
            markSize: 4,        // length the tick will extend beyond the grid in pixels.  For
                                // 'cross', length will be added above and below the grid boundary,
            show: true,         // wether to show the tick (mark and label),
            showLabel: true,    // wether to show the text label at the tick,
            formatString: '',   // format string to use with the axis tick formatter
        }
              },
            axes:{
                xaxis:{
                    renderer:jQuery.jqplot.DateAxisRenderer,
                    min: line[0][0],
                    max:line[axisLabelAmount-1][0],
                    label: 'Date',
                    numberTicks:axisLabelAmount,
                    tickOptions: {
                      formatString:'%m-%d'
                      }
                },
                yaxis: {
                  min: '0',
                  label: 'Subscriptions',
                  tickInterval:1
                }
            },
            legend: {
              show: false,
              location: 'ne',     // compass direction, nw, n, ne, e, se, s, sw, w.
              xoffset: 12,        // pixel offset of the legend box from the x (or x2) axis.
              yoffset: 12,        // pixel offset of the legend box from the y (or y2) axis.
              },
              series:{label: "Number of Signups"},
             grid: { aboveData: false, background:'transparent' },
             seriesDefaults: {   lineWidth: 3.5, shadow:false, showLine: true, showMarker:true, fill:true, fillColor:"#e5f3f9", fillAndStroke:true, color:"#058dc7",
              markerOptions: { size: 10, shadow:false },
              rendererOptions: { highlightMouseOver: false, highlightMouseDown: false, highlightColor: null },
            }
        });
    });
}