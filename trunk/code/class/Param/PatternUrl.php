<?php
class ParamPatternUrl extends ParamUrl 
{
	/**
	 * it maps names of the pattern to the url
	 *
	 * @var unknown_type
	 */
	public static $patternMap = array();
	
	public function __construct($name)
	{
		if (array_key_exists($name, self::$patternMap)) {
			parent::__construct(self::$patternMap[$name]);
		}
	}
	
	/**
	 * return if there is url set
	 *
	 * @return bool
	 */
	public function hasUrl()
	{
		return !is_null($this->_url);
	}
}