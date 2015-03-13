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
		<input id="button1" type="button" value="Simpan" onclick="ajaxChange('industry', 'insert', '<?php echo site_url("master_industry/insert"); ?>', '<?php echo site_url("master_industry/content"); ?>', '<?php echo site_url("master_industry/insert_page"); ?>')" /> 
		<input id="button2" type="button" value="Reset" onclick="loadForm('<?php echo site_url("master_industry/insert_page"); ?>')" />
	</div>
</form>
<?php endif; ?>