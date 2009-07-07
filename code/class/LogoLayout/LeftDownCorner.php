<?php
class LogoLayoutLeftDownCorner extends LogoLayout
{
	/**
	 * puts logo onto map
	 */
	public function putLogo($mapImage, $logoImage)
	{
		$logoWidth = imagesx($logoImage);
		$logoHeight = imagesy($logoImage);
		imagecopy($mapImage, $logoImage, 0, imagesy($mapImage) - $logoHeight, 0, 0, $logoWidth, $logoHeight);
		return $mapImage;
	}
	
}