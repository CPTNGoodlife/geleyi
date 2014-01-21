<?php
/*
* Define class pspActionAdminAjax
* Make sure you skip down to the end of this file, as there are a few
* lines of code that are very important.
*/
!defined('ABSPATH') and exit;
if (class_exists('pspActionAdminAjax') != true) {
    class pspActionAdminAjax
    {
        /*
        * Some required plugin information
        */
        const VERSION = '1.0';

        /*
        * Store some helpers config
        */
		public $the_plugin = null;

		static protected $_instance;
		
	
		/*
        * Required __construct() function that initalizes the AA-Team Framework
        */
        public function __construct( $parent )
        {
			$this->the_plugin = $parent;
			add_action('wp_ajax_pspAdminAjax', array( &$this, 'admin_ajax' ));
        }
        
		/**
	    * Singleton pattern
	    *
	    * @return pspFileEdit Singleton instance
	    */
	    static public function getInstance()
	    {
	        if (!self::$_instance) {
	            self::$_instance = new self;
	        }
	        
	        return self::$_instance;
	    }
	    
	    
		public function admin_ajax() {
			$action = isset($_REQUEST['sub_action']) ? $_REQUEST['sub_action'] : '';
			$engine = isset($_REQUEST['engine']) ? strtolower($_REQUEST['engine']) : '';
			$sitemap_type = isset($_REQUEST['sitemap_type']) ? $_REQUEST['sitemap_type'] : 'sitemap';

			$sitemapList = array('sitemap' => 'Sitemap.xml', 'sitemap_images' => 'Sitemap-Images.xml', 'sitemap_videos' => 'Sitemap-Videos.xml');
			$sitemapCurrent = $sitemapList[ "$sitemap_type" ];

			$ret = array(
				'status'			=> 'invalid',
				'start_date'		=> date('Y-m-d H:i:s'),
				'start_time'		=> 0,
				'end_time'			=> 0,
				'duration'			=> 0,
				'msg'				=> '',
				'msg_html'			=> ''
			);

			if ( $action == 'getStatus') {

				$notifyStatus = $this->the_plugin->get_theoption('psp_sitemap_engine_notify');
				if ( $notifyStatus === false || !isset($notifyStatus["$engine"]) || !isset($notifyStatus["$engine"]["$sitemap_type"]) ) ;
				else {
					$ret['status'] = 'valid';
					$ret['msg_html'] = $notifyStatus["$engine"]["$sitemap_type"]["msg_html"];
				}
				
				die(json_encode($ret));
			}
			
			$sitemapUrl =  home_url('/sitemap.xml');
			switch ($sitemap_type) {
				case 'sitemap_images':
					$sitemapUrl = home_url('/sitemap-images.xml');
					break;
				case 'sitemap_videos':
					$sitemapUrl = home_url('/sitemap-videos.xml');
					break;
				default:
					break;
			}
			if ( $action == 'localseo_notify' ) {

				if ( $sitemap_type == 'kml' )
					$sitemapUrl =  home_url('/sitemap-locations.kml');
				else
					$sitemapUrl =  home_url('/sitemap-locations.xml');
			}

			if ( in_array($action, array('notify', 'localseo_notify')) && $engine == 'google' ) {
				$engineTitle = __('Google', $this->the_plugin->localizationName);
				$pingUrl = "http://www.google.com/webmasters/sitemaps/ping?sitemap=";
				$pingUrl .= urlencode( $sitemapUrl );
			}
			else if ( in_array($action, array('notify', 'localseo_notify')) && $engine == 'bing' ) {
				$engineTitle = __('Bing', $this->the_plugin->localizationName);
				$pingUrl = "http://www.bing.com/webmaster/ping.aspx?siteMap=";
				$pingUrl .= urlencode( $sitemapUrl );
			}

			if ( in_array($action, array('notify', 'localseo_notify')) && in_array($engine, array('google', 'bing')) ) ;
			else {
				$ret['msg_html'] = 'unknown request';
				die(json_encode($ret));
			}

			if ( $action == 'localseo_notify' ) {
				$notifyStatus = $this->the_plugin->get_theoption('psp_localseo_engine_notify');
			} else {
				$notifyStatus = $this->the_plugin->get_theoption('psp_sitemap_engine_notify');
			}

			$ret['start_time'] = $this->the_plugin->microtime_float();

			$response = wp_remote_get( $pingUrl, array('timeout' => 10) );
			if ( is_wp_error( $response ) ) { // If there's error
				$ret = array_merge($ret, array(
					'end_time'		=> $this->the_plugin->microtime_float(),
					'msg'			=> htmlspecialchars( implode(';', $response->get_error_messages()) ),
					'msg_html'		=> '<span class="error">' . ($engine . ' / ' . $sitemapCurrent) . __(' couldn\'t be notified!', $this->the_plugin->localizationName) . '</span>'
				));
				$ret['duration'] = number_format( ($ret['end_time'] - $ret['start_time']), 2 );

				$notifyStatus["$engine"]["$sitemap_type"] = $ret;
				if ( $action == 'localseo_notify' ) {
					$this->the_plugin->save_theoption('psp_localseo_engine_notify', $notifyStatus);
				} else {
					$this->the_plugin->save_theoption('psp_sitemap_engine_notify', $notifyStatus);
				}
				die(json_encode($ret));
			}

			$body = wp_remote_retrieve_body( $response );

			$ret = array_merge($ret, array(
				'end_time'		=> $this->the_plugin->microtime_float(),
				'msg'			=> $body,
				'msg_html'		=> '<span class="error">' . ($engine . ' / ' . $sitemapCurrent) . __(' couldn\'t be notified | invalid response received!', $this->the_plugin->localizationName) . '</span>'
			));
			$ret['duration'] = number_format( ($ret['end_time'] - $ret['start_time']), 2 );

			if ( is_null( $body ) || $body === false ) ;
			else {
				$ret['status'] 		= 'valid';
				$ret['msg_html']	= '<span class="success">' . ($engine . ' / ' . $sitemapCurrent) . sprintf( __(' was notified successfully on %s | ping duration: %s seconds.', $this->the_plugin->localizationName), $ret['start_date'], $ret['duration'] ) . '</span>';
			}
			
			$notifyStatus["$engine"]["$sitemap_type"] = $ret;
			if ( $action == 'localseo_notify' ) {
				$this->the_plugin->save_theoption('psp_localseo_engine_notify', $notifyStatus);
			} else {
				$this->the_plugin->save_theoption('psp_sitemap_engine_notify', $notifyStatus);
			}
			die(json_encode($ret));
		}
    }
}

// Initialize the pspActionAdminAjax class
//$pspActionAdminAjax = new pspActionAdminAjax();
