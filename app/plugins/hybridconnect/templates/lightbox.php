<?php if ($is_link && $lightboxOrOptin=="lightbox"):?>
    <a class="hc_lightbox_click_trigger<?php echo $my_connector->IntegrationID?>" href="#"><?php echo $link_text?></a>
<?php endif?>
<?php if ($is_link && $lightboxOrOptin=="optin"):?>
    <a class="hc_optin_click_trigger<?php echo $my_connector->IntegrationID?>" href="#"><?php echo $link_text?></a>
<?php endif?>
<?php
$hc_ajax_nonce = wp_create_nonce("hyconspecialsecurityforajaxstring");
$facebookButtonSize = $style_button->fb_button_size;
if ($style_text->headline_shadow == 1 || $style_text->cta_shadow == 1 || $style_text->text_shadow == 1) { $textShadowSetting = $style_text->text_h_Shadow . " " . $style_text->text_v_Shadow . " " . $style_text->text_blur_shadow . " " . $style_text->text_shadow_color; }
?>

<script type="text/javascript">
    var hc_shortcode_connector = <?php echo json_encode($my_connector); ?>;
    hc_connectors.push(hc_shortcode_connector);
    var hc_rand_id = <?php echo $rand_id?>;
    hc_rand_ids.push(hc_rand_id);
</script>

<style type="text/css">
  .hc_frontend_ajax_loading {
        display: none !important;
    }

     #hc_template_wrapper<?php echo $rand_id ?> p strong {
       color: <?php echo $style_text->border_font_color ?> !important;
       }

    #hc_template_wrapper<?php echo $rand_id ?> {
       /* font-family:verdana;         */
        font-size:12px;
        line-height: 140%;
        margin-bottom: 10px;


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
        background-color:<?php echo $style_button->btn_bg_color ?>
    }
    #hc_template_wrapper<?php echo $rand_id ?> input[type="text"] {
        box-shadow: none;
        -moz-box-sizing: border-box;
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
    }
    #hc_template_wrapper<?php echo $rand_id ?> p {
        line-height: 140% !important;
        font-size: <?php echo $style_text->border_font_size ?>;
        color : <?php echo $style_text->border_font_color ?>;
        font-family: <?php echo $style_text->border_font_family ?>;
        margin-bottom: 5px;
        padding:0px;
        <?php if ($style_text->body_center == 1): ?>text-align: center;<?php else: ?> text-align:left;<?php endif?>
        <?php if ($style_text->text_shadow == 1): ?>text-shadow:<?php echo $textShadowSetting; ?>;<?php else: ?>text-shadow:none; <?php endif?>
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
        padding-top: <?php echo $style_text->text_vertical_position; ?>;
        <?php if ($style_text->headline_center == 1): ?>text-align: center;<?php endif ?>
        <?php if ($style_text->headline_shadow == 1): ?>text-shadow:<?php echo $textShadowSetting; ?>;<?php else: ?>text-shadow:none; <?php endif?>
        <?php if ($style_text->headline_bold == 1):?>font-weight: bold;<?php endif ?>
        margin-left:<?php echo $style_text->headline_left_margin; ?>;
        margin-right: <?php echo $style_text->headline_right_margin; ?>;
        margin-top:5px;
        padding-left:0px;
        padding-bottom:0px;
        padding-right:0px;
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
        background: url('<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/ticks/<?php echo $style_text->tick_style?>.png') no-repeat top left !important;
	line-height:140%;
	color: <?php echo $style_text->border_font_color ?>;
	font-family:<?php echo $style_text->border_font_family ?>;
	border-bottom:0px;
	border-top:0px;
	font-size: <?php echo $style_text->border_font_size ?>;
	list-style-type: none !important;
	<?php if ($style_text->text_shadow == 1): ?>text-shadow:<?php echo $textShadowSetting;?>;<?php else:?>text-shadow:none;<?php endif?>
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
	/*max-width:200px !important; */
	z-index: 100;
	position: relative;
