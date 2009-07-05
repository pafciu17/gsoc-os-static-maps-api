<?php

class AdminModule extends Module 
{

	public function execute()
	{
		$this->_view->assign('menu_file', 'menu.tpl');
		parent::execute();
		$this->_view->display('admin.tpl');
	}
	
	/**
	 * return an appropriate action
	 *
	 * @param string $actionName - action name
	 * @return ModuleAction
	 */
	protected function _getAction($actionName)
	{
		
		if (is_null($this->_session->user) || !$this->_session->user->isLogged()) {
			return new ModuleActionAdminLogin($this->_get, $this->_post, $this->_conf, $this->_view, $this->_appMap, $this->_session);
		}
		return parent::_getAction($actionName);
	}
	
}
