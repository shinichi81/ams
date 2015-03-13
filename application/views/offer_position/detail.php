<?php
$n = 0; 
foreach ($all_detail as $detail): 
?>
<tr class='remove'>
	<td align='center'>
   		<select name='selectAds' id='selectAds'>
   			<?php 
   			foreach ($all_ads as $ads):
				$selected = "";
				if ($detail->ads_id == $ads->id)
					$selected = "selected='selected'"; 
   			?>
   			<option value='<?php echo $ads->id; ?>' <?php echo $selected; ?>><?php echo $ads->name; ?></option>
   			<?php 
   			endforeach; 
   			?>
   		</select>
   	</td>
   	<td align='center'>
   		<select name='selectKanal' id='selectKanal'>
   			<?php 
   			foreach ($all_kanal as $kanal):
				$selected = "";
				if ($detail->kanal_id == $kanal->id)
					$selected = "selected='selected'";  
   			?>
   			<option value='<?php echo $kanal->id; ?>' <?php echo $selected; ?>><?php echo $kanal->name; ?></option>
   			<?php 
   			endforeach; 
   			?>
   		</select>
   	</td>
   	<td align='center'>
   		<select name='selectProductGroup' id='selectProductGroup'>
   			<?php 
   			foreach ($arr_productgroup[$n] as $productgroup): 
				$selected = "";
				if ($detail->product_group_id == $productgroup->id)
					$selected = "selected='selected'"; 
   			?>
   			<option value='<?php echo $productgroup->id; ?>' <?php echo $selected; ?>><?php echo $productgroup->name; ?></option>
   			<?php 
   			endforeach;
   			?>
   		</select>
   	</td>
   	<td align='center'>
   		<select name='selectPosition' id='selectPosition'>
   			<?php 
   			foreach ($arr_position[$n] as $position): 
				$selected = "";
				if ($detail->position_id == $position->id)
					$selected = "selected='selected'"; 
   			?>
   			<option value='<?php echo $position->id; ?>' <?php echo $selected; ?>><?php echo $position->name; ?></option>
   			<?php 
   			endforeach; 
   			?>
   		</select>
   	</td>
   	<td align='center'>
   		<input name='txtStartDate' class='txtStartDate' type='text' size='7' onmousedown="$(this).datepicker({dateFormat: 'yy-mm-dd', minDate: new Date(<?php echo date("Y"); ?>, <?php echo date("n") - 1; ?>, <?php echo date("j"); ?>)});" value="<?php echo $detail->start_date; ?>" />
   		-
   		<input name='txtEndDate' class='txtEndDate' type='text' size='7' onmousedown="$(this).datepicker({dateFormat: 'yy-mm-dd', minDate: new Date(<?php echo date("Y"); ?>, <?php echo date("n") - 1; ?>, <?php echo date("j"); ?>)});" value="<?php echo $detail->end_date; ?>" />
   	</td>
   	<td align='center'>
   		<textarea name='txtMiscInfoPaket' id='txtMiscInfoPaket' style='height: 30px; width: 150px;'><?php echo $detail->misc_info; ?></textarea>
	</td>
   	<td align='center'>
   		<button type='button' name='btnHapus' id='btnHapus' title='Hapus' class='btn'><img src='<?php echo image_url("icons/delete.gif"); ?>' alt='Hapus' /></button>
		<div class='error' id='errConflict'></div>
   	</td>
</tr>
<?php
	$n += 1; 
endforeach; 
?>