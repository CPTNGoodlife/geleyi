<?php

// automatic updates
require 'plugin-updates/plugin-update-checker.php';
$MyUpdateChecker = new PluginUpdateChecker(
    'http://members.hybrid-connect.com/dl-93Hd2v/hybridupdates.json',
    __FILE__,
    'hybrid-connect'
);

DEFINE('HYBRIDCONNECT_ROOTDIR', dirname(__FILE__));
DEFINE('HYBRIDCONNECT_CSS_PATH_ADMIN', WP_PLUGIN_URL . '/hybridconnect/css/hc_admin.css');
DEFINE('HYBRIDCONNECT_CSS_PATH_META', WP_PLUGIN_URL . '/hybridconnect/css/hc_meta.css');
DEFINE('HYBRIDCONNECT_JS_PATH_ADMIN_STATS', WP_PLUGIN_URL . '/hybridconnect/js/hc_admin_panel_stats.js');
DEFINE('HYBRIDCONNECT_JS_PATH_ADMIN_LICENSE', WP_PLUGIN_URL . '/hybridconnect/js/hc_admin_license.js');
DEFINE('HYBRIDCONNECT_JS_PATH_ADMIN', WP_PLUGIN_URL . '/hybridconnect/js/hc_admin_panel.js');
DEFINE('HYBRIDCONNECT_JS_PATH_ADMIN_SERVICES', WP_PLUGIN_URL . '/hybridconnect/js/hc_admin_panel_services.js');
DEFINE('HYBRIDCONNECT_JS_PATH_META', WP_PLUGIN_URL . '/hybridconnect/js/hc_admin_meta.js');
DEFINE('HYBRIDCONNECT_JS_COLORPICKER_PATH_ADMIN', WP_PLUGIN_URL . '/hybridconnect/js/jscolor.js');
DEFINE('HYBRIDCONNECT_JS_PATH_SHORTCODE', WP_PLUGIN_URL . '/hybridconnect/js/hc_shortcode_main.js');
DEFINE('HYBRIDCONNECT_IAMGES_PATH', WP_PLUGIN_URL . '/hybridconnect/images');
DEFINE('HYBRIDCONNECT_CSS_PATH_TEMPLATES', WP_PLUGIN_URL . '/hybridconnect/css');
DEFINE('HYBRIDCONNECT_JS_JQPLOT', WP_PLUGIN_URL . '/hybridconnect/js/jqplot');
DEFINE('HYBRIDCONNECT_JS_PATH', WP_PLUGIN_URL . '/hybridconnect/js');
DEFINE('HYBRIDCONNECT_JS_JQCOLORS', WP_PLUGIN_URL . '/hybridconnect/js/claviska-jquery-miniColors');
global $hc_version;
global $already_lightbox;
global $already_slidein;
$hc_version = 1.81;
$already_lightbox=false;
$already_slidein=false;


/*
  Plugin Name: Hybrid Connect
  Plugin URI: http://hybrid-connect.com/
  Version: v1.81
  Author: <a href="http://hybrid-connect.com/">Hybrid Connect Team</a>
  Description: Increases signup conversion rates to your mailing list by combining the power of facebook connect and normal email signup forms for your blog.  Design unique and eye catching opt in forms and capture leads for the most popular autoresponder services and Gotowebinar in one plugin.
 */

$myhybridConnect = new HybridConnect;
//include and register the widget
include 'hc_widget.php';
add_action('widgets_init', create_function('', 'return register_widget("HybridConnect_Widget");'));

class HybridConnect {

    function HybridConnect() {
        $this->__construct();
    }

    function __construct() {

        //activation error capturing
        $showActivationErrors = true;
        if ($showActivationErrors) {
            add_action('activated_plugin', 'save_error');
            if (!function_exists('save_error')) {

                function save_error() {
                    update_option('hc_plugin_error_log', ob_get_contents());
                }

            }
        }
        add_action('wp_head', array($this, 'frontend_load_header'));
        add_action('admin_init', array($this, 'hc_meta_init'));
        //add_action('template_redirect', array($this, 'hc_template_redirect'));
        // add_filter('admin_head', array($this, 'ShowTinyMCE'));
        // add_action('admin_head', array($this, 'admin_add_style_js'));
        add_action('admin_menu', array($this, 'admin_navigation_menu'));
        // function to remove wpautop from shortcode content
        //SET UP AJAX ADMIN ACTIONS
        add_action('admin_enqueue_scripts', array($this, 'admin_add_style_jsenqueue'),100);
        add_action('wp_ajax_hc_admin_squeeze_page', array($this, 'admin_squeeze_page'));
        add_action('wp_ajax_hc_shortcode_style_panel', array($this, 'admin_shortcode_style_panel'));
        add_action('wp_ajax_hc_preview_shortcode', array($this, 'admin_preview_shortcode'));
        add_action('wp_ajax_hc_preview_widget', array($this, 'admin_preview_widget'));
        add_action('wp_ajax_update_hc_service_settings', array($this, 'admin_update_service_options'));
        add_action('wp_ajax_update_hc_affiliate_settings', array($this, 'admin_update_hc_affiliate_settings'));
        add_action('wp_ajax_update_hc_fb_settings', array($this, 'admin_update_facebook_options'));
        add_action('wp_ajax_update_hc_license_settings', array($this, 'admin_update_license_options'));
        add_action('wp_ajax_update_hc_connectors_table', array($this, 'admin_update_connectors_table'));
        add_action('wp_ajax_get_hc_connector_dialog', array($this, 'admin_add_new_connector_dialog'));
        add_action('wp_ajax_update_connector_data', array($this, 'admin_update_connector_data'));
        add_action('wp_ajax_remove_hc_connector', array($this, 'admin_remove_connector'));
        add_action('wp_ajax_duplicate_connector', array($this, 'admin_duplicate_connector'));
        add_action('wp_ajax_hc_duplicate_panel', array($this, 'admin_duplicate_panel'));
        add_action('wp_ajax_hc_phpsnippet_panel', array($this, 'admin_phpsnippet_panel'));
        add_action('wp_ajax_hc_mail_list_settings', array($this, 'admin_mail_list_settings'));
        add_action('wp_ajax_hc_webinar_settings', array($this, 'admin_webinar_settings'));
        add_action('wp_ajax_hc_update_mail_list_settings', array($this, 'admin_update_mail_list_settings'));
        add_action('wp_ajax_hc_update_webinar_settings', array($this, 'admin_update_webinar_settings'));
        add_action('wp_ajax_hc_remove_mail_list_settings', array($this, 'admin_remove_mail_list_settings'));
        add_action('wp_ajax_hc_remove_webinar_settings', array($this, 'admin_remove_webinar_settings'));
        add_action('wp_ajax_hc_update_footer_settings', array($this, 'admin_update_footer_settings'));
        add_action('wp_ajax_hc_shortcode_template_settings', array($this, 'admin_shortcode_template_settings'));
        add_action('wp_ajax_hc_shortcode_template_page', array($this, 'admin_shortcode_template_page'));
        add_action('wp_ajax_hc_widget_template_page', array($this, 'admin_widget_template_page'));
        add_action('wp_ajax_hc_update_shortcode_template_settings', array($this, 'admin_update_shortcode_template_settings'));
        add_action('wp_ajax_hc_load_from_templates_page', array($this, 'admin_load_from_templates_page'));
        add_action('wp_ajax_hc_widget_template_settings', array($this, 'admin_widget_template_settings'));
        add_action('wp_ajax_hc_update_widget_template_settings', array($this, 'admin_update_widget_template_settings'));
        add_action('wp_ajax_hc_get_service_list_settings', array($this, 'admin_get_service_list_settings'));
        add_action('wp_ajax_hc_get_stats_options', array($this, 'admin_get_stats_options'));
        add_action('wp_ajax_hc_custom_template_settings', array($this, 'admin_custom_template_settings'));
        add_action('wp_ajax_hc_update_custom_template_settings', array($this, 'admin_update_custom_template_settings'));
        add_action('wp_ajax_hc_update_constant_contact_options', array($this, 'admin_update_constant_contact_options'));
        add_action('wp_ajax_hc_lightbox_page', array($this, 'admin_lightbox_page'));
        add_action('wp_ajax_hc_lightbox_page2', array($this, 'admin_lightbox_page2'));
        add_action('wp_ajax_hc_admin_update_lightbox_settings', array($this, 'admin_update_lightbox_settings'));
        add_action('wp_ajax_hc_admin_update_connector_type', array($this, 'admin_update_connector_type'));
        add_action('wp_ajax_hc_save_as_new_template', array($this, 'hc_save_as_new_template'));
        add_action('wp_ajax_hc_load_user_template', array($this, 'hc_load_user_template'));
        add_action('wp_ajax_hc_update_templates_table', array($this, 'admin_update_templates_table'));
        add_action('wp_ajax_hc_remove_template', array($this, 'admin_remove_template'));
        add_action('wp_ajax_hc_admin_get_stats_container', array($this, 'admin_get_stats_contanier'));
        add_action('wp_ajax_hc_admin_get_variation_container', array($this, 'admin_get_variation_container'));
        add_action('wp_ajax_hc_admin_add_new_variation', array($this, 'admin_add_new_variation'));
        add_action('wp_ajax_hc_admin_delete_variation', array($this, 'admin_delete_variation'));
        add_action('wp_ajax_hc_admin_get_start_test_container', array($this, 'admin_get_start_test_container'));
        add_action('wp_ajax_hc_admin_start_test', array($this, 'admin_start_test'));
        add_action('wp_ajax_hc_admin_get_stop_test_container', array($this, 'admin_get_stop_test_container'));
        add_action('wp_ajax_hc_admin_stop_test', array($this, 'admin_stop_test'));
        add_action('wp_ajax_hc_admin_get_clear_data_container', array($this, 'admin_get_clear_data_container'));
        add_action('wp_ajax_hc_admin_clear_data', array($this, 'admin_clear_data'));
        add_action('wp_ajax_update_hc_tests_table', array($this, 'admin_update_tests_table'));
        add_action('wp_ajax_hc_admin_get_test_stats', array($this, 'admin_get_test_stats'));
        add_action('wp_ajax_hc_comment_footer_panel', array($this, 'admin_comment_footer_panel'));
        add_action('wp_ajax_hc_update_comment_footer_settings', array($this, 'update_comment_footer_settings'));
        add_action('wp_ajax_getFullRefererStats', array($this, 'get_full_referer_data'));
        //SET UP AJAX FRONTEND ACTIONS
        add_action('wp_ajax_nopriv_hc_frontend_submit_connector', array($this, 'hc_frontend_submit_connector'));
        add_action('wp_ajax_nopriv_hc_frontend_check_subscription', array($this, 'hc_frontend_check_subscription'));
        add_action('wp_enqueue_scripts', array($this, 'frontend_register_scripts'));
        add_action('wp_ajax_hc_frontend_submit_connector', array($this, 'hc_frontend_submit_connector'));
        add_action('wp_ajax_hc_frontend_check_subscription', array($this, 'hc_frontend_check_subscription'));
        add_action('wp_ajax_nopriv_hc_frontend_update_views', array($this, 'hc_frontend_update_views'));
        add_action('wp_ajax_hc_frontend_update_views', array($this, 'hc_frontend_update_views'));
        add_action('wp_ajax_hc_update_g2w_api', array($this, 'hc_update_g2w_api'));
        add_action('comment_form_before', array($this, 'hc_frontend_comment_placeholder'));
        add_action('activated_plugin', 'hc_save_error');
        add_filter('option_hc_comment_text', 'stripslashes');

        // post footer
        if(get_option("hc_comment_connector_id")!="false") {
          add_filter('comment_form_after_fields', array($this,'hc_frontend_comment_footer_optin'));
          add_action('comment_post',array($this,'hc_frontend_comment_subscription'));
          }

        // capture activation errors
        function hc_save_error() {
            global $wpdb;
            if (ob_get_contents() != "") {
                $my_t = getdate(date("U"));
                $currentDate = $my_t['weekday'] . ", " . $my_t['month'] . " " . $my_t['mday'] . ", " . $my_t['year'];
                $errorResult = $wpdb->insert('hc_activation_error_log', array(
                    'id' => '',
                    'date' => $currentDate,
                    'error_message' => ob_get_contents()), array(
                    '%d',
                    '%s',
                    '%s'));
            }
        }

        //ADD THE SHORTCODE HANDLER

        add_filter('the_content', array($this, 'hc_frontend_filter_content'),100);
        add_filter('the_content', array($this, 'do_php_shortcode_fix'),101);

        //THE INSTALLATION SCRIPT
        include_once 'tableInstall.php';
        register_activation_hook(__FILE__, 'install_tables');
        register_activation_hook(__FILE__, array($this, 'admin_check_facebook_on_activation'));
        register_deactivation_hook(__FILE__, 'delete_tables');
        
        // must check if fucntion exists first or may get fatal error
        if (!function_exists('squeezePageRedirect')) {
        function squeezePageRedirect() {
          global $wpdb;
          if (is_page()) {
           $thisPageID = get_the_ID();
           $squeezeArray = $wpdb->get_results("select distinct `single_page` from `hc_squeeze_options` where `squeeze_enabled`=1");
           foreach ($squeezeArray as $mySqueeze) {
             if ($mySqueeze->single_page != '' && $thisPageID == $mySqueeze->single_page) {
                  include(HYBRIDCONNECT_ROOTDIR . '/templates/squeezeTemplate.php');
                  die;
                }
               }
              }
            }
        }

        add_action('template_redirect', 'squeezePageRedirect');
        // for removing squeeze page conflicts that may occur
        add_action('wp_print_scripts', array($this,'squeeze_page_script_conflicts'),101);
    }

    function hc_update_g2w_api() {
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        if (isset($_POST['api_key'])) {
            update_option('hc_g2w_app_id', $_POST['api_key']);
            echo 1;
            die;
        }
        echo 0;
        die;
    }
    
    function squeeze_page_script_conflicts() {
     global $wpdb;
          if (is_page()) {
           $thisPageID = get_the_ID();
           $squeezeArray = $wpdb->get_results("select distinct `single_page` from `hc_squeeze_options` where `squeeze_enabled`=1");
           foreach ($squeezeArray as $mySqueeze) {
              if ($mySqueeze->single_page != '' && $thisPageID == $mySqueeze->single_page) {
                wp_deregister_script('javascript');
              }
             }
           }
         }

    // fix for PHP shortcode
    function do_php_shortcode_fix($content) {
        global $shortcode_tags;
        // save current shortcodes
        $old_shortcode_tags = $shortcode_tags;

        // remove all shortcodes, then re-add just our php and echo shortcodes
        unset($shortcode_tags);
        add_shortcode('hcshort', array($this, 'frontend_hybridConnect'));
        add_shortcode('hclightbox', array($this, 'frontend_hybridConnectLightbox'));
        add_shortcode('hcoptinbarbox', array($this, 'frontend_hybridConnectOptin'));
        add_shortcode('hcconversiontracking', array($this, 'frontend_hybridTrackConversion'));
        // echo $content;
        $content = do_shortcode($content);

        // and now put back the original shortcodes
        $shortcode_tags = $old_shortcode_tags;
        return $content;
    }

    function frontend_hybridConnect($atts) {
        // workaround for compatability with Striking theme
        remove_filter('the_content', 'my_formatter', 99);
        remove_filter('the_content', 'theme_formatter', 99);
        //remove_filter('the_content', 'wpautop');
        //remove_filter('the_excerpt', 'wpautop');

        extract(shortcode_atts(array('id' => ''), $atts));
        global $wpdb;
        global $post;
        $is_single = is_single() || $post->post_type == "page";
        $rss_use_excerpt = get_option('rss_use_excerpt');
        $my_connector = $wpdb->get_results("SELECT * FROM wp_connectors WHERE IntegrationID=" . $id);

        if (!isset($my_connector[0])) {
            return "Hybrid Connect Error : Connector could not be found";
        }

        $my_connector = $my_connector[0];

        $tpl_type = $wpdb->get_row("SELECT * FROM hc_tpl_types WHERE idConnector=" . $id . " AND type=0");

        if ($tpl_type->testing == 1) {
            $variation = $wpdb->get_row("SELECT * FROM hc_variations WHERE enabled=1 AND idConnector=" . $id . " AND type=0 ORDER BY RAND() LIMIT 0,1");
        } else {
            $variation = $wpdb->get_row("SELECT * FROM hc_variations WHERE idConnector=" . $id . " AND type=0 AND control=1");
        }

        $rand_id = rand(1000, 10000);
        $style_text = $wpdb->get_results("SELECT * FROM hc_style_text where id_connector=" . $id . " AND type=0 AND idVariation=" . $variation->id);
        $style_text = $style_text[0];
        $style_button = $wpdb->get_results("SELECT * FROM hc_style_button where id_connector=" . $id . " AND type=0 AND idVariation=" . $variation->id);
        $style_button = $style_button[0];
        $style_connector = $wpdb->get_results("SELECT * FROM hc_style_connector where id_connector=" . $id . " AND type=0 AND idVariation=" . $variation->id);
        $style_connector = $style_connector[0];
        $style_email = $wpdb->get_results("SELECT * FROM hc_style_email where id_connector=" . $id . " AND type=0 AND idVariation=" . $variation->id);
        $style_email = $style_email[0];
        $style_image = $wpdb->get_results("SELECT * FROM hc_style_image where id_connector=" . $id . " AND type=0 AND idVariation=" . $variation->id);
        $style_image = $style_image[0];
        $style_optin = $wpdb->get_results("SELECT * FROM hc_style_optin where id_connector=" . $id . " AND type=0 AND idVariation=" . $variation->id);
        $style_optin = $style_optin[0];
        $connector_txt = $wpdb->get_results("SELECT * FROM hc_connector_text where id_connector=" . $id . " AND type=0 AND idVariation=" . $variation->id);
        $connector_txt = $connector_txt[0];
        $connector_txt->optin_description = stripslashes($connector_txt->optin_description);
        //$connector_txt->optin_description = str_replace("style=", "temp=", $connector_txt->optin_description);
        $connector_txt->optin_headline = stripslashes($connector_txt->optin_headline);
        $connector_txt->email_call = stripslashes($connector_txt->email_call);
        $connector_txt->fb_call = stripslashes($connector_txt->fb_call);
        $connector_txt->oneclick_call = stripslashes($connector_txt->oneclick_call);
        $connector_txt->email_btn = stripslashes($connector_txt->email_btn);
        $connector_txt->fb_btn = stripslashes($connector_txt->fb_btn);
        $connector_txt->oneclick_btn = stripslashes($connector_txt->oneclick_btn);
        $hc_is_footer = false;
        //OLD CALL FOR SELECTING A SPECIFIC TEMPLATE
        if ($my_connector->template_shortcode == "1") {
            $template_path = $this->_get_hc_template('custom');
        } else {
            $template_path = HYBRIDCONNECT_ROOTDIR . '/templates/template.php';
        }
        ob_start();
        include $template_path;
        $hc_content = ob_get_contents();

        ob_end_clean();
        return $hc_content;
    }
    
    function frontend_hybridTrackConversion($atts) {
      // This shortcode is desgined to be used on the thank you pages for products that people are selling on their site
      // product = name of the product that is being sold
      // value = value amount of the product being sold
      // this function checks to see if a conversion has already been logged.  If not then stores results in database.
      // duplicated conversions will not be logged with ip tracking and cookie check
      
      global $wpdb;
      extract(shortcode_atts(array('product' => '', 'value' => ''), $atts));
      // if product name or value not set then output error message and do not further action
      if(empty($product) || empty ($value)) {
        echo "Conversion tracking is not running because either the product name or the product value has not been set";
        return false;
      }
      // conversion tracking doesn't happen if user is logged in as an admin (or has permission to moderate comments)
      if (current_user_can('moderate_comments')) { return false; }
      
      $hcTrueConversion=$this->_checkUniqueConversion($product,$value);
       if($hcTrueConversion) {
         if($_COOKIE['hc_converted']!='1') {   // check to see if already registered as conversion by checking cookies
         // if subscription tracking then use that as tracking code else if direct purchase use non subscription tracking
          if($_COOKIE['hc_tracking_subscribed']!='')
          { $thisConversionTracking=$_COOKIE['hc_tracking_subscribed']; } else
          { $thisConversionTracking=$_COOKIE['hc_tracking']; }
        // valid conversion - insert into database
        $query=$wpdb->insert("hc_conversion_tracking", array(
        'id' => '',
        'trackingcode' => $thisConversionTracking,
        'emailonly' => $_COOKIE['hc_emailonly'],
        'date' => date('Y-m-d H:i:s'),
        'value' => $value,
        'product' => $product,
        'customtrackcode' => $_COOKIE['hc_custom_track'],
        'ipaddress' => $_SERVER['REMOTE_ADDR']
        ), array(
        '%d','%s','%d','%s','%d','%s','%s','%s'));
        // set cookie to track conversion and avoid duplicate stats
        setcookie('hc_converted', '1',time() + (86400 * 7 * 416)); // 8 year cookie
      }
    }
    }
    
  function _checkUniqueConversion($product,$value) {
        global $wpdb;
        // check to see if conversion for this ip address has already happened for product and value amount
        $query = "SELECT * FROM hc_conversion_tracking WHERE product='" . $product . "' AND ipaddress LIKE '%" . $_SERVER['REMOTE_ADDR'] . "%' AND value = '" . $value . "'";
        $rez = $wpdb->get_row($query);
        if ($rez) {
            return false;   // conversion not valid
        }
        return true;   // conversion valid
    }

    function frontend_hybridConnectLightbox($atts) {
        // workaround for compatability with Striking theme
        remove_filter('the_content', 'my_formatter', 99);
        remove_filter('the_content', 'theme_formatter', 99);
        extract(shortcode_atts(array('id' => '', 'text' => ''), $atts));
        global $wpdb;
        global $post;
        $my_connector = $wpdb->get_results("SELECT * FROM wp_connectors WHERE IntegrationID=" . $id);
        if (!isset($my_connector[0])) {
            return;
        }
        $lightbox_options = $wpdb->get_results("SELECT * FROM hc_lightbox_options where id_connector=" . $id);
        if (!isset($lightbox_options[0])) {
            return;
        }

        // remove triggers from object when shortcode added
        $lightbox_options[0]->time_enable = "0";
        $lightbox_options[0]->scroll_enable = "0";

        $lightbox_content = $this->hc_frontend_display_lightbox($lightbox_options[0], $my_connector[0], true, $text, "lightbox");

        return $lightbox_content;
    }

    function frontend_hybridConnectOptin($atts) {
        // workaround for compatability with Striking theme
        remove_filter('the_content', 'my_formatter', 99);
        remove_filter('the_content', 'theme_formatter', 99);
        extract(shortcode_atts(array('id' => '', 'text' => ''), $atts));
        global $wpdb;
        global $post;
        $my_connector = $wpdb->get_results("SELECT * FROM wp_connectors WHERE IntegrationID=" . $id);
        if (!isset($my_connector[0])) {
            return;
        }
        $lightbox_options = $wpdb->get_results("SELECT * FROM hc_lightbox_options where id_connector=" . $id);
        if (!isset($lightbox_options[0])) {
            return;
        }

        // remove triggers from object when shortcode added
        $lightbox_options[0]->time_enable = "0";
        $lightbox_options[0]->scroll_enable = "0";
        // make sure optin settings are pulled from the template
        $lightbox_content = $this->hc_frontend_display_lightbox($lightbox_options[0], $my_connector[0], true, $text, "optin");
        return $lightbox_content;
    }

    function admin_init() {
        
    }

    function admin_navigation_menu() {
        $icon_url = HYBRIDCONNECT_IAMGES_PATH . "/hc-admin-icon.png";
        add_menu_page("Hybrid Connect", "Hybrid Connect", 'administrator', 'hybridConnectNavPanel2', array($this, 'admin_hybridConnect'), $icon_url);
        add_submenu_page("hybridConnectNavPanel2", "Test History", "Test History", "administrator", "hybridConnectTestHistroy", array($this, "admin_hybridConnectTestHistory"));
        add_submenu_page('hybridConnectNavPanel2', 'Statistics', 'Statistics', 'administrator', 'hybridConnectAdminStats', array($this, 'admin_hybridConnectStats'));
        add_submenu_page('hybridConnectNavPanel2', 'Earn money with Hybrid Connect', 'Earn money with Hybrid Connect', 'administrator', 'hybridConnectAdminAffiliate', array($this, 'admin_hybridAffiliateSettings'));
        add_submenu_page('hybridConnectNavPanel2', 'Setup', 'Setup', 'administrator', 'hybridConnectAdminSetup', array($this, 'admin_setup'));
        add_submenu_page(null, 'Activation Error Log', 'Activation Error Log', 'administrator', 'errorLog', array($this, 'admin_hybrid_error_log'));
    }

