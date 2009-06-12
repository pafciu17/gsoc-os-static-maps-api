<?php
/**
 * base class for modules
 *
 */
abstract class Module 
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
	
	public function __construct(Get $get, Post $post, Conf $conf, ViewHandler $view)
	{
		$this->_get = $get;
		$this->_post = $post;
		$this->_conf = $conf;
		$this->_view = $view;
	}
	
	abstract function execute();
	
}