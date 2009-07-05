<?php

class ModuleActionAdminLogout extends ModuleAction
{

	public function execute()
	{
		if (!is_null($this->_session->user)) {
			$this->_session->user->logout();
			$this->_view->addInfo('You have been logged out');
		}
		$this->_redirect->toModuleAction('AdminModule');
		die;
	}

}
