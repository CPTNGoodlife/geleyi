<?php
/**
 * Config file, return as json_encode
 * http://www.aa-team.com
 * ======================
 *
 * @author		Andrei Dinca, AA-Team
 * @version		0.1 - in development mode
 */
 echo json_encode(
	array(
		'modules_manager' => array(
			'version' => '1.0',
			'menu' => array(
				'order' => 30,
				'title' => __('Modules manager', $psp->localizationName)
				,'icon' => 'assets/menu_icon.png'
			),
			'in_dashboard' => array(
				'icon' 	=> 'assets/32.png',
				'url'	=> admin_url("admin.php?page=psp#modules_manager")
			),
			'desciption' => __("Core Modules, can't be deactivated!", $psp->localizationName),
		)
	)
 );