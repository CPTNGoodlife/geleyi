<?php if(!isset($squeeze_options)) { $squeeze_options = array(); }     ?>
<script>
    var hc_images_path = "<?php echo HYBRIDCONNECT_IAMGES_PATH ?>";
    var hc_selected_arrow_src = "<?php echo $arrowImageURL; ?>";
    jQuery(document).ready(function() {
<?php if ($style_image->show_side_image == 0): ?>
            jQuery('img.optinGraphic').css("display","none");
<?php endif ?>
<?php if ($style_connector->set_heights == 1): ?>
                jQuery('tr.individualHeightSettings').show();
<?php endif ?>
        bindTinyMceEditor();
        checkCookieSet();
      /*  updateLightboxDisplayOptions();    */
     //   hc_custom_javascript<?php echo $style_connector->default_template ?>();
        jQuery(".radioSelTickType").click(function(){
           var selected = jQuery(this).val();
           var temp_atr = "url('" + hc_images_path + "/ticks/" + selected + ".png') no-repeat top left";
           jQuery(".connectorDescriptionText ul li").css('background', temp_atr);
        });
        //clear cookie
        jQuery(".hc_lb_cookie_clear").click(function(){
          //console.log("checking cookies..");
            jQuery('#hc_admin_ajax_loading').show();
            var id_connector = jQuery("#hc_tpl_page_id_connector").val();
            var cookie_name = "hc_lb_" + id_connector;
            // set cookie to expire yesterday
            createCookie(cookie_name,"",-1);
            checkCookieSet();
            jQuery('#hc_admin_ajax_loading').hide();
        });
        //onchange responsive settings
        jQuery("#responsiveOptinMinWidth").change(function(){
            jQuery("div.connectorWrapper").css("min-width", jQuery(this).val() + "px");
        });
        jQuery("#responsiveOptinMaxWidth").change(function(){
            jQuery("div.connectorWrapper").css("max-width", jQuery(this).val() + "px");
        });
        jQuery("#responsiveMinWidth").change(function(){
            jQuery("div.graphicWrapper").css("min-width", jQuery(this).val() + "px");
        });
        jQuery("#responsiveMaxWidth").change(function(){
            jQuery("div.graphicWrapper").css("max-width", jQuery(this).val() + "px");
        });
        jQuery("#responsiveMinHeight").change(function(){
            jQuery("div.graphicWrapper").css("min-height", jQuery(this).val() + "px");
        });
        jQuery("#responsiveMaxHeight").change(function(){
            jQuery("div.graphicWrapper").css("max-height", jQuery(this).val() + "px");
        });

        /* jQuery for the foldable control panel menus */
        jQuery('th.emailInputFieldSettings').click(function(){ jQuery('tr.emailInputFieldSettingsContent.').toggle(); });
        jQuery('th.textSettings').click(function(){ jQuery('tr.textSettingsContent.').toggle(); });
        jQuery('th.buttonSettings').click(function(){ jQuery('tr.buttonSettingsContent.').toggle(); });
        jQuery('th.optInBoxSettings').click(function(){ jQuery('tr.optInBoxSettingsContent.').toggle(); });
        jQuery('th.dropShadowSettings').click(function(){ jQuery('tr.dropShadowSettingsContent.').toggle(); });
        jQuery('th.facebookSettings').click(function(){ jQuery('tr.facebookSettingsContent.').toggle(); });
        jQuery('th.textShadowSettings').click(function(){ jQuery('tr.textShadowSettingsContent.').toggle(); });
        jQuery('th.textPositioningSettings').click(function(){ jQuery('tr.textPositioningSettingsContent.').toggle(); });
        jQuery('th.bulletSettings').click(function(){ jQuery('tr.bulletSettingsContent').toggle(); });
        jQuery('th.ctatextSettings').click(function(){ jQuery('tr.ctatextSettingsContent').toggle(); });
        jQuery('th.buttontextSettings').click(function(){ jQuery('tr.buttontextSettingsContent').toggle(); });
        jQuery('th.privacyPolicySettings').click(function(){ jQuery('tr.privacyPolicySettingsContent').toggle(); });
        jQuery('th.privacyTextSettings').click(function(){ jQuery('tr.privacyTextSettingsContent').toggle(); });
        jQuery('th.connectorSettings').click(function(){ connectorSettingsHideShow(); });
        jQuery('th.activationSettings').click(function() { squeezeSettingsHideShow(); lightboxDisplay(true); } );
        jQuery('th.triggerSettings').click(function(){ jQuery('tr.triggerSettingsContent').toggle(); });
        jQuery('th.frequencySettings').click(function(){ jQuery('tr.frequencySettingsContent').toggle(); });
        jQuery('th.animationSettings').click(function(){ jQuery('tr.animationSettingsContent').toggle(); });
        jQuery('th.optinboxSettings').click(function(){ jQuery('tr.optinboxSettingsContent').toggle(); });
        jQuery('th.myTemplatesSettings').click(function(){ jQuery('tr.myTemplatesSettingsContent').toggle(); });
        jQuery('th.externalMarginSettings').click(function(){ jQuery('tr.externalMarginSettingsContent').toggle(); });
        jQuery('th.optinBoxPosition').click(function(){ jQuery('tr.optinBoxPositionContent').toggle(); });
        jQuery('th.slideInSettings').click(function(){ jQuery('tr.slideInSettingsContent').toggle(); });

        
        jQuery("#slideInActivated").click(function(e) { displaySettingsTable(e,"optinbarOptions"); });
        jQuery("#lightboxActivatedCheckbox").click(function(e) { displaySettingsTable(e,"lightboxOptionsTable"); });
        
        jQuery("a.loadhcTemplate").on("click", function(event){ event.preventDefault(); loadNewTemplateFromDB(event); });
        jQuery("button.hc_link_connector_shortcode_template_settings").on("click", function(event){ event.preventDefault(); loadUserTemplateFromDB(event); });
        /*change mouse cursor on hover*/
        jQuery('th.expandable').hover(function() {
          jQuery(this).css('cursor','pointer'); }, function() {
          jQuery(this).css('cursor','auto');
          });
          
        jQuery("a#squeezePagesShow").click( function() { squeezeDisplayShow(); } );
        jQuery('a.clearClosestCheckbox').click( function() { jQuery(this).parent().parent().children(".scrollableCheck").find("input:checkbox").attr("checked",false);    } );
        jQuery("#hc_sc_save_as_template").hover( function () { jQuery(this).css("opacity", "0.8");  }, function() { jQuery(this).css("opacity", "1.0"); });

        /* template builder binds */
        jQuery('#hc_lb_displayed_select').live('change', function() {   lightboxDisplay(false);  });
        jQuery("#verticallyAligned").click( function() { verticallyAligned(); });
        jQuery("#centredOnScreen").click( function() { centrallyAligned(); });
        jQuery('button.hc_margin_view_reset').click( function() { resetFromMarginPreview(); } );
        jQuery('#showExternalMarginPreview').click( function() { showExternalMarginPreview(); } );
        jQuery('input[name=privacyPolicyText]').keyup(privacyPolicyText);
        jQuery('#showPrivacyPolicy').click( function() { showPrivacyPolicy(); } );
        jQuery('#boldPrivacyPolicy').click( function() { boldPrivacyPolicy(); } );
        jQuery('#centerPrivacyPolicy').click( function() { centerPrivacyPolicy(); } );
        jQuery("select#privacyPolicyFont").change(privacyPolicyFont);
        jQuery('input[name=privacyPolicyColor]').miniColors({ change: function(hex, rgb) { privacyPolicyColor(); } });
        jQuery('#headlineShadowCheckbox').click( function() { updateTextShadow(); } );
        jQuery('#textShadowCheckbox').click( function() { updateTextShadow(); } );
        jQuery('#ctaShadowCheckbox').click( function() { updateTextShadow(); } );
        jQuery('input[name=textShadowColor]').miniColors({ change: function(hex, rgb) { updateTextShadow(); } });
        jQuery('a#facebookSmall').click( function() { updateFacebook('small'); } );
        jQuery('a#facebookMedium').click( function() { updateFacebook('medium'); } );
        jQuery('a#facebookLarge').click( function() { updateFacebook('large'); } );
        jQuery('a#facebookXlarge').click( function() { updateFacebook('xlarge'); } );
        jQuery('#dropShadowCheckbox').click(dropShadowCheckbox);
        jQuery('#emailInputNewLine').click(emailInputNewLine);
        jQuery('#submitButtonNewLine').click(submitButtonNewLine);
        jQuery('#headlineCenter').click(headlineCenter);
        jQuery('#bodyCenter').click(bodyCenter);
        jQuery('#imageBackgroundUploadFilePath').live('input',imageBackgroundChange);
        jQuery('#transparentBackgroundCheckbox').click(transparentBackgroundCheckbox);
        jQuery('#transparentOptinBackgroundCheckbox').click(transparentOptinBackgroundCheckbox);
        
        jQuery('#hc_sc_save_changes').click( function(event) { try_save(); } );
        jQuery('#hc_sc_save_as_template').click( function(event) { try_save("template"); } );
        jQuery('#hc_save_template').click( function(event) { saveTemplate(event) });
        jQuery("#headlineBold").click(headlineBold);
        
        /squeeze page controls */
        jQuery('input[name=squeezeBGColor]').miniColors({ change: function(hex, rgb) { squeezeBGColor(); } });
        jQuery('input[name=squeezeGradientBGColor1]').miniColors({ change: function(hex, rgb) { squeezeGradientColor(); } });
        jQuery('input[name=squeezeGradientBGColor2]').miniColors({ change: function(hex, rgb) { squeezeGradientColor(); } });
        jQuery('#squeezeGradientCheckbox').click( function() { squeezeGradientBGCheckbox(); } );
        jQuery('#squeezePictureCheckbox').click( function() { squeezeBackgroundCheckbox(); } );
        jQuery("#squeezeTileBG").click(function() { squeezeTileBG(); } );
        jQuery("#repeatXAxis").click(function() { repeatXAxis(); } );
        jQuery("#repeatYAxis").click(function() { repeatYAxis(); }  );
        
        /*additional lightbox settings*/
        jQuery('input[name=lightboxOverlayColour]').miniColors({ change: function(hex, rgb) { } });
        jQuery("button#lightboxPreview").click( function() { previewLightbox(); } );
        jQuery("button#optinBoxPreview").click( function() { previewSlidein(); } );
        
        jQuery('input[name=connectorBGColor]').miniColors({ change: function(hex, rgb) { changeWrapperBG(); } });
        jQuery('input[name=borderColor]').miniColors({ change: function(hex, rgb) { borderColor(); } });
        jQuery('input[name=OptinBGColor]').miniColors({ change: function(hex, rgb) { changeOptInBG(); } });
	      jQuery('input[name=templateBGColor1]').miniColors({ change: function(hex, rgb) { templateGradientColor(); } });
	      jQuery('input[name=templateBGColor2]').miniColors({ change: function(hex, rgb) { templateGradientColor(); } });
        jQuery('input[name=inputFieldBorder]').miniColors({ change: function(hex, rgb) { inputFieldBorder(); } });
        jQuery('input[name=inputFieldBackgroundColor]').miniColors({ change: function(hex, rgb) { inputFieldBackgroundColor(); } });
        jQuery('input[name=headlineTextColor]').miniColors({ change: function(hex, rgb) { headlineTextColor(); } });
        jQuery('input[name=bodyTextColor]').miniColors({ change: function(hex, rgb) { bodyTextColor(); } });
        jQuery('input[name=inputTextColor]').miniColors({ change: function(hex, rgb) { inputTextColor(); } });
        jQuery("select#headlineFont").change(headlineFont);
        jQuery("select#inputTextFont").change(inputTextFont);
        jQuery("select#borderStyle").change(borderStyle);
        jQuery("select#fieldBorderStyle").change(fieldBorderStyle);
        jQuery("select#bodyFont").change(bodyFont);
        jQuery('input[name=buttonBackgroundColor]').miniColors({ change: function(hex, rgb) { buttonBackgroundColor(); } });
        jQuery('input[name=emailCentre]').click(emailCentre);
        jQuery('input[name=facebookCentre]').click(facebookCentre);
        jQuery('input[name=oneClickCentre]').click(oneClickCentre);
        jQuery('input[name=emailCallToActionText]').keyup(emailCallToActionText);
        jQuery('input[name=facebookCallToActionText]').keyup(facebookCallToActionText);
        jQuery('input[name=oneClickCallToActionText]').keyup(oneClickCallToActionText);
        jQuery('input[name=optinBoxHeadline]').keyup(optinBoxHeadline);
        jQuery('textarea#optinBoxDescription').keyup(optinBoxDescription);
        jQuery('input[name=emailButtonText]').keyup(emailButtonText);
        jQuery('input[name=facebookButtonText]').keyup(facebookButtonText);
        jQuery('input[name=oneClickButtonText]').keyup(oneClickButtonText);
        jQuery('input[name=nameLabelField]').keyup(nameLabelField);
        jQuery('input[name=emailLabelField]').keyup(emailLabelField);
        jQuery('input[name=sidePictureShow]').click(sidePictureShow);
        jQuery('input[name=arrowGraphicsShow]').click(arrowGraphicsShow);
        jQuery('img#blackArrowOption').click( function() {
            hc_selected_arrow_src = "<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/arrow-1-black-";
            jQuery('img.leftArrow').attr("src",hc_selected_arrow_src + "l.png");  jQuery('img.rightArrow').attr("src",hc_selected_arrow_src + "r.png");
        } );
        jQuery('img#redArrowOption').click( function() {
            hc_selected_arrow_src = "<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/arrow-1-red-";
            jQuery('img.leftArrow').attr("src",hc_selected_arrow_src + "l.png");  jQuery('img.rightArrow').attr("src",hc_selected_arrow_src + "r.png");
        } );
        jQuery('img#blueArrowOption').click( function() {
            hc_selected_arrow_src = "<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/arrow-1-blue-";
            jQuery('img.leftArrow').attr("src",hc_selected_arrow_src + "l.png");  jQuery('img.rightArrow').attr("src",hc_selected_arrow_src + "r.png");
        } );
        jQuery('img#whiteArrowOption').click( function() {
            hc_selected_arrow_src = "<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/arrow-1-white-";
            jQuery('img.leftArrow').attr("src",hc_selected_arrow_src + "l.png");  jQuery('img.rightArrow').attr("src",hc_selected_arrow_src + "r.png");
        } );
        jQuery('img#greenArrowOption').click( function() {
            hc_selected_arrow_src = "<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/arrow-1-green-";
            jQuery('img.leftArrow').attr("src",hc_selected_arrow_src + "l.png");  jQuery('img.rightArrow').attr("src",hc_selected_arrow_src + "r.png");
        } );
        jQuery('img#orangeArrowOption').click( function() {
            hc_selected_arrow_src = "<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/arrow-1-orange-";
            jQuery('img.leftArrow').attr("src",hc_selected_arrow_src + "l.png");  jQuery('img.rightArrow').attr("src",hc_selected_arrow_src + "r.png");
        } );
        jQuery('img#purpleArrowOption').click( function() {
            hc_selected_arrow_src = "<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/arrow-1-purple-";
            jQuery('img.leftArrow').attr("src",hc_selected_arrow_src + "l.png");  jQuery('img.rightArrow').attr("src",hc_selected_arrow_src + "r.png");
        } );
        jQuery('img#yellowArrowOption').click( function() {
            hc_selected_arrow_src = "<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/arrow-1-yellow-";
            jQuery('img.leftArrow').attr("src",hc_selected_arrow_src + "l.png");  jQuery('img.rightArrow').attr("src",hc_selected_arrow_src + "r.png");
        } );
        
        jQuery("#slideInFrom").change( function() { lightboxDropDown(); } );
        jQuery("select#callToActionFont").change(callToActionFont);
        jQuery('input[name=callToActionTextColor]').miniColors({ change: function(hex, rgb) { callToActionTextColor(); } });
        jQuery('input[name=buttonFontColor]').miniColors({ change: function(hex, rgb) { buttonFontColorFunction(); } });
        jQuery('input[name=buttonTextShadowColor]').miniColors({ change: function(hex, rgb) { buttonTextShadowColorFunction(); } });
        jQuery('input[name=buttonBorderColor]').miniColors({ change: function(hex, rgb) { buttonBorderColorFunction(); } });
        jQuery('input[name=buttonBoxShadow]').miniColors({ change: function(hex, rgb) { buttonBoxShadowFunction(); } });
        jQuery("select#buttonTextFont").change(buttonTextFontFunction);
        jQuery("select#buttonColourType").change(buttonColourType);
        jQuery( "#draggable" ).draggable( {cancel: 'div.tabOptions' });
        jQuery('.ui-state-default').live('mouseover',function () { jQuery(this).addClass('ui-state-hover'); }).live('mouseout',function () { jQuery(this).removeClass('ui-state-hover'); })
        jQuery('.ui-state-default-cancel').live('mouseover',function () { jQuery(this).addClass('ui-state-hover-cancel'); }).live('mouseout',function () { jQuery(this).removeClass('ui-state-hover-cancel'); })
        jQuery('input[name=individualHeightCheckbox]').click(individualHeightCheckbox);
	      jQuery('input[name=gradientBackgroundCheckbox]').click(gradientBackgroundCheckbox);
	      jQuery('input[name=pictureBackgroundCheckbox]').click(pictureBackgroundCheckbox);
        jQuery("a#style1").click(function(event) { event.preventDefault(); defaultStyle1(); makeTemplateResponsive(); });
        jQuery("a#style2").click(function(event) { event.preventDefault(); defaultStyle2(); makeTemplateResponsive(); });
        jQuery("a#style3").click(function(event) { event.preventDefault(); defaultStyle3(); makeTemplateResponsive();});
        jQuery("a#style4").click(function(event) { event.preventDefault(); defaultStyle4(); makeTemplateResponsive(); });
        jQuery("a#style5").click(function(event) { event.preventDefault(); defaultStyle5(); makeTemplateResponsive(); });
        jQuery("a#style6").click(function(event) { event.preventDefault(); defaultStyle6();  makeTemplateResponsive();});
        jQuery("a#style7").click(function(event) { event.preventDefault(); defaultStyle7();  makeTemplateResponsive();});
        jQuery("a#style8").click(function(event) { event.preventDefault(); defaultStyle8();  makeTemplateResponsive();});
        jQuery("a#style9").click(function(event) { event.preventDefault(); defaultStyle9();  makeTemplateResponsive();});
        jQuery("a#style10").click(function(event) { event.preventDefault(); defaultStyle10();  makeTemplateResponsive();});
        
        jQuery("button.hc_link_connector_remove").click(function(event) { event.preventDefault(); removeUserTemplate(event); });

        // 28th June 2012 - code added to make lightbox settings user friendly
       /* jQuery('.lbDisplayOptions').click( function() { updateLightboxDisplayOptions(); } ); */

        jQuery('input[name=hc_lb_cookie_enable]').click(cookieOptionsClick);
        jQuery('input[name=hc_lb_scroll_enable]').click(scrollOptionsClick);
        jQuery('input[name=hc_lb_time_enable]').click(timeOptionsClick);
        jQuery("#tabs" ).tabs();

        <?php if(is_object($squeeze_options)) { echo "var initialMarginTop = '" . $squeeze_options->vertical_top_margin . "';"; }
        else { echo "var initialMarginTop='20px;'"; } ?>
        
        jQuery("#marginDisplay" ).html( "<b>" + initialMarginTop + "</b> margin from top" );


       /* if squeeze pages then change to monitor display on 4th tab click */
        <?php if($style_connector->type=="3"){ ?>
        jQuery("#tabs").tabs({
        select: function(event, ui){
        if(ui.index==4) { squeezeDisplayShow();  }  else { squeezeDisplayHide(); }
        }
       });
       
       <?php }  ?>
       
<?php if ($style_connector->is_responsive == 1): ?>
            makeTemplateResponsive();
<?php endif ?>
          jQuery('input[name=responsive]').click(makeTemplateResponsive);
          // scrollbar for templates
          //scrollpane parts
          var scrollPane = jQuery( ".scroll-pane" ),
          scrollContent = jQuery( ".scroll-content" );
          //build slider
          var scrollbar = jQuery( ".scroll-bar" ).slider({
              slide: function( event, ui ) {
                  if ( scrollContent.width() > scrollPane.width() ) {
                      scrollContent.css( "margin-left", Math.round(
                      ui.value / 100 * ( scrollPane.width() - scrollContent.width() )
                  ) + "px" );
                  } else {
                      scrollContent.css( "margin-left", 0 );
                  }
              }
          });
          //append icon to handle
          var handleHelper = scrollbar.find( ".ui-slider-handle" )
          .mousedown(function() {
              scrollbar.width( handleHelper.width() );
          })
          .mouseup(function() {
              scrollbar.width( "100%" );
          })
          .append( "<span class='ui-icon ui-icon-grip-dotted-vertical'></span>" )
          .wrap( "<div class='ui-handle-helper-parent'></div>" ).parent();
          //change overflow to hidden now that slider handles the scrolling
          scrollPane.css( "overflow", "hidden" );
          //size scrollbar and handle proportionally to scroll distance
          function sizeScrollbar() {
              var remainder = scrollContent.width() - scrollPane.width();
              var proportion = remainder / scrollContent.width();
              var handleSize = scrollPane.width() - ( proportion * scrollPane.width() );
              scrollbar.find( ".ui-slider-handle" ).css({
                  width: handleSize,
                  "margin-left": -handleSize / 2
              });
              handleHelper.width( "" ).width( scrollbar.width() - handleSize );
          }
          //reset slider value based on scroll content position
          function resetValue() {
              var remainder = scrollPane.width() - scrollContent.width();
              var leftVal = scrollContent.css( "margin-left" ) === "auto" ? 0 :
                  parseInt( scrollContent.css( "margin-left" ) );
              var percentage = Math.round( leftVal / remainder * 100 );
              scrollbar.slider( "value", percentage );
          }
          //if the slider is 100% and window gets larger, reveal content
          function reflowContent() {
              var showing = scrollContent.width() + parseInt( scrollContent.css( "margin-left" ), 10 );
              var gap = scrollPane.width() - showing;
              if ( gap > 0 ) {
                  scrollContent.css( "margin-left", parseInt( scrollContent.css( "margin-left" ), 10 ) + gap );
              }
          }
          //change handle position on window resize
          jQuery( window ).resize(function() {
              resetValue();
              sizeScrollbar();
              reflowContent();
          });
          //init scrollbar size
          setTimeout( sizeScrollbar, 10 );//safari wants a timeout
          
          // disable name field if email only
    <?php if($my_connector->emailOnly=="1") { ?>
          jQuery("#nameLabelField").prop('disabled', true);
    <?php } ?>
          
      });
      // slider functions
      jQuery(function() {
<?php if ($style_connector->min_width != "" && $style_connector->min_width > 0): ?>
                initialSetting = "<?php echo $style_connector->min_width + 50 ?>";
<?php else: ?>
                initialSetting = "450";
<?php endif ?>
            jQuery("#responsiveSlider" ).slider({
                value: 450,
                min: 150,
                max: 1024,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#responsiveSliderInput" ).val( ui.value + "px" );
                    jQuery( "div#responsiveWrapperDiv" ).css("width", ui.value + "px" );
                }
            });
            jQuery( "#responsiveSliderInput" ).val( jQuery( "#responsiveSlider" ).slider( "value" ) + "px" );
        });
        
        //bullet point sizing
        jQuery(function() {
            <?php if(!is_null($style_connector->bulletpointsize))
            { echo "initialSetting = " . str_replace('px','', $style_connector->bulletpointsize).";"; }
            else
             { echo "initalSetting=32;"; }
            ?>
            jQuery("#bulletPointSizeSlider" ).slider({
                value: initialSetting,
                min: 1,
                max: 60,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#bulletPointSizeInput" ).val( ui.value + "px" );
                    jQuery( ".connectorDescriptionText ul li" ).css("background-size", ui.value + "px" );
                }
            });
            jQuery( "#bulletPointSizeInput" ).val( jQuery( "#bulletPointSizeSlider" ).slider( "value" ) + "px" );
        });
        

        //bullet point offset
        jQuery(function() {
            <?php if(!is_null($style_connector->bulletpointoffset))
            { echo "initialSetting = " . str_replace('px','', $style_connector->bulletpointoffset).";"; }
            else
             { echo "initalSetting=0;"; }
            ?>
            jQuery("#bulletPointVerticalInputSlider" ).slider({
                value: initialSetting,
                min: -20,
                max: 30,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#bulletPointVerticalInput" ).val( ui.value + "px" );
                    jQuery( ".connectorDescriptionText ul li" ).css("background-position-y", ui.value + "px" );
                }
            });
            jQuery( "#bulletPointVerticalInput" ).val( jQuery( "#bulletPointVerticalInputSlider" ).slider( "value" ) + "px" );
        });
        
        //bullet point offset horizontal
        jQuery(function() {
            <?php if(!is_null($style_connector->bulletpointoffsetx))
            { echo "initialSetting = " . str_replace('px','', $style_connector->bulletpointoffsetx).";"; }
            else
             { echo "initalSetting=0;"; }
            ?>
            jQuery("#bulletPointHorizontalInputSlider" ).slider({
                value: initialSetting,
                min: -20,
                max: 30,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#bulletPointHorizontalInput" ).val( ui.value + "px" );
                    jQuery( ".connectorDescriptionText ul li" ).css("background-position-x", ui.value + "px" );
                }
            });
            jQuery( "#bulletPointHorizontalInput" ).val( jQuery( "#bulletPointHorizontalInputSlider" ).slider( "value" ) + "px" );
        });
        
        jQuery(function() {
            <?php if(!is_null($style_text->headline_font_size))
            { echo "initialSetting = " . str_replace('px','', $style_text->headline_font_size).";"; }
            else
             { echo "initalSetting=20;"; }
            ?>
            jQuery("#headlineFontSizeSlider" ).slider({
                value: initialSetting,
                min: 8,
                max: 40,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#headlineFontSize" ).val( ui.value + "px" );
                    jQuery( "p.connectorHeadline" ).css("font-size", ui.value + "px" );
                }
            });
            jQuery( "#headlineFontSize" ).val( jQuery( "#headlineFontSizeSlider" ).slider( "value" ) + "px" );
        });
        
        jQuery(function() {

         <?php if(!is_null($style_text->call_action_font_size))
            { echo "initialSetting = " . str_replace('px','', $style_text->call_action_font_size).";"; }
            else
            { echo "initalSetting=16;"; }
            ?>

            jQuery("#callToActionFontSizeSlider" ).slider({
                value: initialSetting,
                min: 8,
                max: 40,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#callToActionFontSize" ).val( ui.value + "px" );
                    jQuery( "p.connectorCallToAction" ).css("font-size", ui.value + "px" );
                }
            });
            jQuery( "#callToActionFontSize" ).val( jQuery( "#callToActionFontSizeSlider" ).slider( "value" ) + "px" );
        });
        
        
        jQuery(function() {

            <?php if(!is_null($style_text->border_font_size))
            { echo "initialSetting = " . str_replace('px','', $style_text->border_font_size).";"; }
            else
            { echo "initalSetting=2;"; }
            ?>
            
            jQuery( "#mainFontSizeSlider" ).slider({
                value: initialSetting,
                min: 8,
                max: 40,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#mainFontSize" ).val( ui.value + "px" );
                    jQuery( "div.connectorDescriptionText" ).css("font-size", ui.value + "px" );
                    jQuery( "div.connectorDescriptionText p" ).css("font-size", ui.value + "px" );
                    jQuery( "div.connectorDescriptionText li" ).css("font-size", ui.value + "px" );
                }
            });
            jQuery( "#mainFontSize" ).val( jQuery( "#mainFontSizeSlider" ).slider( "value" ) + "px" );
        });
        
        
        jQuery(function() {


             <?php if(!is_null($style_connector->opt_in_box_height))
            { echo "initialSetting = " . str_replace('px','', $style_connector->opt_in_box_height).";"; }
            else
            { echo "initalSetting=200;"; }
            ?>
            
            jQuery( "#connectorHeightSlider" ).slider({
                value: initialSetting,
                min: 50,
                max: 1500,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#connectorHeight" ).val( ui.value + "px" );
                    jQuery( ".connectorWrapper" ).css("height", ui.value + "px" );
                }
            });
            jQuery( "#connectorHeight" ).val( jQuery( "#connectorHeightSlider" ).slider( "value" ) + "px" );
        });
        
        jQuery(function() {

        <?php if(!is_null($style_connector->call_action_height))
            { echo "initialSetting = " . str_replace('px','', $style_connector->call_action_height).";"; }
            else
            { echo "initalSetting=100;"; }
            ?>

            jQuery( "#callToActionHeightSlider" ).slider({
                value: initialSetting,
                min: 50,
                max: 500,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#callToActionHeight" ).val( ui.value + "px" );
                    jQuery( ".optinWrapper" ).css("height", ui.value + "px" );
                }
            });
            jQuery( "#callToActionHeight" ).val( jQuery( "#callToActionHeightSlider" ).slider( "value" ) + "px" );
        });
        
        jQuery(function() {

            <?php if(!is_null($style_connector->opt_in_box_width))
            { echo "initialSetting = " . str_replace('px','', $style_connector->opt_in_box_width).";"; }
            else
            { echo "initalSetting=250;"; }
            ?>

            jQuery( "#connectorWidthSlider" ).slider({
                value: initialSetting,
                min: 150,
                max: 1200,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#connectorWidth" ).val( ui.value + "px" );
                    jQuery( ".connectorWrapper" ).css("width", ui.value + "px" );
                }
            });
            jQuery( "#connectorWidth" ).val( jQuery( "#connectorWidthSlider" ).slider( "value" ) + "px" );
        });


        jQuery(function() {

           <?php if(!is_null($style_image->vertical_position))
            { echo "initialSetting = " . str_replace('px','', $style_image->vertical_position).";"; }
            else
            { echo "initalSetting=0;"; }
            ?>

            jQuery( "#imageVerticalPositionSlider" ).slider({
                value: initialSetting,
                min: -500,
                max: 500,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#imageVerticalPosition" ).val( ui.value + "px" );
                    jQuery( "div.graphicWrapper" ).css("margin-top", ui.value + "px" );
                }
            });
            jQuery( "#imageVerticalPosition" ).val( jQuery( "#imageVerticalPositionSlider" ).slider( "value" ) + "px" );
        });
        
        
        
        jQuery(function() {


        <?php if(!is_null($style_image->image_left_margin))
            { echo "initialSetting = " . str_replace('px','', $style_image->image_left_margin).";"; }
            else
            { echo "initalSetting=0;"; }
            ?>

            jQuery( "#imageLeftMarginSlider" ).slider({
                value: initialSetting,
                min: -200,
                max: 500,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#imageLeftMargin" ).val( ui.value + "px" );
                    jQuery( "div.graphicWrapper" ).css("margin-left", ui.value + "px" );
                }
            });
            jQuery( "#imageLeftMargin" ).val( jQuery( "#imageLeftMarginSlider" ).slider( "value" ) + "px" );
        });
        
        jQuery(function() {

        <?php if(!is_null($style_image->image_right_margin))
            { echo "initialSetting = " . str_replace('px','', $style_image->image_right_margin).";"; }
            else
            { echo "initalSetting=0;"; }
            ?>

            jQuery( "#imageRightMarginSlider" ).slider({
                value: initialSetting,
                min: -200,
                max: 500,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#imageRightMargin" ).val( ui.value + "px" );
                    jQuery( "div.graphicWrapper" ).css("margin-right", ui.value + "px" );
                }
            });
            jQuery( "#imageRightMargin" ).val( jQuery( "#imageRightMarginSlider" ).slider( "value" ) + "px" );
        });
        
        jQuery(function() {

         <?php if(!is_null($style_optin->name_length))
            { echo "initialSetting = " . str_replace('px','', $style_optin->name_length).";"; }
            else
            { echo "initalSetting=130;"; }
            ?>

            jQuery( "#nameFieldLengthSlider" ).slider({
                value: initialSetting,
                min: 10,
                max: 300,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#nameFieldLength" ).val( ui.value + "px" );
                    jQuery( ".nameConnectorInputField" ).css("width", ui.value + "px" );
                }
            });
            jQuery( "#nameFieldLength" ).val( jQuery( "#nameFieldLengthSlider" ).slider( "value" ) + "px" );
            <?php if($my_connector->emailOnly=="1") { ?>
               jQuery("#nameFieldLengthSlider").slider("disable");
            <?php } ?>
        });
        
        
        jQuery(function() {

         <?php if(!is_null($style_optin->email_length))
            { echo "initialSetting = " . str_replace('px','', $style_optin->email_length).";"; }
            else
            { echo "initalSetting=130;"; }
            ?>

            jQuery( "#emailFieldLengthSlider" ).slider({
                value: initialSetting,
                min: 10,
                max: 300,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#emailFieldLength" ).val( ui.value + "px" );
                    jQuery( ".emailConnectorInputField" ).css("width", ui.value + "px" );
                    emailCentre();
                }
            });
            jQuery( "#emailFieldLength" ).val( jQuery( "#emailFieldLengthSlider" ).slider( "value" ) + "px" );
        });
        
        
        jQuery(function() {

         <?php if(!is_null($style_connector->eoh))
            { echo "initialSetting = " . str_replace('px','', $style_connector->eoh).";"; }
            else
            { echo "initalSetting=300;"; }
            ?>

            jQuery( "#emailBoxHeightSlider" ).slider({
                value: initialSetting,
                min: 10,
                max: 1500,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#emailBoxHeight" ).val( ui.value + "px" );
                    jQuery( "div.emailConnectorWrapper" ).css("height", ui.value + "px" );
                    emailCentre();
                }
            });
            jQuery( "#emailBoxHeight" ).val( jQuery( "#emailBoxHeightSlider" ).slider( "value" ) + "px" );
        });
        
        jQuery(function() {

            <?php if(!is_null($style_connector->foh))
            { echo "initialSetting = " . str_replace('px','', $style_connector->foh).";"; }
            else
            { echo "initalSetting=300;"; }
            ?>
            
            jQuery( "#facebookBoxHeightSlider" ).slider({
                value: initialSetting,
                min: 10,
                max: 1500,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#facebookBoxHeight" ).val( ui.value + "px" );
                    jQuery( "div.facebookConnectorWrapper" ).css("height", ui.value + "px" );
                    emailCentre();
                }
            });
            jQuery( "#facebookBoxHeight" ).val( jQuery( "#facebookBoxHeightSlider" ).slider( "value" ) + "px" );
        });
        
        jQuery(function() {

            <?php if(!is_null($style_connector->ooh))
            { echo "initialSetting = " . str_replace('px','', $style_connector->ooh).";"; }
            else
            { echo "initalSetting=300;"; }
            ?>
            
            jQuery( "#oneClickBoxHeightSlider" ).slider({
                value: initialSetting,
                min: 10,
                max: 1500,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#oneClickBoxHeight" ).val( ui.value + "px" );
                    jQuery( "div.oneClickConnectorWrapper" ).css("height", ui.value + "px" );
                    emailCentre();
                }
            });
            jQuery( "#oneClickBoxHeight" ).val( jQuery( "#oneClickBoxHeightSlider" ).slider( "value" ) + "px" );
        });
        
        jQuery(function() {

           <?php if(!is_null($style_connector->ech))
            { echo "initialSetting = " . str_replace('px','', $style_connector->ech).";"; }
            else
            { echo "initalSetting=150;"; }
            ?>

            jQuery( "#emailCallToActionHeightSlider" ).slider({
                value: initialSetting,
                min: 10,
                max: 700,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#emailCallToActionHeight" ).val( ui.value + "px" );
                    jQuery( "div.emailOptinWrapper" ).css("height", ui.value + "px" );
                    emailCentre();
                }
            });
            jQuery( "#emailCallToActionHeight" ).val( jQuery( "#emailCallToActionHeightSlider" ).slider( "value" ) + "px" );
        });
        
        jQuery(function() {

         <?php if(!is_null($style_connector->fch))
            { echo "initialSetting = " . str_replace('px','', $style_connector->fch).";"; }
            else
            { echo "initalSetting=150;"; }
            ?>

            jQuery( "#facebookCallToActionHeightSlider" ).slider({
                value: initialSetting,
                min: 10,
                max: 700,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#facebookCallToActionHeight" ).val( ui.value + "px" );
                    jQuery( "div.facebookOptinWrapper" ).css("height", ui.value + "px" );
                    emailCentre();
                }
            });
            jQuery( "#facebookCallToActionHeight" ).val( jQuery( "#facebookCallToActionHeightSlider" ).slider( "value" ) + "px" );
        });
        
        jQuery(function() {

            <?php if(!is_null($style_connector->och))
            { echo "initialSetting = " . str_replace('px','', $style_connector->och).";"; }
            else
            { echo "initalSetting=150;"; }
            ?>

            jQuery( "#oneClickCallToActionHeightSlider" ).slider({
                value: initialSetting,
                min: 10,
                max: 700,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#oneClickCallToActionHeight" ).val( ui.value + "px" );
                    jQuery( "div.oneClickOptinWrapper" ).css("height", ui.value + "px" );
                    emailCentre();
                }
            });
            jQuery( "#oneClickCallToActionHeight" ).val( jQuery( "#oneClickCallToActionHeightSlider" ).slider( "value" ) + "px" );
        });
        
        jQuery(function() {

           <?php if(!is_null($style_connector->border_width))
            { echo "initialSetting = " . str_replace('px','', $style_connector->border_width).";"; }
            else
            { echo "initalSetting=400;"; }
            ?>
            
            jQuery("#borderWidthSlider" ).slider({
                value: initialSetting,
                min: 0,
                max: 15,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#borderWidth" ).val( ui.value + "px" );
                    jQuery( "div.connectorWrapper" ).css("border-width", ui.value + "px" );
                }
            });
            jQuery( "#borderWidth" ).val( jQuery( "#borderWidthSlider" ).slider( "value" ) + "px" );
        });
