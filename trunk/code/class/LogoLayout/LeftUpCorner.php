<?php
class LogoLayoutLeftUpCorner extends LogoLayout 
{
	/**
	 * puts logo onto map
	 */
	public function putLogo($mapImage, $logoImage)
	{
		imagecopy($mapImage, $logoImage, 0, 0, 0, 0, imagesx($logoImage), imagesy($logoImage));
		return $mapImage;
	}
	
}