<?php
/**
 * class handles adding osm logo to the result map image
 *
 */
class LogoMap extends Map
{
	/**
	 * array of paths to url image
	 *
	 * @var string
	 */
	private $_logoFiles;
	
	/**
	 * app configuration object
	 *
	 * @var Conf
	 */
	private $_conf;
	
	/**
	 * logo layout
	 *
	 * @var Layout
	 */
	private $_logoLayout;
	
	public function __construct(Map $map, Conf $conf) 
	{
		$this->setImageHandler($map->getImageHandler());
		$this->_logoLayout = LogoLayout::factory($conf->get('logo_layout'));
		$this->_logoFiles = $conf->get('logo_files');
		$this->setWorldMap($map->getWorldMap());
		$leftUpCorner = $map->getLeftUpCorner();
		$this->setLeftUpCorner($leftUpCorner['lon'], $leftUpCorner['lat']);
		$rightDownCorner = $map->getRightDownCorner();
		$this->setRightDownCorner($rightDownCorner['lon'], $rightDownCorner['lat']);
		parent::__construct($map->getImage());
	}
	
	/**
	 * it sets logo layout, which defines how logo will be put onto map
	 *
	 * @param Layout $layout
	 */
	public function setLogoLayout($layout)
	{
		if (!is_null($layout)) {
			$this->_logoLayout = $layout;
		}
	}
	
	/**
	 * return logo layout
	 *
	 * @return Layout
	 */
	public function getLogoLayout()
	{
		return $this->_logoLayout;
	}

	/**
	 * return the logo image which fits the best to the size of the map
	 *
	 * @return resource
	 */
	private function _chooseLogoFile()
	{
		$mapWidth = imagesx($this->_img);
		$mapHeight = imagesy($this->_img);
		foreach ($this->_logoFiles as $logoFile) {
			$logoImageHandler = ImageHandler::createImageHandlerFromFileExtension($logoFile);
			$logoImage = $logoImageHandler->loadImage($logoFile);
			$logoWidth = imagesx($logoImage);
			$logoHeight = imagesy($logoImage);
			if ($logoWidth < $mapWidth && $logoHeight < $mapHeight) {
				return $logoImage;
			}
		}
		return $logoImage;
	}
	
	/**
	 * send image to the browser
	 *
	 * @return bool
	 */
	public function send()
	{
		$logoImage = $this->_chooseLogoFile();
		$this->_logoLayout->putImage($this, $logoImage);	
		parent::send();
	}
	
	/**
	 * return a logo image, or false if image can't be loaded
	 *
	 * @return resource
	 */
	public function getLogoImage()
	{
		return $this->_chooseLogoFile();
	}
	
}