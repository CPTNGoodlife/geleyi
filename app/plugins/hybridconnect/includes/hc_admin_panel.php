<?php
$hc_ajax_nonce = wp_create_nonce("hyconspecialsecurityforajaxstring");
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=179074765560903";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<input type="hidden" id="hc_hidden_fb_ajaxnonce" value="<?php echo $hc_ajax_nonce ?>" />
<!--Admin section layout -->
<div id="hc_admin_main_panel" style="width:950px;">
<h2>Welcome to Hybrid Connect!</h2>
   <div style="float:right; margin-right:-15px;"><img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/hybridLogo.png" style="margin-left:100px; float:right; margin-right:-30px;">
   <div style="clear:both; height:10px;"></div>
   <div class="socialIconsWrapper">
   
  <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/social-cta.png" style="float:left; margin-right:7px; margin-top:-5px;" />

<div class="socialAppsHomepage"><a href="https://twitter.com/share" class="twitter-share-button" data-url="http://hybrid-connect.com" data-text="Awesome mailing-list building plugin for WordPress:" data-via="shanerqr">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div>

   <div class="socialAppsHomepage" id="google">
<div class="g-plusone" data-size="tall" data-href="http://www.hybrid-connect.com"></div>
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
</div>

   <div class="socialAppsHomepage"><div class="fb-like" data-href="http://www.hybrid-connect.com" data-send="false" data-layout="box_count" data-width="450" data-show-faces="true"></div></div>

   </div>
   </div>

   
   
    <p>Thank you for purchasing Hybrid Connect!</p>
    <p>If you haven't already done so, you should go through all the steps in the <a href="admin.php?page=hybridConnectAdminSetup">setup</a> section first before you start creating any connectors.</p>
    </p>
     <br/><br/>
    <div id="hc_button_add_connector_container">
      <!--  <input type="button" id="hc_button_add_connector" value="Add a New Connector" class="hcAdminButton" />  -->
                        <button id="hc_button_add_connector" class="ui-button ui-widget ui-corner-all ui-button-text-only ui-state-default" role="button" aria-disabled="false"><span class="ui-button-text">Add a New Connector</span></button>
    </div>
    
    <?php $fbValidated = get_option('hc_fb_appvalid');
    if($fbValidated=="0") { ?>

    <div class="ui-state-error ui-corner-all" style="padding: 0 .7em; margin-top:5px; margin-bottom:5px;">
            <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                <strong>We can't connect to your Facebook App!  Please check your Facebook App settings in the <a href="admin.php?page=hybridConnectAdminSetup">setup page</a>. None of your connectors will display if we can't connect successfully to your app!</strong></p>
        </div>


    <?php }?>
    
    <h3>Current Connectors</h3>
    <div id="hc_connectors_table_container">
    </div>
    <div id="hc_admin_new_connector_container">
    </div>
    <div id="hc_admin_mail_list_settings_container">
    </div>
    <div id="hc_admin_webinar_settings_container">
    </div>
</div>
<div id="hc_admin_tpls_panel"></div>
<div id="hc_admin_ajax_loading" style="position:fixed; top:50%; left:50%; z-index:3000; display:inline; width:48px; height:48px;">
    <center><img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/ajax-loading.gif"></center>
</div>
<div id="hc_admin_confirmation_dialog" title="Confirm delete">
    <p>
        <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
        This content will be permanently deleted. Are you sure?
    </p>
</div>
<div id="hc_admin_confirmation_variation" title="Confirm delete">
    <p>
        <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
        This variation will be permanently deleted. Are you sure?
    </p>
</div>
<div id="hc_admin_notification_dialog" title="Notification">
    <p>
        <br/>
        <span class="ui-icon ui-icon-info" style="float:left; margin:0 7px 20px 0;"></span>
        <span id="hc_admin_notification_dialog_txt">
        </span>
    </p>
</div>
<script type="text/javascript">
    function myMediaPopupHandler(inputField,identifier)
    {
        window.send_to_editor = function(html) {
            imgurl = jQuery('img',html).attr('src');
            jQuery("#" + inputField).val(imgurl);
            // update image class if class is set
            if(identifier=="sideimage"){
            jQuery("img.optinGraphic").attr("src",imgurl);
          }
           if(identifier=="imageBG") {
           imageBackgroundChange();
         }
         if(identifier=="squeezeImageBG") {
           jQuery("#monitorScreen").css("background-image","url('" + imgurl + "')");
           checkBackgroundScalar();
         }

            tb_remove();
        }
        formfield = jQuery("#" +inputField + ".attr('name')").val();
        tb_show('', 'media-upload.php?type=image&tab=library&TB_iframe=true');
        
        
        return false;
    }
    function tb_remove() {
        jQuery("#TB_imageOff").unbind("click");
        jQuery("#TB_closeWindowButton").unbind("click");
        jQuery("#TB_closeWindowButton").remove();
        jQuery("#TB_title").remove();
        jQuery("#TB_window").hide("fast", function(){
            //jQuery('#TB_window,#TB_overlay,#TB_HideSelect').trigger("unload").unbind().remove();
        });
        //jQuery('#TB_window,#TB_overlay,#TB_HideSelect').trigger("unload").unbind().remove();
        jQuery("#TB_load").remove();
        if (typeof document.body.style.maxHeight == "undefined") {//if IE 6
            jQuery("body","html").css({height: "auto", width: "auto"});
            jQuery("html").css("overflow","");
        }
        jQuery("#TB_overlay").remove();
        jQuery("#TB_HideSelect").remove();
        jQuery(document).unbind('.thickbox');
        jQuery("#TB_window").remove();
    }
    function hc_tb_remove() {
        return false;
    }

</script>