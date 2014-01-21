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
   <div style="float:right; margin-right:-15px; margin-bottom:30px;"><img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/hybridLogo.png" style="margin-left:100px; float:right; margin-right:-30px;">
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

<input type="hidden" id="hc_hidden_fb_ajaxnonce" value="<?php echo $hc_ajax_nonce ?>" />

 <?php $fbValidated = get_option('hc_fb_appvalid');
    if($fbValidated=="0") { ?>
    
    <div id="hc_admin_ajax_loading" style="position:fixed; top:50%; left:50%; z-index:3000; display:inline; width:48px; height:48px;">
    <center><img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/ajax-loading.gif"></center>
</div>

    <div class="ui-state-error ui-corner-all" style="padding: 0 .7em; margin-top:5px; margin-bottom:5px;">
            <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                <strong>We can't connect to your Facebook App!  Please check your Facebook App settings in the <a href="admin.php?page=hybridConnectAdminSetup">setup page</a>. None of your connectors will display if we can't connect successfully to your app!</strong></p>
        </div>


    <?php }?>


<h3>Split Test History</h3>

<p>Here you can view a complete history of all the split tests that you've run using Hybrid Connect.</p>

<p>Simply browse through the list of tests below and click on "Show Test Results" to view the conversion statistics and the designs that were tested.</p>

<div id="hc_admin_tests_panel"></div>

</div>
<div id="hc_admin_tpls_panel"></div>
<div id="hc_admin_ajax_loading" style="position:fixed; top:50%; left:50%; z-index:3000; display:inline; width:48px; height:48px;">
    <center><img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/ajax-loading.gif"></center>
</div>