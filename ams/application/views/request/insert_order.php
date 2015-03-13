<?php if ($create == "Y"): ?>
      <h3 id="adduser">FORM INPUT</h3>
      <form id="form">
            <fieldset id="personal">
                  <legend>Data</legend>
                  <div style="float: left; width: 400px;">
                        <label for="nopaket">No Paket : </label> 
                        <input type="radio" name="rdbPacket" value="Y" /> Autocomplete &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="rdbPacket" value="N" checked="checked" /> Cari
                        <br>
                        <label for="nbsp">&nbsp;</label>
                        <input name="txtNoPaket" id="txtNoPaket" type="text" value="<?php echo $all_data->no_paket; ?>" /> <span class="error" id="errTxtNoPaket"></span>
                        <br>
                        <label for="agency">No Paket User : </label> 
                        <input name="txtNoPaketUser" id="txtNoPaketUser" type="text" disabled="disabled" value="<?php echo $all_data->no_paket_user; ?>" />
                        <br>
                        <label for="agency">Agency : </label> 
                        <input name="txtAgency" id="txtAgency" type="text" disabled="disabled" value="<?php echo $all_data->agency; ?>" />
                        <br>
                        <label for="client">Client : </label> 
                        <input name="txtClient" id="txtClient" type="text" disabled="disabled" value="<?php echo $all_data->client; ?>" />
                        <!--
                        <br>
                        <label for="benefit">Brand : </label> 
                        <input name="txtBrand" id="txtBrand" type="text" /> <span class="error" id="errTxtBrand"></span>
                        -->
                        <br>
                        <label for="benefit">Jenis Order : </label> 
                        <input type="radio" name="rdbOrderType" value="T" checked="checked" /> Tayang Banner&nbsp;
                        <input type="radio" name="rdbOrderType" value="D" /> Data
                        <span class="error" id="errTxtOrderType"></span>
                        <br>
                        <label for="benefit">Detail : </label> 
                        <textarea name="txtDetail" id="txtDetail" style="height: 80px; width: 250px;"></textarea>
                  </div>
                  <div style="float: left; width: 400px;">
                        <label for="budget">Budget : </label> 
                        <input name="txtBudget" id="txtBudget" type="text" disabled="disabled" value="<?php echo $all_data->budget; ?>" />
                        <br>
                        <label for="benefit">Benefit : </label> 
                        <input name="txtBenefit" id="txtBenefit" type="text" disabled="disabled" value="<?php echo $all_data->benefit; ?>" />
                        <br>
                        <label for="diskon">Diskon : </label> 
                        <input name="txtDiskon" id="txtDiskon" type="text" disabled="disabled" value="<?php echo $all_data->diskon; ?>" />
                        <br>
                        <label for="miscinfo">Keterangan : </label> 
                        <textarea name="txtMiscInfo" id="txtMiscInfo" disabled="disabled" style="height: 80px; width: 250px;"><?php echo $all_data->misc_info; ?></textarea>
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
                        <th>Periode</th>
                        <th>Keterangan</th>
                        <th>No Po</th>
                        <th>Request</th>
                        </thead>
                        <tbody id="addme">
                              <?php
                              $n = 0;
                              foreach ($all_detail as $detail):
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
            <fieldset id="conflict">
                  <legend>Conflict Brand</legend>
                  <label for="conflict">Conflict Brand : </label>
                  <span id="isRestrict"><?php echo $all_data->is_restrict; ?></span>
                  <p>
                  <label for="industrycat">Industry : </label> 
                  <span id="industrycat"><?php echo isset($name_cat_industry)?$name_cat_industry:'-'; ?></span>
                  <input type="hidden" name="hdIndustryCatId" id="hdIndustryCatId" value="<?php echo $all_data->industrycat_id; ?>"/>
				  </p>
                  <p>
                  <label for="industry">Sub Industri : </label>
                  <span id="industry"><?php echo $all_data->industry; ?></span>
                  <input type="hidden" name="hdIndustryId" id="hdIndustryId" value="<?php echo $all_data->industry_id; ?>" />
				  </p>
            </fieldset>
            <div class="ajax-loader" style="display: none;">&nbsp;</div>
            <div align="center">
                  <input id="button1" type="button" value="Simpan" onclick="ajaxChange('request', 'insert', '<?php echo site_url("request/insert"); ?>', '<?php echo site_url("request/content"); ?>', '<?php echo site_url("request/insert_page"); ?>')" /> 
                  <input id="button2" type="button" value="Reset" onclick="loadForm('<?php echo site_url("request/insert_page"); ?>')" />
            </div>
      </form>

      <script type="text/javascript">
            $(document).ready(function() {
                  // untuk menampilkan inputan no space
                  $("input[name=rdbPacket]").click(function() {
                        if ($(this).val() == "Y")
                              loadForm('<?php echo site_url("request/insert_page"); ?>')
                        else
                              loadForm('<?php echo site_url("request/search_page"); ?>')
                  });
            });
      </script>
<?php endif; ?>