<?php
abstract class WorldMap extends BaseWorldMap 
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
	
	public function __construct($zoom, TileSource $tileSource)
	{
		$this->_zoom = $zoom;
		$this->_tileSource = $tileSource;
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
	 * return distance between two points in pixels
	 *
	 * @param float $lon
	 * @param float $lat
	 * @param float $lon2
	 * @param float $lat2
	 * @return array distance in x-pixels and y-pixels
	 */
	public function getPixelDistance($lon, $lat, $lon2, $lat2)
	{
		$point = $this->getPixelXY($lon, $lat);
		$point2 = $this->getPixelXY($lon2, $lat2);
		return array('x' => abs($point['x'] - $point2['x']), 
		'y' => abs($point['y'] - $point2['y'])); 
	}
	
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