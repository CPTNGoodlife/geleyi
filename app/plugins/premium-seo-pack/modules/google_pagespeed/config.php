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
		'google_pagespeed' => array(
			'version' => '1.0',
			'menu' => array(
				'order' => 94,
				'show_in_menu' => false,
				'title' => __('PageSpeed Insights', $psp->localizationName),
				'icon' => 'assets/16_pagespeed.png'
			),
			'in_dashboard' => array(
				'icon' 	=> 'assets/32.png',
				'url'	=> admin_url('admin.php?page=' . $psp->alias . "_PageSpeedInsights")
			),
			'desciption' => __('The PageSpeed Insights lets you analyze the performance of your website pages. It offers tailored suggestions for how you can optimize your pages.', $psp->localizationName),
			'module_init' => 'init.php'
		)
	)
 );