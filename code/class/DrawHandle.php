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
		// first draw all drawings that are not DrawMarkPoints
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
			if (!($drawing instanceof DrawMarkPoint)) {
				$drawing->draw($this->_map);
			}
		}
		// then draw the DrawMarkPoints on top
		foreach ($drawings as $drawing) {
			if ($drawing instanceof DrawMarkPoint) {
				if(!$drawing->hasImageUrl()) {
					$drawing->setImageUrl($request->getPointImageUrl());
				}
				$drawing->draw($this->_map);
			}
		}
	}	
}