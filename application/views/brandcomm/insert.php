<?php
if ($create == "Y"):
      if ($total_not_feedback >= $this->config->item("max_request_brandcomm")):
            ?>
            <span class="error">* there are brandcomm that has not been feedback</span>
      <?php else: ?>
            <h3 id="adduser">FORM INPUT</h3>
            <form id="form">
                  <fieldset id="personal">
                        <legend>Data</legend>
                        <label for="nopaket">Order Date : </label>
                        <input name='txtStartDate' class='txtStartDate' type='text' size='9' readonly="readonly" /> <span class="error" id="errTxtStartDate"></span>
                        <br>
                        <label for="nopaket">Deadline Date : </label>
                        <input name='txtEndDate' class='txtEndDate' type='text' size='9' readonly="readonly" /> <span class="error" id="errTxtEndDate"></span>
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
                                                <td align="center"><?php echo++$key; ?></td>
                                                <td><?php echo $item->item; ?></td>
                                                <td>
                                                      <textarea name="txtDetail" id="txtDetail" style="height: 60px; width: 500px;"></textarea>
                                                      <input type="hidden" name="hdItemId" value="<?php echo $item->id; ?>" />
                                                      <div class='error' id='errTxtDetail'></div>
                                                </td>
                                          </tr>
                                    <?php endforeach; ?>
                              </tbody>
                        </table>
                  </fieldset>

                  <div class="ajax-loader" style="display: none;">&nbsp;</div>
                  <div align="center">
                        <input id="button1" type="button" value="Simpan" onclick="ajaxChange('brandcomm', 'insert', '<?php echo site_url("brandcomm/insert"); ?>', '<?php echo site_url("brandcomm/content"); ?>', '<?php echo site_url("brandcomm/insert_page"); ?>')" /> 
                        <input id="button2" type="button" value="Reset" onclick="loadForm('<?php echo site_url("brandcomm/insert_page"); ?>')" />
                  </div>
            </form>

            <script type="text/javascript">
                  $(document).ready(function() {
                        $(".txtStartDate").datepicker({dateFormat: "yy-mm-dd", minDate: new Date(<?php echo date("Y"); ?>, <?php echo date("n") - 1; ?>, <?php echo date("j"); ?>)});
                        $(".txtEndDate").datepicker({dateFormat: "yy-mm-dd", minDate: new Date(<?php echo date("Y"); ?>, <?php echo date("n") - 1; ?>, <?php echo date("j"); ?>)});
                  });
            </script>
      <?php
      endif;
endif;
?>