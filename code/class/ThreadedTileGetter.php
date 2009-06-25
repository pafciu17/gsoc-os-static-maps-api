<?php
class ThreadedTileGetter  implements TileGetter
{
	/**
	 * numbers of the tile
	 *
	 * @var array
	 */
	private $_tileNumbers = array();
	
	/**
	 * world map 
	 *
	 * @var WorldMap
	 */
	private $_worldMap;
	
	/**
	 * tile source from which tile will be loaded
	 *
	 * @var TileSource
	 */
	private $_tileSource;
	
	/**
	 * tile which has been loaded
	 *
	 * @var Tile
	 */
	private $_tile;
	
	/**
	 * it shows if tile has been already loaded
	 *
	 * @var unknown_type
	 */
	private $_isLoaded = false;
	
	public function __construct($tileSource, $x, $y, $worldMap)
	{
		$this->_tileSource = $tileSource;
		$this->_worldMap = $worldMap;
		$this->_tileNumbers = array('x' => $x, 'y' => $y);
	}
	
	/**
	 * checks if tile is loaded
	 *
	 * @return bool
	 */
	public function isLoaded()
	{
		return $this->_isLoaded;
	}
	
	/**
	 * it starts loading the tile image
	 *
	 */
	public function start()
	{
		$this->_tileSource->getTile($this->_tileNumbers['x'], $this->_tileNumbers['y'], $this->_worldMap->getZoom());
	}
	
	/**
	 * return tile
	 *
	 * @return Tile
	 */
	public function getTile()
	{
		return $this->_tile;	
	}
}