jQuery(function() {

            <?php if(!is_null($style_connector->border_radius))
            { echo "initialSetting = " . str_replace('px','', $style_connector->border_radius).";"; }
            else
             { echo "initalSetting=1;"; }
            ?>
            
            jQuery("#roundedCornerSlider" ).slider({
                value: initialSetting,
                min: 0,
                max: 50,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#roundedCornerWidth" ).val( ui.value + "px" );
                    jQuery( "div.connectorWrapper" ).css("border-radius", ui.value + "px" );
		    jQuery( "div.optinWrapper").css("border-bottom-left-radius", ui.value + "px" );
		    jQuery( "div.optinWrapper").css("border-bottom-right-radius", ui.value + "px" );
                }
            });
            jQuery( "#roundedCornerWidth" ).val( jQuery( "#roundedCornerSlider" ).slider( "value" ) + "px" );
        });
        
        
        jQuery(function() {

            <?php if(!is_null($style_text->text_vertical_position))
            { echo "initialSetting = " . str_replace('px','', $style_text->text_vertical_position).";"; }
            else
            { echo "initalSetting=0;"; }
            ?>

            jQuery("#bodyTextVerticalPositionSlider" ).slider({
                value: initialSetting,
                min: -200,
                max: 500,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#bodyTextVerticalPosition" ).val( ui.value + "px" );
                    jQuery( "p.connectorHeadline" ).css("padding-top", ui.value + "px" );
                }
            });
            jQuery( "#bodyTextVerticalPosition" ).val( jQuery( "#bodyTextVerticalPositionSlider" ).slider( "value" ) + "px" );
        });
        
        //button settings slider
        jQuery(function() {
            <?php if(!is_null($style_button->button_font_size))
            { echo "initialSetting = " . str_replace('px','', $style_button->button_font_size).";"; }
            else
             { echo "initalSetting=16;"; }
            ?>
            
            jQuery( "#buttonFontSizeSlider" ).slider({
                value: initialSetting,
                min: 5,
                max:40,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#buttonFontSize" ).val( ui.value + "px" );
                    jQuery( "#templateCode .navButton" ).css("font-size", ui.value + "px" );
                }
            });
            jQuery( "#buttonFontSize" ).val( jQuery( "#buttonFontSizeSlider" ).slider( "value" ) + "px" );
        });
        
          jQuery(function() {

          <?php if(!is_null($style_button->button_lr_padding))
            { echo "initialSetting = " . str_replace('px','', $style_button->button_lr_padding).";"; }
            else
           { echo "initalSetting=50;"; }
            ?>

            jQuery( "#buttonLRPaddingSlider" ).slider({
                value: initialSetting,
                min: 0,
                max:200,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#buttonLRPadding" ).val( ui.value + "px" );
                    jQuery( "#templateCode .navButton" ).css("padding-left", ui.value + "px" );
                    jQuery( "#templateCode .navButton" ).css("padding-right", ui.value + "px" );
                }
            });
            jQuery( "#buttonLRPadding" ).val( jQuery( "#buttonLRPaddingSlider" ).slider( "value" ) + "px" );
        });
        
         jQuery(function() {

            <?php if(!is_null($style_button->button_tb_padding))
            { echo "initialSetting = " . str_replace('px','', $style_button->button_tb_padding).";"; }
            else
            { echo "initalSetting=50;"; }
            ?>
            
            jQuery( "#buttonTBPaddingSlider" ).slider({
                value: initialSetting,
                min: 0,
                max:200,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#buttonTBPadding" ).val( ui.value + "px" );
                    jQuery( "#templateCode .navButton" ).css("padding-top", ui.value + "px" );
                    jQuery( "#templateCode .navButton" ).css("padding-bottom", ui.value + "px" );
                }
            });
            jQuery( "#buttonTBPadding" ).val( jQuery( "#buttonTBPaddingSlider" ).slider( "value" ) + "px" );
        });
        
        jQuery(function() {
             <?php if(!is_null($style_connector->h_shadow))
            { echo "initialSetting = " . str_replace('px','', $style_connector->h_shadow).";"; }
            else
            { echo "initalSetting=2;"; }
            ?>

            jQuery("#hShadowSlider" ).slider({
                value: initialSetting,
                min: -100,
                max: 100,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#hShadow" ).val( ui.value + "px" );
                    updateShadow();
                }
            });
            jQuery( "#hShadow" ).val( jQuery( "#hShadowSlider" ).slider( "value" ) + "px" );
        });
        
         jQuery(function() {

            <?php if(!is_null($style_connector->v_shadow))
            { echo "initialSetting = " . str_replace('px','', $style_connector->v_shadow).";"; }
            else
            { echo "initalSetting=2;"; }
            ?>
            
            jQuery("#vShadowSlider" ).slider({
                value: initialSetting,
                min: -100,
                max: 100,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#vShadow" ).val( ui.value + "px" );
                    updateShadow();
                }
            });
            jQuery( "#vShadow" ).val( jQuery("#vShadowSlider" ).slider( "value" ) + "px" );
        });
        
        
         jQuery(function() {

         <?php if(!is_null($style_connector->blur_shadow))
            { echo "initialSetting = " . str_replace('px','', $style_connector->blur_shadow).";"; }
            else
            { echo "initalSetting=2;"; }
            ?>

            jQuery("#blurShadowSlider" ).slider({
                value: initialSetting,
                min: 0,
                max: 100,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#blurShadow" ).val( ui.value + "px" );
                    updateShadow();
                }
            });
            jQuery( "#blurShadow" ).val( jQuery( "#blurShadowSlider" ).slider( "value" ) + "px" );
        });
        
        jQuery('input[name=shadowColor]').miniColors({ change: function(hex, rgb) { updateShadow(); } });
        
        
        jQuery(function() {

              <?php if(!is_null($style_text->text_h_Shadow))
            { echo "initialSetting = " . str_replace('px','', $style_text->text_h_Shadow).";"; }
            else
            { echo "initalSetting=2;"; }
            ?>
            
            jQuery("#textHShadowSlider" ).slider({
                value: initialSetting,
                min: -20,
                max: 20,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#textHShadow" ).val( ui.value + "px" );
                    updateTextShadow();
                }
            });
            jQuery( "#textHShadow" ).val( jQuery( "#textHShadowSlider" ).slider( "value" ) + "px" );
        });
        
        jQuery(function() {

           <?php if(!is_null($style_text->text_v_Shadow))
            { echo "initialSetting = " . str_replace('px','', $style_text->text_v_Shadow).";"; }
            else
            { echo "initalSetting=2;"; }
            ?>

            jQuery("#textVShadowSlider" ).slider({
                value: initialSetting,
                min: -20,
                max: 20,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#textVShadow" ).val( ui.value + "px" );
                    updateTextShadow();
                }
            });
            jQuery( "#textVShadow" ).val( jQuery( "#textVShadowSlider" ).slider( "value" ) + "px" );
        });
        
        jQuery(function() {

            <?php if(!is_null($style_text->text_blur_shadow))
            { echo "initialSetting = " . str_replace('px','', $style_text->text_blur_shadow).";"; }
            else
            { echo "initalSetting=2;"; }
            ?>

            jQuery("#textBlurShadowSlider" ).slider({
                value: initialSetting,
                min: 0,
                max: 30,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#textBlurShadow" ).val( ui.value + "px" );
                    updateTextShadow();
                }
            });
            jQuery( "#textBlurShadow" ).val( jQuery( "#textBlurShadowSlider" ).slider( "value" ) + "px" );
        });
        
        jQuery(function() {

         <?php if(!is_null($style_text->headline_left_margin))
            { echo "initialSetting = " . str_replace('px','', $style_text->headline_left_margin).";"; }
            else
            { echo "initalSetting=10;"; }
            ?>
            
            jQuery("#headlineLeftMarginSlider" ).slider({
                value: initialSetting,
                min: 0,
                max: 500,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#headlineLeftMargin" ).val( ui.value + "px" );
                    jQuery( "p.connectorHeadline" ).css( "margin-left", ui.value + "px");
                }
            });
            jQuery( "#headlineLeftMargin" ).val( jQuery( "#headlineLeftMarginSlider" ).slider( "value" ) + "px" );
        });
        
        jQuery(function() {

         <?php if(!is_null($style_text->headline_right_margin))
            { echo "initialSetting = " . str_replace('px','', $style_text->headline_right_margin).";"; }
            else
            { echo "initalSetting=10;"; }
            ?>
            
            jQuery("#headlineRightMarginSlider" ).slider({
                value: initialSetting,
                min: 0,
                max: 500,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#headlineRightMargin" ).val( ui.value + "px" );
                    jQuery( "p.connectorHeadline" ).css( "margin-right", ui.value + "px");
                }
            });
            jQuery( "#headlineRightMargin" ).val( jQuery( "#headlineRightMarginSlider" ).slider( "value" ) + "px" );
        });
        
        jQuery(function() {

        <?php if(!is_null($style_text->text_left_margin))
            { echo "initialSetting = " . str_replace('px','', $style_text->text_left_margin).";"; }
            else
            { echo "initalSetting=10;"; }
            ?>

            jQuery("#textLeftMarginSlider" ).slider({
                value: initialSetting,
                min: 0,
                max: 500,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#textLeftMargin" ).val( ui.value + "px" );
                    jQuery( "div.connectorDescriptionText p").css( "margin-left", ui.value + "px");
                }
            });
            jQuery( "#textLeftMargin" ).val( jQuery( "#textLeftMarginSlider" ).slider( "value" ) + "px" );
        });
        
        jQuery(function() {

         <?php if(!is_null($style_text->text_right_margin))
            { echo "initialSetting = " . str_replace('px','', $style_text->text_right_margin).";"; }
            else
            { echo "initalSetting=10;"; }
            ?>

            jQuery("#textRightMarginSlider" ).slider({
                value: initialSetting,
                min: 0,
                max: 500,
                step: 1,
                slide: function( event, ui ) {
                    jQuery( "#textRightMargin" ).val( ui.value + "px" );
                    jQuery( "div.connectorDescriptionText p").css( "margin-right", ui.value + "px");
                }
            });
            jQuery( "#textRightMargin" ).val( jQuery( "#textRightMarginSlider" ).slider( "value" ) + "px" );
        });
        
        jQuery(function() {

        <?php if(!is_null($style_text->bullet_left_margin))
            { echo "initialSetting = " . str_replace('px','', $style_text->bullet_left_margin).";"; }
            else
            { echo "initalSetting=30;"; }
            ?>

            jQuery("#bulletLeftMarginSlider" ).slider({
                value: initialSetting,
                min: 0,
                max: 500,
                step: 1,
                slide: function( event, ui ) {
                    jQuery("#bulletLeftMargin" ).val( ui.value + "px" );
                    jQuery("div.connectorDescriptionText ul").css( "margin-left", ui.value + "px");
                }
            });
            jQuery( "#bulletLeftMargin" ).val( jQuery( "#bulletLeftMarginSlider" ).slider( "value" ) + "px" );
        });
        
        
        jQuery(function() {

         <?php if(!is_null($style_connector->privacy_policy_size))
            { echo "initialSetting = " . str_replace('px','', $style_connector->privacy_policy_size).";"; }
            else
            { echo "initalSetting=10;"; }
            ?>

            jQuery("#privacyPolicySizeSlider" ).slider({
                value: initialSetting,
                min: 0,
                max: 30,
                step: 1,
                slide: function( event, ui ) {
                    jQuery("#privacyPolicySize" ).val( ui.value + "px" );
                    jQuery(".privacyPolicy span").css( "font-size", ui.value + "px");
                }
            });
            jQuery( "#privacyPolicySize" ).val( jQuery( "#privacyPolicySizeSlider" ).slider( "value" ) + "px" );
        });
        
        
         jQuery(function() {

          <?php if(!is_null($style_optin->field_font_size))
            { echo "initialSetting = " . str_replace('px','', $style_optin->field_font_size).";"; }
            else
            { echo "initalSetting=10;"; }
            ?>

            jQuery("#fieldFontSizeSlider" ).slider({
                value: initialSetting,
                min: 0,
                max: 30,
                step: 1,
                slide: function( event, ui ) {
                    jQuery("#fieldFontSize" ).val( ui.value + "px" );
                    jQuery("#templateCode .connectorInputFields").css( "font-size", ui.value + "px");
                }
            });
            jQuery( "#fieldFontSize" ).val( jQuery( "#fieldFontSizeSlider" ).slider( "value" ) + "px" );
        });
        
         jQuery(function() {

         <?php if(!is_null($style_optin->field_height))
            { echo "initialSetting = " . str_replace('px','', $style_optin->field_height).";"; }
            else
            { echo "initalSetting=10;"; }
            ?>
            
            jQuery("#fieldHeightSlider" ).slider({
                value: initialSetting,
                min: 0,
                max: 300,
                step: 1,
                slide: function( event, ui ) {
                    jQuery("#fieldHeight" ).val( ui.value + "px" );
                    jQuery("#templateCode .connectorInputFields").css( "height", ui.value + "px");
                }
            });
            jQuery( "#fieldHeight" ).val( jQuery( "#fieldHeightSlider" ).slider( "value" ) + "px" );
        });
        
        
         jQuery(function() {

         <?php if(!is_null($style_optin->field_padding_top_bottom))
            { echo "initialSetting = " . str_replace('px','', $style_optin->field_padding_top_bottom).";"; }
            else
            { echo "initalSetting=10;"; }
            ?>

            jQuery("#fieldPaddingTopBottomSlider" ).slider({
                value: initialSetting,
                min: 0,
                max: 30,
                step: 1,
                slide: function( event, ui ) {
                    jQuery("#fieldPaddingTopBottom" ).val( ui.value + "px" );
                    jQuery("#templateCode .connectorInputFields").css( "padding-top", ui.value + "px");
                    jQuery("#templateCode .connectorInputFields").css( "padding-bottom", ui.value + "px");
                }
            });
            jQuery( "#fieldPaddingTopBottom" ).val( jQuery( "#fieldPaddingTopBottomSlider" ).slider( "value" ) + "px" );
        });
        
        jQuery(function() {

           <?php if(!is_null($style_optin->field_padding_left_right))
            { echo "initialSetting = " . str_replace('px','', $style_optin->field_padding_left_right).";"; }
            else
            { echo "initalSetting=10;"; }
            ?>

            jQuery("#fieldPaddingLeftRightSlider" ).slider({
                value: initialSetting,
                min: 0,
                max: 30,
                step: 1,
                slide: function( event, ui ) {
                    jQuery("#fieldPaddingLeftRight" ).val( ui.value + "px" );
                    jQuery("#templateCode .connectorInputFields").css( "padding-left", ui.value + "px");
                    jQuery("#templateCode .connectorInputFields").css( "padding-right", ui.value + "px");
                }
            });
            jQuery( "#fieldPaddingLeftRight" ).val( jQuery( "#fieldPaddingLeftRightSlider" ).slider( "value" ) + "px" );
        });
        
        
        jQuery(function() {

         <?php if(!is_null($style_optin->field_border_width))
            { echo "initialSetting = " . str_replace('px','', $style_optin->field_border_width).";"; }
            else
            { echo "initalSetting=1;"; }
            ?>

            jQuery("#fieldBorderWidthSlider" ).slider({
                value: initialSetting,
                min: 0,
                max: 10,
                step: 1,
                slide: function( event, ui ) {
                    jQuery("#fieldBorderWidth" ).val( ui.value + "px" );
                    jQuery("#templateCode .connectorInputFields").css( "border-width", ui.value + "px");
                }
            });
            jQuery( "#fieldBorderWidth" ).val( jQuery( "#fieldBorderWidthSlider" ).slider( "value" ) + "px" );
        });
        
        jQuery(function() {

        <?php if(!is_null($style_optin->field_border_radius))
            { echo "initialSetting = " . str_replace('px','', $style_optin->field_border_radius).";"; }
            else
            { echo "initalSetting=1;"; }
            ?>

            jQuery("#fieldBorderRadiusSlider" ).slider({
                value: initialSetting,
                min: 0,
                max: 10,
                step: 1,
                slide: function( event, ui ) {
                    jQuery("#fieldBorderRadius" ).val( ui.value + "px" );
                    jQuery("#templateCode .connectorInputFields").css( "border-radius", ui.value + "px");
                }
            });
            jQuery( "#fieldBorderRadius" ).val( jQuery( "#fieldBorderRadiusSlider" ).slider( "value" ) + "px" );
        });
        
        jQuery(function() {

         <?php if(!is_null($style_connector->email_privacy_top_margin))
            { echo "initialSetting = " . str_replace('px','', $style_connector->email_privacy_top_margin).";"; }
            else
            { echo "initalSetting=50;"; }
            ?>

            jQuery("#emailPrivacyPolicyMarginSlider" ).slider({
                value: initialSetting,
                min: 0,
                max: 100,
                step: 1,
                slide: function( event, ui ) {
                    jQuery("#emailPrivacyPolicyMargin" ).val( ui.value + "px" );
                    jQuery(".privacyPolicyEmail").css( "margin-top", ui.value + "px");
                }
            });
            jQuery( "#emailPrivacyPolicyMargin" ).val( jQuery( "#emailPrivacyPolicyMarginSlider" ).slider( "value" ) + "px" );
        });
        
        jQuery(function() {

        <?php if(!is_null($style_connector->facebook_privacy_top_margin))
            { echo "initialSetting = " . str_replace('px','', $style_connector->facebook_privacy_top_margin).";"; }
            else
            { echo "initalSetting=50;"; }
            ?>

            jQuery("#facebookPrivacyPolicyMarginSlider" ).slider({
                value: initialSetting,
                min: 0,
                max: 100,
                step: 1,
                slide: function( event, ui ) {
                    jQuery("#facebookPrivacyPolicyMargin" ).val( ui.value + "px" );
                    jQuery(".privacyPolicyFacebook").css( "margin-top", ui.value + "px");
                }
            });
            jQuery( "#facebookPrivacyPolicyMargin" ).val( jQuery( "#facebookPrivacyPolicyMarginSlider" ).slider( "value" ) + "px" );
        });
        
        
        jQuery(function() {

         <?php if(!is_null($style_connector->oneclick_privacy_top_margin))
            { echo "initialSetting = " . str_replace('px','', $style_connector->oneclick_privacy_top_margin).";"; }
            else
            { echo "initalSetting=50;"; }
            ?>

            jQuery("#oneClickPrivacyPolicyMarginSlider" ).slider({
                value: initialSetting,
                min: 0,
                max: 100,
                step: 1,
                slide: function( event, ui ) {
                    jQuery("#oneClickPrivacyPolicyMargin" ).val( ui.value + "px" );
                    jQuery(".privacyPolicyOneClick").css( "margin-top", ui.value + "px");
                }
            });
            jQuery( "#oneClickPrivacyPolicyMargin" ).val( jQuery( "#oneClickPrivacyPolicyMarginSlider" ).slider( "value" ) + "px" );
        });
        
        
        jQuery(function() {

        <?php if(!is_null($style_connector->external_top_margin))
            { echo "initialSetting = " . str_replace('px','', $style_connector->external_top_margin).";"; }
            else
            { echo "initalSetting=50;"; }
            ?>

            jQuery("#externalTopMarginSlider" ).slider({
                value: initialSetting,
                min: 0,
                max: 100,
                step: 1,
                slide: function( event, ui ) {
                    jQuery("#externalTopMargin" ).val( ui.value + "px" );
                    jQuery(".facebookConnectorWrapper").css( "margin-top", ui.value + "px");
                }
            });
            jQuery( "#externalTopMargin" ).val( jQuery( "#externalTopMarginSlider" ).slider( "value" ) + "px" );
        });
        
        
        jQuery(function() {

         <?php if(!is_null($style_connector->external_bottom_margin))
            { echo "initialSetting = " . str_replace('px','', $style_connector->external_bottom_margin).";"; }
            else
            { echo "initalSetting=50;"; }
            ?>

            jQuery("#externalBottomMarginSlider" ).slider({
                value: initialSetting,
                min: 0,
                max: 100,
                step: 1,
                slide: function( event, ui ) {
                    jQuery("#externalBottomMargin" ).val( ui.value + "px" );
                    jQuery(".facebookConnectorWrapper").css( "margin-bottom", ui.value + "px");
                }
            });
            jQuery( "#externalBottomMargin" ).val( jQuery( "#externalBottomMarginSlider" ).slider( "value" ) + "px" );
        });
        
        
        jQuery(function() {

         <?php if(!is_null($style_image->image_size))
            { echo "initialSetting = " . str_replace('px','', $style_image->image_size).";"; }
            else
            { echo "initalSetting=200;"; }
            ?>

            jQuery("#sideImageSlider" ).slider({
                value: initialSetting,
                min: 0,
                max: 900,
                step: 1,
                slide: function( event, ui ) {
                    jQuery("#sideImageSize" ).val( ui.value + "px" );
                    jQuery("img.optinGraphic").css( "width", ui.value + "px");
                    
                }
            });
            jQuery( "#sideImageSize" ).val( jQuery( "#sideImageSlider" ).slider( "value" ) + "px" );
        });
        
         <?php if($style_connector->type=="2") { ?>
         


          jQuery(function() {

            <?php if($lightbox_options->optin_scroll_size) { echo "initialSetting =" . str_replace("%", "", $lightbox_options->optin_scroll_size) . ";"; } else { echo "initialSetting = 10;"; } ?>;
            jQuery("#optinBarScrollEnableSlider").slider({
                value: initialSetting,
                min: 0,
                max: 100,
                step: 1,
                slide: function (event,ui) {
                  jQuery("#optinbarScrollSize").val(ui.value+ "%");
                }
            });
            jQuery("#optinbarScrollSize" ).val(jQuery("#optinBarScrollEnableSlider").slider("value") + "%" );
        });
        
        

         
         
          jQuery(function() {

             <?php if($lightbox_options->optin_on_time) { echo "initialSetting =" . $lightbox_options->optin_on_time; } else { echo "initialSetting = 5;"; } ?>;
            jQuery("#optinBarAfterPageLoadSlider").slider({
                value: initialSetting,
                min: 0,
                max: 300,
                step: 1,
                slide: function (event,ui) {
                  jQuery("#optinBarOnTime").val(ui.value+ " seconds");
                }
            });
            jQuery("#optinTopBottomMargin" ).val(jQuery("#optinBarAfterPageLoadSlider").slider("value") + " seconds" );
        });
         
         
          jQuery(function() {

             <?php if($lightbox_options->optin_slide_in_distance) { echo "initialSetting =" . str_replace("px", "", $lightbox_options->optin_slide_in_distance) . ";"; } else { echo "initialSetting = 10;"; } ?>;
            jQuery("#optinTopBottomMarginSlider").slider({
                value: initialSetting,
                min: 0,
                max: 200,
                step: 1,
                start: function (event, ui) {
                  slideInPreview("true");
                },
                slide: function (event,ui) {
                  slideInPreviewMoveLeftRight(ui.value+ "px", "vertical");
                  jQuery("#optinTopBottomMargin" ).val( ui.value + "px" );
                },
                stop: function (event,ui) {
                    slideInPreview("false");
                }
            });
            jQuery("#optinTopBottomMargin" ).val(jQuery("#optinTopBottomMarginSlider").slider("value") + "px" );
        });
        
        
         jQuery(function() {

            <?php if($lightbox_options->optin_start_pos_value) { echo "initialSetting =" . str_replace("px", "", $lightbox_options->optin_start_pos_value) . ";"; } else { echo "initialSetting = 10;"; } ?>;
            jQuery("#optinLeftRightMarginSlider").slider({
                value: initialSetting,
                min: 0,
                max: 200,
                step: 1,
                start: function (event, ui) {
                  slideInPreview("true");
                },
                slide: function (event,ui) {
                  slideInPreviewMoveLeftRight(ui.value+ "px", "horizontal");
                  jQuery("#optinLeftRightMargin" ).val( ui.value + "px" );
                },
                stop: function (event,ui) {
                    slideInPreview("false");
                }
            });
            jQuery("#optinLeftRightMargin" ).val(jQuery("#optinLeftRightMarginSlider").slider("value") + "px" );
        });
        
        
         jQuery(function() {

           <?php if($lightbox_options->optin_ani_duration) { echo "initialSetting =" . str_replace("ms", "", $lightbox_options->optin_ani_duration) . ";"; } else { echo "initialSetting = 10;"; } ?>;
            jQuery("#optinAnimationDurationSlider" ).slider({
                value: initialSetting,
                min: 0,
                max: 3000,
                step: 1,
                slide: function( event, ui ) {
                    jQuery("#optinAnimationDuration" ).val( ui.value + "ms" );

                }
            });
            jQuery( "#optinAnimationDuration" ).val( jQuery( "#optinAnimationDurationSlider" ).slider( "value" ) + "ms" );
        });
        
        
         jQuery(function() {

          <?php if(!is_null($lightbox_options->on_time))
            { echo "initialSetting = " . str_replace('px','', $lightbox_options->on_time).";"; }
            else
            { echo "initalSetting=0;"; }
            ?>

            if(!initialSetting) { initialSetting=10; }
            jQuery("#timeAfterPageLoadSlider" ).slider({
                value: initialSetting,
                min: 0,
                max: 500,
                step: 1,
                slide: function( event, ui ) {
                    jQuery("#hc_lb_on_time" ).val( ui.value + " seconds" );

                }
            });
            jQuery( "#hc_lb_on_time" ).val( jQuery( "#timeAfterPageLoadSlider" ).slider( "value" ) + " seconds" );
        });
        


         jQuery(function() {

            <?php if($lightbox_options->scroll_size) { echo "initialSetting =" . str_replace("%", "", $lightbox_options->scroll_size) . ";"; } else echo "initialSetting = 10;"; ?>;
            jQuery("#scrollSizeSlider" ).slider({
                value: initialSetting,
                min: 0,
                max: 100,
                step: 1,
                slide: function( event, ui ) {
                    jQuery("#scroll_size" ).val( ui.value + "%" );

                }
            });
            jQuery( "#scroll_size" ).val( jQuery( "#scrollSizeSlider" ).slider( "value" ) + "%" );
        });
        
        
        jQuery(function() {
            <?php if(!is_null($lightbox_options->lightbox_overlay_opacity)) { echo "initialSetting =" . str_replace("%", "", ($lightbox_options->lightbox_overlay_opacity * 100)) . ";"; } else echo "initialSetting = 80;"; ?>;
            jQuery("#overlayOpacitySlider" ).slider({
                value: initialSetting,
                min: 0,
                max: 100,
                step: 1,
                slide: function( event, ui ) {
                    jQuery("#overlayOpacity" ).val( ui.value + "%" );

                }
            });
            jQuery( "#overlayOpacity" ).val( jQuery( "#overlayOpacitySlider" ).slider( "value" ) + "%" );
        });
        
        
        jQuery(function() {

            <?php if($lightbox_options->lightbox_fade_duration) { echo "initialSetting =" . str_replace("ms", "", $lightbox_options->lightbox_fade_duration) . ";"; } else echo "initialSetting = 400;"; ?>;
            jQuery("#lightboxFadeDurationSlider" ).slider({
                value: initialSetting,
                min: 0,
                max: 1000,
                step: 1,
                slide: function( event, ui ) {
                    jQuery("#lightboxFadeDuration" ).val( ui.value + " ms" );

                }
            });
            jQuery( "#lightboxFadeDuration" ).val( jQuery( "#lightboxFadeDurationSlider" ).slider( "value" ) + " ms" );
        });
        
         <?php } ?>
        
       <?php if($style_connector->type=="3") { ?>
        
        jQuery(function() {
             <?php if($squeeze_options->vertical_top_margin) { echo "initialSetting =" . str_replace("px", "", $squeeze_options->vertical_top_margin) . ";"; } else echo "initialSetting = 200;"; ?>;
            jQuery("#optinTopMarginSlider" ).slider({
                value: initialSetting,
                min: 0,
                max: 500,
                step: 1,
                slide: function( event, ui ) {
                    jQuery("#optinTopMargin" ).val( ui.value + "px" );
                    jQuery("#marginDisplay" ).html( "<b>" + ui.value + "px</b> margin from top" );

                }
            });
            jQuery( "#optinTopMargin" ).val( jQuery( "#optinTopMarginSlider" ).slider( "value" ) + "px" );
        });
        
        <?php } ?>
        
          /* initial settings for controls */
       <?php if ($style_connector->set_heights == 1): ?> jQuery('#connectorHeightSlider').slider("disable"); <?php endif?>
       <?php if ($style_connector->set_heights == 1): ?> jQuery('#callToActionHeightSlider').slider("disable"); <?php endif?>

       jQuery('#externalTopMarginSlider').slider("disable");
       jQuery('#externalBottomMarginSlider').slider("disable");

       <?php if($style_connector->type=="3" && $squeeze_options->centre_aligned) {  ?>
       jQuery("#optinTopMarginSlider").slider("disable");
       <?php } ?>
       
       checkBackgroundScalar();
       scrollOptionsClick();
       timeOptionsClick();
       lightboxDropDown();


        
