<?php
class ImageHandlerPNG extends ImageHandler 
{	
	
	/**
	 * image file extension
	 *
	 * @var string
	 */
	protected $_fileExtension = 'png';
	
	/**
	 * send resource to output
	 *
	 * @param resource $image
	 */
	public function sendImage($image)
	{
		header('Content-type: image/png');
		imagepng($image);
	}
	
	/**
	 * load image from given url
	 *
	 * @param string $url
	 * @return resource , in case of problems it retrun false
	 */
	public function loadImage($url)
	{
		return @imagecreatefrompng($url);
	}
	
	/**
	 * saves image to file
	 *
	 * @param resource $image
	 * @param string $url
	 */
	public function saveImage($image, $url)
	{
		imagepng($image, $url);
	}
}