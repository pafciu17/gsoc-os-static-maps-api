<?php
/**
 * implements creating output map from center point
 *
 */
class MapProcessorFromCenterPoint extends MapProcessor 
{
	/**
	 * return x-number and y-number of the most to the up and to the right tile
	 *
	 * @return array
	 */
	protected function _getRightDownTileNumbers()
	{
		$centerPoint = $this->_mapData->getCenterPoint();
		$centerPointInPixels = $this->_worldMap->getPixelXY($centerPoint['lon'], $centerPoint['lat']);
		$rightDownPointInPixels = array('x' => $centerPointInPixels['x'] + round($this->_mapData->getWidth() / 2),
		'y' => $centerPointInPixels['y'] + round($this->_mapData->getHeight() / 2));
		$lon = $this->_worldMap->getLon($rightDownPointInPixels['x']);
		$lat = $this->_worldMap->getLat($rightDownPointInPixels['y']);
		return $this->_tileSource->getTileNumbersFromCoordinates($lon, $lat, $this->_mapData->getZoom());
	}
	
	/**
	 * return x-number and y-number of the most to the left to the up tile
	 *
	 * @return array
	 */
	protected function _getLeftUpTileNumbers()
	{
		$centerPoint = $this->_mapData->getCenterPoint();
		$centerPointInPixels = $this->_worldMap->getPixelXY($centerPoint['lon'], $centerPoint['lat']);
		$leftUpPointInPixels = array('x' => $centerPointInPixels['x'] - round($this->_mapData->getWidth() / 2),
		'y' => $centerPointInPixels['y'] - round($this->_mapData->getHeight() / 2));
		$lon = $this->_worldMap->getLon($leftUpPointInPixels['x']);
		$lat = $this->_worldMap->getLat($leftUpPointInPixels['y']);
		return $this->_tileSource->getTileNumbersFromCoordinates($lon, $lat, $this->_mapData->getZoom());
	}
	
	/**
	 * get pixel coordinates for cuting result map from temporary one
	 *
	 * @return array coordinates of the left up corner
	 */
	protected function _getLeftUpCornerForCutingResultMap(Map $map) 
	{
		$leftUpBigMap = $map->getLeftUpCorner();
		$leftUpBigMapInPixels = $this->_worldMap->getPixelXY($leftUpBigMap['lon'], $leftUpBigMap['lat']);
		$centerPoint = $this->_mapData->getCenterPoint();
		$centerPointInPixels = $this->_worldMap->getPixelXY($centerPoint['lon'], $centerPoint['lat']);
		$leftUpPointInPixels = array('x' => $centerPointInPixels['x'] - round($this->_mapData->getWidth() / 2),
		'y' => $centerPointInPixels['y'] - round($this->_mapData->getHeight() / 2));
		return array('x' => $leftUpPointInPixels['x'] - $leftUpBigMapInPixels['x'],
		'y' => $leftUpPointInPixels['y'] - $leftUpBigMapInPixels['y']);
	}
	
	/**
	 * it sets coordinates of the left up corner of the result map
	 * 
	 * @param Map $resultMap
	 */
	protected function _setUpResultMapLeftUpCornerPoint(Map $resultMap)
	{
		$centerPoint = $this->_mapData->getCenterPoint();
		$centerPointInPixels = $this->_worldMap->getPixelXY($centerPoint['lon'], $centerPoint['lat']);
		$leftUpPointInPixels = array('x' => $centerPointInPixels['x'] - round($this->_mapData->getWidth() / 2),
		'y' => $centerPointInPixels['y'] - round($this->_mapData->getHeight() / 2));
		$resultMap->setLeftUpCorner($this->_worldMap->getLon($leftUpPointInPixels['x']),
		$this->_worldMap->getLat($leftUpPointInPixels['y']));	
	}
	
}