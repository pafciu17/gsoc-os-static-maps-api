<?php
abstract class ParamFactory
{
	
	public static $delimeter = ':';

	public static function create($string)
	{
		$tab = explode(self::$delimeter, $string);
		if (isset($tab[0]) && strtolower($tab[0]) == 'color' && isset($tab[1]) && isset($tab[2]) && isset($tab[3])) {
			return new Color((int)$tab[1], (int)$tab[2], (int)$tab[3]);
		} else if (isset($tab[0]) && strtolower($tab[0]) == 'thickness' && isset($tab[1])) {
			return new ParamThickness((int) $tab[1]);
		} else if (isset($tab[0]) && strtolower($tab[0]) == 'transparency' && isset($tab[1])) {
			return new ParamTransparency((int) $tab[1]);
		}
	}
}