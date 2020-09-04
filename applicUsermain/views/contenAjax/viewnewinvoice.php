<select name='categoryinv' id='selcategorinv'>
	<option value='0' >выбрать категорию</option>
	<?php foreach ($namecat as $k=>$name):?>
				<option value='<?=$k?>' style='background:rgba(<?php echo $color[$k] ?>,0.6);'><?=$name?> </option>
	<?php endforeach; ?>
</select >
<div class='textzg'>Названия счета: </div>
<div class='inpttext'><input type='text' name='namei'> </div>
<div class='textzg'>пояснения счета: </div>
<div class='inpttext'><input type='text' name='disclosure'> </div>
<div class='textzg'>Сумма счета:</div>
<div class='inpttext'><input type='number' name='summ'></div>
<div class='textzg'><img src='../resurUs/images/floopy.png' class='cur' onclick='savenewinvoice ()'></div>
