<?php

/**
 * it handles creating output map from boundary box with given boundary box and given zoom
 *
 */
class MapProcessorFromBoundaryBoxZoom extends MapProcessorFromBoundaryBox
{

	public function __construct(MapRequest $mapData, TileSource $source) 
	{
		$this->_requestValidator = new RequestValidatorFromBoundaryBoxZoom($mapData, $source);
		parent::__construct($mapData, $source);
	}
	
}