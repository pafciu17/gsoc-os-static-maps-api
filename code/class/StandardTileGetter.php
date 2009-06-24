<?php
class StandardTileGetter implements TileGetter 
{
	/**
	 * numbers of the tile
	 *
	 * @var array
	 */
	private $_tileData = array();
	
	
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
	
	public function __construct($tileSource, $x, $y, $zoom)
	{
		$this->_tileSource = $tileSource;
		$this->_tileData = array('x' => $x, 'y' => $y, 'zoom' => $zoom);
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
		$this->_tile = $this->_tileSource->getTile($this->_tileData['x'], $this->_tileData['y'], $this->_tileData['zoom']);
		$this->_isLoaded = true;
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