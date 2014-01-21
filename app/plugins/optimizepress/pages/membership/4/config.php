<?php  if ( ! defined('OP_DIR')) exit('No direct script access allowed');
$config['name'] = 'Template Style 4 - Raised Header';
$config['screenshot'] = 'styles/ms-4b.jpg';
$config['screenshot_thumbnail'] = 'styles/ms-4b.jpg';
$config['description'] = 'This design includes the raised header for giving header banners more impact';
$config['header_width'] = 960;

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