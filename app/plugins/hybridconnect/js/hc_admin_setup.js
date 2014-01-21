jQuery(document).ready(function() {


jQuery("button#hc_button_g2w_connect").click( function() {
  var g2wapi = jQuery("input[name=g2wAPIKey]").val();
  var hc_ajax_nonce = jQuery('#hc_hidden_services_ajaxnonce').val();
  
  var data = {
            action: 'hc_update_g2w_api',
            api_key: g2wapi,
            security: hc_ajax_nonce
        };
        jQuery('#hc_admin_ajax_loading').show();
        var uriRedirection = document.URL;

        jQuery.post(ajaxurl, data, function(response) {
        if (response == 0) {
                jQuery('#hc_admin_ajax_loading').hide();
                jQuery('#hc_admin_notification_dialog_txt').html("Your API key couldn't be saved - please try again!");
                jQuery("#hc_admin_notification_dialog").dialog('open');
                return false;
            }
            if (response == 1) {
                window.location="https://api.citrixonline.com/oauth/authorize?client_id=" + g2wapi + "&redirect_uri=" + encodeURIComponent(uriRedirection);
            }
          });
  

});



jQuery("a#apitoggle").click( function (ev) {
  ev.preventDefault();
  jQuery("#hiddenServicesTable").toggle();
});

   //  jQuery('a.getFBAppData').click(function(ev){ ev.preventDefault(); admin_get_fb_data();  });
    jQuery('a.getFBAppData').on('click', function(){ admin_get_fb_data();  });
    //on load hide all the containers
    /*  jQuery('.hc_table_fb_settings').hide();  */
    jQuery('#hc_submit_fb_settings').click(admin_update_facebook_settings);
    jQuery('#hc_submit_license_settings').click(admin_update_license_settings);
    var fbvalid = jQuery("#hc_hidden_fb_appvalid").val();
    if (fbvalid == 1) {
        jQuery('#hc_facebook_txt_valid').show();
        jQuery('#hc_facebook_txt_invalid').hide();
    } else {
        jQuery('#hc_facebook_txt_valid').hide();
        jQuery('#hc_facebook_txt_invalid').show();
    }
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
    jQuery("#hc_constantcontact_vurl").focus(function(){
        jQuery(this).select();
    });
    jQuery("#hc_submit_constantcontact_settings").click(function(){
        var verif_url = jQuery("#hc_cc_verification_url").val();
        var api_key = jQuery("#hc_constantcontact_appkey").val();
        var api_id = jQuery("#hc_constantcontact_appid").val();
        var hc_ajax_nonce = jQuery('#hc_hidden_services_ajaxnonce').val();
        if (api_key == "" || api_id == "") {
            jQuery('#hc_admin_notification_dialog_txt').html('Please enter your api key and your consumer secret code!');
            jQuery("#hc_admin_notification_dialog").dialog('open');
            return false;
        }
        var data = {
            action: 'hc_update_constant_contact_options',
            api_key: api_key,
            api_id: api_id,
            security: hc_ajax_nonce
        };
        var auth_url = "https://oauth2.constantcontact.com/oauth2/oauth/siteowner/authorize?response_type=code&client_id=" + api_key + "&redirect_uri=" + verif_url;
        jQuery('#hc_admin_ajax_loading').show();
        jQuery.post(ajaxurl, data, function(response) {
            if (response == 0) {
                jQuery('#hc_admin_ajax_loading').hide();
                jQuery('#hc_admin_notification_dialog_txt').html("Your settings couldn't be saved!");
                jQuery("#hc_admin_notification_dialog").dialog('open');
                return false;
            }
            if (response == 1) {
                window.location = auth_url;
            }
        });
    });
    jQuery('.hc_update_service_settings').click(function(){
        var thisid = jQuery(this).attr('id');
        if (thisid == "hc_submit_license_settings") {
            return;
        }
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
            if (response == 1) {
                jQuery("#hc_service_msg_valid_" + service_name).show();
                jQuery("#hc_service_msg_invalid_" + service_name).hide();
            } else if (response == 2) {
                jQuery("#hc_service_msg_valid_" + service_name).hide();
                jQuery("#hc_service_msg_invalid_" + service_name).show();
                jQuery("#hc_service_msg_invalid_" + service_name).find('strong').html("It looks like you don't have any mailing lists in your account");
            } else {
                jQuery("#hc_service_msg_valid_" + service_name).hide();
                jQuery("#hc_service_msg_invalid_" + service_name).show();
            }
        });
    });
    jQuery("#hc_admin_notification_dialog").dialog({
        autoOpen: false
    });
});






