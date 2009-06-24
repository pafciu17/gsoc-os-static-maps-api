<?php
class TilesGetter
{
	/**
	 * left up tile numbers
	 *
	 * @var array
	 */
	private $_leftUpTileNumbers;
	
	/**
	 * right down tile numbers
	 *
	 * @var array
	 */
	private $_rightDownTileNumbers;
	
	/**
	 * tile source
	 *
	 * @var TileSource
	 */
	private $_tileSource;
	
	/**
	 * the world map object which is used to establish zoom of tiles
	 *
	 * @var WorldMap
	 */
	private $_worldMap;
	
	/**
	 * tile getters objects
	 *
	 * @var array
	 */
	private $_tileGetters = array();
	
	public function __construct($leftUpTileNumbers, $rightDownTileNumbers, $tileSource, $worldMap)
	{
		$this->_leftUpTileNumbers = $leftUpTileNumbers;
		$this->_rightDownTileNumbers = $rightDownTileNumbers;
		$this->_tileSource = $tileSource;
		$this->_worldMap = $worldMap;
		$this->_createTileGettersTable();
	}
	
	private function _createTileGettersTable()
	{
		for($y = $this->_leftUpTileNumbers['y']; $y <= $this->_rightDownTileNumbers['y']; $y++) {
			$row = array();
			$x = $this->_leftUpTileNumbers['x'];
			while (true) {
				$tileGetter = new StandardTileGetter($this->_tileSource, $x, $y, $this->_worldMap->getZoom());
				$row[] = $tileGetter;
				if ($x == $this->_rightDownTileNumbers['x']) {
					break;
				}
				$x++;
			}
			$this->_tileGetters[] = $row;
		}
	}
	
	public function startLoading()
	{
		foreach ($this->_tileGetters as $row) {
			foreach ($row as $tileGetters) {
				$tileGetters->start();
			}
		}
	}
	
	public function isLoaded()
	{
		$result = false;
		foreach ($this->_tileGetters as $row) {
			$result = true;
			foreach ($row as $tileGetters) {
				$result = $tileGetters->isLoaded() && $result;
			}

		}
		return $result;
	}
	
	public function getTiles()
	{
		$tiles = array();
		foreach ($this->_tileGetters as $row) {
			$newRow = array();
			foreach ($row as $tileGetter) {
				$newRow[] = $tileGetter->getTile();
			}
			$tiles[] = $newRow;
		}
		return $tiles;
	}
}