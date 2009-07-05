<h3>{$formHeader}</h3>
<div>
<form method="post">
<table class="form">
<tr>
	<td><label for="">Login</label></td>
	<td><input type="text" value="{$login}" name="login" /></td>
</tr>
<tr>
	<td><label for="">Password</label></td>
	<td><input type="text" value="" name="password" /></td>
</tr>
</table>
<div class="formButtons">
<input type="hidden" name="send" value="true" />
<input type="submit" value="login" />
</div>
</form>