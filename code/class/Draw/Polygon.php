<?php

class DrawPolygon extends DrawPath
{

	/**
	 * it draws object on map
	 *
	 * @param Map $map
	 */
	public function draw(Map $map)
	{
		parent::draw($map);
		if (sizeof($this->_points) > 0) {
			$firstPoint = reset($this->_points);
			$lastPoint = $this->_points[sizeof($this->_points) - 1];
			$this->_drawLineBetweenPoints($map, $firstPoint, $lastPoint);
		}
	}
}