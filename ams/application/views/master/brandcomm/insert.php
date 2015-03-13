<?php if ($create == "Y"): ?>
      <h3 id="adduser">FORM INPUT</h3>
      <form id="form">
            <fieldset id="personal">
                  <legend>Data</legend>
                  <label for="name">Item : </label>
                  <input name="txtItem" id="txtItem" type="text" size="50" /> <span class="error" id="errTxtItem"></span>
                  <br>
                  <label for="name">No Urut: </label>
                  <select name="selectNumberOrder">
                        <?php
                        for ($i = 1; $i <= 10; $i++):
                              if (!in_array($i, $arr_used_order_number)):
                                    ?>
                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                    <?php
                              endif;
                        endfor;
                        ?>
                  </select> <span class="error" id="errSelectNumberOrder"></span>
            </fieldset>
            <div class="ajax-loader" style="display: none;">&nbsp;</div>
            <div align="center">
                  <input id="button1" type="button" value="Simpan" onclick="ajaxChange('masterbrandcomm', 'insert', '<?php echo site_url("master_brandcomm/insert"); ?>', '<?php echo site_url("master_brandcomm/content"); ?>', '<?php echo site_url("master_brandcomm/insert_page"); ?>')" /> 
                  <input id="button2" type="button" value="Reset" onclick="loadForm('<?php echo site_url("master_brandcomm/insert_page"); ?>')" />
            </div>
      </form>
<?php endif; ?>