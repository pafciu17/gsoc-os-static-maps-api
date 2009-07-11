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
	private $_conf = array(
		'module_url_variable_name' => 'module',
		'action_url_variable_name' => 'page',
		'template_dir' => './tpl',
		'template_c_dir' => './tpl_c',
		'css_dir' => './style',
		'default_drawnings_color' => array('r' => 0, 'g' => 0, 'b' => 255),
		'database_host' => 'www.bialowieza1.home.pl',
		'database_name' => 'bialowieza6',
		'database_username' => 'bialowieza6',
		'database_password' => 'test',
		'database_type' => 'Mysql',
		'logo_layout' => 'logo_left_down_corner',
		'logo_file' => './media/small_osm_logo_and_text.png',
		'wrong_map_request_file' => './media/osm_wrong_map_request.png',
		'tile_cache_days_of_memory' => 7,
		'tile_cache_number_of_files_to_delete' => 10);
	
	private $_appMap = array('home' => array('name' => 'PublicModule'),
		'map' => array('name' => 'MapModule'),
		'admin' => array('name' => 'AdminModule', 
			'servers' => 'ModuleActionServers',
			'server' => 'ModuleActionEditServer',
			'addNewServer' => 'ModuleActionAddNewServer',
			'logout' => 'ModuleActionAdminLogout'));
	
	/**
	 * return conf option
	 */
	public function get($key) {
		return $this->_conf[$key];
	}
	
	/**
	 * return an array which maps url variables to modules and actions
	 *
	 * @return array
	 */
	public function getMap()
	{
		return $this->_appMap;
	}
}
