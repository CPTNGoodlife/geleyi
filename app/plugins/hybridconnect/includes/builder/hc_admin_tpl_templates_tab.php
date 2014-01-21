<div id="tabs-1" class="tabOptions ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
    <h2>Choose an Opt In Template</h2>

    <table style="background: none repeat scroll 0% 0% rgb(255, 255, 204); padding: 20px; width: 500px;">
                                    <tbody><tr>
                                            <th colspan="4" class="optinboxSettings expandable" id="connectorExpandedMarker">
                                                Opt in Box Templates
                                            </th>
                                        <tr class="optinboxSettingsContent expandableSettings">
                                            <td colspan="4">

    <div class="demo" style="width:500px; overflow:hidden;">
        <div class="scroll-pane ui-widget ui-widget-header ui-corner-all" style="border: 1px solid rgb(153, 153, 153); overflow: hidden; width:475px;">
            <div class="scroll-content" style="width:8800px;">
            <?php foreach($connectorTemplates as $thisConnector):?>

                <div class="scroll-content-item ui-widget-header templateGraphic" style="float: left; width: auto; overflow:hidden; margin: 0px; padding:10px; font-size: 3em; line-height: 96px; text-align: center; float: left;">
                <a href="/" class="loadhcTemplate"><img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/<?php echo $thisConnector->template_image; ?>" border="0" />
                <input type="hidden" class="templateConnectorID" name="templateConnectorID" value="<?php echo $thisConnector->id_connector; ?>" />
                <input type="hidden" class="templateTemplateType" name="templateTemplateType" value="<?php echo $thisConnector->type; ?>" />
                <input type="hidden" class="templateTemplateID" name="templateTemplateID" value="<?php echo $thisConnector->id; ?>" />
                </a>
                </div>
            <?php endforeach; ?>
            </div>
            

            
            <div class="scroll-bar-wrap ui-widget-content ui-corner-bottom">
                <div class="scroll-bar ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"><div style="width: 380px;" class="ui-handle-helper-parent"><a style="left: 0%; width: 76.6116px; margin-left: -38.3058px;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"><span class="ui-icon ui-icon-grip-dotted-vertical"></span></a></div></div>
            </div>
        </div>
    </div><!-- End demo -->

               </td>
               </tr>
               <tr>
               <th class="myTemplatesSettings expandable">
            <a href="http://fast.wistia.com/embed/iframe/kn0fmb2rle?playerColor=26cc2c&version=v1&videoHeight=450&videoWidth=800&volumeControl=true" class="wistia-popover[height=450,playerColor=050505,width=800]" style="float:left;"><li class="ui-state-default ui-corner-all helpvideos ui-state-hover" id="ldl5p55sf0" title="Templates in 60 seconds or less"><span class="ui-icon ui-icon-help"></span></li></a>   My Templates
               </th>
               </tr>
               
               <tr class="myTemplatesSettingsContent">
               <td colspan="4">
               
               <div id="ownTemplatesTable" style="max-height:500px; overflow:auto;">
               
               
    <?php $hc_connectors_list = $wpdb->get_results("SELECT * FROM hc_style_connector where user_template='1' and type='0' ORDER by id_connector ASC");    ?>

    <?php include_once('hc_admin_templates_table.php'); ?>

  </div>

               </td>
               </tr>
               
               </table>
    

</div>