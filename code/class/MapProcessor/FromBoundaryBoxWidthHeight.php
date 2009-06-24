<?php

/**
 * implements creating output map from boundary box with given width and height of the map
 *
 */
class MapProcessorFromBoundaryBoxWidthHeight extends MapProcessorFromBoundaryBox
{

	protected function _prepareData()
	{
		$leftUpCorner = $this->_mapData->getLeftUpCornerPoint();
		$rightDownCorner = $this->_mapData->getRightDownCornerPoint();
		if (!is_null($this->_mapData->getWidth()) || !is_null($this->_mapData->getHeight())) {
			for ($i = $this->_tileSource->getMinZoom() + 1; $i <= $this->_tileSource->getMaxZoom(); $i++) {
				$world = $this->_tileSource->getWorldMap($i);
				$distance = $world->getPixelDistance($leftUpCorner['lon'], $leftUpCorner['lat'],
				$rightDownCorner['lon'], $rightDownCorner['lat']);			
				if (!is_null($this->_mapData->getWidth()) && $distance['x'] >= $this->_mapData->getWidth()) {
					$this->_worldMap = $this->_tileSource->getWorldMap($i - 1);
					return;
				}
				if (!is_null($this->_mapData->getHeight()) && $distance['y'] >= $this->_mapData->getHeight()) {
					$this->_worldMap = $this->_tileSource->getWorldMap($i - 1);
					return;
				}
			}
			$this->_worldMap = $this->_tileSource->getWorldMap($this->_tileSource->getMaxZoom());
			return;
		}
		$this->_worldMap = $this->_tileSource->getWorldMap($this->_tileSource->getMinZoom());	
	}
	
	protected function _setUpSizeOfTheResultMap()
	{
		$this->_prepareData();
		$point = $this->_mapData->getLeftUpCornerPoint();
		$point2 = $this->_mapData->getRightDownCornerPoint();
		$leftUpInPixels = $this->_worldMap->getPixelXY($point['lon'], $point['lat']);
		$rightDownInPixels = $this->_worldMap->getPixelXY($point2['lon'], $point2['lat']);
		$distance = $this->_worldMap->getPixelDistance($point['lon'], $point['lat'], $point2['lon'], $point2['lat']);
		if ($distance['x'] >= $this->_mapData->getWidth()) {
			$this->_mapData->setWidth($distance['x']);
		} else {
			$dis = round(($this->_mapData->getWidth() - $distance['x']) / 2);
			$leftUpInPixels['x'] -= $dis;
			$rightDownInPixels['x'] += $dis;
			$point['lon'] = $this->_worldMap->getLon($leftUpInPixels['x']);
			$point2['lon'] = $this->_worldMap->getLon($rightDownInPixels['x']);
			$this->_mapData->setWidth($rightDownInPixels['x'] - $leftUpInPixels['x']);
		}
		if ($distance['y'] >= $this->_mapData->getHeight()) {
			$this->_mapData->setHeight($distance['y']);
		} else {
			$dis = round(($this->_mapData->getHeight() - $distance['y']) / 2);
			$leftUpInPixels['y'] -= $dis;
			$rightDownInPixels['y'] += $dis;
			$point['lat'] = $this->_worldMap->getLat($leftUpInPixels['y']);
			$point2['lat'] = $this->_worldMap->getLat($rightDownInPixels['y']);
			$this->_mapData->setHeight($rightDownInPixels['y'] - $leftUpInPixels['y']);
		}
		$this->_mapData->setLeftUpCornerPoint($point);
		$this->_mapData->setRightDownCornerPoint($point2);

		
	}
}