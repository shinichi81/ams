<?php if ($update == "Y"): ?>
      <h3 id="adduser">FORM UPDATE</h3>
      <form id="form">
            <fieldset id="personal">
                  <legend>Data</legend>
                  <label for="noPO">No PO : </label> 
                  <input name="noPO" id="noPO" type="text" style="background-color:#DCDCDC;" value="<?php echo $all_data->no_po; ?>" readonly />
                  <br>
                  <label for="noSO">No SO : </label> 
                  <input name="noSO" id="noSO" type="text" style="background-color:#DCDCDC;" value="<?php echo $all_data->no_so; ?>" readonly />
                  <br>
                  <label>Approve : </label> 
                  <input name="rdbApprove" type="radio" value="Y" checked="checked" /> Ya&nbsp;&nbsp;&nbsp;
                  <input name="rdbApprove" type="radio" value="N" /> Tidak
				  <br />
				  <div id="divAlasan">
					  <label for="alasan">Keterangan : </label>
					  <textarea name="alasan" id="alasan" style="height: 50px; width: 180px;"></textarea>
                  </div>
				  <input name="hdId" id="hdId" type="hidden" value="<?php echo $all_data->no_paket; ?>" />
            </fieldset>
            <div class="ajax-loader" style="display: none;">&nbsp;</div>
            <div align="center">
                  <input id="button1" type="button" value="Simpan" onclick="ajaxChange('approve_manager', 'update', '<?php echo site_url("approve_manager/update"); ?>', '<?php echo site_url("approve_manager/content"); ?>', '<?php echo site_url("approve_manager/insert_page"); ?>')" /> 
                  <input id="button2" type="button" value="Kembali" onclick="loadForm('<?php echo site_url("approve_manager/insert_page"); ?>')" />
            </div>
      </form>

      <script type="text/javascript">
            $(document).ready(function() {
				$("#divAlasan").hide();
				$('input:radio[name="rdbApprove"]').change(
					function(){
						if ($(this).val() == 'Y') {
							$("#divAlasan").hide();
						}
						else {
							$("#divAlasan").show();
						}
					});
			});				
      </script>
<?php endif; ?>