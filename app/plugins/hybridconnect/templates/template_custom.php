<?php
$hc_theme_name = get_current_theme();
$hc_problem_themes = array("Sterling", "Striking", "Envision Child");
?>
<?php if (in_array($hc_theme_name, $hc_problem_themes) && $style_connector->type == 0): ?>[raw]<?php endif ?>
<?php
$hc_ajax_nonce = wp_create_nonce("hyconspecialsecurityforajaxstring");
?>
<script type="text/javascript">
    var hc_shortcode_connector = <?php echo json_encode($my_connector); ?>;
    hc_connectors.push(hc_shortcode_connector);
    var hc_rand_id = <?php echo $rand_id ?>;
    hc_rand_ids.push(hc_rand_id);
</script>
<input type="hidden" id="hc_hidden_emailonly<?php echo $rand_id ?>" class="hc_hidden_default_template" value="<?php echo $my_connector->emailOnly ?>" />
<div style="position:absolute; top:-1000px; left:-1000px; z-index:300;" id="customsubmit<?php echo $rand_id ?>"><?php echo $my_connector->custom_code; ?></div>
<input type="hidden" id="hc_hidden_fb_ajaxnonce" value="<?php echo $hc_ajax_nonce ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo HYBRIDCONNECT_CSS_PATH_TEMPLATES ?>/hc_tpl_fonts.css" />
<link href='<?php echo $protocol; ?>//fonts.googleapis.com/css?family=Dosis|Droid+Sans|Crushed|Parisienne|Lora|PT+Sans|PT+Sans+Narrow|Ubuntu|Lobster|Anton|Holtwood+One+SC|Russo+One|Great+Vibes|Droid+Serif|Open+Sans|Oswald|Yanone+Kaffeesatz|Homenaje|Bowlby+One+SC|Seaweed+Script|News+Cycle|Oxygen|Open+Sans'
      rel='stylesheet' type='text/css' />
<input type="hidden" value="0" id="hc_hidden_default_template<?php echo $rand_id?>" />
<div id="hc_template_wrapper<?php echo $rand_id ?>" class="hc_template_frontend_wrapper" style="display:none; <?php if ($hc_is_footer): ?>margin-bottom: 15px;<?php endif ?>">
    <div style="width:<?php echo $my_connector->custom_width?>px;" id="hc_shortcode_form<?php echo $rand_id ?>" class="connectorWrapper emailConnectorWrapper hc_shortcode_form<?php echo $rand_id ?> connectorWrapper<?php echo $rand_id ?>">
        <input type="hidden" class="hc_hidden_connector_id" value="<?php echo $my_connector->IntegrationID ?>" />
        <input type="hidden" class="hc_hidden_connector_randid" value="<?php echo $rand_id ?>" />
        <input type="hidden" id="islightbox<?php echo $rand_id ?>" value="0" />
        <?php echo html_entity_decode(stripslashes_deep($my_connector->custom_form))?>
    </div>
    <div id="hc_shortcode_facebook<?php echo $rand_id ?>" class="hc_shortcode_facebook<?php echo $rand_id ?>">
        <div style="width:<?php echo $my_connector->custom_width?>px;" id="hc_facebook_not_connected<?php echo $rand_id ?>" class="connectorWrapper facebookConnectorWrapper hc_facebook_not_connected<?php echo $rand_id ?> connectorWrapper<?php echo $rand_id ?>">
            <input type="hidden" class="hc_hidden_connector_randid" value="<?php echo $rand_id ?>" />
            <input type="hidden" class="hc_hidden_connector_id" value="<?php echo $my_connector->IntegrationID ?>" />
            <?php echo html_entity_decode(stripslashes_deep($my_connector->custom_fbnot))?>
        </div>
        <div style="width:<?php echo $my_connector->custom_width?>px;" id="hc_facebook_connected<?php echo $rand_id ?>" class="connectorWrapper oneClickConnectorWrapper hc_facebook_connected<?php echo $rand_id ?> connectorWrapper<?php echo $rand_id ?>">
            <input type="hidden" class="hc_hidden_connector_id" value="<?php echo $my_connector->IntegrationID ?>" />
            <input type="hidden" class="hc_hidden_connector_randid" value="<?php echo $rand_id ?>" />
            <?php echo html_entity_decode(stripslashes_deep($my_connector->custom_fbyes))?>
        </div>
    </div>
</div>
<?php if (in_array($hc_theme_name, $hc_problem_themes) && $style_connector->type == 0):?>[/raw]<?php endif?>