<?php

include_once(dirname( __FILE__ ) . '/mvc_custom.php');

class all_around_mvc_controller { // main, switch
	public $model, $view, $wrapper, $main_object;

	function __construct(&$wrapper, &$main_object) {
		$this->wrapper=$wrapper;
		$this->main_object=$main_object;
		
		$this->view = new all_around_mvc_view_custom($this, $wrapper, $main_object);
		$this->model = new all_around_mvc_model_custom($this, $wrapper, $main_object);
		$this->view->set_model($this->model);
		$this->model->set_view($this->view);
		
		//$this->model->find_target ('item_*_content', 'item_7_link_type');
		//$this->model->find_target ('item_44_content', 'item_5_link_type');
		//exit;

		if ($this->main_object->mode=='backend') {
			$this->wrapper->add_ajax_hook('all_around_add_subitem', array(&$this, 'ajax_add_subitem'));
			$this->wrapper->add_ajax_hook('all_around_get_custom_form', array(&$this, 'ajax_get_custom_form'));
			$this->wrapper->add_ajax_hook('all_around_add_subitem_from_category', array(&$this, 'ajax_add_subitem_from_category'));
			$this->wrapper->add_ajax_hook($this->wrapper->ajax_save_handler, array(&$this, 'ajax_save'));
			$this->wrapper->add_ajax_hook($this->wrapper->ajax_preview_handler, array(&$this, 'ajax_preview'));
		} else {
			// frontend ajax hooks
		}
	}
	
	function frontend_header_function($ids) {
		//print_r($ids);exit;
		$buffer='';
		foreach ($ids as $id) {
			$this->model->load($id);
			$buffer.=$this->view->generate_frontend_css($id);
			$buffer.=$this->view->generate_frontend_javascript($id);
		}
		return $buffer;
	}
	
	function frontend_body_function($id) {
		$this->model->load($id);
		$buffer=$this->view->frontend_body_function($id);
		return $buffer;
	}
	
	function generate_backend_javascript($with_wrapper=0) {
		return $this->view->generate_backend_javascript($with_wrapper);
	}
	
	function ajax_add_subitem_from_category() {
		$this->main_object->ajax_call=1;
		if (!isset($_POST['category'])) $this->main_object->ajax_return(0, 'No category specified.');

		$item_id=intval($_POST['count']);
		$rarr=array();
		$category=intval($_POST['category']);
		$arr=$this->wrapper->get_category_posts($category);
		
		$i=0;
		$this->model->reset();
		foreach ($arr as $post) {
			$this->model->create_empty_item ($item_id);
			$this->model->set_default_values_from_post($item_id, 0, $post);
			$this->model->pre_process_form ('item', $item_id);
			$rarr['data'.$i] = $this->view->generate_html_form_part('item', $item_id);
			$item_id++;
			$i++;
		}
		
		$this->main_object->ajax_return(1, $rarr);
	}

	function ajax_add_subitem() {
		$this->main_object->ajax_call=1;
		$item_id=intval($_POST['count']);
		$this->model->reset();
		$this->model->create_empty_item ($item_id);
		if (isset($_POST['from_post'])) {
			$pid=intval($_POST['from_post']);
			$this->model->set_default_values_from_post($item_id, $pid);
		}
		$this->model->pre_process_form ('item', $item_id);
		$r = $this->view->generate_html_form_part('item', $item_id);
		$this->main_object->ajax_return(1, $r);
	}
	function ajax_get_custom_form() {
		$generated_html='';
		$custom_form=$_POST['custom_form'];
		$item_id=intval($_POST['sub_item_id']);
		$generated_html=substr($custom_form,0,12);
		if (substr($custom_form,0,12)=='custom_form_') {
			$custom_form=intval(substr($custom_form,12));
			$this->model->create_empty_item_custom_form($item_id, $custom_form);
			$this->model->pre_process_form ('custom_form', $item_id, $custom_form);
			$generated_html=$this->view->generate_html_fields( $this->model->item_loaded_custom_forms[$item_id][$custom_form] );
		}
		$this->main_object->ajax_return(1, $generated_html);
	}
	
