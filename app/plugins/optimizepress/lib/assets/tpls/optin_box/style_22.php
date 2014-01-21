<?php include 'style.inc.php'; ?>

<div id="<?php echo $id; ?>" class="optin-box optin-box-22"<?php echo $style_str; ?>>
	<?php
		$headline = op_get_var($content,'headline','','<h2>%1$s</h2>');
		_e(!empty($headline) ? $headline : '');
	
		echo $form_open.$hidden_str;
		op_get_var_e($fields,'name_field');
		op_get_var_e($fields,'email_field');
		echo implode('',$extra_fields);
		echo $submit_button;
	?>
	</form>
</div>