/*	max-height: 200px !important; */
	display: block;
	width: <?php echo $style_image->image_size; ?>;
}
div.graphicWrapper<?php echo $rand_id ?> {
	float:right;
	position:relative;
	<?php if ($style_image->show_side_image != 1):?>display:none;<?php endif?>
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
box-shadow: <?php echo $style_connector->h_shadow." ".$style_connector->v_shadow." ". $style_connector->blur_shadow." ". $style_connector->shadow_color; ?>;
-moz-box-shadow: <?php echo $style_connector->h_shadow." ".$style_connector->v_shadow." ". $style_connector->blur_shadow." ". $style_connector->shadow_color; ?>;
-webkit-box-shadow: <?php echo $style_connector->h_shadow." ".$style_connector->v_shadow." ". $style_connector->blur_shadow." ". $style_connector->shadow_color; ?>;
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
<?php if ($style_text->cta_shadow == 1): ?>text-shadow:<?php echo $textShadowSetting; ?>;<?php else: ?>text-shadow:none; <?php endif?>
padding:0px;
}

#hc_template_wrapper<?php echo $rand_id ?> div.optinPosition<?php echo $rand_id ?> {
<?php if ($style_optin->email_centered ==1):?>margin-left:auto !important; margin-right:auto !important;<?php endif?>
 }
#hc_template_wrapper<?php echo $rand_id ?> div.facebookPosition<?php echo $rand_id ?> {
<?php if ($style_optin->fb_centered ==1):?>margin-left:auto !important; margin-right:auto !important; <?php else: ?>margin-left:5px; margin-right:5px; <?php endif?>
 }
#hc_template_wrapper<?php echo $rand_id ?> div.oneClickPosition<?php echo $rand_id ?> {
<?php if ($style_optin->oneclick_centered ==1):?>margin-left:auto !important; margin-right:auto !important;<?php else: ?>margin-left:5px; margin-right:5px; <?php endif?>
 }

#hc_template_wrapper<?php echo $rand_id ?> div.optinPositionInput<?php echo $rand_id ?> {
  <?php if ($style_optin->email_centered !=1):?>text-align:left;<?php else:?>text-align:center;<?php endif?>
 }

 #hc_template_wrapper<?php echo $rand_id ?> div.emailInputField<?php echo $rand_id ?> {
  <?php if ($style_button->emailNewLine ==1):?>display:block;<?php else: ?>display:inline;<?php endif?>
 }

 #hc_template_wrapper<?php echo $rand_id ?> div.emailButtonContainer<?php echo $rand_id ?> {
  <?php if ($style_button->buttonNewLine ==1):?>display:block;<?php else: ?>display:inline;<?php endif?>
  <?php if ($style_optin->email_centered !=1):?>text-align:left;<?php else:?>text-align:center;<?php endif?>
 }

 #hc_template_wrapper<?php echo $rand_id ?> .ppWrapper {
 <?php if ($style_connector->show_privacy_policy ==1):?>display:block;<?php else: ?>display:none;<?php endif?>
 }

#hc_template_wrapper<?php echo $rand_id ?> .privacyPolicy {
padding-left:10px;
padding-right:10px;
<?php if ($style_connector->center_privacy_policy ==1):?>margin:0px auto;<?php else: ?>margin-left:5px;<?php endif?>
text-shadow:none;
}



#hc_template_wrapper<?php echo $rand_id ?> .privacyPolicy span {
<?php if ($style_connector->bold_privacy_policy ==1):?>font-weight:bold;<?php else: ?>font-weight:normal;<?php endif?>
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

 /* LIGHTBOX CONTENT */
       #hc_template_lightbox_overlay<?php echo $rand_id?> {
        background-color:<?php if(!is_null($lightbox_options->lightbox_overlay_colour)) { echo $lightbox_options->lightbox_overlay_colour; } else { echo "#000000" ;} ?>;
        opacity: <?php if(!is_null($lightbox_options->lightbox_overlay_opacity)) { echo $lightbox_options->lightbox_overlay_opacity; } else { echo "0.8" ;} ?>;
        height: 100%;
        left: 0;
        min-height: 350px;
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 90000 !important;
    }

    .connectorWrapper<?php echo $rand_id?> {
      position:absolute;
      z-index:500000;
    }

    .hc_template_lightbox_popup {
        z-index: 90001 !important;
        position: fixed;
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
        z-index:500001;
        position:relative;
    }
    .hc_template_lightbox_popup .lightbox-close:hover {
        background-position: left bottom;
    }
    #hc_template_wrapper<?php echo $rand_id ?> p.connectorHeadline
    {
        <?php if ($style_text->headline_bold == 1):?>
            font-weight: bold;
        <?php endif?>
    }

    /* END LIGHTBOX CONTENT */
    /* slide up from bottom experiment */
    /* slideinonly   */
