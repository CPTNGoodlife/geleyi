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

//Add body classes
$body_classes = 'no_js maintenance';
if( ( yit_get_option( 'responsive-enabled' ) && !$GLOBALS['is_IE'] ) || ( yit_get_option( 'responsive-enabled' ) && yit_ie_version() >= 9 ) ) {
    $body_classes .= ' responsive';
}

$body_classes .= ' ' . yit_get_option( 'layout-type' );
?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" class="ie"<?php language_attributes() ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7"  class="ie"<?php language_attributes() ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8"  class="ie"<?php language_attributes() ?>>
<![endif]-->
<!--[if IE 9]>
<html id="ie9"  class="ie"<?php language_attributes() ?>>
<![endif]-->
<!--[if gt IE 9]>
<html class="ie"<?php language_attributes() ?>>
<![endif]-->

<!-- This doesn't work but i prefer to leave it here... maybe in the future the MS will support it... i hope... -->
<!--[if IE 10]>
<html id="ie10"  class="ie"<?php language_attributes() ?>>
<![endif]-->


<!--[if !IE]>
<html <?php language_attributes() ?>>
<![endif]-->

<!-- START HEAD -->
<head>
    <?php do_action( 'yit_head' ) ?>
    <?php wp_head() ?>
    <?php $newsletter['submit']['border'] = yit_get_option('maintenance-newsletter-submit-border-color'); ?>
    <?php $social_text = yit_get_option('maintenance_social_text_shortcode'); ?>
    <?php $title = yit_get_option('maintenance-general-title'); ?>
    <?php $newsletter['font'] = yit_get_option('maintenance-newsletter-submit-font') ?>

    <style type="text/css">
    	body {
			background: <?php echo $background['color'] ?> <?php if($background['image']): ?>url('<?php echo $background['image'] ?>') <?php echo $background['repeat'] ?> <?php echo $background['position'] ?> <?php echo $background['attachment'] ?><?php endif ?>;
    	}

        #maintenance_wrapper{
            width: 940px;
            margin: 0 auto;
            margin-bottom: 70px;
        }

        #maintenance_main_container{
            width: 470px;
            float: right;
            margin-right: 180px;
        }
    	#maintenance_container {
    		margin: 0 auto;
    		width: 470px;
    		min-height: <?php echo $container['height'] ?>px;
    		background-color: transparent;
            padding-bottom: 30px;
    	}

        #maintenance_logo_container {
            width: 470px;
            height: 142px;
            margin: 0 auto;
            display: table;

            <?php if( $logo['color'] != 'transparent' ): ?>
                background: <?php echo $logo['color'] ?>;
                -moz-box-shadow: 3px 3px 0px rgba(0,0,0,0.2);
                -webkit-box-shadow: 3px 3px 0px rgba(0,0,0,0.2);
                box-shadow: 3px 3px 0px rgba(0,0,0,0.2);
            <?php endif ?>

        }

    	#maintenance_logo {
            margin-top: 0px;
    		text-align: center;

            display: table-cell;
            vertical-align: middle;
            <?php if( $logo['color'] ): ?>background: <?php echo $logo['color'] ?><?php endif ?>
    	}

        #maintenance_container{
            padding-top: 60px;
        }

		#maintenance_message,
        #maintenance_social_text{
			/*padding: 16px 29px 8px 29px;*/
		}

        #maintenance_social_text{
            padding-bottom: 16px;
            padding-top: 21px;
            display: table;
            margin: 0 auto;
        }

        #maintenance_message h2,
        #maintenance_social_text h2{
            font-size:33px;
            font-weight: 600;
            color: #fff;
            padding: 0 0 10px 0;
            margin: 5px 0 0 0;
            border-bottom: 1px solid rgba(255,255,255,0.5);
        }

        #maintenance_message p,
        #maintenance_social_text p{
            line-height: 22px;
            font-weight: 300;
            margin-top: 30px;
            font-size: 18px;
            color: #fff;
            padding-bottom: 20px;
        }

        #maintenance_social_text .socials-square,
        #maintenance_social_text .fade-socials{
            float: none;
            display: inline-block;
            margin: 0;
            margin-top: 20px;
        }


        #maintenance_twitter_text{
            margin: 0 auto;
            margin-top: 40px;
            margin-bottom: 40px;
            margin-left: -20px;
            /*background: url('<?php echo get_template_directory_uri() ?>/images/maintenance_twitter.png') no-repeat 0 center;*/
        }

        #maintenance_twitter_text ul{
            list-style: none;
            padding-left: 0;
            margin-left: 0;
        }

        #maintenance_twitter_text ul li{
            color: #6d6d6d;
            font-size: 13px;
            height: 30px;
            display: none;
            text-align: center;

        }

        #maintenance_twitter_text ul li span{
            background: url('<?php echo get_template_directory_uri() ?>/images/maintenance_twitter.png') no-repeat 0 center;
            padding: 14px;
        }
        #maintenance_twitter_text ul li a{
             color: #605e5e;
             font-size: 13px;
         }

        #maintenance_twitter_text ul li a:hover{
            color: #000;
        }


        #maintenance_newsletter{
            margin: 0px;
            padding: 0px;
        }

		#maintenance_newsletter .newsletter-section {
            padding: 0px 14px 0px 22px;
            padding: 0px;
            width: auto;
			margin: 0 auto;
            border: 0;
		}

        #maintenance_newsletter .newsletter-section form{
            margin-bottom:0;
        }

        #maintenance_newsletter .newsletter-section ul{
            margin-bottom: 7px;
        }

		#maintenance_newsletter .newsletter-section input.text-field{
			width: 334px;
			background: #fff url('<?php echo get_template_directory_uri() ?>/images/maintenance_mail.png') no-repeat 0 center;
			background-position: 13px center;
			border: 1px solid #dcdcdc;
            padding-left: 50px !important;
            padding-top: 15px;
            -moz-box-shadow: 3px 3px 0px rgba(0,0,0,0.2);
            -webkit-box-shadow: 3px 3px 0px rgba(0,0,0,0.2);
            box-shadow: 3px 3px 0px rgba(0,0,0,0.2);
			-moz-border-radius: 0px;
			-webkit-border-radius: 0;
			border-radius: 0;
            margin: 0 0 0 0px;
            height:50px;
		}


        #maintenance_newsletter .newsletter-section input.text-field:focus{
            -moz-box-shadow: 3px 3px 0px rgba(0,0,0,0.2) !important;
            -webkit-box-shadow: 3px 3px 0px rgba(0,0,0,0.2) !important;
            box-shadow: 3px 3px 0px rgba(0,0,0,0.2) !important;
        }

		#maintenance_newsletter .newsletter-section label {
			top: 17px;
			left: 44px;
		}

		#maintenance_newsletter .newsletter-section input.sendmail {
			background: <?php echo $newsletter['submit']['color'] ?>;
            border: none !important;
            height: 50px !important;
            text-transform: uppercase !important;
            text-shadow: #000 0 0px 0px !important;
            box-shadow: none;
            position: relative !important;
            border-radius: 0;
            top: -3px;
            font-family: "<?php echo $newsletter['font']['family'] ?>";
            font-size: <?php echo $newsletter['font']['size'] . $newsletter['font']['unit'] ?>;
            color: <?php echo $newsletter['font']['color'] ?>;

            -moz-box-shadow: 3px 3px 0px rgba(0,0,0,0.2);
            -webkit-box-shadow: 3px 3px 0px rgba(0,0,0,0.2);
            box-shadow: 3px 3px 0px rgba(0,0,0,0.2);

            padding: 0 33px !important;

        <?php
            if ( isset( $newsletter['font']['style'] ) ) {
                switch ( $newsletter['font']['style'] ) {
                    case 'bold' :
                        $newsletter['font']['font-style']  = 'normal';
                        $newsletter['font']['font-weight'] = '700';
                        break;
                    case 'extra-bold' :
                        $newsletter['font']['font-style']  = 'normal';
                        $newsletter['font']['font-weight'] = '800';
                        break;
                    case 'italic' :
                        $newsletter['font']['font-style']  = 'italic';
                        $newsletter['font']['font-weight'] = 'normal';
                        break;
                    case 'bold-italic' :
                        $newsletter['font']['font-style']  = 'italic';
                        $newsletter['font']['font-weight'] = '700';
                        break;
                    case 'regular' :
                        $newsletter['font']['font-style']  = 'normal';
                        $newsletter['font']['font-weight'] = '400';
                        break;
                }
            }
         ?>

            font-style: <?php echo $newsletter['font']['font-style'] ?>;
            font-weight: <?php echo $newsletter['font']['font-weight'] ?>;
		}

        #maintenance_social_text div{
            margin: 0px 8px;
        }

        #maintenance_newsletter .newsletter-section input.sendmail:hover {
			background: <?php echo yit_get_option('maintenance-newsletter-background_hover') ?> !important;
		}

        #maintenance_newsletter .newsletter-section input.sendmail:active {
			top:-3px;
		}

        @media (min-width: 1200px) {
            #maintenance_wrapper {  width: 1170px; }
        }

		@media (min-width: 768px) and (max-width: 979px) {
            #maintenance_wrapper {  width: 724px;  }
            #maintenance_main_container{ margin-right: 60px;  }
		}

		@media (max-width: 767px) {
            #maintenance_main_container{ margin: 0 auto; float: none;  margin-bottom: 50px; }
            #maintenance_wrapper { width: auto;}
            #maintenance_container .submit-button .sendmail { margin-top: 10px; }
            #maintenance_container {  margin-bottom: 20px; margin-top: -30px; }
			#maintenance_message { padding: 10px 12px }
            #maintenance_message p, #maintenance_social_text p{ padding-bottom: 0px }
			#maintenance_newsletter { margin-top: 0px; padding:0px; }
			#maintenance_newsletter .newsletter-section li { float: none; text-align: center; display: inline-block; width: 100%;  }
			#maintenance_newsletter .newsletter-section input.text-field { width: 75%; margin-left: 0; }
			#maintenance_newsletter .newsletter-section input.submit-field { float: none; display: inline-block; }
		}

		@media (max-width: 480px) {
           #maintenance_main_container{ margin: 0 auto; float: none; width:100% }
           #maintenance_logo_container, #maintenance_container, #maintenance_twitter_text { width:98%; padding:0 2% }
           #maintenance_container {  margin-bottom: 20px; margin-top: 40px; }
           #maintenance_message h2, #maintenance_social_text h2 { font-size: 28px;  line-height: 30px }
           #maintenance_twitter_text { margin-top: 70px; }
           #maintenance_message { padding: 0px; }
		}

		@media (max-width: 320px) {
            #maintenance_container {  margin-bottom: 10px; margin-top: 30px; }
            #maintenance_message h2, #maintenance_social_text h2 { font-size: 24px; line-height: 28px }
            #maintenance_message { margin-bottom: 20px }
            #maintenance_message p, #maintenance_social_text p { font-size: 15px }
            #maintenance_twitter_text { margin-top: 40px; }
		}


    	<?php echo $custom ?>
    </style>
