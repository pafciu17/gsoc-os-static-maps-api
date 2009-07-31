<?php
class LayoutLeftUpCorner extends Layout 
{
	/**
	 * method puts image onto map image
	 * 
	 * @param Map  $map
	 * @param resources $imageToPut
	 */
	public function putImage(Map $map, $imageToPut)
	{
		$mapImage = $map->getImage();
		imagecopy($mapImage, $imageToPut, 0, 0, 0, 0, imagesx($imageToPut), imagesy($imageToPut));
	}
	
}