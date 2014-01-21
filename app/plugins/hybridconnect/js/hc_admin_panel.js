var hc_meta_upload_field = null;
var hc_admin_current_connector_id = null;
var hc_admin_current_variation_id = null;
//TODO: try to get rid of this var - used only for confirmation dialog

jQuery(document).ready(function(){

    jQuery('.ui-state-default').live('mouseover',function () {
        jQuery(this).addClass('ui-state-hover');
    }).live('mouseout',function () {
        jQuery(this).removeClass('ui-state-hover');
    })
    jQuery('.ui-state-default-cancel').live('mouseover',function () {
        jQuery(this).addClass('ui-state-hover-cancel');
    }).live('mouseout',function () {
        jQuery(this).removeClass('ui-state-hover-cancel');
    })

    //Load the connectors table
    admin_update_connectors_table();
    admin_update_tests_table();
    //bind events
    jQuery('#hc_button_add_connector').click(admin_add_new_connector);
    //initialize the confirmation dialog
    jQuery("#hc_admin_confirmation_dialog").dialog({
        autoOpen: false,
        buttons: {
            "Remove": function() {
                admin_remove_connector(hc_admin_current_connector_id);
                jQuery( this ).dialog( "close" );
            },
            Cancel: function() {
                jQuery( this ).dialog( "close" );
            }
        }
    });
    //initialize the confirmation dialog for removing a variation
    jQuery("#hc_admin_confirmation_variation").dialog({
        autoOpen: false,
        buttons: {
            "Remove": function() {
                admin_delete_variation(hc_admin_current_variation_id);
                jQuery( this ).dialog( "close" );
            },
            Cancel: function() {
                jQuery( this ).dialog( "close" );
            }
        }
    });
    jQuery("#hc_admin_notification_dialog").dialog({
        autoOpen: false
    });
});


/*
 * Renders the edit dialog container
 * @id_connector is used to get the parameter if we select to edit a connector
 * by default, when binding this function as a callback function, jquery sets the id connector to an event object
 */
function admin_add_new_connector(id_connector) {
    if (!helper_isInt(id_connector)) {
        id_connector = 0;
    }
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'get_hc_connector_dialog',
        id_connector: id_connector,
        security: hc_ajax_nonce
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        jQuery('#hc_admin_new_connector_container').html(response);
        jQuery('#hc_admin_new_connector_container').fadeIn();
        //bind new actions
        jQuery('.hc_admin_new_connector_top_close').click(function(){
            jQuery(this).parent().parent().fadeOut();
        });
        jQuery('#btn_hc_admin_add_connector').bind('click', admin_new_connector_submit_form);
    });
}


