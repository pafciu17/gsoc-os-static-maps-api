<?php
class ImageHandlerException extends Exception 
{
}

abstract class ImageHandler
{
	/**
	 * image file extension
	 *
	 * @var string
	 */
	protected $_fileExtension;
	
	/**
	 * it maps url values to image classes
	 *
	 * @var array
	 */
	protected static $_classMap = array('png' => 'ImageHandlerPNG',
		'jpg' => 'ImageHandlerJPEG',
		'jpeg' => 'ImageHandlerJPEG',
		'gif' => 'ImageHandlerGIF');
	
	/**
	 * it maps file extensions to classes
	 *
	 * @var array
	 */
	protected static $_extensionToClassMap = array('png' => 'ImageHandlerPng',
		'jpg' => 'ImageHandlerJPEG',
		'jpeg' => 'ImageHandlerJPEG',
		'gif' => 'ImageHandlerGIF');
	
	/**
	 * create appropriate handler for given url name
	 *
	 * @param string $urlFileTypeName
	 * @return ImageHandler
	 */
	static public function factory($urlFileTypeName)
	{
		if (array_key_exists($urlFileTypeName, self::$_classMap)) {
			return new self::$_classMap[$urlFileTypeName]();
		}
		$defaultClass = reset(self::$_classMap);
		return new $defaultClass();
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
	 * it creates apprioprate ImageHandler for given file, by checkin its extension
	 *
	 * @param string $fileName
	 * @return ImageHandler
	 */
	public static function createImageHandlerFromFileExtension($fileName)
	{
		$tab = explode('.', $fileName);
		$lastIndex = sizeof($tab) - 1;
		if (isset($tab[$lastIndex])) {//extension exists
			$extension = $tab[$lastIndex];
			if (array_key_exists($extension, self::$_extensionToClassMap)) {
				return new self::$_extensionToClassMap[$extension]();
			}
		}
		throw new ImageHandlerException("Such extension doesn't fit to any class");
	}
}