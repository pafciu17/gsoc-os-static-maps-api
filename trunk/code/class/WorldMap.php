<?php
abstract class WorldMap
{
	/**
	 * map zoom
	 *
	 * @var int
	 */
	protected $_zoom;
	
	/**
	 * tile source
	 *
	 * @var TileSource
	 */
	protected $_tileSource;
	
	/**
	 * top edge of the latitude
	 *
	 * @var float
	 */
	protected $_topEdge = 85.0511;
	
	/**
	 * down edge of the latitude
	 *
	 * @var float
	 */
	protected $_downEdge = - 85.0511;
	
	public function __construct($zoom, TileSource $tileSource)
	{
		$this->_zoom = $zoom;
		$this->_tileSource = $tileSource;
	}
	
	/**
	 * correct longitude if it is out of domain
	 *
	 * @param float $lon
	 * @return float
	 */
	protected function _correctLon($lon)
	{
		if ($lon <= -180) {
			$lon += 360;
			$this->_correctLon($lon);
		}
		if ($lon > 180) {
			$lon -= 360;
			$this->_correctLon($lon);
		}
		return $lon;
	}
	
	/**
	 * correct latitude if it is out of domain
	 *
	 * @param float $lat
	 * @return float
	 */
	protected function _correctLat($lat)
	{
		if ($lat > $this->_topEdge) {
			$lat = $this->_topEdge;
		} else if ($lat < $this->_downEdge) {
			$lat = $this->_downEdge;
		}
		return $lat;
	} 
	
	/**
	 * create proper world for longitude distance between two given longitudes and given width of the map
	 *
	 * @param float $lon
	 * @param float $lon2
	 * @param int $width
	 * @return WorldMap
	 */
	abstract function createProperWorldFromWidth($lon, $lon2, $width);
	
	/**
	 * create world for given latitude distance between two given latitudes and given height of the map
	 *
	 * @param float $lat
	 * @param float $lat2
	 * @param int $height
	 * @return WorldMap
	 */
	abstract function createProperWordlFromHeight($lat, $lat2, $height);
	
	/**
	 * get pixel coordinates for given longitude and latitude
	 *
	 * @param int $lon
	 * @param int $lat
	 * @return array
	 */
	abstract public function getPixelXY($lon, $lat);
	
	/**
	 * get width of the world map
	 *
	 * @return int
	 */
	abstract public function getWidth();
	
	/**
	 * get height of the world map
	 *
	 * @return int
	 */
	abstract public function getHeight();
	
	/**
	 * get longitude for given x pixel coordinate
	 *
	 * @return int
	 */
	abstract public function getLon($x);
	
	/**
	 * get latitude for given y pixel coordinate
	 *
	 * @param int
	 */
	abstract public function getLat($y);
	
	/**
	 * return tile source which has been used to create map
	 *
	 * @return TileSource
	 */
	public function getTileSource()
	{
		return $this->_tileSource;
	}
	
	/**
	 * return zoom of the world map
	 *
	 * @return int
	 */
	public function getZoom()
	{
		return $this->_zoom;
	}
	
}