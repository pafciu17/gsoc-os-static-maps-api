<?php
abstract class Layout
{
	/**
	 * method puts image onto map image
	 * 
	 * @param Map  $map
	 * @param resources $imageToPut
	 */
	abstract public function putImage(Map $map, $imageToPut);
}