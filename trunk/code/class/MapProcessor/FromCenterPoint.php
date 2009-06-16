<?php
/**
 * implements creating output map from center point
 *
 */
class MapProcessorFromCenterPoint extends MapProcessor 
{
	
	/**
	 * center tile
	 *
	 * @var Tile
	 */
	private $_centerTile;
	
	/**
	 * temporary map, made of all tiles
	 *
	 * @var Map
	 */
	private $_temporaryMap;
	
	/**
	 * create output map
	 *
	 * @return Map
	 */
	public function createMap()
	{
		//@TODO implement it
		
		$centerPoint = $this->_mapData->getCenterPoint();
			
		$this->_centerTile = $this->_tileSource->getTileFromCoordinates($centerPoint['lon'],
		$centerPoint['lat'], $this->_mapData->getZoom());
		return $this->_prepareOutputMap($this->_createTemporaryMap());
		$worldMap = $this->_tileSource->getWorldMap($this->_mapData->getZoom());
		$temporaryMapLeftUpCoordinates = $this->_temporaryMap->getLeftUp();
		$temporaryMapLeftUpCoordinatesInPixels = $worldMap->getPixelXY($temporaryMapLeftUpCoordinates['lon'],
		$temporaryMapLeftUpCoordinates['lat']);
		$centerPointInPixels = $worldMap->getPixelXY($centerPoint['lon'], $centerPoint['lat']);
		$halfOfTheWidth = round($this->_mapData->getWidth() / 2);
		$halfOfTheHeight = round($this->_mapData->getHeight() / 2);
		$leftUp = array('x' => $centerPointInPixels['x'] - $temporaryMapLeftUpCoordinatesInPixels['x'] - $halfOfTheWidth,
			'y' => $centerPointInPixels['y'] - $temporaryMapLeftUpCoordinatesInPixels['y'] - $halfOfTheHeight);
		$rightDown = array('x' => $leftUp['x'] + $this->_mapData->getWidth(), 
			'y' => $leftUp['y'] + $this->_mapData->getHeight());
		print_r('leftUp and rightDown ' . $leftUp . ' ' . $rightDown);
	}
	
	/**
	 * create temporary map which is made of all tiles which have been load
	 *
	 * @return Map
	 */
	public function _createTemporaryMap()
	{
			
		$leftUpTileNumbers = $this->_getLeftUpTileNumbers();
		$rightDownTileNumbers = $this->_getRightDownTileNumbers();
		$tiles = $this->_getTiles($leftUpTileNumbers, $rightDownTileNumbers);

		return $this->_concatenateTiles($tiles);
	}
	
	/**
	 * get numbers of the most to top and to left tile
	 *
	 * @return array
	 */
	private function _getLeftUpTileNumbers()
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
	 * get numbers of the most to down and to left tile
	 *
	 * @return array
	 */
	private function _getRightDownTileNumbers()
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
	 * load all tiles from given range
	 *
	 * @param array $leftUpTilesNumber
	 * @param array $rightDownTilesNumber
	 * @return array
	 */
	private function _getTiles($leftUpTilesNumber, $rightDownTilesNumber)
	{
		$tiles = array();
		for($y = $leftUpTilesNumber['y']; $y <= $rightDownTilesNumber['y']; $y++) {
			$row = array();
			for ($x = $leftUpTilesNumber['x']; $x <= $rightDownTilesNumber['x']; $x++) {
				$row[] = $this->_tileSource->getTile($x, $y, $this->_mapData->getZoom());
			}
			$tiles[] = $row;
		}
		return $tiles;
	}
	
	/**
	 * concatenate tiles to one map
	 *
	 * @param array $tiles
	 * @return Map
	 */
	private function _concatenateTiles($tiles)
	{
		$height = count($tiles) * $this->_tileSource->getTileWidth();
		$width = count($tiles[0]) * $this->_tileSource->getTileHeight();
		$imageHandler = $this->_tileSource->getImageHandler();
		$mapImage = $imageHandler->createImage($width, $height);
		$y = 0;
		$firstTile = $tiles[0][0];
		foreach ($tiles as $rowKey => $row) {
			$x = 0;
			foreach ($row as $tileKey => $tile) {
				imagecopy($mapImage, $tile->getImage(), $x, $y, 0, 0, $this->_tileSource->getTileWidth(),
				$this->_tileSource->getTileHeight());
				$x += $this->_tileSource->getTileWidth();
			}
			$y += $this->_tileSource->getTileHeight();
		}
		$map = new Map($mapImage);

		$leftUp = $firstTile->getLeftUpCorner();
		$map->setLeftUpCorner($leftUp['lon'], $leftUp['lat']);
		$map->setWorldMap($this->_worldMap);
		return $map;
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
		$newImage = $this->_tileSource->getImageHandler()->createImage($this->_mapData->getWidth(),
		$this->_mapData->getHeight());
		imagecopy($newImage, $image, 0, 0, $outputMapLeftUpInPixels['x'], $outputMapLeftUpInPixels['y'], 
		$this->_mapData->getWidth(), $this->_mapData->getHeight());
		$resultMap = new Map($newImage);
		$resultMap->setLeftUpCorner($this->_worldMap->getLon($leftUpPointInPixels['x']),
		$this->_worldMap->getLat($leftUpPointInPixels['y']));
		$resultMap->setWorldMap($this->_worldMap);
		return $resultMap;
	}
	
	
}