	function get_items_scheme() {
		return $this->model->items_scheme;
	}
	function get_loaded_items() {
		return $this->model->loaded_items;
	}
	function get_settings_scheme() {
		return $this->model->settings_scheme;
	}
	function get_loaded_settings() {
		return $this->model->loaded_settings;
	}
	function get_loaded_name() {
		return $this->model->loaded_name;
	}
	function get_loaded_id() {
		return $this->model->loaded_id;
	}
	
	function ajax_return ($status, $data) {
		$this->main_object->ajax_return ($status, $data);
	}
	
	function get_index_table() {
		$arr = $this->model->list_items();
		return $this->view->list_items($arr);
	}
	
	function load($id) {
		return $this->model->load($id);
	}
	
	function delete($id) {
		$this->model->delete($id);
	}
	
	function strip_separator() {
		$post_array=explode('[odvoji]', $_POST['all_around_data']);
		foreach($post_array as $pval) {
			$pos=strpos($pval, '=');
			if ($pos!==FALSE) {
				$pkey=substr($pval, 0, $pos);
				$pval=substr($pval, $pos+1);
				$_POST[$pkey]=$pval;
			}
		}
		unset($_POST['all_around_data']);
		unset($_POST['action']);	
	}

	function ajax_save() {
		$this->main_object->ajax_call=1;
		$this->strip_separator();
		
		$r=$this->model->save($_POST);
		
		if ($r===FALSE) $this->main_object->ajax_return(0, 'Error, data not saved.');
		else {
			if ($r===TRUE) $this->main_object->ajax_return(1, 'Saved.');
			else $this->main_object->ajax_return(2, array('data'=>'Saved.', 'id'=>$r));
		}

		die();
	}
	
	function ajax_preview() {
		$this->main_object->ajax_call=1;
		$this->strip_separator();
		
		$r=$this->model->load_from_array($_POST);
		$r=$this->view->preview(0);

		if ($r===FALSE) $this->main_object->ajax_return(0, 'Preview error.');
		else {
			$this->main_object->ajax_return(1, $r);
		}

		die();
	}

	function generate_all_sub_items() {
		$arr=array();
		$count=count($this->model->loaded_items);
		for ($i=0; $i<$count; $i++) {
			$form = $this->view->generate_html_form_part('item', $i);
			$arr[]=$form;
		}
		return $arr;
	}

	function generate_html_form_part($for, $id=0) {
		return $this->view->generate_html_form_part($for, $id);
	}
	
	function pre_process_form ($for, $id=0, $custom_id=0) {
		return $this->model->pre_process_form ($for, $id, $custom_id);
	}

}


abstract class all_around_mvc_model { // data
	public $controller, $view, $wrapper, $main_object;
	public $items_scheme, $loaded_items;
	public $settings_scheme, $loaded_settings;
	public $item_custom_forms_scheme, $item_custom_forms_count, $item_loaded_custom_forms;
	public $loaded_name, $loaded_id;
	public $nullGuard=NULL;
	public $pre_processed_forms;

	function __construct(&$controller, &$wrapper, &$main_object) {
		$this->wrapper=$wrapper;
		$this->controller=$controller;
		$this->main_object=$main_object;

		$this->reset();
	}
	
	function reset() {
		$this->item_custom_forms_count=0;
		$this->load_scheme();
		$this->loaded_items=array();
		$this->loaded_settings=$this->settings_scheme;
		$this->item_loaded_custom_forms=array();
		$this->loaded_name='';
		$this->loaded_id=-1;
		$this->pre_processed_forms=array();
		$this->pre_processed_forms['items']=array();
		$this->pre_processed_forms['custom_forms']=array();
		$this->pre_processed_forms['settings']=0;
	}

	function set_view(&$view) {
		$this->view=$view;
	}

	abstract function load_scheme(); //{$r = all_around_mvc_custom::model_load_scheme($this);return $r;}

