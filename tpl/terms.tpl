<!DOCTYPE>
<html>
<head>
<title>OSM static map api - admin panel</title>
{foreach from=$css_files item=file}
<link rel="stylesheet" type="text/css" href="{$file}" />
{/foreach}
</head>
<body>
<div id="termsBanner">
	
</div>
<div id="termsBody">
<h2>OSM Static maps API</h2>
{assign var=host value=''}
<div>
<p>
Main idea of the project is to create an web application which will provide an easy way of embedding maps into web pages.
Application is going to be deeply configurable and easy to install by anyone on his server. 
It is being implemented in PHP5.
</p>
<p>
Application is development all the time, and I am looking forward for any feedback about API
I would be very grateful for it.
You can send comments, information about errors etc. to <b>osm.static.maps.api(at)gmail.com</b>.
</p>
<h2>Sample maps</h2>
<div id="sampleMaps">
<p><b>{$host}/?module=map&amp;center=55.027084,24.999439&zoom=10&type=mapnik&width=400&height=200&points=54.99,25.01,pointImagePattern:greenP;55.05,25.039,pointImagePattern:redI</b><br/>
<img class="sampleMap" src="{$host}/?module=map&center=55.027084,24.999439&zoom=10&type=mapnik&width=400&height=200&points=54.99,25.01,pointImagePattern:greenP;55.05,25.039,pointImagePattern:redI" />
</p>
<p><b>{$host}/?module=map&bbox=69.2,-47.2,71,-50&width=400&height=250</b><br />
<img class="sampleMap" src="{$host}/?module=map&bbox=69.2,-47.2,71,-50&width=400&height=250" />
</p>
</div>
</div>

