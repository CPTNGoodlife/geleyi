<div class="my_meta_control">
    <p>
        Page Options to customize Custom Page Templates added by Hybrid Connect Plugin.
        Applicable to HybridBlankCanvas, HybridTemplate2 and HybridTemplate3 page templates.
    </p>
    <p><strong>Display Header:</strong>
        <input type="radio" name="_my_optinmeta[header]" value="on"<?php if ($meta['header'] == 'on')
    echo ' checked="checked"'; ?>/> On
        <input type="radio" name="_my_optinmeta[header]" value="off"<?php if ($meta['header'] == 'off')
                   echo ' checked="checked"'; ?>/> Off
        <span>Select No if you dont want header with logo to be displayed.</span>
    </p>
    <label>Logo Image</label>
    <p>
        <input id="hc_upload_image_logo" type="text" size="36" name="_my_optinmeta[logo]"  value="<?php if (!empty($meta['logo']))
                   echo $meta['logo']; ?>" />
        <input id="hc_upload_image_button_logo" type="button" value="Select Image" class="hcAdminButton" />
        <span>Enter image path of the logo to be displayed in header. (click on Select Image, find your image and after that click on Insert into post)</span>
    </p>
    <label>Header Background Image</label>
    <p>
        <input id="hc_upload_image_header" type="text" size="36" name="_my_optinmeta[header_background]" value="<?php if (!empty($meta['header_background']))
                   echo $meta['header_background']; ?>"/>
        <input id="hc_upload_image_button_header" type="button" value="Select Image" class="hcAdminButton" />
        <span>Enter image path of the Background to be displayed in header. (click on Select Image, find your image and after that click on Insert into post)</span>
    </p>
    <?php $selected = ' selected="selected"'; ?>
    <label>Headline Font</label>
    <p>
        <select name="_my_optinmeta[font]">
            <option value=""></option>
            <option value="Arial"<?php if ($meta['font'] == 'Arial')
        echo $selected; ?>>Arial</option>
            <option value="Verdana"<?php if ($meta['font'] == 'Verdana')
                        echo $selected; ?>>Verdana</option>
            <option value="Tahoma"<?php if ($meta['font'] == 'Tahoma')
                        echo $selected; ?>>Tahoma</option>
            <option value="Impact"<?php if ($meta['font'] == 'Impact')
                        echo $selected; ?>>Impact</option>
            <option value="Vegur"<?php if ($meta['font'] == 'Vegur')
                        echo $selected; ?>>Vegur</option>
        </select>
        <span>Select font to be applied for Headlines on the page.</span>
    </p>
    <label>Background Image</label>
    <p>
        <input id="hc_upload_image_body" type="text" size="36" name="_my_optinmeta[body_background]" value="<?php if (!empty($meta['body_background']))
                        echo $meta['body_background']; ?>"/>
        <input id="hc_upload_image_button_body" type="button" value="Select Image" />
        <span>Enter image path of the Background to be displayed across whole page. (click on Select Image, find your image and after that click on Insert into post)</span>
    </p>
    <label>Hybrid-Connect Connector ID</label>
    <p>
        <input type="text" name="_my_optinmeta[hybridshortcode]" value="<?php if (!empty($meta['hybridshortcode']))
                   echo $meta['hybridshortcode']; ?>"/>
        <span>Shortcode for Hybrid Connect.</span>
    </p>
    <label>Custom image</label>
    <p>
        <input id="hc_upload_image_custom" type="text" size="36" name="_my_optinmeta[sidebarimage]" value="<?php if (!empty($meta['sidebarimage']))
                   echo $meta['sidebarimage']; ?>"/>
        <input id="hc_upload_image_button_custom" type="button" value="Select Image" class="hcAdminButton" />
        <span>Sidebar Image Path. (click on Select Image, find your image and after that click on Insert into post)</span>
    </p>
</div>