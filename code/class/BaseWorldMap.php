<?php
class BaseWorldMap
{
	
	/**
	 * top edge of the latitude
	 *
	 * @var float
	 */
	static public $_topEdge = 85.0511;
	
	/**
	 * down edge of the latitude
	 *
	 * @var float
	 */
	static public $_downEdge = - 85.0511;
	
	/**
	 * left edge of the longitude
	 *
	 * @var float
	 */
	static public $_leftEdge = 180;
	
	/**
	 * right edge of the longitude
	 *
	 * @var float
	 */
	static public $_rightEdge = -180;
	
	/**
	 * correct longitude if it is out of domain
	 *
	 * @param float $lon
	 * @return float
	 */
	public function _correctLon($lon)
	{
		if ($lon <= self::$_rightEdge) {
			$lon += 360;
			$this->_correctLon($lon);
		}
		if ($lon > self::$_leftEdge) {
			$lon -= 360;
			$this->_correctLon($lon);
		}
		return $lon;
	}
	
	/**
	 * correct latitude if it is out of domain
	 *
	 * @param float $lat
	 * @return float
	 */
	public function _correctLat($lat)
	{
		if ($lat > self::$_topEdge) {
			$lat = self::$_topEdge;
		} else if ($lat < self::$_downEdge) {
			$lat = self::$_downEdge;
		}
		return $lat;
	} 
	
	/**
	 * method checks if latitude is correct
	 *
	 * @param float $lat
	 * @return bool
	 */
	public function isCorrectLat($lat) {
		if ($lat > self::$_topEdge || $lat < self::$_downEdge) {
			return false;
		}
		return true;
	}

	
	
}