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
	private $post = array();
	
	public function __construct($post)
	{
		$this->post = $post;
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
				$data[$key] = $this->__processPostData($pole);
			}
		} else {
			if (get_magic_quotes_gpc()) {
				$data = stripslashes($dane);
			}
			$data = htmlspecialchars($dane);
			return $data;
		}
	}
	
	public function __get($pole)
	{
		if (isset($this->post[$pole])) {
			return $this->zabezpieczDaneZPosta($this->post[$pole]);
		}
	}
	
}
