<?php
/**
 * implements creating output map from center point
 *
 */
class MapProcessorFromCenterPoint extends MapProcessor 
{
	
	public function __construct(MapRequest $mapData, TileSource $source) 
	{
		$this->_requestValidator = new RequestValidatorFromCenterPoint($mapData, $source);
		parent::__construct($mapData, $source);
	}
	
	/**
	 * return coordinates of the right down corner of the map
	 *
	 * @return array
	 */
	protected function _getRightDownPoint()
	{
		$centerPoint = $this->_mapData->getCenterPoint();
		$centerPointInPixels = $this->_worldMap->getPixelXY($centerPoint['lon'], $centerPoint['lat']);
		$rightDownPointInPixels = array('x' => $centerPointInPixels['x'] + round($this->_mapData->getWidth() / 2),
		'y' => $centerPointInPixels['y'] + round($this->_mapData->getHeight() / 2));
		$lon = $this->_worldMap->getLon($rightDownPointInPixels['x']);
		$lat = $this->_worldMap->getLat($rightDownPointInPixels['y']);
		return array('lon' => $lon, 'lat' => $lat);
	}
	
	/**
	 * return coordinates of the right up corner of the map
	 *
	 * @return array
	 */
	protected function _getLeftUpPoint()
	{
		$centerPoint = $this->_mapData->getCenterPoint();
		$centerPointInPixels = $this->_worldMap->getPixelXY($centerPoint['lon'], $centerPoint['lat']);
		$leftUpPointInPixels = array('x' => $centerPointInPixels['x'] - round($this->_mapData->getWidth() / 2),
		'y' => $centerPointInPixels['y'] - round($this->_mapData->getHeight() / 2));
		$lon = $this->_worldMap->getLon($leftUpPointInPixels['x']);
		$lat = $this->_worldMap->getLat($leftUpPointInPixels['y']);
		return array('lon' => $lon, 'lat' => $lat);
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
		$result = array('x' => $leftUpPointInPixels['x'] - $leftUpBigMapInPixels['x'],
		'y' => $leftUpPointInPixels['y'] - $leftUpBigMapInPixels['y']);
		return $result;
	}
	
	/**
	 * it sets coordinates of the left up and right down corners of the result map
	 * 
	 * @param Map $resultMap
	 */
	protected function _setUpResultMapCorners(Map $resultMap)
	{
		$centerPoint = $this->_mapData->getCenterPoint();
		$centerPointInPixels = $this->_worldMap->getPixelXY($centerPoint['lon'], $centerPoint['lat']);
		$leftUpPointInPixels = array('x' => $centerPointInPixels['x'] - round($this->_mapData->getWidth() / 2),
		'y' => $centerPointInPixels['y'] - round($this->_mapData->getHeight() / 2));
		$resultMap->setLeftUpCorner($this->_worldMap->getLon($leftUpPointInPixels['x']),
		$this->_worldMap->getLat($leftUpPointInPixels['y']));	
		$rightDownPointInPixels = array('x' => $centerPointInPixels['x'] + round($this->_mapData->getWidth() / 2),
		'y' => $centerPointInPixels['y'] + round($this->_mapData->getHeight() / 2));
		$resultMap->setRightDownCorner($this->_worldMap->getLon($rightDownPointInPixels['x']),
		$this->_worldMap->getLat($rightDownPointInPixels['y']));
	}
	
}