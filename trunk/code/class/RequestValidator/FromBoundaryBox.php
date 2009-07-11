<?php
abstract class RequestValidatorFromBoundaryBox extends RequestValidator 
{
	/**
	 * implements detials of checking map request data, it should be overloaded by subclasses
	 *
	 * @throws WrongMapRequestDataException
	 * @return bool return false if data are incorect
	 */
	protected function _check()
	{
		$bbox = $this->_mapData->getBBox();
		//checking if bbox is given correctly
		if (is_null($bbox)) {
			throw new WrongMapRequestDataException('Bbox has not been defined');
		}
		if (!is_numeric($bbox['left']) && !is_numeric($bbox['top']) && !is_numeric($bbox['right'])
		&& !is_numeric($bbox['bottom'])) {
			throw new WrongMapRequestDataException('Bbox has wrong paramters');
		}
		$worldMap = new BaseWorldMap();
		if (!$worldMap->isCorrectLat($bbox['top']) || !$worldMap->isCorrectLat($bbox['bottom'])) {
			throw new WrongMapRequestDataException('Bbox has wrong parameters');
		}
		if ($bbox['bottom'] >= $bbox['top']) {
			throw new WrongMapRequestDataException('Bbox has wrong parameters');
		}
	}
}