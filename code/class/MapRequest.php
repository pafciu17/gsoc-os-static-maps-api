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
	static private $_urlParametersNames = array('centerLon' => 'centerLon',
		'centerLat' => 'centerLat',
		'leftUpLon' => 'leftUpLon',
		'leftUpLat' => 'leftUpLat',
		'rightDownLon' => 'rightDownLon',
		'rightDownLat' => 'rightDownLat',
		'leftDownLon' => 'leftDownLon',
		'leftDownLat' => 'leftDownLat',
		'rightUpLon' => 'rightUpLon',
		'rightDownLon' => 'rightDownLon',
		'width' => 'width',
		'height' => 'height',
		'zoom' => 'zoom',
		'type' => 'type');
	
	public function __construct(GET $get)
	{
		$this->_get = $get;
		$this->_setUpMapData($get);
	}
	
	private function _setUpMapData(GET $get)
	{
		foreach (self::$_urlParametersNames as $urlName => $appName) {
			$parameter = $get->$urlName;
			if (!is_null($parameter)) {
				$this->_mapData[$appName] = $parameter;
			}
		}
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
			$this->_mapData['leftUpLon'] = $this->_mapData['leftDownLon'];
			$this->_mapData['leftUpLat'] = $this->_mapData['rightUpLat'];
			return array('lon' => $this->_mapData['rightDownLon'], 'lat' => $this->_mapData['rightDownLon']);
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
		// @TODO maybe it would be good place to validate data ?
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
			return $this->_mapData['width'];
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
			return $this->_mapData['height'];
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
			return $this->_mapData['zoom'];
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