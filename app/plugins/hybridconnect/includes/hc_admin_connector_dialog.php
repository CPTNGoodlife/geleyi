<div class="hc_admin_new_connector_top">
    <div class="hc_admin_new_connector_top_close">
        <img class="img_hc_admin_new_connector_top_close" src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/close-icon.png" border="0" />
    </div>
    <div class="clear"></div>
</div>
<div class="hc_admin_new_connector">
    <div class="labelHeader">Add a new connector</div>
    <div class="labelStep">Step 1. Add your connector details</div>
    <table class="tableConnectorDetails">
        <tr>
            <td class="label_column">Connector Name*:</td>
            <td>
                <input type="text" name="hc_connector_name" id="txt_hc_new_connector_name" value="<?php if ($my_connector): ?><?php echo $my_connector->Name ?><?php endif; ?>" />
            </td>
        </tr>
        <tr>
            <td class="label_column">Option Type*:</td>
            <td>
                <select name="hc_connector_type" id="sel_hc_connector_type">
                    <option <?php if ($my_connector && $my_connector->Type == 'Hybrid'): ?>selected<?php endif; ?> value="Hybrid">Hybrid</option>
                    <option <?php if ($my_connector && $my_connector->Type == 'Facebook'): ?>selected<?php endif; ?> value="Facebook">Facebook Only</option>
                    <option <?php if ($my_connector && $my_connector->Type == 'Form'): ?>selected<?php endif; ?> value="Form">Form Only</option>
                </select>
            </td>
        </tr>

    </table>
    <div class="labelStep">Step 2. Add your connector details</div>
    <table class="tableConnectorDetails">
        <tr>
            <td class="label_column">Allow registration to blog:</td>
            <td>
                <input type="checkbox" name="hc_allow_registration" id="hc_allow_registration" <?php if ($my_connector && $my_connector->allow_registration == 1): ?>checked<?php endif; ?> />
            </td>
        </tr>
        <tr>
            <td class="label_column">Registration role:</td>
            <td>
                <select name="hc_registration_role" id="hc_registration_role">
                    <option value="subscriber" <?php if ($my_connector && $my_connector->registration_role == 'subscriber'):?>selected="selected"<?php endif?>>Subscriber</option>
                    <option value="editor" <?php if ($my_connector && $my_connector->registration_role == 'editor'):?>selected="selected"<?php endif?>>Editor</option>
                    <option value="author" <?php if ($my_connector && $my_connector->registration_role == 'author'):?>selected="selected"<?php endif?>>Author</option>
                    <option value="contributor" <?php if ($my_connector && $my_connector->registration_role == 'contributor'):?>selected="selected"<?php endif?>>Contributor</option>
                </select>
            </td>
        </tr>
    </table>
    <input type="hidden" name="hc_admin_id_connector" id="hidden_hc_admin_edit_id_connector" value="<?php if ($my_connector): ?><?php echo $my_connector->IntegrationID ?><?php else: ?>0<?php endif; ?>" />
   <!-- <input type="button" name="hc_admin_add_connector" id="btn_hc_admin_add_connector" value="Submit Form" class="hcAdminButton" />   -->
   <button id="btn_hc_admin_add_connector" class="ui-button ui-widget ui-corner-all ui-button-text-only ui-state-default" role="button" aria-disabled="false"><span class="ui-button-text">Save Connector!</span></button>
</div>