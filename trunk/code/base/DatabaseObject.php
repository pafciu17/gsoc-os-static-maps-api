<?php


/**
 * base class for clases which use database
 *
 */
abstract class DatabaseObject extends Database
{


	/**
	 * tabel name
	 *
	 * @param string $id
	 */
	protected $_tableName;

	/**
	 * object data
	 *
	 * @var array
	 */
	protected $_data = array();

	/**
	 * error array
	 *
	 * @var array
	 */
	protected $_errors = array();

	/**
	 * array of object field names
	 */
	protected $_fields = array();

	/**
	 * it validate object data before save
	 *
	 * @var Validator
	 */
	protected $_validator;

	private function loadData($id)
	{
		$select = self::$db->select();
		$data = $select->From($this->_tableName)->Where('id = ?', $id)->query()->fetch();
		if ($data) {
			$this->_data = $data;
		}
	}

	public function __construct($id = null) {
		self::setUpConnection();
		if (is_numeric($id)) {
			$this->loadData($id);
		}
	}

	public function __get($key)
	{
		if (isset($this->_data[$key])) {
			return $this->_data[$key];
		}
	}

	public function __set($key, $value)
	{
		$this->_data[$key] = $value;
	}

	/**
	 * sava data object to database
	 *
	 * @throws ValidatorException it is thrown if objects data are wrong
	 */
	public function save()
	{
		$this->_validator->validate($this);
		if (isset($this->_data['id']) && is_numeric($this->_data['id'])) {
			$this->update();
		} else {
			$this->insert();
		}
	}

	/**
	 * it adds object o database
	 *
	 */
	private function insert()
	{
		try {
			self::$db->insert($this->_tableName, $this->_data);
			$this->_data['id'] = self::$db->lastInsertId();
		} catch (Zend_Db_Exception $e) {
			if (!$this->_validator->handleException($e))
			{
				throw $e;
			}
		}
	}

	/**
	 * it updates object data
	 *
	 */
	private function update()
	{
		try {
			$id = (int)$this->_data['id'];
			self::$db->update($this->_tableName, $this->_data, 'id = '.$id);
		} catch (Zend_Db_Exception $e) {
			if (!$this->_validator->handleException($e))
			{
				throw $e;
			}
		}
	}

	/**
	 * return errors which refer to object
	 *
	 * @return array
	 */
	public function getErrors()
	{
		return $this->_validator->getErrors();
	}

	/**
	 * return db connection object
	 *
	 * @return Zend_Db
	 */
	public function getDb()
	{
		self::setUpConnection();
		return self::$db;
	}

	/**
	 * return db table name
	 *
	 * @return string
	 */
	public function getTableName()
	{
		return $this->_tableName;
	}

	/**
	 * it sets object data
	 *
	 * @param array $data data to set
	 */
	public function setData($data)
	{
		foreach ($data as $key => $value) {
			if (in_array($key, $this->_fields)) {
				$this->_data[$key] = $value;
			}
		}
	}

	/**
	 * delete object from database
	 *
	 */
	public function delete()
	{
		if ($this->id) {
			self::$db->delete($this->_tableName, 'id = '.$this->id);
		}
	}

	public function loadDataFromPost(Post $post)
	{
		foreach ($this->_fields as $fieldName) {
			if (!is_null($post->$fieldName)) {
				$this->$fieldName = $post->$fieldName;
			}
		}
	}
}
