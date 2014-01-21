/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
jQuery(document).ready(function(){
    //bind events
    jQuery('#hc_submit_affiliate').click(function(){
        admin_update_affiliate_settings(1, 0);
    });
    jQuery('#hc_submit_affiliate_manual').click(function(){
        admin_update_affiliate_settings(1, 1);
    });
    //initialize the confirmation dialog
    jQuery("#hc_admin_notification_dialog").dialog({
        autoOpen: false
    });
    jQuery("#hc_check_affiliate").click(function(){
        var hc_check_affiliate = jQuery("#hc_check_affiliate").attr('checked');
        if (hc_check_affiliate == "checked") {
            jQuery("#affiliate_table").show();
            jQuery("#radioset").show();
            admin_update_affiliate_settings(0, 0);
        } else {
            jQuery("#affiliate_table").hide();
            jQuery("#radioset").hide();
            admin_update_affiliate_settings(0, 0);
        }
    });
    jQuery("#hc_radio1").click(function(){
        jQuery("#hc_row_get_affiliate_api").show();
        jQuery("#hc_row_affiliate_msg").show();
        jQuery("#affiliate_manual").hide();
        jQuery("#hc_label1").addClass('ui-state-active');
        jQuery("#hc_label2").removeClass('ui-state-active');
    });
    jQuery("#hc_radio2").click(function(){
        jQuery("#hc_row_get_affiliate_api").hide();
        jQuery("#hc_row_affiliate_msg").hide();
        jQuery("#affiliate_manual").show();
        jQuery("#hc_label2").addClass('ui-state-active');
        jQuery("#hc_label1").removeClass('ui-state-active');
    });
});
function admin_update_affiliate_settings(type, manual) {
    var hc_affiliate_email = jQuery('#hc_affiliate_email').val();
    var hc_ajax_nonce = jQuery('#hc_hidden_affiliate_ajaxnonce').val();
    var hc_check_affiliate = jQuery("#hc_check_affiliate").attr('checked');
    var hc_manual_link = jQuery("#hc_affiliate_manual_link").val();
    var data = {
        action: 'update_hc_affiliate_settings',
        hc_check_affiliate: hc_check_affiliate,
        hc_affiliate_email: hc_affiliate_email,
        hc_manual: manual,
        hc_manual_link: hc_manual_link,
        type: type,
        security: hc_ajax_nonce
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response == 5) {
            jQuery('#hc_admin_notification_dialog_txt').html("Your affiliate link has been set!");
            jQuery("#hc_admin_notification_dialog").dialog('open');
            jQuery("#hc_affiliate_valid_msg").html("Your affiliate link is set!");
            return;
        }
        if (response == 3) {
            jQuery("#hc_affiliate_valid_msg").html("We couldn't find an affiliate account with that record, you can sign up or do a password reset here:<a href='http://affiliates.swissmademarketing.com' target='_blank'>http://affiliates.swissmademarketing.com</a>");
            return;
        }
        if (response == 0) {
            jQuery("#hc_affiliate_valid_msg").html("If you're not an affiliate, sign up <a href='http://affiliates.swissmademarketing.com' target='_blank'>here</a>.");
            return;
        }
        jQuery("#hc_affiliate_valid_msg").html(response);
    });
}