<?php

class ValidatorDatabaseServer extends Validator
{
	/**
	 * validate data of given object
	 *
	 * @param DatabaseObject $object
	 * @throws ValidatorException it is thrown if objects data are wrong
	 */
	public function validate($object)
	{
		if (is_null($object->name) || strlen($object->name) == 0) {
			$this->_errors[] = 'Wrong name';
		}
		if (is_null($object->url) || strlen($object->url) == 0) {
			$this->_errors[] = 'Wrong url pattern';
		}
		if (is_null($object->urlName) || strlen($object->urlName) == 0) {
			$this->_errors[] = 'Wrong url name';
		}
		if (is_null($object->cacheSize) || strlen($object->cacheSize) == 0 || !is_numeric($object->cacheSize)) {
			$this->_errors[] = 'Wrong cache size';
		}
		if (is_null($object->tileHeight) || strlen($object->tileHeight) == 0 || !is_numeric($object->tileHeight)) {
			$this->_errors[] = 'Wrong tile height';
		}
		if (is_null($object->tileWidth) || strlen($object->tileWidth) == 0 || !is_numeric($object->tileWidth)) {
			$this->_errors[] = 'Wrong tile width';
		}
		if (is_null($object->minZoom) || strlen($object->minZoom) == 0 || !is_numeric($object->minZoom)) {
			$this->_errors[] = 'Wrong minimal zoom';
		}
		if (is_null($object->maxZoom) || strlen($object->maxZoom) == 0 || !is_numeric($object->maxZoom)) {
			$this->_errors[] = 'Wrong maximal zoom';
		}
		if (count($this->_errors) > 0) {
			throw new ValidatorException('Wrong object data');
		}
	}

	/**
	 * it handles exception
	 *
	 * @param Exception/ $e
	 * @return bool return true if exception has been handled by this method
	 */
	public function handleException(Exception $e)
	{
		if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
			$this->_errors[] = 'Name and url name have to be unique';
			throw new ValidatorException('Wrong data object');
			return true;
		}
		return false;
	}
}