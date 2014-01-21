 <td style="width: 750px;" valign="top">
 <table><tr><td>
 <a href="http://fast.wistia.com/embed/iframe/lumf6hz9if?playerColor=26cc2c&version=v1&videoHeight=450&videoWidth=800&volumeControl=true" class="wistia-popover[height=450,playerColor=050505,width=800]" style="float:left;"><li class="ui-state-default ui-corner-all helpvideos ui-state-hover" id="ldl5p55sf0" title="Templates in 60 seconds or less"><span class="ui-icon ui-icon-help"></span></li></a>
 </td><td><a class="wistia-popover[height=450,playerColor=050505,width=800]" href="http://fast.wistia.com/embed/iframe/lumf6hz9if?playerColor=26cc2c&version=v1&videoHeight=450&videoWidth=800&volumeControl=true">Why are there 3 forms?</a></td>
 </tr>
 </table>
<div id="responsiveWrapperDiv" style="padding-left:30px; padding-right:40px; width:450px;">
                        <?php
                        $box_height = ($style_connector->set_heights == 1) ? $style_connector->eoh : $style_connector->opt_in_box_height;
                        $action_height = ($style_connector->set_heights == 1) ? $style_connector->ech : $style_connector->call_action_height;
                        $facebookButtonSize = $style_button->fb_button_size;
                        ?>

                        <div id="lightboxChild">
                        <div style="width:<?php echo $style_connector->opt_in_box_width ?>; margin-top:50px; height:<?php echo $box_height ?>; position:relative; border-width:<?php echo $style_connector->border_width ?>;" class="connectorWrapper emailConnectorWrapper connectorWrapperSVG1">
                            <?php if($style_connector->type=="2") { ?> <a class="lightbox-close" id="hc_lightbox_close" href="#"></a> <?php } ?>
                            <div class="graphicWrapper" style="float:right; position:relative; <?php if ($style_image->show_side_image != 1): ?>display:none;<?php endif ?>">
                                <img src="<?php echo $sideImageURL; ?>" style="float: right; z-index: 100; position: relative;  display: block;" class="optinGraphic">
                                <div id="sideOptinPosition"> </div>
                            </div>
                            <p class="connectorHeadline" style="font-family:<?php echo $style_text->headline_font_family ?>; color:<?php echo $style_text->headline_font_color ?>; font-size:<?php echo $style_text->headline_font_size ?>;">
                                <?php echo $connector_txt->optin_headline ?>
                            </p>
                            <div class="connectorDescriptionText" style="color:<?php echo $style_text->border_font_color ?>; font-family:<?php echo $style_text->border_font_family ?>; font-size:<?php echo $style_text->border_font_size ?>; font-weight:normal; height:150px; ">
                                <?php echo $connector_txt->optin_description ?>
                            </div>
                            <br>
                            <div style="position:absolute; bottom: 0; height:<?php echo $action_height ?>; width:100%; z-index: 3; text-align:<?php if ($style_optin->email_centered == 1): ?>center<?php else: ?>left<?php endif ?>;" class="optinWrapper emailOptinWrapper">
                                <p class="connectorCallToAction emailCallToAction" style="font-size:<?php echo $style_text->call_action_font_size ?>; margin-bottom:5px; line-height:140%; margin-left:10px; margin-top:15px; margin-right:10px; font-family:<?php echo $style_text->call_action_font_family ?>; color:<?php echo $style_text->call_action_font_color ?>;"><?php echo $connector_txt->email_call ?></p>
                                <div class="optinPosition" style="display:table; overflow:hidden; padding:0px;">
                                <div class="optinPositionRow" style="display:table-row;">
                                <div class="optinPositionLeftImage" style="display:table-cell;">
                                    <img src="<?php echo $arrowImageURL ?>l.png" style="float: left; <?php if ($style_image->show_arrow_graphics == 0): ?>display:none;<?php endif ?> margin-right:10px;" class="leftArrow leftArrowEmail">
                                </div>
                                <div class="optinPositionInput" style="display:table-cell; vertical-align:top;">
                                <div style="display:inline;"><input value="<?php echo $style_email->name_label_field; ?>" id="stylized" class="nameConnectorInputField connectorInputFields" name="nameField" style="width: <?php echo $style_optin->name_length ?>; clear: both; border-color: <?php echo $style_email->input_border_color ?>; background: none repeat scroll 0 0 <?php echo $style_email->input_bg_color ?>; font-family: <?php echo $style_email->input_font_family ?>; color: <?php echo $style_email->input_font_color ?>; line-height:18px;" onfocus="if (this.value == '<?php echo $style_email->name_label_field; ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $style_email->name_label_field; ?>';}" type="text"></div>
                                 <div class="emailInputField"><input value="<?php echo $style_email->email_label_field; ?>" id="stylized" class="emailConnectorInputField connectorInputFields" name="emailField" style="width: <?php echo $style_optin->email_length ?>; clear: both; border-color: <?php echo $style_email->input_border_color ?>; background: none repeat scroll 0 0 <?php echo $style_email->input_bg_color ?>; font-family: <?php echo $style_email->input_font_family ?>; color: <?php echo $style_email->input_font_color ?>; line-height:18px;" onfocus="if (this.value == '<?php echo $style_email->email_label_field; ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $style_email->email_label_field; ?>';}" type="text"></div>
                                <div class="emailButtonContainer" ><a href="/" class="navButton" id="emailSignUpButton" style="margin-top: 4px; text-align: center; clear: both;"><?php echo $connector_txt->email_btn ?></a></div>
                                </div>
                                <div class="optinPositionRightImage" style="display:table-cell;">
                                    <img src="<?php echo $arrowImageURL ?>r.png" style="float: right; margin-left: 10px; <?php if ($style_image->show_arrow_graphics == 0): ?>display:none;<?php endif ?>" class="rightArrow rightEmailArrow">
                                </div>
                                    </div>
                                </div>
                                <div class="ppWrapper"><div class="privacyPolicy privacyPolicyEmail" style="vertical-align:middle; display:table"><div style="display:table-row;" class="ppRow"><div style="display:table-cell; vertical-align:middle"><img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/lock-icon.png" align="<?php if ($style_connector->center_privacy_policy ==1):?>center<?php else: ?>left<?php endif?>" style="vertical-align:middle; display:inline; width:25px; height:25px;"/></div><div style="display:table-cell;"><span style="vertical-align:middle; display:inline;"><?php echo $connector_txt->privacy_policy_text; ?></span></div></div></div></div>
                            </div>
                        </div>
                        </div>
                        <?php
                        $box_height = ($style_connector->set_heights == 1) ? $style_connector->foh : $style_connector->opt_in_box_height;
                        $action_height = ($style_connector->set_heights == 1) ? $style_connector->fch : $style_connector->call_action_height;
                        ?>
                        <div style="width:<?php echo $style_connector->opt_in_box_width ?>; margin-top:50px; height:<?php echo $box_height ?>;  position:relative; border-width:<?php echo $style_connector->border_width ?>;" class="connectorWrapper facebookConnectorWrapper connectorWrapperSVG2">
                            <?php if($style_connector->type=="2") { ?> <a class="lightbox-close" id="hc_lightbox_close" href="#"></a> <?php } ?>
                            <div class="graphicWrapper" style="float:right; position:relative; <?php if ($style_image->show_side_image != 1): ?>display:none;<?php endif ?>">
                                <img src="<?php echo $sideImageURL; ?>" style="float: right; z-index: 100; position: relative; display: block;" class="optinGraphic">
                                <div id="sideFacebookPosition"> </div>
                            </div>
                            <p class="connectorHeadline" style="font-family:<?php echo $style_text->headline_font_family ?>; color:<?php echo $style_text->headline_font_color ?>; font-size:<?php echo $style_text->headline_font_size ?>;">
                                <?php echo $connector_txt->optin_headline ?>
                            </p>
                            <div class="connectorDescriptionText" style="color:<?php echo $style_text->border_font_color ?>; font-family:<?php echo $style_text->border_font_family ?>; font-size:<?php echo $style_text->border_font_size ?>; font-weight:normal; height:150px; ">
                                <?php echo $connector_txt->optin_description ?>
                            </div>
                            <br/>
                            <div style="position:absolute; bottom: 0; height:<?php echo $action_height ?>; width:100%; z-index: 3; text-align:<?php if ($style_optin->fb_centered == 1): ?>center<?php else: ?>left<?php endif ?>;" class="optinWrapper facebookOptinWrapper">
                                <p class="connectorCallToAction facebookCallToAction" style="font-size:<?php echo $style_text->call_action_font_size ?>; line-height:140%; margin-bottom:5px; margin-left:10px; margin-top:15px; margin-right:10px; font-family:<?php echo $style_text->call_action_font_family ?>; color:<?php echo $style_text->call_action_font_color ?>;"><?php echo $connector_txt->fb_call ?></p>
                                <div class="facebookPosition" style="display:table;">
                                <div class="facebookPositionRow" style="display:table-row;">
                                <div class="facebookPositionLeftArrow" style="display:table-cell;">
                                        <img src="<?php echo $arrowImageURL ?>l.png" style="float: left; margin-right: 5px; <?php if ($style_image->show_arrow_graphics == 0): ?>display:none;<?php endif ?>" class="leftArrow leftArrowFacebook">
                                </div>
                               <div class="facebookPositionInput" style="display:table-cell; vertical-align:middle;">
                                            <div class="fb-login-button" size="<?php echo $facebookButtonSize ?>"><a class="fb_button fb_button_<?php echo $facebookButtonSize; ?>"><span class="fb_button_text"><?php echo $connector_txt->fb_btn ?></span></a></div>
                               </div>
                               <div class="facebookPositionRightArrow" style="display:table-cell;">
                                        <img src="<?php echo $arrowImageURL ?>r.png" style="float: left; margin-left: 5px; <?php if ($style_image->show_arrow_graphics == 0): ?>display:none;<?php endif ?>" class="rightArrow rightArrowFacebook">
                                   </div>
                                    </div>
                                </div>
                                <div class="ppWrapper"><div class="privacyPolicy privacyPolicyFacebook" style="vertical-align:middle; display:table"><div style="display:table-row;" class="ppRow"><div style="display:table-cell; vertical-align:middle"><img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/lock-icon.png" align="<?php if ($style_connector->center_privacy_policy ==1):?>center<?php else: ?>left<?php endif?>" style="vertical-align:middle; display:inline; width:25px; height:25px;"/></div><div style="display:table-cell;"><span style="vertical-align:middle; display:inline;"><?php echo $connector_txt->privacy_policy_text; ?></span></div></div></div></div>
                            </div>
                        </div>
                        <?php
                        $box_height = ($style_connector->set_heights == 1) ? $style_connector->ooh : $style_connector->opt_in_box_height;
                        $action_height = ($style_connector->set_heights == 1) ? $style_connector->och : $style_connector->call_action_height;
                        ?>
                        <div style="width:<?php echo $style_connector->opt_in_box_width ?>; margin-top:50px; height:<?php echo $box_height ?>; position:relative; border-width:<?php echo $style_connector->border_width ?>;"  class="connectorWrapper oneClickConnectorWrapper connectorWrapperSVG3">
                           <?php if($style_connector->type=="2") { ?> <a class="lightbox-close" id="hc_lightbox_close" href="#"></a> <?php } ?>
                            <div class="graphicWrapper" style="float:right; position:relative; <?php if ($style_image->show_side_image != 1): ?>display:none;<?php endif ?>">
                                <img src="<?php echo $sideImageURL ?>" style="float: right; z-index: 100; position: relative;  display: block;" class="optinGraphic">
                                <div id="sideOneClickPosition"> </div>
                            </div>
                            <p class="connectorHeadline" style="font-family:<?php echo $style_text->headline_font_family ?>; color:<?php echo $style_text->headline_font_color ?>; font-size:<?php echo $style_text->headline_font_size ?>;">
                                <?php echo $connector_txt->optin_headline ?>
                            </p>
                            <div class="connectorDescriptionText" style="color:<?php echo $style_text->border_font_color ?>; font-family:<?php echo $style_text->border_font_family ?>; font-size:<?php echo $style_text->border_font_size ?>; font-weight:normal; height:150px; ">
                                <?php echo $connector_txt->optin_description ?>
                            </div>
                            <br>
                            <div style="position:absolute; bottom: 0; height:<?php echo $action_height ?>; width:100%; z-index: 3; text-align:<?php if ($style_optin->oneclick_centered == 1): ?>center<?php else: ?>left<?php endif ?>;" class="optinWrapper oneClickOptinWrapper">
                                <p class="connectorCallToAction oneClickCallToAction" style="font-size:<?php echo $style_text->call_action_font_size ?>; line-height:140%; margin-bottom:5px; margin-left:10px; margin-top:15px; margin-right:10px; font-family:<?php echo $style_text->call_action_font_family ?>; color:<?php echo $style_text->call_action_font_color ?>;"><?php echo $connector_txt->oneclick_call ?></p>
                                <div class="oneClickPosition" style="display:table;">
                                <div class="oneClickRow" style="display:table-row;">
                                <div class="oneClickLeftArrow" style="display:table-cell;">
                                    <img src="<?php echo $arrowImageURL ?>l.png" style="float: left; margin-right: 10px; <?php if ($style_image->show_arrow_graphics == 0): ?>display:none;<?php endif ?>" class="leftArrow leftArrowOneClick">
                                </div>
                                <div class="oneClickInput" style="display:table-cell; vertical-align:middle;">
                                        <a href="/" class="oneClickSignupButton navButton" id="oneClickSignupButton"><?php echo $connector_txt->oneclick_btn ?></a>
                                </div>
                                <div class="oneClickRightArrow" style="display:table-cell;">
                                    <img src="<?php echo $arrowImageURL ?>r.png" style="float: left; margin-left: 10px; <?php if ($style_image->show_arrow_graphics == 0): ?>display:none;<?php endif ?>" class="rightArrow rightArrowOneClick">
                                </div>
                                </div>
                                </div>
                                <div class="ppWrapper"><div class="privacyPolicy privacyPolicyOneClick" style="vertical-align:middle; display:table"><div style="display:table-row;" class="ppRow"><div style="display:table-cell; vertical-align:middle"><img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/lock-icon.png" align="<?php if ($style_connector->center_privacy_policy ==1):?>center<?php else: ?>left<?php endif?>" style="vertical-align:middle; display:inline; width:25px; height:25px;"/></div><div style="display:table-cell;"><span style="vertical-align:middle; display:inline;"><?php echo $connector_txt->privacy_policy_text; ?></span></div></div></div></div>
                            </div>
                        </div>

                    </div>
                    
                    <div id="squeezePageDisplay" style="display:none; background:url('<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/monitor.png'); width:587px; height:483px; margin:0px auto; margin-top:20px; position:relative;">
                    <div style="position:absolute; top: 20px; left:20px; width:545px; height:345px;" id="monitorScreen" >
                    <div id="marginDisplay" style="position:absolute; top: 30px; left:185px; width:160px; border:1px solid #000000; background:#ffffff; vertical-align:middle; text-align:center; padding:10px; font-size:16px; background-color:#ffffcc;"><b>20px</b> margin from top</div>
                    <div class="centralLocation" id="squeezeOptinDisplay" style="background-image:url('<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/centralBackground.png'); width:545px; height:345px; background-repeat:no-repeat;">
                    <div class="centralLocation"><img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/optinGraphic.png" style="position:absolute; top:82px; left:125px;"></div>
                    </div>
                    </div>

                    </div>

                </td>