<?php
class ParamThickness
{
	/**
	 * minimal possible thickness
	 *
	 * @var int
	 */
	public static $maxThickness = 25;
	
	/**
	 * maximal possible thickness
	 *
	 * @var int
	 */
	public static $minThickness = 1;
	
	/**
	 * thickness
	 *
	 * @var int
	 */
	private $_thickness;
	
	public function __construct($thickness = 1)
	{
		if (is_int($thickness) && $thickness <= self::$maxThickness && $thickness >= self::$minThickness) {
			$this->_thickness = $thickness;
		} else {
			$thickness = self::$minThickness;	
		}
	}
	
	/**
	 * return thickness of the line
	 *
	 * @return int
	 */
	public function getThickness()
	{
		return $this->_thickness;
	}

}