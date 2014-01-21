<div class="hc_admin_new_connector_top">
    <div class="hc_admin_new_connector_top_close">
        <img class="img_hc_admin_new_connector_top_close" src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/close-icon.png" border="0" />
    </div>
    <div class="clear"></div>
</div>
<div class="hc_admin_new_connector">
    <div class="labelHeader">Theme code (PHP Snippet)</div>
    <div class="labelStep">
        Enter this code in your theme where you want to insert the connector
    </div>
    <table class="tableConnectorDetails">
        <tr>
            <td class="label_column">Snippet:</td>
            <td>
                <input style="width:300px;" type="text" id="txt_hc_connector_snippet"  value="<?php echo "<?php hybrid_connect_insert_connector(" . $id_connector . ");?>";?>" />
            </td>
        </tr>
    </table>
    <button id="hc_submit_admin_phpsnippet" class="ui-button ui-widget ui-corner-all ui-button-text-only ui-state-default" role="button" aria-disabled="false"><span class="ui-button-text">Close</span></button>
</div>