	function after_load_scheme() {
		$this->item_custom_forms_count=count($this->item_custom_forms_scheme);

		foreach($this->items_scheme as $key => $arr) {
			$this->items_scheme[$key]['name']=$key;
			$this->items_scheme[$key]['base_name']=$key;
			if (isset($arr['value'])) $this->items_scheme[$key]['default_value']=$arr['value'];
		}
		foreach($this->settings_scheme as $key => $arr) {
			$this->settings_scheme[$key]['name']=$key;
			$this->settings_scheme[$key]['base_name']=$key;
			if (isset($arr['value'])) $this->settings_scheme[$key]['default_value']=$arr['value'];
		}
		for ($i=0; $i<$this->item_custom_forms_count; $i++) {
			foreach($this->item_custom_forms_scheme[$i] as $key => $arr) {
				$this->item_custom_forms_scheme[$i][$key]['name']=$key;
				$this->item_custom_forms_scheme[$i][$key]['base_name']=$key;
				if (isset($arr['value'])) $this->item_custom_forms_scheme[$i][$key]['default_value']=$arr['value'];
			}
		}
		return TRUE;	
	}

	function extract_array($arr) {
		$rarr=array();
		if (isset($arr['element_id'])) $rarr['element_id']=$arr['element_id'];
		if (isset($arr['element_name'])) $rarr['element_name']=$name=$arr['element_name'];
		
		$rarr['items']=array();
		$rarr['settings']=array();
		$current_base='';
		$i=-1;
		foreach($arr as $var => $val) {
			if (substr($var,0,4)=='item') {
				$pos=strpos($var, '_', 5);
				$base=substr($var, 0, $pos);
				$field=substr($var, $pos);
				if ($base!=$current_base) {$i++; $current_base=$base;}
				$nvar='item_'.$i.$field;
				$rarr['items'][$nvar]=stripslashes($val);
			}
			if (substr($var,0,8)=='settings') $rarr['settings'][$var]=stripslashes($val);
		}
		return $rarr;
	}
	
	function save($arr) {
		$rarr=$this->extract_array($arr);
		$data['name']='';		
		if (isset($rarr['element_name'])) $data['name']=$rarr['element_name'];
		$data['settings']=serialize($rarr['settings']);
		$data['items']=serialize($rarr['items']);
		
		$table=$this->main_object->get_plugin_table_name();
		
		if ($rarr['element_id']=='new') {
		
			$this->wrapper->db_insert_row($table, $data, array('%s', '%s', '%s'));
			return $this->wrapper->db_get_insert_id();
		} else {
			$this->wrapper->db_update($table, $data, array('id'=>$rarr['element_id']), array('%s', '%s', '%s'), array('%d'));
			return TRUE;
		}
		return FALSE;
	}
	
	function set_default_values_from_post($id, $post_id, $arr=FALSE) {
		if ($arr===FALSE) $arr=$this->wrapper->post_get($post_id);
		if ($arr===NULL) return FALSE;
		foreach ($this->loaded_items[$id] as $aid => $row) {
			if ($row['base_name']=='content_type') $this->loaded_items[$id][$aid]['value']=4;
			if (!empty($arr['title'])) if ($row['base_name']=='title') $this->loaded_items[$id][$aid]['value']=$arr['title'];
			if (!empty($arr['thumbnail'])) if ($row['base_name']=='image') $this->loaded_items[$id][$aid]['value']=$arr['thumbnail'];
			if (!empty($arr['content'])) if ($row['base_name']=='content') $this->loaded_items[$id][$aid]['value']=$arr['content'];
			if (!empty($arr['link'])) {
				if ($row['base_name']=='custom_link') $this->loaded_items[$id][$aid]['value']=$arr['link'];
				if ($row['base_name']=='link_type') $this->loaded_items[$id][$aid]['value']=1;
			}
		}
		return TRUE;
	}
	
	function create_empty_item_custom_form($item_id, $custom_form_id) {
		if (!isset($this->item_loaded_custom_forms[$item_id][$custom_form_id])) {
			$this->item_loaded_custom_forms[$item_id][$custom_form_id]=$this->item_custom_forms_scheme[$custom_form_id];
			foreach ($this->item_loaded_custom_forms[$item_id][$custom_form_id] as $aid => $arr) {
				$this->item_loaded_custom_forms[$item_id][$custom_form_id][$aid]['name']='item_'.$item_id.'_'.$this->item_loaded_custom_forms[$item_id][$custom_form_id][$aid]['name'];
			}
		}
	}
	
