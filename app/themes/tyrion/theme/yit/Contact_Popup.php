<?php
/**
 * Your Inspiration Themes
 *
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Contact Popup
 *
 */
class YIT_Contact_Popup {

    protected $_queryString = 'yit-contact-popup';


    /**
     * Constructor
     *
     */
    public function __construct() { }

    /**
     * Init
     *
     */
    public function init() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );

        if( !yit_get_option('enable-contact-popup') ) return;

        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_action( 'wp_ajax_yit_contact_popup', array( $this, 'init_popup' ) );
        add_action( 'wp_ajax_nopriv_yit_contact_popup', array( $this, 'init_popup' ) );

        //send email checks
        add_action( 'wp_ajax_yit_contact_popup_send_email', array( $this, 'send_email' ) );
        add_action( 'wp_ajax_nopriv_yit_contact_popup_send_email', array( $this, 'send_email' ) );
    }


    public function init_popup() {
        if ( ! wp_verify_nonce( $_REQUEST['_nonce'], 'yit-contact-popup-nonce' ) )
            die ( 'You are not authorized!' );

            $title = yit_get_option('contact-title');
            $contact = yit_get_option('contact-popup');
            $content = yit_get_option('contact-content');

            yit_get_template('contact-popup/markup.php', array(
                'contact' => $contact,
                'title' => $title,
                'content' => $content
            ));

            die();
    }

    public function send_email() {
        if ( ! wp_verify_nonce( $_REQUEST['_nonce'], 'yit-contact-popup-nonce' ) )
            die ( 'You are not authorized!' );

        //yit_get_model('contact_form')->send_email();
        $contact = yit_get_option('contact-popup');
        echo do_shortcode( '[contact_form name="'. $contact .'" ]' );
        die();
    }

    public function enqueue_scripts() {
        wp_enqueue_script( 'contact-popup', get_template_directory_uri() .'/theme/assets/js/yit/jquery.contact-popup.js', array('jquery'), '1.0', true);

        wp_localize_script( 'contact-popup', 'contact_popup_vars', array(
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'url'     => add_query_arg($this->_queryString, 'true', home_url()),
                'nonce'   => wp_create_nonce( 'yit-contact-popup-nonce' )
            )
        );
    }

    public function enqueue_styles() {
        yit_enqueue_style( 100, 'contact-popup', get_template_directory_uri() . '/theme/assets/css/contact-popup.css', array(), '1.0.0' );
    }

}