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
		'title_meta_format' => array(
			'version' => '1.0',
			'menu' => array(
				'order' => 10,
				'title' => __('Title & Meta Format', $psp->localizationName)
				,'icon' => 'assets/menu_icon.png'
			),
			'in_dashboard' => array(
				'icon' 	=> 'assets/32.png',
				'url'	=> admin_url("admin.php?page=psp#title_meta_format")
			),
			'desciption' => "Using this module you can set custom page titles, meta descriptions, meta keywords, meta robots and social meta using defined format tags for Homepage, Posts, Pages, Categories, Tags, Custom Taxonomies, Archives, Authors, Search, 404 Pages and Pagination.",
			'module_init' => 'init.php'
		)
	)
 );