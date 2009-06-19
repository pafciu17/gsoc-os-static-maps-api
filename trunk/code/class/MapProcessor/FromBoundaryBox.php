<?php
class NoMapProcessorException extends Exception 
{
}

/**
 * define infterface for map processor, it creates output map
 *
 */
class MapProcessorFromBoundaryBox extends MapProcessor 
{
	
	/**
	 * create temporary map which is made of all tiles which have been load
	 *
	 * @return Map
	 */
	public function _createTemporaryMap()
	{
		$this->_worldMap = $this->_getProperWorldMap();
		$leftUpTileNumbers = $this->_getLeftUpTileNumbers();
		$rightDownTileNumbers = $this->_getRightDownTileNumbers();
		$tiles = $this->_getTiles($leftUpTileNumbers, $rightDownTileNumbers);
		return $this->_concatenateTiles($tiles);
	}
	
	/**
	 * return proper world map object
	 *
	 * @return map
	 */
	private function _getProperWorldMap()
	{
		$leftUpCorner = $this->_mapData->getLeftUpCornerPoint();
		$rightDownCorner = $this->_mapData->getRightDownCornerPoint();
		if (!is_null($this->_mapData->getWidth())) {
			return $this->_worldMap->createProperWorldFromWidth($leftUpCorner['lon'], $rightDownCorner['lon'], $this->_mapData->getWidth());
		} else if (!is_null($this->_mapData->getHeight())) {
			return $this->_worldMap->createProperWordlFromHeight($leftUpCorner['lat'], $rightDownCorner['lat'], $this->_mapData->getHeight());
		}
		return $this->_worldMap;
	}
	
	/**
	 * get numbers of the most to top and to left tile
	 *
	 * @return array
	 */
	private function _getLeftUpTileNumbers()
	{
		$leftUpCorner = $this->_mapData->getLeftUpCornerPoint();
		return $this->_tileSource->getTileNumbersFromCoordinates($leftUpCorner['lon'], $leftUpCorner['lat'], $this->_mapData->getZoom());
	}
	
	/**
	 * get numbers of the most to down and to left tile
	 *
	 * @return array
	 */
	private function _getRightDownTileNumbers()
	{
		$rightDownPointInPixels = $this->_mapData->getRightDownCornerPoint();
		return $this->_tileSource->getTileNumbersFromCoordinates($rightDownPointInPixels['lon'], $rightDownPointInPixels['lat'], $this->_mapData->getZoom());
	}
	
	
	/**
	 * create output map from the temoporary one
	 *
	 * @param Map $map
	 */
	private function _prepareOutputMap($map)
	{
		$image = $map->getImage();
		$leftUpBigMap = $map->getLeftUpCorner();
		$leftUpBigMapInPixels = $this->_worldMap->getPixelXY($leftUpBigMap['lon'], $leftUpBigMap['lat']);
		$centerPoint = $this->_mapData->getCenterPoint();
		$centerPointInPixels = $this->_worldMap->getPixelXY($centerPoint['lon'], $centerPoint['lat']);
		$leftUpPointInPixels = array('x' => $centerPointInPixels['x'] - round($this->_mapData->getWidth() / 2),
		'y' => $centerPointInPixels['y'] - round($this->_mapData->getHeight() / 2));
		$outputMapLeftUpInPixels = array('x' => $leftUpPointInPixels['x'] - $leftUpBigMapInPixels['x'],
		'y' => $leftUpPointInPixels['y'] - $leftUpBigMapInPixels['y']);
		
		
		$resultMap = new Map($this->_createResultMapImage($image, $outputMapLeftUpInPixels['x'],
		$outputMapLeftUpInPixels['y'], $this->_mapData->getWidth(), $this->_mapData->getHeight()));
		$resultMap->setLeftUpCorner($this->_worldMap->getLon($leftUpPointInPixels['x']),
		$this->_worldMap->getLat($leftUpPointInPixels['y']));
		$resultMap->setWorldMap($this->_worldMap);
		return $resultMap;
	}
	
	/**
	 * create result image from given temporary image
	 *
	 * @param resource $image
	 * @param int $leftUpX x-coordinate of the left up corner of the new image
	 * @param int $leftUpY y-coordinate of the left up corner of the new image
	 * @param int $width width of the new image
	 * @param int $height of the new image
	 * @return resource
	 */
	protected function _createResultMapImage($image, $leftUpX, $leftUpY, $width, $height)
	{	
		$newImage = $this->_tileSource->getImageHandler()->createImage($width, $height);
		imagecopy($newImage, $image, 0, 0, $leftUpX, $leftUpY, 
		$width, $height);
		return $newImage;
	}

}