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
		'Social_Stats' => array(
			'version' => '1.0',
			'menu' => array(
				'order' => 18,
				'title' => __('Social Stats', $psp->localizationName)
				,'icon' => 'assets/menu_icon.png'
			),
			'in_dashboard' => array(
				'icon' 	=> 'assets/32.png',
				'url'	=> admin_url('admin.php?page=' . $psp->alias . "_Social_Stats")
			),
			'desciption' => __('You’re putting a lot of effort on marketing your website trough social media? Want to know for sure if your tactics have results? ', $psp->localizationName),
			'module_init' => 'init.php'
		)
	)
 );