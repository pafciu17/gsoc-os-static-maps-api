<?php
class DrawPoint extends Draw
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
		$color = $this->_getDrawColor($image);
		$pointInPixels = $map->getPixelPointFromCoordinates($this->_coordinates['lon'],
		$this->_coordinates['lat']);
		imagesetpixel($image, $pointInPixels['x'], $pointInPixels['y'], $color);
	}
	
	/**
	 * return longitude
	 *
	 * @return float;
	 */
	public function getLon()
	{
		return $this->_coordinates['lon'];
	}
	
	/**
	 * return latitude
	 *
	 * @return float
	 */
	public function getLat()
	{
		return $this->_coordinates['lat'];
	}
}