    function admin_add_style_jsenqueue($hook) {
        GLOBAL $hc_version;
        $protocol = 'http:';
        if (!empty($_SERVER['HTTPS'])) {
            $protocol = 'https:';
        }
        if ($hook == 'toplevel_page_hybridConnectNavPanel2' || $hook == 'hybrid-connect_page_hybridConnectAdminSetup' || $hook == 'hybrid-connect_page_hybridConnectAdminStats' || $hook == 'hybrid-connect_page_hybridConnectAdminAffiliate' || $hook == 'hybrid-connect_page_hybridConnectTestHistroy') {
            // theme conflict fixes
            wp_deregister_script('jquery-value-slider');    // fix for cosmox theme - jquery value slider conflicts with jquery slider
            // deregister script for plugin conflicts
            // seo raptor pro
            wp_deregister_script('js1');
            wp_deregister_script('js2');
            wp_deregister_script('js3');
            wp_deregister_script('js4');
            wp_deregister_script('feature_box_script');
            // parallax slider - thesis plugin
            wp_deregister_script('parallax-slider-jquery');
            // jQuery
            wp_deregister_script('jquery');
            wp_register_script('jquery', HYBRIDCONNECT_JS_PATH . '/jquery-1.7.2.min.js?v=' . $hc_version);
            wp_enqueue_script('jquery');
            // jQuery UI - need to load jquery UI via CDN so deregister all wordpress jquery ui scripts that may conflict
            wp_deregister_script('jquery-ui-core');
            wp_deregister_script('jquery-ui-dialog');
            wp_deregister_script('jquery-ui-tabs');
            wp_deregister_script('jquery-ui-slider');
            wp_deregister_script('jquery-ui-widget');
            wp_deregister_script('jquery-ui-accordion');
            wp_deregister_script('jquery-ui-datepicker');
            wp_enqueue_script('jqueryUI', $protocol . '//ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js');
            wp_enqueue_script('jqueryUIWidget', HYBRIDCONNECT_JS_PATH . '/jquery.ui.widget.js');
            wp_enqueue_script('jqueryUICheckbox', HYBRIDCONNECT_JS_PATH . '/jquery.ui.checkbox.js');
            // CSS
            wp_enqueue_style('hcBackendCSS', HYBRIDCONNECT_CSS_PATH_ADMIN);
            wp_register_style('hc_backend_ui_css', HYBRIDCONNECT_CSS_PATH_TEMPLATES . '/south-street/jquery-ui-1.8.20.custom.css');
            wp_enqueue_style('hc_backend_ui_css');
            // Image path var
            echo "<script type='text/javascript'>var hc_admin_images_path='" . HYBRIDCONNECT_IAMGES_PATH . "';</script>";
            // TinyMCE
            wp_register_script('hc_tiny_mce', HYBRIDCONNECT_JS_PATH . '/tiny_mce.js');
            wp_enqueue_script('hc_tiny_mce');
            if (function_exists('add_thickbox'))
                add_thickbox();
            wp_print_scripts('media-upload');
            wp_admin_css();
        }
        if ($hook == 'toplevel_page_hybridConnectNavPanel2') {
            wp_enqueue_script('hcBackendAdminJS', HYBRIDCONNECT_JS_PATH_ADMIN . '?v=' . $hc_version);
            wp_enqueue_script('hcBackendColorpicker', HYBRIDCONNECT_JS_COLORPICKER_PATH_ADMIN . '?v=' . $hc_version);
            wp_enqueue_script('hcBackendSetup', HYBRIDCONNECT_JS_PATH . '/hc_admin_setup.js?v=' . $hc_version);
            wp_enqueue_script('hceasing', HYBRIDCONNECT_JS_PATH . '/jquery.easing.1.3.js?v=' . $hc_version);
        } else if ($hook == 'hybrid-connect_page_hybridConnectAdminSetup') {
            wp_enqueue_script('hcBackendAdminServices', HYBRIDCONNECT_JS_PATH_ADMIN_SERVICES . '?v=' . $hc_version);
            wp_enqueue_script('hcBackendSetup', HYBRIDCONNECT_JS_PATH . '/hc_admin_setup.js?v=' . $hc_version);
            wp_enqueue_script('hcBackendAdminLicense', HYBRIDCONNECT_JS_PATH_ADMIN_LICENSE . '?v=' . $hc_version);
        } else if ($hook == 'hybrid-connect_page_hybridConnectAdminStats') {
            wp_enqueue_script('hcBackendAdminStats', HYBRIDCONNECT_JS_PATH_ADMIN_STATS . '?v=' . $hc_version);
            wp_enqueue_script('hcBackendJQPlot', HYBRIDCONNECT_JS_JQPLOT . '/jquery.jqplot.min.js');
            wp_enqueue_script('hcBackendAxisRenderer', HYBRIDCONNECT_JS_JQPLOT . '/plugins/jqplot.dateAxisRenderer.min.js');
            wp_enqueue_style('hcBackendJQPlotCSS', HYBRIDCONNECT_JS_JQPLOT . '/jquery.jqplot.min.css');
        } else if ($hook == 'hybrid-connect_page_hybridConnectAdminAffiliate') {
            wp_enqueue_script('hcBackendAffiliate', HYBRIDCONNECT_JS_PATH . '/hc_admin_affiliate.js?v=' . $hc_version);
        }
        if ($hook == 'hybrid-connect_page_hybridConnectTestHistroy') {
            wp_enqueue_script('hcBackendAdminJS', HYBRIDCONNECT_JS_PATH_ADMIN . '?v=' . $hc_version);
            wp_enqueue_script('hcBackendColorpicker', HYBRIDCONNECT_JS_COLORPICKER_PATH_ADMIN . '?v=' . $hc_version);
            wp_enqueue_script('hcBackendSetup', HYBRIDCONNECT_JS_PATH . '/hc_admin_setup.js?v=' . $hc_version);
            wp_enqueue_script('hceasing', HYBRIDCONNECT_JS_PATH . '/jquery.easing.1.3.js?v=' . $hc_version);
        }
    }

    function admin_licensePanel() {
        global $wpdb;
        // $this->admin_add_style_js('license');
        include('includes/hc_admin_license.php');
    }

    function admin_setup() {
        //   $this->admin_add_style_js('setup');
        $ccontact_set = false;
        $ccontact_valid = false;
        if (isset($_GET['code']) && isset($_GET['username'])) {
            $ccontact_set = true;
            update_option('hc_constant_contact_username', $_GET['username']);
            update_option('hc_constant_contact_code', $_GET['code']);
            if (!class_exists("ConstantContact")) {
                require_once('includes/apis/CTCT-OAuth2/ConstantContact.php');
            }
            $apikey = get_option('hc_constantcontact_appkey');
            $csecret = get_option('hc_constantcontact_appid');
            $vUrl = admin_url() . "admin.php?page=hybridConnectAdminSetup";
            $ccontact_valid = false;
            try {
                $oAuth2 = new CTCTOauth2($apikey, $csecret, $vUrl, $_GET ["code"]);
                // trade your code in for an access token by doing a POST
                $token = $oAuth2->getAccessToken();
                update_option('hc_constant_contact_token', $token);
                $ConstantContact = new ConstantContact("oauth2", $apikey, $_GET['username'], $token);
                if ($token && $token != '') {
                    $ccontact_valid = true;
                }
            } catch (Exception $e) {
                $ccontact_valid = false;
            }
        } else {
            if (isset($_GET["code"]) && !isset($_GET["username"])) {
                // gotowebinar
                require_once('includes/apis/g2w/citrix.php');
                $citrix = new Citrix(get_option('hc_g2w_app_id'));
                $hcg2wError = false;
                try {
                    $g2worganizerKey = $citrix->get_organizer_key();
                    update_option("hc_g2w_organizer_key", $g2worganizerKey);
                    update_option("hc_g2w_error", "");
                } catch (Exception $e) {
                    update_option("hc_g2w_error", $citrix->pr($e->getMessage()));
                    $hcg2wError = true;
                    update_option("hc_g2w_valid", "false");
                }
                try {
                    $g2waccesssToken = $citrix->get_access_token();
                    update_option("hc_g2w_access_token", $g2waccesssToken);
                    update_option("hc_g2w_error_2", "");
                } catch (Exception $e) {
                    update_option("hc_g2w_error_2", $citrix->pr($e->getMessage()));
                    $hcg2wError = true;
                    update_option("hc_g2w_valid", "false");
                }
                if (get_option("hc_g2w_organizer_key") != "" && get_option("hc_g2w_access_token") != "") {
                    update_option("hc_g2w_valid", "true");
                }
            }
        }
        $my_services = $this->_get_services_array();
        include('includes/hc_admin_setup.php');
    }

    function admin_hybridConnect() {
        $license = get_option('HYBRID_CONNECT_LICENSE_STATUS');
        if (!$license || $license != 'ACTIVE') {
            $this->admin_setup();
            return;
        }
        //     $this->admin_add_style_js();
        include('includes/hc_admin_panel.php');
    }

    function admin_hybridConnectTestHistory() {
        $license = get_option('HYBRID_CONNECT_LICENSE_STATUS');
        if (!$license || $license != 'ACTIVE') {
            $this->admin_setup();
            return;
        }
        include('includes/hc_admin_test_history.php');
    }

    function admin_hybrid_error_log() {
        $license = get_option('HYBRID_CONNECT_LICENSE_STATUS');
        if (!$license || $license != 'ACTIVE') {
            $this->admin_setup();
            return;
        }
        include('includes/hc_admin_error_log.php');
    }

    function admin_hybridAffiliateSettings() {
        $license = get_option('HYBRID_CONNECT_LICENSE_STATUS');
        if (!$license || $license != 'ACTIVE') {
            $this->admin_setup();
            return;
        }
        //    $this->admin_add_style_js('affiliate');
        include('includes/hc_admin_affiliate.php');
    }

    function admin_hybridConnectServices() {
        $license = get_option('HYBRID_CONNECT_LICENSE_STATUS');
        if (!$license || $license != 'ACTIVE') {
            $this->admin_setup();
            return;
        }
        $my_services = $this->_get_services_array();
        //     $this->admin_add_style_js('services');
        include('includes/hc_admin_services_panel.php');
    }

    function admin_hybridConnectStats() {
        global $wpdb;
        $license = get_option('HYBRID_CONNECT_LICENSE_STATUS');
        if (!$license || $license != 'ACTIVE') {
            $this->admin_setup();
            return;
        }
        $my_stats = $this->_get_stats_array();
        //$end_date = date('d-m-Y', mktime(0, 0, 0, date("m") + 1, 1, date("Y")));
        // always today  2012-11-16  1:00PM"
        $end_date = date('d-m-Y');
        $start_date = date('d-m-Y', strtotime("-1 month"));
        //$start_date = date('d-m-Y', mktime(0, 0, 0, date("m"), 1, date("Y")));
        //$this->admin_add_style_js('stats');
        $referingDomainStats = $wpdb->get_results("select count(distinct email) as 'subscribers', referingdomain from `wp_hc_subscribers` where referingdomain <> '' and referingdomain is not null group by referingdomain order by subscribers desc");
        $referingDomainStatsSize = $wpdb->num_rows;
        $hcTrackingStats = $wpdb->get_results("select count(distinct email) as 'subscribers', trackingcode from `wp_hc_subscribers` where trackingcode <> '' and trackingcode is not null group by trackingcode order by subscribers desc");
        $hcTrackingStatsSize = $wpdb->num_rows;
        include('includes/hc_admin_stats_panel.php');
    }

    /*
     * UPDATE AND VALIDATE LICENSE
     */
    /*  function admin_update_license_options() {   */

