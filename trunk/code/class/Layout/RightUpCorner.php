<?php
class LayoutRightUpCorner extends Layout 
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
		$width = imagesx($imageToPut);
		$height = imagesy($imageToPut);
		imagecopy($mapImage, $imageToPut, imagesx($mapImage) - $width, 0, 0, 0, $width, $height);
	}
	
}