<?php

abstract class ScaleBarLayout 
{
	
	private static $_classMap = array('without' => 'LayoutWithout',
		'logo_left_up_corner' => 'LayoutLeftUpCornerScaleBar',
		'logo_left_down_corner' => 'LayoutLeftDownCornerScaleBar',
		'logo_right_up_corner' => 'LayoutRightUpCornerScaleBar',
		'logo_right_down_corner' => 'LayoutRightDownCornerScaleBar');
	
	private static $_urlClassMap = array('leftUpCorner' => 'LayoutLeftUpCornerScaleBar',
		'leftDownCorner' => 'LayoutLeftDownCornerScaleBar',
		'rightUpCorner' => 'LayoutRightUpCornerScaleBar',
		'rightDownCorner' => 'LayoutRightDownCornerScaleBar',
		'without' => 'LayoutWithout');
	
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
	
	
	
}