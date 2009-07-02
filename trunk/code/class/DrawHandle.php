<?php

class DrawHandle
{
	/**
	 * map on which class draws
	 *
	 * @var Map
	 */
	private $_map;
	
	public function __construct(Map $map)
	{
		$this->_map = $map;
	}
	
	/**
	 * it draws objects from DrawRequest
	 *
	 * @param DrawRequest $request
	 */
	public function draw(DrawRequest $request)
	{
		$drawings = $request->getDrawings();
		foreach ($drawings as $drawing) {
			$drawing->setColor($request->getColor());
			$drawing->draw($this->_map);
		}
	}
	
}

?>