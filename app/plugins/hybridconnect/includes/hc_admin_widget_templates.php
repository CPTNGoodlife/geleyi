<script type="text/javascript">
    var myPicker = new jscolor.color(document.getElementById('hc_admin_txt_widget_background'), {});
    var myPicker2 = new jscolor.color(document.getElementById('hc_admin_txt_widget_strokeColor'), {});
    var myPicker3 = new jscolor.color(document.getElementById('hc_admin_txt_widget_borderColor'), {});
    //myPicker.fromString('99FF33');  // now you can access API via 'myPicker' variable
</script>
<div class="hc_admin_new_connector_top">
    <div class="hc_admin_new_connector_top_close">
        <img class="img_hc_admin_new_connector_top_close" src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/close-icon.png" border="0" />
    </div>
    <div class="clear"></div>
</div>
<div class="hc_admin_new_connector">
    <table class="tableConnectorDetails">
        <tr>
            <td class="label_column">
                Select template
                <select id="hc_admin_sel_widget_template">
                    <option <?php if ($my_connector->template_widget == 1):?>selected<?php endif?> value="1">Simple</option>
                    <option <?php if ($my_connector->template_widget == 2):?>selected<?php endif?> value="2">Side 1</option>
                    <option <?php if ($my_connector->template_widget == 3):?>selected<?php endif?> value="3">Side 2</option>
                    <option <?php if ($my_connector->template_widget == 4):?>selected<?php endif?> value="4">Side 3</option>
                </select>
            </td>
            <td class="input_column">
                <img id="wc_tpl_screenshot" src="<?php echo HYBRIDCONNECT_IAMGES_PATH . '/tpls/w' . $my_connector->template_widget . '.PNG';?>"/>
            </td>
        </tr>
    </table>
    <table class="tableConnectorDetails hc_settings_shortcode_style_container" id="hc_settings_shortcode_style_container_1">
        <tr>
            <td class="label_column">Title text</td>
            <td class="input_column">
                <input size="80" type="text" id="hc_txt_wg_title" value="<?php echo $my_settings->wg_tpl_title ?>" />
            </td>
        </tr>
        <tr>
            <td class="label_column">Description text</td>
            <td class="input_column">
                <textarea id="hc_txt_wg_description" rows="3" cols="75"><?php echo $my_settings->wg_tpl_description ?></textarea>
            </td>
        </tr>
        <tr>
            <td class="label_column">Background color</td>
            <td>
                <input class="color" id="hc_admin_txt_widget_background" value="<?php echo $my_settings->wg_background ?>"></input>
            </td>
        </tr>
        <tr>
            <td class="label_column">Font color</td>
            <td>
                <input class="color" id="hc_admin_txt_widget_strokeColor" value="<?php echo $my_settings->wg_strokeColor ?>"></input>
            </td>
        </tr>
        <tr>
            <td class="label_column">Font size</td>
            <td>
                <select id="hc_admin_txt_widget_strokeSize" style="width: 135px;">
                    <?php for ($size = 6; $size < 20; $size++): ?>
                    <option value="<?php echo $size ?>" <?php if($my_settings->wg_strokeSize == $size):?>selected<?php endif; ?>>
                        <?php echo $size ?>
                    </option>
                    <?php endfor;?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="label_column">Border color</td>
            <td>
                <input class="color" id="hc_admin_txt_widget_borderColor" value="<?php echo $my_settings->wg_borderColor ?>"></input>
            </td>
        </tr>
        <tr>
            <td class="label_column">Border width</td>
            <td>
                <input id="hc_admin_txt_widget_borderWidth" value="<?php echo $my_settings->wg_borderWidth ?>"></input>
            </td>
        </tr>
        <tr>
            <td class="label_column">Panel width</td>
            <td>
                <input type="text" id="hc_admin_txt_widget_width" value="<?php echo $my_settings->wg_width ?>"></input>
            </td>
        </tr>
    </table>
    <!-- Container for wide template (2) -->
    <table class="tableConnectorDetails hc_settings_shortcode_style_container" id="hc_settings_shortcode_style_container_2">
        <tr>
            <td class="label_column">Template picture</td>
            <td class="input_column">
                <input size="80" type="text" name="hc_admin_txt_widget_image" id="hc_admin_txt_widget_image" value="<?php echo $my_settings->wg_tpl_image ?>"/>
                <input id="hc_upload_image_button_widget" type="button" value="Select Image" /> <br/>
                Please note: image will be resized to a maximum width of 180px and a maximum height of 200px
            </td>
        </tr>
        <tr>
            <td class="label_column">Title text</td>
            <td class="input_column">
                <input size="80" type="text" id="hc_txt_wg_title2" value="<?php echo $my_settings->wg_tpl_title ?>" />
            </td>
        </tr>
        <tr>
            <td class="label_column">Description text</td>
            <td class="input_column">
                <textarea id="hc_txt_wg_description2" rows="3" cols="75"><?php echo $my_settings->wg_tpl_description ?></textarea>
            </td>
        </tr>
        <tr>
            <td class="label_column">Button text</td>
            <td class="input_column">
                <input size="30" type="text" id="hc_txt_wg_button" value="<?php echo $my_settings->wg_tpl_button ?>" />
            </td>
        </tr>
        <tr>
            <td class="label_column">Footer text</td>
            <td class="input_column">
                <input size="80" type="text" id="hc_txt_wg_footer" value="<?php echo $my_settings->wg_tpl_footer_text ?>" />
            </td>
        </tr>
        <tr>
            <td class="label_column">Enable footer text</td>
            <td class="input_column">
                <input type="checkbox" id="hc_chk_wg_footer" <?php if($my_settings->wg_tpl_footer_enable == 1):?>checked<?php endif?> /> Yes
            </td>
        </tr>
        <tr>
            <td class="label_column">Widget width</td>
            <td class="input_column">
                <input size="80" type="text" id="hc_txt_wg_width" value="<?php echo $my_settings->wg_tpl_width ?>" />
            </td>
        </tr>
    </table>
    <input type="button" id="hc_preview_widget" value="Save and preview" />
    <input type="button" id="hc_submit_admin_widget_template" value="Save changes" />
</div>