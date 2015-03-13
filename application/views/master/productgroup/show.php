<?php if ($read == "Y"): ?>
      <p>
		<table class="noborder">
            <tr>
                  <td width="90px">Kanal</td>
                  <td width="20px">:</td>
                  <td><?php echo $selected_kanal->name; ?></td>
            </tr>
            <tr>
                  <td>Nama</td>
                  <td>:</td>
                  <td><?php echo $all_data->name; ?></td>
            </tr>
            <tr>
                  <td>Keterangan</td>
                  <td>:</td>
                  <td><?php echo $all_data->misc_info; ?></td>
            </tr>
            <tr>
                  <td>Harga</td>
                  <td>:</td>
                  <td><?php echo $all_data->harga; ?></td>
            </tr>
            <tr>
                  <td valign="top">Rubrik</td>
                  <td valign="top">:</td>
                  <td>
                        <?php foreach ($selected_rubrik as $rubrik): ?>
                              > <?php echo $rubrik->name; ?><br>
                        <?php endforeach; ?>
                  </td>
            </tr>
		</table>
		
		<table class="noborder">
            <tr>
                  <td width="150px"><strong>POSISI</strong></td>
                  <td width="20px">&nbsp;</td>
                  <td>&nbsp;</td>
            </tr>
		</table>
      <table>
            <thead>
                  <tr>
                        <th>Posisi</th>
                        <th>Harga</th>
                  </tr>
            </thead>
            <tbody>
                  <?php
                  $n = 0;
                  foreach ($selected_harga as $position):
                        ?>
                        <tr class='remove'>
                              <td align='center'>
                                    <?php echo $position->name; ?>
                              </td>
                              <td align='center'>
                                    <?php echo "Rp. " . number_format($position->harga,0,",","."); ?>
                              </td>
                        </tr>
                        <?php
                        $n += 1;
                  endforeach;
                  ?>
            </tbody>
      </table>
	  
		<table class="noborder">
            <tr>
                  <td valign="top">Posisi CPM</td>
                  <td valign="top">:</td>
                  <td>
                        <?php foreach ($all_cpm as $cpm): ?>
                              > <?php echo $cpm->position_name; ?><br>
                        <?php endforeach; ?>
                  </td>
            </tr>
		</table>
      </p>
<?php endif; ?>