function admin_new_connector_submit_form() {
    //Ajax security param
    jQuery('#hc_admin_ajax_loading').show();
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    //Get the form values
    var hc_connector_name = jQuery('#txt_hc_new_connector_name').val();
    var hc_connector_type = jQuery('#sel_hc_connector_type').val();
    var hc_connector_id = jQuery('#hidden_hc_admin_edit_id_connector').val();
    var hc_allow_registration = jQuery('#hc_allow_registration').attr('checked');
    var hc_registration_role = jQuery('#hc_registration_role').val();
    //Do the validation
    var formError = false;
    var formErrorTxt = '';
    if (hc_connector_name == '') {
        formError = true;
        formErrorTxt += 'Please enter the connector name <br/>';
    }
    if (formError) {
        alert(formErrorTxt);
        return false;
    }
    var data = {
        action: 'update_connector_data',
        connector_name: hc_connector_name,
        connector_type: hc_connector_type,
        connector_id: hc_connector_id,
        allow_registration: hc_allow_registration,
        registration_role: hc_registration_role,
        security: hc_ajax_nonce
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
            return false;
        }
        admin_update_connectors_table();
        admin_new_connector_container_close();
        return false;
    });
    return false;
}
function admin_update_connectors_table() {
    //Load the connectors table
   jQuery("#getTemplateName").dialog('destroy').remove();
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'update_hc_connectors_table',
        security: hc_ajax_nonce
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("Error: connectors table couldn't be rendered. Please try to refresh the page.");
        } else {
            jQuery('#hc_connectors_table_container').html(response);
            //selection option for the shortcode text input
            jQuery(".hc_txt_admin_shortcode").focus(function(){
                this.select();
            });
            //bind the actions for the table links
            jQuery('.hc_link_connector_edit').click(function(ev){
                ev.preventDefault();
                var id_connector = parseInt(jQuery(this).parent().parent().find('.hc_table_hidden_connector_id').val());
                admin_add_new_connector(id_connector);
                return false;
            });
            jQuery('.hc_sel_connector_type').change(function(){
                var id_connector = parseInt(jQuery(this).parent().parent().find('.hc_table_hidden_connector_id').val());
                admin_update_connector_type(id_connector, jQuery(this).val());
            });
            jQuery('.hc_link_connector_remove').click(function(){
                var id_connector = parseInt(jQuery(this).parent().parent().find('.hc_table_hidden_connector_id').val());
                hc_admin_current_connector_id = id_connector;
                jQuery('#hc_admin_confirmation_dialog').dialog('open');
                return false;
            });
            jQuery('.hc_link_connector_toMailingList').click(function(ev){
                ev.preventDefault();
                var id_connector = parseInt(jQuery(this).parent().parent().find('.hc_table_hidden_connector_id').val());
                admin_mail_list_settings(id_connector);
                return false;
            });
            jQuery('.hc_link_connector_toGotoWebinar').click(function(){
                var id_connector = parseInt(jQuery(this).parent().parent().find('.hc_table_hidden_connector_id').val());
                admin_webinar_settings(id_connector);
                return false;
            });
            jQuery('.hc_radio_post_footer').click(function(){
                var id_connector = parseInt(jQuery(this).parents('td').find('.hc_table_hidden_connector_id').val());
                admin_update_post_footer_settings(id_connector, jQuery(this).parent().find('.hc_radio_post_footer'), jQuery(this).parent().find('.hc_radio_page_footer'), 0);
                return false;
            });
            jQuery('.hc_radio_page_footer').click(function(){
                var id_connector = parseInt(jQuery(this).parents('td').find('.hc_table_hidden_connector_id').val());
                admin_update_post_footer_settings(id_connector, jQuery(this).parent().find('.hc_radio_post_footer'), jQuery(this).parent().find('.hc_radio_page_footer'), 1);
                return false;
            });
            jQuery('.hc_radio_comment_footer').click(function(){
                var id_connector = parseInt(jQuery(this).parents('td').find('.hc_table_hidden_connector_id').val());
                var current_comment_footer = parseInt(jQuery(this).parents('td').find(".hc_comment_footer_id").val());
                if(current_comment_footer == id_connector) {
                  admin_update_comment_footer_settings(false);
                } else {
                admin_comment_footer_panel(id_connector);
                }
                return false;
            });
            jQuery('#hc_admin_remove_postfooter_options').click(function(){
                admin_update_post_footer_settings('remove', null);
                return false;
            });
            jQuery('.hc_link_connector_shortcode_template_settings').click(function(){
                var id_connector = parseInt(jQuery(this).parent().parent().find('.hc_table_hidden_connector_id').val());
                admin_shortcode_template_page(id_connector, 0);
                return false;
            });
            jQuery('.hc_link_connector_widget_template_settings').click(function(){
                var id_connector = parseInt(jQuery(this).parent().parent().find('.hc_table_hidden_connector_id').val());
                admin_widget_template_page(id_connector, 0);
                return false;
            });
            jQuery('.hc_link_connector_custom_template_settings').click(function(){
                var id_connector = parseInt(jQuery(this).parent().parent().find('.hc_table_hidden_connector_id').val());
                admin_custom_template_settings(id_connector);
                return false;
            });
            jQuery('a.hc_link_connector_lightbox_template_settings').click(function(){
                var id_connector = parseInt(jQuery(this).parent().parent().find('.hc_table_hidden_connector_id').val());
                admin_lightbox_template_settings(id_connector, 0);
                return false;
            });
            jQuery('.hc_link_connector_lightbox_template_settings2').click(function(){
                var id_connector = parseInt(jQuery(this).parent().parent().find('.hc_table_hidden_connector_id').val());
                admin_lightbox_template_settings2(id_connector);
                return false;
            });
            
            jQuery('a.hc_link_connector_squeeze_template_settings').click(function(ev){
                ev.preventDefault();
                var id_connector = parseInt(jQuery(this).parent().parent().find('.hc_table_hidden_connector_id').val());
                admin_squeeze_template_settings(id_connector, 0);
                return false;
            });
            jQuery('.hc_link_connector_duplicate').click(function(){
                var id_connector = parseInt(jQuery(this).parent().parent().find('.hc_table_hidden_connector_id').val());
                admin_duplicate_panel(id_connector);
                return false;
            });
            jQuery('.hc_link_php_snippet').click(function(){
                var id_connector = parseInt(jQuery(this).parent().parent().find('.hc_table_hidden_connector_id').val());
                admin_phpsnippet_panel(id_connector);
                return false;
            });
            jQuery('.hc_link_connector_statistics').click(function(){
                var id_connector = parseInt(jQuery(this).parent().parent().find('.hc_table_hidden_connector_id').val());
                var type = parseInt(jQuery(this).attr('rel'));
                admin_stats_container(id_connector, type);
                return false;
            });
            jQuery('#hc_new_first_connector').click(function(){
                admin_add_new_connector();
                return false;
            });
        }
    });
}

function admin_comment_footer_panel(id_connector) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_comment_footer_panel',
        security: hc_ajax_nonce,
        id_connector: id_connector
    };

    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            jQuery('#hc_admin_webinar_settings_container').html(response);
            jQuery('#hc_admin_webinar_settings_container').fadeIn();
            //bind new actions
            jQuery('.hc_admin_new_connector_top_close').click(function(){
                jQuery(this).parent().parent().fadeOut();
                 admin_update_connectors_table();
            });
            jQuery('#hc_submit_comment_footer_settings').click(function(){
              admin_update_comment_footer_settings(id_connector);
            });

        }
        return false;
    });
}

function admin_update_comment_footer_settings(id_connector) {
  var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
  var commentFooterText=jQuery("#hc_comment_footer_text").val();
  var commentFooterOptIn=jQuery("#hc_comment_footer_opt").val();
  
     var data = {
        action: 'hc_update_comment_footer_settings',
        security: hc_ajax_nonce,
        commenttext: commentFooterText,
        commentoptin: commentFooterOptIn,
        commentconnector: id_connector
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
      jQuery('#hc_admin_ajax_loading').hide();
      if (response < 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
             jQuery("#hc_admin_webinar_settings_container").fadeOut();
             admin_update_connectors_table();
          }
      });
}

