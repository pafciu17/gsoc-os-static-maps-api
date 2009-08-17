<?php
/**
 * it implements action of displaying the list of servers
 *
 */
class ModuleActionServers extends ModuleAction 
{
	
	public function execute()
	{
		$servers = DatabaseCollectionManager::getServers();
		$serverIdToDelete = $this->_get->delId;
		if ($serverIdToDelete != null) {
			$this->_deleteServer($servers, $serverIdToDelete);
		}
		$this->_view->assign('servers', $servers);
		$this->_view->assign('content_file', 'servers.tpl');
	}
	
	private function _deleteServer(& $servers, $serverId) {
		foreach ($servers as $key => $server) {
			if ($server->id == $serverId) {
				$server->delete();
				unset($servers[$key]);
				$this->_view->addInfo('Server has been deleted');
			}
		}
	}
}