    function admin_update_license_options() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $current_status = get_option('HYBRID_CONNECT_LICENSE_STATUS');
        if ($current_status == 'ACTIVE') {
            echo $current_status;
            die;
        }
        $update1 = update_option('hc_license_email', $_POST['hc_license_email']);
        $update2 = update_option('hc_license_key', $_POST['hc_license_key']);
        error_reporting(0);
       // $validate = $this->smp_remote_license_check($_POST['hc_license_email'], $_POST['hc_license_key']);
        $status = 0;
        //if (isset($validate->license_id)) {
            //if ($validate->license_status == "ACTIVE" || $validate->license_status == "UNUSED") {
                $status = "ACTIVE";
          //  }
           /*  if (($validate->license_status == 'ACTIVE' || $validate->license_status == 'UNUSED') && $validate->product_id == 5) {
                $validate = $this->smp_remote_license_check($_POST['hc_license_email'], $_POST['hc_license_key'], 1);
            } */
			$validate->product_id =5;
            $udpate3 = update_option('HYBRID_CONNECT_LICENSE_STATUS', $status);
            $udpate4 = update_option('HYBRID_CONNECT_LICENSE_PRODUCT', $validate->product_id);
        //}
        if ($status == "ACTIVE") {
            echo 10;
            die;
        }
        echo $status;
        die;
    }

    function admin_lightbox_page() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $my_connector = $wpdb->get_results("SELECT * FROM wp_connectors where IntegrationID=" . $_POST['id_connector']);
        $my_connector = $my_connector[0];

        $idVariation = (isset($_POST['id_variation']) && $_POST['id_variation'] > 0) ? $_POST['id_variation'] : null;
        if (!$idVariation) {
            $variation = $wpdb->get_row("SELECT * FROM hc_variations WHERE control=1 AND type=2 AND idConnector=" . $_POST['id_connector']);
            $idVariation = $variation->id;
        }
        $variation = $wpdb->get_row("SELECT * FROM hc_variations WHERE id=" . $idVariation);
        $tpl_type = $wpdb->get_row("SELECT * FROM hc_tpl_types WHERE idConnector=" . $_POST['id_connector'] . " AND type=2");

        $lightbox_options = $wpdb->get_results("SELECT * FROM hc_lightbox_options where id_connector=" . $_POST['id_connector']);
        if (count($lightbox_options) == 0) {
            $lightbox_options = $wpdb->get_results("SELECT * FROM hc_lightbox_options where id_connector=0");
            $this->hybridCopySingleRow("hc_lightbox_options", $_POST['id_connector'], 2, true);
        }
        $lightbox_options = $lightbox_options[0];

        $excluded_pages = explode("-", $lightbox_options->excluded_pages);
        $included_pages = explode("-", $lightbox_options->included_pages);
        $excluded_posts = explode("-", $lightbox_options->excluded_posts);
        $included_posts = explode("-", $lightbox_options->included_posts);
        $excluded_cats = explode("-", $lightbox_options->excluded_cats);
        $included_cats = explode("-", $lightbox_options->included_cats);
        $available_pages = $wpdb->get_results("SELECT id, post_title FROM $wpdb->posts WHERE post_type = 'page' AND post_title!='Auto Draft'");
        $available_posts = $wpdb->get_results("SELECT id, post_title FROM $wpdb->posts WHERE post_type = 'post'");
        $available_cats = get_categories();

        $style_text = $wpdb->get_results("SELECT * FROM hc_style_text where idVariation=" . $idVariation);
        if (count($style_text) == 0) {
            $style_text = $wpdb->get_results("SELECT * FROM hc_style_text where id_connector=0");
            $this->hybridCopySingleRow("hc_style_text", $_POST['id_connector'], 2);
        }
        $style_text = $style_text[0];

        $style_button = $wpdb->get_results("SELECT * FROM hc_style_button where idVariation=" . $idVariation);
        if (count($style_button) == 0) {
            $style_button = $wpdb->get_results("SELECT * FROM hc_style_button where id_connector=0");
            $this->hybridCopySingleRow("hc_style_button", $_POST['id_connector'], 2);
        }
        $style_button = $style_button[0];

        $style_connector = $wpdb->get_results("SELECT * FROM hc_style_connector where idVariation=" . $idVariation);
        if (count($style_connector) == 0) {
            $style_connector = $wpdb->get_results("SELECT * FROM hc_style_connector where id_connector=0");
            $this->hybridCopySingleRow("hc_style_connector", $_POST['id_connector'], 2);
        }
        $style_connector = $style_connector[0];

        $style_email = $wpdb->get_results("SELECT * FROM hc_style_email where idVariation=" . $idVariation);
        if (count($style_email) == 0) {
            $style_email = $wpdb->get_results("SELECT * FROM hc_style_email where id_connector=0");
            $this->hybridCopySingleRow("hc_style_email", $_POST['id_connector'], 2);
        }
        $style_email = $style_email[0];

        $style_image = $wpdb->get_results("SELECT * FROM hc_style_image where idVariation=" . $idVariation);
        if (count($style_image) == 0) {
            $style_image = $wpdb->get_results("SELECT * FROM hc_style_image where id_connector=0");
            $this->hybridCopySingleRow("hc_style_image", $_POST['id_connector'], 2);
        }
        $style_image = $style_image[0];

        $style_optin = $wpdb->get_results("SELECT * FROM hc_style_optin where idVariation=" . $idVariation);
        if (count($style_optin) == 0) {
            $style_optin = $wpdb->get_results("SELECT * FROM hc_style_optin where id_connector=0");
            $this->hybridCopySingleRow("hc_style_optin", $_POST['id_connector'], 2);
        }
        $style_optin = $style_optin[0];

        $connector_txt = $wpdb->get_results("SELECT * FROM hc_connector_text where idVariation=" . $idVariation);
        if (count($connector_txt) == 0) {
            $connector_txt = $wpdb->get_results("SELECT * FROM hc_connector_txt where id_connector=0");
            $this->hybridCopySingleRow("hc_connector_txt", $_POST['id_connector'], 2);
        }
        $connector_txt = $connector_txt[0];

        $connector_txt->optin_description = stripslashes($connector_txt->optin_description);
        //$connector_txt->optin_description = str_replace("style=", "temp=", $connector_txt->optin_description);
        $connector_txt->optin_headline = stripslashes($connector_txt->optin_headline);
        $connector_txt->email_call = stripslashes($connector_txt->email_call);
        $connector_txt->fb_call = stripslashes($connector_txt->fb_call);
        $connector_txt->oneclick_call = stripslashes($connector_txt->oneclick_call);
        $connector_txt->email_btn = stripslashes($connector_txt->email_btn);
        $connector_txt->fb_btn = stripslashes($connector_txt->fb_btn);
        $connector_txt->oneclick_btn = stripslashes($connector_txt->oneclick_btn);
        $connector_txt->optin_description = str_replace(array("\r", "\n"), '', $connector_txt->optin_description);
        /* return an array of all build in template ids */
        $connectorTemplates = $wpdb->get_results("SELECT `id`, `id_connector`, `template_image`, `type` FROM hc_style_connector_templates");
        include('includes/hc_admin_lb_page.php');
        die;
    }

    function admin_lightbox_page2() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $my_connector = $wpdb->get_results("SELECT * FROM wp_connectors where IntegrationID=" . $_POST['id_connector']);
        $my_connector = $my_connector[0];
        include('includes/hc_admin_lb_page2.php');
        die;
    }

    function admin_update_lightbox_settings() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $lo = $_POST['lightbox_config_object'];
        $id_con = $_POST['id_connector'];
        $lo['all_pages'] = isset($lo['all_pages']) ? 1 : 0;
        $lo['single_page'] = isset($lo['single_page']) ? 1 : 0;
        if ($lo['all_pages'] == 1) {
            $result = $wpdb->update('hc_lightbox_options', array('all_pages' => 0), array(), array('%d'), array());
        }
        $result1 = $wpdb->update('hc_lightbox_options', array(
            'all_pages' => $lo['all_pages'],
            'excluded_pages' => $lo['excluded_pages'],
            'single_page' => $lo['single_page'],
            'included_pages' => $lo['included_pages'],
            'on_time' => $lo['on_time'],
            'on_click' => $lo['on_click']
                ), array('id_connector' => $id_con), array('%d', '%s', '%d', '%s', '%s', '%s'), array('%d'));
        echo 1;
    }

    /*
     * Update the options of a service
     */

    function admin_update_constant_contact_options() {
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        if (isset($_POST['api_key'])) {
            update_option("hc_constantcontact_appkey", $_POST['api_key']);
            update_option("hc_constantcontact_appid", $_POST['api_id']);
            echo 1;
            die;
        }
        echo 0;
        die;
    }

    function get_full_referer_data() {
       global $wpdb;
       check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
       $thisRefererStats = $wpdb->get_results("select count(distinct email) as 'subscribers', referer from `wp_hc_subscribers` where referingdomain like '%" . $_POST["domain"] . "%' group by referer order by subscribers desc");
       include('includes/hc_admin_full_referer_stats.php');
       die;
    }

    function admin_update_service_options() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $service = $_POST['hc_service'];
        if (!$service || $service == '') {
            echo 0;
            die;
        }
        $service_name = $service;
        $service = 'hc_' . $service;
        $appid = (isset($_POST['appid']) && $_POST['appid'] != '') ? $_POST['appid'] : null;
        $appkey = (isset($_POST['appkey']) && $_POST['appkey'] != '') ? $_POST['appkey'] : null;
        $appurl = (isset($_POST['appurl']) && $_POST['appurl'] != '') ? $_POST['appurl'] : null;
        if ($appid) {
            $update1 = update_option($service . '_appid', $appid);
        }
        if ($appkey) {
            $update2 = update_option($service . '_appkey', $appkey);
        }
        if ($appurl) {
            $update3 = update_option($service . '_appurl', $appurl);
        }
        if ($this->_check_services_settings($service_name, true)) {
            echo 1;
            die;
        } else {
            echo 2; //if the connection to the api couldn't be set
            die;
        }
        echo 3;
        die();
    }

    function _get_services_array() {
        $service1 = array('name' => 'infusionsoft',
            'label' => 'InfusionSoft',
            'index' => 1,
            'validated' => $this->_check_services_settings('infusionsoft'));
        $service2 = array('name' => 'officeautopilot',
            'label' => 'OfficeAutopilot',
            'index' => 2,
            'validated' => $this->_check_services_settings('officeautopilot'));
        $service3 = array('name' => 'getresponse',
            'label' => 'GetResponse',
            'index' => 3,
            'validated' => $this->_check_services_settings('getresponse'));
        $service4 = array('name' => 'mailchimp',
            'label' => 'MailChimp',
            'index' => 4,
            'validated' => $this->_check_services_settings('mailchimp'));
        $service5 = array('name' => 'icontact',
            'label' => 'IContact',
            'index' => 5,
            'validated' => $this->_check_services_settings('icontact'));
        $service6 = array('name' => 'constantcontact',
            'label' => 'ConstantContact',
            'index' => 6,
            'validated' => $this->_check_services_settings('constantcontact'));
        $service7 = array('name' => 'aweber',
            'label' => 'Aweber',
            'index' => 7,
            'validated' => $this->_check_services_settings('aweber'));
        $services = array('infusionsoft' => $service1, 'officeautopilot' => $service2, 'getresponse' => $service3,
            'mailchimp' => $service4, 'icontact' => $service5, 'constantcontact' => $service6, 'aweber' => $service7);
        return $services;
    }

    function _get_stats_array() {
        global $wpdb;
        $stats = array();
        $connectors = $wpdb->get_results("SELECT * FROM wp_connectors");
        foreach ($connectors as $c) {
            $cona = get_object_vars($c);
            $db_subscribers = $wpdb->get_results("SELECT * FROM wp_hc_subscribers WHERE id_connector=" . $c->IntegrationID);
            $cona['subscribers'] = $db_subscribers;
            array_push($stats, $cona);
        }
        return $stats;
    }

    function _get_stats_data($start_date, $end_date) {
        global $wpdb;
        $stats = array();
        $db_subscribers = $wpdb->get_results("SELECT * FROM wp_hc_subscribers ORDER BY id ASC");
        $time1 = strtotime($start_date);
        $time2 = strtotime($end_date);
        foreach ($db_subscribers as $s) {
            $s_array = get_object_vars($s);
            $date = date('d-m-Y', strtotime($s_array['date']));
            $time = strtotime($date);
            $s_array['time'] = $time;
            if ($time1 <= $time && $time2 >= $time) {
                array_push($stats, $time);
            }
        }
        $stats_array = array_count_values($stats);
        ksort($stats_array);
        $full_array = array();
        for ($i = $time1; $i <= $time2; $i = $i + 86400) {
            $thisDate = date('Y-m-d', $i); // 2010-05-01, 2010-05-02, etc
            $temp = array(date('Y-m-d', $i) . "  1:00PM", 0);
            $full_array[$i] = 0;
        }
        foreach ($stats_array as $key => $val) {
            $full_array[$key] = $val;
        }
        $stats_array = $full_array;
        if (count($stats_array) == 0) {
            echo "00";
            die;
        }
        $response = array();
        foreach ($stats_array as $key => $s) {
            $temp = array(date('Y-m-d', $key) . "  1:00PM", $s);
            array_push($response, $temp);
        }
        if (count($stats_array) == 1) {
            $tempStartTime = strtotime("-24 hours", $time1);
            $temp_element = array(date('Y-m-d', $tempStartTime) . " 1:00PM", 0);
            array_unshift($response, $temp_element);
        }
        echo json_encode($response);
        die;
    }

    function _check_services_settings($service, $on_update = false) {
        $service_name = $service;
        $service = 'hc_' . $service;
        $appid = $service . '_appid';
        $appkey = $service . '_appkey';
        $appurl = $service . '_appurl';

        require_once('includes/apis/hc_services_helper.php');
        if ($service_name == 'aweber') {
            if ($on_update === false) {
                $aweber_settings = get_option('hc_aweber_api_settings');
                if (is_array($aweber_settings)) {
                    extract($aweber_settings);
                } else {
                    return false;
                }
                try {
                    $aweber = $this->_get_aweber_api($consumer_key, $consumer_secret);
                    $account = $aweber->getAccount($access_key, $access_secret);
                    return true;
                } catch (AWeberException $e) {
                    $account = null;
                    return false;
                }
                if (!$account) {
                    return false;
                }
                return false;
            }
            require_once('includes/apis/aweber_api/aweber_api.php');
            $auth_code = get_option($appid);
            try {
                list($consumer_key, $consumer_secret, $access_key, $access_secret) = AWeberAPI::getDataFromAweberID($auth_code);
                $aweber_settings = array(
                    'consumer_key' => $consumer_key,
                    'consumer_secret' => $consumer_secret,
                    'access_key' => $access_key,
                    'access_secret' => $access_secret,
                );
                update_option('hc_aweber_api_settings', $aweber_settings);
                return true;
            } catch (AWeberException $e) {
                $aweber_settings = array(
                    'consumer_key' => null,
                    'consumer_secret' => null,
                    'access_key' => null,
                    'access_secret' => null,
                );
                update_option('hc_aweber_api_settings', $aweber_settings);
                return false;
            } catch (AWeberOAuthException $e) {
                $aweber_settings = array(
                    'consumer_key' => null,
                    'consumer_secret' => null,
                    'access_key' => null,
                    'access_secret' => null,
                );
                update_option('hc_aweber_api_settings', $aweber_settings);
                return false;
            }
            return false;
        }
        if ($service_name == 'mailchimp') {
            $result = mailchimp_getLists(get_option('hc_mailchimp_appkey'));
            if (!$result) {
                return false;
            }
            return true;
        }
        if ($service_name == 'infusionsoft') {
            $client = $this->_get_infusionsoft_client();
            $apikey = get_option('hc_infusionsoft_appkey');
            $result = infusionsoft_getCampaigns($client, $apikey);
            if (isset($result->errno) && $result->errno > 0) {
                return false;
            }
            return true;
        }
        if ($service_name == 'icontact') {
            $appkey = get_option('hc_icontact_appkey');
            $appid = get_option('hc_icontact_appid');
            $appurl = get_option('hc_icontact_appurl');
            if ($appkey != '' && $appid != '' && $appurl != '') {
                $result = icontact_getLists($appid, $appkey, $appurl);
                if (!$result) {
                    return false;
                }
                return true;
            } else {
                return false;
            }
        }
        if ($service_name == 'officeautopilot') {
            $appkey = get_option('hc_officeautopilot_appkey');
            $appid = get_option('hc_officeautopilot_appid');
            if ($appkey == '' || $appid == '') {
                return false;
            }
            $result = officeautopilot_getLists(get_option('hc_officeautopilot_appkey'), get_option('hc_officeautopilot_appid'));
            if (isset($result[0]) && strpos($result[0], "error") > 0) {
                return false;
            }
            if (!isset($result[0])) {
                return false;
            }
            return true;
        }
        if ($service_name == 'getresponse') {
            $result = getresponse_getList(get_option('hc_getresponse_appkey'));
            if (!$result) {
                return false;
            }
            return true;
        }
        if ($service_name == 'constantcontact') {
            $appkey = get_option('hc_constantcontact_appkey');
            $appusername = get_option('hc_constant_contact_username');
            $apptoken = get_option('hc_constant_contact_token');
            if ($appkey != '' && $appid != '' && $appurl != '') {
                $result = constantcontact_getList($appkey, $appusername, $apptoken);
                if (!$result) {
                    return false;
                }
            } else {
                return false;
            }
            return true;
        }
        return false;
    }

    function admin_check_facebook_on_activation() {

        if (get_option('hc_fb_appid') == "" || get_option('hc_fb_appsecret') == "") {
            return false;
        }

        if (!class_exists("Facebook")) {
            include ('includes/apis/facebook/src/facebook.php');
        }

        $appid = get_option('hc_fb_appid');
        $secret = get_option('hc_fb_appsecret');
        $facebook = new Facebook(array(
                    'appId' => $appid,
                    'secret' => $secret,
                ));
        try {
            // get access token as application
            $accessToken = file_get_contents('https://graph.facebook.com/oauth/access_token?client_id=' . $appid . '&client_secret=' . $secret . '&grant_type=client_credentials');
            parse_str($accessToken);

            $fbSiteURL = get_site_url();
            $fbSiteDomain = $_SERVER['HTTP_HOST'];
            $appDomainsArray = array('0' => $fbSiteDomain);

            $postdata = http_build_query(
                    array(
                        'access_token' => $access_token,
                        'website_url' => $fbSiteURL,
                        'app_domains' => $appDomainsArray
                    )
            );

            $opts = array('http' =>
                array(
                    'method' => 'POST',
                    'header' => 'Content-type: application/x-www-form-urlencoded',
                    'content' => $postdata
                )
            );

            $context = stream_context_create($opts);
            $result = file_get_contents('https://graph.facebook.com/app', false, $context);

            $result = json_decode($result);

            if ($result->error) {
                update_option('hc_fb_appvalid', 0);
            } else {
                update_option('hc_fb_appvalid', 1);
            }
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    function admin_update_facebook_options() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        if (isset($_POST['hc_fb_appid']) && isset($_POST['hc_fb_appsecret'])) {
            $update1 = update_option('hc_fb_appid', $_POST['hc_fb_appid']);
            $update2 = update_option('hc_fb_appsecret', $_POST['hc_fb_appsecret']);
        }
        $valid = $this->_check_fb_connection();
        // if f_url_open then return json object
        if ($valid!=0) {
        foreach ($valid as $fbCheck => $fbValue) {
            if ($fbCheck == "success") {
                $update3 = update_option('hc_fb_appvalid', $fbValue);
            }
        }
        ob_clean();
        echo json_encode($valid);
        die;
        } else {
        ob_clean();
        $furlproblem=array('success' => -2);
        echo json_encode($furlproblem);
        die;
        }
    }

    function admin_update_hc_affiliate_settings() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $earn_money = (isset($_POST['hc_check_affiliate']) && $_POST['hc_check_affiliate'] == "checked") ? 1 : 0;
        $update1 = update_option('hc_earn_money', $earn_money);
        if ($_POST['type'] == 0) {
            0;
            die;
        }
        if ($_POST['hc_manual'] == 1) {
            update_option('hc_affiliate_link', $_POST['hc_manual_link']);
            update_option('hc_affiliate_valid', 1);
            echo 5;
            die;
        }
        if ($earn_money == 1 && isset($_POST['hc_affiliate_email']) && $_POST['hc_affiliate_email'] != '') {
            $update2 = update_option('hc_affiliate_email', $_POST['hc_affiliate_email']);
            if (!class_exists('Gpf_Api_Session')) {
                include('includes/apis/PapApi.class.php');
            }
            $session = new Gpf_Api_Session("http://affiliates.swissmademarketing.com/scripts/server.php");
            if (!$session->login("api@pap.com", "hd73kAb38UrG2Hkdl")) {
                echo 3;
            }
            $emailAddress = $_POST['hc_affiliate_email'];
            $affiliate = new Pap_Api_Affiliate($session);
            $affiliate->setUsername($emailAddress);
            try {
                $affiliate->load();
            } catch (Exception $e) {
                update_option('hc_affiliate_valid', 0);
                echo 3;
                die;
            }
            $affiliate_link = "http://www.hybrid-connect.com/#a_aid=" . $affiliate->getRefid();
            echo "Your affiliate link has been added! (<a href= '" . $affiliate_link . "' target='_blank'>" . $affiliate_link . "</a>)";
            update_option('hc_affiliate_link', $affiliate_link);
            update_option('hc_affiliate_valid', 1);
            die;
        }
        echo 3;
        die();
    }

    function admin_update_templates_table() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $hc_connectors_list = $wpdb->get_results("SELECT * FROM hc_style_connector where user_template=1 ORDER by id_connector ASC");
        include('includes/builder/hc_admin_templates_table.php');
        die;
    }

    function admin_update_tests_table() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $hc_tests_list = $wpdb->get_results("select * from hc_tests_log order by startData desc");
        include('includes/hc_admin_tests_table.php');
        die;
    }

    function admin_update_connectors_table() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $hc_connectors_list = $wpdb->get_results("SELECT * FROM wp_connectors where is_user_template!='1' ORDER by IntegrationID ASC");
        include('includes/hc_admin_connectors_table.php');
        die;
    }

    function admin_add_new_connector_dialog() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $available_pages = $wpdb->get_results("SELECT id, post_title FROM $wpdb->posts WHERE post_type = 'page' AND post_title!='Auto Draft'");
        $my_connector = null;
        if ($_POST['id_connector'] > 0) {
            $my_connector = $wpdb->get_results("SELECT * FROM wp_connectors where IntegrationID=" . $_POST['id_connector']);
            $my_connector = $my_connector[0];
        }
        include('includes/hc_admin_connector_dialog.php');
        die;
    }

    function hc_save_as_new_template() {

        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $new_id = $this->MysqlCopyRow("wp_connectors", "IntegrationID", $_POST['id_connector'], null, $_POST['template_name'], null, 1);

        $this->MysqlCopyRow("hc_connector_text", "idVariation", $_POST['id_variation'], $new_id, NULL, $_POST['connectorType'], true);
        $this->MysqlCopyRow("hc_style_button", "idVariation", $_POST['id_variation'], $new_id, NULL, $_POST['connectorType'], true);
        $this->MysqlCopyRow("hc_style_email", "idVariation", $_POST['id_variation'], $new_id, NULL, $_POST['connectorType'], true);
        $this->MysqlCopyRow("hc_style_connector", "idVariation", $_POST['id_variation'], $new_id, NULL, $_POST['connectorType'], true);
        $this->MysqlCopyRow("hc_style_image", "idVariation", $_POST['id_variation'], $new_id, NULL, $_POST['connectorType'], true);
        $this->MysqlCopyRow("hc_style_optin", "idVariation", $_POST['id_variation'], $new_id, NULL, $_POST['connectorType'], true);
        $this->MysqlCopyRow("hc_style_text", "idVariation", $_POST['id_variation'], $new_id, NULL, $_POST['connectorType'], true);

        // update template name and setting in connectors table
        $templateSetting = "update `hc_style_connector` set user_template_name='" . $_POST['template_name'] . "', user_template='1' where id_connector = '" . $new_id . "';";
        $wpdb->query($templateSetting);
        $templateSetting2 = "update `wp_connectors` set is_user_template='1' where IntegrationID = '" . $new_id . "';";
        $wpdb->query($templateSetting2);
        $tableArray = array("hc_templates", "hc_connector_text", "hc_style_button", "hc_style_email", "hc_style_connector", "hc_style_image", "hc_style_optin", "hc_style_text");
        // delete rows that don't match connector type
        for ($i = 0; $i < 3; $i++) {
            echo $i;
            echo "\n";
            if ($i == $_POST['connectorType']) {
                
            } else {
                foreach ($tableArray as $table) {
                    $deleteType = "delete from `" . $table . "` where type='" . $i . "' and id_connector = '" . $new_id . "';";
                    $wpdb->query($deleteType);
                }
            }
        }
        // set type to zero - default for templates
        foreach ($tableArray as $table) {
            $updateTemplate = "update `" . $table . "` set type='0' where id_connector = '" . $new_id . "';";
            $wpdb->query($updateTemplate);
        }
        die;
    }

    function admin_duplicate_connector() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $new_id = $this->MysqlCopyRow("wp_connectors", "IntegrationID", $_POST['id_connector'], null, $_POST['new_name'], null, 1);

        $result = $wpdb->insert('hc_variations', array('idConnector' => $new_id, 'type' => 0, 'name' => 'Default', 'control' => 1), array('%d', '%d', '%s', '%d'));
        $id0 = $wpdb->insert_id;
        $result = $wpdb->insert('hc_variations', array('idConnector' => $new_id, 'type' => 1, 'name' => 'Default', 'control' => 1), array('%d', '%d', '%s', '%d'));
        $id1 = $wpdb->insert_id;
        $result = $wpdb->insert('hc_variations', array('idConnector' => $new_id, 'type' => 2, 'name' => 'Default', 'control' => 1), array('%d', '%d', '%s', '%d'));
        $id2 = $wpdb->insert_id;
        $result = $wpdb->insert('hc_variations', array('idConnector' => $new_id, 'type' => 3, 'name' => 'Default', 'control' => 1), array('%d', '%d', '%s', '%d'));
        $id3 = $wpdb->insert_id;

        $var0 = $wpdb->get_row("SELECT * FROM hc_variations WHERE idConnector=" . $_POST['id_connector'] . " AND type=0 AND control=1");
        $var1 = $wpdb->get_row("SELECT * FROM hc_variations WHERE idConnector=" . $_POST['id_connector'] . " AND type=1 AND control=1");
        $var2 = $wpdb->get_row("SELECT * FROM hc_variations WHERE idConnector=" . $_POST['id_connector'] . " AND type=2 AND control=1");
        $var3 = $wpdb->get_row("SELECT * FROM hc_variations WHERE idConnector=" . $_POST['id_connector'] . " AND type=3 AND control=1");

        $this->MysqlCopyRow("hc_connector_text", "id_connector", $var0->id, $new_id, null, 0, null, $id0, true);
        $this->MysqlCopyRow("hc_connector_text", "id_connector", $var1->id, $new_id, null, 1, null, $id1, true);
        $this->MysqlCopyRow("hc_connector_text", "id_connector", $var2->id, $new_id, null, 2, null, $id2, true);
        $this->MysqlCopyRow("hc_connector_text", "id_connector", $var3->id, $new_id, null, 3, null, $id3, true);
        $this->MysqlCopyRow("hc_style_button", "id_connector", $var0->id, $new_id, null, 0, null, $id0, true);
        $this->MysqlCopyRow("hc_style_button", "id_connector", $var1->id, $new_id, null, 1, null, $id1, true);
        $this->MysqlCopyRow("hc_style_button", "id_connector", $var2->id, $new_id, null, 2, null, $id2, true);
        $this->MysqlCopyRow("hc_style_button", "id_connector", $var3->id, $new_id, null, 3, null, $id3, true);
        $this->MysqlCopyRow("hc_style_email", "id_connector", $var0->id, $new_id, null, 0, null, $id0, true);
        $this->MysqlCopyRow("hc_style_email", "id_connector", $var1->id, $new_id, null, 1, null, $id1, true);
        $this->MysqlCopyRow("hc_style_email", "id_connector", $var2->id, $new_id, null, 2, null, $id2, true);
        $this->MysqlCopyRow("hc_style_email", "id_connector", $var3->id, $new_id, null, 3, null, $id3, true);
        $this->MysqlCopyRow("hc_style_connector", "id_connector", $var0->id, $new_id, null, 0, null, $id0, true);
        $this->MysqlCopyRow("hc_style_connector", "id_connector", $var1->id, $new_id, null, 1, null, $id1, true);
        $this->MysqlCopyRow("hc_style_connector", "id_connector", $var2->id, $new_id, null, 2, null, $id2, true);
        $this->MysqlCopyRow("hc_style_connector", "id_connector", $var3->id, $new_id, null, 3, null, $id3, true);
        $this->MysqlCopyRow("hc_style_image", "id_connector", $var0->id, $new_id, null, 0, null, $id0, true);
        $this->MysqlCopyRow("hc_style_image", "id_connector", $var1->id, $new_id, null, 1, null, $id1, true);
        $this->MysqlCopyRow("hc_style_image", "id_connector", $var2->id, $new_id, null, 2, null, $id2, true);
        $this->MysqlCopyRow("hc_style_image", "id_connector", $var3->id, $new_id, null, 3, null, $id3, true);
        $this->MysqlCopyRow("hc_style_optin", "id_connector", $var0->id, $new_id, null, 0, null, $id0, true);
        $this->MysqlCopyRow("hc_style_optin", "id_connector", $var1->id, $new_id, null, 1, null, $id1, true);
        $this->MysqlCopyRow("hc_style_optin", "id_connector", $var2->id, $new_id, null, 2, null, $id2, true);
        $this->MysqlCopyRow("hc_style_optin", "id_connector", $var3->id, $new_id, null, 3, null, $id3, true);
        $this->MysqlCopyRow("hc_style_text", "id_connector", $var0->id, $new_id, null, 0, null, $id0, true);
        $this->MysqlCopyRow("hc_style_text", "id_connector", $var1->id, $new_id, null, 1, null, $id1, true);
        $this->MysqlCopyRow("hc_style_text", "id_connector", $var2->id, $new_id, null, 2, null, $id2, true);
        $this->MysqlCopyRow("hc_style_text", "id_connector", $var3->id, $new_id, null, 3, null, $id3, true);

        $result = $wpdb->insert('hc_tpl_types', array('idConnector' => $new_id, 'type' => 0), array('%d', '%d'));
        $result = $wpdb->insert('hc_tpl_types', array('idConnector' => $new_id, 'type' => 1), array('%d', '%d'));
        $result = $wpdb->insert('hc_tpl_types', array('idConnector' => $new_id, 'type' => 2), array('%d', '%d'));
        $result = $wpdb->insert('hc_tpl_types', array('idConnector' => $new_id, 'type' => 3), array('%d', '%d'));
        /* copy lightbox settings */
        $this->MysqlCopyRow("hc_lightbox_options", "id", 1, $new_id, null, true, 1);
        /* copy squeeze page settings */
        $this->MysqlCopyRow("hc_squeeze_options", "id", 1, $new_id, null, true, 1);
        $my_mailinglist = $wpdb->get_results("SELECT * FROM wp_mailingList where IntegrationID=" . $_POST['id_connector']);
        $my_mailingList = (isset($my_mailinglist[0])) ? $my_mailinglist[0] : null;
        $my_webinar = $wpdb->get_results("SELECT * FROM wp_hyCong2w where IntegrationID=" . $_POST['id_connector']);
        $my_webinar = (isset($my_webinar[0])) ? $my_webinar[0] : null;
        //insert default empty row in wp_hyCong2w and wp_mailingList
        $result2 = $wpdb->insert('wp_hyCong2w', array(
            'IntegrationID' => $new_id,
            'webinarKey' => $my_webinar->webinarKey), array('%d', '%s'));
        $result3 = $wpdb->insert('wp_mailingList', array(
            'IntegrationID' => $new_id,
            'autoresponderType' => $my_mailingList->autoresponderType,
            'settings' => $my_mailingList->settings), array('%d', '%s', '%s'));
        echo 1;
        die;
    }

    function admin_remove_connector() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $query = "DELETE from wp_connectors WHERE IntegrationID = " . $_POST['id_connector'];
        $result = $wpdb->get_results($query);
        $query2 = "DELETE from wp_mailingList WHERE IntegrationID = " . $_POST['id_connector'];
        $result2 = $wpdb->get_results($query2);
        $query3 = "DELETE from wp_hyCong2w WHERE IntegrationID = " . $_POST['id_connector'];
        $result3 = $wpdb->get_results($query3);
        $query4 = "DELETE from hc_lightbox_options WHERE id_connector = " . $_POST['id_connector'];
        $result4 = $wpdb->get_results($query4);
        $query5 = "DELETE from hc_squeeze_options WHERE id_connector = " . $_POST['id_connector'];
        $result5 = $wpdb->get_results($query5);

        echo $result;
        die;
    }

    function admin_remove_template() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $tableArray = array("hc_templates", "hc_connector_text", "hc_style_button", "hc_style_email", "hc_style_connector", "hc_style_image", "hc_style_optin", "hc_style_text");
        foreach ($tableArray as $table) {
            $deleteType = "delete from `" . $table . "` where type='0' and id_connector = '" . $_POST['templateID'] . "';";
            $wpdb->query($deleteType);
            echo $deleteType . "\n";
        }
        die;
    }

    function admin_mail_list_settings() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $my_connector = $wpdb->get_results("SELECT * FROM wp_connectors where IntegrationID=" . $_POST['id_connector']);
        $my_connector = $my_connector[0];
        $my_mailinglist = $wpdb->get_results("SELECT * FROM wp_mailingList where IntegrationID=" . $_POST['id_connector']);
        $my_mailingList = (isset($my_mailinglist[0])) ? $my_mailinglist[0] : null;
        $my_services = $this->_get_services_array();
        $available_pages = $wpdb->get_results("SELECT id, post_title FROM $wpdb->posts WHERE post_type = 'page' AND post_title!='Auto Draft'");
        include('includes/hc_admin_mail_list_settings.php');
        die;
    }

    function admin_webinar_settings() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $my_connector = $wpdb->get_results("SELECT * FROM wp_connectors where IntegrationID=" . $_POST['id_connector']);
        $my_connector = $my_connector[0];
        $my_webinar = $wpdb->get_results("SELECT * FROM wp_hyCong2w where IntegrationID=" . $_POST['id_connector']);
        $my_webinar = (isset($my_webinar[0])) ? $my_webinar[0] : null;
        include('includes/hc_admin_webinar_settings.php');
        die;
    }

    function admin_duplicate_panel() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $my_connector = $wpdb->get_results("SELECT * FROM wp_connectors where IntegrationID=" . $_POST['id_connector']);
        $my_connector = $my_connector[0];
        include('includes/hc_admin_duplicate_panel.php');
        die;
    }

    function admin_phpsnippet_panel() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $id_connector = $_POST['id_connector'];
        include('includes/hc_admin_phpsnippet.php');
        die;
    }

    function admin_update_mail_list_settings() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $result = $wpdb->update('wp_mailingList', array('autoresponderType' => $_POST['mail_list_type'],
            'settings' => $_POST['mail_list_name']), array('IntegrationID' => $_POST['id_connector']), array('%s', '%s'), array('%d'));

        if (!$_POST['connectAPI']) {
            $mailingListName = "Custom";
        } else {
            $mailingListName = $_POST['mail_list_type'];
        }

        $result2 = $wpdb->update('wp_connectors', array('TyPage' => $_POST['thankspage'],
            'MailingList' => $mailingListName,
            'custom_code' => stripslashes($_POST['customcode']),
            'apiConnection' => $_POST['connectAPI'],
            'emailOnly' => $_POST['optintype']), array('IntegrationID' => $_POST['id_connector']), array('%s', '%s', '%s', '%s', '%s'), array('%d'));
        die;
    }

    function admin_update_webinar_settings() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $result = $wpdb->update(
                'wp_hyCong2w', array(
            'webinarKey' => $_POST['webinar_key']), array('IntegrationID' => $_POST['id_connector']), array('%s'), array('%d')
        );
        $result2 = $wpdb->update('wp_connectors', array('GotoWebinar' => '1'), array('IntegrationID' => $_POST['id_connector']), array('%s'), array('%d'));
        echo '1';
        die;
    }

    function admin_remove_mail_list_settings() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $result = $wpdb->update(
                'wp_mailingList', array(
            'autoresponderType' => '',
            'settings' => ''), array('IntegrationID' => $_POST['id_connector']), array('%s', '%s'), array('%d')
        );
        $result2 = $wpdb->update('wp_connectors', array('MailingList' => ''), array('IntegrationID' => $_POST['id_connector']), array('%s'), array('%d')
        );
        die;
    }

    function admin_remove_webinar_settings() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $result = $wpdb->update(
                'wp_hyCong2w', array(
            'webinarKey' => ''), array('IntegrationID' => $_POST['id_connector']), array('%s'), array('%d')
        );
        echo $result;
        $result2 = $wpdb->update('wp_connectors', array('GotoWebinar' => ''), array('IntegrationID' => $_POST['id_connector']), array('%s'), array('%d'));
        echo $result2;
        die;
    }

    function admin_update_connector_type() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        if (!isset($_POST['id_connector']) || !isset($_POST['type'])) {
            echo 0;
            die;
        }
        $result = $wpdb->update('wp_connectors', array('type' => $_POST['type']), array('IntegrationID' => $_POST['id_connector']), array('%s'), array('%d'));
        echo 1;
        die;
    }

    function admin_update_connector_data() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        if (isset($_POST['allow_registration']) && $_POST['allow_registration'] == 'true') {
            $_POST['allow_registration'] = 1;
        } else {
            $_POST['allow_registration'] = 0;
        }
        if ($_POST['connector_id'] == 0) {
            $custom_form = "Header text
&lt;br/&gt;&lt;br&gt;
Name: &lt;input type=\&quot;text\&quot; name=\&quot;name\&quot; /&gt; &lt;br/&gt;
Email: &lt;input type=\&quot;text\&quot; name=\&quot;email\&quot;/&gt; &lt;br/&gt;
&lt;a href=\&quot;#\&quot; class=\&quot;hc_custom_form_submit\&quot;&gt; Connect &lt;/a&gt; ";
            $custom_fbyes = "Connect
&lt;br/&gt;&lt;br/&gt;
&lt;a class=\&quot;hc_fb_form_connector_submit\&quot; href=\&quot;#\&quot;&gt;Connect&lt;/a&gt;";
            $custom_fbnot = "Header text &lt;br/&gt;
&lt;div class=\&quot;fb-login-button\&quot; data-scope=\&quot;email\&quot; size=\&quot;large\&quot;&gt;
	Connect
&lt;/div&gt;";
            $result = $wpdb->insert('wp_connectors', array(
                'Name' => $_POST['connector_name'],
                'Type' => $_POST['connector_type'],
                'TyPage' => '',
                'MailingList' => '',
                'GotoWebinar' => '',
                'Wordpress' => '',
                'FacebookCTA' => '',
                'FormCTA' => '',
                'oneClickCTA' => '',
                'allow_registration' => $_POST['allow_registration'],
                'registration_role' => $_POST['registration_role'],
                'custom_form' => $custom_form,
                'custom_fbnot' => $custom_fbnot,
                'custom_fbyes' => $custom_fbyes,
                'custom_width' => '500'), array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%s', '%s', '%s', '%s', '%s'));
            $last_inserted_connector = $wpdb->insert_id;

            $result2 = $wpdb->insert('wp_hyCong2w', array(
                'IntegrationID' => $last_inserted_connector,
                'webinarKey' => $_POST['webinar_key']), array('%d', '%s'));
            $result3 = $wpdb->insert('wp_mailingList', array(
                'IntegrationID' => $last_inserted_connector,
                'autoresponderType' => $_POST['mail_list_type'],
                'settings' => $_POST['mail_list_name']), array('%d', '%s', '%s'));

            $this->_insert_default_styles($last_inserted_connector, 1, 0);
            $this->_insert_default_styles($last_inserted_connector, 1, 1);
            $this->_insert_default_styles($last_inserted_connector, 1, 2);
            $this->_insert_default_styles($last_inserted_connector, 1, 3);
            $this->MysqlCopyRow("hc_lightbox_options", "id", 1, $last_inserted_connector, null, true, 1);
            $this->MysqlCopyRow("hc_squeeze_options", "id", 1, $last_inserted_connector, null, true, 1);
        } else {
            $result = $wpdb->update(
                    'wp_connectors', array(
                'Name' => $_POST['connector_name'],
                'Type' => $_POST['connector_type'],
                'MailingList' => '',
                'GotoWebinar' => '',
                'Wordpress' => '',
                'FacebookCTA' => '',
                'FormCTA' => '',
                'oneClickCTA' => '',
                'allow_registration' => $_POST['allow_registration'],
                'registration_role' => $_POST['registration_role']), array('IntegrationID' => $_POST['connector_id']), array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%s'), array('%d')
            );
        }
        echo 1;
        die;
    }

    function admin_update_footer_settings() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $connectorID = $_POST['id_connector'];
        if ($connectorID == "remove") {
            update_option('hyConFooterPost', '');
            update_option('hyConFooterPage', '');
        } else {
            if ($_POST['post_footer'] == 1) {
                update_option('hyConFooterPost', $connectorID);
            }
            if ($_POST['page_footer'] == 1) {
                update_option('hyConFooterPage', $connectorID);
            }
            if ($_POST['post_footer'] == 0 && $_POST['type'] == 0) {
                update_option('hyConFooterPost', '');
            }
            if ($_POST['page_footer'] == 0 && $_POST['type'] == 1) {
                update_option('hyConFooterPage', '');
            }
        }
        die;
    }

    function admin_shortcode_style_panel() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $my_connector = $wpdb->get_results("SELECT * FROM wp_connectors where IntegrationID=" . $_POST['id_connector']);
        $my_connector = $my_connector[0];
        $my_settings = $wpdb->get_results("SELECT * FROM hc_templates where idConnector=" . $_POST['id_connector']);
        $my_settings = $my_settings[0];
        include('includes/hc_admin_sc_style.php');
        die;
    }

    function hc_load_user_template() {

        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $my_connector = $wpdb->get_results("SELECT * FROM wp_connectors where IntegrationID=" . $_POST['connectorID']);
        $my_connector = $my_connector[0];
        $style_text = $wpdb->get_results("SELECT * FROM hc_style_text where id_connector=" . $_POST['templateID'] . " AND type=0");
        $style_text = $style_text[0];
        $style_button = $wpdb->get_results("SELECT * FROM hc_style_button where id_connector=" . $_POST['templateID'] . " AND type=0");
        $style_button = $style_button[0];
        $style_connector = $wpdb->get_results("SELECT * FROM hc_style_connector where id_connector=" . $_POST['templateID'] . " AND type=0");
        $style_connector = $style_connector[0];
        $style_email = $wpdb->get_results("SELECT * FROM hc_style_email where id_connector=" . $_POST['templateID'] . " AND type=0");
        $style_email = $style_email[0];
        $style_image = $wpdb->get_results("SELECT * FROM hc_style_image where id_connector=" . $_POST['templateID'] . " AND type=0");
        $style_image = $style_image[0];
        $style_optin = $wpdb->get_results("SELECT * FROM hc_style_optin where id_connector=" . $_POST['templateID'] . " AND type=0");
        $style_optin = $style_optin[0];
        $connector_txt = $wpdb->get_results("SELECT * FROM hc_connector_text where id_connector=" . $_POST['templateID'] . " AND type=0");
        $connector_txt = $connector_txt[0];
        $connector_txt->optin_description = stripslashes($connector_txt->optin_description);
        //$connector_txt->optin_description = str_replace("style=", "temp=", $connector_txt->optin_description);
        $connector_txt->optin_headline = stripslashes($connector_txt->optin_headline);
        $connector_txt->email_call = stripslashes($connector_txt->email_call);
        $connector_txt->fb_call = stripslashes($connector_txt->fb_call);
        $connector_txt->oneclick_call = stripslashes($connector_txt->oneclick_call);
        $connector_txt->email_btn = stripslashes($connector_txt->email_btn);
        $connector_txt->fb_btn = stripslashes($connector_txt->fb_btn);
        $connector_txt->oneclick_btn = stripslashes($connector_txt->oneclick_btn);
        $connector_txt->optin_description = str_replace(array("\r", "\n"), '', $connector_txt->optin_description);
        $squeeze_options = $wpdb->get_results("select * from hc_squeeze_options where id_connector = " . $_POST['connectorID']);
        $squeeze_options = $squeeze_options[0];
        $available_pages = $wpdb->get_results("SELECT id, post_title FROM $wpdb->posts WHERE post_type = 'page' AND post_title!='Auto Draft'");
        $available_posts = $wpdb->get_results("SELECT id, post_title FROM $wpdb->posts WHERE post_type = 'post'");
        $fromTemplate = 0;

        /* return an array of all build in template ids */
        $connectorTemplates = $wpdb->get_results("SELECT `id`, `id_connector`, `template_image`, `type` FROM hc_style_connector_templates");

        /* carry the connectorType from submission page even though templates are always connectorType 0 */
        $style_connector->type = $_POST['type'];

        $idVariation = $_POST['idVariation'];
        $variation = $wpdb->get_row("SELECT * FROM hc_variations WHERE id=" . $idVariation);
        $tpl_type = $wpdb->get_row("SELECT * FROM hc_tpl_types WHERE idConnector=" . $_POST['id_connector'] . " AND type=" . $_POST['type']);

        if ($_POST['type'] == "0") {
            include('includes/hc_admin_sc_page.php');
            die;
        }
        if ($_POST['type'] == "1") {
            include('includes/hc_admin_wg_page.php');
            die;
        }
        if ($_POST['type'] == "2") {
            $lightbox_options = $wpdb->get_results("SELECT * FROM hc_lightbox_options where id_connector=" . $_POST['connectorID']);
            $lightbox_options = $lightbox_options[0];
            $excluded_pages = explode("-", $lightbox_options->excluded_pages);
            $included_pages = explode("-", $lightbox_options->included_pages);
            $excluded_posts = explode("-", $lightbox_options->excluded_posts);
            $included_posts = explode("-", $lightbox_options->included_posts);
            $excluded_cats = explode("-", $lightbox_options->excluded_cats);
            $included_cats = explode("-", $lightbox_options->included_cats);
            $available_pages = $wpdb->get_results("SELECT id, post_title FROM $wpdb->posts WHERE post_type = 'page' AND post_title!='Auto Draft'");
            $available_posts = $wpdb->get_results("SELECT id, post_title FROM $wpdb->posts WHERE post_type = 'post'");
            $available_cats = get_categories();

            include('includes/hc_admin_lb_page.php');
            die;
        }
        if ($_POST['type'] == "3") {
            include('includes/hc_admin_sq_page.php');

            $available_pages = $wpdb->get_results("SELECT id, post_title FROM $wpdb->posts WHERE post_type = 'page' AND post_title!='Auto Draft'");

            die;
        }
    }

    function admin_load_from_templates_page() {
        /* shortcode editor page */
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $my_connector = $wpdb->get_results("SELECT * FROM wp_connectors where IntegrationID=" . $_POST['id_connector']);
        $my_connector = $my_connector[0];
        $style_text = $wpdb->get_results("SELECT * FROM hc_style_text_templates where id_connector=" . $_POST['idTemplateConnector'] . " AND type= " . $_POST['templateConnectorType'] . "");
        $style_text = $style_text[0];
        $style_button = $wpdb->get_results("SELECT * FROM hc_style_button_templates where id_connector=" . $_POST['idTemplateConnector'] . " AND type= " . $_POST['templateConnectorType'] . "");
        $style_button = $style_button[0];
        $style_connector = $wpdb->get_results("SELECT * FROM hc_style_connector_templates where id_connector=" . $_POST['idTemplateConnector'] . " AND type= " . $_POST['templateConnectorType'] . "");
        $style_connector = $style_connector[0];
        $style_email = $wpdb->get_results("SELECT * FROM hc_style_email_templates where id_connector=" . $_POST['idTemplateConnector'] . " AND type= " . $_POST['templateConnectorType'] . "");
        $style_email = $style_email[0];
        $style_image = $wpdb->get_results("SELECT * FROM hc_style_image_templates where id_connector=" . $_POST['idTemplateConnector'] . " AND type= " . $_POST['templateConnectorType'] . "");
        $style_image = $style_image[0];

        $style_optin = $wpdb->get_results("SELECT * FROM hc_style_optin_templates where id_connector=" . $_POST['idTemplateConnector'] . " AND type= " . $_POST['templateConnectorType'] . "");
        $style_optin = $style_optin[0];
        $connector_txt = $wpdb->get_results("SELECT * FROM hc_connector_text_templates where id_connector=" . $_POST['idTemplateConnector'] . " AND type= " . $_POST['templateConnectorType'] . "");
        $connector_txt = $connector_txt[0];
        $connector_txt->optin_description = stripslashes($connector_txt->optin_description);
        //$connector_txt->optin_description = str_replace("style=", "temp=", $connector_txt->optin_description);
        $connector_txt->optin_headline = stripslashes($connector_txt->optin_headline);
        $connector_txt->email_call = stripslashes($connector_txt->email_call);
        $connector_txt->fb_call = stripslashes($connector_txt->fb_call);
        $connector_txt->oneclick_call = stripslashes($connector_txt->oneclick_call);
        $connector_txt->email_btn = stripslashes($connector_txt->email_btn);
        $connector_txt->fb_btn = stripslashes($connector_txt->fb_btn);
        $connector_txt->oneclick_btn = stripslashes($connector_txt->oneclick_btn);
        $connector_txt->optin_description = str_replace(array("\r", "\n"), '', $connector_txt->optin_description);
        $squeeze_options = $wpdb->get_results("select * from hc_squeeze_options where id_connector = " . $_POST['id_connector']);
        $squeeze_options = $squeeze_options[0];
        $available_pages = $wpdb->get_results("SELECT id, post_title FROM $wpdb->posts WHERE post_type = 'page' AND post_title!='Auto Draft'");
        $available_posts = $wpdb->get_results("SELECT id, post_title FROM $wpdb->posts WHERE post_type = 'post'");
        $fromTemplate = 1;

        $idVariation = $_POST['idVariation'];
        $variation = $wpdb->get_row("SELECT * FROM hc_variations WHERE id=" . $idVariation);
        $tpl_type = $wpdb->get_row("SELECT * FROM hc_tpl_types WHERE idConnector=" . $_POST['id_connector'] . " AND type=" . $_POST['type']);

        /* return an array of all build in template ids */
        $connectorTemplates = $wpdb->get_results("SELECT `id`, `id_connector`, `template_image`, `type` FROM hc_style_connector_templates");

        /* pass through type of original page even though templates are always of type 0 */
        $style_connector->type = $_POST['type'];

        if ($_POST['type'] == "0") {
            include('includes/hc_admin_sc_page.php');
            die;
        }
        if ($_POST['type'] == "1") {
            include('includes/hc_admin_wg_page.php');
            die;
        }
        if ($_POST['type'] == "2") {


            $lightbox_options = $wpdb->get_results("SELECT * FROM hc_lightbox_options where id_connector=" . $_POST['id_connector']);
            $lightbox_options = $lightbox_options[0];
            $excluded_pages = explode("-", $lightbox_options->excluded_pages);
            $included_pages = explode("-", $lightbox_options->included_pages);
            $excluded_posts = explode("-", $lightbox_options->excluded_posts);
            $included_posts = explode("-", $lightbox_options->included_posts);
            $excluded_cats = explode("-", $lightbox_options->excluded_cats);
            $included_cats = explode("-", $lightbox_options->included_cats);
            $available_pages = $wpdb->get_results("SELECT id, post_title FROM $wpdb->posts WHERE post_type = 'page' AND post_title!='Auto Draft'");
            $available_posts = $wpdb->get_results("SELECT id, post_title FROM $wpdb->posts WHERE post_type = 'post'");
            $available_cats = get_categories();

            include('includes/hc_admin_lb_page.php');
            die;
        }
        if ($_POST['type'] == "3") {

            $available_pages = $wpdb->get_results("SELECT id, post_title FROM $wpdb->posts WHERE post_type = 'page' AND post_title!='Auto Draft'");
            include('includes/hc_admin_sq_page.php');
            die;
        }
        die;
    }

    function admin_squeeze_page() {
        /* shortcode editor page */
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $my_connector = $wpdb->get_results("SELECT * FROM wp_connectors where IntegrationID=" . $_POST['id_connector']);
        $my_connector = $my_connector[0];

        $idVariation = (isset($_POST['id_variation']) && $_POST['id_variation'] > 0) ? $_POST['id_variation'] : null;
        if (!$idVariation) {
            $variation = $wpdb->get_row("SELECT * FROM hc_variations WHERE control=1 AND type=3 AND idConnector=" . $_POST['id_connector']);
            $idVariation = $variation->id;
        }
        $variation = $wpdb->get_row("SELECT * FROM hc_variations WHERE id=" . $idVariation);
        $tpl_type = $wpdb->get_row("SELECT * FROM hc_tpl_types WHERE idConnector=" . $_POST['id_connector'] . " AND type=3");

        $style_text = $wpdb->get_results("SELECT * FROM hc_style_text where idVariation=" . $idVariation);
        if (count($style_text) == 0) {
            $style_text = $wpdb->get_results("SELECT * FROM hc_style_text where id_connector=0");
            $this->hybridCopySingleRow("hc_style_text", $_POST['id_connector'], 3);
        }
        $style_text = $style_text[0];

        $style_button = $wpdb->get_results("SELECT * FROM hc_style_button where idVariation=" . $idVariation);
        if (count($style_button) == 0) {
            $style_button = $wpdb->get_results("SELECT * FROM hc_style_button where id_connector=0");
            $this->hybridCopySingleRow("hc_style_button", $_POST['id_connector'], 3);
        }
        $style_button = $style_button[0];

        $style_connector = $wpdb->get_results("SELECT * FROM hc_style_connector where idVariation=" . $idVariation);
        if (count($style_connector) == 0) {
            $style_connector = $wpdb->get_results("SELECT * FROM hc_style_connector where id_connector=0");
            $this->hybridCopySingleRow("hc_style_connector", $_POST['id_connector'], 3);
        }
        $style_connector = $style_connector[0];

        $style_email = $wpdb->get_results("SELECT * FROM hc_style_email where idVariation=" . $idVariation);
        if (count($style_email) == 0) {
            $style_email = $wpdb->get_results("SELECT * FROM hc_style_email where id_connector=0");
            $this->hybridCopySingleRow("hc_style_email", $_POST['id_connector'], 3);
        }
        $style_email = $style_email[0];

        $style_image = $wpdb->get_results("SELECT * FROM hc_style_image where idVariation=" . $idVariation);
        if (count($style_image) == 0) {
            $style_image = $wpdb->get_results("SELECT * FROM hc_style_image where id_connector=0");
            $this->hybridCopySingleRow("hc_style_image", $_POST['id_connector'], 3);
        }
        $style_image = $style_image[0];

        $style_optin = $wpdb->get_results("SELECT * FROM hc_style_optin where idVariation=" . $idVariation);
        if (count($style_optin) == 0) {
            $style_optin = $wpdb->get_results("SELECT * FROM hc_style_optin where id_connector=0");
            $this->hybridCopySingleRow("hc_style_optin", $_POST['id_connector'], 3);
        }
        $style_optin = $style_optin[0];

        $connector_txt = $wpdb->get_results("SELECT * FROM hc_connector_text where idVariation=" . $idVariation);
        if (count($connector_txt) == 0) {
            $connector_txt = $wpdb->get_results("SELECT * FROM hc_connector_txt where id_connector=0");
            $this->hybridCopySingleRow("hc_connector_txt", $_POST['id_connector'], 3);
        }
        $connector_txt = $connector_txt[0];

        $connector_txt->optin_description = stripslashes($connector_txt->optin_description);
        //$connector_txt->optin_description = str_replace("style=", "temp=", $connector_txt->optin_description);
        $connector_txt->optin_headline = stripslashes($connector_txt->optin_headline);
        $connector_txt->email_call = stripslashes($connector_txt->email_call);
        $connector_txt->fb_call = stripslashes($connector_txt->fb_call);
        $connector_txt->oneclick_call = stripslashes($connector_txt->oneclick_call);
        $connector_txt->email_btn = stripslashes($connector_txt->email_btn);
        $connector_txt->fb_btn = stripslashes($connector_txt->fb_btn);
        $connector_txt->oneclick_btn = stripslashes($connector_txt->oneclick_btn);
        $connector_txt->optin_description = str_replace(array("\r", "\n"), '', $connector_txt->optin_description);

        $squeeze_options = $wpdb->get_results("SELECT * FROM hc_squeeze_options where id_connector=" . $_POST['id_connector'] . ";");
        if (count($squeeze_options) == 0) {
            $squeeze_options = $wpdb->get_results("SELECT * FROM hc_squeeze_options where id_connector=0");
            $this->hybridCopySingleRow("hc_squeeze_options", $_POST['id_connector'], 3, true);
        }
        $squeeze_options = $squeeze_options[0];

        $available_pages = $wpdb->get_results("SELECT id, post_title FROM $wpdb->posts WHERE post_type = 'page' AND post_title!='Auto Draft'");
        $available_posts = $wpdb->get_results("SELECT id, post_title FROM $wpdb->posts WHERE post_type = 'post'");

        /* return an array of all built in template ids */
        $connectorTemplates = $wpdb->get_results("SELECT `id`, `id_connector`, `template_image`, `type` FROM hc_style_connector_templates");
        include('includes/hc_admin_sq_page.php');
        die;
    }

    function hybridCopySingleRow($tablename, $idtocopyto, $type, $ignoreType = false) {

        global $wpdb;
        $thiscopy = $wpdb->query("create temporary table if not exists hc_tmp123 SELECT * FROM " . $tablename . "  WHERE id_connector=0");
        if ($ignoreType = false) {
            $updaterow = $wpdb->query("update hc_tmp123 set id='', id_connector= " . $idtocopyto . ", type=" . $type);
        } else {
            $updaterow = $wpdb->query("update hc_tmp123 set id='', id_connector= " . $idtocopyto);
        }
        $insertBack = $wpdb->query("insert into " . $tablename . " select * from hc_tmp123 where id_connector=" . $idtocopyto);
        return;
    }

    function admin_shortcode_template_page() {

        $insertDefaultStyles = false;
        /* shortcode editor page */
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');


        $my_connector = $wpdb->get_results("SELECT * FROM wp_connectors where IntegrationID=" . $_POST['id_connector']);
        $my_connector = $my_connector[0];

        $idVariation = (isset($_POST['id_variation']) && $_POST['id_variation'] > 0) ? $_POST['id_variation'] : null;
        if (!$idVariation) {
            $variation = $wpdb->get_row("SELECT * FROM hc_variations WHERE control=1 AND type=0 AND idConnector=" . $_POST['id_connector']);
            $idVariation = $variation->id;
        }
        $variation = $wpdb->get_row("SELECT * FROM hc_variations WHERE id=" . $idVariation);
        $tpl_type = $wpdb->get_row("SELECT * FROM hc_tpl_types WHERE idConnector=" . $_POST['id_connector'] . " AND type=0");

        $style_text = $wpdb->get_results("SELECT * FROM hc_style_text where idVariation=" . $idVariation);
        if (count($style_text) == 0) {
            $style_text = $wpdb->get_results("SELECT * FROM hc_style_text where id_connector=0 AND type=0");
            $this->hybridCopySingleRow("hc_style_text", $_POST['id_connector'], 0);
        }
        $style_text = $style_text[0];

        $style_button = $wpdb->get_results("SELECT * FROM hc_style_button where idVariation=" . $idVariation);
        if (count($style_button) == 0) {
            $style_button = $wpdb->get_results("SELECT * FROM hc_style_button where id_connector=0 AND type=0");
            $this->hybridCopySingleRow("hc_style_button", $_POST['id_connector'], 0);
        }
        $style_button = $style_button[0];

        $style_connector = $wpdb->get_results("SELECT * FROM hc_style_connector where idVariation=" . $idVariation);
        if (count($style_connector) == 0) {
            $style_connector = $wpdb->get_results("SELECT * FROM hc_style_connector where id_connector=0 AND type=0");
            $this->hybridCopySingleRow("hc_style_connector", $_POST['id_connector'], 0);
        }
        $style_connector = $style_connector[0];

        $style_email = $wpdb->get_results("SELECT * FROM hc_style_email where idVariation=" . $idVariation);
        if (count($style_email) == 0) {
            $style_email = $wpdb->get_results("SELECT * FROM hc_style_email where id_connector=0 AND type=0");
            $this->hybridCopySingleRow("hc_style_email", $_POST['id_connector'], 0);
        }
        $style_email = $style_email[0];

        $style_image = $wpdb->get_results("SELECT * FROM hc_style_image where idVariation=" . $idVariation);
        if (count($style_image) == 0) {
            $style_image = $wpdb->get_results("SELECT * FROM hc_style_image where id_connector=0 AND type=0");
            $this->hybridCopySingleRow("hc_style_image", $_POST['id_connector'], 0);
        }
        $style_image = $style_image[0];

        $style_optin = $wpdb->get_results("SELECT * FROM hc_style_optin where idVariation=" . $idVariation);
        if (count($style_optin) == 0) {
            $style_optin = $wpdb->get_results("SELECT * FROM hc_style_optin where id_connector=0 AND type=0");
            $this->hybridCopySingleRow("hc_style_optin", $_POST['id_connector'], 0);
        }
        $style_optin = $style_optin[0];

        $connector_txt = $wpdb->get_results("SELECT * FROM hc_connector_text where idVariation=" . $idVariation);
        if (count($connector_txt) == 0) {
            $connector_txt = $wpdb->get_results("SELECT * FROM hc_connector_txt where id_connector=0 AND type=0");
            $this->hybridCopySingleRow("hc_connector_txt", $_POST['id_connector'], 0);
        }
        $connector_txt = $connector_txt[0];

        $connector_txt->optin_description = stripslashes($connector_txt->optin_description);
        //$connector_txt->optin_description = str_replace("style=", "temp=", $connector_txt->optin_description);
        $connector_txt->optin_headline = stripslashes($connector_txt->optin_headline);
        $connector_txt->email_call = stripslashes($connector_txt->email_call);
        $connector_txt->fb_call = stripslashes($connector_txt->fb_call);
        $connector_txt->oneclick_call = stripslashes($connector_txt->oneclick_call);
        $connector_txt->email_btn = stripslashes($connector_txt->email_btn);
        $connector_txt->fb_btn = stripslashes($connector_txt->fb_btn);
        $connector_txt->oneclick_btn = stripslashes($connector_txt->oneclick_btn);
        $connector_txt->optin_description = str_replace(array("\r", "\n"), '', $connector_txt->optin_description);

        /* return an array of all build in template ids */
        $connectorTemplates = $wpdb->get_results("SELECT `id`, `id_connector`, `template_image`, `type` FROM hc_style_connector_templates");
        include('includes/hc_admin_sc_page.php');
        die;
    }

    function admin_widget_template_page() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $my_connector = $wpdb->get_results("SELECT * FROM wp_connectors where IntegrationID=" . $_POST['id_connector']);
        $my_connector = $my_connector[0];

        $idVariation = (isset($_POST['id_variation']) && $_POST['id_variation'] > 0) ? $_POST['id_variation'] : null;
        if (!$idVariation) {
            $variation = $wpdb->get_row("SELECT * FROM hc_variations WHERE control=1 AND type=1 AND idConnector=" . $_POST['id_connector']);
            $idVariation = $variation->id;
        }
        $variation = $wpdb->get_row("SELECT * FROM hc_variations WHERE id=" . $idVariation);
        $tpl_type = $wpdb->get_row("SELECT * FROM hc_tpl_types WHERE idConnector=" . $_POST['id_connector'] . " AND type=1");

        $style_text = $wpdb->get_results("SELECT * FROM hc_style_text where idVariation=" . $idVariation);
        if (count($style_text) == 0) {
            $style_text = $wpdb->get_results("SELECT * FROM hc_style_text where id_connector=0");
            $this->hybridCopySingleRow("hc_style_text", $_POST['id_connector'], 1);
        }
        $style_text = $style_text[0];

        $style_button = $wpdb->get_results("SELECT * FROM hc_style_button where idVariation=" . $idVariation);
        if (count($style_button) == 0) {
            $style_button = $wpdb->get_results("SELECT * FROM hc_style_button where id_connector=0");
            $this->hybridCopySingleRow("hc_style_button", $_POST['id_connector'], 1);
        }
        $style_button = $style_button[0];

        $style_connector = $wpdb->get_results("SELECT * FROM hc_style_connector where idVariation=" . $idVariation);
        if (count($style_connector) == 0) {
            $style_connector = $wpdb->get_results("SELECT * FROM hc_style_connector where id_connector=0");
            $this->hybridCopySingleRow("hc_style_connector", $_POST['id_connector'], 1);
        }
        $style_connector = $style_connector[0];

        $style_email = $wpdb->get_results("SELECT * FROM hc_style_email where idVariation=" . $idVariation);
        if (count($style_email) == 0) {
            $style_email = $wpdb->get_results("SELECT * FROM hc_style_email where id_connector=0");
            $this->hybridCopySingleRow("hc_style_email", $_POST['id_connector'], 1);
        }
        $style_email = $style_email[0];

        $style_image = $wpdb->get_results("SELECT * FROM hc_style_image where idVariation=" . $idVariation);
        if (count($style_image) == 0) {
            $style_image = $wpdb->get_results("SELECT * FROM hc_style_image where id_connector=0");
            $this->hybridCopySingleRow("hc_style_image", $_POST['id_connector'], 1);
        }
        $style_image = $style_image[0];

        $style_optin = $wpdb->get_results("SELECT * FROM hc_style_optin where idVariation=" . $idVariation);
        if (count($style_optin) == 0) {
            $style_optin = $wpdb->get_results("SELECT * FROM hc_style_optin where id_connector=0");
            $this->hybridCopySingleRow("hc_style_optin", $_POST['id_connector'], 1);
        }
        $style_optin = $style_optin[0];

        $connector_txt = $wpdb->get_results("SELECT * FROM hc_connector_text where idVariation=" . $idVariation);
        if (count($connector_txt) == 0) {
            $connector_txt = $wpdb->get_results("SELECT * FROM hc_connector_txt where id_connector=0");
            $this->hybridCopySingleRow("hc_connector_txt", $_POST['id_connector'], 1);
        }
        $connector_txt = $connector_txt[0];

        $connector_txt->optin_description = stripslashes($connector_txt->optin_description);
        // $connector_txt->optin_description = str_replace("style=", "temp=", $connector_txt->optin_description);
        $connector_txt->optin_headline = stripslashes($connector_txt->optin_headline);
        $connector_txt->email_call = stripslashes($connector_txt->email_call);
        $connector_txt->fb_call = stripslashes($connector_txt->fb_call);
        $connector_txt->oneclick_call = stripslashes($connector_txt->oneclick_call);
        $connector_txt->email_btn = stripslashes($connector_txt->email_btn);
        $connector_txt->fb_btn = stripslashes($connector_txt->fb_btn);
        $connector_txt->oneclick_btn = stripslashes($connector_txt->oneclick_btn);
        $connector_txt->optin_description = str_replace(array("\r", "\n"), '', $connector_txt->optin_description);
        $connectorTemplates = $wpdb->get_results("SELECT `id`, `id_connector`, `template_image`, `type` FROM hc_style_connector_templates");
        include('includes/hc_admin_wg_page.php');
        die;
    }

    function admin_shortcode_template_settings() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $my_connector = $wpdb->get_results("SELECT * FROM wp_connectors where IntegrationID=" . $_POST['id_connector']);
        $my_connector = $my_connector[0];
        $my_settings = $wpdb->get_results("SELECT * FROM hc_templates where idConnector=" . $_POST['id_connector']);
        $my_settings = $my_settings[0];
        include('includes/hc_admin_shortcode_style.php');
        die;
    }

    function admin_update_shortcode_template_settings() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $so = $_POST['style_config_object'];
        $id_con = $_POST['id_connector'];
        $type = $_POST['type'];
        $idVariation = (int) $_POST['idVariation'];
        $variation = $wpdb->get_row("SELECT * FROM hc_variations WHERE id=" . $idVariation);

        $so['btn_email_new_line'] = isset($so['btn_email_new_line']) ? 1 : 0;
        $so['btn_submit_new_line'] = isset($so['btn_submit_new_line']) ? 1 : 0;
        $result1 = $wpdb->update('hc_style_button', array(
            'btn_bg_color' => $so['btn_bg_color'],
            'btn_font_color' => $so['btn_font_color'],
            'txt_shadow_color' => $so['btn_txt_shadow_color'],
            'btn_border_color' => $so['btn_border_color'],
            'btn_box_shadow' => $so['btn_box_shadow'],
            'btn_font_family' => $so['btn_font_family'],
            'btn_bg_light' => $so['btn_bg_light'],
            'btn_type' => $so['btn_type'],
            'emailNewLine' => $so['btn_email_new_line'],
            'buttonNewLine' => $so['btn_submit_new_line'],
            'button_font_size' => $so['btn_font_size'],
            'button_lr_padding' => $so['btn_lr_padding'],
            'button_tb_padding' => $so['btn_tb_padding'],
            'fb_button_size' => $so['btn_facebookButtonSize']
                ), array('idVariation' => $idVariation), array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%d', '%s', '%s', '%s', '%s'), array('%d'));
        $result = $wpdb->query("SET NAMES 'utf8'");
        $result2 = $wpdb->update('hc_connector_text', array(
            'optin_headline' => $so['txt_optin_headline'],
            'optin_description' => $so['txt_optin_description'],
            'email_call' => $so['txt_email_call'],
            'fb_call' => $so['txt_fb_call'],
            'oneclick_call' => $so['txt_oneclick_call'],
            'email_btn' => $so['txt_email_btn'],
            'fb_btn' => $so['txt_fb_btn'],
            'oneclick_btn' => $so['txt_oneclick_btn'],
            'privacy_policy_text' => $so['txt_privacyText'],
                ), array('idVariation' => $idVariation), array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'), array('%d'));
        $so['con_set_heights'] = isset($so['con_set_heights']) ? 1 : 0;
        $so['con_is_responsive'] = isset($so['con_is_responsive']) ? 1 : 0;
        $so['con_template_gradient'] = isset($so['con_template_gradient']) ? 1 : 0;
        $so['con_template_picturebg'] = isset($so['con_template_picturebg']) ? 1 : 0;
        $so['con_template_transparentbg'] = isset($so['con_template_transparentbg']) ? 1 : 0;
        $so['con_template_transparentoptinbg'] = isset($so['con_template_transparentoptinbg']) ? 1 : 0;
        $so['con_dropShadow'] = isset($so['con_dropShadow']) ? 1 : 0;
        $so['con_showPrivacyPolicy'] = isset($so['con_showPrivacyPolicy']) ? 1 : 0;
        $so['con_boldPrivacyPolicy'] = isset($so['con_boldPrivacyPolicy']) ? 1 : 0;
        $so['con_centerPrivacyPolicy'] = isset($so['con_centerPrivacyPolicy']) ? 1 : 0;

        $result3 = $wpdb->update('hc_style_connector', array(
            'opt_in_box_width' => $so['con_opt_in_box_width'],
            'opt_in_box_height' => $so['con_opt_in_box_height'],
            'call_action_height' => $so['con_call_action_height'],
            'tpl_bg_color' => $so['con_tpl_bg_color'],
            'opt_in_bg_color' => $so['con_opt_in_bg_color'],
            'border_color' => $so['con_border_color'],
            'border_width' => $so['con_border_width'],
            'border_radius' => $so['con_border_radius'],
            'set_heights' => $so['con_set_heights'],
            'eoh' => $so['con_eoh'],
            'ech' => $so['con_ech'],
            'foh' => $so['con_foh'],
            'fch' => $so['con_fch'],
            'ooh' => $so['con_ooh'],
            'och' => $so['con_och'],
            'is_responsive' => $so['con_is_responsive'],
            'min_width' => $so['con_min_width'],
            'max_width' => $so['con_max_width'],
            'template_gradient' => $so['con_template_gradient'],
            'template_bgcolor_1' => $so['con_template_bgcolor_1'],
            'template_bgcolor_2' => $so['con_template_bgcolor_2'],
            'template_picturebg' => $so['con_template_picturebg'],
            'template_picturebgurl' => $so['con_template_picturebgurl'],
            'template_transparent_bg' => $so['con_template_transparentbg'],
            'template_transparent_optin_bg' => $so['con_template_transparentoptinbg'],
            'drop_shadow' => $so['con_dropShadow'],
            'h_shadow' => $so['con_hShadow'],
            'v_shadow' => $so['con_vShadow'],
            'blur_shadow' => $so['con_blurShadow'],
            'shadow_color' => $so['con_shadowColor'],
            'border_style' => $so['con_borderStyle'],
            'show_privacy_policy' => $so['con_showPrivacyPolicy'],
            'bold_privacy_policy' => $so['con_boldPrivacyPolicy'],
            'center_privacy_policy' => $so['con_centerPrivacyPolicy'],
            'privacy_policy_font' => $so['con_privacyPolicyFont'],
            'privacy_policy_color' => $so['con_privacyPolicyColour'],
            'privacy_policy_size' => $so['con_privacyPolicySize'],
            'email_privacy_top_margin' => $so['con_emailPrivacyPolicyMargin'],
            'facebook_privacy_top_margin' => $so['con_facebookPrivacyPolicyMargin'],
            'oneclick_privacy_top_margin' => $so['con_oneClickPrivacyPolicyMargin'],
            'external_top_margin' => $so['con_externalTopMargin'],
            'external_bottom_margin' => $so['con_externalBottomMargin'],
            'bulletpointsize' => $so['con_bulletsize'],
            'bulletpointoffset' => $so['con_bullety'],
            'bulletpointoffsetx' => $so['con_bulletx'],
            'default_template' => $so['hc_default_template']
                ), array('idVariation' => $idVariation), array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%s', '%s', '%d', '%s', '%s', '%d', '%s', '%d', '%d', '%d', '%s', '%s', '%s', '%s', '%s', '%d', '%d', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s','%s'), array('%d'));
        $result4 = $wpdb->update('hc_style_email', array(
            'input_border_color' => $so['em_input_border_color'],
            'input_bg_color' => $so['em_input_bg_color'],
            'input_font_color' => $so['em_input_font_color'],
            'input_font_family' => $so['em_input_font_family'],
            'name_label_field' => $so['em_nameFieldLabel'],
            'email_label_field' => $so['em_emailFieldLabel']
                ), array('idVariation' => $idVariation), array('%s', '%s', '%s', '%s'), array('%d'));
        $so['image_show_side_image'] = isset($so['image_show_side_image']) ? 1 : 0;
        $so['image_show_arrow_graphics'] = isset($so['image_show_arrow_graphics']) ? 1 : 0;
        $result5 = $wpdb->update('hc_style_image', array(
            'show_side_image' => $so['image_show_side_image'],
            'image_url' => $so['image_url'],
            'vertical_position' => $so['image_vertical_position'],
            'image_left_margin' => $so['image_left_margin'],
            'image_right_margin' => $so['image_right_margin'],
            'show_arrow_graphics' => $so['image_show_arrow_graphics'],
            'arrow_style' => $so['image_arrow_style'],
            'min_height' => $so['image_min_height'],
            'max_height' => $so['image_max_height'],
            'min_width' => $so['image_min_width'],
            'max_width' => $so['image_max_width'],
            'image_size' => $so['image_setImageSize']
                ), array('idVariation' => $idVariation), array('%d', '%s', '%s', '%s', '%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s'), array('%d'));
        $so['opt_email_centered'] = isset($so['opt_email_centered']) ? 1 : 0;
        $so['opt_fb_centered'] = isset($so['opt_fb_centered']) ? 1 : 0;
        $so['opt_oneclick_centered'] = isset($so['opt_oneclick_centered']) ? 1 : 0;
        $result6 = $wpdb->update('hc_style_optin', array(
            'name_length' => $so['opt_name_length'],
            'email_length' => $so['opt_email_length'],
            'email_centered' => $so['opt_email_centered'],
            'fb_centered' => $so['opt_fb_centered'],
            'oneclick_centered' => $so['opt_oneclick_centered'],
            'field_font_size' => $so['em_fieldFontSize'],
            'field_height' => $so['em_fieldHeight'],
            'field_padding_top_bottom' => $so['em_fieldPaddingTopBottom'],
            'field_padding_left_right' => $so['em_fieldPaddingLeftRight'],
            'field_border_width' => $so['em_fieldBorderWidth'],
            'field_border_style' => $so['em_fieldBorderStyle'],
            'field_border_radius' => $so['em_fieldBorderRadius']
                ), array('idVariation' => $idVariation), array('%s', '%s', '%d', '%d', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s'), array('%d'));
        $so['st_headline_bold'] = isset($so['st_headline_bold']) ? 1 : 0;
        $so['st_headline_center'] = isset($so['st_headline_center']) ? 1 : 0;
        $so['st_body_center'] = isset($so['st_body_center']) ? 1 : 0;
        $so['txt_headlineShadow'] = isset($so['txt_headlineShadow']) ? 1 : 0;
        $so['txt_textShadow'] = isset($so['txt_textShadow']) ? 1 : 0;
        $so['txt_ctaShadow'] = isset($so['txt_ctaShadow']) ? 1 : 0;
        $result7 = $wpdb->update('hc_style_text', array(
            'headline_font_color' => $so['st_headline_font_color'],
            'headline_font_size' => $so['st_headline_font_size'],
            'headline_font_family' => $so['st_headline_font_family'],
            'headline_bold' => $so['st_headline_bold'],
            'border_font_color' => $so['st_body_font_color'],
            'border_font_size' => $so['st_body_font_size'],
            'border_font_family' => $so['st_body_font_family'],
            'call_action_font_color' => $so['st_call_action_font_color'],
            'call_action_font_family' => $so['st_call_action_font_family'],
            'call_action_font_size' => $so['st_call_action_font_size'],
            'headline_center' => $so['st_headline_center'],
            'body_center' => $so['st_body_center'],
            'text_vertical_position' => $so['st_body_vertical_position'],
            'tick_style' => $so['st_tick_style'],
            'headline_shadow' => $so['txt_headlineShadow'],
            'text_shadow' => $so['txt_textShadow'],
            'cta_shadow' => $so['txt_ctaShadow'],
            'text_h_Shadow' => $so['txt_hShadow'],
            'text_v_Shadow' => $so['txt_vShadow'],
            'text_blur_shadow' => $so['txt_blurShadow'],
            'text_shadow_color' => $so['txt_shadowColor'],
            'headline_left_margin' => $so['txt_headlineLeftMargin'],
            'headline_right_margin' => $so['txt_headlineRightMargin'],
            'text_left_margin' => $so['txt_textLeftMargin'],
            'text_right_margin' => $so['txt_textRightMargin'],
            'bullet_left_margin' => $so['txt_leftMargin']
                ), array('idVariation' => $idVariation), array('%s', '%s', '%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%d', '%s', '%s', '%d', '%d', '%d', '%s', '%s', '%s', '%s', '%s'), array('%d'));
        if ($type == 2 && $variation->control == 1) {
            // $so['lb_all_pages'] = isset($so['lb_all_pages']) ? 1 : 0;
            // $so['lb_all_posts'] = isset($so['lb_all_posts']) ? 1 : 0;
            // $so['lb_homepage'] = isset($so['lb_homepage']) ? 1 : 0;
            $so['lb_cookie_enable'] = isset($so['lb_cookie_enable']) ? 1 : 0;
            $so['lb_scroll_enable'] = isset($so['lb_scroll_enable']) ? 1 : 0;
            $so['lb_time_enable'] = isset($so['lb_time_enable']) ? 1 : 0;
            $so['lb_fadein_enable'] = isset($so['lb_fadein_enable']) ? 1 : 0;
            $so['lb_activated'] = isset($so['lb_activated']) ? 1 : 0;
            if ($so['lb_all_pages'] == 1) {
                $result = $wpdb->update('hc_lightbox_options', array('all_pages' => 0), array(), array('%d'), array());
            }
            if ($so['lb_all_posts'] == 1) {
                $result = $wpdb->update('hc_lightbox_options', array('all_posts' => 0), array(), array('%d'), array());
            }
            if ($so['lb_homepage'] == 1) {
                $result = $wpdb->update('hc_lightbox_options', array('homepage' => 0), array(), array('%d'), array());
            }

            $so['oib_optin_activated'] = isset($so['oib_optin_activated']) ? 1 : 0;
            $so['oib_optin_on_click'] = isset($so['oib_optin_on_click']) ? 1 : 0;
            $so['oib_optin_time_enable'] = isset($so['oib_optin_time_enable']) ? 1 : 0;
            $so['oib_optin_scroll_enable'] = isset($so['oib_optin_scroll_enable']) ? 1 : 0;

            $result1 = $wpdb->update('hc_lightbox_options', array(
                'all_pages' => $so['lb_all_pages'],
                'all_posts' => $so['lb_all_posts'],
                'excluded_pages' => $so['lb_excluded_pages'],
                'excluded_posts' => $so['lb_excluded_posts'],
                'single_page' => $so['lb_single_page'],
                'homepage' => $so['lb_homepage'],
                'all_posts_and_pages' => $so['lb_all_posts_and_pages'],
                'single_category' => $so['lb_single_category'],
                'included_pages' => $so['lb_included_pages'],
                'included_posts' => $so['lb_included_posts'],
                'on_time' => $so['lb_on_time'],
                'on_click' => $so['lb_on_click'],
                'activated' => $so['lb_activated'],
                'lightbox_overlay_colour' => $so['lb_lightbox_overlay_colour'],
                'lightbox_overlay_opacity' => $so['lb_lightbox_overlay_opacity'],
                'lightbox_fade_duration' => $so['lb_lightbox_fade_duration'],
                'optin_activated' => $so['oib_optin_activated'],
                'optin_on_click' => $so['oib_optin_on_click'],
                'optin_time_enable' => $so['oib_optin_time_enable'],
                'optin_on_time' => $so['oib_optin_on_time'],
                'optin_scroll_enable' => $so['oib_optin_scroll_enable'],
                'optin_scroll_size' => $so['oib_optin_scroll_size'],
                'optin_slide_in_from' => $so['oib_optin_slide_in_from'],
                'optin_slide_in_distance' => $so['oib_optin_slide_in_distance'],
                'optin_start_pos_attribute' => $so['oib_optin_start_pos_attribute'],
                'optin_start_pos_value' => $so['oib_optin_start_pos_value'],
                'optin_ani_duration' => $so['oib_optin_ani_duration'],
                'cookie_enable' => $so['lb_cookie_enable'],
                'cookie_life' => $so['lb_cookie_life'],
                'scroll_enable' => $so['lb_scroll_enable'],
                'scroll_size' => $so['lb_scroll_size'],
                'fadein_enable' => $so['lb_fadein_enable'],
                'included_cats' => $so['lb_included_cats'],
                'excluded_cats' => $so['lb_excluded_cats'],
                'time_enable' => $so['lb_time_enable']
                    ), array('id_connector' => $id_con), array('%d', '%d', '%s', '%s', '%d', '%d', '%d', '%d', '%s', '%s', '%s', '%d', '%s', '%s', '%f', '%d', '%d', '%d', '%d', '%d', '%d', '%s', '%s', '%s', '%s', '%s', '%d', '%d', '%s', '%d', '%s', '%d', '%s', '%s', '%d'), array('%d'));
        }

        // if type = squeeze page then get and update custom squeeze page settings into the appropriate table
        if ($type == 3 && $variation->control == 1) {
            $so['sq_squeeze_enabled'] = isset($so['sq_squeeze_enabled']) ? 1 : 0;
            $so['sq_bg_gradient_checkbox'] = isset($so['sq_bg_gradient_checkbox']) ? 1 : 0;
            $so['sq_bg_picture_checkbox'] = isset($so['sq_bg_picture_checkbox']) ? 1 : 0;
            $so['sq_tile_bg'] = isset($so['sq_tile_bg']) ? 1 : 0;
            $so['sq_bg_repeat_x_axis'] = isset($so['sq_bg_repeat_x_axis']) ? 1 : 0;
            $so['sq_bg_repeat_y_axis'] = isset($so['sq_bg_repeat_y_axis']) ? 1 : 0;
            $so['sq_centre_aligned'] = isset($so['sq_centre_aligned']) ? 1 : 0;
            $so['sq_vertically_aligned'] = isset($so['sq_vertically_aligned']) ? 1 : 0;

            //print_r($so); die;
            $result1 = $wpdb->update('hc_squeeze_options', array(
                'squeeze_enabled' => $so['sq_squeeze_enabled'],
                'single_page' => $so['sq_squeeze_page_show'],
                'squeeze_bg_color' => $so['sq_background_color'],
                'squeeze_gradient_checkbox' => $so['sq_bg_gradient_checkbox'],
                'squeeze_picture_checkbox' => $so['sq_bg_picture_checkbox'],
                'squeeze_gradient_color1' => $so['sq_gradient_bg_color_1'],
                'squeeze_gradient_color2' => $so['sq_gradient_bg_color_2'],
                'squeeze_bgimage_url' => $so['sq_image_bg_file'],
                'squeeze_tile' => $so['sq_tile_bg'],
                'repeat_x_axis' => $so['sq_bg_repeat_x_axis'],
                'repeat_y_axis' => $so['sq_bg_repeat_y_axis'],
                'centre_aligned' => $so['sq_centre_aligned'],
                'vertically_aligned' => $so['sq_vertically_aligned'],
                'vertical_top_margin' => $so['sq_vertical_top_margin']
                    ), array('id_connector' => $id_con), array('%d', '%s', '%s', '%d', '%d', '%s', '%s', '%s', '%d', '%d', '%d', '%d', '%d', '%s'), array('%d'));
        }

        echo 1;
        die;
    }

    function admin_widget_template_settings() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $my_connector = $wpdb->get_results("SELECT * FROM wp_connectors where IntegrationID=" . $_POST['id_connector']);
        $my_connector = $my_connector[0];
        $my_settings = $wpdb->get_results("SELECT * FROM hc_templates where idConnector=" . $_POST['id_connector']);
        $my_settings = $my_settings[0];
        include('includes/hc_admin_widget_templates.php');
        die;
    }

    function admin_update_widget_template_settings() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        if (isset($_POST['wg_tpl_footer_enable']) && $_POST['wg_tpl_footer_enable'] == 'true') {
            $_POST['wg_tpl_footer_enable'] = 1;
        } else {
            $_POST['wg_tpl_footer_enable'] = 0;
        }
        if ($_POST['sc_tpl_image'] != '' && !$this->checkRemoteFile($_POST['sc_tpl_image'])) {
            echo 2;
            die;
        }
        $result1 = $wpdb->update('wp_connectors', array(
            'template_widget' => $_POST['template_widget'],
                ), array('IntegrationID' => $_POST['id_connector']), array('%s'), array('%d'));
        $result2 = $wpdb->update('hc_templates', array(
            'wg_background' => $_POST['wg_background'],
            'wg_strokeColor' => $_POST['wg_strokeColor'],
            'wg_strokeSize' => $_POST['wg_strokeSize'],
            'wg_width' => $_POST['wg_width'],
            'wg_tpl_image' => $_POST['wg_tpl_image'],
            'wg_tpl_title' => $_POST['wg_tpl_title'],
            'wg_tpl_description' => $_POST['wg_tpl_description'],
            'wg_tpl_button' => $_POST['wg_tpl_button'],
            'wg_tpl_footer_text' => $_POST['wg_tpl_footer_text'],
            'wg_tpl_footer_enable' => (int) $_POST['wg_tpl_footer_enable'],
            'wg_borderWidth' => $_POST['wg_borderWidth'],
            'wg_borderColor' => $_POST['wg_borderColor'],
            'wg_tpl_width' => $_POST['wg_tpl_width'],
                ), array('idConnector' => $_POST['id_connector']), array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%s', '%s', '%s'), array('%d'));
        echo 1;
        die;
    }

    function admin_custom_template_settings() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $my_connector = $wpdb->get_results("SELECT * FROM wp_connectors where IntegrationID=" . $_POST['id_connector']);
        $my_connector = $my_connector[0];
        $my_settings->custom_form = html_entity_decode($my_connector->custom_form);
        $my_settings->custom_fbyes = html_entity_decode($my_connector->custom_fbyes);
        $my_settings->custom_fbnot = html_entity_decode($my_connector->custom_fbnot);
        $my_settings->custom_form = stripslashes_deep($my_connector->custom_form);
        $my_settings->custom_fbyes = stripslashes_deep($my_connector->custom_fbyes);
        $my_settings->custom_fbnot = stripslashes_deep($my_connector->custom_fbnot);
        include('includes/hc_admin_custom_template.php');
        die;
    }

    function admin_update_custom_template_settings() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $_POST['template_shortcode'] = isset($_POST['template_shortcode']) ? 1 : 0;
        $_POST['template_widget'] = isset($_POST['template_widget']) ? 1 : 0;
        $_POST['template_lightbox'] = isset($_POST['template_lightbox']) ? 1 : 0;
        //print_r($_POST); die;
        $result2 = $wpdb->update('wp_connectors', array(
            'template_shortcode' => $_POST['template_shortcode'],
            'template_widget' => $_POST['template_widget'],
            'template_lightbox' => $_POST['template_lightbox'],
            'custom_form' => htmlspecialchars($_POST['custom_form']),
            'custom_fbyes' => htmlspecialchars($_POST['custom_fbyes']),
            'custom_fbnot' => htmlspecialchars($_POST['custom_fbnot']),
            'custom_width' => htmlspecialchars($_POST['custom_width']),
                ), array('IntegrationID' => $_POST['id_connector']), array('%s', '%s', '%s', '%s', '%s', '%s', '%s'), array('%d'));
        echo 1;
        die;
    }

    /*
     * Returns a html form element containing the service settings to be set up when assigning a service to a connector
     */

    function admin_get_service_list_settings() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        if (!isset($_POST['id_connector']) || !isset($_POST['service'])) {
            echo 0;
            die;
        }
        $service = $_POST['service'];
        $my_connector = $wpdb->get_results("SELECT * FROM wp_connectors WHERE IntegrationID=" . $_POST['id_connector']);
        $my_connector = $my_connector[0];
        $my_mailinglist = $wpdb->get_results("SELECT * FROM wp_mailingList where IntegrationID=" . $_POST['id_connector']);
        $my_mailingList = (isset($my_mailinglist[0])) ? $my_mailinglist[0] : null;
        require_once('includes/apis/hc_services_helper.php');
        switch ($service) {
            case 'aweber':
                $aweber_settings = get_option('hc_aweber_api_settings');
                extract($aweber_settings);
                try {
                    $aweber = $this->_get_aweber_api($consumer_key, $consumer_secret);
                    $account = $aweber->getAccount($access_key, $access_secret);
                } catch (AWeberException $e) {
                    $account = null;
                }
                if (!$account) {
                    echo 2;
                    die;
                } else {
                    $response = "<select id='txt_hc_admin_mail_list_name'>";
                    //go on and create the select element with the lists
                    foreach ($account->lists as $offset => $list) {
                        if ($list->id == $my_mailingList->settings) {
                            $response .= "<option value='" . $list->id . "' selected>" . $list->name . "</option>";
                        } else {
                            $response .= "<option value='" . $list->id . "'>" . $list->name . "</option>";
                        }
                    }
                    $response .= "</select>";
                    echo $response;
                    die;
                }
                break;
            case 'infusionsoft':
                $client = $this->_get_infusionsoft_client();
                $apikey = get_option('hc_infusionsoft_appkey');
                $result = infusionsoft_getCampaigns($client, $apikey);
                //var_dump($result); die;
                if (!$result) {
                    echo 2;
                    die;
                } else {
                    //echo "<pre>" . print_r($result, true); die;
                    if (isset($result->errno) && $result->errno > 0) {
                        echo "The Infusionsoft api settings are invalid";
                        die;
                    }
                    $response = "<select id='txt_hc_admin_mail_list_name'>";
                    foreach ($result->val as $tag) {
                        if ($tag['Status'] == "Active") {
                            if ($tag['Id'] == $my_mailingList->settings) {
                                $response .= "<option value='" . $tag['Id'] . "' selected>" . $tag['Name'] . "</option>";
                            } else {
                                $response .= "<option value='" . $tag['Id'] . "'>" . $tag['Name'] . "</option>";
                            }
                        }
                    }
                    $response .= "</select>";
                    echo $response;
                    die;
                }
                break;
            case 'mailchimp':
                $result = mailchimp_getLists(get_option('hc_mailchimp_appkey'));
                if (!$result) {
                    echo 2;
                    die;
                } else {
                    $response = "<select id='txt_hc_admin_mail_list_name'>";
                    foreach ($result as $list) {
                        if ($list['id'] == $my_mailingList->settings) {
                            $response .= "<option value='" . $list['id'] . "' selected>" . $list['name'] . "</option>";
                        } else {
                            $response .= "<option value='" . $list['id'] . "'>" . $list['name'] . "</option>";
                        }
                    }
                    $response .= "</select>";
                    echo $response;
                    die;
                }
                die;
                break;
            case 'icontact':
                $result = icontact_getLists(get_option('hc_icontact_appid'), get_option('hc_icontact_appkey'), get_option('hc_icontact_appurl'));
                if (!$result) {
                    echo 2;
                    die;
                } else {
                    $response = "<select id='txt_hc_admin_mail_list_name'>";
                    foreach ($result as $list) {
                        if ($list->listId == $my_mailingList->settings) {
                            $response .= "<option value='" . $list->listId . "' selected>" . $list->name . "</option>";
                        } else {
                            $response .= "<option value='" . $list->listId . "'>" . $list->name . "</option>";
                        }
                    }
                    $response .= "</select>";
                    echo $response;
                    die;
                }
                die;
                break;
            case 'officeautopilot':
                $result = officeautopilot_getLists(get_option('hc_officeautopilot_appkey'), get_option('hc_officeautopilot_appid'));
                if (!$result) {
                    echo 2;
                    die;
                } else {
                    $response = "<select id='txt_hc_admin_mail_list_name'>";
                    foreach ($result as $list) {
                        if ($list == $my_mailingList->settings) {
                            $response .= "<option value='" . $list . "' selected>" . $list . "</option>";
                        } else {
                            $response .= "<option value='" . $list . "'>" . $list . "</option>";
                        }
                    }
                    $response .= "</select>";
                    echo $response;
                    die;
                }
                die;
                break;
            case 'constantcontact':
                $result = constantcontact_getList(get_option('hc_constantcontact_appkey'), get_option('hc_constant_contact_username'), get_option('hc_constant_contact_token'));
                if (!$result) {
                    echo 2;
                    die;
                } else {
                    $response = "<select id='txt_hc_admin_mail_list_name'>";
                    foreach ($result as $list) {
                        if ($list->id == $my_mailingList->settings) {
                            $response .= "<option value='" . $list->id . "' selected>" . $list->name . "</option>";
                        } else {
                            $response .= "<option value='" . $list->id . "'>" . $list->name . "</option>";
                        }
                    }
                    $response .= "</select>";
                    echo $response;
                    die;
                }
                die;
                break;
            case 'getresponse':
                $result = getresponse_getList(get_option('hc_getresponse_appkey'));
                if (!$result) {
                    echo 2;
                    die;
                } else {
                    $response = "<select id='txt_hc_admin_mail_list_name'>";
                    foreach ($result as $key => $list) {
                        if ($key == $my_mailingList->settings) {
                            $response .= "<option value='" . $key . "' selected>" . $list->name . "</option>";
                        } else {
                            $response .= "<option value='" . $key . "'>" . $list->name . "</option>";
                        }
                    }
                    $response .= "</select>";
                    echo $response;
                    die;
                }
                die;
                break;
            default:
                echo "-";
                die;
        }
        die;
    }

    function admin_get_stats_options() {
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
            $date1 = date('d-m-Y', strtotime($_POST['start_date']));
            $date2 = date('d-m-Y', strtotime($_POST['end_date']));
        } else {
            echo 2;
            die;
        }
        //spectial return for 0 or 1 in order to know not to try to render the chart
        $stats = $this->_get_stats_data($date1, $date2);
        if ($stats == 0) {
            echo 00;
            die;
        }
        if ($stats == 1) {
            echo 11;
            die;
        }
        echo json_encode($stats);
        die;
    }

    function frontend_register_scripts() {
        $protocol = 'http:';
        if (!empty($_SERVER['HTTPS'])) {
            $protocol = 'https:';
        }
        wp_register_style('hybridconnectreset', HYBRIDCONNECT_CSS_PATH_TEMPLATES . '/hc_reset.css');
        wp_enqueue_style('hybridconnectreset');
        wp_register_style('hybridconnectfonts', HYBRIDCONNECT_CSS_PATH_TEMPLATES . '/hc_tpl_fonts.css');
        wp_enqueue_style('hybridconnectfonts');
        wp_register_style('hybridconnectgooglefonts', $protocol . '//fonts.googleapis.com/css?family=Dosis|Droid+Sans|Crushed|Parisienne|Lora|PT+Sans|PT+Sans+Narrow|Ubuntu|Lobster|Anton|Holtwood+One+SC|Russo+One|Great+Vibes|Droid+Serif|Open+Sans|Oswald|Yanone+Kaffeesatz|Homenaje|Bowlby+One+SC|Seaweed+Script|News+Cycle|Oxygen|Open+Sans');
        wp_enqueue_style('hybridconnectgooglefonts');
        wp_register_style('hcmodalstyle', HYBRIDCONNECT_CSS_PATH_TEMPLATES . '/hcmodalbasic.css');
        wp_enqueue_style('hcmodalstyle');

        wp_deregister_script('jquery');
        wp_register_script('jquery', $protocol . '//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
        wp_enqueue_script('jquery');

        wp_register_script('jquerysimplemodal', HYBRIDCONNECT_JS_PATH . "/jquery.simplemodal.1.4.3.min.js");
        wp_enqueue_script('jquerysimplemodal');

        wp_enqueue_script('waypoints', HYBRIDCONNECT_JS_PATH . "/waypoints.min.js");
    }

    function frontend_load_header() {
       include('includes/hc_facebook_api.php');
    }

    function admin_preview_shortcode() {
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        global $wpdb;
        $id = $_POST['id_connector'];
        $my_connector = $wpdb->get_results("SELECT * FROM wp_connectors WHERE IntegrationID=" . $id);
        if (!isset($my_connector[0])) {
            return "Hybrid Connect Error : Connector could not be found";
        }
        $my_connector = $my_connector[0];
        $my_settings = $wpdb->get_results("SELECT * FROM hc_templates where idConnector=" . $id);
        $my_settings = $my_settings[0];
        $my_settings->custom_html = html_entity_decode($my_settings->custom_html);
        $my_settings->custom_html2 = html_entity_decode($my_settings->custom_html2);
        $my_settings->custom_html = str_replace("\'", "'", $my_settings->custom_html);
        $my_settings->custom_html2 = str_replace("\'", "'", $my_settings->custom_html2);
        //OLD CALL FOR SELECTING A SPECIFIC TEMPLATE
        $template_path = $this->_get_hc_template('shortcode');
        $preview = true;
        include $template_path;
        die;
    }

    function admin_preview_widget() {
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        global $wpdb;
        $id = $_POST['id_connector'];
        $my_connector = $wpdb->get_results("SELECT * FROM wp_connectors WHERE IntegrationID=" . $id);
        if (!isset($my_connector[0])) {
            return "Hybrid Connect Error : Connector could not be found";
        }
        $my_connector = $my_connector[0];
        $my_settings = $wpdb->get_results("SELECT * FROM hc_templates where idConnector=" . $id);
        $my_settings = $my_settings[0];
        $my_settings->custom_html = html_entity_decode($my_settings->custom_html);
        $my_settings->custom_html2 = html_entity_decode($my_settings->custom_html2);
        $my_settings->custom_html = str_replace("\'", "'", $my_settings->custom_html);
        $my_settings->custom_html2 = str_replace("\'", "'", $my_settings->custom_html2);
        //OLD CALL FOR SELECTING A SPECIFIC TEMPLATE
        $template_path = $this->_get_hc_template('widget');
        //$template_path = $this->_get_hc_template('shortcode', 3);
        $preview = true;
        include $template_path;
        die;
    }

    function hc_frontend_submit_connector() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');

        require_once('includes/apis/hc_services_helper.php');
        $my_connector = $wpdb->get_results("SELECT * FROM wp_connectors WHERE IntegrationID=" . $_POST['id_connector']);
        $my_connector = $my_connector[0];
        $my_webinar = $wpdb->get_results("SELECT * FROM wp_hyCong2w where IntegrationID=" . $_POST['id_connector']);
        $my_webinar = (isset($my_webinar[0])) ? $my_webinar[0] : null;
        $my_mailinglist = $wpdb->get_results("SELECT * FROM wp_mailingList where IntegrationID=" . $_POST['id_connector']);
        $my_mailingList = (isset($my_mailinglist[0])) ? $my_mailinglist[0] : null;

        //only insert into stats if not admin
        if (!current_user_can('moderate_comments')) {
            $result2 = $wpdb->insert('wp_hc_subscribers', array(
                'id_connector' => $my_connector->IntegrationID,
                'email' => $_POST['email'],
                'name' => $_POST['name'],
                'date' => date('Y-m-d H:i:s'),
                'post' => $_POST['id_post'],
                'referer' => $_POST['referer'],
                'trackingcode' => $_POST['trackingcode'],
                'referingdomain' => $_POST['referingdomain'],
                'commentsubscriber' => $commentsubscriber
                    ), array('%d', '%s', '%s', '%s', '%d', '%s', '%s', '%s','%d'));
        }


        //attend the webinar        
        $my_webinar = $wpdb->get_results("SELECT * FROM wp_hyCong2w where IntegrationID=" . $my_connector->IntegrationID);
        $my_webinar = (isset($my_webinar[0])) ? $my_webinar[0] : null;
        $this->updateHCCounter();
        if ($my_webinar) {
            $names = explode(" ", $_POST['name'], 2);
            // new version of g2w
            require_once('includes/apis/g2w/citrix.php');
            $citrix = new Citrix(get_option("hc_g2w_app_id"));
            $citrix->set_organizer_key(get_option("hc_g2w_organizer_key"));
            $citrix->set_access_token(get_option("hc_g2w_access_token"));
            try {
                if ($names[1] == "") {
                    $names[1] = "-";
                }
                $response = $citrix->citrixonline_create_registrant_of_webinar($my_webinar->webinarKey, $data = array('first_name' => $names[0], 'last_name' => $names[1], 'email' => $_POST['email']));
            } catch (Exception $e) {
                
            }
            // old version of g2w
            $info = array('first_name' => $names[0], 'last_name' => $names[1], 'email' => $_POST['email']);
            gtw_attend($info, $my_webinar->webinarKey);
        }
        //register the user
        if ($my_connector->allow_registration == 1) {
            $names = explode(" ", $_POST['name'], 2);
            $info = array('first_name' => $names[0], 'last_name' => $names[1],
                'email' => $_POST['email'], 'role' => $my_connector->registration_role);
            $this->hc_setup_user($info);
        }

        //split testing functionality
        $variation = $wpdb->get_row("SELECT * FROM hc_variations WHERE id=" . $_POST['id_variation']);
        $tpl_type = $wpdb->get_row("SELECT * FROM hc_tpl_types WHERE idConnector=" . $_POST['id_connector'] . " AND type=" . $variation->type);

        //if ($tpl_type->testing == 1) {
        $conversions = $variation->conversions + 1;

        // make sure user not admin - admin conversions should not be logged.
        if (!current_user_can('moderate_comments')) {
            $result3 = $wpdb->update('hc_variations', array('conversions' => $conversions), array('id' => $variation->id), array('%d'), array('%d'));
            $stopTest = $this->_updateVariationsData($variation->id);
        }
        //}
        //connect to the mailing list using the custom code or the api
        if ($my_connector->apiConnection != "1") {
            $manualSubmit = true;
        } else {
            $manualSubmit = false;
        }
        if (!$manualSubmit) {
            switch ($my_mailingList->autoresponderType) {
                case 'aweber':
                    try {
                        $aweber_settings = get_option('hc_aweber_api_settings');
                        extract($aweber_settings);
                        $aweber = $this->_get_aweber_api($consumer_key, $consumer_secret);
                        $account = $aweber->getAccount($access_key, $access_secret);
                        $listURL = "/accounts/{$account->id}/lists/{$my_mailingList->settings}";
                        $list = $account->loadFromUrl($listURL);
                        # create a subscriber
                        $params = array(
                            'email' => $_POST['email'],
                            'ip_address' => $_SERVER['REMOTE_ADDR'],
                            'ad_tracking' => 'client_lib_example',
                            'last_followup_message_number_sent' => 0,
                            'misc_notes' => 'my cool app',
                            'name' => $_POST['name']
                        );
                        $subscribers = $list->subscribers;
                        $new_subscriber = $subscribers->create($params);
                    } catch (AWeberAPIException $exc) {
                        echo $my_connector->TyPage;
                        die;
                    }
                    break;
                case 'infusionsoft':
                    try {

                        $client = $this->_get_infusionsoft_client();
                        $apikey = get_option('hc_infusionsoft_appkey');
                        $names = explode(" ", $_POST['name'], 2);
                        $info = array('first_name' => $names[0], 'last_name' => $names[1], 'email' => $_POST['email']);
                        $contact_id = infusionsoft_addContact($info, $client, $apikey);
                        if ($contact_id) {
                            $result = infusionsoft_addToCampaign($contact_id, $my_mailingList->settings, $client, $apikey);
                            $result2 = infusionsoft_addEmailOptin($_POST['email'], $client, $apikey);
                        }
                    } catch (Exception $e) {
                        echo $my_connector->TyPage;
                        die;
                    }
                    break;
                case 'mailchimp':
                    try {
                        $names = explode(" ", $_POST['name'], 2);
                        $info = array('first_name' => $names[0], 'last_name' => $names[1], 'email' => $_POST['email']);
                        if (!mailchimp_addContact($info, $my_mailingList->settings, get_option('hc_mailchimp_appkey'))) {
                            echo $my_connector->TyPage;
                            die;
                        }
                    } catch (Exception $e) {
                        echo $my_connector->TyPage;
                        die;
                    }
                    break;
                case 'icontact':
                    try {
                        $names = explode(" ", $_POST['name'], 2);
                        $info = array('first_name' => $names[0], 'last_name' => $names[1], 'email' => $_POST['email']);
                        $result = icontact_addContact($info, $my_mailingList->settings, get_option('hc_icontact_appid'), get_option('hc_icontact_appkey'), get_option('hc_icontact_appurl'));
                        if (!$result) {
                            echo $my_connector->TyPage;
                            die;
                        }
                    } catch (Exception $e) {
                        echo $my_connector->TyPage;
                        die;
                    }
                    break;
                case 'officeautopilot':
                    try {
                        $names = explode(" ", $_POST['name'], 2);
                        $info = array('first_name' => $names[0], 'last_name' => $names[1], 'email' => $_POST['email']);
                        $result = officeautopilot_addContact($info, $my_mailingList->settings, get_option('hc_officeautopilot_appkey'), get_option('hc_officeautopilot_appid'));
                        if (!$result) {
                            echo $my_connector->TyPage;
                            die;
                        }
                    } catch (Exception $e) {
                        echo $my_connector->TyPage;
                        die;
                    }
                    break;
                case 'constantcontact':
                    try {
                        $names = explode(" ", $_POST['name'], 2);
                        $info = array('first_name' => $names[0], 'last_name' => $names[1], 'email' => $_POST['email']);
                        $result = constantcontact_addContact($info, $my_mailingList->settings, get_option('hc_constantcontact_appkey'), get_option('hc_constant_contact_username'), get_option('hc_constant_contact_token'));
                        if (!$result) {
                            echo $my_connector->TyPage;
                            die;
                        }
                    } catch (Exception $e) {
                        echo $my_connector->TyPage;
                        die;
                    }
                    break;
                case 'getresponse':
                    try {
                        $info = array('name' => $_POST['name'], 'email' => $_POST['email']);
                        $result = getresponse_addContact($info, $my_mailingList->settings, get_option('hc_getresponse_appkey'));
                        if (!$result) {
                            echo $my_connector->TyPage;
                            die;
                        }
                    } catch (Exception $e) {
                        echo $my_connector->TyPage;
                        die;
                    }
                    break;
                default:
                //nothing for default
            }
        } else {
            //we're going to submit the details manually through html web form code
            echo $my_connector->custom_code;
            die;
        }
        echo $my_connector->TyPage;
        die;
    }

    function hc_frontend_check_subscription() {
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $result = $this->_check_subscribers($_POST['email'], $_POST['id_connector']);
        if ($result) {
            echo $_POST['id_connector'];
        } else {
            echo '0';
        }
        die;
    }

    function hc_frontend_filter_content($content) {
        global $wpdb;
        global $post;
        $displayOnHome = False;
        $isSqueezePage = False;
        $connectorType = "0";
        $onlyOptin = false;
        $onlyLightbox = false;
        
        // Custom tracking for converisons. If custom tracking code set, then store as cookie
        if(isset($_GET['hccustomtrack'])) {
        $thisCustomTrack = $_GET['hccustomtrack'];
      }
        if(!empty($thisCustomTrack)) {
         setcookie('hc_custom_track', $thisCustomTrack, time() + (86400 * 7 * 416)); // 8 year cookie
        }

        // if squeeze page only show one connector and ignore lightbox, etc.
        if (is_page()) {
            $thisPageID = get_the_ID();
            $squeezeArray = $wpdb->get_results("select distinct `single_page`, `id_connector` from `hc_squeeze_options` where `squeeze_enabled`=1");
            foreach ($squeezeArray as $mySqueeze) {
                if ($mySqueeze->single_page != '' && $thisPageID == $mySqueeze->single_page) {
                    $isSqueezePage = True;
                    $display = true;
                    $id_connector = $mySqueeze->id_connector;
                    $connectorType = "3";
                    break;
                }
            }
        }

        if (!$isSqueezePage) {
            // do lightbox content
            // if homepage then find results for lightbox on homepage, else find results for all posts/pages
            $single_page_inclusion = false;
            $single_category_inclusion = false;

            if (is_home() || is_front_page()) {

                $displayOnHome = true;
                $lbOptions = $wpdb->get_results("SELECT * FROM hc_lightbox_options where homepage=1 and (activated=1 or optin_activated=1)");
            } else {
                $lbOptions = $wpdb->get_results("SELECT * FROM hc_lightbox_options where (all_pages=1 OR all_posts=1 OR all_posts_and_pages=1 OR single_page=1 OR single_category=1) and (activated=1 or optin_activated=1)");
            }
            $lightboxDisplayed = false;
            $optinDisplayed = false;
            foreach ($lbOptions as $lightbox_options) {
                // if both ligthbox and optin haven't been displayed
                if (!($lightboxDisplayed && $optinDisplayed)) {

                    if ($lightboxDisplayed) {
                        $onlyOptin = true;
                    }
                    if ($optinDisplayed) {
                        $onlyLightbox = true;
                    }
                    // if any results are returned - lightbox display is possible. Find exclusions (post, pages and categories) and quickly eliminate any for fast loading times.
                    // It doesn't make sense to have exclusions when posts are selected individually so ignore when single_page =1.
                    $excluded=false;
                    if (!$lightbox_options->single_page) {
                        $excluded_pages = explode("-", $lightbox_options->excluded_pages);
                        $excluded_posts = explode("-", $lightbox_options->excluded_posts);
                        $excluded_cats = explode("-", $lightbox_options->excluded_cats);
                        $excluded = false;
                        foreach ($excluded_cats as $c) {
                            if (in_category($c, $post)) {
                                $excluded = true;
                            }
                        }
                    } else {
                        // if single page then no exclusions
                        $excluded_pages = array();
                        $excluded_posts = array();
                    }

                    // if not excluded specifically by post page or category.  Anything past this point has no exclusions
                    if (!in_array($post->ID, $excluded_pages) && !in_array($post->ID, $excluded_posts) && !$excluded) {

                        $displayOnPosts = $lightbox_options->all_posts;
                        $displayOnPages = $lightbox_options->all_pages;
                        $displayOnPostsAndPages = $lightbox_options->all_posts_and_pages;

                        // check for single post/page inclusions
                        $single_page = $lightbox_options->single_page;

                        // no need to run through this if loop if set to all_pages or all_posts or homepage in database as these will already be included regardless
                        if ($single_page && !$displayOnPosts && !$displayOnPages && !$displayOnHome) {
                            $included_pages = explode("-", $lightbox_options->included_pages);
                            $included_posts = explode("-", $lightbox_options->included_posts);

                            if ((in_array($post->ID, $included_pages) || in_array($post->ID, $included_posts))) {
                                $single_page_inclusion = true;
                            } else {
                                $single_page_inclusion = false;
                            }
                        }

                        // check for single category inclusions
                        $singleCategory = $lightbox_options->single_category;

                        // no need to run through this if loop if set to all_pages or all_posts or homepage or single page inclusion in database as these will already be included regardless
                        if ($singleCategory && !$displayOnPosts && !$displayOnPages && !$displayOnHome && !$single_page_inclusion) {

                            $single_category_inclusion = false;
                            $included_categories = explode("-", $lightbox_options->included_cats);
                            foreach ($included_categories as $c) {

                                if (in_category($c, $post)) {
                                    $single_category_inclusion = true;
                                }
                            }
                        }

                        global $already_lightbox;
                        global $already_optin;

                        //lightbox is valid if post+all posts / page+allpages / homepage / included explicitly by post or page / included explicitly by category - exclusions have already been taken out at this point.
                        if ((is_single() && $displayOnPosts) || (is_page() && $displayOnPages) || $displayOnHome || $single_page_inclusion || $single_category_inclusion || ($displayOnPostsAndPages && !$displayOnHome)) {
                            // check if this is a connector or a slide in box
                            $my_connector = $wpdb->get_results("SELECT * FROM wp_connectors where IntegrationID=" . $lightbox_options->id_connector);
                            if (isset($my_connector[0])) {
                                // if lightbox only

                                if ($lightbox_options->activated && !$lightbox_options->optin_activated && !$onlyOptin   && !$already_lightbox) {
                                    $lightbox_content = $this->hc_frontend_display_lightbox($lightbox_options, $my_connector[0], false, null, "lightbox");
                                    if ($lightbox_content) {
                                        echo $lightbox_content;
                                        //$content .= $lightbox_content;
                                        $lightboxDisplayed = true;
                                        // amke sure multiple lb's not loaded on homepage with multiple calls to the_content in the loop
                                        $already_lightbox = true;
                                    }
                                } else if (!$lightbox_options->activated && $lightbox_options->optin_activated && !$onlyLightbox && !$already_optin) {
                                    // if optin only
                                    $lightbox_content = $this->hc_frontend_display_lightbox($lightbox_options, $my_connector[0], false, null, "optin");
                                    if ($lightbox_content) {
                                        echo $lightbox_content;
                                        //$content .= $lightbox_content;
                                        $optinDisplayed = true;
                                        // amke sure multiple lb's not loaded on homepage with multiple calls to the_content in the loop
                                        $already_optin = true;
                                    }
                                } else if ($lightbox_options->activated && $lightbox_options->optin_activated) {
                                    // lightbox and optin
                                    if (!$onlyOptin && !$already_lightbox) {
                                        $lightbox_content = $this->hc_frontend_display_lightbox($lightbox_options, $my_connector[0], false, null, "lightbox");
                                        if ($lightbox_content) {
                                            echo $lightbox_content;
                                            //$content .= $lightbox_content;
                                            $lightboxDisplayed = true;
                                            // amke sure multiple lb's not loaded on homepage with multiple calls to the_content in the loop
                                            $already_lightbox = true;
                                        }
                                    }
                                    if (!$onlyLightbox && !$already_optin) {
                                        $lightbox_content2 = $this->hc_frontend_display_lightbox($lightbox_options, $my_connector[0], false, null, "optin");
                                        if ($lightbox_content2) {
                                            echo $lightbox_content2;
                                            //$content .= $lightbox_content2;
                                            $optinDisplayed = true;
                                            // amke sure multiple lb's not loaded on homepage with multiple calls to the_content in the loop
                                            $already_optin = true;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            $is_single = is_single() || $post->post_type == "page";
            $display = false;

            if ($post->post_type == 'post' && get_option('hyConFooterPost') != '' && is_single()) {
                $display = true;
                $id_connector = get_option('hyConFooterPost');
            }
            if ($post->post_type == 'page' && get_option('hyConFooterPage') != '') {
                $display = true;
                $id_connector = get_option('hyConFooterPage');
            }
        }

        if ($display) {

            $my_connector = $wpdb->get_results("SELECT * FROM wp_connectors WHERE IntegrationID=" . $id_connector);
            if (!isset($my_connector[0])) {
                return $content;
            }
            $my_connector = $my_connector[0];

            $tpl_type = $wpdb->get_row("SELECT * FROM hc_tpl_types WHERE idConnector=" . $id_connector . " AND type=" . $connectorType . "");

            if ($tpl_type->testing == 1) {

                $variation = $wpdb->get_row("SELECT * FROM hc_variations WHERE enabled=1 AND idConnector=" . $id_connector . " AND type=" . $connectorType . " ORDER BY RAND() LIMIT 0,1");
            } else {
                $variation = $wpdb->get_row("SELECT * FROM hc_variations WHERE idConnector=" . $id_connector . " AND type=" . $connectorType . " AND control=1");
            }

            $rand_id = rand(1000, 10000);
            $id = $id_connector;
            $style_text = $wpdb->get_results("SELECT * FROM hc_style_text where id_connector=" . $id . " AND type=" . $connectorType . " AND idVariation=" . $variation->id);
            $style_text = $style_text[0];
            $style_button = $wpdb->get_results("SELECT * FROM hc_style_button where id_connector=" . $id . " AND type=" . $connectorType . " AND idVariation=" . $variation->id);
            $style_button = $style_button[0];
            $style_connector = $wpdb->get_results("SELECT * FROM hc_style_connector where id_connector=" . $id . " AND type=" . $connectorType . " AND idVariation=" . $variation->id);
            $style_connector = $style_connector[0];
            $style_email = $wpdb->get_results("SELECT * FROM hc_style_email where id_connector=" . $id . " AND type=" . $connectorType . " AND idVariation=" . $variation->id);
            $style_email = $style_email[0];
            $style_image = $wpdb->get_results("SELECT * FROM hc_style_image where id_connector=" . $id . " AND type=" . $connectorType . " AND idVariation=" . $variation->id);
            $style_image = $style_image[0];
            $style_optin = $wpdb->get_results("SELECT * FROM hc_style_optin where id_connector=" . $id . " AND type=" . $connectorType . " AND idVariation=" . $variation->id);
            $style_optin = $style_optin[0];
            $connector_txt = $wpdb->get_results("SELECT * FROM hc_connector_text where id_connector=" . $id . " AND type=" . $connectorType . " AND idVariation=" . $variation->id);
            $connector_txt = $connector_txt[0];
            $connector_txt->optin_description = stripslashes($connector_txt->optin_description);
            $connector_txt->optin_headline = stripslashes($connector_txt->optin_headline);
            $connector_txt->email_call = stripslashes($connector_txt->email_call);
            $connector_txt->fb_call = stripslashes($connector_txt->fb_call);
            $connector_txt->oneclick_call = stripslashes($connector_txt->oneclick_call);
            $connector_txt->email_btn = stripslashes($connector_txt->email_btn);
            $connector_txt->fb_btn = stripslashes($connector_txt->fb_btn);
            $connector_txt->oneclick_btn = stripslashes($connector_txt->oneclick_btn);
            $hc_is_footer = true;
            //OLD CALL FOR SELECTING A SPECIFIC TEMPLATE
            if ($my_connector->template_shortcode == "1") {
                $template_path = $this->_get_hc_template('custom');
            } else {
                $template_path = $this->_get_hc_template('shortcode');
            }
            if ($isSqueezePage) {
                $squeeze_options = $wpdb->get_results("select * from hc_squeeze_options where id_connector = " . $id . ";");
                $squeeze_options = $squeeze_options[0];
            }
            // echo $template_path;
            ob_start();
            include $template_path;
            $hc_content = ob_get_contents();
            ob_end_clean();
            $hc_content = str_replace("\r\n", '', $hc_content);
            $content .= $hc_content;
        }
          return $content;
    }

    function hc_frontend_display_lightbox($lightbox_options, $my_connector, $is_link = false, $link_text = null, $displayType = "lightbox") {

        global $wpdb;
        $rand_id = rand(1000, 10000);
        $id = $my_connector->IntegrationID;

        $tpl_type = $wpdb->get_row("SELECT * FROM hc_tpl_types WHERE idConnector=" . $id . " AND type=2");

        if ($tpl_type->testing == 1) {
            $variation = $wpdb->get_row("SELECT * FROM hc_variations WHERE enabled=1 AND idConnector=" . $id . " AND type=2 ORDER BY RAND() LIMIT 0,1");
        } else {
            $variation = $wpdb->get_row("SELECT * FROM hc_variations WHERE idConnector=" . $id . " AND type=2 AND control=1");
        }

        $style_text = $wpdb->get_results("SELECT * FROM hc_style_text where id_connector=" . $id . " AND type=2 AND idVariation=" . $variation->id);
        $style_text = $style_text[0];
        $style_button = $wpdb->get_results("SELECT * FROM hc_style_button where id_connector=" . $id . " AND type=2 AND idVariation=" . $variation->id);
        $style_button = $style_button[0];
        $style_connector = $wpdb->get_results("SELECT * FROM hc_style_connector where id_connector=" . $id . " AND type=2 AND idVariation=" . $variation->id);

        $style_connector = $style_connector[0];

        $style_email = $wpdb->get_results("SELECT * FROM hc_style_email where id_connector=" . $id . " AND type=2 AND idVariation=" . $variation->id);
        $style_email = $style_email[0];
        $style_image = $wpdb->get_results("SELECT * FROM hc_style_image where id_connector=" . $id . " AND type=2 AND idVariation=" . $variation->id);
        $style_image = $style_image[0];
        $style_optin = $wpdb->get_results("SELECT * FROM hc_style_optin where id_connector=" . $id . " AND type=2 AND idVariation=" . $variation->id);
        $style_optin = $style_optin[0];
        $connector_txt = $wpdb->get_results("SELECT * FROM hc_connector_text where id_connector=" . $id . " AND type=2 AND idVariation=" . $variation->id);
        $connector_txt = $connector_txt[0];
        $connector_txt->optin_description = stripslashes($connector_txt->optin_description);
        $connector_txt->optin_headline = stripslashes($connector_txt->optin_headline);
        $connector_txt->email_call = stripslashes($connector_txt->email_call);
        $connector_txt->fb_call = stripslashes($connector_txt->fb_call);
        $connector_txt->oneclick_call = stripslashes($connector_txt->oneclick_call);
        $connector_txt->email_btn = stripslashes($connector_txt->email_btn);
        $connector_txt->fb_btn = stripslashes($connector_txt->fb_btn);
        $connector_txt->oneclick_btn = stripslashes($connector_txt->oneclick_btn);
        $hc_is_lightbox = true;
        $lightboxOrOptin = $displayType;
        //OLD CALL FOR SELECTING A SPECIFIC TEMPLATE
        if ($my_connector->template_lightbox == "1") {
            $template_path = $this->_get_hc_template('lightbox_custom');
        } else {
            $template_path = $this->_get_hc_template('lightbox');
        }
        ob_start();
        include $template_path;
        $hc_content = ob_get_contents();
        ob_end_clean();
        return $hc_content;
    }

    function _get_hc_type($id) {
        global $wpdb;
        $myrows = $wpdb->get_results("SELECT Type FROM wp_connectors where IntegrationID=$id");
        foreach ($myrows as $myrow) {
            $hcType = $myrow->Type;
            return $hcType;
        }
    }

    function _get_hc_template($tpl_type) {
        $path = 'templates/template.php';
        if ($tpl_type == 'lightbox') {
            $path = 'templates/lightbox.php';
        }
        if ($tpl_type == 'lightbox_custom') {
            $path = 'templates/lightbox_custom.php';
        }
        if ($tpl_type == "custom") {
            $path = 'templates/template_custom.php';
        }
        if ($tpl_type == "shortcode") {
            $path = 'templates/template.php';
        }

        return $path;
    }

    function _check_subscribers($email, $id_connector) {
        global $wpdb;
        $subscribers = $wpdb->get_results("SELECT * FROM wp_hc_subscribers where id_connector=" . $id_connector . " AND email='" . $email . "'");
        $subscribers = (isset($subscribers[0])) ? $subscribers[0] : null;
        return $subscribers;
    }

    /*
     * Meta attributes handlers
     */

    function hc_meta_init() {
        /* removed paul 12th Nov 2012 */
    }

    function hc_meta_setup() {
        /* removed paul 12th Nov 2012 */
    }

    function hc_meta_save($post_id) {
        /* removed paul 12th Nov 2012 */
    }

    function hc_meta_clean(&$arr) {
        /* removed paul 12th Nov 2012 */
    }

    function hc_template_redirect() {
        /* removed paul 12th Nov 2012 */
    }

    function do_theme_redirect($url) {
        //echo $url; die;
        global $post, $wp_query, $wpdb;
        if (have_posts()) {
            $optin_meta = get_post_meta($post->ID, '_my_optinmeta', TRUE);
            $my_connector = null;
            if (!empty($optin_meta['hybridshortcode'])) {
                $my_connector = $wpdb->get_results("SELECT * FROM wp_connectors WHERE IntegrationID=" . $optin_meta['hybridshortcode']);
                $my_connector = $my_connector[0];
            }
            include('includes/hc_facebook_api.php');
            include($url);
            die();
        } else {
            $wp_query->is_404 = true;
        }
    }

    function admin_check_image_exists() {
        
    }

    /**
     * Get a new AWeber API object
     *
     * Wrapper for AWeber API generation
     * @return AWeberAPI
     */
    function _get_aweber_api($consumer_key, $consumer_secret) {
        if (!class_exists('AWeberAPI')) {
            require_once('includes/apis/aweber_api/aweber_api.php');
        }
        return new AWeberAPI($consumer_key, $consumer_secret);
    }

    function _get_infusionsoft_client() {
        if (!class_exists("xmlrpc_client")) {
            require_once("includes/apis/xmlrpc-2.0/lib/xmlrpc.inc");
        }
        $client = new xmlrpc_client(get_option('hc_infusionsoft_appurl'));
        $client->return_type = "phpvals";
        $client->setSSLVerifyPeer(FALSE);
        return $client;
    }

    function hc_setup_user($info) {
        //check options
        global $options;
        require_once(ABSPATH . WPINC . '/registration.php' );
        require_once(ABSPATH . WPINC . '/pluggable.php' );
        //Assign POST variables
        $user_name = strtolower($info['first_name'] . $info['last_name']);
        $fname = $info['first_name'];
        $lname = $info['last_name'];
        $user_name = sanitize_user($info['first_name'] . $info['last_name'], true);
        $email = $info['email'];
        $role = $info['role'];
        //This part actually generates the account
        $passw = wp_generate_password(12, false);
        $userdata = array(
            'user_login' => $user_name,
            'first_name' => $fname,
            'last_name' => $lname,
            'user_pass' => $passw,
            'user_email' => $email,
            'role' => $role
        );
        // create user
        $user_id = wp_insert_user($userdata);
        //multisite support add user to registration log and associate with current site
        if (WP_MULTISITE === true) {
            global $wpdb;
            $ip = getenv('REMOTE_ADDR');
            $site = get_current_site();
            $sid = $site->id;
            $query = $wpdb->prepare("
				INSERT INTO $wpdb->registration_log
				(ID, email, IP, blog_ID, date_registered)
				VALUES ($user_id, $email, $ip, $sid, NOW() )
				");
            $results = $wpdb->query($query);
        }
        $update = update_user_option($user_id, 'default_password_nag', true, true);
        //notify admin of new user
        $this->hc_send_notifications($userdata, $passw);
        $extra = "Please check your email for confirmation.";
        $extra = apply_filters('simplr_extra_message', __($extra, 'simplr-reg'));
        $confirm = '<div class="simplr-message success">Your Registration was successful. ' . $extra . '</div>';
        //Use this hook for multistage registrations
        //do_action('simplr_reg_next_action', array($data, $user_id, $confirm));
        //return confirmation message.
        //return apply_filters('simplr_reg_confirmation', $confirm);
    }

    function hc_send_notifications($data, $passw) {
        $site = get_option('siteurl');
        $name = get_option('blogname');
        $user_name = $data['user_login'];
        $email = $data['user_email'];
        $emessage = __("Your registration via HyibridConnect was successful.");
        $headers = "From: $name" . ' <' . get_option('admin_email') . '> ' . "\r\n\\";
        wp_mail(get_option('admin_email'), "A new user registered for $name", "A new user has registered for $name.\rUsername: $user_name\r Email: $email \r", $headers);
        $emessage = $emessage . "\r\r---\r";
        $emessage .= "You should login and change your password as soon as possible.\r\r";
        $emessage .= "Username: $user_name\rPassword: $passw\rLogin: $site/wp-login.php";
        wp_mail($email, "$name - Registration Confirmation", $emessage, $headers);
    }

    function smp_remote_license_check($licensed_email, $license_key = '', $block_license = 0, $ucount = 0) {
        $plugin_name = 'HybridConnect';
        $plugin_license_email = 'HybridConnect_LICENSE_EMAIL';
        $plugin_license_key = 'HybridConnect_LICENSE_KEY';
        $smp_location = 'http://smp.whitesquareim.com';
        $smp_api_key = 'JAHSGTY651BB819KAJSHBAHST';
        define('SMP_API_URL', $smp_location . '/index.php/api/');
        define('API_KEY', $smp_api_key);
        //define('PID', '10');
        if ($license_key == "") {
            $license_key = "UNKNOWN";
        }
        $api_url = SMP_API_URL . 'license_api/license/lkey/' . $license_key . '/email/' . $licensed_email . '/block/' . $block_license . '/key/' . API_KEY . '/ucount/' . $ucount . '/format/json';
        //echo $api_url; die; exit;
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $api_url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_GET, 1);
        $buffer = curl_exec($curl_handle);
        curl_close($curl_handle);
        $result = json_decode($buffer);
        return $result;
        switch ($result->status) {
            case "ACTIVE":
                return true;
                break;
            case "EXPIRED":
                return false;
                break;
            case "SUSPENDED":
                return false;
                break;
            case "UNKNOWN":
                return false;
                break;
            case "EXCEEDED":
                return false;
                break;
            default:
                return false;
                break;
        }
    }

    function checkRemoteFile($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        // don't download content
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if (curl_exec($ch) !== FALSE) {
            return true;
        } else {
            return false;
        }
    }

    function _check_fb_connection() {

        if (!class_exists("Facebook")) {
            include ('includes/apis/facebook/src/facebook.php');
        }
        $appid = get_option('hc_fb_appid');
        $secret = get_option('hc_fb_appsecret');
        $facebook = new Facebook(array(
                    'appId' => $appid,
                    'secret' => $secret,
                ));
                
        // check if we can fetch urls remotely
        if( ini_get('allow_url_fopen') ) {

        try {

            // get access token as application
            $accessToken = file_get_contents('https://graph.facebook.com/oauth/access_token?client_id=' . $appid . '&client_secret=' . $secret . '&grant_type=client_credentials');

            $result = json_decode($accessToken);

            $params = null;
            parse_str($accessToken, $params);
            $access_token = $params['access_token'];


            $fbSiteURL = get_site_url();
            $fbSiteDomain = $_SERVER['HTTP_HOST'];
            $appDomainsArray = array('0' => $fbSiteDomain);

            $postdata = http_build_query(
                    array(
                        'access_token' => $access_token,
                        'website_url' => $fbSiteURL,
                        'app_domains' => $appDomainsArray
                    )
            );

            $opts = array('http' =>
                array(
                    'method' => 'POST',
                    'header' => 'Content-type: application/x-www-form-urlencoded',
                    'content' => $postdata
                )
            );

            $context = stream_context_create($opts);
            $result = file_get_contents('https://graph.facebook.com/app', false, $context);
            $result = json_decode($result);


            if ($result->error) {
                //  return false;
                // build array
                $facebookValidation = array('success' => '0');
                return $facebookValidation;
            } else {

                // get app name and picture and return in array.
                $getAppDetails = file_get_contents('https://graph.facebook.com/' . $appid . '?fields=logo_url,app_domains,website_url,name,description,id&access_token=' . $access_token);
                $getAppDetails = json_decode($getAppDetails);
                //  echo $getAppDetails->logo_url . "\n" . $getAppDetails->app_domains[0] . "\n" . $getAppDetails->website_url . "\n" . $getAppDetails->name . "\n" . $getAppDetails->description . "\n" . $getAppDetails->access_token;
                //build array of data about the app that's been created.
                $facebookValidation = array('success' => '1',
                    'name' => $getAppDetails->name,
                    'description' => $getAppDetails->description,
                    'website_url' => $getAppDetails->website_url,
                    'domain' => $getAppDetails->app_domains[0],
                    'logo_url' => $getAppDetails->logo_url,
                    'id' => $getAppDetails->id
                );
                return $facebookValidation;
            }
        } catch (Exception $e) {
            $facebookValidation = array('success' => '0');
            return $facebookValidation;
        }
      }
      else {
       // allow f_url not enabled need to show error message
       return 0;
      }
    }

    function MysqlCopyRow($TableName, $IDFieldName, $IDToDuplicate, $new_id = null, $new_name = null, $template_type = null, $copyFromBase = null, $idVariation = null, $add_tpl = null) {
        global $wpdb;
        if ($TableName && $IDFieldName && $IDToDuplicate > 0) {
            if (is_null($template_type) || $copyFromBase == "1") {
                $sql = "SELECT * FROM $TableName WHERE $IDFieldName = $IDToDuplicate";
            } else {
                $sql = "SELECT * FROM $TableName WHERE $IDFieldName = $IDToDuplicate AND type = $template_type";
            }
            if ($idVariation && $add_tpl) {
                $sql = "SELECT * FROM $TableName WHERE idVariation = $IDToDuplicate";
            }
            $result = $wpdb->get_results($sql);
            if ($result) {
                $sql = "INSERT INTO $TableName SET ";
                $row = get_object_vars($result[0]);
                $RowKeys = array_keys($row);
                $RowValues = array_values($row);
                $start = 1;
                if ($new_name) {
                    $RowValues[1] = $new_name;
                }
                if ($TableName == 'hc_templates') {
                    $start = 0;
                    $RowValues[0] = $new_id;
                }
                if ($TableName == 'hc_connector_text' || $TableName == 'hc_style_button' || $TableName == 'hc_style_connector'
                        || $TableName == 'hc_style_email' || $TableName == 'hc_style_image' || $TableName == 'hc_style_optin' || $TableName == 'hc_style_text' || $TableName == 'hc_lightbox_options' || $TableName == 'hc_squeeze_options') {
                    $start = 1;
                    $RowValues[1] = $new_id;
                }
                if ($template_type) {
                    $RowValues[1] = $new_id;
                }
                for ($i = $start; $i < count($RowKeys); $i++) {
                    if ($i != $start) {
                        $sql .= ", ";
                    }
                    if ($template_type == 1 && $RowKeys[$i] == 'type') {
                        $RowValues[$i] = 1;
                    }
                    if ($template_type == 2 && $RowKeys[$i] == 'type') {
                        $RowValues[$i] = 2;
                    }
                    if ($template_type == 3 && $RowKeys[$i] == 'type') {
                        $RowValues[$i] = 3;
                    }
                    if ($RowKeys[$i] == "idVariation") {
                        $RowValues[$i] = $idVariation;
                    }
                    $sql .= $RowKeys[$i] . " = '" . $RowValues[$i] . "'";
                }
                if ($idVariation && $add_tpl) {
                    //echo $sql; die;
                }
                $result = $wpdb->get_results($sql);
            }
        }
        return $wpdb->insert_id;
    }

    function _insert_default_styles($id_connector, $id_type, $type = 0) {
        global $wpdb;
        //Insert the default control for stats
        $result = $wpdb->insert('hc_variations', array(
            'idConnector' => $id_connector,
            'type' => $type,
            'name' => "Default", "control" => 1), array('%d', '%d', '%s', '%d'));
        $last_inserted_variation = $wpdb->insert_id;
        $result = $wpdb->insert('hc_tpl_types', array(
            'idConnector' => $id_connector,
            'type' => $type), array('%d', '%d'));

        $this->MysqlCopyRow("hc_style_button", "id", $id_type, $id_connector, null, $type, 1, $last_inserted_variation);
        $this->MysqlCopyRow("hc_style_connector", "id", $id_type, $id_connector, null, $type, 1, $last_inserted_variation);
        $this->MysqlCopyRow("hc_style_email", "id", $id_type, $id_connector, null, $type, 1, $last_inserted_variation);
        $this->MysqlCopyRow("hc_style_image", "id", $id_type, $id_connector, null, $type, 1, $last_inserted_variation);
        $this->MysqlCopyRow("hc_style_optin", "id", $id_type, $id_connector, null, $type, 1, $last_inserted_variation);
        $this->MysqlCopyRow("hc_style_text", "id", $id_type, $id_connector, null, $type, 1, $last_inserted_variation);
        $this->MysqlCopyRow("hc_connector_text", "id", $id_type, $id_connector, null, $type, 1, $last_inserted_variation);
    }

    function _get_custom_templates() {
        
    }

    function updateHCCounter() {
        $url = "http://counter.hybrid-connect.com/hccounter.php";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_NOBODY, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 1000);
        $head = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    }
    
    function admin_comment_footer_panel() {
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        include('includes/comment_footer_panel.php');
        die;
    }

    function update_comment_footer_settings() {
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        update_option("hc_comment_connector_id", $_POST['commentconnector']);
        if($_POST['commentconnector']) {
        update_option("hc_comment_optin", $_POST['commentoptin']);
        update_option("hc_comment_text", $_POST['commenttext']);
        }
        echo 1;
        die;
    }

    function admin_get_stats_contanier() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $my_connector = $wpdb->get_row("SELECT * FROM wp_connectors WHERE IntegrationID=" . $_POST['id_connector']);
        $variations = $wpdb->get_results("SELECT * FROM hc_variations WHERE enabled!=0 AND idConnector=" . $_POST['id_connector'] . " AND type=" . $_POST['type'] . " ORDER BY control DESC");
        $hc_type = $wpdb->get_row("SELECT * FROM hc_tpl_types WHERE idConnector=" . $_POST['id_connector'] . " AND type=" . $_POST['type']);

        include('includes/hc_admin_stats_container.php');
        die;
    }

    function admin_get_test_stats() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');

        $test = $wpdb->get_row("SELECT * FROM hc_tests_log WHERE id=" . $_POST['id_test']);

        $my_connector = $wpdb->get_row("SELECT * FROM wp_connectors WHERE IntegrationID=" . $test->idConnector);
        $hc_type = $wpdb->get_row("SELECT * FROM hc_tpl_types WHERE idConnector=" . $test->idConnector . " AND type=" . $test->type);

        $var1 = $wpdb->get_row("SELECT * FROM hc_variations WHERE id=" . $test->var1);
        $var2 = $wpdb->get_row("SELECT * FROM hc_variations WHERE id=" . $test->var2);
        $var3 = $wpdb->get_row("SELECT * FROM hc_variations WHERE id=" . $test->var3);
        $var4 = $wpdb->get_row("SELECT * FROM hc_variations WHERE id=" . $test->var4);

        $initialControl = $wpdb->get_row("SELECT * FROM hc_variations WHERE id=" . $test->initialControl);
        $finalControl = $wpdb->get_row("SELECT * FROM hc_variations WHERE id=" . $test->finalControl);

        $initialControl->control = 1;

        $temp_vars = array($var1, $var2, $var3, $var4);

        $variations = array($initialControl);
        $add_final = true;
        foreach ($temp_vars as $key => $v) {
            if ($v && $v->id != $test->finalControlCurrent && $v->id != $test->initialControlCurrent) {
                $variations[] = $v;
                if ($v->id == $finalControl->id) {
                    $add_final = false;
                }
            }
        }

        if ($add_final && $test->initialControlCurrent != $test->finalControlCurrent) {
            $variations[] = $finalControl;
        }
        include('includes/hc_admin_test_stats.php');
        die;
    }

    function admin_get_variation_container() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $connector = $wpdb->get_row("SELECT * FROM wp_connectors WHERE IntegrationID=" . $_POST['id_connector']);
        $types_array = array(0 => 'shortcode', 1 => 'widget', 2 => 'lightbox', 3 => 'squeeze');
        $type_label = (isset($types_array[$_POST['type']])) ? $types_array[$_POST['type']] : "";
        include('includes/hc_admin_variation_container.php');
        die;
    }

    function admin_get_start_test_container() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $connector = $wpdb->get_row("SELECT * FROM wp_connectors WHERE IntegrationID=" . $_POST['id_connector']);
        $types_array = array(0 => 'shortcode', 1 => 'widget', 2 => 'lightbox', 3 => 'squeeze');
        $type_label = (isset($types_array[$_POST['type']])) ? $types_array[$_POST['type']] : "";
        include('includes/hc_admin_start_test_container.php');
        die;
    }

    function admin_get_clear_data_container() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $connector = $wpdb->get_row("SELECT * FROM wp_connectors WHERE IntegrationID=" . $_POST['id_connector']);
        $types_array = array(0 => 'shortcode', 1 => 'widget', 2 => 'lightbox', 3 => 'squeeze');
        $type_label = (isset($types_array[$_POST['type']])) ? $types_array[$_POST['type']] : "";
        include('includes/hc_admin_clear_data_container.php');
        die;
    }

    function admin_get_stop_test_container() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $connector = $wpdb->get_row("SELECT * FROM wp_connectors WHERE IntegrationID=" . $_POST['id_connector']);
        $variations = $wpdb->get_results("SELECT * FROM hc_variations WHERE enabled=1 AND idConnector=" . $_POST['id_connector'] . " AND type=" . $_POST['type'] . " ORDER BY control DESC");
        $types_array = array(0 => 'shortcode', 1 => 'widget', 2 => 'lightbox', 3 => 'squeeze');
        $type_label = (isset($types_array[$_POST['type']])) ? $types_array[$_POST['type']] : "";
        $type = $_POST['type'];
        $idConnector = $_POST['id_connector'];
        include('includes/hc_admin_stop_test_container.php');
        die;
    }

    function admin_add_new_variation() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');

        $id_connector = (int) $_POST['id_connector'];
        $type = (int) $_POST['type'];

        $control = $wpdb->get_row("SELECT * FROM hc_variations WHERE idConnector=" . $id_connector . " AND type=" . $type . " AND control=1");

        $result = $wpdb->insert('hc_variations', array(
            'idConnector' => $id_connector,
            'type' => $type,
            'name' => $_POST['name']), array('%d', '%d', '%s'));
        $last_inserted_variation = $wpdb->insert_id;

        $this->MysqlCopyRow("hc_style_button", "id", $control->id, $id_connector, null, $type, 1, $last_inserted_variation, true);
        $this->MysqlCopyRow("hc_style_connector", "id", $control->id, $id_connector, null, $type, 1, $last_inserted_variation, true);
        $this->MysqlCopyRow("hc_style_email", "id", $control->id, $id_connector, null, $type, 1, $last_inserted_variation, true);
        $this->MysqlCopyRow("hc_style_image", "id", $control->id, $id_connector, null, $type, 1, $last_inserted_variation, true);
        $this->MysqlCopyRow("hc_style_optin", "id", $control->id, $id_connector, null, $type, 1, $last_inserted_variation, true);
        $this->MysqlCopyRow("hc_style_text", "id", $control->id, $id_connector, null, $type, 1, $last_inserted_variation, true);
        $this->MysqlCopyRow("hc_connector_text", "id", $control->id, $id_connector, null, $type, 1, $last_inserted_variation, true);
        echo 1;
        die;
    }

    function admin_delete_variation() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $_POST['id_variation'] = (int) $_POST['id_variation'];
        $variation = $wpdb->get_row("SELECT * FROM hc_variations WHERE id=" . $_POST['id_variation']);
        $wpdb->query("DELETE FROM hc_variations WHERE id=" . $_POST['id_variation']);
        echo json_encode($variation);
        die;
    }

    function admin_start_test() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $result1 = $wpdb->update('hc_tpl_types', array('testing' => 1, 'dateTestStart' => date("Y-m-d H:i:s")), array('idConnector' => $_POST['id_connector'], 'type' => $_POST['type']), array('%d', '%s'), array('%d', '%d'));

        $variations = $wpdb->get_results("SELECT * FROM hc_variations WHERE enabled!=0 AND idConnector=" . $_POST['id_connector'] . " AND type=" . $_POST['type'] . " ORDER BY control DESC");

        $tvars = array(0 => 0);
        for ($i = 1; $i <= 4; $i++) {
            $tvars[$i] = (isset($variations[$i - 1])) ? $variations[$i - 1]->id : 0;
        }

        $result = $wpdb->insert('hc_tests_log', array('startData' => date("Y-m-d H:i:s"),
            'initialControl' => $tvars[1],
            'var1' => $tvars[1],
            'var2' => $tvars[2],
            'var3' => $tvars[3],
            'var4' => $tvars[4],
            'idConnector' => $_POST['id_connector'],
            'type' => $_POST['type']), array('%s', '%d', '%d', '%d', '%d', '%d', '%d'));

        echo 1;
        die;
    }

    function admin_clear_data() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');

        $result3 = $wpdb->update('hc_variations', array('totalImpressions' => 0, 'uniqueImpressions' => 0, 'conversions' => 0, 'conversionsRate' => '0',
            'percentageImproovement' => '0', 'chanceTbo' => '0'), array('idConnector' => $_POST['id_connector'], 'type' => $_POST['type'], 'enabled' => 1), array('%d', '%d', '%d', '%s', '%s', '%s'), array('%d', '%d', '%d'));

        echo 1;
        die;
    }

    function hc_frontend_update_views() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');


        // check if current user admin or not
        if (current_user_can('moderate_comments')) {
            echo 1;
            die;
        }


        $idVariation = (int) $_POST['id_variation'];
        $query = "";
        if ($this->_checkUniqueVisitor($idVariation)) {
            $query = "UPDATE hc_variations SET uniqueImpressions=uniqueImpressions+1, totalImpressions=totalImpressions+1 WHERE id=" . $idVariation;
        } else {
            $query = "UPDATE hc_variations SET totalImpressions=totalImpressions+1 WHERE id=" . $idVariation;
        }
        $rez = $wpdb->query($query);
        $stopTest = $this->_updateVariationsData($idVariation);
        echo $rez;
        die;
    }

    function _checkUniqueVisitor($idVariation) {
        global $wpdb;
        $query = "SELECT * FROM hc_variation_views WHERE idVariation=" . $idVariation . " AND ipUser LIKE '%" . $_SERVER['REMOTE_ADDR'] . "%' AND date >= NOW() - INTERVAL 30 DAY";
        $rez = $wpdb->get_row($query);
        if ($rez) {
            return false;
        }
        $query = "INSERT INTO hc_variation_views (idVariation, ipUser, date) VALUES(" . $idVariation . ", '" . $_SERVER['REMOTE_ADDR'] . "', NOW())";
        $wpdb->query($query);
        return true;
    }

    function _updateVariationsData($idVariation) {
        global $wpdb;

        $variation = $wpdb->get_row("SELECT * FROM hc_variations WHERE id=" . $idVariation);
        $isControl = ($variation->control == 1);

        if (!$isControl) {
            $control = $wpdb->get_row("SELECT * FROM hc_variations WHERE idConnector=" . $variation->idConnector . " AND type=" . $variation->type . " AND control=1");
        } else {
            $control = $variation;
        }

        require_once 'includes/SplitTest.php';
        $stest = new SplitTest();

        //if is a simple variation update its data..if control, update all the other variations
        if (!$isControl) {

            $conversionsRate = $stest->conversionRate($variation->uniqueImpressions, $variation->conversions);
            $c_conversionsRate = $stest->conversionRate($control->uniqueImpressions, $control->conversions);

            $improovement = $stest->percentageImproovement($variation->uniqueImpressions, $variation->conversions, $control->uniqueImpressions, $control->conversions);

            $confidenceLevel = $stest->getConfidenceLevel($variation->uniqueImpressions, $variation->conversions, $control->uniqueImpressions, $control->conversions);

            //disable the variation if ctb bellow 5%
            $enabled = 1;
            if ($confidenceLevel < 5 && $confidenceLevel != 0) {
                $enabled = 2;
            }
            $result = $wpdb->update('hc_variations', array('conversionsRate' => $conversionsRate,
                'percentageImproovement' => $improovement,
                'chanceTbo' => $confidenceLevel), array('id' => $variation->id), array('%s', '%s', '%s'), array('%d'));


            if ($confidenceLevel > 95) {
                $this->_stop_test($variation->idConnector, $variation->type, $variation->id);
            }
            return;
        }
        
        $result = $wpdb->update('hc_variations', array('conversionsRate' => $conversionsRate), array('id' => $control->id), array('%s'), array('%d'));
        //update the rest of the variations
        $q = "SELECT * FROM hc_variations WHERE idConnector=" . $control->idConnector . " AND type=" . $control->type . " AND control=1";
        $control = $wpdb->get_row($q);
        $variations = $wpdb->get_results("SELECT * FROM hc_variations WHERE enabled=1 AND control=0 AND idConnector=" . $control->idConnector . " AND type=" . $control->type);
        foreach ($variations as $v) {

            $conversionsRate = $stest->conversionRate($v->uniqueImpressions, $v->conversions);
            $c_conversionsRate = $stest->conversionRate($control->uniqueImpressions, $control->conversions);

            $improovement = $stest->percentageImproovement($v->uniqueImpressions, $v->conversions, $control->uniqueImpressions, $control->conversions);

            $confidenceLevel = $stest->getConfidenceLevel($v->uniqueImpressions, $v->conversions, $control->uniqueImpressions, $control->conversions);

            //disable the variation if ctb bellow 5%
            $enabled = 1;
            if ($confidenceLevel < 5 && $confidenceLevel != 0) {
                $enabled = 2;
            }
            $result = $wpdb->update('hc_variations', array('conversionsRate' => $conversionsRate,
                'percentageImproovement' => $improovement,
                'chanceTbo' => $confidenceLevel, 'enabled' => $enabled), array('id' => $v->id), array('%s', '%s', '%s', '%d'), array('%d'));

            if ($confidenceLevel > 95) {
                $this->_stop_test($v->idConnector, $v->type, $v->id);
            }
        }
        $result = $wpdb->update('hc_variations', array('conversionsRate' => $stest->conversionRate($control->uniqueImpressions, $control->conversions)), 
                array('id' => $control->id), array('%s'), array('%d'));
    }

    function hc_frontend_comment_placeholder() {
        echo '<div id="hc_comments_marker" style="height:0px; width:0px;"></div>';
    }

    function _log_test($idConnector, $type, $testEndManual = 0) {
        global $wpdb;

        $test = $wpdb->get_results("SELECT * FROM hc_tests_log WHERE idConnector=" . $idConnector . " AND type=" . $type . " ORDER BY id DESC");
        $test = $test[0];

        $var0 = $wpdb->get_row("SELECT * FROM hc_variations WHERE idConnector=" . $idConnector . " AND type=" . $type . " AND control=1");
        $finalCtrlCurrent = $var0->id;

        //copy the final control
        $result = $wpdb->insert('hc_variations', array('idConnector' => $idConnector,
            'type' => $type,
            'name' => $var0->name,
            'totalImpressions' => $var0->totalImpressions,
            'uniqueImpressions' => $var0->uniqueImpressions,
            'conversions' => $var0->conversions,
            'conversionsRate' => $var0->conversionsRate,
            'percentageImproovement' => $var0->percentageImproovement,
            'chanceTbo' => $var0->chanceTbo,
            'enabled' => 0
                ), array('%d', '%d', '%s', '%d', '%d', '%d', '%s', '%s', '%s', '%d'));
        $id0 = $wpdb->insert_id;
        $this->MysqlCopyRow("hc_connector_text", "id_connector", $var0->id, $idConnector, null, $type, null, $id0, true);
        $this->MysqlCopyRow("hc_style_button", "id_connector", $var0->id, $idConnector, null, $type, null, $id0, true);
        $this->MysqlCopyRow("hc_style_email", "id_connector", $var0->id, $idConnector, null, $type, null, $id0, true);
        $this->MysqlCopyRow("hc_style_connector", "id_connector", $var0->id, $idConnector, null, $type, null, $id0, true);
        $this->MysqlCopyRow("hc_style_image", "id_connector", $var0->id, $idConnector, null, $type, null, $id0, true);
        $this->MysqlCopyRow("hc_style_optin", "id_connector", $var0->id, $idConnector, null, $type, null, $id0, true);
        $this->MysqlCopyRow("hc_style_text", "id_connector", $var0->id, $idConnector, null, $type, null, $id0, true);
        //copy the initial control

        $var0 = $wpdb->get_row("SELECT * FROM hc_variations WHERE id=" . $test->initialControl);
        $initialCtrlCurrent = $var0->id;
        $result = $wpdb->insert('hc_variations', array('idConnector' => $idConnector,
            'type' => $type,
            'name' => $var0->name,
            'totalImpressions' => $var0->totalImpressions,
            'uniqueImpressions' => $var0->uniqueImpressions,
            'conversions' => $var0->conversions,
            'conversionsRate' => $var0->conversionsRate,
            'percentageImproovement' => $var0->percentageImproovement,
            'chanceTbo' => $var0->chanceTbo,
            'enabled' => 0
                ), array('%d', '%d', '%s', '%d', '%d', '%d', '%s', '%s', '%s', '%d'));
        $id1 = $wpdb->insert_id;

        $this->MysqlCopyRow("hc_connector_text", "id_connector", $var0->id, $idConnector, null, $type, null, $id1, true);
        $this->MysqlCopyRow("hc_style_button", "id_connector", $var0->id, $idConnector, null, $type, null, $id1, true);
        $this->MysqlCopyRow("hc_style_email", "id_connector", $var0->id, $idConnector, null, $type, null, $id1, true);
        $this->MysqlCopyRow("hc_style_connector", "id_connector", $var0->id, $idConnector, null, $type, null, $id1, true);
        $this->MysqlCopyRow("hc_style_image", "id_connector", $var0->id, $idConnector, null, $type, null, $id1, true);
        $this->MysqlCopyRow("hc_style_optin", "id_connector", $var0->id, $idConnector, null, $type, null, $id1, true);
        $this->MysqlCopyRow("hc_style_text", "id_connector", $var0->id, $idConnector, null, $type, null, $id1, true);

        $result = $wpdb->update('hc_tests_log', array('stopData' => date("Y-m-d H:i:s"),
            'initialControl' => $id1,
            'finalControl' => $id0,
            'initialControlCurrent' => $initialCtrlCurrent,
            'finalControlCurrent' => $finalCtrlCurrent,
            'testEndManual' => $testEndManual), array('id' => $test->id), array('%s', '%d', '%d', '%d'), array('%d'));
    }

    function admin_stop_test() {
        global $wpdb;
        check_ajax_referer('hyconspecialsecurityforajaxstring', 'security');
        $idConnector = $_POST['id_connector'];
        $idNewControl = $_POST['id_variation'];
        $type = $_POST['type'];
        $result1 = $wpdb->update('hc_tpl_types', array('testing' => 0, 'dateTestEnd' => date("Y-m-d H:i:s"), 'testEndManual' => 1), array('idConnector' => $_POST['id_connector'], 'type' => $_POST['type']), array('%d', '%s', '%d'), array('%d', '%d'));
        $result2 = $wpdb->update('hc_variations', array('control' => 0, 'enabled' => 0), array('idConnector' => $_POST['id_connector'], 'type' => $_POST['type']), array('%d', '%d'), array('%d', '%d'));

        $result3 = $wpdb->update('hc_variations', array('control' => 1, 'enabled' => 1), array('id' => $_POST['id_variation']), array('%d', '%d', '%d', '%d', '%d', '%s'), array('%d'));

        $this->_log_test($_POST['id_connector'], $_POST['type'], 1);
        echo 1;
        die;
    }

    function _stop_test($idConnector, $type, $idNewControl) {
        global $wpdb;
        $result1 = $wpdb->update('hc_tpl_types', array('testing' => 0, 'dateTestEnd' => date("Y-m-d H:i:s"), 'testEndManual' => 0), array('idConnector' => $idConnector, 'type' => $type), array('%d', '%s', '%d'), array('%d', '%d'));
        $result2 = $wpdb->update('hc_variations', array('control' => 0, 'enabled' => 0), array('idConnector' => $idConnector, 'type' => $type), array('%d', '%d'), array('%d', '%d'));

        $result3 = $wpdb->update('hc_variations', array('control' => 1, 'enabled' => 1), array('id' => $idNewControl), array('%d', '%d', '%d', '%d', '%d', '%s'), array('%d'));

        $this->_log_test($idConnector, $type, 0);
        
    }

    function _cr($t) {
        if ($t[0] == 0)
            return 0;
        return $t[1] / $t[0];
    }

    function _zscore($c, $t) {
        $z = $this->_cr($t) - $this->_cr($c);
        $s = ($this->_cr($t) * (1 - $this->_cr($t))) / $t[0] + ($this->_cr($c) * (1 - $this->_cr($c))) / $c[0];
        return $z / sqrt($s);
    }

    function _cumnormdist($x) {
        $b1 = 0.319381530;
        $b2 = -0.356563782;
        $b3 = 1.781477937;
        $b4 = -1.821255978;
        $b5 = 1.330274429;
        $p = 0.2316419;
        $c = 0.39894228;

        if ($x >= 0.0) {
            $t = 1.0 / ( 1.0 + $p * $x );
            return (1.0 - $c * exp(-$x * $x / 2.0) * $t *
                    ( $t * ( $t * ( $t * ( $t * $b5 + $b4 ) + $b3 ) + $b2 ) + $b1 ));
        } else {
            $t = 1.0 / ( 1.0 - $p * $x );
            return ( $c * exp(-$x * $x / 2.0) * $t *
                    ( $t * ( $t * ( $t * ( $t * $b5 + $b4 ) + $b3 ) + $b2 ) + $b1 ));
        }
    }

    function _ssize($conv) {
        $a = 3.84145882689;
        $res = array();
        $bs = array(0.0625, 0.0225, 0.0025);
        foreach ($bs as $b) {
            $res[] = (int) ((1 - $conv) * $a / ($b * $conv));
        }
        return $res;
    }
    
        //add tick box underneath comments so people can subscribe from there
    // Display of subscribe on comments option
