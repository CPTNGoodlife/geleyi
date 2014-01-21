<?php
$hc_ajax_nonce = wp_create_nonce("hyconspecialsecurityforajaxstring");
$license = get_option('HYBRID_CONNECT_LICENSE_STATUS');


?>
<input type="hidden" id="hc_hidden_services_ajaxnonce" value="<?php echo $hc_ajax_nonce ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo HYBRIDCONNECT_CSS_PATH_TEMPLATES ?>/south-street/jquery-ui-1.8.20.custom.css" />
<input type="hidden" id="hc_hidden_setup_page_url" value="<?php echo get_admin_url() . "admin.php?page=hybridConnectAdminSetup" ?>" />
<!--Admin section layout -->
<?php if ($ccontact_set): ?>
    <?php if ($ccontact_valid): ?>
        <div class="ui-widget" style="width:800px;">
            <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
                <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                    <strong>Your ConstantContact account has been linked to HybridConnect successfully!</strong></p>
            </div>
        </div>
    <?php else: ?>
        <div class="ui-widget">
            <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
                <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                    <strong>We couldn't connect your ConstantContact account!</strong></p>
            </div>
        </div>
    <?php endif ?>
<?php endif ?>
<div style="width:800px;">
    <p><img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/setup.png" style="margin-left:20px; float:right;">
    <h2>Set Up Your Software</h2>
    <p>Before you can start creating your awesome hybrid optin forms you need to do three things in this order:-
    <ol><li>Validate your License</li>
        <li>Connect to your Facebook Application</li>
        <li>Connect to your Autoresponder</li>
        <li>(Optional) Connect to GoToWebinar</li>
    </ol>
</p>
<p>This will only take a few minutes to set up and once complete, you'll never have to worry about doing it again!</p>
<h3 style="margin-top:30px;">Step 1 - Validate your Licensee </h3><?php if ($license == 'ACTIVE'): ?>
    <div class="ui-widget" style="width:800px;">
        <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
            <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                <strong>Your license is valid and your product is ready to use  </strong></p>
        </div>
    </div>
<?php else: ?>
    <div class="ui-widget">
        <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
            <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                <strong>Your license is not valid. </strong></p>
        </div>
    </div>
<?php endif ?>
<br/>
<table class="hc_table_fb_settings" style="width:800px;">
    <tr>
        <td class="label_column">License Email:</td>
        <td><input type="text" name="hc_license_email" value="<?php echo get_option('hc_license_email') ?>" size="55" id="hc_license_email" /></td>
        <td rowspan="2">
       <!--     <input type="button" name="Submit" id="hc_submit_license_settings" value="Validate License" class="hcAdminButton" />      -->
            <button id="hc_submit_license_settings" class="hc_update_service_settings ui-button ui-widget ui-corner-all ui-button-text-only ui-state-default" role="button" aria-disabled="false"><span class="ui-button-text">Validate License</span></button>
            <input type="hidden" id="hc_hidden_license_ajaxnonce" value="<?php echo $hc_ajax_nonce ?>" />
        </td>
    </tr>
    <tr>
        <td class="label_column">License Key:</td>
        <td><input type="text" name="hc_license_key" value="<?php echo get_option('hc_license_key') ?>" size="55" id="hc_license_key" /></td>
    </tr>
