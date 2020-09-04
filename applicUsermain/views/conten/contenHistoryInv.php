	<img src='/resurUs/images/left.png' class="cur" onclick="window.close();"> <br>
	<h1><?php echo $nameInvoice ?></h1>
	<table cellspacing="0" cellpadding="10" border="1" width="100%" align="center" style="font-size: 2.2em;">
	<tr>
		<th>дата</th>
		<th>сумма</th>
		<th>ком</th>
		<th>класс</th>
	</tr>	
<?php foreach ($dat as $k=>$d):?>
		<tr>
			<td><?=$d?></td>
			<td>
				<?php  if($sp[$k]): ?><span style="color: #4b9641"><?php echo $sp[$k] ?></span><?php endif; ?>
				<?php  if($sr[$k]): ?><span style="color: #a60000 "><?php echo $sr[$k] ?></span><?php endif; ?>
			</td>
			<td><?php echo $coment[$k]; ?></td>
			<td><?php echo $clroom[$k]; ?></td>
		</tr>
<?php endforeach; ?>	
	</table>