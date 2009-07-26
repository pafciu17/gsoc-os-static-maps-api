<?php
abstract class Draw
{
	/**
	 * color of the draw
	 *
	 * @var Color
	 */
	protected $_color;
	
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
}
