<?php

class TileSourceMapnik extends TileSource
{

	/**
	 * tilesource configuration
	 *
	 * @var array
	 */
	protected $_configuration = array('tileWidth' => 256, 'tileHeight' => 256,
		'sourceUrl' => 'http://tile.openstreetmap.org');

	public function __construct()
	{
		$this->_imageHandler = new ImageHandlerPNG();
	}

	/**
	 * get world map
	 *
	 * @param int $zoom
	 * @return WorldMap
	 */
	public function getWorldMap($zoom)
	{
		return new StandardMercatorWorldMap($zoom, $this);
	}
}