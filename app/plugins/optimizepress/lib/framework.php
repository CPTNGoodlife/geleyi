<?php

if(!function_exists('op_define_vars')){
	function op_define_vars(){
		//Init constants
		define('OP_VERSION', '2.0.0');
		
		define('OP_TYPE','plugin');
		define('OP_SN','optimizepress'); //Short/safe name
		define('OP_DIR',OP_PLUGIN_DIR);
		define('OP_URL',OP_PLUGIN_URL);
		
		//Lib directory constants
		define('OP_LIB',OP_DIR.'lib/');
		define('OP_LIB_URL',OP_URL.'lib/');
		define('OP_ADMIN',OP_LIB.'admin/');
		define('OP_MOD',OP_LIB.'modules/');
		define('OP_MOD_URL',OP_URL.'lib/modules/');
		define('OP_ASSETS',OP_DIR.'lib/assets/');
		define('OP_ASSETS_URL',OP_URL.'lib/assets/');
		define('OP_DEFAULTS',OP_LIB.'defaults/');
		define('OP_FUNC',OP_LIB.'functions/');
		define('OP_TPL',OP_LIB.'tpl/');
		define('OP_THEMES',OP_DIR.'themes/');
		
		//Pages directory constants
		define('OP_PAGES',OP_DIR.'pages/');
		define('OP_PAGES_URL',OP_URL.'pages/');
		
		//Script constants
		define('OP_JS',OP_URL.'lib/js/');
		define('OP_JS_PATH',OP_LIB.'js/');
		define('OP_CSS',OP_LIB_URL.'css/');
		
		//Image constants
		define('OP_IMG',OP_LIB_URL.'images/');
		define('OP_IMG_DIR',OP_LIB.'images/');
		define('OP_THUMB',OP_IMG_DIR.'thumbs/');
		define('OP_THUMB_URL',OP_IMG.'thumbs/');
		
		//Notification constants
		define('OP_NOTIFY_SUCCESS', 0);
		define('OP_NOTIFY_WARNING', 1);
		define('OP_NOTIFY_ERROR', 2);
		
		
		//Date constants
		define('OP_DATE_MYSQL', 'Y-m-d');
		define('OP_DATE_POSTS', 'F j, Y');
		define('OP_DATE_TIME_PICKER_GMT', 'Y/m/d G:i:s O');
		
		//Font constants
		define('OP_FONT_FAMILY', 'Source Sans Pro, sans-serif');
		define('OP_FONT_SIZE', 15);
		define('OP_FONT_STYLE', 'normal');
		define('OP_FONT_SPACING', '');
		define('OP_FONT_SHADOW', 'none');
		define('OP_FONT_COLOR', '#444');

		//Font strings
		define('OP_STRING_FONT_FAMILY', 'Font');
		define('OP_STRING_FONT_SIZE', 'Size');
		define('OP_STRING_FONT_STYLE', 'Style');
		define('OP_STRING_FONT_SPACING', 'Spacing');
		define('OP_STRING_FONT_SHADOW', 'Shadow');
		define('OP_STRING_FONT_COLOR', 'Color');
		define('OP_STRING_FONT_DECORATION', 'Decoration');
		define('OP_STRING_FONT_THEME_DEFAULT', 'Theme Default');
		
		//Logo and Image Constants
		define('OP_HEADER_LOGO_WIDTH', 250);
		define('OP_HEADER_LOGO_HEIGHT', 50);

		//AWeber Oauth authorizing URL
		define('OP_AWEBER_AUTH_URL', 'aweber-authorize');

		//iContact App ID
		define('OP_ICONTACT_APP_ID', 'bxqNtsRX17VsWHc437VGAjmwS9keS2er');
		
		//1ShoppingCart
		define('OP_ONESHOPPINGCART_CONNECT_URL', '1-shopping-cart-connect');

		//GoToWebinar
		define('OP_GOTOWEBINAR_AUTH_URL', 'gotowebinar-authorize');
		define('OP_GOTOWEBINAR_EXPIRE_NOTICE', 1209600);
		
		//OP Social Networking Account Names
		define('OP_SOCIAL_ACCT_TWITTER', 'optimizepress');
		define('OP_SOCIAL_ACCT_FACEBOOK', 'optimizepress');
		define('OP_SOCIAL_ACCT_GOOGLEPLUS', '111273444733787349971');

		//SL cache lifetime (in seconds)
		define('OP_SL_ELEMENT_CACHE_LIFETIME', 86400);
		
		//CSS Classes
		define('OP_CSS_CLASS_CLOSE_MODAL', 'close-optin-modal');
		
		$GLOBALS['OP_LIVEEDITOR_FONT_STR'] = array();
		$GLOBALS['OP_LIVEEDITOR_DEPTH'] = 0;
		$GLOBALS['OP_PARSED_SHORTCODE'] = '';
		$GLOBALS['OP_LIVEEDITOR_DISABLE_NEW'] = true;
		
		// SEO ENABLED
		$seo_enabled = unserialize(get_option(OP_SN . '_seo'));
		if (!empty($seo_enabled) && isset($seo_enabled['enabled'])) {
			define('OP_SEO_ENABLED', $seo_enabled['enabled']);
		} else {
			define('OP_SEO_ENABLED', 'N');
		}
	}
	add_action('init','op_define_vars');

	function admin_bar_links() {
		if (!is_admin() && current_user_can('edit-themes')) {
			global $wp_admin_bar;
			global $post;
			
			if ($post->post_type == 'page') {
				$wp_admin_bar->add_menu( array(
					'parent' => false, // use 'false' for a root menu, or pass the ID of the parent menu
					'id' => 'optimizepress', // link ID, defaults to a sanitized title value
					'title' => __('OptimizePress', OP_SN), // link title
					'href' => '', // name of file
					'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
				));
				if (get_post_meta($post->ID,'_'.OP_SN.'_pagebuilder',true) == 'Y') {
					$wp_admin_bar->add_menu( array(
						'parent' => 'optimizepress', 
						'id' => 'op_live_editor', 
						'title' => __('Live Editor', OP_SN), 
						'href' => admin_url("admin.php?page=optimizepress-page-builder&page_id=".$post->ID."&step=5"), 
						'meta' => array('class' => 'op-pagebuilder') 
					));
				}
				$wp_admin_bar->add_menu( array(
						'parent' => 'optimizepress', 
						'id' => 'op_pagebuilder', 
						'title' => __('PageBuilder', OP_SN), 
						'href' => admin_url("admin.php?page=optimizepress-page-builder&page_id=".$post->ID), 
						'meta' => array('class' => 'op-pagebuilder') 
					));
			}
		}
		
	}
	add_action('wp_before_admin_bar_render', 'admin_bar_links');
		
	function op_include_files(){
		require_once OP_FUNC.'widgets.php';
		require_once OP_FUNC.'options.php';
		require_once OP_FUNC.'page_options.php';
		require_once OP_FUNC.'general.php';
		require_once OP_FUNC.'scripts.php';
		require_once OP_FUNC.'assets.php';
		require_once OP_FUNC.'fonts.php';
		require_once OP_FUNC.'sl_api.php';
		
		op_textdomain();
		require_once OP_FUNC.'templates.php';
		
		_op_assets();
		add_theme_support( 'automatic-feed-links' );		
		add_theme_support( 'post-thumbnails' );
		if(is_admin()){
			require_once OP_FUNC.'admin.php';
			require_once OP_ADMIN.'init.php';
		} else {
			op_register_scripts();
			do_action('op_pre_tempate_include');
			add_filter('template_include', 'op_template_include');
			do_action('op_setup');
		}
	}
	add_action('init','op_include_files');
	
	
	
	function op_template_include($template,$use_template=true){
		/*if(op_get_option('blog_enabled') != 'Y' || op_get_option('installed') != 'Y'){
			global $post;
			if (!empty($post) && 'page' != $post->post_type) {
				return OP_DIR.'index.php';
			}
		}*/
		if($use_template){
			if($id = get_queried_object_id()){
				$status = get_post_status($id);
				if ( $status == 'publish' || (current_user_can('edit_posts') || current_user_can('edit_pages')) ){
					if(get_post_meta($id,'_'.OP_SN.'_pagebuilder',true) == 'Y'){
						op_init_page($id);
						if(op_page_option('launch_funnel','enabled') == 'Y' && $launch_info = op_page_option('launch_suite_info')){
							require_once OP_FUNC.'launch.php';
						}
						$theme = op_page_option('theme');
						$file = OP_PAGES.$theme['type'].'/'.$theme['dir'].'/template.php';
						if(file_exists($file)){
							return $file;
						}
					}
				}
			}
		}
		
		return $template;
	}

	function opLog($msg, $level = 'DEBUG')
	{
		$msg = date("d.m.Y h:i:s", time()). ' '. '['.$level.'] ' . $msg . PHP_EOL;
		file_put_contents('c:\wamp\www\optitheme\data\log.txt', $msg, FILE_APPEND);
	}
	
	/**
	 * Multi-byte Unserialize
	 *
	 * UTF-8 will screw up a serialized string
	 *
	 * @access private
	 * @param string
	 * @return string
	 */
	function mb_unserialize($string) {
		if (is_array($string)) {
			return $string;
		}
	    $string = preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'", $string);
	    return unserialize($string);
	}

	/*
	 * Attaching on template redirect action for processing of optin form
	 */
	add_action('template_redirect', 'processOptinForm', 20);

	/**
	 * Processing optin form, subscribing users
	 * @author Luka Peharda <luka.peharda@gmail.com>
	 * @return void
	 */
	function processOptinForm()
	{
		global $wp;
		/*
		 * We are checking for our processing URL slug
		 */
		if ($wp->request === 'process-optin-form') {

			$type = op_post('provider');
			if (false !== $type) {

				require_once(OP_MOD . 'email/ProviderFactory.php');

				$list = op_post('list');
				$email = op_post('email');

				$webinar = op_post('gotowebinar');
				/*
				 * Triggering GoToWebinar
				 */
				if (false !== $webinar) {
					do_action('gotowebinar', $webinar, $email);
				}

				$provider = OptimizePress_Modules_Email_ProviderFactory::getFactory($type, true);
				$provider->subscribe(array('list' => $list, 'email' => $email));

				header("HTTP/1.1 200 OK");
				header("Location: " . op_post('redirect_url'));
			} else {
				$email = op_post(op_post('email_field'));
				$webinar = op_post('gotowebinar');
				/*
				 * Triggering GoToWebinar
				 */
				if (false !== $webinar) {
					do_action('gotowebinar', $webinar, $email);
				}

				/*
				 * Redirecting user with all its POST data (needed for GoToWebinar interception)
				 */
				wp_redirect(op_post('redirect_url'), 307);
			}
			exit();
		}
	}

	/**
	 * Checks GET vars for 'op_' prefixed parameters to fill the value
	 * @author Luka Peharda <luka.peharda@gmail.com>
	 * @param  string $name
	 * @return string
	 */
	function getOptinUrlValue($name)
	{
		$value = op_get('op_' . strtolower($name));
		if (false !== $value) {
			$value = op_attr($value);
		} else if ('FNAME' == $name) {
			$value = getOptinUrlValue('name');
		}

		return $value;
	}

	/*
	 * Attaching on template readirect action for authorizing with AWeber Oauth
	 */
	add_action('template_redirect', 'oauthAuthorize', 20);

	/**
	 * Authorize Email provider using OAuth
	 * @author Luka Peharda <luka.peharda@gmail.com>
	 * @return void
	 */
	function oauthAuthorize()
	{
		/*
		 * As a security precaution we need to check if user is logged in and administrator type
		 */
		global $user_ID;
		if (!$user_ID || !current_user_can('level_10')) {
			return;
		}

		global $wp;
		/*
		 * We are checking for our authorizing URL slug
		 */
		if ($wp->request === OP_AWEBER_AUTH_URL) {

			require_once(OP_MOD . 'email/ProviderFactory.php');

			$provider = OptimizePress_Modules_Email_ProviderFactory::getFactory('aweber', true);
			$provider->authorize();

		} else if ($wp->request === OP_GOTOWEBINAR_AUTH_URL) {

			require_once(OP_MOD . 'email/ProviderFactory.php');

			$provider = OptimizePress_Modules_Email_ProviderFactory::getFactory('gotowebinar', true);
			$provider->authorize();

		} else if ($wp->request === OP_ONESHOPPINGCART_CONNECT_URL) {

			require_once(OP_MOD . 'email/ProviderFactory.php');

			$provider = OptimizePress_Modules_Email_ProviderFactory::getFactory('oneshoppingcart', true);
			$provider->authorize();
		}
	}

	/*
	 * Attaching to scheduled delete to clean up expired DB transients
	 */
	add_action('wp_scheduled_delete', 'deleteExpiredDbTransients');

	/**
	 * Deletes expired DB transients as WP currently doesn't do garbage cleaning
	 * @author Luka Peharda <luka.peharda@gmail.com>
	 * @return void
	 */
	function deleteExpiredDbTransients()
	{
	    global $wpdb, $_wp_using_ext_object_cache;

	    if ($_wp_using_ext_object_cache) {
	    	return;
	    }

	    $time = isset ($_SERVER['REQUEST_TIME']) ? (int)$_SERVER['REQUEST_TIME'] : time();
	    $expired = $wpdb->get_col("SELECT option_name FROM {$wpdb->options} WHERE option_name LIKE '_transient_timeout%' AND option_value < $time;");

	    foreach ($expired as $transient) {
	        delete_transient(str_replace('_transient_timeout_', '', $transient));
	    }
	}

	/*
	 * Adding ping-pong action
	 */
	add_action('ping_pong', 'op_sl_ping');
	
	add_action('gotowebinar', 'processGoToWebinar', 10, 2);

	/**
	 * Processes GoToWebinar interception request
	 * @author Luka Peharda <luka.peharda@gmail.com>
	 * @param  string $webinar
	 * @param  email $email
	 * @return void
	 */
	function processGoToWebinar($webinar, $email)
	{
		$firstName = $lastName = '';

		foreach ($_POST as $key => $value) {
			$key = strtolower($key);
			if (in_array($key, array('firstname','first_name','first-name','fname','first','name'))) {
				$firstName = $value;
			}
			if (in_array($key, array('lastname','last_name','last-name','lname','last','name'))) {
				$firstName = $value;
			}
		}

		require_once(OP_MOD . 'email/ProviderFactory.php');
		$provider = OptimizePress_Modules_Email_ProviderFactory::getFactory('gotowebinar', true);
		if ($provider->isEnabled()) {
			$provider->subscribe(array(
				'list' => $webinar,
				'email' => $email,
				'firstName' => empty($firstName) ? 'Friend' : $firstName,
				'lastName' => empty($lastName) ? '.' :  $lastName
			));	
		}		
	}
	
	/*
	 * GoToWebinar token is active only for a year. We are showing user notice when the token is about to expire
	 */
	add_action('admin_notices', 'goToWebinarTokenExpiry');

	/**
	 * Checks that 'optimizepress_gotowebinar_access_token' is defined and if 'optimizepress_gotowebinar_expires_in' is larger smaller than two weeks
	 * @author Luka Peharda <luka.peharda@gmail.com>
	 * @return void
	 */
	function goToWebinarTokenExpiry()
	{
		$accessToken = op_get_option('gotowebinar_access_token'); 
		$expiresIn = op_get_option('gotowebinar_expires_in');
		$expiryTime = (int) $expiresIn - time();

		if (false !== $accessToken && false !== $expiresIn && $expiryTime < OP_GOTOWEBINAR_EXPIRE_NOTICE) {
			if ($expiryTime > 0) {
				echo '<div class="update-nag">' . sprintf(__('GoToWebinar access token is going to expire in %1$d day(s). Please <a href="%2$s">re-authorize</a>.', OP_SN), intval($expiryTime / 86400), site_url(OP_GOTOWEBINAR_AUTH_URL) . '?authorize=1') . '</div>';
			} else {
				echo '<div class="update-nag">' . sprintf(__('GoToWebinar access token is expired. Please <a href="%1$s">re-authorize</a>.', OP_SN), site_url(OP_GOTOWEBINAR_AUTH_URL) . '?authorize=1') . '</div>';
			}			
		}
	}

	/**
	 * Displays admin notice that both theme and plugin are activated
	 * @author Luka Peharda <luka.peharda@gmail.com>
	 * @return void
	 */
	function pluginAndThemeAreRunning()
	{
		$currentTheme = wp_get_theme();
		/*
		 * We are both checking the name and the version of the current theme to make sure that we don't display the notice when OP1 theme is used with OP2 plugin
		 */
		if ('OptimizePress' === $currentTheme->Name && version_compare($currentTheme->Version, 2) > -1) {
			echo '<div class="update-nag">' . __('Both OptimizePress plugin and theme are running. You should deactivate one of them.', OP_SN) . '</div>';	
		}		
	}

	/*
	 * called on admin_init
	*/
	function load_plugin_screen() {
		add_thickbox();
		add_action( 'admin_notices', 'update_nag_screen');
	}

	/*
	 * checking and adding admin notices for plugin update
	* @return void
	*/
	function update_nag_screen() {
		//PLUGIN
		$response = get_transient('op_plugin_update');
		
		$plugin_version = OP_VERSION;
		$plugin_slug = plugin_basename(__FILE__);
		list ($t1, $t2) = explode('/', $plugin_slug);
		$pluginName = str_replace('.php', '', $t2);

		if (false === $response)
			return;

		$update_url = wp_nonce_url( 'update.php?action=upgrade-plugin&amp;plugin=' . urlencode($plugin_slug), 'upgrade-plugin_' . $plugin_slug);
		$update_onclick = '';

		if (isset($response->new_version) &&  version_compare( $plugin_version, $response->new_version, '<' ) ) {
			echo '<div id="update-nag">';
			printf( '<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.',
			'OptimizePress Plugin',
			$response->new_version,
			'#TB_inline?width=640&amp;inlineId=' . $pluginName . '_changelog',
			'OptimizePress Plugin',
			$update_url,
			$update_onclick
			);
			echo '</div>';
			echo '<div id="' . $pluginName . '_' . 'changelog" style="display:none;">';
			echo wpautop($response->sections['changelog']);
			echo '</div>';
		}
	}

	// Take over the Plugin info screen
	add_filter('plugins_api', 'plugin_screen', 10, 3);

	function plugin_screen($def, $action, $args) {
		$plugin_slug = plugin_basename(__FILE__);
		if ($args->slug != $plugin_slug)
			return false;
		
		$obj = get_transient('op_plugin_update');
		
		if (false !== $obj) {
			$res = $obj;
		}

		return $res;
	}

	/**
	 * Check SL service for new version
	 * @param array existing WordPress transient array
	 * @return bool|WP_Error
	 */
	function checkUpdate($transient)
	{
		$response = get_transient('op_plugin_update');
		
		$plugin_version = OP_VERSION;
		$plugin_slug = plugin_basename(__FILE__);
		list ($t1, $t2) = explode('/', $plugin_slug);
		$pluginName = str_replace('.php', '', $t2);

		if (false === $response) {
				
			$apiResponse = op_sl_update('plugin');
			
			if (is_wp_error($response)) {
				return $transient;
			}
			/*
			 The WordPress update process needs an array formatted like the following:
			{
			"name" : "External Update Example",
			"slug" : "external-update-example",
			"homepage" : "http://example.com/",
			"download_url" : "http://w-shadow.com/files/external-update-example/external-update-example.zip",
			
			"version" : "2.0",
			"requires" : "3.0",
			"tested" : "3.1-alpha",
			"last_updated" : "2010-08-29 20:50:00",
			"upgrade_notice" : "Here's why you should upgrade...",
			
			"author" : "Janis Elsts",
			"author_homepage" : "http://w-shadow.com/",
			
			"sections" : {
			"description" : "(Required) Plugin description.<p>This section will be opened by default when the user clicks on 'View version XYZ information'. Basic HTML can be used in all sections.</p>",
			"installation" : "(Recommended) Installation instructions.",
			"changelog" : "(Recommended) Changelog.",
			"custom_section" : "This is a custom section labeled 'Custom Section'."
			},
			
			"rating" : 90,
			"num_ratings" : 123,
			"downloaded" : 1234
			}
			*/
			
			if (version_compare($plugin_version, $apiResponse->new_version, '<')) {
				//prepare object for WordPress
				$obj 					= new stdClass();
				$obj->name				= __('OptimizePress Plugin', OP_SN);
				$obj->slug 				= $plugin_slug;
				$obj->version 			= $apiResponse->new_version;
				$obj->new_version 		= $apiResponse->new_version;
				$obj->homepage 			= $apiResponse->url;
				$obj->url	 			= $apiResponse->url;
				$obj->download_url 		= $apiResponse->package;
				$obj->package	 		= $apiResponse->package;
				$obj->requires			= '3.5';
				$obj->tested			= '3.5.2';
				$obj->sections			= array(
											'description' => $apiResponse->section->description,
											'changelog' => $apiResponse->section->changelog,
										);

				$transient->response[$plugin_slug] = $obj;
			}
			
			// set transient for 12 hours
			set_transient('op_plugin_update', $obj, strtotime('+12 hours'));
		} else {
			if (version_compare($plugin_version, $response->new_version, '<')) {
				$transient->response[$plugin_slug] = $response;
			}
		}
		//die(print_r($transient));
		return $transient;
	}

	//this is for debug only, DON'T USE IN PRODUCTION
	//set_site_transient('update_plugins', null); //check version in every request, but also check op_theme_update transient. If is set, nothing will happen

	add_filter('pre_set_site_transient_update_plugins', 'checkUpdate');
	add_action('admin_init', 'load_plugin_screen');

	/*
	 * Hooking on admin action (for the purpose of page cloning)
	 */
	add_action('admin_action_optimizepress-page-cloning', 'clonePage');

	/**
	 * Clones the page
	 * @return void
	 */
	function clonePage()
	{	
		$id = (int) filter_input(INPUT_GET, 'page_id', FILTER_SANITIZE_NUMBER_INT);
		if (empty($id)) {
			wp_die('No page ID to duplicate has been provided!', OP_SN);
		}

		require_once OP_ADMIN . 'clone_page.php';

		$newId = OptimizePress_Admin_ClonePage::getInstance()->clonePage($id);

		wp_redirect(admin_url('post.php?action=edit&post=' . $newId));
	}
}

if (!class_exists('Arrow_Walker_Nav_Menu')) {
	class Arrow_Walker_Nav_Menu extends Walker_Nav_Menu
	{
		public function display_element($el, &$children, $max_depth, $depth = 0, $args, &$output)
		{
			$id = $this->db_fields['id'];    

			if(isset($children[$el->$id])) {
				$el->classes[] = 'has_children';    	
			}			  

			parent::display_element($el, $children, $max_depth, $depth, $args, $output);
		}
	}	
}

add_action('admin_notices', 'pluginAndThemeAreRunning');