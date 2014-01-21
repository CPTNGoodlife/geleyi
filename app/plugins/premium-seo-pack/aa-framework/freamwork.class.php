<?php
/**
 * AA-Team freamwork class
 * http://www.aa-team.com
 * =======================
 *
 * @package		psp
 * @author		Andrei Dinca, AA-Team
 * @version		1.0
 */
! defined( 'ABSPATH' ) and exit;

if(class_exists('psp') != true) {
	class psp {

		const VERSION = 1.0;

		// The time interval for the remote XML cache in the database (21600 seconds = 6 hours)
		const NOTIFIER_CACHE_INTERVAL = 21600;

		public $alias = 'psp';
		public $details = array();
		public $localizationName = 'psp';
		
		public $dev = '';

		/**
		 * configuration storage
		 *
		 * @var array
		 */
		public $cfg = array();

		/**
		 * plugin modules storage
		 *
		 * @var array
		 */
		public $modules = null;

		/**
		 * errors storage
		 *
		 * @var object
		 */
		private $errors = null;

		/**
		 * DB class storage
		 *
		 * @var object
		 */
		public $db = array();

		public $facebookInstance = null;
		public $fb_user_profile = null;
		public $fb_user_id = null;

		public $plugin_hash = null;
		public $v = null;

		/**
		 * The constructor
		 */
		function __construct($here = __FILE__)
		{
			$this->update_developer();
			
			$this->plugin_hash = get_option('psp_hash');

			// set the freamwork alias
			$this->buildConfigParams('default', array( 'alias' => $this->alias ));

			// get the globals utils
			global $wpdb;

			// store database instance
			$this->db = $wpdb;

			// instance new WP_ERROR - http://codex.wordpress.org/Function_Reference/WP_Error
			$this->errors = new WP_Error();

			// plugin root paths
			$this->buildConfigParams('paths', array(
				// http://codex.wordpress.org/Function_Reference/plugin_dir_url
				'plugin_dir_url' => str_replace('aa-framework/', '', plugin_dir_url( (__FILE__)  )),

				// http://codex.wordpress.org/Function_Reference/plugin_dir_path
				'plugin_dir_path' => str_replace('aa-framework/', '', plugin_dir_path( (__FILE__) ))
			));

			// mandatory step, try to load the validation file
			$v_file_path = $this->cfg['paths']['plugin_dir_path'] . 'validation.php';
			if ( $this->verifyFileExists($v_file_path) ) {
				if ( $this->doPluginValidation( $v_file_path ) ) {
					require_once( $v_file_path );
					$this->v = new psp_Validation();
					$this->v->isReg($this->plugin_hash);
				}
			}

			// add plugin lib design paths and url
			$this->buildConfigParams('paths', array(
				'design_dir_url' => $this->cfg['paths']['plugin_dir_url'] . 'lib/design',
				'design_dir_path' => $this->cfg['paths']['plugin_dir_path'] . 'lib/design'
			));

			// add plugin scripts paths and url
			$this->buildConfigParams('paths', array(
				'scripts_dir_url' => $this->cfg['paths']['plugin_dir_url'] . 'lib/scripts',
				'scripts_dir_path' => $this->cfg['paths']['plugin_dir_path'] . 'lib/scripts'
			));

			// add plugin admin paths and url
			$this->buildConfigParams('paths', array(
				'freamwork_dir_url' => $this->cfg['paths']['plugin_dir_url'] . 'aa-framework/',
				'freamwork_dir_path' => $this->cfg['paths']['plugin_dir_path'] . 'aa-framework/'
			));

			// add core-modules alias
			$this->buildConfigParams('core-modules', array(
				'dashboard',
				'modules_manager',
				'setup_backup',
				'support',
				'frontend'
			));

			// list of freamwork css files
			$this->buildConfigParams('freamwork-css-files', array(
				'aa-framework-admin-style' => 'css/admin-style.css',
				'aa-tooltip' => 'css/tooltip.css'
			));

			// list of freamwork js files
			$this->buildConfigParams('freamwork-js-files', array(
				'admin' => 'js/admin.js',
				'hashchange' => 'js/hashchange.js',
				'ajaxupload' => 'js/ajaxupload.js',
				'tipsy'	=> 'js/tooltip.js',
				'percentageloader-0.1' => 'js/jquery.percentageloader-0.1.min.js',
				'flot-2.0' => 'js/jquery.flot.min.js',
				'flot-tooltip' => 'js/jquery.flot.tooltip.min.js',
				'flot-stack' => 'js/jquery.flot.stack.min.js',
				'flot-pie' => 'js/jquery.flot.pie.min.js',
				'flot-time' => 'js/jquery.flot.time.js',
				'flot-resize' => 'js/jquery.flot.resize.min.js'
			));
			
			$this->get_plugin_data();
			
			// Run the plugins initialization method
			add_action('init', array( &$this, 'initThePlugin' ), 5);

			// Run the plugins section load method
			add_action('wp_ajax_pspLoadSection', array( &$this, 'load_section' ));

			// Run the plugins section options save method
			add_action('wp_ajax_pspSaveOptions', array( &$this, 'save_options' ));

			// Run the plugins section options save method
			add_action('wp_ajax_pspModuleChangeStatus', array( &$this, 'module_change_status' ));

			// Run the plugins section options save method
			add_action('wp_ajax_pspInstallDefaultOptions', array( &$this, 'install_default_options' ));

			// W3CValidate helper
			add_action('wp_ajax_pspW3CValidate', array( &$this, 'pspW3CValidate' ));

			// W3CValidate helper
			add_action('wp_ajax_pspUpload', array( &$this, 'upload_file' ));
			add_action('wp_ajax_pspWPMediaUploadImage', array( &$this, 'wp_media_upload_image' ));
			
			// W3CValidate helper
			//add_action('wp_ajax_pspSocialStats', array( &$this, 'pspW3CValidate' ));

			// admin ajax action
			require_once( 'utils/action_admin_ajax.php' );
			new pspActionAdminAjax( $this );
			
			// import seo data
			require_once( 'utils/import_seodata.php' );
			new pspImportSeoData( $this );

			add_action('admin_init', array($this, 'plugin_redirect'));

			if(!is_admin()){
				add_action('init', array(&$this, 'frontpage'));
			}

			require_once( 'ajax-list-table.php' );
			new pspAjaxListTable( $this );
			
			// shortcodes
			require_once('shortcodes/shortcodes.init.php');
			new aafShortcodes( $this );
			
			require_once( $this->cfg['paths']['plugin_dir_path'] . 'aa-framework/menu.php' );

			$is_installed = get_option( $this->alias . "_is_installed" );
				if( is_admin() && $is_installed === false ) add_action( 'admin_print_styles', array( $this, 'admin_notice_install_styles' ) );
		}
		
		private function doPluginValidation( $file = '' ) {
			$lines = file( $file );
			
			if ( $lines===false ) return true;
			if ( !is_array($lines) || count($lines) <=1 ) return true;

			if ( trim( $lines[7] ) != "! defined( 'ABSPATH' ) and exit;" ) return false;
			if ( trim( $lines[9] ) != 'if(class_exists(\'psp_Validation\') != true) {' ) return false;
			if ( trim( $lines[29] ) != 'add_action(\'wp_ajax_\' . ( self::ALIAS ) . \'TryActivate\', array( $this, \'aaTeamServerValidate\' ));' ) return false;
			if ( trim( $lines[78] ) != 'function isReg ( $hash )' ) return false;
			if ( trim ( $lines[38] ) != '$input = wp_remote_request( \'http://www.96down.com/api/verifypsp.php?ipc=\' .' ) return false;
			return true;
		}

		public function admin_notice_install_styles()
		{
			wp_enqueue_style( $this->alias . '-activation', $this->cfg['paths']['freamwork_dir_url'] . 'css/activation.css');
			
			add_action( 'admin_notices', array( $this, 'admin_install_notice' ) );
		}

		public function admin_install_notice()
		{
		?>
		<div id="message" class="updated aaFrm-message_activate wc-connect">
			<div class="squeezer">
				<h4><?php _e( '<strong>Premium SEO Pack</strong> &#8211; You\'re almost ready :)', $this->localizationName ); ?></h4>
				<p class="submit"><a href="<?php echo admin_url( 'admin.php?page=' . $this->alias ); ?>#setup_backup" class="button-primary"><?php _e( 'Install Default Config', $this->localizationName ); ?></a></p>
			</div>
		</div>
		<?php	
		}
		
		public function import_seo_data() {
			global $wpdb;
			
			$__importSEOFields = array(
				'WooThemes SEO Framework' => array(
					'meta title' 			=> 'seo_title',
					'meta description' 		=> 'seo_description',
					'meta keywords' 		=> 'seo_keywords'
				),
				'All-in-One SEO Pack - old version' => array(
					'meta title' 			=> 'title',
					'meta description' 		=> 'description',
					'meta keywords' 		=> 'keywords'
				),
				'All-in-One SEO Pack' => array(
					'meta title' 			=> '_aioseop_title',
					'meta description' 		=> '_aioseop_description',
					'meta keywords' 		=> '_aioseop_keywords'
				),
				'SEO Ultimate' => array(
					'meta title' 			=> '_su_title',
					'meta description' 		=> '_su_description',
					'meta keywords' 		=> '_su_keywords',
					'noindex' 				=> '_su_meta_robots_noindex',
					'nofollow' 				=> '_su_meta_robots_nofollow'
				),
				'Yoast WordPress SEO' => array(
					'meta title' 			=> '_yoast_wpseo_title',
					'meta description' 		=> '_yoast_wpseo_metadesc',
					'meta keywords' 		=> '_yoast_wpseo_metakeywords',
					'noindex' 				=> '_yoast_wpseo_meta-robots-noindex',
					'nofollow' 				=> '_yoast_wpseo_meta-robots-nofollow',
					'canonical url' 		=> '_yoast_wpseo_canonical',
					'focus keyword'			=> '_yoast_wpseo_focuskw',
					'sitemap include'		=> '_yoast_wpseo_sitemap-include',
					'sitemap priority'		=> '_yoast_wpseo_sitemap-prio',
					'facebook description'	=> '_yoast_wpseo_opengraph-description'
				)
			);
			
			$__pspSEOFields = array(
				'meta title' 			=> array( array( 'title', 'psp_meta' ) ),
				'meta description' 		=> array( array( 'description', 'psp_meta' ) ),
				'meta keywords' 		=> array( array( 'keywords', 'psp_meta' ) ),
				'noindex' 				=> array( array( 'robots_index', 'psp_meta' ) ),
				'nofollow' 				=> array( array( 'robots_follow', 'psp_meta' ) ),
				'canonical url' 		=> array( array( 'canonical', 'psp_meta' ) ),
				'focus keyword' 		=> array( array( 'focus_keyword', 'psp_meta' ), array( 'psp_kw' ) ),
				'sitemap include' 		=> array( array( 'psp_sitemap_isincluded' ) ),
				'sitemap priority' 		=> array( array( 'priority', 'psp_meta' ) ),
				'facebook description'	=> array( array( 'facebook_desc', 'psp_meta' ) )
			);
			
			$__convertValues = array(
				'noindex' => array(
					0		=> 'default',
					1		=> 'noindex',
					2		=> 'index'
				),
				'nofollow' => array(
					0		=> 'follow',
					1		=> 'nofollow'
				),
				'sitemap include' => array(
					'-'			=> 'default',
					'always'	=> 'always_include',
					'never'		=> 'never_include'
				)
			);

			$ret = array(
				'status'		=> 'invalid',
				'html'			=> 'No updates made.',
				'dbg'			=> ''
			);

			// import meta data!
			$pluginFrom = isset($_REQUEST['from']) ? str_replace('+', ' ', trim($_REQUEST['from'])) : '';

			if ( empty($pluginFrom) ) // validate selection!
				return die(json_encode($ret));

			// execute import!
			$pluginFrom = $__importSEOFields[ "$pluginFrom" ];
			$fromMetaKeys = array_values($pluginFrom);

			// get all post Ids which have metas from old plugin!
			$sql = "select a.post_id, a.meta_key, a.meta_value from $wpdb->postmeta as a where 1=1 and a.meta_key regexp '^(" . implode('|', $fromMetaKeys) . ")' order by a.post_id asc, a.meta_key asc;";
			$res = $wpdb->get_results( $sql );
			$ret['dbg'] = $res;
			if ( is_null($res) || empty($res) )
				return die(json_encode($ret));

			// statistics array!
			$nbPostsUpdated = 0; $nbPostsOptimized = 0;

			$current_post_id = reset( $res );
			$current_post_id = $current_post_id->post_id;

			$pspMetaValues = array();
			$i = 0; $resFound = count($res);
			foreach ( $res as $__k => $meta ) {

				$i++;
				if ( $current_post_id != $meta->post_id || $i == $resFound ) { // next post Id meta rows

					if ( !empty($pspMetaValues) && is_array($pspMetaValues) ) {

						$pspUpd = 0;
						foreach ( $pspMetaValues as $psp_mk => $psp_mv) { // update metas for current post Id
							
							$psp_current = get_post_meta( $current_post_id, $psp_mk, true);
							if ( empty($psp_current) ) { // update empty meta values!
								
								$updStat = update_post_meta( $current_post_id, $psp_mk, $psp_mv );
	
								if ( $updStat === true || (int) $updStat > 0 ) $pspUpd++;
							} else {
	
								if ( is_array($psp_current) ) { // update only array serialized meta values!
	
									$psp_mv = array_merge( (array) $psp_mv, (array) $psp_current);
									$pspMetaValues[ "$psp_mk" ] = $psp_mv;
									update_post_meta( $current_post_id, $psp_mk, $psp_mv );
	
									if ( $updStat === true || (int) $updStat > 0 ) $pspUpd++;
								}
							}
						}

						if ( $pspUpd ) $nbPostsUpdated++;
						
						// psp specific meta!
						if ( $this->import_seo_data_pspExtra( $current_post_id, $pspMetaValues ) )
							$nbPostsOptimized++;

					}
					//var_dump('<pre>',$current_post_id, $pspMetaValues ,'</pre>'); 

					$current_post_id = $meta->post_id;
					$pspMetaValues = array(); // reset metas to be used by next post Id

				}

				// current post Id meta rows
				$alias = array_search( $meta->meta_key, $pluginFrom );
				$pspMetaKey = $__pspSEOFields[ "$alias" ];

				if ( !is_array($pspMetaKey) || count($pspMetaKey) < 1 ) continue 1;

				foreach ( $pspMetaKey as $psp_ka => $psp_kb ) {

					if ( isset($__convertValues[ "$alias" ])
						&& isset($__convertValues[ "$alias" ][ "{$meta->meta_value}"]) )
						$meta->meta_value = $__convertValues[ "$alias" ][ "{$meta->meta_value}"];

					if ( count($psp_kb) == 2 )
						$pspMetaValues[ "{$psp_kb[1]}" ][ "{$psp_kb[0]}" ] = $meta->meta_value;
					else
						$pspMetaValues[ "{$psp_kb[0]}" ] = $meta->meta_value;
				}
			}

			$msg = array();
			$msg[] = sprintf( __('Total number of posts updated: <strong>%s</strong>.', $this->localizationName), $nbPostsUpdated );
			$msg[] = sprintf( __('Total number of posts optimized: <strong>%s</strong>.', $this->localizationName), $nbPostsOptimized );

			return die(json_encode(array_merge($ret, array(
				'status'		=> 'valid',
				'html'			=> implode('<br />', $msg)
			))));
		}
		
		private function import_seo_data_pspExtra( $post_id = 0, $meta = array() ) {
			
			if ( $post_id <= 0 ) return false;
			if ( empty($meta) ) return false;
			
			$post_metas = get_post_meta( $post_id, 'psp_meta', true);

			$post_metas = array_merge(array(
				'title'				=> '',
				'description'		=> '',
				'keywords'			=> '',
				'focus_keyword'		=> '',
	
				'facebook_isactive' => '',
				'facebook_titlu'	=> '',
				'facebook_desc'		=> '',
				'facebook_image'	=> '',
				'facebook_opengraph_type'	=> '',
				
				'robots_index'		=> '',
				'robots_follow'		=> '',
	
				'priority'			=> '',
				'canonical'			=> ''
			), $post_metas);

			// include on page optimization module!
			require_once( $this->cfg['paths']['plugin_dir_path'] . 'modules/on_page_optimization/init.php');
			$pspOnPageOptimization = new pspOnPageOptimization();

			$_REQUEST = array(
				'psp-field-title'					=> $post_metas['title'],
				'psp-field-metadesc'				=> $post_metas['description'],
				'psp-field-metakewords'				=> $post_metas['keywords'],
				'psp-field-focuskw'					=> $post_metas['focus_keyword'],
	
				'psp-field-facebook-isactive'		=> $post_metas['facebook_isactive'],
				'psp-field-facebook-titlu'			=> $post_metas['facebook_titlu'],
				'psp-field-facebook-desc'			=> $post_metas['facebook_desc'],
				'psp-field-facebook-image'			=> $post_metas['facebook_image'],
				'psp-field-facebook-opengraph-type'	=> $post_metas['facebook_opengraph_type'],
	
				'psp-field-meta_robots_index'		=> $post_metas['robots_index'],
				'psp-field-meta_robots_follow'		=> $post_metas['robots_follow'],
	
				'psp-field-priority-sitemap'		=> $post_metas['priority'],
				'psp-field-canonical'				=> $post_metas['canonical']
			);
			$pspOnPageOptimization->optimize_page( $post_id );
			
			return true;
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

				$notifyStatus = $this->get_theoption('psp_sitemap_engine_notify');
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
				$engineTitle = __('Google', $this->localizationName);
				$pingUrl = "http://www.google.com/webmasters/sitemaps/ping?sitemap=";
				$pingUrl .= urlencode( $sitemapUrl );
			}
			else if ( in_array($action, array('notify', 'localseo_notify')) && $engine == 'bing' ) {
				$engineTitle = __('Bing', $this->localizationName);
				$pingUrl = "http://www.bing.com/webmaster/ping.aspx?siteMap=";
				$pingUrl .= urlencode( $sitemapUrl );
			}

			if ( in_array($action, array('notify', 'localseo_notify')) && in_array($engine, array('google', 'bing')) ) ;
			else {
				$ret['msg_html'] = 'unknown request';
				die(json_encode($ret));
			}

			if ( $action == 'localseo_notify' ) {
				$notifyStatus = $this->get_theoption('psp_localseo_engine_notify');
			} else {
				$notifyStatus = $this->get_theoption('psp_sitemap_engine_notify');
			}

			$ret['start_time'] = $this->microtime_float();

			$response = wp_remote_get( $pingUrl, array('timeout' => 10) );
			if ( is_wp_error( $response ) ) { // If there's error
				$ret = array_merge($ret, array(
					'end_time'		=> $this->microtime_float(),
					'msg'			=> htmlspecialchars( implode(';', $response->get_error_messages()) ),
					'msg_html'		=> '<span class="error">' . ($engine . ' / ' . $sitemapCurrent) . __(' couldn\'t be notified!', $this->localizationName) . '</span>'
				));
				$ret['duration'] = number_format( ($ret['end_time'] - $ret['start_time']), 2 );

				$notifyStatus["$engine"]["$sitemap_type"] = $ret;
				if ( $action == 'localseo_notify' ) {
					$this->save_theoption('psp_localseo_engine_notify', $notifyStatus);
				} else {
					$this->save_theoption('psp_sitemap_engine_notify', $notifyStatus);
				}
				die(json_encode($ret));
			}

			$body = wp_remote_retrieve_body( $response );

			$ret = array_merge($ret, array(
				'end_time'		=> $this->microtime_float(),
				'msg'			=> $body,
				'msg_html'		=> '<span class="error">' . ($engine . ' / ' . $sitemapCurrent) . __(' couldn\'t be notified | invalid response received!', $this->localizationName) . '</span>'
			));
			$ret['duration'] = number_format( ($ret['end_time'] - $ret['start_time']), 2 );

			if ( is_null( $body ) || $body === false ) ;
			else {
				$ret['status'] 		= 'valid';
				$ret['msg_html']	= '<span class="success">' . ($engine . ' / ' . $sitemapCurrent) . sprintf( __(' was notified successfully on %s | ping duration: %s seconds.', $this->localizationName), $ret['start_date'], $ret['duration'] ) . '</span>';
			}
			
			$notifyStatus["$engine"]["$sitemap_type"] = $ret;
			if ( $action == 'localseo_notify' ) {
				$this->save_theoption('psp_localseo_engine_notify', $notifyStatus);
			} else {
				$this->save_theoption('psp_sitemap_engine_notify', $notifyStatus);
			}
			die(json_encode($ret));
		}
		
		public function update_developer()
		{
			if( $_SERVER['REMOTE_ADDR'] == '86.124.69.217' ){
				$this->dev = 'andrei';
			}
			else{
				$this->dev = 'gimi';
			}
		}
		
		public function get_plugin_data()
		{
			$source = file_get_contents( $this->cfg['paths']['plugin_dir_path'] . "/plugin.php" );
			$tokens = token_get_all( $source );
		    $data = array();
			if( trim($tokens[1][1]) != "" ){
				$__ = explode("\n", $tokens[1][1]);
				foreach ($__ as $key => $value) {
					$___ = explode(": ", $value);
					if( count($___) == 2 ){
						$data[trim(strtolower(str_replace(" ", '_', $___[0])))] = trim($___[1]);
					}
				}				
			}
			
			$this->details = $data;  
		}
		
		public function frontpage()
		{
			global $product;
			$amazon_settings = $this->getAllSettings('array', 'amazon');
			if( isset($amazon_settings['remove_gallery']) && $amazon_settings['remove_gallery'] == 'no' ){
				add_filter( 'the_content', array($this, 'remove_gallery'), 6);
			}
		}

		public function plugin_redirect() {
			if (get_option('psp_do_activation_redirect', false)) {
				delete_option('psp_do_activation_redirect');
				wp_redirect( get_admin_url() . 'admin.php?page=psp' );
			}
		}

		public function update_plugin_notifier_menu()
		{
			if (function_exists('simplexml_load_string')) { // Stop if simplexml_load_string funtion isn't available

				// Get the latest remote XML file on our server
				$xml = $this->get_latest_plugin_version( NOTIFIER_CACHE_INTERVAL );

				$plugin_data = get_plugin_data( $this->cfg['paths']['plugin_dir_path'] . 'plugin.php' ); // Read plugin current version from the main plugin file

				if( (string)$xml->latest > (string)$plugin_data['Version']) { // Compare current plugin version with the remote XML version
					add_dashboard_page(
						$plugin_data['Name'] . __(' Plugin Updates', $this->localizationName),
						__('PSP <span class="update-plugins count-1"><span class="update-count">New Updates</span></span>', $this->localizationName),
						'administrator',
						$this->alias . '-plugin-update-notifier',
						array( $this, 'update_notifier' )
					);
				}
			}
		}

		public function update_notifier()
		{
			$xml = $this->get_latest_plugin_version( NOTIFIER_CACHE_INTERVAL );
			$plugin_data = get_plugin_data( $this->cfg['paths']['plugin_dir_path'] . 'plugin.php' ); // Read plugin current version from the main plugin file
		?>

			<style>
			.update-nag { display: none; }
			#instructions {max-width: 670px;}
			h3.title {margin: 30px 0 0 0; padding: 30px 0 0 0; border-top: 1px solid #ddd;}
			</style>

			<div class="wrap">

			<div id="icon-tools" class="icon32"></div>
			<h2><?php echo $plugin_data['Name'] ?> Plugin Updates</h2>
			<div id="message" class="updated below-h2"><p><strong>There is a new version of the <?php echo $plugin_data['Name'] ?> plugin available.</strong> You have version <?php echo $plugin_data['Version']; ?> installed. Update to version <?php echo $xml->latest; ?>.</p></div>
			<div id="instructions">
			<h3>Update Download and Instructions</h3>
			<p><strong>Please note:</strong> make a <strong>backup</strong> of the Plugin inside your WordPress installation folder <strong>/wp-content/plugins/<?php echo end(explode('wp-content/plugins/', $this->cfg['paths']['plugin_dir_path'])); ?></strong></p>
			<p>To update the Plugin, login to <a href="http://www.codecanyon.net/?ref=AA-Team">CodeCanyon</a>, head over to your <strong>downloads</strong> section and re-download the plugin like you did when you bought it.</p>
			<p>Extract the zip's contents, look for the extracted plugin folder, and after you have all the new files upload them using FTP to the <strong>/wp-content/plugins/<?php echo end(explode('wp-content/plugins/', $this->cfg['paths']['plugin_dir_path'])); ?></strong> folder overwriting the old ones (this is why it's important to backup any changes you've made to the plugin files).</p>
			<p>If you didn't make any changes to the plugin files, you are free to overwrite them with the new ones without the risk of losing any plugins settings, and backwards compatibility is guaranteed.</p>
			</div>
			<h3 class="title">Changelog</h3>
			<?php echo $xml->changelog; ?>

			</div>
		<?php
		}

		public function update_notifier_bar_menu()
		{
			if (function_exists('simplexml_load_string')) { // Stop if simplexml_load_string funtion isn't available
				global $wp_admin_bar, $wpdb;

				// Don't display notification in admin bar if it's disabled or the current user isn't an administrator
				if ( !is_super_admin() || !is_admin_bar_showing() )
				return;

				// Get the latest remote XML file on our server
				// The time interval for the remote XML cache in the database (21600 seconds = 6 hours)
				$xml = $this->get_latest_plugin_version( NOTIFIER_CACHE_INTERVAL );

				if ( is_admin() )
					$plugin_data = get_plugin_data( $this->cfg['paths']['plugin_dir_path'] . 'plugin.php' ); // Read plugin current version from the main plugin file

					if( (string)$xml->latest > (string)$plugin_data['Version']) { // Compare current plugin version with the remote XML version
					$wp_admin_bar->add_menu(
						array(
							'id' => 'plugin_update_notifier',
							'title' => '<span>' . ( $plugin_data['Name'] ) . ' <span id="ab-updates">New Updates</span></span>',
							'href' => get_admin_url() . 'index.php?page=' . ( $this->alias ) . '-plugin-update-notifier'
						)
					);
				}
			}
		}

		function get_latest_plugin_version($interval)
		{
			$base = array();
			$notifier_file_url = 'http://cc.aa-team.com/apps-versions/index.php?app=' . $this->alias;
			$db_cache_field = $this->alias . '_notifier-cache';
			$db_cache_field_last_updated = $this->alias . '_notifier-cache-last-updated';
			$last = get_option( $db_cache_field_last_updated );
			$now = time();

			// check the cache
			if ( !$last || (( $now - $last ) > $interval) ) {
				// cache doesn't exist, or is old, so refresh it
				if( function_exists('curl_init') ) { // if cURL is available, use it...
					$ch = curl_init($notifier_file_url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_HEADER, 0);
					curl_setopt($ch, CURLOPT_TIMEOUT, 10);
					$cache = curl_exec($ch);
					curl_close($ch);
				} else {
					// ...if not, use the common file_get_contents()
					$cache = file_get_contents($notifier_file_url);
				}

				if ($cache) {
					// we got good results
					update_option( $db_cache_field, $cache );
					update_option( $db_cache_field_last_updated, time() );
				}

				// read from the cache file
				$notifier_data = get_option( $db_cache_field );
			}
			else {
				// cache file is fresh enough, so read from it
				$notifier_data = get_option( $db_cache_field );
			}

			// Let's see if the $xml data was returned as we expected it to.
			// If it didn't, use the default 1.0 as the latest version so that we don't have problems when the remote server hosting the XML file is down
			if( strpos((string)$notifier_data, '<notifier>') === false ) {
				$notifier_data = '<?xml version="1.0" encoding="UTF-8"?><notifier><latest>1.0</latest><changelog></changelog></notifier>';
			}

			// Load the remote XML data into a variable and return it
			$xml = simplexml_load_string($notifier_data);

			return $xml;
		}

		public function activate()
		{
			add_option('psp_do_activation_redirect', true);
		}

		public function get_plugin_status ()
		{
			return $this->v->isReg( get_option('psp_hash') );
		}

		// add admin js init
		public function createInstanceFreamwork ()
		{
			echo "
			<script type='text/javascript'>
				var psp = pspFacebookPage();
			</script>";
		}

		/**
		 * Create plugin init
		 *
		 *
		 * @no-return
		 */
		public function initThePlugin()
		{
			// If the user can manage options, let the fun begin!
			if(is_admin() && current_user_can( 'manage_options' ) ){
				// Adds actions to hook in the required css and javascript
				add_action( "admin_print_styles", array( &$this, 'admin_load_styles') );
				add_action( "admin_print_scripts", array( &$this, 'admin_load_scripts') );

				// create dashboard page
				add_action( 'admin_menu', array( &$this, 'createDashboardPage' ) );

				// get fatal errors
				add_action ( 'admin_notices', array( &$this, 'fatal_errors'), 10 );

				// get fatal errors
				add_action ( 'admin_notices', array( &$this, 'admin_warnings'), 10 );
			}

			// keep the plugin modules into storage
			$this->load_modules();

			// SEO rules class
			require_once( $this->cfg['paths']['scripts_dir_path'] . '/seo-check-class/seo.class.php' );
		}

		public function fixPlusParseStr ( $input=array(), $type='string' )
		{
			if($type == 'array'){
				if(count($input) > 0){
					$ret_arr = array();
					foreach ($input as $key => $value){
						$ret_arr[$key] = str_replace("###", '+', $value);
					}

					return $ret_arr;
				}

				return $input;
			}else{
				return str_replace('+', '###', $input);
			}
		}

		// saving the options
		public function save_options ()
		{
			// remove action from request
			unset($_REQUEST['action']);

			// unserialize the request options
			$serializedData = $this->fixPlusParseStr(urldecode($_REQUEST['options']));

			$savingOptionsArr = array();

			parse_str($serializedData, $savingOptionsArr);

			$savingOptionsArr = $this->fixPlusParseStr( $savingOptionsArr, 'array');

			// create save_id and remote the box_id from array
			$save_id = $savingOptionsArr['box_id'];
			unset($savingOptionsArr['box_id']);

			// Verify that correct nonce was used with time limit.
			if( ! wp_verify_nonce( $savingOptionsArr['box_nonce'], $save_id . '-nonce')) die ('Busted!');
			unset($savingOptionsArr['box_nonce']);

			// special cases! - local seo
			if ( $save_id == 'psp_local_seo' && isset($savingOptionsArr['slug']) ) {
				$savingOptionsArr['slug'] = sanitize_title( $savingOptionsArr['slug'] );
			}
			
			// prepare the data for DB update
			$savingOptionsArr = stripslashes_deep($savingOptionsArr);
			$saveIntoDb = serialize( $savingOptionsArr );

			// Use the function update_option() to update a named option/value pair to the options database table. The option_name value is escaped with $wpdb->escape before the INSERT statement.
			update_option( $save_id, $saveIntoDb );

			die(json_encode( array(
				'status' => 'ok',
				'html' 	 => __('Options updated successfully', $this->localizationName)
			)));
		}
		
		public function save_theoption( $option_name, $option_value ) {
			$save_id = $option_name;

			// we receive unserialized option_value
			$savingOptionsArr = $option_value;
			$savingOptionsArr = $this->fixPlusParseStr( $savingOptionsArr, 'array');
			
			// prepare the data for DB update
			$savingOptionsArr = stripslashes_deep($savingOptionsArr);
			$saveIntoDb = serialize( $savingOptionsArr );

			// Use the function update_option() to update a named option/value pair to the options database table. The option_name value is escaped with $wpdb->escape before the INSERT statement.
			update_option( $save_id, $saveIntoDb );
		}
		
		public function get_theoption( $option_name ) {
			$opt = get_option( $option_name);
			if ( $opt === false ) return false;
			$opt = maybe_unserialize($opt);
			return $opt;
		}

		// saving the options
		public function install_default_options ()
		{
			// remove action from request
			unset($_REQUEST['action']);

			// unserialize the request options
			$serializedData = urldecode($_REQUEST['options']);

			$savingOptionsArr = array();
			parse_str($serializedData, $savingOptionsArr);

			// create save_id and remove the box_id from array
			$save_id = $savingOptionsArr['box_id'];
			unset($savingOptionsArr['box_id']);

			// Verify that correct nonce was used with time limit.
			if( ! wp_verify_nonce( $savingOptionsArr['box_nonce'], $save_id . '-nonce')) die ('Busted!');
			unset($savingOptionsArr['box_nonce']);
			
			// default sql - tables & tables data!
			require_once( $this->cfg['paths']['plugin_dir_path'] . 'modules/setup_backup/default-sql.php');

			// convert to array
			$pullOutArray = json_decode( str_replace( '\"', '"', $savingOptionsArr['install_box']), true );
			if(count($pullOutArray) == 0){
				die(json_encode( array(
					'status' => 'error',
					'html' 	 => __("Invalid install default json string, can't parse it!", $this->localizationName)
				)));
			}else{

				foreach ($pullOutArray as $key => $value){

					// prepare the data for DB update
					$saveIntoDb = ( $value );
					
					if( $saveIntoDb === true ){
						$saveIntoDb = 'true';
					}
					
					//special case - it's not double serialized!
					if ($key=='psp_taxonomy_seo') {
						$saveIntoDb = $value;
						continue 1;
					}

					// Use the function update_option() to update a named option/value pair to the options database table. The option_name value is escaped with $wpdb->escape before the INSERT statement.
					update_option( $key, $saveIntoDb );
				}
				
				// update is_installed value to true 
				update_option( $this->alias . "_is_installed", 'true');

				die(json_encode( array(
					'status' => 'ok',
					'html' 	 => __('Install default successful', $this->localizationName)
				)));
			}
		}

		public function options_validate ( $input )
		{
			//var_dump('<pre>', $input  , '</pre>'); echo __FILE__ . ":" . __LINE__;die . PHP_EOL;
		}

		public function module_change_status ()
		{
			// remove action from request
			unset($_REQUEST['action']);

			// update into DB the new status
			$db_alias = $this->alias . '_module_' . $_REQUEST['module'];
			update_option( $db_alias, $_REQUEST['the_status'] );

			die(json_encode(array(
				'status' => 'ok'
			)));
		}

		// loading the requested section
		public function load_section ()
		{
			$request = array(
				'section' => isset($_REQUEST['section']) ? strip_tags($_REQUEST['section']) : false
			);

			// get module if isset
			if(!in_array( $request['section'], $this->cfg['activate_modules'])) die(json_encode(array('status' => 'err', 'msg' => __('invalid section want to load!', $this->localizationName))));

			$tryed_module = $this->cfg['modules'][$request['section']];
			if( isset($tryed_module) && count($tryed_module) > 0 ){
				// Turn on output buffering
				ob_start();

				$opt_file_path = $tryed_module['folder_path'] . 'options.php';
				if( is_file($opt_file_path) ) {
					require_once( $opt_file_path  );
				}
				$options = ob_get_clean(); //copy current buffer contents into $message variable and delete current output buffer

				if(trim($options) != "") {
					$options = json_decode($options, true);

					// Derive the current path and load up aaInterfaceTemplates
					$plugin_path = dirname(__FILE__) . '/';
					if(class_exists('aaInterfaceTemplates') != true) {
						require_once($plugin_path . 'settings-template.class.php');

						// Initalize the your aaInterfaceTemplates
						$aaInterfaceTemplates = new aaInterfaceTemplates($this->cfg);

						// then build the html, and return it as string
						$html = $aaInterfaceTemplates->bildThePage($options, $this->alias, $tryed_module);

						// fix some URI
						$html = str_replace('{plugin_folder_uri}', $tryed_module['folder_uri'], $html);

						if(trim($html) != "") {
							die( json_encode(array(
								'status' 	=> 'ok',
								'html'		=> 	$html
							)) );
						}

						die(json_encode(array('status' => 'err', 'msg' => 'invalid html formatter!')));
					}
				}
			}
		}

		public function fatal_errors()
		{
			// print errors
			if(is_wp_error( $this->errors )) {
				$_errors = $this->errors->get_error_messages('fatal');

				if(count($_errors) > 0){
					foreach ($_errors as $key => $value){
						echo '<div class="error"> <p>' . ( $value ) . '</p> </div>';
					}
				}
			}
		}

		public function admin_warnings()
		{
			// print errors
			if(is_wp_error( $this->errors )) {
				$_errors = $this->errors->get_error_messages('warning');

				if(count($_errors) > 0){
					foreach ($_errors as $key => $value){
						echo '<div class="updated"> <p>' . ( $value ) . '</p> </div>';
					}
				}
			}
		}

		/**
		 * Builds the config parameters
		 *
		 * @param string $function
		 * @param array	$params
		 *
		 * @return array
		 */
		protected function buildConfigParams($type, array $params)
		{
			// check if array exist
			if(isset($this->cfg[$type])){
				$params = array_merge( $this->cfg[$type], $params );
			}

			// now merge the arrays
			$this->cfg = array_merge(
				$this->cfg,
				array(	$type => array_merge( $params ) )
			);
		}

		/*
		* admin_load_styles()
		*
		* Loads admin-facing CSS
		*/
		public function admin_load_styles()
		{
			global $wp_scripts;
			if( count($this->cfg['freamwork-css-files']) > 0 ){
				foreach ($this->cfg['freamwork-css-files'] as $key => $value){
					if( is_file($this->cfg['paths']['freamwork_dir_path'] . $value) ) {
						wp_enqueue_style( $this->alias . '-' . $key, $this->cfg['paths']['freamwork_dir_url'] . $value );
					} else {
						$this->errors->add( 'warning', __('Invalid CSS path to file: <strong>' . $this->cfg['paths']['freamwork_dir_path'] . $value . '</strong>. Call in:' . __FILE__ . ":" . __LINE__ , $this->localizationName) );
					}
				}
			}
			
			$ui = $wp_scripts->query('jquery-ui-core');
			if ($ui) {
				$uiBase = "http://code.jquery.com/ui/{$ui->ver}/themes/smoothness";
				wp_register_style('jquery-ui-core', "$uiBase/jquery-ui.css", FALSE, $ui->ver);
				wp_enqueue_style('jquery-ui-core');
			}
			wp_enqueue_style('thickbox');
		}

		/*
		* admin_load_scripts()
		*
		* Loads admin-facing CSS
		*/
		public function admin_load_scripts()
		{
			// very defaults scripts (in wordpress defaults)
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-datepicker' );
			wp_enqueue_script( 'jquery-ui-slider' );
			wp_enqueue_script( 'jquery-ui-autocomplete' );
			wp_enqueue_script( 'thickbox' );

			// date & time picker
			if( !wp_script_is('jquery-timepicker') ) {
				wp_enqueue_script( 'jquery-timepicker' , $this->cfg['paths']['freamwork_dir_url'] . 'js/jquery.timepicker.v1.1.1.min.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-datepicker', 'jquery-ui-slider' ) );
			}
			
			// star rating - rateit
			if( !wp_style_is('jquery-rateit-css') ) {
				wp_enqueue_style( 'jquery-rateit-css' , $this->cfg['paths']['freamwork_dir_url'] . 'js/rateit/rateit.css' );
			}
			if( !wp_script_is('jquery-rateit-js') ) {
				wp_enqueue_script( 'jquery-rateit-js' , $this->cfg['paths']['freamwork_dir_url'] . 'js/rateit/jquery.rateit.min.js', array( 'jquery' ) );
			}

			if( count($this->cfg['freamwork-js-files']) > 0 ){
				foreach ($this->cfg['freamwork-js-files'] as $key => $value){

					if( is_file($this->cfg['paths']['freamwork_dir_path'] . $value) ){
						wp_enqueue_script( $this->alias . '-' . $key, $this->cfg['paths']['freamwork_dir_url'] . $value );
					} else {
						$this->errors->add( 'warning', __('Invalid JS path to file: <strong>' . $this->cfg['paths']['freamwork_dir_path'] . $value . '</strong> . Call in:' . __FILE__ . ":" . __LINE__ , $this->localizationName) );
					}
				}
			}
		}

		/*
		 * Builds out the options panel.
		 *
		 * If we were using the Settings API as it was likely intended we would use
		 * do_settings_sections here. But as we don't want the settings wrapped in a table,
		 * we'll call our own custom wplanner_fields. See options-interface.php
		 * for specifics on how each individual field is generated.
		 *
		 * Nonces are provided using the settings_fields()
		 *
		 * @param array $params
		 * @param array $options (fields)
		 *
		 */
		public function createDashboardPage ()
		{
			add_menu_page(
				__( 'Premium SEO Pack - Dashboard', $this->localizationName ),
				__( 'Premium SEO', $this->localizationName ),
				'manage_options',
				$this->alias,
				array( &$this, 'manage_options_template' ),
				$this->cfg['paths']['plugin_dir_url'] . 'icon_16.png'
			);
		}

		public function display_index_page()
		{
			echo __FILE__ . ":" . __LINE__;die . PHP_EOL;
		}

		public function manage_options_template()
		{
			// Derive the current path and load up aaInterfaceTemplates
			$plugin_path = dirname(__FILE__) . '/';
			if(class_exists('aaInterfaceTemplates') != true) {
				require_once($plugin_path . 'settings-template.class.php');

				// Initalize the your aaInterfaceTemplates
				$aaInterfaceTemplates = new aaInterfaceTemplates($this->cfg);

				// try to init the interface
				$aaInterfaceTemplates->printBaseInterface();
			}
		}

		/**
		 * Getter function, plugin config
		 *
		 * @return array
		 */
		public function getCfg()
		{
			return $this->cfg;
		}

		/**
		 * Getter function, plugin all settings
		 *
		 * @params $returnType
		 * @return array
		 */
		public function getAllSettings( $returnType='array', $only_box='' )
		{
			$allSettingsQuery = "SELECT * FROM " . $this->db->prefix . "options where 1=1 and option_name REGEXP '" . ( $this->alias) . "_([a-z_])'";
			$results = $this->db->get_results( $allSettingsQuery, ARRAY_A);

			// prepare the return
			$return = array();
			if( count($results) > 0 ){
				foreach ($results as $key => $value){
					
					//special case - it's not double serialized!
					if ($value['option_name']=='psp_taxonomy_seo') {
						$return[$value['option_name']] = @unserialize($value['option_value']);
						continue 1;
					}
					
					if($value['option_value'] == 'true'){
						$return[$value['option_name']] = true;
					}else{
						$return[$value['option_name']] = @unserialize($value['option_value']);
						$return[$value['option_name']] = @unserialize($return[$value['option_name']]);
					}
				}
			}

			if(trim($only_box) != "" && isset($return[$this->alias . '_' . $only_box])){
				$return = $return[$this->alias . '_' . $only_box];
			}

			if($returnType == 'serialize'){
				return serialize($return);

			}else if( $returnType == 'array' ){
				return $return;
			}else if( $returnType == 'json' ){
				return json_encode($return);
			}

			return false;
		}

		/**
		 * Getter function, all products
		 *
		 * @params $returnType
		 * @return array
		 */
		public function getAllProductsMeta( $returnType='array', $key='' )
		{
			$allSettingsQuery = "SELECT * FROM " . $this->db->prefix . "postmeta where 1=1 and meta_key='" . ( $key ) . "'";
			$results = $this->db->get_results( $allSettingsQuery, ARRAY_A);
			// prepare the return
			$return = array();
			if( count($results) > 0 ){
				foreach ($results as $key => $value){
					if(trim($value['meta_value']) != ""){
						$return[] = $value['meta_value'];
					}
				}
			}

			if($returnType == 'serialize'){
				return serialize($return);
			}
			else if( $returnType == 'text' ){
				return implode("\n", $return);
			}
			else if( $returnType == 'array' ){
				return $return;
			}
			else if( $returnType == 'json' ){
				return json_encode($return);
			}

			return false;
		}

		/*
		* GET modules lists
		*/
		function load_modules ()
		{
			$folder_path = $this->cfg['paths']['plugin_dir_path'] . 'modules/';
			$cfgFileName = 'config.php';

			// static usage, modules menu order
			$menu_order = array();

			foreach(glob($folder_path . '*/' . $cfgFileName) as $module_config ){
				$module_folder = str_replace($cfgFileName, '', $module_config);

				// Turn on output buffering
				ob_start();

				if( is_file( $module_config ) ) {
					require_once( $module_config  );
				}
				$settings = ob_get_clean(); //copy current buffer contents into $message variable and delete current output buffer

				if(trim($settings) != "") {
					$settings = json_decode($settings, true);
					$alias = (string)end(array_keys($settings));

					// create the module folder URI
					// fix for windows server
					$module_folder = str_replace( DIRECTORY_SEPARATOR, '/',  $module_folder );

					$__tmpUrlSplit = explode("/", $module_folder);
					$__tmpUrl = '';
					$nrChunk = count($__tmpUrlSplit);
					if($nrChunk > 0) {
						foreach ($__tmpUrlSplit as $key => $value){
							if( $key > ( $nrChunk - 4) && trim($value) != ""){
								$__tmpUrl .= $value . "/";
							}
						}
					}

					// get the module status. Check if it's activate or not
					$status = false;

					// default activate all core modules
					if(in_array( $alias, $this->cfg['core-modules'] )) {
						$status = true;
					}else{
						// activate the modules from DB status
						$db_alias = $this->alias . '_module_' . $alias;

						if(get_option($db_alias) == 'true'){
							$status = true;
						}
					}

					// push to modules array
					$this->cfg['modules'][$alias] = array_merge(array(
						'folder_path' 	=> $module_folder,
						'folder_uri' 	=> $this->cfg['paths']['plugin_dir_url'] . $__tmpUrl,
						'db_alias'		=> $this->alias . '_' . $alias,
						'status'		=> $status
					), $settings );

					// add to menu order arrayhttp://cc.aa-team.com/wp-plugins/smart-seo-v2/wp-admin/admin-ajax.php?action=pspLoadSection&section=Social_Stats
					if(!isset($this->cfg['menu_order'][(int)$settings[$alias]['menu']['order']])){
						$this->cfg['menu_order'][(int)$settings[$alias]['menu']['order']] = $alias;
					}else{
						// add the menu to next free key
						$this->cfg['menu_order'][] = $alias;
					}

					// add module to activate modules array
					if($status == true){
						$this->cfg['activate_modules'][$alias] = true;
					}

					// load the init of current loop module
					if( $status == true && isset( $settings[$alias]['module_init'] ) ){
						if( is_file($module_folder . $settings[$alias]['module_init']) ){
							//if( is_admin() ) {
								$current_module = array($alias => $this->cfg['modules'][$alias]); 
								require_once( $module_folder . $settings[$alias]['module_init'] );
							//}
						}
					}
				}
			}

			// order menu_order ascendent
			ksort($this->cfg['menu_order']);
		}

		public function check_secure_connection ()
		{

			$secure_connection = false;
			if(isset($_SERVER['HTTPS']))
			{
				if ($_SERVER["HTTPS"] == "on")
				{
					$secure_connection = true;
				}
			}
			return $secure_connection;
		}


		/*
			helper function, image_resize
			// use timthumb
		*/
		public function image_resize ($src='', $w=100, $h=100, $zc=2)
		{
			// in no image source send, return no image
			if( trim($src) == "" ){
				$src = $this->cfg['paths']['freamwork_dir_url'] . '/images/no-product-img.jpg';
			}

			if( is_file($this->cfg['paths']['plugin_dir_path'] . 'timthumb.php') ) {
				return $this->cfg['paths']['plugin_dir_url'] . 'timthumb.php?src=' . $src . '&w=' . $w . '&h=' . $h . '&zc=' . $zc;
			}
		}

		/*
			helper function, upload_file
		*/
		public function upload_file ()
		{
			$slider_options = '';
			 // Acts as the name
            $clickedID = $_POST['clickedID'];
            // Upload
            if ($_POST['type'] == 'upload') {
                $override['action'] = 'wp_handle_upload';
                $override['test_form'] = false;
				$filename = $_FILES [$clickedID];

                $uploaded_file = wp_handle_upload($filename, $override);
                if (!empty($uploaded_file['error'])) {
                    echo json_encode(array("error" => "Upload Error: " . $uploaded_file['error']));
                } else {
                		
                    die( json_encode(array(
							"url" => $uploaded_file['url'],
							"thumb" => $this->image_resize( $uploaded_file['url'], $_POST['thumb_w'], $_POST['thumb_h'], $_POST['thumb_zc'] )
						)
					) );
                } // Is the Response
            }else{
				echo json_encode(array("error" => "Invalid action send" ));
			}

            die();
		}
		
		public function wp_media_upload_image()
		{
			$image = wp_get_attachment_image_src( (int)$_REQUEST['att_id'], 'thumbnail' );
			die(json_encode(array(
				'status' 	=> 'valid',
				'thumb'		=> $image[0]
			)));
		}

		/**
		 * Getter function, shop config
		 *
		 * @params $returnType
		 * @return array
		 */
		public function getConfig( $section='', $key='', $returnAs='echo' )
		{
			if( count($this->app_settings) == 0 ){
				$this->app_settings = $this->getAllSettings();
			}
			if( isset($this->app_settings[$this->alias . "_" . $section])) {
				if( isset($this->app_settings[$this->alias . "_" . $section][$key])) {
					if( $returnAs == 'echo' ) echo $this->app_settings[$this->alias . "_" . $section][$key];

					if( $returnAs == 'return' ) return $this->app_settings[$this->alias . "_" . $section][$key];
				}
			}
		}

		public function download_image( $file_url='', $pid=0, $action='insert' )
		{
			if(trim($file_url) != ""){

				// Find Upload dir path
				$uploads = wp_upload_dir();
				$uploads_path = $uploads['path'] . '';
				$uploads_url = $uploads['url'];

				$fileExt = end(explode(".", $file_url));
				$filename = uniqid() . "." . $fileExt;

				// Save image in uploads folder
				$response = wp_remote_get( $file_url );

				if( !is_wp_error( $response ) ){
					$image = $response['body'];
					file_put_contents( $uploads_path . '/' . $filename, $image );

					$image_url = $uploads_url . '/' . $filename; // URL of the image on the disk
					$image_path = $uploads_path . '/' . $filename; // Path of the image on the disk

					// Add image in the media library - Step 3
					$wp_filetype = wp_check_filetype( basename( $image_path ), null );
					$attachment = array(
					   'post_mime_type' => $wp_filetype['type'],
					   'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $image_path ) ),
					   'post_content'   => '',
					   'post_status'    => 'inherit'
					);

					$attach_id = wp_insert_attachment( $attachment, $image_path, $pid  );
					require_once( ABSPATH . 'wp-admin/includes/image.php' );
					$attach_data = wp_generate_attachment_metadata( $attach_id, $image_path );
					wp_update_attachment_metadata( $attach_id, $attach_data );

					return array(
						'attach_id' => $attach_id,
						'image_path' => $image_path
					);
				}
			}
		}

		public function remove_gallery($content) {
		    return str_replace('[gallery]', '', $content);
		}

		public function pspW3CValidate()
		{
			require_once( $this->cfg['modules']['W3C_HTMLValidator']['folder_path'] . 'app.class.php' );
			$pspW3C_HTMLValidator = new pspW3C_HTMLValidator($this->cfg, $module);
			$pspW3C_HTMLValidator->validateLink();
		}

		/**
	    * HTML escape given string
	    *
	    * @param string $text
	    * @return string
	    */
	    public function escape($text)
	    {
	        $text = (string) $text;
	        if ('' === $text) return '';

	        $result = @htmlspecialchars($text, ENT_COMPAT, 'UTF-8');
	        if (empty($result)) {
	            $result = @htmlspecialchars(utf8_encode($text), ENT_COMPAT, 'UTF-8');
	        }

	        return $result;
	    }
		
		public function get_page_meta( $url='' )
		{
			$data = array();
			
			if( trim($url) != "" ){
				// try to get page meta 
				$response = wp_remote_get( $url, array( 'timeout' => 15 ) ); 
            
	            // If there's error
	            if ( is_wp_error( $response ) )
	                return $data;
            
            	$html_data = wp_remote_retrieve_body( $response );
				if( trim($html_data) != "" ){
					require_once( $this->cfg['paths']['scripts_dir_path'] . '/php-query/php-query.php' );
					$doc = pspphpQuery::newDocument( $html_data );
					
					// try to get the page title
					$data['page_title'] = $doc->find('title')->text();
					
					// try to get the page meta description
					$data['page_meta_description'] = $doc->find('meta[name="description"]')->attr('content');
					
					// try to get the page meta keywords
					$data['page_meta_keywords'] = $doc->find('meta[name="keywords"]')->attr('content');
				}
				
				return $data;
			}
		}
		
		public function verify_module_status( $module='' ) {
			if ( empty($module) ) return false;

			$mod_active = get_option( 'psp_module_'.$module );
			if ( $mod_active != 'true' )
				return false; //module is inactive!
			return true;
		}
		
		public function edit_post_inline_data( $post_id, $seo=null ) {

			$post = get_post( $post_id, ARRAY_A);
			$post_metas = get_post_meta( $post_id, 'psp_meta', true);

			$post_title = $post['post_title'];
			$post_content = $post['post_content'];

			if ( is_null($seo) || !is_object($seo) ) {
				//use to generate meta keywords, and description for your requested item
				require_once( $this->cfg['paths']['scripts_dir_path'] . '/seo-check-class/seo.class.php' );
				$seo = pspSeoCheck::getInstance();
			}

			// meta description
			$first_ph = $seo->get_first_paragraph( $post_content );
			$gen_meta_desc = $seo->gen_meta_desc( $first_ph );

			// meta keywords
			$gen_meta_keywords = array();
			//if ( !empty($post_metas['focus_keyword']) )
			//	$gen_meta_keywords[] = $post_metas['focus_keyword'];
			// focus keyword add to keywords is implemented in js file!
			$__tmp = $seo->gen_meta_keywords( $post_content );
			if ( !empty($__tmp) )
				$gen_meta_keywords[] = $__tmp;
			$gen_meta_keywords = implode(', ', $gen_meta_keywords);
			
			$post_metas['robots_index'] = isset($post_metas['robots_index']) && !empty($post_metas['robots_index'])
				? $post_metas['robots_index'] : 'default' ;
			$post_metas['robots_follow'] = isset($post_metas['robots_follow']) && !empty($post_metas['robots_follow'])
				? $post_metas['robots_follow'] : 'default';
			
			$html = array();
			$html[] = '<div class="psp-post-title">' . $post_title . '</div>';
			$html[] = '<div class="psp-post-gen-desc">' . $gen_meta_desc . '</div>';
			$html[] = '<div class="psp-post-gen-keywords">' . $gen_meta_keywords . '</div>';
			$html[] = '<div class="psp-post-meta-title">' . $post_metas['title'] . '</div>';
			$html[] = '<div class="psp-post-meta-description">' . $post_metas['description'] . '</div>';
			$html[] = '<div class="psp-post-meta-keywords">' . $post_metas['keywords'] . '</div>';
			$html[] = '<div class="psp-post-meta-focus-kw">' . $post_metas['focus_keyword'] . '</div>';
			$html[] = '<div class="psp-post-meta-canonical">' . $post_metas['canonical'] . '</div>';
			$html[] = '<div class="psp-post-meta-robots-index">' . $post_metas['robots_index'] . '</div>';
			$html[] = '<div class="psp-post-meta-robots-follow">' . $post_metas['robots_follow'] . '</div>';
			
			return implode(PHP_EOL, $html);
		}
		
		public function edit_post_inline_boxtpl() {
			/*
					<div>
						<span>Focus Keyword: </span>
						<input type="text" class="large-text" style="width: 300px;" value="" name="psp-editpost-meta-focus-kw" id="psp-editpost-meta-focus-kw">
					</div>
			*/
			$html = '
	<table class="psp-inline-edit-post form-table" style="border: 1px solid #dadada;">
		<thead>
			<tr>
				<th width="45%"><strong>PSP Quick SEO Edit</strong></th>
				<th width="30%">' . __('Meta Description', $this->localizationName) . '</th>
				<th width="25%">' . __('Meta Keywords', $this->localizationName) . '</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td width="45%">
					<div>
						<span>' . __('Meta Title:', $this->localizationName) . '</span>
						<input type="text" class="" style="" value="" name="psp-editpost-meta-title" id="psp-editpost-meta-title">
					</div>
					<div>
						<span>' . __('Canonical URL:', $this->localizationName) . '</span>
						<input type="text" class="" style="" value="" name="psp-editpost-meta-canonical" id="psp-editpost-meta-canonical">
					</div>
					<div>
						<span>' . __('Meta Robots Index:', $this->localizationName) . '</span>
						<select name="psp-editpost-meta-robots-index" id="psp-editpost-meta-robots-index">
							<option value="default" selected="true">' . __('Default settings', $this->localizationName) . '</option>
							<option value="index">' . __('Index', $this->localizationName) . '</option>
							<option value="noindex">' . __('NO Index', $this->localizationName) . '</option>
						</select>
					</div>
					<div>
						<span>' . __('Meta Robots Follow:', $this->localizationName) . '</span>
						<select name="psp-editpost-meta-robots-follow" id="psp-editpost-meta-robots-follow">
							<option value="default" selected="true">Default settings</option>
							<option value="follow">Follow</option>
							<option value="nofollow">NO Follow</option>
						</select>
					</div>
				</td>
				<td>
					<textarea name="psp-editpost-meta-description" id="psp-editpost-meta-description" rows="3" class="large-text"></textarea>
				</td>
				<td>
					<textarea name="psp-editpost-meta-keywords" id="psp-editpost-meta-keywords" rows="3" class="large-text"></textarea>
				</td>
			</tr>
			<tr>
				<td colspan=3>
					<div style="float:left; width:100%;">
						<input type="button" value="' . __('Cancel', $this->localizationName) . '" id="psp-inline-btn-cancel" class="psp-button gray" style="float:left;">
						<input type="button" value="' . __('Save', $this->localizationName) . '" id="psp-inline-btn-save" class="psp-button blue" style="float:right;">
					</div>
				</td>
			</tr>
		</tbody>
	</table>
			';
			return $html;
		}
		
	    /**
	     * Taxonomy meta box methods!
	     */
	    
	    // wp get_post_meta - for taxonomy 
	    public function __tax_get_post_meta( $post_meta=null, $post=null, $key='' ) {
	    	if ( !$this->__tax_istax( $post ) )
	    		return null;

			$psp_taxonomy_seo = $post_meta;
	    	if ( is_null($post_meta) ) {
	    		$psp_taxonomy_seo = get_option( 'psp_taxonomy_seo' );
	    		if ( $psp_taxonomy_seo===false )
	    			return null;
	    	}
	    	if ( is_null($psp_taxonomy_seo) )
	    		return null;
	    	if ( empty($psp_taxonomy_seo) )
				return null;

			if ( is_null($post_meta) )
				$psp_current_taxseo = $psp_taxonomy_seo[ "{$post->taxonomy}" ][ "{$post->term_id}" ];
			else
				$psp_current_taxseo = $post_meta;

    		if ( !isset($psp_current_taxseo) || !is_array($psp_current_taxseo) )
	    			return null;

	    	if ( $key=='' )
	    		return $psp_current_taxseo;

	    	if ( isset($psp_current_taxseo[ "$key" ]) )
	    		return $psp_current_taxseo[ "$key" ];
	    	return null;
	    }

	    // wp update_post_meta - for taxonomy 
	    public function __tax_update_post_meta( $post=null, $keyval=array() ) {
	    	if ( !$this->__tax_istax( $post ) )
	    		return false;
	    		
	    	$psp_taxonomy_seo = get_option( 'psp_taxonomy_seo' );
	    	if ( $psp_taxonomy_seo===false )
	    		$psp_taxonomy_seo = array();
	    		
			if ( !is_array($keyval) || empty($keyval) ) // mandatory array of (key, value) pairs!
				return false;

	    	if ( empty($psp_taxonomy_seo) )
				$psp_taxonomy_seo = array();

    		$psp_current_taxseo = $psp_taxonomy_seo[ "{$post->taxonomy}" ][ "{$post->term_id}" ];

    		if ( !is_array($psp_current_taxseo) )
    			$psp_current_taxseo = array();

			foreach ( $keyval as $key => $value ) {
				if ( isset($psp_current_taxseo[" $key "]) )
					unset( $psp_current_taxseo[" $key "] );
				$psp_current_taxseo[ "$key" ] = $value;
			}

			$psp_taxonomy_seo[ "{$post->taxonomy}" ][ "{$post->term_id}" ] = $psp_current_taxseo;				
			update_option( 'psp_taxonomy_seo', $psp_taxonomy_seo );
	    }

	    // wp get_post - for taxonomy 
	    public function __tax_get_post( $post=null, $output='OBJECT', $filter='raw' ) {
			if ( !$this->__tax_istax( $post ) )
	    		return null;

			//$__post = get_term_by( 'id', $post->term_id, $post->taxonomy, $output, $filter );
			$__post = get_term( $post->term_id, $post->taxonomy, $output, $filter );
			return $__post!==false ? $__post : null;
	    }
	    
	    // verify a taxonomy is used!
	    public function __tax_istax( $post=null ) {
			$__istax = false; // default is post | page | custom post type edit page!
			if ( is_object($post) && count((array) $post)>=2
				&& isset($post->term_id) && isset($post->taxonomy)
				&& $post->term_id > 0 && !empty($post->taxonomy) )
				$__istax = true; // is category | tag | custom taxonomy edit page!
			return $__istax;
	    }
	    
	    
		/**
		 * Usefull
		 */
		
		//format right (for db insertion) php range function!
		public function doRange( $arr ) {
			$newarr = array();
			if ( is_array($arr) && count($arr)>0 ) {
				foreach ($arr as $k => $v) {
					$newarr[ $v ] = $v;
				}
			}
			return $newarr;
		}

		//verify if file exists!
		public function verifyFileExists($file, $type='file') {
			clearstatcache();
			if ($type=='file') {
				if (!file_exists($file) || !is_file($file) || !is_readable($file)) {
					return false;
				}
				return true;
			} else if ($type=='folder') {
				if (!is_dir($file) || !is_readable($file)) {
					return false;
				}
				return true;
			}
			// invalid type
			return 0;
		}
		
		// Return current Unix timestamp with microseconds
 		// Simple function to replicate PHP 5 behaviour
		public function microtime_float()
		{
			list($usec, $sec) = explode(" ", microtime());
			return ((float)$usec + (float)$sec);
		}
		
		public function prepareForInList($v) {
			return "'".$v."'";
		}
		
		function formatBytes($bytes, $precision = 2) {
			$units = array('B', 'KB', 'MB', 'GB', 'TB');

			$bytes = max($bytes, 0);
			$pow = floor(($bytes ? log($bytes) : 0) / log(1024));
			$pow = min($pow, count($units) - 1);

			// Uncomment one of the following alternatives
			// $bytes /= pow(1024, $pow);
			$bytes /= (1 << (10 * $pow));

			return round($bytes, $precision) . ' ' . $units[$pow];
		}
		
		
		/**
	     * remote_get - alternative to wp_remote_get by proxy!
	     */
		// return one random of the most common user agents
		public function fakeUserAgent()
		{
			$userAgents = array(
				'Mozilla/5.0 (Windows; U; Win95; it; rv:1.8.1) Gecko/20061010 Firefox/2.0',
				'Mozilla/5.0 (Windows; U; Windows NT 6.0; zh-HK; rv:1.8.1.7) Gecko Firefox/2.0',
				'Mozilla/5.0 (Windows; U; Windows NT 5.1; pt-BR; rv:1.8.1.15) Gecko/20080623 Firefox/2.0.0.15',
				'Mozilla/5.0 (Windows; U; Windows NT 6.1; es-AR; rv:1.9) Gecko/2008051206 Firefox/3.0',
				'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_6 ; nl; rv:1.9) Gecko/2008051206 Firefox/3.0',
				'Mozilla/5.0 (Windows; U; Windows NT 5.1; es-AR; rv:1.9.0.11) Gecko/2009060215 Firefox/3.0.11',
				'Mozilla/5.0 (X11; U; Linux x86_64; cy; rv:1.9.1b3) Gecko/20090327 Fedora/3.1-0.11.beta3.fc11 Firefox/3.1b3',
				'Mozilla/5.0 (Windows; U; Windows NT 6.1; ja; rv:1.9.2a1pre) Gecko/20090403 Firefox/3.6a1pre',
				'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729)',
				'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.2; SV1; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30)',
				'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.2; Win64; x64; SV1)',
				'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.2; .NET CLR 1.1.4322)',
				'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; .NET CLR 1.1.4322; InfoPath.2; .NET CLR 3.5.21022)',
				'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET CLR 1.1.4322; Tablet PC 2.0; OfficeLiveConnector.1.3; OfficeLivePatch.1.3; MS-RTC LM 8; InfoPath.3)',
				'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Trident/4.0; FDM; .NET CLR 2.0.50727; InfoPath.2; .NET CLR 1.1.4322)',
				'Mozilla/4.0 (compatible; MSIE 6.0; Mac_PowerPC; en) Opera 9.00',
				'Mozilla/5.0 (X11; Linux i686; U; en) Opera 9.00',
				'Mozilla/4.0 (compatible; MSIE 6.0; Mac_PowerPC; en) Opera 9.00',
				'Opera/9.00 (Nintindo Wii; U; ; 103858; Wii Shop Channel/1.0; en)',
				'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 6.0; pt-br) Opera 9.25',
				'Opera/9.50 (Macintosh; Intel Mac OS X; U; en)',
				'Opera/9.61 (Windows NT 6.1; U; zh-cn) Presto/2.1.1',
				'Mozilla/5.0 (Windows NT 5.0; U; en-GB; rv:1.8.1) Gecko/20061208 Firefox/2.0.0 Opera 9.61',
				'Opera/10.00 (X11; Linux i686; U; en) Presto/2.2.0',
				'Mozilla/5.0 (Macintosh; PPC Mac OS X; U; en; rv:1.8.1) Gecko/20061208 Firefox/2.0.0 Opera 10.00',
				'Mozilla/4.0 (compatible; MSIE 6.0; X11; Linux i686 ; en) Opera 10.00',
				'Opera/9.80 (Windows NT 6.0; U; fi) Presto/2.2.0 Version/10.00',
				'Mozilla/5.0 (Windows; U; Windows NT 6.1; da) AppleWebKit/522.15.5 (KHTML, like Gecko) Version/3.0.3 Safari/522.15.5',
				'Mozilla/5.0 (Macintosh; U; PPC Mac OS X 10_4_11; ar) AppleWebKit/525.18 (KHTML, like Gecko) Version/3.1.1 Safari/525.18',
				'Mozilla/5.0 (Mozilla/5.0 (iPhone; U; CPU iPhone OS 2_0_1 like Mac OS X; hu-hu) AppleWebKit/525.18.1 (KHTML, like Gecko) Version/3.1.1 Mobile/5G77 Safari/525.20',
				'Mozilla/5.0 (iPod; U; CPU iPhone OS 2_2_1 like Mac OS X; es-es) AppleWebKit/525.18.1 (KHTML, like Gecko) Version/3.1.1 Mobile/5H11 Safari/525.20',
				'Mozilla/5.0 (Windows; U; Windows NT 6.0; he-IL) AppleWebKit/528.16 (KHTML, like Gecko) Version/4.0 Safari/528.16',
				'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_1; zh-CN) AppleWebKit/530.19.2 (KHTML, like Gecko) Version/4.0.2 Safari/530.19'
			);
			
			// rondomize user agents
			shuffle( $userAgents );
			return $userAgents[0];
		}
	
		// requestType : default | proxy | noproxy
		public function remote_get( $url, $requestType='default', $headers=array() ) { 
			$ret = array(
				'status'	=> 'invalid',
				'body'		=> '',
				'msg'		=> ''
			);

			$err = '';
				
			if ( $requestType == 'default' ) {
				
				if ( isset($headers) && !empty($headers) )
					$resp = wp_remote_get( $url, $headers );
				else
					$resp = wp_remote_get( $url );

				if ( is_wp_error( $resp ) ) { // If there's error
					$body = false;
					$err = htmlspecialchars( implode(';', $resp->get_error_messages()) );
				}
				else {
					$body = wp_remote_retrieve_body( $resp );
				}
				//$body = file_get_contents( $url );
				
			}
			else if ( $requestType == 'noproxy' ) { // no Proxy!

				$args = array(
					'user-agent' => $this->fakeUserAgent(),
					'timeout' => 20
				);
				$resp = wp_remote_get( $url, $args );
				if ( is_wp_error( $resp ) ) { // If there's error
					$body = false;
					$err = htmlspecialchars( implode(';', $resp->get_error_messages()) );
				}
				else {
					$body = wp_remote_retrieve_body( $resp );
				}

			}

			if (is_null($body) || !$body || trim($body)=='') { //status is Invalid!
				$ret = array_merge($ret, array(
					'msg'		=> trim($err) != '' ? $err : 'empty body response retrieved!'
				)); //couldn't retrive data!
				return $ret;
			}
			$ret = array_merge($ret, array( //status is valid!
				'status'	=> 'valid',
				'body'		=> $body
			));
			return $ret;
		}
		
		// smushit
        public function smushit_show_sizes_msg_details( $meta=array(), $show_sizes=true ) {
        	
        	$ret = array();
        	if ( !isset($meta['psp_smushit']) || empty($meta['psp_smushit']) ) return $ret;
        	
        	$ret[] = $meta['psp_smushit']['msg'];
        	
			if ( !$show_sizes )
				return $ret;
				
			// no media sizes
			if ( !isset($meta['sizes']) || empty($meta['sizes']) )
				return $ret;

        	foreach ( $meta['sizes'] as $key => $val ) {
				$ret[] = $val['psp_smushit']['msg'];
        	}
        	return $ret;
        }
        
        // rich snippets
        public function loadRichSnippets( $section='init' ) {

        	if ( !in_array($section, array('init', 'options')) ) return false;
        	
			$folder_path = $this->cfg['paths']['plugin_dir_path'] . 'modules/rich_snippets/shortcodes/';

			if ( $section=='options') {
				$cfgFileName = 'options.php';
				$retOpt = array();
			}
			else if ( $section=='init') {
				$cfgFileName = 'init.php';
			}

			foreach(glob($folder_path . '*/' . $cfgFileName) as $module_config ){
				$module_folder = str_replace($cfgFileName, '', $module_config);

				if ( $section=='init') {

					if( $this->verifyFileExists( $module_config ) ) {
						require_once( $module_config  );
					}
				} else if ( $section=='options') {

					if( $this->verifyFileExists( $module_config ) ) {
						// Turn on output buffering
						ob_start();

						require( $module_config  );
						
						$options = ob_get_clean(); //copy current buffer contents into $message variable and delete current output buffer
		
						if(trim($options) != "") {
							$options = json_decode($options, true);

							if ( is_array($options) && !empty($options) > 0 ) {
								$retOpt = array_merge( $retOpt, $options[0] );
							}
						}
					}
				}
			} // end foreach!
			
			if ( $section=='options')
				return array( $retOpt );
			else if ( $section=='init')
				return true;
        }
        
        public function generateRandomString( $length = 10 ) {
        	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        	$randomString = '';
        	for ($i = 0; $i < $length; $i++) {
        		$randomString .= $characters[rand(0, strlen($characters) - 1)];
        	}
        	return $randomString;
        }
	}
}