<?php
/**
 * class contains application configuration data
 *
 */
class Conf 
{
	/**
	 * configuration options
	 *
	 * @var array
	 */
	private $_conf = array('modules' => array(array('map' => 'ModuleMap')),
		'module_key' => 'module',
		'templates' => '',
		'templates_c' => '');
	
	/**
	 * return conf option
	 */
	public function get($key) {
		return $this->_conf[$key];
	}
}
