<?php if ($create == "Y"): ?>
<h3 id="adduser">FORM INPUT</h3>
<form id="form">
	<fieldset id="personal">
		<legend>Data</legend>
		<label for="name">Nama : </label> 
		<input name="txtName" id="txtName" type="text" /> <span class="error" id="errTxtName"></span>
	</fieldset>
	<div class="ajax-loader" style="display: none;">&nbsp;</div>
	<div align="center">
		<input id="button1" type="button" value="Simpan" onclick="ajaxChange('department', 'insert', '<?php echo site_url("master_department/insert"); ?>', '<?php echo site_url("master_department/content"); ?>', '<?php echo site_url("master_department/insert_page"); ?>')" /> 
		<input id="button2" type="button" value="Reset" onclick="loadForm('<?php echo site_url("master_department/insert_page"); ?>')" />
	</div>
</form>
<?php endif; ?>