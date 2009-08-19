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
	
		'greenA' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/greenA.png',
	    'greenB' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/greenB.png',
	    'greenC' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/greenC.png',
		'greenD' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/greenD.png',
		'greenE' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/greenE.png',
		'greenF' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/greenF.png',
		'greenG' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/greenG.png',
		'greenH' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/greenH.png',
		'greenI' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/greenI.png',
		'greenJ' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/greenJ.png',
		'greenK' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/greenK.png',
		'greenL' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/greenL.png',
		'greenM' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/greenM.png',
		'greenN' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/greenN.png',
		'greenO' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/greenO.png',
		'greenP' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/greenP.png',
		'greenQ' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/greenQ.png',
		'greenR' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/greenR.png',
		'greenS' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/greenS.png',
		'greenT' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/greenT.png',
		'greenU' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/greenU.png',
		'greenV' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/greenA.png',
		'greenW' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/greenW.png',
		'greenX' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/greenX.png',
		'greenY' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/greenY.png',
		'greenZ' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/greenZ.png',
		'green1' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/green1.png',
		'green2' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/green2.png',
		'green3' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/green3.png',
		'green4' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/green4.png',
		'green5' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/green5.png',
		'green6' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/green6.png',
		'green7' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/green7.png',
		'green8' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/green8.png',
		'green9' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/green9.png',
		'green0' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/green0.png',
	
		'blueA' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blueA.png',
	    'blueB' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blueB.png',
	    'blueC' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blueC.png',
		'blueD' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blueD.png',
		'blueE' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blueE.png',
		'blueF' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blueF.png',
		'blueG' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blueG.png',
		'blueH' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blueH.png',
		'blueI' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blueI.png',
		'blueJ' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blueJ.png',
		'blueK' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blueK.png',
		'blueL' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blueL.png',
		'blueM' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blueM.png',
		'blueN' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blueN.png',
		'blueO' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blueO.png',
		'blueP' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blueP.png',
		'blueQ' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blueQ.png',
		'blueR' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blueR.png',
		'blueS' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blueS.png',
		'blueT' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blueT.png',
		'blueU' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blueU.png',
		'blueV' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blueA.png',
		'blueW' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blueW.png',
		'blueX' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blueX.png',
		'blueY' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blueY.png',
		'blueZ' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blueZ.png',
		'blue1' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blue1.png',
		'blue2' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blue2.png',
		'blue3' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blue3.png',
		'blue4' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blue4.png',
		'blue5' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blue5.png',
		'blue6' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blue6.png',
		'blue7' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blue7.png',
		'blue8' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blue8.png',
		'blue9' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blue9.png',
		'blue0' => 'http://dev.openstreetmap.org/~pafciu17/media/pointer/blue0.png',
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
