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
		'on_page_optimization' => array(
			'version' => '1.0',
			'menu' => array(
				'order' => 93,
				'show_in_menu' => false,
				'title' => __('Mass Optimization', $psp->localizationName),
				'icon' => 'assets/menu_icon.png',
			),
			'in_dashboard' => array(
				'icon' 	=> 'assets/32.png',
				'url'	=> admin_url('admin.php?page=' . $psp->alias . "_massOptimization")
			),
			'desciption' => __('This is a premium feature that will allow you to mass optimize your wordpress website in just a few clicks! It\'s the most unique feature and you will not find it anywhere else on the market.', $psp->localizationName),
			'module_init' => 'init.php'
		)
	)
 );