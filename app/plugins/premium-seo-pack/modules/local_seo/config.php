<?php
/**
 * Local SEO Config file, return as json_encode
 * http://www.aa-team.com
 * ======================
 *
 * @author		Andrei Dinca, AA-Team
 * @version		1.0
 */
 echo json_encode(
	array(
		'local_seo' => array(
			'version' => '1.0',
			'menu' => array(
				'order' => 13,
				'title' => __('Local SEO', $psp->localizationName),
				'icon' => 'assets/menu_icon.png'
			),
			'in_dashboard' => array(
				'icon' 	=> 'assets/32.png',
				'url'	=> admin_url("admin.php?page=psp#local_seo")
			),
			'desciption' => __('Local SEO', $psp->localizationName),
			'module_init' => 'init.php',
			
			'shortcodes_btn' => array(
				'icon' 	=> 'assets/20-icon.png',
				'title'	=> __('Insert Local SEO Shortcodes', $psp->localizationName)
			)
		)
	)
 );