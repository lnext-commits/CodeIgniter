	<?php foreach ($namei as $k=>$name):?>
		<div class="invbox hinvbox" style="background:rgba(<?php echo $color[$k] ?>,0.6);" <?php echo $hidden[$k]?>> 
		
			<table cellspacing="0" cellpadding="10" border="1" width="100%" style="border-color:rgba(<?php echo $color[$k] ?>,1);">
				<tr  >
					<td onclick="viewtaboutgo (<?php echo $idinv[$k]?>,<?=$k?>)" class="cur" rowspan="3">
						<?=$name?>  <br> <small><small><?php echo $disclosure[$k] ?></small></small>
					</td>
				</tr>
				<tr>
					<td class="tabsumm"> 
						<?php echo $summ[$k]?>
						
					</td>
				</tr>
				<tr>
					<td>
						<img src="resurUs/images/remove.png" class="iqom cur" onclick="abate (<?=$k?>,<?php echo $idinv[$k]?>)">
					</td>
				</tr>
			</table>
		</div>
	<div  class="invbox" style="background:rgba(<?php echo $color[$k] ?>,0.3);" <?php echo $hidden[$k]?>>
		<div id="boxtab<?=$k?>" class="textinvbox">
		</div>
	</div>
	<?php endforeach; ?>
	