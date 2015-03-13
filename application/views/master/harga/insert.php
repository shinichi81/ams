<?php if ($create == "Y"): ?>
<h3 id="addharga">FORM INPUT</h3>
<form id="form">
	<fieldset id="personal">
		<legend>Data</legend>
		<label for="kanal">Kanal : </label>
		<select name="selectKanal" id="selectKanal" style="width:150px;" >
			<option value="" disabled selected>-- Pilih Kanal --</option>
			<?php foreach ($all_kanal as $kanal): ?>
			<option value="<?php echo $kanal->id; ?>"><?php echo $kanal->name; ?></option>
			<?php endforeach; ?>
		</select>
		<span class="error" id="errSelectKanal"></span>
		<br />
		<label for="rubrik">Rubrik : </label>
		<select name="selectRubrik" id="selectRubrik" class="list_rubrik" >
			<option value="" disabled selected>-- Pilih Rubrik --</option>
			<?php foreach ($all_rubrik as $rubrik): ?>
			<option value="<?php echo $rubrik->id; ?>"><?php echo $rubrik->name; ?></option>
			<?php endforeach; ?>
		</select>
		<br />
		<label for="produk">Produk Group : </label>
		<select name="selectProduk" id="selectProduk"  class="list_produk">
			<option value="" disabled selected>-- Pilih Produk --</option>
			<?php foreach ($all_produk as $produk): ?>
			<option value="<?php echo $produk->id; ?>"><?php echo $produk->name; ?></option>
			<?php endforeach; ?>
		</select>
		<br />
		<label for="position">Posisi : </label>
		<select name="selectPosition" id="selectPosition" style="width: 150px;">
			<option value="" disabled selected>-- Pilih Posisi --</option>
			<?php foreach ($all_position as $position): ?>
			<option value="<?php echo $position->id; ?>"><?php echo $position->name; ?></option>
			<?php endforeach; ?>
		</select>
		<span class="error" id="errSelectPosition"></span>
        <br />
		<label for="harga">Harga : </label> 
		<input name="txtHarga" id="txtHarga" type="text" onkeydown='return numberOnly(event);' value='0' /> <span class="error" id="errTxtHarga"></span>
	</fieldset>
	<div class="ajax-loader" style="display: none;">&nbsp;</div>
	<div align="center">
		<input id="button1" type="button" value="Simpan" onclick="ajaxChange('harga', 'insert', '<?php echo site_url("master_harga/insert"); ?>', '<?php echo site_url("master_harga/content"); ?>', '<?php echo site_url("master_harga/insert_page"); ?>')" /> 
		<input id="button2" type="button" value="Reset" onclick="loadForm('<?php echo site_url("master_harga/insert_page"); ?>')" />
	</div>
</form>
<script type="text/javascript">
   function numberOnly(e) {
		  var charCode = (e.which) ? e.which : e.keyCode;

		  if (!((charCode >= 48 && charCode <= 57) || charCode == 8 || charCode == 9))
				return false;
	}
	$(document).ready(function() {
		  $("#selectKanal").change(function() {
				loadListOption2('<?php echo site_url("master_harga/get_rubrik"); ?>', 'selectKanal', 'list_rubrik');
				loadListOption2('<?php echo site_url("master_harga/get_produk"); ?>', 'selectKanal', 'list_produk');
		  });
	});
</script>
<?php endif; ?>