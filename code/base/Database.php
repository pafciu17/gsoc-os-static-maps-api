<?php
class BaseException extends Exception{}

/**
 * base class for clases which use database
 *
 */
abstract class Database 
{
	
	/**
	 * 
	 * 
	 * @var Zend_Db
	 */
	static public $db;
	
	/**
	 * type of database e.g: Mysql, Postgresql etc
	 *
	 * @var string
	 */
	static public $dbType;
	
	/**
	 * database password
	 *
	 * @var string
	 */
	static public $dbPassword;
	
	/**
	 * database username
	 *
	 * @var string
	 */
	static public $dbUsername;
	
	/**
	 * database host
	 *
	 * @var string
	 */
	static public $dbHost;
	
	/**
	 * database name
	 *
	 * @var string
	 */
	static public $dbName;
	
	
	protected static function setUpConnection()
	{
		if (!isset(self::$db)) {
			$dbType = 'Zend_Db_Adapter_Pdo_' . self::$dbType;
			self::$db = new $dbType(array(
    			'host'     => self::$dbHost,
   				'username' => self::$dbUsername,
    			'password' => self::$dbPassword,
    			'dbname'   => self::$dbName
			));
		}
	}
	

}