<?php

class MyLoader
{
	
	/**
	 * dirs from which clases are loaded
	 *
	 * @var array
	 */
	private $_source = array();
	
	
	/**
	 * load file with given class
	 *
	 * @param string $name class name
	 */
	public function loadClass($name)
	{
		foreach ($this->_source as $dir) {
			if ($this->_loadClass($dir, $name)) {
				return true;
			}
		}
		return false;
	}
	
	/**
	 * add new dirs to source path 
	 *
	 * @param array $source
	 */
	public function addSource($source)
	{
		$this->_source = array_merge($this->_source, $source);
	}
	
	/**
	 * search for file in given dir
	 *
	 * @param string $dir
	 * @param string $name
	 */
	private function _loadClass($dir, $name)
	{
		if (file_exists($dir . '/' . $name . '.php')) {
			include_once($dir. '/' . $name . '.php');
			return true;
		}
		if (strlen($name) > 0) {
			$currentDir = $dir;
			$currentName = $name;
			while (true) {
				$newDir = $this->_getDirFromName($currentName);
				if (is_bool($newDir) and !$newDir) {
					break;
				}
				$currentDir = $currentDir . $newDir;
				$result = $this->_loadClass($currentDir, $currentName);
				if ($result) {
					return $result;
				}
			}
			$newDir = $this->_getDirFromName($name);
			if (is_bool($newDir) and !$newDir) {
				return false;
			}
			return $this->_loadClass($dir . '/' . $newDir, $name);
		}
		return false;
	}
	
	/**
	 * get dir from class name
	 *
	 * @param string $name
	 * @return string
	 */
	private function _getDirFromName(& $name)
	{
		$len = strlen($name);
		$result = '';
		$result = $name[0];
		$isUpper = false;
		for ($i = 1; $i < $len; $i++) {
			if ($this->_isUpper($name[$i])) {
				$isUpper = true;
				break;
			}
			$result[$i] = $name[$i];
		}
		if (!$isUpper) {
			return false;
		}
		$name = substr($name, $i);
		return $result;
	}
	
	/**
	 * checks if letter is upper case
	 *
	 * @param string $letter
	 * @return string
	 */
	private function _isUpper($letter) 
	{
		return strtoupper($letter) == $letter;
	}
}