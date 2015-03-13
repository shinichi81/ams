<?php if ($update == "Y"): ?>
      <h3 id="adduser">FORM UPDATE</h3>
      <form id="form">
            <fieldset id="personal">
                  <legend>Data</legend>
                  <div style="float: left; width: 400px;">
                        <label for="nopaket">No Paket : </label> 
                        <input name="txtNoPaket" id="txtNoPaket" type="text" disabled="disabled" value="<?php echo $all_data->no_paket; ?>" />
                        <br>
                        <label for="nopaketuser">No Paket User : </label> 
                        <input name="txtNoPaketUser" id="txtNoPaketUser" disabled="disabled" type="text" value="<?php echo $all_data->no_paket_user; ?>" /> <span class="error" id="errTxtNoPaketUser"></span>
                        <br>
                        <label for="agency">Agency : </label> 
                        <input name="txtAgency" id="txtAgency" type="text" disabled="disabled" value="<?php echo $all_data->agency; ?>" />
                        <br>
                        <label for="client">Client : </label> 
                        <input name="txtClient" id="txtClient" type="text" disabled="disabled" value="<?php echo $all_data->client; ?>" />
                        <br>
                        <label for="benefit">Keterangan : </label>
                        <textarea name="txtMiscInfo" id="txtMiscInfo" disabled="disabled" style="height: 80px; width: 250px;"><?php echo $all_data->misc_info; ?></textarea>
                  </div>
                  <div style="float: left;">	
                        <?php /*
                          <label for="budget">Budget : </label>
                          <input name="txtBudget" id="txtBudget" type="text" disabled="disabled" value="<?php echo $all_data->budget; ?>" />
                          <br>
                          <label for="diskon">Diskon : </label>
                          <input name="txtDiskon" id="txtDiskon" type="text" disabled="disabled" value="<?php echo $all_data->diskon; ?>" />
                          <br>
                          <label for="benefit">Benefit : </label>
                          <input name="txtBenefit" id="txtBenefit" type="text" disabled="disabled" value="<?php echo $all_data->benefit; ?>" />
                         */ ?>
                        <!--                        <label for="benefit">Jenis Order : </label> 
                                                <input type="radio" name="rdbOrderType" value="T" disabled="disabled" <?php echo ($all_data->request_type == "T") ? "checked='checked'" : ""; ?> /> Tayang Banner&nbsp;
                                                <input type="radio" name="rdbOrderType" value="D" disabled="disabled" <?php echo ($all_data->request_type == "D") ? "checked='checked'" : ""; ?> /> Data
                                                <br>
                                                <label for="brand">Brand : </label> 
                                                <input name="txtBrand" id="txtBrand" type="text" disabled="disabled" value="<?php echo $all_data->brand; ?>" />
                                                <br>-->
                        <label for="benefit">Reason : </label> 
                        <textarea name="txtReason" id="txtReason" disabled="disabled" style="height: 80px; width: 250px;"><?php echo $all_data->reason; ?></textarea>
                  </div>
            </fieldset>
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
                        <th>Periode Sebelumnya</th>
                        <th>Periode Revisi</th>
                        <th>Keterangan</th>
                        <th>Approve</th>
                        </thead>
                        <tbody>
                              <?php foreach ($all_detail as $detail): ?>
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
                                                <?php echo format_date($detail["new_start_date"], TRUE); ?>
                                                -
                                                <?php echo format_date($detail["new_end_date"], TRUE); ?>
                                          </td>
                                          <td align='center'>
                                                <?php echo $detail["misc_info"]; ?>
                                          </td>
                                          <td align='center'>
                                                <?php if ($detail["approve"] == "N"): ?>
                                                      <input type="checkbox" name="chkApprove" value="<?php echo $detail["id"]; ?>" />
                                                <?php else: ?>
                                                      <img src="<?php echo image_path("checked.png"); ?>" title="Was Approve" width="16" height="16" />
                                                <?php endif; ?>
                                          </td>
                                    </tr>
                              <?php endforeach; ?>
                        </tbody>
                  </table>
            </fieldset>
            <fieldset id="conflict">
                  <legend>Conflict Brand</legend>
                  <label for="conflictbrand">Conflict Brand : </label> 
                  <?php echo $all_data->is_restrict; ?>
                  <p>
                  <label for="industry">Industry : </label> 
                  <?php echo isset($name_cat_industry)?$name_cat_industry:'-'; ?>
				  </p>
                  <p>
                  <label for="industry">Sub Industry : </label> 
                  <?php echo $all_data->industry; ?>
				  </p>
            </fieldset>
            <div class="ajax-loader" style="display: none;">&nbsp;</div>
            <div align="center">
                  <input type="hidden" name="hdId" id="hdId" value="<?php echo $all_data->id; ?>" />
                  <input id="button1" type="button" value="Simpan" onclick="ajaxChange('backdate_receive', 'update', '<?php echo site_url("backdate_receive/update"); ?>', '<?php echo site_url("backdate_receive/content"); ?>', '<?php echo site_url("backdate_receive/insert_page"); ?>')" /> 
                  <input id="button2" type="button" value="Kembali" onclick="loadForm('<?php echo site_url("backdate_receive/insert_page"); ?>')" />
            </div>
      </form>
<?php endif; ?>