<?php if ($update == "Y"): ?>
      <h3 id="adduser">FORM UPDATE</h3>
      <form id="form">
            <fieldset id="personal">
                  <legend>Data</legend>
                  <label for="name">Nama : </label> 
                  <input name="txtName" id="txtName" type="text" value="<?php echo $all_data->name; ?>" /> <span class="error" id="errTxtName"></span>
                  <br>
                  <label for="keterangan">Keterangan : </label> 
                  <input name="txtKeterangan" id="txtKeterangan" type="text" value="<?php echo $all_data->misc_info; ?>" />
                  <br>
				  <label for="price">Harga : </label> 
                  <input name="price" id="price" type="number" value="<?php echo $all_data->price; ?>" />
				  <?php /*
                    <br>
                    <label for="override">Dapat Ditimpa : </label>
                    <input type="radio" name="rdbOverride" value="Y" <?php echo ($all_data->allow_override == "Y") ? "checked='checked'" : ""; ?> /> Ya
                    <input type="radio" name="rdbOverride" value="N" <?php echo ($all_data->allow_override == "N") ? "checked='checked'" : ""; ?> /> Tidak
                    <div id="cpm" <?php echo ($all_data->allow_override == "Y") ? "" : "style='display: none;'"; ?>>
                    <label for="keterangan">CPM Quota : </label>
                    <input name="txtCpmQuota" id="txtCpmQuota" value="<?php echo number_format($all_data->cpm_quota, 0, ",", "."); ?>" type="text" onkeyup="currencySeparator(this, '.')" onkeydown="return numberOnly(event);" />
                    </div>
                   */ ?>
                  <input name="hdId" id="hdId" type="hidden" value="<?php echo $all_data->id; ?>" />
            </fieldset>
            <div class="ajax-loader" style="display: none;">&nbsp;</div>
            <div align="center">
                  <input id="button1" type="button" value="Simpan" onclick="ajaxChange('position', 'update', '<?php echo site_url("master_position/update"); ?>', '<?php echo site_url("master_position/content"); ?>', '<?php echo site_url("master_position/insert_page"); ?>')" /> 
                  <input id="button2" type="button" value="Kembali" onclick="loadForm('<?php echo site_url("master_position/insert_page"); ?>')" />
            </div>
      </form>
<?php endif; ?>

<?php /*
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

  $(document).ready(function() {
  $("input[name=rdbOverride]").click(function() {
  if ($(this).val() == "Y")
  $("#cpm").show();
  else
  $("#cpm").hide();
  });
  });
  </script>
 */ ?>