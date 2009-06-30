<?php
/**
 * creates map from boundary box
 *
 */
abstract class MapProcessorFromBoundaryBox extends MapProcessor
{
	protected function _prepareData()
	{
		
	}
	
	/**
	 * prepare object to create output map
	 *
	 */
	protected function _prepareToCreateMap()
	{
		$rightDownCorner = $this->_mapData->getRightDownCornerPoint();
		$leftUpCorner = $this->_mapData->getLeftUpCornerPoint();
		while ($rightDownCorner['lon'] <= $leftUpCorner['lon']) {
			$rightDownCorner['lon'] += 360;
		}
		$this->_mapData->setRightDownCornerPoint($rightDownCorner);
		$this->_setUpSizeOfTheResultMap();
		parent::_prepareToCreateMap();
	}
	
	protected function _setUpSizeOfTheResultMap()
	{
		$point = $this->_mapData->getLeftUpCornerPoint();
		$point2 = $this->_mapData->getRightDownCornerPoint();
		$distance = $this->_worldMap->getPixelDistance($point['lon'], $point['lat'], $point2['lon'], $point2['lat']);
		$this->_mapData->setHeight($distance['y']);
		$this->_mapData->setWidth($distance['x']);
	}
	
	/**
	 * get pixel coordinates for cuting result map from temporary one
	 *
	 * @return array coordinates of the left up corner
	 */
	protected function _getLeftUpCornerForCutingResultMap(Map $map)
	{
		$leftUpCornerOfTemporaryMap = $map->getLeftUpCorner();
		$leftUpCornerOfTemporaryMapInPixels = $this->_worldMap->getPixelXY($leftUpCornerOfTemporaryMap['lon'], 
		$leftUpCornerOfTemporaryMap['lat']);
		$leftUpCornerOfResultMap = $this->_mapData->getLeftUpCornerPoint();
		$leftUpCornerOfResultMapInPixels = $this->_worldMap->getPixelXY($leftUpCornerOfResultMap['lon'],
		$leftUpCornerOfResultMap['lat']);
		return array('x' => $leftUpCornerOfResultMapInPixels['x'] - $leftUpCornerOfTemporaryMapInPixels['x'],
		'y' => $leftUpCornerOfResultMapInPixels['y'] - $leftUpCornerOfTemporaryMapInPixels['y']);
	}
	
	/**
	 * it sets coordinates of the left up corner of the result map
	 * 
	 * @param Map $resultMap
	 */
	protected function _setUpResultMapLeftUpCornerPoint(Map $resultMap)
	{
		$leftUpCorner = $this->_mapData->getLeftUpCornerPoint();
		$resultMap->setLeftUpCorner($leftUpCorner['lon'], $leftUpCorner['lat']);
	}
	
	/**
	 * return coordinates of the right down corner of the map
	 *
	 * @return array
	 */
	protected function _getRightDownPoint()
	{
		return $this->_mapData->getRightDownCornerPoint();
	}
	
	/**
	 * return coordinates of the right up corner of the map
	 *
	 * @return array
	 */
	protected function _getLeftUpPoint()
	{
		return $this->_mapData->getLeftUpCornerPoint();
	}
}
?>