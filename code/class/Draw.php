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
	
}
?>