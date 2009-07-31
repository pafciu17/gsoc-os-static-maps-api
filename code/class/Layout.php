<?php
abstract class Layout
{
	/**
	 * method puts image onto map image
	 * 
	 * @param resources $mapImage
	 * @param resources $imageToPut
	 */
	abstract public function putImage($mapImage, $imageToPut);
}