function admin_update_post_footer_settings(id_connector, radio_button, radio_button2, type) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var x1 = jQuery(radio_button).attr('checked');
    var x2 = jQuery(radio_button2).attr('checked');
    var post_footer = 0;
    var page_footer = 0;
    if (x1 == "checked") {
        post_footer = 1;
    }
    if (x2 == "checked") {
        page_footer = 1;
    }
    var data = {
        action: 'hc_update_footer_settings',
        security: hc_ajax_nonce,
        id_connector: id_connector,
        post_footer: post_footer,
        page_footer: page_footer,
        type: type
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response < 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            jQuery('.hc_radio_post_footer').attr('checked', false);
            jQuery('.hc_radio_page_footer').attr('checked', false);
            if (x1 == "checked") {
                jQuery(radio_button).attr('checked', 'checked');
            }
            if (x2 == "checked") {
                jQuery(radio_button2).attr('checked', 'checked');
            }
            admin_update_connectors_table();
        //            jQuery('#hc_admin_notification_dialog_txt').html('Settings saved successfully!');
        //            jQuery("#hc_admin_notification_dialog").dialog('open');
        }
        return false;
    });
}
var hc_admin_selected_service_for_connector = null;
var hc_admin_selected_connector = null;
function admin_mail_list_settings(id_connector) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_mail_list_settings',
        security: hc_ajax_nonce,
        id_connector: id_connector
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            jQuery('#hc_admin_mail_list_settings_container').html(response);
            jQuery('#hc_admin_mail_list_settings_container').fadeIn();
            //bind new actions
            jQuery('.hc_admin_new_connector_top_close').click(function(){
                jQuery(this).parent().parent().fadeOut();
                return false;
            });
            switchMailingListScreen();
            jQuery("input:radio[name=customHTMLConnect]").click(function() {
               switchMailingListScreen();

            });
            jQuery('#hc_submit_admin_mail_list_settings2').unbind();
            jQuery('#hc_submit_admin_mail_list_settings2').click(function(){
                admin_update_mail_list_settings(id_connector);
                return false;
            });
            jQuery('#hc_remove_admin_mail_list_settings').click(function(){
                //var id_connector = parseInt(jQuery(this).parent().parent().find('.hc_table_hidden_connector_id').val());
                admin_remove_mail_list_settings(id_connector);
                return false;
            });
            hc_admin_selected_service_for_connector = jQuery('input[name=hc_mail_type]:checked').val();
            hc_admin_selected_connector = id_connector;
            if (hc_admin_selected_service_for_connector && hc_admin_selected_service_for_connector != '') {
                admin_service_list_settings();
            }
            jQuery('.radio_hc_admin_mail_list_type').click(admin_service_list_settings);
        }
        return false;
    });
}
function admin_update_connector_type(id_connector, type) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_admin_update_connector_type',
        security: hc_ajax_nonce,
        id_connector: id_connector,
        type: type
    };
    jQuery('#hc_admin_ajax_loading_front').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading_front').hide();
        if (response <= 0) {
            jQuery('#hc_admin_notification_dialog_txt').html("We couldn't process your request. Please refresh the page and try again. Thank you.");
            jQuery("#hc_admin_notification_dialog").dialog('open');
        }
    });
}

function switchMailingListScreen() {
  var currentScreen = jQuery('input[name=customHTMLConnect]:checked').val();
               switch(currentScreen) {
                 case '1':
                 jQuery("#hc_table_custom_signup_code").hide();
                 jQuery(".mailingListAPI").show();
                 break;
                 case '0':
                 jQuery("#hc_table_custom_signup_code").show();
                 jQuery(".mailingListAPI").hide();
                 break;
               }
}

