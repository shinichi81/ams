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
                  <td valign="top">Rubrik</td>
                  <td valign="top">:</td>
                  <td>
                        <?php foreach ($selected_rubrik as $rubrik): ?>
                              > <?php echo $rubrik->name; ?><br>
                        <?php endforeach; ?>
                  </td>
            </tr>
            <tr>
                  <td valign="top">Posisi</td>
                  <td valign="top">:</td>
                  <td>
                        <?php foreach ($selected_position as $position): ?>
                              > <?php echo $position->name; ?><br>
                        <?php endforeach; ?>
                  </td>
            </tr>
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