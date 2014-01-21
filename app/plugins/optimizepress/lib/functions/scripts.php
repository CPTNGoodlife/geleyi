<?php
add_filter('widget_text', 'do_shortcode');
function op_check_exit_redirect(){
	$chk = op_get('op_exit_redirect');
	if($chk && $chk == 'true'){
		$url = op_current_url();
		$url = str_replace('op_exit_redirect=true','',$url);
		$url = rtrim($url,'?');
		echo '
			<script type="text/javascript">
			top.location.href = \''.$url.'\';
			</script>
		';
	}
}
add_action('wp_head','op_check_exit_redirect');
function op_footer(){
	do_action('op_footer');
	
	//Init the scripts array
	$js_scripts = array(
		'tooltipster.min.js',
		//'menus.js',
		'selectnav.min.js',
		'dropkick.js',
		'jquery/jquery-ui-1.10.3.custom.min.js',
		'jquery/jquery.sharrre-1.3.4.min.js',
		'jquery/jquery.reveal.js',
		'jquery/countdown.js',
		'global.js'
	);
	
	//Init the frontend array, which will then be converted to JSON
	if (!is_admin()) {
		op_localize_script('front');
		wp_enqueue_script('op-menus', OP_JS.'menus.js', array());
	} 
	
	//Print out script include
	foreach($js_scripts as $script){
		echo '<script type="text/javascript" src="'.OP_JS.$script.'"></script>';
	}
	
	//Print out footer scripts
	op_print_footer_scripts('front');
	wp_footer();
	
	//Return (which will not allow user in), if the user does not have permissions
	if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) return;
	if (!get_user_option('rich_editing')) return;
	
	//If we are previewing, run the following script
	$preview = (!empty($_GET['preview']) ? $_GET['preview'] : false);
	echo ($preview ? '
		<script type="text/javascript">
			jQuery(\'#TB_window\', window.parent.document).css({marginLeft: \'-\' + parseInt((1050 / 2),10) + \'px\',width:\'1050px\',height:\'600px\'});
			jQuery(\'#TB_iframeContent\', window.parent.document).css({width:\'1050px\',height:\'600px\'});
		</script>
	' : '');

	//Insert tracking scripts
	$tracking = op_default_option('analytics_and_tracking');
	echo (!empty($tracking['google_analytics_tracking_code']) ? stripslashes($tracking['google_analytics_tracking_code']) : '');
	echo (!empty($tracking['sitewide_tracking_code']) ? stripslashes($tracking['sitewide_tracking_code']) : '');
}
function op_default_localize(){
	//Defaults for localized PHP to JS variables
	return $default = array(
		'flowplayer' => OP_MOD_URL.'blog/video/flowplayer/flowplayer-3.2.7.swf',
		'flowplayer_control' => OP_MOD_URL.'blog/video/flowplayer/flowplayer.controls-3.2.5.swf',
		'SN' => OP_SN,
		'paths' => array(
			'url' => OP_URL,
			'img' => OP_IMG,
			'js' => OP_JS,
			'css' => OP_CSS
		),
		'social' => array(
			'twitter' => OP_SOCIAL_ACCT_TWITTER,
			'facebook' => OP_SOCIAL_ACCT_FACEBOOK,
			'googleplus' => OP_SOCIAL_ACCT_GOOGLEPLUS
		)
	);
}
function op_localize_script($types=''){
	//Get the localized variables
	$localize = apply_filters(OP_SN.'-script-localize',op_default_localize());
	
	//Get localized variables if a type is set
	if(!empty($types)){
		//Init types
		$types = (is_array($types) ? $types : $types = array($types));
		
		//Loop through types and get variables
		foreach($types as $type){
			$localize = apply_filters(OP_SN.'-script-localize-'.$type,$localize);
		}
	}
	
	//Finally, assuming we have data to localize, we print out the data in a JSON object
	echo ((count($localize) > 0) ? '<script type="text/javascript">OP = (typeof(OP)=="undefined" ? '.json_encode($localize).' : OP);</script>' : '');
}

function op_print_scripts($types=''){
	_op_print_scripts($types,'-print-scripts');
}

function op_print_footer_scripts($types=''){
	_op_print_scripts($types,'-print-footer-scripts');
}

function _op_print_scripts($types='',$action){
	do_action(OP_SN.$action);
	if(!empty($types)){
		if(!is_array($types)){
			$types = array($types);
		}
		if(is_admin()){
			$types[] = 'admin';
		}
		foreach($types as $type){
			do_action(OP_SN.$action.'-'.$type);
		}
	}
}


function op_modernizr_selectivizr(){
	echo '
		<script type="text/javascript" src="'.OP_JS.'modernizr-2.5.3.min.js?2.5.3"></script>
	';
}
add_action('wp_head', 'op_modernizr_selectivizr',2);
//add_action(OP_SN.'-print-scripts','op_modernizr_selectivizr');

function op_html5shiv(){
	echo '
		<!--[if (gte IE 6)&(lte IE 8)]>
		<script type="text/javascript" src="'.OP_JS.'selectivizr-1.0.2-min.js?ver=1.0.2"></script>
		<![endif]-->
		<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	';
}
add_action('wp_head', 'op_html5shiv');
//add_action(OP_SN.'-print-scripts','op_html5shiv');

function op_load_favicon(){
	$url = op_get_option('favicon');
	$favicon_setup = op_default_option('favicon_setup');
	if (!empty($favicon_setup)) $url = $favicon_setup;

	if(!empty($url)){
		echo "\n".'<link rel="shortcut icon" href="'.$url.'" type="image/x-icon" />';
	}
	wp_enqueue_style( OP_SN.'-fancybox', OP_JS.'fancybox/jquery.fancybox.css');
}
add_action('wp_head', 'op_load_favicon');

function op_css_font_str($field,$val){
	$font = '';
	if(empty($val)){
		return '';
	}
	if($field == 'font'){
		if($font_str = op_font_str($val)){
			$font .= 'font-family:'.$font_str.';';
		}
	} elseif($field == 'style'){
		switch($val){
			case 'bold italic':
				$font .= 'font-style:italic;';
			case 'bold':
				$font .= 'font-weight:bold;';
				break;
			case 'italic':
				$font .= 'font-style:italic;';
				break;
			case 'normal':
				$font .= 'font-style:normal;font-weight:normal;';
				break;
			case '300':
				$font .= 'font-style:normal;font-weight:300;';
				break;
		}
	} elseif($field == 'spacing'){
		$font .= 'letter-spacing:'.(int)$val.'px;';
	} elseif($field == 'color'){
		$font .= 'color:'.$val.';';
	} elseif($field == 'shadow'){
		switch($val){
			case 'light':
				$font .= 'text-shadow:1px 1px 0px #fff;text-shadow:1px 1px 0px rgba(255,255,255,0.5);';
				break;
			case 'dark':
				$font .= 'text-shadow:1px 1px 0px #000;text-shadow:1px 1px 0px rgba(0,0,0,0.5);';
				break;
		}
	} else {
		$font .= 'font-'.$field.':'.$val.($field=='size'?'px':'').';';
	}
	return $font;
}

function op_typography_output($css,$config=array()){
	$func = 'op_default_option';
	if(defined('OP_PAGEBUILDER')){
		$func = 'op_default_page_option';
	}
	if(count($config) > 0){
		$typography = $config;
	} elseif(!$typography = $func('typography')){
		return $css;
	}
	$elements = op_typography_output_elements();
	$first = true;
	if(isset($elements['font_elements']) && isset($typography['font_elements'])){
		foreach($elements['font_elements'] as $selector => $option){
			if(isset($typography['font_elements'][$option])){
				$el = $typography['font_elements'][$option];
				$font = '';
				if ($first === false && 'default' == $option) {
					$checks = array('font');
				} else {
					$checks = array('style','size','font','color');
				}
				foreach($checks as $check){
					if(!empty($el[$check])){
						$font .= op_css_font_str($check,$el[$check]);
					}
				}
				if ('default' == $option) {
					$first = false;
				}
				$font = rtrim($font,';');
				if(!empty($font)){
					$css .= $selector.'{'.$font.'}';
				}
			}
		}
	}
	if(isset($elements['color_elements']) && isset($typography['color_elements'])){
		foreach($elements['color_elements'] as $selector => $option){
			if(isset($typography['color_elements'][$option])){
				$el = $typography['color_elements'][$option];
				if(is_array($el)){
					$str = '';
					foreach($el as $prop => $value){
						if($prop == 'text_decoration'){
							$prop = 'text-decoration';
							if($value == ''){
								$value = 'none';
							}
							$str .= $prop.':'.$value.';';
						} elseif($value != ''){
							$str .= $prop.':'.$value.';';
						}
					}
					if($str != ''){
						$css .= $selector.'{'.$str.'}';
					}
				} else {
					if(!empty($el)){
						$css .= $selector.'{color:'.$el.'}';
					}
				}
			}
		}
	}
	return $css;
}
add_filter('op_output_css','op_typography_output',10,2);


function op_typography_elements(){
	static $typography_elements;
	if(!isset($typography_elements)){
		$typography_elements = array(
			'font_elements' => array(
				'site_title' => array(
					'name' => 'Site Title',
					'help' => 'Set the styling for your site title (if activated in the blog header options)',
				),
				'tagline' => array(
					'name' => 'Site Tagline',
					'help' => 'Set the styling for your site tagline (shows below site title)',
				),
				'default' => array(
					'name' => 'Theme Text/Paragraph Styles',
					'help' => 'Set the styling for the blog paragraph styling and general text styles',
				),
				'h1' => array(
					'name' => 'H1 Heading Styles',
					'help' => 'Set the font, styling, size and colour for the H1 Headings',
				),
				'h2' => array(
					'name' => 'H2 Heading Styles',
					'help' => 'Set the font, styling, size and colour for the H2 Headings',
				),
				'h3' => array(
					'name' => 'H3 Heading Styles',
					'help' => 'Set the font, styling, size and colour for the H3 Headings',
				),
				'h4' => array(
					'name' => 'H4 Heading Styles',
					'help' => 'Set the font, styling, size and colour for the H4 Headings',
				),
				'h5' => array(
					'name' => 'H5 Heading Styles',
					'help' => 'Set the font, styling, size and colour for the H5 Headings',
				),
				'h6' => array(
					'name' => 'H6 Heading Styles',
					'help' => 'Set the font, styling, size and colour for the H6 Headings',
				),
			),
			'color_elements' => array(
				/*'link_color' => array(
					'name' => 'Link Colour',
					'help' => 'Set the link colour for your blog',
					'text_decoration' => true,
				),
				'link_hover_color' => array(
					'name' => 'Link Hover Colour',
					'help' => 'Set the link hover colour for your blog',
					'text_decoration' => true,
				),*/
				//'header_link_color' => 'Top Header Link Colour',
				'footer_text_color' => array(
					'name' => 'Footer Text Colour',
					'help' => 'Set the colour of the text/copyright message in the footer',
				)
			)
		);
		$typography_elements = apply_filters('op_typography_elements',$typography_elements);
	}
	return $typography_elements;
}

function op_typography_output_elements(){
	static $typography_elements;
	if(!isset($typography_elements)){
		$typography_elements = array(
			'font_elements' => array(
				'p, .single-post-content li,#content_area li' => 'default',
				'a, blockquote' => 'default',
				'h1,.main-content h1,.single-post-content h1,.full-width.featured-panel h1,.latest-post h1.the-title' => 'h1',
				'h2,.main-content h2,.single-post-content h2,.page-header h2,.featured-panel h2,.featured-posts .post-content h2,.featured-posts .post-content h2 a,.latest-post h2 a' => 'h2',
				'h3,.main-content h3,.single-post-content h3' => 'h3',
				'h4,.main-content h4,.single-post-content h4,.older-post h4 a' => 'h4',
				'h5,.main-content h5,.single-post-content h5' => 'h5',
				'h6,.main-content h6,.single-post-content h6' => 'h6',
				'h1.site-title,h1.site-title a' => 'site_title',
				'h2.site-description' => 'tagline',
			),
			'color_elements' => array(
				'.latest-post .continue-reading a, .post-content .continue-reading a, .older-post .continue-reading a,.main-content-area .single-post-content a,.featured-panel a,.sub-footer a, .main-sidebar a' => 'link_color',
				'.latest-post .continue-reading a:hover, .post-content .continue-reading a:hover, .older-post .continue-reading a:hover,.main-content-area .single-post-content a:hover,.featured-panel a:hover,.sub-footer a:hover, .main-sidebar a:hover' => 'link_hover_color',
				//'.header-nav li a' => 'header_link_color',
				'.footer,.footer p,.footer a' => 'footer_text_color',
			)
		);
		$typography_elements = apply_filters('op_typography_output_elements',$typography_elements);
	}
	return $typography_elements;
}

function op_output_css(){
	$css = apply_filters('op_output_css','');
	$css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
	$css = str_replace(array("\r\n", "\r", "\n", "\t"), '', $css);
	$css = str_replace(array(' {',':',';}'), array('{',':','}'), $css);
	if(!empty($css)){
		echo '
<style type="text/css" id="op_header_css">
'.$css.'
</style>';
	}

	//Echo out custom CSS if entered
	$custom_css = op_default_option('custom_css');
	if (!empty($custom_css)) echo '<style id="op_custom_css">'.stripslashes($custom_css).'</style>';

}
add_action('wp_head','op_output_css',10);

function op_add_theme_css($css){
	if(defined('OP_AJAX')){
		return $css;
	}
	$url = '';
	if(defined('OP_PAGE_URL')){
		$url = OP_PAGE_URL.'style.css';
	} elseif(defined('OP_THEME_URL')){
		$url = OP_THEME_URL.'style.css';
	}
	echo '
		<link href="'.OP_CSS.'wp.css" type="text/css" rel="stylesheet" />
		<link href="'.$url.'" type="text/css" rel="stylesheet" />
	';
	return $css;
}
add_filter('op_output_css','op_add_theme_css');


function op_opengraph_meta(){
	/*$metas = array(
		//'og:url' => get_bloginfo('wpurl'),
		'og:type' => 'article',
	);
	$site_title = '';
	if(!$site_title = op_get_option('seo','title')){
		$site_title = get_bloginfo('name');
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$site_title .= ' &mdash; '.$site_description;
	}
	$metas['og:site_name'] = $site_title;
	if(is_single()){
		global $post;
		while(have_posts()){
			the_post();

			$metas['og:url'] = get_permalink($post->ID);

			$seo = get_post_meta($post->ID,'op_seo',true);
			$seo = is_array($seo) ? $seo : array();
			$title = op_get_var($seo,'title');
			$description = op_get_var($seo,'description');


			$metas['og:title'] = empty($title) ? $post->post_title : $title;
			$metas['og:description'] = empty($description) ? wp_trim_excerpt($post->post_excerpt) : $description;
			if(has_post_thumbnail($post->ID)){
				$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'list-image');
				$metas['og:image'] = $thumbnail[0];
			}
		}
		rewind_posts();
	}*/
	$metas = array();
	$appId = op_get_option('comments','facebook','id');
	if(!empty($appId)){
		$metas['fb:app_id'] = op_get_option('comments','facebook','id');
		if($notify = op_get_option('comments','facebook','notify') && !empty($notify)){
			$metas['fb:admins'] = $notify;
		}
	}
	//$metas = apply_filters('op_meta_tags',$metas);
	foreach($metas as $property => $content){
		echo '
			<meta property="'.$property.'" content="'.esc_attr($content).'" />
		';
	}
}
add_action('wp_head','op_opengraph_meta');

function op_admin_body_class($class=''){
	global $wp_version;
	if(version_compare($wp_version,'3.3','<')){
		$class .= ' op-less-than-3-3';
	}
	return $class;
}
add_filter('admin_body_class','op_admin_body_class');

function op_register_scripts(){
	wp_register_script(OP_SN.'-backstretch',OP_JS.'jquery/jquery.backstretch.js',array('jquery'),'2012-05-03');
	wp_enqueue_script(OP_SN.'-placeholder',OP_JS.'jquery/jquery.placeholder.min.js',array('jquery'),'2012-05-03',true);
	wp_enqueue_script(OP_SN.'-fancybox', OP_JS.'fancybox/jquery.fancybox.pack.js',array('jquery'), '2013-05-31', true);
	wp_register_script( OP_SN.'-fancybox-op', OP_JS.'fancybox/helpers/jquery.fancybox-op.js',array(OP_SN.'-fancybox'));
}
add_action('init','op_register_scripts');

function op_font_style_str($vars,$prefix='font_'){
	$font = '';
	$font_vars = array('size','font','style','color','spacing','shadow');
	foreach($font_vars as $f){
		$var = op_get_var($vars,$prefix.$f);
		$font .= op_css_font_str($f,$var);
	}
	return $font;
}
function op_fix_embed_url_shortcodes($content){
	return preg_replace(array('|\](https?://[^\s"]+)|im','|(https?://[^\s"]+)\[|im'),array("]\n$1","$1\n["), $content);
}
function op_process_asset_content($content){
	if(isset($GLOBALS['OP_LIVEEDITOR_FONT_STR']) && count($GLOBALS['OP_LIVEEDITOR_FONT_STR']) == 2){
		extract($GLOBALS['OP_LIVEEDITOR_FONT_STR']);
		foreach($elements as $el){
			$content = preg_replace_callback('{<'.$el.'\s(?=[^>]*style=(["\']*)(.*?)\1)[^>]*>}i','op_process_asset_change_quotes',$content);
			$content = preg_replace(array('{<'.$el.'\s(?![^>]*style=)((?!href=\"#add_element\"))[^>]*}i','{<'.$el.'\s*>}i'),array('$0 style=\''.$style_str.'\'','<'.$el.' style=\''.$style_str.'\'>'),$content);
		}
	}
	return $content;
}
function op_process_asset_change_quotes($matches){
	$style = trim($matches[2]);
	if(substr($style,-1) != ';'){
		$style .= ';';
	}
	$style = $GLOBALS['OP_LIVEEDITOR_FONT_STR']['style_str'].$style;
	return str_replace('style='.$matches[1].$matches[2].$matches[1],"style='".str_replace("'",'"',$style)."'",$matches[0]);
}