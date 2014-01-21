<?php  if ( ! defined('OP_DIR')) exit('No direct script access allowed');
$config['name'] = 'Template Style 2 - Flat Border';
$config['screenshot'] = 'styles/ms-2b.jpg';
$config['screenshot_thumbnail'] = 'styles/ms-2b.jpg';
$config['description'] = 'This fixed width template is perfect for pages using a header image';
$config['header_width'] = 1060;

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