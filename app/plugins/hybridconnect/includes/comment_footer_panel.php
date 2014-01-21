<div class="hc_admin_new_connector_top">
    <div class="hc_admin_new_connector_top_close">
        <img class="img_hc_admin_new_connector_top_close" src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/close-icon.png" border="0" />
    </div>
    <div class="clear"></div>
</div>
<div class="hc_admin_new_connector">
    <div class="labelHeader">Comment Footer Settings</div>
    <div class="labelStep">
        This will add a comment opt in checkbox in the comments section of your blog posts similar to this below:-
      <center>
      <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/comment_opt_in_new2.png" style="margin-top:10px; margin-bottom:10px;" />
      </center>
      <p><font color="red">Please note that this is still in beta: We have noticed that with a minority of themes the subscription option isn't appearing and on others it's not appearing correctly.  We are working on improving the "hit rate" and will be uploading a newer version of this for you shortly.</font></p>
    </div>
    <table class="tableConnectorDetails">
        <tr>
            <td class="label_column">Display text</td>
            <td>
                <input type="text" id="hc_comment_footer_text"  value="<?php echo get_option("hc_comment_text"); ?>" size="80"/>
            </td>
        </tr>
        <tr>
            <td class="label_column">Opt in Settings</td>
            <td>
                <select name="hc_comment_footer_opt_in" id="hc_comment_footer_opt">
                <option value="1" <?php if(get_option("hc_comment_optin")=="1") { echo 'selected="selected"'; }?>>Opt in to receive comments (recommended)</option>
                <option value="0" <?php if(get_option("hc_comment_optin")=="0") { echo 'selected="selected"'; }?>>Opt out to not receive comments</option>
                </select>
            </td>
        </tr>
    </table>
    <button id="hc_submit_comment_footer_settings" class="ui-button ui-widget ui-corner-all ui-button-text-only ui-state-default" role="button" aria-disabled="false"><span class="ui-button-text">Save Settings</span></button>
</div>