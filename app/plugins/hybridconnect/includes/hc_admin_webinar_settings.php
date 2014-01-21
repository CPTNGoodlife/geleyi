<div class="hc_admin_new_connector_top">
    <div class="hc_admin_new_connector_top_close">
        <img class="img_hc_admin_new_connector_top_close" src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/close-icon.png" border="0" />
    </div>
    <div class="clear"></div>
</div>
<div class="hc_admin_new_connector">
    <div class="labelHeader">GotoWebinar Settings</div>
    <div class="labelStep">
        Use this form to integrate with GotoWebinar. If you add a GotoWebinar connection then your prospects will automatically be signed up for a webinar when they sign up.
    </div>
    <table class="tableConnectorDetails">
        <tr>
            <td class="label_column">Webinar Key:</td>
            <td>
                <input type="text" id="txt_hc_admin_webinar_key"  value="<?php if($my_webinar):?><?php echo $my_webinar->webinarKey ?><?php endif;?>" />
            </td>
        </tr>
    </table>
    <button id="hc_submit_admin_webinar_settings" class="ui-button ui-widget ui-corner-all ui-button-text-only ui-state-default" role="button" aria-disabled="false"><span class="ui-button-text">Submit</span></button>
    <button id="hc_remove_admin_webinar_settings" class="ui-button ui-widget ui-corner-all ui-button-text-only ui-state-default-cancel" role="button" aria-disabled="false"><span class="ui-button-text">Remove Webinar</span></button>
</div>