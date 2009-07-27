<?php
class DrawMarkPoint extends DrawPoint
{
	/**
	 * draw point on map
	 *
	 * @param Map $map
	 */
	public function draw(Map $map)
	{
		$image = $map->getImage();
		$color = $this->_getDrawColor($image); 
		$point = $map->getPixelPointFromCoordinates($this->getLon(), $this->getLat());
		$vertices = array($point['x'], $point['y'],
			$point['x'] - 10, $point['y'] - 20, $point['x'] + 10, $point['y'] - 20);
		imagefilledpolygon ($map->getImage() , $vertices , 3, $color);
	}
}