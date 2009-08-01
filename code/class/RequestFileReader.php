<?php
/**
 * class reades data from given file
 *
 */
class RequestFileReader
{
	
	private $_params = array();
	
	public static $nameValueDelimeter = '=';
	
	public function __construct($path)
	{
		$pos = strpos($path, 'http://');
		if ($pos !== 0) {
			$path = 'http://' . $path;
		}
		$file = @fopen($path, r);
		if ($file !== false) {
			$this->_parseFile($file);
			fclose($file);
		}
	}
	
	public function __get($name)
	{
		if (isset($this->_params[$name])) {
			return $this->_params[$name];
		}
	}

	private function _parseFile($file)
	{
		while (($line = fgets($file)) !== false) {
			$this->_parseLine($line);
		}
	}
	
	private function _parseLine($line)
	{
		$tab = explode(self::$delimeter, $line);
		if (isset($tab[0]) && isset($tab[1])) {
			$this->_params[$tab[0]] = $tab[1];
		}
	}
}