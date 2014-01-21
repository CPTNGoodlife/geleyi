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
 * Class to print fields in the tab Typography -> Header
 *
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Typography_Header extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     *
     * @var array
     * @since 1.0.0
     */
    public $fields;

    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_typography_header
     *
     * @param array $fields
     * @since 1.0.0
     */
    public function __construct() {
        $fields = $this->init();
        $this->fields = apply_filters( strtolower( __CLASS__ ), $fields );
    }

    /**
     * Set default values
     *
     * @return array
     * @since 1.0.0
     */
    public function init() {
        return array(
            5 => array(
                'id'   => 'topbar-font',
                'type' => 'typography',
                'name' => __( 'Topbar font', 'yit' ),
                'desc' => __( 'Select the type to use for the topbar.', 'yit' ),
                'min'  => 1,
                'max'  => 18,
                'std'  => apply_filters( 'yit_topbar-font_std', array(
                    'size'   => 10,
                    'unit'   => 'px',
                    'family' => 'Lato',
                    'style'  => 'regular',
                    'color'  => '#ffffff'
                ) ),
                'style' => array(
                    'selectors' => '#topbar, #topbar p, #topbar a, #topbar li',
                    'properties' => 'font-size, font-family, color, font-style, font-weight'
                )
            ),


            6 => array(
                'id' => 'topbar-links',
                'type' => 'colorpicker',
                'name' => __( 'Topbar links color', 'yit' ),
                'desc' => __( 'Select the color of the links in topbar.', 'yit' ),
                'std' => '#ffffff',
                'style' => array(
                    'selectors' => '#topbar a, #topbar #lang_sel a',
                    'properties' => 'color'
                )
            ),
            7 => array(
                'id' => 'topbar-links-hover',
                'type' => 'colorpicker',
                'name' => __( 'Topbar links hover color', 'yit' ),
                'desc' => __( 'Select the hover color of the links in topbar.', 'yit' ),
                'std' => '#a4a3a3',
                'style' => array(
                    'selectors' => '#topbar a:hover, #topbar #lang_sel a:hover',
                    'properties' => 'color'
                )
            ),



            /* === LOGO FONT === */
            10 => array(
                'id'   => 'logo-font',
                'type' => 'typography',
                'name' => __( 'Logo font', 'yit' ),
                'desc' => __( 'Select the type to use for the logo font. ', 'yit' ),
                'min'  => 1,
                'max'  => 80,
                'std'  => apply_filters( 'yit_logo-font_std', array(
                    'size'   => 42,
                    'unit'   => 'px',
                    'family' => 'Lato',
                    'style'  => 'regular',
                    'color'  => '#302e2e'
                ) ),
                'style' => apply_filters( 'yit_logo-font_style', array(
                    'selectors' => '#header #logo #textual, span.logo',
                    'properties' => 'font-size, font-family, color, font-style, font-weight'
                ) )
            ),

            20 => array(
                'id'   => 'logo-highlight-font',
                'type' => 'typography',
                'name' => __( 'Logo font highlight', 'yit' ),
                'desc' => __( 'Select the type to use for the logo font highlight.', 'yit' ),
                'min'  => 1,
                'max'  => 80,
                'std'  => apply_filters( 'yit_logo-highlight-font_std', array(
                    'size'   => 42,
                    'unit'   => 'px',
                    'family' => 'Lato',
                    'style'  => 'regular',
                    'color'  => '#9f0808'
                ) ),
                'style' => array(
                    'selectors' => '#header #logo #textual span',
                    'properties' => 'font-size, font-family, color, font-style, font-weight'
                )
            ),

            30 => array(
                'id'   => 'logo-tagline-font',
                'type' => 'typography',
                'name' => __( 'Tagline font', 'yit' ),
                'desc' => __( 'Select the type to use for the tagline below the logo.', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_logo-tagline-font_std', array(
                    'size'   => 12,
                    'unit'   => 'px',
                    'family' => 'Lato',
                    'style'  => 'regular',
                    'color'  => '#0a0a0a'
                ) ),
                'style' => array(
                    'selectors' => '#header #logo #tagline',
                    'properties' => 'font-size, font-family, color, font-style, font-weight'
                )
            ),

            40 => array(
                'id'   => 'logo-tagline-highlight-font',
                'type' => 'typography',
                'name' => __( 'Tagline font highlight', 'yit' ),
                'desc' => __( 'Select the type to use for the tagline highlight.', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_logo-tagline-highlight-font_std', array(
                    'size'   => 12,
                    'unit'   => 'px',
                    'family' => 'Lato',
                    'style'  => 'bold',
                    'color'  => '#000000'
                ) ),
                'style' => array(
                    'selectors' => '#header #logo #tagline span',
                    'properties' => 'font-size, font-family, color, font-style, font-weight'
                )
            ),
             61 => array(
                'id'   => 'slogan-font',
                'type' => 'typography',
                'name' => __( 'Slogan font', 'yit' ),
                'desc' => __( 'Select the type to use for the slogan. ', 'yit' ),
                'min'  => 1,
                'max'  => 40,
                'std'  => apply_filters( 'yit_slogan-font_std', array(
                    'size'   => 36,
                    'unit'   => 'px',
                    'family' => 'Lato',
                    'style'  => 'bold',
                    'color'  => '#4d4b4b'
                ) ),
                'style' => apply_filters( 'yit_slogan-font_style', array(
					'selectors' => '.slogan h2',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				) )
            ),
            62 => array(
                'id'   => 'sub-slogan-font',
                'type' => 'typography',
                'name' => __( 'Sub Slogan font', 'yit' ),
                'desc' => __( 'Select the type to use for the sub slogan. ', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_sub-slogan-font_std', array(
                    'size'   => 18,
                    'unit'   => 'px',
                    'family' => 'Lato',
                    'style'  => 'Light',
                    'color'  => '#868484'
                ) ),
                'style' => apply_filters( 'yit_sub-slogan-font_style', array(
					'selectors' => '.slogan h3',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				) )
            ),
            /* == END LOGO FONT === */

