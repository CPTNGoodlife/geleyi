<div class="hc_admin_new_connector_top">
    <div class="hc_admin_new_connector_top_close">
        <img class="img_hc_admin_new_connector_top_close" src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/close-icon.png" border="0" />
    </div>
    <div class="clear"></div>
</div>
<div class="hc_admin_new_connector">
    <table class="tableConnectorDetails hc_settings_shortcode_style_container" id="hc_settings_shortcode_style_container_1">
        <tr>
            <td class="label_column">Your HTML form:</td>
            <td class="input_column">
                <textarea id="hc_txt_custom_form" rows="8" cols="95"><?php echo stripslashes_deep($my_connector->custom_form) ?></textarea>
            </td>
        </tr>
        <tr>
            <td class="label_column">HTML for facebook not connected:</td>
            <td class="input_column">
                <textarea id="hc_txt_custom_fbnot" rows="8" cols="95"><?php echo stripslashes_deep($my_connector->custom_fbnot) ?></textarea>
            </td>
        </tr>
        <tr>
            <td class="label_column">HTML for facebook connected:</td>
            <td class="input_column">
                <textarea id="hc_txt_custom_fbyes" rows="8" cols="95"><?php echo stripslashes_deep($my_connector->custom_fbyes) ?></textarea>
            </td>
        </tr>
        <tr>
            <td class="label_column">Connector width</td>
            <td class="input_column">
                <input type="text" id="hc_custom_width" value="<?php echo $my_connector->custom_width ?>" />
            </td>
        </tr>
        <tr>
            <td class="label_column">Enable as shortcode template</td>
            <td class="input_column">
                <input type="checkbox" id="hc_chk_shortcode" <?php if($my_connector->template_shortcode == 1):?>checked<?php endif?> /> Yes
            </td>
        </tr>
        <tr>
            <td class="label_column">Enable as widget template</td>
            <td class="input_column">
                <input type="checkbox" id="hc_chk_widget" <?php if($my_connector->template_widget == 1):?>checked<?php endif?> /> Yes
            </td>
        </tr>
        <tr>
            <td class="label_column">Enable as lightbox template</td>
            <td class="input_column">
                <input type="checkbox" id="hc_chk_lightbox" <?php if($my_connector->template_lightbox == 1):?>checked<?php endif?> /> Yes
            </td>
        </tr>
    </table>
    <input type="button" id="hc_submit_admin_custom_template" value="Save changes" class="hcAdminButton" />
</div>