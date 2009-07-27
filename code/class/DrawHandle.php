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
			if (!$drawing->hasColor()) {//if color is not set, default color will be used
				$drawing->setColor($request->getColor());
			}
			if ($drawing instanceof DrawLine && !$drawing->hasThickness()) {
				$drawing->setThickness($request->getThickness());
			} 
			if (!$drawing->hasTransparency()) {
				$drawing->setTransparency($request->getTransparency());
			}
			$drawing->draw($this->_map);
		}
	}	
}