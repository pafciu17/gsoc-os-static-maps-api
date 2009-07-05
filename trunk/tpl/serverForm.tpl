<h3>{$formHeader}</h3>
<div>
<form method="post">
<fieldset>
<table class="form">
<tr>
	<td><label for="">Name</label></td>
	<td><input type="text" value="{$server->name}" name="name" /> - unique system name of the server</td>
</tr>
<tr>
	<td><label for="">Url name</label></td>
	<td><input type="text" value="{$server->urlName}" name="urlName" /> - unique url server name, it is used in map request url to recognize the server </td>
</tr>
<tr>
	<td><label for="">Url pattern</label></td>
	<td><input type="text" value="{$server->url}" size="50" name="url"/> - parameters of the requested tile are expressed by tags: &lt;zoom&gt;, &lt;x&gt;, &lt;y&gt; </td>
</tr>
<tr>
	<td><label for="">Tile height</label></td>
	<td><input type="text" value="{$server->tileHeight}" name="tileHeight" /> - height of the tile from the server (in pixels)</td>
</tr>
<tr>
	<td><label for="">Tile width</label></td>
	<td><input type="text" value="{$server->tileWidth}" name="tileWidth" /> - width of the tile from the server (in pixels)</td>
</tr>
<tr>
	<td><label for="">Minimal zoom</label></td>
	<td><input type="text" value="{$server->minZoom}" name="minZoom" /> - minimal zoom which is handled by server</td>
</tr>
<tr>
	<td><label for="">Maximal zoom</label></td>
	<td><input type="text" value="{$server->maxZoom}" name="maxZoom" /> - maximal zoom which is handled by server</td>
</tr>
<tr>
	<td><label for="">Cache size</label></td>
	<td><input type="text" value="{$server->cacheSize}" name="cacheSize" /> - how many Mb is used for caching tiles from that server</td>
</tr>
</table>
<div class="formButtons">
<input type="hidden" name="send" value="true" />
<input type="submit" value="save" />
</div>
</fieldset>
</form>