<?php if ($style_connector->is_responsive == 1): ?>
        makeTemplateResponsive();
<?php endif ?>
      jQuery('input[name=responsive]').click(makeTemplateResponsive);
      function changeWrapperBG()
      {
          bgColor = jQuery("input#connectorBGColor").val();
          jQuery(".connectorWrapper").css("background-color", bgColor);
      }
      function changeOptInBG()
      {
          bgColor = jQuery("input#OptinBGColor").val();
          jQuery(".optinWrapper").css("background-color", bgColor);
      }
	    function templateGradientColor()
      {
      color1 =  jQuery("#templateBGColor1").val();
      color2 =  jQuery("#templateBGColor2").val();
      jQuery('.connectorWrapper').css({background: '-webkit-gradient(linear, left top, left bottom, from(' + color2  + '), to(' + color1 + '))'});
      jQuery(".connectorWrapper").css("background", "-moz-linear-gradient( center top, " + color1 + " 0%, " + color2 + " 100% )");
      jQuery(".connectorWrapper").css("filter", "progid:DXImageTransform.Microsoft.gradient(startColorstr='" + color1 + "', endColorstr='" + color2 + "')");
      jQuery(".connectorWrapper").css("background", "-ms-linear-gradient(top,  " + color1 + " 0%," +color2 + " 100%)");
      jQuery(".connectorWrapper").css("background", "-webkit-linear-gradient(top, " + color1 + " 0%, " + color2 + " 100%)");
      jQuery(".connectorWrapper").css("background", " -o-linear-gradient(top,  " + color1 + " 0%, " + color2 + " 100%)");
      jQuery(".connectorWrapper").css("background", "background: linear-gradient(to bottom,  " + color1 + " 0%, " + color2 + " 100%)");
      }
      function inputFieldBorder()
      {
          border = jQuery("input#inputFieldBorderColor").val();
          jQuery("input.connectorInputFields").css("border-color", border);
      }
      function inputFieldBackgroundColor()
      {
          color= jQuery("input#inputFieldBackgroundColor").val();
          jQuery("input.connectorInputFields").css("background", color);
      }
      function headlineTextColor()
      {
          color = jQuery("input#headlineTextColor").val();
          jQuery("p.connectorHeadline").css("color", color);
      }
      function callToActionTextColor()
      {
          color = jQuery("input#callToActionTextColor").val();
          jQuery("p.connectorCallToAction").css("color", color);
      }
      function buttonFontColorFunction()
      {
          color = jQuery("input#buttonFontColor").val();
          jQuery("a#emailSignUpButton").css("color", color);
          jQuery("a#oneClickSignupButton").css("color", color);
      }
      function buttonTextShadowColorFunction()
      {
          color = jQuery("input#buttonTextShadowColor").val();
          jQuery("a.navButton").css("text-shadow", "1px 1px 0px " + color);
      }
      function buttonBoxShadowFunction() {
          color = jQuery("input#buttonBoxShadow").val();
          jQuery("a.navButton").css("-moz-box-shadow", "inset 0px 1px 0px 0px " + color);
          jQuery("a.navButton").css("-webkit-box-shadow", "inset 0px 1px 0px 0px " + color);
          jQuery("a.navButton").css("box-shadow", "inset 0px 1px 0px 0px " + color);
      }
      function buttonBorderColorFunction()
      {
          color = jQuery("input#buttonBorderColor").val();
          jQuery("a.navButton").css("border", "1px solid " + color);
      }
      function bodyTextColor()
      {
          color = jQuery("input#bodyTextColor").val();
          jQuery("div.connectorDescriptionText").css("color", color);
          jQuery("div.connectorDescriptionText p").css("color", color);
          jQuery("div.connectorDescriptionText li").css("color", color);
      }
      function inputTextColor()
      {
          color = jQuery("input#inputTextColor").val();
          jQuery("input.connectorInputFields").css("color", color);
      }
      function borderColor()
      {
          color = jQuery("input#borderColor").val();
          jQuery(".connectorWrapper").css("border-color", color);
      }
      function headlineFont()
      {
          font = jQuery("select#headlineFont").val();
          jQuery("p.connectorHeadline").css("font-family", font);
      }
      function inputTextFont()
      {
          font = jQuery("select#inputTextFont").val();
          jQuery("input.connectorInputFields").css("font-family", font);
      }
      
      function borderStyle()
      {
          newBorderStyle = jQuery("select#borderStyle").val();
          jQuery("div.connectorWrapper").css("border-style",newBorderStyle);
      }
      
      function fieldBorderStyle()
      {
          newBorderStyle = jQuery("select#fieldBorderStyle").val();
          jQuery("#templateCode .connectorInputFields").css("border-style",newBorderStyle);
      }
      
      function buttonTextFontFunction()
      {
          font = jQuery("select#buttonTextFont").val();
          jQuery("a.navButton").css("font-family", font);
      }
      function buttonColourType() {
          button = jQuery("select#buttonColourType").val();
          switch (button)
          {
              case 'Silver':

                  backgroundColor = '#ededed';
                  textShadowColor = '#ffffff';
                  buttonFontColor = '#777777';
                  buttonBorderColor = '#dcdcdc';
                  buttonBoxShadow = '#ffffff';
                  secondaryColor = shadeColor(backgroundColor, -50);
                  //background colour
                  jQuery(".navButton").css("background", backgroundColor);
                  jQuery('.navButton').css({background: '-webkit-gradient(linear, left top, left bottom, from(' + backgroundColor  + '), to(' + secondaryColor + '))'});
                  jQuery(".navButton").css("background", "-moz-linear-gradient( center top, " + secondaryColor + " 5%, " + backgroundColor + " 100% )");
                  jQuery(".navButton").css("filter", "progid:DXImageTransform.Microsoft.gradient(startColorstr='" + backgroundColor + "', endColorstr='" + secondaryColor + "')");
                  //button box shadow
                  jQuery("a.navButton").css("-moz-box-shadow", "inset 0px 1px 0px 0px " + buttonBoxShadow);
                  jQuery("a.navButton").css("-webkit-box-shadow", "inset 0px 1px 0px 0px " + buttonBoxShadow);
                  jQuery("a.navButton").css("box-shadow", "inset 0px 1px 0px 0px " + buttonBoxShadow);
                  //button text shadow colour
                  jQuery("a.navButton").css("text-shadow", "1px 1px 0px " + textShadowColor);
                  //button font colour
                  jQuery("a#emailSignUpButton").css("color", buttonFontColor);
                  jQuery("a#oneClickSignupButton").css("color", buttonFontColor);
                  //button border colour
                  jQuery("a.navButton").css("border", "1px solid " + buttonBorderColor);
                  // set all input fields to match current colour scheme
                  jQuery("input#buttonBackgroundColor").miniColors('value', [backgroundColor]);
                  jQuery("input#buttonBorderColor").miniColors('value', [buttonBorderColor]);
                  jQuery("input#buttonBoxShadow").miniColors('value', [buttonBoxShadow]);
                  jQuery("input#buttonTextShadowColor").miniColors('value', [textShadowColor]);
                  jQuery("input#buttonFontColor").miniColors('value', [buttonFontColor]);
                  break;
              case 'Orange':

                  backgroundColor = '#FFB30F';
                  textShadowColor = '#000000';
                  buttonFontColor = '#FFFFFF';
                  buttonBorderColor = '#000000';
                  buttonBoxShadow = '#fffffc';
                  secondaryColor = shadeColor(backgroundColor, -50);
                  //background colour
                  jQuery(".navButton").css("background", backgroundColor);
                  jQuery('.navButton').css({background: '-webkit-gradient(linear, left top, left bottom, from(' + backgroundColor  + '), to(' + secondaryColor + '))'});
                  jQuery(".navButton").css("background", "-moz-linear-gradient( center top, " + secondaryColor + " 5%, " + backgroundColor + " 100% )");
                  jQuery(".navButton").css("filter", "progid:DXImageTransform.Microsoft.gradient(startColorstr='" + backgroundColor + "', endColorstr='" + secondaryColor + "')");
                  //button box shadow
                  jQuery("a.navButton").css("-moz-box-shadow", "inset 0px 1px 0px 0px " + buttonBoxShadow);
                  jQuery("a.navButton").css("-webkit-box-shadow", "inset 0px 1px 0px 0px " + buttonBoxShadow);
                  jQuery("a.navButton").css("box-shadow", "inset 0px 1px 0px 0px " + buttonBoxShadow);
                  //button text shadow colour
                  jQuery("a.navButton").css("text-shadow", "1px 1px 0px " + textShadowColor);
                  //button font colour
                  jQuery("a#emailSignUpButton").css("color", buttonFontColor);
                  jQuery("a#oneClickSignupButton").css("color", buttonFontColor);
                  //button border colour
                  jQuery("a.navButton").css("border", "1px solid " + buttonBorderColor);
                  // set all input fields to match current colour scheme
                  jQuery("input#buttonBackgroundColor").miniColors('value', [backgroundColor]);
                  jQuery("input#buttonBorderColor").miniColors('value', [buttonBorderColor]);
                  jQuery("input#buttonBoxShadow").miniColors('value', [buttonBoxShadow]);
                  jQuery("input#buttonTextShadowColor").miniColors('value', [textShadowColor]);
                  jQuery("input#buttonFontColor").miniColors('value', [buttonFontColor]);
                  break;
              case 'Red':

                  backgroundColor = '#DE0000';
                  textShadowColor = '#000000';
                  buttonFontColor = '#FFFFFF';
                  buttonBorderColor = '#940000';
                  buttonBoxShadow = '#F06C6C';
                  secondaryColor = shadeColor(backgroundColor, -50);
                  //background colour
                  jQuery(".navButton").css("background", backgroundColor);
                  jQuery('.navButton').css({background: '-webkit-gradient(linear, left top, left bottom, from(' + backgroundColor  + '), to(' + secondaryColor + '))'});
                  jQuery(".navButton").css("background", "-moz-linear-gradient( center top, " + secondaryColor + " 5%, " + backgroundColor + " 100% )");
                  jQuery(".navButton").css("filter", "progid:DXImageTransform.Microsoft.gradient(startColorstr='" + backgroundColor + "', endColorstr='" + secondaryColor + "')");
                  //button box shadow
                  jQuery("a.navButton").css("-moz-box-shadow", "inset 0px 1px 0px 0px " + buttonBoxShadow);
                  jQuery("a.navButton").css("-webkit-box-shadow", "inset 0px 1px 0px 0px " + buttonBoxShadow);
                  jQuery("a.navButton").css("box-shadow", "inset 0px 1px 0px 0px " + buttonBoxShadow);
                  //button text shadow colour
                  jQuery("a.navButton").css("text-shadow", "1px 1px 0px " + textShadowColor);
                  //button font colour
                  jQuery("a#emailSignUpButton").css("color", buttonFontColor);
                  jQuery("a#oneClickSignupButton").css("color", buttonFontColor);
                  //button border colour
                  jQuery("a.navButton").css("border", "1px solid " + buttonBorderColor);
                  // set all input fields to match current colour scheme
                  jQuery("input#buttonBackgroundColor").miniColors('value', [backgroundColor]);
                  jQuery("input#buttonBorderColor").miniColors('value', [buttonBorderColor]);
                  jQuery("input#buttonBoxShadow").miniColors('value', [buttonBoxShadow]);
                  jQuery("input#buttonTextShadowColor").miniColors('value', [textShadowColor]);
                  jQuery("input#buttonFontColor").miniColors('value', [buttonFontColor]);
                  break;
              case 'Yellow':

                  backgroundColor = '#FCFC0D';
                  textShadowColor = '#FFFFFF';
                  buttonFontColor = '#000000';
                  buttonBorderColor = '#000000';
                  buttonBoxShadow = '#FFFFFF';
                  secondaryColor = shadeColor(backgroundColor, -50);
                  //background colour
                  jQuery(".navButton").css("background", backgroundColor);
                  jQuery('.navButton').css({background: '-webkit-gradient(linear, left top, left bottom, from(' + backgroundColor  + '), to(' + secondaryColor + '))'});
                  jQuery(".navButton").css("background", "-moz-linear-gradient( center top, " + secondaryColor + " 5%, " + backgroundColor + " 100% )");
                  jQuery(".navButton").css("filter", "progid:DXImageTransform.Microsoft.gradient(startColorstr='" + backgroundColor + "', endColorstr='" + secondaryColor + "')");
                  //button box shadow
                  jQuery("a.navButton").css("-moz-box-shadow", "inset 0px 1px 0px 0px " + buttonBoxShadow);
                  jQuery("a.navButton").css("-webkit-box-shadow", "inset 0px 1px 0px 0px " + buttonBoxShadow);
                  jQuery("a.navButton").css("box-shadow", "inset 0px 1px 0px 0px " + buttonBoxShadow);
                  //button text shadow colour
                  jQuery("a.navButton").css("text-shadow", "1px 1px 0px " + textShadowColor);
                  //button font colour
                  jQuery("a#emailSignUpButton").css("color", buttonFontColor);
                  jQuery("a#oneClickSignupButton").css("color", buttonFontColor);
                  //button border colour
                  jQuery("a.navButton").css("border", "1px solid " + buttonBorderColor);
                  // set all input fields to match current colour scheme
                  jQuery("input#buttonBackgroundColor").miniColors('value', [backgroundColor]);
                  jQuery("input#buttonBorderColor").miniColors('value', [buttonBorderColor]);
                  jQuery("input#buttonBoxShadow").miniColors('value', [buttonBoxShadow]);
                  jQuery("input#buttonTextShadowColor").miniColors('value', [textShadowColor]);
                  jQuery("input#buttonFontColor").miniColors('value', [buttonFontColor]);
                  break;
              case 'Blue':

                  backgroundColor = '#3c72cf';
                  textShadowColor = '#000000';
                  buttonFontColor = '#ffffff';
                  buttonBorderColor = '#000000';
                  buttonBoxShadow = '#FFFFFF';
                  secondaryColor = shadeColor(backgroundColor, -50);
                  //background colour
                  jQuery(".navButton").css("background", backgroundColor);
                  jQuery('.navButton').css({background: '-webkit-gradient(linear, left top, left bottom, from(' + backgroundColor  + '), to(' + secondaryColor + '))'});
                  jQuery(".navButton").css("background", "-moz-linear-gradient( center top, " + secondaryColor + " 5%, " + backgroundColor + " 100% )");
                  jQuery(".navButton").css("filter", "progid:DXImageTransform.Microsoft.gradient(startColorstr='" + backgroundColor + "', endColorstr='" + secondaryColor + "')");
                  //button box shadow
                  jQuery("a.navButton").css("-moz-box-shadow", "inset 0px 1px 0px 0px " + buttonBoxShadow);
                  jQuery("a.navButton").css("-webkit-box-shadow", "inset 0px 1px 0px 0px " + buttonBoxShadow);
                  jQuery("a.navButton").css("box-shadow", "inset 0px 1px 0px 0px " + buttonBoxShadow);
                  //button text shadow colour
                  jQuery("a.navButton").css("text-shadow", "1px 1px 0px " + textShadowColor);
                  //button font colour
                  jQuery("a#emailSignUpButton").css("color", buttonFontColor);
                  jQuery("a#oneClickSignupButton").css("color", buttonFontColor);
                  //button border colour
                  jQuery("a.navButton").css("border", "1px solid " + buttonBorderColor);
                  // set all input fields to match current colour scheme
                  jQuery("input#buttonBackgroundColor").miniColors('value', [backgroundColor]);
                  jQuery("input#buttonBorderColor").miniColors('value', [buttonBorderColor]);
                  jQuery("input#buttonBoxShadow").miniColors('value', [buttonBoxShadow]);
                  jQuery("input#buttonTextShadowColor").miniColors('value', [textShadowColor]);
                  jQuery("input#buttonFontColor").miniColors('value', [buttonFontColor]);
                  break;
              case 'Green':

                  backgroundColor = '#299100';
                  textShadowColor = '#000000';
                  buttonFontColor = '#ffffff';
                  buttonBorderColor = '#000000';
                  buttonBoxShadow = '#FFFFFF';
                  secondaryColor = shadeColor(backgroundColor, -50);
                  //background colour
                  jQuery(".navButton").css("background", backgroundColor);
                  jQuery('.navButton').css({background: '-webkit-gradient(linear, left top, left bottom, from(' + backgroundColor  + '), to(' + secondaryColor + '))'});
                  jQuery(".navButton").css("background", "-moz-linear-gradient( center top, " + secondaryColor + " 5%, " + backgroundColor + " 100% )");
                  jQuery(".navButton").css("filter", "progid:DXImageTransform.Microsoft.gradient(startColorstr='" + backgroundColor + "', endColorstr='" + secondaryColor + "')");
                  //button box shadow
                  jQuery("a.navButton").css("-moz-box-shadow", "inset 0px 1px 0px 0px " + buttonBoxShadow);
                  jQuery("a.navButton").css("-webkit-box-shadow", "inset 0px 1px 0px 0px " + buttonBoxShadow);
                  jQuery("a.navButton").css("box-shadow", "inset 0px 1px 0px 0px " + buttonBoxShadow);
                  //button text shadow colour
                  jQuery("a.navButton").css("text-shadow", "1px 1px 0px " + textShadowColor);
                  //button font colour
                  jQuery("a#emailSignUpButton").css("color", buttonFontColor);
                  jQuery("a#oneClickSignupButton").css("color", buttonFontColor);
                  //button border colour
                  jQuery("a.navButton").css("border", "1px solid " + buttonBorderColor);
                  // set all input fields to match current colour scheme
                  jQuery("input#buttonBackgroundColor").miniColors('value', [backgroundColor]);
                  jQuery("input#buttonBorderColor").miniColors('value', [buttonBorderColor]);
                  jQuery("input#buttonBoxShadow").miniColors('value', [buttonBoxShadow]);
                  jQuery("input#buttonTextShadowColor").miniColors('value', [textShadowColor]);
                  jQuery("input#buttonFontColor").miniColors('value', [buttonFontColor]);
                  break;
              case 'Black':

                  backgroundColor = '#595959';
                  textShadowColor = '#000000';
                  buttonFontColor = '#ffffff';
                  buttonBorderColor = '#000000';
                  buttonBoxShadow = '#FFFFFF';
                  secondaryColor = shadeColor(backgroundColor, -50);
                  //background colour
                  jQuery(".navButton").css("background", backgroundColor);
                  jQuery('.navButton').css({background: '-webkit-gradient(linear, left top, left bottom, from(' + backgroundColor  + '), to(' + secondaryColor + '))'});
                  jQuery(".navButton").css("background", "-moz-linear-gradient( center top, " + secondaryColor + " 5%, " + backgroundColor + " 100% )");
                  jQuery(".navButton").css("filter", "progid:DXImageTransform.Microsoft.gradient(startColorstr='" + backgroundColor + "', endColorstr='" + secondaryColor + "')");
                  //button box shadow
                  jQuery("a.navButton").css("-moz-box-shadow", "inset 0px 1px 0px 0px " + buttonBoxShadow);
                  jQuery("a.navButton").css("-webkit-box-shadow", "inset 0px 1px 0px 0px " + buttonBoxShadow);
                  jQuery("a.navButton").css("box-shadow", "inset 0px 1px 0px 0px " + buttonBoxShadow);
                  //button text shadow colour
                  jQuery("a.navButton").css("text-shadow", "1px 1px 0px " + textShadowColor);
                  //button font colour
                  jQuery("a#emailSignUpButton").css("color", buttonFontColor);
                  jQuery("a#oneClickSignupButton").css("color", buttonFontColor);
                  //button border colour
                  jQuery("a.navButton").css("border", "1px solid " + buttonBorderColor);
                  // set all input fields to match current colour scheme
                  jQuery("input#buttonBackgroundColor").miniColors('value', [backgroundColor]);
                  jQuery("input#buttonBorderColor").miniColors('value', [buttonBorderColor]);
                  jQuery("input#buttonBoxShadow").miniColors('value', [buttonBoxShadow]);
                  jQuery("input#buttonTextShadowColor").miniColors('value', [textShadowColor]);
                  jQuery("input#buttonFontColor").miniColors('value', [buttonFontColor]);
                  break;
              default:
          }
      }
      function callToActionFont()
      {
          font = jQuery("select#callToActionFont").val();
          jQuery("p.connectorCallToAction").css("font-family", font);
      }
      function bodyFont()
      {
          font = jQuery("select#bodyFont").val();
          jQuery("div.connectorDescriptionText").css("font-family", font);
          jQuery("div.connectorDescriptionText p").css("font-family", font);
          jQuery("div.connectorDescriptionText li").css("font-family", font);
      }
      function buttonBackgroundColor()
      {
          // make sure that the hex function is only called if value of input box is 7 chars long otherwise errors in IE
          textLength = jQuery("input#buttonBackgroundColor").val().length;
          if(textLength == '7') {
              color = jQuery("input#buttonBackgroundColor").val();
              secondaryColor = shadeColor(color, -50);
              jQuery(".navButton").css("background", color);
              jQuery('.navButton').css({background: '-webkit-gradient(linear, left top, left bottom, from(' + color  + '), to(' + secondaryColor + '))'});
              jQuery(".navButton").css("background", "-moz-linear-gradient( center top, " + secondaryColor + " 5%, " + color + " 100% )");
              jQuery(".navButton").css("filter", "progid:DXImageTransform.Microsoft.gradient(startColorstr='" + color + "', endColorstr='" + secondaryColor + "')");
          }
      }
      function shadeColor(color, shade) {
          var colorInt = parseInt(color.substring(1),16);
          var R = (colorInt & 0xFF0000) >> 16;
          var G = (colorInt & 0x00FF00) >> 8;
          var B = (colorInt & 0x0000FF) >> 0;
          R = R + Math.floor((shade/255)*R);
          G = G + Math.floor((shade/255)*G);
          B = B + Math.floor((shade/255)*B);
          var newColorInt = (R<<16) + (G<<8) + (B);
          var newColorStr = "#"+newColorInt.toString(16);
          return newColorStr;
      }
      function emailCentre()
      {
          if (jQuery("#emailCentre").is(":checked")) {
              jQuery("div.optinPosition").css("margin-left", "auto");
              jQuery("div.optinPosition").css("margin-right", "auto");
              jQuery("div.optinPositionInput").css("text-align", "center");
              jQuery("div.emailOptinWrapper").css("text-align", "center");
          } else {
              // remove all CSS classes
              jQuery("div.optinPosition").css("margin-left", "0px");
              jQuery("div.optinPosition").css("margin-right", "0px");
              jQuery("div.optinPositionInput").css("text-align", "left");
              jQuery("div.emailOptinWrapper").css("text-align", "left");
              }
      }
      function facebookCentre()
      {
          if (jQuery("#facebookCentre").is(":checked")) {
              jQuery("div.facebookPosition").css("margin-left", "auto");
              jQuery("div.facebookPosition").css("margin-right", "auto");
              jQuery("div.facebookOptinWrapper").css("text-align", "center");
          } else {
              // remove all CSS classes
              jQuery("div.facebookPosition").css("margin-left", "5px");
              jQuery("div.facebookPosition").css("margin-right", "5px");
              jQuery("div.facebookOptinWrapper").css("text-align", "left");
          }
      }
      function headlineBold() {
          if (jQuery("#headlineBold").is(":checked")) {
              jQuery("p.connectorHeadline").css("font-weight", "bold");
          } else {
              // remove all CSS classes
              jQuery("p.connectorHeadline").css("font-weight", "normal");
          }
      }
      function oneClickCentre()
      {
          if (jQuery("#oneClickCentre").is(":checked")) {
              jQuery("div.oneClickPosition").css("margin-left", "auto");
              jQuery("div.oneClickPosition").css("margin-right", "auto");
              jQuery("div.oneClickOptinWrapper").css("text-align", "center");
          } else {
              // remove all CSS classes
              jQuery("div.oneClickPosition").css("margin-left", "5px");
              jQuery("div.oneClickPosition").css("margin-right", "5px");
              jQuery("div.oneClickOptinWrapper").css("text-align", "left");
          }
      }
      function emailCallToActionText() {
          callToAction = jQuery('#emailCallToActionText').val();
          jQuery('p.emailCallToAction').text(callToAction);
      }
      function facebookCallToActionText() {
          callToAction = jQuery('#facebookCallToActionText').val();
          jQuery('p.facebookCallToAction').text(callToAction);
      }
      function oneClickCallToActionText() {
          callToAction = jQuery('#oneClickCallToActionText').val();
          jQuery('p.oneClickCallToAction').text(callToAction);
      }
      function optinBoxHeadline() {
          headline = jQuery('#optinBoxHeadline').val();
          jQuery('p.connectorHeadline').text(headline);
      }
      function optinBoxDescription() {
          description  = jQuery('textarea#optinBoxDescription').val();
          jQuery('div.connectorDescriptionText').text(description );
          var selected = jQuery(".radioSelTickType:checked").val();
           var temp_atr = "url('" + hc_images_path + "/ticks/" + selected + ".png') no-repeat top left";
          jQuery(".connectorDescriptionText ul li").css('background', temp_atr);
      }
      function emailButtonText() {
          buttonText = jQuery('input#emailButtonText').val();
          jQuery('#emailSignUpButton').text(buttonText);
      }
      function facebookButtonText() {
          buttonText = jQuery('input#facebookButtonText').val();
          jQuery('.fb_button_text').html(buttonText);
          return;
          jQuery('div.fb-login-button').text(buttonText);
          window.fbAsyncInit = function() {
              FB.init({
                  appId      : '127118057392683',
                  status     : true,
                  cookie     : true,
                  xfbml      : true,
                  oauth      : true
              });
          };
          (function(d){
              var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
              js = d.createElement('script'); js.id = id; js.async = true;
              js.src = "http://connect.facebook.net/en_US/all.js";
              d.getElementsByTagName('head')[0].appendChild(js);
          }(document));
      }
      function oneClickButtonText() {
          buttonText = jQuery('input#oneClickButtonText').val();
          jQuery('#oneClickSignupButton').text(buttonText);
      }
      function sidePictureShow() {
          if (jQuery("#sidePictureShow").is(":checked")) {
              jQuery('tr.imageSettings').show();
              jQuery('div.graphicWrapper').css("display","block");
              jQuery('img.optinGraphic').css("display","block");
          } else {
              // hide picture upload options
              jQuery('tr.imageSettings').hide();
              jQuery('div.graphicWrapper').css("display","none");
              jQuery('img.optinGraphic').css("display","none");
          }
      }

       function cookieOptionsClick() {
          if (jQuery("#hc_lb_cookie_enable").is(":checked")) {
            //  jQuery('td.excludePagesRow').css("display","block");
              jQuery('tr.cookieOptions').show();
          } else {
              // hide picture upload options
             // jQuery('td.excludePagesRow').css("display","none");
             jQuery('tr.cookieOptions').hide();
          }
      }
       function scrollOptionsClick() {
          if (jQuery("#hc_lb_scroll_enable").is(":checked")) {
                    jQuery("#scrollSizeSlider").slider("enable");
              jQuery('td.scrollOptions').show();
          } else {
              // hide picture upload options
             // jQuery('td.excludePagesRow').css("display","none");
             jQuery('td.scrollOptions').hide();
             jQuery("#scrollSizeSlider").slider("disable");
          }
      }
      function timeOptionsClick() {
          if (jQuery("#hc_lb_time_enable").is(":checked")) {
              jQuery('td.timeOptions').show();
              jQuery('#timeAfterPageLoadSlider').slider("enable");
          } else {
              // hide picture upload options
             // jQuery('td.excludePagesRow').css("display","none");
             jQuery('td.timeOptions').hide();
             jQuery('#timeAfterPageLoadSlider').slider("disable");
          }
      }
      function individualHeightCheckbox() {
          if (jQuery("#individualHeightCheckbox").is(":checked")) {
              jQuery('tr.individualHeightSettings').show();
              jQuery('#connectorHeightSlider').slider("disable");
              jQuery('#callToActionHeightSlider').slider("disable");
              var currentHeight = parseInt(jQuery("#connectorHeight").val());
              var currentCTAHeight = parseInt(jQuery("#callToActionHeight").val());
              // set values of all width sliders to match current heights of optin and cta box
              jQuery("#emailBoxHeightSlider").slider( "value" , currentHeight);
              jQuery("#emailBoxHeight").val(currentHeight + "px");
              jQuery("#facebookBoxHeightSlider").slider( "value" , currentHeight);
              jQuery("#facebookBoxHeight").val(currentHeight + "px");
              jQuery("#oneClickBoxHeightSlider").slider( "value" , currentHeight);
              jQuery("#oneClickBoxHeight").val(currentHeight + "px");
              jQuery("#emailCallToActionHeightSlider").slider( "value" , currentCTAHeight);
              jQuery("#emailCallToActionHeight").val(currentCTAHeight + "px");
              jQuery("#facebookCallToActionHeightSlider").slider( "value" , currentCTAHeight);
              jQuery("#facebookCallToActionHeight").val(currentCTAHeight + "px");
              jQuery("#oneClickCallToActionHeightSlider").slider( "value" , currentCTAHeight);
              jQuery("#oneClickCallToActionHeight").val(currentCTAHeight + "px");
          } else {
              jQuery('tr.individualHeightSettings').hide();
              jQuery('#connectorHeightSlider').slider("enable");
              jQuery('#callToActionHeightSlider').slider("enable");
              //reset height and width of connectors to match display
              var newHeight = jQuery("#connectorHeight").val();
              var newWidth = jQuery("#connectorWidth").val();
              var newCTAHeight = jQuery("#callToActionHeight").val();
              jQuery( ".connectorWrapper" ).css("height", newHeight );
              jQuery( ".connectorWrapper" ).css("width", newWidth );
              jQuery( ".optinWrapper" ).css("height", newCTAHeight );
		
          }
      }
	function gradientBackgroundCheckbox() {
          if (jQuery("#gradientBackgroundCheckbox").is(":checked")) {
          // hide background picture settings
          jQuery("#pictureBackgroundCheckbox").attr('checked', false);
          jQuery('tr.pictureBackgroundSettings').hide();
        jQuery('tr.gradientBackgroundSettings').show();
        jQuery('input[name=connectorBGColor]').miniColors('disabled', true);
        templateGradientColor();
        jQuery("td.templateBackgroundColour").addClass("disabledOption");
          } else {
             jQuery('tr.gradientBackgroundSettings').hide();
             jQuery('input[name=connectorBGColor]').miniColors('disabled', false);
             jQuery("td.templateBackgroundColour").removeClass("disabledOption");
             jQuery("div.connectorWrapper").css("background", "none");
             jQuery("div.connectorWrapper").css("filter", "none");
             updateBackgroundColor();
            // changeWrapperBG();
          }
      }
      
      function pictureBackgroundCheckbox() {
          if (jQuery("#pictureBackgroundCheckbox").is(":checked")) {
                   //hide gradient settings
                   jQuery("#gradientBackgroundCheckbox").attr('checked', false);
                   jQuery('tr.gradientBackgroundSettings').hide();
                   jQuery('tr.pictureBackgroundSettings').show();
                 /*  jQuery('input[name=connectorBGColor]').miniColors('disabled', true);     */
                   jQuery("td.templateBackgroundColour").removeClass("disabledOption");
                   // update display for background settings
              /*     jQuery("div.connectorWrapper").css("background", "none");       */
                   jQuery("div.connectorWrapper").css("filter", "none");
                   backgroundImage = jQuery("#imageBackgroundUploadFilePath").val();
                   jQuery("div.connectorWrapper").css("background-image", "url('" + backgroundImage + "')");
                   jQuery("div.connectorWrapper").css("background-repeat", "no-repeat");
                   updateBackgroundColor();
          } else {
                   jQuery('tr.pictureBackgroundSettings').hide();
             /*      jQuery('input[name=connectorBGColor]').miniColors('disabled', false);   */
                   jQuery("div.connectorWrapper").css("background-image", "none");
                   updateBackgroundColor();
          }
      }
      
      function transparentBackgroundCheckbox() {
         if (jQuery("#transparentBackgroundCheckbox").is(":checked")) {
                   jQuery("div.connectorWrapper").css("background-color","transparent");
                   jQuery('input[name=connectorBGColor]').miniColors('disabled', true);
        }  else {
                   var backgroundColor = jQuery("#connectorBGColor").val();
                   jQuery("div.connectorWrapper").css("background-color",backgroundColor);
                   jQuery('input[name=connectorBGColor]').miniColors('disabled', false);
         }
      }
      
      function transparentOptinBackgroundCheckbox() {
         if (jQuery("#transparentOptinBackgroundCheckbox").is(":checked")) {
             jQuery("div.optinWrapper").css("background-color","transparent");
             jQuery('input[name=OptinBGColor]').miniColors('disabled', true);
         } else {
             var backgroundColor = jQuery("#OptinBGColor").val();
             jQuery("div.optinWrapper").css("background-color",backgroundColor);
             jQuery('input[name=OptinBGColor]').miniColors('disabled', false);
         }
      }
      
      function headlineCenter() {
          if (jQuery("#headlineCenter").is(":checked")) {
                jQuery("p.connectorHeadline").css("text-align","center");
          } else {
                jQuery("p.connectorHeadline").css("text-align","left");
          }
      }
      
      function bodyCenter() {
          if (jQuery("#bodyCenter").is(":checked")) {
                jQuery("div.connectorDescriptionText").css("text-align","center");
          } else {
                jQuery("div.connectorDescriptionText").css("text-align","left");
          }
      }
      
      function arrowGraphicsShow() {
          if (jQuery("#arrowGraphicsShow").is(":checked")) {
              jQuery('tr#arrowGraphicsShowRow').show();
              jQuery('img.leftArrow').css("display","block");
              jQuery('img.rightArrow').css("display","block");
          } else {
              // hide picture upload options
              jQuery('tr#arrowGraphicsShowRow').hide();
              jQuery('img.leftArrow').css("display","none");
              jQuery('img.rightArrow').css("display","none");
          }
      }
      function makeTemplateResponsive() {
          if (jQuery('input[name=responsive]').is(":checked")) {
              jQuery("#connectorWidthSlider").slider("disable");
              jQuery("#connectorHeightSlider").slider("disable");
              jQuery("#callToActionHeightSlider").slider("disable");
              jQuery("#callToActionHeightSlider").slider("disable");
              jQuery("#emailBoxHeightSlider").slider("disable");
              jQuery("#emailCallToActionHeightSlider").slider("disable");
              jQuery("#facebookBoxHeightSlider").slider("disable");
              jQuery("#facebookCallToActionHeightSlider").slider("disable");
              jQuery("#oneClickBoxHeightSlider").slider("disable");
              jQuery("#oneClickCallToActionHeightSlider").slider("disable");
              jQuery("tr#setIndividualHeightRow").hide();
              jQuery("tr.responsiveExplanationRow").show();
              // make css changes to make preview responsive
              jQuery("div.connectorWrapper").css("width","100%");
              jQuery("div.connectorWrapper").css("height","100%");
              jQuery("div.graphicWrapper").css("width","40%");
              jQuery("img.optinGraphic").css("width","100%");
              jQuery("div.connectorWrapper").css("min-width", "<?php echo $style_connector->min_width . "px" ?>");
              jQuery("div.connectorWrapper").css("max-width", "<?php echo $style_connector->max_width . "px" ?>");
              jQuery("div.graphicWrapper").css("min-width", "<?php echo $style_image->min_width . "px" ?>");
              jQuery("div.graphicWrapper").css("max-width", "<?php echo $style_image->max_width . "px" ?>");
              jQuery("div.graphicWrapper").css("min-height", "<?php echo $style_image->min_height . "px" ?>");
              jQuery("div.graphicWrapper").css("max-height", "<?php echo $style_image->max_height . "px" ?>");
              jQuery("div.optinWrapper").css("position","relative");
              jQuery("div.optinWrapper").css("height","");
              jQuery("div.optinWrapper").css("overflow","hidden");
              jQuery("div.connectorDescriptionText").css("height","100%");
              jQuery("div#responsiveWrapperDiv").css("border-right","2px dashed #000000");
              jQuery("div#responsiveWrapperDiv").css("border-left","2px dashed #000000");
              jQuery("tr.hideWhenResponsive").hide();
          } else {
              jQuery("div.connectorWrapper").css("min-width", "");
              jQuery("div.connectorWrapper").css("max-width", "");
              jQuery("div.graphicWrapper").css("min-width", "");
              jQuery("div.graphicWrapper").css("max-width", "");
              jQuery("div.graphicWrapper").css("min-height", "");
              jQuery("div.graphicWrapper").css("max-height", "");
              jQuery("div#responsiveWrapperDiv").css("border-right","0px");
              jQuery("div#responsiveWrapperDiv").css("border-left","0px");
              jQuery("#connectorWidthSlider").slider("enable");
              jQuery("#connectorHeightSlider").slider("enable");
              jQuery("#callToActionHeightSlider").slider("enable");
              jQuery("#callToActionHeightSlider").slider("enable");
              jQuery("#emailBoxHeightSlider").slider("enable");
              jQuery("#emailCallToActionHeightSlider").slider("enable");
              jQuery("#facebookBoxHeightSlider").slider("enable");
              jQuery("#facebookCallToActionHeightSlider").slider("enable");
              jQuery("#oneClickBoxHeightSlider").slider("enable");
              jQuery("#oneClickCallToActionHeightSlider").slider("enable");
              jQuery("tr#setIndividualHeightRow").show();
              jQuery("tr.responsiveExplanationRow").hide();
              connectorWidth = jQuery("input#connectorWidth" ).val();
              jQuery("div.connectorWrapper").css("width",connectorWidth);
              connectorHeight = jQuery("input#connectorHeight" ).val();
              jQuery("div.connectorWrapper").css("height",connectorHeight);
              jQuery("div.graphicWrapper").css("width","");
              jQuery("div.graphicWrapper").css("min-width","");
              jQuery("img.optinGraphic").css("width","");
              jQuery("div.optinWrapper").css("position","absolute");
              optinHeight = jQuery("input#callToActionHeight" ).val();
              jQuery("div.optinWrapper").css("height",optinHeight);
              jQuery("div.optinWrapper").css("overflow","");
              jQuery("tr.hideWhenResponsive").show();
              checkConnectorVisibility();
          }
      }
     function bindTinyMceEditor() {

    // var theme_advanced_fonts="Aclonica=Aclonica, sans-serif;"

       ed = new tinyMCE.init({
              mode: "exact",
              elements: "optinBoxDescription",
              theme: "advanced",
              onchange_callback: "myCustomOnChangeHandler",
              theme_advanced_buttons1 : "bold,italic,underline,bullist,numlist,font,forecolor,image,code",
              theme_advanced_buttons2 : "fontselect,fontsizeselect,justifyleft,justifycenter,justifyright,justifyfull",
              theme_advanced_buttons3 : "",
              theme_advanced_buttons1_add: 'code',
              relative_urls : false,
              inline_styles : true,
              cleanup: false,
              extended_valid_elements:"img[style|class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name]",
              extended_valid_elements:"iframe[width|height|src|marginheight|marginwidth]",
              extended_valid_elements:"div[style]",
              plugins : "media",
              theme_advanced_buttons1_add : "media",
         //     theme_advanced_fonts: theme_advanced_fonts,
              setup : function(ed) { ed.addButton ('mce_media', {
              'title' : 'Embed a video',
              'image' : '{T_ICONS_PATH}mce_icons/video.gif',
              'onclick' : function () {
              var text = prompt('Please enter the embed code for your video:','');
              var pattern = new RegExp('embed', 'gi'); // very simple check for proper code
              if(text.match(pattern)) {
              var width = parseInt (text.replace (/^(?:.*?)(?:width="(.*?)"){1}(?:.*?)$/gi,'$1'));
              var height = parseInt (text.replace (/^(?:.*?)(?:height="(.*?)"){1}(?:.*?)$/gi,'$1'));
              var aspect = width / height;
              var w = 320; // basic resize-to
              var h = Math.round(w / aspect);
              var str = text
                .replace (/&amp;/gi,'&')
                .replace (/&quot;/gi,'"')
                .replace (/&lt;/gi,'<')
                .replace (/&gt;/gi,'>')
                .replace (/width="(?:.*?)"/gi, 'width="' + w + '"')
                .replace (/height="(?:.*?)"/gi, 'height="' + h + '"')
            ed.execCommand('mceInsertContent', false, '<div>' + str + '</div>');
            setTimeout(function(){ed.hide()},1);
            setTimeout(function(){ed.show()},5);
            setTimeout(function(){ed.focus()},10);
        } else {
            alert('Incorrect or invalid embed code');
        }
    }
});
},
setup : function(ed) {
          ed.onExecCommand.add(function(ed, cmd, ui, val) {
             if (cmd == "mceInsertContent") {
                 if (val == "<img id=\"__mce_tmp\" />") {
                     var newImage = ed.getDoc().getElementById("__mce_tmp");
                     myCustomOnChangeHander(ed);
                 }
             }
          });
    }
});
          }
      function myCustomOnChangeHandler(inst) {


         // var thebody = tinyMCE.activeEditor.getContent({format : 'raw'});
         var thebody = inst.getBody().innerHTML;
        // thebody = thebody.replace('style=', 'type=');
          jQuery('div.connectorDescriptionText').html(thebody);
          var st_body_font_color = jQuery("#bodyTextColor").val();
          var st_body_font_size = jQuery("#mainFontSize").val();
          var st_body_font_family = jQuery("#bodyFont").val();
          jQuery("div.connectorDescriptionText p").css("color",st_body_font_color);
          jQuery("div.connectorDescriptionText p").css("font-size",st_body_font_size);
          jQuery("div.connectorDescriptionText p").css("font-family",st_body_font_family);
          jQuery("div.connectorDescriptionText li").css("color",st_body_font_color);
          jQuery("div.connectorDescriptionText li").css("font-size",st_body_font_size);
          jQuery("div.connectorDescriptionText li").css("font-family",st_body_font_family);
          var selected = jQuery(".radioSelTickType:checked").val();
          var temp_atr = "url('" + hc_images_path + "/ticks/" + selected + ".png') no-repeat top left";
         jQuery(".connectorDescriptionText ul li").css('background', temp_atr);
          refreshParagraphMargin();
          jQuery( ".connectorDescriptionText ul li" ).css("background-size", jQuery("#bulletPointSizeSlider").slider("value") + "px" );
          jQuery( ".connectorDescriptionText ul li" ).css("background-position-y", jQuery("#bulletPointVerticalInputSlider").slider("value") + "px" );
          jQuery( ".connectorDescriptionText ul li" ).css("background-position-x", jQuery("#bulletPointHorizontalInputSlider").slider("value") + "px" );

          return false;
      }
      
      function imageBackgroundChange() {

          var backgroundImage = jQuery("#imageBackgroundUploadFilePath").val();
          jQuery("div.connectorWrapper").css("background-image","url(" + backgroundImage + ")");

      }
      
      function updateBackgroundColor() {

      if (jQuery("#transparentBackgroundCheckbox").is(":checked")) {
                jQuery("div.connectorWrapper").css("background-color","transparent");
         }  else {
            var backgroundColor = jQuery("#connectorBGColor").val();
          jQuery("div.connectorWrapper").css("background-color",backgroundColor);
          }

      }
      
      function emailInputNewLine() {
      if (jQuery("#emailInputNewLine").is(":checked")) {
                   jQuery("div.emailInputField").css("display","block");
          } else {
                   jQuery("div.emailInputField").css("display","inline");
          }
    }

    function submitButtonNewLine() {
         if (jQuery("#submitButtonNewLine").is(":checked")) {
                   jQuery("div.emailButtonContainer").css("display","block");
          } else {
                   jQuery("div.emailButtonContainer").css("display","inline");
          }

    }
    
    function dropShadowCheckbox() {
        if (jQuery("#dropShadowCheckbox").is(":checked")) {
           jQuery('#hShadowSlider').slider("enable");
           jQuery('#vShadowSlider').slider("enable");
           jQuery('#blurShadowSlider').slider("enable");
           jQuery('input[name=shadowColor]').miniColors('disabled', false);
           updateShadow();
          } else {
           jQuery('#hShadowSlider').slider("disable");
           jQuery('#vShadowSlider').slider("disable");
           jQuery('#blurShadowSlider').slider("disable");
           jQuery('input[name=shadowColor]').miniColors('disabled', true);
           jQuery(".connectorWrapper").css("box-shadow", "none");
           jQuery(".connectorWrapper").css("-moz-box-shadow", "none");
           jQuery(".connectorWrapper").css("-webkit-box-shadow", "none");
          }
    }
    
    function updateShadow() {
     if (jQuery("#dropShadowCheckbox").is(":checked")) {
    var horizShadow = jQuery('#hShadow').val();
    var verticShadow = jQuery('#vShadow').val();
    var blurShadow = jQuery('#blurShadow').val();
    var shadowColor = jQuery('#shadowColor').val();
    var boxShadowSetting = horizShadow + " " + verticShadow + " " + blurShadow + " " + shadowColor;
    jQuery(".connectorWrapper").css("box-shadow", boxShadowSetting);
    jQuery(".connectorWrapper").css("-moz-box-shadow", boxShadowSetting);
    jQuery(".connectorWrapper").css("-webkit-box-shadow", boxShadowSetting);

    }
  }
  
  function updateTextShadow() {

  var horizShadow = jQuery('#textHShadow').val();
  var verticShadow = jQuery('#textVShadow').val();
  var blurShadow = jQuery('#textBlurShadow').val();
  var shadowColor = jQuery('#textShadowColor').val();
  var textShadowSetting = horizShadow + " " + verticShadow + " " + blurShadow + " " + shadowColor;
  var ieDirection = calculateIEAngle(parseInt(horizShadow), parseInt(verticShadow));
  var ieStrength =  Math.sqrt(parseInt(verticShadow)*parseInt(verticShadow) + parseInt(horizShadow)*parseInt(horizShadow));
  if (jQuery("#headlineShadowCheckbox").is(":checked")) {
    jQuery('p.connectorHeadline').css('text-shadow', textShadowSetting);
    /* internet explorer shadow filter looks terrible - don't use it */
    /*  jQuery('p.connectorHeadline').css("filter", "progid:DXImageTransform.Microsoft.Shadow(color=" + shadowColor + ",direction=" + parseInt(ieDirection) + ",strength=" + parseInt(ieStrength) + ")");  */
  } else {
    jQuery('p.connectorHeadline').css('text-shadow', "none");
  }
  if (jQuery("#textShadowCheckbox").is(":checked")) {
    jQuery('.connectorDescriptionText p').not('p.connectorCallToAction').css('text-shadow', textShadowSetting);
    jQuery('.connectorDescriptionText ul li').not('p.connectorCallToAction').css('text-shadow', textShadowSetting);
    } else {
    jQuery('.connectorDescriptionText p').css('text-shadow', "none");
    jQuery('.connectorDescriptionText ul li').not('p.connectorCallToAction').css('text-shadow', "none");
    }
  if (jQuery("#ctaShadowCheckbox").is(":checked")) {
    jQuery('p.connectorCallToAction').css('text-shadow', textShadowSetting);
  } else {
    jQuery('p.connectorCallToAction').css('text-shadow', "none");
  }
}

