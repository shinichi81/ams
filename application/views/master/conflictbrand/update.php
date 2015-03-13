<?php if ($update == "Y"): ?>
<h3 id="adduser">FORM UPDATE</h3>
<form id="form">
	<fieldset id="personal">
		<legend>Data</legend>
		<label for="name">Industri : </label> 
		<select name="selectIndustry" id="selectIndustry">
			<?php 
			foreach ($all_industry as $industry): 
				$selected = "";
				if ($industry->id == $all_data->industry_id)
					$selected = "selected='selected'"; 
			?>
			<option value="<?php echo $industry->id; ?>" <?php echo $selected; ?>><?php echo $industry->name; ?></option>
			<?php endforeach; ?>
		</select>
		<br>
		<label for="kanal">Kanal : </label> 
		<select name="selectKanal" id="selectKanal" onchange="loadListOption2('<?php echo site_url("master_conflictbrand/get_product_group") ?>', 'selectKanal', 'list_product_group')">
			<?php		 
			foreach ($all_kanal as $kanal):
				$selected = "";
				if ($kanal->id == $all_data->kanal_id)
					$selected = "selected='selected'"; 
			?>
			<option value="<?php echo $kanal->id; ?>" <?php echo $selected; ?>><?php echo $kanal->name; ?></option>
			<?php endforeach; ?>
		</select>
		<br>
		<label for="kanal">Produk Grup : </label> 
		<select name="selectProductgroup" id="selectProductgroup" class="list_product_group" onchange="loadListOption2('<?php echo site_url("master_conflictbrand/get_position") ?>', 'selectProductgroup', 'list_position')">
			<?php 
			foreach ($all_product_group as $product_group):
				$selected = "";
				if ($product_group->id == $all_data->product_group_id)
					$selected = "selected='selected'";  
			?>
			<option value="<?php echo $product_group->id; ?>" <?php echo $selected; ?>><?php echo $product_group->name; ?></option>
			<?php endforeach; ?>
		</select>
		<br>
		<label for="position">Posisi : </label> 
		<select name="selectPosition" id="selectPosition" class="list_position" multiple="multiple" size="5" style="width: 150px;">
			<?php foreach ($all_position as $position): ?>
			<option value="<?php echo $position->id; ?>"><?php echo $position->name; ?></option>
			<?php endforeach; ?>
		</select>
		<button type="button" name="btnRule" id="btnRule" title="Tambah Rule" class="btn"><img src="<?php echo image_url("icons/add.png"); ?>" alt="Tambah Rule" /></button> <span class="error" id="errTxtRule"></span>
		<br>
		<div id="addme">
			<?php for ($n=0; $n<count($all_rule); $n++): ?>
			<div class='remove'>
				<label for='rule'>Rule : </label>
			   	<input type='text' name='txtRule' id='txtRule' disabled='disabled' nilai='<?php echo $all_rule[$n]; ?>' value='<?php echo $all_rule_name[$n]; ?>' />
			   	<button type='button' name='btnHapus' id='btnHapus' title='Hapus' class='btn'><img src='<?php echo image_url("icons/delete.gif"); ?>' alt='Hapus' /></button><br>
		   	</div>
		   	<?php endfor; ?>
		</div>
		<input name="hdId" id="hdId" type="hidden" value="<?php echo $all_data->id; ?>" />
	</fieldset>
	<div class="ajax-loader" style="display: none;">&nbsp;</div>
	<div align="center">
		<input id="button1" type="button" value="Simpan" onclick="ajaxChange('conflictbrand', 'update', '<?php echo site_url("master_conflictbrand/update"); ?>', '<?php echo site_url("master_conflictbrand/content"); ?>', '<?php echo site_url("master_conflictbrand/insert_page"); ?>')" /> 
		<input id="button2" type="button" value="Kembali" onclick="loadForm('<?php echo site_url("master_conflictbrand/insert_page"); ?>')" />
	</div>
</form>

<script type="text/javascript">
	$(document).ready(function() {
		$("#btnRule").click(function() {
			var tempText = "";
			var tempVal = "";
			
			if ($("select[name=selectPosition] option:selected").length < 2) {
				alert("Minimal 2 posisi dipilih!");
				return false;
			}
			
			$("select[name=selectPosition] option:selected").each(function() {
				tempText += $(this).text() +",";
				tempVal += $(this).val() +",";
				//$(this).remove();
			});
			
			tempText = tempText.substring(0, tempText.length-1); // untuk menghilangkan "," di belakang
			tempVal = tempVal.substring(0, tempVal.length-1); // untuk menghilangkan "," di belakang
			
			/*if ($(this).attr("clicked") == "Y") {
				$("#addme").append("<div class='remove'>"+
								   "	<label for='nbsp'>&nbsp;</label>"+
								   "	<input type='text' name='txtRule' id='txtRule' disabled='disabled' nilai='"+tempVal+"' value='"+tempText+"' />"+
								   "	<input type='button' name='btnHapus' id='btnHapus' value='Hapus' /><br>"+
								   "</div>");
			} else {
				$("#addme").append("<div class='remove'>"+
								   "	<label for='rule'>Rule : </label>"+
							   	   "	<input type='text' name='txtRule' id='txtRule' disabled='disabled' nilai='"+tempVal+"' value='"+tempText+"' />"+
							       "	<input type='button' name='btnHapus' id='btnHapus' value='Hapus' /><br>"+
							       "</div>");
			}*/
			
			// tambah attribute "clicked" untuk menentukan apakah sebelumnya sudah di klik atau belum
			//$(this).attr("clicked", "Y");
			
			$("#addme").append("<div class='remove'>"+
							   "	<label for='rule'>Rule : </label>"+
						   	   "	<input type='text' name='txtRule' id='txtRule' disabled='disabled' nilai='"+tempVal+"' value='"+tempText+"' />"+
						       "	<button type='button' name='btnHapus' id='btnHapus' title='Hapus' class='btn'><img src='<?php echo image_url("icons/delete.gif"); ?>' alt='Hapus' /></button><br>"+
						       "</div>");
		});
		
		// gunakan fungsi live untuk membind event 'click' ke #btnHapus
		/*$("#btnHapus").die('click').live('click', function() {
			$parent = $(this).parents(".remove");			
			$position = $parent.children("#txtRule");			
			$positionValue = $position.attr("nilai").split(",");
			$positionText = $position.val().split(",");
			
			for (var n in $positionValue)
				$("#selectPosition").append("<option value='"+$positionValue[n]+"'>"+$positionText[n]+"</option>");
			
			$parent.remove();
		});*/
	});
</script>
<?php endif; ?>