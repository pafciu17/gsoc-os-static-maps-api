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
	 * paths to dir which contains css files
	 *
	 * @var string
	 */
	protected $_cssDir;
	
	/**
	 * array of paths to css files
	 *
	 * @var array
	 */
	protected $_cssFiles = array();
	
	/**
	 * consturctor
	 *
	 * @param Conf $conf
	 */
	public function __construct($conf)
	{
		$this->_conf = $conf; 
		$this->_cssDir = $conf->get('css_dir');
		$this->_info = new Zend_Session_Namespace('View_Info');
	}
	
	/**
	 * add css file
	 *
	 * @param string $fileName
	 */
	public function addCss($fileName)
	{
		$this->_cssFiles[] = $this->_cssDir . '/' . $fileName;
	}
	
	public function addInfo($info)
	{
		$inf = $this->_info->info;
		if (is_null($inf) || !is_array($info)) {
			$inf = array();
		}
		$inf[] = $info;
		$this->_info->info = $inf;
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
	public function display($tpl)
	{
		$this->_view->assign('css_files', $this->_cssFiles);
		$this->_view->assign('info', $this->_info->info);
		$this->_info->info = array();
	}
	
}