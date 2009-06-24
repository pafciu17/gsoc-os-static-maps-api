<?php

class TileSourceMapnik extends TileSource
{

	/**
	 * tilesource configuration
	 *
	 * @var array
	 */
	protected $_configuration = array('tileWidth' => 256, 'tileHeight' => 256,
		'sourceUrl' => 'http://tile.openstreetmap.org', 'minZoom' => 0, 'maxZoom' => 18);

	public function __construct()
	{
		$this->_imageHandler = new ImageHandlerPNG();
		$this->_tileCache = new TileCache('./dynamic/mapnik', 10, $this->_imageHandler);
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