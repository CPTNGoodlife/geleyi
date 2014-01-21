<?php
$hc_ajax_nonce = wp_create_nonce("hyconspecialsecurityforajaxstring");
$facebookButtonSize = $style_button->fb_button_size;
if ($style_text->headline_shadow == 1 || $style_text->cta_shadow == 1 || $style_text->text_shadow == 1) {
    $textShadowSetting = $style_text->text_h_Shadow . " " . $style_text->text_v_Shadow . " " . $style_text->text_blur_shadow . " " . $style_text->text_shadow_color;
}
?>
<script type="text/javascript">
    var hc_shortcode_connector = <?php echo json_encode($my_connector); ?>;
    hc_connectors.push(hc_shortcode_connector);
    var hc_rand_id = <?php echo $rand_id ?>;
    hc_rand_ids.push(hc_rand_id);
</script>

<style type="text/css">
    #hc_template_wrapper<?php echo $rand_id ?> p strong {
        color: <?php echo $style_text->border_font_color ?> !important;
    }

    .hc_frontend_ajax_loading {
        display: none !important;
    }
    #hc_template_wrapper<?php echo $rand_id ?> {
        /* font-family:verdana;         */
        font-size:12px;
        line-height: 140%;
        height: auto;
        margin-top: <?php echo $style_connector->external_top_margin; ?>;
        margin-bottom:<?php echo $style_connector->external_bottom_margin; ?>;
        /* if squeeze page, fix position to middle of screen */

        <?php
        if ($isSqueezePage) {
            if ($squeeze_options->centre_aligned) {
                $halfTopMargin = ($style_connector->set_heights == 1) ? intval(preg_replace("/[^0-9]/", '', $style_connector->eoh)) / 2 : intval(preg_replace("/[^0-9]/", '', $style_connector->opt_in_box_height)) / 2;
                $halfLeftMargin = intval(preg_replace("/[^0-9]/", '', $style_connector->opt_in_box_width)) / 2;
                echo "position:fixed; top:50%; left:50%; margin-left:-" . $halfLeftMargin . "px; margin-top: -" . $halfTopMargin . "px;";
            } else {
                echo "margin-top:" . $squeeze_options->vertical_top_margin;
            }
        }
        ?>
    }

    #poweredBy<?php echo $rand_id ?> {
        width:<?php echo $style_connector->opt_in_box_width ?>;
        text-align:left;
        margin:0px auto;
    }

    #hc_template_wrapper<?php echo $rand_id ?> div {
        line-height: 140%;
    }
    #hc_template_wrapper<?php echo $rand_id ?> .navButton {

        /* button font size and padding settings from slider */
        padding-left: <?php echo $style_button->button_lr_padding; ?>;
        padding-right: <?php echo $style_button->button_lr_padding; ?>;
        padding-top: <?php echo $style_button->button_tb_padding; ?>;
        padding-bottom: <?php echo $style_button->button_tb_padding; ?>;
        font-size: <?php echo $style_button->button_font_size; ?>;
        -moz-box-shadow:inset 0px 1px 0px 0px <?php echo $style_button->btn_box_shadow ?>;
        -webkit-box-shadow:inset 0px 1px 0px 0px <?php echo $style_button->btn_box_shadow ?>;
        box-shadow:inset 0px 1px 0px 0px <?php echo $style_button->btn_box_shadow ?>;
        -moz-border-radius:6px;
        -webkit-border-radius:6px;
        border-radius:6px;
        border:1px solid <?php echo $style_button->btn_border_color ?>;
        display:inline-block;
        color:<?php echo $style_button->btn_font_color ?> !important;
        font-family:<?php echo $style_button->btn_font_family ?>;
        font-weight:bold;
        text-decoration:none;
        text-shadow:1px 1px 0px <?php echo $style_button->txt_shadow_color ?>;
        margin-bottom:5px;
        background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, <?php echo $style_button->btn_bg_light ?> ), color-stop(1, <?php echo $style_button->btn_bg_color ?> ) );
        background:-moz-linear-gradient( center top, <?php echo $style_button->btn_bg_light ?> 5%, <?php echo $style_button->btn_bg_color ?>  100% );
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $style_button->btn_bg_color ?>', endColorstr='<?php echo $style_button->btn_bg_light ?>');
        background-color:<?php echo $style_button->btn_bg_color ?>;
        line-height: 140%;

    }
    #hc_template_wrapper<?php echo $rand_id ?> .navButton:hover {
        background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, <?php echo $style_button->btn_bg_light ?>), color-stop(1, <?php echo $style_button->btn_bg_light ?>) );
        background:-moz-linear-gradient( center top, <?php echo $style_button->btn_bg_light ?> 5%, <?php echo $style_button->btn_bg_light ?> 100% );
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $style_button->btn_bg_light ?>', endColorstr='<?php echo $style_button->btn_bg_light ?>');
        background-color:<?php echo $style_button->btn_bg_color ?>;
    }
    #hc_template_wrapper<?php echo $rand_id ?> input[type="text"] {

        border-collapse: collapse;
        margin:2px 5px 5px 5px;
        line-height:18px;
        font-size:<?php echo $style_optin->field_font_size; ?>;
        height: <?php echo $style_optin->field_height; ?>;
        padding-top:<?php echo $style_optin->field_padding_top_bottom; ?>;
        padding-bottom:<?php echo $style_optin->field_padding_top_bottom; ?>;
        padding-left:<?php echo $style_optin->field_padding_left_right; ?>;
        padding-right:<?php echo $style_optin->field_padding_left_right; ?>;
        border-width: <?php echo $style_optin->field_border_width; ?>;
        border-style: <?php echo $style_optin->field_border_style; ?>;
        border-radius:<?php echo $style_optin->field_border_radius; ?>;
        /* line-height: 30px; */
        box-sizing: border-box;
        display: inline !important;
        box-shadow: none;
        -moz-box-sizing: border-box;
    }
    #hc_template_wrapper<?php echo $rand_id ?> p {
        line-height: 140% !important;
        font-size: <?php echo $style_text->border_font_size ?> !important;
        color : <?php echo $style_text->border_font_color ?>;
        font-family: <?php echo $style_text->border_font_family ?>;
        margin-bottom: 5px;
        padding:0px;
        <?php if ($style_text->body_center == 1): ?>text-align: center;<?php else: ?> text-align:left;<?php endif ?>
        <?php if ($style_text->text_shadow == 1): ?>text-shadow:<?php echo $textShadowSetting; ?>;<?php else: ?>text-shadow:none; <?php endif ?>
    }
    #hc_template_wrapper<?php echo $rand_id ?> .optinWrapper iframe {
         width: 100% !important;
        background: transparent !important;
        padding:0px !important;
        margin:0px !important;
    }
    #hc_template_wrapper<?php echo $rand_id ?> p.connectorHeadline {
        line-height: 1.2em !important;
        margin-bottom: 10px !important;
        padding-top: <?php echo $style_text->text_vertical_position; ?> !important;
        <?php if ($style_text->headline_center == 1): ?>text-align: center;<?php endif ?>
        <?php if ($style_text->headline_shadow == 1): ?>text-shadow:<?php echo $textShadowSetting; ?>;<?php else: ?>text-shadow:none; <?php endif ?>
        <?php if ($style_text->headline_bold == 1): ?>font-weight: bold;<?php endif ?>
        margin-left:<?php echo $style_text->headline_left_margin; ?> !important;
        margin-right: <?php echo $style_text->headline_right_margin; ?> !important;
        margin-top:5px !important;
        padding-left:0px !important;
        padding-bottom:0px !important;
        padding-right:0px !important;
    }
    #hc_template_wrapper<?php echo $rand_id ?> ul {
        margin-left: <?php echo $style_text->bullet_left_margin; ?> !important;
        padding: 0 !important;
        margin-top:20px !important;
        border:0px !important;
        margin-bottom:20px !important;
        font-size: <?php echo $style_text->border_font_size ?>;
        width:auto !important;
        text-align:left !important;
    }
    #hc_template_wrapper<?php echo $rand_id ?> ul li {
        margin: 0 !important;
        padding: 2px 0 2px 35px !important;
        list-style: none;
        background: url('<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/ticks/<?php echo $style_text->tick_style ?>.png') no-repeat top left !important;
        line-height:140%;
        color: <?php echo $style_text->border_font_color ?>;
        font-family:<?php echo $style_text->border_font_family ?>;
        border-bottom:0px;
        border-top:0px;
        font-size: <?php echo $style_text->border_font_size ?>;
        list-style-type: none !important;
        <?php if ($style_text->text_shadow == 1): ?>text-shadow:<?php echo $textShadowSetting; ?>;<?php else: ?>text-shadow:none;<?php endif ?>
        background-size: <?php echo $style_connector->bulletpointsize; ?> !important;
        background-position-y: <?php echo $style_connector->bulletpointoffset; ?> !important;
        background-position-x: <?php echo $style_connector->bulletpointoffsetx; ?> !important;
    }

    #hc_template_wrapper<?php echo $rand_id ?> img {
        background:transparent;
    }
    #hc_template_wrapper<?php echo $rand_id ?> img.leftArrow {
        padding: 0px;
        margin-right:10px;
        border:0px;
        background:transparent;
        float:left;
        <?php if ($style_image->show_arrow_graphics == 0): ?>display:none !important;<?php endif ?>
    }
    #hc_template_wrapper<?php echo $rand_id ?> img.rightArrow {
        padding: 0px;
        margin:0px;
        border:0px;
        background:transparent;
        float:right;
        margin-left:10px;
        <?php if ($style_image->show_arrow_graphics == 0): ?>display:none !important;<?php endif ?>
    }
    #hc_template_wrapper<?php echo $rand_id ?> img.optinGraphic {
        z-index: 100;
        position: relative;
        display: block;
        width: <?php echo $style_image->image_size; ?>;
    }
    div.graphicWrapper<?php echo $rand_id ?> {
        float:right;
        position:relative;
        <?php if ($style_image->show_side_image != 1): ?>display:none;<?php endif ?>
        margin-left:<?php echo $style_image->image_left_margin ?> !important;
        margin-right:<?php echo $style_image->image_right_margin ?> !important;
        margin-top: <?php echo $style_image->vertical_position ?> !important;
        display:block;
    }
    img.optinGraphic {
        border:0px !important;
        margin:0px !important;
        padding:0px !important;
    }
    img.leftArrowFacebook {
        margin-right:5px !important;
    }
    div.connectorWrapper<?php echo $rand_id ?> {
        
        border:<?php echo $style_connector->border_width ?> <?php echo $style_connector->border_style; ?> <?php echo $style_connector->border_color ?> !important;
        /* if radius set*/
        <?php if ($style_connector->border_radius != ""): ?>border-radius:<?php echo $style_connector->border_radius; ?>;<?php endif ?>
        /* if not gradient then use background colour selector */
        <?php if ($style_connector->template_gradient != "1"): ?>background:<?php echo $style_connector->tpl_bg_color ?>;<?php endif ?>
        font-size:12px;
        /* if gradient selected then apply gradient CSS */
        <?php if ($style_connector->template_gradient != "0"): ?>
            background: -moz-linear-gradient(top,  <?php echo $style_connector->template_bgcolor_1 ?> 0%, <?php echo $style_connector->template_bgcolor_2 ?> 100%); /* FF3.6+ */
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $style_connector->template_bgcolor_2 ?>), color-stop(100%,<?php echo $style_connector->template_bgcolor_1 ?>)); /* Chrome,Safari4+ */
            background: -webkit-linear-gradient(top,  <?php echo $style_connector->template_bgcolor_1 ?> 0%,<?php echo $style_connector->template_bgcolor_2 ?> 100%); /* Chrome10+,Safari5.1+ */
            background: -o-linear-gradient(top,  <?php echo $style_connector->template_bgcolor_1 ?> 0%,<?php echo $style_connector->template_bgcolor_2 ?> 100%); /* Opera 11.10+ */
            background: -ms-linear-gradient(top,  <?php echo $style_connector->template_bgcolor_1 ?> 0%,<?php echo $style_connector->template_bgcolor_2 ?> 100%); /* IE10+ */
            background: linear-gradient(to bottom,  <?php echo $style_connector->template_bgcolor_1 ?> 0%,<?php echo $style_connector->template_bgcolor_2 ?> 100%); /* W3C */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $style_connector->template_bgcolor_1 ?>', endColorstr='<?php echo $style_connector->template_bgcolor_2 ?>',GradientType=0 ); /* IE6-8 */
        <?php endif ?>

        <?php if ($style_connector->template_picturebg != 0): ?>background-image:url('<?php echo $style_connector->template_picturebgurl; ?>'); background-repeat:no-repeat;<?php endif ?>

        <?php if ($style_connector->template_transparent_bg == 1): ?>background-color:transparent;<?php else: ?> background-color: <?php echo $style_connector->tpl_bg_color; ?>;<?php endif ?>

        /* box shadow CSS */
        border-collapse:separate;
        <?php if ($style_connector->drop_shadow == 1): ?>
            box-shadow: <?php echo $style_connector->h_shadow . " " . $style_connector->v_shadow . " " . $style_connector->blur_shadow . " " . $style_connector->shadow_color; ?>;
            -moz-box-shadow: <?php echo $style_connector->h_shadow . " " . $style_connector->v_shadow . " " . $style_connector->blur_shadow . " " . $style_connector->shadow_color; ?>;
            -webkit-box-shadow: <?php echo $style_connector->h_shadow . " " . $style_connector->v_shadow . " " . $style_connector->blur_shadow . " " . $style_connector->shadow_color; ?>;
        <?php endif ?>

    }
    #hc_template_wrapper<?php echo $rand_id ?> div.optinWrapper<?php echo $rand_id ?> {
        <?php if ($style_connector->border_radius != ""): ?>border-bottom-left-radius:<?php echo $style_connector->border_radius; ?>;<?php endif ?>
        <?php if ($style_connector->border_radius != ""): ?>border-bottom-right-radius:<?php echo $style_connector->border_radius; ?>;<?php endif ?>
        background-color: <?php if ($style_connector->template_transparent_optin_bg == 1) : ?>transparent;<?php else: echo $style_connector->opt_in_bg_color; ?>;<?php endif ?>
    }

    #hc_template_wrapper<?php echo $rand_id ?> div.connectorDescriptionText<?php echo $rand_id ?> {
        <?php if ($style_text->body_center == 1): ?>text-align: center;<?php endif ?>
    }

    #hc_template_wrapper<?php echo $rand_id ?> div.connectorDescriptionText<?php echo $rand_id ?> p {
        margin-bottom: 5px;
        margin-top:5px;
        margin-left:<?php echo $style_text->text_left_margin; ?>;
        margin-right:<?php echo $style_text->text_right_margin; ?>;
        padding:0px;
    }


    #hc_template_wrapper<?php echo $rand_id ?> p.connectorCallToAction {
        <?php if ($style_text->cta_shadow == 1): ?>text-shadow:<?php echo $textShadowSetting; ?>;<?php else: ?>text-shadow:none; <?php endif ?>
        padding:0px;
    }

    #hc_template_wrapper<?php echo $rand_id ?> div.optinPosition<?php echo $rand_id ?> {
        <?php if ($style_optin->email_centered == 1): ?>margin-left:auto !important; margin-right:auto !important;<?php endif ?>
    }
    #hc_template_wrapper<?php echo $rand_id ?> div.facebookPosition<?php echo $rand_id ?> {
        <?php if ($style_optin->fb_centered == 1): ?>margin-left:auto !important; margin-right:auto !important; <?php else: ?>margin-left:5px; margin-right:5px; <?php endif ?>
    }
    #hc_template_wrapper<?php echo $rand_id ?> div.oneClickPosition<?php echo $rand_id ?> {
        <?php if ($style_optin->oneclick_centered == 1): ?>margin-left:auto !important; margin-right:auto !important;<?php else: ?>margin-left:5px; margin-right:5px; <?php endif ?>
    }

    #hc_template_wrapper<?php echo $rand_id ?> div.optinPositionInput<?php echo $rand_id ?> {
        <?php if ($style_optin->email_centered != 1): ?>text-align:left;<?php else: ?>text-align:center;<?php endif ?>
    }

    #hc_template_wrapper<?php echo $rand_id ?> div.emailInputField<?php echo $rand_id ?> {
        <?php if ($style_button->emailNewLine == 1): ?>display:block;<?php else: ?>display:inline;<?php endif ?>
    }

    #hc_template_wrapper<?php echo $rand_id ?> div.emailButtonContainer<?php echo $rand_id ?> {
        <?php if ($style_button->buttonNewLine == 1): ?>display:block;<?php else: ?>display:inline;<?php endif ?>
        <?php if ($style_optin->email_centered != 1): ?>text-align:left;<?php else: ?>text-align:center;<?php endif ?>
    }

    #hc_template_wrapper<?php echo $rand_id ?> .ppWrapper {
        <?php if ($style_connector->show_privacy_policy == 1): ?>display:block;<?php else: ?>display:none;<?php endif ?>
    }

    #hc_template_wrapper<?php echo $rand_id ?> .privacyPolicy {
        padding-left:10px;
        padding-right:10px;
        <?php if ($style_connector->center_privacy_policy == 1): ?>margin:0px auto;<?php else: ?>margin-left:5px;<?php endif ?>
        text-shadow:none;
    }



    #hc_template_wrapper<?php echo $rand_id ?> .privacyPolicy span {
        <?php if ($style_connector->bold_privacy_policy == 1): ?>font-weight:bold;<?php else: ?>font-weight:normal;<?php endif ?>
        font-family: <?php echo $style_connector->privacy_policy_font; ?>;
        font-size: <?php echo $style_connector->privacy_policy_size; ?>;
        color: <?php echo $style_connector->privacy_policy_color; ?>;
        margin-top:10px;
        margin-bottom:0px;
        margin-left:0px;
        margin-right:0px;
        line-height:25px;
    }


    #hc_template_wrapper<?php echo $rand_id ?> .privacyPolicy img {
        vertical-align:middle;
    }

    #hc_template_wrapper<?php echo $rand_id ?> .privacyPolicyEmail {
        margin-top:<?php echo $style_connector->email_privacy_top_margin; ?>;
    }

    #hc_template_wrapper<?php echo $rand_id ?> .privacyPolicyFacebook {
        margin-top:<?php echo $style_connector->facebook_privacy_top_margin; ?>;
    }

    #hc_template_wrapper<?php echo $rand_id ?> .privacyPolicyOneClick {
        margin-top:<?php echo $style_connector->oneclick_privacy_top_margin; ?>;
    }

    /*************************************************************************************************
    SQUEEZE PAGE STYLES
    /* if squeeze page then apply styles */
    <?php if ($isSqueezePage) { ?>

        html {
            padding:0px !important;
            margin:0px !important;
        }

        body {
            padding:0px;
            margin:0px;

            <?php
            echo "background-color:" . $squeeze_options->squeeze_bg_color . ";";

            if ($squeeze_options->squeeze_gradient_checkbox == "1") {
                ?>

                background: -moz-linear-gradient(top,  <?php echo $squeeze_options->squeeze_gradient_color1 ?> 0%, <?php echo $squeeze_options->squeeze_gradient_color2 ?> 100%); /* FF3.6+ */
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $squeeze_options->squeeze_gradient_color2 ?>), color-stop(100%,<?php echo $squeeze_options->squeeze_gradient_color1 ?>)); /* Chrome,Safari4+ */
                background: -webkit-linear-gradient(top,  <?php echo $squeeze_options->squeeze_gradient_color1 ?> 0%,<?php echo $squeeze_options->squeeze_gradient_color2 ?> 100%); /* Chrome10+,Safari5.1+ */
                background: -o-linear-gradient(top,  <?php echo $squeeze_options->squeeze_gradient_color1 ?> 0%,<?php echo $squeeze_options->squeeze_gradient_color2 ?> 100%); /* Opera 11.10+ */
                background: -ms-linear-gradient(top,  <?php echo $squeeze_options->squeeze_gradient_color1 ?> 0%,<?php echo $squeeze_options->squeeze_gradient_color2 ?> 100%); /* IE10+ */
                background: linear-gradient(to bottom,  <?php echo $squeeze_options->squeeze_gradient_color1 ?> 0%,<?php echo $squeeze_options->squeeze_gradient_color2 ?> 100%); /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $squeeze_options->squeeze_gradient_color1 ?>', endColorstr='<?php echo $squeeze_options->squeeze_gradient_color2 ?>',GradientType=0 ); /* IE6-8 */
                background-image:none;
            <?php } ?>

            <?php
            if ($squeeze_options->squeeze_picture_checkbox) {
                if (!$squeeze_options->repeat_y_axis && !$squeeze_options->repeat_x_axis && !$squeeze_options->squeeze_tile) {
                    ?>
                    background-image:url('<?php echo $squeeze_options->squeeze_bgimage_url ?>');
                    background-image:no-repeat;
                    background: url('<?php echo $squeeze_options->squeeze_bgimage_url ?>') no-repeat center center fixed;
                    -webkit-background-size: cover;
                    -moz-background-size: cover;
                    -o-background-size: cover;
                    background-size: cover;
                <?php } else { ?>
                    background-image:url('<?php echo $squeeze_options->squeeze_bgimage_url ?>');
                    <?php
                    if ($squeeze_options->squeeze_tile) {
                        $bgRepeat = "repeat";
                    }
                    if ($squeeze_options->repeat_x_axis) {
                        $bgRepeat = "repeat-x";
                    }
                    if ($squeeze_options->repeat_y_axis) {
                        $bgRepeat = "repeat-y";
                    }
                    ?>
                    background-repeat:<?php echo $bgRepeat; ?>;
                    <?php
                }
            } else {
                echo "background-image:none;";
            }
            ?> }
      <?php  } ?>

    /**********************
    END OF SQUEEZE PAGE STYLES  */
