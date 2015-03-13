<?php if ($update == "Y"): ?>
      <h3 id="adduser">FORM UPDATE</h3>
      <form id="form">
            <fieldset id="personal">
                  <legend>Data</legend>
                  <div style="float: left; width: 400px;">
                        <label for="nopaket">No Brandcomm : </label> 
                        <input name="txtNoBrandcomm" id="txtNoBrandcomm" type="text" disabled="disabled" value="<?php echo $all_data->no_brandcomm; ?>" />
                        <br>
                        <label for="nopaket">Order Date : </label>
                        <input name='txtStartDate' disabled="disabled" type='text' value="<?php echo format_date($all_data->start_date, TRUE); ?>" /> <span class="error" id="errTxtStartDate"></span>
                        <br>
                        <label for="nopaket">Deadline Date : </label>
                        <input name='txtEndDate' disabled="disabled" type='text' value="<?php echo format_date($all_data->end_date, TRUE); ?>" /> <span class="error" id="errTxtEndDate"></span>
                  </div>

            </fieldset>
            <fieldset id="paket">
                  <legend>Item</legend>
                  <!-- <button type="button" name="btnTambah" id="btnTambah" title="Tambah" class="btn"><img src="<?php echo image_url("icons/add.png"); ?>" alt="Tambah" /></button> <span class="error" id="errPaket"></span> -->
                  <table>
                        <thead>
                        <th width="40px">No</th>
                        <th width="300px">Item</th>
                        <th>Detail</th>
                        </thead>
                        <tbody id="addme">
                              <?php foreach ($all_item as $key => $item): ?>
                                    <tr>
                                          <td align="center"><?php echo ($key + 1); ?></td>
                                          <td><?php echo $item->item; ?></td>
                                          <td>
                                                <?php echo $all_detail[$key]->detail; ?>
                                          </td>
                                    </tr>
                              <?php endforeach; ?>
                        </tbody>
                  </table>
            </fieldset>

            <fieldset id="personal">
                  <legend>Feedback Client</legend>
                  <label for="feedback">Status : </label>
                  <?php echo ($all_data->enable_feedback == "Y") ? "Enable" : "Disable"; ?>
                  <br>
                  <label for="feedback">Feedback : </label>
                  <textarea id="txtFeedback" disabled="disabled" style="height: 100px; width: 550px;" name="txtFeedback"><?php echo $all_data->feedback; ?></textarea>
            </fieldset>

            <div class="ajax-loader" style="display: none;">&nbsp;</div>
            <div align="center">
                  <input id="button1" type="button" value="Done" onclick="ajaxChange('done', 'update_brandcomm', '<?php echo site_url("done/update_brandcomm"); ?>', '<?php echo site_url("done/content_brandcomm"); ?>', '<?php echo site_url("done/insert_page"); ?>')" /> 
                  <input id="button2" type="button" value="Kembali" onclick="loadForm('<?php echo site_url("done/insert_page"); ?>')" />
            </div>
      </form>
<?php endif; ?>