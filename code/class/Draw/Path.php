<?php
class DrawPath extends DrawLine
{
	
	/**
	 * Points which creates path
	 *
	 * @var array
	 */
	protected $_points;
	
	public function __construct(array $points = array())
	{
		$this->_points = $points;
	}
	
	/**
	 * it draws object on map
	 *
	 * @param Map $map
	 */
	public function draw(Map $map)
	{
		$previousPoint = null;
		foreach ($this->_points as $point) {
			if (!is_null($previousPoint)) {
				$this->_drawLineBetweenPoints($map, $point, $previousPoint);
			}
			$previousPoint = $point;
		}
	}
	
	/**
	 * it draws line beetween two points
	 *
	 * @param Map $map
	 * @param DrawMarkPoint $point1
	 * @param DrawMarkPoint $point2
	 */
	protected function _drawLineBetweenPoints(Map $map, DrawMarkPoint $point1, DrawMarkPoint $point2)
	{
		$line = new DrawLine($point1, $point2);
		$line->setColor($this->_color);
		$line->setThickness($this->_thickness);
		$line->setTransparency($this->_transparency);
		$line->draw($map);
	}
	
	/**
	 * add point
	 *
	 * @param DrawMarkPoint $point
	 */
	public function addPoint(DrawMarkPoint $point)
	{
		$this->_points[] = $point;
	}
	
	/**
	 * set additional options 
	 *
	 * @param mixed $param
	 */
	public function setParam($param) 
	{
		parent::setParam($param);
		if ($param instanceof ParamThickness) {
			$this->setThickness($param);
		}
	}
}