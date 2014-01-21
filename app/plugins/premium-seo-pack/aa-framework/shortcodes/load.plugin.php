<?php

// Derive the current path and load up psp
$plugin_path = dirname(__FILE__) . '/';
if(class_exists('psp') != true) {
    require_once('../freamwork.class.php');

	// Initalize the your plugin
	$psp = new psp();
}