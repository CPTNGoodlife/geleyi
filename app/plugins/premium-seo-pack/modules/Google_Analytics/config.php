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
		'Google_Analytics' => array(
			'version' => '1.0',
			'menu' => array(
				'order' => 11,
				'title' => __('Google Analytics', $psp->localizationName)
				,'icon' => 'assets/menu_icon.png'
			),
			'in_dashboard' => array(
				'icon' 	=> 'assets/32.png',
				'url'	=> admin_url('admin.php?page=' . $psp->alias . "_Google_Analytics")
			),
			'desciption' => "We’ve made a module that takes the data from Google Analytics and transforms it into a easy to understand dashboard, that will allow you to see the impact on search engines.",
			'module_init' => 'init.php'
		)
	)
 );