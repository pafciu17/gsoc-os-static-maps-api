<?php

class ControllerException extends Exception {}

/**
 * main controller for app
 *
 */
class MainController 
{

	/**
	 * GET data
	 *
	 * @var Get
	 */
	private $_get;
	
	/**
	 * POST data
	 *
	 * @var Post
	 */
	private $_post;

	/**
	 * configuaration data
	 *
	 * @var Conf
	 */
	private $_conf;
	
	/**
	 * view object
	 *
	 * @var ViewHandler
	 */
	private $_view;
	
	/**
	 * map of application
	 * 
	 * @var AppMap
	 */
	private $_appMap;
	
	public function __construct(Get $get, Post $post, Conf $conf)
	{
		$this->_get = $get;
		$this->_post = $post;
		$this->_conf = $conf;
		$this->_handleDb();
		$this->_appMap = new AppMap($this->_conf->getMap());
		// creates smarty handle for view
		$this->_view = new ViewHandlerSmarty($this->_conf);
		$this->_view->assign('conf', $this->_conf);
		//$this->_view->display('test.tpl');
	}
	
	private function _handleDb()
	{
		Database::$dbType = $this->_conf->get('database_type');
		Database::$dbHost = $this->_conf->get('database_host');
		Database::$dbName = $this->_conf->get('database_name');
		Database::$dbUsername = $this->_conf->get('database_username');
		Database::$dbPassword = $this->_conf->get('database_password');
	}
	
	public function execute()
	{
		$this->_view->addCss('global.css');
		$module = $this->_getProperModule();
		$module->execute();
	}
	
	private function _getProperModule()
	{
		$key = $this->_conf->get('module_url_variable_name');
		$moduleUrlName = $this->_get->$key;
		$moduleName = $this->_appMap->getModuleNameFromUrlName($moduleUrlName);
		if (!is_null($moduleName)) {
			return new $moduleName($this->_get, $this->_post, $this->_conf, $this->_view, $this->_appMap);
		}
		throw new ControllerException('No module has been choosen for execution');
	}
}