function calculateIEAngle(x, y){
    var d = Math.atan2(x, y) * (180 / Math.PI);
    if(d < 0){ d = 180 - d; }
    return d;
}
  

  function updateFacebook(facebookSize) {

    var newFBClass = "fb_button_" + facebookSize;
    jQuery('#facebookSize').val(facebookSize);
    jQuery('div#templateCode').find('.fb-login-button').attr('size', facebookSize);
    jQuery('div#templateCode').find('a.fb_button').not('a.facebookSettingButton').removeClass('fb_button_small fb_button_medium fb_button_large fb_button_xlarge').addClass(newFBClass);

  }
  
  function nameLabelField() {

    var currentLabel = jQuery('input[name=nameLabelField]').val();
    jQuery(".nameConnectorInputField").val(currentLabel);

  }
  
  function emailLabelField() {

    var currentLabel = jQuery('input[name=emailLabelField]').val();
    jQuery(".emailConnectorInputField").val(currentLabel);

  }
  
  function showPrivacyPolicy () {
    if (jQuery("#showPrivacyPolicy").is(":checked")) {
   jQuery('.ppWrapper').show();
   } else {
   jQuery('.ppWrapper').hide();
   }
 }

 function boldPrivacyPolicy () {
    if (jQuery("#boldPrivacyPolicy").is(":checked")) {
   jQuery('.privacyPolicy span').css("font-weight","bold");
   } else {
   jQuery('.privacyPolicy span').css("font-weight","normal");
   }
 }

 function centerPrivacyPolicy () {
    if (jQuery("#centerPrivacyPolicy").is(":checked")) {
   jQuery('.privacyPolicy').css("margin","0px auto");

   } else {
   jQuery('.privacyPolicy').css("margin-left","5px");
   }
 }
 
 function privacyPolicyFont()
      {
          font = jQuery("select#privacyPolicyFont").val();
          jQuery(".privacyPolicy span").css("font-family", font);
      }

  function privacyPolicyColor()
      {
          color = jQuery("input#privacyPolicyColor").val();
          jQuery(".privacyPolicy span").css("color", color);
      }
      
  function privacyPolicyText() {

           pptext = jQuery("input#privacyPolicyText").val();
           jQuery('.privacyPolicy span').text(pptext);

      }

   function connectorSettingsHideShow() {

     if(jQuery("tr.connectorSettingsContent").is(":visible")) {
     /* hide everything */
     jQuery('tr.connectorSettingsContent').hide();
     } else {
       /* run functions to make everything else hide / display */
       jQuery('tr.connectorSettingsContent').show();
       checkConnectorVisibility();
     }
   }
   
   function checkConnectorVisibility() {
            if (jQuery("#gradientBackgroundCheckbox").is(":checked")) { jQuery('tr.gradientBackgroundSettings').show(); } else { jQuery('tr.gradientBackgroundSettings').hide(); }
            if (jQuery("#pictureBackgroundCheckbox").is(":checked")) { jQuery('tr.pictureBackgroundSettings').show(); } else { jQuery('tr.pictureBackgroundSettings').hide();   }
            if (jQuery("#individualHeightCheckbox").is(":checked")) { jQuery('tr.individualHeightSettings').show(); } else { jQuery('tr.individualHeightSettings').hide(); }
            if (jQuery('input[name=responsive]').is(":checked")) { jQuery("tr.responsiveExplanationRow").show(); } else { jQuery("tr.responsiveExplanationRow").hide(); }
   }
   
   
   function loadUserTemplateFromDB(event) {


          var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
          var id_variation = jQuery("#hc_tpl_page_id_variation").val();
          var connectorID = jQuery("#hc_tpl_page_id_connector").val();
          var templateID = jQuery(event.target).closest("td.loadTemplateCell").find("input.connID").val();
          var connectorType = window.hybridConnectorType;
          var data = {
          action: 'hc_load_user_template',
          security: hc_ajax_nonce,
          connectorID: connectorID,
          templateID:templateID,
          type:connectorType,
          idVariation: id_variation
    };
    
    //console.log(data);

   // destroy any instance of getTemplateName
        jQuery("#getTemplateName").dialog('destroy').remove();

  jQuery("#hc_admin_main_panel").hide();
    jQuery('#hc_admin_ajax_loading').show();

  jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {

            jQuery("#hc_admin_tpls_panel").show();
            jQuery("#hc_admin_tpls_panel").html(response);
            jQuery("#hc_sc_cancel_changes").click(admin_cancel_template_changes);
        }
        return false;
    });
}
   
   
   
   function loadNewTemplateFromDB(event) {

         // destroy any instance of getTemplateName
        jQuery("#getTemplateName").dialog('destroy').remove();
          var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
          var template_id_connector = jQuery(event.target).nextAll("input[name=templateConnectorID]").val();
          var template_connector_type = jQuery(event.target).nextAll("input[name=templateTemplateType]").val();
          var id_connector = jQuery("#hc_tpl_page_id_connector").val();
        var id_variation = jQuery("#hc_tpl_page_id_variation").val();
           var connectorType = window.hybridConnectorType;
          var data = {
          action: 'hc_load_from_templates_page',
          security: hc_ajax_nonce,
          idTemplateConnector: template_id_connector,
          templateConnectorType: template_connector_type,
          type:connectorType,
          idVariation: id_variation,
          id_connector:id_connector
    };
    
    //console.log(data);
    
  jQuery("#hc_admin_main_panel").hide();
    jQuery('#hc_admin_ajax_loading').show();

  jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        if (response <= 0) {
            alert("We couldn't process your request. Please refresh the page and try again. Thank you.");
        } else {
            jQuery("#hc_admin_tpls_panel").show();
            jQuery("#hc_admin_tpls_panel").html(response);
            jQuery("#hc_sc_cancel_changes").click(admin_cancel_template_changes);
        }
        return false;
    });
}

