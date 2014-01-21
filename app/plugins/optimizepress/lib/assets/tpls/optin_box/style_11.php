<?php include 'style.inc.php'; ?>

<div id="<?php echo $id; ?>" class="optin-box optin-box-11"<?php echo $style_str; ?>>
	<?php
		$headline = op_get_var($content,'headline','','<h2>%1$s</h2>');
		_e(!empty($headline) ? $headline : '');

		$paragraph = op_get_var($content,'paragraph','');
		_e(!empty($paragraph) ? '<p class="description">'.strip_tags($paragraph).'</p>' : '');
	
		echo $form_open.$hidden_str;
		op_get_var_e($fields,'name_field');
		op_get_var_e($fields,'email_field');
		echo implode('',$extra_fields);
		echo $submit_button;
		echo $link_button;
	?>
	</form>
	<?php op_get_var_e($content,'privacy','','<p class="privacy">%1$s</p>') ?>
</div>