<?php
/**
 * class fill up url with tile coordinates
 *
 */
class ServerUrl
{
	/**
	 * url adress
	 *
	 * @var string
	 */
	private $_url;
	
	private $_zoomPattern = '<zoom>';
	
	private $_xPattern = '<x>';
	
	private $_yPattern = '<y>';
	
	public function __construct($url)
	{
		$this->_url = $url;
	}
	
	/**
	 * return filled up url with given data
	 *
	 * @param int $zoom
	 * @param int $x
	 * @param int $y
	 * @return string
	 */
	public function getUrl($zoom, $x, $y)
	{
		$url = str_replace($this->_zoomPattern, $zoom, $this->_url);	
		$url = str_replace($this->_xPattern, $x, $url);
		return str_replace($this->_yPattern, $y, $url);
	}
	
	public function getUrlPatternWithHtmlSpecialChars()
	{
		return htmlspecialchars($this->getUrlPattern());
	}
	
	public function getUrlPattern()
	{
		return $this->_url;
	}
	
}
