	<img src='/resurUs/images/left.png' class="cur" onclick="window.close();"> <br>
	<div class="box_history">
		<div class="teacher">
			Учитель : <b><?php echo $teacher ?></b><br>
			год начала: <b><?php echo $income_year ?></b><br>
			<!--общая сумма <small><small><sub> c 2019г</sub></small></small> :  <?php echo $fact ?>-->
		</div>
		<span class="fio_tab"><?php echo $fio ?></span>
		<table class="tab_history">
			<rt>
				<th>Дата</th>
				<th>Сумма</th>
			</rt>
		<?php foreach ($summ as $k=>$sum):?>
			<tr>
				<td><?php echo $d[$k] ?></td>
				<td><?=$sum?></td> 
			</tr>
		<?php endforeach; ?>
		</table>
	</div>
	