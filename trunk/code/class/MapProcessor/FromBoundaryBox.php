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
	 * world map object
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
		}
		throw new NoMapProcessorException("No map processor exception");
	}
	
	public function __construct(MapRequest $mapData, TileSource $source) 
	{
		$this->_mapData = $mapData;
		$this->_tileSource= $source;
		$this->_worldMap = $source->getWorldMap($this->_mapData->getZoom());
	}
	
	/**
	 * create output map
	 *
	 * @return Map
	 */
	abstract public function createMap();
	
}