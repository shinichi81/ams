<?php if ($update == "Y"): ?>
      <h3 id="adduser">FORM UPDATE</h3>
      <form id="form">
            <fieldset id="personal">
                  <legend>Data</legend>
                  <label for="nopaket">No Brandcomm : </label> 
                  <input name="txtNoBrandcomm" id="txtNoBrandcomm" type="text" disabled="disabled" value="<?php echo $all_data->no_brandcomm; ?>" />
                  <br>
                  <label for="nopaket">Order Date : </label>
                  <input name='txtStartDate' class='txtStartDate' type='text' size='9' value="<?php echo $all_data->start_date; ?>" readonly="readonly" /> <span class="error" id="errTxtStartDate"></span>
                  <input type="hidden" name="hdStartDate" value="<?php echo $all_data->start_date; ?>" />
                  <br>
                  <label for="nopaket">Deadline Date : </label>
                  <input name='txtEndDate' class='txtEndDate' type='text' size='9' value="<?php echo $all_data->end_date; ?>" readonly="readonly" /> <span class="error" id="errTxtEndDate"></span>
                  <input type="hidden" name="hdEndDate" value="<?php echo $all_data->end_date; ?>" />
                  <div class="error" id="errTxtWrongDateRange"></div>
            </fieldset>

            <fieldset id="paket">
                  <legend>Item</legend>
                  <!-- <button type="button" name="btnTambah" id="btnTambah" title="Tambah" class="btn"><img src="<?php echo image_url("icons/add.png"); ?>" alt="Tambah" /></button> <span class="error" id="errPaket"></span> -->
                  <table>
                        <thead>
                        <th width="40px">No</th>
                        <th>Item</th>
                        <th>Detail</th>
                        </thead>
                        <tbody id="addme">
                              <?php foreach ($all_item as $key => $item): ?>
                                    <tr>
                                          <td align="center"><?php echo ($key + 1); ?></td>
                                          <td><?php echo $item->item; ?></td>
                                          <td>
                                                <textarea name="txtDetail" id="txtDetail" style="height: 60px; width: 500px;"><?php echo $all_detail[$key]->detail; ?></textarea>
                                                <input type="hidden" name="hdItemId" value="<?php echo $item->id; ?>" />
                                                <div class='error' id='errTxtDetail'></div>
                                          </td>
                                    </tr>
                              <?php endforeach; ?>
                        </tbody>
                  </table>
            </fieldset>

            <?php if ($all_data->enable_feedback == "Y"): ?>
                  <fieldset id="personal">
                        <legend>Feedback Client</legend>
                        <label for="feedback">Feedback : </label>
                        <textarea id="txtFeedback" style="height: 100px; width: 550px;" name="txtFeedback"><?php echo $all_data->feedback; ?></textarea>
                        <span class="error" id="errTxtFeedback"></span>
                  </fieldset>
            <?php endif; ?>

            <div class="ajax-loader" style="display: none;">&nbsp;</div>
            <div align="center">
                  <input id="button1" type="button" value="Simpan" onclick="ajaxChange('brandcomm', 'update', '<?php echo site_url("brandcomm/update"); ?>', '<?php echo site_url("brandcomm/content"); ?>', '<?php echo site_url("brandcomm/insert_page"); ?>')" /> 
                  <input id="button2" type="button" value="Kembali" onclick="loadForm('<?php echo site_url("brandcomm/insert_page"); ?>')" />
            </div>
      </form>

      <script type="text/javascript">
            $(document).ready(function() {
                  $(".txtStartDate").datepicker({dateFormat: "yy-mm-dd", minDate: new Date(<?php echo date("Y"); ?>, <?php echo date("n") - 1; ?>, <?php echo date("j"); ?>)});
                  $(".txtEndDate").datepicker({dateFormat: "yy-mm-dd", minDate: new Date(<?php echo date("Y"); ?>, <?php echo date("n") - 1; ?>, <?php echo date("j"); ?>)});
            });
      </script>
<?php endif; ?>