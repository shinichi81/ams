<?php if ($update == "Y"): ?>
      <h3 id="adduser">FORM UPDATE</h3>
      <form id="form" enctype="multipart/form-data" action="<?php echo site_url("po/do_upload"); ?>">
            <fieldset id="offer_position">
                  <legend>Data</legend>
                        <label for="nopaket">No Paket : </label> 
                        <input name="txtNoPaket" id="txtNoPaket" type="text" disabled="disabled" value="<?php echo $all_data->no_paket; ?>" />
                        <br>
                        <label for="nopaketuser">No Paket User : </label> 
                        <input name="txtNoPaketUser" id="txtNoPaketUser" type="text" disabled="disabled" value="<?php echo $all_data->no_paket_user; ?>" />
                        <br>
                        <label for="agency">Perusahaan : </label> 
                        <select name="selectAgency" id="selectAgency" style="width: 150px;">
                              <option value="-">-</option>
                              <?php
                              foreach ($all_agency as $agency):
                                    $selected = "";
                                    if ($all_data->agency_id == $agency->id)
                                          $selected = "selected='selected'";
                                    ?>
                                    <option value="<?php echo $agency->id; ?>" <?php echo $selected; ?>><?php echo $agency->name; ?></option>
                              <?php endforeach; ?>
                        </select>
                        <br>
                        <label for="unit">Unit : </label> 
                        <input name="txtUnit" id="txtUnit" type="text" disabled="disabled" value="<?php echo $all_data->unit; ?>" />
                        <br>
                        <label for="client">Brand : </label> 
                        <input name="txtClient" id="txtClient" type="text" disabled="disabled" value="<?php echo $all_data->brand; ?>" />
						<br />
                  <label for="noPO">No PO : </label> 
                  <input name="noPO" id="noPO" type="text" value="<?php echo $all_data->no_po; ?>" />
                  <br>
                  <label for="noSO">No SO : </label> 
                  <input name="noSO" id="noSO" type="text" value="<?php echo $all_data->no_so; ?>" />
                  <br>
				  <label for="bukti">Bukti Tayang & Report : </label> 
				  <input name="userfile[]" id="userfile" type="file" multiple />
				  <br>
				  <label for="upload"></label>
				  <input type="submit" name="upload" id="upload" value="Upload">
				  <br />
				  <div class="progress">
					<div class="bar"></div >
					<div class="percent">0%</div >
				  </div>
				  <div id="status"></div>
                  <input name="hdId" id="hdId" type="hidden" value="<?php echo $all_data->no_paket; ?>" />
            </fieldset>
            <div class="ajax-loader" style="display: none;">&nbsp;</div>
            <div align="center">
                  <input id="button1" type="button" value="Simpan" onclick="ajaxChange('po', 'update', '<?php echo site_url("po/update"); ?>', '<?php echo site_url("po/content"); ?>', '<?php echo site_url("po/insert_page"); ?>')" /> 
                  <input id="button2" type="button" value="Kembali" onclick="loadForm('<?php echo site_url("po/insert_page"); ?>')" />
            </div>
      </form>

<?php echo js("jquery.form.js"); ?>
      <script type="text/javascript">
		$(document).ready(function() {
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