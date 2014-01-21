<?php if ($is_link && $lightboxOrOptin=="lightbox"):?>
    <a class="hc_lightbox_click_trigger<?php echo $my_connector->IntegrationID?>" href="#"><?php echo $link_text?></a>
<?php endif?>
<?php if ($is_link && $lightboxOrOptin=="optin"):?>
    <a class="hc_optin_click_trigger<?php echo $my_connector->IntegrationID?>" href="#"><?php echo $link_text?></a>
<?php endif?>
<?php
$hc_ajax_nonce = wp_create_nonce("hyconspecialsecurityforajaxstring");
?>
<?php
$hc_theme_name = get_current_theme();
$hc_problem_themes = array("Sterling", "Striking", "Envision Child");
?>
<?php if (in_array($hc_theme_name, $hc_problem_themes) && $style_connector->type == 2): ?>[raw]<?php endif ?>
<script type="text/javascript">
    var hc_shortcode_connector = <?php echo json_encode($my_connector); ?>;
    hc_connectors.push(hc_shortcode_connector);
    var hc_rand_id = <?php echo $rand_id ?>;
    hc_rand_ids.push(hc_rand_id);
</script>

<style type="text/css">
    /* LIGHTBOX CONTENT */
    .hc_template_lightbox_popup {
        background-image: url("<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/bg-trans.png");
        height: 100%;
        left: 0;
        min-height: 350px;
        position: fixed;
        top: 0;
        width: 100%;
    }
    .hc_template_lightbox_popup {
        z-index: 10000 !important;
    }
    .hc_template_lightbox_popup .lightbox-close {
        background-image: url("<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/lightbox-close.png");
        background-position: left top;
        background-repeat: no-repeat;
        float: right;
        height: 25px;
        margin-top: -25px;
        margin-right: -25px;
        width: 25px;
    }
    .hc_template_lightbox_popup .lightbox-close:hover {
        background-position: left bottom;
    }
