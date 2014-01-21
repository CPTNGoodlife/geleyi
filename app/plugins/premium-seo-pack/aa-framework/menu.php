<?php
/**
 * AA-Team - http://www.aa-team.com
 * ===============================+
 *
 * @package		pspAdminMenu
 * @author		Andrei Dinca
 * @version		1.0
 */
! defined( 'ABSPATH' ) and exit;

if(class_exists('pspAdminMenu') != true) {
	class pspAdminMenu {
		
		/*
        * Some required plugin information
        */
        const VERSION = '1.0';

        /*
        * Store some helpers config
        */
		public $the_plugin = null;
		private $the_menu = array();
		private $current_menu = '';
		private $ln = '';

		static protected $_instance;

        /*
        * Required __construct() function that initalizes the AA-Team Framework
        */
        public function __construct()
        {
        	global $psp;
        	$this->the_plugin = $psp;
			$this->ln = $this->the_plugin->localizationName;
			
			// update the menu tree
			$this->the_menu_tree();
			
			return $this;
        }

		/**
	    * Singleton pattern
	    *
	    * @return pspDashboard Singleton instance
	    */
	    static public function getInstance()
	    {
	        if (!self::$_instance) {
	            self::$_instance = new self;
	        }

	        return self::$_instance;
	    }
		
		private function the_menu_tree()
		{
			$this->the_menu['dashboard'] = array( 
				'title' => __( 'Dashboard', $this->ln ),
				'url' => admin_url("admin.php?page=psp#dashboard"),
				'folder_uri' => $this->the_plugin->cfg['paths']['freamwork_dir_url'],
				'menu_icon' => 'images/16_dashboard.png'
			);
			
			$this->the_menu['monitoring'] = array( 
				'title' => __( 'Monitorize', $this->ln ),
				'url' => "#",
				'folder_uri' => $this->the_plugin->cfg['paths']['freamwork_dir_url'],
				'menu_icon' => 'images/16_monitorize.png',
				'submenu' => array(
					'Google_Analytics' => array(
						'title' => __( 'Google Analytics', $this->ln ),
						'url' => admin_url('admin.php?page=' . $this->the_plugin->alias . "_Google_Analytics"),
						'folder_uri' => $this->the_plugin->cfg['modules']['Google_Analytics']['folder_uri'],
						'menu_icon' => 'assets/menu_icon.png',
						'submenu' => array(
							'Google_Analytics_View' => array(
								'title' => __( 'Google Analytics', $this->ln ),
								'url' => admin_url('admin.php?page=' . $this->the_plugin->alias . "_Google_Analytics")
							),
							'Google_Analytics_Settings' => array(
								'title' => __( 'Google Analytics Settings', $this->ln ),
								'url' => admin_url("admin.php?page=psp#Google_Analytics")
							),
						)
					),
					
					'serp' => array(
						'title' => __( 'SERP Tracking', $this->ln ),
						'url' => admin_url('admin.php?page=' . $this->the_plugin->alias . "_SERP"),
						'folder_uri' => $this->the_plugin->cfg['modules']['serp']['folder_uri'],
						'menu_icon' => 'assets/menu_icon.png',
						'submenu' => array(
							'SERP_View' => array(
								'title' => __( 'SERP Tracking', $this->ln ),
								'url' => admin_url('admin.php?page=' . $this->the_plugin->alias . "_SERP")
							),
							'SERP_Settings' => array(
								'title' => __( 'SERP Settings', $this->ln ),
								'url' => admin_url("admin.php?page=psp#serp")
							),
						)
					),
					
					'google_pagespeed' => array(
						'title' => __( 'PageSpeed Insights', $this->ln ),
						'url' => admin_url('admin.php?page=' . $this->the_plugin->alias . "_PageSpeedInsights"),
						'folder_uri' => $this->the_plugin->cfg['modules']['google_pagespeed']['folder_uri'],
						'menu_icon' => 'assets/16_pagespeed.png',
						'submenu' => array(
							'google_pagespeed_View' => array(
								'title' => __( 'PageSpeed Insights', $this->ln ),
								'url' => admin_url('admin.php?page=' . $this->the_plugin->alias . "_PageSpeedInsights")
							),
							'google_pagespeed_Settings' => array(
								'title' => __( 'PageSpeed Settings', $this->ln ),
								'url' => admin_url("admin.php?page=psp#google_pagespeed")
							),
						)
					),
					
					'monitor_404' => array(
						'title' => __( '404 Monitor', $this->ln ),
						'url' => admin_url('admin.php?page=' . $this->the_plugin->alias . "_mass404Monitor"),
						'folder_uri' => $this->the_plugin->cfg['modules']['monitor_404']['folder_uri'],
						'menu_icon' => 'assets/menu_icon.png',
					),
				)
			);
			
			$this->the_menu['on_page_optimization'] = array( 
				'title' => __( 'ON Page Optimization', $this->ln ),
				'url' => "#",
				'folder_uri' => $this->the_plugin->cfg['paths']['freamwork_dir_url'],
				'menu_icon' => 'images/16_onpg.png',
				'submenu' => array(
					'on_page_optimization' => array(
						'title' => __( 'Mass Optimization', $this->ln ),
						'url' => admin_url('admin.php?page=' . $this->the_plugin->alias . "_massOptimization"),
						'folder_uri' => $this->the_plugin->cfg['modules']['on_page_optimization']['folder_uri'],
						'menu_icon' => 'assets/menu_icon.png'
					),
					
					'title_meta_format' => array(
						'title' => __( 'Title & Meta Format', $this->ln ),
						'url' => admin_url("admin.php?page=psp#title_meta_format"),
						'folder_uri' => $this->the_plugin->cfg['modules']['title_meta_format']['folder_uri'],
						'menu_icon' => 'assets/menu_icon.png'
					),
					
					'sitemap' => array(
						'title' => __( 'Sitemap', $this->ln ),
						'url' => admin_url("admin.php?page=psp#sitemap"),
						'folder_uri' => $this->the_plugin->cfg['modules']['sitemap']['folder_uri'],
						'menu_icon' => 'assets/menu_icon.png'
					),
					
					'misc' => array(
						'title' => __( 'SEO Slug Optimizer', $this->ln ),
						'url' => admin_url("admin.php?page=psp#misc"),
						'folder_uri' => $this->the_plugin->cfg['modules']['misc']['folder_uri'],
						'menu_icon' => 'assets/menu_icon.png'
					),
					
					'seo_friendly_images' => array(
						'title' => __( 'SEO Friendly Images', $this->ln ),
						'url' => admin_url("admin.php?page=psp#seo_friendly_images"),
						'folder_uri' => $this->the_plugin->cfg['modules']['seo_friendly_images']['folder_uri'],
						'menu_icon' => 'assets/menu_icon.png'
					),
					
					'local_seo' => array(
						'title' => __( 'Local SEO', $this->ln ),
						'url' => admin_url("admin.php?page=psp#local_seo"),
						'folder_uri' => $this->the_plugin->cfg['modules']['local_seo']['folder_uri'],
						'menu_icon' => 'assets/menu_icon.png'
					)
				)
			);
			
			$this->the_menu['off_page_optimization'] = array( 
				'title' => __( 'OFF Page Optimization', $this->ln ),
				'url' => "#",
				'folder_uri' => $this->the_plugin->cfg['paths']['freamwork_dir_url'],
				'menu_icon' => 'images/16_offpg.png',
				'submenu' => array(
					'backlink_builder' => array(
						'title' => __( 'Backlink Builder', $this->ln ),
						'url' => admin_url('admin.php?page=' . $this->the_plugin->alias . "_Backlink_Builder"),
						'folder_uri' => $this->the_plugin->cfg['modules']['backlink_builder']['folder_uri'],
						'menu_icon' => 'assets/menu_icon.png'
					),
					
					'Social_Stats' => array(
						'title' => __( 'Social Stats', $this->ln ),
						'url' => admin_url('admin.php?page=' . $this->the_plugin->alias . "_Social_Stats"),
						'folder_uri' => $this->the_plugin->cfg['modules']['Social_Stats']['folder_uri'],
						'menu_icon' => 'assets/menu_icon.png',
						'submenu' => array(
							'Social_Stats_View' => array(
								'title' => __( 'Social Stats', $this->ln ),
								'url' => admin_url('admin.php?page=' . $this->the_plugin->alias . "_Social_Stats")
							),
							'Google_Analytics_Settings' => array(
								'title' => __( 'Social Stats Settings', $this->ln ),
								'url' => admin_url("admin.php?page=psp#Social_Stats")
							),
						)
					),
					
					'Link_Builder' => array(
						'title' => __( 'Link Builder', $this->ln ),
						'url' => admin_url('admin.php?page=' . $this->the_plugin->alias . "_Link_Builder"),
						'folder_uri' => $this->the_plugin->cfg['modules']['Link_Builder']['folder_uri'],
						'menu_icon' => 'assets/menu_icon.png'
					),
					
					'Link_Redirect' => array(
						'title' => __( '301 Link Redirect', $this->ln ),
						'url' => admin_url('admin.php?page=' . $this->the_plugin->alias . "_Link_Redirect"),
						'folder_uri' => $this->the_plugin->cfg['modules']['Link_Redirect']['folder_uri'],
						'menu_icon' => 'assets/menu_icon.png'
					),
				)
			);
			
			$this->the_menu['advanced_setup'] = array( 
				'title' => __( 'Advanced Setup', $this->ln ),
				'url' => "#",
				'folder_uri' => $this->the_plugin->cfg['paths']['freamwork_dir_url'],
				'menu_icon' => 'images/16_tools.png',
				'submenu' => array(
					'file_edit' => array(
						'title' => __( 'Files Edit', $this->ln ),
						'url' => admin_url('admin.php?page=' . $this->the_plugin->alias . "_massFileEdit"),
						'folder_uri' => $this->the_plugin->cfg['modules']['file_edit']['folder_uri'],
						'menu_icon' => 'assets/menu_icon.png'
					),

					'W3C_HTMLValidator' => array(
						'title' => __( 'W3C Validator', $this->ln ),
						'url' => admin_url('admin.php?page=' . $this->the_plugin->alias . "_HTMLValidator"),
						'folder_uri' => $this->the_plugin->cfg['modules']['W3C_HTMLValidator']['folder_uri'],
						'menu_icon' => 'assets/menu_icon.png'
					),

					'misc' => array(
						'title' => __( 'SEO Insert Code', $this->ln ),
						'url' => admin_url("admin.php?page=psp#misc#insert-code"),
						'folder_uri' => $this->the_plugin->cfg['paths']['freamwork_dir_url'],
						'menu_icon' => 'images/16_code.png'
					),

					/*'rich_snippets' => array(
						'title' => __( 'Rich Snippets', $this->ln ),
						'url' => admin_url("admin.php?page=psp#rich_snippets"),
						'folder_uri' => $this->the_plugin->cfg['paths']['freamwork_dir_url'],
						'menu_icon' => 'assets/menu_icon.png'
					),*/

					'facebook_planner' => array(
						'title' => __( 'Facebook Planner', $this->ln ),
						'url' => admin_url("admin.php?page=psp#facebook_planner"),
						'folder_uri' => $this->the_plugin->cfg['paths']['freamwork_dir_url'],
						'menu_icon' => 'images/16_code.png'
					),
					
					'facebook_planner' => array(
						'title' => __( 'Facebook Planner', $this->ln ),
						'url' => admin_url("admin.php?page=psp#facebook_planner"),
						'folder_uri' => $this->the_plugin->cfg['modules']['facebook_planner']['folder_uri'],
						'menu_icon' => 'assets/menu_icon.png',
						'submenu' => array(
							'Smushit_View' => array(
								'title' => __( 'FB Planner', $this->ln ),
								'url' => admin_url('admin.php?page=' . $this->the_plugin->alias . "_facebook_planner")
							),
							'Smushit_Settings' => array(
								'title' => __( 'FB Planner Settings', $this->ln ),
								'url' => admin_url("admin.php?page=psp#facebook_planner")
							),
						)
					),

					'smushit' => array(
						'title' => __( 'Media Smushit', $this->ln ),
						'url' => admin_url('admin.php?page=' . $this->the_plugin->alias . "_smushit"),
						'folder_uri' => $this->the_plugin->cfg['modules']['smushit']['folder_uri'],
						'menu_icon' => 'assets/menu_icon.png',
						'submenu' => array(
							'Smushit_View' => array(
								'title' => __( 'Media Smushit', $this->ln ),
								'url' => admin_url('admin.php?page=' . $this->the_plugin->alias . "_smushit")
							),
							'Smushit_Settings' => array(
								'title' => __( 'Smushit Settings', $this->ln ),
								'url' => admin_url("admin.php?page=psp#smushit")
							),
						)
					)

				)
			);
			
			$this->the_menu['general'] = array( 
				'title' => __( 'Plugin Settings', $this->ln ),
				'url' => "#",
				'folder_uri' => $this->the_plugin->cfg['paths']['freamwork_dir_url'],
				'menu_icon' => 'images/16_generalsettings.png',
				'submenu' => array(
					'modules_manager' => array(
						'title' => __( 'Modules Manager', $this->ln ),
						'url' => admin_url("admin.php?page=psp#modules_manager"),
						'folder_uri' => $this->the_plugin->cfg['modules']['modules_manager']['folder_uri'],
						'menu_icon' => 'assets/menu_icon.png'
					),
					
					'setup_backup' => array(
						'title' => __( 'Setup / Backup', $this->ln ),
						'url' => admin_url("admin.php?page=psp#setup_backup"),
						'folder_uri' => $this->the_plugin->cfg['modules']['setup_backup']['folder_uri'],
						'menu_icon' => 'assets/menu_icon.png'
					),
				)
			);
		}
		
		public function show_menu()
		{
			$html = array();
			// id="psp-nav-dashboard" 
			$html[] = '<div id="psp-header">';
			$html[] = 	'<div id="psp-header-bottom">';
			$html[] = 		'<div id="psp-topMenu">';
			$html[] = 			'<ul>';
								foreach ($this->the_menu as $key => $value) {
									$iconImg = '<img src="' . ( $value['folder_uri'] . $value['menu_icon'] ) . '" />';
									$html[] = '<li id="psp-nav-' . ( $key ) . '" class="psp-section-' . ( $key ) . ' ' . ( $key == $this->current_menu ? 'active' : '' ) . '">';
									$html[] = 	$iconImg;
									
									if( $value['url'] == "#" ){
										$value['url'] = 'javascript: void(0)';
									}
									$html[] = 	'<a href="' . ( $value['url'] ) . '">' . ( $value['title'] ) . '</a>';
									if( isset($value['submenu']) ){
										$html[] = 	'<ul class="psp-sub-menu">';
										foreach ($value['submenu'] as $kk2 => $vv2) {
											
											if( !in_array( $kk2, array_keys($this->the_plugin->cfg['activate_modules'])) ) continue;
											
											$iconImg = '<img src="' . ( $vv2['folder_uri'] . $vv2['menu_icon'] ) . '" />';
											$html[] = '<li class="psp-section-' . ( $kk2 ) . '" id="psp-sub-nav-' . ( $kk2 ) . '">';
											$html[] = 	$iconImg;
											$html[] = 	'<a href="' . ( $vv2['url'] ) . '">' . ( $vv2['title'] ) . '</a>'; 
											
											if( isset($vv2['submenu']) ){
												$html[] = 	'<ul class="psp-sub-sub-menu">';
												foreach ($vv2['submenu'] as $kk3 => $vv3) {
													$html[] = '<li id="psp-sub-sub-nav-' . ( $kk3 ) . '">';
													$html[] = 	'<a href="' . ( $vv3['url'] ) . '">' . ( $vv3['title'] ) . '</a>';
													$html[] = '</li>';
												}
												$html[] = 	'</ul>';
											}
											$html[] = '</li>';
										}
										$html[] = 	'</ul>';
									}
									$html[] = '</li>';
								}
			$html[] = 			'</ul>';
			$html[] = 		'</div>';
			$html[] = 	'</div>';
			$html[] = '</div>';
			
			echo implode("\n", $html);
		}

		public function make_active( $section='' )
		{
			$this->current_menu = $section;
			return $this;
		}
	}
}