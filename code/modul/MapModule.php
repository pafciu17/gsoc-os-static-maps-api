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
			$mapWithLogo = new LogoMap($map, $this->_conf);
			$mapWithLogo->setLogoLayout(LogoLayout::factoryFromUrl($mapRequest->getLogoLayoutName()));
			$mapWithLogo->send();
			die;
		} catch (NoMapProcessorException $e) {
			$map = new WrongRequestMap($this->_conf->get('wrong_map_request_file'));
			$map->send();
			die;
		} catch (WrongMapRequestDataException $e) {
			echo $e->getMessage();
			print_r($e);
			die;
			$map = new WrongRequestMap($this->_conf->get('wrong_map_request_file'));
			$map->send();
			die;
		}
		/*
		 header('Content-Type: image/png');
		 $img = imagecreatefrompng('http://tile.openstreetmap.org/12/2048/1362.png');

		 imagepng($img);*/
	}
}