<?php
error_reporting(E_ALL);
session_start();
//set loader for zend classes
include_once('./libs/Zend/Loader.php');
set_include_path('./libs');
//set autload function
function __autoload($nazwa) {
	if (file_exists('./class/'.$nazwa.'.php')) {
		include_once('./class/'.$nazwa.'.php');
	} else {
		Zend_Loader::loadClass($nazwa,'./libs');
	}
}
//creates configuration file
$conf = new Conf();
//creates main controller
$controller = new MainController($_GET, $_POST, $conf);
//execute controller
$controller->execute();