	<table cellspacing="0" cellpadding="10" border="1" width="100%" align="center">
		
		<?php $np=0; ?>
<?php foreach ($fio as $k=>$namef):?>
		<tr>
			<td rowspan="3"><span style="font-size: 2.5em;"><?php echo ++$np; ?></span></td>
			<td colspan="3"><input type="text" name="fio<?=$k?>" value="<?=$namef?>" /></td>
		</tr>	
		<tr>
			<td>
				<select name="tipPerson<?=$k?>">
					<?php foreach ($tipPerson as $i=>$name):?>
						<option value="<?=$i?>"<?php if ($idTip[$k]==$i) : ?> selected <?php endif;?>><?=$name?>
					<?php endforeach; ?>
				</select>
			</td>
			<td>
				<select name="access<?=$k?>">
					<?php foreach ($access as $i=>$name):?>
						<option value="<?=$i?>"<?php if ($dost[$k]==$i) : ?> selected <?php endif;?>><?=$name?>
					<?php endforeach; ?>
				</select>
			</td>
			<td>
				<select name="room<?=$k?>">
						<option value="0"> не закреплен
					<?php foreach ($class_room as $i=>$name):?>
						<option value="<?=$i?>"<?php if ($idClass[$k]==$i) : ?> selected <?php endif;?>><?=$name?>
					<?php endforeach; ?>
				</select>
			
			</td>
		</tr>
		<tr>
			<td colspan="3" height="215px">
				<input type="text" name="pass<?=$k?>" value="<?php echo $pas[$k] ?>" /><img src="/resurUs/images/floopy.png" id="imgSave<?=$k?>" class="cur" onclick="savePerson (<?php echo $k ?>);" />
			</td>
		</tr>
<?php endforeach; ?>
		<tr id="imgNewPerson">
			<td colspan="4"><img src="/resurUs/images/users.png" class="cur" onclick="addPerson ();" /></td>
		</tr>
	</table>
	<div id="newPerson"></div>