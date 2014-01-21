<div class="hc_admin_new_connector_top">
    <div class="hc_admin_new_connector_top_close">
        <img class="img_hc_admin_new_connector_top_close" src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/close-icon.png" border="0" />
    </div>
    <div class="clear"></div>
</div>
<div class="hc_admin_new_connector">
    <div class="labelHeader">Are you sure you want to end the test?</div>
    <div class="labelStep">
        To end the test select the connector that you want to display from the drop down list bellow:
    </div>
    <table class="tableConnectorDetails">
        <tr>
            <td class="label_column">Variation:</td>
            <td>
                <select id="hc_select_variation<?php echo $idConnector . "-" . $type; ?>">
                    <?php foreach ($variations as $key => $var): ?>
                        <option value="<?php echo $var->id ?>"><?php echo $var->name ?><?php if ($var->control == 1):?>(control)<?php endif?></option>
                    <?php endforeach ?>
                </select>
            </td>
        </tr>
    </table>
    <div class="labelStep">
       <p>Please note: Even if you don't end this test, Hybrid Connect will automatically select and show the winning design when there is a 95% chance statistically that a variation will outperform the control.</p>
       <div class="ui-widget">
	<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
		<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
		<strong>Important -</strong> Once you choose a winning design, all the variations will be removed and the winning design will become the default design for the connector.  Therefore, please make sure that you select the right connector from the drop down list above.</p>
	</div>
</div>
    </div>
    <button id="hc_cancel_stop_test" class="ui-button ui-widget ui-corner-all ui-button-text-only ui-state-default-cancel" role="button" aria-disabled="false"><span class="ui-button-text">Continue Test</span></button>
    <button id="hc_submit_stop_test" class="ui-button ui-widget ui-corner-all ui-button-text-only ui-state-default" role="button" aria-disabled="false"><span class="ui-button-text">End Test</span></button>
</div>