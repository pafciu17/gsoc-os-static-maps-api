<?php
class DrawLine extends Draw
{
	/**
	 * start point of the line
	 *
	 * @var Point
	 */
	private $_startPoint;
	
	/**
	 * end point of the line
	 *
	 * @var Point
	 */
	private $_endPoint;
	
	public function __construct($startPoint, $endPoint)
	{
		$this->_startPoint = $startPoint;
		$this->_endPoint = $endPoint;
	}
	
	/**
	 * draw line on map
	 *
	 * @param Map $map
	 */
	public function draw(Map $map)
	{
	
		$image = $map->getImage();
		$startPointInPixels = $map->getPixelPointFromCoordinates($this->_startPoint->getLon(),
		$this->_startPoint->getLat());
		$endPointInPixels = $map->getPixelPointFromCoordinates($this->_endPoint->getLon(),
		$this->_endPoint->getLat());
		imageline($image, $startPointInPixels['x'], $startPointInPixels['y'], 
		$endPointInPixels['x'], $endPointInPixels['y'], imagecolorallocate($image, 
		$this->_color->getR(), $this->_color->getG(), $this->_color->getB()));
	}
}