function admin_service_list_settings() {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    if (hc_admin_selected_service_for_connector) {
        var service = hc_admin_selected_service_for_connector;
        var id_connector = hc_admin_selected_connector;
        hc_admin_selected_service_for_connector = null;
        hc_admin_selected_connector = null;
    } else {
        var id_connector = jQuery(this).parent().find('.hc_admin_hidden_idConnector').val();
        var service = jQuery(this).val();
    }
    var data = {
        action: 'hc_get_service_list_settings',
        security: hc_ajax_nonce,
        id_connector: id_connector,
        service: service
    };
    jQuery('#hc_admin_ajax_loading_front').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading_front').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
            return;
        }
        if (response == 2) {
            jQuery('#table_column_list_settings').html("We couldn't connect to the service with the provided settings. Please review the service options.");
            return;
        }
        jQuery('#table_column_list_settings').html(response);
    });
}
function admin_update_mail_list_settings(id_connector) {
    //Ajax security param
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    //Get the form values
    var hc_mail_list_type = jQuery('input[name=hc_mail_type]:checked').val()
    var hc_mail_list_name = jQuery('#txt_hc_admin_mail_list_name').val();
    //Do the validation
    var formError = false;
    var customSignupCode = jQuery("#mailingListSignupCode").val();
    var hc_connector_thanksPage = jQuery('#sel_hc_connector_thanksPage').val();
    var formErrorTxt = '';
    var apiConnection=jQuery('input[name=customHTMLConnect]:checked').val();
    var optintype = jQuery('input[name=optinType]:checked').val();

    if (apiConnection=="1" && hc_mail_list_type == '') {
        formError = true;
        formErrorTxt += 'Please select a mailing list service. <br/>';
    }
    if (apiConnection=="1" && hc_mail_list_name == '') {
        formError = true;
        formErrorTxt += 'Please enter a mailing list name. <br/>';
    }
    if (formError) {
        alert(formErrorTxt);
        return false;
    }
    var data = {
        action: 'hc_update_mail_list_settings',
        id_connector: id_connector,
        mail_list_name: hc_mail_list_name,
        mail_list_type: hc_mail_list_type,
        customcode: customSignupCode,
        connectAPI:jQuery('input[name=customHTMLConnect]:checked').val(),
        thankspage: hc_connector_thanksPage,
        optintype: optintype,
        security: hc_ajax_nonce
    };
    

    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response < 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
            return false;
        }
        admin_update_connectors_table();
        admin_mailing_list_settings_container_close();
        return false;
    });
    return false;
}
function admin_remove_mail_list_settings(id_connector) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_remove_mail_list_settings',
        security: hc_ajax_nonce,
        id_connector: id_connector
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response < 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            admin_update_connectors_table();
            admin_mailing_list_settings_container_close();
        }
        return false;
    });
}
function admin_webinar_settings(id_connector) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_webinar_settings',
        security: hc_ajax_nonce,
        id_connector: id_connector
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            jQuery('#hc_admin_webinar_settings_container').html(response);
            jQuery('#hc_admin_webinar_settings_container').fadeIn();
            //bind new actions
            jQuery('.hc_admin_new_connector_top_close').click(function(){
                jQuery(this).parent().parent().fadeOut();
            });
            jQuery('#hc_submit_admin_webinar_settings').click(function(){
                //var id_connector = parseInt(jQuery(this).parent().parent().find('.hc_table_hidden_connector_id').val());
                admin_update_webinar_settings(id_connector);
            });
            jQuery('#hc_remove_admin_webinar_settings').click(function(){
                //var id_connector = parseInt(jQuery(this).parent().parent().find('.hc_table_hidden_connector_id').val());
                admin_remove_webinar_settings(id_connector);
            });
        }
        return false;
    });
}
function admin_update_webinar_settings(id_connector) {
    //Ajax security param
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    //Get the form values
    var hc_webinar_key = jQuery('#txt_hc_admin_webinar_key').val();
    //Do the validation
    var formError = false;
    var formErrorTxt = '';
    if (hc_webinar_key == '') {
        formError = true;
        formErrorTxt += 'Please enter your Webinar Key. <br/>';
    }
    if (formError) {
        alert(formErrorTxt);
        return false;
    }
    var data = {
        action: 'hc_update_webinar_settings',
        id_connector: id_connector,
        webinar_key: hc_webinar_key,
        security: hc_ajax_nonce
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
            return false;
        }
        admin_update_connectors_table();
        admin_webinar_settings_container_close();
        return false;
    });
    return false;
}
function admin_remove_webinar_settings(id_connector) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_remove_webinar_settings',
        security: hc_ajax_nonce,
        id_connector: id_connector
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response < 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            admin_update_connectors_table();
            admin_webinar_settings_container_close();
        }
        return false;
    });
}
function admin_shortcode_template_settings(id_connector) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_shortcode_template_settings',
        security: hc_ajax_nonce,
        id_connector: id_connector
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            //hide and display the appropiate containers
            jQuery('#hc_admin_webinar_settings_container').html(response);
            jQuery('#hc_admin_webinar_settings_container').fadeIn();
            jQuery('.hc_settings_shortcode_style_container').hide();
            var selected_template = jQuery('#hc_admin_sel_shortcode_template').val();
            if (selected_template > 1) {
                selected_template = 2;
            }
            jQuery('#hc_settings_shortcode_style_container_' + selected_template).show();
            jQuery('#hc_admin_sel_shortcode_template').change(function(){
                jQuery('.hc_settings_shortcode_style_container').hide();
                var selected_template2 = jQuery('#hc_admin_sel_shortcode_template').val();
                var img_path = hc_admin_images_path + "/tpls/s" + selected_template2 + ".PNG";
                jQuery('#sc_tpl_screenshot').attr('src', img_path);
                if (selected_template2 > 1) {
                    selected_template2 = 2;
                }
                jQuery('#hc_settings_shortcode_style_container_' + selected_template2).show();
            });
            //bind new actions
            jQuery('#hc_upload_image_button_shortcode').click(function() {
                hc_meta_upload_field = jQuery('#hc_admin_txt_shortcode_image');
                formfield = jQuery('#hc_admin_txt_shortcode_image').attr('name');
                tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
                return false;
            });
            jQuery('.hc_admin_new_connector_top_close').click(function(){
                jQuery(this).parent().parent().fadeOut();
            });
            //jQuery('#hc_admin_txt_shorcode_background').jPicker();
            jQuery('#hc_submit_admin_shortcode_style').click(function(){
                //var id_connector = parseInt(jQuery(this).parent().parent().find('.hc_table_hidden_connector_id').val());
                admin_update_shortcode_template_settings(id_connector, 0);
            });
            jQuery('#hc_preview_shortcode').click(function(){
                //var id_connector = parseInt(jQuery(this).parent().parent().find('.hc_table_hidden_connector_id').val());
                admin_update_shortcode_template_settings(id_connector, 1);
            });
        /*    bindTinyMceEditor();      */
        }
        return false;
    });
}
function admin_preview_shortcode_template_settings(id_connector) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_preview_shortcode',
        security: hc_ajax_nonce,
        id_connector: id_connector
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            jQuery('.hc_admin_new_connector').html(response);
            jQuery('#hc_admin_preview_back').click(function(){
                admin_shortcode_template_settings(id_connector);
            });
            jQuery('#hc_admin_preview_close').click(function(){
                admin_webinar_settings_container_close();
            });
        //            var my_window = window.open("", "mywindow1", "status=1,width=550,height=350");
        //            my_window.document.write("<html><head></head><body>" + response + "</body></html>");
        //            my_window.document.close();
        }
        return false;
    });
}
function admin_preview_widget_template_settings(id_connector) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_preview_widget',
        security: hc_ajax_nonce,
        id_connector: id_connector
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            jQuery('.hc_admin_new_connector').html(response);
            jQuery('#hc_admin_preview_back').click(function(){
                admin_widget_template_settings(id_connector);
            });
            jQuery('#hc_admin_preview_close').click(function(){
                admin_webinar_settings_container_close();
            });
        //            var my_window = window.open("", "mywindow1", "status=1,width=550,height=350");
        //            my_window.document.write("<html><head></head><body>" + response + "</body></html>");
        //            my_window.document.close();
        }
        return false;
    });
}
function admin_update_shortcode_template_settings(id_connector, preview) {
    //Ajax security param
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    //Get the form values
    var template_shortcode = parseInt(jQuery('#hc_admin_sel_shortcode_template').val());
    var sc_borderWidth = jQuery("#hc_admin_txt_shorcode_borderWidth").val();
    var sc_borderColor = jQuery("#hc_admin_txt_shorcode_borderColor").val();
    var sc_background = jQuery('#hc_admin_txt_shorcode_background').val();
    var sc_strokeColor = jQuery('#hc_admin_txt_shorcode_strokeColor').val();
    var sc_strokeSize = jQuery('#hc_admin_txt_shorcode_strokeSize').val();
    var sc_width = jQuery('#hc_admin_txt_shorcode_width').val();
    var sc_tpl_title = jQuery('#hc_txt_sc_title').val();
    var sc_tpl_description = tinyMCE.activeEditor.getContent();
    var sc_tpl_button = jQuery('#hc_txt_sc_button').val();
    var sc_tpl_image = jQuery('#hc_admin_txt_shortcode_image').val();
    var sc_tpl_footer_text = jQuery('#hc_txt_sc_footer').val();
    var sc_tpl_footer_enable = jQuery('#hc_chk_sc_footer').attr('checked');
    var sc_tpl_width = jQuery('#hc_txt_sc_width').val();
    if (template_shortcode > 1) {
        sc_tpl_title = jQuery('#hc_txt_sc_title2').val();
    }
    var data = {
        action: 'hc_update_shortcode_template_settings',
        template_shortcode: template_shortcode,
        id_connector: id_connector,
        sc_background: sc_background,
        sc_strokeColor: sc_strokeColor,
        sc_strokeSize: sc_strokeSize,
        sc_width: sc_width,
        sc_tpl_title: sc_tpl_title,
        sc_tpl_description: sc_tpl_description,
        sc_tpl_button: sc_tpl_button,
        sc_tpl_image: sc_tpl_image,
        sc_tpl_footer_text: sc_tpl_footer_text,
        sc_tpl_footer_enable: sc_tpl_footer_enable,
        sc_tpl_width: sc_tpl_width,
        sc_borderWidth: sc_borderWidth,
        sc_borderColor: sc_borderColor,
        security: hc_ajax_nonce
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response == 2) {
            alert("The image url isn't valid. Please enter a valid image url.");
            return false;
        }
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
            return false;
        }
        if (preview == 0) {
            admin_update_connectors_table();
            admin_webinar_settings_container_close();
        } else {
            admin_preview_shortcode_template_settings(id_connector);
        }
        return false;
    });
    return false;
}
function admin_widget_template_settings(id_connector) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_widget_template_settings',
        security: hc_ajax_nonce,
        id_connector: id_connector
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            jQuery('#hc_admin_webinar_settings_container').html(response);
            jQuery('#hc_admin_webinar_settings_container').fadeIn();
            jQuery('.hc_settings_shortcode_style_container').hide();
            var selected_template = jQuery('#hc_admin_sel_widget_template').val();
            if (selected_template > 1) {
                selected_template = 2;
            }
            jQuery('#hc_settings_shortcode_style_container_' + selected_template).show();
            jQuery('#hc_admin_sel_widget_template').change(function(){
                jQuery('.hc_settings_shortcode_style_container').hide();
                var selected_template2 = jQuery('#hc_admin_sel_widget_template').val();
                var img_path = hc_admin_images_path + "/tpls/w" + selected_template2 + ".PNG";
                jQuery('#wc_tpl_screenshot').attr('src', img_path);
                if (selected_template2 > 1) {
                    selected_template2 = 2;
                }
                jQuery('#hc_settings_shortcode_style_container_' + selected_template2).show();
            });
            //bind new actions
            jQuery('#hc_upload_image_button_widget').click(function() {
                hc_meta_upload_field = jQuery('#hc_admin_txt_widget_image');
                formfield = jQuery('#hc_admin_txt_widget_image').attr('name');
                tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
                return false;
            });
            jQuery('.hc_admin_new_connector_top_close').click(function(){
                jQuery(this).parent().parent().fadeOut();
            });
            jQuery('#hc_submit_admin_widget_template').click(function(){
                admin_update_widget_template_settings(id_connector, 0);
            });
            jQuery('#hc_preview_widget').click(function(){
                //var id_connector = parseInt(jQuery(this).parent().parent().find('.hc_table_hidden_connector_id').val());
                admin_update_widget_template_settings(id_connector, 1);
            });
            bindTinyMceEditor();
        }
        return false;
    });
}
function admin_update_widget_template_settings(id_connector, preview) {
    //Ajax security param
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    //Get the form values
    var template_widget = jQuery('#hc_admin_sel_widget_template').val();
    var wg_background = jQuery('#hc_admin_txt_widget_background').val();
    var wg_strokeColor = jQuery('#hc_admin_txt_widget_strokeColor').val();
    var wg_strokeSize = jQuery('#hc_admin_txt_widget_strokeSize').val();
    var wg_width = jQuery('#hc_admin_txt_widget_width').val();
    var wg_tpl_title = jQuery('#hc_txt_wg_title').val();
    var wg_tpl_description = tinyMCE.activeEditor.getContent();
    var wg_tpl_button = jQuery('#hc_txt_wg_button').val();
    var wg_tpl_image = jQuery('#hc_admin_txt_widget_image').val();
    var wg_tpl_footer_text = jQuery('#hc_txt_wg_footer').val();
    var wg_tpl_footer_enable = jQuery('#hc_chk_wg_footer').attr('checked');
    var wg_tpl_width = jQuery('#hc_txt_wg_width').val();
    var wg_borderWidth = jQuery("#hc_admin_txt_widget_borderWidth").val();
    var wg_borderColor = jQuery("#hc_admin_txt_widget_borderColor").val();
    if (template_widget > 1) {
        wg_tpl_title = jQuery('#hc_txt_wg_title2').val();
    }
    var data = {
        action: 'hc_update_widget_template_settings',
        template_widget: template_widget,
        id_connector: id_connector,
        wg_background: wg_background,
        wg_strokeColor: wg_strokeColor,
        wg_strokeSize: wg_strokeSize,
        wg_width: wg_width,
        wg_tpl_title: wg_tpl_title,
        wg_tpl_description: wg_tpl_description,
        wg_tpl_button: wg_tpl_button,
        wg_tpl_image: wg_tpl_image,
        wg_tpl_footer_text: wg_tpl_footer_text,
        wg_tpl_footer_enable: wg_tpl_footer_enable,
        wg_tpl_width: wg_tpl_width,
        wg_borderWidth: wg_borderWidth,
        wg_borderColor: wg_borderColor,
        security: hc_ajax_nonce
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response == 2) {
            alert("The image url isn't valid. Please enter a valid image url.");
            return false;
        }
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
            return false;
        }
        if (preview == 0) {
            admin_update_connectors_table();
            admin_webinar_settings_container_close();
        } else {
            admin_preview_widget_template_settings(id_connector);
        }
        return false;
    });
    return false;
}
function admin_remove_connector(id_connector) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'remove_hc_connector',
        security: hc_ajax_nonce,
        id_connector: id_connector
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            admin_update_connectors_table();
        }
        return false;
    });
}
function admin_new_connector_container_close() {
    jQuery('#hc_admin_new_connector_container').fadeOut();
}
function admin_mailing_list_settings_container_close() {
    jQuery('#hc_admin_mail_list_settings_container').fadeOut();
}
function admin_webinar_settings_container_close() {
    jQuery('#hc_admin_webinar_settings_container').fadeOut();
}
function helper_isInt(n) {
    return typeof n == 'number' && n % 1 == 0;
}
function admin_duplicate_panel(id_connector) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_duplicate_panel',
        security: hc_ajax_nonce,
        id_connector: id_connector
    };

    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            jQuery('#hc_admin_webinar_settings_container').html(response);
            jQuery('#hc_admin_webinar_settings_container').fadeIn();
            //bind new actions
            jQuery('.hc_admin_new_connector_top_close').click(function(){
                jQuery(this).parent().parent().fadeOut();
            });
            jQuery('#hc_submit_admin_duplicate').click(function(){
                //var id_connector = parseInt(jQuery(this).parent().parent().find('.hc_table_hidden_connector_id').val());
                admin_duplicate_connector(id_connector);
            });
        }
        return false;
    });
}
function admin_phpsnippet_panel(id_connector) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_phpsnippet_panel',
        security: hc_ajax_nonce,
        id_connector: id_connector
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            jQuery('#hc_admin_webinar_settings_container').html(response);
            jQuery('#hc_admin_webinar_settings_container').fadeIn();
            //bind new actions
            jQuery('.hc_admin_new_connector_top_close').click(function(){
                jQuery(this).parent().parent().fadeOut();
            });
            jQuery('#hc_submit_admin_phpsnippet').click(function(){
                jQuery(this).parent().parent().fadeOut();
            });
        }
        return false;
    });
}
function admin_duplicate_connector(id_connector) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var new_name = jQuery("#txt_hc_connector_name").val();
    if (new_name == "") {
        alert('Please enter a new name for the connector!');
        return false;
    }
    var data = {
        action: 'duplicate_connector',
        security: hc_ajax_nonce,
        new_name: new_name,
        id_connector: id_connector
    };

    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            admin_webinar_settings_container_close();
            admin_update_connectors_table();
        }
        return false;
    });
}
function admin_custom_template_settings(id_connector) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_custom_template_settings',
        security: hc_ajax_nonce,
        id_connector: id_connector
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            jQuery('#hc_admin_webinar_settings_container').html(response);
            jQuery('#hc_admin_webinar_settings_container').fadeIn();
            jQuery('.hc_admin_new_connector_top_close').click(function(){
                jQuery(this).parent().parent().fadeOut();
            });
            jQuery('#hc_submit_admin_custom_template').click(function(){
                admin_update_custom_template_settings(id_connector);
            });
        }
        return false;
    });
}
function admin_update_custom_template_settings(id_connector) {
    //Ajax security param
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    //Get the form values
    var template_shortcode = jQuery('#hc_chk_shortcode').attr('checked');
    var template_widget = jQuery('#hc_chk_widget').attr('checked');
    var template_lightbox = jQuery('#hc_chk_lightbox').attr('checked');
    var custom_form = jQuery('#hc_txt_custom_form').val();
    var custom_fbnot = jQuery('#hc_txt_custom_fbnot').val();
    var custom_fbyes = jQuery('#hc_txt_custom_fbyes').val();
    var custom_width = jQuery("#hc_custom_width").val();
    var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
    if(!numberRegex.test(custom_width)) {
        jQuery('#hc_admin_notification_dialog_txt').html("Please enter a number in the width field!");
        jQuery("#hc_admin_notification_dialog").dialog('open');
        return false;
    }
    var data = {
        action: 'hc_update_custom_template_settings',
        template_shortcode: template_shortcode,
        template_widget: template_widget,
        template_lightbox: template_lightbox,
        custom_form: custom_form,
        custom_fbnot: custom_fbnot,
        custom_fbyes: custom_fbyes,
        custom_width: custom_width,
        id_connector: id_connector,
        security: hc_ajax_nonce
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
            return false;
        }
        admin_update_connectors_table();
        admin_webinar_settings_container_close();
        return false;
    });
    return false;
}
function bindTinyMceEditor() {
    tinyMCE.init({
        mode : "textareas",
        theme: "advanced"
    });
}

