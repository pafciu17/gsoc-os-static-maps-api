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
	 * thicknes of lines
	 *
	 * @var ParamThickness
	 */
	private $_thickness;
	
		
	/**
	 * color which is used when normal color is not set
	 *
	 * @var Color
	 */
	public static $defaultColor;
	
	/**
	 * default thickness
	 *
	 * @var ParamThickness
	 */
	public static $defaultThickness;
	
	public function __construct(MapRequest $mapRequest)
	{
		$this->_mapRequest= $mapRequest;
		$this->_setColor();
		$this->_setThickness();
	}

	/**
	 * baseing on map request it sets global thicknes of all paths
	 *
	 */
	private function _setThickness()
	{
		$thickness = $this->_mapRequest->getThickness();
		if (!is_null($thickness)) {
			$this->_thickness = new ParamThickness((int)$thickness);
		}
	}
	
	/**
	 * method returns thickness
	 *
	 * @return ParamThickness
	 */
	public function getThickness()
	{
		if (!is_null($this->_thickness)) {
			return $this->_thickness;
		} else {
			return self::$defaultThickness;
		}
	}
	
	/**
	 * set thickness
	 *
	 * @param int $thickness 
	 */
	public function setThickness($thickness)
	{
		$this->_thickness = new ParamThickness($thickness);
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
	 * return color
	 *
	 * @return Color
	 */
	public function getColor()
	{
		if (!is_null($this->_color)) {
			return $this->_color;
		} else {
			return self::$defaultColor;
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
			$path = new DrawPath();
			$i = 0;
			foreach ($coordinates as $coordinate) {
				if ($i == 0 && is_numeric($coordinate)) {
					$lon = $coordinate;
					$i++;
				} else if (is_numeric($coordinate)) {
					$addPoint = new DrawMarkPoint($lon, $coordinate);
					$path->addPoint($addPoint);
					$i = 0;
				} else {
					$param = ParamFactory::create($coordinate);
					$path->setParam($param);
				}
			}
			$paths[] = $path;
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
			if ($i == 0 && is_numeric($coordinate)) {
				$lon = $coordinate;
				$i++;
			} else if (is_numeric($coordinate)) {
				$addPoint = new DrawMarkPoint($lon, $coordinate);
				$points[] = $addPoint;
				$i = 0;
			} else if (isset($addPoint)) {
				$param = ParamFactory::create($coordinate);
				$addPoint->setParam($param);
			}
		}
		return $points;
	}
	
}