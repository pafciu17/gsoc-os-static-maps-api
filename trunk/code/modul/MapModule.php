<?php
/**
 * creates the output map image
 *
 */
class MapModule extends Module
{

	public function execute()
	{

		try {
			$mapRequest = new MapRequest($this->_get);
			$leftUpCorner = $mapRequest->getLeftUpCornerPoint();
			$rightDownCorner = $mapRequest->getRightDownCornerPoint();
			$mapProcessor = MapProcessor::factory($mapRequest);
			// create map object
			$map = $mapProcessor->createMap();
			// send output image


			$map->setImageHandler(ImageHandler::factory($mapRequest->getImageType()));
			$drawHandle = new DrawHandle($map);
			$drawRequest = new DrawRequest($mapRequest);
			$drawRequest->setDefaultColor($this->_conf->get('default_drawnings_color'));
			$drawHandle->draw($drawRequest);
			$map->send();
			die;
		} catch (NoMapProcessorException $e) {
			echo 'Map cannot be created from given attributes';
		}
		/*
		 header('Content-Type: image/png');
		 $img = imagecreatefrompng('http://tile.openstreetmap.org/12/2048/1362.png');

		 imagepng($img);*/
	}
}