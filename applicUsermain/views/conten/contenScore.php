	<table cellspacing="0" cellpadding="10" border="1" width="100%" align="center" style="font-size: 2.2em;">
	<tr>
		<th>Кат</th>
		<th>название</th>
		<th>Сумма</th>
		<th>подключение</th>
		<th>Истор</th>
		<th></th>
	</tr>
		
		
<?php foreach ($namei as $k=>$namei):?>
		<tr>
			<td><?php echo $namecat[$k]; ?></td>
			<td><?=$namei?> <br> <small><small><?php echo $disclosure[$k]; ?></small></small></td>
			<td><?php echo $summ[$k]; ?></td>
			<td>
			<?php foreach ($masCl[$k] as $cl):?>
				<?=$cl?>,
			<?php endforeach; ?>
			</td>
			<td>
			<?php  if($history[$k]): ?> <img src="/resurUs/images/clock_9593.png" class="cur" onclick='var helpDisc=window.open("/help/historyInvoce/<?php echo $k?>", "seting","width=1000,height=550")' />
			<?php else: ?> нет
			<?php endif; ?></td>
			<td><?php  if(!$history[$k] && $masCl[$k][0]=='нет'): ?><img src="/resurUs/images/remove_8853.png" class="cur" onclick="delScoreWindow (<?php echo $k ?>)" /><?php endif; ?></td>
		</tr>
<?php endforeach; ?>	
	</table>