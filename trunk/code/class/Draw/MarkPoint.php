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
		parent::draw($map);
		$point = $map->getPixelPointFromCoordinates($this->getLon(), $this->getLat());
		$vertices = array($point['x'], $point['y'],
			$point['x'] - 10, $point['y'] - 20, $point['x'] + 10, $point['y'] - 20);
		imagefilledpolygon ($map->getImage() , $vertices , 3, imagecolorallocate($map->getImage(), 
		$this->_color->getR(), $this->_color->getG(), $this->_color->getB()));
	}
}