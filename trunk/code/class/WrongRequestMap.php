<?php
/**
 * class represent image which is return as the result of wrong request
 *
 */
class WrongRequestMap extends Map
{
	public function __construct($fileName)
	{
		$this->setImageHandler(ImageHandler::createImageHandlerFromFileExtension($fileName));
		parent::__construct($this->_imageHandler->loadImage($fileName));
	}
}