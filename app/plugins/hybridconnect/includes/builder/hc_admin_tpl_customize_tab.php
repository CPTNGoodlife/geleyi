<div id="tabs-2" class="tabOptions ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
                                <h2>Customise Your Template</h2>
                                <table style="background: none repeat scroll 0% 0% rgb(255, 255, 204); padding: 20px; width: 500px;">
                                    <tbody><tr>
                                            <th colspan="4" class="connectorSettings expandable" id="connectorExpandedMarker">
                                                Connector Settings
                                            </th>
                                        <tr class="responsiveSettings  connectorSettingsContent expandableSettings">
                                            <td colspan="2">
                                               <a href="http://fast.wistia.com/embed/iframe/lfcj69y85z?autoPlay=true&fullscreenButton=false&playerColor=050505&popover=true&version=v1&videoHeight=450&videoWidth=800&volumeControl=true" class="wistia-popover[height=450,playerColor=050505,width=800]" style="float:left;"><li class="ui-state-default ui-corner-all ui-state-hover helpvideos" id="ldl5p55sf0" title="Templates in 60 seconds or less"><span class="ui-icon ui-icon-help"></span></li></a> Make this template Responsive?
                                            </td>
                                            <td colspan="2">
                                                <input type="checkbox" id="reponsive" name="responsive" <?php if ($style_connector->is_responsive == 1): ?>checked="checked"<?php endif ?> />

                                            </td>
                                        <tr class="responsiveExplanationRow connectorSettingsContent expandableSettings" style="display:none">
                                            <th colspan="4">
                                                Responsive Opt-In Box Settings
                                            </th>
                                        </tr>
                                        <tr class="responsiveExplanationRow connectorSettingsContent expandableSettings" style="display:none">
                                            <td colspan="2">
                                                Preview responsive Opt In:
                                            </td>
                                            <td colspan="2">
                                                <div class="demo">
                                                    <input value="250px" id="responsiveSliderInput" name="responsiveSliderInput" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% #FFC;" type="text">
                                                    <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="responsiveSlider"><a style="left: 30.4348%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                                </div><!-- End demo -->
                                            </td>
                                        </tr>
                                        <tr class="responsiveExplanationRow connectorSettingsContent expandableSettings" style="display:none">
                                            <td>
                                                Opt in box Min Width
                                            </td>
                                            <td>
                                                <input id="responsiveOptinMinWidth" name="responsiveOptinMinWidth" size="3" value="<?php echo $style_connector->min_width ?>" type="text" />px
                                            </td>
                                            <td>
                                                Opt in box Max Width
                                            </td>
                                            <td>
                                                <input id="responsiveOptinMaxWidth" name="responsiveOptinMaxWidth" size="3" value="<?php echo $style_connector->max_width ?>" type="text" />px
                                            </td>
                                        </tr>
                                        <tr class="responsiveExplanationRow connectorSettingsContent expandableSettings" style="display:none">
                                            <td>
                                                Image Min Width
                                            </td>
                                            <td>
                                                <input id="responsiveMinWidth" name="responsiveMinWidth" size="3" value="<?php echo $style_image->min_width ?>" type="text" />px
                                            </td>
                                            <td>
                                                Image Max Width
                                            </td>
                                            <td>
                                                <input id="responsiveMaxWidth" name="responsiveMaxWidth" size="3" value="<?php echo $style_image->max_width ?>" type="text" />px
                                            </td>
                                        </tr>
                                        <tr class="responsiveExplanationRow connectorSettingsContent expandableSettings" style="display:none">
                                            <td>
                                                Image Min Height
                                            </td>
                                            <td>
                                                <input id="responsiveMinHeight" name="responsiveMinHeight" size="3" value="<?php echo $style_image->min_height ?>" type="text" />px
                                            </td>
                                            <td>
                                                Image Max Height
                                            </td>
                                            <td>
                                                <input id="responsiveMaxHeight" name="responsiveMaxHeight" size="3" value="<?php echo $style_image->max_height ?>" type="text" />px
                                            </td>
                                        </tr>
                                        <tr class="responsiveExplanationRow connectorSettingsContent expandableSettings" style="display:none;">
                                            <td colspan="4">
                                                <p><strong>Please note:</strong> All other width and height sliders have been disabled because you have chosen to make this template responsive.  This means the optin box will expand to the width of its surrounding elements on the page.</p>
                                            </td>
                                        </tr>
                                    </tr><tr class="widthAndHeightSettings connectorSettingsContent expandableSettings hideWhenResponsive">
                                    <td>
                                        Opt in box width
                                    </td>
                                    <td>
                                        <div class="demo">
                                            <input value="<?php echo $style_connector->opt_in_box_width ?>" id="connectorWidth" name="connectorWidth" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="connectorWidthSlider"><a style="left: 52.9412%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div><!-- End demo -->
                                    </td>
                                    <td>
                                        Opt in box height
                                    </td>
                                    <td>
                                        <div class="demo">
                                            <input value="<?php echo $style_connector->opt_in_box_height ?>" id="connectorHeight" name="connectorHeight" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="connectorHeightSlider"><a style="left: 30.9091%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div><!-- End demo -->
                                    </td>
                                </tr>
                                 <tr class="connectorSettingsContent expandableSettings hideWhenResponsive">
                                    <td>
                                        Call to Action Height
                                    </td>
                                    <td>
                                        <div class="demo">
                                            <input value="<?php echo $style_connector->call_action_height ?>" id="callToActionHeight" name="callToActionHeight" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="callToActionHeightSlider"><a style="left: 16%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div><!-- End demo -->
                                    </td>
                                    </tr>
                                <tr class="connectorSettingsContent expandableSettings hideWhenResponsive">
                                    <td colspan="4" style="background:#EEB;">
                                       <a href="http://fast.wistia.com/embed/iframe/8xwhsypi50?playerColor=26cc2c&version=v1&videoHeight=450&videoWidth=800&volumeControl=true" class="wistia-popover[height=450,playerColor=050505,width=800]" style="float:left;"><li class="ui-state-default ui-corner-all helpvideos ui-state-hover" id="ldl5p55sf0" title="Templates in 60 seconds or less"><span class="ui-icon ui-icon-help"></span></li></a> <input id="individualHeightCheckbox" name="individualHeightCheckbox" type="checkbox" <?php if ($style_connector->set_heights == 1): ?>checked="checked"<?php endif ?> /> Set heights individually
                                    </td>
                                </tr>
                                <tr class="individualHeightSettings connectorSettingsContent expandableSettings hideWhenResponsive" style="display: none; background: none repeat scroll 0% 0% rgb(238, 238, 187);">
                                    <td>
                                        Email optin box height
                                    </td>
                                    <td>
                                        <div class="demo">
                                            <input value="220px" id="emailBoxHeight" name="emailBoxHeight" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(238, 238, 187);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="emailBoxHeightSlider"><a style="left: 30.4348%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div><!-- End demo -->
                                    </td>
                                    <td>
                                        Email call to action height
                                    </td>
                                    <td>
                                        <div class="demo">
                                            <input value="90px" id="emailCallToActionHeight" name="emailCallToActionHeight" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(238, 238, 187);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="emailCallToActionHeightSlider"><a style="left: 11.5942%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div><!-- End demo -->
                                    </td>
                                </tr>
                                <tr class="individualHeightSettings connectorSettingsContent expandableSettings hideWhenResponsive" style="display: none; background: none repeat scroll 0% 0% rgb(238, 238, 187);">
                                    <td>
                                        Facebook optin box height
                                    </td>
                                    <td>
                                        <div class="demo">
                                            <input value="220px" id="facebookBoxHeight" name="facebookBoxHeight" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(238, 238, 187);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="facebookBoxHeightSlider"><a style="left: 30.4348%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div><!-- End demo -->
                                    </td>
                                    <td>
                                        Facebook call to action height
                                    </td>
                                    <td>
                                        <div class="demo">
                                            <input value="90px" id="facebookCallToActionHeight" name="facebookCallToActionHeight" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(238, 238, 187);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="facebookCallToActionHeightSlider"><a style="left: 11.5942%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div><!-- End demo -->
                                    </td>
                                </tr>
                                <tr class="individualHeightSettings connectorSettingsContent expandableSettings hideWhenResponsive" style="display: none; background: none repeat scroll 0% 0% rgb(238, 238, 187);">
                                    <td>
                                        One Click optin box height
                                    </td>
                                    <td>
                                        <div class="demo">
                                            <input value="220px" id="oneClickBoxHeight" name="oneClickBoxHeight" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(238, 238, 187);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="oneClickBoxHeightSlider"><a style="left: 30.4348%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div><!-- End demo -->
                                    </td>
                                    <td>
                                        One Click call to action height
                                    </td>
                                    <td>
                                        <div class="demo">
                                            <input value="<?php echo $style_connector->call_action_height ?>" id="oneClickCallToActionHeight" name="oneClickCallToActionHeight" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(238, 238, 187);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="oneClickCallToActionHeightSlider"><a style="left: 11.5942%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div><!-- End demo -->
                                    </td>
                                </tr>
                                <tr class="connectorSettingsContent expandableSettings">
                                    <td class="templateBackgroundColour">
                                        Template Background Colour
                                    </td>
                                    <td class="templateBackgroundColour">
                                        <input autocomplete="off" maxlength="7" id="connectorBGColor" name="connectorBGColor" value="<?php echo $style_connector->tpl_bg_color ?>" class="color-picker miniColors" type="text">
                                    </td>
                                    <td>
                                        Opt in Background Colour
                                    </td>
                                    <td>
                                        <input autocomplete="off" maxlength="7" id="OptinBGColor" value="<?php echo $style_connector->opt_in_bg_color ?>" name="OptinBGColor" class="color-picker miniColors" type="text">
                                    </td>
                                </tr>
                                <tr class="connectorSettingsContent expandableSettings">
                                    <td colspan="2" style="background:#EEB;">
                                        <input id="gradientBackgroundCheckbox" name="gradientBackgroundCheckbox" type="checkbox" <?php if ($style_connector->template_gradient == 1): ?>checked="checked"<?php endif ?> /> Gradient Background
                                    </td>

                                    <td colspan="2" style="background:#EEB;">
                                        <input id="pictureBackgroundCheckbox" name="pictureBackgroundCheckbox" type="checkbox" <?php if ($style_connector->template_picturebg == 1): ?>checked="checked"<?php endif ?> /> Picture Background <a href="http://fast.wistia.com/embed/iframe/ldl5p55sf0?playerColor=26cc2c&version=v1&videoHeight=450&videoWidth=800&volumeControl=true" class="wistia-popover[height=450,playerColor=050505,width=800]" style="float:left;"><li class="ui-state-default ui-corner-all helpvideos ui-state-hover" id="ldl5p55sf0" title="Templates in 60 seconds or less"><span class="ui-icon ui-icon-help"></span></li></a>
                                    </td>
                                </tr>
 <tr class="gradientBackgroundSettings connectorSettingsContent expandableSettings" style="background: none repeat scroll 0% 0% rgb(238, 238, 187);">
