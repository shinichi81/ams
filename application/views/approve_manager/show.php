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
                  <td>AE / Sales</td>
                  <td>:</td>
                  <td><?php echo $all_data->sales; ?></td>
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
            <th>Harga / hari</th>
			<th>Harga Total</th>
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
                        <td align='center'>
                              <?php echo number_format($detail["harga"],0,",","."); ?>
                        </td>
                        <td align='center'>
                              <?php echo number_format($detail["total"] ,0,",",".");?>
                        </td>
                  </tr>
            <?php endforeach; ?>
      </tbody>
      </table>
	  <br />
      <table class="noborder">
            <tr>
                  <td width="150px">Harga Paket Gross</td>
                  <td width="20px">:</td>
				  <td><?= "Rp. " . number_format($all_data->paket_gross,0,",",".");?></td>
            </tr>
            <tr>
                  <td>Diskon (%)</td>
                  <td>:</td>
                  <td><?php echo $all_data->diskon; ?></td>
            </tr>
			<tr>
				  <td>Diskon (Nominal)</td>
				  <td>:</td>
				  <td><?= "Rp. " . number_format($all_data->diskon_nominal,0,",",".");?></td>
			</tr>
            <tr>
                  <td>Additional Diskon (%)</td>
                  <td>:</td>
                  <td><?php echo $all_data->additional_diskon; ?></td>
            </tr>
			<tr>
				  <td>Additional Diskon (Nominal)</td>
				  <td>:</td>
				  <td><?= "Rp. " . number_format($all_data->additional_diskon_nominal,0,",",".");?></td>
			</tr>
            <tr>
                  <td>Total Harga Paket</td>
                  <td>:</td>
                  <td><?php echo "Rp. " . number_format($all_data->paket_total, 0, ",", ".");?></td>
            </tr>
      </table>
	  <br />      
      </p>
<?php endif; ?>