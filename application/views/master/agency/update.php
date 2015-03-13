<?php if ($update == "Y"): ?>
<h3 id="adduser">FORM UPDATE</h3>
<form id="form">
	<fieldset id="personal">
		<legend>Data</legend>
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
		<input id="button1" type="button" value="Simpan" onclick="ajaxChange('agency', 'update', '<?php echo site_url("master_agency/update"); ?>', '<?php echo site_url("master_agency/content"); ?>', '<?php echo site_url("master_agency/insert_page"); ?>')" /> 
		<input id="button2" type="button" value="Kembali" onclick="loadForm('<?php echo site_url("master_agency/insert_page"); ?>')" />
	</div>
</form>
<?php endif; ?>