<?php
/**
 * Config file, return as json_encode
 * http://www.aa-team.com
 * =======================
 *
 * @author		Andrei Dinca, AA-Team
 * @version		1.0
 */
 echo json_encode(
	array(
		'setup_backup' => array(
			'version' => '1.0',
			'menu' => array(
				'order' => 31,
				'title' => __('Setup / Backup', $psp->localizationName)
				,'icon' => 'assets/menu_icon.png'
			),
			'desciption' => __("Core Modules, can't be deactivate!", $psp->localizationName)
		)
	)
 );