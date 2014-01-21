<?php
/**
 * Config file, return as json_encode
 * http://www.aa-team.com
 * ======================
 *
 * @author		Andrei Dinca, AA-Team
 * @version		1.0
 */
 echo json_encode(
	array(
		'sitemap' => array(
			'version' => '1.0',
			'menu' => array(
				'order' => 20,
				'title' => __('Sitemap', $psp->localizationName)
				,'icon' => 'assets/menu_icon.png'
			),
			'in_dashboard' => array(
				'icon' 	=> 'assets/32.png',
				'url'	=> admin_url("admin.php?page=psp#sitemap")
			),
			'desciption' => __('The sitemap is generated automatically, and you can submit it to Google or Bing right from the dashboard. You can choose what to include, and if you want to include Images as well.', $psp->localizationName),
			'module_init' => 'init.php',
			
			'shortcodes_btn' => array(
				'icon' 	=> 'assets/menu_icon.png',
				'title'	=> __('Insert Sitemap sh', $psp->localizationName)
			)
		)
	)
 );