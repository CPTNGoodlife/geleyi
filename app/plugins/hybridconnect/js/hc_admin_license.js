/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
jQuery(document).ready(function(){
    //bind events
    jQuery('#hc_submit_license_settings').click(admin_update_license_settings);
    //initialize the confirmation dialog
    jQuery("#hc_admin_notification_dialog").dialog({
        autoOpen: false
    });
});
function admin_update_license_settings() {
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
        window.location.href = window.location.href;
    });
}