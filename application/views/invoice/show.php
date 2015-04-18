<?php if ($read == "Y"): ?>
      <p>
      <table class="noborder">
            <tr>
                  <td width="150px">No Paket</td>
                  <td width="20px">:</td>
                  <td><?php echo $all_data->no_paket; ?></td>
            </tr>
            <tr>
                  <td>Agency</td>
                  <td>:</td>
                  <td><?php echo $all_data->brand; ?></td>
            </tr>
            <tr>
                  <td>Client</td>
                  <td>:</td>
                  <td><?php echo $all_data->company; ?></td>
            </tr>
            <tr>
                  <td>No PO</td>
                  <td>:</td>
                  <td><?php echo $all_data->no_po; ?></td>
            </tr>
            <tr>
                  <td>No SO</td>
                  <td>:</td>
                  <td><?php echo $all_data->no_so; ?></td>
            </tr>
            <tr>
                  <td>No Invoice</td>
                  <td>:</td>
                  <td><?php echo $all_data->no_invoice; ?></td>
            </tr>
            <tr>
                  <td>AE / Sales</td>
                  <td>:</td>
                  <td><?php echo $all_data->sales; ?></td>
            </tr>
            <tr>
                  <td>Tanggal Jatuh Tempo</td>
                  <td>:</td>
                  <td><?php echo format_date($all_data->jatuh_tempo, TRUE); ?></td>
            </tr>
      </table>
	  
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
      </p>
<?php endif; ?>