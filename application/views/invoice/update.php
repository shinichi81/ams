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
                  <label for="noInvoice">No Invoice : </label> 
                  <input name="noInvoice" id="noInvoice" type="text" value="<?php echo $all_data->no_invoice; ?>" />
                  <br>
					<label for="tanggal">Tangal Jatuh Tempo : </label> 
					<input name='txtTempo' id='txtTempo' class='txtTempo' type='text' style='width:70px;' readonly='readonly' onmousedown='$(this).datepicker({dateFormat: "yy-mm-dd", minDate: new Date(<?php echo date("Y"); ?>, <?php echo date("n") - 1; ?>, <?php echo date("j"); ?>)});' value="<?php echo $all_data->jatuh_tempo; ?>" />
                  <input name="hdId" id="hdId" type="hidden" value="<?php echo $all_data->no_paket; ?>" />
            </fieldset>
            <div class="ajax-loader" style="display: none;">&nbsp;</div>
            <div align="center">
                  <input id="button1" type="button" value="Simpan" onclick="ajaxChange('invoice', 'update', '<?php echo site_url("invoice/update"); ?>', '<?php echo site_url("invoice/content"); ?>', '<?php echo site_url("invoice/insert_page"); ?>')" /> 
                  <input id="button2" type="button" value="Kembali" onclick="loadForm('<?php echo site_url("invoice/insert_page"); ?>')" />
            </div>
      </form>

      <script type="text/javascript">
            $(document).ready(function() {
			});				
      </script>
<?php endif; ?>