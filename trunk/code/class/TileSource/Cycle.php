<?php

class TileSourceCycle extends TileSource
{

	/**
	 * tilesource configuration
	 *
	 * @var array
	 */
	protected $_configuration = array('tileWidth' => 256, 'tileHeight' => 256,
		'sourceUrl' => 'http://andy.sandbox.cloudmade.com/tiles/cycle', 'minZoom' => 0, 'maxZoom' => 18);

	public function __construct()
	{
		$this->_imageHandler = new ImageHandlerPNG();
		$this->_tileCache = new TileCache('./dynamic/cycle', 5000000, $this->_imageHandler);
	}

	/**
	 * get world map
	 *
	 * @param int $zoom
	 * @return WorldMap
	 */
	public function getWorldMap($zoom)
	{
		return new WorldMapStandardMercator($zoom, $this);
	}
}