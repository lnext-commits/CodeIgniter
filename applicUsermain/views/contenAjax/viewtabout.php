<?php if ($cominbox):?>
	<div style="text-align:center;">Расход</div>
<?php else:?>
	<div style="text-align:center;">Приход</div>
<?php endif?>
<table cellspacing="0" cellpadding="10" border="1" width="100%">
	<tr>
		<th>Дата</th>
		<th>Сумма</th>
		<th>Пояснения</th>
	</tr>
	 <?php if ($f):?>
	<tr>
		<td><img src='resurUs/images/floopy.png' style='width:90px' class="cur" onclick="saveneed (<?php echo $pm ?>)"></td>
		<td><input type="number" name="cash" style="margin-top:10px;"></td>
		<td><input type="text" name="comm"></td>
	</tr>
	<?php endif?>
	<?php if ($fl>0):?>
	<?php foreach ($summ as $k=>$s):?>
	<tr >
		<td style="width:15%; text-align:center;"><small><small><?php echo date("d/m/y",strtotime($k))?></small></small></td>
		<td style="width:15%; text-align:center;"><?=$s?></td>
		<td><?php echo $comment[$k]; ?> </td>
	</tr>
	<?php endforeach; ?>
	<?php else: ?>
	<tr >
		<td colspan=3>Нет данных</td>
	</tr>	
	<?php endif?>
</table>