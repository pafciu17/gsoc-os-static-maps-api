<?php
/**
 * it provides default interface for classes which maintain views
 *
 */
abstract class ViewHandler
{
	
	/**
	 * conf object
	 *
	 * @var Conf
	 */
	protected $_conf;
	
	/**
	 * consturctor
	 *
	 * @param Conf $conf
	 */
	public function __construct($conf)
	{
		$this->_conf = $conf; 
	}
	
	/**
	 * assign value to variable, it will be used in view
	 *
	 * @param string $name
	 * @param unknown_type $value
	 */
	abstract public function assign($name, $value);
	
	/**
	 * display view which will be build on template
	 *
	 * @param string $tpl template 
	 */
	abstract public function display($tpl);
	
}