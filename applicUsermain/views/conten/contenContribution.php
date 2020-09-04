
	<div id="box_input"><? echo $addboy ?></div>
	<?php $np=0;?>
	<?php foreach ($scholboy as $k=>$name):?>
	<?php $np++?>
	<div class="box_scholboy">
		
		<div class='box_progress'><progress value="<?php echo 4-$lgota[$k] ?>" max="3" style="width:100px; height:20px;"></progress></div>	
		<img src="resurUs/images/add.png" class="iqorowmenu cur" onclick="addcash (<?=$k?>)">
		<?php  if($dost<=2): ?>
			<img src='resurUs/images/notepad.png' class='iqorowmenu cur' onclick='editboy (<?=$k?>)'> 
			<img src='resurUs/images/info.png' class='iqorowmenu cur' onclick='history (<?=$k?>)'>
		<?php else: ?>
		<?php endif; ?>
		<div class="cash_box" style="<?php echo $color[$k] ?>"><div class="cash_nom"><?php echo $cash[$k] ?></div></div>
		<span id="boy<?=$k?>"><?php echo $np ?>. <?=$name?></span>
	</div>
	<?php endforeach; ?>
	<br><br>
	<div id="box_input"><? echo $oldboy ?></div>

	
