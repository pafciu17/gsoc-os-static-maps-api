<?php
class StandardMercatorWorldMap extends WorldMap 
{
	/**
	 * get pixel coordinates for given longitude and latitude
	 *
	 * @param int $lon
	 * @param int $lat
	 * @return array
	 */
	public function getPixelXY($lon, $lat)
	{
		$worldMapWidth = $this->getWidth();
		$worldMapHeight = $this->getHeight();
		$x = round((($lon + 180)/360) * $worldMapWidth);
		$y = round(abs((log(tan(pi()/4 + deg2rad($lat)/2)) - pi()) / (2 * pi())) * $this->getHeight());
		return array('x' => $x, 'y' => $y);
	}
	
	/**
	 * get width of the world map
	 *
	 * @return int
	 */
	public function getWidth()
	{
		return pow(2, $this->_zoom) * $this->_tileSource->getTileWidth();
	
	}
	
	/**
	 * get height of the world map
	 *
	 * @return int
	 */
	public function getHeight()
	{
		return pow(2, $this->_zoom) * $this->_tileSource->getTileHeight();
	}
	
	/**
	 * get longitude for given x pixel coordinate
	 *
	 * @return int
	 */
	public function getLon($x)
	{
		$lon = (($x / $this->getWidth()) * 360) - 180;
		return $this->_correctLon($lon);
	}
	
	/**
	 * get latitude for given y pixel coordinate
	 *
	 * @param int
	 */
	public function getLat($y)
	{
		$a = (-1) * ($y - ($this->getHeight() / 2)) * (2 * pi()) / $this->getHeight();
		$lat = rad2deg(2 * atan(exp($a))) - 90; 
		return $this->_correctLat($lat);
	}
}
?>