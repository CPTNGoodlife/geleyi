<div id="tabs-5" class="tabOptions ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
    <h2>Lightbox Settings</h2>
    <table style="background: none repeat scroll 0% 0% rgb(255, 255, 204); padding: 20px; width: 500px; ">
        <tbody><tr>
                <th colspan="4" class="activationSettings expandable">
                   <a href="http://fast.wistia.com/embed/iframe/5pjght8en8?playerColor=26cc2c" class="wistia-popover[height=450,playerColor=050505,width=800]" style="float:left;"><li class="ui-state-default ui-corner-all helpvideos ui-state-hover" id="ldl5p55sf0" title="Templates in 60 seconds or less"><span class="ui-icon ui-icon-help"></span></li></a> Choose Content on Which to Display your Lightbox or Slide In Bar
                </th>
            </tr>
            <tr class="activationSettingsContent">
               <td>
               Where do you want your popup / lightbox displayed?
               </td>
               <td>
               <select id="hc_lb_displayed_select">
                        <option value="allposts" <?php if($lightbox_options->all_posts): ?>selected<?php endif ?>>All posts</option>
                        <option value="allpages" <?php if($lightbox_options->all_pages): ?>selected<?php endif ?>>All pages</option>
                        <option value="allpostsandpages" <?php if($lightbox_options->all_posts_and_pages): ?>selected<?php endif ?>>All posts and pages</option>
                        <option value="homepage" <?php if($lightbox_options->homepage): ?>selected<?php endif ?>>Homepage</option>
                        <option value="singleposts" <?php if($lightbox_options->single_page && $lightbox_options->included_posts): ?>selected<?php endif ?>>Selection of posts</option>
                        <option value="singlepages" <?php if($lightbox_options->included_pages  && $lightbox_options->included_pages): ?>selected<?php endif ?>>Selection of pages</option>
                        <option value="certaincategories" <?php if($lightbox_options->single_category): ?>selected<?php endif ?>>Selection of categories</option>
                    </select>
               </td>


               </tr>
            </table>
              <table style="background: none repeat scroll 0% 0% rgb(255, 255, 204); padding: 20px; width: 500px; ">
        <tbody>
            <tr class="activationSettingsContent">
                <td class="excludepages lightboxdisplay" colspan="4" style="display:none; text-align:left;">
                 <center><b>Exclude pages (<a href="#" class="clearClosestCheckbox">clear</a>)</b>
                  <br/>
                    <div class="scrollableCheck" style="margin:0 auto; margin-top:4px; text-align:left;">
                        <?php foreach ($available_pages as $mypage): ?>
                            <input class="hc_lb_excluded_pages_checkbox lightboxdisplaycheckbox" type="checkbox" value="<?php echo $mypage->id ?>" <?php if (in_array($mypage->id, $excluded_pages)): ?>checked<?php endif ?>><?php echo $mypage->post_title ?></input><br/>
                        <?php endforeach ?>
                    </div>
                </td>
                <td class="excludeposts lightboxdisplay" colspan="2" style="display:none;">
               <center><b> Exclude posts (<a href="#" class="clearClosestCheckbox">clear</a>)</b>
                   <br/>
                    <div class="scrollableCheck" style="margin:0 auto; margin-top:4px; text-align:left;">
                        <?php foreach ($available_posts as $mypage): ?>
                            <input class="hc_lb_excluded_posts_checkbox lightboxdisplaycheckbox" type="checkbox" value="<?php echo $mypage->id ?>" <?php if (in_array($mypage->id, $excluded_posts)): ?>checked<?php endif ?>><?php echo $mypage->post_title ?></input><br/>
                        <?php endforeach ?>
                    </div>
                </td>
                <td class="includepages lightboxdisplay" colspan="2" style="display:none;">
                <center><b>Include pages (<a href="#" class="clearClosestCheckbox">clear</a>)</b>
            <br />
                    <div class="scrollableCheck" style="margin:0 auto; margin-top:4px; text-align:left;">
                        <?php foreach ($available_pages as $mypage): ?>
                            <input class="hc_lb_included_pages_checkbox lightboxdisplaycheckbox" type="checkbox" value="<?php echo $mypage->id ?>" <?php if (in_array($mypage->id, $included_pages)): ?>checked<?php endif ?>><?php echo $mypage->post_title ?></input><br/>
                        <?php endforeach ?>
                    </div>
                    </center>
                </td>
                <td class="includeposts lightboxdisplay" colspan="2" style="display:none;">
                  <center><b>Include posts (<a href="#" class="clearClosestCheckbox">clear</a>)</b>
            <br />
                    <div class="scrollableCheck" style="margin:0 auto; margin-top:4px; text-align:left;">
                        <?php foreach ($available_posts as $mypage): ?>
                            <input class="hc_lb_included_posts_checkbox lightboxdisplaycheckbox" type="checkbox" value="<?php echo $mypage->id ?>" <?php if (in_array($mypage->id, $included_posts)): ?>checked<?php endif ?>><?php echo $mypage->post_title ?></input><br/>
                        <?php endforeach ?>
                    </div>
                    </center>
                </td>
                <td class="includecategories lightboxdisplay" colspan="2" style="display:none;">
                    <center><b>Include categories (<a href="#" class="clearClosestCheckbox">clear</a>)</b>
        <br/>
                    <div class="scrollableCheck" style="margin:0 auto; margin-top:4px; text-align:left;">
                        <?php foreach ($available_cats as $c): ?>
                            <input class="hc_lb_included_cats_checkbox lightboxdisplaycheckbox" type="checkbox" value="<?php echo $c->term_id ?>" <?php if (in_array($c->term_id, $included_cats)): ?>checked<?php endif ?>><?php echo $c->name ?></input><br/>
                        <?php endforeach ?>
                        </div>
                        </center>
                    </div>
                </td>
                <td class="excludecategories lightboxdisplay" style="display:none;">
                <center><b>Exclude categories (<a href="#" class="clearClosestCheckbox">clear</a>)</b><br/>
                    <div class="scrollableCheck" style="margin:0 auto; margin-top:4px; text-align:left;">
                        <?php foreach ($available_cats as $c): ?>
                            <input class="hc_lb_excluded_cats lightboxdisplaycheckbox" type="checkbox" value="<?php echo $c->term_id ?>" <?php if (in_array($c->term_id, $excluded_cats)): ?>checked<?php endif ?>><?php echo $c->name ?></input><br/>
                        <?php endforeach ?>
                    </div>
                </td>
            </tr>
    </table>
             <table style="background: none repeat scroll 0% 0% rgb(255, 255, 204); padding: 20px; width: 500px;">
            <tr>
             <th colspan="4" class="animationSettings expandable">
                                    <a href="http://fast.wistia.com/embed/iframe/4h92a421fa?playerColor=26cc2c&version=v1&videoHeight=450&videoWidth=800&volumeControl=true" class="wistia-popover[height=450,playerColor=050505,width=800]" style="float:left;"><li class="ui-state-default ui-corner-all helpvideos ui-state-hover" id="ldl5p55sf0" title="Templates in 60 seconds or less"><span class="ui-icon ui-icon-help"></span></li></a>   Lightbox Settings
                </th>
             </tr>
             <tr class="animationSettingsContent">
             <td colspan="4">
             <br/><center>
             Activate the Lightbox &nbsp; <input type="checkbox" <?php if($lightbox_options->activated=="1"){ echo "checked"; }?> id="lightboxActivatedCheckbox" />
             </center>
             </td>
             </tr>
           <tr class="animationSettingsContent">
            <td colspan="4">
            <center>
            
             <table class="hc_admin_connectors_table lightboxOptionsTable" style=" margin:10px;">
                    <thead>
                     <tr>
                    <th style="font-size: 1.1em;" colspan="2">Trigger</th>
                    <th style="font-size: 1.1em;" colspan="2">Setting</th>
                     </tr>
                    </thead>
                     <tr>
            <td class="lightboxTriggers">
            User click
            </td>
            <td>
            <input type="checkbox" disabled="disabled" checked="checked">
            </td>
                <td colspan="2">
                    <input id="hc_lb_on_click" value='[hclightbox id="<?php echo $my_connector->IntegrationID ?>" text="Anchor text"]' type="text" size="40" />
                </td>
            </tr>

                     <tr>
                    <td class="lightboxTriggers">
                    Time after page load</td>
                    <td>
                        <input id="hc_lb_time_enable" name="hc_lb_time_enable" <?php if ($lightbox_options->time_enable == 1): ?>checked="checked"<?php endif ?> type="checkbox" />
                    </td>
                <td colspan="2">

                    <div class="demo">
                    <input id="hc_lb_on_time" value="<?php echo $lightbox_options->on_time ?>" type="text" size="8" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background:transparent;" />
                    <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="timeAfterPageLoadSlider"><a style="left: 30.4348%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                </div><!-- End demo -->
                </td>
            </tr>

             <tr>
                <td class="lightboxTriggers">User scroll down page</td>
                <td>
                    <input id="hc_lb_scroll_enable" name="hc_lb_scroll_enable" <?php if ($lightbox_options->scroll_enable == 1): ?>checked="checked"<?php endif ?> type="checkbox" />
                </td>

                <td colspan="2">

                <div class="demo">
                    <input id="scroll_size" value="<?php echo $lightbox_options->scroll_size ?>" type="text" size="2" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background:transparent;" />
                    <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="scrollSizeSlider"><a style="left: 30.4348%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                </div><!-- End demo -->

                </td>
            </tr>

            </table>
            
             <table class="hc_admin_connectors_table lightboxDisplay lightboxOptions lightboxOptionsTable" style=" margin:10px;width:350px;">
                    <thead>
                     <tr>
                    <th style="font-size: 1.1em;" colspan="1">Configuration</th>
                    <th style="font-size: 1.1em;" colspan="1">Setting</th>
                     </tr>
                    </thead>
                     <tr>
                <td class="lightboxTriggers">Overlay Colour</td>
                <td>
                <input autocomplete="off" maxlength="7" id="lightboxOverlayColour" value="<?php echo $lightbox_options->lightbox_overlay_colour ?>" name="lightboxOverlayColour" class="color-picker miniColors" type="text">
                </td>
            </tr>

              <tr>
                <td class="lightboxTriggers">Overlay Opacity</td>
                <td>
                 <div class="demo">
                    <input id="overlayOpacity" value="<?php echo $lightbox_options->lightbox_overlay_opacity ?>" type="text" size="2" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background:transparent;" />
                    <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="overlayOpacitySlider"><a style="left: 30.4348%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                </div><!-- End demo -->
                </td>
            </tr>
            
            <tr>
                <td class="lightboxTriggers">Fade Duration</td>
                <td>
                 <div class="demo">
                    <input id="lightboxFadeDuration" value="<?php echo $lightbox_options->lightbox_fade_duration ?>" type="text" size="4" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background:transparent;" />
                    <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="lightboxFadeDurationSlider"><a style="left: 30.4348%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                </div><!-- End demo -->
                </td>
            </tr>
            
            <tr >
            <td colspan="2">
            <button id="lightboxPreview" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false"><span class="ui-button-text">Preview</span></button>

            </td>
            </tr>
            </table>
            
            

            
            
            </td></tr></table>
            
            <table style="background: none repeat scroll 0% 0% rgb(255, 255, 204); padding: 20px; width: 500px;">
            <tr>
             <th colspan="4" class="slideInSettings expandable">
                <a href="http://fast.wistia.com/embed/iframe/4ufqkewxjv?playerColor=26cc2c&version=v1&videoHeight=450&videoWidth=800&volumeControl=true" class="wistia-popover[height=450,playerColor=050505,width=800]" style="float:left;"><li class="ui-state-default ui-corner-all helpvideos ui-state-hover" id="ldl5p55sf0" title="Templates in 60 seconds or less"><span class="ui-icon ui-icon-help"></span></li></a>    Slide In Bar Settings
                </th>
             </tr>
             
             <tr class="slideInSettingsContent">
             <td colspan="4">
             <br/><center>
             Activate the Slide in Bar &nbsp; <input type="checkbox" <?php if($lightbox_options->optin_activated=="1"){ echo "checked"; }?> id="slideInActivated" />
             </center>
             </td>
             </tr>
            
              <tr class="slideInSettingsContent">
            <td colspan="4">
            <center>
            
             <!-- opt in bar triggers -->
             <table class="hc_admin_connectors_table optinbarOptions" style=" margin:10px;">
                    <thead>
                     <tr>
                    <th style="font-size: 1.1em;" colspan="2">Trigger</th>
                    <th style="font-size: 1.1em;" colspan="2">Setting</th>
                     </tr>
                    </thead>
                     <tr>
            <td class="lightboxTriggers">
            User click
            </td>
            <td>
            <input type="checkbox" disabled="disabled" checked="checked">
            </td>
                <td colspan="2">
                    <input id="optinBarOnClick" value='[hcoptinbarbox id="<?php echo $my_connector->IntegrationID ?>" text="Anchor text"]' type="text" size="40" />
                </td>
            </tr>

                     <tr>
                    <td class="lightboxTriggers">
                    Time after page load</td>
                    <td>
                        <input id="optinBarTimeEnable" name="optinBarTimeEnable" <?php if ($lightbox_options->optin_time_enable == 1): ?>checked="checked"<?php endif ?> type="checkbox" />
                    </td>
                <td colspan="2">

                    <div class="demo">
                    <input id="optinBarOnTime" value="<?php echo $lightbox_options->optin_on_time ?> seconds" type="text" size="8" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background:transparent;" />
                    <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="optinBarAfterPageLoadSlider"><a style="left: 30.4348%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                </div><!-- End demo -->
                </td>
            </tr>

             <tr>
                <td class="lightboxTriggers">User scroll down page</td>
                <td>
                    <input id="optinBarScrollEnable" name="optinBarScrollEnable" <?php if ($lightbox_options->optin_scroll_enable == 1): ?>checked="checked"<?php endif ?> type="checkbox" />
                </td>

                <td colspan="2">

                <div class="demo">
                    <input id="optinbarScrollSize" value="<?php echo $lightbox_options->optin_scroll_size ?>" type="text" size="2" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background:transparent;" />
                    <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="optinBarScrollEnableSlider"><a style="left: 30.4348%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                </div><!-- End demo -->

                </td>
            </tr>

            </table>
            
            
            
            <!-- optin bar settings -->
            <table class="hc_admin_connectors_table lightboxDisplay optinbarOptions slideInBarTable" style=" margin:10px;width:350px;">
                    <thead>
                     <tr>
                    <th style="font-size: 1.1em;" colspan="1">Configuration</th>
                    <th style="font-size: 1.1em;" colspan="1">Setting</th>
                     </tr>
                    </thead>
            <tr>
                <td class="lightboxTriggers">Slide in from</td>
                <td>
                  <select id="slideInFrom">
                        <option value="top" <?php if($lightbox_options->optin_slide_in_from=="top"): ?>selected<?php endif ?>>Top</option>
                        <option value="bottom" <?php if($lightbox_options->optin_slide_in_from=="bottom"): ?>selected<?php endif ?>>Bottom</option>
                        <option value="left" <?php if($lightbox_options->optin_slide_in_from=="left"): ?>selected<?php endif ?>>Left</option>
                        <option value="right" <?php if($lightbox_options->optin_slide_in_from=="right"): ?>selected<?php endif ?>>Right</option>
                    </select>
                </td>
            </tr>
            
              <tr>
                <td class="lightboxTriggers" style="border-bottom:0px;" colspan="2">Choose where your opt in box will animate to<br/><span style="font-weight:normal">Use the sliders below to control where you want your opt in box to slide in</span></td>
                </tr>
                <tr>
                    <td colspan="2">
                    <div class="demo">
                    <input id="optinTopBottomMargin" value="<?php echo $lightbox_options->optin_top_bottom_margin?>" type="text" size="4" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background:transparent;" />
                    <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="optinTopBottomMarginSlider" style="margin-bottom:5px;"><a style="left: 30.4348%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                </div>

                </td>
            </tr>
            <tr>
            <td style="width:181px;">
                  <select id="optinFromLeftOrRight">
                        <option value="left">From Left of Screen</option>
                        <option value="right">From Right of Screen</option>
                        <option value="center">From Center of Screen</option>
                    </select>
            </td>
            
                <td>