function admin_squeeze_template_settings(id_connector, id_variation) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_admin_squeeze_page',
        security: hc_ajax_nonce,
        id_connector: id_connector,
        id_variation: id_variation
    };
    jQuery("#hc_admin_main_panel").hide();
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            jQuery("#hc_admin_tpls_panel").show();
            jQuery("#hc_admin_tpls_panel").html(response);
            jQuery("#hc_sc_cancel_changes").click(admin_cancel_template_changes);
        }
        return false;
    });

}

function admin_shortcode_template_page(id_connector, id_variation) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_shortcode_template_page',
        security: hc_ajax_nonce,
        id_connector: id_connector,
        id_variation: id_variation
    };
    jQuery("#hc_admin_main_panel").hide();
    jQuery('#hc_admin_ajax_loading').show();
    
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            jQuery("#hc_admin_tpls_panel").show();
            jQuery("#hc_admin_tpls_panel").html(response);
            jQuery("#hc_sc_cancel_changes").click(admin_cancel_template_changes);
        }
        return false;
    });
}
function admin_lightbox_template_settings(id_connector, id_variation) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_lightbox_page',
        security: hc_ajax_nonce,
        id_connector: id_connector,
        id_variation: id_variation
    };
    jQuery("#hc_admin_main_panel").hide();
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            jQuery("#hc_admin_tpls_panel").show();
            jQuery("#hc_admin_tpls_panel").html(response);
            jQuery("#hc_sc_cancel_changes").click(admin_cancel_template_changes);
        }
        return false;
    });
}
function admin_lightbox_update_settings() {
    var id_connector = jQuery("#hc_lb_hidden_id_connector").val();
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var excluded_pages = "";
    var included_pages = "";
    var excluded_posts = "";
    var included_posts = "";
    jQuery(".hc_lb_excluded_pages:checked").each(function(){
        excluded_pages = excluded_pages + jQuery(this).val() + "-";
    });
    jQuery(".hc_lb_included_pages:checked").each(function(){
        included_pages = included_pages + jQuery(this).val() + "-";
    });
    jQuery(".hc_lb_excluded_posts:checked").each(function(){
        excluded_posts = excluded_posts + jQuery(this).val() + "-";
    });
    jQuery(".hc_lb_included_posts:checked").each(function(){
        included_posts = included_posts + jQuery(this).val() + "-";
    });
    var lightbox_config_object = {
        all_pages : jQuery('#hc_lb_all_pages').attr('checked'),
        single_page : jQuery('#hc_lb_single_page').attr('checked'),
        included_pages : included_pages,
        excluded_pages : excluded_pages,
        on_time: jQuery('#hc_lb_on_time').val(),
        on_click: jQuery('#hc_lb_on_click').val()
    }
    var data = {
        action: 'hc_admin_update_lightbox_settings',
        id_connector: id_connector,
        lightbox_config_object: lightbox_config_object,
        security: hc_ajax_nonce
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        admin_cancel_template_changes();
    });
}
function admin_lightbox_template_settings2(id_connector) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_lightbox_page2',
        security: hc_ajax_nonce,
        id_connector: id_connector
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            jQuery("#hc_admin_tpls_panel").show();
            jQuery("#hc_admin_tpls_panel").html(response);
            jQuery("#hc_admin_main_panel").hide();
        }
        return false;
    });
}
function admin_widget_template_page(id_connector, id_variation) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_widget_template_page',
        security: hc_ajax_nonce,
        id_connector: id_connector,
        id_variation: id_variation
    };
    jQuery("#hc_admin_main_panel").hide();
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            jQuery("#hc_admin_tpls_panel").show();
            jQuery("#hc_admin_tpls_panel").html(response);
            jQuery("#hc_sc_cancel_changes").click(admin_cancel_template_changes);
        }
        return false;
    });
}
function admin_shortcode_style_panel(id_connector, template) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_shortcode_style_panel',
        security: hc_ajax_nonce,
        id_connector: id_connector,
        template: template
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            jQuery("#hc_style_options_panel").html(response);
        }
        return false;
    });
}
function admin_cancel_template_changes() {
    jQuery("#getTemplateName").dialog('destroy').remove();
    jQuery("#hc_admin_tpls_panel").hide();
    jQuery("#hc_admin_main_panel").show();
}


