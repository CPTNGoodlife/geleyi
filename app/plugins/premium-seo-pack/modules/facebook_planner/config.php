<?php
/**
 * W3C_HTMLValidator Config file, return as json_encode
 * http://www.aa-team.com
 * =======================
 *
 * @author		Andrei Dinca, AA-Team
 * @version		1.0
 */
 echo json_encode(
	array(
		'facebook_planner' => array(
			'version' => '1.0',
			'menu' => array(
				'order' => 96,
				'show_in_menu' => false,
				'title' => __('Facebook Planner', $psp->localizationName)
				,'icon' => 'assets/menu_icon.png'
			),
			'in_dashboard' => array(
				'icon' 	=> 'assets/32.png',
				'url'	=> admin_url("admin.php?page=psp#facebook_planner")
			),
			'desciption' => __('This module allows you to post your content to facebook.', $psp->localizationName),
			'module_init' => 'init.php'
		)
	)
 );