<div>
	<h3>Conditions and terms of use</h3>
	<ul>
	<li>I am not sure how it should look like, I am waiting for suggetions.</li>
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
			<a href="{$host}/?module=map&center=0,51&zoom=7&width=400&height=400">{$host}/?module=map&amp;center=0,51&zoom=7&width=400&height=400</a></li>
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
			<li><b>type</b>: it indicates which tile server should be used to build up map. Possible values: mapnik, cycle, osmarender. Mapnik is a default value. Samples:
			<br /><a href="{$host}/?module=map&bbox=0,70,40,50&width=300&height=300&type=mapnik">{$host}/?module=map&bbox=0,70,40,50&width=300&height=300&type=mapnik</a><br />
			<a href="{$host}/?module=map&bbox=0,70,40,50&width=300&height=300&type=cycle">{$host}/?module=map&bbox=0,70,40,50&width=300&height=300&type=cycle</a> <br />
			<a href="{$host}/?module=map&bbox=0,70,40,50&width=300&height=300&type=osmarender">{$host}/?module=map&bbox=0,70,40,50&width=300&height=300&type=osmarender</a> <br />
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
			<li><b>zoom</b>: zoom of the map, possible values depend on map type. Usually it could be from 0 to 18.
			</li>
			<li><b>bbox</b>: it indicates the bound box of the map. It is given as 4 numbers: longitude of the left bound, latitude of the top bound, longitude of the right bound, latitude of bottom edge.  Sample:<br />
			<a href="{$host}/?module=map&bbox=-80,50,-50,10&width=300">{$host}/?module=map&bbox=-80,50,-50,10&width=300</a>
			</li>
			<li><b>width</b> and <b>height</b> size of the return map (in pixels).</li
			<li><b>points</b>: coordinates of the points which will be drawn on the map. Points are separated by semicolons. Each points has two coordinates: longitude and latitude. Sample:<br />
			<a href="{$host}/?module=map&bbox=-80,50,-67,15&width=500&points=-74,40.34;-82.3,23.1">{$host}/?module=map&bbox=-80,50,-67,15&width=500&points=-74,40.34;-82.3,23.1</a> <br />
			Each point can also have specifed: transparency(0 - 127), color (RPG coordinates), pointImageUrl (url to image which will be put in point), pointImagePattern (indicates what pattern image will be used). Samples: <br/>
			<a href="{$host}/?module=map&bbox=-80,50,-67,15&width=500&points=-74,40.34,color:0:20:0,transparency:80;-82.3,23.1,pointImageUrl:pafciu17.dev.openstreetmap.org/media/pointer/sight_point.png">{$host}/?module=map&bbox=-80,50,-67,15&width=500&points=-74,40.34,color:0:20:0,transparency:80;-82.3,23.1,pointImageUrl:pafciu17.dev.openstreetmap.org/media/pointer/sight_point.png</a> <br />
			<a href="{$host}/?module=map&bbox=-80,50,-67,15&width=500&points=-74,40.34,pointImagePattern:cursor;-82.3,23.1,pointImagePattern:sight">{$host}/?module=map&bbox=-80,50,-67,15&width=500&points=-74,40.34,pointImagePattern:cursor;-82.3,23.1,pointImagePattern:sight</a> <br />
			</li>
			<li><b>pointImageUrl</b> url to image which is used to mark points
			<a href="{$host}/?module=map&bbox=-80,50,-67,15&width=500&points=-74,40.34;-82.3,23.1&pointImageUrl=pafciu17.dev.openstreetmap.org/media/pointer/sight_point.png">{$host}/?module=map&bbox=-80,50,-67,15&width=500&points=-74,40.34;-82.3,23.1&pointImageUrl=pafciu17.dev.openstreetmap.org/media/pointer/sight_point.png</a>
			</li>
			<li><b>pointImagePattern</b> indicates image pattern for all points, values: sight, cursor , redA, redB ..., redZ, red0, red1 ... red9, greenA, ... blueA, ... <br />
			<a href="{$host}/?module=map&bbox=-80,50,-67,15&width=500&points=-74,40.34;-82.3,23.1&pointImagePattern=sight">{$host}/?module=map&bbox=-80,50,-67,15&width=500&points=-74,40.34;-82.3,23.1&pointImagePattern=sight</a><br />
			<a href="{$host}/?module=map&bbox=-80,50,-67,15&width=500&points=-74,40.34;-82.3,23.1&pointImagePattern=redA">{$host}/?module=map&bbox=-80,50,-67,15&width=500&points=-74,40.34;-82.3,23.1&pointImagePattern=redA</a><br />
			</li>
			<li><b>paths</b>: coordinates of paths, paths are separated by semicolons. Sample:<br />
			<a href="{$host}/?module=map&bbox=-100,45,-67,5&width=600&paths=-74,40.34,-82.3,23.1,-85,35,-87.2,32.12;-90,40,-80,40">{$host}/?module=map&bbox=-100,45,-67,5&width=600&paths=-74,40.43,-82.3,23.1,-85,35,-87.2,32.12;-90,40,-80,40</a><br />
			Path attributes: color (RPG coordinates), transparency(0 - 127), thickness(1 - 5), sample:<br />
			<a href="{$host}/?module=map&bbox=-100,45,-67,5&width=600&paths=-74,40.43,-82.3,23.1,-85,35,-87.2,32.12,thickness:5,transparency:100;-90,40,-80,40,color:0:255:0">{$host}/?module=map&bbox=-100,45,-67,5&width=600&paths=-74,40.43,-82.3,23.1,-85,35,-87.2,32.12,thickness:5,transparency:100;-90,40,-80,40,color:0:255:0</a><br />
			</li>
			<li><b>polygons</b>: coordinates of vertices of polygons, polygons are separated by semicolons. Sample:<br />
			<a href="{$host}/?module=map&bbox=-100,45,-67,5&width=600&polygons=-74,40.43,-82.3,23.1,-85,35,-87.2,32.12,thickness:5,transparency:100;-90,40,-80,40,-95.45,39,color:0:255:0">{$host}/?module=map&bbox=-100,45,-67,5&width=600&polygons=-74,40.43,-82.3,23.1,-85,35,-87.2,32.12,thickness:5,transparency:100;-90,40,-80,40,-95.45,39,color:0:255:0</a><br />
			Polygons has the same attributes as paths (so transparency, thickness, color).
			</li>
			<li><b>filledPolygons</b>: coordinates of vertices of polygons. Similar to polygons tag, but this time polygons are filled with given color. Sample: <br />
			<a href="{$host}/?module=map&center=12,52&zoom=4&width=500&height=400&filledPolygons=2.35,48.5,13.40,52.5,0,51.5,color:0:255:0;16.35,48.19,13.4,52.5,30.5,50.45&transparency=100">{$host}/?module=map&center=12,52&zoom=4&width=500&height=400&filledPolygons=2.35,48.5,13.40,52.5,0,51.5,color:0:255:0;16.35,48.19,13.4,52.5,30.5,50.45&transparency=100</a>
			attributes: transparency, color.
			</li>
			<li><b>color</b>: color of drawings, given as 3 RPG coordinates. That Color is used for all objects which don't have specifed color. Sample:<br />
			<a href="{$host}/?module=map&bbox=-80,50,-67,15&width=500&points=-74,40.344,-82.3,23.1&color=150,0,0">{$host}/?module=map&bbox=-80,50,-67,15&width=500&points=-74,40.34,-82.3,23.1&color=150,0,0</a>
			</li>
			<li><b>thickness</b>: thickness of paths, polygons, given as number (value: 1 - 5). Sample<br />
			<a href="{$host}/?module=map&center=12,52&zoom=4&width=500&height=400&paths=2.35,48.5,13.40,52.5,0,51.5;16.35,48.19,13.4,52.5,30.5,50.45&thickness=3">{$host}/?module=map&center=12,52&zoom=4&width=500&height=400&paths=2.35,48.5,13.40,52.5,0,51.5;16.35,48.19,13.4,52.5,30.5,50.45&thickness=3</a>
			</li>
			<li><b>transparency</b>: transparency, given as int number (value: 0 - 127). Sample<br />
			<a href="{$host}/?module=map&center=12,52&zoom=4&width=500&height=400&paths=2.35,48.5,13.40,52.5,0,51.5;16.35,48.19,13.4,52.5,30.5,50.45&transparency=100&thickness=3">{$host}/?module=map&center=12,52&zoom=4&width=500&height=400&paths=2.35,48.5,13.40,52.5,0,51.5;16.35,48.19,13.4,52.5,30.5,50.45&transparency=100&thickness=3</a>
			</li>
			<li><b>reload</b>: it force application to load all tiles from tile server, in that case cache will not be used<br />
			<a href="{$host}/?module=map&center=23.78677,52.751256,&zoom=10&width=500&height=500&reload=true">{$host}/?module=map&center=23.78677,52.751256,&zoom=10&width=500&height=500&reload=true</a>
			</li>
			<li><b>logoPos</b>: it defines in which part of the map osm logo is put, 4 possible values are supported : leftUpCorner, leftDownCorne, rightUpCorner, rightDownCorner. Default value is leftDownCorner. 
			Samples:<br />
			<a href="{$host}/?module=map&center=-120,50&zoom=5&width=300&height=300&logoPos=leftUpCorner">{$host}/?module=map&center=-120,50&zoom=5&width=300&height=300&logoPos=leftUpCorner</a><br />
			<a href="{$host}/?module=map&center=-120,50&zoom=5&width=300&height=300&logoPos=leftDownCorner">{$host}/?module=map&center=-120,50&zoom=5&width=300&height=300&logoPos=leftDownCorner</a><br />
			<a href="{$host}/?module=map&center=-120,50&zoom=5&width=300&height=300&logoPos=rightUpCorner">{$host}/?module=map&center=-120,50&zoom=5&width=300&height=300&logoPos=rightUpCorner</a><br />
			<a href="{$host}/?module=map&center=-120,50&zoom=5&width=300&height=300&logoPos=rightDownCorner">{$host}/?module=map&center=-120,50&zoom=5&width=300&height=300&logoPos=rightDownCorner</a><br />
			<a href="{$host}/?module=map&center=-120,50&zoom=5&width=300&height=300&">{$host}/?module=map&center=-120,50&zoom=5&width=300&height=300</a><br />
			</li>
			<li><b>scaleBarPos</b> and <b>scaleBarUnit</b>, These parameters define how scale bar will be displayed. <b>scaleBarPos</b> defines where scale bar will be put 
			(values: leftUpCorner, rightUpCorner, rightDownCorner, leftDownCorner, without) and
			<b>scaleBarUnit</b> sets what distance unit will be used (mi for miles, km for kilometers, km is a default value). Samples: <br />
			<a href="{$host}/?module=map&center=0,51&zoom=4&width=400&height=400">{$host}/?module=map&center=0,51&zoom=4&width=400&height=400</a><br />
			<a href="{$host}/?module=map&center=0,51&zoom=4&width=400&height=400&scaleBarPos=rightDownCorner">{$host}/?module=map&center=0,51&zoom=4&width=400&height=400&scaleBarPos=rightDownCorner</a><br />
			<a href="{$host}/?module=map&center=0,51&zoom=4&width=400&height=400&scaleBarPos=leftDownCorner">{$host}/?module=map&center=0,51&zoom=4&width=400&height=400&scaleBarPos=leftDownCorner</a><br />
			<a href="{$host}/?module=map&center=0,51&zoom=4&width=400&height=400&scaleBarUnit=mi">{$host}/?module=map&center=0,51&zoom=4&width=400&height=400&scaleBarPos=scaleBarUnit=mi</a><br />
			</li>
			<li><b>paramFileUrl</b> the url which indicates file with map request data. Sometimes there is too many of given parameters and url becomes too complicated, in such case it is better to put them
			in file, and in request just give the url to that file. Url parameters have higher priority, so in case of conflicts url parameters are taken into account instead of those from file. Samples: <br />
			<a href="{$host}/?module=map&paramFileUrl=http://pafciu17.dev.openstreetmap.org/samples/sample_map_request.txt">{$host}/?module=map&paramFileUrl=http://pafciu17.dev.openstreetmap.org/samples/sample_map_request.txt</a><br />
			<a href="{$host}/?module=map&paramFileUrl=http://pafciu17.dev.openstreetmap.org/samples/sample_map_request.txt">{$host}/?module=map&zoom=4&paramFileUrl=http://pafciu17.dev.openstreetmap.org/samples/sample_map_request.txt</a><br />
			Structure of the file: each attribute is given in one line. Line starts with name of parameter and after the char "=" goes the value.
			</li>
			Sample: <a href="http://pafciu17.dev.openstreetmap.org/samples/sample_map_request.txt">sample file</a>
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