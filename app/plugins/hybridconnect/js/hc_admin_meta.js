/*
 * Here we handle the custom upload fields for the templates
 */
var hc_meta_upload_field = null;
jQuery(document).ready(function() {
    jQuery('#hc_upload_image_button_logo').click(function() {
        hc_meta_upload_field = jQuery('#hc_upload_image_logo');
        formfield = jQuery('#hc_upload_image_logo').attr('name');
        tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
        return false;
    });
    jQuery('#hc_upload_image_button_header').click(function() {

        hc_meta_upload_field = jQuery('#hc_upload_image_header');
        formfield = jQuery('#hc_upload_image_header').attr('name');
        tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
        return false;
    });
    jQuery('#hc_upload_image_button_body').click(function() {

        hc_meta_upload_field = jQuery('#hc_upload_image_body');
        formfield = jQuery('#hc_upload_image_body').attr('name');
        tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
        return false;
    });
    jQuery('#hc_upload_image_button_custom').click(function() {

        hc_meta_upload_field = jQuery('#hc_upload_image_custom');
        formfield = jQuery('#hc_upload_image_custom').attr('name');
        tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
        return false;
    });
    window.send_to_editor = function(html) {

        imgurl = jQuery('img',html).attr('src');
        hc_meta_upload_field.val(imgurl);
        tb_remove();
    }
});
