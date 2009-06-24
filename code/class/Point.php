<?php
class Point
{
	/**
	 * coordinates of the point
	 *
	 * @var array
	 */
	private $_coordinates = array();
	
	public function __construct($lon, $lat)
	{
		$this->_coordinates = array('lon' => $lon, 'lat' => $lat);
	}
	
	/**
	 * draw point on map
	 *
	 * @param Map $map
	 */
	public function draw(Map $map)
	{
		$image = $map->getImage();
		$pointInPixels = $map->getPixelPointFromCoordinates($this->_coordinates['lon'],
		$this->_coordinates['lat']);
		$map->getImageHandler()->drawPixel($image, $pointInPixels['x'], $pointInPixels['y']);
	}
	
	public function getLon()
	{
		return $this->_coordinates['lon'];
	}
	
	public function getLat()
	{
		return $this->_coordinates['lat'];
	}
}