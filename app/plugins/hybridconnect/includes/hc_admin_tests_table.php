<?php
if (empty($hc_tests_list)) {
    echo '<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
            <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                <strong>You haven\'t run any tests yet! </strong></p>
        </div>';
} else {
    ?>

    <table class="hc_admin_connectors_table" style="margin-top:20px; margin-left:20px; height:auto; width:950px;">
        <thead>
            <tr>
                <th style="font-size: 1.1em; font-family: segoe ui, Arial, sans-serif;">Test Type</th>
                <th style="font-size: 1.1em; font-family: segoe ui, Arial, sans-serif;">Test Started</th>
                <th style="font-size: 1.1em; font-family: segoe ui, Arial, sans-serif;">Test Ended</th>
                <th style="font-size: 1.1em; font-family: segoe ui, Arial, sans-serif;">Show Test Details</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hc_tests_list as $thisTest) { ?>
                <tr>
            <input type="hidden" class="hc_test_id" value="<?php echo $thisTest->id; ?>"/>
            <input type="hidden" class="hc_connector_id" value="<?php echo $thisTest->idConnector; ?>"/>
            <input type="hidden" class="hc_type" value="<?php echo $thisTest->type; ?>"/>
            <td valign="middle" style="font-family: segoe ui, Arial, sans-serif; font-size: 1.1em; width:250px; text-align:left;">
                <?php
                switch ($thisTest->type) {
                    case 0: echo "Shortcode";
                        break;
                    case 1: echo "Widget";
                        break;
                    case 2: echo "Lightbox / Slide in";
                        break;
                    case 3: echo "Squeeze Page";
                        break;
                }
                ?>
            </td>
            <td style="font-family: segoe ui, Arial, sans-serif; font-size: 1.1em; width:250px; text-align:left;">
                <?php
                $SQL_DateTime = date($thisTest->startData);
                $thisDate = date("F j, Y, g:i A", strtotime($SQL_DateTime));
                echo $thisDate;
                ?>
            </td>
            <td style="font-family: segoe ui, Arial, sans-serif; font-size: 1.1em; width:250px; text-align:left;">
                <?php
                $SQL_DateTime = date($thisTest->stopData);
                $thisDate = date("F j, Y, g:i A", strtotime($SQL_DateTime));
                echo $thisDate;
                ?>
            </td>
            <td>
                <?php if ($thisTest->stopData != ""): ?>
                    <a class="hc_link_test_results" style="text-decoration:none;" href="/">                    
                        <li class="ui-state-default ui-corner-all ui-state" title="Shortcode Design" style="width:130px; padding:4px; margin:0px auto; list-style:none;">
                            <span class="ui-icon ui-icon-pencil" style="width:16px; float:left; margin:0px; padding:0px;"></span>Show Test Results
                        </li>
                    </a>
                <?php else: ?>
                <li class="ui-state-default ui-corner-all ui-state" title="Test is running" style="width:130px; padding:4px; margin:0px auto; list-style:none;">
                    <span class="ui-icon ui-icon-pencil" style="width:16px; float:left; margin:0px; padding:0px;"></span>Test is running
                </li>
            <?php endif ?>
        </td>
        </tr>
        <tr style="display: none;">
            <td colspan="4" class="stats_container_background">
                <div class="hc_container_statistics" id="hc_container_statistics<?php echo $thisTest->id; ?>">

                </div>
            </td>
        </tr>
        <?php
    } // end foreach
    unset($thisTest);
    ?>

    </tbody>
    </table>
    <?php
} // end if statement ?>