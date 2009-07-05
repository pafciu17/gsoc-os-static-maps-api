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
<div id="all">
<div id="top">
	<img src="media/osm_logo.png" />
	<b>OSM static maps API - prototype 0.1</b>
</div>
<div id="body"> 
<div id="menu">
{if isset($menu_file)}
	{include file="$menu_file"}
{/if}
</div>
<div id="content">
<div>
	
	<ul class="info">
	{foreach from=$info item=inf}
		<li ">{$inf}</li>
	{/foreach}
	</ul>
	<ul class="errors">
	{foreach from=$errors item=error}
		<li>{$error}</li>
	{/foreach}
	</ul>
</div>
	{include file="$content_file"}
</div>
</div>
<div id="down">
</div>
</div>
</body>
</html>