<?php

class TileSourceOsmrender extends TileSource
{

	/**
	 * tilesource configuration
	 *
	 * @var array
	 */
	protected $_configuration = array('tileWidth' => 256, 'tileHeight' => 256,
		'sourceUrl' => 'http://tah.openstreetmap.org/Tiles/tile', 'minZoom' => 0, 'maxZoom' => 17);

	public function __construct()
	{
		$this->_imageHandler = new ImageHandlerPNG();
		$this->_tileCache = new TileCache('./dynamic/osmrender', 1000000, $this->_imageHandler);
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