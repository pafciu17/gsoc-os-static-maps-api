<?php
class LogoLayoutException
{
}

/**
 * represents different ways of putting logo onto result map 
 *
 */
abstract class LogoLayout 
{
	
	private static $_classMap = array('no_logo' => 'LogoLayoutWithoutLogo',
		'logo_left_up_corner' => 'LogoLayoutLeftUpCorner',
		'logo_left_down_corner' => 'LogoLayoutLeftDownCorner',
		'logo_right_up_corner' => 'LogoLayoutRightUpCorner',
		'logo_right_down_corner' => 'LogoLayoutRightDownCorner');
	
	private static $_urlClassMap = array('leftUpCorner' => 'LogoLayoutLeftUpCorner',
		'leftDownCorner' => 'LogoLayoutLeftDownCorner',
		'rightUpCorner' => 'LogoLayoutRightUpCorner',
		'rightDownCorner' => 'LogoLayoutRightDownCorner');
	
	/**
	 * it creates logo layout object from its conf name
	 *
	 * @param string $layoutName
	 * @return LogoLayout
	 */
	public static function factory($layoutName) 
	{
		if (array_key_exists($layoutName, self::$_classMap)) {
			$className = self::$_classMap[$layoutName];
			return new $className();
		}
		throw new LogoLayoutException('No logo layout has been choosen');
	}
	
	/**
	 * method creates logo layout object from its url name
	 *
	 * @param string $urlLayoutName
	 * @return LogoLayout
	 */
	public static function factoryFromUrl($urlLayoutName) 
	{
		if (array_key_exists($urlLayoutName, self::$_urlClassMap)) {
			$className = self::$_urlClassMap[$urlLayoutName];
			return new $className();
		}
	}
	
	/**
	 * method puts logo onto map image
	 * 
	 * @param resources $mapImage
	 * @param resources $logoImage
	 */
	abstract public function putLogo($mapImage, $logoImage);
	
}