function refreshParagraphMargin() {

     var leftMargin = jQuery( "#textLeftMargin" ).val();
     jQuery( "div.connectorDescriptionText p").css( "margin-left", leftMargin);
     
     var rightMargin = jQuery( "#textRightMargin" ).val();
     jQuery( "div.connectorDescriptionText p").css( "margin-right", rightMargin);

}

function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function checkCookieSet() {
   var id_connector = jQuery("#hc_tpl_page_id_connector").val();
   var cookie_name="hc_lb_" + id_connector;
   var cookieValue = readCookie(cookie_name);
   if(cookieValue) {
      jQuery("#cookieStatus").html('<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"><button style="float:right; margin-left:20px; margin-top:15px;" class="hc_lb_cookie_clear" class="ui-button ui-widget ui-state-default-cancel ui-corner-all ui-button-text-only ui-state-hover-cancel" role="button" aria-disabled="false"><span class="ui-button-text">Clear Cookie</span></button><p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span><strong>A cookie for this lightbox is currently set on your computer, therefore your lightbox won\'t display.  </strong></p></div>');

   } else {
        jQuery("#cookieStatus").html('<div class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong>There is currently no cookie set for this connector on your computer, therefore your lightbox will display. </strong></p></div>');
   }
   
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function showExternalMarginPreview() {

         if (jQuery("#showExternalMarginPreview").is(":checked")) {

         jQuery('#externalTopMarginSlider').slider("enable");
         jQuery('#externalBottomMarginSlider').slider("enable");
         jQuery(".emailConnectorWrapper").hide();
         jQuery(".oneClickConnectorWrapper").hide();
         jQuery("#showMarginPreview").hide();
         jQuery("#showMarginPreview").parent().append('<td colspan="4" class="marginPreviewReset" style="text-align:center"><div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"><button style="float:right; margin-left:20px; margin-top:15px;" class="hc_margin_view_reset" onClick="resetFromMarginPreview();" class="ui-button ui-widget ui-state-default-cancel ui-corner-all ui-button-text-only ui-state-hover-cancel" role="button" aria-disabled="false"><span class="ui-button-text">Go Back to Template Viewer Mode</span></button><p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span><strong>You are in Margin Preview Mode</strong></p></div></td>');
           var currentWidth= jQuery(".facebookConnectorWrapper").css("width");
           jQuery(".facebookConnectorWrapper").css("margin-top", jQuery('#externalTopMargin').val());
           jQuery(".facebookConnectorWrapper").css("margin-bottom", jQuery('#externalBottomMargin').val());
           
           if(jQuery(".simulateItem").exists()){
           jQuery(".simluateItem").css("width", currentWidth);
           jQuery(".simulateItem").show();
           jQuery("#responsiveWrapperDiv").prepend('<div class="ui-state-error ui-corner-all marginPreviewWarning" style="padding: 0 .7em; width:' + currentWidth + '; margin-bottom:20px;"><button style="float:right; margin-left:20px; margin-top:15px;" class="hc_margin_view_reset" onClick="resetFromMarginPreview();" class="ui-button ui-widget ui-state-default-cancel ui-corner-all ui-button-text-only ui-state-hover-cancel" role="button" aria-disabled="false"><span class="ui-button-text">Go Back to Template Viewer Mode</span></button><p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span><strong>You are in Margin Preview Mode</strong></p></div>');
           } else {


           jQuery(".facebookConnectorWrapper").parent().prepend('<div class="simulateItem simulateItemeAbove" style="border:2px dashed #cc0000; width:' + currentWidth + '; height:250px; background:#cccccc; margin:0px auto; vertical-align:middle; text-align:center;"><p style="vertical-align:middle; width:100%; height:100%; color:#ffffff; font-size:20px; height:250px; position:relative; top:200px;">Content Above</p></div>');
           jQuery(".facebookConnectorWrapper").parent().append('<div class="simulateItem simulateItemBelow" style="border:2px dashed #cc0000; width:' + currentWidth + '; height:250px; background:#cccccc; margin:0px auto; text-align:center;"><p style="vertical-align:middle; width:100%; height:100%; color:#ffffff; font-size:20px; height:250px; position:relative; top:0px;">Content Below</p></div>');
           jQuery("#responsiveWrapperDiv").prepend('<div class="ui-state-error ui-corner-all marginPreviewWarning" style="padding: 0 .7em; width:' + currentWidth + '; margin-bottom:20px;"><button style="float:right; margin-left:20px; margin-top:15px;" class="hc_margin_view_reset" onClick="resetFromMarginPreview();" class="ui-button ui-widget ui-state-default-cancel ui-corner-all ui-button-text-only ui-state-hover-cancel" role="button" aria-disabled="false"><span class="ui-button-text">Go Back to Template Viewer Mode</span></button><p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span><strong>You are in Margin Preview Mode</strong></p></div>');
         }
         }
         else {
            resetFromMarginPreview();
         }
}

function resetFromMarginPreview() {
  jQuery(".emailConnectorWrapper").show();
           jQuery(".oneClickConnectorWrapper").show();
           jQuery(".facebookConnectorWrapper").css("margin-top", "50px");
           jQuery(".facebookConnectorWrapper").css("margin-bottom", "");
           jQuery(".simulateItem").hide();
           jQuery(".marginPreviewReset").remove();
           jQuery("#showMarginPreview").show();
           jQuery("#showExternalMarginPreview").attr("checked",false);
           jQuery(".marginPreviewWarning").remove();
           jQuery('#externalTopMarginSlider').slider("disable");
           jQuery('#externalBottomMarginSlider').slider("disable");

}

jQuery.fn.exists = function () {
    return this.length !== 0;
}


/* function updateLightboxDisplayOptions() {

         if (jQuery("#hc_lb_all_pages").is(":checked")) {
            jQuery('input.hc_lb_included_pages_checkbox').attr("disabled", true);
            jQuery('td.includePagesRow').css("opacity","0.5");
            jQuery('input#hc_lb_includepages').attr("disabled", true);
            jQuery('input.hc_lb_excluded_pages_checkbox').attr("disabled",false);
            jQuery('td.excludedPagesRow').css("opacity","1.0");
          }  else {
            jQuery('input.hc_lb_included_pages_checkbox').attr("disabled", false);
            jQuery('td.includePagesRow').css("opacity","1.0");
            jQuery('input#hc_lb_includepages').attr("disabled", false);
            jQuery('input.hc_lb_excluded_pages_checkbox').attr("disabled",true);
            jQuery('td.excludePagesRow').css("opacity","0.5");
            jQuery('td.includePagesRow').css("opacity","1.0");
          }
          
          if (jQuery("#hc_lb_all_posts").is(":checked")) {
            jQuery('input.hc_lb_included_posts_checkbox').attr("disabled", true);
            jQuery('td.includePostsRow').css("opacity","0.5");
          }  else {
            jQuery('input.hc_lb_included_posts_checkbox').attr("disabled", false);
            jQuery('td.includePostsRow').css("opacity","1.0");
          }
          
           if (jQuery("#hc_lb_includepages").is(":checked")) {
                jQuery("td.allPagesRow").css("opacity","0.5");
                jQuery("#hc_lb_all_pages").attr("disabled", true);
                jQuery("td.excludePagesRow").css("opacity","0.5");
                jQuery(".hc_lb_excluded_pages_checkbox").attr("disabled", true);
                jQuery(".includePagesRow").css("opacity","1.0");
                jQuery('input#hc_lb_includepages').attr("disabled", false);
           } else {
                jQuery("td.allPagesRow").css("opacity","1.0");
                jQuery("#hc_lb_all_pages").attr("disabled", false);
                jQuery("td.excludePagesRow").css("opacity","1.0");
                jQuery(".hc_lb_excluded_pages_checkbox").attr("disabled", false);
                jQuery(".includePagesRow").css("opacity","0.5");
                jQuery('input#hc_lb_includepages').attr("disabled", true);
           }

}   */



function saveTemplate(event) {

//console.log(event);
jQuery("#getTemplateName").dialog('destroy');


var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
var id_connector = jQuery("#hc_tpl_page_id_connector").val();
var templateName = jQuery("#newTemplateName").val();
var id_variation = jQuery("#hc_tpl_page_id_variation").val();
var connectorType = window.hybridConnectorType;

          var data = {
              action: 'hc_save_as_new_template',
              id_connector: id_connector,
              template_name: templateName,
              security: hc_ajax_nonce,
              connectorType: connectorType,
              id_variation: id_variation
          };
          
          console.log(data);
          
          //console.log(data);
          jQuery('#hc_admin_ajax_loading').show();
          jQuery.post(ajaxurl, data, function(response) {
          jQuery('#hc_admin_ajax_loading').hide();
          updateTemplatesTable();
          jQuery("#templateSaveConfirmation").dialog({ height:100, close: function(event, ui) { jQuery(this).dialog('destroy'); } });
          jQuery("#newTemplateName").val("");
          

          });

}
   
   
function updateTemplatesTable() {

         var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_update_templates_table',
        security: hc_ajax_nonce
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#hc_admin_ajax_loading').hide();
        jQuery('#ownTemplatesTable').html(response);
        jQuery("a.loadhcTemplate").on("click", function(event){ event.preventDefault(); loadNewTemplateFromDB(event); });
      jQuery("button.hc_link_connector_shortcode_template_settings").on("click", function(event){ event.preventDefault(); loadUserTemplateFromDB(event); });
      jQuery("button.hc_link_connector_remove").click(function(event) { event.preventDefault(); removeUserTemplate(event); });

});

}

