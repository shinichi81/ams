<?php if ($update == "Y"): ?>
<h3 id="addproduction">FORM UPDATE</h3>
<form id="form">
	<fieldset id="personal">
		<legend>Data</legend>
		<label for="name">Nama : </label> 
		<input name="txtName" id="txtName" type="text" value="<?php echo $all_data->nama; ?>" /> <span class="error" id="errTxtName"></span>
		<br />
		<label for="harga">Harga : </label> 
		<input name="txtHarga" id="txtHarga" type="text" onkeydown='return numberOnly(event);' value="<?php echo $all_data->harga; ?>" /> <span class="error" id="errTxtHarga"></span>
		<input name="hdId" id="hdId" type="hidden" value="<?php echo $all_data->id; ?>" />
	</fieldset>
	<div class="ajax-loader" style="display: none;">&nbsp;</div>
	<div align="center">
		<input id="button1" type="button" value="Simpan" onclick="ajaxChange('production', 'update', '<?php echo site_url("master_production/update"); ?>', '<?php echo site_url("master_production/content"); ?>', '<?php echo site_url("master_production/insert_page"); ?>')" /> 
		<input id="button2" type="button" value="Kembali" onclick="loadForm('<?php echo site_url("master_production/insert_page"); ?>')" />
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