/*div.connectorWrapper<?php echo $rand_id ?> {
       bottom:-1000px;
       position:fixed;
       right:auto;

    }     */





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

</style>
<div style="display:none;" id="apiFlag<?php echo $rand_id ?>"><?php echo $my_connector->apiConnection; ?></div>
<div style="position:absolute; top:-1000px; left:-1000px; z-index:300;" id="customsubmit<?php echo $rand_id ?>"><?php echo $my_connector->custom_code; ?></div>
<input type="hidden" id="hc_hidden_emailonly<?php echo $rand_id ?>" class="hc_hidden_default_template" value="<?php echo $my_connector->emailOnly ?>" />
<input type="hidden" value="<?php if ($hc_is_lightbox): ?>1<?php else: ?>0<?php endif ?>" id="hc_hidden_lightbox_on<?php echo $rand_id ?>"  />
<input type="hidden" value="<?php if ($hc_is_lightbox): ?><?php echo $lightbox_options->on_time ?><?php else: ?>0<?php endif ?>" id="hc_hidden_lightbox_ontime<?php echo $rand_id ?>"  />
<input type="hidden" value="<?php if ($hc_is_lightbox): ?><?php echo $lightbox_options->on_click ?><?php else: ?>0<?php endif ?>" id="hc_hidden_lightbox_onclick<?php echo $rand_id ?>"  />
<input type="hidden" value="<?php echo $my_connector->IntegrationID?>" id="hc_hidden_this_connector_id<?php echo $rand_id ?>" />
<input type="hidden" value="<?php echo $lightbox_options->cookie_enable?>" id="hc_hidden_cookie_enable<?php echo $rand_id ?>" class="hc_hidden_cookie_enable"/>
<input type="hidden" value="<?php echo $lightbox_options->cookie_life?>" id="hc_hidden_cookie_life<?php echo $rand_id ?>" class="hc_hidden_cookie_life"/>
<input type="hidden" value="<?php echo $lightbox_options->fadein_enable?>" id="hc_hidden_fadein_enable<?php echo $rand_id ?>" class="hc_hidden_fadein_enable"/>
<input type="hidden" value="<?php echo $lightbox_options->time_enable?>" id="hc_hidden_time_enable<?php echo $rand_id ?>" class="hc_hidden_time_enable_"/>
<input type="hidden" value="<?php echo $lightbox_options->scroll_enable?>" id="<?php echo $rand_id ?>" class="hc_hidden_scroll_enable_<?php echo $rand_id ?>"/>
<input type="hidden" value="<?php echo $lightbox_options->scroll_size?>" id="hc_hidden_scroll_size_<?php echo $rand_id ?>" class="hc_hidden_scroll_size_<?php echo $rand_id ?>"/>
<input type="hidden" value="<?php echo $lightbox_options->optin_on_time?>" id="optin_on_time<?php echo $rand_id ?>" class="hc_optin_on_time" />
<input type="hidden" value="<?php echo $lightbox_options->optin_time_enable?>" id="optin_time_enable<?php echo $rand_id ?>" class="hc_optin_time_enable" />
<input type="hidden" value="<?php echo $lightbox_options->optin_scroll_enable?>" id="optin_scroll_enable<?php echo $rand_id ?>" class="hc_hidden_scroll_enable_optin_<?php echo $rand_id ?>" />
<input type="hidden" value="<?php echo $lightbox_options->optin_scroll_size?>" id="hc_hidden_scroll_size_optin_<?php echo $rand_id ?>" class="hc_hidden_scroll_size_optin_<?php echo $rand_id ?>" />
<input type="hidden" value="<?php echo $lightbox_options->optin_slide_in_from?>" id="optin_slide_in_from<?php echo $rand_id ?>" class="hc_optin_slide_in_from" />
<input type="hidden" value="<?php echo $lightbox_options->optin_slide_in_distance?>" id="optin_slide_in_distance<?php echo $rand_id ?>" class="hc_optin_slide_in_distance" />
<input type="hidden" value="<?php echo $lightbox_options->optin_start_pos_attribute?>" id="optin_start_pos_attribute<?php echo $rand_id ?>" class="hc_optin_start_pos_attribute" />
<input type="hidden" value="<?php echo $lightbox_options->optin_start_pos_value?>" id="optin_start_pos_value<?php echo $rand_id ?>" class="hc_optin_start_pos_value" />
<input type="hidden" value="<?php echo $lightbox_options->optin_ani_duration?>" id="optin_ani_duration<?php echo $rand_id ?>" class="hc_optin_ani_duration" />
<input type="hidden" value="<?php echo $lightboxOrOptin; ?>" id="lightbox_or_optin<?php echo $rand_id ?>" class="hc_lightbox_or_optin" />
<input type="hidden" value="<?php echo $lightbox_options->activated?>" id="lightboxActivated<?php echo $rand_id ?>" />
<input type="hidden" value="<?php echo $lightbox_options->optin_activated?>" id="optinActivated<?php echo $rand_id ?>" />
<input type="hidden" id="<?php echo $lightboxOrOptin; ?>" />
<input type="hidden" id="islightbox<?php echo $rand_id ?>" value="1" />
<input type="hidden" id="hc_hidden_variation_id<?php echo $rand_id ?>" class="hc_hidden_variation_id" value="<?php echo $variation->id ?>" />
<input type="hidden" id="hc_hidden_is_testing<?php echo $rand_id ?>" class="hc_hidden_is_testing" value="<?php echo $tpl_type->testing ?>" />


