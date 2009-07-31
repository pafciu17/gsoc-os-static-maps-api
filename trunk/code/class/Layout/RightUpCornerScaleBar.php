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
				$width = imagesx($imageToPut);
				$height = imagesy($imageToPut);
				$logoHeight = imagesy($logoImage);
				imagecopy($mapImage, $imageToPut, imagesx($mapImage) - $width, $logoHeight, 0, 0, $width, $height);
				return;
			}
		}
		parent::putImage($map, $imageToPut);
	}

}