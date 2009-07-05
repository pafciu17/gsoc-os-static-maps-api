<?php
class AppMapException extends Exception 
{
}

class AppMap
{
	/**
	 * map of modules and actions
	 *
	 * @var 
	 */
	private $_map;
	
	public function __construct($map)
	{
		$this->_map = $map;
	}
	
	public function getModuleNameFromUrlName($urlName)
	{
		if (array_key_exists($urlName, $this->_map)) {
			return $this->_map[$urlName]['name'];
		}
	}
	
	public function getModuleUrlName($moduleName)
	{
		foreach ($this->_map as $urlName => $module) {
			if ($module['name'] == $moduleName) {
				return $urlName;
			}
		}
		throw new AppMapException('Request for unkown module1');
	}
					
	public function getModuleActionUrlName($moduleName, $actionName)
	{
		$moduleMap = $this->_getModuleMap($moduleName);
		foreach ($moduleMap as $key => $action) {
			if ($action == $actionName) {
				return $key;
			}
		}
		throw new AppMapException('Request for unkown action');
	}
	
	public function getModuleActionFromActionUrlName($moduleName, $urlActionName)
	{
		$moduleMap = $this->_getModuleMap($moduleName);
		if (array_key_exists($urlActionName, $moduleMap)) {
			return $moduleMap[$urlActionName];
		}
		//return default action(first action from the array map)
		foreach ($moduleMap as $key => $value) {
			if ($key != 'name') {
				return $value;
			}
		}
	}
	
	
	
	private function _getModuleMap($moduleName)
	{
		foreach ($this->_map as $moduleMap) {
			if ($moduleMap['name'] == $moduleName) {
				return $moduleMap;
			}
		}
		throw new AppMapException('Request for unkown module2');
	}
	
}