<td>Colour 1</td>
<td>
<input autocomplete="off" maxlength="7" id="templateBGColor1" value="<?php echo $style_connector->template_bgcolor_1; ?>" name="templateBGColor1" class="color-picker miniColors" type="text">
</td>
<td>Colour 2</td>
<td>
<input autocomplete="off" maxlength="7" id="templateBGColor2" value="<?php echo $style_connector->template_bgcolor_2; ?>" name="templateBGColor2" class="color-picker miniColors" type="text">
</td>
</tr>


<tr class="pictureBackgroundSettings connectorSettingsContent expandableSettings" style="background: #eeb;">
                <td>
<a onclick="myMediaPopupHandler('imageBackgroundUploadFilePath', 'imageBG')"><button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false"><span class="ui-button-text">Upload Image</span></button></a>
                </td>
                <td colspan="3">
                    <input id="imageBackgroundUploadFilePath" name="imageBackgroundUploadFilePath" size="50" value="<?php echo $bgImageURL; ?>" type="text">
                </td>
            </tr>
            
            <tr class="connectorSettingsContent expandableSettings">
                                    <td colspan="2" style="background:#ffffcc;">
                                        <input id="transparentBackgroundCheckbox" name="transparentBackgroundCheckbox" type="checkbox" <?php if ($style_connector->template_transparent_bg == 1): ?>checked="checked"<?php endif ?> /> Transparent Background
                                    </td>

                                    <td colspan="2" style="background:#ffffcc;">
                                        <input id="transparentOptinBackgroundCheckbox" name="transparentOptinBackgroundCheckbox" type="checkbox" <?php if ($style_connector->template_transparent_optin_bg == 1): ?>checked="checked"<?php endif ?> /> Transparent Opt In Background
                                    </td>
                                </tr>

                                <tr class="connectorSettingsContent expandableSettings">

                                    <td>
                                        Border Width
                                    </td>
                                    <td>
                                        <div class="demo">
                                            <input value="<?php echo $style_connector->border_width ?>" id="borderWidth" name="borderWidth" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="borderWidthSlider"><a style="left: 6.66667%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div><!-- End demo -->
                                    </td>
                                    
                                      <td>Rounded Corners</td>
<td> <div class="demo">
                                            <input value="<?php echo $style_connector->border_width ?>" id="roundedCornerWidth" name="rounderCornerWidth" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="roundedCornerSlider"><a style="left: 6.66667%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                    </div>
