<?php
class DrawPath extends DrawLine
{
	
	/**
	 * Points which creates path
	 *
	 * @var array
	 */
	private $_points;
	
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
				$line = new DrawLine($previousPoint, $point);
				$line->setColor($this->_color);
				$line->setThickness($this->_thickness);
				$line->draw($map);
			}
			$previousPoint = $point;
		}
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