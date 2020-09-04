	<img src='../resurUs/images/left.png' class="cur" onclick="window.close();"> <br>
	<?php $np=0;?>
	<?php foreach ($scholboy as $k=>$name):?>
		<?php  if($k>0): ?>
			<?php $np++?>
			<div class="box_scholboy">
				<?php  if($dost<=2): ?>
					<img src='../resurUs/images/refresh.png' class='iqorowmenu cur' onclick='refresh (<?=$k?>)' /> 
					<img src='../resurUs/images/info.png' class='iqorowmenu cur' onclick='history (<?php echo $idboy[$k]; ?>)'>
				<?php else: ?>
				<?php endif; ?>
				<span id="boy<?=$k?>" ><?php echo $np ?>. <?=$name?></span>
			</div>		
		<?php endif; ?>
	<?php endforeach; ?>
	
