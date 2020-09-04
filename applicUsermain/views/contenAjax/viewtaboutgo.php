	<table cellspacing="0" cellpadding="10" border="1" width="100%">
		<tr>
			<th>Дата</th>
			<th>Сумма</th>
			<th>Пояснения</th>
		</tr>
		<?php foreach ($summ as $k=>$s):?>
		<tr >
			<td style="width:15%; text-align:center;"><small><small><?php echo date("d/m/y",strtotime($k))?></small></small></td>
			<td style="width:15%; text-align:center;"><?=$s?></td>
			<td><?php echo $comment[$k]?></td>
		</tr>
		<?php endforeach; ?>
	</table>