</table>
<br/><br/>
<div id="facebook_settings_container" <?php if ($license != 'ACTIVE'): ?>style="display:none;"<?php endif ?>>
    <h3 id="facebook_header" <?php if ($license != 'ACTIVE'): ?>style="display:none;"<?php endif ?> >Step 2 - Connect to your Facebook Application</h3>
    <input type="hidden" id="hc_hidden_fb_appvalid" value="<?php echo get_option('hc_fb_appvalid') ?>" />
    <div class="ui-widget" style="width:800px;" id="hc_facebook_txt_valid" <?php if (get_option('hc_fb_appvalid') == 1): ?>style="display:block;"<?php else: ?>style="display:none;"<?php endif ?>>
        <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
            <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                <strong>Your facebook settings are valid.</strong></p>
        </div>
    </div>
    <div class="ui-widget" id="hc_facebook_txt_invalid" <?php if (get_option('hc_fb_appvalid') == 0): ?>style="display:block;"<?php else: ?>style="display:none;"<?php endif ?>>
        <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
            <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                <strong> Your facebook application isn't set up correctly.</strong></p>
        </div>
    </div>
    <br/>
    <table class="hc_table_fb_settings" style="width:800px;<?php if ($license != 'ACTIVE'): ?>display:none;<?php endif ?>">
        <tr>
            <td class="label_column">Facebook App ID:</td>
            <td><input type="text" name="hc_fb_appid" value="<?php echo get_option('hc_fb_appid') ?>" size="55" id="hc_txt_fb_appid" /></td>
            <td rowspan="2">
               <!--  <input type="button" name="Submit" id="hc_submit_fb_settings" value="Update Facebook App Settings" class="hcAdminButton" /> -->
                <button id="hc_submit_fb_settings" class="ui-button ui-widget ui-corner-all ui-button-text-only ui-state-default" role="button" aria-disabled="false"><span class="ui-button-text">Verify Facebook App Settings</span></button>
                <br/> <a href="https://developers.facebook.com/apps" target="_blank">https://developers.facebook.com/apps</a>
                <input type="hidden" id="hc_hidden_fb_ajaxnonce" value="<?php echo $hc_ajax_nonce ?>" /> <br/><br/>
                <span id="hc_admin_fb_txt_valid">
                </span>
            </td>
        </tr>
        <tr>
            <td class="label_column">Facebook App Secret:</td>
            <td><input type="text" name="hc_fb_appsecret" value="<?php echo get_option('hc_fb_appsecret') ?>" size="55" id="hc_txt_fb_appsecret" /></td>
        </tr>
    </table>
   <div id="facebookValidSettings" style="width:800px; display: <?php if(get_option('hc_fb_appvalid')=="1"){ echo "block;"; } else { echo "none;"; } ?>;">
   <center>
  <?php if(get_option('hc_fb_appvalid')=="1") { echo '<b><a href="#" class="getFBAppData">Click Here to Display your application data (Needs a few seconds to load)</a></b>'; } ?>
   </center>

   </div>
