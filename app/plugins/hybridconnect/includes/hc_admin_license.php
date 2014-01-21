<?php
$hc_ajax_nonce = wp_create_nonce("hyconspecialsecurityforajaxstring");
$license = get_option('HYBRID_CONNECT_LICENSE_STATUS')
?>
<link type="text/css" rel="stylesheet" href="<?php echo HYBRIDCONNECT_CSS_PATH_TEMPLATES ?>/south-street/jquery-ui-1.8.20.custom.css" />
<!--Admin section layout -->
<h3>Hybrid Connect License </h3>
<?php if ($license == 'ACTIVE'): ?>
        <div class="ui-widget" style="width:800px;">
            <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
                <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                    <strong>Your license is valid and your product is ready to use  </strong></p>
            </div>
        </div>
    <?php else: ?>
        <div class="ui-widget" style="width:800px;">
            <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
                <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                    <strong>Your license is not valid. </strong></p>
            </div>
        </div>
    <?php endif ?>
    <br />
<table class="hc_table_fb_settings" style="width:800px;">
    <tr>
        <td class="label_column">License Email:</td>
        <td><input type="text" name="hc_license_email" value="<?php echo get_option('hc_license_email') ?>" size="55" id="hc_license_email" /></td>
        <td rowspan="2">
       <!--     <input type="button" name="Submit" id="hc_submit_license_settings" value="Validate License" class="hcAdminButton" />      -->
            <button id="hc_submit_license_settings" class="hc_update_service_settings ui-button ui-widget ui-corner-all ui-button-text-only ui-state-default" role="button" aria-disabled="false"><span class="ui-button-text">Validate License</span></button>
            <input type="hidden" id="hc_hidden_license_ajaxnonce" value="<?php echo $hc_ajax_nonce ?>" />
        </td>
    </tr>
    <tr>
        <td class="label_column">License Key:</td>
        <td><input type="text" name="hc_license_key" value="<?php echo get_option('hc_license_key') ?>" size="55" id="hc_license_key" /></td>
    </tr>
</table>
<div id="hc_admin_notification_dialog" title="Notification">
    <p>
        <br/>
        <span class="ui-icon ui-icon-info" style="float:left; margin:0 7px 20px 0;"></span>
        <span id="hc_admin_notification_dialog_txt">
        </span>
    </p>
</div>
<script>
    jQuery(document).ready(function(){
        jQuery('.ui-state-default').live('mouseover',function () { jQuery(this).addClass('ui-state-hover'); }).live('mouseout',function () { jQuery(this).removeClass('ui-state-hover'); })
    });
</script>