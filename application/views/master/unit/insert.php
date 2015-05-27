<?php if ($create == "Y"): ?>
<h3 id="adduser">FORM INPUT</h3>
<form id="form">
	<fieldset id="personal">
		<legend>Data</legend>
		<label for="selectAgency">Perusahaan : </label>
		<select name="selectAgency" id="selectAgency" style="width: 150px;">
				<option value="" disabled selected>-- Pilih Perusahaan --</option>
			  <?php foreach ($all_agency as $agency): ?>
					<option value="<?php echo $agency->id; ?>"><?php echo $agency->name; ?></option>
			  <?php endforeach; ?>
		</select>
		<br>
		<label for="name">Nama : </label> 
		<input name="txtName" id="txtName" type="text" /> <span class="error" id="errTxtName"></span>
		<br>
		<label for="address">Alamat : </label> 
		<input name="txtAddress" id="txtAddress" type="text" />
		<br>
		<label for="contact">Kontak : </label> 
		<input name="txtContact" id="txtContact" type="text" />
	</fieldset>
	<div class="ajax-loader" style="display: none;">&nbsp;</div>
	<div align="center">
		<input id="button1" type="button" value="Simpan" onclick="ajaxChange('unit', 'insert', '<?php echo site_url("master_unit/insert"); ?>', '<?php echo site_url("master_unit/content"); ?>', '<?php echo site_url("master_unit/insert_page"); ?>')" /> 
		<input id="button2" type="button" value="Reset" onclick="loadForm('<?php echo site_url("master_unit/insert_page"); ?>')" />
	</div>
</form>
<?php endif; ?>