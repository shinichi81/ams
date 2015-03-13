<?php if ($create == "Y"): ?>
<h3 id="addproduction">FORM INPUT</h3>
<form id="form">
	<fieldset id="personal">
		<legend>Data</legend>
		<label for="name">Nama : </label> 
		<input name="txtName" id="txtName" type="text" /> <span class="error" id="errTxtName"></span>
		<br />
		<label for="harga">Harga : </label> 
		<input name="txtHarga" id="txtHarga" type="text" onkeydown='return numberOnly(event);' value='0' /> <span class="error" id="errTxtHarga"></span>
	</fieldset>
	<div class="ajax-loader" style="display: none;">&nbsp;</div>
	<div align="center">
		<input id="button1" type="button" value="Simpan" onclick="ajaxChange('production', 'insert', '<?php echo site_url("master_production/insert"); ?>', '<?php echo site_url("master_production/content"); ?>', '<?php echo site_url("master_production/insert_page"); ?>')" /> 
		<input id="button2" type="button" value="Reset" onclick="loadForm('<?php echo site_url("master_production/insert_page"); ?>')" />
	</div>
</form>
<script type="text/javascript">
   function numberOnly(e) {
		  var charCode = (e.which) ? e.which : e.keyCode;
										
		  if (!((charCode >= 48 && charCode <= 57) || charCode == 8 || charCode == 9))
				return false;
	}
</script>
<?php endif; ?>