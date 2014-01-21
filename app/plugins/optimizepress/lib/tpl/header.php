<div class="op-bsw-wizard">
	<div class="op-bsw-content cf">
		<div class="op-bsw-header cf">
			<?php
				switch(strtolower($title)){
					case 'launch suite':
						$logo_file = 'launchsuite';
						break;
					case 'theme settings':
						$logo_file = 'blogsettings';
						break;
					case 'dashboard': //Uncomment once we have the dashboard logo file in place
						$logo_file = 'dashboard';
						break;
					default:
						$logo_file = 'optimizepress';
				}
			?>
			<?php
				$host = explode('/', str_replace(array('http://', 'https://'), '', $_SERVER['HTTP_HOST']));
				$img_path = str_replace(array('http://', 'https://', $host[0]), '', op_img('', true));
				if (!file_exists($_SERVER['DOCUMENT_ROOT'].$img_path.'logo-'.$logo_file.'.png')) $logo_file = 'optimizepress';
			?>
			<div class="op-logo"><img src="<?php op_img() ?>logo-<?php echo $logo_file; ?>.png" alt="OptimizePress" height="50" class="animated flipInY" /></div>
			<ul>
				<li><a href="http://help.optimizepress.com/" target="_blank"><img src="<?php echo OP_IMG ?>live_editor/le_help_bg.png" onmouseover="this.src='<?php echo OP_IMG ?>live_editor/le_help_icon.png'" onmouseout="this.src='<?php echo OP_IMG ?>live_editor/le_help_bg.png'" alt="<?php _e('Help', OP_SN) ?>" class="tooltip animated pulse" title="<?php _e('Help', OP_SN) ?>" /></a></li>
				<script src='<?php echo OP_JS ?>tooltipster.min.js'></script>
				<script>
					jQuery(document).ready(function() {
					jQuery('.tooltip').tooltipster({animation: 'grow'});
					});
				</script>
			</ul>
		</div> <!-- end .op-bsw-header -->