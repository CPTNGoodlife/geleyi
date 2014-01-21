<!--
OLD FILE WITH THE ADMIN TEMPLATE SELECT FOR THE SHORTCODE
-->
<div class="hc_admin_new_connector_top">
    <div class="hc_admin_new_connector_top_close">
        <img class="img_hc_admin_new_connector_top_close" src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/close-icon.png" border="0" />
    </div>
    <div class="clear"></div>
</div>
<div class="hc_admin_new_connector">
    <div class="labelHeader">Select shortcode template:
        <select>
            <option>Simple</option>
            <option>Wide 1</option>
            <option>Wide 2</option>
            <option>Wide 3</option>
        </select>
    </div>
    <div class="labelStep">
        Some description here
    </div>
    <table class="tableConnectorDetails">
        <tr>
            <td class="label_column">Template 1</td>
            <td>
                <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/shortcode_template1.png" height="150" width="170" />
            </td>
            <td>
                <input type="radio" name="shortcode_template" <?php if ($my_connector->template_shortcode == 1):?>checked<?php endif;?> value="1" />
            </td>
        </tr>
    </table>
    <table class="tableConnectorDetails">
        <tr>
            <td class="label_column">Template 2</td>
            <td>
                <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/shortcode_template2.png" height="150" width="170" />
            </td>
            <td>
                <input type="radio" name="shortcode_template" <?php if ($my_connector->template_shortcode == 2):?>checked<?php endif;?> value="2" />
            </td>
        </tr>
    </table>
    <input type="button" id="hc_submit_admin_shortcode_template" value="Save changes" />
</div>