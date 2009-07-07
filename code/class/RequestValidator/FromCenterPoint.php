<?php
class RequestValidatorFromCenterPoint extends RequestValidatorFromBoundaryBox 
{
	/**
	 * implements details of checking map request data, it should be overloaded by subclasses
	 *
	 * 
	 */
	protected function _check()
	{
		$centerPoint = $this->_mapData->getCenterPoint();
		//checking if mapa data are correct, and map can be build from it 
		if (is_null($centerPoint)) {
			throw new WrongMapRequestDataException('Center point has not been given');
		}
		if (!is_numeric($centerPoint['lon']) || !is_numeric($centerPoint['lat'])) {
			throw new WrongMapRequestDataException('Wrong paramters of center point have been given1');
		}
		$worldMap = new BaseWorldMap();
		if (!$worldMap->isCorrectLat($centerPoint['lat'])) {
			throw new WrongMapRequestDataException('Wrong parameters of center point have been given2');
		}
		if (!$this->_checkZoom()) {
			throw new WrongMapRequestDataException('Wrong zoom is given');
		}
		if (!$this->_checkWidth() || !$this->_checkHeight()) {
			throw new WrongMapRequestDataException('Wrong parameters of map is given');
		}
	}
}