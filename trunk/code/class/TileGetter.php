<?php
/**
 * defines interface for objects which handle geting tile images from server
 *
 */
interface TileGetter
{
	public function __construct($tileSource, $x, $y, $zoom);
	
	/**
	 * checks if tile is loaded
	 *
	 * @return bool
	 */
	public function isLoaded();
	
	/**
	 * it starts loading the tile image
	 *
	 */
	public function start();
	
	/**
	 * return tile
	 *
	 */
	public function getTile();
}
?>