<?php
class DrawFilledPolygon extends DrawPolygon 
{

	/**
	 * it draws object on map
	 *
	 * @param Map $map
	 */
	public function draw(Map $map)
	{
		$points = array();
		$count = 0;
		foreach ($this->_points as $point) {
			$coordinates = $map->getPixelPointFromCoordinates($point->getLon(), $point->getLat());
			$points[] = $coordinates['x'];
			$points[] = $coordinates['y'];
			$count++;
		}
		if ($count < 3) {
			return;
		}
		imagefilledpolygon($map->getImage(), $points, $count, $this->_getDrawColor($map->getImage()));
	}
}
