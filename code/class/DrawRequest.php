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
	 * color of drawings
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
	 * transparency of drawnings
	 *
	 * @var ParamTransparency
	 */
	private $_transparency;

	/**
	 * objects which contains url to mark point image
	 *
	 * @var ParamUrl
	 */
	private $_pointImageUrl;
	
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

	/**
	 * default transparency of the drawings
	 *
	 * @var unknown_type
	 */
	public static $defaultTransparency;
	
	/**
	 * object delimeter used in request string
	 *
	 * @var char
	 */
	public static $drawObjectDelimeter = ';';

	/**
	 * param delimeter used in request string
	 *
	 * @var char
	 */
	public static $paramDelimeter = ',';
	
	public function __construct(MapRequest $mapRequest)
	{
		$this->_mapRequest= $mapRequest;
		$this->_setColor();
		$this->_setThickness();
		$this->_setTransparency();
		$this->_setPointImageUrl();
	}
	
	/**
	 * method bases on map request object and sets the url to image which is used for drawing points
	 *
	 */
	private function _setPointImageUrl()
	{
		$url = $this->_mapRequest->getUrlToPointImage();
		if (!is_null($url)) {
			$this->_pointImageUrl = new ParamUrl($url);
		} else {
			$patternName = $this->_mapRequest->getPointImagePatternName();
			if (!is_null($patternName)) {
				$paramUrl = new ParamPatternUrl($patternName);
				if ($paramUrl->hasUrl()) {
					$this->_pointImageUrl = $paramUrl;
				}
			}
		}
	}

	/**
	 * baseing on map request it sets global transparency of all drawings
	 *
	 */
	private function _setTransparency()
	{
		$transparency = $this->_mapRequest->getTransparency();
		if (!is_null($transparency)) {
			$this->_transparency = new ParamTransparency((int)$transparency);
		}
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
	 * it returns objects which encapsulates url to mark point image
	 *
	 * @return ParamUrl
	 */
	public function getPointImageUrl()
	{
		return $this->_pointImageUrl;
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
		$rgb = explode(self::$paramDelimeter, $colorString);
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
	 * return transparency
	 *
	 * @return ParamTransparecy
	 */
	public function getTransparency()
	{
		if (!is_null($this->_transparency)) {
			return $this->_transparency;
		} else {
			return self::$defaultTransparency;
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
		return array_merge($this->getMarkPoints(), $this->getPaths(),
		$this->getPolygons(), $this->getFilledPolygons());
	}

	/**
	 * return array of drawing paths
	 *
	 * @return array
	 */
	public function getPaths()
	{
		$paths = array();
		$string =  $this->_mapRequest->getPathPoints();
		if (is_null($string)) {
			return array();
		}
		$coordinatesStrings = explode(self::$drawObjectDelimeter, $string);
		foreach ($coordinatesStrings as $coordinatesString) {
			$coordinates = explode(self::$paramDelimeter, $coordinatesString);
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
	 * return array of polygons to draw
	 *
	 * @return array
	 */
	public function getPolygons()
	{
		$polygons = array();
		$string =  $this->_mapRequest->getPolygonsPoints();
		if (is_null($string)) {
			return array();
		}
		$coordinatesStrings = explode(self::$drawObjectDelimeter, $string);
		foreach ($coordinatesStrings as $coordinatesString) {
			$coordinates = explode(self::$paramDelimeter, $coordinatesString);
			$polygon = new DrawPolygon();
			$i = 0;
			foreach ($coordinates as $coordinate) {
				if ($i == 0 && is_numeric($coordinate)) {
					$lon = $coordinate;
					$i++;
				} else if (is_numeric($coordinate)) {
					$addPoint = new DrawMarkPoint($lon, $coordinate);
					$polygon->addPoint($addPoint);
					$i = 0;
				} else {
					$param = ParamFactory::create($coordinate);
					$polygon->setParam($param);
				}
			}
			$polygons[] = $polygon;
		}
		return $polygons;
	}

	/**
	 * return array of filled polygons to draw
	 *
	 * @return array
	 */
	public function getFilledPolygons()
	{
		$polygons = array();
		$string =  $this->_mapRequest->getFilledPolygons();
		if (is_null($string)) {
			return array();
		}
		$coordinatesStrings = explode(self::$drawObjectDelimeter, $string);
		foreach ($coordinatesStrings as $coordinatesString) {
			$coordinates = explode(self::$paramDelimeter, $coordinatesString);
			$polygon = new DrawFilledPolygon();
			$i = 0;
			foreach ($coordinates as $coordinate) {
				if ($i == 0 && is_numeric($coordinate)) {
					$lon = $coordinate;
					$i++;
				} else if (is_numeric($coordinate)) {
					$addPoint = new DrawMarkPoint($lon, $coordinate);
					$polygon->addPoint($addPoint);
					$i = 0;
				} else {
					$param = ParamFactory::create($coordinate);
					$polygon->setParam($param);
				}
			}
			$polygons[] = $polygon;
		}
		return $polygons;
	}

	/**
	 * return array of MarkPoints objects
	 *
	 * @return array
	 */
	public function getMarkPoints()
	{
		$points = array();
		$string =  $this->_mapRequest->getMarkPoints();
		if (is_null($string)) {
			return array();
		}
		$pointsString = explode(self::$drawObjectDelimeter, $string);
		foreach ($pointsString as $pointString) {
			$coordinates = explode(self::$paramDelimeter, $pointString);
			$i = 0;
			foreach ($coordinates as $value) {
				if ($i == 0 && is_numeric($value)) {
					$lon = $value;
					$i++;
				} else if (is_numeric($value)) {
					$addPoint = new DrawMarkPoint($lon, $value);
					$points[] = $addPoint;
					$i = 0;
				} else if (isset($addPoint)) {
					$param = ParamFactory::create($value);
					$addPoint->setParam($param);
				}
			}
		}
		return $points;
	}

}