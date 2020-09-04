	<div style='margin-top:25px;'>
		<input type='text' name='fio' value='<?php echo $fio ?>' ><br><br>
		<select name='lgota' class='sellgota' style='width:360px; text-align:center;'>
			<option value='0'>Удалить Ученика</option>
			<?php foreach ($sel as $k=>$name):?>
				<?php  if($id_lgota==$k): ?>
					<option value='<?=$k?>' selected ><?=$name?> </option>
				<?php else: ?>
					<option value='<?=$k?>'><?=$name?> </option>
				<?php endif; ?>
			<?php endforeach; ?>
		</select>
		<img src='resurUs/images/help.png' class='cur' style='margin-left:20px;' onclick='var helpDisc=window.open("/help/discounts", "help","width=1000,height=550")'>
	</div>