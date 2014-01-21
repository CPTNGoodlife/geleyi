<div id="tabs-4" class="tabOptions ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
    <h2>Upload / Edit Images</h2>
    <table style="background: none repeat scroll 0% 0% rgb(255, 255, 204); padding: 20px; width: 500px;">
        <tbody><tr>
                <th colspan="4">
                    Side Image
                </th>
            </tr>
            <tr>
                <td colspan="4">
                    <input id="sidePictureShow" name="sidePictureShow" <?php if ($style_image->show_side_image == 1): ?>checked="checked"<?php endif ?> type="checkbox"> Show Side Picture?
                </td>
            </tr>
            <tr class="imageSettings">
                <td>
<a onclick="myMediaPopupHandler('imageUploadFilePath', 'sideimage')"><button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false"><span class="ui-button-text">Upload Image</span></button></a>
                </td>
                <td colspan="3">
                    <input id="imageUploadFilePath" name="imageUploadFilePath" size="50" value="<?php echo $sideImageURL; ?>" type="text">
                </td>
            </tr>
            <tr class="imageSettings">
                <td>
                    Vertical Position
                </td>
                <td>
                    <div class="demo">
                        <input value="<?php echo $style_image->vertical_position ?>" id="imageVerticalPosition" name="imageVerticalPosition" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" type="text">
                        <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="imageVerticalPositionSlider"><a style="left: 47%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                    </div><!-- End demo -->
                </td>
                <td>
                    Image Left Margin
                </td>
                <td>
                    <div class="demo">
                        <input id="imageLeftMargin" name="imageLeftMargin" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" value="<?php echo $style_image->image_left_margin ?>" type="text">
                        <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="imageLeftMarginSlider"><a style="left: 33.3333%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                    </div><!-- End demo -->
                </td>
            </tr>
            <tr class="imageSettings">
                <td>
                    Image Right Margin
                </td>
                <td>
                    <div class="demo">
                        <input id="imageRightMargin" name="imageRightMargin" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" value="<?php echo $style_image->image_right_margin ?>" type="text">
                        <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="imageRightMarginSlider"><a style="left: 33.3333%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                    </div><!-- End demo -->
                </td>
                </tr>
                <tr class="imageSettings">

                  <td>
                    Image Size
                </td>
                <td>
                    <div class="demo">
                        <input id="sideImageSize" name="sideImageSize" style="border: 0pt none; color: rgb(246, 147, 31); font-weight: bold; background: none repeat scroll 0% 0% rgb(255, 255, 204);" value="<?php echo $style_image->image_size; ?>" type="text">
                        <div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="sideImageSlider"><a style="left: 33.3333%;" class="ui-slider-handle ui-state-default ui-corner-all" href="/"></a></div>
                    </div><!-- End demo -->
                </td>
                <td colspan="2">
                <a onclick="resetNativeSize();"><button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false"><span class="ui-button-text">Set Image to Native Size</span></button></a></a>
                </td>
                
            </tr>
        </tbody></table>
    <table style="background: none repeat scroll 0% 0% rgb(255, 255, 204); padding: 20px; width: 500px;">
        <tbody><tr>
                <th colspan="4">
                    Arrow Graphics
                </th>
            </tr>
            <tr>
                <td colspan="4">
                    <input id="arrowGraphicsShow" name="arrowGraphicsShow" <?php if ($style_image->show_arrow_graphics == 1): ?>checked="checked"<?php endif ?> type="checkbox"> Show Arrow Graphics?
                </td>
            </tr>
            <tr id="arrowGraphicsShowRow">
                <td colspan="1" style="text-align: center;">
                    <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/arrow-1-black-l.png" id="blackArrowOption">
                </td>
                <td style="text-align: center;">
                    <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/arrow-1-blue-l.png" id="blueArrowOption">
                </td>
                <td style="text-align: center;">
                    <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/arrow-1-red-l.png" id="redArrowOption">
                </td>
                <td style="text-align: center;">
                    <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/arrow-1-white-l.png" id="whiteArrowOption">
                </td>
            </tr>
            <tr id="arrowGraphicsShowRow">
                <td colspan="1" style="text-align: center;">
                    <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/arrow-1-green-l.png" id="greenArrowOption">
                </td>
                <td style="text-align: center;">
                    <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/arrow-1-orange-l.png" id="orangeArrowOption">
                </td>
                <td style="text-align: center;">
                    <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/arrow-1-purple-l.png" id="purpleArrowOption">
                </td>
                <td style="text-align: center;">
                    <img src="<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/arrow-1-yellow-l.png" id="yellowArrowOption">
                </td>
            </tr>
        </tbody></table>
</div>