</style>
<!--[if  ie 9]>
<style type="text/css" media="screen">
   #hc_template_wrapper<?php echo $rand_id ?> .navButton
    {
        border-radius: 0px !important;
    }
#hc_template_wrapper<?php echo $rand_id ?> .navButton:hover
    {
        border-radius: 0px !important;
    }
</style>
<![endif]-->

<div style="display:none;" id="apiFlag<?php echo $rand_id ?>"><?php echo $my_connector->apiConnection; ?></div>
<div style="position:absolute; top:-1000px; left:-1000px; z-index:300;" id="customsubmit<?php echo $rand_id ?>"><?php echo $my_connector->custom_code; ?></div>
<input type="hidden" id="hc_hidden_emailonly<?php echo $rand_id ?>" class="hc_hidden_default_template" value="<?php echo $my_connector->emailOnly ?>" />
<input type="hidden" id="hc_hidden_default_template<?php echo $rand_id ?>" class="hc_hidden_default_template" value="<?php echo $style_connector->default_template ?>" />
<input type="hidden" id="hc_hidden_is_responsive<?php echo $rand_id ?>" class="hc_hidden_is_responsive" value="<?php echo $style_connector->is_responsive ?>" />
<input type="hidden" id="hc_hidden_img_min_width<?php echo $rand_id ?>" class="hc_hidden_img_min_width" value="<?php echo $style_image->min_width ?>" />
<input type="hidden" id="hc_hidden_img_min_height<?php echo $rand_id ?>" class="hc_hidden_img_min_height" value="<?php echo $style_image->min_height ?>" />
<input type="hidden" id="hc_hidden_img_max_width<?php echo $rand_id ?>" class="hc_hidden_img_max_width" value="<?php echo $style_image->max_width ?>" />
<input type="hidden" id="hc_hidden_img_max_height<?php echo $rand_id ?>" class="hc_hidden_img_max_height" value="<?php echo $style_image->max_height ?>" />
<input type="hidden" id="hc_hidden_con_min_width<?php echo $rand_id ?>" class="hc_hidden_con_min_width" value="<?php echo $style_connector->min_width ?>" />
<input type="hidden" id="hc_hidden_con_max_width<?php echo $rand_id ?>" class="hc_hidden_con_max_width" value="<?php echo $style_connector->max_width ?>" />
<input type="hidden" id="islightbox<?php echo $rand_id ?>" value="0" />
<input class="hc_hidden_post_id" value="<?php echo the_ID() ?>" type="hidden" />
<input type="hidden" id="hc_hidden_fb_ajaxnonce" value="<?php echo $hc_ajax_nonce ?>" />
<input type="hidden" id="hc_hidden_variation_id<?php echo $rand_id ?>" class="hc_hidden_variation_id" value="<?php echo $variation->id ?>" />
<input type="hidden" id="hc_hidden_is_testing<?php echo $rand_id ?>" class="hc_hidden_is_testing" value="<?php echo $tpl_type->testing ?>" />
<div id="hc_notification<?php echo $rand_id ?>" class="hc_notification" style="display:none; width:100%; z-index:1500000;"></div>

