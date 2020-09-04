<?php  $class="hiddenbox"; ?>
<div  class="invbox" style="background:rgba(255,255,0,0.3);">
	<div id="boxcoming" class="textinvbox2">
		<img src="resurUs/images/shopping.png" class="cur" onclick="getviewcoming ()">
	</div>
</div>
<?php foreach ($amont as $k=>$name):?>
	 <?php if ($k==$tm) $class="";?>
	<div class="invbox hinvbox <?php echo $class?>" style="background:rgba(255,255,0,0.6);" > 
		<table cellspacing="0" cellpadding="10" border="1" width="100%" style="border-color:rgba(255,255,0,1);">
			<tr  >
				<td onclick="viewtabout (<?=$k?>)" class="cur">
					<?=$name?>  
				</td>
				<td class="tabsumm2"> 	
					<div style="float:right; margin-top:-20px;">
						<?php if ($k==$tm): ?>
							<span class="texttab">остаток</span>
						<?php echo $summ; else: ?><?php endif?>
							<span class="texttab2">потраченно <?php echo $spent[$k] ?></span>
					</div>
				</td>
		</table>
	</div>
	<div  class="invbox <?php echo $class?>" style="background:rgba(255,255,0,0.3);">
		
		<div id="boxtab<?=$k?>" class="textinvbox">
			 <?php if ($k==$tm):?>
				<script>
					viewtabout (<?=$k?>);
				</script>
			 <?php endif?>
		</div>
	</div>
		
	
<?php endforeach; ?>