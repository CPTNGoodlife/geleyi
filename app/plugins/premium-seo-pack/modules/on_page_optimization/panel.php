<?php
/*
* Define class pspW3C_HTMLValidator
* Make sure you skip down to the end of this file, as there are a few
* lines of code that are very important.
*/
! defined( 'ABSPATH' ) and exit;

// load the modules managers class
$module_class_path = $module['folder_path'] . 'app.class.php';
if(is_file($module_class_path)) {

	require_once( 'app.class.php' );

	// Initalize the your aaModulesManger
	$pspW3C_HTMLValidator = new pspW3C_HTMLValidator($this->cfg, $module);

	// print the lists interface
	echo $pspW3C_HTMLValidator->printSearchInterface();
}