<?php
/**
 * class contains GET data
 *
 */
class Get
{
	/**
	 * get data
	 *
	 * @var array
	 */
	private $get;
	
	public function __construct($get)
	{
		$this->get = $get;
	}
	
	public function __get($pole)
	{
		if (isset($this->get[$pole])) {
			return $this->get[$pole];
		}
	}
	
}
?>