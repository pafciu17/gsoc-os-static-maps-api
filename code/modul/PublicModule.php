<?php
class PublicModule extends Module 
{
	public function execute()
	{
		$this->_displayTerms();
	}
	
	private function _displayTerms()
	{
		$this->_view->display('terms.tpl');
	}
}
?>