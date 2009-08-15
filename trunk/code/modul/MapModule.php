<?php
/**
 * creates the output map image
 *
 */
class MapModule extends Module
{

	private function _configure()
	{
		TileCache::$daysToRemember = $this->_conf->get('tile_cache_days_of_memory');
		TileCache::$numberOfFilesToDelete = $this->_conf->get('tile_cache_number_of_files_to_delete');
		TilesGetter::$limitOfTiles = $this->_conf->get('max_number_of_tiles_per_map');
		$defaultColor = new Color();
		$defaultColor->setColor($this->_conf->get('default_drawings_color'));
		DrawRequest::$defaultColor = $defaultColor;
		DrawRequest::$defaultThickness = new ParamThickness($this->_conf->get('default_path_thickness'));
		DrawRequest::$defaultTransparency = new ParamTransparency($this->_conf->get('default_drawings_transparency'));
		ParamPatternUrl::$patternMap = $this->_conf->get('pattern_point_image_map');
	}
	
	public function execute()
	{
		$this->_configure();
		try {
			$mapRequest = new MapRequest($this->_get);
			$leftUpCorner = $mapRequest->getLeftUpCornerPoint();
			$rightDownCorner = $mapRequest->getRightDownCornerPoint();
			$mapProcessor = MapProcessor::factory($mapRequest);
			// create map object
			$bboxRespons = BboxRespons::factory($mapRequest->getBboxReturnType());
			$mapProcessor->getTileSource()->useImages($bboxRespons == null);
			$map = $mapProcessor->createMap($bboxRespons);
			if ($bboxRespons != null) {
				$bboxRespons->setData($map);
				$bboxRespons->send();
				die;
			}
			
			$map->setImageHandler(ImageHandler::factory($mapRequest->getImageType()));
			$drawHandle = new DrawHandle($map);
			$drawRequest = new DrawRequest($mapRequest);
			$drawHandle->draw($drawRequest);
	
			$mapWithLogo = new LogoMap($map, $this->_conf);
			$mapWithLogo->setLogoLayout(LogoLayout::factoryFromUrl($mapRequest->getLogoLayoutName()));
			
			$scaleBar = new ScaleBar($mapWithLogo, $this->_conf);
			$scaleBar->setUnit($mapRequest->getScaleBarUnit());
			$scaleBar->putOnMap(ScaleBarLayout::factoryFromUrl($mapRequest->getScaleBarLayoutName()));
			
			// send output image
			$mapWithLogo->send();
			die;
		} catch (NoMapProcessorException $e) {
			$map = new WrongRequestMap($this->_conf->get('wrong_map_request_file'));
			$map->send();
			die;
		} catch (WrongMapRequestDataException $e) {
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