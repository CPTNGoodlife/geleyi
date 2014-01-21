<?php  if ( ! defined('OP_DIR')) exit('No direct script access allowed');
$config['name'] = 'Full Background Style';
$config['screenshot'] = 'LP_4A.jpg';
$config['screenshot_thumbnail'] = 'LP_4A-thumb.jpg';
$config['description'] = 'Landing page with full screen background';

$config['header_layout'] = array(
	'menu-positions' => array(
		'alongside' => array(
			'title' => 'Alongside Logo',
			'preview' => array(
				'image' => OP_IMG.'previews/navpos_alongside.png',
				'width' => 477,
				'height' => 67
			),
			'link_color' => true,
			'link_selector' => '.banner .nav > li > a',
			'dropdown_selector' => '.banner .nav a',
		),
		'below' => array(
			'title' => 'Beneath Logo',
			'preview' => array(
				'image' => OP_IMG.'previews/navpos_below.png',
				'width' => 477,
				'height' => 89
			),
		)
	)
);

$config['disable'] = array(
	'layout' => array(
		'header_layout' => true,
		'footer_area' => array(
			'large_footer' => true,
		)
	),
	'color_schemes' => true,
	'content_layout' => true,
	'functionality' => array(
		'comments' => true,
	)
);

$config['feature_areas'] = array(
	'A' => array(
		'image' => $theme_url.'styles/LP_4A.jpg',
		'width' => 212,
		'height' => 156,
                'tooltip_title' => 'Theme 1',
                'tooltip_description' => 'White box on full background'
	),
	'B' => array(
		'image' => $theme_url.'styles/LP_4B.jpg',
		'width' => 212,
		'height' => 156,
                'tooltip_title' => 'Theme 2',
                'tooltip_description' => 'Black box on full background'
	)
);