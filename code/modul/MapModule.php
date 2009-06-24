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
		$line = new Line($point, $point2);
		$line2 = new Line($point2, $point3);
		$line3 = new Line($point3, $point4);
		$line4 = new Line($point4, $point);
		$line->draw($map);
		$line2->draw($map);
		$line3->draw($map);
		$line4->draw($map);
		$map->setImageHandler(new ImageHandlerPNG());
		$map->send();
		die;
		/*
		header('Content-Type: image/png');
		$img = imagecreatefrompng('http://tile.openstreetmap.org/12/2048/1362.png');
		
		imagepng($img);*/
	}
}