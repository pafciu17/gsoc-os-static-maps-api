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
		'database_host' => '',
		'database_name' => '',
		'database_username' => '',
		'database_password' => '',
		'database_type' => 'Mysql', // possible values dependent on databases which are supported by Zend clases
		'logo_layout' => 'logo_left_down_corner',
		'scale_bar_layout' => 'left_up_corner',
		'logo_files' => array('./media/osm_logo_cc.png', './media/osm_small_logo_cc.png'),
		'wrong_map_request_file' => './media/osm_wrong_map_request.png',
		'tile_cache_days_of_memory' => 7,
		'tile_cache_number_of_files_to_delete' => 10,
		'max_number_of_tiles_per_map' => 30,
		'pattern_point_image_map' => array('sight' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/sight_point.png',
		'cursor' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/cursor.png',
		'redA' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/redA.png',
	    'redB' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/redB.png',
	    'redC' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/redC.png',
		'redD' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/redD.png',
		'redE' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/redE.png',
		'redF' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/redF.png',
		'redG' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/redG.png',
		'redH' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/redH.png',
		'redI' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/redI.png',
		'redJ' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/redJ.png',
		'redK' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/redK.png',
		'redL' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/redL.png',
		'redM' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/redM.png',
		'redN' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/redN.png',
		'redO' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/redO.png',
		'redP' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/redP.png',
		'redQ' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/redQ.png',
		'redR' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/redR.png',
		'redS' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/redS.png',
		'redT' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/redT.png',
		'redU' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/redU.png',
		'redV' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/redA.png',
		'redW' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/redW.png',
		'redX' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/redX.png',
		'redY' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/redY.png',
		'redZ' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/redZ.png',
		'red1' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/red1.png',
		'red2' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/red2.png',
		'red3' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/red3.png',
		'red4' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/red4.png',
		'red5' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/red5.png',
		'red6' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/red6.png',
		'red7' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/red7.png',
		'red8' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/red8.png',
		'red9' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/red9.png',
		'red0' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/red0.png',
	
		'greenA' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/greenA.png',
	    'greenB' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/greenB.png',
	    'greenC' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/greenC.png',
		'greenD' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/greenD.png',
		'greenE' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/greenE.png',
		'greenF' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/greenF.png',
		'greenG' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/greenG.png',
		'greenH' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/greenH.png',
		'greenI' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/greenI.png',
		'greenJ' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/greenJ.png',
		'greenK' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/greenK.png',
		'greenL' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/greenL.png',
		'greenM' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/greenM.png',
		'greenN' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/greenN.png',
		'greenO' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/greenO.png',
		'greenP' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/greenP.png',
		'greenQ' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/greenQ.png',
		'greenR' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/greenR.png',
		'greenS' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/greenS.png',
		'greenT' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/greenT.png',
		'greenU' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/greenU.png',
		'greenV' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/greenA.png',
		'greenW' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/greenW.png',
		'greenX' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/greenX.png',
		'greenY' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/greenY.png',
		'greenZ' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/greenZ.png',
		'green1' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/green1.png',
		'green2' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/green2.png',
		'green3' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/green3.png',
		'green4' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/green4.png',
		'green5' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/green5.png',
		'green6' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/green6.png',
		'green7' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/green7.png',
		'green8' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/green8.png',
		'green9' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/green9.png',
		'green0' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/green0.png',
	
		'blueA' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blueA.png',
	    'blueB' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blueB.png',
	    'blueC' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blueC.png',
		'blueD' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blueD.png',
		'blueE' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blueE.png',
		'blueF' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blueF.png',
		'blueG' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blueG.png',
		'blueH' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blueH.png',
		'blueI' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blueI.png',
		'blueJ' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blueJ.png',
		'blueK' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blueK.png',
		'blueL' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blueL.png',
		'blueM' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blueM.png',
		'blueN' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blueN.png',
		'blueO' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blueO.png',
		'blueP' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blueP.png',
		'blueQ' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blueQ.png',
		'blueR' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blueR.png',
		'blueS' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blueS.png',
		'blueT' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blueT.png',
		'blueU' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blueU.png',
		'blueV' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blueA.png',
		'blueW' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blueW.png',
		'blueX' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blueX.png',
		'blueY' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blueY.png',
		'blueZ' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blueZ.png',
		'blue1' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blue1.png',
		'blue2' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blue2.png',
		'blue3' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blue3.png',
		'blue4' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blue4.png',
		'blue5' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blue5.png',
		'blue6' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blue6.png',
		'blue7' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blue7.png',
		'blue8' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blue8.png',
		'blue9' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blue9.png',
		'blue0' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blue0.png',
	
		'red' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/red.png',
		'blue' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/blue.png',
		'green' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/green.png',
		'yellow' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/yellow.png',
		'black' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/black.png',
		'white' => 'http://pafciu17.dev.openstreetmap.org/media/pointer/white.png',
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
