<?php if ($update == "Y"): ?>
<h3 id="adduser">FORM UPDATE</h3>
<form id="form">
	<fieldset id="personal">
		<legend>Data</legend>
		<label for="selectAgency">Perusahaan : </label>
		<select name="selectAgency" id="selectAgency" style="width: 150px;">
			  <option value="-">-</option>
			  <?php
			  foreach ($all_agency as $agency):
					$selected = "";
					if ($all_data->perusahaan_id == $agency->id)
						  $selected = "selected='selected'";
					?>
					<option value="<?php echo $agency->id; ?>" <?php echo $selected; ?>><?php echo $agency->name; ?></option>
			  <?php endforeach; ?>
		</select>
		<br>
		<label for="name">Nama : </label> 
		<input name="txtName" id="txtName" type="text" value="<?php echo $all_data->name; ?>" /> <span class="error" id="errTxtName"></span>
		<br>
		<label for="address">Alamat : </label> 
		<input name="txtAddress" id="txtAddress" type="text" value="<?php echo $all_data->address; ?>" />
		<br>
		<label for="contact">Kontak : </label> 
		<input name="txtContact" id="txtContact" type="text" value="<?php echo $all_data->contact; ?>" />
		<input name="hdId" id="hdId" type="hidden" value="<?php echo $all_data->id; ?>" />
	</fieldset>
	<div class="ajax-loader" style="display: none;">&nbsp;</div>
	<div align="center">
		<input id="button1" type="button" value="Simpan" onclick="ajaxChange('unit', 'update', '<?php echo site_url("master_unit/update"); ?>', '<?php echo site_url("master_unit/content"); ?>', '<?php echo site_url("master_unit/insert_page"); ?>')" /> 
		<input id="button2" type="button" value="Kembali" onclick="loadForm('<?php echo site_url("master_unit/insert_page"); ?>')" />
	</div>
</form>
<?php endif; ?>