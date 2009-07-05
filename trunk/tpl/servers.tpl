<h3>Tile servers</h3>
<table class="listTable">
<tr>
	<th>
		Name
	</th>
	<th>
		Url name
	</th>
	<th>
		Url pattern
	</th>
	<th>
		Tile width
	</th>
	<th>
		Tile height
	</th>
	<th>
		Min. zoom
	</th>
	<th>
		Max. zoom
	</th>
	<th>
		Options
	</th>
</tr>
{assign var=rowMark value=1}
{foreach from=$servers item=server}
	<tr {if $rowMark == 1} class="oddRow" {assign var=rowMark value=2} {else} class="evenRow" {assign var=rowMark value=1} {/if}>
		<td>
			{$server->name}
		</td>
		<td>
			{$server->urlName}
		</td>
		<td>
			{assign var=url value=$server->getServerUrl()}
			{$url->getUrlPatternWithHtmlSpecialChars()}
		</td>
		<td>
			{$server->tileWidth}
		</td>
		<td>
			{$server->tileHeight}
		</td>
		<td>
			{$server->minZoom}
		</td>
		<td>
			{$server->maxZoom}
		</td>
		<td>
			<a href="?{$conf->get('module_url_variable_name')}={$appMap->getModuleUrlName('AdminModule')}&page={$appMap->getModuleActionUrlName('AdminModule', 'ModuleActionEditServer')}&id={$server->id}">edit</a>
		</td>
	</tr>
{/foreach}
</table>
<div class="underListTableOptions">
<a href="?{$conf->get('module_url_variable_name')}={$appMap->getModuleUrlName('AdminModule')}&{$conf->get('action_url_variable_name')}={$appMap->getModuleActionUrlName('AdminModule', 'ModuleActionAddNewServer')}">Add new server</a>
</div>