<?php
/**
 * base class for modules
 *
 */
abstract class Module 
{

	/**
	 * data of module
	 *
	 * @var array
	 */
	protected $_moduleData = array();
	
	/**
	 * GET data
	 *
	 * @var Get
	 */
	protected $_get;
	
	/**
	 * POST data
	 *
	 * @var Post
	 */
	protected $_post;
	
	/**
	 * configuration data
	 *
	 * @var Conf
	 */
	protected $_conf;
	
	/**
	 * view handler
	 *
	 * @var ViewHandler
	 */
	protected $_view;
	
	/**
	 * map of application
	 * 
	 * @var AppMap
	 */
	protected $_appMap;
	
	/**
	 * it handles all redirects into the module
	 *
	 * @var Redirect
	 */
	protected $_redirect;
	
	/**
	 * session data
	 *
	 * @var all session data
	 */
	protected $_session;
		
	public function __construct(Get $get, Post $post, Conf $conf, ViewHandler $view, AppMap $appMap)
	{
		$this->_get = $get;
		$this->_post = $post;
		$this->_conf = $conf;
		$this->_view = $view;
		$this->_appMap = $appMap;
		$this->_session = new Zend_Session_Namespace('Main');
		$this->_moduleData['module_name'] = get_class($this);
		$this->_moduleData['module_url_name'] = $this->_appMap->getModuleUrlName(get_class($this));
		$this->_view->assign('module_data', $this->_moduleData);
		$this->_view->assign('appMap', $this->_appMap);
	}
	
	public function execute()
	{
		$actionUrlName = $this->_conf->get('action_url_variable_name');
		$action = $this->_getAction($this->_get->$actionUrlName);
		$action->execute();
	}
	
	/**
	 * return an appropriate action
	 *
	 * @param string $actionName - action name
	 * @return ModuleAction
	 */
	protected function _getAction($actionName)
	{
		$actionClassName = $this->_appMap->getModuleActionFromActionUrlName($this->_moduleData['module_name'], $actionName);
		return new $actionClassName($this->_get, $this->_post, $this->_conf, $this->_view, $this->_appMap, $this->_session);
	}
	
}