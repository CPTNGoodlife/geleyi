<div class="hc_admin_new_connector_top">
    <div class="hc_admin_new_connector_top_close">
        <img class="img_hc_admin_new_connector_top_close" src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/close-icon.png" border="0" />
    </div>
    <div class="clear"></div>
</div>
<form id="hc_form_mail_settings">
    <div class="hc_admin_new_connector">
    <div class="labelHeader">Mailing List Settings</div>

    <table class="tableConnectorDetails">
    <tr>
    <td><input type="radio" name="customHTMLConnect" id="mailRadio1" value="0" <?php if($my_connector->apiConnection=="0") { echo 'checked="checked"';  } ?> /> Custom form code (recommended for most users)</td>
    <td><input type="radio" name="customHTMLConnect" id="mailRadio2" value="1" <?php if($my_connector->apiConnection=="1") { echo 'checked="checked"';  } ?> /> Connect through API (advanced users)</td>
    </tr>
    </table>

</form>
       <div id="hc_table_custom_signup_code">
       <div class="labelStep">
              <p>Simply and copy and paste the signup code from your autoresponder into the input textarea below:</p>
        </div>
         <table class="tableConnectorDetails" >
     <tr>
     <td class="label_column">
    Enter your HTML signup code below:<br/>

    <textarea id="mailingListSignupCode" rows="10" cols="50" style="padding:0px !important; font-size:12px; font-family:courier;">
    <?php echo $my_connector->custom_code; ?>
    </textarea>
    </td>
    </tr>
    </table>
    </div>

    <div class="mailingListAPI" style="margin-top:20px;">
        <div class="labelStep">
            You can use this form to integrate with your mailing list. Firstly, choose the service provider that you use, and then fill out the settings underneath
        </div>
        <?php foreach ($my_services as $s):
              if ($s['validated']): $autoValidated=1 ?>
              <?php endif ?>
        <?php endforeach ?>
        <?php if($autoValidated) { ?>
        <table class="tableConnectorDetails" style="margin-bottom:0px;">
            <tr>
                <td class="label_column">Integrate With*:</td>
                <td>
                    <input type="hidden" class="hc_admin_hidden_idConnector" value="<?php echo $my_connector->IntegrationID ?>" />
                    <?php foreach ($my_services as $s): ?>
                        <?php if ($s['validated']): ?>
                            <input type="radio" name="hc_mail_type" value="<?php echo $s['name'] ?>" class="radio_hc_admin_mail_list_type" <?php if ($my_mailingList && $my_mailingList->autoresponderType == $s['name']): ?>checked<?php endif; ?> />
                            <?php echo $s['label'] ?>
                        <?php endif ?>
                    <?php endforeach ?>
                </td>
            </tr>
        </table>
        <table class="tableConnectorDetails" id="hc_table_admin_mail_list_name" style="margin-top:0px; margin-bottom:0px;">
            <tr>
                <td class="label_column">List Settings:</td>
                <td id="table_column_list_settings">
                </td>
            </tr>
        </table>
        <table class="tableConnectorDetails" id="hc_table_admin_mail_list_typage" style="margin-top:0px; margin-bottom:0px;">
        <tr>
            <td class="label_column">Thank you page*:</td>
            <td>
                <select name="hc_connector_thanksPage" id="sel_hc_connector_thanksPage">
                    <?php foreach ($available_pages as $page): ?>
                        <option <?php if ($my_connector && $my_connector->TyPage == get_permalink(get_page_by_title($page->post_title))): ?>selected<?php endif; ?>  value="<?php echo get_permalink(get_page_by_title($page->post_title)) ?>">
                            <?php echo $page->post_title ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        </table>
        </div>

        <?php } else {
                     $hcSettingsPage = get_admin_url();
                     $hcSettingsPage = $hcSettingsPage."admin.php?page=hybridConnectAdminSetup"; ?>
                     <div class="ui-widget" id="hc_facebook_txt_invalid">
                           <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
                                <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                                <strong><?php echo 'You haven\'t set up an autoresponder yet. Please configure your services in the <a href="' . $hcSettingsPage . '">Connect Autoresponder</a> section.</div>'; } ?></strong></p>
                           </div>
                      </div>

          <div class="hc_admin_new_connector">
                      <div class="labelStep">
            Tell us which type of optin form you would like to use (please note that if you are using custom HTML form code, then you must choose the option below that matches with that code!):
        </div>

         <table class="tableConnectorDetails">
    <tr>
    <td><input type="radio" name="optinType" id="nameAndEmail" value="0" <?php if($my_connector->emailOnly=="0") { echo 'checked="checked"';  } ?> /> Name and Email Address</td>
    <td><input type="radio" name="optinType" id="emailOnly" value="1" <?php if($my_connector->emailOnly=="1") { echo 'checked="checked"';  } ?> /> Only Email Address</td>
    </tr>
    </table>
        </div>
        </div>

           <button id="hc_submit_admin_mail_list_settings2" class="ui-button ui-widget ui-corner-all ui-button-text-only ui-state-default" role="button" aria-disabled="false"><span class="ui-button-text">Submit</span></button>
                  <button id="hc_remove_admin_mail_list_settings" class="ui-button ui-widget ui-corner-all ui-button-text-only ui-state-default-cancel" role="button" aria-disabled="false"><span class="ui-button-text">Remove Mailing List</span></button>
    </div>
</form>
<div id="hc_admin_ajax_loading_front">
    <center><img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/ajax-loading.gif"></center>
</div>
