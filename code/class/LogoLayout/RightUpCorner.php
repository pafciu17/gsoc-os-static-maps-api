<?php
class LogoLayoutRightUpCorner extends LogoLayout 
{
	/**
	 * puts logo onto map
	 */
	public function putLogo($mapImage, $logoImage)
	{
		$logoWidth = imagesx($logoImage);
		$logoHeight = imagesy($logoImage);
		imagecopy($mapImage, $logoImage, imagesx($mapImage) - $logoWidth, 0, 0, 0, $logoWidth, $logoHeight);
		return $mapImage;
	}
	
}