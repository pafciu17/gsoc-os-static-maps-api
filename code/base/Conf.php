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
	private $_conf = array('modules' => array('map' => 'MapModule',
		'home' => 'PublicModule',
		'admin' => 'AdminModule'),
		'module_url_name' => 'module',
		'template_dir' => './tpl',
		'template_c_dir' => './tpl_c',
		'default_drawnings_color' => array('r' => 0, 'g' => 0, 'b' => 255));
	
	/**
	 * return conf option
	 */
	public function get($key) {
		return $this->_conf[$key];
	}
}
