<?php if ($create == "Y"): ?>
<h3 id="adduser">FORM INPUT</h3>
<form id="form" enctype="multipart/form-data" action="<?php echo site_url("offer_position/do_upload"); ?>">
	<fieldset id="offer_position">
		<legend>Offer Position</legend>
		<label for="paket">Tipe : </label> 
		<select name='selectAds' id='selectAds' class="w200">
	   		<?php foreach ($all_ads as $ads): ?>
	   		<option value='<?php echo $ads->id; ?>'><?php echo $ads->name; ?></option>
	   		<?php endforeach; ?>
	   	</select>
		<br>
		<label for="paket">Kanal : </label> 
		<select name='selectKanal' id='selectKanal' class="w200">
			<?php foreach ($all_kanal as $kanal): ?>
			<option value='<?php echo $kanal->id; ?>'><?php echo $kanal->name; ?></option>
			<?php endforeach; ?>
		</select>
		<br>
		<label for="paket">Produk Grup : </label> 
		<select name='selectProductGroup' id='selectProductGroup' class="w200">
   			<?php foreach ($all_productgroup as $productgroup): ?>
   			<option value='<?php echo $productgroup->id; ?>'><?php echo $productgroup->name; ?></option>
   			<?php endforeach; ?>
   		</select>
   		<br>
   		<label for="paket">Posisi : </label>
		<select name='selectPosition' id='selectPosition' class="w200">
			<?php foreach ($all_position as $position): ?>
			<option value='<?php echo $position->id; ?>'><?php echo $position->name; ?></option>
			<?php endforeach; ?>
		</select>
	</fieldset>
	<fieldset id="additional">
		<legend>Additional</legend>
		<div style="float: left; width: 400px;">
			<label for="paket">Dimension : </label> 
			<input name="txtDimension" id="txtDimension" type="text" /> <span class="error" id="errTxtDimension"></span>
			<br>
			<label for="paket">Size : </label> 
			<input name="txtSize" id="txtSize" type="text" /> <span class="error" id="errTxtSize"></span>
			<br>
			<label for="paket">Rate Period : </label> 
			<input type="radio" name="rdbRatePeriod" id="rdbRatePeriod" value="W" checked="checked" /> Weekly &nbsp;&nbsp;&nbsp;
			<input type="radio" name="rdbRatePeriod" id="rdbRatePeriod" value="M" /> Monthly
			<br>
			<label for="paket">Gross Rate : </label> 
			<input name="txtGrossRate" id="txtGrossRate" type="text" /> <span class="error" id="errTxtGrossRate"></span>
		</div>
		<div style="float: left;">
			<label for="budget">Picture : </label> 
			<input name="userfile" id="userfile" type="file" />
			<input type="submit" name="uploadPicture" id="uploadPicture" value="Upload Picture">
			<div class="progress">
		        <div class="bar"></div >
		        <div class="percent">0%</div >
		    </div>
		    <div id="status"></div>
			<br>
			<label for="diskon">Imp : </label> 
			<input name="txtImp" id="txtImp" type="text" /> <span class="error" id="errTxtImp"></span>
			<br>
			<label for="benefit">SOV : </label> 
			<input name="txtSov" id="txtSov" type="text" />
		</div>
	</fieldset>
	<div class="ajax-loader" style="display: none;">&nbsp;</div>
	<div align="center">
		<input id="button1" type="button" value="Simpan" onclick="ajaxChange('offer_position', 'insert', '<?php echo site_url("offer_position/insert"); ?>', '<?php echo site_url("offer_position/content"); ?>', '<?php echo site_url("offer_position/insert_page"); ?>')" /> 
		<input id="button2" type="button" value="Reset" onclick="loadForm('<?php echo site_url("offer_position/insert_page"); ?>')" />
	</div>
</form>

<?php echo js("jquery.form.js"); ?>
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