<?php
if(isset($content_layouts) && count($content_layouts) > 0){
	foreach($content_layouts as $layout){
		echo '
	<h4>'.$layout['name'].'</h4>'.$layout['item_html'];
	}
} elseif(!$no_missing_text){
	echo '<h2>'.__('No content templates found').'</h2>';
}