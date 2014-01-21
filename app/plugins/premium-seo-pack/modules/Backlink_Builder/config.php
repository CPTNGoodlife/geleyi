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
		'backlink_builder' => array(
			'version' => '1.0',
			'menu' => array(
				'order' => 99,
				'show_in_menu' => false,
				'title' => __('Backlink Builder', $psp->localizationName),
				'icon' => 'assets/menu_icon.png'
			),
			'in_dashboard' => array(
				'icon' 	=> 'assets/32.png',
				'url'	=> admin_url('admin.php?page=' . $psp->alias . "_Backlink_Builder")
			),
			'desciption' => __("Our Backlink Builder Module will automatically add your link to thousands of different website directories that will automatically provide free backlinks for you in just minutes!", $psp->localizationName),
			'module_init' => 'init.php'
		)
	)
);