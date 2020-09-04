	<table cellspacing="0" cellpadding="10" border="1" width="100%" align="center">
		
		<?php $np=0; ?>
<?php foreach ($teacher as $k=>$name):?>
		<tr>
			<td ><span style="font-size: 2.5em;"><?php echo ++$np; ?></span></td>
			<td ><input type="text" name="teacher<?=$k?>" value="<?=$name?>" /></td>
			<td ><input type="text" name="year<?=$k?>" value="<?php echo $income_year[$k] ?>" /></td>
			<td><img src="/resurUs/images/floopy.png" id="imgSave<?=$k?>" class="cur" onclick="saveRoom (<?php echo $k ?>);" /></td>
		</tr>
<?php endforeach; ?>
		<tr id="imgNewRoom">
			<td colspan="4"><img src="/resurUs/images/users.png" class="cur" onclick="addRoom ();" /></td>
		</tr>
	</table>
	<div id="newRoom"></div>