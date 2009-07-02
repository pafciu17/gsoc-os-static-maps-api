<?php
class DrawRequest
{

	/**
	 * map request data
	 *
	 * @var MapRequest
	 */
	private $_mapRequest;
	
	/**
	 * color of drawnings
	 *
	 * @var Color
	 */
	private $_color;
	
	/**
	 * color which is used when normal color is not set
	 *
	 * @var Color
	 */
	private $_defaultColor;
	
	public function __construct(MapRequest $mapRequest)
	{
		$this->_mapRequest= $mapRequest;
		$this->_setColor();
	}

	/**
	 * method sets color for drawings
	 *
	 */
	private function _setColor()
	{
		$colorString = $this->_mapRequest->getColor();
		$rgb = explode(',', $colorString);
		if (isset($rgb[0]) && isset($rgb[1]) && isset($rgb[2])) {
			$this->_color = new Color($rgb[0], $rgb[1], $rgb[2]);
		}
	}
	
	/**
	 * it sets default color for drawings, this color is used when normaln color is not defined
	 *
	 * @param array $colorArray
	 */
	public function setDefaultColor($colorArray)
	{
		if (isset($colorArray['r']) && isset($colorArray['g']) && isset($colorArray['b'])) {
			$this->_defaultColor = new Color($colorArray['r'], $colorArray['g'], $colorArray['b']);
		}
	}
	
	/**
	 * return color
	 *
	 * @return Color
	 */
	public function getColor()
	{
		if (!is_null($this->_color)) {
			return $this->_color;
		} else {
			return $this->_defaultColor;
		}
	}
	
	/**
	 * it sets color
	 *
	 * @param Color $color
	 */
	public function setColor(Color $color)
	{
		$this->_color = $color;
	}
	
	/**
	 * return if color is set
	 *
	 * @return bool
	 */
	public function hasColor()
	{
		return isset($this->_color);
	}
	
	/**
	 * get all drawable objects
	 *
	 * @return array
	 */
	public function getDrawings()
	{
		return array_merge($this->getMarkPoints(), $this->getPaths());
	}

	
	
	/**
	 * return array of drawning paths
	 *
	 * @return array
	 */
	public function getPaths()
	{
		$paths = array();
		$coordinatesStrings = explode(';', $this->_mapRequest->getPathPoints());
		foreach ($coordinatesStrings as $coordinatesString) {
			$coordinates = explode(',', $coordinatesString);
			$points = array();
			$i = 0;
			foreach ($coordinates as $pointCoordinate) {
				if ($i == 0) {
					$lon = $pointCoordinate;
					$i++;
				} else {
					$points[] = new DrawMarkPoint($lon, $pointCoordinate);
					$i = 0;
				}
			}
			$paths[] = new DrawPath($points);
		}
		return $paths;
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