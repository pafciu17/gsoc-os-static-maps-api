<?php
/**
 * creates the output map image
 *
 */
class MapModule extends Module
{

	public function execute()
	{
		$mapRequest = new MapRequest($this->_get);
		
		$leftUpCorner = $mapRequest->getLeftUpCornerPoint();
		$rightDownCorner = $mapRequest->getRightDownCornerPoint();
		$mapProcessor = MapProcessor::factory($mapRequest);
		// create map object
		$map = $mapProcessor->createMap();
		// send output image 

		$point = new Point($leftUpCorner['lon'], $leftUpCorner['lat']);
		$point2 = new Point($rightDownCorner['lon'], $leftUpCorner['lat']);
		$point3 = new Point($rightDownCorner['lon'], $rightDownCorner['lat']);
		$point4 = new Point($leftUpCorner['lon'], $rightDownCorner['lat']);
		$point5 = new MarkPoint(0, 51.5);
		$point5->draw($map);
		$point6 = new MarkPoint(2.333, 48.83);
		$point6->draw($map);
		$point7 = new MarkPoint(-0.33, 39.5);
		$point7->draw($map);

		$map->setImageHandler(new ImageHandlerPNG());
		$map->send();
		die;
		/*
		header('Content-Type: image/png');
		$img = imagecreatefrompng('http://tile.openstreetmap.org/12/2048/1362.png');
		
		imagepng($img);*/
	}
}