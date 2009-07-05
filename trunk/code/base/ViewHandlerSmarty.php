<?php
/**
 * it provides default interface for classes which maintain views
 *
 */
class ViewHandlerSmarty extends ViewHandler 
{
	
	/**
	 * smarty object
	 *
	 * @var Smarty
	 */
	protected $_view;
	
	/**
	 * consturctor
	 *
	 * @param Conf $conf
	 */
	public function __construct($conf)
	{
		parent::__construct($conf);
		$this->_view = new Smarty();
		$this->_view->template_dir = $this->_conf->get('template_dir');
		$this->_view->compile_dir  = $this->_conf->get('template_c_dir');
	}
	
	/**
	 * assign value to variable, it will be used in view
	 *
	 * @param string $name
	 * @param unknown_type $value
	 */
	public function assign($name, $value)
	{
		$this->_view->assign($name, $value);
	}
	
	/**
	 * display view which will be build on template
	 *
	 * @param string $tpl template 
	 */
	public function display($tpl)
	{
		parent::display($tpl);
		$this->_view->display($tpl);	
	}
	
}