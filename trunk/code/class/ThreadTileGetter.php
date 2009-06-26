<?php
class ThreadTileGetter extends ZendX_Console_Process_Unix  implements TileGetter
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
		parent::__construct();
		$this->_tileSource = $tileSource;
		$this->_worldMap = $worldMap;
		$this->_tileNumbers = array('x' => $x, 'y' => $y);
	}
	
	protected function _run()
	{
		$this->_tile = $this->_tileSource->getTile($this->_tileNumbers['x'], $this->_tileNumbers['y'], $this->_worldMap->getZoom());
		$this->_isLoaded = true;
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
	 * return tile
	 *
	 * @return Tile
	 */
	public function getTile()
	{
		return $this->_tile;	
	}
}