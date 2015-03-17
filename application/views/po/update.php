<?php if ($update == "Y"): ?>
      <h3 id="adduser">FORM UPDATE</h3>
      <form id="form" enctype="multipart/form-data" action="<?php echo site_url("po/do_upload"); ?>">
            <fieldset id="personal">
                  <legend>Data</legend>
                  <label for="noPO">No PO : </label> 
                  <input name="noPO" id="noPO" type="text" value="<?php echo $all_data->no_po; ?>" />
                  <br>
                  <label for="noSO">No SO : </label> 
                  <input name="noSO" id="noSO" type="text" value="<?php echo $all_data->no_so; ?>" />
                  <br>
				  <label for="bukti">Bukti Tayang : </label> 
				  <input name="bukti" id="bukti" type="file" />
				  <input type="submit" name="uploadBukti" id="uploadBukti" value="Upload Picture">
				  <div class="progress">
					<div class="bar"></div >
					<div class="percent">0%</div >
				  </div>
				  <div id="statusBukti"></div>
				  <br>
<!--
				  <label for="report">Report : </label> 
				  <input name="report" id="report" type="file" />
				  <input type="submit" name="uploadReport" id="uploadReport" value="Upload File Excel">
				  <div class="progress">
					<div class="bar"></div >
					<div class="percent">0%</div >
				  </div>
				  <div id="statusReport"></div>
-->
                  <input name="hdId" id="hdId" type="hidden" value="<?php echo $all_data->no_paket; ?>" />
            </fieldset>
            <div class="ajax-loader" style="display: none;">&nbsp;</div>
            <div align="center">
                  <input id="button1" type="button" value="Simpan" onclick="ajaxChange('po', 'update', '<?php echo site_url("po/update"); ?>', '<?php echo site_url("po/content"); ?>', '<?php echo site_url("po/insert_page"); ?>')" /> 
                  <input id="button2" type="button" value="Kembali" onclick="loadForm('<?php echo site_url("po/insert_page"); ?>')" />
            </div>
      </form>

      <script type="text/javascript">
		$(document).ready(function() {
			/* s: UNTUK PROSES UPLOAD GAMBAR */
			var bar = $(".bar");
			var percent = $(".percent");
			var status = $("#statusBukti");
			   
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