function showFacebookDetails(response) {

// jQuery('#hc_admin_notification_dialog_txt').html("We have successfully connected to your Facebook app with the App ID and Secret that you provided - we have also set the correct app domain and site URL for you.<br/><br/><b>You are ready to rock and roll.</b>");

          var facebookSettingsTable= '<table class="hc_admin_connectors_table" style="width:800px;"><thead><tr><th colspan="2">Your Facebook App Details (<a href="" class="getFBAppData"><b>Click here to refresh)</b></a></th></tr><tr><th>Property</th><th>Value</th></tr></thead><tbody>';
          facebookSettingsTable=facebookSettingsTable + ' <tr><td class="label_column"><strong>Name</strong></td><td>' + response.name + '</td></tr>';
          facebookSettingsTable=facebookSettingsTable + ' <tr><td class="label_column"><strong>Description</strong></td><td>' + response.description + '</td></tr>';
          facebookSettingsTable=facebookSettingsTable + ' <tr><td class="label_column"><strong>Website URL</strong></td><td>' + response.website_url + '</td></tr>';
          facebookSettingsTable=facebookSettingsTable + ' <tr><td class="label_column"><strong>Domain</strong></td><td>' + response.domain + '</td></tr>';
          facebookSettingsTable=facebookSettingsTable + ' <tr><td class="label_column"><strong>Logo</strong></td><td><img src="' + response.logo_url + '"></td></tr>';
          facebookSettingsTable=facebookSettingsTable + ' <tr><td class="label_column"><strong>App Homepage (To edit these settings)</strong></td><td><a href="https://developers.facebook.com/apps/' + response.id + '" target="_blank">https://developers.facebook.com/apps/' + response.id + '</a></td></tr>';
          
          facebookSettingsTable=facebookSettingsTable + '</table>';

          jQuery("#facebookValidSettings").html(facebookSettingsTable);
          jQuery("#facebookValidSettings").fadeIn("slow");
          
            jQuery('#hc_facebook_txt_invalid').hide();
            jQuery('#hc_facebook_txt_valid').fadeIn("slow");
            
    jQuery('a.getFBAppData').click(function(ev){ ev.preventDefault(); admin_get_fb_data();  });

}

function facebookError(message) {
  if(message=="furl") {
     jQuery('#hc_admin_notification_dialog_txt').html("<font style=\"size:16px;\"><B>Please send an Email to your Hosting Company</b></font><br/><br/>Unfortunately, in order for us to correctly set up your Facebook app, we need your host to make a small change on your server.<br/><br/>Please copy and paste the following email to your hosting company (they will get this request all the time):<br/><br/><div style=\"margin-left:10px; margin-top:10px; font-size:0.9em; background: #f5f5f5; border:1px dashed #aaaaaa; padding:15px;\">Good Afternoon,<br/>I need to connect to Facebook using their API for a plugin that I'm running on my Wordpress web site and for that to happen I need to set allow_url_fopen=1 in the server configuration.  Please can you open this up for me so that I can get my app validated?</div><br/><br/>Your host will change the server settings for you and then you'll be able to come back here and revalidate your Facebook app.<br/><br/><b>This is important because without the correct app settings none of your hybrid forms will display on your site!</b>");
            jQuery('#hc_facebook_txt_valid').hide();
            jQuery('#hc_facebook_txt_invalid').show();
            jQuery('#facebookValidSettings').hide();
            jQuery("#hc_admin_notification_dialog").dialog( "option", "width", 530 );
        jQuery("#hc_admin_notification_dialog").dialog('open');
 }
 else {
   jQuery('#hc_admin_notification_dialog_txt').html("<font style=\"size:16px;\"><B>Something is up...We can't connect to your app!</b></font><br/><br/>This could mean that your app ID or secret aren't correct (check there aren't any hidden characters at the end of the two strings). <br/><br/>Alternatively double check at http://developers.facebook.com that the app ID and secret key you've provided are 100% correct.<br/><br/><b>Without the correct app settings none of your hybrid forms will display on your site!</b>");
            jQuery('#hc_facebook_txt_valid').hide();
            jQuery('#hc_facebook_txt_invalid').show();
            jQuery('#facebookValidSettings').hide();
            jQuery("#hc_admin_notification_dialog").dialog( "option", "width", 530 );
        jQuery("#hc_admin_notification_dialog").dialog('open');
   }
}


function admin_get_fb_data() {

jQuery("div#facebookValidSettings").css("display","none");
var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();

  var data= { action: 'update_hc_fb_settings',
              security: hc_ajax_nonce
            }
        jQuery('#hc_admin_ajax_loading').show();

        jQuery.post(ajaxurl, data, function(response) {
          jQuery('#hc_admin_ajax_loading').hide();
        if(response.success=="1") {
           showFacebookDetails(response);
          } else if(response.success=="-2") {
           facebookError("furl");
          }
          else {
          facebookError("standard");
          }
        }, "json" );
}


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
          if(response.success=="1") {
           showFacebookDetails(response);
          } else if(response.success=="-2") {
           facebookError("furl");
          }
          else {
          facebookError("standard");
          }
    }, "json");
}
function admin_update_license_settings() {
    var hc_setup_page_url = jQuery("#hc_hidden_setup_page_url").val();
    var hc_license_email = jQuery('#hc_license_email').val();
    var hc_license_key = jQuery('#hc_license_key').val();
    var hc_ajax_nonce = jQuery('#hc_hidden_license_ajaxnonce').val();
    var data = {
        action: 'update_hc_license_settings',
        hc_license_email: hc_license_email,
        hc_license_key: hc_license_key,
        security: hc_ajax_nonce
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        //        jQuery('#hc_admin_notification_dialog_txt').html(response);
        //        jQuery("#hc_admin_notification_dialog").dialog('open');
        window.location.href = hc_setup_page_url;
    });
}