jQuery(document).ready(function() {
    //on load hide all the containers
  /*  jQuery('.hc_table_fb_settings').hide();  */
  /*  jQuery('#hc_admin_sel_services').click(function(){
        var selected_service = jQuery(this).val();
        jQuery('.hc_table_fb_settings').hide();
        jQuery('#hc_service_provider_' + selected_service).show();
    }); */
    jQuery('img#service-1').click(function(){
      jQuery('div.serviceProviderTable').css('display','none');
      jQuery('div#hc_service_provider_7').css('display','block');
    });
    jQuery('img#service-7').click(function(){
      jQuery('div.serviceProviderTable').css('display','none');
      jQuery('div#hc_service_provider_6').css('display','block');
    });
    jQuery('img#service-2').click(function(){
      jQuery('div.serviceProviderTable').css('display','none');
      jQuery('div#hc_service_provider_5').css('display','block');
    });
    jQuery('img#service-3').click(function(){
      jQuery('div.serviceProviderTable').css('display','none');
      jQuery('div#hc_service_provider_3').css('display','block');
    });
    jQuery('img#service-6').click(function(){
      jQuery('div.serviceProviderTable').css('display','none');
      jQuery('div#hc_service_provider_4').css('display','block');
    });
    jQuery('img#service-4').click(function(){
      jQuery('div.serviceProviderTable').css('display','none');
      jQuery('div#hc_service_provider_2').css('display','block');
    });
    jQuery('img#service-5').click(function(){
      jQuery('div.serviceProviderTable').css('display','none');
      jQuery('div#hc_service_provider_1').css('display','block');
    });
   /* jQuery('.hc_update_service_settings').click(function(){
        var hc_ajax_nonce = jQuery('#hc_hidden_services_ajaxnonce').val();
        var service_name = jQuery(this).parent().find('.hc_service_name').val();
        var appid = jQuery("#hc_" + service_name + "_appid").val();
        var appkey = jQuery("#hc_" + service_name + "_appkey").val();
        var appurl = jQuery("#hc_" + service_name + "_appurl").val();
        var data = {
            action: 'update_hc_service_settings',
            hc_service: service_name,
            appid: appid,
            appkey: appkey,
            appurl: appurl,
            security: hc_ajax_nonce
        };
        jQuery('#hc_admin_ajax_loading').show();
        jQuery.post(ajaxurl, data, function(response) {
            jQuery('#hc_admin_ajax_loading').hide();
            jQuery('#hc_admin_notification_dialog_txt').html('Settings saved successfully!');
            jQuery("#hc_admin_notification_dialog").dialog('open');
        });
    });   */
    jQuery("#hc_admin_notification_dialog").dialog({
        autoOpen: false
    });
});
function admin_update_facebook_settings() {
    var hc_appid = jQuery('#hc_txt_fb_appid').val();
    var hc_appsecret = jQuery('#hc_txt_fb_appsecret').val();
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'update_hc_fb_settings',
        hc_fb_appid: hc_appid,
        hc_fb_appsecret: hc_appsecret,
        security: hc_ajax_nonce
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        var test_response = parseInt(response);
        if (test_response == 0) {
            jQuery('#hc_admin_notification_dialog_txt').html("Please check your input data!");
        } else if (test_response == 1) {
            jQuery('#hc_admin_notification_dialog_txt').html("Your settings have been saved!");
        } else if (test_response == 2) {
            jQuery('#hc_admin_notification_dialog_txt').html("Your settings have been saved but we couldn't connect to the service. Please check your settings!");
        } else {
            jQuery('#hc_admin_notification_dialog_txt').html("Your settings couldn't be saved.");
        }
        jQuery("#hc_admin_notification_dialog").dialog('open');
    });
}