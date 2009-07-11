<h2>Test page</h2>
{assign var=host value=http://dev.openstreetmap.org/~pafciu17}
<div>
	<h3>Conditions and terms of use</h3>
	<ul>
	<li>Some information, conditions of use, etc</li>
	<li>...</li>
	</ul>
	<div>
		If you are using OSM static maps api it means that you read and accepted terms and conditions of use
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
		Supported url attributes:
		<ul>
			<li><b>type</b>: it indicates which tile server should be used to build up map. Possible values: mapnik, cycle, osmrender. Mapnik is a default value. Samples:
			<br /><a href="{$host}/?module=map&bbox=0,70,40,50&width=300&height=300&type=mapnik">{$host}/?module=map&bbox=0,70,40,50&width=300&height=300&type=mapnik</a><br />
			<a href="{$host}/?module=map&bbox=0,70,40,50&width=300&height=300&type=cycle">{$host}/?module=map&bbox=0,70,40,50&width=300&height=300&type=cycle</a> <br />
			<a href="{$host}/?module=map&bbox=0,70,40,50&width=300&height=300&type=osmrender">{$host}/?module=map&bbox=0,70,40,50&width=300&height=300&type=osmrender</a> <br />
			</li>
			<li><b>imgType</b>: image type of returned image. Possible values: png, gif, jpg. Default value is png. Samples:<br />
			<a href="{$host}/?module=map&bbox=-30,30,0,0&width=300&height=300&type=mapnik&imgType=gif">{$host}/?module=map&bbox=-30,30,0,0&width=300&height=300&type=mapnik&imgType=gif</a>
			<a href="{$host}/?module=map&bbox=-30,30,0,0&width=300&height=300&type=mapnik&imgType=jpg">{$host}/?module=map&bbox=-30,30,0,0&width=300&height=300&type=mapnik&imgType=jpg</a>
			</li>
			<li><b>center</b>: it describes two coordinates of center point separted by comma: longitude (value from -180 to 180) and latitude(from -85.0511 to 85.0511)  indicate coordinates of the center point of the map. Samples: <br />
			<a href="{$host}/?module=map&center=180,20&zoom=2&width=1200&height=1200">{$host}/?module=map&center=180,20&zoom=2&width=1200&height=1200</a>
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
			<li><b>paths</b>: coordinates of paths, paths are separeted by semi-colons. Sample:<br />
			<a href="{$host}/?module=map&bbox=-100,45,-67,5&width=600&paths=-74,40.34,-82.3,23.1,-85,35,-87.2,32.12;-90,40,-80,40">{$host}/?module=map&bbox=-100,45,-67,5&width=600&paths=-74,40.43,-82.3,23.1,-85,35,-87.2,32.12;-90,40,-80,40</a>
			</li>
			<li><b>color</b>: color of drawnings, given as 3 RPG coordinates. Sample:<br />
			<a href="{$host}/?module=map&bbox=-80,50,-67,15&width=500&points=-74,40.344,-82.3,23.1&color=150,0,0">{$host}/?module=map&bbox=-80,50,-67,15&width=500&points=-74,40.34,-82.3,23.1&color=150,0,0</a>
			</li>
		</ul>
	</p>
	
</div>
