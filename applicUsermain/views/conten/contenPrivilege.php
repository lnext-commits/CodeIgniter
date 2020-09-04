	<table cellspacing="0" cellpadding="10" border="1" width="100%" align="center">
		
		<?php $np=0; ?>
<?php foreach ($name as $k=>$namef):?>
		<tr>
			<td ><span style="font-size: 2.5em;"><?php echo ++$np; ?></span></td>
			<td ><input type="text" name="namel<?=$k?>" value="<?=$namef?>" /></td>
			<td ><input type="text" name="summ<?=$k?>" value="<?php echo $stake[$k] ?>" /></td>
			<td><img src="/resurUs/images/floopy.png" id="imgSave<?=$k?>" class="cur" onclick="savePrivilege (<?php echo $k ?>);" /></td>
		</tr>
<?php endforeach; ?>
		<tr id="imgNewPrivilege">
			<td colspan="4"><img src="/resurUs/images/users.png" class="cur" onclick="addPrivilege ();" /></td>
		</tr>
	</table>
	<div id="newPrivilege"></div>