function admin_stats_container(id_connector, type) {
    jQuery(".hc_container_statistics").parent().parent().hide();
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_admin_get_stats_container',
        security: hc_ajax_nonce,
        id_connector: id_connector,
        type: type
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            
            jQuery("#hc_container_statistics" + id_connector).parents("tr").first().fadeIn('slow');

            jQuery("#hc_container_statistics" + id_connector).html(response);
            //bind new actions
            jQuery("#hc_container_statistics" + id_connector).find('.hc_link_add_variation_design').click(function(ev){
                var no_variations = jQuery("#hc_container_statistics" + id_connector).find('.row_variation_stats_body').length;
                if (no_variations > 6) {
                    alert("The maximum number of 4 variations has been reached!");
                    return false;
                }
                ev.preventDefault();
                admin_add_variation_dialog(id_connector, type);
                return false;
            });
            
            jQuery(".statsCloseButton").click(function(ev){
                ev.preventDefault();
                jQuery("#hc_container_statistics" + id_connector).parents("tr").first().fadeOut('slow');
                return false;
            });
            jQuery("#hc_container_statistics" + id_connector).find('.hc_link_delete_variation').click(function(){
                var id_variation = parseInt(jQuery(this).parent().parent().find('.hidden_variation_id').val());
                hc_admin_current_variation_id = id_variation;
                jQuery('#hc_admin_confirmation_variation').dialog('open');
                return false;
            });
            jQuery("#hc_container_statistics" + id_connector).find('.hc_link_edit_variation_design').click(function(){
                var id_variation = parseInt(jQuery(this).parent().parent().find('.hidden_variation_id').val());
                var id_connector = parseInt(jQuery(this).parent().parent().find('.hidden_connector_id').val());
                hc_admin_current_variation_id = id_variation;
                switch(type) {
                    case 0:
                        admin_shortcode_template_page(id_connector, id_variation);
                        break;
                    case 1:
                        admin_widget_template_page(id_connector, id_variation);
                        break;
                    case 2:
                        admin_lightbox_template_settings(id_connector, id_variation);
                        break;
                    case 3:
                        admin_squeeze_template_settings(id_connector, id_variation);
                        break;
                        
                }
                return false;
            });
            jQuery("#hc_container_statistics" + id_connector).find('.hc_link_start_test_design').click(function(ev){
                var no_variations = jQuery("#hc_container_statistics" + id_connector).find('.row_variation_stats_body').length;
                if (no_variations < 5) {
                    alert("Please create atleast one variation!");
                    return false;
                }
                ev.preventDefault();
                admin_start_test_dialog(id_connector, type);
                return false;
            });
            
            jQuery("#hc_container_statistics" + id_connector).find('.hc_link_stop_test_design').click(function(ev){
                ev.preventDefault();
                admin_stop_test_dialog(id_connector, type);
                return false;
            });
            
            jQuery("#hc_container_statistics" + id_connector).find('.hc_link_clear_data_design').click(function(ev){
                ev.preventDefault();
                admin_clear_data_dialog(id_connector, type);
                return false;
            });
        }
        return false;
    });
}

