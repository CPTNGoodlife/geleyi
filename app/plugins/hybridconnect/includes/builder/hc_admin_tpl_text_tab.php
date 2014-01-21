<div id="tabs-3" class="tabOptions ui-tabs-panel ui-widget-content ui-corner-bottom">
    <h2>Enter Your Text:</h2>
    <table style="background: none repeat scroll 0% 0% rgb(255, 255, 204); padding: 20px; width: 500px;">
        <tbody><tr>
                <th colspan="4">
                    Headline Text
                </th>
            </tr>
            <tr><td colspan="2">
                    Opt In Headline
                </td>
                <td colspan="2">
                    <input id="optinBoxHeadline" name="optinBoxHeadline" size="50" value="<?php echo str_replace('"','&quot;',$connector_txt->optin_headline); ?>" type="text" />
                </td>
            </tr>
            <tr>
                <th colspan="4">
                    Description Text
                </th>
            </tr>
            <tr><td colspan="4">
            <center>
                     <textarea rows="25" cols="75" id="optinBoxDescription" name="optinBoxDescription"><?php echo $connector_txt->optin_description; ?>
                    </textarea>
                    </center>
                </td>
                </tr>
                <tr>
                <td colspan="4">
                 <p><b>Helpful hint:</b> You can add line breaks by pressing SHIFT + ENTER and you can add paragraph breaks by simply pressing ENTER</p>
                 <p><b>Helpful hint 2:</b> You can add bullet points using the textarea above and then use the "Bullet Style" icon set below to choose a graphic to display for your bullet points</p>
                </td>
                </tr>
            <tr>
                <th colspan="4" class="bulletSettings expandable">
                 <a href="http://fast.wistia.com/embed/iframe/8ct6u3bm87?autoPlay=true&fullscreenButton=false&playerColor=050505&popover=true&version=v1&videoHeight=450&videoWidth=800&volumeControl=true" class="wistia-popover[height=450,playerColor=050505,width=800]" style="float:left;"><li class="ui-state-default ui-corner-all ui-state-hover helpvideos" id="ldl5p55sf0" title="Templates in 60 seconds or less"><span class="ui-icon ui-icon-help"></span></li></a>Bullet style
                </th>
            </tr>
            <tr class="bulletSettingsContent expandableSettings">
                <td colspan="4">
                   <center>
                   
                   <table>
                        <tr>
                            <td style="text-align: center;">
                                <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/ticks/1.png" /> <br/>
                                <input name="ticktype" type="radio" group="ticktype" class="radioSelTickType" value="1" <?php if ($style_text->tick_style == 1):?>checked<?php endif?> />
                            </td>
                            <td style="text-align: center;">
                                <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/ticks/2.png" /><br/>
                                <input name="ticktype" type="radio" group="ticktype" class="radioSelTickType" value="2" <?php if ($style_text->tick_style == 2):?>checked<?php endif?> />
                            </td>
                            <td style="text-align: center;">
                                <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/ticks/3.png" /> <br/>
                                <input name="ticktype" type="radio" group="ticktype" class="radioSelTickType" value="3" <?php if ($style_text->tick_style == 3):?>checked<?php endif?>  />
                            </td>
                            <td style="text-align: center;">
                                <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/ticks/4.png" /> <br/>
                                <input name="ticktype" type="radio" group="ticktype" class="radioSelTickType" value="4" <?php if ($style_text->tick_style == 4):?>checked<?php endif?>  />
                            </td>
                            <td style="text-align: center;">
                                <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/ticks/5.png" /> <br/>
                                <input name="ticktype" type="radio" group="ticktype" class="radioSelTickType" value="5" <?php if ($style_text->tick_style == 5):?>checked<?php endif?>  />
                            </td>
                            <td style="text-align: center;">
                                <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/ticks/6.png" /> <br/>
                                <input name="ticktype" type="radio" group="ticktype" class="radioSelTickType" value="6" <?php if ($style_text->tick_style == 6):?>checked<?php endif?>  />
                            </td>
                            <td style="text-align: center;">
                                <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/ticks/7.png" /> <br/>
                                <input name="ticktype" type="radio" group="ticktype" class="radioSelTickType" value="7" <?php if ($style_text->tick_style == 7):?>checked<?php endif?>  />
                            </td>
                            <td style="text-align: center;">
                                <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/ticks/8.png" /> <br/>
                                <input name="ticktype" type="radio" group="ticktype" class="radioSelTickType" value="8" <?php if ($style_text->tick_style == 8):?>checked<?php endif?>  />
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">
                                <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/ticks/9.png" /> <br/>
                                <input name="ticktype" type="radio" group="ticktype" class="radioSelTickType" value="9" <?php if ($style_text->tick_style == 9):?>checked<?php endif?> />
                            </td>
                            <td style="text-align: center;">
                                <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/ticks/10.png" /><br/>
                                <input name="ticktype" type="radio" group="ticktype" class="radioSelTickType" value="10" <?php if ($style_text->tick_style == 10):?>checked<?php endif?> />
                            </td>
                            <td style="text-align: center;">
                                <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/ticks/11.png" /> <br/>
                                <input name="ticktype" type="radio" group="ticktype" class="radioSelTickType" value="11" <?php if ($style_text->tick_style == 11):?>checked<?php endif?>  />
                            </td>
                            <td style="text-align: center;">
                                <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/ticks/12.png" /> <br/>
                                <input name="ticktype" type="radio" group="ticktype" class="radioSelTickType" value="12" <?php if ($style_text->tick_style == 12):?>checked<?php endif?>  />
                            </td>
                            <td style="text-align: center;">
                                <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/ticks/13.png" /> <br/>
                                <input name="ticktype" type="radio" group="ticktype" class="radioSelTickType" value="13" <?php if ($style_text->tick_style == 13):?>checked<?php endif?>  />
                            </td>
                            <td style="text-align: center;">
                                <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/ticks/14.png" /> <br/>
                                <input name="ticktype" type="radio" group="ticktype" class="radioSelTickType" value="14" <?php if ($style_text->tick_style == 14):?>checked<?php endif?>  />
                            </td>
                            <td style="text-align: center;">
                                <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/ticks/15.png" /> <br/>
                                <input name="ticktype" type="radio" group="ticktype" class="radioSelTickType" value="15" <?php if ($style_text->tick_style == 15):?>checked<?php endif?>  />
                            </td>
                            <td style="text-align: center;">
                                <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/ticks/16.png" /> <br/>
                                <input name="ticktype" type="radio" group="ticktype" class="radioSelTickType" value="16" <?php if ($style_text->tick_style == 16):?>checked<?php endif?>  />
                            </td>
                        </tr>
                    </table>
                       
                       <table style="background: none repeat scroll 0% 0% rgb(255, 255, 204); padding: 20px; width: 500px;">
        <tbody>
            <tr><td colspan="2">
                    Bullet Size
                </td>
                <td colspan="2">
                <input value="30px" id="bulletPointSizeInput" name="bulletPointSizeInput" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% #FFC;" type="text">
                <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="bulletPointSizeSlider"><a style="left: 30.4348%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                </td>
            </tr>
            
             <tr><td colspan="2">
                    Bullet Vertical Offset
                </td>
                <td colspan="2">
                <input value="30px" id="bulletPointVerticalInput" name="bulletPointVerticalInput" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% #FFC;" type="text">
                <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="bulletPointVerticalInputSlider"><a style="left: 30.4348%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                </td>
            </tr>
            
             <tr><td colspan="2">
                    Bullet Horizontal Offset
                </td>
                <td colspan="2">
                <input value="30px" id="bulletPointHorizontalInput" name="bulletPointHorizontalInput" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% #FFC;" type="text">
                <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="bulletPointHorizontalInputSlider"><a style="left: 30.4348%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                </td>
            </tr>
            </table>
            
                 </center>
                    
                   <p><b>Helpful Hint:</b> - You can adjust the margin settings of your bullet points by going to the "Customize" tab then the "Text Positioning" section and then moving the "Bullet Left Margin" slider.</p>


                </td>
            </tr>
            <tr>
                <th colspan="4" class="ctatextSettings expandable">
                    Call to Action Text
                </th>
            </tr>
            <tr class="ctatextSettingsContent expandableSettings">
                <td colspan="2">
                    Email Call to Action:
                </td>
                <td colspan="2">
                    <input id="emailCallToActionText" name="emailCallToActionText" size="50" value="<?php echo str_replace('"','&quot;',$connector_txt->email_call); ?>" type="text">
                </td>
            </tr>
            <tr class="ctatextSettingsContent expandableSettings">
                <td colspan="2">
                    Facebook Call to Action:
                </td>
                <td colspan="2">
                    <input id="facebookCallToActionText" name="facebookCallToActionText" size="50" value="<?php echo str_replace('"','&quot;',$connector_txt->fb_call); ?>" type="text">
                </td>
            </tr>
            <tr class="ctatextSettingsContent expandableSettings">
                <td colspan="2">
                    One Click Call to Action:
                </td>
                <td colspan="2">
                    <input id="oneClickCallToActionText" name="oneClickCallToActionText" size="50" value="<?php echo str_replace('"','&quot;',$connector_txt->oneclick_call); ?>" type="text">
                </td>
            </tr>
            <tr>
                <th colspan="4" class="buttontextSettings expandable">
                    Button Text
                </th>
            </tr>
            <tr class="buttontextSettingsContent expandableSettings">
                <td colspan="2">
                    Email Button Text
                </td>
                <td colspan="2">
                    <input id="emailButtonText" name="emailButtonText" size="50" value="<?php echo str_replace('"','&quot;',$connector_txt->email_btn); ?>" type="text">
                </td>
            </tr>
            <tr class="buttontextSettingsContent expandableSettings">
                <td colspan="2">
                    Facebook Button Text
                </td>
                <td colspan="2">
                    <input id="facebookButtonText" name="facebookButtonText" size="50" value="<?php echo str_replace('"','&quot;',$connector_txt->fb_btn); ?>" type="text">
                </td>
            </tr>
            <tr class="buttontextSettingsContent expandableSettings">
                <td colspan="2">
                    Facebook Button Text
                </td>
                <td colspan="2">
                    <input id="oneClickButtonText" name="oneClickButtonText" size="50" value="<?php echo str_replace('"','&quot;',$connector_txt->oneclick_btn); ?>" type="text">
                </td>
            </tr>
            
             <tr>
                <th colspan="4" class="privacyTextSettings expandable">
                    Privacy Policy Text
                </th>
            </tr>
            
            <tr class="privacyTextSettingsContent expandableSettings">
                <td colspan="2">
                    Privacy Policy Text
                </td>
                <td colspan="2">
                    <input id="privacyPolicyText" name="privacyPolicyText" size="50" value="<?php echo str_replace('"','&quot;',stripslashes($connector_txt->privacy_policy_text)); ?>" type="text">
                </td>
            </tr>
            
            
        </tbody></table>
</div>