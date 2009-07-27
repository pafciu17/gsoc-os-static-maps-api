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

	/**
	 * thickness of the line
	 *
	 * @var ParamThickness
	 */
	protected $_thickness;

	public function __construct($startPoint, $endPoint)
	{
		$this->_startPoint = $startPoint;
		$this->_endPoint = $endPoint;
	}

	/**
	 * set thickness of the line
	 *
	 * @param ParamThickness $thick
	 */
	public function setThickness(ParamThickness $thick)
	{
		$this->_thickness = $thick;
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
		$this->_drawLine($image, $startPointInPixels['x'], $startPointInPixels['y'],
		$endPointInPixels['x'], $endPointInPixels['y']);
	}

	private function _drawLine($image, $x1, $y1, $x2, $y2)
	{
		$thick = $this->_thickness->getThickness();
		$color = $this->_getDrawColor($image);
		if ($thick == 1) {
			return imageline($image, $x1, $y1, $x2, $y2, $color);
		}
		$t = $thick / 2 - 0.5;
		if ($x1 == $x2 || $y1 == $y2) {
			return imagefilledrectangle($image, round(min($x1, $x2) - $t), round(min($y1, $y2) - $t), round(max($x1, $x2) + $t), round(max($y1, $y2) + $t), $color);
		}
		$k = ($y2 - $y1) / ($x2 - $x1); //y = kx + q
		$a = $t / sqrt(1 + pow($k, 2));
		$points = array(
		round($x1 - (1+$k)*$a), round($y1 + (1-$k)*$a),
		round($x1 - (1-$k)*$a), round($y1 - (1+$k)*$a),
		round($x2 + (1+$k)*$a), round($y2 - (1-$k)*$a),
		round($x2 + (1-$k)*$a), round($y2 + (1+$k)*$a),
		);
		imagefilledpolygon($image, $points, 4, $color);
		imagepolygon($image, $points, 4, $color);
	}
	
	/**
	 * checks if thickness is set
	 *
	 * @return bool
	 */
	public function hasThickness()
	{
		return !is_null($this->_thickness);
	}

}