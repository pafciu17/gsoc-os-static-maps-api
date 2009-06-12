<?php
class Tile extends Map
{
	/**
	 * tile data
	 * 
	 * @var array
	 */
	private $_tileData = array();
	
	public function setTileData($x, $y, $zoom)
	{
		$this->_tileData = array('x' => $x, 'y' => $y, 'zoom' => $zoom);
	}
	
	/**
	 * return coordinates of the left up corner of the map
	 *
	 * @return array
	 */
	public function getLeftUpCorner()
	{
		if (isset($this->_coordinates['leftUp'])) {
			return $this->_coordinates['leftUp'];
		}
		return $this->_coordinates['leftUp'] = $this->_worldMap->getTileSource()
		->getCoordinatesOfTheLeftUpTileCorner($this->_tileData['x'], $this->_tileData['y'],
		$this->_tileData['zoom']);
	}
	
	/**
	 * return coordinates of the right down corner of the map
	 *
	 * @return array
	 */
	public function getRightDownCorner()
	{
		return $this->_coordinates['rightDown'];
	}
}