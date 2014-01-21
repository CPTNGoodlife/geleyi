<div class="op-signup_form-form_html">
    <?php
        $integrationType = op_get_var($fields, 'integration_type', 'custom');
        /*
         * On some occasions $integrationType was returning as an empty string ("");
         */
        if (empty($integrationType)) {
            $integrationType = 'custom';
        }
    ?>
    <p class="integration_type">
        <label for="<?php echo $id ?>integration_type"><strong><?php _e('Integration Type',OP_SN) ?>:</strong></label>
        <select id="<?php echo $id ?>integration_type" name="<?php echo $fieldname ?>[form_html][integration_type]" class="integration_type_select">
            <option value="email" <?php selected('email', $integrationType); ?>><?php _e('Email Data', OP_SN); ?></option>
            <option value="custom" <?php selected('custom', $integrationType); ?>><?php _e('Custom Form', OP_SN); ?></option>
            <?php
                $providers = op_assets_provider_list();
                if (count($providers) > 0): foreach ($providers as $key => $value): ?>
            <option value="<?php echo $key; ?>" <?php selected($key, $integrationType); ?>><?php echo $value; ?></option>
            <?php 
                endforeach; endif;
            ?>
        </select>
    </p>
    <p class="provider_list">
        <label for="<?php echo $id ?>list"><strong><?php _e('Provider List',OP_SN) ?>:</strong></label>
        <?php $list = op_get_var($fields, 'list', null); ?>
        <select id="<?php echo $id ?>list" name="<?php echo $fieldname ?>[form_html][list]" class="provider_list_select" data-default="<?php echo $list; ?>">
            <?php
                if (false === in_array($integrationType, array('email', 'custom')) && count($lists = op_assets_provider_details($integrationType)) > 0): foreach ($lists['lists'] as $key => $item):
            ?>
            <option value="<?php echo $key; ?>" <?php selected($key, $list);?>><?php echo $item['name']; ?></option>
            <?php 
                endforeach; endif; 
            ?>
        </select>
    </p>
    <div class="field-note provider_list_note">
        <p><?php _e('Note: Lists can take up to 1 minute to be retrieved from your provider', OP_SN); ?></p>
    </div>
    <p class="thank_you_page">
        <label for="<?php echo $id ?>thank_you_page"><strong><?php _e('Thank You Page URL',OP_SN) ?>:</strong></label>
        <input size="60" type="text" id="<?php echo $id ?>thank_you_page" name="<?php echo $fieldname ?>[form_html][thank_you_page]" value="<?php echo $fields['thank_you_page'] ?>" />
    </p>
    <p class="action_page">
        <input type="hidden" id="<?php echo $id ?>action_page" name="<?php echo $fieldname ?>[form_html][action_page]" value="<?php echo $fields['action_page'] ?>" />
    </p>
    <p class="email_data_field cf">
        <label for="<?php echo $id ?>email_address"><strong><?php _e('Email Address:',OP_SN) ?></strong></label>
        <input size="60" type="text" id="<?php echo $id ?>email_address" name="<?php echo $fieldname ?>[form_html][email_address]" value="<?php echo $fields['email_address'] ?>" />
    </p>
    <p class="email_data_field cf">
        <label for="<?php echo $id ?>redirect_url"><strong><?php _e('Redirect URL:',OP_SN) ?></strong></label>
        <input size="60" type="text" id="<?php echo $id ?>redirect_url" name="<?php echo $fieldname ?>[form_html][redirect_url]" value="<?php echo $fields['redirect_url'] ?>" />
    </p>
    <p class="msg form_html_field cf"><?php _e('Enter your html opt-in code below and we\'ll hook up your form to the template:',OP_SN) ?></p>
    <p class="form_html_field cf"><textarea cols="60" rows="10" id="<?php echo $id ?>formhtml" name="<?php echo $fieldname ?>[form_html][html]" class="form_html"><?php echo $fields['html'] ?></textarea></p>
    <p class="cf new_window">
        <input type="checkbox" name="<?php echo $fieldname ?>[form_html][new_window]" id="<?php echo $id ?>new_window" value="Y"<?php echo ($fields['new_window'] == 'Y' ? ' checked="checked"' : '') ?> />
        <label for="<?php echo $id ?>new_window"><?php _e('Submit the form to a new window',OP_SN) ?></label>
    </p>
    <?php if(!$disable_name_options): ?>
    <p class="cf">
        <input type="checkbox" name="<?php echo $fieldname ?>[form_html][disable_name]" id="<?php echo $id ?>disable_name" value="Y"<?php echo ($fields['disable_name'] == 'Y' ? ' checked="checked"' : '') ?> class="disable_name" />
        <label for="<?php echo $id ?>disable_name"><?php _e('Disable name box?',OP_SN) ?></label>
    </p>
    <?php
    $name_disabled = ($fields['disable_name'] == 'Y' ? ' class="hidden-el"' : '');
    ?>
    <p class="form_html_field cf<?php echo $name_disabled ?>">
        <label for="<?php echo $id ?>name_box"><strong><?php _e('Name:',OP_SN) ?></strong></label>
        <select id="<?php echo $id ?>name_box" name="<?php echo $fieldname ?>[form_html][name_box]" class="name_select name_input field_select">
            <?php /*if (isset($lists['lists'][$list]['fields']) && count($lists['lists'][$list]['fields']) > 0): foreach ($lists['lists'][$list]['fields'] as $key => $value): ?>
            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
            <?php endforeach; endif;*/ ?>
        </select>
        <input type="hidden" id="<?php echo $id ?>name_box_selected" value="<?php echo $fields['name_box'] ?>" class="name_input name_box_selected" />
    </p>
    <?php endif ?>
    <p class="form_html_field cf">
        <label for="<?php echo $id ?>email_box"><strong><?php _e('Email:',OP_SN) ?></strong></label>
        <select id="<?php echo $id ?>email_box" name="<?php echo $fieldname ?>[form_html][email_box]" class="email_select email_input field_select"></select>
        <input type="hidden" id="<?php echo $id ?>email_box_selected" value="<?php echo $fields['email_box'] ?>" class="email_input email_box_selected" />
    </p>
    <p class="form_html_field cf">
        <label for="<?php echo $id ?>method"><strong><?php _e('Method:',OP_SN) ?></strong></label>
        <select id="<?php echo $id ?>method" name="<?php echo $fieldname ?>[form_html][method]" class="method_select">
            <option value="post">POST</option>
            <option value="get">GET</option>
        </select>
    </p>
    <p class="form_html_field cf">
        <label for="<?php echo $id ?>action"><strong><?php _e('Form URL:',OP_SN) ?></strong></label>
        <input size="60" type="text" id="<?php echo $id ?>action" name="<?php echo $fieldname ?>[form_html][action]" value="<?php echo $fields['action'] ?>" class="form_action" />
    </p>
    <div class="form_html_field cf extra_fields">
    	<label><strong><?php _e('Extra Fields',OP_SN) ?></strong></label><br />
        <div class="op-multirow-container cf">
        <?php if(is_array($fields['extra_fields']) && isset($fields['extra_fields']['field_name'])): 
		$field_names = $fields['extra_fields']['field_name'];
		for($i=0,$il=count($field_names);$i<$il;$i++):
			$field_id = $id.'form_html_'.$i.'_'; ?>
        	<div class="op-multirow cf">
            	<div>
                    <label for="<?php echo $field_id ?>field_name"><?php _e('Field Name',OP_SN) ?></label>
                    <select name="<?php echo $fieldname ?>[form_html][extra_fields][field_name][]" id="<?php echo $field_id ?>field_name">
                        <option value="op_add_new_field"><?php _e('Add New Field',OP_SN) ?></option>
                        <option value="">-----------------</option>
                        <?php if (isset($lists['lists'][$list]['fields']) && count($lists['lists'][$list]['fields']) > 0): foreach ($lists['lists'][$list]['fields'] as $key => $value): ?>
                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                        <?php endforeach; endif; ?>
                    </select>
                    <input type="hidden" name="selected_value" value="<?php echo op_attr($field_names[$i]) ?>" />
                </div>
                <div>
                    <input type="text" name="<?php echo $fieldname ?>[form_html][extra_fields][title][]" id="<?php echo $field_id ?>title" value="<?php echo op_attr($fields['extra_fields']['title'][$i]) ?>" /></div><div><label for="<?php echo $field_id ?>text"><?php _e('Text',OP_SN) ?></label><input type="text" name="<?php echo $fieldname ?>[form_html][extra_fields][text][]" id="<?php echo $field_id ?>text" value="<?php echo op_attr($fields['extra_fields']['text'][$i]) ?>" /></div><div class="op-multirow-controls"><a href="#remove"><img alt="<?php _e('Remove',OP_SN) ?>" src="<?php echo OP_IMG ?>remove-row.png" /></a>
                </div>
            </div>
        <?php endfor; endif ?>
		</div>
        <a class="add-new-row" href="#"><?php _e('Add New', OP_SN) ?></a>
    </div>
    <div class="email_data_field cf email_data_extra_fields">
    	<label><strong><?php _e('Extra Fields',OP_SN) ?></strong></label><br />
        <div class="op-multirow-container cf">
        <?php if(is_array($fields['email_extra_fields'])): foreach($fields['email_extra_fields'] as $item): ?>
			<div class="op-multirow cf">
            	<label><?php _e('Text',OP_SN) ?></label>
                <input type="text" name="<?php echo $fieldname ?>[form_html][email_extra_fields][]" value="<?php echo op_attr($item) ?>" />
                <div class="op-multirow-controls">
                    <a href="#remove"><img alt="<?php _e('Remove',OP_SN) ?>" src="<?php echo OP_IMG ?>remove-row.png" /></a>
                </div>
            </div>
		<?php endforeach; endif ?>
        </div>
        <a href="#" class="add-new-row"><?php _e('Add New', OP_SN) ?></a>
    </div>
    <?php if (true === op_assets_provider_enabled('gotowebinar')) : ?>
    <p class="gotowebinar_field cf">
        <label for="<?php echo $id ?>method"><strong><?php _e('GoToWebinar:',OP_SN) ?></strong></label>
        <select id="<?php echo $id ?>method" name="<?php echo $fieldname ?>[form_html][gotowebinar_enabled]" class="gotowebinar_enabled_select">
            <option value="Y"<?php if (isset($fields['gotowebinar']) && !empty($fields['gotowebinar'])) : echo 'selected="selected"'; endif; ?>><?php _e('Integrate with GoToWebinar', OP_SN); ?></option>
            <option value="N"<?php if (!isset($fields['gotowebinar']) || empty($fields['gotowebinar'])) : echo 'selected="selected"'; endif; ?>><?php _e("Don't integrate", OP_SN); ?></option>
        </select>
    </p>
    <p class="gotowebinar_list_field cf">
        <label for="<?php echo $id ?>method"><strong><?php _e('GoToWebinar List:',OP_SN) ?></strong></label>
        <select id="<?php echo $id ?>method" name="<?php echo $fieldname ?>[form_html][gotowebinar]" class="gotowebinar_select" data-default="<?php echo $fields['gotowebinar']; ?>">
            <?php 
                $webinars = op_assets_provider_details('gotowebinar'); 
                if (count($webinars['lists']) > 0) : foreach ($webinars['lists'] as $webKey => $webinar) : ?>
            ?>
            <option value="<?php echo $webKey; ?>"<?php if ($fields['gotowebinar'] === $webKey) : echo 'selected="selected"'; endif; ?>><?php echo $webinar['name']; ?></option>            
            <?php 
                endforeach; endif; 
            ?>            
        </select>
    </p>
    <?php endif; ?>
    <input type="hidden" class="field_prefix" value="<?php echo esc_attr($fieldname) ?>[form_html]" />
    <input type="hidden" class="field_idprefix" value="<?php echo esc_attr($id) ?>form_html_" />
    <div class="hidden-div hidden-el"></div>
</div>