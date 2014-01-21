<?php
$hc_ajax_nonce = wp_create_nonce("hyconspecialsecurityforajaxstring");
?>
<link type="text/css" rel="stylesheet" href="<?php echo HYBRIDCONNECT_CSS_PATH_TEMPLATES ?>/south-street/jquery-ui-1.8.20.custom.css" />
<div style="width:950px;">
<img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/yourAffiliateLink.png" style="margin-left:20px; float:right;">
<h2>
    Earn money with Hybrid Connect
</h2>
<p>You can effortlessly make commissions with Hybrid Connect by simply ticking the box below and giving us permission to place a small affiliate link underneath each optin box on your site.</p>
<p>The is a very soft sell approach that won't alienate your visitors.  By adding a simple "powered by Hybrid Connect" link below your optin box, you can catch prospects that are interesting
in using Hybrid Connect to power their own optin boxes.  This requires no extra effort on your behalf!</p>
<p>As an affiliate you make <b><u>50% of the full sale</b></u>, including upsells.</p>
<h3>DigiResults Affiliate Program</h3>
<p>We now use the DigiResults affiliate platform because we believe it's the best platform for you.  <a href="https://www.digiresults.com/marketplace/4928" target="_blank">Go get started, visit our affiliate page here and click "Sign Up" at the top right of the page</a>.</p>
<p>Before you can start promoting, we will need to approve you as an affiliate.  We'll do this for you within a couple of hours.</p>
<h3 style="margin-top:30px;">Once you've signed up, you can get yourself set up by ticking the box below:</h3>
<table class="hc_table_fb_settings">
    <tr>
        <td class="label_column">Earn money with Hybrid Connect?</td>
        <td colspan="2">
            <input type="checkbox" name="hc_check_affiliate" <?php if (get_option('hc_earn_money') == 1): ?>checked="checked"<?php endif ?> id="hc_check_affiliate" />
        </td>
    </tr>
</table>

<table class="hc_table_fb_settings" id="affiliate_table" <?php if (get_option('hc_earn_money') == 0): ?>style="display:none;"<?php endif ?>>
<tr id="hc_row_affiliate_msg">
        <td colspan="3" id="hc_affiliate_valid_msg">
            <?php if (get_option('hc_affiliate_valid') == 1 && get_option('hc_earn_money') == 1): ?>
                Your affiliate link has been added! (
                <a href="<?php echo get_option('hc_affiliate_link') ?>" target="_blank">
                    <?php echo get_option('hc_affiliate_link') ?>
                </a>
                )
            <?php elseif (get_option('hc_earn_money') == 1 && get_option('hc_affiliate_valid') != 1): ?>
                We couldn't find an affiliate account with that record, you can sign up or do a password reset <a href="http://affiliates.swissmademarketing.com" target="_blank">here</a>.
            <?php elseif (get_option('hc_earn_money') == 0): ?>
                If you're not an affiliate, sign up <a href="https://www.digiresults.com/marketplace/4928" target="_blank">here</a>.
            <?php endif ?>
        </td>
    </tr>
    <tr id="affiliate_manual">
        <td>
            Enter DigiResults Affiliate link:
        </td>
        <td>
            <input type="text" name="hc_affiliate_manual_link" value="<?php echo get_option('hc_affiliate_link') ?>" size="55" id="hc_affiliate_manual_link" />
        </td>
        <td>
            <button id="hc_submit_affiliate_manual" class="hc_update_service_settings ui-button ui-widget ui-corner-all ui-button-text-only ui-state-default" role="button" aria-disabled="false"><span class="ui-button-text">Update Affiliate Link</span></button>
            <input type="hidden" id="hc_hidden_affiliate_ajaxnonce" value="<?php echo $hc_ajax_nonce ?>" />
        </td>
    </tr>
</table>
<p>p.s: We only recently made the transition to DigiResults, so if you've previously signed up for our proprietary affiliate program then don't panic because your affiliate links <strong>will</strong> still work.</p>
<div id="hc_admin_notification_dialog" title="Notification">
    <p>
        <br/>
        <span class="ui-icon ui-icon-info" style="float:left; margin:0 7px 20px 0;"></span>
        <span id="hc_admin_notification_dialog_txt">
        </span>
    </p>
</div>
</div>
<script>
    jQuery(document).ready(function(){
        jQuery('.ui-state-default').live('mouseover',function () { jQuery(this).addClass('ui-state-hover'); }).live('mouseout',function () { jQuery(this).removeClass('ui-state-hover'); })
    });
</script>