</head>
<!-- END HEAD -->
<!-- START BODY -->
<body <?php body_class( $body_classes ) ?>>
<div id="maintenance_wrapper" class="clear-fix">
        <div id="maintenance_main_container">
            <?php if( $logo['image'] ): ?>
                <div id="maintenance_logo_container">
                    <div id="maintenance_logo">
                        <img src="<?php echo $logo['image'] ?>" alt="<?php bloginfo() ?>" />
                    </div>
                </div>
            <?php endif ?>

            <div id="maintenance_container" class="clearfix">
                    <div id="maintenance_message">
                        <?php if($title) : ?>
                        <h2><?php echo $title ?></h2>
                        <?php endif ?>

                        <?php if( $message ): ?>
                        <p><?php echo $message ?></p>
                        <?php endif ?>
                    </div>


                    <?php if( $newsletter['enabled'] ): ?>
                    <div id="maintenance_newsletter">
                        <?php echo do_shortcode('[newsletter_form submit="' . __( 'Get Notify', 'yit' ) .'"]'); ?>
                    </div>
                    <?php endif ?>
            </div>
        </div>
        <div class="clear"></div>
    </div>

        <?php
            $twitter_username=yit_get_option('twitter-username');
            $twitter_consumer_key=yit_get_option('twitter-consumer-key');
            $twitter_consumer_secret=yit_get_option('twitter-consumer-secret');
            $twitter_access_token=yit_get_option('twitter-access-token');
            $twitter_access_token_secret=yit_get_option('twitter-access-token-secret');
            $tweets = yit_get_tweets( $twitter_access_token, $twitter_access_token_secret, $twitter_consumer_key, $twitter_consumer_secret, 3 );

            if( !isset( $tweets -> errors ) ){

                ?>
                <script type="text/javascript">
                     jQuery(document).ready(function($){
                         $('#maintenance_twitter_text').flexslider({
                            animation: 'fade',
                            slideshowSpeed: 5000,
                            animationSpeed: 300,
                            selectors: '.slides > li',
                            directionNav: false,
                            slideshow: true,
                            pauseOnAction: false,
                            controlNav: false,
                            touch: true
                        });
                    });
                </script>
                <div id="maintenance_twitter_text">
                    <ul class="slides">
                         <?php
                            $i=0;
                            foreach( $tweets as $tweet ){ ?>

                                <li class="tweet-<?php echo $i ?>"><span></span><div class="text"><?php echo $tweet -> text ?></div>
                                <script type="text/javascript">
                                    jQuery(function($){
                                        var text = twttr.txt.autoLink("<?php echo addslashes( str_replace( "\n", " ", $tweet -> text ) ) ?>");
                                        $('#maintenance_twitter_text ul  li.tweet-<?php echo $i++ ?> .text').replaceWith(text);
                                    });
                                </script>
                                </li>
                           <?php }
                         ?>
                    </ul>

                 </div>
            <?php

            }
        ?>
    </div>

    <div id="maintenance_social_text" style="text-align:center">
        <?php echo do_shortcode($social_text) ?>
    </div>

	<?php wp_footer() ?>
</body>
</html>