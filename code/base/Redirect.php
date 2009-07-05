<?php

class Redirect
{

	/**
	 * conf object
	 *
	 * @var Conf
	 */
	protected $_conf;
	
	/**
	 * application url map
	 *
	 * @var AppMap
	 */
	protected $_appMap;
	
	public function __construct(AppMap $appMap, Conf $conf)
	{
		$this->_appMap = $appMap;
		$this->_conf = $conf;
	}
	
	private function _getUrlToModule($moduleName)
	{
		$url = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $_SERVER['SCRIPT_NAME'] . '?' .
		$this->_conf->get('module_url_variable_name') . '=' . $this->_appMap->getModuleUrlName($moduleName);
		return $url;
	}
	
	public function toModule($moduleName) {
		header('Location: ' . $this->_getUrlToModule($moduleName));
	}
	
	public function toModuleAction($moduleName, $actionName)
	{
		header('Location: ' . $this->_getUrlToModule($moduleName) . '&' . $this->_conf->get('action_url_variable_name') . '=' .
		$actionName);
	}
	
}