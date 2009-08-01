<?php
/**
 * class reades data from given file
 *
 */
class RequestFileReader
{

	private $_params = array();

	public static $nameValueDelimeter = '=';

	/**
	 * maximal size of the file can be used
	 *
	 * @var unknown_type
	 */
	public static $maxSizeOfFile = 25600;

	public function __construct($path)
	{
		$pos = strpos($path, 'http://');
		if ($pos !== 0) {
			$path = 'http://' . $path;
		}
		$size = HelpClass::getSizeOfRemoteFile($path);
		if ($size !== false && $size <= self::$maxSizeOfFile) {
			$file = @fopen($path, 'r');
			if ($file !== false) {
				$this->_parseFile($file);
				fclose($file);
			}
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
		$tab = explode(self::$nameValueDelimeter, $line);
		if (isset($tab[0]) && isset($tab[1])) {
			$tab[0] = trim($tab[0]);
			$tab[1] = trim($tab[1]);
			$this->_params[$tab[0]] = $tab[1];
		}
	}
}