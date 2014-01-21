<input type="hidden" value="<?php echo $var->id ?>" class="hc_hidden_variation_id"/>
<input type="hidden" value="<?php echo count($variations) ?>" class="hidden_variations_count" />
<?php
if ($hc_type->type == 0) {
    $hc_current_section = "Shortcode";
} elseif ($hc_type->type == 1) {
    $hc_current_section = "Widget";
} elseif ($hc_type->type == 2) {
    $hc_current_section = "Lightbox";
} elseif ($hc_type->type == 3) {
    $hc_current_section = "Squeeze page";
}
?>
<table class="hc_admin_stats_table">
    <thead>
        <tr>
            <th colspan="8">
                <b><?php echo $hc_current_section ?> Statistics</b>
    <div class="statsCloseButton"></div>
</th>

</tr>
<tr class="row_variation_stats_body">
    <td colspan="8">
        <?php if ($hc_type->testing == 1): ?>
            <div class="ui-widget">
                <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em; float:left; width:1000px; margin-top:0px;">
                    <p style="float:left; width:100%;"><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                        <strong>Update</strong> (<?php echo $hc_type->dateTestStart ?>) Test has been started and is currently running</p></div></div>

        <?php else: ?>
            <?php if ($hc_type->dateTestEnd != ""): ?>
                <div class="ui-widget">
                    <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em; float:left; width:1000px; margin-top:0px;">
                        <p style="float:left; width:100%;"><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                            <strong>Update</strong> (<?php echo $hc_type->dateTestEnd ?>) The test was ended
                            <?php if ($hc_type->testEndManual == 1): ?>
                                manually.  The chosen variation was set to be the new control.
                            <?php endif ?>

                            <?php if ($hc_type->testEndManual != 1): ?>
                                automatically because the winner reached 95% statistical significance and is now being shown on the site.
                            <?php endif ?>
                        </p></div></div>
            <?php endif ?>
        <?php endif ?>
    </td>
</tr>
<tr class="row_variation_stats">
    <th>Name</th>
    <th width="75">Total Impressions</th>
    <th width="75">Unique Impressions</th>
    <th width="75">Conversions</th>
    <th width="75">Conversion Rate</th>
    <th width="75">Percentage Improvement</th>
    <th width="75">Chance to Beat Original</th>
    <th width="250">Actions</th>