<div style="clear:both;"></div>

<div id="hc_template_wrapper<?php echo $rand_id ?>" class="hc_template_frontend_wrapper" style="display:none; clear:both;">    
    <?php
    $box_height = ($style_connector->set_heights == 1) ? $style_connector->eoh : $style_connector->opt_in_box_height;
    $action_height = ($style_connector->set_heights == 1) ? $style_connector->ech : $style_connector->call_action_height;
    ?>
    <div id="hc_shortcode_form<?php echo $rand_id ?>" style="width:<?php if($style_connector->is_responsive=="1") { echo "100%"; } else { echo $style_connector->opt_in_box_width; } ?>; height:<?php if ($style_connector->is_responsive=="1") { echo "100%"; } else { echo $box_height; } ?>; position:relative; margin-left:auto; margin-right:auto;" class="connectorWrapper emailConnectorWrapper hc_shortcode_form<?php echo $rand_id ?> connectorWrapper<?php echo $rand_id ?>">
        <input type="hidden" class="hc_hidden_connector_id" value="<?php echo $my_connector->IntegrationID ?>" />       
        <input type="hidden" class="hc_hidden_variation_id" value="<?php echo $variation->id ?>" />
        <input type="hidden" class="hc_hidden_connector_randid" value="<?php echo $rand_id ?>" />
        <div class="graphicWrapper<?php echo $rand_id ?>">
            <?php if ($style_image->show_side_image == 1): ?>
                <img src="<?php echo $style_image->image_url ?>" style="float: right; z-index: 100; position: relative; display: block;" class="optinGraphic optinGraphic<?php echo $rand_id ?>">
            <?php endif ?><div id="sideOptinPosition<?php echo $rand_id ?>"></div></div>
        <p class="connectorHeadline" style="font-family:<?php echo $style_text->headline_font_family ?> !important; color:<?php echo $style_text->headline_font_color ?> !important; font-size:<?php echo $style_text->headline_font_size ?> !important;">
            <?php echo $connector_txt->optin_headline ?>
        </p>
        <div class="connectorDescriptionText connectorDescriptionText<?php echo $rand_id ?>" style="color:<?php echo $style_text->border_font_color ?>; font-family:<?php echo $style_text->border_font_family ?>; font-size:<?php echo $style_text->border_font_size ?>;font-weight:normal; ">
            <?php echo $connector_txt->optin_description ?>
        </div>
        <br />
        <div style="position:absolute; bottom: 0; height:<?php echo $action_height ?>; width:100%; z-index: 3; text-align:<?php if ($style_optin->email_centered == 1): ?>center<?php else: ?>left<?php endif ?>;" class="optinWrapper emailOptinWrapper<?php echo $rand_id ?> optinWrapper<?php echo $rand_id ?>">
            <p class="connectorCallToAction emailCallToAction" style="font-size:<?php echo $style_text->call_action_font_size ?> !important; margin-bottom:5px !important; margin-left:10px !important; margin-top:15px !important; margin-right:10px !important; text-align:<?php if ($style_optin->email_centered == 1): ?>center<?php else: ?>left<?php endif ?> !important; font-family:<?php echo $style_text->call_action_font_family ?> !important; color:<?php echo $style_text->call_action_font_color ?> !important;"><?php echo $connector_txt->email_call ?></p>
            <div class="optinPosition<?php echo $rand_id ?>" style="display:table; overflow:hidden; padding:0px; text-align:inherit; ">
                <div class="optinPositionRow<?php echo $rand_id ?>" style="display:table-row;">
                    <div class="optinPositionLeftArrow<?php echo $rand_id ?>" style="display:table-cell;">
                        <img src="<?php echo $style_image->arrow_style ?>l.png" style="<?php if ($style_image->show_arrow_graphics == 0): ?>display:none;<?php endif ?>" class="leftArrow leftArrowEmail">
                    </div>
                    <div class="optinPositionInput<?php echo $rand_id ?>" style="display:table-cell; vertical-align:top;">
                        <div style=" <?php if ($my_connector->emailOnly=="1") { ?>display:none !important;<?PHP } else {?> display:inline;<?php } ?>"><input value="<?php echo $style_email->name_label_field ?>" id="hc_txt_name<?php echo $rand_id ?>" class="nameConnectorInputField connectorInputFields" name="nameField" style="width: <?php echo $style_optin->name_length ?>; clear: both; border-color: <?php echo $style_email->input_border_color ?>; background: none repeat scroll 0 0 <?php echo $style_email->input_bg_color ?>; font-family: <?php echo $style_email->input_font_family ?>; color: <?php echo $style_email->input_font_color ?>" onfocus="if (this.value == '<?php echo $style_email->name_label_field ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $style_email->name_label_field ?>';}" type="text"></div>
                        <div class="emailInputField<?php echo $rand_id ?>"><input value="<?php echo $style_email->email_label_field ?>" id="hc_txt_email<?php echo $rand_id ?>" class="emailConnectorInputField connectorInputFields" name="emailField" style="width: <?php echo $style_optin->email_length ?>; clear: both; border-color: <?php echo $style_email->input_border_color ?>; background: none repeat scroll 0 0 <?php echo $style_email->input_bg_color ?>; font-family: <?php echo $style_email->input_font_family ?>; color: <?php echo $style_email->input_font_color ?>" onfocus="if (this.value == '<?php echo $style_email->email_label_field ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $style_email->email_label_field ?>';}" type="text"></div>
                        <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/ajax-loader.gif" id="hc_ajax_email<?php echo $rand_id ?>" class="hc_frontend_ajax_loading" />
                        <div class="emailButtonContainer<?php echo $rand_id ?>"><a href="#" class="navButton hc_form_connector_submit" id="hc_emailSignUpButton<?php echo $rand_id ?>" style="margin-top: 4px; text-align: center; clear: both;"><?php echo $connector_txt->email_btn ?></a></div>
                    </div>
                    <div class="optinPositionRightArrow<?php echo $rand_id ?>" style="display:table-cell;">
                        <img src="<?php echo $style_image->arrow_style ?>r.png" style="float: right; <?php if ($style_image->show_arrow_graphics == 0): ?>display:none;<?php endif ?>" class="rightArrow rightArrowEmail">
                    </div>
                </div>
            </div>
            <div class="ppWrapper"><div class="privacyPolicy privacyPolicyEmail" style="vertical-align:middle; display:table"><div style="display:table-row;" class="ppRow"><div style="display:table-cell; vertical-align:middle"><img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/lock-icon.png" align="<?php if ($style_connector->center_privacy_policy == 1): ?>center<?php else: ?>left<?php endif ?>" style="vertical-align:middle; display:inline; width:25px; height:25px;"/></div><div style="display:table-cell;"><span style="vertical-align:middle; display:inline;"><?php echo $connector_txt->privacy_policy_text; ?></span></div></div></div></div>
        </div>
    </div>
    <div id="hc_shortcode_facebook<?php echo $rand_id ?>" class="hc_shortcode_facebook<?php echo $rand_id ?>" style="width:100%;">
        <?php
        $box_height = ($style_connector->set_heights == 1) ? $style_connector->foh : $style_connector->opt_in_box_height;
        $action_height = ($style_connector->set_heights == 1) ? $style_connector->fch : $style_connector->call_action_height;
        ?>
        <div id="hc_facebook_not_connected<?php echo $rand_id ?>" style="width:<?php if ($style_connector->is_responsive=="1") { echo "100%"; } else { echo $style_connector->opt_in_box_width; } ?>; height:<?php if ($style_connector->is_responsive=="1") { echo "100%"; } else { echo $box_height; } ?>;  position:relative; margin-left:auto; margin-right:auto;" class="connectorWrapper facebookConnectorWrapper hc_facebook_not_connected<?php echo $rand_id ?> connectorWrapper<?php echo $rand_id ?>">
            <input type="hidden" class="hc_hidden_connector_randid" value="<?php echo $rand_id ?>" />
            <input type="hidden" class="hc_hidden_connector_id" value="<?php echo $my_connector->IntegrationID ?>" />
            <input type="hidden" class="hc_hidden_variation_id" value="<?php echo $variation->id ?>" />
            <div class="graphicWrapper<?php echo $rand_id ?>">
                <?php if ($style_image->show_side_image == 1): ?>
                    <img src="<?php echo $style_image->image_url ?>" style="float: right; z-index: 100; position: relative; display: block;" class="optinGraphic optinGraphic<?php echo $rand_id ?>">
                <?php endif ?><div id="sideFacebookPosition<?php echo $rand_id ?>"></div></div>
            <p class="connectorHeadline" style="font-family:<?php echo $style_text->headline_font_family ?> !important; color:<?php echo $style_text->headline_font_color ?> !important; font-size:<?php echo $style_text->headline_font_size ?> !important;">
                <?php echo $connector_txt->optin_headline ?>
            </p>
            <div class="connectorDescriptionText connectorDescriptionText<?php echo $rand_id ?>" style="color:<?php echo $style_text->border_font_color ?>; font-family:<?php echo $style_text->border_font_family ?>; font-size:<?php echo $style_text->border_font_size ?>; font-weight:normal; ">
                <?php echo $connector_txt->optin_description ?>
            </div>
            <br>
            <div style="position:absolute; bottom: 0; height:<?php echo $action_height ?>; width:100%; z-index: 3; text-align:<?php if ($style_optin->fb_centered == 1): ?>center<?php else: ?>left<?php endif ?>;" class="optinWrapper facebookOptinWrapper<?php echo $rand_id ?>  optinWrapper<?php echo $rand_id ?>">
                <p class="connectorCallToAction facebookCallToAction" style="font-size:<?php echo $style_text->call_action_font_size ?> !important; text-align:<?php if ($style_optin->fb_centered == 1): ?>center<?php else: ?>left<?php endif ?> !important; margin-bottom:5px !important; margin-left:10px !important; margin-top:15px !important; margin-right:10px !important; font-family:<?php echo $style_text->call_action_font_family ?> !important; color:<?php echo $style_text->call_action_font_color ?> !important;"><?php echo $connector_txt->fb_call ?></p>
                <div class="facebookPosition<?php echo $rand_id ?>" style="display:table; text-align:inherit;">
                    <div class="facebookPositionRow<?php echo $rand_id ?>" style="display:table-row;">
                        <div class="facebookPositionLeftArrow<?php echo $rand_id ?>" style="display:table-cell;">
                            <img src="<?php echo $style_image->arrow_style ?>l.png" style="float: left; margin-right: 5px; <?php if ($style_image->show_arrow_graphics == 0): ?>display:none;<?php endif ?>" class="leftArrow leftArrowFacebook">
                        </div>
                        <div class="facebookPositionInput<?php echo $rand_id ?>" style="display:table-cell; vertical-align: middle;">
                            <div style="overflow:hidden; float:left;"><div class="fb-login-button" data-scope="email" size="<?php echo $facebookButtonSize; ?>">
                                    <?php echo $connector_txt->fb_btn ?></div></div></div>
                        <div class="facebookPositionRightArrow<?php echo $rand_id ?>" style="display:table-cell;">
                            <p style="float:left; margin:0px; padding:0px;"><img src="<?php echo $style_image->arrow_style ?>r.png" style="float: left; margin-left: 5px; <?php if ($style_image->show_arrow_graphics == 0): ?>display:none;<?php endif ?>" class="rightArrow rightArrowFacebook"></p>
                        </div>
                    </div>
                </div>
                <div class="ppWrapper"><div class="privacyPolicy privacyPolicyFacebook" style="vertical-align:middle; display:table"><div style="display:table-row;" class="ppRow"><div style="display:table-cell; vertical-align:middle"><img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/lock-icon.png" align="<?php if ($style_connector->center_privacy_policy == 1): ?>center<?php else: ?>left<?php endif ?>" style="vertical-align:middle; display:inline; width:25px; height:25px;"/></div><div style="display:table-cell;"><span style="vertical-align:middle; display:inline;"><?php echo $connector_txt->privacy_policy_text; ?></span></div></div></div></div>
            </div>

        </div>
        <?php
        $box_height = ($style_connector->set_heights == 1) ? $style_connector->ooh : $style_connector->opt_in_box_height;
        $action_height = ($style_connector->set_heights == 1) ? $style_connector->och : $style_connector->call_action_height;
        ?>
        <div id="hc_facebook_connected<?php echo $rand_id ?>" style="width:<?php if ($style_connector->is_responsive=="1") { echo "100%"; } else { echo $style_connector->opt_in_box_width; } ?>; height:<?php if ($style_connector->is_responsive=="1") { echo "100%"; } else { echo $box_height; } ?>; position:relative; margin-left:auto; margin-right:auto;"  class="connectorWrapper oneClickConnectorWrapper hc_facebook_connected<?php echo $rand_id ?> connectorWrapper<?php echo $rand_id ?>">
            <input type="hidden" class="hc_hidden_connector_id" value="<?php echo $my_connector->IntegrationID ?>" />
            <input type="hidden" class="hc_hidden_connector_randid" value="<?php echo $rand_id ?>" />
            <input type="hidden" class="hc_hidden_variation_id" value="<?php echo $variation->id ?>" />
            <div class="graphicWrapper<?php echo $rand_id ?>">
                <?php if ($style_image->show_side_image == 1): ?>
                    <img src="<?php echo $style_image->image_url ?>" style="float: right; z-index: 100; position: relative; display: block;" class="optinGraphic optinGraphic<?php echo $rand_id ?>">
                <?php endif ?><div id="sideOneClickPosition<?php echo $rand_id ?>"></div></div>
            <p class="connectorHeadline" style="font-family:<?php echo $style_text->headline_font_family ?> !important; color:<?php echo $style_text->headline_font_color ?> !important; font-size:<?php echo $style_text->headline_font_size ?> !important;">
                <?php echo $connector_txt->optin_headline ?>
            </p>
            <div class="connectorDescriptionText connectorDescriptionText<?php echo $rand_id ?>" style="color:<?php echo $style_text->border_font_color ?>; font-family:<?php echo $style_text->border_font_family ?>; font-size:<?php echo $style_text->border_font_size ?>; font-weight:normal;">
                <?php echo $connector_txt->optin_description ?>
            </div>
            <br/>
            <div style="position:absolute; bottom: 0; height:<?php echo $action_height ?>; width:100%; z-index: 3; text-align:<?php if ($style_optin->oneclick_centered == 1): ?>center<?php else: ?>left<?php endif ?>;" class="optinWrapper oneClickOptinWrapper<?php echo $rand_id ?>  optinWrapper<?php echo $rand_id ?>">
                <p class="connectorCallToAction oneClickCallToAction" style="font-size:<?php echo $style_text->call_action_font_size ?> !important; margin-bottom:5px !important; text-align:<?php if ($style_optin->oneclick_centered == 1): ?>center<?php else: ?>left<?php endif ?> !important; margin-left:10px !important; margin-top:15px !important; margin-right:10px !important; font-family:<?php echo $style_text->call_action_font_family ?> !important; color:<?php echo $style_text->call_action_font_color ?> !important;"><?php echo $connector_txt->oneclick_call ?></p>
                <div class="oneClickPosition<?php echo $rand_id ?>" style="display:table; text-align:inherit;">
                    <div class="oneClickPositionRow<?php echo $rand_id ?>" style="display:table-row;">
                        <div class="oneClickPositionLeftArrow<?php echo $rand_id ?>" style="display:table-cell;">
                            <img src="<?php echo $style_image->arrow_style ?>l.png" style="float: left; margin-right:10px; <?php if ($style_image->show_arrow_graphics == 0): ?>display:none;<?php endif ?>" class="leftArrow leftArrowOneClick">
                        </div>
                        <div class="facebookPositionInput<?php echo $rand_id ?>" style="display:table-cell; vertical-align: middle;">
                            <a href="#" class="oneClickSignupButton navButton hc_fb_form_connector_submit" id="oneClickSignupButton"><?php echo $connector_txt->oneclick_btn ?></a>
                            <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/ajax-loader.gif" id="hc_ajax_email<?php echo $rand_id ?>" class="hc_frontend_ajax_loading" />
                        </div>
                        <div class="oneClickPositionRightArrow<?php echo $rand_id ?>" style="display:table-cell;">
                            <img src="<?php echo $style_image->arrow_style ?>r.png" style="float: left; margin-left: 10px; <?php if ($style_image->show_arrow_graphics == 0): ?>display:none;<?php endif ?>" class="rightArrow rightArrowOneClick">
                        </div>
                    </div>
                </div>
                <div class="ppWrapper"><div class="privacyPolicy privacyPolicyOneClick" style="vertical-align:middle; display:table"><div style="display:table-row;" class="ppRow"><div style="display:table-cell; vertical-align:middle"><img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/lock-icon.png" align="<?php if ($style_connector->center_privacy_policy == 1): ?>center<?php else: ?>left<?php endif ?>" style="vertical-align:middle; display:inline; width:25px; height:25px;"/></div><div style="display:table-cell;"><span style="vertical-align:middle; display:inline;"><?php echo $connector_txt->privacy_policy_text; ?></span></div></div></div></div>
            </div>
        </div>
    </div>

    <?php if (get_option('hc_affiliate_valid') == 1 && get_option('hc_earn_money') == 1): ?>
        <div style="margin-top:5px; font-size:11px; overflow:hidden; display:block;" id="poweredBy<?php echo $rand_id ?>">Powered by <strong><a target="_blank" href="<?php echo get_option('hc_affiliate_link') ?>">Hybrid Connect</a></strong></div>

    <?php endif ?>
</div>
<div class="hybridConnectErrorDisplay" style="background:#ffffcc; border:1px dashed #cc0000; padding:10px; display:none;"></div>

