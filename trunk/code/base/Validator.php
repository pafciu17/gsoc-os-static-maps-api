<?php
class ValidatorException extends Exception
{
}

class Validator
{
	
	protected $_errors = array();
	
	/**
	 * validate data of given object
	 *
	 * @param DatabaseObject $object
	 * @throws ValidatorException it is thrown if objects data are wrong
	 */
	public function validate($object)
	{
		
	}

	/**
	 * it handles exception
	 *
	 * @param Exception/ $e
	 * @return bool return true if exception has been handled by this method
	 */
	public function handleException(Exception $e)
	{
		
	}
	
	
	public function getErrors()
	{
		return $this->_errors;
	}
}