<?php
/**
 * main controller for app
 *
 */
class MainController 
{

	/**
	 * access point to POST and GET data
	 *
	 * @var GetPostHandler
	 */
	private $_getPostHandler;

	/**
	 * configuaration data
	 *
	 * @var Conf
	 */
	private $_conf;
	
	/**
	 * contructor for the object
	 *
	 * @param GetPostHandler $gp
	 * @param Conf $conf
	 */
	public function __constructor($gp, $conf)
	{
		$this->_getPostHandler = $gp;
		$this->_conf = $conf;
	}
	
	public function _execute()
	{
		//$this->_executeModule()
	}
}
