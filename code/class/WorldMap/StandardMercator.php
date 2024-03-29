<?php
class WorldMapStandardMercator extends WorldMap 
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
	
	public function validatePixelX($x)
	{
		if ($x >= $this->getWidth()) {
			return $x = $this->getWidth() - 1;
		}
		return $x;
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
		return $lon;
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
	
	/**
	 * create proper world for longitude distance between two given longitudes and given width of the map
	 *
	 * @param float $lon
	 * @param float $lon2
	 * @param int $width
	 * @return WorldMap
	 */
	public function createProperWorldFromWidth($lon, $lon2, $width)
	{
		$maxZoom = $this->_tileSource->getMaxZoom();
		for ($i = $this->_tileSource->getMinZoom(); $i <= $maxZoom; $i++) {
			$className = get_class($this);
			$world = new $className($i, $this->_tileSource);
			$distance = $world->getPixelDistance($lon, 0, $lon2, 0);
			if ($width < $distance['x']) {
				return $world;
			}
		}
		return $world;
	}
	
	/**
	 * create world for given latitude distance between two given latitudes and given height of the map
	 *
	 * @param float $lat
	 * @param float $lat2
	 * @param int $height
	 * @return WorldMap
	 */
	public function createProperWordlFromHeight($lat, $lat2, $height)
	{
		$maxZoom = $this->_tileSource->getMaxZoom();
		for ($i = $this->_tileSource->getMinZoom(); $i <= $maxZoom; $i++) {
			$world = new WorldMap($i, $this->_tileSource);
			$distance = $world->getPixelDistance(0, $lat, 0, $lat2);
			if ($width > $distance['y']) {
				return $world;
			}
		}
		return $world;
	}
	
}
?>