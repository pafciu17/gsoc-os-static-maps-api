<?php
class ParamTransparency
{
	/**
	 * transparency, range: 0 - 127
	 *
	 * @var int
	 */
	private $_alpha;
	
	public static $minAlpha = 0;
	public static $maxAlpha = 127;
	
	public function __construct($alpha)
	{
		$this->setTransparency($alpha);
	}
	
	public function setTransparency($alpha)
	{
		$alpha = (int) $alpha;
		if ($alpha < self::$minAlpha || $alpha > self::$maxAlpha) {
			$alpha = self::$minAlpha;
		}
		$this->_alpha = $alpha;
	}
	
	public function getTransparency()
	{
		return $this->_alpha;
	}
}