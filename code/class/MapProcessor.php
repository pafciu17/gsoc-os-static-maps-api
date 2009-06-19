<?php
class NoMapProcessorException extends Exception 
{
}

/**
 * define infterface for map processor, it creates output map
 *
 */
abstract class MapProcessor
{
	/**
	 * tile source
	 *
	 * @var TileSource
	 */
	protected $_tileSource;
	
	/**
	 * request mapa data
	 *
	 * @var MapRequest
	 */
	protected $_mapData;
	
	/**
	 * world map object, map zoom should be taken from that object
	 * 
	 * @var WorldMap
	 */
	protected $_worldMap;
	
	/**
	 * create appropriate MapProcessor
	 *
	 * @param MapRequest $mapData
	 * @return MapProcessor
	 */
	static public function factory(MapRequest $mapData)
	{
		if (!is_null($mapData->getCenterPoint()) && !is_null($mapData->getWidth()) && !is_null($mapData->getHeight())) {
			return new MapProcessorFromCenterPoint($mapData, TileSource::factory($mapData->getType()));
		} else if (!is_null($mapData->getLeftUpCornerPoint()) && !is_null($mapData->getRightDownCornerPoint()) && !is_null($mapData->getHeight())
		&& !is_null($mapData->getWidth())) {
			return new MapProcessorFromBoundaryBox($mapData, TileSource::factory($mapData->getType()));
		}
		throw new NoMapProcessorException("No map processor has been choosen");
	}
	
	public function __construct(MapRequest $mapData, TileSource $source) 
	{
		$this->_mapData = $mapData;
		$this->_tileSource= $source;
		$this->_worldMap = $source->getWorldMap($this->_mapData->getZoom());
	}
	
	/**
	 * load all tiles from given range
	 *
	 * @param array $leftUpTilesNumber
	 * @param array $rightDownTilesNumber
	 * @return array
	 */
	protected function _getTiles($leftUpTilesNumber, $rightDownTilesNumber)
	{
		$tiles = array();
		for($y = $leftUpTilesNumber['y']; $y <= $rightDownTilesNumber['y']; $y++) {
			$row = array();
			for ($x = $leftUpTilesNumber['x']; $x <= $rightDownTilesNumber['x']; $x++) {
				$row[] = $this->_tileSource->getTile($x, $y, $this->_worldMap->getZoom());
			}
			$tiles[] = $row;
		}
		return $tiles;
	}
	
	/**
	 * create output map
	 *
	 * @return Map
	 */
	public function createMap()
	{
		$this->_prepareToCreateMap();
		return $this->_prepareOutputMap($this->_createTemporaryMap());
	}
	
	/**
	 * prepare object to create output map
	 *
	 */
	protected function _prepareToCreateMap()
	{
		
	}
	
	/**
	 * concatenate tiles to one map
	 *
	 * @param array $tiles
	 * @return Map
	 */
	protected function _concatenateTiles($tiles)
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
		$outputMapLeftUpInPixels = $this->_getLeftUpCornerForCutingResultMap($map);
		$resultMap = new Map($this->_createResultMapImage($image, $outputMapLeftUpInPixels['x'],
		$outputMapLeftUpInPixels['y'], $this->_mapData->getWidth(), $this->_mapData->getHeight()));
		$this->_setUpResultMapLeftUpCornerPoint($resultMap);
		$resultMap->setWorldMap($this->_worldMap);
		return $resultMap;
	}
	
	/**
	 * create temporary map which is made of all load tiles
	 *
	 * @return Map
	 */
	protected function _createTemporaryMap()
	{
		$leftUpTileNumbers = $this->_getLeftUpTileNumbers();
		$rightDownTileNumbers = $this->_getRightDownTileNumbers();
		$tiles = $this->_getTiles($leftUpTileNumbers, $rightDownTileNumbers);
		return $this->_concatenateTiles($tiles);
	}
	
	/**
	 * return x-number and y-number of the most to the up and to the right tile
	 *
	 * @return array
	 */
	abstract protected function _getRightDownTileNumbers();
	
	/**
	 * return x-number and y-number of the most to the left to the up tile
	 *
	 * @return array
	 */
	abstract protected function _getLeftUpTileNumbers();
	
	/**
	 * get pixel coordinates for cuting result map from temporary one
	 *
	 * @return array coordinates of the left up corner
	 */
	abstract protected function _getLeftUpCornerForCutingResultMap(Map $map);
	
	/**
	 * it sets coordinates of the left up corner of the result map
	 * 
	 * @param Map $resultMap
	 */
	abstract protected function _setUpResultMapLeftUpCornerPoint(Map $resultMap);
	
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