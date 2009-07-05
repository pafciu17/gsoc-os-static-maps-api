<?php
abstract class DatabaseCollectionManager extends Database 
{
	
	/**
	 * it loads data about all servers, and return array of them
	 *
	 * @return array array of DatabaseServers
	 */
	public static function getServers()
	{
		self::setUpConnection();
		$select = self::$db->select();
		$databaseServer = new DatabaseServer();
		$data = $select->From($databaseServer->getTableName())->query()->fetchAll();
		$servers = array();
		foreach ($data as $row) {
			$server = new DatabaseServer();
			$server->setData($row);
			$servers[] = $server;
		}
		return $servers;
	}
	
}