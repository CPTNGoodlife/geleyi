<?php

class all_around_viewer {
	public $wrapper, $main_object, $plugin_url;
	function __construct(&$wrapper, &$main_object) {
		$this->wrapper=$wrapper;
		$this->main_object=$main_object;
		$this->plugin_url=$main_object->url;
	}
	
	function generate_form ($id) {

		//$this->main_object->init_google_fonts();
		$this->generate_header();
		
		$message='Add slider';
		$admin_url=$this->main_object->admin_url;
		$plugin_url=$this->main_object->url;
		$style2=array(
			'width' => '140px'
		);
		$style3=array(
			'width' => '140px',
			'margin-left' => '5px !important'
		);
		$new = all_around_visual_elements::generate_button('all_around_add_new_item', 'Add new item', 'black_clear', FALSE, $style2, FALSE);
		$new .= all_around_visual_elements::generate_button('all_around_add_new_from_post', 'Add new from post', 'black_clear', FALSE, $style3, FALSE);
		$new .= all_around_visual_elements::generate_button('all_around_add_new_from_category', 'Add new from category', 'black_clear', FALSE, $style3, TRUE);

		if ($id!='new') {
			$this->main_object->mvc->load($id);
			$this->main_object->mvc->pre_process_form ('all');
			$loaded_items=$this->main_object->mvc->generate_all_sub_items();
			$title_value=$this->main_object->mvc->get_loaded_name();
			$message='Edit slider';
		} else {
			$this->main_object->mvc->pre_process_form ('all');
			$loaded_items=array();
			$title_value='New item';
			//$elements=$this->main_object->mvc->generate_html_form_part('empty_item', 0);
		}

		$status='<h2 class="all_around_status">'.$message.'<a href="'.$admin_url.'">Cancel</a></h2> <span class="all_around_small_buton" id="all_around_update_notification" style="display: none;"></span>';
		$title=all_around_visual_elements::generate_input ('element_name', $title_value, NULL, array('auto_width'=>FALSE));

		$ul=all_around_visual_elements::generate_sortable('all_around_sortable', $loaded_items, NULL, 'all_around_primary_sortable');

		$style2=array(
			'width' => '70px'
		);
		$style_collapsible=array(
			'width' => '280px'
		);
		$buttons=all_around_visual_elements::generate_button('all_around_save_button', 'Save', 'blue', FALSE, $style2, FALSE).all_around_visual_elements::generate_button('all_around_preview_button', 'Preview', '', FALSE, $style2, TRUE);
		$loader='<img src="'.$plugin_url.'images/ajax-loader2.gif" id="all_around_save_loader" style="float: right; margin-right:38px; display: none;">';
		$saved='<a class="all_around_small_buton" style="float: right; margin-right: 38px; display: none;" id="all_around_save_status">Saved</a>';
		$save=all_around_visual_elements::generate_collapsible('Save'.$saved.$loader, $buttons, $style_collapsible, TRUE);

		$settings_form = $this->main_object->mvc->generate_html_form_part('settings');
		
		$steps=<<<eod
<h2 class="all_around_status">Step by step:</h2>
<ol class="all_around_steps">
	<li>
		<h3>Enter some name for this slider, something associative (name will not be shown on page)</h3>
	</li>
	<li>
		<h3>Add items</h3>
	</li>
	<li>
		<h3>Save it</h3>
	</li>
	<li>
		<h3>And go to <a href="$admin_url">All Around plugin main page</a></h3>
	</li>
</ol>
eod;
		$settings_side=$save.$settings_form;
		$element_side=$status.$title.'<br />'.$new.'<br />'.$ul.'<br />'.$steps;

		$view = all_around_visual_elements::generate_form_layout($element_side, $settings_side);
		$hidden=all_around_visual_elements::generate_hidden('element_id', $id);
		$view = all_around_visual_elements::generate_form ($hidden.$view, 'form1');
		echo $view;

		$this->close_header();
	}
	
