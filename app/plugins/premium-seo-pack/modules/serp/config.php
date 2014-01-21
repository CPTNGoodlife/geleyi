<?php
/**
 * Config file, return as json_encode
 * http://www.aa-team.com
 * =======================
 *
 * @author		Andrei Dinca, AA-Team
 * @version		1.0
 */
global $psp;
echo json_encode(
	array(
		'serp' => array(
			'version' => '1.0',
			'menu' => array(
				'order' => 14,
				'title' => __('SERP', $psp->localizationName)
				,'icon' => 'assets/menu_icon.png'
			),
			'in_dashboard' => array(
				'icon' 	=> 'assets/32.png',
				'url'	=> admin_url('admin.php?page=' . $psp->alias . "_SERP")
			),
			'desciption' => __('This module reads the results from Google for you focus keywords', $psp->localizationName),
			'module_init' => 'init.php'
		)
	)
);