	function create_empty_item ($id) {
		$next_id=$id+1;
		$this->loaded_items[$id]=$this->items_scheme;
		for ($f=0; $f<$this->item_custom_forms_count; $f++) {
			$this->create_empty_item_custom_form($id, $f);
		}
		foreach($this->loaded_items[$id] as $aid => $arr) {
			if ($this->loaded_items[$id][$aid]['name']=='title') {
				$this->loaded_items[$id][$aid]['value']='Item '.$next_id;
			}
			$this->loaded_items[$id][$aid]['name']='item_'.$id.'_'.$this->loaded_items[$id][$aid]['name'];
		}
	}
	
	function load_from_array($arr) {	// for preview
		$this->reset();
		$arr2=array();
		foreach ($arr as $var => $val) {
			if (substr($var, 0, 5)=='item_') {$arr2['items'][$var]=$val; continue;}
			if (substr($var, 0, 9)=='settings_') {$arr2['settings'][$var]=$val; continue;}
			$arr2['other'][$var]=$val;
		}
		return $this->load(0, $arr2);
	}

	function load($id, $preview=FALSE) {
		if ($id!=-1 && $this->loaded_id==$id) return;
		$this->reset();
		$loaded_items_registry=array();
		if ($preview===FALSE) {
			$table=$this->main_object->get_plugin_table_name();
			$row=$this->wrapper->db_get_row('SELECT id, name, settings, items FROM '.$table.' WHERE id='.$id);
			$loaded_items_registry=unserialize($row['items']);
			$arr=unserialize($row['settings']);
			foreach($arr as $var=>$val)	$loaded_settings_registry[$var]=$val;;
			$this->loaded_name=$row['name'];
			$this->loaded_id=$row['id'];
		} else {
			foreach ($preview as $var => $arr)
				foreach ($arr as $var2 => $val2)
					$preview[$var][$var2]=stripslashes($val2);
			$loaded_items_registry=$preview['items'];
			$arr=$preview['settings'];
			foreach($arr as $var=>$val)	$loaded_settings_registry[$var]=$val;;
			$this->loaded_name=$preview['other']['element_name'];
			$this->loaded_id=$preview['other']['element_id'];
		}

		foreach($loaded_items_registry as $field => $value) {

			$temp=explode('_', $field); $i=$temp[1];

			if (!isset($this->loaded_items[$i])) {
				$this->loaded_items[$i]=$this->items_scheme;
				foreach ($this->loaded_items[$i] as $aid => $arr) {
					$this->loaded_items[$i][$aid]['name']='item_'.$i.'_'.$this->loaded_items[$i][$aid]['name'];
				}
				for ($f=0; $f<$this->item_custom_forms_count; $f++) {
					$this->create_empty_item_custom_form($i, $f);
				}
			}
			foreach ($this->loaded_items[$i] as $aid => $arr) {
				if ($arr['name']==$field) {
					$this->loaded_items[$i][$aid]['value']=$value;
					continue;
				}
			}
			for ($f=0; $f<$this->item_custom_forms_count; $f++) {
				foreach ($this->item_loaded_custom_forms[$i][$f] as $aid => $arr) {
					if ($arr['name']==$field) {
						$this->item_loaded_custom_forms[$i][$f][$aid]['value']=$value;
						continue;
					}
				}
			}
		}
		foreach($loaded_settings_registry as $field => $value) {
			foreach ($this->loaded_settings as $aid => $arr) if ($arr['name']==$field) {
				$this->loaded_settings[$aid]['value']=$value;
			}
		}
	}
	
	function get_field_from_loaded_items ($name) {
		foreach($this->loaded_items as $id => $arr) {
			foreach($arr as $pid => $parr) {
				if ($parr['name']==$name) return $parr;
			}
		}
		return FALSE;
	}
	
