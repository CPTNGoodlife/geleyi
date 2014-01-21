<?php
/**
 * module return as json_encode
 * http://www.aa-team.com
 * =======================
 *
 * @author		Andrei Dinca, AA-Team
 * @version		1.0
 */
global $psp;
echo json_encode(
	array(
		$tryed_module['db_alias'] => array(
			/* define the form_messages box */
			'social' => array(
				'title' 	=> __('Social Services', $psp->localizationName),
				'icon' 		=> '{plugin_folder_uri}assets/menu_icon.png',
				'size' 		=> 'grid_4', // grid_1|grid_2|grid_3|grid_4
				'header' 	=> true, // true|false
				'toggler' 	=> false, // true|false
				'buttons' 	=> true, // true|false
				'style' 	=> 'panel', // panel|panel-widget

				// create the box elements array
				'elements'	=> array(
					'services' 	=> array(
						'type' 		=> 'multiselect',
						'std' 		=> array('facebook', 'twitter', 'google', 'stumbleupon', 'digg', 'linkedin'),
						'size' 		=> 'small',
						'force_width'=> '250',
						'title' 	=> __('Check on:', $psp->localizationName),
						'desc' 		=> __('Show status on this social services.', $psp->localizationName),
						'options' 	=> array(
							'facebook' 		=> 'Facebook',
							'pinterest' 	=> 'Pinterest',
							'twitter' 		=> 'Twitter',
							'google' 		=> 'Google +1',
							'stumbleupon' 	=> 'Stumbleupon',
							'digg' 			=> 'Digg',
							'linkedin' 		=> 'LinkedIn'
						)
					)
					
				)
			)
		)
	)
);