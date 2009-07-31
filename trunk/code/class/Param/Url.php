<?php
class ParamUrl
{
	/**
	 * url
	 *
	 * @var string
	 */
	protected $_url;

	public function __construct($url)
	{
		$this->_url = $url;
	}
	
	/**
	 * it returns url
	 *
	 * @return string
	 */
	public function getUrl()
	{
		$pos = strpos($this->_url, 'http://');
		if ($pos === 0) {
			return $this->_url;
		}
		return 'http://' . $this->_url;
	}	
	
	
}
