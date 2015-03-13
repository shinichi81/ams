<?php if ($update == "Y"): ?>
<h3 id="adduser">FORM UPDATE</h3>
<form id="form" enctype="multipart/form-data" action="<?php echo site_url("offer_position/do_upload"); ?>">
	<fieldset id="offer_position">
		<legend>Offer Position</legend>
		<label for="paket">Tipe : </label> 
		<select name='selectAds' id='selectAds' class="w200">
	   		<?php 
   			foreach ($all_ads as $ads):
				$selected = "";
				if ($all_data->ads_id == $ads->id)
					$selected = "selected='selected'"; 
   			?>
   			<option value='<?php echo $ads->id; ?>' <?php echo $selected; ?>><?php echo $ads->name; ?></option>
   			<?php 
   			endforeach; 
   			?>
	   	</select>
		<br>
		<label for="paket">Kanal : </label> 
		<select name='selectKanal' id='selectKanal' class="w200">
			<?php 
   			foreach ($all_kanal as $kanal):
				$selected = "";
				if ($all_data->kanal_id == $kanal->id)
					$selected = "selected='selected'";
   			?>
   			<option value='<?php echo $kanal->id; ?>' <?php echo $selected; ?>><?php echo $kanal->name; ?></option>
   			<?php 
   			endforeach; 
   			?>
		</select>
		<br>
		<label for="paket">Produk Grup : </label> 
		<select name='selectProductGroup' id='selectProductGroup' class="w200">
   			<?php 
   			foreach ($all_productgroup as $productgroup):
				$selected = "";
				if ($all_data->product_group_id == $productgroup->id)
					$selected = "selected='selected'";  
   			?>
   			<option value='<?php echo $productgroup->id; ?>' <?php echo $selected; ?>><?php echo $productgroup->name; ?></option>
   			<?php 
   			endforeach; 
   			?>
   		</select>
   		<br>
   		<label for="paket">Posisi : </label>
		<select name='selectPosition' id='selectPosition' class="w200">
			<?php 
   			foreach ($all_position as $position):
				$selected = "";
				if ($all_data->position_id == $position->id)
					$selected = "selected='selected'";  
   			?>
   			<option value='<?php echo $position->id; ?>' <?php echo $selected; ?>><?php echo $position->name; ?></option>
   			<?php 
   			endforeach; 
   			?>
		</select>
	</fieldset>
	<fieldset id="additional">
		<legend>Additional</legend>
		<div style="float: left; width: 400px;">
			<label for="paket">Dimension : </label> 
			<input name="txtDimension" id="txtDimension" type="text" value="<?php echo $all_data->dimension; ?>" /> <span class="error" id="errTxtDimension"></span>
			<br>
			<label for="paket">Size : </label> 
			<input name="txtSize" id="txtSize" type="text" value="<?php echo $all_data->size; ?>" /> <span class="error" id="errTxtSize"></span>
			<br>
			<label for="paket">Rate Period : </label>
			<input type="radio" name="rdbRatePeriod" id="rdbRatePeriod" value="W" <?php echo ($all_data->rate_period == "W") ? "checked='checked'" : ""; ?> /> Weekly &nbsp;&nbsp;&nbsp;
			<input type="radio" name="rdbRatePeriod" id="rdbRatePeriod" value="M" <?php echo ($all_data->rate_period == "M") ? "checked='checked'" : ""; ?> /> Monthly
			<br>
			<label for="paket">Gross Rate : </label>
			<input name="txtGrossRate" id="txtGrossRate" type="text" value="<?php echo $all_data->gross_rate; ?>" /> <span class="error" id="errTxtGrossRate"></span>
		</div>
		<div style="float: left;">
			<label for="budget">Picture Name : </label> 
			<!-- <input name="txtPictureName" id="txtPictureName" type="text" value="<?php echo $all_data->pictures_name; ?>" /> -->
			<input name="userfile" id="userfile" type="file" />
			<input type="submit" name="uploadPicture" id="uploadPicture" value="Upload Picture">
			<div class="progress">
		        <div class="bar"></div >
		        <div class="percent">0%</div >
		    </div>
		    <img src="<?php echo $all_data->pictures_name; ?>" border="0" width="100px" height="100px" class="ml_110" />
		    <div id="status"><?php echo substr($all_data->pictures_name, strrpos($all_data->pictures_name, "/") - strlen($all_data->pictures_name) + 1); ?></div>
			<br>
			<label for="diskon">Imp : </label> 
			<input name="txtImp" id="txtImp" type="text" value="<?php echo $all_data->imp; ?>" /> <span class="error" id="errTxtImp"></span>
			<br>
			<label for="benefit">SOV : </label> 
			<input name="txtSov" id="txtSov" type="text" value="<?php echo $all_data->sov; ?>" />
		</div>
		<input name="hdId" id="hdId" type="hidden" value="<?php echo $all_data->id; ?>" />
	</fieldset>
	<div class="ajax-loader" style="display: none;">&nbsp;</div>
	<div align="center">
		<input id="button1" type="button" value="Simpan" onclick="ajaxChange('offer_position', 'update', '<?php echo site_url("offer_position/update"); ?>', '<?php echo site_url("offer_position/content"); ?>', '<?php echo site_url("offer_position/insert_page"); ?>')" /> 
		<input id="button2" type="button" value="Reset" onclick="loadForm('<?php echo site_url("offer_position/insert_page"); ?>')" />
	</div>
</form>

<script type="text/javascript">
	$(document).ready(function() {
		// gunakan fungsi live untuk membind event 'change' ke #selectKanal
		$("#selectKanal").die('change').live('change', function() {
			loadListOption3('<?php echo site_url("order/get_product_group"); ?>', 'selectKanal', 'selectProductGroup');
		});
		
		// gunakan fungsi live untuk membind event 'change' ke #selectProductGroup
		$("#selectProductGroup").die('change').live('change', function(event, index) {
			loadListOption3('<?php echo site_url("order/get_position"); ?>', 'selectProductGroup', 'selectPosition');
		});
		
		/* s: UNTUK PROSES UPLOAD GAMBAR */
		var bar = $(".bar");
		var percent = $(".percent");
		var status = $("#status");
		   
		$("form").ajaxForm({
		    beforeSend: function() {
		        status.empty();
		        var percentVal = "0%";
		        bar.width(percentVal)
		        percent.html(percentVal);
		    },
		    uploadProgress: function(event, position, total, percentComplete) {
		        var percentVal = percentComplete + "%";
		        bar.width(percentVal)
		        percent.html(percentVal);
		    },
			complete: function(xhr) {
				status.html(xhr.responseText);
			}
		});
		/* e: UNTUK PROSES UPLOAD GAMBAR */
	});
</script>
<?php endif; ?>