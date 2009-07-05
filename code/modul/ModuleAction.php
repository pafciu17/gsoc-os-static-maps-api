<?php
abstract class ModuleAction
{
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
	
	public function __construct(Get $get, Post $post, Conf $conf, ViewHandler $view, AppMap $appMap, Zend_Session_Namespace $session)
	{
		$this->_get = $get;
		$this->_post = $post;
		$this->_conf = $conf;
		$this->_view = $view;
		$this->_appMap = $appMap;
		$this->_session = $session;
		$this->_redirect = new Redirect($this->_appMap, $this->_conf);
	}

	/**
	 * it execute main action which is represented by this class
	 *
	 */
	abstract public function execute();
}
