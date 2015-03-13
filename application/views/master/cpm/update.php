<?php if ($update == "Y"): ?>
      <h3 id="adduser">FORM UPDATE</h3>
      <form id="form">
            <fieldset id="personal">
                  <legend>Data</legend>
                  <label for="name">Kanal : </label> 
                  <input type="text" value="<?php echo $all_data->kanal_name; ?>" disabled="disabled" />
                  <br>
                  <label for="name">Product Group : </label> 
                  <input type="text" value="<?php echo $all_data->product_group_name; ?>" disabled="disabled" />
                  <br>
                  <label for="name">Position : </label> 
                  <input type="text" value="<?php echo $all_data->position_name; ?>" disabled="disabled" />
                  <br>
                  <label for="name">Cpm Quota : </label> 
                  <input name="txtCpmQuota" id="txtCpmQuota" type="text" value="<?php echo number_format($all_data->cpm_quota, 0, ",", "."); ?>" onkeyup="currencySeparator(this, '.')" onkeydown="return numberOnly(event);" /> <span class="error" id="errTxtCpmQuota"></span>
                  <input name="hdId" id="hdId" type="hidden" value="<?php echo $all_data->id; ?>" />
            </fieldset>
            <div class="ajax-loader" style="display: none;">&nbsp;</div>
            <div align="center">
                  <input id="button1" type="button" value="Simpan" onclick="ajaxChange('cpm', 'update', '<?php echo site_url("master_cpm/update"); ?>', '<?php echo site_url("master_cpm/content"); ?>', '<?php echo site_url("master_cpm/insert_page"); ?>')" /> 
                  <input id="button2" type="button" value="Kembali" onclick="loadForm('<?php echo site_url("master_cpm/insert_page"); ?>')" />
            </div>
      </form>
<?php endif; ?>

<script type="text/javascript">
      function numberOnly(e) {
            var charCode = (e.which) ? e.which : e.keyCode;

            if (!((charCode >= 48 && charCode <= 57) || charCode == 8 || charCode == 9))
                  return false;
      }

      function currencySeparator(obj, separator) {
            a = obj.value;
            b = a.replace(/[^\d]/g, "");
            c = "";
            panjang = b.length;
            j = 0;

            for (i = panjang; i > 0; i--) {
                  j = j + 1;
                  if (((j % 3) == 1) && (j != 1)) {
                        c = b.substr(i-1,1) + separator + c;
                  } else {
                        c = b.substr(i-1,1) + c;
                  }
            }
            obj.value = c;
      }
</script>