</td>
                                </tr>
                                <tr class="connectorSettingsContent expandableSettings">
                                    <td>
                                        Border Colour
                                    </td>
                                    <td>
                                        <input autocomplete="off" maxlength="7" id="borderColor" name="borderColor" value="<?php echo $style_connector->border_color ?>" class="color-picker miniColors" type="text">
                                    </td>
                                    <td>
                                    Border Style
                                    </td>
                                    <td>
                                    <select name="borderStyle" id="borderStyle">
                                            <option <?php if ($style_connector->border_style == "dotted"): ?>selected="selected"<?php endif ?> value="dotted">Dotted</option>
                                            <option <?php if ($style_connector->border_style == "dashed"): ?>selected="selected"<?php endif ?> value="dashed">Dashed</option>
                                            <option <?php if ($style_connector->border_style == "double"): ?>selected="selected"<?php endif ?> value="double">Double</option>
                                            <option <?php if ($style_connector->border_style == "groove"): ?>selected="selected"<?php endif ?> value="groove">Groove</option>
                                            <option <?php if ($style_connector->border_style == "ridge"): ?>selected="selected"<?php endif ?> value="ridge">Ridge</option>
                                            <option <?php if ($style_connector->border_style == "inset"): ?>selected="selected"<?php endif ?> value="inset">Inset</option>
                                            <option <?php if ($style_connector->border_style == "outset"): ?>selected="selected"<?php endif ?> value="outset">Outset</option>
                                            <option <?php if ($style_connector->border_style == "solid"): ?>selected="selected"<?php endif ?> value="solid">Solid</option>
                                        </select>
                                    </td>

                                </tr>
                                <tr>
                                    <th colspan="4" class="emailInputFieldSettings expandable">
                                        Email Input Field Settings
                                    </th>
                                </tr>
                                <tr class="emailInputFieldSettingsContent expandableSettings">
                                    <td>
                                        Input Field Border Color
                                    </td>
                                    <td>
                                        <input autocomplete="off" maxlength="7" id="inputFieldBorderColor" value="<?php echo $style_email->input_border_color ?>" name="inputFieldBorder" class="color-picker miniColors" type="text">
                                    </td>
                                    <td>
                                        Input Field Bg Color
                                    </td>
                                    <td>
                                        <input autocomplete="off" maxlength="7" id="inputFieldBackgroundColor" name="inputFieldBackgroundColor" value="<?php echo $style_email->input_bg_color ?>" class="color-picker miniColors" type="text">
                                    </td>
                                </tr>
                                <tr class="emailInputFieldSettingsContent expandableSettings">
                                    <td>
                                        Input Text Colour
                                    </td>
                                    <td>
                                        <input autocomplete="off" maxlength="7" id="inputTextColor" name="inputTextColor" value="<?php echo $style_email->input_font_color ?>" class="color-picker miniColors" type="text">
                                    </td>
                                    <td>
                                        Input Text Font
                                    </td>
                                    <td>
                                        <select name="inputTextFont" id="inputTextFont">
                                            <option <?php if ($style_email->input_font_family == "berlin Sans FB"): ?>selected="selected"<?php endif ?> value="berlin Sans FB">berlin Sans FB</option>
                                            <option <?php if ($style_email->input_font_family == "Arial"): ?>selected="selected"<?php endif ?> value="Arial">Arial</option>
                                            <option <?php if ($style_email->input_font_family == "Verdana"): ?>selected="selected"<?php endif ?> value="Verdana">Verdana</option>
                                            <option <?php if ($style_email->input_font_family == "Impact"): ?>selected="selected"<?php endif ?> value="Impact">Impact</option>
                                            <option <?php if ($style_email->input_font_family == "Dosis"): ?>selected="selected"<?php endif ?> value="Dosis">Dosis</option>
                                            <option <?php if ($style_email->input_font_family == "Droid Sans"): ?>selected="selected"<?php endif ?> value="Droid Sans">Droid Sans</option>
                                            <option <?php if ($style_email->input_font_family == "Crushed"): ?>selected="selected"<?php endif ?> value="Crushed">Crushed</option>
                                            <option <?php if ($style_email->input_font_family == "Parisienne"): ?>selected="selected"<?php endif ?> value="Parisienne">Parisienne</option>
                                            <option <?php if ($style_email->input_font_family == "Lora"): ?>selected="selected"<?php endif ?> value="Lora">Lora</option>
                                            <option <?php if ($style_email->input_font_family == "PT Sans"): ?>selected="selected"<?php endif ?> value="PT Sans">PT Sans</option>
                                            <option <?php if ($style_email->input_font_family == "PT Sans Narrow"): ?>selected="selected"<?php endif ?> value="PT Sans Narrow">PT Sans Narrow</option>
                                            <option <?php if ($style_email->input_font_family == "Ubuntu"): ?>selected="selected"<?php endif ?> value="Ubuntu">Ubuntu</option>
                                            <option <?php if ($style_email->input_font_family == "Lobster"): ?>selected="selected"<?php endif ?> value="Lobster">Lobster</option>
                                            <option <?php if ($style_email->input_font_family == "Anton"): ?>selected="selected"<?php endif ?> value="Anton">Anton</option>
                                            <option <?php if ($style_email->input_font_family == "Holtwood One SC"): ?>selected="selected"<?php endif ?> value="Holtwood One SC">Holtwood One SC</option>
                                            <option <?php if ($style_email->input_font_family == "Russo One"): ?>selected="selected"<?php endif ?> value="Russo One">Russo One</option>
                                            <option <?php if ($style_email->input_font_family == "Great Vibes"): ?>selected="selected"<?php endif ?> value="Great Vibes">Great Vibes</option>
                                            <option <?php if ($style_email->input_font_family == "Droid Serif"): ?>selected="selected"<?php endif ?> value="Droid Serif">Droid Serif</option>
                                            <option <?php if ($style_email->input_font_family == "Open Sans"): ?>selected="selected"<?php endif ?> value="Open Sans">Open Sans</option>
                                            <option <?php if ($style_email->input_font_family == "Oswald"): ?>selected="selected"<?php endif ?> value="Oswald">Oswald</option>
                                            <option <?php if ($style_email->input_font_family == "Yanone Kaffeesatz"): ?>selected="selected"<?php endif ?> value="Yanone Kaffeesatz">Yanone Kaffeesatz</option>
                                            <option <?php if ($style_email->input_font_family == "Homenaje"): ?>selected="selected"<?php endif ?> value="Homenaje">Homenaje</option>
                                            <option <?php if ($style_email->input_font_family == "Bowlby One SC"): ?>selected="selected"<?php endif ?> value="Bowlby One SC">Bowlby One SC</option>
                                            <option <?php if ($style_email->input_font_family == "Seaweed Script"): ?>selected="selected"<?php endif ?> value="Seaweed Script">Seaweed Script</option>
                                            <option <?php if ($style_email->input_font_family == "News Cycle"): ?>selected="selected"<?php endif ?> value="News Cycle">News Cycle</option>
                                            <option <?php if ($style_email->input_font_family == "Oxygen"): ?>selected="selected"<?php endif ?> value="Oxygen">Oxygen</option>
                                            <option <?php if ($style_email->input_font_family == "Open Sans"): ?>selected="selected"<?php endif ?> value="Open Sans">Open Sans</option>
                                        </select>
                                    </td>
                                </tr>
                                
                                <tr class="emailInputFieldSettingsContent expandableSettings">
                                    <td>
                                        Font Size
                                    </td>
                                    <td>
                                        <div class="demo">
                                            <input value="<?php echo $style_optin->field_font_size ?>" id="fieldFontSize" name="fieldFontSize" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="fieldFontSizeSlider"><a style="left: 44.8276%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div></td>
                                        
                                        <td>
                                        Field Height
                                    </td>
                                    <td>
                                        <div class="demo">
                                            <input value="<?php echo $style_optin->field_height ?>" id="fieldHeight" name="fieldHeight" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="fieldHeightSlider"><a style="left: 44.8276%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div></td>
                                </tr>
                                
                                
                                 <tr class="emailInputFieldSettingsContent expandableSettings">
                                    <td>
                                        Padding Top/Bottom
                                    </td>
                                    <td>
                                        <div class="demo">
                                            <input value="<?php echo $style_optin->field_padding_top_bottom ?>" id="fieldPaddingTopBottom" name="fieldPaddingTopBottom" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="fieldPaddingTopBottomSlider"><a style="left: 44.8276%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div></td>

                                        <td>
                                        Padding Left/Right
                                    </td>
                                    <td>
                                        <div class="demo">
                                            <input value="<?php echo $style_optin->field_padding_left_right ?>" id="fieldPaddingLeftRight" name="fieldPaddingLeftRight" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="fieldPaddingLeftRightSlider"><a style="left: 44.8276%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div></td>
                                </tr>
                                

                                
                                 <tr class="emailInputFieldSettingsContent expandableSettings">
                                    <td>
                                        Name Field Length
                                    </td>
                                    <td>
                                        <div class="demo">
                                            <input value="<?php echo $style_optin->name_length ?>" id="nameFieldLength" name="nameFieldLength" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="nameFieldLengthSlider"><a style="left: 44.8276%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div></td>
                                    <td>
                                        Email Field Length
                                    </td>
                                    <td>
                                        <div class="demo">
                                            <input value="<?php echo $style_optin->email_length ?>" id="emailFieldLength" name="emailFieldLength" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="emailFieldLengthSlider"><a style="left: 44.8276%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div></td>
                                </tr>
                                
                                <tr class="emailInputFieldSettingsContent expandableSettings">
                                    <td>
                                        Input Label (Name)
                                    </td>
                                    <td>
                                        <input autocomplete="off" maxlength="20" id="nameLabelField" value="<?php echo $style_email->name_label_field ?>" name="nameLabelField" type="text">
                                    </td>
                                    <td>
                                        Input Label (Email)
                                    </td>
                                    <td>
                                        <input autocomplete="off" maxlength="20" id="emailLabelField" name="emailLabelField" value="<?php echo $style_email->email_label_field ?>" type="text">
                                    </td>
                                </tr>
                                
                                <tr class="emailInputFieldSettingsContent expandableSettings">
                                    <td>
                                        Border Width
                                    </td>
                                    <td>
                                        <div class="demo">
                                            <input value="<?php echo $style_optin->field_border_width ?>" id="fieldBorderWidth" name="fieldBorderWidth" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="fieldBorderWidthSlider"><a style="left: 44.8276%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div></td>
                                        
                                         <td>
                                    Border Style
                                    </td>
                                    <td>
                                    <select name="fieldBorderStyle" id="fieldBorderStyle">
                                            <option <?php if ($style_optin->field_border_style == "dotted"): ?>selected="selected"<?php endif ?> value="dotted">Dotted</option>
                                            <option <?php if ($style_optin->field_border_style == "dashed"): ?>selected="selected"<?php endif ?> value="dashed">Dashed</option>
                                            <option <?php if ($style_optin->field_border_style == "double"): ?>selected="selected"<?php endif ?> value="double">Double</option>
                                            <option <?php if ($style_optin->field_border_style == "groove"): ?>selected="selected"<?php endif ?> value="groove">Groove</option>
                                            <option <?php if ($style_optin->field_border_style == "ridge"): ?>selected="selected"<?php endif ?> value="ridge">Ridge</option>
                                            <option <?php if ($style_optin->field_border_style == "inset"): ?>selected="selected"<?php endif ?> value="inset">Inset</option>
                                            <option <?php if ($style_optin->field_border_style == "outset"): ?>selected="selected"<?php endif ?> value="outset">Outset</option>
                                            <option <?php if ($style_optin->field_border_style == "solid"): ?>selected="selected"<?php endif ?> value="solid">Solid</option>
                                        </select>
                                    </td>

                                </tr>
                                
                                 <tr class="emailInputFieldSettingsContent expandableSettings">
                                    <td>
                                        Border Radius
                                    </td>
                                    <td>
                                        <div class="demo">
                                            <input value="<?php echo $style_optin->field_border_radius ?>" id="fieldBorderRadius" name="fieldBorderRadius" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="fieldBorderRadiusSlider"><a style="left: 44.8276%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div></td>

                                </tr>
                                
                                <tr class="textSettings">
                                    <th colspan="4" class="textSettings expandable">
                                        Text Formatting
                                    </th>
                                </tr>
                                <tr class="textSettingsContent expandableSettings">
                                    <td>
                                        Headline Text Color
                                    </td>
                                    <td>
                                        <input autocomplete="off" maxlength="7" id="headlineTextColor" name="headlineTextColor" value="<?php echo $style_text->headline_font_color ?>" class="color-picker miniColors" type="text">
                                    </td>
                                    <td>
                                        Headline Font
                                    </td>
                                    <td><select name="headlineFont" id="headlineFont">
                                            <option <?php if ($style_text->headline_font_family == "berlin Sans FB"): ?>selected="selected"<?php endif ?> value="berlin Sans FB">berlin Sans FB</option>
                                            <option <?php if ($style_text->headline_font_family == "Arial"): ?>selected="selected"<?php endif ?> value="Arial">Arial</option>
                                            <option <?php if ($style_text->headline_font_family == "Verdana"): ?>selected="selected"<?php endif ?> value="Verdana">Verdana</option>
                                            <option <?php if ($style_text->headline_font_family == "Impact"): ?>selected="selected"<?php endif ?> value="Impact">Impact</option>
                                            <option <?php if ($style_text->headline_font_family == "Dosis"): ?>selected="selected"<?php endif ?> value="Dosis">Dosis</option>
                                            <option <?php if ($style_text->headline_font_family == "Droid Sans"): ?>selected="selected"<?php endif ?> value="Droid Sans">Droid Sans</option>
                                            <option <?php if ($style_text->headline_font_family == "Crushed"): ?>selected="selected"<?php endif ?> value="Crushed">Crushed</option>
                                            <option <?php if ($style_text->headline_font_family == "Parisienne"): ?>selected="selected"<?php endif ?> value="Parisienne">Parisienne</option>
                                            <option <?php if ($style_text->headline_font_family == "Lora"): ?>selected="selected"<?php endif ?> value="Lora">Lora</option>
                                            <option <?php if ($style_text->headline_font_family == "PT Sans"): ?>selected="selected"<?php endif ?> value="PT Sans">PT Sans</option>
                                            <option <?php if ($style_text->headline_font_family == "PT Sans Narrow"): ?>selected="selected"<?php endif ?> value="PT Sans Narrow">PT Sans Narrow</option>
                                            <option <?php if ($style_text->headline_font_family == "Ubuntu"): ?>selected="selected"<?php endif ?> value="Ubuntu">Ubuntu</option>
                                            <option <?php if ($style_text->headline_font_family == "Lobster"): ?>selected="selected"<?php endif ?> value="Lobster">Lobster</option>
                                            <option <?php if ($style_text->headline_font_family == "Anton"): ?>selected="selected"<?php endif ?> value="Anton">Anton</option>
                                            <option <?php if ($style_text->headline_font_family == "Holtwood One SC"): ?>selected="selected"<?php endif ?> value="Holtwood One SC">Holtwood One SC</option>
                                            <option <?php if ($style_text->headline_font_family == "Russo One"): ?>selected="selected"<?php endif ?> value="Russo One">Russo One</option>
                                            <option <?php if ($style_text->headline_font_family == "Great Vibes"): ?>selected="selected"<?php endif ?> value="Great Vibes">Great Vibes</option>
                                            <option <?php if ($style_text->headline_font_family == "Droid Serif"): ?>selected="selected"<?php endif ?> value="Droid Serif">Droid Serif</option>
                                            <option <?php if ($style_text->headline_font_family == "Open Sans"): ?>selected="selected"<?php endif ?> value="Open Sans">Open Sans</option>
                                            <option <?php if ($style_text->headline_font_family == "Oswald"): ?>selected="selected"<?php endif ?> value="Oswald">Oswald</option>
                                            <option <?php if ($style_text->headline_font_family == "Yanone Kaffeesatz"): ?>selected="selected"<?php endif ?> value="Yanone Kaffeesatz">Yanone Kaffeesatz</option>
                                            <option <?php if ($style_text->headline_font_family == "Homenaje"): ?>selected="selected"<?php endif ?> value="Homenaje">Homenaje</option>
                                            <option <?php if ($style_text->headline_font_family == "Bowlby One SC"): ?>selected="selected"<?php endif ?> value="Bowlby One SC">Bowlby One SC</option>
                                            <option <?php if ($style_text->headline_font_family == "Seaweed Script"): ?>selected="selected"<?php endif ?> value="Seaweed Script">Seaweed Script</option>
                                            <option <?php if ($style_text->headline_font_family == "News Cycle"): ?>selected="selected"<?php endif ?> value="News Cycle">News Cycle</option>
                                            <option <?php if ($style_text->headline_font_family == "Oxygen"): ?>selected="selected"<?php endif ?> value="Oxygen">Oxygen</option>
                                            <option <?php if ($style_text->headline_font_family == "Open Sans"): ?>selected="selected"<?php endif ?> value="Open Sans">Open Sans</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="textSettingsContent expandableSettings">
                                    <td>
                                        Headline Font  Size
                                    </td>
                                    <td>
                                        <div class="demo">
                                            <input value="<?php echo $style_text->headline_font_size ?>" id="headlineFontSize" name="headlineFontSize" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="headlineFontSizeSlider"><a style="left: 53.125%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div><!-- End demo -->
                                    </td>
                                    <td>
                                        Body Text Colour
                                    </td>
                                    <td>
                                        <input autocomplete="off" maxlength="7" id="bodyTextColor" name="bodyTextColor" value="<?php echo $style_text->border_font_color ?>" class="color-picker miniColors" type="text">
                                    </td>
                                </tr>
                                <tr class="textSettingsContent expandableSettings">
                                    <td>
                                        Body Font
                                    </td>
                                    <td>
                                        <select name="bodyFont" id="bodyFont">
                                            <option <?php if ($style_text->border_font_family == "berlin Sans FB"): ?>selected="selected"<?php endif ?> value="berlin Sans FB">berlin Sans FB</option>
                                            <option <?php if ($style_text->border_font_family == "Arial"): ?>selected="selected"<?php endif ?> value="Arial">Arial</option>
                                            <option <?php if ($style_text->border_font_family == "Verdana"): ?>selected="selected"<?php endif ?> value="Verdana">Verdana</option>
                                            <option <?php if ($style_text->border_font_family == "Impact"): ?>selected="selected"<?php endif ?> value="Impact">Impact</option>
                                            <option <?php if ($style_text->border_font_family == "Dosis"): ?>selected="selected"<?php endif ?> value="Dosis">Dosis</option>
                                            <option <?php if ($style_text->border_font_family == "Droid Sans"): ?>selected="selected"<?php endif ?> value="Droid Sans">Droid Sans</option>
                                            <option <?php if ($style_text->border_font_family == "Crushed"): ?>selected="selected"<?php endif ?> value="Crushed">Crushed</option>
                                            <option <?php if ($style_text->border_font_family == "Parisienne"): ?>selected="selected"<?php endif ?> value="Parisienne">Parisienne</option>
                                            <option <?php if ($style_text->border_font_family == "Lora"): ?>selected="selected"<?php endif ?> value="Lora">Lora</option>
                                            <option <?php if ($style_text->border_font_family == "PT Sans"): ?>selected="selected"<?php endif ?> value="PT Sans">PT Sans</option>
                                            <option <?php if ($style_text->border_font_family == "PT Sans Narrow"): ?>selected="selected"<?php endif ?> value="PT Sans Narrow">PT Sans Narrow</option>
                                            <option <?php if ($style_text->border_font_family == "Ubuntu"): ?>selected="selected"<?php endif ?> value="Ubuntu">Ubuntu</option>
                                            <option <?php if ($style_text->border_font_family == "Lobster"): ?>selected="selected"<?php endif ?> value="Lobster">Lobster</option>
                                            <option <?php if ($style_text->border_font_family == "Anton"): ?>selected="selected"<?php endif ?> value="Anton">Anton</option>
                                            <option <?php if ($style_text->border_font_family == "Holtwood One SC"): ?>selected="selected"<?php endif ?> value="Holtwood One SC">Holtwood One SC</option>
                                            <option <?php if ($style_text->border_font_family == "Russo One"): ?>selected="selected"<?php endif ?> value="Russo One">Russo One</option>
                                            <option <?php if ($style_text->border_font_family == "Great Vibes"): ?>selected="selected"<?php endif ?> value="Great Vibes">Great Vibes</option>
                                            <option <?php if ($style_text->border_font_family == "Droid Serif"): ?>selected="selected"<?php endif ?> value="Droid Serif">Droid Serif</option>
                                            <option <?php if ($style_text->border_font_family == "Open Sans"): ?>selected="selected"<?php endif ?> value="Open Sans">Open Sans</option>
                                            <option <?php if ($style_text->border_font_family == "Oswald"): ?>selected="selected"<?php endif ?> value="Oswald">Oswald</option>
                                            <option <?php if ($style_text->border_font_family == "Yanone Kaffeesatz"): ?>selected="selected"<?php endif ?> value="Yanone Kaffeesatz">Yanone Kaffeesatz</option>
                                            <option <?php if ($style_text->border_font_family == "Homenaje"): ?>selected="selected"<?php endif ?> value="Homenaje">Homenaje</option>
                                            <option <?php if ($style_text->border_font_family == "Bowlby One SC"): ?>selected="selected"<?php endif ?> value="Bowlby One SC">Bowlby One SC</option>
                                            <option <?php if ($style_text->border_font_family == "Seaweed Script"): ?>selected="selected"<?php endif ?> value="Seaweed Script">Seaweed Script</option>
                                            <option <?php if ($style_text->border_font_family == "News Cycle"): ?>selected="selected"<?php endif ?> value="News Cycle">News Cycle</option>
                                            <option <?php if ($style_text->border_font_family == "Oxygen"): ?>selected="selected"<?php endif ?> value="Oxygen">Oxygen</option>
                                            <option <?php if ($style_text->border_font_family == "Open Sans"): ?>selected="selected"<?php endif ?> value="Open Sans">Open Sans</option>
                                        </select>
                                    </td>
                                    <td>
                                        Body Text<br> Size
                                    </td>
                                    <td>
                                        <div class="demo">
                                            <input value="<?php echo $style_text->border_font_size ?>" id="mainFontSize" name="mainFontSize" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="mainFontSizeSlider"><a style="left: 31.25%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div><!-- End demo -->
                                    </td>
                                </tr>
                                <tr class="textSettingsContent expandableSettings">
                                    <td>
                                        Call to Action Color
                                    </td>
                                    <td>
                                        <input autocomplete="off" maxlength="7" id="callToActionTextColor" name="callToActionTextColor" value="<?php echo $style_text->call_action_font_color ?>" class="color-picker miniColors" type="text">
                                    </td>
                                    <td>
                                        Call to Action Font
                                    </td>
                                    <td>
                                        <select name="callToActionFont" id="callToActionFont">
                                            <option <?php if ($style_text->call_action_font_family == "berlin Sans FB"): ?>selected="selected"<?php endif ?> value="berlin Sans FB">berlin Sans FB</option>
                                            <option <?php if ($style_text->call_action_font_family == "Arial"): ?>selected="selected"<?php endif ?> value="Arial">Arial</option>
                                            <option <?php if ($style_text->call_action_font_family == "Verdana"): ?>selected="selected"<?php endif ?> value="Verdana">Verdana</option>
                                            <option <?php if ($style_text->call_action_font_family == "Impact"): ?>selected="selected"<?php endif ?> value="Impact">Impact</option>
                                            <option <?php if ($style_text->call_action_font_family == "Dosis"): ?>selected="selected"<?php endif ?> value="Dosis">Dosis</option>
                                            <option <?php if ($style_text->call_action_font_family == "Droid Sans"): ?>selected="selected"<?php endif ?> value="Droid Sans">Droid Sans</option>
                                            <option <?php if ($style_text->call_action_font_family == "Crushed"): ?>selected="selected"<?php endif ?> value="Crushed">Crushed</option>
                                            <option <?php if ($style_text->call_action_font_family == "Parisienne"): ?>selected="selected"<?php endif ?> value="Parisienne">Parisienne</option>
                                            <option <?php if ($style_text->call_action_font_family == "Lora"): ?>selected="selected"<?php endif ?> value="Lora">Lora</option>
                                            <option <?php if ($style_text->call_action_font_family == "PT Sans"): ?>selected="selected"<?php endif ?> value="PT Sans">PT Sans</option>
                                            <option <?php if ($style_text->call_action_font_family == "PT Sans Narrow"): ?>selected="selected"<?php endif ?> value="PT Sans Narrow">PT Sans Narrow</option>
                                            <option <?php if ($style_text->call_action_font_family == "Ubuntu"): ?>selected="selected"<?php endif ?> value="Ubuntu">Ubuntu</option>
                                            <option <?php if ($style_text->call_action_font_family == "Lobster"): ?>selected="selected"<?php endif ?> value="Lobster">Lobster</option>
                                            <option <?php if ($style_text->call_action_font_family == "Anton"): ?>selected="selected"<?php endif ?> value="Anton">Anton</option>
                                            <option <?php if ($style_text->call_action_font_family == "Holtwood One SC"): ?>selected="selected"<?php endif ?> value="Holtwood One SC">Holtwood One SC</option>
                                            <option <?php if ($style_text->call_action_font_family == "Russo One"): ?>selected="selected"<?php endif ?> value="Russo One">Russo One</option>
                                            <option <?php if ($style_text->call_action_font_family == "Great Vibes"): ?>selected="selected"<?php endif ?> value="Great Vibes">Great Vibes</option>
                                            <option <?php if ($style_text->call_action_font_family == "Droid Serif"): ?>selected="selected"<?php endif ?> value="Droid Serif">Droid Serif</option>
                                            <option <?php if ($style_text->call_action_font_family == "Open Sans"): ?>selected="selected"<?php endif ?> value="Open Sans">Open Sans</option>
                                            <option <?php if ($style_text->call_action_font_family == "Oswald"): ?>selected="selected"<?php endif ?> value="Oswald">Oswald</option>
                                            <option <?php if ($style_text->call_action_font_family == "Yanone Kaffeesatz"): ?>selected="selected"<?php endif ?> value="Yanone Kaffeesatz">Yanone Kaffeesatz</option>
                                            <option <?php if ($style_text->call_action_font_family == "Homenaje"): ?>selected="selected"<?php endif ?> value="Homenaje">Homenaje</option>
                                            <option <?php if ($style_text->call_action_font_family == "Bowlby One SC"): ?>selected="selected"<?php endif ?> value="Bowlby One SC">Bowlby One SC</option>
                                            <option <?php if ($style_text->call_action_font_family == "Seaweed Script"): ?>selected="selected"<?php endif ?> value="Seaweed Script">Seaweed Script</option>
                                            <option <?php if ($style_text->call_action_font_family == "News Cycle"): ?>selected="selected"<?php endif ?> value="News Cycle">News Cycle</option>
                                            <option <?php if ($style_text->call_action_font_family == "Oxygen"): ?>selected="selected"<?php endif ?> value="Oxygen">Oxygen</option>
                                            <option <?php if ($style_text->call_action_font_family == "Open Sans"): ?>selected="selected"<?php endif ?> value="Open Sans">Open Sans</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="textSettingsContent expandableSettings">
                                    <td>
                                        Call to Action Font Size
                                    </td>
                                    <td>
                                        <div class="demo">
                                            <input value="<?php echo $style_text->call_action_font_size ?>" id="callToActionFontSize" name="callToActionFontSize" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="callToActionFontSizeSlider"><a style="left: 31.25%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div><!-- End demo -->
                                    </td>
                                    <td colspan="2">
                                        <input id="headlineBold" name="headlineBold" <?php if ($style_text->headline_bold == 1): ?>checked="checked"<?php endif ?> type="checkbox">
                                        Bold headline?
                                    </td>
                                    </tr>
                                   <tr class="textSettingsContent expandableSettings">
                                     <td colspan="2">
                                     <input id="headlineCenter" name="headlineCenter" <?php if ($style_text->headline_center == 1): ?>checked="checked"<?php endif ?> type="checkbox"> Center Headline?
                                     </td>
                                     <td colspan="2">
                                     <input id="bodyCenter" name="bodyCenter" <?php if ($style_text->body_center == 1): ?>checked="checked"<?php endif ?> type="checkbox"> Center Body Text?
                                     </td>
                                </tr>
                                
                                <tr class="textPositioning">
                                    <th colspan="4" class="textPositioningSettings expandable">
                                        Text Positioning
                                    </th>
                                </tr>
                                
                                <tr class="textPositioningSettingsContent expandableSettings">
                                 <td>
                                 Text Vertical Positioning
                                 </td>
                                 <td>
                                 <div class="demo">
                                            <input value="<?php echo $style_text->text_vertical_position ?>" id="bodyTextVerticalPosition" name="bodyTextVerticalPosition" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="bodyTextVerticalPositionSlider"><a style="left: 31.25%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div><!-- End demo -->
                                 </td>
                                 
                                  <td>
                                 Bullet Left Margin
                                 </td>
                                 <td>
                                 <div class="demo">
                                            <input value="<?php echo $style_text->bullet_left_margin ?>" id="bulletLeftMargin" name="bulletLeftMargin" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="bulletLeftMarginSlider"><a style="left: 31.25%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div><!-- End demo -->
                                 </td>
                                 
                                 </tr>
                                 
                                 <tr class="textPositioningSettingsContent expandableSettings">
                                 <td>
                                 Headline Left Margin
                                 </td>
                                 <td>
                                 <div class="demo">
                                            <input value="<?php echo $style_text->headline_left_margin ?>" id="headlineLeftMargin" name="headlineLeftMargin" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="headlineLeftMarginSlider"><a style="left: 31.25%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div><!-- End demo -->
                                 </td>
                                 
                                 <td>
                                 Headline Right Margin
                                 </td>
                                 <td>
                                 <div class="demo">
                                            <input value="<?php echo $style_text->headline_right_margin ?>" id="headlineRightMargin" name="headlineRightMargin" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="headlineRightMarginSlider"><a style="left: 31.25%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div><!-- End demo -->
                                 </td>
                                 
                                </tr>
                                
                                
                                <tr class="textPositioningSettingsContent expandableSettings">
                                 <td>
                                 Text Left Margin
                                 </td>
                                 <td>
                                 <div class="demo">
                                            <input value="<?php echo $style_text->text_left_margin ?>" id="textLeftMargin" name="textLeftMargin" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="textLeftMarginSlider"><a style="left: 31.25%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div><!-- End demo -->
                                 </td>

                                 <td>
                                 Text Right Margin
                                 </td>
                                 <td>
                                 <div class="demo">
                                            <input value="<?php echo $style_text->text_right_margin ?>" id="textRightMargin" name="textRightMargin" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="textRightMarginSlider"><a style="left: 31.25%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div><!-- End demo -->
                                 </td>

                                </tr>
                                <tr class="textPositioningSettingsContent expandableSettings">
                                <td colspan="4">
                                 <p><b>Helpful Hint:</b> If you're creating a responsive connector (to use with a responsive theme) then we recommend that you leave margin settings to default where possible because high margin settings can mess with aesthetics at smaller screen resolutions.</p>
                                </td>
                                </tr>
                                <tr>
                                    <th colspan="4" class="buttonSettings expandable">
                                        Button Settings
                                    </th>
                                </tr>
                                <tr class="buttonSettingsContent expandableSettings" style="dispay:table-row;">
                                    <td colspan="2">
                                        Choose a Button:
                                    </td>
                                    <td colspan="2">
                                        <select name="buttonColourType" id="buttonColourType">
                                            <option <?php if ($style_button->btn_type == "Silver"): ?>selected="selected"<?php endif ?> value="Silver">Silver</option>
                                            <option <?php if ($style_button->btn_type == "Orange"): ?>selected="selected"<?php endif ?>  value="Orange">Orange</option>
                                            <option <?php if ($style_button->btn_type == "Red"): ?>selected="selected"<?php endif ?>  value="Red">Red</option>
                                            <option <?php if ($style_button->btn_type == "Yellow"): ?>selected="selected"<?php endif ?>  value="Yellow">Yellow</option>
                                            <option <?php if ($style_button->btn_type == "Blue"): ?>selected="selected"<?php endif ?>  value="Blue">Blue</option>
                                            <option <?php if ($style_button->btn_type == "Green"): ?>selected="selected"<?php endif ?>  value="Green">Green</option>
                                            <option <?php if ($style_button->btn_type == "Black"): ?>selected="selected"<?php endif ?>  value="Black">Black</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="buttonSettingsContent expandableSettings">
                                <td colspan="2">
                                  <input id="emailInputNewLine" name="emailInputNewLine" <?php if ($style_button->emailNewLine == 1): ?>checked="checked"<?php endif ?> type="checkbox">
                                        Put Email Input Field on New Line?
                                </td>
                                <td colspan="2">
                                  <input id="submitButtonNewLine" name="submitButtonNewLine" <?php if ($style_button->buttonNewLine == 1): ?>checked="checked"<?php endif ?> type="checkbox">
                                        Put Email Submit button on New Line?
                                </td>
                                </tr>
                                <tr class="createOwnButtonRow buttonSettingsContent expandableSettings">
                                    <td>
                                        Button Background Colour
                                    </td>
                                    <td>
                                        <input autocomplete="off" maxlength="7" id="buttonBackgroundColor" name="buttonBackgroundColor" value="<?php echo $style_button->btn_bg_color ?>" class="color-picker miniColors" type="text">
                                    </td>
                                    <td>
                                        Button Font Color
                                    </td>
                                    <td>
                                        <input autocomplete="off" maxlength="7" id="buttonFontColor" name="buttonFontColor" value="<?php echo $style_button->btn_font_color ?>" class="color-picker miniColors" type="text">
                                    </td>
                                </tr>
                                <tr class="createOwnButtonRow buttonSettingsContent expandableSettings">
                                    <td>
                                        Text Shadow Color
                                    </td>
                                    <td>
                                        <input autocomplete="off" maxlength="7" id="buttonTextShadowColor" name="buttonTextShadowColor" value="<?php echo $style_button->txt_shadow_color ?>" class="color-picker miniColors" type="text">
                                    </td>
                                    <td>
                                        Button Border Color
                                    </td>
                                    <td>
                                        <input autocomplete="off" maxlength="7" id="buttonBorderColor" name="buttonBorderColor" value="<?php echo $style_button->btn_border_color ?>" class="color-picker miniColors" type="text">
                                    </td>
                                </tr>
                                <tr class="createOwnButtonRow buttonSettingsContent expandableSettings">
                                    <td>
                                        Button Box Shadow
                                    </td>
                                    <td>
                                        <input autocomplete="off" maxlength="7" id="buttonBoxShadow" name="buttonBoxShadow" value="<?php echo $style_button->btn_box_shadow ?>" class="color-picker miniColors" type="text">
                                    </td>
                                    <td>
                                        Button Text Font
                                    </td>
                                    <td>
                                        <select name="buttonTextFont" id="buttonTextFont">
                                            <option <?php if ($style_button->btn_font_family == "berlin Sans FB"): ?>selected="selected"<?php endif ?> value="berlin Sans FB">berlin Sans FB</option>
                                            <option <?php if ($style_button->btn_font_family == "Arial"): ?>selected="selected"<?php endif ?> value="Arial">Arial</option>
                                            <option <?php if ($style_button->btn_font_family == "Verdana"): ?>selected="selected"<?php endif ?> value="Verdana">Verdana</option>
                                            <option <?php if ($style_button->btn_font_family == "Impact"): ?>selected="selected"<?php endif ?> value="Impact">Impact</option>
                                            <option <?php if ($style_button->btn_font_family == "Dosis"): ?>selected="selected"<?php endif ?> value="Dosis">Dosis</option>
                                            <option <?php if ($style_button->btn_font_family == "Droid Sans"): ?>selected="selected"<?php endif ?> value="Droid Sans">Droid Sans</option>
                                            <option <?php if ($style_button->btn_font_family == "Crushed"): ?>selected="selected"<?php endif ?> value="Crushed">Crushed</option>
                                            <option <?php if ($style_button->btn_font_family == "Parisienne"): ?>selected="selected"<?php endif ?> value="Parisienne">Parisienne</option>
                                            <option <?php if ($style_button->btn_font_family == "Lora"): ?>selected="selected"<?php endif ?> value="Lora">Lora</option>
                                            <option <?php if ($style_button->btn_font_family == "PT Sans"): ?>selected="selected"<?php endif ?> value="PT Sans">PT Sans</option>
                                            <option <?php if ($style_button->btn_font_family == "PT Sans Narrow"): ?>selected="selected"<?php endif ?> value="PT Sans Narrow">PT Sans Narrow</option>
                                            <option <?php if ($style_button->btn_font_family == "Ubuntu"): ?>selected="selected"<?php endif ?> value="Ubuntu">Ubuntu</option>
                                            <option <?php if ($style_button->btn_font_family == "Lobster"): ?>selected="selected"<?php endif ?> value="Lobster">Lobster</option>
                                            <option <?php if ($style_button->btn_font_family == "Anton"): ?>selected="selected"<?php endif ?> value="Anton">Anton</option>
                                            <option <?php if ($style_button->btn_font_family == "Holtwood One SC"): ?>selected="selected"<?php endif ?> value="Holtwood One SC">Holtwood One SC</option>
                                            <option <?php if ($style_button->btn_font_family == "Russo One"): ?>selected="selected"<?php endif ?> value="Russo One">Russo One</option>
                                            <option <?php if ($style_button->btn_font_family == "Great Vibes"): ?>selected="selected"<?php endif ?> value="Great Vibes">Great Vibes</option>
                                            <option <?php if ($style_button->btn_font_family == "Droid Serif"): ?>selected="selected"<?php endif ?> value="Droid Serif">Droid Serif</option>
                                            <option <?php if ($style_button->btn_font_family == "Open Sans"): ?>selected="selected"<?php endif ?> value="Open Sans">Open Sans</option>
                                            <option <?php if ($style_button->btn_font_family == "Oswald"): ?>selected="selected"<?php endif ?> value="Oswald">Oswald</option>
                                            <option <?php if ($style_button->btn_font_family == "Yanone Kaffeesatz"): ?>selected="selected"<?php endif ?> value="Yanone Kaffeesatz">Yanone Kaffeesatz</option>
                                            <option <?php if ($style_button->btn_font_family == "Homenaje"): ?>selected="selected"<?php endif ?> value="Homenaje">Homenaje</option>
                                            <option <?php if ($style_button->btn_font_family == "Bowlby One SC"): ?>selected="selected"<?php endif ?> value="Bowlby One SC">Bowlby One SC</option>
                                            <option <?php if ($style_button->btn_font_family == "Seaweed Script"): ?>selected="selected"<?php endif ?> value="Seaweed Script">Seaweed Script</option>
                                            <option <?php if ($style_button->btn_font_family == "News Cycle"): ?>selected="selected"<?php endif ?> value="News Cycle">News Cycle</option>
                                            <option <?php if ($style_button->btn_font_family == "Oxygen"): ?>selected="selected"<?php endif ?> value="Oxygen">Oxygen</option>
                                            <option <?php if ($style_button->btn_font_family == "Open Sans"): ?>selected="selected"<?php endif ?> value="Open Sans">Open Sans</option>
                                        </select>
                                    </td>
                                </tr>
                                 <tr class="createOwnButtonRow buttonSettingsContent expandableSettings">
                                      <td>Button Font Size</td>
                                      <td> <div class="demo">
                                            <input value="<?php echo $style_button->button_font_size ?>" id="buttonFontSize" name="buttonFontSize" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="buttonFontSizeSlider"><a style="left: 6.66667%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                    </div>
