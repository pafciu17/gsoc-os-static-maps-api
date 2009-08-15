<?php
/**
 * this class handles sending coordinates of boundary box to browser
 *
 */
abstract class BboxRespons
{
	
	protected $_bbox = array('left' => null,
		'right' => null,
		'up' => null,
		'down' => null);
	
	public static function factory($type) {
		if ($type == 'csv') {
			return new BboxResponsCsv();
		}
		return null;
	}
	
	public function setData(Map $map) {
		$leftUp = $map->getLeftUpCorner();
		$rightDown = $map->getRightDownCorner();
		$this->setLeft($leftUp['lon']);
		$this->setUp($leftUp['lat']);
		$this->setRight($rightDown['lon']);
		$this->setDown($rightDown['lat']);
	}
	
	public function setLeft($value) 
	{
		$this->_bbox['left'] = $value;
	}
	
	public function setRight($value)
	{
		$this->_bbox['right'] = $value;
	}
	
	public function setUp($value)
	{
		$this->_bbox['up'] = $value;
	}
	
	public function setDown($value)
	{
		$this->_bbox['down'] = $value;
	}
	
	/**
	 * send data to browser
	 *
	 */
	abstract public function send();
}