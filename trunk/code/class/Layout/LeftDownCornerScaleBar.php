<?php
class LayoutLeftDownCornerScaleBar extends LayoutLeftDownCorner
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
			if ($logoImage !== false && $layout instanceof  LayoutLeftDownCorner) {
				$width = imagesx($imageToPut);
				$height = imagesy($imageToPut);
				$logoHeight = imagesy($logoImage);
				imagecopymerge($mapImage, $imageToPut, 0, imagesy($mapImage) - $height - $logoHeight, 0, 0, $width, $height, 100);
				return;
			}
		}
		imagecopymerge($mapImage, $imageToPut, 0, imagesy($mapImage) - $height, 0, 0, $width, $height, 100);
	}

}