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

		$mapProcessor = MapProcessor::factory($mapRequest);
		// create map object
		$map = $mapProcessor->createMap();
		// send output image 
		$map->setImageHandler(new ImageHandlerPNG());
		$map->send();
		die;
		/*
		header('Content-Type: image/png');
		$img = imagecreatefrompng('http://tile.openstreetmap.org/12/2048/1362.png');
		
		imagepng($img);*/
	}
}