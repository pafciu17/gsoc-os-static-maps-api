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
	static private $_urlParametersNames = array('centerX' => 'centerX',
		'centerY' => 'centerY',
		'leftUpX' => 'leftUpX',
		'leftUpY' => 'leftUpY',
		'rightDownX' => 'rightDownX',
		'rightDownY' => 'rightDownY',
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
	 * return coordinates of center point
	 *
	 * @return array
	 */
	public function getCenterPoint()
	{
		return array('lon' => 22.5, 'lat' => 51.25);
		// @TODO maybe it would be good place to validate data ?
		if (isset($this->_mapData['centerX']) && isset($this->_mapData['centerY'])) {
			return array('lon' => $this->_mapData['centerX'], 'lat' => $this->_mapData['centerY']);
		}
	}
	
	/**
	 * return width of the image
	 *
	 * @return int
	 */
	public function getWidth()
	{
		return 300;
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
		return 300;
		if (isset($this->_mapData['height'])) {
			return $this->_mapData['width'];
		}
	}
	
	/**
	 * return type of the map which will be used to create output map
	 *
	 * @return string
	 */
	public function getType()
	{
		return 'cycle';
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
		return 10;	
		if (isset($this->_mapData['zoom'])) {
			return $this->_mapData['zoom'];
		}
	}
}