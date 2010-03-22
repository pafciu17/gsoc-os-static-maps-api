<?php
class LayoutRightUpCornerScaleBar extends LayoutRightUpCorner
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
		if ($map instanceof LogoMap) {
			$layout = $map->getLogoLayout();
			$logoImage = $map->getLogoImage();
			if ($logoImage !== false && $layout instanceof  LayoutRightUpCorner) {
				$logoHeight = imagesy($logoImage);
				imagecopymerge($mapImage, $imageToPut, imagesx($mapImage) - $width, $logoHeight, 0, 0, $width, $height, 100);
				return;
			}
		}
		imagecopymerge($mapImage, $imageToPut, imagesx($mapImage) - $width, 0, 0, 0, $width, $height, 100);
	}

}