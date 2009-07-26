<?php
/**
 * represents color in RGB way
 *
 */
class Color
{
	private $_red = 0;
	private $_green = 0;
	private $_blue = 0;
	
	public function __construct($red = 0, $green = 0, $blue = 0)
	{
		$this->setR($red);
		$this->setB($blue);
		$this->setG($green);
	}
	
	public function setColor($color)
	{
		$this->setR($color['r']);
		$this->setG($color['g']);
		$this->setB($color['b']);
	}
	
	private function _validColor($color)
	{
		return (0 <= $color && $color <= 255);
	}
	
	public function setR($red) 
	{
		if ($this->_validColor($red)) {
			$this->_red = $red;
		}
	}
	
	public function setG($green) 
	{
		if ($this->_validColor($green)) {
			$this->_green = $green;
		}
	}
	
	public function setB($blue)
	{
		if ($this->_validColor($blue)) {
			$this->_blue = $blue;
		}
	}
	
	public function getR()
	{
		return $this->_red;
	}
	
	public function getG()
	{
		return $this->_green;
	}
	
	public function getB()
	{
		return $this->_blue;
	}
}
