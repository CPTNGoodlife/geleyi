<?php
$hc_ajax_nonce = wp_create_nonce("hyconspecialsecurityforajaxstring");
?>
<input type="hidden" id="hc_hidden_services_ajaxnonce" value="<?php echo $hc_ajax_nonce ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo HYBRIDCONNECT_CSS_PATH_TEMPLATES ?>/south-street/jquery-ui-1.8.20.custom.css" />
<!--Admin section layout -->
<h3>Choose the Autoresponder that you Use:</h3>
<!-- <img src="http://hybrid-connect.com/wp-content/uploads/2012/04/emailservices2.png">    -->
 <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH?>/aweberLogo.png" id="service-1"  class="serviceOption" />
 <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH?>/icontactLogo.png" id="service-2" class="serviceOption" />
 <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH?>/getresponseLogo.png" id="service-3" class="serviceOption" />
 <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH?>/officeautopilotLogo.png" id="service-4" class="serviceOption" />
 <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH?>/infusionsoftLogo.png" id="service-5" class="serviceOption" />
 <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH?>/mailchimpLogo.png" id="service-6" class="serviceOption" />
 <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH?>/constantcontactLogo.png" id="service-7" class="serviceOption" />
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
    <?php foreach ($my_services as $s):?>
        <?php if ($s['validated']):?>
            <?php echo $s['label'] . ' - '; ?>
        <?php endif?>
    <?php endforeach?>
</div><br/> -->
<div class="serviceProviderTable" id="hc_service_provider_7" style="display:none;">
<table class="hc_table_fb_settings" width="90%">
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
            <?php if ($my_services['aweber']['validated']):?>
                This service is valid with the current settings
            <?php else:?>
                This service couldn't be validated with the current settings
            <?php endif?>
        </td>
        </tr>
        </table>
</div>
<div class="serviceProviderTable" id="hc_service_provider_1" style="display:none;">
<table class="hc_table_fb_settings" width="90%">
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
            </a>
        </td>
    </tr>
    <tr>
        <td class="service_label">InfusionSoft AppUrl:</td>
        <td><input type="text" name="hc_infusionsoft_appurl" value="<?php echo get_option('hc_infusionsoft_appurl') ?>" size="55" id="hc_infusionsoft_appurl" /></td>
    </tr>
   </table>
</div>
<div class="serviceProviderTable" id="hc_service_provider_2" style="display:none;">
<table class="hc_table_fb_settings serviceProviderTable" width="90%">
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
            </a>
        </td>
    </tr>
    <tr>
        <td class="service_label">OfficeAutoPilot AppKey:</td>
        <td><input type="text" name="hc_officeautopilot_appkey" value="<?php echo get_option('hc_officeautopilot_appkey') ?>" size="55" id="hc_officeautopilot_appkey" /></td>
    </tr>
    </table>
</div>
<div class="serviceProviderTable"  id="hc_service_provider_3" style="display:none;">
<table class="hc_table_fb_settings serviceProviderTable" width="90%">
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
            </a>
        </td>
    </tr>
</table>
</div>
<div class="serviceProviderTable"  id="hc_service_provider_4" style="display:none;">
<table class="hc_table_fb_settings serviceProviderTable" width="90%">
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
            </a>
        </td>
    </tr>
   </table>
</div>
<div class="serviceProviderTable"  id="hc_service_provider_5" style="display:none;">
<table class="hc_table_fb_settings serviceProviderTable" width="90%">
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
            </a>
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
<table class="hc_table_fb_settings serviceProviderTable" width="90%">
    <tr>
        <td class="service_label">ConstantContact AppKey:</td>
        <td><input type="text" name="hc_constantcontact_appkey" value="<?php echo get_option('hc_constantcontact_appkey') ?>" size="55" id="hc_constantcontact_appkey" /></td>
        <td class="update_column" rowspan="3">
            <input type="hidden" name="hc_service_name" class="hc_service_name" value="constantcontact" />
        <!--     <input type="button" name="Submit" class="hc_update_service_settings hcAdminButton" id="hc_submit_constantcontact_settings" value="Update ConstantContact Settings" />   -->
             <button id="hc_submit_constantcontact_settings" class="hc_update_service_settings ui-button ui-widget ui-corner-all ui-button-text-only ui-state-default" role="button" aria-disabled="false"><span class="ui-button-text">Update ConstantContact Settings</span></button>
            <br/>
            Get more details here:
            <a href="http://developer.constantcontact.com/" target="_blank">
                http://developer.constantcontact.com/
            </a>
        </td>
    </tr>
    <tr>
        <td class="service_label">ConstantContact Username:</td>
        <td>
            <input type="text" name="hc_constantcontact_appid" value="<?php echo get_option('hc_constantcontact_appid') ?>" size="55" id="hc_constantcontact_appid" />
        </td>
    </tr>
    <tr>
        <td class="service_label">ConstantContact Password:</td>
        <td><input type="text" name="hc_constantcontact_appurl" value="<?php echo get_option('hc_constantcontact_appurl') ?>" size="55" id="hc_constantcontact_appurl" /></td>
    </tr>
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
      $('.ui-state-default').live('mouseover',function () { $(this).addClass('ui-state-hover'); }).live('mouseout',function () { $(this).removeClass('ui-state-hover'); })
    });
    </script>