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
		'seo_friendly_images' => array(
			'version' => '1.0',
			'menu' => array(
				'order' => 12,
				'title' => __('SEO Friendly Images', $psp->localizationName)
				,'icon' => 'assets/menu_icon.png'
			),
			'in_dashboard' => array(
				'icon' 	=> 'assets/32.png',
				'url'	=> admin_url("admin.php?page=psp#seo_friendly_images")
			),
			'desciption' => __("How does it work? This module will automatically update all images with proper ALT and Title Attributes. If they don’t have ALT setup, the SEO Friendly Images will add them according to the options you set. ", $psp->localizationName),
			'module_init' => 'init.php'
		)
	)
 );