function hc_frontend_comment_footer_optin() {
  global $post;
        if(get_option("hc_comment_optin")=="0") { $checkedMark = "checked"; }
  			$thisCommentFooter = '<p class="hybrid-comment-optin" style="margin-top:10px; float:left; display:block; width:100%;">
        <input id="hybridCommentOptin" name="hybridCommentOptin" type="checkbox" ' . $checkedMark . ' style="width:auto;" />
         <label for="hybridCommentOptin">' . get_option("hc_comment_text") . '</label>
				</p><input type="hidden" name="thispostid" value="' . $post->ID . '">';

			if ( is_user_logged_in() ) {
 		 		global $current_user;
				get_currentuserinfo();
				$thisCommentFooter .= '<input type="hidden" name="hycon_comment_name" value="' . $current_user->user_firstname . '" />
					<input type="hidden" name="hycon_comment_email" value="' . $current_user->user_email . '" />';
			}
			echo $thisCommentFooter;
      }

function hc_frontend_comment_subscription() {
  global $wpdb;
  $author = ( isset( $_POST['hycon_comment_name'] ) ) ? $_POST['hycon_comment_name'] : $_POST['author'];
	$email  = ( isset( $_POST['hycon_comment_email'] ) ) ? $_POST['hycon_comment_email'] : $_POST['email'];
  $my_mailinglist = $wpdb->get_results("SELECT * FROM wp_mailingList where IntegrationID=" . get_option("hc_comment_connector_id"));
  $my_mailingList = (isset($my_mailinglist[0])) ? $my_mailinglist[0] : null;
  $my_connector = $wpdb->get_results("SELECT * FROM wp_connectors WHERE IntegrationID=" . get_option("hc_comment_connector_id"));
  $my_connector = $my_connector[0];
  // only run if there is an api connection - custom html doesn't work here
  if ($my_connector->apiConnection == "1") {
  $this->updateSubscriptionStats(get_option("hc_comment_connector_id"), $author, $email, $_POST['thispostid'], "", "", "", 1);
  $this->hycon_api_subscribe($author, $email, $my_connector, $my_mailingList, $commentSubscribe = true);
}

}

}

