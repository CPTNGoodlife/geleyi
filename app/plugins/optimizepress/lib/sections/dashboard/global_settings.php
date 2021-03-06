<?php
class OptimizePress_Sections_Global_Settings {
	function sections(){
		static $sections;
		if(!isset($sections)){
			$sections = array(
				'header_logo_setup' => array(
					'title' => __('Header & Logo Setup', OP_SN),
					'action' => array($this,'header_logo_setup'), 
					'save_action' => array($this,'save_header_logo_setup')
				),
				'favicon_setup' => array(
					'title' => __('Favicon Setup', OP_SN),
					'action' => array($this,'favicon_setup'), 
					'save_action' => array($this,'save_favicon_setup')
				),
				'site_footer' => array(
					'title' => __('Site Footer', OP_SN),
					'action' => array($this,'site_footer'), 
					'save_action' => array($this,'save_site_footer')
				),
				'seo' => array(
					'title' => __('SEO Options', OP_T_SN),
					'module' => 'seo',
					//'options' => op_theme_config('mod_options','seo'),
					'on_off' => true,
				),
				'promotion' => array(
					'title' => __('Promotion Settings', OP_T_SN),
					'module' => 'promotion',
					'options' => op_theme_config('mod_options','promotion')
				),
				'custom_css' => array(
					'title' => __('Custom CSS (Sitewide)', OP_SN),
					'action' => array($this,'custom_css'), 
					'save_action' => array($this,'save_custom_css')
				),
				'typography' => array(
					'title' => __('Typography', OP_SN),
					'action' => array($this,'typography'),
					'save_action' => array($this,'save_typography')
				),				
				'api_key' => array(
					'title' => __('API Key', OP_SN),
					'action' => array($this,'api_key'),
					'save_action' => array($this,'save_api_key')
				),
				'advanced_filter' => array(
					'title' => __('Advanced WP Filter Settings', OP_SN),
					'action' => array($this,'advanced_filter'),
					'save_action' => array($this,'save_advanced_filter')
				),
			);
			$sections = apply_filters('op_edit_sections_global_settings',$sections);
		}
		return $sections;
	}

	/* API key Section */
	function api_key(){
		echo op_load_section('api_key');
	}
	
	function save_api_key($op){
		$key = op_get_var($op, OptimizePress_Sl_Api::OPTION_API_KEY_PARAM);
		$status = op_sl_register($key);
		if (is_wp_error($status)) {
			op_tpl_error('op_sections_' . OptimizePress_Sl_Api::OPTION_API_KEY_PARAM, __('API key is invalid. Please re-check it.', OP_SN));
		} else {
			op_sl_save_key($key);	
		}		
	}

	/* Advanced filter settings */
	function advanced_filter()
	{
		echo op_load_section('advanced_filter');
	}

	function save_advanced_filter($op)
	{
		if ($advancedFilter = op_get_var($op, 'advanced_filter')) {
			op_update_option('advanced_filter', $advancedFilter);
		}
	}
	
	/* Header & Logo Setup Section */
	function header_logo_setup(){
		echo op_load_section('header_logo_setup', array(), 'global_settings');
	}
	
	function save_header_logo_setup($op){
		if ($header_logo_setup = op_get_var($op, 'header_logo_setup')){
			op_update_option('header_logo_setup', $header_logo_setup);
		}
	}
	
	/* Favicon Section */
	function favicon_setup(){
		echo op_load_section('favicon_setup', array(), 'global_settings');
	}
	
	function save_favicon_setup($op){
		op_update_option('favicon_setup', op_get_var($op,'favicon_setup'));
	}
	
	/* Site Footer Section */
	function site_footer(){
		echo op_load_section('site_footer', array(), 'global_settings');
	}
	
	function save_site_footer($op){
		if ($site_footer = op_get_var($op, 'site_footer')){
			op_update_option('site_footer', $site_footer);
		}
	}
	
	/* Custom CSS Section */
	function custom_css(){
		echo op_load_section('custom_css', array(), 'global_settings');
	}
	
	function save_custom_css($op){
		if ($custom_css = op_get_var($op, 'custom_css')){
			op_update_option('custom_css', $custom_css);
		}
	}
	
	/* Typography */
	function typography(){
		echo op_load_section('typography', array(), 'global_settings');
	}
	
	function save_typography($op){
		if(isset($op['default_typography'])){
			$op = $op['default_typography'];
			$typography = op_get_option('default_typography');
			$typography = is_array($typography) ? $typography : array();
			$typography_elements = op_typography_elements();
			$typography_elements['color_elements'] = array(
				//'link_color' => '',
				//'link_hover_color' => '',
				'footer_text_color' => '',
				'footer_link_color' => '',
				'footer_link_hover_color' => '',
				'feature_text_color' => '',
				'feature_link_color' => '',
				'feature_link_hover_color' => ''
			);
			$typography['font_elements'] = op_get_var($typography,'font_elements',array());
			$typography['color_elements'] = op_get_var($typography,'color_elements',array());
			if(isset($typography_elements['font_elements'])){
				foreach($typography_elements['font_elements'] as $name => $options){
					$tmp = op_get_var($op,$name,op_get_var($typography['font_elements'],$name,array()));
					$typography['font_elements'][$name] = array(
						'size' => op_get_var($tmp,'size'),
						'font' => op_get_var($tmp,'font'),
						'style' => op_get_var($tmp,'style'),
						'color' => op_get_var($tmp,'color'),
					);
				}
			}
			if(isset($typography_elements['color_elements'])){
				foreach($typography_elements['color_elements'] as $name => $options){
					$typography['color_elements'][$name] = $op[$name];
				}
			}
			op_update_option('default_typography',$typography);
			
			//Check for blanks so we can set the defaults.
			//Otherwise a refresh would be necessary to see the defaults.
			// op_set_font_defaults();
		}
	}
}