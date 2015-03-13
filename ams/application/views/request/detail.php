<?php if (count($all_data_brandcomm) > 0): ?>
      <fieldset id="brandcomm">
            <legend>Brandcomm</legend>
            <!-- <div style="float: left; width: 400px;">
                    <label for="nopaket">No Brandcomm : </label> 
                    <input name="txtNoBrandcomm" id="txtNoBrandcomm" type="text" disabled="disabled" value="<?php echo $all_data->no_brandcomm; ?>" />
                    <br> -->
            <label for="nopaket">No Brandcomm : </label>
            <input name='txtNoBrandcomm' type='text' size='9' disabled="disabled" value="<?php echo $all_data_brandcomm->no_brandcomm; ?>" />
            <br>
            <label for="nopaket">Start Date : </label>
            <input name='txtStartDate' type='text' size='9' disabled="disabled" value="<?php echo $all_data_brandcomm->start_date; ?>" />
            <br>
            <label for="nopaket">End Date : </label>
            <input name='txtEndDate' type='text' size='9' disabled="disabled" value="<?php echo $all_data_brandcomm->end_date; ?>" />
            <!-- </div> -->
            <table>
                  <thead>
                  <th width="40px">No</th>
                  <th>Item</th>
                  <th>Detail</th>
                  </thead>
                  <tbody>
                        <?php foreach ($all_detail_brandcomm as $key => $detail_brandcomm): ?>
                              <tr>
                                    <td align="center"><?php echo ($key + 1); ?></td>
                                    <td><?php echo $detail_brandcomm->item; ?></td>
                                    <td><?php echo $detail_brandcomm->detail; ?></td>
                              </tr>
                        <?php endforeach; ?>
                  </tbody>
            </table>
      </fieldset>
      <fieldset id="personal">
            <legend>Feedback Client</legend>
            <label for="feedback">Status : </label>
            <?php echo ($all_data_brandcomm->enable_feedback == "Y") ? "Enable" : "Disable"; ?>
            <br>
            <label for="feedback">Feedback : </label>
            <textarea id="txtFeedback" disabled="disabled" style="height: 100px; width: 550px;" name="txtFeedback"><?php echo $all_data_brandcomm->feedback; ?></textarea>
      </fieldset>
<?php endif; ?>
<fieldset id="paket">
      <legend>Paket</legend>
      <span class="error" id="errPaket"></span>
      <table>
            <thead>
            <th>Iklan</th>
            <th>Kanal</th>
            <th>Produk Grup</th>
            <th>Posisi</th>
            <th>CPM Quota</th>
            <th>Periode</th>
            <th>Keterangan</th>
            <th>No Po</th>
            <th>Request</th>
            </thead>
            <tbody>
                  <?php
                  $n = 0;
                  foreach ($result as $detail):
                        ?>
                        <tr class='remove'>
                              <td align='center'>
                                    <?php echo $detail["ads"]; ?>
                              </td>
                              <td align='center'>
                                    <?php echo $detail["kanal"]; ?>
                              </td>
                              <td align='center'>
                                    <?php echo $detail["product_group"]; ?>
                              </td>
                              <td align='center'>
                                    <?php echo $detail["position"]; ?>
                              </td>
                              <td align='center'>
                                    <?php echo number_format($detail["cpm_quota"], 0, ",", "."); ?>
                              </td>
                              <td align='center'>
                                    <?php echo format_date($detail["start_date"], TRUE); ?>
                                    -
                                    <?php echo format_date($detail["end_date"], TRUE); ?>
                              </td>
                              <td align='center'>
                                    <?php echo $detail["misc_info"]; ?>
                              </td>
                              <td align='center'>
                                    <?php echo $detail["no_po"]; ?>
                              </td>
                              <td align="center">
                                    <?php
									$allDetailReq = $this->Request_Model->getRequestDetail($detail["no_paket"],$detail["kanal_id"],$detail["product_group_id"],$detail["position_id"],$detail["start_date"]);
                                    if (!empty($detail["no_po"])):
                                          if ($detail["request"] == "Y" || !empty($allDetailReq)):
                                                ?>
                                                <img src="<?php echo image_path("checked.png"); ?>" title="Was Request" width="16" height="16" />
                                          <?php else: ?>
                                                <input type="radio" name="chkRequest" value="<?php echo $detail["id"]; ?>" />
                                          <?php
                                          endif;
                                    endif;
                                    ?>
                                    <input type="hidden" name="hdId" value="<?php echo $detail["id"]; ?>" />
                              </td>
                        </tr>
                        <?php
                        $n += 1;
                  endforeach;
                  ?>
            </tbody>
      </table>
</fieldset>      