<input type="hidden" value="<?php echo $var->id ?>" class="hc_hidden_variation_id"/>

<table class="hc_admin_stats_table">
    <thead>
        <tr>
            <th colspan="8">
                <b>Shortcode Statistics</b>
    <div class="statsCloseButton"></div>
</th>

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
            <td style="text-align:left !important; <?php if ($var->control == 1): ?> background:#ffffcc !important; font-weight:bold;<?php endif ?>">
                <?php echo $key + 1 . ". " . $var->name ?>
                <?php if ($var->control == 1): ?> (control)<?php endif ?>
                <?php if ($var->id == $finalControl->id):?>(winner)<?php endif?>
            </td>
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
                        //$var->chanceTbo = 100 - $var->chanceTbo;
                    }
                    ?>
                <?php elseif ($var->control == 0 && $ctrl->conversions == 0): ?>
                    N/A                
                <?php endif ?>
            </td>
            <td <?php if ($var->control == 1): ?> style="background:#ffffcc  !important;" <?php endif ?>>
                <?php if ($var->control == 0 && $ctrl->conversions > 0): ?>
                    <?php echo number_format($var->chanceTbo, 2) ?> %
                <?php elseif ($var->control == 0 && $ctrl->conversions == 0): ?>
                    N/A
                <?php endif ?>
                <?php if ($var->enabled == 2): ?><br/>This variation has been removed because the chance to beat original rate was below 5%<?php endif ?>
            </td>
            <td <?php if ($var->control == 1): ?> style="background:#ffffcc  !important;" <?php endif ?>>
                <input type="hidden" class="hidden_variation_id" value="<?php echo $var->id ?>" />
                <input type="hidden" class="hidden_connector_id" value="<?php echo $var->idConnector ?>" />
                <a class="hc_link_edit_variation_design hc_button" href="/" style="float:right;  margin:5px; font-size:1.0em;">
                    <li class="ui-state-default ui-corner-all" title="View Variation" style="width:100px; padding:4px; margin:0px auto; list-style-type:none;"><span class="ui-icon ui-icon-pencil" style="width:16px; float:left; margin:0px; padding:0px; font-size:0.8em;"></span>View Variation</li>
                </a>
            </td>
        </tr>
    <?php endforeach ?>
</tbody>
</table>