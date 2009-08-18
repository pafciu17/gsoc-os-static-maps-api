<?php
/**
 * it implements action of changing the admin password
 *
 */
class ModuleActionChangePassword extends ModuleAction 
{
	
	public function execute()
	{
		if (!is_null($this->_post->send)) {
			if ($this->_post->password == $this->_post->confirmPassword && 
			$this->_session->user->checkPassword($this->_post->oldPassword)) {
				if (strlen($this->_post->password) < 4) {
					$this->_view->assign('errors', array('Password has to have more than 3 characters'));
				} else {
					$this->_session->user->changePassword($this->_post->password);	
					$this->_view->addInfo('Password has been changed');
					$this->_redirect->toModuleAction('AdminModule', 'ModuleActionServers');		
				}
			} else {
				$this->_view->assign('errors', array('Wrong old password or confirm password given'));
			}
		}
		$this->_view->assign('content_file', 'passwordForm.tpl');
	}

}