<?php
class LayoutLeftDownCorner extends Layout
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
		imagecopy($mapImage, $imageToPut, 0, imagesy($mapImage) - $height, 0, 0, $width, $height);
	}
	
}