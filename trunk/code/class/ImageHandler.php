<?php
abstract class ImageHandler
{
	/**
	 * image file extension
	 *
	 * @var string
	 */
	protected $_fileExtension;
	
	/**
	 * create appropriate handler for given extension
	 *
	 * @param string $extension
	 * @return ImageHandler
	 */
	static public function factory($extension)
	{
		//@todo implement it	
	}
	
	/**
	 * create empty image
	 *
	 * @return resource 
	 */
	public function createImage($width, $height)
	{
		return imagecreatetruecolor($width, $height);
	}
	
	/**
	 * send resource to output
	 *
	 * @param resource $image
	 */
	abstract public function sendImage($image);
	
	/**
	 * load image from given url
	 *
	 * @param string $url
	 * @return resource
	 */
	abstract public function loadImage($url);
	
	/**
	 * saves image to file
	 *
	 * @param resource $image
	 * @param string $url
	 */
	abstract public function saveImage($image, $url);
	
	/**
	 * return file extension for image file which is handled by this class
	 *
	 * @return string
	 */
	public function getFileExtension()
	{
		return $this->_fileExtension;
	}
	
	/**
	 * draw pixel
	 *
	 * @param unknown_type $image
	 * @param unknown_type $x
	 * @param unknown_type $y
	 */
	public function drawPixel($image, $x, $y)
	{
		imagesetpixel($image, $x, $y, imagecolorallocate($image, 200, 0, 0));
	}
}