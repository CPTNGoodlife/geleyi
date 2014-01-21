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
		'rich_snippets' => array(
			'version' => '1.0',
			'menu' => array(
				'order' => 23,
				'title' => __('Rich Snippets', $psp->localizationName)
				,'icon' => 'assets/menu_icon.png'
			),
			'desciption' => __('Rich Snippets - Schema.org', $psp->localizationName),
			'module_init' => 'init.php',
			
			'shortcodes_btn' => array(
				'icon' 	=> 'assets/20-icon.png',
				'title'	=> __('Insert Rich Snippets Shortcodes', $psp->localizationName)
			)
		)
	)
 );