function admin_add_variation_dialog(id_connector, type) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_admin_get_variation_container',
        security: hc_ajax_nonce,
        id_connector: id_connector,
        type: type
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            jQuery('#hc_admin_webinar_settings_container').html(response);
            jQuery('#hc_admin_webinar_settings_container').fadeIn();
            //bind new actions
            jQuery('.hc_admin_new_connector_top_close').click(function(){
                jQuery(this).parent().parent().fadeOut();
            });
            jQuery('#hc_submit_add_variation').click(function(){
                admin_add_variation(id_connector, type);
            });
        }
        return false;
    });
}

function admin_start_test_dialog(id_connector, type) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_admin_get_start_test_container',
        security: hc_ajax_nonce,
        id_connector: id_connector,
        type: type
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            jQuery('#hc_admin_webinar_settings_container').html(response);
            jQuery('#hc_admin_webinar_settings_container').fadeIn();
            //bind new actions
            jQuery('.hc_admin_new_connector_top_close').click(function(){
                jQuery(this).parent().parent().fadeOut();
            });
            jQuery('#hc_cancel_start_test').click(function(){
                jQuery(this).parent().parent().fadeOut();
            });
            jQuery('#hc_submit_start_test').click(function(){
                admin_start_test(id_connector, type);
            });
        }
        return false;
    });
}

