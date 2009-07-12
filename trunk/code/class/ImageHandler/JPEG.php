<?php
class ImageHandlerJPEG extends ImageHandler 
{	
	
	/**
	 * image file extension
	 *
	 * @var string
	 */
	protected $_fileExtension = 'jpg';
	
	/**
	 * send resource to output
	 *
	 * @param resource $image
	 */
	public function sendImage($image)
	{
		header('Content-type: image/jpeg');
		imagejpeg($image);
	}
	
	/**
	 * load image from given url
	 *
	 * @param string $url
	 * @return resource
	 */
	public function loadImage($url)
	{
		return @imagecreatefromjpeg($url);
	}
	
	/**
	 * saves image to file
	 *
	 * @param resource $image
	 * @param string $url
	 */
	public function saveImage($image, $url)
	{
		imagejpeg($image, $url);
	}
}