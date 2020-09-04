<div class="h1"><?php echo $monts; ?></div>
	<?php $np=0; $tempnamecat="";?>
	<?php foreach ($namei as $k=>$name):?>
	<?php  if($tempnamecat!=$namecat[$k]):  $tempnamecat=$namecat[$k]; $np=0; ?>
		<div class="invbox hinvbox" style="background:rgba(<?php echo $color[$k] ?>,0.6);">
			<?php  if($summ[$k]!=0):?>
			<table class="summtab">
				<tr>
					<td class="summtabup"><?php if($sumohistory[$k] != $sumoverall[$k]) echo $sumohistory[$k] ?></td>
					<td rowspan="2" class="summtaboverall"><?php  echo $sumoverall[$k] ?></td>
				</tr>
				<tr>
					<td class="summtabdown"><?php if ($sumoverall[$k]-$sumohistory[$k]>0) echo $sumoverall[$k]-$sumohistory[$k] ?></td>
				</tr>
			</table>
			<?php endif; ?>
			<?php echo $namecat[$k]; ?>
		</div>
		<?php endif; ?>
	<?php $np++?>
	<div class="invbox textinvbox <?php if ($summ[$k]!=0) echo $style[$k] ?>" style="background:rgba(<?php echo $color[$k] ?>,0.3);">
		<img src="<?php if ($style[$k]=="enabl" || $summ[$k]==0) echo"resurUs/images/remove.png"; else echo"resurUs/images/tick.png"; ?>" class="iqorowmenu cur" <?php if ($style[$k]=="enabl" || $summ[$k]==0) echo "onclick='topay ($k,$retained_money)'"; else echo ""; ?>>
		<div class="cash_box" ><div class="cash_nom"><?php echo $summ[$k] ?></div></div>
		<?php echo $np; ?>) <?=$name?>  <br> <small><small><?php echo $disclosure[$k] ?></small></small>
	</div>
	<?php endforeach; ?>
	<div id="box_input"><? echo $seting ?></div>