<?php
/**
 * contains and provides POST data
 *
 */
class Post
{
	/**
	 * post data
	 *
	 * @var array
	 */
	private $_post = array();
	
	public function __construct($post)
	{
		$this->_post = $post;
	}
	
	/**
	 * secures post data
	 *
	 * @param string $data
	 */
	private function _processPostData($data)
	{
		if (is_array($data)) {
			foreach ($data as $key => $value) {
				$data[$key] = $this->_processPostData($value);
			}
		} else {
			if (get_magic_quotes_gpc()) {
				$data = stripslashes($data);
			}
			$data = htmlspecialchars($data);
			return trim($data);
		}
	}
	
	public function __get($key)
	{
		if (isset($this->_post[$key])) {
			return $this->_processPostData($this->_post[$key]);
		}
	}
	
	public function getRawData($key)
	{
		return $this->_post[$key];
	}
	
}
