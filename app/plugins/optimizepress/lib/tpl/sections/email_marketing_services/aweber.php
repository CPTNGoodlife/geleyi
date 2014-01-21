<div class="op-bsw-grey-panel-content op-bsw-grey-panel-no-sidebar cf">        
    <label for="op_sections_email_marketing_services_mailchimp_api_key" class="form-title"><?php _e('AWeber API connection', OP_SN); ?></label>
    <?php if (op_get_option('aweber_access_token') === false || op_get_option('aweber_access_secret') === false): ?>
    <p class="op-micro-copy"><?php _e('AWeber is disconnected.', OP_SN); ?> <a href="<?php echo site_url(OP_AWEBER_AUTH_URL); ?>"><?php _e('Connect', OP_SN); ?></a></p>
	<?php else: ?>
	<p class="op-micro-copy"><?php _e('AWeber is connected.', OP_SN); ?> <a href="<?php echo site_url(OP_AWEBER_AUTH_URL); ?>?disconnect=1"><?php _e('Disconnect', OP_SN); ?></a></p>
	<?php endif; ?>
</div>