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
		'default_drawings_color' => array('r' => 0, 'g' => 0, 'b' => 255), 
		'default_path_thickness' => 1,
		'default_drawings_transparency' => 0,
		'database_host' => 'www.bialowieza1.home.pl',
		'database_name' => 'bialowieza6',
		'database_username' => 'bialowieza6',
		'database_password' => 'test',
		'database_type' => 'Mysql', // possible values dependent on databases which are supported by Zend clases
		'logo_layout' => 'logo_left_down_corner',
		'scale_bar_layout' => 'left_up_corner',
		'logo_files' => array('./media/osm_logo_cc.png', './media/osm_small_logo_cc.png'),
		'wrong_map_request_file' => './media/osm_wrong_map_request.png',
		'tile_cache_days_of_memory' => 7,
		'tile_cache_number_of_files_to_delete' => 10,
		'max_number_of_tiles_per_map' => 30,
		'pattern_point_image_map' => array('sight' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/sight_point.png',
		'cursor' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/cursor.png',
		'redA' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/redA.png',
	    'redB' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/redB.png',
	    'redC' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/redC.png',
		'redD' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/redD.png',
		'redE' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/redE.png',
		'redF' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/redF.png',
		'redG' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/redG.png',
		'redH' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/redH.png',
		'redI' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/redI.png',
		'redJ' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/redJ.png',
		'redK' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/redK.png',
		'redL' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/redL.png',
		'redM' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/redM.png',
		'redN' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/redN.png',
		'redO' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/redO.png',
		'redP' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/redP.png',
		'redQ' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/redQ.png',
		'redR' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/redR.png',
		'redS' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/redS.png',
		'redT' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/redT.png',
		'redU' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/redU.png',
		'redV' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/redA.png',
		'redW' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/redW.png',
		'redX' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/redX.png',
		'redY' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/redY.png',
		'redZ' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/redZ.png',
		'red1' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/red1.png',
		'red2' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/red2.png',
		'red3' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/red3.png',
		'red4' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/red4.png',
		'red5' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/red5.png',
		'red6' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/red6.png',
		'red7' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/red7.png',
		'red8' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/red8.png',
		'red9' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/red9.png',
		'red0' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/red0.png',
		)
							
	);
	
	/**
	 * map of action and modules of application
	 *
	 * @var array
	 */
	private $_appMap = array('home' => array('name' => 'PublicModule'),
		'map' => array('name' => 'MapModule'),
		'admin' => array('name' => 'AdminModule', 
			'servers' => 'ModuleActionServers',
			'server' => 'ModuleActionEditServer',
			'addNewServer' => 'ModuleActionAddNewServer',
			'pass' => 'ModuleActionChangePassword',
			'logout' => 'ModuleActionAdminLogout',
			'login' => 'ModuleActionAdminLogin'));
	
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
