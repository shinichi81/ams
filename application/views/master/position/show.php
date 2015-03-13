<?php if ($read == "Y"): ?>
      <p>
      <table class="noborder">
            <tr>
                  <td width="110px">Nama</td>
                  <td width="20px">:</td>
                  <td><?php echo $all_data->name; ?></td>
            </tr>
            <tr>
                  <td>Keterangan</td>
                  <td>:</td>
                  <td><?php echo $all_data->misc_info; ?></td>
            </tr>
            <?php /*
            <tr>
                  <td>Dapat Ditimpa</td>
                  <td>:</td>
                  <td><?php echo ($all_data->allow_override == "Y") ? "Ya" : "Tidak"; ?></td>
            </tr>
            <?php if ($all_data->allow_override == "Y"): ?>
                  <tr>
                        <td>CPM Quota</td>
                        <td>:</td>
                        <td><?php echo $all_data->cpm_quota; ?></td>
                  </tr>
            <?php endif; ?>
             */ ?>
      </table>
      </p>
<?php endif; ?>