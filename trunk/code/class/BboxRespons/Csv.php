<?php

/**
 * method sends data in csv format
 *
 */
class BboxResponsCsv extends BboxRespons 
{
	
	public function send()
	{
		header('Content-type: text/plain');
		echo $this->_bbox['left'] . ',' . $this->_bbox['up'] . ',' . $this->_bbox['right'] . ',' . $this->_bbox['down'];
	}
}