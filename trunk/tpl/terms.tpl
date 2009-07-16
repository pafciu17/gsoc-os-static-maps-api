<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>OSM static map api - admin panel</title>
{foreach from=$css_files item=file}
<link rel="stylesheet" type="text/css" href="{$file}" />
{/foreach}
</head>
<body>
<div id="termsBanner">
	
</div>
<div id="termsBody">
<h2>Test page</h2>
{assign var=host value=http://dev.openstreetmap.org/~pafciu17}

<div>
<p>
This is test page of GSoC 2009 project: Static maps API. 
Main idea of the project is to create an web application which will provide an easy way of embedding maps into web pages.
Application is going to be deeply configurable and easy to install by anyone on his server. 
It is being implemented in PHP5.
</p>
<p>
During first month of work scaffold of application has been created with its basic functionality. 
Now it is time for improvements and adding new features. 
I would be very grateful for any feedback about API. 
You can send comments, information about errors etc. to <b>osm.static.maps.api(at)gmail.com</b>.
</p>
<h2>Sample maps</h2>
<div id="sampleMaps">
<p><b>{$host}?module=map&center=55.027084,24.999439&zoom=10&type=mapnik&width=400&height=200</b><br/>
<img class="sampleMap" src="{$host}?module=map&center=55.027084,24.999439&zoom=10&type=mapnik&width=400&height=200" />
</p>
<p><b>{$host}?module=map&bbox=69.2,-47.2,71,-50&width=400&height=250</b><br />
<img class="sampleMap" src="{$host}?module=map&bbox=69.2,-47.2,71,-50&width=400&height=250" />
</p>
</div>
</div>

<div>
	<h3>Conditions and terms of use</h3>
	<ul>
	<li>Some information, conditions of use, etc</li>
	<li>...</li>
	</ul>
	<div>
		If you are using OSM static maps API it means that you read and accepted terms and conditions of use
	</div>
</div>

<div>
	<h3>API description</h3>
	<p>For that moment map can be build in 3 ways:
		<ul>
			<li>from given center point, width, height and zoom of the map:<br /> 
			<a href="{$host}/?module=map&center=0,51&zoom=7&width=400&height=400">{$host}/?module=map&center=0,51&zoom=7&width=400&height=400</a></li>
			<li>from given bound box and zoom:<br /> 
			<a href="{$host}/?module=map&bbox=0,70,40,50&zoom=4">{$host}/?module=map&bbox=0,70,40,50&zoom=4</a></li>
			<li>from given bound box, width and/or height: <br>
			 <a href="{$host}/?module=map&bbox=0,70,40,50&width=300">{$host}/?module=map&bbox=0,70,40,50&width=300</a> <br/>
			 <a href="{$host}/?module=map&bbox=0,70,40,50&height=300">{$host}/?module=map&bbox=0,70,40,50&height=300</a> <br />
			 <a href="{$host}/?module=map&bbox=0,70,40,50&width=300&height=400">{$host}/?module=map&bbox=0,70,40,50&width=300&height=400</a></li>
		</ul>
		<p>
		There has been set up limit of tiles per map, so each map can be build from no more than 30 tiles.
		</p>
		Supported url attributes:
		<ul>
			<li><b>type</b>: it indicates which tile server should be used to build up map. Possible values: mapnik, cycle, osmrender. Mapnik is a default value. Samples:
			<br /><a href="{$host}/?module=map&bbox=0,70,40,50&width=300&height=300&type=mapnik">{$host}/?module=map&bbox=0,70,40,50&width=300&height=300&type=mapnik</a><br />
			<a href="{$host}/?module=map&bbox=0,70,40,50&width=300&height=300&type=cycle">{$host}/?module=map&bbox=0,70,40,50&width=300&height=300&type=cycle</a> <br />
			<a href="{$host}/?module=map&bbox=0,70,40,50&width=300&height=300&type=osmrender">{$host}/?module=map&bbox=0,70,40,50&width=300&height=300&type=osmrender</a> <br />
			</li>
			<li><b>imgType</b>: image type of result image. Possible values: png, gif, jpg. Default value is png. Samples:<br />
			<a href="{$host}/?module=map&bbox=-30,30,0,0&width=300&height=300&type=mapnik&imgType=gif">{$host}/?module=map&bbox=-30,30,0,0&width=300&height=300&type=mapnik&imgType=gif</a><br />
			<a href="{$host}/?module=map&bbox=-30,30,0,0&width=300&height=300&type=mapnik&imgType=jpg">{$host}/?module=map&bbox=-30,30,0,0&width=300&height=300&type=mapnik&imgType=jpg</a>
			</li>
			<li><b>center</b>: it describes two coordinates of center point separeted by comma: longitude and latitude. Sample: <br />
			<a href="{$host}/?module=map&center=180,20&zoom=2&width=1200&height=1200">{$host}/?module=map&center=180,20&zoom=2&width=1200&height=1200</a>
			</li>
			<li><b>lon</b> and <b>lat</b>: it is another way to indicate center point of the map, <b>lon</b> represents longitude and <b>lat</b> refers to latitude. Sample: <br />
			<a href="{$host}/?module=map&lon=180&lat=20&zoom=2&width=1200&height=1200">{$host}/?module=map&lon=180&lat=20&zoom=2&width=1200&height=1200</a>
			
			</li>
			<li><b>zoom</b>: zoom of the map
			</li>
			<li><b>bbox</b>: it indicates the bound box of the map. It is given as 4 numbers: longitude of the left bound, latitude of the top bound, longitude of the right bound, latitude of bottom edge.  Sample:<br />
			<a href="{$host}/?module=map&bbox=-80,50,-50,10&width=300">{$host}/?module=map&bbox=-80,50,-50,10&width=300</a>
			</li>
			<li><b>width</b> and <b>height</b> size of the return map (in pixels).</li
			<li><b>points</b>: coordinates of the points which will be drawn on the map. Each points has two coordinates: longitude and latitude. Sample:<br />
			<a href="{$host}/?module=map&bbox=-80,50,-67,15&width=500&points=-74,40.34,-82.3,23.1">{$host}/?module=map&bbox=-80,50,-67,15&width=500&points=-74,40.34,-82.3,23.1</a>
			</li>
			<li><b>paths</b>: coordinates of paths, paths are separated by semi-colons. Sample:<br />
			<a href="{$host}/?module=map&bbox=-100,45,-67,5&width=600&paths=-74,40.34,-82.3,23.1,-85,35,-87.2,32.12;-90,40,-80,40">{$host}/?module=map&bbox=-100,45,-67,5&width=600&paths=-74,40.43,-82.3,23.1,-85,35,-87.2,32.12;-90,40,-80,40</a>
			</li>
			<li><b>color</b>: color of drawings, given as 3 RPG coordinates. Sample:<br />
			<a href="{$host}/?module=map&bbox=-80,50,-67,15&width=500&points=-74,40.344,-82.3,23.1&color=150,0,0">{$host}/?module=map&bbox=-80,50,-67,15&width=500&points=-74,40.34,-82.3,23.1&color=150,0,0</a>
			</li>
			<li><b>reload</b>: it force application to load all tiles from tile server, in that case cache will not be used<br />
			<a href="{$host}/?module=map&center=23.78677,52.751256,&zoom=10&width=500&height=500">{$host}/?module=map&center=23.78677,52.751256,&zoom=10&width=500&height=500</a>
			</li>
			<li><b>logoPos</b>: it defines in which part of the map osm logo is putted, 4 possible values are supported : leftUpCorner, leftDownCorne, rightUpCorner, rightDownCorner. Default value is leftDownCorner. 
			Samples:<br />
			<a href="{$host}?module=map&center=-120,50&zoom=5&width=300&height=300&logoPos=leftUpCorner">{$host}?module=map&center=-120,50&zoom=5&width=300&height=300&logoPos=leftUpCorner</a><br />
			<a href="{$host}?module=map&center=-120,50&zoom=5&width=300&height=300&logoPos=leftDownCorner">{$host}?module=map&center=-120,50&zoom=5&width=300&height=300&logoPos=leftDownCorner</a><br />
			<a href="{$host}?module=map&center=-120,50&zoom=5&width=300&height=300&logoPos=rightUpCorner">{$host}?module=map&center=-120,50&zoom=5&width=300&height=300&logoPos=rightUpCorner</a><br />
			<a href="{$host}?module=map&center=-120,50&zoom=5&width=300&height=300&logoPos=rightDownCorner">{$host}?module=map&center=-120,50&zoom=5&width=300&height=300&logoPos=rightDownCorner</a><br />
			<a href="{$host}?module=map&center=-120,50&zoom=5&width=300&height=300&">{$host}?module=map&center=-120,50&zoom=5&width=300&height=300</a><br />
			</li>
		</ul>
	</p>
	<p>
	Range of longitude values: from -180 to 180 <br />
	Range of latitude values: from -85.0511 to 85.0511 <br />
	</p>
</div>
</div>
</body>
</html>