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
		'file_edit' => array(
			'version' => '1.0',
			'menu' => array(
				'order' => 95,
				'show_in_menu' => false,
				'title' => __('Files Edit', $psp->localizationName)
				,'icon' => 'assets/menu_icon.png'
			),
			'in_dashboard' => array(
				'icon' 	=> 'assets/32.png',
				'url'	=> admin_url('admin.php?page=' . $psp->alias . "_massFileEdit")
			),
			'desciption' => __('Edit important files: .htaccess & robots.txt', $psp->localizationName),
			'module_init' => 'init.php'
		)
	)
 );