/*
            100 => array(
                'type' => 'title',
                'name' => __( 'Parallax Image', 'yit' ),
                'desc' => __( 'Typography for parallax image content.', 'yit' )
            ),


            110 => array(
                'id'   => 'parallax-title-font',
                'type' => 'typography',
                'name' => __( 'Parallax Title Font', 'yit' ),
                'desc' => __( 'Select the typo to use for the parallax title.', 'yit' ),
                'min'  => 1,
                'max'  => 72,
                'std'  => apply_filters( 'yit_parallax-title-font_std', array(
                    'size'   => 45,
                    'unit'   => 'px',
                    'family' => 'Lato',
                    'style'  => 'bold',
                    'color'  => '#4a4137'
                ) ),
                'style' => apply_filters( 'yit_parallax-title-font-font_style', array(
                    'selectors' => '.parallaxeos_container .parallaxeos_animate h1',
                    'properties' => 'font-size, font-family, color, font-style, font-weight'
                ) )
            ),
            120 => array(
                'id'   => 'parallax-title-special-font',
                'type' => 'typography',
                'name' => __( 'Parallax Title Special Font', 'yit' ),
                'desc' => __( 'Select the typo to use for the text contained within the [] brackets in parallax title', 'yit' ),
                'min'  => 1,
                'max'  => 72,
                'std'  => apply_filters( 'yit_parallax-title-font_std', array(
                    'size'   => 45,
                    'unit'   => 'px',
                    'family' => 'Lato',
                    'style'  => 'extra-bold',
                    'color'  => '#4a4137'
                ) ),
                'style' => apply_filters( 'yit_parallax-title-font-font_style', array(
                    'selectors' => '.parallaxeos_container .parallaxeos_animate h1 span',
                    'properties' => 'font-size, font-family, color, font-style, font-weight'
                ) )
            ),
            130 => array(
                'id'   => 'parallax-subtitle-font',
                'type' => 'typography',
                'name' => __( 'Parallax SubTitle Font', 'yit' ),
                'desc' => __( 'Select the typo to use for the parallax subtitle.', 'yit' ),
                'min'  => 1,
                'max'  => 72,
                'std'  => apply_filters( 'yit_parallax-subtitle-font_std', array(
                    'size'   => 24,
                    'unit'   => 'px',
                    'family' => 'Lato',
                    'style'  => 'light',
                    'color'  => '#4a4137'
                ) ),
                'style' => apply_filters( 'yit_parallax-subtitle-font-font_style', array(
                    'selectors' => '.parallaxeos_container .parallaxeos_animate h2',
                    'properties' => 'font-size, font-family, color, font-style, font-weight'
                ) )
            ),
            140 => array(
                'id'   => 'parallax-link-font',
                'type' => 'typography',
                'name' => __( 'Parallax Link Font', 'yit' ),
                'desc' => __( 'Select the typo to use for the parallax links.', 'yit' ),
                'min'  => 1,
                'max'  => 72,
                'std'  => apply_filters( 'yit_parallax-link-font_std', array(
                    'size'   => 13,
                    'unit'   => 'px',
                    'family' => 'Lato',
                    'style'  => 'regular',
                    'color'  => '#4a4137'
                ) ),
                'style' => apply_filters( 'yit_parallax-link-font-font_style', array(
                    'selectors' => '.parallaxeos_container .parallaxeos_animate a',
                    'properties' => 'font-size, font-family, color, font-style, font-weight'
                ) )
            ),

            150 => array(
                'id' => 'parallax-link-hover-font',
                'type' => 'colorpicker',
                'name' => __( 'Parallax Link Font hover', 'yit' ),
                'desc' => __( 'Select the links color on mouse hover.', 'yit' ),
                'std' => '#ffffff',
                'style' => apply_filters( 'yit_parallax-link-hover-font_selectors', array(
                    'selectors' => '.parallaxeos_container .parallaxeos_animate a:hover',
                    'properties' => 'color'
                ) )
            ),

            160 => array(
                'id' => 'parallax-link-hover-background',
                'type' => 'colorpicker',
                'name' => __( 'Parallax Link Background hover', 'yit' ),
                'desc' => __( 'Select the links background color on mouse hover.', 'yit' ),
                'std' => '#4a4137',
                'style' => apply_filters( 'yit_parallax-link-hover-font_selectors', array(
                    'selectors' => '.parallaxeos_container .parallaxeos_animate a:hover',
                    'properties' => 'background-color'
                ) )
            ),
            /* == END LOGO FONT === */

        );
    }
}