</style>
<input type="hidden" id="hc_hidden_fb_ajaxnonce" value="<?php echo $hc_ajax_nonce ?>" />
<input type="hidden" id="hc_hidden_emailonly<?php echo $rand_id ?>" class="hc_hidden_default_template" value="<?php echo $my_connector->emailOnly ?>" />
<div style="position:absolute; top:-1000px; left:-1000px; z-index:300;" id="customsubmit<?php echo $rand_id ?>"><?php echo $my_connector->custom_code; ?></div>
<input type="hidden" value="<?php if ($hc_is_lightbox): ?>1<?php else: ?>0<?php endif ?>" id="hc_hidden_lightbox_on<?php echo $rand_id ?>"  />
<input type="hidden" value="<?php if ($hc_is_lightbox): ?><?php echo $lightbox_options->on_time ?><?php else: ?>0<?php endif ?>" id="hc_hidden_lightbox_ontime<?php echo $rand_id ?>"  />
<input type="hidden" value="<?php if ($hc_is_lightbox): ?><?php echo $lightbox_options->on_click ?><?php else: ?>0<?php endif ?>" id="hc_hidden_lightbox_onclick<?php echo $rand_id ?>"  />
<input type="hidden" value="<?php echo $my_connector->IntegrationID ?>" id="hc_hidden_this_connector_id<?php echo $rand_id ?>" />
<input type="hidden" value="<?php echo $lightbox_options->cookie_enable ?>" id="hc_hidden_cookie_enable<?php echo $rand_id ?>" class="hc_hidden_cookie_enable"/>
<input type="hidden" value="<?php echo $lightbox_options->cookie_life ?>" id="hc_hidden_cookie_life<?php echo $rand_id ?>" class="hc_hidden_cookie_life"/>
<input type="hidden" value="<?php echo $lightbox_options->fadein_enable ?>" id="hc_hidden_fadein_enable<?php echo $rand_id ?>" class="hc_hidden_fadein_enable"/>
<input type="hidden" value="<?php echo $lightbox_options->time_enable ?>" id="hc_hidden_time_enable<?php echo $rand_id ?>" class="hc_hidden_time_enable"/>
<input type="hidden" value="<?php echo $lightbox_options->scroll_enable ?>" id="<?php echo $rand_id ?>" class="hc_hidden_scroll_enable_<?php echo $rand_id ?>"/>
<input type="hidden" value="<?php echo $lightbox_options->scroll_size ?>" id="hc_hidden_scroll_size_<?php echo $rand_id ?>" class="hc_hidden_scroll_size_<?php echo $rand_id ?>"/>
<input type="hidden" value="<?php echo $lightbox_options->optin_on_time?>" id="optin_on_time<?php echo $rand_id ?>" class="hc_optin_on_time" />
<input type="hidden" value="<?php echo $lightbox_options->optin_time_enable?>" id="optin_time_enable<?php echo $rand_id ?>" class="hc_optin_time_enable" />
<input type="hidden" value="<?php echo $lightbox_options->optin_scroll_enable?>" id="optin_scroll_enable<?php echo $rand_id ?>" class="hc_hidden_scroll_enable_optin_<?php echo $rand_id ?>" />
<input type="hidden" value="<?php echo $lightbox_options->optin_scroll_size?>" id="hc_hidden_scroll_size_optin_<?php echo $rand_id ?>" class="hc_hidden_scroll_size_optin_<?php echo $rand_id ?>" />
<input type="hidden" value="<?php echo $lightbox_options->optin_slide_in_from?>" id="optin_slide_in_from<?php echo $rand_id ?>" class="hc_optin_slide_in_from" />
<input type="hidden" value="<?php echo $lightbox_options->optin_slide_in_distance?>" id="optin_slide_in_distance<?php echo $rand_id ?>" class="hc_optin_slide_in_distance" />
<input type="hidden" value="<?php echo $lightbox_options->optin_start_pos_attribute?>" id="optin_start_pos_attribute<?php echo $rand_id ?>" class="hc_optin_start_pos_attribute" />
<input type="hidden" value="<?php echo $lightbox_options->optin_start_pos_value?>" id="optin_start_pos_value<?php echo $rand_id ?>" class="hc_optin_start_pos_value" />
<input type="hidden" value="<?php echo $lightbox_options->optin_ani_duration?>" id="optin_ani_duration<?php echo $rand_id ?>" class="hc_optin_ani_duration" />
<input type="hidden" value="<?php echo $lightbox_options->activated?>" id="lightboxActivated<?php echo $rand_id ?>" />
<input type="hidden" value="<?php echo $lightbox_options->optin_activated?>" id="optinActivated<?php echo $rand_id ?>" />
<input type="hidden" id="<?php echo $lightboxOrOptin; ?>" />
<input type="hidden" id="islightbox<?php echo $rand_id ?>" value="1" />
<input type="hidden" value="<?php echo $lightboxOrOptin; ?>" id="lightbox_or_optin<?php echo $rand_id ?>" class="hc_lightbox_or_optin" />
<input type="hidden" id="hc_hidden_default_template<?php echo $rand_id ?>" class="hc_hidden_default_template" value="0" />
<input class="hc_hidden_post_id" value="<?php echo the_ID() ?>" type="hidden" />
<input type="hidden" id="hc_hidden_fb_ajaxnonce" value="<?php echo $hc_ajax_nonce ?>" />
<input type="hidden" class="hc_hidden_rand_id<?php echo $my_connector->IntegrationID ?><?php if($lightboxOrOptin=="optin")echo "o"; ?>" value="<?php echo $rand_id ?>" />
<div class="hc_template_lightbox_popup" id="hc_template_lightbox_popup<?php echo $rand_id ?>" style="display:none">
    <div id="hc_template_wrapper<?php echo $rand_id ?>" class="hc_template_frontend_wrapper" style="display:none; <?php if ($hc_is_footer): ?>margin-bottom: 15px;<?php endif ?>">
        <div style="width:<?php echo $my_connector->custom_width?>px;" id="hc_shortcode_form<?php echo $rand_id ?>" class="connectorWrapper emailConnectorWrapper hc_shortcode_form<?php echo $rand_id ?> connectorWrapper<?php echo $rand_id ?>">
            <a class="lightbox-close" id="hc_lightbox_close<?php echo $rand_id ?>" href="#"></a>
            <input type="hidden" class="hc_hidden_connector_id" value="<?php echo $my_connector->IntegrationID ?>" />
            <input type="hidden" class="hc_hidden_connector_randid" value="<?php echo $rand_id ?>" />
            <?php echo html_entity_decode(stripslashes_deep($my_connector->custom_form)) ?>
        </div>
        <div style="width:<?php echo $my_connector->custom_width?>px;" id="hc_shortcode_facebook<?php echo $rand_id ?>" class="hc_shortcode_facebook<?php echo $rand_id ?>">
            <div style="width:<?php echo $my_connector->custom_width?>px;" id="hc_facebook_not_connected<?php echo $rand_id ?>" class="connectorWrapper facebookConnectorWrapper hc_facebook_not_connected<?php echo $rand_id ?> connectorWrapper<?php echo $rand_id ?>">
                <a class="lightbox-close" id="hc_lightbox_close<?php echo $rand_id ?>" href="#"></a>
                <input type="hidden" class="hc_hidden_connector_randid" value="<?php echo $rand_id ?>" />
                <input type="hidden" class="hc_hidden_connector_id" value="<?php echo $my_connector->IntegrationID ?>" />
                <?php echo html_entity_decode(stripslashes_deep($my_connector->custom_fbnot)) ?>
            </div>
            <div style="width:<?php echo $my_connector->custom_width?>px;" id="hc_facebook_connected<?php echo $rand_id ?>" class="connectorWrapper oneClickConnectorWrapper hc_facebook_connected<?php echo $rand_id ?> connectorWrapper<?php echo $rand_id ?>">
                <a class="lightbox-close" id="hc_lightbox_close<?php echo $rand_id ?>" href="#"></a>
                <input type="hidden" class="hc_hidden_connector_id" value="<?php echo $my_connector->IntegrationID ?>" />
                <input type="hidden" class="hc_hidden_connector_randid" value="<?php echo $rand_id ?>" />
                <?php echo html_entity_decode(stripslashes_deep($my_connector->custom_fbyes)) ?>
            </div>
        </div>
    </div>
</div>
<?php if (in_array($hc_theme_name, $hc_problem_themes) && $style_connector->type == 0): ?>[/raw]<?php endif?>