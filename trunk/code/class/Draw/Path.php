<?php
class DrawPath extends Draw
{
	
	/**
	 * Points which creates path
	 *
	 * @var array
	 */
	private $_points;
	
	public function __construct(array $points)
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
			$point->setColor($this->_color);
			$point->draw($map);
			if (!is_null($previousPoint)) {
				$line = new DrawLine($previousPoint, $point);
				$line->setColor($this->_color);
				$line->draw($map);
			}
			$previousPoint = $point;
		}
	}
	
}
?>