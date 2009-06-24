<?php
/**
 * it handles cache for tiles 
 *
 */
class TileCache
{
	/**
	 * path to cache folder
	 *
	 * @var string
	 */
	protected  $_path;
	
	/**
	 * image handler for
	 *
	 * @var ImageHandler
	 */
	protected $_imageHandler;
	
	/**
	 * size of cache folder
	 *
	 * @var int
	 */
	protected $_cacheSize;
	
	/**
	 * 
	 *
	 * @param string $path
	 * @param int $size
	 * @param ImageHandler $imageHandler
	 */
	public function __construct($path, $size, ImageHandler $imageHandler)
	{
		$this->_imageHandler = $imageHandler;
		if (!file_exists($path)) {
			mkdir($path);
		}
		$this->_path = $path;
		$this->_getSizeOfCache();
		$this->_cacheSize = $size;
	}
	
	/**
	 * it loads tile image from cache
	 *
	 * @param int $x
	 * @param int $y
	 * @param int $zoom
	 * @return resources
	 */
	public function getTile($x, $y, $zoom)
	{
		return $this->_imageHandler->loadImage($this->_getFileName($x, $y, $zoom));
	}
	
	/**
	 * it checks if there is such tile image in cache
	 *
	 * @param int $x
	 * @param int $y
	 * @param int $zoom
	 * @return bool
	 */
	public function hasTile($x, $y, $zoom)
	{
		return file_exists($this->_getFileName($x, $y, $zoom));
	}
	
	/**
	 * saves image file for given tile
	 *
	 * @param resource $image
	 * @param int $x
	 * @param int $y
	 * @param int $zoom
	 */
	public function addTile($image, $x, $y, $zoom)
	{
		$this->_imageHandler->saveImage($image, $this->_getFileName($x, $y, $zoom));
		if ($this->_getSizeOfCache() > $this->_cacheSize) {
			$this->_cleanCache();
		}
	}
	
	/**
	 * it cleans cache
	 *
	 */
	private function _cleanCache()
	{
		$dir = opendir($this->_path);
		while (false !== ($fileName = readdir($dir))) {
			if ($fileName != '.' && $fileName != '..') {
				unlink($this->_path. '/' . $fileName);
			}
		}
	}
	
	/**
	 * return current size of the cache
	 *
	 * @return int
	 */
	private function _getSizeOfCache()
	{
		$dir = opendir($this->_path);
		$size = 0;
		while (false !== ($fileName = readdir($dir))) {
			if ($fileName != '.' && $fileName != '..') {
				$size += filesize($this->_path. '/' . $fileName);
			}
		}
		return $size;
	}
	
	/**
	 * create file name for given tile data
	 *
	 * @param int $x
	 * @param int $y
	 * @param int $zoom
	 * @return string
	 */
	private function _getFileName($x, $y, $zoom)
	{
		return $this->_path . '/' . $zoom . '_' . $x . '_' . $y;
	}
}
?>