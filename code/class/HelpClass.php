<?php
/**
 * this class contains some helpfull various funcion, which are used in different part of application,
 * it is just junk class:)
 *
 */
class HelpClass
{
	
	/**
	 * return size (byts) of remote file, or false in error case
	 *
	 * @param string $url
	 * @return int
	 */
	public static function getSizeOfRemoteFile($url)
	{
		$headers = get_headers($url, 1);
		if (is_array($headers) && isset($headers['Content-Length'])) {
			return $headers['Content-Length'];
		}
		return false;
	}
	
}