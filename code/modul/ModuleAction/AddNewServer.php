<?php
/**
 * class implements action fo adding new server to database
 *
 */
class ModuleActionAddNewServer extends ModuleAction
{

	public function execute()
	{
		if (!is_null($this->_post->send)) {
			$server = new DatabaseServer();
			$server->loadDataFromPost($this->_post);
			$server->url = $this->_post->getRawData('url');
			try {
				$server->save();
				$this->_view->addInfo('Server has been added');
				$this->_redirect->toModuleAction('AdminModule', 'ModuleActionServers');
				die;
			} catch(ValidatorException $e) {
				$this->_view->assign('errors', $server->getErrors());
				$this->_view->assign('server', $server);
			}
		}
		$this->_view->assign('formHeader', 'Adding new server');
		$this->_view->assign('content_file', 'serverForm.tpl');
	}

}