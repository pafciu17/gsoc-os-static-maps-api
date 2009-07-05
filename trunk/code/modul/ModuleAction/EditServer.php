<?php

class ModuleActionEditServer extends ModuleAction 
{
	
	public function execute()
	{
		$server = new DatabaseServer($this->_get->id);
		$this->_view->assign('server', $server);
		if (!is_null($this->_post->send)) {
			$server->loadDataFromPost($this->_post);
			$server->url = $this->_post->getRawData('url');
			try {
				$server->save();
				$this->_view->addInfo('Server has been saved');
				$this->_redirect->toModuleAction('AdminModule', 'ModuleActionServers');
				die;
			} catch(ValidatorException $e) {
				$this->_view->assign('errors', $server->getErrors());
				$this->_view->assign('server', $server);
			}
		}
		$this->_view->assign('formHeader', 'Edit server');
		$this->_view->assign('content_file', 'serverForm.tpl');
	}
	
}