	function get_field_from_custom_scheme (&$arr, $name) {
		if (isset($arr[$name])) return $arr[$name];
		foreach($arr as $id => $arr2) {
			if ($arr2['name']==$name) return $arr2;
		}
		return FALSE;
	}
	
	function delete($id) {
		$table=$this->main_object->get_plugin_table_name();
		return $this->wrapper->db_query('DELETE FROM '.$table.' WHERE id='.$id);
	}

	function list_items() {
		$table=$this->main_object->get_plugin_table_name();
		return $this->wrapper->db_get_results('SELECT id, name, settings, items FROM '.$table);	
	}

	function &find_target ($looking_for, $current_name='') {	// return pointer to form
		$what_is_target=0;// 1=item, 2=custom_form, 3=settings
		$this_item_number=-1;
		$that_item_number=-1;
		$looking_item_type=0;
		$looking_item_field='';
		if (substr($current_name, 0, 5)=='item_') {
			$arr=explode('_', $current_name);
			$prefix=$arr[0].'_'.$arr[1];
			$this_item_number=intval($arr[1]);
		}
		if (substr($looking_for,0,5)=='item_') {
			$what_is_target=1;
			if (substr($looking_for,0,7)=='item_*_') {
				$looking_item_type=1;	// this item
				$that_item_number=$this_item_number;
				$looking_item_field=substr($looking_for, 7);
				//echo "looking_item_type=".$looking_item_type."<br \>\n"; echo "that_item_number=".$that_item_number."<br \>\n";	echo "looking_item_field=".$looking_item_field."<br \>\n"; exit;
			}
			if ($looking_item_type==0 && substr($looking_for,0,5)=='item_') {
				$looking_item_type=2;	// other item
				$next_underscore=strpos($looking_for, '_', 5);
				$len=$next_underscore-5;
				$that_item_number=intval( substr($looking_for, 5, $len) );
				$looking_item_field=substr($looking_for, $next_underscore+1);
				//echo "looking_item_type=".$looking_item_type."<br \>\n"; echo "next_underscore=".$next_underscore."<br \>\n"; echo "len=".$len."<br \>\n"; echo "that_item_number=".$that_item_number."<br \>\n"; echo "looking_item_field=".$looking_item_field."<br \>\n"; exit;
			}
		}
		if (substr($looking_for,0,12)=='custom_form_') {
			$what_is_target=2;
			// not finished
		}
		if (substr($looking_for,0,9)=='settings_') {
			$what_is_target=3;
		}

		if ($what_is_target==0) return $this->nullGuard;
		if ($what_is_target==1) {
			if ($that_item_number==-1) return $this->nullGuard;
			if (isset($this->loaded_items[$this_item_number][$looking_item_field])) return $this->loaded_items[$this_item_number][$looking_item_field];
		}
		if ($what_is_target==2) return $this->nullGuard; // because it is not finished
		if ($what_is_target==3) {
			if (isset($this->loaded_settings[$looking_for])) return $this->loaded_settings[$looking_for];
		}
		return $this->nullGuard;
	}
	function determine_item_number($name) {
		$tarr=explode('_', $name);
		//$prefix=$tarr[0].'_'.$tarr[1];
		return intval($tarr[1]);
	}
	function pre_process_form ($for, $id=0, $custom_id=0) {
		//$this->pre_processed_forms['items']=array();
		//$this->pre_processed_forms['custom_forms']=array();
		//$this->pre_processed_forms['settings']=0;
		if ($for=='item' || $for=='all') {
			foreach ($this->loaded_items as $id => $item) {
				if (isset($this->pre_processed_forms['items'][$id])) continue;
				foreach ($item as $var => $field) {
					if (isset($field['if_value'])) {
						$tarr=explode('_', $field['name']);
						$base_name=$field['base_name'];
						$current_item_id=intval($tarr[1]);
						$arr=$field['if_value'];
						foreach($arr as $desired_value => $expr) {
							$expr=explode(' ', $expr);
							$action=$expr[0];
							$target=$expr[1];
							if ($action=='hide') {
								$div=0;
								if (substr($target, 0, 1)=='.') {$target=substr($target, 1); $div=1;}
								if (substr($target, 0, 7)=='item_*_') {
									if ($div) {
										$fields=$this->find_fields($current_item_id, 'group', $target);
										foreach ($fields as $fid => $field) {
											$fields[$fid]['not_visible_if']='item_*_'.$base_name.'='.$desired_value;
										}
										//print_r($this->loaded_items[0]); exit;
									}

								}
							}
						}
					}

				}
				
				$this->pre_processed_forms['items'][$id]=1;
			}
		}
		if ($for=='settings' || $for=='all') {
			if (!isset($this->pre_processed_forms['settings'])) {
				
				$this->pre_processed_forms['settings']=1;
			}
		}
	}
	function find_fields ($item_id, $searching_var, $searching_val) {
		//echo "find_fields (".$item_id.", '".$var."', '".$val."')"; exit();
		$arr=array();
		foreach ($this->loaded_items[$item_id] as $var => $field) {
			if (isset($field[$searching_var])) {
				if ($field[$searching_var]==$searching_val) $arr[] = &$this->loaded_items[$item_id][$var];
			}
		}
		return $arr;
	}
}

