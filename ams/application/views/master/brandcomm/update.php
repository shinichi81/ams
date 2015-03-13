<?php if ($update == "Y"): ?>
      <h3 id="adduser">FORM UPDATE</h3>
      <form id="form">
            <fieldset id="personal">
                  <legend>Data</legend>
                  <label for="name">Item : </label> 
                  <input name="txtItem" id="txtItem" type="text" size="50" value="<?php echo $all_data->item; ?>" /> <span class="error" id="errTxtItem"></span>
                  <input name="hdId" id="hdId" type="hidden" value="<?php echo $all_data->id; ?>" />
                  <br>
                  <label for="name">No Urut: </label>
                  <select name="selectNumberOrder">
                        <?php
                        for ($i = 1; $i <= 10; $i++):
                              if ((!in_array($i, $arr_used_order_number)) or ($i == $all_data->order_number)):
                                    ?>
                                    <option value="<?php echo $i ?>" <?php echo ($i == $all_data->order_number) ? "selected='selected'" : ""; ?>><?php echo $i ?></option>
                                    <?php
                              endif;
                        endfor;
                        ?>
                  </select> <span class="error" id="errSelectNumberOrder"></span>
            </fieldset>
            <div class="ajax-loader" style="display: none;">&nbsp;</div>
            <div align="center">
                  <input id="button1" type="button" value="Simpan" onclick="ajaxChange('masterbrandcomm', 'update', '<?php echo site_url("master_brandcomm/update"); ?>', '<?php echo site_url("master_brandcomm/content"); ?>', '<?php echo site_url("master_brandcomm/insert_page"); ?>')" /> 
                  <input id="button2" type="button" value="Kembali" onclick="loadForm('<?php echo site_url("master_brandcomm/insert_page"); ?>')" />
            </div>
      </form>
<?php endif; ?>