<input type="hidden" value="<?php if(!is_null($lightbox_options->lightbox_fade_duration)) { echo $lightbox_options->lightbox_fade_duration; } else { echo '600'; } ?>" id="hc_hidden_fade_in_speed<?php echo $rand_id ?>" class="hc_fade_in_speed"/>
<input type="hidden" id="hc_hidden_default_template<?php echo $rand_id ?>" class="hc_hidden_default_template" value="<?php echo $style_connector->default_template ?>" />
<input class="hc_hidden_post_id" value="<?php echo the_ID() ?>" type="hidden" />
<input type="hidden" id="hc_hidden_fb_ajaxnonce" value="<?php echo $hc_ajax_nonce ?>" />
<input type="hidden" class="hc_hidden_rand_id<?php echo $my_connector->IntegrationID?><?php if($lightboxOrOptin=="optin")echo "o"; ?>" value="<?php echo $rand_id ?>" />
<div id="hc_template_lightbox_overlay<?php echo $rand_id ?>" class="hc_template_lightbox_overlay" style="display:none"></div>
<div class="hc_template_lightbox_popup" id="hc_template_lightbox_popup<?php echo $rand_id ?>" style="display:none">
    <div id="hc_template_wrapper<?php echo $rand_id ?>" class="hc_template_frontend_wrapper" style="display:none; <?php if ($hc_is_footer): ?>margin-bottom: 15px;<?php endif ?>">
        <?php
        $box_height = ($style_connector->set_heights == 1) ? $style_connector->eoh : $style_connector->opt_in_box_height;
        $action_height = ($style_connector->set_heights == 1) ? $style_connector->ech : $style_connector->call_action_height;
        ?>
        <div id="hc_shortcode_form<?php echo $rand_id ?>" style="width:<?php echo $style_connector->opt_in_box_width ?>; height:<?php echo $box_height ?>; margin-left:auto; margin-right:auto;" class="connectorWrapper emailConnectorWrapper hc_shortcode_form<?php echo $rand_id ?> connectorWrapper<?php echo $rand_id ?>">
        <a class="lightbox-close" id="hc_lightbox_close<?php echo $rand_id ?>" href="#"></a>
        <input type="hidden" class="hc_hidden_connector_id" value="<?php echo $my_connector->IntegrationID ?>" />
        <input type="hidden" class="hc_hidden_connector_randid" value="<?php echo $rand_id ?>" />
        <input type="hidden" class="hc_hidden_variation_id" value="<?php echo $variation->id ?>" />
        <div class="graphicWrapper<?php echo $rand_id ?>">
            <?php if ($style_image->show_side_image == 1): ?>
                <img src="<?php echo $style_image->image_url ?>" style="float: right; z-index: 100; position: relative; display: block;" class="optinGraphic optinGraphic<?php echo $rand_id ?>">
            <?php endif ?><div id="sideOptinPosition<?php echo $rand_id ?>"></div></div>
        <p class="connectorHeadline" style="font-family:<?php echo $style_text->headline_font_family ?>; color:<?php echo $style_text->headline_font_color ?>; font-size:<?php echo $style_text->headline_font_size ?>;">
            <?php echo $connector_txt->optin_headline ?>
        </p>
        <div class="connectorDescriptionText connectorDescriptionText<?php echo $rand_id ?>" style="color:<?php echo $style_text->border_font_color ?>; font-family:<?php echo $style_text->border_font_family ?>; font-size:<?php echo $style_text->border_font_size ?>;font-weight:normal; height:150px; ">
            <?php echo $connector_txt->optin_description ?>
        </div>
        <br>
        <div style="position:absolute; bottom: 0; height:<?php echo $action_height ?>; width:100%; z-index: 3; text-align:<?php if ($style_optin->email_centered == 1): ?>center<?php else: ?>left<?php endif ?>;" class="optinWrapper emailOptinWrapper<?php echo $rand_id ?> optinWrapper<?php echo $rand_id ?>">
            <p class="connectorCallToAction emailCallToAction" style="font-size:<?php echo $style_text->call_action_font_size ?>; margin-bottom:5px; margin-left:10px; margin-top:15px; margin-right:10px; text-align:<?php if ($style_optin->email_centered == 1): ?>center<?php else: ?>left<?php endif ?>; font-family:<?php echo $style_text->call_action_font_family ?>; color:<?php echo $style_text->call_action_font_color ?>;"><?php echo $connector_txt->email_call ?></p>
            <div class="optinPosition<?php echo $rand_id ?>" style="display:table; overflow:hidden; padding:0px; text-align:inherit;">
            <div class="optinPositionRow<?php echo $rand_id ?>" style="display:table-row;">
            <div class="optinPositionLeftArrow<?php echo $rand_id ?>" style="display:table-cell;">
                <img src="<?php echo $style_image->arrow_style ?>l.png" style="float: left; <?php if ($style_image->show_arrow_graphics == 0): ?>display:none;<?php endif ?>" class="leftArrow leftArrowEmail">
            </div>
            <div class="optinPositionInput<?php echo $rand_id ?>" style="display:table-cell; vertical-align:top;">
                 <div style="<?php if ($my_connector->emailOnly=="1") { ?>display:none !important;<?PHP } else {?> display:inline;<?php } ?>"><input value="<?php echo $style_email->name_label_field ?>" id="hc_txt_name<?php echo $rand_id ?>" class="nameConnectorInputField connectorInputFields" name="nameField" style="width: <?php echo $style_optin->name_length ?>; clear: both; border-color: <?php echo $style_email->input_border_color ?>; background: none repeat scroll 0 0 <?php echo $style_email->input_bg_color ?>; font-family: <?php echo $style_email->input_font_family ?>; color: <?php echo $style_email->input_font_color ?>" onfocus="if (this.value == '<?php echo $style_email->name_label_field ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $style_email->name_label_field ?>';}" type="text"></div>
                 <div class="emailInputField<?php echo $rand_id ?>"><input value="<?php echo $style_email->email_label_field ?>" id="hc_txt_email<?php echo $rand_id ?>" class="emailConnectorInputField connectorInputFields" name="emailField" style="width: <?php echo $style_optin->email_length ?>; clear: both; border-color: <?php echo $style_email->input_border_color ?>; background: none repeat scroll 0 0 <?php echo $style_email->input_bg_color ?>; font-family: <?php echo $style_email->input_font_family ?>; color: <?php echo $style_email->input_font_color ?>" onfocus="if (this.value == '<?php echo $style_email->email_label_field ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $style_email->email_label_field ?>';}" type="text"></div>
                <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/ajax-loader.gif" id="hc_ajax_email<?php echo $rand_id ?>" class="hc_frontend_ajax_loading" />
                 <div class="emailButtonContainer<?php echo $rand_id ?>"><a href="#" class="navButton hc_form_connector_submit" id="hc_emailSignUpButton<?php echo $rand_id ?>" style="margin-top: 4px; text-align: center; clear: both;"><?php echo $connector_txt->email_btn ?></a></div>
                </div>
                <div class="optinPositionRightArrow<?php echo $rand_id ?>" style="display:table-cell;">
                <img src="<?php echo $style_image->arrow_style ?>r.png" style="float: right; <?php if ($style_image->show_arrow_graphics == 0): ?>display:none;<?php endif ?>" class="rightArrow rightArrowEmail">
            </div>
            </div>
            </div>
            <div class="ppWrapper"><div class="privacyPolicy privacyPolicyEmail" style="vertical-align:middle; display:table"><div style="display:table-row;" class="ppRow"><div style="display:table-cell; vertical-align:middle"><img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/lock-icon.png" align="<?php if ($style_connector->center_privacy_policy ==1):?>center<?php else: ?>left<?php endif?>" style="vertical-align:middle; display:inline; width:25px; height:25px;"/></div><div style="display:table-cell;"><span style="vertical-align:middle; display:inline;"><?php echo $connector_txt->privacy_policy_text; ?></span></div></div></div></div>
        </div></div>
    <div id="hc_shortcode_facebook<?php echo $rand_id ?>" class="hc_shortcode_facebook<?php echo $rand_id ?>" style="width:100%;">
        <?php
        $box_height = ($style_connector->set_heights == 1) ? $style_connector->foh : $style_connector->opt_in_box_height;
        $action_height = ($style_connector->set_heights == 1) ? $style_connector->fch : $style_connector->call_action_height;
        ?>
        <div id="hc_facebook_not_connected<?php echo $rand_id ?>" style="width:<?php echo $style_connector->opt_in_box_width ?>; height:<?php echo $box_height ?>;  margin-left:auto; margin-right:auto;" class="connectorWrapper facebookConnectorWrapper hc_facebook_not_connected<?php echo $rand_id ?> connectorWrapper<?php echo $rand_id ?>">
            <a class="lightbox-close" id="hc_lightbox_close<?php echo $rand_id ?>" href="#"></a>
            <input type="hidden" class="hc_hidden_connector_randid" value="<?php echo $rand_id ?>" />
            <input type="hidden" class="hc_hidden_connector_id" value="<?php echo $my_connector->IntegrationID ?>" />
            <input type="hidden" class="hc_hidden_variation_id" value="<?php echo $variation->id ?>" />
            <div class="graphicWrapper<?php echo $rand_id ?>">
                <?php if ($style_image->show_side_image == 1): ?>
                    <img src="<?php echo $style_image->image_url ?>" style="float: right; z-index: 100; position: relative; display: block;" class="optinGraphic optinGraphic<?php echo $rand_id ?>">
                <?php endif ?><div id="sideFacebookPosition<?php echo $rand_id ?>"></div></div>
            <p class="connectorHeadline" style="font-family:<?php echo $style_text->headline_font_family ?>; color:<?php echo $style_text->headline_font_color ?>; font-size:<?php echo $style_text->headline_font_size ?>;">
                <?php echo $connector_txt->optin_headline ?>
            </p>
            <div class="connectorDescriptionText connectorDescriptionText<?php echo $rand_id ?>" style="color:<?php echo $style_text->border_font_color ?>; font-family:<?php echo $style_text->border_font_family ?>; font-size:<?php echo $style_text->border_font_size ?>; font-weight:normal; height:150px; ">
                <?php echo $connector_txt->optin_description ?>
            </div>
            <br>
            <div style="position:absolute; bottom: 0; height:<?php echo $action_height ?>; width:100%; z-index: 3; text-align:<?php if ($style_optin->fb_centered == 1): ?>center<?php else: ?>left<?php endif ?>;" class="optinWrapper facebookOptinWrapper<?php echo $rand_id ?>  optinWrapper<?php echo $rand_id ?>">
                <p class="connectorCallToAction facebookCallToAction" style="font-size:<?php echo $style_text->call_action_font_size ?>; text-align:<?php if ($style_optin->fb_centered == 1): ?>center<?php else: ?>left<?php endif ?>; margin-bottom:5px; margin-left:10px; margin-top:15px; margin-right:10px; font-family:<?php echo $style_text->call_action_font_family ?>; color:<?php echo $style_text->call_action_font_color ?>;"><?php echo $connector_txt->fb_call ?></p>
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
                <div class="ppWrapper"><div class="privacyPolicy privacyPolicyFacebook" style="vertical-align:middle; display:table"><div style="display:table-row;" class="ppRow"><div style="display:table-cell; vertical-align:middle"><img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/lock-icon.png" align="<?php if ($style_connector->center_privacy_policy ==1):?>center<?php else: ?>left<?php endif?>" style="vertical-align:middle; display:inline; width:25px; height:25px;"/></div><div style="display:table-cell;"><span style="vertical-align:middle; display:inline;"><?php echo $connector_txt->privacy_policy_text; ?></span></div></div></div></div>
            </div></div>
        <?php
        $box_height = ($style_connector->set_heights == 1) ? $style_connector->ooh : $style_connector->opt_in_box_height;
        $action_height = ($style_connector->set_heights == 1) ? $style_connector->och : $style_connector->call_action_height;
        ?>
        <div id="hc_facebook_connected<?php echo $rand_id ?>" style="width:<?php echo $style_connector->opt_in_box_width ?>; height:<?php echo $box_height ?>;  margin-left:auto; margin-right:auto;"  class="connectorWrapper oneClickConnectorWrapper hc_facebook_connected<?php echo $rand_id ?> connectorWrapper<?php echo $rand_id ?>">
            <a class="lightbox-close" id="hc_lightbox_close<?php echo $rand_id ?>" href="#"></a>
            <input type="hidden" class="hc_hidden_connector_id" value="<?php echo $my_connector->IntegrationID ?>" />
            <input type="hidden" class="hc_hidden_connector_randid" value="<?php echo $rand_id ?>" />
            <input type="hidden" class="hc_hidden_variation_id" value="<?php echo $variation->id ?>" />
            <div class="graphicWrapper<?php echo $rand_id ?>">
                <?php if ($style_image->show_side_image == 1): ?>
                    <img src="<?php echo $style_image->image_url ?>" style="float: right; z-index: 100; position: relative; display: block;" class="optinGraphic optinGraphic<?php echo $rand_id ?>">
                <?php endif ?><div id="sideOneClickPosition<?php echo $rand_id ?>"></div></div>
            <p class="connectorHeadline" style="font-family:<?php echo $style_text->headline_font_family ?>; color:<?php echo $style_text->headline_font_color ?>; font-size:<?php echo $style_text->headline_font_size ?>;">
                <?php echo $connector_txt->optin_headline ?>
            </p>
            <div class="connectorDescriptionText connectorDescriptionText<?php echo $rand_id ?>" style="color:<?php echo $style_text->border_font_color ?>; font-family:<?php echo $style_text->border_font_family ?>; font-size:<?php echo $style_text->border_font_size ?>; font-weight:normal; height:150px; ">
                <?php echo $connector_txt->optin_description ?>
            </div>
            <br/>
            <div style="position:absolute; bottom: 0; height:<?php echo $action_height ?>; width:100%; z-index: 3; text-align:<?php if ($style_optin->oneclick_centered == 1): ?>center<?php else: ?>left<?php endif ?>;" class="optinWrapper oneClickOptinWrapper<?php echo $rand_id ?>  optinWrapper<?php echo $rand_id ?>">
                <p class="connectorCallToAction oneClickCallToAction" style="font-size:<?php echo $style_text->call_action_font_size ?>; margin-bottom:5px; text-align:<?php if ($style_optin->oneclick_centered == 1): ?>center<?php else: ?>left<?php endif ?>; margin-left:10px; margin-top:15px; margin-right:10px; font-family:<?php echo $style_text->call_action_font_family ?>; color:<?php echo $style_text->call_action_font_color ?>;"><?php echo $connector_txt->oneclick_call ?></p>
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
                <div class="ppWrapper"><div class="privacyPolicy privacyPolicyOneClick" style="vertical-align:middle; display:table"><div style="display:table-row;" class="ppRow"><div style="display:table-cell; vertical-align:middle"><img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/lock-icon.png" align="<?php if ($style_connector->center_privacy_policy ==1):?>center<?php else: ?>left<?php endif?>" style="vertical-align:middle; display:inline; width:25px; height:25px;"/></div><div style="display:table-cell;"><span style="vertical-align:middle; display:inline;"><?php echo $connector_txt->privacy_policy_text; ?></span></div></div></div></div>
            </div></div>
    </div>

    </div>
</div>

<script>
jQuery(document).ready( function($) {

jQuery('body').prepend(jQuery('div#hc_template_lightbox_popup<?php echo $rand_id ?>'));
	jQuery('body').prepend(jQuery('div#hc_template_lightbox_overlay<?php echo $rand_id ?>'));

        });
</script>