abstract class all_around_mvc_view { // viewer
	public $controller, $model, $wrapper, $main_object, $javascript_events, $generated_frontend_javascript, $generated_frontend_css;
	function __construct(&$controller, &$wrapper, &$main_object) {
		$this->controller=$controller;
		$this->wrapper=$wrapper;
		$this->main_object=$main_object;
		$this->javascript_events=array();
		$this->generated_frontend_javascript=array();
		$this->generated_frontend_css=array();
	}
	function set_model(&$model) {
		$this->model=$model;
	}
	
	function preview($id) {
		$buffer=$this->frontend_body_function($id);
		return $buffer;
	}
	
	abstract function generate_frontend_javascript($id);
	abstract function generate_frontend_css($id);
	//{return all_around_mvc_custom::view_generate_frontend_javascript ($this, $id);}

	abstract function generate_frontend_html($id);
	//{return all_around_mvc_custom::view_generate_frontend_html($this, $id);}

	function frontend_body_function($id) {
		$buffer='';
		$buffer.=$this->generate_frontend_css($id);
		$buffer.=$this->generate_frontend_javascript($id);
		$buffer.=$this->generate_frontend_html($id);
		return $buffer;
	}
	
	function generate_backend_javascript($with_wrapper=0) {
		if (count($this->javascript_events)==0) return '';
		$buffer='';
		if ($with_wrapper) {
			$buffer.=<<<eof
<script>
(function($){
	$(document).ready(function(){

eof;
		}
		foreach ($this->javascript_events as $id => $arr) {
			if (isset($arr['if_value'])) {
				$buffer.="all_around_add_event('".$arr['object']."', function(name, value) {\n";
				foreach ($arr['if_value'] as $value => $action_array) {
					foreach ($action_array as $action => $target_arr) {
						$target=$target_arr['target'];
						$action_string='';
						if ($action=='show' || $action=='hide') $action_string=$action."();";
						if ($action=='empty') $action_string="html('');";
						if ($action=='ajax_load_form') {
							$buffer.="	if (value==".$value.") all_around_ajax_load_form('".$target."', '".$target_arr['param1']."', '".$target_arr['param2']."');\n";
							continue;
						}
						if ($action_string!='') $buffer.="	if (value==".$value.") $('".$target."').".$action_string."\n";
					}
				}
				$buffer.="});\n";
			}
		}
		if ($with_wrapper) {
			$buffer.=<<<eof
	});
})(jQuery);
</script>
eof;
		}
		return $buffer;
	}

	function list_items($resource) {
		$url=$this->main_object->admin_url;
		$new_url=$url.'&action=new';
		if ($resource==NULL) {
			$arr=array(array('<b>There is no created items. <a href="'.$new_url.'">Create one now</a>.</b>'));
			$td_style[0][0]='colspan="4" style="text-align: center;"';
		} else {
			$td_style=NULL;
			foreach ($resource as $row) {
				$edit_url=$url.'&action=edit&id='.$row['id'];
				$delete_url=$url.'&action=delete&id='.$row['id'];
				$arr[]=array ($row['id'], $row['name'], '[all_around id="'.$row['id'].'"]', '<a href="'.$edit_url.'">Edit</a> | <a href="'.$delete_url.'" class="all_around_delete">Delete</a>');
			}
		}

		$header=array(
			'ID',
			'Name',
			'Shortcode',
			'Actions'
		);
		return all_around_visual_elements::generate_table ($arr, $header, array('auto_width'=>FALSE), $td_style);
	}

