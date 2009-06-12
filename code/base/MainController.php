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
	
	public function __construct(Get $get, Post $post, Conf $conf)
	{
		$this->_get = $get;
		$this->_post = $post;
		$this->_conf = $conf;
		// creates smarty handle for view
		$this->_view = new ViewHandlerSmarty($conf);
		//$this->_view->display('test.tpl');
	}
	
	public function execute()
	{
		$module = $this->_getProperModule();
		$module->execute();
	}
	
	private function _getProperModule()
	{
		$moduleMap = $this->_conf->get('modules');
		$moduleUrlKeyName = $this->_conf->get('module_url_name');
		$moduleUrlName = $this->_get->__get($moduleUrlKeyName);
		if (array_key_exists($moduleUrlName, $moduleMap)) {
			return new $moduleMap[$moduleUrlName]($this->_get, $this->_post, $this->_conf, $this->_view);
		}
		throw new ControllerException('No module has been choosen for execution');
	}
}
