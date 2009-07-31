<?php
/**
 * contains map request data, it is build from GET data
 *
 */
class MapRequest
{
	/**
	 * GET data
	 * 
	 * @var GET
	 */
	private $_get;
	
	/**
	 * request map data
	 *
	 * @var array
	 */
	private $_mapData = array();
	
	/**
	 * it maps url paramters to app parameters
	 *
	 * @var array
	 */
	static private $_urlParametersNames = array('lon' => 'centerLon',
		'lat' => 'centerLat',
		'leftUpLon' => 'leftUpLon',
		'leftUpLat' => 'leftUpLat',
		'rightDownLon' => 'rightDownLon',
		'rightDownLat' => 'rightDownLat',
		'leftDownLon' => 'leftDownLon',
		'leftDownLat' => 'leftDownLat',
		'rightUpLon' => 'rightUpLon',
		'rightUpLat' => 'rightUpLat',
		'width' => 'width',
		'height' => 'height',
		'zoom' => 'zoom',
		'type' => 'type',
		'imgType' => 'imgType',
		'points' => 'points',
		'bbox' => 'bbox',
		'paths' => 'paths',
		'color' => 'color',
		'logoPos' => 'logoLayout',
		'center' => 'center',
		'reload' => 'reload',
		'thickness' => 'thickness',
		'transparency' => 'transparency',
		'polygons' => 'polygons',
		'filledPolygons' => 'filledPolygons',
		'pointImageUrl' => 'pointImage',
		'pointImagePattern' => 'pointImagePattern'
	);
	
	/**
	 * 
	 *
	 */
	public function getScaleBarLayoutName()
	{
		return null;
	}
	
	/**
	 * return name of the pattern url to point image
	 *
	 * @return string
	 */
	public function getPointImagePatternName()
	{
		return $this->_mapData['pointImagePattern'];
	}
	
	/**
	 * return url to an image which is used as url image
	 *
	 * @return string
	 */
	public function getUrlToPointImage()
	{
		return $this->_mapData['pointImage'];
	}
	
	/**
	 * return string which represents filled polygons to draw
	 *
	 * @return string
	 */
	public function getFilledPolygons()
	{
		return $this->_mapData['filledPolygons'];
	}
	
	/**
	 * it returns string which represents polygons to draw
	 *
	 * @return string
	 */
	public function getPolygonsPoints()
	{
		return $this->_mapData['polygons'];
	}
	
	/**
	 * it returns string which describes transparency of the line
	 *
	 * @return string
	 */
	public function getTransparency()
	{
		return $this->_mapData['transparency'];
	}
	
	/**
	 * it returns string which describes thickness of the line
	 *
	 * @return int
	 */
	public function getThickness()
	{
		return $this->_mapData['thickness'];
	}
	
	/**
	 * return true if isset reload param
	 *
	 * @return bool
	 */
	public function issetReloadParam()
	{
		if (!is_null($this->_mapData['reload'])) {
			return true;
		}
		return false;
	}
	
	/**
	 * return string which contains coordinates of points to draw
	 *
	 * @return string
	 */
	public function getMarkPoints()
	{
		return $this->_mapData['points'];
	}
	
	/**
	 * return string which indicates how logo should be added to result map
	 *
	 * @return string
	 */
	public function getLogoLayoutName()
	{
		return $this->_mapData['logoLayout'];
	}
	
	/**
	 * return string which contains coordinates of paths points 
	 *
	 * @return string
	 */
	public function getPathPoints()
	{
		return $this->_mapData['paths'];
	}
	
	/**
	 * return array which describes map boundary box, it returns null if box is not define
	 * array keys: left, top, right, bottom
	 *
	 * @return mixed
	 */
	public function getBBox()
	{
		$bbox = $this->_getBoundBox();
		if (sizeof($bbox) != 4) {
			return null;
		}
		return $bbox;
	}
	
	/**
	 * return string which contains RGB cordinates of draw color
	 *
	 * @return string
	 */
	public function getColor()
	{
		return $this->_mapData['color'];
	}
	
	public function __construct(GET $get)
	{
		$this->_get = $get;
		$this->_setUpMapData($get);
	}
	
	/**
	 * return image type
	 *
	 * @return string
	 */
	public function getImageType()
	{
		return $this->_mapData['imgType'];		
	}
	
	private function _setUpMapData(GET $get)
	{
		foreach (self::$_urlParametersNames as $urlName => $appName) {
			$parameter = $get->$urlName;
			if (!is_null($parameter)) {
				$this->_mapData[$appName] = $parameter;
			} else {
				$this->_mapData[$appName] = null;
			}
		}
	}
	
