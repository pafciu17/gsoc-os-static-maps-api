<?php
class ScaleBar
{
	
	/**
	 * map
	 *
	 * @var Map
	 */
	private $_map;
	
	/**
	 * layout which defines how scale bar is put onto the map
	 *
	 * @var Layout
	 */
	private $_layout;
	
	/**
	 * earth circumference (equator)
	 *
	 * @var float
	 */
	public static $earthCircumference = 40041.455;
	
	/**
	 * possible length units
	 *
	 * @var array
	 */
	public static $unitLength = array('km' => 1, 'mi' => 1.609344);
	
	/**
	 * possible labels of scalbar
	 *
	 * @var array
	 */
	public static $possibleLables = array(10000, 5000, 2000, 1000, 
	500, 200, 100, 
	50, 20, 10, 
	5, 2, 1, 
	0.5, 0.2, 0.1);
	
	/**
	 * unit of distance
	 *
	 * @var string
	 */
	private $_unit = 'km';
	
	/**
	 * 
	 *
	 * @param Map $map
	 * @param Conf $conf
	 */
	public function __construct($map, Conf $conf)
	{
		$this->_map = $map;
		$this->_layout = ScaleBarLayout::factory($conf->get('scale_bar_layout'));
	}
	
	/**
	 * it sets an unit of the scaleBar
	 *
	 * @param string $unitName
	 */
	public function setUnit($unitName)
	{
		if (!is_null($unitName) && array_key_exists($unitName, self::$unitLength)) {
			$this->_unit = $unitName; 
		}
	}
	
	/**
	 * method puts scalebar onto map
	 *
	 * @param Layout $layout
	 */
	public function putOnMap($layout = null)
	{
		$this->setLogoLayout($layout);
		$worldMap = $this->_map->getWorldMap();
		$widthPx = $worldMap->getWidth();
		$equatorPixelsPerKm = $widthPx / self::$earthCircumference;
		$scale = $this->_calculateScale();
		$label = $this->_findOutWhichLabel($scale, $equatorPixelsPerKm);
		$this->_layout->putImage($this->_map, $this->_createScaleBarMap($label, 
		$this->_calculateLengthOfScaleBar($label, $scale, $equatorPixelsPerKm)));
	}
	
	
	private function _getLengthUnit()
	{
		return $this->_unit;
	}
	
	private function _createScaleBarMap($label, $length)
	{
		$font = 1;
		$fullLabel = $label . ' ' . $this->_getLengthUnit();
		$stringWidth = imagefontwidth($font) * strlen($fullLabel);
		if ($stringWidth > $length) {
			$width = $stringWidth;
		} else {
			$width = $length;
		}
		$width += 20;
		$height = imagefontheight($font) + 20;
		
		//@todo drawing of scalebar not work proper for some version GD, rememer to fix it
		$scaleBarImage = imagecreatetruecolor($width, $height);
		$transparentColor = imagecolorat($scaleBarImage, 0, 0);
		imagecolortransparent($scaleBarImage, $transparentColor);
		$transparent = imagecolorallocatealpha($scaleBarImage, 0, 0, 0, 127);
	   	imagefilledrectangle($scaleBarImage, 0, 0, $width, $height, $transparent);

		$barPosX = round(($width - $length) / 2);
		$barPosY = $height - 5;
		$color = imagecolorallocate($scaleBarImage, 1, 0, 0);
		imageline($scaleBarImage, $barPosX, $barPosY, $barPosX + $length, $barPosY, $color);
		imageline($scaleBarImage, $barPosX, $barPosY - 3, $barPosX, $barPosY + 3, $color);
		imageline($scaleBarImage, $barPosX + $length, $barPosY - 3, $barPosX + $length, $barPosY + 3, $color);
		$stringPosX = round(($width - $stringWidth) / 2);
		$stringPoxY = 10;
		imagestring($scaleBarImage, $font, $stringPosX, $stringPoxY, $fullLabel, $color);
		return $scaleBarImage;
	}
	
	/**
	 * calculates length of of scale bar in pixels
	 *
	 * @param float $label
	 * @param float $scale
	 * @param float $equatorPixelsPerKm
	 * @return int
	 */
	private function _calculateLengthOfScaleBar($label, $scale, $equatorPixelsPerKm)
	{
		return round($label * $scale * $equatorPixelsPerKm * self::$unitLength[$this->_unit]);
	}
	
	/**
	 * methods find out which label should be used for map
	 *
	 * @param float $scale
	 * @param float $equatorPixelsPerKm
	 */
	private function _findOutWhichLabel($scale, $equatorPixelsPerKm)
	{
		$mapWidth = imagesx($this->_map->getImage());
		$maxLenghtOfScaleBar = $mapWidth / 4;
		foreach (self::$possibleLables as $label) {
			if ($this->_calculateLengthOfScaleBar($label, $scale, $equatorPixelsPerKm) < $maxLenghtOfScaleBar) {
				return $label;
			}
		}
		
		return $label;
	}
	
	private function _calculateScale()
	{
		$leftUp = $this->_map->getLeftUpCorner();
		$rightDown = $this->_map->getRightDownCorner();	
		$lat = abs(($leftUp['lat']  + $rightDown['lat']) / 2);
		return 1/cos(deg2rad($lat));
	}
	
	/**
	 * it sets layout
	 *
	 * @param Layout $layout
	 */
	public function setLogoLayout($layout)
	{
		if (!is_null($layout)) {
			$this->_layout = $layout;
		}
	}
	
	
}