</td>
<td>Button Left/Right Padding</td>
                                      <td> <div class="demo">
                                            <input value="<?php echo $style_button->button_lr_padding ?>" id="buttonLRPadding" name="buttonLRPadding" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="buttonLRPaddingSlider"><a style="left: 6.66667%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                    </div>
</td>
                                 </tr>
<tr class="createOwnButtonRow buttonSettingsContent expandableSettings">
  <td>Button Top/Bottom Padding</td>
                                      <td> <div class="demo">
                                            <input value="<?php echo $style_button->button_tb_padding ?>" id="buttonTBPadding" name="buttonTBPadding" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="buttonTBPaddingSlider"><a style="left: 6.66667%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                    </div>
</td>
</tr>
                                <tr>
                                    <th colspan="4" class="optInBoxSettings expandable">
                                        Call to Action Box Settings
                                    </th>
                                </tr>

                                <tr class="optInBoxSettingsContent expandableSettings">
                                    <td colspan="2">
                                        <input id="emailCentre" name="emailCentre" <?php if ($style_optin->email_centered == 1): ?>checked="checked"<?php endif ?> type="checkbox"> Email Centre Aligned?
                                    </td>
                                    <td colspan="2">
                                        <input id="facebookCentre" name="facebookCentre" <?php if ($style_optin->fb_centered == 1): ?>checked="checked"<?php endif ?> type="checkbox"> Facebook Centre Aligned?
                                    </td>
                                </tr>
                                <tr class="optInBoxSettingsContent expandableSettings">
                                    <td colspan="2">
                                        <input id="oneClickCentre" name="oneClickCentre" <?php if ($style_optin->oneclick_centered == 1): ?>checked="checked"<?php endif ?> type="checkbox"> 1 Click Signup Centre Aligned?
                                    </td>
                                </tr>
                                <tr>
                                  <th colspan="4" class="dropShadowSettings expandable">
                                       Connector Drop Shadow
                                    </th>
                                </tr>
                                <tr class="dropShadowSettingsContent expandableSettings">
                                 <td colspan="2">
                                        <input id="dropShadowCheckbox" name="dropShadowCheckbox" type="checkbox" <?php if ($style_connector->drop_shadow == 1): ?>checked="checked"<?php endif ?> /> Drop Shadow?
                                    </td>
                                 <td>Horizontal Shadow</td>
                                 <td>
                                   <div class="demo">
                                            <input value="<?php echo $style_connector->h_shadow ?>" id="hShadow" name="hShadow" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="hShadowSlider"><a style="left: 44.8276%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div></td>
                               </tr>
                               <tr class="dropShadowSettingsContent expandableSettings">
                               <td> Vertical Shadow</td>
                                    <td>
                                    <div class="demo">
                                            <input value="<?php echo $style_connector->v_shadow ?>" id="vShadow" name="vShadow" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="vShadowSlider"><a style="left: 44.8276%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div></td>
                                        <td>
                                        Blur Amount
                                        </td>
                                        
                                        <td>
                                        <div class="demo">
                                            <input value="<?php echo $style_connector->blur_shadow ?>" id="blurShadow" name="blurShadow" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="blurShadowSlider"><a style="left: 44.8276%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div></td>
                                        </tr>
                                    <tr class="dropShadowSettingsContent expandableSettings">
                                      <td>
                                       Shadow Color
                                      </td>
                                      <td>
                                      <input autocomplete="off" maxlength="7" id="shadowColor" value="<?php echo $style_connector->shadow_color ?>" name="shadowColor" class="color-picker miniColors" type="text">
                                      </td>
                                    </tr>
                                    
                                    <th colspan="4" class="textShadowSettings expandable">
                                        Text Drop Shadow
                                    </th>
                                </tr>
                                <tr class="textShadowSettingsContent expandableSettings">
                                 <td colspan="2">
                                        <input id="headlineShadowCheckbox" name="headlineShadowCheckbox" type="checkbox" <?php if ($style_text->headline_shadow == 1): ?>checked="checked"<?php endif ?> /> Headline Text Shadow
                                    </td>
                                  <td colspan="2">
                                        <input id="textShadowCheckbox" name="textShadowCheckbox" type="checkbox" <?php if ($style_text->text_shadow == 1): ?>checked="checked"<?php endif ?> /> Body Text Shadow
                                    </td>

                               </tr>
                               
                                </tr>
                                <tr class="textShadowSettingsContent expandableSettings">
                                 <td colspan="2">
                                        <input id="ctaShadowCheckbox" name="ctaShadowCheckbox" type="checkbox" <?php if ($style_text->cta_shadow == 1): ?>checked="checked"<?php endif ?> /> Call to Action Text Shadow
                                    </td>
                                  <td>Horizontal Shadow</td>
                                    <td>
                                    <div class="demo">
                                            <input value="<?php echo $style_text->text_h_shadow ?>" id="textHShadow" name="textHShadow" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="textHShadowSlider"><a style="left: 44.8276%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div></td>
                                    
                               </tr>
                               <tr class="textShadowSettingsContent expandableSettings">
                               <td>
                               Vertical Shadow
                               </td>
                                    <td>
                                    <div class="demo">
                                            <input value="<?php echo $style_text->text_v_shadow ?>" id="textVShadow" name="textVShadow" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="textVShadowSlider"><a style="left: 44.8276%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div></td>
                                  <td>
                                  Blur Shadow
                                  </td>
                                    <td>
                                    <div class="demo">
                                            <input value="<?php echo $style_text->text_blur_shadow ?>" id="textBlurShadow" name="textBlurShadow" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="textBlurShadowSlider"><a style="left: 44.8276%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div></td>
                               </tr>
                               
                               <tr class="textShadowSettingsContent expandableSettings">
                                    <td>
                                    Text Shadow Colour
                                    </td>

                                    <td>
                                    <input autocomplete="off" maxlength="7" id="textShadowColor" value="<?php echo $style_text->text_shadow_color; ?>" name="textShadowColor" class="color-picker miniColors" type="text">
                                   </td>

                               </tr>
                                    <tr>
                                  <th colspan="4" class="facebookSettings expandable">
                                        Facebook Button Type
                                    </th>
                                </tr>
                                <tr class="facebookSettingsContent expandableSettings">
                                    <td colspan="4" style="text-align:center;">
                                    <a class="fb_button fb_button_small facebookSettingButton" id="facebookSmall"><span class="fb_button_text">Connect!</span></a>
                                    </td>
                               </tr>
                               <tr class="facebookSettingsContent expandableSettings">
                                    <td colspan="4" style="text-align:center;">
                                    <a class="fb_button fb_button_medium facebookSettingButton" id="facebookMedium"><span class="fb_button_text">Connect!</span></a>
                                    </td>
                               </tr>
                               <tr class="facebookSettingsContent expandableSettings">
                                    <td colspan="4" style="text-align:center;">
                                    <a class="fb_button fb_button_large facebookSettingButton" id="facebookLarge"><span class="fb_button_text">Connect!</span></a>
                                    </td>
                               </tr>
                               <tr class="facebookSettingsContent expandableSettings">
                                    <td colspan="4" style="text-align:center;">
                                    <a class="fb_button fb_button_xlarge facebookSettingButton" id="facebookXlarge"><span class="fb_button_text">Connect!</span></a>
                                    <input type="hidden" id="facebookSize" name="facebookSize" value="<?php echo $style_button->fb_button_size; ?>" />
                                    </td>
                               </tr>
                               
                               <tr>
                                  <th colspan="4" class="privacyPolicySettings expandable">
                                        Privacy Policy
                                    </th>
                                </tr>
                                
                                 <tr class="privacyPolicySettingsContent expandableSettings">
                                    <td colspan="2">
                                                <input type="checkbox" id="showPrivacyPolicy" name="showPrivacyPolicy" <?php if ($style_connector->show_privacy_policy == 1): ?>checked="checked"<?php endif ?> /> Show Privacy Policy
                                            </td>
                                            <td colspan="2">
                                                <input type="checkbox" id="boldPrivacyPolicy" name="boldPrivacyPolicy" <?php if ($style_connector->bold_privacy_policy == 1): ?>checked="checked"<?php endif ?> /> Bold Privacy Policy
                                            </td>
                               </tr>
                               
                                <tr class="privacyPolicySettingsContent expandableSettings">
                                    <td colspan="2">
                                                <input type="checkbox" id="centerPrivacyPolicy" name="centerPrivacyPolicy" <?php if ($style_connector->center_privacy_policy == 1): ?>checked="checked"<?php endif ?> /> Center Privacy Policy
                                            </td>
                                            <td>
                                        Privacy Policy Font
                                    </td>
                                    <td>
                                        <select name="privacyPolicyFont" id="privacyPolicyFont">
                                            <option <?php if ($style_connector->privacy_policy_font == "berlin Sans FB"): ?>selected="selected"<?php endif ?> value="berlin Sans FB">berlin Sans FB</option>
                                            <option <?php if ($style_connector->privacy_policy_font == "Arial"): ?>selected="selected"<?php endif ?> value="Arial">Arial</option>
                                            <option <?php if ($style_connector->privacy_policy_font == "Verdana"): ?>selected="selected"<?php endif ?> value="Verdana">Verdana</option>
                                            <option <?php if ($style_connector->privacy_policy_font == "Impact"): ?>selected="selected"<?php endif ?> value="Impact">Impact</option>
                                            <option <?php if ($style_connector->privacy_policy_font == "Dosis"): ?>selected="selected"<?php endif ?> value="Dosis">Dosis</option>
                                            <option <?php if ($style_connector->privacy_policy_font == "Droid Sans"): ?>selected="selected"<?php endif ?> value="Droid Sans">Droid Sans</option>
                                            <option <?php if ($style_connector->privacy_policy_font == "Crushed"): ?>selected="selected"<?php endif ?> value="Crushed">Crushed</option>
                                            <option <?php if ($style_connector->privacy_policy_font == "Parisienne"): ?>selected="selected"<?php endif ?> value="Parisienne">Parisienne</option>
                                            <option <?php if ($style_connector->privacy_policy_font == "Lora"): ?>selected="selected"<?php endif ?> value="Lora">Lora</option>
                                            <option <?php if ($style_connector->privacy_policy_font == "PT Sans"): ?>selected="selected"<?php endif ?> value="PT Sans">PT Sans</option>
                                            <option <?php if ($style_connector->privacy_policy_font == "PT Sans Narrow"): ?>selected="selected"<?php endif ?> value="PT Sans Narrow">PT Sans Narrow</option>
                                            <option <?php if ($style_connector->privacy_policy_font == "Ubuntu"): ?>selected="selected"<?php endif ?> value="Ubuntu">Ubuntu</option>
                                            <option <?php if ($style_connector->privacy_policy_font == "Lobster"): ?>selected="selected"<?php endif ?> value="Lobster">Lobster</option>
                                            <option <?php if ($style_connector->privacy_policy_font == "Anton"): ?>selected="selected"<?php endif ?> value="Anton">Anton</option>
                                            <option <?php if ($style_connector->privacy_policy_font == "Holtwood One SC"): ?>selected="selected"<?php endif ?> value="Holtwood One SC">Holtwood One SC</option>
                                            <option <?php if ($style_connector->privacy_policy_font == "Russo One"): ?>selected="selected"<?php endif ?> value="Russo One">Russo One</option>
                                            <option <?php if ($style_connector->privacy_policy_font == "Great Vibes"): ?>selected="selected"<?php endif ?> value="Great Vibes">Great Vibes</option>
                                            <option <?php if ($style_connector->privacy_policy_font == "Droid Serif"): ?>selected="selected"<?php endif ?> value="Droid Serif">Droid Serif</option>
                                            <option <?php if ($style_connector->privacy_policy_font == "Open Sans"): ?>selected="selected"<?php endif ?> value="Open Sans">Open Sans</option>
                                            <option <?php if ($style_connector->privacy_policy_font == "Oswald"): ?>selected="selected"<?php endif ?> value="Oswald">Oswald</option>
                                            <option <?php if ($style_connector->privacy_policy_font == "Yanone Kaffeesatz"): ?>selected="selected"<?php endif ?> value="Yanone Kaffeesatz">Yanone Kaffeesatz</option>
                                            <option <?php if ($style_connector->privacy_policy_font == "Homenaje"): ?>selected="selected"<?php endif ?> value="Homenaje">Homenaje</option>
                                            <option <?php if ($style_connector->privacy_policy_font == "Bowlby One SC"): ?>selected="selected"<?php endif ?> value="Bowlby One SC">Bowlby One SC</option>
                                            <option <?php if ($style_connector->privacy_policy_font == "Seaweed Script"): ?>selected="selected"<?php endif ?> value="Seaweed Script">Seaweed Script</option>
                                            <option <?php if ($style_connector->privacy_policy_font == "News Cycle"): ?>selected="selected"<?php endif ?> value="News Cycle">News Cycle</option>
                                            <option <?php if ($style_connector->privacy_policy_font == "Oxygen"): ?>selected="selected"<?php endif ?> value="Oxygen">Oxygen</option>
                                            <option <?php if ($style_connector->privacy_policy_font == "Open Sans"): ?>selected="selected"<?php endif ?> value="Open Sans">Open Sans</option>
                                        </select>
                                    </td>
                               </tr>
                               
                                <tr class="privacyPolicySettingsContent expandableSettings">
                                
                                <td>
                                        Font Colour
                                </td>
                                    <td>
                                        <input autocomplete="off" maxlength="7" id="privacyPolicyColor" name="privacyPolicyColor" value="<?php echo $style_connector->privacy_policy_color ?>" class="color-picker miniColors" type="text">
                                    </td>
                                 <td>
                                        Font Size
                                    </td>
                                    <td>
                                        <div class="demo">
                                            <input value="<?php echo $style_connector->privacy_policy_size ?>" id="privacyPolicySize" name="privacyPolicySize" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="privacyPolicySizeSlider"><a style="left: 52.9412%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div><!-- End demo -->
                                    </td>


                               </tr>
                               
                               

                                <tr class="privacyPolicySettingsContent expandableSettings">

                                <td>
                                        Email Top Margin
                                    </td>
                                    <td>
                                        <div class="demo">
                                            <input value="<?php echo $style_connector->email_privacy_top_margin ?>" id="emailPrivacyPolicyMargin" name="emailPrivacyPolicyMargin" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="emailPrivacyPolicyMarginSlider"><a style="left: 52.9412%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div><!-- End demo -->
                                    </td>
                                    
                                    <td>
                                        Facebook Top Margin
                                    </td>
                                    <td>
                                        <div class="demo">
                                            <input value="<?php echo $style_connector->facebook_privacy_top_margin ?>" id="facebookPrivacyPolicyMargin" name="facebookPrivacyPolicyMargin" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="facebookPrivacyPolicyMarginSlider"><a style="left: 52.9412%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div><!-- End demo -->
                                    </td>


                               </tr>
                               
                               <tr class="privacyPolicySettingsContent expandableSettings">

                                <td>
                                        One Click Top Margin
                                    </td>
                                    <td>
                                        <div class="demo">
                                            <input value="<?php echo $style_connector->oneclick_privacy_top_margin ?>" id="oneClickPrivacyPolicyMargin" name="oneClickPrivacyPolicyMargin" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="oneClickPrivacyPolicyMarginSlider"><a style="left: 52.9412%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div><!-- End demo -->
                                    </td>

                               </tr>
                               
                                <tr>
                                  <th colspan="4" class="externalMarginSettings expandable">
                                   <a href="http://fast.wistia.com/embed/iframe/c7beg9bluc?playerColor=26cc2c&version=v1&videoHeight=450&videoWidth=800&volumeControl=true" class="wistia-popover[height=450,playerColor=050505,width=800]" style="float:left;"><li class="ui-state-default ui-corner-all ui-state-hover helpvideos" id="ldl5p55sf0" title="Templates in 60 seconds or less"><span class="ui-icon ui-icon-help"></span></li></a>      External Margin Settings
                                    </th>
                                </tr>
                                

                               <tr class="externalMarginSettingsContent expandableSettings">
                               <td colspan="4" id="showMarginPreview">
                                 <input type="checkbox" name="showExternalMarginPreview" id="showExternalMarginPreview" /> Modify External Margins and Show Preview
                               </td>
                               </tr>
                               <tr class="externalMarginSettingsContent expandableSettings">
                                <td>
                                        Top Margin
                                    </td>
                                    <td>
                                        <div class="demo">
                                            <input value="<?php echo $style_connector->external_top_margin ?>" id="externalTopMargin" name="externalTopMargin" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="externalTopMarginSlider"><a style="left: 52.9412%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div><!-- End demo -->
                                    </td>

                                    <td>
                                       Bottom Margin
                                    </td>
                                     <td>
                                        <div class="demo">
                                            <input value="<?php echo $style_connector->external_bottom_margin ?>" id="externalBottomMargin" name="externalBottomMargin" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                                            <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="externalBottomMarginSlider"><a style="left: 52.9412%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                                        </div><!-- End demo -->
                                    </td>
                               </tr>
                               
                               



                            </tbody></table>
                    </div>
<div id="getTemplateName" title="Template Name" style="display:none;">
<center>
<table>
<tr>
<td valign="middle">
<input type="text" id="newTemplateName" />
</td>
<td valign="middle">
<button id="hc_save_template" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false" style="float: right; background-color: rgb(255, 179, 15); border-color: rgb(204, 102, 0); opacity: 0.8; background-position: initial initial; background-repeat: initial initial; "><span class="ui-button-text">Save</span></button>
</td>
</tr>
</table>
</center>
</div>
<div id="templateSaveConfirmation" style="display:none;">Your template has been successfully saved!</div>
