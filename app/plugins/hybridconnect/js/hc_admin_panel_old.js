var hc_meta_upload_field = null;
var hc_admin_current_connector_id = null;
//TODO: try to get rid of this var - used only for confirmation dialog
jQuery(document).ready(function(){
    //Load the connectors table
    admin_update_connectors_table();
    //bind events
    jQuery('#hc_submit_fb_settings').click(admin_update_facebook_settings);
    jQuery('#hc_button_add_connector').click(admin_add_new_connector);
    //initialize the confirmation dialog
    jQuery("#hc_admin_confirmation_dialog").dialog({
        autoOpen: false,
        buttons: {
            "Remove": function() {
                admin_remove_connector(hc_admin_current_connector_id);
                $( this ).dialog( "close" );
            },
            Cancel: function() {
                $( this ).dialog( "close" );
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
        if (response == 1) {
            jQuery('#hc_admin_fb_txt_valid').html('Your facebook settings are valid.');
        } else {
            jQuery('#hc_admin_fb_txt_valid').html("Your facebook application isn't set up correctly.");
        }
//        jQuery('#hc_admin_notification_dialog_txt').html('Settings saved successfully!');
//        jQuery("#hc_admin_notification_dialog").dialog('open');
    });
}
function admin_new_connector_submit_form() {
    //Ajax security param
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    //Get the form values
    var hc_connector_name = jQuery('#txt_hc_connector_name').val();
    var hc_connector_type = jQuery('#sel_hc_connector_type').val();
    var hc_connector_thanksPage = jQuery('#sel_hc_connector_thanksPage').val();
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
        connector_thanksPage: hc_connector_thanksPage,
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
            jQuery('.hc_link_connector_edit').click(function(){
                var id_connector = parseInt(jQuery(this).parent().parent().find('.hc_table_hidden_connector_id').val());
                admin_add_new_connector(id_connector);
                return false;
            });
            jQuery('.hc_link_connector_remove').click(function(){
                var id_connector = parseInt(jQuery(this).parent().parent().find('.hc_table_hidden_connector_id').val());
                hc_admin_current_connector_id = id_connector;
                jQuery('#hc_admin_confirmation_dialog').dialog('open');
                return false;
            });
            jQuery('.hc_link_connector_toMailingList').click(function(){
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
                var id_connector = parseInt(jQuery(this).parent().parent().find('.hc_table_hidden_connector_id').val());
                admin_update_post_footer_settings(id_connector, jQuery(this).parent().find('.hc_radio_post_footer'), jQuery(this).parent().find('.hc_radio_page_footer'), 0);
                return false;
            });
            jQuery('.hc_radio_page_footer').click(function(){
                var id_connector = parseInt(jQuery(this).parent().parent().find('.hc_table_hidden_connector_id').val());
                admin_update_post_footer_settings(id_connector, jQuery(this).parent().find('.hc_radio_post_footer'), jQuery(this).parent().find('.hc_radio_page_footer'), 1);
                return false;
            });
            jQuery('#hc_admin_remove_postfooter_options').click(function(){
                admin_update_post_footer_settings('remove', null);
                return false;
            });
            jQuery('.hc_link_connector_shortcode_template_settings').click(function(){
                var id_connector = parseInt(jQuery(this).parent().parent().find('.hc_table_hidden_connector_id').val());
                admin_shortcode_template_page(id_connector);
                return false;
            });
            jQuery('.hc_link_connector_widget_template_settings').click(function(){
                var id_connector = parseInt(jQuery(this).parent().parent().find('.hc_table_hidden_connector_id').val());
                admin_widget_template_page(id_connector);
                return false;
            });
            jQuery('.hc_link_connector_custom_template_settings').click(function(){
                var id_connector = parseInt(jQuery(this).parent().parent().find('.hc_table_hidden_connector_id').val());
                admin_custom_template_settings(id_connector);
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
            jQuery('#hc_new_first_connector').click(function(){
                admin_add_new_connector();
                return false;
            });
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
            });
            jQuery('#hc_submit_admin_mail_list_settings').click(function(){
                //var id_connector = parseInt(jQuery(this).parent().parent().find('.hc_table_hidden_connector_id').val());
                admin_update_mail_list_settings(id_connector);
            });
            jQuery('#hc_remove_admin_mail_list_settings').click(function(){
                //var id_connector = parseInt(jQuery(this).parent().parent().find('.hc_table_hidden_connector_id').val());
                admin_remove_mail_list_settings(id_connector);
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
    var formErrorTxt = '';
    if (hc_mail_list_type == '') {
        formError = true;
        formErrorTxt += 'Please select a mailing list service. <br/>';
    }
    if (hc_mail_list_name == '') {
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
            bindTinyMceEditor();
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
    var custom_shortcode = jQuery('#hc_chk_shortcode').attr('checked');
    var custom_widget = jQuery('#hc_chk_widget').attr('checked');
    var custom_html = jQuery('#hc_txt_custom_html').val();
    var custom_html2 = jQuery('#hc_txt_custom_html2').val();
    var data = {
        action: 'hc_update_custom_template_settings',
        custom_shortcode: custom_shortcode,
        custom_widget: custom_widget,
        custom_html: custom_html,
        custom_html2: custom_html2,
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
function admin_shortcode_template_page(id_connector) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_shortcode_template_page',
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
            jQuery("#hc_sc_cancel_changes").click(admin_cancel_template_changes);
        }
        return false;
    });
}
function admin_widget_template_page(id_connector) {
    var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_widget_template_page',
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
    jQuery("#hc_admin_tpls_panel").hide();
    jQuery("#hc_admin_main_panel").show();
}