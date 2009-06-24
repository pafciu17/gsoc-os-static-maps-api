<?php

//all errors will be report

error_reporting(E_ALL | E_STRICT);
set_time_limit(90);
session_start();

//include path indicates on lib directory
set_include_path('./lib');

//include Zend loader
include_once('Zend/Loader.php');
//including smarty
include_once('Smarty/Smarty.class.php');
//include my loader
include_once('./code/base/MyLoader.php');

/*
function loadCodeClass($nazwa) 
{
	if (file_exists('./code/base/'.$nazwa.'.php')) {
		include_once('./code/base/'.$nazwa.'.php');
	} else if (file_exists('./code/modul/'.$nazwa.'.php')) {
		include_once('./code/modul/'.$nazwa.'.php');
	} else if (file_exists('./code/class/'.$nazwa.'.php')) {
		include_once('./code/class/'.$nazwa.'.php');
	} else {
		return false;
	}
	return true;
}
*/

//set autload function
function __autoload($name) 
{
	$loader = new MyLoader();
	$loader->addSource(array('./code/base', './code/modul', './code/class'));
	if ($loader->loadClass($name)) {
	} else {
		Zend_Loader::loadClass($name,'./libs');
	}
}

//creates configuration file
$conf = new Conf();
//creates handlers for data send by POST and GET
$get = new Get($_GET);
$post = new Post($_POST);
//creates main controller
$controller = new MainController($get, $post, $conf);
//execute controller
$controller->execute();