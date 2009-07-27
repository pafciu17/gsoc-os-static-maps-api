<?php
abstract class Draw
{
	/**
	 * color of the draw
	 *
	 * @var Color
	 */
	protected $_color;
	
	
	/**
	 * transparency of the drawing
	 *
	 * @var ParamTransparency
	 */
	protected $_transparency;
	
	public function setColor(Color $color)
	{
		$this->_color = $color;
	}
	
	/**
	 * it draws object on map
	 *
	 * @param Map $map
	 */
	abstract public function draw(Map $map);

	/**
	 * set additional options 
	 *
	 * @param mixed $param
	 */
	public function setParam($param) 
	{
		if ($param instanceof Color) {
			$this->setColor($param);
		} else if ($param instanceof ParamTransparency) {
			$this->setTransparency($param);	
		}
	}
	
	/**
	 * it checks if color is set
	 *
	 * @return bool
	 */
	public function hasColor()
	{
		return !is_null($this->_color);
	}
	
	/**
	 * it checks if transparency is set
	 *
	 * @return bool
	 */
	public function hasTransparency()
	{
		return !is_null($this->_transparency);
	}
	
	
	/**
	 * return int which desribes allocate color for drawing
	 *
	 * @param resource $image
	 * @return int
	 */
	protected function _getDrawColor($image)
	{
		return imagecolorallocatealpha($image, $this->_color->getR(), $this->_color->getG(), $this->_color->getB(), $this->_transparency->getTransparency());
	}
	
	/**
	 * method sets transparency of the drawing
	 *
	 * @param ParamTransparency $transparency
	 */
	public function setTransparency(ParamTransparency $transparency)
	{
		$this->_transparency = $transparency;
	}
}