</tr>
</thead>
<tbody>    
    <?php
    $ctrl = $variations[0];
    foreach ($variations as $key => $var):
        ?>
        <tr class="row_variation_stats_body">
            <td style="text-align:left !important; <?php if ($var->control == 1): ?> background:#ffffcc !important; font-weight:bold;<?php endif ?>"><?php echo $key + 1 . ". " . $var->name ?><?php if ($var->control == 1): ?> (control)<?php endif ?></td>
            <td <?php if ($var->control == 1): ?> style="background:#ffffcc  !important;" <?php endif ?>><?php echo $var->totalImpressions ?></td>
            <td <?php if ($var->control == 1): ?> style="background:#ffffcc  !important;" <?php endif ?>><?php echo $var->uniqueImpressions ?></td>
            <td <?php if ($var->control == 1): ?> style="background:#ffffcc  !important;" <?php endif ?>><?php if ($var->control != 2): ?><?php echo $var->conversions ?><?php endif ?></td>
            <td class="conversionRate" <?php if ($var->control == 1): ?> style="background:#ffffcc  !important; " <?php endif ?>><?php if ($var->control != 2): ?><?php echo number_format($var->conversionsRate * 100, 2); ?> % <?php endif ?></td>
            <td class="percentageImprovement" <?php if ($var->control == 1): ?> style="background:#ffffcc  !important; " <?php endif ?>>
                <?php if ($var->control == 0 && $ctrl->conversions > 0): ?>

                    <?php
                    if ($var->percentageImproovement >= 0) {
                        echo number_format($var->percentageImproovement, 2) . " %";
                    } else {
                        echo "<span style='color: red;'> " . number_format($var->percentageImproovement, 2) . " %</span>";
                    }
                    ?>
                <?php elseif ($var->control == 0 && $ctrl->conversionsRate == 0): ?>
                    N/A                
                <?php endif ?>
            </td>
            <td <?php if ($var->control == 1): ?> style="background:#ffffcc  !important;" <?php endif ?>>
                <?php if ($var->control == 0 && $ctrl->conversions > 0 && is_numeric($var->chanceTbo)): ?>
                
                    <?php echo number_format($var->chanceTbo, 2) ?> %
                <?php elseif (($var->control == 0 && $ctrl->conversions == 0) || (!is_numeric($var->chanceTbo) && $var->control == 0) ): ?>
                    N/A
                <?php endif ?>
                <?php if ($var->enabled == 2): ?><br/>This variation has been removed because the chance to beat original rate was below 5%<?php endif ?>
            </td>
            <td <?php if ($var->control == 1): ?> style="background:#ffffcc  !important;" <?php endif ?>>
                <input type="hidden" class="hidden_variation_id" value="<?php echo $var->id ?>" />
                <input type="hidden" class="hidden_connector_id" value="<?php echo $var->idConnector ?>" />
                <?php if ($hc_type->testing == 1): ?>
                    <a class="hc_link_edit_variation_design hc_button" href="/" style="float:right;  margin:5px;">
                        <li class="ui-state-default ui-corner-all ui-state-hover" title="View Variation" style="width:100px; padding:4px; margin:0px auto;"><span class="ui-icon ui-icon-pencil" style="width:16px; float:left; margin:0px; padding:0px; font-size:0.8em;"></span>View Variation</li>
                    </a>
                <?php else: ?>
                    <a class="hc_link_edit_variation_design hc_button" href="/" style="float:right;  margin:5px;">
                        <li class="ui-state-default ui-corner-all ui-state-hover" title="Edit Variation" style="width:100px; padding:4px; margin:0px auto;"><span class="ui-icon ui-icon-pencil" style="width:16px; float:left; margin:0px; padding:0px; font-size:0.8em;"></span><span class="ui-button-text">Edit Variation</span></li>
                    </a>
                    <?php if ($var->control == 0): ?>
                        <a class="hc_link_delete_variation hc_button" href="/" style="float:right;  margin:5px;">
                            <li class="ui-state-default-cancel ui-corner-all ui-state-hover-cancel" title="Delete Variation" style="width:60px; padding:4px; margin:0px auto;"><span class="ui-icon ui-icon-closethick" style="width:16px; float:left; margin:0px; padding:0px; font-size:0.8em;"></span><span class="ui-button-text">Delete</span></li>
                        </a>
                    <?php endif ?>
                <?php endif ?>
            </td>
        </tr>
    <?php endforeach ?>
    <?php if ($hc_type->testing == 0): ?>
        <tr class="row_variation_stats_body">
            <td colspan="8">
                <a class="hc_link_add_variation_design hc_button" href="/" style="float:right; margin:5px;">
                    <li class="ui-state-default ui-corner-all ui-state-hover" title="Add Variation" style="width:100px; padding:4px; margin:0px auto;"><span class="ui-icon ui-icon-circle-plus" style="width:16px; float:left; margin:0px; padding:0px; font-size:0.8em;"></span>Add Variation</li>
                </a>
            </td>
        </tr>
    <?php endif ?>
    <?php if ($hc_type->testing == 0): ?>
        <tr class="row_variation_stats_body" style="border-top:1px dashed">
            <td colspan="10" class="testControls">
                <a class="hc_link_start_test_design hc_main_button" href="/" style="float:right;margin:5px;">
                    <li class="ui-state-default ui-corner-all ui-state-hover" title="Start Test" style="width:100px; padding:4px; margin:0px auto;"><span class="ui-icon ui-icon-play" style="width:16px; float:left; margin:0px; padding:0px; font-size:0.8em;"></span>Start Test</li>
                </a>
                <a class="hc_link_clear_data_design hc_main_button" href="/" style="float:right;margin:5px;">
                    <li class="ui-state-default-cancel ui-corner-all ui-state-hover-cancel" title="Clear data" style="width:100px; padding:4px; margin:0px auto;"><span class="ui-icon ui-icon-closethick" style="width:16px; float:left; margin:0px; padding:0px; font-size:0.8em;"></span>Clear data</li>
                </a>
            </td>

        </tr>
    <?php endif ?>
    <?php if ($hc_type->testing == 1): ?>
        <tr class="row_variation_stats_body" style="border-top:1px dashed">
            <td colspan="10" class="testControls">
                <a class="hc_link_stop_test_design hc_main_button" href="/" style="float:right;margin:5px;">
                    <li class="ui-state-default-cancel ui-corner-all ui-state-hover-cancel" title="Clear data" style="width:100px; padding:4px; margin:0px auto;"><span class="ui-icon ui-icon-closethick" style="width:16px; float:left; margin:0px; padding:0px; font-size:0.8em;"></span>Stop Test</li>
                </a>
            </td>

        </tr>
    <?php endif ?>
</tbody>
</table>