</div>
</div>
<div class="services_container"  <?php if ($license != 'ACTIVE'): ?>style="display:none;"<?php endif ?>>
    <!--Admin section layout -->
    <br/><br/>
    <h3 id="services_header">Step 3. Connect to your Mailing List</h3>
    
    <p><a href="/" id="apitoggle">Click here to connect through the API (only do this if you know what you're doing)</a></p>
    
    <div id="hiddenServicesTable" style="display:none;">
    
    <p>There are two ways to connect your autoresponder - you can either use what's called an API or you can use custom HTML code.  <a href="http://members.hybrid-connect.com/how-to-connect-to-my-mailing-list/" target="_blank">Click here to decide how best to connect to your autoresponder</a></p>

    <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/aweberLogo.png" id="service-1"  class="serviceOption" />
    <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/icontactLogo.png" id="service-2" class="serviceOption" />
    <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/getresponseLogo.png" id="service-3" class="serviceOption" />
    <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/officeautopilotLogo.png" id="service-4" class="serviceOption" />
    <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/infusionsoftLogo.png" id="service-5" class="serviceOption" />
    <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/mailchimpLogo.png" id="service-6" class="serviceOption" />
    <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/constantcontactLogo.png" id="service-7" class="serviceOption" />
    <!-- <div class="hc_admin_selector_container">
        Select a service to update its options:
        <select id="hc_admin_sel_services">
            <option value="0">- select an option -</option>
            <option value="7">Aweber</option>
            <option value="1">InfusionSoft</option>
            <option value="2">OfficeAutoPilot</option>
            <option value="3">GetResponse</option>
            <option value="4">MailChimp</option>
            <option value="5">IContact</option>
            <option value="6">ConstantContact</option>
        </select>
        Valid services:
    <?php foreach ($my_services as $s): ?>
        <?php if ($s['validated']): ?>
            <?php echo $s['label'] . ' - '; ?>
        <?php endif ?>
    <?php endforeach ?>
    </div><br/> -->
    <div class="serviceProviderTable" id="hc_service_provider_7" style="display:none;">
        <div class="ui-widget" style="display:<?php if ($my_services['aweber']['validated']): ?>block; <?php else: ?>none;<?php endif ?>" id="hc_service_msg_valid_aweber">
            <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
                <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                    <strong>This service is valid with the current settings</strong></p>
            </div>
        </div>
        <div class="ui-widget" id="hc_service_msg_invalid_aweber" <?php if (!$my_services['aweber']['validated']): ?>style="display:block;"<?php else: ?>style="display:none;"<?php endif ?>>
            <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
                <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                    <strong>This service couldn't be validated with the current settings</strong></p>
            </div>
        </div>
        <br/>
        <table class="hc_table_fb_settings">
            <tr>
                <td class="service_label">Aweber Authorization code:</td>
                <td><input type="text" name="hc_aweber_appid" value="<?php echo get_option('hc_aweber_appid') ?>" size="55" id="hc_aweber_appid" /></td>
                <td class="update_column">
                    <input type="hidden" name="hc_service_name" class="hc_service_name" value="aweber" />
                  <!--   <input type="button" name="Submit" class="hc_update_service_settings hcAdminButton" id="hc_submit_aweber_settings" value="Update aweber Settings" />   -->
                    <button id="hc_submit_aweber_settings" class="hc_update_service_settings ui-button ui-widget ui-corner-all ui-button-text-only ui-state-default" role="button" aria-disabled="false"><span class="ui-button-text">Update Aweber Settings</span></button>
                    <br/>
                    <a href="https://auth.aweber.com/1.0/oauth/authorize_app/d9d52735" target="_blank">
                        Get your authorization code here
                    </a><br/>
                </td>
            </tr>
        </table>
    </div>
    <div class="serviceProviderTable" id="hc_service_provider_1" style="display:none;">
        <div class="ui-widget" style="display:<?php if ($my_services['infusionsoft']['validated']): ?>block; <?php else: ?>none;<?php endif ?>" id="hc_service_msg_valid_infusionsoft">
            <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
                <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                    <strong>This service is valid with the current settings</strong></p>
            </div>
        </div>
        <div class="ui-widget" id="hc_service_msg_invalid_infusionsoft" <?php if (!$my_services['infusionsoft']['validated']): ?>style="display:block;"<?php else: ?>style="display:none;"<?php endif ?>>
            <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
                <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                    <strong>This service couldn't be validated with the current settings</strong></p>
            </div>
        </div>
        <br/>
        <table class="hc_table_fb_settings">
            <tr>
                <td class="service_label">InfusionSoft AppKey:</td>
                <td>
                    <input type="text" name="hc_infusionsoft_appkey" value="<?php echo get_option('hc_infusionsoft_appkey') ?>" size="55" id="hc_infusionsoft_appkey" />
                </td>
                <td class="update_column" rowspan="2">
                    <input type="hidden" name="hc_service_name" class="hc_service_name" value="infusionsoft" />
                 <!--   <input type="button" name="Submit" class="hc_update_service_settings hcAdminButton" id="hc_submit_infusionsoft_settings" value="Update InfusionSoft Settings" />   -->
                    <button id="hc_submit_infusionsoft_settings" class="hc_update_service_settings ui-button ui-widget ui-corner-all ui-button-text-only ui-state-default" role="button" aria-disabled="false"><span class="ui-button-text">Update Infusionsoft Settings</span></button>
                    <br/>
                    Get more details here:
                    <a href="http://help.infusionsoft.com/developers" target="_blank">
                        http://help.infusionsoft.com/developers
                    </a><br/>
                </td>
            </tr>
            <tr>
                <td class="service_label">InfusionSoft AppUrl:</td>
                <td><input type="text" name="hc_infusionsoft_appurl" value="<?php echo get_option('hc_infusionsoft_appurl') ?>" size="55" id="hc_infusionsoft_appurl" /></td>
            </tr>
        </table>
    </div>
    <div class="serviceProviderTable" id="hc_service_provider_2" style="display:none;">
        <div class="ui-widget" style="display:<?php if ($my_services['officeautopilot']['validated']): ?>block; <?php else: ?>none;<?php endif ?>" id="hc_service_msg_valid_officeautopilot">
            <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
                <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                    <strong>This service is valid with the current settings</strong></p>
            </div>
        </div>
        <div class="ui-widget" id="hc_service_msg_invalid_officeautopilot" <?php if (!$my_services['officeautopilot']['validated']): ?>style="display:block;"<?php else: ?>style="display:none;"<?php endif ?>>
            <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
                <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                    <strong>This service couldn't be validated with the current settings</strong></p>
            </div>
        </div>
        <br/>
        <table class="hc_table_fb_settings serviceProviderTable">
            <tr>
                <td class="service_label">OfficeAutoPilot AppId:</td>
                <td><input type="text" name="hc_officeautopilot_appid" value="<?php echo get_option('hc_officeautopilot_appid') ?>" size="55" id="hc_officeautopilot_appid" /></td>
                <td class="update_column" rowspan="2">
                    <input type="hidden" name="hc_service_name" class="hc_service_name" value="officeautopilot" />
                    <!-- <input type="button" name="Submit" class="hc_update_service_settings hcAdminButton" id="hc_submit_officeautopilot_settings" value="Update OfficeAutoPilot Settings" />-->
                    <button id="hc_submit_officeautopilot_settings" class="hc_update_service_settings ui-button ui-widget ui-corner-all ui-button-text-only ui-state-default" role="button" aria-disabled="false"><span class="ui-button-text">Update OfficeAutoPilot Settings</span></button>
                    <br/>
                    Get more details here:
                    <a href="http://officeautopilot.com/developers/" target="_blank">
                        http://officeautopilot.com/developers/
                    </a><br/>
                </td>
            </tr>
            <tr>
                <td class="service_label">OfficeAutoPilot AppKey:</td>
                <td><input type="text" name="hc_officeautopilot_appkey" value="<?php echo get_option('hc_officeautopilot_appkey') ?>" size="55" id="hc_officeautopilot_appkey" /></td>
            </tr>
        </table>
    </div>
    <div class="serviceProviderTable"  id="hc_service_provider_3" style="display:none;">
        <div class="ui-widget" style="display:<?php if ($my_services['getresponse']['validated']): ?>block; <?php else: ?>none;<?php endif ?>" id="hc_service_msg_valid_getresponse">
            <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
                <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                    <strong>This service is valid with the current settings</strong></p>
            </div>
        </div>
        <div class="ui-widget" id="hc_service_msg_invalid_getresponse" <?php if (!$my_services['getresponse']['validated']): ?>style="display:block;"<?php else: ?>style="display:none;"<?php endif ?>>
            <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
                <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                    <strong>This service couldn't be validated with the current settings</strong></p>
            </div>
        </div>
        <br/>
        <table class="hc_table_fb_settings serviceProviderTable">
            <tr>
                <td class="service_label">GetResponse AppKey:</td>
                <td><input type="text" name="hc_getresponse_appkey" value="<?php echo get_option('hc_getresponse_appkey') ?>" size="55" id="hc_getresponse_appkey" /></td>
                <td class="update_column">
                    <input type="hidden" name="hc_service_name" class="hc_service_name" value="getresponse" />
                  <!--   <input type="button" name="Submit" class="hc_update_service_settings hcAdminButton" id="hc_submit_getresponse_settings" value="Update GetResponse Settings" /> -->
                    <button id="hc_submit_getresponse_settings" class="hc_update_service_settings ui-button ui-widget ui-corner-all ui-button-text-only ui-state-default" role="button" aria-disabled="false"><span class="ui-button-text">Update GetResponse Settings</span></button>
                    <br/>
                    Get more details here:
                    <a href="http://dev.getresponse.com/" target="_blank">
                        http://dev.getresponse.com/
                    </a><br/>
                </td>
            </tr>
        </table>
    </div>
    <div class="serviceProviderTable"  id="hc_service_provider_4" style="display:none;">
        <div class="ui-widget" style="display:<?php if ($my_services['mailchimp']['validated']): ?>block; <?php else: ?>none;<?php endif ?>" id="hc_service_msg_valid_mailchimp">
            <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
                <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                    <strong>This service is valid with the current settings</strong></p>
            </div>
        </div>
        <div class="ui-widget" id="hc_service_msg_invalid_mailchimp" <?php if (!$my_services['mailchimp']['validated']): ?>style="display:block;"<?php else: ?>style="display:none;"<?php endif ?>>
            <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
                <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                    <strong>This service couldn't be validated with the current settings</strong></p>
            </div>
        </div>
        <br/>
        <table class="hc_table_fb_settings serviceProviderTable">
            <tr>
                <td class="service_label">MailChimp AppKey:</td>
                <td><input type="text" name="hc_mailchimp_appkey" value="<?php echo get_option('hc_mailchimp_appkey') ?>" size="55" id="hc_mailchimp_appkey" /></td>
                <td class="update_column">
                    <input type="hidden" name="hc_service_name" class="hc_service_name" value="mailchimp" />
                 <!--    <input type="button" name="Submit" class="hc_update_service_settings hcAdminButton" id="hc_submit_mailchimp_settings" value="Update MailChimp Settings" />  -->
                    <button id="hc_submit_mailchimp_settings" class="hc_update_service_settings ui-button ui-widget ui-corner-all ui-button-text-only ui-state-default" role="button" aria-disabled="false"><span class="ui-button-text">Update MailChimp Settings</span></button>
                    <br/>
                    Get more details here:
                    <a href="http://apidocs.mailchimp.com/" target="_blank">
                        http://apidocs.mailchimp.com/
                    </a><br/>
                </td>
            </tr>
        </table>
    </div>
    <div class="serviceProviderTable"  id="hc_service_provider_5" style="display:none;">
        <div class="ui-widget" style="display:<?php if ($my_services['icontact']['validated']): ?>block; <?php else: ?>none;<?php endif ?>" id="hc_service_msg_valid_icontact">
            <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
                <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                    <strong>This service is valid with the current settings</strong></p>
            </div>
        </div>
        <div class="ui-widget" id="hc_service_msg_invalid_icontact" <?php if (!$my_services['icontact']['validated']): ?>style="display:block;"<?php else: ?>style="display:none;"<?php endif ?>>
            <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
                <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                    <strong>This service couldn't be validated with the current settings</strong></p>
            </div>
        </div>
        <br/>
        <table class="hc_table_fb_settings serviceProviderTable">
            <tr>
                <td class="service_label">IContact AppId:</td>
                <td><input type="text" name="hc_icontact_appid" value="<?php echo get_option('hc_icontact_appid') ?>" size="55" id="hc_icontact_appid" /></td>
                <td class="update_column" rowspan="3">
                    <input type="hidden" name="hc_service_name" class="hc_service_name" value="icontact" />
                   <!-- <input type="button" name="Submit" class="hc_update_service_settings hcAdminButton" id="hc_submit_icontact_settings" value="Update IContact Settings" /> -->
                    <button id="hc_submit_icontact_settings" class="hc_update_service_settings ui-button ui-widget ui-corner-all ui-button-text-only ui-state-default" role="button" aria-disabled="false"><span class="ui-button-text">Update IContact Settings</span></button>
                    <br/>
                    Get more details here:
                    <a href="http://developer.icontact.com/" target="_blank">
                        http://developer.icontact.com/
                    </a><br/>
                </td>
            </tr>
            <tr>
                <td class="service_label">IContact AppUser:</td>
                <td><input type="text" name="hc_icontact_appkey" value="<?php echo get_option('hc_icontact_appkey') ?>" size="55" id="hc_icontact_appkey" /></td>
            </tr>
            <tr>
                <td class="service_label">IContact AppPass:</td>
                <td><input type="text" name="hc_icontact_appurl" value="<?php echo get_option('hc_icontact_appurl') ?>" size="55" id="hc_icontact_appurl" /></td>
            </tr>
        </table>
    </div>
    <div class="serviceProviderTable"  id="hc_service_provider_6" style="display:none;">
        <div class="ui-widget" style="display:<?php if ($my_services['constantcontact']['validated']): ?>block; <?php else: ?>none;<?php endif ?>" id="hc_service_msg_valid_constantcontact">
            <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
                <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                    <strong>This service is valid with the current settings</strong></p>
            </div>
        </div>
        <div class="ui-widget" id="hc_service_msg_invalid_constantcontact" <?php if (!$my_services['constantcontact']['validated']): ?>style="display:block;"<?php else: ?>style="display:none;"<?php endif ?>>
            <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
                <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                    <strong>This service couldn't be validated with the current settings</strong></p>
            </div>
        </div>
        <br/>
        <table class="hc_table_fb_settings serviceProviderTable">
            <tr>
                <td class="service_label">ConstantContact AppKey:</td>
                <td><input type="text" name="hc_constantcontact_appkey" value="<?php echo get_option('hc_constantcontact_appkey') ?>" size="55" id="hc_constantcontact_appkey" /></td>
                <td class="update_column" rowspan="3">
                    <input type="hidden" name="hc_service_name" class="hc_service_name" value="constantcontact" />
                <!--     <input type="button" name="Submit" class="hc_update_service_settings hcAdminButton" id="hc_submit_constantcontact_settings" value="Update ConstantContact Settings" />   -->
                    <button id="hc_submit_constantcontact_settings" class="ui-button ui-widget ui-corner-all ui-button-text-only ui-state-default" role="button" aria-disabled="false"><span class="ui-button-text">Update ConstantContact Settings</span></button>
                    <input id="hc_cc_verification_url" type="hidden" value="<?php echo admin_url() . "admin.php?page=hybridConnectAdminSetup"; ?>" />
                    <br/>
                    Get more details here:
                    <a href="http://developer.constantcontact.com/" target="_blank">
                        http://developer.constantcontact.com/
                    </a><br/>
                </td>
            </tr>
            <tr>
                <td class="service_label">ConstantContact Consumer secret:</td>
                <td>
                    <input type="text" name="hc_constantcontact_appid" value="<?php echo get_option('hc_constantcontact_appid') ?>" size="55" id="hc_constantcontact_appid" />
                </td>
            </tr>
            <tr>
                <td class="service_label">ConstantContact Verification URL:</td>
                <td>
                    <input type="text" readonly="readonly" name="hc_constantcontact_vurl" value="<?php echo admin_url() . "admin.php?page=hybridConnectAdminSetup"; ?>" size="55" id="hc_constantcontact_vurl" />
                </td>
            </tr>
        </table>
    </div>
    </div>
    <h3 style="margin-top:40px;">Step 4. GoToWebinar (OPTIONAL) - You Only Need to do this if you are going to sign people up to GoToWebinar Events</h3>
    <p>If you would like to register people up to GoTowebinar, then you'll need to connect through their API.  <a href="http://members.hybrid-connect.com/gotowebinar-integration/" target="_blank">Follow these instructions to connect to GoToWebinar</a></p>
    
    <div class="ui-widget" style="display:<?php if(get_option("hc_g2w_valid")=="true"): ?>block; <?php else: ?>none;<?php endif ?> width:800px;" id="hc_service_msg_valid_g2w">
            <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
                <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                    <strong>This service is valid with the current settings</strong></p>
            </div>
        </div>
        <div class="ui-widget" id="hc_service_msg_invalid_g2w" <?php if(get_option("hc_g2w_valid")=="false"): ?>style="display:block; width:800px;"<?php else: ?>style="display:none; width:800px;"<?php endif ?>>
            <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
                <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                    <strong>This service couldn't be validated with the current settings</strong></p>
            </div>
        </div>
    <br/>
    <table class="hc_table_fb_settings" style="width:800px;">
    <tbody>
        <tr>
            <td class="label_column">API Key*:</td>
            <td>
            <input type="text" name="g2wAPIKey" id="g2wAPIKey" value="<?php echo get_option('hc_g2w_app_id') ?>" size="60"/>
            </td>
            </tr>
            <td colspan="2">
            <center>
             <button id="hc_button_g2w_connect" class="ui-button ui-widget ui-corner-all ui-button-text-only ui-state-default" role="button" aria-disabled="false"><span class="ui-button-text">Connect to GoToWebinar</span></button>
            </center>
            </td>
        </tr>
         </tbody>
        </table>
    
</div>
<div id="hc_admin_ajax_loading">
    <center><img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/ajax-loading.gif"></center>
</div>
<div id="hc_admin_notification_dialog" title="Notification">
    <p>
        <br/>
        <span class="ui-icon ui-icon-info" style="float:left; margin:0 7px 20px 0;"></span>
        <span id="hc_admin_notification_dialog_txt">
        </span>
    </p>
</div>
<script>
    jQuery(document).ready(function(){
        jQuery('.ui-state-default').live('mouseover',function () { jQuery(this).addClass('ui-state-hover'); }).live('mouseout',function () { jQuery(this).removeClass('ui-state-hover'); })
    });
</script>