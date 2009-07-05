<?php
/**
 * this class represents tile server
 *
 */
class DatabaseUser extends DatabaseObject
{
	/**
	 * tabel name
	 *
	 * @param string $id
	 */
	protected $_tableName = 'User';

	/**
	 * array of object field names
	 */
	protected $_fields = array('id', 'login', 'password');
	
	
	public static function getUser($login)
	{
		self::setUpConnection();
		$select = self::$db->select();
		$sampleUser = new DatabaseUser();
		if (!is_null($login)) {
			$data = $select->From($sampleUser->getTableName())->Where('login = ?', $login)->query()->fetch();
			if ($data) {
				$user = new DatabaseUser();
				$user->setData($data);
				return $user;
			}
		}
	}

}