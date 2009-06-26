<?php
class ImageHandlerGIF extends ImageHandler 
{	
	
	/**
	 * image file extension
	 *
	 * @var string
	 */
	protected $_fileExtension = 'gif';
	
	/**
	 * send resource to output
	 *
	 * @param resource $image
	 */
	public function sendImage($image)
	{
		header('Content-type: image/gif');
		imagegif($image);
	}
	
	/**
	 * load image from given url
	 *
	 * @param string $url
	 * @return resource
	 */
	public function loadImage($url)
	{
		return imagecreatefromgif($url);
	}
	
	/**
	 * saves image to file
	 *
	 * @param resource $image
	 * @param string $url
	 */
	public function saveImage($image, $url)
	{
		imagegif($image, $url);
	}
}