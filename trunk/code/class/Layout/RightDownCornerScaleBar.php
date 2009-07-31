<?php
class LayoutRightDownCornerScaleBar extends LayoutRightDownCorner
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
			if ($logoImage !== false && $layout instanceof  LayoutRightDownCorner) {
				$width = imagesx($imageToPut);
				$height = imagesy($imageToPut);
				$logoHeight = imagesy($logoImage);
				imagecopy($mapImage, $imageToPut, imagesx($mapImage) - $width, imagesy($mapImage) - $height - $logoHeight, 0, 0, $width, $height);
				return;
			}
		}
		parent::putImage($map, $imageToPut);
	}

}