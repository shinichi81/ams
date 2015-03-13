<?php if ($read == "Y"): ?>
      <p>
      <table class="noborder">
            <tr>
                  <td width="110px">No Paket</td>
                  <td width="20px">:</td>
                  <td><?php echo $all_data->no_paket; ?></td>
            </tr>
            <tr>
                  <td>No Paket User</td>
                  <td>:</td>
                  <td><?php echo $all_data->no_paket_user; ?></td>
            </tr>
            <tr>
                  <td>Agency</td>
                  <td>:</td>
                  <td><?php echo $all_data->agency; ?></td>
            </tr>
            <tr>
                  <td>Client</td>
                  <td>:</td>
                  <td><?php echo $all_data->client; ?></td>
            </tr>
            <tr>
                  <td>Budget</td>
                  <td>:</td>
                  <td><?php echo $all_data->budget; ?></td>
            </tr>
            <tr>
                  <td>Diskon</td>
                  <td>:</td>
                  <td><?php echo $all_data->diskon; ?></td>
            </tr>
            <tr>
                  <td>Benefit</td>
                  <td>:</td>
                  <td><?php echo $all_data->benefit; ?></td>
            </tr>
            <tr>
                  <td>Keterangan</td>
                  <td>:</td>
                  <td><?php echo $all_data->misc_info; ?></td>
            </tr>
            <tr>
                  <td>AE / Sales</td>
                  <td>:</td>
                  <td><?php echo $all_data->sales; ?></td>
            </tr>
            <tr>
                  <td>Done</td>
                  <td>:</td>
                  <td><?php echo ($all_data->done == "Y") ? "Ya" : "Belum"; ?></td>
            </tr>
            <tr>
                  <td>Event</td>
                  <td>:</td>
                  <td><?php echo $all_data->misc_info_event; ?></td>
            </tr>
            <tr>
                  <td>Production Cost</td>
                  <td>:</td>
                  <td><?php echo $all_data->misc_info_production_cost; ?></td>
            </tr>
      </table>

      <?php if (count($all_data_brandcomm) > 0): ?>
            <table class="noborder">
                  <tr>
                        <td width="120px"><strong>BRANDCOMM</strong></td>
                        <td width="20px">&nbsp;</td>
                        <td>&nbsp;</td>
                  </tr>
                  <tr>
                        <td>No Brandcomm</td>
                        <td>:</td>
                        <td><?php echo$all_data_brandcomm->no_brandcomm; ?></td>
                  </tr>
                  <tr>
                        <td>Start Date</td>
                        <td>:</td>
                        <td><?php echo format_date($all_data_brandcomm->start_date, TRUE); ?></td>
                  </tr>
                  <tr>
                        <td>End Date</td>
                        <td>:</td>
                        <td><?php echo format_date($all_data_brandcomm->end_date, TRUE); ?></td>
                  </tr>
            </table>
            <table>
                  <thead>
                        <tr>
                              <th>No</th>
                              <th>Item</th>
                              <th>Detail</th>
                        </tr>
                  </thead>
                  <tbody>
                        <?php
                        foreach ($all_detail_brandcomm as $key => $detail_brandcomm):
                              ?>
                              <tr class='remove'>
                                    <td align='center'>
                                          <?php echo++$key; ?>
                                    </td>
                                    <td>
                                          <?php echo $detail_brandcomm->item; ?>
                                    </td>
                                    <td align='center'>
                                          <?php echo $detail_brandcomm->detail; ?>
                                    </td>
                              </tr>
                              <?php
                        endforeach;
                        ?>
                  </tbody>
            </table>
            <table class="noborder">
                  <tr>
                        <td width="150px">Status Feedback Client</td>
                        <td width="20px">:</td>
                        <td><?php echo ($all_data_brandcomm->enable_feedback == "Y") ? "Enable" : "Disable"; ?></td>
                  </tr>
                  <tr>
                        <td>Feedback Client</td>
                        <td>:</td>
                        <td><?php echo $all_data_brandcomm->feedback; ?></td>
                  </tr>
                  <tr>
                        <td>Progress</td>
                        <td>:</td>
                        <td><?php echo $all_data_brandcomm->progress; ?>%</td>
                  </tr>
            </table>
      <?php endif; ?>

      <table class="noborder">
            <tr>
                  <td width="110px"><strong>PAKET</strong></td>
                  <td width="20px">&nbsp;</td>
                  <td>&nbsp;</td>
            </tr>
      </table>
      <table>
            <thead>
            <th>Iklan</th>
            <th>Kanal</th>
            <th>Produk Grup</th>
            <th>Posisi</th>
            <th>CPM Quota</th>
            <th>Periode</th>
            <th>Keterangan</th>
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
                              <?php echo $detail["misc_info"]; ?>
                        </td>
                  </tr>
            <?php endforeach; ?>
      </tbody>
      </table>
      <table class="noborder">
            <tr>
                  <td width="110px">Conflict Brand</td>
                  <td width="20px">:</td>
                  <td><?php echo $all_data->is_restrict; ?></td>
            </tr>
            <tr>
                  <td>Industri</td>
                  <td>:</td>
                  <td><?php echo isset($name_cat_industry)?$name_cat_industry:'-'; ?></td>
            </tr>
            <tr>
                  <td>Sub Industri</td>
                  <td>:</td>
                  <td><?php echo $all_data->industry; ?></td>
            </tr>
      </table>
      </p>
<?php endif; ?>