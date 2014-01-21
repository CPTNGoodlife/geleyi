<?php
/**
 * module return as json_encode
 * http://www.aa-team.com
 * =======================
 *
 * @author		Andrei Dinca, AA-Team
 * @version		1.0
 */

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */
if ( !function_exists( 'psp_wplanner_fb_options' ) ) {
	
	function __doRange( $arr ) {
		$newarr = array();
		if ( is_array($arr) && count($arr)>0 ) {
			foreach ($arr as $k => $v) {
				$newarr[ $v ] = $v;
			}
		}
		return $newarr;
	}
		
	function psp_wplanner_fb_options() 
	{
		global $wpdb, $psp;
		
		/* Here we define the different drop downs for our option page */
		
		// Facebook language
		$select_fblanguage = array( "af_ZA" => "Afrikaans","sq_AL" => "Albanian","ar_AR" => "Arabic","hy_AM" => "Armenian","eu_ES" => "Basque","be_BY" => "Belarusian","bn_IN" => "Bengali","bs_BA" => "Bosanski","bg_BG" => "Bulgarian","ca_ES" => "Catalan","zh_CN" => "Chinese","cs_CZ" => "Czech","da_DK" => "Danish","fy_NL" => "Dutch","en_US" => "English","eo_EO" => "Esperanto","et_EE" => "Estonian","et_EE" => "Estonian","fi_FI" => "Finnish","fo_FO" => "Faroese","tl_PH" => "Filipino","fr_FR" => "French","gl_ES" => "Galician","ka_GE" => "Georgian","de_DE" => "German","zh_CN" => "Greek","he_IL" => "Hebrew","hi_IN" => "Hindi","hr_HR" => "Hrvatski","hu_HU" => "Hungarian","is_IS" => "Icelandic","id_ID" => "Indonesian","ga_IE" => "Irish","it_IT" => "Italian","ja_JP" => "Japanese","ko_KR" => "Korean","ku_TR" => "Kurdish","la_VA" => "Latin","lv_LV" => "Latvian","fb_LT" => "Leet Speak","lt_LT" => "Lithuanian","mk_MK" => "Macedonian","ms_MY" => "Malay","ml_IN" => "Malayalam","nl_NL" => "Nederlands","ne_NP" => "Nepali","nb_NO" => "Norwegian","ps_AF" => "Pashto","fa_IR" => "Persian","pl_PL" => "Polish","pt_PT" => "Portugese","pa_IN" => "Punjabi","ro_RO" => "Romanian","ru_RU" => "Russian","sk_SK" => "Slovak","sl_SI" => "Slovenian","es_LA" => "Spanish","sr_RS" => "Srpski","sw_KE" => "Swahili","sv_SE" => "Swedish","ta_IN" => "Tamil","te_IN" => "Telugu","th_TH" => "Thai","tr_TR" => "Turkish","uk_UA" => "Ukrainian","vi_VN" => "Viettitlese","cy_GB" => "Welsh" );
		
		// Facebook OpenGraph Post Types
		$select_fb_og_type = array(
			"Activities" => array("activity", "sport"),
			"Businesses" => array("bar", "company", "cafe", "hotel", "restaurant"),
			"Groups" => array("cause", "sports_league", "sports_team"),
			"Organizations" => array("band", "government", "non_profit", "school", "university"),
			"People" => array("actor", "athlete", "author", "director", "musician", "politician", "public_figure"),
			"Places" => array("city", "country", "landmark", "state_province"),
			"Products and Entertainment" => array("album", "book", "drink", "food", "game", "product", "song", "movie", "tv_show"),
			"Websites" => array("blog", "website", "article")
		);
		
		// Inputs available for posting to Facebook displayed on each post/page
		$inputs_available = array(
			"message" => __( "Message", $psp->localizationName ), 
			"caption" => __( "Caption", $psp->localizationName ), 
			"image" => __( "Image", $psp->localizationName )
		);
							
		// Facebook privacy options
		$wplannerfb_post_privacy_options = array(
			"EVERYONE" => __( 'Everyone', $psp->localizationName ), 
			"EVERYONE" => __( 'Everyone', $psp->localizationName ), 
			"ALL_FRIENDS" => __( 'All Friends', $psp->localizationName ), 
			"NETWORKS_FRIENDS" => __( 'Networks Friends', $psp->localizationName ), 
			"FRIENDS_OF_FRIENDS" => __( 'Friends of Friends', $psp->localizationName ),
			"CUSTOM" => __( 'Private (only me)', $psp->localizationName )
		);
		
		// all alias of post types 
		$select_post_types = array();
		$exclude_post_types = array('attachment', 'revision', 'wplannertw', 'wptw2fbfeed_fb', 'wplannerfb', 'wplannerlin', 'wpsfpb');
		
		// Facebook available user Pages / Groups
		$fb_user_pages_groups = get_option('psp_fb_planner_user_pages');
		if(trim($fb_user_pages_groups) != "") {
				$fb_all_user_pages_groups = @json_decode($fb_user_pages_groups);
		}
			
		// create query string
		$querystr = "SELECT DISTINCT($wpdb->posts.post_type) FROM $wpdb->posts WHERE 1=1";
		$pageposts = $wpdb->get_results($querystr, ARRAY_A);
		if(count($pageposts) > 0 ) {
			foreach ($pageposts as $key => $value){
				if( !in_array($value['post_type'], $exclude_post_types) ) {
					$select_post_types[$value['post_type']] = ucfirst($value['post_type']);
				}
			}
		}
			
		$options = array(
		
			'inputs_available' => array(
				"title" => __( "Publish on facebook optional fields", $psp->localizationName ),
				"desc" => __( "What inputs do you want to be available for posting to facebook? It will appear on page/post details", $psp->localizationName ),
				'size' 	=> 'large',
				'force_width'=> '130',
				"type" => "multiselect",
				"options" => $inputs_available 
			),
			
			'featured_image_size' => array(
				"title" => __( "Custom Image size", $psp->localizationName ),
				'std' => '450x320',
				"desc" => __( "WIDTH x HEIGHT (Without measuring units. Example: 450x320)", $psp->localizationName ),
				'force_width'=> '180',
				'size' 	=> 'large',
				"type" => "text" 
			),
			
			'featured_image_size_crop' => array(
				"title" => __( "Crop image?", $psp->localizationName ),
				"desc" => __( "If yes, the image will crop to fit the above desired size. If no, the image will just resize with the dimensions provided.", $psp->localizationName ),
				"type" => 'select',
				'size' 	=> 'large',
				'force_width'=> '140',
				"options" => array(
					'true' => __('Yes', $psp->localizationName), 
					'false' => __('No', $psp->localizationName)
				)
			),
			
			'default_privacy_option' => array(
				"title" => __( "Publish on facebook default privacy option", $psp->localizationName ),
				"desc" => __( "What privacy option would you like to be default when you're posting to facebook? This option can also be adjusted manually when setting the scheduler for each post/page.", $psp->localizationName ),
				'size' 	=> 'large',
				'force_width'=> '150',
				"type" => "select",
				"options" => $wplannerfb_post_privacy_options 
			),
			
			'email' => array(
				"title" => __( "Admin email", $psp->localizationName ),
				'size' 	=> 'large',
				'force_width'=> '200',
				"desc" => __( "Notify this email adress each time you post something on facebook.", $psp->localizationName ),
				"type" => "text"
			),
			
			'email_subject' => array(
				"title" => __( "Admin email subject", $psp->localizationName ),
				'size' 	=> 'large',
				'force_width'=> '240',
				"desc" => __( "Subject for plugin email notification.", $psp->localizationName ),
				"type" => "text"
			),
			
			
			'email_message' => array(
				"title" => __( "Admin email message", $psp->localizationName ),
				'size' 	=> 'large',
				'force_width'=> '340',
				"desc" => __( "Email content for plugin notification.", $psp->localizationName ),
				"type" => "textarea"
			),
			
			'timezone' => array(
				"title" => __( "Cron timezone", $psp->localizationName ),
				"desc" => __( "Use valid timezone format from <a href='http://php.net/manual/en/timezones.php' target='_blank'>php.net</a>. E.g: America/Detroit", $psp->localizationName ),
				"type" => "select",
				'size' 	=> 'large',
				'force_width'=> '150',
				'options' => __doRange( timezone_identifiers_list() )
			),
			
			
			'info' => array(
				"html" => __( "
					<h2>Important Information</h2>
					<p>You need to create a Facebook App. You can do that <a href='http://developers.facebook.com' target='_blank'>here.</a> and enter its details in to the fields below.</p>", $psp->localizationName ),
				"type" => "message"
			),
			
			'auth' => array(
				"desc" => __( "Facebook Application authorization for cron job.", $psp->localizationName ),
				"type" => "authorization_button",
				'size' 	=> 'large',
				'value' =>  __( "Authorization facebook app", $psp->localizationName )
			),
			
			'app_id' => array(
				"title" => __( "Facebook App ID", $psp->localizationName ),
				"desc" => __( "Insert your Facebook App ID here.", $psp->localizationName ),
				"std" => "",
				'size' 	=> 'large',
				'force_width'=> '250',
				"type" => "text"
			),
			
			'app_secret' => array(
				"title" => __( "Facebook App Secret.", $psp->localizationName ),
				"desc" => __( "Insert your Facebook App Secret here.", $psp->localizationName ),
				"std" => "",
				'size' 	=> 'large',
				'force_width'=> '350',
				"type" => "text"
			),
			
			'language' => array(
				"title" => __( "Facebook Language", $psp->localizationName ),
				"desc" => __( "Select the language for Facebook. More Information about the languages can be found <a target='_blank' href='http://developers.facebook.com/docs/internationalization/'>here</a>.", $psp->localizationName ),
				"std" => "en_US",
				"type" => "select",
				'size' 	=> 'large',
				'force_width'=> '150',
				"options" => $select_fblanguage
			)
		);
		
		// Facebook available user pages / groups
		if( isset($fb_all_user_pages_groups) && count($fb_all_user_pages_groups) > 0 ) {
			// Facebook available user pages
			if(count($fb_all_user_pages_groups->pages) > 0) {
				$fb_all_user_pages = array();
				foreach($fb_all_user_pages_groups->pages as $key => $value) {
					$fb_all_user_pages[ "{$value->id}" ] = $value->name;
				}
				
				$options['page_filter'] = array( 
					"title" => __( "Activate \"Filter Pages\"", $psp->localizationName ),
					"desc" => __( "Select \"Yes\" if you want to limit the pages shown when publishing and then select from above only what you wish to be shown. <i><strong>This is usefull if you have a lot of pages and/or you have a master facebook account and you wish to limit specific users to see other pages.</strong></i>", $psp->localizationName ),
					"type" => "select",
					'size' 	=> 'large',
					'force_width'=> '80',
					"options" => array('No', 'Yes') 
				);
									
				$options['available_pages'] = array( 
					"title" => __( "What pages do you want to be available when publishing?", $psp->localizationName ),
					"desc" => __( "<strong>This option only works if the \"Filter Pages\" option from above is \"Yes\"</strong>", $psp->localizationName ),
					"type" => "multiselect",
					'size' 	=> 'large',
					'force_width'=> '350',
					"options" => $fb_all_user_pages 
				);
			}

			// Facebook available user groups
			if(count($fb_all_user_pages_groups->groups) > 0) {
				$fb_all_user_groups = array();
				foreach($fb_all_user_pages_groups->groups as $key => $value) {
					$fb_all_user_groups[ "{$value->id}" ] = $value->name;
				}

				$options['group_filter'] = array( 
					"title" => __( "Activate \"Filter Groups\"", $psp->localizationName ),
					"desc" => __( "Select \"Yes\" if you want to limit the groups shown when publishing and then select from above only what you wish to be shown. <i><strong>This is usefull if you have a lot of groups and/or you have a master facebook account and you wish to limit specific users to see other groups.</strong></i>", $psp->localizationName ),
					"type" => "select",
					'size' 	=> 'large',
					'force_width'=> '80',
					"options" => array('No', 'Yes') 
				);

				$options['available_groups'] = array( 
					"title" => __( "What groups do you want to be available when publishing?", $psp->localizationName ),
					"desc" => __( "<strong>This option only works if the \"Filter Groups\" option from above is \"Yes\"</strong>", $psp->localizationName ),
					"type" => "multiselect",
					'size' 	=> 'large',
					'force_width'=> '350',
					"options" => $fb_all_user_groups 
				);
			}
		}

		return $options;
	}
}
global $psp;
echo json_encode(
	array(
		$tryed_module['db_alias'] => array(
			/* define the form_messages box */
			'facebook_planner' => array(
				'size' 		=> 'grid_4', // grid_1|grid_2|grid_3|grid_4
				'toggler' 	=> false, // true|false
				'header' 	=> false, // true|false
				'buttons' 	=> true, // true|false
				'style' 	=> 'panel', // panel|panel-widget
				
				// tabs
				'tabs'	=> array(
					'__tab1'	=> array(__('General setup', $psp->localizationName), 'inputs_available,default_privacy_option,timezone'),
					'__tab2'	=> array(__('Facebook Settings', $psp->localizationName), 'info,auth,app_id,app_secret,language'),
					'__tab3'	=> array(__('Facebook - Pages', $psp->localizationName), 'page_filter,available_pages'),
					'__tab4'	=> array(__('Facebook - Groups', $psp->localizationName), 'group_filter,available_groups'),
					'__tab5'	=> array(__('Email Notification', $psp->localizationName), 'email,email_subject,email_message'),
					'__tab6'	=> array(__('Facebook Image size', $psp->localizationName), 'featured_image_size,featured_image_size_predefined,featured_image_size_crop'),
				),
				
				
				// create the box elements array
				'elements'	=> psp_wplanner_fb_options()
			)
		)
	)
);