function hybrid_connect_insert_connector($id) {
    global $wpdb;
    global $post;
    $rand_id = rand(1000, 10000);
    $my_connector = $wpdb->get_results("SELECT * FROM wp_connectors WHERE IntegrationID=" . $id);
    if (!isset($my_connector[0])) {
        echo "Hybrid Connect Error : Connector could not be found";
        return;
    }
    $my_connector = $my_connector[0];

    $tpl_type = $wpdb->get_row("SELECT * FROM hc_tpl_types WHERE idConnector=" . $id . " AND type=0");

    if ($tpl_type->testing == 1) {
        $variation = $wpdb->get_row("SELECT * FROM hc_variations WHERE enabled=1 AND idConnector=" . $id . " AND type=0 ORDER BY RAND() LIMIT 0,1");
    } else {
        $variation = $wpdb->get_row("SELECT * FROM hc_variations WHERE idConnector=" . $id . " AND type=0 AND control=1");
    }

    $my_settings = $wpdb->get_results("SELECT * FROM hc_templates where idConnector=" . $id);
    $my_settings = $my_settings[0];
    $my_settings->custom_html = html_entity_decode($my_settings->custom_html);
    $my_settings->custom_html2 = html_entity_decode($my_settings->custom_html2);
    $my_settings->custom_html = str_replace("\'", "'", $my_settings->custom_html);
    $my_settings->custom_html2 = str_replace("\'", "'", $my_settings->custom_html2);
    $style_text = $wpdb->get_results("SELECT * FROM hc_style_text where id_connector=" . $id . " AND type=0 AND idVariation=" . $variation->id);
    $style_text = $style_text[0];
    $style_button = $wpdb->get_results("SELECT * FROM hc_style_button where id_connector=" . $id . " AND type=0 AND idVariation=" . $variation->id);
    $style_button = $style_button[0];
    $style_connector = $wpdb->get_results("SELECT * FROM hc_style_connector where id_connector=" . $id . " AND type=0 AND idVariation=" . $variation->id);
    $style_connector = $style_connector[0];
    $style_email = $wpdb->get_results("SELECT * FROM hc_style_email where id_connector=" . $id . " AND type=0 AND idVariation=" . $variation->id);
    $style_email = $style_email[0];
    $style_image = $wpdb->get_results("SELECT * FROM hc_style_image where id_connector=" . $id . " AND type=0 AND idVariation=" . $variation->id);
    $style_image = $style_image[0];
    $style_optin = $wpdb->get_results("SELECT * FROM hc_style_optin where id_connector=" . $id . " AND type=0 AND idVariation=" . $variation->id);
    $style_optin = $style_optin[0];
    $connector_txt = $wpdb->get_results("SELECT * FROM hc_connector_text where id_connector=" . $id . " AND type=0 AND idVariation=" . $variation->id);
    $connector_txt = $connector_txt[0];
    $connector_txt->optin_description = stripslashes($connector_txt->optin_description);
    // $connector_txt->optin_description = str_replace("style=", "temp=", $connector_txt->optin_description);
    $connector_txt->optin_headline = stripslashes($connector_txt->optin_headline);
    $connector_txt->email_call = stripslashes($connector_txt->email_call);
    $connector_txt->fb_call = stripslashes($connector_txt->fb_call);
    $connector_txt->oneclick_call = stripslashes($connector_txt->oneclick_call);
    $connector_txt->email_btn = stripslashes($connector_txt->email_btn);
    $connector_txt->fb_btn = stripslashes($connector_txt->fb_btn);
    $connector_txt->oneclick_btn = stripslashes($connector_txt->oneclick_btn);
    $hc_is_footer = false;
    $hc_is_theme_code = true;
    //OLD CALL FOR SELECTING A SPECIFIC TEMPLATE
    $template_path = 'templates/template.php';
    ob_start();
    include $template_path;
    $hc_content = ob_get_contents();
    ob_end_clean();
    $hc_content = str_replace("\r\n", '', $hc_content);
    echo $hc_content;
    return;
}

?>