<?php
class RequestValidatorFromBoundaryBoxWidthHeight extends RequestValidatorFromBoundaryBox 
{
	/**
	 * implements detials of checking map request data, it should be overloaded by subclasses
	 *
	 * @throws WrongMapRequestDataException
	 * @return bool return false if data are incorect
	 */
	protected function _check()
	{
		if (!$this->_checkHeight() && !$this->_checkWidth()) {
			throw new WrongMapRequestDataException('Wrong size of the map is given1');
		}
		if ($this->_mapData->getWidth() < 0 || $this->_mapData->getHeight() < 0) {
			throw new WrongMapRequestDataException('Wrong size of the map is given2');
		}
	}
}