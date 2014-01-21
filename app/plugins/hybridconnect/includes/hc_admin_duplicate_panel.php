<div class="hc_admin_new_connector_top">
    <div class="hc_admin_new_connector_top_close">
        <img class="img_hc_admin_new_connector_top_close" src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/close-icon.png" border="0" />
    </div>
    <div class="clear"></div>
</div>
<div class="hc_admin_new_connector">
    <div class="labelHeader">Duplicate connector - <?php echo $my_connector->Name?></div>
    <div class="labelStep">
        Please enter the new connector's name. All the other options will be duplicated.
    </div>
    <table class="tableConnectorDetails">
        <tr>
            <td class="label_column">New Connector name:</td>
            <td>
                <input type="text" id="txt_hc_connector_name"  value="" />
            </td>
        </tr>
    </table>
    <button id="hc_submit_admin_duplicate" class="ui-button ui-widget ui-corner-all ui-button-text-only ui-state-default" role="button" aria-disabled="false"><span class="ui-button-text">Duplicate</span></button>
</div>