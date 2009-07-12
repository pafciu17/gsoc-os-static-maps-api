<?php
/**
 * class represents an tile which can't load his map image
 *
 */
class EmptyTile extends Tile 
{
	/**
	 * defines what is the background color for the empty tiles
	 *
	 * @var array
	 */
	public static $backgroundColor = array('r' => 255, 'g' => 255, 'b' => 255);
	
	/**
	 * defines what is the color of text which is putted onto empty tile
	 *
	 * @var array
	 */
	public static $stringColor = array('r' => 0, 'g' => 0, 'b' => 0);
	
	/**
	 * color of the cross which is drawn onto unload tiles
	 * 
	 * @var = array
	 */
	public static $crossColor = array('r' => 255, 'g' => 0, 'b' => 0);
	
	/**
	 * text which is putted onto empty tile
	 *
	 * @var string
	 */
	public static $string = "can't load tile";
	
	/**
	 * 
	 *
	 * @param int $width
	 * @param int $height
	 * @param ImageHandler $imageHandler
	 */
	public function __construct($width, $height, ImageHandler $imageHandler)
	{
		$img = $imageHandler->createImage($width, $height);
		$color = imagecolorallocate($img, self::$backgroundColor['r'], self::$backgroundColor['g'], self::$backgroundColor['b']);
		imagefilledrectangle($img, 0, 0, $width, $height, $color);
		$crossColor = imagecolorallocate($img, self::$crossColor['r'], self::$crossColor['g'], self::$crossColor['b']);
		imageline($img,0,0,$width,$height, $crossColor);
		imageline($img,0, $height, $width, 0, $crossColor);
		imageline($img,0,0,$width - 1,0, $crossColor);
		imageline($img,$width - 1,0,$width - 1,$height,$crossColor);
		imageline($img,$width - 1,$height - 1,0,$height - 1, $crossColor);
		imageline($img,0,$height - 1,0,0,$crossColor);
		$stringColor = imagecolorallocate($img, self::$stringColor['r'], self::$stringColor['g'], self::$stringColor['b']);
		imagestring($img,2,0,0, self::$string, $stringColor);
		parent::__construct($img);
	}
	
}