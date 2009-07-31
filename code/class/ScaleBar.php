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
	public static $unitLength = array('km' => 1, 'mil' => 1.609344);
	
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
		$this->_putOnMap($label, $this->_calculateLengthOfScaleBar($label, $scale, $equatorPixelsPerKm));
	}
	
	private function _calculateLengthOfScaleBar($label, $scale, $equatorPixelsPerKm)
	{
		return $label * $scale * $equatorPixelsPerKm * self::$unitLength['km'];
	}
	
	/**
	 * 
	 *
	 * @param float $label
	 */
	private function _putOnMap($label, $lengthOfBar)
	{
		imagestring($this->_map->getImage(), 1, 30,30, $label . ' km', imagecolorallocate($this->_map->getImage(),
		0,0,0));
		return imageline($this->_map->getImage(), 30, 30, 30 + $lengthOfBar, 30, imagecolorallocate($this->_map->getImage(),
		0,0,0));
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
		//echo 'max length ' . $maxLenghtOfScaleBar . '<br />'; 
		foreach (self::$possibleLables as $label) {
		//	echo $this->_calculateLengthOfScaleBar($label, $scale, $equatorPixelsPerKm);
		//	echo '<br />';
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