<?php
class RequestValidatorFromBoundaryBoxZoom extends RequestValidatorFromBoundaryBox 
{
	/**
	 * implements detials of checking map request data, it should be overloaded by subclasses
	 *
	 * @return bool return false if data are incorect
	 */
	protected function _check()
	{
		parent::_check();
		if (!$this->_checkZoom()) {
			throw new WrongMapRequestDataException('Wrong zoom is given');
		}
	}
}