function admin_clear_data_dialog(id_connector, type) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_admin_get_clear_data_container',
        security: hc_ajax_nonce,
        id_connector: id_connector,
        type: type
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            jQuery('#hc_admin_webinar_settings_container').html(response);
            jQuery('#hc_admin_webinar_settings_container').fadeIn();
            //bind new actions
            jQuery('.hc_admin_new_connector_top_close').click(function(){
                jQuery(this).parent().parent().fadeOut();
            });
            jQuery('#hc_cancel_clear_data').click(function(){
                jQuery(this).parent().parent().fadeOut();
            });
            jQuery('#hc_submit_clear_data').click(function(){
                admin_clear_data(id_connector, type);
            });
        }
        return false;
    });
}

function admin_stop_test_dialog(id_connector, type) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_admin_get_stop_test_container',
        security: hc_ajax_nonce,
        id_connector: id_connector,
        type: type
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            jQuery('#hc_admin_webinar_settings_container').html(response);
            jQuery('#hc_admin_webinar_settings_container').fadeIn();
            //bind new actions
            jQuery('.hc_admin_new_connector_top_close').click(function(){
                jQuery(this).parent().parent().fadeOut();
            });
            jQuery('#hc_cancel_stop_test').click(function(){
                jQuery(this).parent().parent().fadeOut();
            });
            jQuery('#hc_submit_stop_test').click(function(){
                admin_stop_test(id_connector, type);
            });
        }
        return false;
    });
}

function admin_stop_test(id_connector, type) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var id_variation = jQuery("#hc_select_variation" + id_connector + "-" + type).val();
    var data = {
        action: 'hc_admin_stop_test',
        security: hc_ajax_nonce,
        id_connector: id_connector,
        id_variation: id_variation,
        type: type
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            jQuery('#hc_admin_webinar_settings_container').fadeOut();
            admin_stats_container(id_connector, type);
        }
        return false;
    });
}
function admin_start_test(id_connector, type) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_admin_start_test',
        security: hc_ajax_nonce,
        id_connector: id_connector,
        type: type
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            jQuery('#hc_admin_webinar_settings_container').fadeOut();
            admin_stats_container(id_connector, type);
        }
        return false;
    });
}
function admin_clear_data(id_connector, type) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_admin_clear_data',
        security: hc_ajax_nonce,
        id_connector: id_connector,
        type: type
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            jQuery('#hc_admin_webinar_settings_container').fadeOut();
            admin_stats_container(id_connector, type);
        }
        return false;
    });
}

function admin_add_variation(id_connector, type) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var no_variations = jQuery("#hc_container_statistics" + id_connector).find('.row_variation_stats_body').length;
    if (no_variations > 6) {
        alert("The maximum number of 4 variations has been reached!");
        return;
    }
    var data = {
        action: 'hc_admin_add_new_variation',
        security: hc_ajax_nonce,
        id_connector: id_connector,
        type: type,
        name: jQuery("#hc_variation_name").val()
    };
    
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            admin_stats_container(id_connector, type);
            jQuery('#hc_admin_webinar_settings_container').html(response);
            jQuery('#hc_admin_webinar_settings_container').fadeOut();
        }
        return false;
    });
}

function admin_delete_variation(id_variation) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_admin_delete_variation',
        security: hc_ajax_nonce,
        id_variation: id_variation
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            var data = JSON.parse(response);
            admin_stats_container(data.idConnector, data.type);
        }
        return false;
    });
}

function admin_update_tests_table() {    
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'update_hc_tests_table',
        security: hc_ajax_nonce
    };
    
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("Error: Tests could not be found.");
        } else {
            jQuery('#hc_admin_tests_panel').html(response);
            //selection option for the shortcode text input

            jQuery(".hc_link_test_results").click(function(ev) {
                ev.preventDefault();
                showDetailedTestData(this);

            });

        }
    });
}

function showDetailedTestData(myTest) {
    var id_test = jQuery(myTest).parents("tr").first().find(".hc_test_id").first().val();
    var id_connector = jQuery(myTest).parents("tr").first().find(".hc_connector_id").first().val();
    var type = parseInt(jQuery(myTest).parents("tr").first().find(".hc_type").first().val());
    
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_admin_get_test_stats',
        security: hc_ajax_nonce,
        id_test: id_test
    };
    
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("Error: Tests could not be found.");
        } else {
            jQuery("#hc_container_statistics" + id_test).parents("tr").first().fadeIn('slow');
            jQuery("#hc_container_statistics" + id_test).html(response);
            
            jQuery("#hc_container_statistics" + id_test).find(".statsCloseButton").click(function(ev){
                ev.preventDefault();
                jQuery("#hc_container_statistics" + id_test).parents("tr").first().fadeOut('slow');
                return false;
            });
            
            jQuery("#hc_container_statistics" + id_test).find('.hc_link_edit_variation_design').click(function(){
                
                var id_variation = parseInt(jQuery(this).parent().parent().find('.hidden_variation_id').val());
                var id_connector = parseInt(jQuery(this).parent().parent().find('.hidden_connector_id').val());
                hc_admin_current_variation_id = id_variation;
                switch(type) {
                    case 0:
                        admin_shortcode_template_page(id_connector, id_variation);
                        break;
                    case 1:
                        admin_widget_template_page(id_connector, id_variation);
                        break;
                    case 2:
                        admin_lightbox_template_settings(id_connector, id_variation);
                        break;
                    case 3:
                        admin_squeeze_template_settings(id_connector, id_variation);
                        break;
                        
                }
                return false;
            });
        }
    });
}