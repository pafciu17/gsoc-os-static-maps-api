<?php
abstract class RequestValidator
{
	/**
	 * map data
	 *
	 * @var MapRequest
	 */
	protected $_mapData;
	
	/**
	 * tile source
	 *
	 * @var TileSource
	 */
	protected $_tileSource;
	
	public function __construct(MapRequest $requestData, TileSource $tileSource)
	{
		$this->_mapData = $requestData;
		$this->_tileSource = $tileSource;
	}
	
	/**
	 * it checks if request data are correct, if not throws an excpetion
	 *
	 * @throws WrongMapRequestDataException
	 */
	public function check()
	{
		$this->_check();
	}
	
	/**
	 * implements detials of checking map request data, it should be overloaded by subclasses
	 *
	 * @throws WrongMapRequestDataException
	 */
	abstract protected function _check();
	
	/**
	 * check if map zoom is given coorect
	 *
	 * @return bool
	 */
	protected function _checkZoom() 
	{
		$zoom = $this->_mapData->getZoom();
		$minZoom = $this->_tileSource->getMinZoom();
		$maxZoom = $this->_tileSource->getMaxZoom();
		if (is_null($zoom) || !is_numeric($zoom) || $zoom < $minZoom || $zoom > $maxZoom) {
			return false;
		}
		return true;
	}
	
	/**
	 * method checks if width of the map is given correct
	 *
	 * @return bool
	 */
	protected function _checkWidth()
	{
		$width = $this->_mapData->getWidth();
		if (is_null($width) || !is_numeric($width) || $width <= 0) {
			return false;
		}
		return true;
	}
	
	/**
	 * method checks if height of the t
	 *
	 * @return bool
	 */
	protected function _checkHeight()
	{
		$height = $this->_mapData->getHeight();
		if (is_null($height) || !is_numeric($height) || $height <= 0) {
			return false;
		}
		return true;
	}
	
}