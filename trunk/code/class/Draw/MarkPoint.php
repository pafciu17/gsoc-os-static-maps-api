<?php
class DrawMarkPoint extends DrawPoint
{
	/**
	 * url to image which can be used to draw point
	 * 
	 * @var string
	 */
	private $_imageUrl = 'http://127.0.0.1/static_maps_api/media/osm_logo_cc.png';
	
	/**
	 * draw point on map
	 *
	 * @param Map $map
	 */
	public function draw(Map $map)
	{
		//@todo implement puting an image given by url 
		//$ImageHandler = ImageHandler::createImageHandlerFromFileExtension($this->_imageUrl);
		$image = $map->getImage();
		$color = $this->_getDrawColor($image); 
		$point = $map->getPixelPointFromCoordinates($this->getLon(), $this->getLat());
		$vertices = array($point['x'], $point['y'],
			$point['x'] - 10, $point['y'] - 20, $point['x'] + 10, $point['y'] - 20);
		imagefilledpolygon ($map->getImage() , $vertices , 3, $color);
	}
}