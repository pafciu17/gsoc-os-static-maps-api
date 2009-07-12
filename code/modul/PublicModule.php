<?php
class PublicModule extends Module 
{
	public function execute()
	{
		$this->_displayTerms();
	}
	
	private function _displayTerms()
	{
		$this->_view->addCss('public.css');
		$this->_view->display('terms.tpl');
	}
}
?>