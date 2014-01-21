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
		'Link_Redirect' => array(
			'version' => '1.0',
			'menu' => array(
				'order' => 98,
				'show_in_menu' => false,
				'title' => __('301 Link Redirect', $psp->localizationName)
				,'icon' => 'assets/menu_icon.png'
			),
			'in_dashboard' => array(
				'icon' 	=> 'assets/32.png',
				'url'	=> admin_url('admin.php?page=' . $psp->alias . "_Link_Redirect")
			),
			'desciption' => "This module is very useful for any permalink changes.
The Link Redirect Module gives you an easy way of redirecting requests to other pages on your site or anywhere else on the web.
",
			'module_init' => 'init.php'
		)
	)
 );