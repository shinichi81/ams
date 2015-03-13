<?php if ($create == "Y"): ?>
<h3 id="adduser">FORM INPUT</h3>
<form id="form">
	<fieldset id="personal">
		<legend>Data</legend>
		<label for="name">Nama : </label> 
		<input name="txtName" id="txtName" type="text" /> <span class="error" id="errTxtName"></span>
		<br>
		<label for="name">Rubrik : </label> 
		<input name="txtRubrik" id="txtRubrik" type="text" />
		<button type="button" name="btnTambah" id="btnTambah" title="Tambah" class="btn"><img src="<?php echo image_url("icons/add.png"); ?>" alt="Tambah" /></button> <span class="error" id="errTxtRubrik"></span>
		<div id="addme"></div>
	</fieldset>
	<div class="ajax-loader" style="display: none;">&nbsp;</div>
	<div align="center">
		<input id="button1" type="button" value="Simpan" onclick="ajaxChange('kanal', 'insert', '<?php echo site_url("master_kanal/insert"); ?>', '<?php echo site_url("master_kanal/content"); ?>', '<?php echo site_url("master_kanal/insert_page"); ?>')" /> 
		<input id="button2" type="button" value="Reset" onclick="loadForm('<?php echo site_url("master_kanal/insert_page"); ?>')" />
	</div>
</form>

<script type="text/javascript">
	$(document).ready(function() {
		$("#btnTambah").click(function() {
			$("#addme").append("<div class='remove'>"+
							   "	<label for='nbsp'>&nbsp;</label>"+
							   "	<input name='txtRubrik' id='txtRubrik' type='text' />"+
							   "	<button type='button' name='btnHapus' id='btnHapus' title='Hapus' class='btn'><img src='<?php echo image_url("icons/delete.gif"); ?>' alt='Hapus' /></button>"+
							   "</div>");
		});
		
		// gunakan fungsi live untuk membind event 'click' ke #btnHapus
		$("#btnHapus").die('click').live('click', function() {
			$(this).parent().remove();
		});
	});
</script>
<?php endif; ?>