<div class="demo">
                    <input id="optinLeftRightMargin" value="<?php echo $lightbox_options->optin_left_right_margin ?>" type="text" size="4" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background:transparent;" />
                    <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="optinLeftRightMarginSlider"><a style="left: 30.4348%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                </div>

                </td>
            </tr>
              <tr>
                <td class="lightboxTriggers">Animation Duration</td>
                <td>
                 <div class="demo">
                    <input id="optinAnimationDuration" value="<?php echo $lightbox_options->optin_animation_duration ?>" type="text" size="7" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background:transparent;" />
                    <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="optinAnimationDurationSlider"><a style="left: 30.4348%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                </div><!-- End demo -->
                </td>
            </tr>

            <tr >
            <td colspan="2">
            <button id="optinBoxPreview" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false"><span class="ui-button-text">Preview</span></button>

            </td>
            </tr>
            </table>

               </center>

            </td>
            </tr>
            </table>
             <table style="background: none repeat scroll 0% 0% rgb(255, 255, 204); padding: 20px; width: 500px;">
             <tr>
                    <th colspan="4" class="frequencySettings expandable">
                   <a href="http://fast.wistia.com/embed/iframe/cegikhsg22?playerColor=26cc2c&version=v1&videoHeight=450&videoWidth=800&volumeControl=true" class="wistia-popover[height=450,playerColor=050505,width=800]" style="float:left;"><li class="ui-state-default ui-corner-all helpvideos ui-state-hover" id="ldl5p55sf0" title="Templates in 60 seconds or less"><span class="ui-icon ui-icon-help"></span></li></a> Display Frequency and Cookie Settings
                </th>
             </tr>
             <tr class="frequencySettingsContent">
             <td colspan="4">
             <p>You can use cookies to set the display frequency of your choice.  If you set the cookie to 7 days, that means that the popup will only show once every 7 days for returning visitors to your site.  This is recommended to prevent barraging people with the same offer after each page load (thus annoying them and worsening visitor experience).
             </td>
             </tr>
            <tr class="frequencySettingsContent">
                <td colspan="2">Enable cookies (recommended)</td>
                <td colspan="2" width="300">
                    <input id="hc_lb_cookie_enable" name="hc_lb_cookie_enable" <?php if ($lightbox_options->cookie_enable == 1): ?>checked="checked"<?php endif ?> type="checkbox" />
                </td>
            </tr>
            <tr class="cookieOptions frequencySettingsContent"  <?php if ($lightbox_options->cookie_enable != 1): ?>style="display:none;"<?php endif?>>
                <td colspan="2">Cookie duration</td>
                <td colspan="2">
                    <input id="hc_lb_cookie_life" type="text" value="<?php echo $lightbox_options->cookie_life ?>"/>
                </td>
            </tr>
            <tr class="cookieStatus frequencySettingsContent">
                <td colspan="4" id="cookieStatus"></td>
            </tr>

    </table>
</div>