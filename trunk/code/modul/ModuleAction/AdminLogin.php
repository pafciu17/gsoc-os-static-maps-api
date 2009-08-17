<?php
/**
 * login action
 *
 */
class ModuleActionAdminLogin extends ModuleAction
{

	public function execute()
	{
		if (!is_null($this->_post->send)) {
			$user = new User();
			if ($user->login($this->_post->login, $this->_post->password)) {
				$this->_session->user = $user;
				$this->_view->addInfo('You have been logged in');
				$this->_redirect->toModuleAction('AdminModule', 'ModuleActionServers');
				die;
			} else {
				$this->_view->assign('login', $this->_post->login);
				$this->_view->assign('errors', array('Wrong login or password'));
			}
		}
		$this->_view->assign('content_file', 'loginForm.tpl');
		$this->_view->assign('menu_file', null);
	}

}
