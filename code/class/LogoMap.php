<?php
/**
 * class handles adding osm logo to the result map image
 *
 */
class LogoMap extends Map
{

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
	 * @var LogoLayout
	 */
	private $_logoLayout;
	
	public function __construct(Map $map, Conf $conf) 
	{
		$this->setImageHandler($map->getImageHandler());
		$this->_logoLayout = LogoLayout::factory($conf->get('logo_layout'));
		$this->_logoFile = $conf->get('logo_file');
		parent::__construct($map->getImage());
	}
	
	/**
	 * it sets logo layout, which defines how logo will be put onto map
	 *
	 * @param LogoLayout $layout
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
		//@todo it should work also for file diffrent then png
		$logoImage = imagecreatefrompng($this->_logoFile);
		$this->_img = $this->_logoLayout->putLogo($this->_img, $logoImage);	
		parent::send();
	}
	
}