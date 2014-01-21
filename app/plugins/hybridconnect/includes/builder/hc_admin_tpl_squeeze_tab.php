<div id="tabs-5" class="tabOptions ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
    <h2>Squeeze Page Settings</h2>
    <table style="background: none repeat scroll 0% 0% rgb(255, 255, 204); padding: 20px; width: 500px; ">
        <tbody><tr>
                <th colspan="4" class="activationSettings expandable">
                    Display Settings
                </th>
            </tr>

             <tr class="activationSettingsContent">
             <td>
            Enable this squeeze page
            </td>
            <td colspan="3">
            <input type="checkbox" id="squeezeEnabled" name="squeezeEnabled" <?php if ($squeeze_options->squeeze_enabled == 1): ?>checked="checked"<?php endif ?> />
            </td>
            </tr>

            <tr class="activationSettingsContent">
            

            <td>
            Show on Page:
            </td>
            <td colspan="3">
                <select name="squeezePageShow" id="squeezePageShow">
                    <?php foreach ($available_pages as $page): ?>
                        <option <?php if ($squeeze_options->single_page == $page->id): ?>selected<?php endif; ?>  value="<?php echo $page->id; ?>">
                            <?php echo $page->post_title ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
            </tr>

            
            <tr class="activationSettingsContent">
                                    <td class="squeezeBackgroundColour">
                                        Squeeze Background Colour
                                    </td>
                                    <td class="squeezeBackgroundColour" colspan="3">
                                        <input autocomplete="off" maxlength="7" id="squeezeBGColor" name="squeezeBGColor" value="<?php echo $squeeze_options->squeeze_bg_color ?>" class="color-picker miniColors" type="text">
                                        </td>
                                        </tr>
                                   <tr class="activationSettingsContent">

                                    <td colspan="2" style="background:#EEB;">
                                        <input id="squeezeGradientCheckbox" name="squeezeGradientCheckbox" type="checkbox" <?php if ($squeeze_options->squeeze_gradient_checkbox == 1): ?>checked="checked"<?php endif ?> /> Gradient Background
                                    </td>

                                    <td colspan="2" style="background:#EEB;">
                                        <input id="squeezePictureCheckbox" name="squeezePictureCheckbox" type="checkbox" <?php if ($squeeze_options->squeeze_picture_checkbox == 1): ?>checked="checked"<?php endif ?> /> Picture Background
                                    </td>
                                </tr>
                                </table>
  <table style="background: none repeat scroll 0% 0% rgb(255, 255, 204); padding: 20px; width: 500px; ">
 <tr class="squeezegradientBackgroundSettings activationSettingsContent expandableSettings" style="background: none repeat scroll 0% 0% rgb(238, 238, 187);">
<td>Colour 1</td>
<td>
<input autocomplete="off" maxlength="7" id="squeezeGradientBGColor1" value="<?php echo $squeeze_options->squeeze_gradient_color1; ?>" name="squeezeGradientBGColor1" class="color-picker miniColors" type="text">
</td>
<td>Colour 2</td>
<td>
<input autocomplete="off" maxlength="7" id="squeezeGradientBGColor2" value="<?php echo $squeeze_options->squeeze_gradient_color2; ?>" name="squeezeGradientBGColor2" class="color-picker miniColors" type="text">
</td>
</tr>


<tr class="squeezePictureBGSettings activationSettingsContent expandableSettings" style="background: #eeb;">
                <td>
<a onclick="myMediaPopupHandler('squeezeImageBackgroundUploadFilePath', 'squeezeImageBG')"><button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false"><span class="ui-button-text">Upload Image</span></button></a>
                </td>
                <td colspan="3">
                    <input id="squeezeImageBackgroundUploadFilePath" name="squeezeImageBackgroundUploadFilePath" size="50" value="<?php echo $squeeze_options->squeeze_bgimage_url; ?>" type="text">
                </td>
            </tr>
            <tr class="squeezePictureBGSettings activationSettingsContent expandableSettings" style="background: #eeb;">
            <td colspan="4">
             <b>Optional Background Image Setttings:-</b>
            </td>
            </tr>
            
            <tr class="squeezePictureBGSettings activationSettingsContent expandableSettings" style="background: #eeb;">
                 <td>
                <input type="checkbox" id="squeezeTileBG" name="squeezeTileBG" <?php if ($squeeze_options->squeeze_tile == 1): ?>checked="checked"<?php endif ?> />
                Tile Background</td>
                <td>
                <input type="checkbox" id="repeatXAxis" name="repeatXAxis" <?php if ($squeeze_options->repeat_x_axis == 1): ?>checked="checked"<?php endif ?> />
                Repeat on X-Axis</td>
                <td colspan="2">
                <input type="checkbox" id="repeatYAxis" name="squeezeEnabled" <?php if ($squeeze_options->repeat_y_axis == 1): ?>checked="checked"<?php endif ?> />
                Repeat on Y-Axis
                </td>
            </tr>
            <tr class="squeezePictureBGSettings activationSettingsContent expandableSettings" style="background: #eeb;">
                 <td colspan="4">
                 If you don't select any of the three options above then the background image will stretch to cover the entire screen.
                </td>
            </tr>
            <tr>
            
            </tr>
            
             <tbody><tr>
                <th colspan="4" class="optinBoxPosition expandable">
                    Optin Box Position
                </th>
            </tr>
            <table style="background: none repeat scroll 0% 0% rgb(255, 255, 204); padding: 20px; width: 500px; ">
            <tr class="optinBoxPositionContent expandableSettings">
            <td>
            Center of Screen
            &nbsp; <input type="checkbox" id="centredOnScreen" name="centredOnScreen" <?php if ($squeeze_options->centre_aligned == 1): ?>checked="checked"<?php endif ?> />
            </td>
            <td>
            Align to top of page
             &nbsp;<input type="checkbox" id="verticallyAligned" name="verticallyAligned" <?php if ($squeeze_options->vertically_aligned == 1): ?>checked="checked"<?php endif ?> />
            </td>
            </tr>
            <tr class="optinBoxPositionContent expandableSettings">
            <td>
            Top Margin
            </td>
           <td>
           <div class="demo">
           <input value="<?php echo $squeeze_options->vertical_top_margin; ?>" id="optinTopMargin" name="optinTopMargin" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% #FFC;" type="text">
           <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="optinTopMarginSlider"><a style="left: 30.4348%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
           </div>
           </td>
            </tr>

            
            </table>

</div>