	/**
	 * return coordinates of bound box
	 *
	 * @return 
	 */
	private function _getBoundBox()
	{
		$bbox = array();
		if (!is_null($this->_mapData['bbox'])) {
			$coordinates = explode(',', $this->_mapData['bbox']);
			if (isset($coordinates[0]) && isset($coordinates[1]) && isset($coordinates[2]) && isset($coordinates[3])) {
				$bbox['left'] = $coordinates[0];
				$bbox['top'] = $coordinates[1];
				$bbox['right'] = $coordinates[2];
				$bbox['bottom'] = $coordinates[3];
			}
		}
		return $bbox;
	}
	
	/**
	 * return coordinates of the left up corner of the map
	 *
	 * @return array
	 */
	public function getLeftUpCornerPoint()
	{
		if (isset($this->_mapData['leftUpLon']) && isset($this->_mapData['leftUpLat'])) {
			return array('lon' => $this->_mapData['leftUpLon'], 'lat' => $this->_mapData['leftUpLat']);
		}
		if (isset($this->_mapData['leftDownLon']) && isset($this->_mapData['rightUpLat'])) {
			$this->_mapData['leftDownLon'] = $this->_mapData['leftDownLon'];
			$this->_mapData['rightUpLat'] = $this->_mapData['rightUpLat'];
			return array('lon' => $this->_mapData['leftDownLon'], 'lat' => $this->_mapData['rightUpLat']);
		}
		$bbox = $this->_getBoundBox();
		if (isset($bbox['left']) && isset($bbox['top'])) {
			return array('lon' => $bbox['left'], 'lat' => $bbox['top']);
		}
	}
	
	/**
	 * return coordinates of the left right down corner of the map
	 *
	 * @return array
	 */
	public function getRightDownCornerPoint()
	{
		if (isset($this->_mapData['rightDownLon']) && isset($this->_mapData['rightDownLat'])) {
			return array('lon' => $this->_mapData['rightDownLon'], 'lat' => $this->_mapData['rightDownLat']);
		}
		if (isset($this->_mapData['rightUpLon']) && isset($this->_mapData['leftDownLat'])) {
			$this->_mapData['rightDownLon'] = $this->_mapData['rightUpLon'];
			$this->_mapData['rightDownLat'] = $this->_mapData['leftDownLat'];
			return array('lon' => $this->_mapData['rightDownLon'], 'lat' => $this->_mapData['rightDownLon']);
		}
		$bbox = $this->_getBoundBox();
		if (isset($bbox['right']) && isset($bbox['bottom'])) {
			return array('lon' => $bbox['right'], 'lat' => $bbox['bottom']);
		}
	}
	
	/**
	 * set coordinates of the left up corner point
	 *
	 * @param array $coordinates
	 */
	public function setLeftUpCornerPoint($coordinates)
	{
		$this->_mapData['leftUpLon'] = $coordinates['lon'];
		$this->_mapData['leftUpLat'] = $coordinates['lat'];
	}
	
	/**
	 * set coordinates of the right down corner point
	 *
	 * @param array $coordinates
	 */
	public function setRightDownCornerPoint($coordinates)
	{					
		$this->_mapData['rightDownLon'] = $coordinates['lon'];
		$this->_mapData['rightDownLat'] = $coordinates['lat'];
	}
	
	/**
	 * return coordinates of center point
	 *
	 * @return array
	 */
	public function getCenterPoint()
	{
		if (isset($this->_mapData['center'])) {
			$coordinates = explode(',', $this->_mapData['center']);
			if (isset($coordinates[0]) && isset($coordinates[1])) {
				return array('lon' => $coordinates[0], 'lat' => $coordinates[1]);
			}
		}
		if (isset($this->_mapData['centerLon']) && isset($this->_mapData['centerLat'])) {
			return array('lon' => $this->_mapData['centerLon'], 'lat' => $this->_mapData['centerLat']);
		}
	}
	
	/**
	 * return width of the image
	 *
	 * @return int
	 */
	public function getWidth()
	{
		if (isset($this->_mapData['width'])) {
			return (int)$this->_mapData['width'];
		}
	}
	
	/**
	 * return height of the image
	 *
	 * @return int
	 */
	public function getHeight()
	{
		if (isset($this->_mapData['height'])) {
			return (int)$this->_mapData['height'];
		}
	}
	
	/**
	 * return type of the map which will be used to create output map
	 *
	 * @return string
	 */
	public function getType()
	{
		if (isset($this->_mapData['type'])) {
			return $this->_mapData['type'];
		}
	}
	
	/**
	 * return zoom of the map
	 *
	 * @return int
	 */
	public function getZoom()
	{
		if (isset($this->_mapData['zoom'])) {
			return (int)$this->_mapData['zoom'];
		} 
	}
	
	public function setHeight($height)
	{
		$this->_mapData['height'] = $height;
	}
	
	public function setWidth($width)
	{
		$this->_mapData['width'] = $width;
	}
}