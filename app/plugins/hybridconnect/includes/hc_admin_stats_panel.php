<?php
$hc_ajax_nonce = wp_create_nonce("hyconspecialsecurityforajaxstring");
?>
<input type="hidden" id="hc_hidden_services_ajaxnonce" value="<?php echo $hc_ajax_nonce ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo HYBRIDCONNECT_CSS_PATH_TEMPLATES ?>/south-street/jquery-ui-1.8.20.custom.css" />
<script type="text/javascript">
</script>
<h3>Hybrid Connect Statistics</h3>
Start date: <input type="text" id="datepicker1" value="<?php echo $start_date?>" /> End date: <input type="text" id="datepicker2" value="<?php echo $end_date?>" />
<button id="hc_admin_update_chart" class="hc_update_service_settings ui-button ui-widget ui-corner-all ui-button-text-only ui-state-default" role="button" aria-disabled="false"><span class="ui-button-text">Update Chart</span></button>
<div id="chart1" style="width: 95%; height:500px; margin-top:40px;">
</div>

<div style="width:92%; margin-left:auto; margin-right:auto; margin-top:30px; border-top:2px solid #f5f3e5; overflow:hidden; padding:20px; background:#faf9f2;">
<div style="float:left; width:49%; margin:5px;">
<h3>Referral Paths (All time)</h3>
<p>Hybrid Connect automatically records the referring sites for visitors that have subscribed.  This is especially useful to understand which of your marketing efforts are bringing you the most subscribers (for instance: this data is very useful for guest posting to see how many subscribers you are getting from your posts on other people's sites)</p>

<table class="hc_admin_connectors_table" style="width:100%; margin-top:20px;">
            <thead>
                <tr>
                    <th>Referring Domain</th>
                    <th>Signups</th>
                </tr>
            </thead>
            <tbody>
<?php
if($referingDomainStatsSize=="0") { echo "<tr><td colspan='2'>You don't have any referral data yet.</td></tr>"; } else {
foreach ($referingDomainStats as $referingDomainStat) { ?>
            <tr>
            <td style="text-align:left;">
            <a href="<?php echo $referingDomainStat->referingdomain; ?>" class="fullURLStats"><?php echo $referingDomainStat->referingdomain; ?>
            <li class="ui-state-default ui-corner-all" title=".ui-icon-circle-triangle-s" style="width:16px; height:16px; list-style:none; float:left; margin-right:5px;"><span class="ui-icon ui-icon-circle-triangle-s"></span></li>
            </a>
            </td>
            <td>
            <?php echo $referingDomainStat->subscribers; ?>
            </td>
            </tr>
            <tr style="display:none;" class="referingURLRow">
            <td colspan="2" class="referringURLContainer" style="background:#FAF9F2 !important;">
            </td>
            </tr>
<?php }
}
?>
</tbody>
</table>

</div>

<div style="float:left; width:49%; margin:5px;">
<h3>Custom Tracking (All time)</h3>
<p>Hybrid Connect has an inbuilt link tracking script to track any inbound marketing campaigns that you are running.  You can simply add '?hctrack=xxxxx' where xxxxx is any name that you choose to end of your link. So, for instance, a valid tracking link looks like this: http://www.imimpact.com/blog?hctrack=soload1</p>

<table class="hc_admin_connectors_table" style="width:100%; margin-top:20px;">
            <thead>
                <tr>
                    <th>Tracking Code</th>
                    <th>Signups</th>
                </tr>
            </thead>
            <tbody>
<?php
if($hcTrackingStatsSize=="0") { echo "<tr><td colspan='2'>You don't have any tracking data yet.</td></tr>"; } else {
foreach ($hcTrackingStats as $hcTrackingStat) { ?>
            <tr>
            <td>
            <?php echo $hcTrackingStat->trackingcode; ?>
            </td>
            <td>
            <?php echo $hcTrackingStat->subscribers; ?>
            </td>
            </tr>
<?php }
}
?>
</tbody>
</table>
</div>

</div>

<div id="hc_admin_notification_dialog" title="Notification">
    <p>
        <br/>
        <span class="ui-icon ui-icon-info" style="float:left; margin:0 7px 20px 0;"></span>
        <span id="hc_admin_notification_dialog_txt">
        </span>
    </p>
</div>
<div id="hc_admin_ajax_loading">
    <center><img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/ajax-loading.gif"></center>
</div>
<script>
 jQuery(document).ready(function(){
      jQuery('.ui-state-default').live('mouseover',function () { jQuery(this).addClass('ui-state-hover'); }).live('mouseout',function () { jQuery(this).removeClass('ui-state-hover'); })
    });
    </script>