	function generate_index () {
		$this->generate_header();

		$url=$this->main_object->admin_url;
		$name=$this->main_object->plugin_name;
		$new_url=$url.'&action=new';

		echo '<h2 class="all_around_status">'.$name.'<a href="'.$new_url.'">Create new</a></h2> <span class="all_around_small_buton" id="all_around_update_notification" style="display: none;"></span>';
		echo $this->main_object->mvc->get_index_table();

		echo all_around_visual_elements::generate_button('all_around_new', 'Create new', 'blue', NULL, array('width'=>'150px', 'float'=>'right'), TRUE, $new_url);
		
		if (!isset($this->main_object->settings_in_db['use_separated_jquery'])) $this->main_object->settings_in_db['use_separated_jquery']=0;
		$use_separated_jquery=$this->main_object->settings_in_db['use_separated_jquery'];

		$separated=all_around_visual_elements::generate_checkbox ('Use separated jQuery only for this plugin in order to skip possible conflicts (activate this option only if slider fails to open)', 'use_separated_jquery', $use_separated_jquery, array('empty_wrapper'=>1), array('auto_width'=>FALSE));
		
		$skip_head_section=$this->main_object->settings['skip_head_section'];
		$skipheadsection=all_around_visual_elements::generate_checkbox ('Put CSS &amp; JS near HTML block, not in &lt;head&gt; section (this can help if your template or some other plugin screws up &lt;head&gt; section)', 'skip_head_section', $skip_head_section, array('empty_wrapper'=>1), array('auto_width'=>FALSE));
		
		//$settings=print_r(, TRUE);
		//<div style="background-color: white;"><pre>$settings</pre></div>
		//echo '<span style="color: #E0E0E0;">prefix='.$this->wrapper->get_db_prefix().'<br />table='.$this->main_object->get_plugin_table_name().'</span><br />';
		echo <<<eof
		<script>
		(function($){
			all_around_add_event('use_separated_jquery', function(name, value) {
				all_around_send_ajax('all_around_set_settings_1val', 'var1=use_separated_jquery&val1='+value, function(response) {
					$('#all_around_save_status').fadeIn('slow', function(){
						$(this).fadeOut('slow');
					});

				});
			});
			all_around_add_event('skip_head_section', function(name, value) {
				all_around_send_ajax('all_around_set_settings_1val', 'var1=skip_head_section&val1='+value, function(response) {
					$('#all_around_save_status').fadeIn('slow', function(){
						$(this).fadeOut('slow');
					});

				});
			});
		})(jQuery);
		</script>
		<br /><span style="padding: 2px 0 0 0; font-size: 12px; display: block; float: left; font-weight: bold; position: relative; color: #E0E0E0;">Troubleshooting?</span>&nbsp;&nbsp;&nbsp;<a class="all_around_small_buton" style="top: 3px; display: none;" id="all_around_save_status">Saved</a><br /><br />
		$separated
		$skipheadsection
		<br /><br /><br />
		<h2 class="all_around_status">Step by step:</h2>
<ol class="all_around_steps">
	<li>
		<h3>Click on "Create New" button</h3>
	</li>
	<li>
		<h3>Setup your slider, save it, and come back here</h3>
	</li>
	<li>
		<h3>Copy "shortcode" from the table above and paste it in your post or page.<br />(for adding slider into .php parts of template use it like this "&lt;?php echo do_shortcode('[all_around id="X"]'); ?&gt;" where X is id of your slider)</h3>
	</li>
</ol>
eof;

		$this->close_header();
	}

	
	function generate_header() {
		$uploadertype=$this->wrapper->uploader_type;
		$ajaxreceiver=$this->wrapper->ajax_receiver;
		$ajaxactionparam=$this->wrapper->ajax_action_param;
		$ajaxsavehandler=$this->wrapper->ajax_save_handler;
		$ajaxpreviewhandler=$this->wrapper->ajax_preview_handler;
		$adminurl=$this->main_object->admin_url;
		$pluginurl=$this->main_object->url;
		$version=$this->main_object->plugin_version;
		$google_fonts_last_update=$this->main_object->settings['google_fonts_update'];
		$updategooglefonts=0;
		$now=date('m-Y');
		if ($now!=$google_fonts_last_update) $updategooglefonts=1;
		echo <<<eof
<script>
var all_around_uploader_type = $uploadertype;
var all_around_ajax_receiver = '$ajaxreceiver';
var all_around_ajax_action_param = '$ajaxactionparam';
var all_around_ajax_save_handler = '$ajaxsavehandler';
var all_around_ajax_preview_handler = '$ajaxpreviewhandler';
var all_around_admin_url = '$adminurl';
var all_around_plugin_url = '$pluginurl';
var all_around_should_check_for_update=1;
var all_around_version='$version';
var all_around_update_google_fonts = $updategooglefonts;
</script>
<style>
</style>
<br />

<div style="margin: 4px 15px 0 0;">
eof;
	}
		
	function close_header()  {
		echo <<<eof
<script>
(function($){
	$(document).ready(function(){

eof;

		echo $this->main_object->mvc->generate_backend_javascript();

		echo <<<eof
	});
})(jQuery);
</script>

eof;
		echo '</div>';
	}

}


?>