	function generate_html_fields (&$form) {
		$html='';
		foreach ($form as $id => $field) {
			$wrapper=array();
			$style=NULL;
			$style['auto_width']=FALSE;
			$generated_html='';
			if (isset($field['wrapper'])) $wrapper=$field['wrapper'];
			if (isset($field['if_other_fields'])) {
				foreach($field['if_other_fields'] as $arr) {
					//$tarr=explode('_', $field['name']);
					//$prefix=$tarr[0].'_'.$tarr[1];
					//$item_number=$tarr[1];
					$item_number=$this->model->determine_item_number($field['name']);
					foreach ($arr as $condition => $action) {
						$condition=explode('=', $condition);
						$target=$condition[0];
						$target_value=$condition[1];
						$action=explode(' ', $action);
						
						//if (substr($target,0,7)=='item_*_') $target=$prefix.'_'.substr($target,7);
						$target_arr=&$this->model->find_target ($target, $field['name']); //$this->model->get_field_from_custom_scheme($form, $target);
						if ($target_arr['value']==$target_value)
						{
							if ($action[0]=='show_form') {
								if (substr($action[1], 0, 12)=='custom_form_') {
									$custom_form=intval(substr($action[1], 12));
									$generated_html=$this->generate_html_fields( $this->model->item_loaded_custom_forms[$item_number][$custom_form] );
								}
							}
						}
					}
				}
			}
			if (isset($field['not_visible_if'])) {
				$looking_for=explode('=', $field['not_visible_if']);
				$looked_val=$looking_for[1];
				$looking_for=$looking_for[0];
				$looked_arr=&$this->model->find_target ($looking_for, $field['name']);
				if ($looked_arr != NULL) {
					if ($looked_arr['value']==$looked_val) $wrapper['display']='none';
				}
			}
			if (isset($field['if_value'])) {
				$arr=$field['if_value'];
				$events=array();
				foreach($arr as $value => $expr) {
					$expr=explode(' ', $expr);
					$action=$expr[0];
					$target=$expr[1];
					$param1='';
					$param2='';
					$tarr=explode('_', $field['name']);
					$prefix=$tarr[0].'_'.$tarr[1];
					if (isset($expr[2])) $param1=$expr[2];
					if ($action=='ajax_load_form' && $tarr[0]=='item') $param2=$tarr[1];
					if ($tarr[0]=='item' && substr($target,0,7)=='item_*_') $target=$prefix.'_'.substr($target,7);
					if ($tarr[0]=='item' && substr($target,0,8)=='.item_*_') $target='.'.$prefix.'_'.substr($target,8);
					if ($tarr[0]=='item' && substr($target,0,8)=='#item_*_') $target='#'.$prefix.'_'.substr($target,8);
					$target_arr=array('target'=>$target, 'param1'=>$param1, 'param2'=>$param2);
					$events[$value]=array($action=>$target_arr);
				}
				$this->javascript_events[]=array(
					'object' => $field['name'],
					'if_value' => $events
				);
			}

			if (isset($field['style'])) $style=$field['style'];
			if (isset($field['label'])) $wrapper['span']=$field['label'];
			if (isset($field['group'])) {
				$wrapper['group']=$field['group'];
				$tarr=explode('_', $field['name']);
				$prefix=$tarr[0].'_'.$tarr[1];
				if ($tarr[0]=='item' && substr($field['group'],0,7)=='item_*_') $wrapper['group']=$prefix.'_'.substr($wrapper['group'],7);
			}
			if (isset($field['html_before'])) $html.=$field['html_before'];
			/*if ($field['type']=='font') {
				if (isset($style['width'])) {
					$wrapper['width']=$style['width'];
					unset($style['width']);
				}
			}*/
			if ($field['type']=='image_upload') {
				$default=$this->main_object->url.'images/no_image.jpg';
				if (isset($field['empty_image'])) $default=$field['empty_image'];
				$html.=all_around_visual_elements::generate_image($field['name'], $field['value'], $wrapper, $style, $default);
			}
			if ($field['type']=='listbox') $html.=all_around_visual_elements::generate_listbox($field['name'], $field['value'], $field['list'], $wrapper, $style);
			if ($field['type']=='text') $html.=all_around_visual_elements::generate_textarea($field['name'], $field['value'], $wrapper, $style);
			if ($field['type']=='input') $html.=all_around_visual_elements::generate_input($field['name'], $field['value'], $wrapper, $style);
			if ($field['type']=='font'){
				$wrapper2=$wrapper;
				$wrapper2['margin-bottom']='50px';
				$html.=all_around_visual_elements::generate_button($field['name'].'_button', $this->convert_font_data_to_label($field['value']), 'black_clear', $wrapper2, $style, FALSE, '', 'all_around_font_button', $field['name']).all_around_visual_elements::generate_hidden ($field['name'], $field['value']);
			}
			if ($field['type']=='color') $html.=all_around_visual_elements::generate_color($field['name'], $field['value'], $wrapper, $style);
			if ($field['type']=='checkbox') {
				if (isset($field['without_wrapper_label']) && $field['without_wrapper_label']==1 && isset($wrapper['span'])) {
					unset($wrapper['span']);
					$wrapper['empty_wrapper']=1;
				}
				$html.=all_around_visual_elements::generate_checkbox($field['label'], $field['name'], $field['value'], $wrapper, $style);
			}
			if ($field['type']=='number') $html.=all_around_visual_elements::generate_number($field['name'], $field['value'], $field['min'], $field['max'], $field['unit'],  $wrapper, $style);
			if ($field['type']=='attached_form') $html.=all_around_visual_elements::generate_div($field['name'], $generated_html, $style);
			if (isset($field['html_after'])) $html.=$field['html_after'];
		}
		return $html;
	}
	
