<?php
/**
 * this class represents tile server
 *
 */
class DatabaseServer extends DatabaseObject
{
	/**
	 * tabel name
	 *
	 * @param string $id
	 */
	protected $_tableName = 'TileServer';

	/**
	 * array of object field names
	 */
	protected $_fields = array('id', 'url', 'urlName', 'name', 'cacheSize', 'tileHeight', 'tileWidth',
	'minZoom', 'maxZoom');

	public function __construct($id = null)
	{
		parent::__construct($id);
		$this->_validator = new ValidatorDatabaseServer();
	}
	
	/**
	 * method bases on url server name and creates appropriate server object
	 *
	 * @param string $urlName
	 * @return DatabaseServer
	 */
	static public function getServer($urlName)
	{
		self::setUpConnection();
		$sampleServer = new DatabaseServer();
		if (!is_null($urlName)) {
			$select = self::$db->select();
			$data = $select->From($sampleServer->getTableName())->Where('urlName = ?', $urlName)->query()->fetch();
			if ($data) {
				$server = new DatabaseServer();
				$server->setData($data);
				return $server;
			}
		}
		//return default server
		$select = self::$db->select();
		$data = $select->From($sampleServer->getTableName())->query()->fetch();
		$server = new DatabaseServer();
		$server->setData($data);
		return $server;
	}

	public function getServerUrl()
	{
		return new ServerUrl($this->url);
	}
	
}