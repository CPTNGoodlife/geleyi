 <?php if(empty($hc_connectors_list)) { echo '<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
            <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                <strong>You haven\'t saved any templates yet! </strong></p>
        </div>';} else {
               ?>

               <table class="hc_admin_connectors_table" style="margin-top:20px; margin-left:20px; height:auto;">
    <thead>
        <tr>
            <th style="font-size: 1.1em;">Name</th>
            <th style="font-size: 1.1em;">Load Template</th>
            <th style="font-size: 1.1em;">Delete</th>
        </tr>
    </thead>
    <tbody>


 <?php foreach($hc_connectors_list as $thisConnector) { ?>
                <tr>
                <td valign="middle" style="font-family: segoe ui, Arial, sans-serif; font-size: 1.1em; width:250px; text-align:left;">
               <?php echo $thisConnector->user_template_name; ?>
            </td>
            <td valign="middle" class="loadTemplateCell">
            <button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover hc_link_connector_shortcode_template_settings" role="button" aria-disabled="false"><span class="ui-button-text">Load Template</span></button>
            <input type="hidden" class="intID" value="<?php echo $thisConnector->id; ?>" name="intID" />
            <input type="hidden" class="connID" value="<?php echo $thisConnector->id_connector; ?>" />
            </td>
            <td valign="middle">
            <input type="hidden" class="connID" value="<?php echo $thisConnector->id_connector; ?>" />
                             <button class="ui-button ui-widget ui-state-default-cancel ui-corner-all ui-button-text-only ui-state-hover hc_link_connector_remove removeTemplate" role="button" aria-disabled="false"><span class="ui-icon ui-icon-closethick removeTemplate"></span></button>

            </td>
        </tr>
<?php   } // end foreach
unset($thisConnector);
?>

            </tbody>
</table>
<?php  } // end if statement ?>