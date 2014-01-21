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

		'frontend' => array(

			'version' => '1.0',

			'menu' => array(
				'show_in_menu' => false,

				'order' => 1,

				'title' => __('Frontend', $psp->localizationName)

				,'icon' => 'assets/menu_icon.png'

			),

			'desciption' => __("Core Modules, can't be deactivated!", $psp->localizationName),
			
			'module_init' => 'init.php'

		)

	)

 );