<img src='../resurUs/images/left.png' class="cur" onclick="window.close();"> <br>
<?php $np=0; $tempnamecat="";?>
<table cellspacing="0" cellpadding="10" border="1">
<?php foreach ($namei as $k=>$name):?>
<?php  if($tempnamecat!=$namecat[$k]):  $tempnamecat=$namecat[$k]; $np=0; ?>
	<tr style="background:rgba(<?php echo $color[$k] ?>,0.6);">
		<td colspan="4"><?php echo $namecat[$k]?></td>
	</tr>
<?php endif; ?>
	<tr style="background:rgba(<?php echo $color[$k] ?>,0.3);">
		<td><?php echo ++$np; ?>.</td>
		<td><?=$name?><br> <small><small><?php echo $disclosure[$k] ?></small></small></td>
		<td style="text-align:right;"><?php echo $summ[$k]?></td>
		<td><div id="switch<?=$k?>" class='<?php echo $switchcl[$k]?>' onclick="<?php echo $switchcl[$k]?> (<?=$k?>)"></div></td>
	</tr>
	<?php endforeach; ?>
</table>
<div id="newinvoice"><img src="../resurUs/images/datebase.png" class="cur" onclick="viewnewinvoice ()"></div>