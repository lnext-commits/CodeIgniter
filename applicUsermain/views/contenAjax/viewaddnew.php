	<div style='margin-top:25px;'>
		<input type='text' name='fio' autofocus><br><br>
		<select name='lgota' class='sellgota'>
			<?php foreach ($sel as $k=>$name):?>
				<option value='<?=$k?>'><?=$name?> </option>
			<?php endforeach; ?>
		</select>
		<img src='resurUs/images/help.png' class='cur' style='margin-left:20px;' onclick='var helpDisc=window.open("/help/discounts", "help","width=1000,height=550")'>
	</div>