	abstract function pre_generate_html_form_part($for, $id=0);

	function generate_html_form_part($for, $id=0) {
		$html='';
		$form=array();
		$current_item_title='';
		
		$this->pre_generate_html_form_part($for, $id);

		if ($for=='item' || $for=='empty_item') {
			$form=$this->model->loaded_items[$id];
			foreach($form as $aid => $arr) {
				if ($arr['base_name']=='title') $current_item_title=$arr['value'];
			}
		}
		if ($for=='settings') {
			$form=$this->model->loaded_settings;
		}
		
		// main task
		$html=$this->generate_html_fields($form);
		
		// finalizing
		if ($for=='item') {
			$current_item_title.='&nbsp;&nbsp;&nbsp;<a class="all_around_delete_subitem">[Delete]</a>';
			$open=FALSE;
			if ($this->main_object->ajax_call==1) {
				$open=TRUE;
				$html.=$this->generate_backend_javascript(1);
				$this->javascript_events=array();
			}
			$html=all_around_visual_elements::generate_collapsible ($current_item_title, $html, NULL, $open, 'padding-left: 0px; padding-right: 15px;');
		}
		if ($for=='settings') {
			$style_collapsible=array(
				'width' => '280px'
			);
			$html = all_around_visual_elements::generate_collapsible('Settings', $html, $style_collapsible, TRUE);
		}
		return $html;
	}
	
	function convert_font_data_to_label ($data) {
		$font=json_decode($data);
		if (!isset($font->font)) $font->font='Default';
		if ($font->font=='default') $font->font='Default';
		if (strpos($font->font, ",")!==FALSE) $font->font=substr($font->font, 0, strpos($font->font, ","));
		$s = $font->font.' font';
		if (isset($font->size) && isset($font->size_unit)) 
			if ($font->size!='default') $s.=", ".$font->size.$font->size_unit;
		$s.='...';
		return $s;
	}
}

?>