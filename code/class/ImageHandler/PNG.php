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
		return imagecreatefrompng($url);
	}
	
}