<?php
/**
 * support class
 *
 */
class FileList 
{
	
	private $_files = array();
	
	public function add($fileName)
	{
		$this->_files[$fileName] = filemtime($fileName);	
	}
	
	public function deleteOldest($number)
	{
		asort($this->_files);
		$count = 0;
		foreach ($this->_files as $fileName => $fileTime) {
			if ($count >= $number) {
				break;
			}
			unlink($fileName);
			$count++;
		}
	}
	
}

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
	 * how many files should be deleted in one clean operation
	 *
	 * @var int
	 */
	public static $numberOfFilesToDelete = 10;
	
	/**
	 * it sets after how many days tile will be deleted from cache
	 *
	 * @var int
	 */
	public static $daysToRemember = 7;
	
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
	 * it checks if there is such valid tile image in cache
	 *
	 * @param int $x
	 * @param int $y
	 * @param int $zoom
	 * @return bool
	 */
	public function hasTile($x, $y, $zoom)
	{
		$fileName = $this->_getFileName($x, $y, $zoom);
		$actualTime = new Zend_Date();
		if (file_exists($fileName)) {
			$fileTime = new Zend_Date();
			$fileTime->setTimestamp(filemtime($this->_getFileName($x, $y, $zoom)));
			$fileTime->addDay(self::$daysToRemember);
			if ($fileTime->isLater($actualTime)) {
				return true;
			}
		}
		return false;
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
		$fileList = new FileList();
		while (false !== ($fileName = readdir($dir))) {
			if ($fileName != '.' && $fileName != '..') {
				$fileList->add($this->_path . '/' . $fileName);
			}
		}
		$fileList->deleteOldest(self::$numberOfFilesToDelete);
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