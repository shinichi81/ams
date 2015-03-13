<?php if ($update == "Y"): ?>
<h3>FORM UPDATE</h3>
<form id="form">
	<fieldset id="personal">
		<legend>Data</legend>
		<label for="kanal">Kanal : </label>
		<select name="selectKanal" id="selectKanal" style="width:150px;" >
			<?php foreach ($all_kanal as $kanal):
				  $selected = "";
				  if ($kanal->id == $all_data->id_kanal)
						$selected = "selected='selected'";
			?>
			<option value="<?php echo $kanal->id; ?>" <?php echo $selected; ?>><?php echo $kanal->name; ?></option>
			<?php endforeach; ?>
		</select>
		<br />
		<label for="rubrik">Rubrik : </label>
		<select name="selectRubrik" id="selectRubrik" class="list_rubrik" >
			<?php foreach ($all_rubrik as $rubrik):
				  $selected = "";
				  if ($rubrik->id == $all_data->id_rubrik)
						$selected = "selected='selected'";
			?>
			<option value="<?php echo $rubrik->id; ?>" <?php echo $selected; ?>><?php echo $rubrik->name; ?></option>
			<?php endforeach; ?>
		</select>
		<br />
		<label for="produk">Produk Group : </label>
		<select name="selectProduk" id="selectProduk" class="list_produk" >
			<?php foreach ($all_produk as $produk):
				  $selected = "";
				  if ($produk->id == $all_data->id_product)
						$selected = "selected='selected'";
			?>
			<option value="<?php echo $produk->id; ?>" <?php echo $selected; ?>><?php echo $produk->name; ?></option>
			<?php endforeach; ?>
		</select>
		<br />
		<label for="position">Posisi : </label>
		<select name="selectPosition" id="selectPosition" style="width: 150px;">
			<?php foreach ($all_position as $position):
				  $selected = "";
				  if ($position->id == $all_data->id_position)
						$selected = "selected='selected'";
			?>
			<option value="<?php echo $position->id; ?>" <?php echo $selected; ?>><?php echo $position->name; ?></option>
			<?php endforeach; ?>
		</select>
        <br />
		<label for="harga">Harga : </label> 
		<input name="txtHarga" id="txtHarga" type="text" onkeydown='return numberOnly(event);' value="<?php echo $all_data->harga; ?>" /> <span class="error" id="errTxtHarga"></span>
		<input name="hdId" id="hdId" type="hidden" value="<?php echo $all_data->id; ?>" />
	</fieldset>
	<div class="ajax-loader" style="display: none;">&nbsp;</div>
	<div align="center">
		<input id="button1" type="button" value="Simpan" onclick="ajaxChange('harga', 'update', '<?php echo site_url("master_harga/update"); ?>', '<?php echo site_url("master_harga/content"); ?>', '<?php echo site_url("master_harga/insert_page"); ?>')" /> 
		<input id="button2" type="button" value="Kembali" onclick="loadForm('<?php echo site_url("master_harga/insert_page"); ?>')" />
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