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
	 * object which valid request map data
	 *
	 * @var RequestValidator
	 */
	protected $_requestValidator;
	
	/**
	 * create appropriate MapProcessor
	 *
	 * @param MapRequest $mapData
	 * @return MapProcessor
	 */
	static public function factory(MapRequest $mapData)
	{
		$tileSource = new TileSource(DatabaseServer::getServer($mapData->getType()));
		if ($mapData->getBboxReturnType()) {
			$tileSource->loadTileImages($map->data);
		}
		$tileSource->useCache(!$mapData->issetReloadParam());
		if (!is_null($mapData->getCenterPoint()) && !is_null($mapData->getWidth()) && !is_null($mapData->getHeight())) {
			return new MapProcessorFromCenterPoint($mapData, $tileSource);
		} else if (!is_null($mapData->getLeftUpCornerPoint()) && !is_null($mapData->getRightDownCornerPoint()) && !is_null($mapData->getZoom())) {
			return new MapProcessorFromBoundaryBoxZoom($mapData, $tileSource);
		} else if (!is_null($mapData->getLeftUpCornerPoint()) && !is_null($mapData->getRightDownCornerPoint())) {
			return new MapProcessorFromBoundaryBoxWidthHeight($mapData, $tileSource);
		}
		throw new NoMapProcessorException("No map processor has been choosen");
	}
	
	public function __construct(MapRequest $mapData, TileSource $source) 
	{
		$this->_mapData = $mapData;
		$this->_tileSource= $source;
		if (!is_null($this->_mapData->getZoom())) {
			$this->_worldMap = $source->getWorldMap($this->_mapData->getZoom());
		}
		$this->_requestValidator->check();
	}
	
	/**
	 * load all tiles
	 *
	 * @param array $leftUpCorner
	 * @param array $rightDownCorner
	 * @return array
	 */
	protected function _getTiles($leftUpCorner, $rightDownCorner)
	{
		$tiles = array();
		$leftUpTilesNumber = $this->_tileSource->getTileNumbersFromCoordinates($leftUpCorner['lon'],
		$leftUpCorner['lat'], $this->_worldMap->getZoom());
		$rightDownTilesNumber = $this->_tileSource->getTileNumbersFromCoordinates($rightDownCorner['lon'],
		$rightDownCorner['lat'], $this->_worldMap->getZoom());
		$tilesGetter = new TilesGetter($leftUpTilesNumber, $rightDownTilesNumber, $this->_tileSource, $this->_worldMap);
		$tilesGetter->startLoading();
		while(!$tilesGetter->isLoaded()) {//wating for finishing loading
		}
		return $tilesGetter->getTiles();

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
	 * prepare object to create output map, validate map data
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
		$map->setImageHandler($this->_tileSource->getImageHandler());
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
		$this->_setUpResultMapCorners($resultMap);
		$resultMap->setWorldMap($this->_worldMap);
		$resultMap->setImageHandler($this->_tileSource->getImageHandler());
		return $resultMap;
	}
	
	/**
	 * create temporary map which is made of all load tiles
	 *
	 * @return Map
	 */
	protected function _createTemporaryMap()
	{
		$tiles = $this->_getTiles($this->_getLeftUpPoint(), $this->_getRightDownPoint());
		return $this->_concatenateTiles($tiles);
	}
	
	/**
	 * return coordinates of the right down corner of the map
	 *
	 * @return array
	 */
	abstract protected function _getRightDownPoint();
	
	/**
	 * return coordinates of the right up corner of the map
	 *
	 * @return array
	 */
	abstract protected function _getLeftUpPoint();
	
	/**
	 * get pixel coordinates for cuting result map from temporary one
	 *
	 * @return array coordinates of the left up corner
	 */
	abstract protected function _getLeftUpCornerForCutingResultMap(Map $map);
	
	/**
	 * it sets coordinates of the left up and right down corners of the result map
	 * 
	 * @param Map $resultMap
	 */
	abstract protected function _setUpResultMapCorners(Map $resultMap);
	
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
		if ($leftUpY < 0) {
			$height += $leftUpY;
			$leftUpY = 0;
		}
		$imageWidth = imagesx($image);
		$imageHeight = imagesy($image);
		if ($leftUpY + $height > $imageHeight) {
			$height = $imageHeight - $leftUpY;
		}
		$newImage = $this->_tileSource->getImageHandler()->createImage($width, $height);
		imagecopy($newImage, $image, 0, 0, $leftUpX, $leftUpY, 
		$width, $height);
		return $newImage;
	}
	
}