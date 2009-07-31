<?php
class LayoutLeftUpCornerScaleBar extends LayoutLeftUpCorner
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
			if ($logoImage !== false && $layout instanceof  LayoutLeftUpCorner) {
				$width = imagesx($imageToPut);
				$height = imagesy($imageToPut);
				$logoHeight = imagesy($logoImage);
				imagecopy($mapImage, $imageToPut, 0, $logoHeight, 0, 0, imagesx($imageToPut), imagesy($imageToPut));
				return;
			}
		}
		parent::putImage($map, $imageToPut);
	}

}