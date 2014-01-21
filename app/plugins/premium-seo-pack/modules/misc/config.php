<?php
/**
 * Social_Stats Config file, return as json_encode
 * http://www.aa-team.com
 * ======================
 *
 * @author		Andrei Dinca, AA-Team
 * @version		1.0
 */
 echo json_encode(
	array(
		'misc' => array(
			'version' => '1.0',
			'menu' => array(
				'order' => 13,
				'title' => __('Miscellaneous', $psp->localizationName)
				,'icon' => 'assets/menu_icon.png'
			),
			'in_dashboard' => array(
				'icon' 	=> 'assets/32.png',
				'url'	=> admin_url("admin.php?page=psp#misc")
			),
			'desciption' => __('Usefull SEO Settings', $psp->localizationName),
			'module_init' => 'init.php'
		)
	)
 );