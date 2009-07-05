<?php

class ModuleActionServers extends ModuleAction 
{
	
	public function execute()
	{
		$servers = DatabaseCollectionManager::getServers();
		$this->_view->assign('servers', $servers);
		$this->_view->assign('content_file', 'servers.tpl');
	}
	
}