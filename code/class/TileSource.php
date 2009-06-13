<?php
class TileSourceException extends Exception 
{
}

/**
 * it defines interface for tile source classes
 *
 */
abstract class TileSource
{
	/**
	 * tilesource configuration
	 *
	 * @var array
	 */
	protected $_configuration = array('tileWidth' => 256, 'tileHeight' => 256,
		'sourceUrl' => '');
	
	/**
	 * image handler for tiles
	 *
	 * @var ImageHandler
	 */
	protected $_imageHandler;
	
	/**
	 * class map
	 *
	 * @var array
	 */
	static private $_classMap = array('mapnik' => 'TileSourceMapnik',
		'cycle' => 'TileSourceCycle');
	
	/**
	 * creates apprioprate TileSource
	 *
	 * @param string $type
	 */
	static public function factory($type)
	{
		foreach (self::$_classMap as $key => $className) {
			if ($key == $type) {
				return new $className();
			}
		}
		throw new TileSourceException("Wrong tile source class");
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
		$url = $this->_createUrl($x, $y, $zoom);
		$tile = new Tile($this->_loadImage($url));
		$tile->setWorldMap($this->getWorldMap($zoom));
		$tile->setTileData($x, $y, $zoom);
		$tile->setImageHandler($this->_imageHandler);
		return $tile;
	}

	
	/**
	 * load image
	 *
	 * @param string $url
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
		return $this->_configuration['sourceUrl'] . '/' . $zoom . '/' . $x . '/' . $y . '.' .$this->_imageHandler->getFileExtension();
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
	 * get world map
	 *
	 * @param int $zoom
	 * @return WorldMap
	 */
	abstract public function getWorldMap($zoom);
}