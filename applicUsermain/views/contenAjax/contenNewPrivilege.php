	<?php $k=0; ?>
	<table cellspacing="0" cellpadding="10" border="1" width="100%" align="center">
		<tr>
			<td ><span style="font-size: 2.5em;"><?php echo $k; ?></span></td>
			<td ><input type="text" name="namel<?=$k?>" /></td>
			<td ><input type="text" name="summ<?=$k?>" /></td>
			<td><img src="/resurUs/images/floopy.png" id="imgSave<?=$k?>" class="cur" onclick="savePrivilege (<?php echo $k ?>);" /></td>
		</tr>
	</table>