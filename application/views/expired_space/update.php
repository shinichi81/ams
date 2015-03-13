<?php if ($update == "Y"): ?>
<h3 id="adduser">FORM UPDATE</h3>
<form id="form">
	<fieldset id="personal">
		<legend>Data</legend>
		<div style="float: left;">
			<label for="nospace">No Space : </label>
			<input name="txtNoSpace" id="txtNoSpace" type="text" disabled="disabled" value="<?php echo $all_data->no_space; ?>" /> <span class="error" id="errNoSpace"></span>
			<br>
			<label for="agency">Agency : </label> 
			<select name="selectAgency" id="selectAgency" style="width: 150px;">
				<option value="-">-</option>
				<?php 
				foreach ($all_agency as $agency):
					$selected = "";
					if ($all_data->agency_id == $agency->id)
						$selected = "selected='selected'";
				?>
				<option value="<?php echo $agency->id; ?>" <?php echo $selected; ?>><?php echo $agency->name; ?></option>
				<?php endforeach; ?>
			</select>
			<br>
			<label for="client">Client : </label>
			<select name="selectClient" id="selectClient" style="width: 150px;">
				<?php 
				foreach ($all_client as $client):
					$selected = "";
					if ($all_data->client_id == $client->id)
						$selected = "selected='selected'"; 
				?>
				<option value="<?php echo $client->id; ?>" <?php echo $selected; ?>><?php echo $client->name; ?></option>
				<?php endforeach; ?>
			</select>
			<br>
			<label for="miscinfo">Keterangan : </label> 
			<textarea name="txtMiscInfo" id="txtMiscInfo" style="height: 80px; width: 250px;"><?php echo $all_data->misc_info; ?></textarea>
		</div>
	</fieldset>
	<fieldset id="space">
		<legend>Space</legend>
		<button type="button" name="btnTambah" id="btnTambah" title="Tambah" class="btn"><img src="<?php echo image_url("icons/add.png"); ?>" alt="Tambah" /></button> <span class="error" id="errSpace"></span>
		<table>
			<thead>
				<th>Iklan</th>
				<th>Kanal</th>
				<th>Produk Grup</th>
				<th>Posisi</th>
				<th>Periode</th>
				<th>Keterangan</th>
				<th>&nbsp;</th>
			</thead>
			<tbody id="addme">
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
						<textarea name='txtMiscInfoSpace' id='txtMiscInfoSpace' style='height: 30px; width: 150px;'><?php echo $detail->misc_info; ?></textarea>
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
			</tbody>
		</table>
	</fieldset>
	<fieldset id="conflict">
		<legend>Conflict Brand</legend>
		<label for="conflict">Conflict Brand : </label> 
		<input type="checkbox" name="chkIsRestrict" id="chkIsRestrict" value="Y" <?php echo ($all_data->is_restrict == "Y") ? "checked='checked'" : ""; ?> /> Ya
		<span class="industry" <?php echo ($all_data->is_restrict == "Y") ? "" : "style='display: none;'"; ?>>
		<br>
		<label for="industry">Industri : </label>
		<select name="selectIndustry" id="selectIndustry">
			<?php 
			foreach ($all_industry as $industry):
				$selected = "";
				if ($all_data->industry_id == $industry->id)
					$selected = "selected='selected'";  
			?>
			<option value="<?php echo $industry->id; ?>" <?php echo $selected; ?>><?php echo $industry->name; ?></option>	
			<?php endforeach; ?>
		</select>
		</span>
	</fieldset>
	<div class="ajax-loader" style="display: none;">&nbsp;</div>
	<div align="center">
		<input id="button1" type="button" value="Simpan" onclick="ajaxChange('expired_space', 'update', '<?php echo site_url("expired_space/update"); ?>', '<?php echo site_url("expired_space/content"); ?>', '<?php echo site_url("expired_space/insert_page"); ?>')" /> 
		<input id="button2" type="button" value="Kembali" onclick="loadForm('<?php echo site_url("expired_space/insert_page"); ?>')" />
	</div>
</form>

