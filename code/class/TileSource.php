<?php
class TileSourceException extends Exception 
{
}

/**
 * it defines interface for tile source classes
 *
 */
class TileSource
{
	/**
	 * tilesource configuration
	 *
	 * @var array
	 */
	protected $_configuration = array();
	
	/**
	 * image handler for tiles
	 *
	 * @var ImageHandler
	 */
	protected $_imageHandler;
	
	/**
	 * cache for tiles
	 *
	 * @var TileCache
	 */
	protected $_tileCache;
	
	/**
	 * url server
	 *
	 * @var ServerUrl
	 */
	protected $_serverUrl;
	
	/**
	 * if it is set to false then all tiles are taken from server, and not from cache
	 *
	 * @var bool
	 */
	protected $_useCache = true;
	
	/**
	 * class map
	 *
	 * @var array
	 */
	static private $_classMap = array('mapnik' => 'TileSourceMapnik',
		'cycle' => 'TileSourceCycle',
		'osmrender' => 'TileSourceOsmrender');
	
	public function __construct(DatabaseServer $server)
	{
		$this->_configuration['tileWidth'] = $server->tileWidth;
		$this->_configuration['tileHeight'] = $server->tileHeight;
		$this->_configuration['minZoom'] = $server->minZoom;
		$this->_configuration['maxZoom'] = $server->maxZoom;
		$this->_configuration['cacheLimit'] = $server->cacheSize;
		$this->_configuration['name'] = $server->name;
		$this->_serverUrl = $server->getServerUrl();
		$this->_imageHandler = new ImageHandlerPNG();
		$this->_tileCache = new TileCache('./dynamic/' . $this->_configuration['name'], $this->_configuration['cacheLimit'] * 1048576, $this->_imageHandler);
	}
	
	/**
	 * is sets if tiles will be load also from tile cache
	 *
	 * @param bool $value
	 */
	public function useCache($value)
	{
		$this->_useCache = $value;
	}
	
	
	/**
	 * return image handler for tile source
	 *
	 * @return ImageHandler
	 */
	public function getImageHandler()
	{
		return $this->_imageHandler;
	}
	
	/**
	 * get map tile from its numbers
	 *
	 * @param int $x x number of the tile
	 * @param int $y y number of the tile
	 * @param int $zoom map zoom
	 * @return Tile
	 */
	public function getTile($x, $y, $zoom)
	{
		$tx = $x;
		$ty = $y;
		$this->_validateTileNumbers($tx, $ty, $zoom);
		if ($this->_useCache && $this->_tileCache->hasTile($tx, $ty, $zoom)) {//if tile image is in cache, take it from there
			$image = $this->_tileCache->getTile($tx, $ty, $zoom);
			$tile = new Tile($image);
		} else {
			$image = $this->_loadImage($this->_createUrl($tx, $ty, $zoom));
			if ($image === false) {//when loading an image failed
				$tile = new EmptyTile($this->getTileWidth(), $this->getTileHeight(), $this->_imageHandler);
			} else {
				$this->_tileCache->addTile($image, $tx, $ty, $zoom);
				$tile = new Tile($image);
			}
		}
		$tile->setWorldMap($this->getWorldMap($zoom));
		$tile->setTileData($x, $y, $zoom);
		$tile->setImageHandler($this->_imageHandler);
		return $tile;
	}

	/**
	 * load image
	 *
	 * @param string $url
	 * @return resource or false in case of error
	 */
	protected function _loadImage($url)
	{
		return $this->_imageHandler->loadImage($url);
	}
	
	/**
	 * create tile load url
	 *
	 * @param int $x tile x number
	 * @param int $y tile y number
	 * @param int $zoom zoom of the map
	 * @return string
	 */
	protected function _createUrl($x, $y, $zoom)
	{
		$this->_validateTileNumbers($x, $y, $zoom);
		return $this->_serverUrl->getUrl($zoom, $x, $y);
	}
	
	
	/**
	 * corrects numbers of tiles
	 *
	 * @param int $x x-coordinate of the tile
	 * @param int $y y-coordinate of the tile
	 * @param int $zoom zoom
	 */
	protected function _validateTileNumbers(&$x, &$y, $zoom)
	{
		if ($x >= $this->getWidthInTiles($zoom)) {
			$x = bcmod($x, $this->getWidthInTiles($zoom));
		} else if ($x < 0) {
			$x = bcmod(bcmod($x, $this->getWidthInTiles($zoom)) + $this->getWidthInTiles($zoom), $this->getWidthInTiles($zoom));
		}
	}

	/**
	 * get tile in which lies given point
	 *
	 * @param float $lon longitude of the point
	 * @param float $lat latitude of the point
	 * @param int $zoom map zoom
	 * @return Tile
	 */
	public function getTileNumbersFromCoordinates($lon, $lat, $zoom)
	{
		$x = floor((($lon + 180) / 360) * pow(2, $zoom));
		$y = floor((1 - log(tan($lat * pi()/180) + 1 / cos($lat* pi()/180)) / pi()) /2 * pow(2, $zoom));
		return array('x' => $x, 'y' => $y);
	}

	
	/**
	 * get tile in which lies given point
	 *
	 * @param float $lon longitude of the point
	 * @param float $lat latitude of the point
	 * @param int $zoom map zoom
	 * @return Tile
	 */
	public function getTileFromCoordinates($lon, $lat, $zoom)
	{
		$tileNumbers = $this->getTileNumbersFromCoordinates($lon, $lat, $zoom);
		return $this->getTile($tileNumbers['x'], $tileNumbers['y'], $zoom);
	}
	
	/**
	 * return coordinates of the left up corner of given tile
	 *
	 * @param int $x x-tile number
	 * @param int $y y-tile number
	 * @param int $zoom
	 */
	public function getCoordinatesOfTheLeftUpTileCorner($x, $y, $zoom)
	{
		$n = pow(2, $zoom);
		$lon = $x / $n * 360 - 180;
		$lat = rad2deg(atan(sinh(pi() * (1 - 2 * $y / $n))));
		return array('lon' => $lon, 'lat' => $lat);
	}
	
	/**
	 * return the width of the world map in number tiles
	 *
	 * @param int $zoom
	 * @return int
	 */
	public function getWidthInTiles($zoom)
	{
		return pow(2, $zoom);
	}
	
	/**
	 * return the height of the world map in number of tiles
	 *
	 * @param int $zoom
	 * @return int
	 */
	public function getHeightInTiles($zoom)
	{
		return pow(2, $zoom);
	}
	
	/**
	 * return width of the tile in pixels
	 *
	 * @return int
	 */
	public function getTileWidth()
	{
		return $this->_configuration['tileWidth'];
	}

	/**
	 * return height of the tile
	 *
	 * @return int
	 */
	public function getTileHeight()
	{
		return $this->_configuration['tileHeight'];
	}
	
	/**
	 * return minimal zoom for the tile source
	 *
	 * @return int
	 */
	public function getMinZoom()
	{
		return $this->_configuration['minZoom'];
	}
	
	/**
	 * return maximal zoom for the tile source
	 *
	 * @return int
	 */
	public function getMaxZoom()
	{
		return $this->_configuration['maxZoom'];
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