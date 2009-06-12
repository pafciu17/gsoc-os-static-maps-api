<?php
class UnsupportedImageExtensionException extends Exception
{	
}

class Map
{
	
	/**
	 * map image
	 */
	protected $_img;
	
	/**
	 * image extension
	 * 
	 * @var ImageHandler
	 */
	protected $_imageHandler;
	
	/**
	 * coordinates of the map
	 *
	 * @var array
	 */
	protected $_coordinates;
	
	/**
	 * geo calculation object
	 *
	 * @var WorldMap
	 */
	protected $_worldMap;
	
	public function __construct($img)
	{
		$this->_img = $img;
	}
	
	/**
	 * return map image
	 *
	 * @return image
	 */
	public function getImage()
	{
		return $this->_img;
	}
	
	/**
	 * set image handler
	 *
	 * @param string $ext
	 */
	public function setImageHandler($handler)
	{
		$this->_imageHandler = $handler;
	}
	
	/**
	 * set up coordinates of the left up map corner
	 *
	 * @param int $lon longitude
	 * @param int $lat latitude
	 */
	public function setLeftUpCorner($lon, $lat)
	{
		$this->_coordinates['leftUp'] = array('lon' => $lon, 'lat' => $lat);
	}
	
	/**
	 * set up coordinates of the right down map corner
	 *
	 * @param int $lon longitude
	 * @param int $lat latitude
	 */
	public function setRightDownCorner($lon, $lat)
	{
		$this->_coordinates['rightDown'] = array('lon' => $lon, 'lat' => $lat);
	}
	
	/**
	 * return coordinates of the left up corner of the map
	 *
	 * @return array
	 */
	public function getLeftUpCorner()
	{
		return $this->_coordinates['leftUp'];
	}
	
	/**
	 * return coordinates of the right down corner of the map
	 *
	 * @return array
	 */
	public function getRightDownCorner()
	{
		return $this->_coordinates['rightDown'];
	}
	
	/**
	 * send image to the browser
	 *
	 * @return bool
	 */
	public function send()
	{
		$this->_imageHandler->sendImage($this->_img);
	}
	
	/**
	 * set object which is used for geo caluclation
	 *
	 * @param WorldMap $worldMap
	 */
	public function setWorldMap($worldMap)
	{
		$this->_worldMap = $worldMap;
	}
	
}