function removeUserTemplate(event) {

 var templateID = jQuery(event.target).parents("td").first().children("input").first().val();
 var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
    var data = {
        action: 'hc_remove_template',
        security: hc_ajax_nonce,
        templateID:templateID
    };
    jQuery('#hc_admin_ajax_loading').show();
    jQuery.post(ajaxurl, data, function(response) {
      updateTemplatesTable();
      


});

}

function resetNativeSize() {

// Get on screen image
var screenImage = jQuery("img.optinGraphic");

// Create new offscreen image to test
var theImage = new Image();
theImage.src = screenImage.attr("src");

// Get accurate measurements from that.
var imageWidth = theImage.width;
var imageHeight = theImage.height;

jQuery("img.optinGraphic").css("width", imageWidth + "px");
jQuery("#imageSizeSlider").slider({ value: imageWidth });
jQuery("#sideImageSize").val(imageWidth +"px");

}

function squeezeBGColor() {

  var bgColor = jQuery("#squeezeBGColor").val();
  jQuery("#monitorScreen").css("background-color",bgColor);
}

function squeezeGradientColor()
      {
      color1 =  jQuery("#squeezeGradientBGColor1").val();
      color2 =  jQuery("#squeezeGradientBGColor2").val();
      jQuery('#monitorScreen').css({background: '-webkit-gradient(linear, left top, left bottom, from(' + color2  + '), to(' + color1 + '))'});
      jQuery("#monitorScreen").css("background", "-moz-linear-gradient( center top, " + color1 + " 0%, " + color2 + " 100% )");
      jQuery("#monitorScreen").css("filter", "progid:DXImageTransform.Microsoft.gradient(startColorstr='" + color1 + "', endColorstr='" + color2 + "')");
      jQuery("#monitorScreen").css("background", "-ms-linear-gradient(top,  " + color1 + " 0%," +color2 + " 100%)");
      jQuery("#monitorScreen").css("background", "-webkit-linear-gradient(top, " + color1 + " 0%, " + color2 + " 100%)");
      jQuery("#monitorScreen").css("background", " -o-linear-gradient(top,  " + color1 + " 0%, " + color2 + " 100%)");
      jQuery("#monitorScreen").css("background", "background: linear-gradient(to bottom,  " + color1 + " 0%, " + color2 + " 100%)");
      }
   
 function squeezeGradientBGCheckbox() {
          if (jQuery("#squeezeGradientCheckbox").is(":checked")) {
          // hide background picture settings
          jQuery("#squeezePictureCheckbox").attr('checked', false);
          jQuery('tr.squeezePictureBGSettings').hide();
        jQuery('tr.squeezegradientBackgroundSettings').show();
        jQuery('input[name=squeezeBGColor]').miniColors('disabled', true);
        squeezeGradientColor();
        jQuery("td.squeezeBackgroundColour").addClass("disabledOption");
          } else {
             jQuery('tr.squeezegradientBackgroundSettings').hide();
             jQuery('input[name=squeezeBGColor]').miniColors('disabled', false);
             jQuery("td.squeezeBackgroundColour").removeClass("disabledOption");
             jQuery("#monitorScreen").css("background", "none");
             jQuery("#monitorScreen").css("filter", "none");
             updateSqueezeBGColor();
            // changeWrapperBG();
          }
      }
      
      
      function updateSqueezeBGColor() {

          var backgroundColor = jQuery("#squeezeBGColor").val();
          jQuery("#monitorScreen").css("background-color",backgroundColor);
          
      }
      
      function squeezeBackgroundCheckbox() {
          if (jQuery("#squeezePictureCheckbox").is(":checked")) {

                   jQuery("#squeezeGradientCheckbox").attr('checked', false);
                   jQuery('tr.squeezegradientBackgroundSettings').hide();
                   jQuery('tr.squeezePictureBGSettings').show();
                   jQuery("td.squeezeBackgroundColour").removeClass("disabledOption");
                   jQuery("#squeezeBGColor").miniColors("disabled", false);
                   jQuery("#monitorScreen").css("filter", "none");
                   backgroundImage = jQuery("#squeezeImageBackgroundUploadFilePath").val();
                   jQuery("#monitorScreen").css("background-image", "url('" + backgroundImage + "')");
                   jQuery("#monitorScreen").css("background-repeat", "no-repeat");
                    jQuery("#monitorScreen").css("-webkit-background-size", "cover");
                    jQuery("#monitorScreen").css("-moz-background-size", "cover");
                    jQuery("#monitorScreen").css("-o-background-size", "cover");
                    jQuery("#monitorScreen").css("background-size", "cover");
                    checkBackgroundScalar();
                   
                   updateSqueezeBGColor();
          } else {
                   jQuery('tr.squeezePictureBGSettings').hide();
                   jQuery("#monitorScreen").css("background-image", "none");
                   updateSqueezeBGColor();
          }
      }
      
      function squeezeTileBG() {
      if (jQuery("#squeezePictureCheckbox").is(":checked")) {
         if (jQuery("#squeezeTileBG").is(":checked")) {
            var optinScalar = calculateSqueezeImageMultiplier();
             var scalarSetting = optinScalar[0] + " " + optinScalar[1];
             jQuery("#monitorScreen").css("background-repeat","repeat");
             jQuery("#repeatXAxis").attr("checked", false);
             jQuery("#repeatYAxis").attr("checked", false);
             jQuery("#monitorScreen").css("-webkit-background-size", scalarSetting);
             jQuery("#monitorScreen").css("-moz-background-size", scalarSetting);
             jQuery("#monitorScreen").css("-o-background-size", scalarSetting);
             jQuery("#monitorScreen").css("background-size", scalarSetting);
         } else {
             jQuery("table.tbuilderWrapper").css("background-repeat","no-repeat");
             checkNoTileSettings()
         }
        }
      }
      
       function repeatXAxis() {
      if (jQuery("#squeezePictureCheckbox").is(":checked")) {
         if (jQuery("#repeatXAxis").is(":checked")) {
            var optinScalar = calculateSqueezeImageMultiplier();
             var scalarSetting = optinScalar[0] + " " + optinScalar[1];
             jQuery("#monitorScreen").css("background-repeat","repeat-x");
             jQuery("#squeezeTileBG").attr("checked", false);
             jQuery("#repeatYAxis").attr("checked", false);
             jQuery("#monitorScreen").css("-webkit-background-size", scalarSetting);
             jQuery("#monitorScreen").css("-moz-background-size", scalarSetting);
             jQuery("#monitorScreen").css("-o-background-size", scalarSetting);
             jQuery("#monitorScreen").css("background-size", scalarSetting);
         } else {
             jQuery("#monitorScreen").css("background-repeat","no-repeat");
             checkNoTileSettings()
         }
        }
      }
      
      function repeatYAxis() {
      if (jQuery("#squeezePictureCheckbox").is(":checked")) {
         if (jQuery("#repeatYAxis").is(":checked")) {
            var optinScalar = calculateSqueezeImageMultiplier();
             var scalarSetting = optinScalar[0] + " " + optinScalar[1];
             
             jQuery("#monitorScreen").css("background-repeat","repeat-y");
             jQuery("#repeatXAxis").attr("checked", false);
             jQuery("#squeezeTileBG").attr("checked", false);
             jQuery("#monitorScreen").css("-webkit-background-size", scalarSetting);
             jQuery("#monitorScreen").css("-moz-background-size", scalarSetting);
             jQuery("#monitorScreen").css("-o-background-size", scalarSetting);
             jQuery("#monitorScreen").css("background-size", scalarSetting);

         } else {
             jQuery("#monitorScreen").css("background-repeat","no-repeat");
             checkNoTileSettings()
         }
        }
      }
      
      
      function checkNoTileSettings() {
        if (!(jQuery("#repeatYAxis").is(":checked"))||!(jQuery("#squeezeTileBG").is(":checked"))||!(jQuery("#repeatXAxis").is(":checked"))){

        jQuery("#monitorScreen").css("-webkit-background-size", "cover");
        jQuery("#monitorScreen").css("-moz-background-size", "cover");
        jQuery("#monitorScreen").css("-o-background-size", "cover");
        jQuery("#monitorScreen").css("background-size", "cover");

        }
      }
      
      
      function squeezeSettingsHideShow() {

     if(jQuery("tr.activationSettingsContent").is(":visible")) {
     /* hide everything */
     jQuery('tr.activationSettingsContent').hide();
     } else {
       /* run functions to make everything else hide / display */
       jQuery('tr.activationSettingsContent').show();
       checkSqueezeMenuVisibility();
     }
   }

   function checkSqueezeMenuVisibility() {
            if (jQuery("#squeezeGradientCheckbox").is(":checked")) { jQuery('tr.squeezegradientBackgroundSettings').show(); } else { jQuery('tr.squeezegradientBackgroundSettings').hide(); }
            if (jQuery("#squeezePictureCheckbox").is(":checked")) { jQuery('tr.squeezePictureBGSettings').show(); } else { jQuery('tr.squeezePictureBGSettings').hide();   }
   }
   
   function squeezeDisplayShow() {
               jQuery("div.connectorWrapper").hide();
               jQuery("div#squeezePageDisplay").show();
   }
    function squeezeDisplayHide() {
               jQuery("div.connectorWrapper").show();
               jQuery("div#squeezePageDisplay").hide();
   }
   
   function calculateSqueezeImageMultiplier() {

         var theImage = new Image();
         theImage.src = jQuery("#squeezeImageBackgroundUploadFilePath").val();

         pictureToDimensionsWidth = screen.width/theImage.width;
          percentageMultiplierWidth = ((1/pictureToDimensionsWidth)*100);
          pictureToDimensionsHeight = screen.height/theImage.height;
          percentageMultiplierHeight = ((1/pictureToDimensionsHeight)*100);
          percentageMultiplierHeight = parseInt(percentageMultiplierHeight);
          percentageMultiplierWidth  = parseInt(percentageMultiplierWidth);
        return [percentageMultiplierWidth + "%",percentageMultiplierHeight + "%"];
   }
   
   function checkBackgroundScalar() {
     if(((jQuery("#squeezeTileBG").attr("checked")) || (jQuery("#repeatXAxis").attr("checked")) || (jQuery("#repeatYAxis").attr("checked"))) && jQuery("#squeezePictureCheckbox").attr("checked"))  {
           var optinScalar = calculateSqueezeImageMultiplier();
             var scalarSetting = optinScalar[0] + " " + optinScalar[1];
             jQuery("#monitorScreen").css("-webkit-background-size", scalarSetting);
             jQuery("#monitorScreen").css("-moz-background-size", scalarSetting);
             jQuery("#monitorScreen").css("-o-background-size", scalarSetting);
             jQuery("#monitorScreen").css("background-size", scalarSetting);
             if(jQuery("#squeezeTileBG").attr("checked")) { jQuery("#monitorScreen").css("background-repeat", "repeat");  }
             if(jQuery("#repeatXAxis").attr("checked")) { jQuery("#monitorScreen").css("background-repeat", "repeat-x");  }
             if(jQuery("#repeatYAxis").attr("checked")) { jQuery("#monitorScreen").css("background-repeat", "repeat-y");  }
        }
   }
   
   function verticallyAligned() {
             if(jQuery("#verticallyAligned").is(":checked")) {
               jQuery('#optinTopMarginSlider').slider("enable");
                 jQuery("#squeezeOptinDisplay").css("background-image","url('<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/topMarginBackground.png')");
                 jQuery("#marginDisplay").fadeIn("slow");
                 jQuery("#centredOnScreen").attr("checked", false);
             } else {
               jQuery('#optinTopMarginSlider').slider("disable");
                 jQuery("#marginDisplay").fadeOut("slow");
                 jQuery("#centredOnScreen").attr("checked", true);
                 jQuery("#squeezeOptinDisplay").css("background-image","url('<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/centralBackground.png')");
             }

   }
   
    function centrallyAligned() {
             if(jQuery("#centredOnScreen").is(":checked")) {
                 jQuery('#optinTopMarginSlider').slider("disable");
                 jQuery("#squeezeOptinDisplay").css("background-image","url('<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/centralBackground.png')");
                 jQuery("#marginDisplay").fadeOut("slow");
                 jQuery("#verticallyAligned").attr("checked", false);
             } else {
               jQuery('#optinTopMarginSlider').slider("enable");
                 jQuery("#marginDisplay").fadeIn("slow");
                 jQuery("#verticallyAligned").attr("checked", true);
                 jQuery("#squeezeOptinDisplay").css("background-image","url('<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/topMarginBackground.png')");
             }

   }
   
   function lightboxDisplay(firstLoad) {

            // hide all display options
            jQuery(".lightboxdisplay").hide();
           if(!firstLoad) { unCheckLightboxDisplayOptions(); }
           // var selectedOption = event.target.options[event.target.selectedIndex].value;
           var selectedOption = jQuery("#hc_lb_displayed_select").val();
            
            switch(selectedOption)
            {
              case "allposts":
              jQuery("td.excludeposts").fadeIn("fast");
              jQuery("td.excludecategories").fadeIn("fast");
              break;
              case "allpages":
              jQuery("td.excludepages").fadeIn("fast");
              break;
              case "allpostsandpages":
              jQuery("td.excludeposts").fadeIn("fast");
              jQuery("td.excludepages").fadeIn("fast");
              jQuery("td.excludecategories").fadeIn("fast");
              break;
              case "homepage":
              break;
              case "singleposts":
              jQuery("td.includeposts").fadeIn("fast");
              break;
              case "singlepages":
              jQuery("td.includepages").fadeIn("fast");
              break;
              case "certaincategories":
              jQuery("td.includecategories").fadeIn("fast");
              break;
            }
   }
   
   function unCheckLightboxDisplayOptions() {
           jQuery('input.lightboxdisplaycheckbox').attr('checked', false);
   }

   function previewLightbox() {
           var lightboxHtml = jQuery("div#lightboxChild").html();
           jQuery("div.lightbox_preview_overlay").after(lightboxHtml);
           var lightboxPopup = jQuery("#templateCode").find("div.emailConnectorWrapper").first();
          jQuery(lightboxPopup).css("z-index","500002");
          jQuery(lightboxPopup).css("position","fixed");
          jQuery(lightboxPopup).css("display","none");
           jQuery(lightboxPopup).css("top","50%");
           jQuery(lightboxPopup).css("left","50%");
           var lightboxWidth = jQuery(lightboxPopup).width();
           var lightboxHeight = jQuery(lightboxPopup).height();
           var leftMargin=lightboxWidth/2;
           var topMargin=lightboxHeight/2;
           jQuery(lightboxPopup).css("margin-top","-" + topMargin + "px");
           jQuery(lightboxPopup).css("margin-left","-" + leftMargin + "px");
           
          var fadeDuration = parseInt(jQuery("#lightboxFadeDuration").val());
          var fadeAmount = (parseInt(jQuery("#overlayOpacity").val()))/100;
          var overlayColour = jQuery("#lightboxOverlayColour").val();

          jQuery("div.lightbox_preview_overlay").css("background-color",overlayColour);
          jQuery("div.lightbox_preview_overlay").css("opacity",fadeAmount);
          jQuery("div.lightbox_preview_overlay").fadeIn(fadeDuration);
          jQuery(lightboxPopup).fadeIn(fadeDuration);

           jQuery("div.lightbox_preview_overlay, .lightbox-close").click(function(){
           jQuery("div.lightbox_preview_overlay").fadeOut(fadeDuration);
           jQuery(lightboxPopup).fadeOut(lightbox_preview_overlay);
           jQuery(lightboxPopup).remove();
           });
   }
   
   function previewSlidein() {

           jQuery("div.activeSlideIn").remove();
           var lightboxHtml = jQuery("div#lightboxChild").html();
           jQuery("div.lightbox_preview_overlay").after(lightboxHtml);
           var connectorWrapper = jQuery("#templateCode").find("div.emailConnectorWrapper").first();
           jQuery(connectorWrapper).addClass("activeSlideIn");
           connectorWrapper = ("div.activeSlideIn");
           
           var position = jQuery("#slideInFrom").val();
           jQuery(connectorWrapper).css({ "position":"fixed", "z-index":"1000"});
           jQuery(connectorWrapper).css(position,'-1000px');
           
           var secondDimensionPropery = jQuery("#optinFromLeftOrRight").val();
           var secondDimensionValue = jQuery("#optinLeftRightMargin").val();
           jQuery(connectorWrapper).css(secondDimensionPropery, secondDimensionValue);

           jQuery(connectorWrapper).show();
           var animationDuration = parseInt(jQuery("#optinAnimationDuration").val());
           var aniArgs = {};
           aniArgs[position] = jQuery("#optinTopBottomMargin").val();
           jQuery(connectorWrapper).animate(aniArgs,animationDuration,'linear', function() {
           jQuery(this).delay("1000");
           aniArgs[position] = "-1000px";
           jQuery(this).animate(aniArgs,animationDuration, 'linear', function(){ jQuery(this).remove(); } );
              });

           
           jQuery(".lightbox-close").click(function(){
           aniArgs[position] = '-1000px';
           jQuery(connectorWrapper).animate(aniArgs,animationDuration, 'linear', function(){ jQuery(this).remove(); } );


           });
           
   }
   
   function slideInPreviewMoveLeftRight(amount, plane) {

          switch(plane) {
            case "vertical":
            var fromPosition = jQuery("#slideInFrom").val();
            break;
            case "horizontal":
            var fromPosition = jQuery("#optinFromLeftOrRight").val();
            break;
          }
          
          var connectorWrapper = jQuery("#templateCode").find("div.emailConnectorWrapper").first();
          jQuery(connectorWrapper).css(jQuery("#optinFromLeftOrRight").val(),jQuery("#optinLeftRightMargin").val());
          jQuery(connectorWrapper).css(fromPosition,amount);
   }
   
   function slideInPreview(display) {
     if(display=="true") {
          if(jQuery(".activeSlideIn")) { jQuery(".activeSlideIn").remove(); }
           var lightboxHtml = jQuery("div#lightboxChild").html();
           jQuery("div.lightbox_preview_overlay").after(lightboxHtml);
           var connectorWrapper = jQuery("#templateCode").find("div.emailConnectorWrapper").first();
           jQuery(connectorWrapper).addClass("activeSlideIn");
            var position = jQuery("#slideInFrom").val();
            var positionValue = jQuery("#optinTopBottomMargin").val();
            /* clear css */
           jQuery(connectorWrapper).css("left",""); jQuery(connectorWrapper).css("right",""); jQuery(connectorWrapper).css("top",""); jQuery(connectorWrapper).css("bottom","");
           
           jQuery(connectorWrapper).css(jQuery("#optinFromLeftOrRight").val(),jQuery("#optinLeftRightMargin").val());
           jQuery(connectorWrapper).css(position,positionValue);
           jQuery(connectorWrapper).css({ "position":"fixed", "z-index":"1000", "opacity":"0"});
           jQuery(connectorWrapper).animate({ opacity: 0.8 }, 500);
           } else {
            jQuery("#templateCode").find("div.activeSlideIn").first().animate({opacity: 0}, 500, function() { jQuery(this).remove(); });
           }
   }
   
   function lightboxDropDown() {
     var slideInFrom = jQuery("#slideInFrom").val();
     if(slideInFrom == "top" || slideInFrom=="bottom") { jQuery("#optinFromLeftOrRight").find('option').remove().end().append('<option value="left">Distance From Left Edge</option><option value="right">Distance From Right Edge</option>') }
     if(slideInFrom == "left" || slideInFrom=="right") { jQuery("#optinFromLeftOrRight").find('option').remove().end().append('<option value="top">Distance From Top Edge</option><option value="bottom">Distance From Bottom Edge</option>') }
   }
   
   function displaySettingsTable(event, tableClass) {
     var myCheckbox = event.target;
     if(jQuery(myCheckbox).attr("checked")) {
       jQuery("table."+tableClass).fadeIn();
     } else {
       jQuery("table."+tableClass).fadeOut();
     }
   }
   
</script>
<script charset="ISO-8859-1" src="http://fast.wistia.com/static/popover-v1.js"></script>