<?php
class DrawMarkPoint extends DrawPoint
{
	/**
	 * url to image which can be used to draw point
	 *
	 * @var ParamUrl
	 */
	private $_imageUrl;

	/**
	 * draw point on map
	 *
	 * @param Map $map
	 */
	public function draw(Map $map)
	{
		$image = $map->getImage();
		$color = $this->_getDrawColor($image);
		$pointImage = false;
		if ($this->hasImageUrl()) {
			$imageHandler = ImageHandler::createImageHandlerFromFileExtension($this->_imageUrl->getUrl());
			$pointImage = $imageHandler->loadImage($this->_imageUrl->getUrl());
		}
		if ($pointImage !== false) {
			$map->putImage($pointImage, $this->getLon(), $this->getLat());
		} else {
			$color = $this->_getDrawColor($image);
			$point = $map->getPixelPointFromCoordinates($this->getLon(), $this->getLat());
			$vertices = array($point['x'], $point['y'],
			$point['x'] - 10, $point['y'] - 20, $point['x'] + 10, $point['y'] - 20);
			imagefilledpolygon ($map->getImage() , $vertices , 3, $color);
		}
	}
	
	/**
	 * return if objects has already set url to image
	 *
	 * @return bool
	 */
	public function hasImageUrl()
	{
		return !is_null($this->_imageUrl);
	}
	
	/**
	 * method sets url
	 *
	 * @param ParamUrl $url
	 */
	public function setImageUrl($url)
	{
		$this->_imageUrl = $url;
	}
	
	/**
	 * set additional options 
	 *
	 * @param mixed $param
	 */
	public function setParam($param) 
	{
		parent::setParam($param);
		if ($param instanceof ParamPatternUrl && $param->hasUrl()) {
			$this->setImageUrl($param);
		} else if ($param instanceof ParamUrl) {
			$this->setImageUrl($param);
		}
	}
}