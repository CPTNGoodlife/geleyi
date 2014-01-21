<?php if (count($hc_connectors_list) == 0): ?>
    You haven't created any connectors yet. <a href="/" id="hc_new_first_connector">Click here to create one.</a>
<?php else: ?>
    <ul id="icons" class="ui-widget ui-helper-clearfix">
        <table class="hc_admin_connectors_table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Mailing List</th>
                    <th>GotoWebinar</th>
                    <th>Short code / Theme code</th>
                    <th>
                        Post footer <br/>
                        <a href="/" id="hc_admin_remove_postfooter_options"> Remove </a>
                    </th>
                    <th>
                        Comment optin
                    </th>
                    <th>Shortcode <br/>Design</th>
                    <th>Widget <br/> Design</th>
                 <!--   <th>Custom <br/> Design</th>  -->
                    <th>Lightboxes<br/>& Slide Ins</th>
                    <th>Squeeze <br/>Pages</th>
                    <th style="width:45px;"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($hc_connectors_list as $connector): ?>
                    <tr>
                <input type="hidden" class="hc_table_hidden_connector_id" value="<?php echo $connector->IntegrationID ?>" />
                <td valign="middle" style="vertical-align:top">
                    <a href='/' class="hc_link_connector_edit"> <?php echo $connector->Name ?> </a>
                </td>
                <td valign="middle" style="vertical-align:top">
                    <select name="hc_sel_connector_type" class="hc_sel_connector_type" style="width:88px;">
                        <option <?php if ($connector && $connector->Type == 'Hybrid'): ?>selected<?php endif; ?> value="Hybrid">Hybrid</option>
                        <option <?php if ($connector && $connector->Type == 'Facebook'): ?>selected<?php endif; ?> value="Facebook">Facebook</option>
                        <option <?php if ($connector && $connector->Type == 'Form'): ?>selected<?php endif; ?> value="Form">Form</option>
                    </select>
                </td>
                <td valign="middle" class="editDesignButton">
                    <?php if ($connector->MailingList): ?>
                        <a class="hc_link_connector_toMailingList" href="/"><li class="ui-state-default ui-corner-all" title="Connect to Mailing List" style="width:85px; padding:4px; margin:0px auto;"><span class="ui-icon ui-icon-mail-closed" style="width:16px; float:left; margin:0px; padding:0px;"></span><?php echo $connector->MailingList ?></li></a>
                    <?php else: ?>
                        <a class="hc_link_connector_toMailingList" href="/"><li class="ui-state-default ui-corner-all" title="Connect to Mailing List" style="width:65px; padding:4px; margin:0px auto;"><span class="ui-icon ui-icon-mail-closed" style="width:16px; float:left; margin:0px; padding:0px;"></span>Connect</li></a>
                    <?php endif; ?>
                </td>
                <td valign="middle" class="editDesignButton">
                    <?php if ($connector->GotoWebinar != ''): ?>
                        <a class="hc_link_connector_toGotoWebinar" href="/"><li class="ui-state-default ui-corner-all" title="Connect to Mailing List" style="width:65px; padding:4px; margin:0px auto;">
                                <span class="ui-icon ui-icon-video" style="width:16px; float:left; margin:0px; padding:0px;"></span>Settings</li></a>
                    <?php else: ?>
                        <a class="hc_link_connector_toGotoWebinar" href="/"><li class="ui-state-default ui-corner-all" title="Connect to Mailing List" style="width:65px; padding:4px; margin:0px auto;">
                                <span class="ui-icon ui-icon-video" style="width:16px; float:left; margin:0px; padding:0px;"></span>Connect</li></a>
                    <?php endif; ?>
                </td>
                <td valign="middle" style="vertical-align:top;" class="editDesignButton">
                    <input class="hc_txt_admin_shortcode" type='text' value='[hcshort id="<?php echo $connector->IntegrationID ?>"]' readonly='true' size="13" style="margin-bottom:5px;"/><br/>
                    <a href="/" class="hc_link_php_snippet" style="font-size:1em;">
                        Get Theme Code
                    </a>
                </td>
                <td valign="middle" style="vertical-align:top;">
                    <input type="hidden" class="hc_table_hidden_connector_id" value="<?php echo $connector->IntegrationID ?>" />
                    <div><label>Post <input class="hc_radio_post_footer" type="checkbox" <?php if ($connector->IntegrationID == get_option('hyConFooterPost')): ?>checked<?php endif ?> /></label></div>
                    <div><label>Page <input class="hc_radio_page_footer" type="checkbox" <?php if ($connector->IntegrationID == get_option('hyConFooterPage')): ?>checked<?php endif ?> /></label></div>
                </td>
                 <td valign="middle" style="vertical-align:top;">
                    <input type="hidden" class="hc_table_hidden_connector_id" value="<?php echo $connector->IntegrationID ?>" />
                    <input type="hidden" class="hc_comment_footer_id" value="<?php echo get_option("hc_comment_connector_id"); ?>" />
                    <div style="margin-left:auto; margin-right:auto;"><label>Active <input class="hc_radio_comment_footer" type="checkbox" <?php if ($connector->IntegrationID == get_option('hc_comment_connector_id')): ?>checked<?php endif ?> /></label></div>
                </td>
                <td valign="middle" class="editDesignButton">
                    <a class="hc_link_connector_shortcode_template_settings" href="/" ><li class="ui-state-default ui-corner-all" title="Shortcode Design" style="width:45px; padding:4px; margin:0px auto;"><span class="ui-icon ui-icon-pencil" style="width:16px; float:left; margin:0px; padding:0px;"></span>Edit</li></a>
                    <a class="hc_link_connector_statistics" rel="0" href="/"><li class="ui-state-highlight ui-corner-all" title="Statistics" style="width:45px; padding:4px; margin:0px auto; margin-top:5px;"><span class="ui-icon ui-icon-calculator" style="width:16px; float:left; margin:0px; padding:0px;"></span>Stats</li></a>
                </td>
                <td valign="middle" class="editDesignButton">
                    <a class="hc_link_connector_widget_template_settings" href="/"><li class="ui-state-default ui-corner-all" title="Widget Design" style="width:45px; padding:4px; margin:0px auto;"><span class="ui-icon ui-icon-pencil" style="width:16px; float:left; margin:0px; padding:0px;"></span>Edit</li></a>
                    <a class="hc_link_connector_statistics" rel="1" href="/"><li class="ui-state-highlight ui-corner-all" title="Statistics" style="width:45px; padding:4px; margin:0px auto; margin-top:5px;"><span class="ui-icon ui-icon-calculator" style="width:16px; float:left; margin:0px; padding:0px;"></span>Stats</li></a>
                </td>
             <!--    <td valign="middle" class="editDesignButton">
                    <a class="hc_link_connector_custom_template_settings" href="/"><li class="ui-state-default ui-corner-all" title="Custom Design" style="width:45px; padding:4px; margin:0px auto;"><span class="ui-icon ui-icon-pencil" style="width:16px; float:left; margin:0px; padding:0px;"></span>Edit</li></a>
                    <a class="hc_link_nogo" rel="1" href="/">&nbsp;</a>
                </td>  -->
                <td valign="middle" class="editDesignButton">
                    <a class="hc_link_connector_lightbox_template_settings" href="/"><li class="ui-state-default ui-corner-all" title="Lightbox Design" style="width:45px; padding:4px; margin:0px auto;"><span class="ui-icon ui-icon-pencil" style="width:16px; float:left; margin:0px; padding:0px;"></span>Edit</li></a>
                    <a class="hc_link_connector_statistics" rel="2" href="/"><li class="ui-state-highlight ui-corner-all" title="Statistics" style="width:45px; padding:4px; margin:0px auto; margin-top:5px;"><span class="ui-icon ui-icon-calculator" style="width:16px; float:left; margin:0px; padding:0px;"></span>Stats</li></a>
                </td>
                <td valign="middle" class="editDesignButton">
                    <a class="hc_link_connector_squeeze_template_settings" href="/"><li class="ui-state-default ui-corner-all" title="Squeeze Page Design" style="width:45px; padding:4px; margin:0px auto;"><span class="ui-icon ui-icon-pencil" style="width:16px; float:left; margin:0px; padding:0px;"></span>Edit</li></a>
                    <a class="hc_link_connector_statistics" rel="3" href="/"><li class="ui-state-highlight ui-corner-all" title="Statistics" style="width:45px; padding:4px; margin:0px auto; margin-top:5px;"><span class="ui-icon ui-icon-calculator" style="width:16px; float:left; margin:0px; padding:0px;"></span>Stats</li></a>
                 </td>
                <td valign="middle">
                    <a class="hc_link_connector_duplicate" href="/">
                        <li class="ui-state-default ui-corner-all" title="Duplicate" style="float:left; margin:2px;"><span class="ui-icon ui-icon-copy"></span></li>
                    </a>
                    <a href="/" class='hc_link_connector_remove'>
                     <!--   <img src="<?php // echo HYBRIDCONNECT_IAMGES_PATH   ?>/button_remove_large.png" border="0" />  -->
                        <li class="ui-state-default-cancel ui-corner-all" title="Delete" style="width:17px; float:left; margin:2px;"><span class="ui-icon ui-icon-closethick"></span></li>
                    </a>
                </td>
                </tr>
                <tr style="display: none;">
                    <td colspan="13" class="stats_container_background">
                        <div class="hc_container_statistics" id="hc_container_statistics<?php echo $connector->IntegrationID?>">
                        
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </ul>
    <br/>
    <div class="well">
    <div style="margin-left:auto; margin-right:auto; width:590px;">
    <span class="label label-important" style="position:relative; top:0px; left:0px; float:left; margin-right:10px;">New!</span><h1 style="color:#BD362F; margin-top:0px; font-size:2.5em;">Hybrid Connect: Done for You Service</h1>
    </div>
    <h2 style="text-align:center;">Your time is <u>VALUABLE</u>: Leave Everything up to the Experts</h2>
    <h3 style="text-align:center;">We'll Design your opt in forms, handle your copywriting, manage your split tests<br/> and <strong>ultimately maximise the number of leads you
get from your<br/> web site</strong> while you concentrate on your business.</h3>
<div style="width:650px; margin-left:auto; margin-right:auto;">
 <h4>You know that improving lead generation on your site is the number one way to grow your bottom line significantly but you're not a designer, haven't got any experience with copywriting or conversions and <strong><u>you don't have the time to do everything</u></strong>.</h4>
 <h4>We have the solution for you - let us manage everything so you can go back to doing what you do best safe in the knowledge that your lead generation will be taken care of by experts.</h4>
 <center> <i>
 Please note: Due to the "hands on" nature of this offer we have a strict limitation<br/> on the number of clients we can take.</i><br/>
 </center>
<center><a href="http://hybrid-connect.com/done-for-you-service/?hctrack=pluginBackend" target="_blank"><img src="<?php echo HYBRIDCONNECT_IAMGES_PATH   ?>/doneForYouCTA.png" border="0" /></a></center>
 </div>
    </div>
    
    
    
    <a href="<?php echo get_admin_url() ?>admin.php?page=hybridConnectAdminAffiliate">Earn money with Hybrid Connect</a>
<?php endif ?>
<script>
    jQuery(document).ready(function(){
        jQuery(":checkbox").checkbox();
    });
</script>