<?php
class DrawRequest
{
	
	/**
	 * map request data
	 *
	 * @var MapRequest
	 */
	private $_mapRequest;
	
	public function __construct(MapRequest $mapRequest)
	{
		$this->_mapRequest= $mapRequest;
	}
	
	/**
	 * get all drawable objects
	 *
	 * @return array
	 */
	public function getDrawings()
	{
		return $this->getMarkPoints();	
	}
	
	/**
	 * return array of MarkPoints objects
	 *
	 * @return array
	 */
	public function getMarkPoints()
	{
		$points = array();
		$coordinatesString = $this->_mapRequest->getMarkPoints();
		$coordinates = explode(',', $coordinatesString);
		$i = 0;
		foreach ($coordinates as $coordinate) {
			if ($i == 0) {
				$lon = $coordinate;
				$i++;
			} else {
				$points[] = new DrawMarkPoint($lon, $coordinate);
				$i = 0;
			}
		}
		return $points;
	}
}