<script type="text/javascript">
	$(document).ready(function() {
		$("#btnTambah").click(function() {
			$("#addme").append("<tr class='remove'>"+
							   "	<td align='center'>"+
							   "		<select name='selectAds' id='selectAds'>"+
							   "			<?php foreach ($all_ads as $ads): ?>"+
							   "			<option value='<?php echo $ads->id; ?>'><?php echo $ads->name; ?></option>"+
							   "			<?php endforeach; ?>"+
							   "		</select>"+
							   "	</td>"+
							   "	<td align='center'>"+
							   "		<select name='selectKanal' id='selectKanal'>"+
							   "			<?php foreach ($all_kanal as $kanal): ?>"+
							   "			<option value='<?php echo $kanal->id; ?>'><?php echo $kanal->name; ?></option>"+
							   "			<?php endforeach; ?>"+
							   "		</select>"+
							   "	</td>"+
							   "	<td align='center'>"+
							   "		<select name='selectProductGroup' id='selectProductGroup'>"+
							   "			<?php foreach ($all_productgroup as $productgroup): ?>"+
							   "			<option value='<?php echo $productgroup->id; ?>'><?php echo $productgroup->name; ?></option>"+
							   "			<?php endforeach; ?>"+
							   "		</select>"+
							   "	</td>"+
							   "	<td align='center'>"+
							   "		<select name='selectPosition' id='selectPosition'>"+
							   "			<?php foreach ($all_position as $position): ?>"+
							   "			<option value='<?php echo $position->id; ?>'><?php echo $position->name; ?></option>"+
							   "			<?php endforeach; ?>"+
							   "		</select>"+
							   "	</td>"+
							   "	<td align='center'>"+
							   "		<input name='txtStartDate' class='txtStartDate' type='text' size='7' onmousedown='$(this).datepicker({dateFormat: \"yy-mm-dd\", minDate: new Date(<?php echo date("Y"); ?>, <?php echo date("n") - 1; ?>, <?php echo date("j"); ?>)});' />"+
							   "		-"+
							   "		<input name='txtEndDate' class='txtEndDate' type='text' size='7' onmousedown='$(this).datepicker({dateFormat: \"yy-mm-dd\", minDate: new Date(<?php echo date("Y"); ?>, <?php echo date("n") - 1; ?>, <?php echo date("j"); ?>)});' />"+
							   "	</td>"+
							   "	<td align='center'>"+
							   "		<textarea name='txtMiscInfoSpace' id='txtMiscInfoSpace' style='height: 30px; width: 150px;'></textarea>"+
							   "	</td>"+
							   "	<td align='center'>"+
							   "		<button type='button' name='btnHapus' id='btnHapus' title='Hapus' class='btn'><img src='<?php echo image_url("icons/delete.gif"); ?>' alt='Hapus' /></button>"+
							   "		<div class='error' id='errConflict'></div>"+
							   "	</td>"+
							   "</tr>");
		});
		
		// gunakan fungsi live untuk membind event 'click' ke #btnHapus
		$("#btnHapus").die('click').live('click', function() {
			$(this).parents(".remove").remove();
		});
		
		// gunakan fungsi live untuk membind event 'change' ke #selectKanal
		$("#selectKanal").die('change').live('change', function() {
			var index = $(this).parents(".remove").prevAll().length;
			
			loadListOption(index, '<?php echo site_url("order_space/get_product_group"); ?>', 'selectKanal', 'selectProductGroup');
		});
		
		// gunakan fungsi live untuk membind event 'change' ke #selectProductGroup
		$("#selectProductGroup").die('change').live('change', function(event, index) {
			if (index == undefined)
				var index = $(this).parents(".remove").prevAll().length;
				
			loadListOption(index, '<?php echo site_url("order_space/get_position"); ?>', 'selectProductGroup', 'selectPosition');
		});
		<? /*
		// untuk autocomplete Agency
		$("#txtAgency").autocomplete({
			source: "<?php echo site_url("order_space/get_agency"); ?>",
			minLength: 2,
			select: function(event, ui) {
				$("#txtAgency").attr("nilai", ui.item.id);
			}
		});
		
		// untuk autocomplete Client
		$("#txtClient").autocomplete({
			source: "<?php echo site_url("order_space/get_client"); ?>",
			minLength: 2,
			select: function(event, ui) {
				$("#txtClient").attr("nilai", ui.item.id);
			}
		});
		*/ ?>
		// untuk menampilkan inputan industri
		$("#chkIsRestrict").click(function() {
			if ($(this).is(":checked"))
				$(".industry").show();
			else
				$(".industry").hide();
		});
	});
</script>
<?php endif; ?>