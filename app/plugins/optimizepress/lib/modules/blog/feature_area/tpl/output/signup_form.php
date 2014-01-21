<?php echo $before_form ?>
<div class="op_signup_form<?php echo isset($color_scheme) ? ' op-signup-style-'.$color_scheme : '' ?>">
	<?php op_get_var_e($content,'title','','<h2>%1$s</h2>') ?>
	<?php op_get_var_e($content,'form_header','','<p>%1$s</p>') ?>
	<?php echo $form_open ?>
    	<div>
        	<?php 
			echo $hidden_elems.(isset($name_input) ? $name_input : '').$email_input;
			if(isset($extra_fields)){
				echo implode('',$extra_fields);
			}
			?>
			<?php echo $submit_button ?>
        </div>
		<?php op_get_var_e($content,'footer_note','','<p class="secure-icon">%1$s</p>') ?>
	<?php echo $form_close ?>
</div>
<?php echo $after_form ?>