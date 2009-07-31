<?php
/**
 * class handles adding osm logo to the result map image
 *
 */
class LogoMap extends Map
{
	/**
	 * path to url image
	 *
	 * @var string
	 */
	private $_logoFile;

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
		$this->_logoFile = $conf->get('logo_file');
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
	 * send image to the browser
	 *
	 * @return bool
	 */
	public function send()
	{
		$logoImageHandler = ImageHandler::createImageHandlerFromFileExtension($this->_logoFile);
		$logoImage = $logoImageHandler->loadImage($this->_logoFile);
		$this->_img = $this->_logoLayout->putImage($this->_img, $logoImage);	
		parent::send();
	}
	
}